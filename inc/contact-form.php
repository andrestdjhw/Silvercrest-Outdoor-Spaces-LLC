<?php
/**
 * Consultation request form backend (React form: src/components/ContactForm.js).
 *
 * POST /wp-json/silvercrest/v1/consultation
 * - Validates fields from the brief (section 09).
 * - Saves every request as a private "Consultation Request" in wp-admin (nothing is lost if email fails).
 * - Email: EmailJS sends the notification + customer auto-reply from the browser (ids in functions.php).
 *   If EmailJS fails, the browser calls /consultation/notify and wp_mail sends the notification instead.
 *   Without EmailJS configured, wp_mail sends it right away.
 * - Anti-spam: reCAPTCHA v3 (verified only when SILVERCREST_RECAPTCHA_SECRET is defined in wp-config.php)
 *   + honeypot + minimum fill time + per-IP rate limit.
 *
 * Launch checklist (brief, section 13): transactional SMTP + SPF/DKIM/DMARC on the corporate domain.
 */

// TODO: corporate inbox not set up yet — notifications go to the WordPress admin email until then.
function silvercrest_form_recipient() {
  return get_option('admin_email');
}

/** Options shown in the form — passed to React so PHP stays the single source. */
function silvercrest_form_options() {
  $services = array();
  foreach (silvercrest_services() as $slug => $service) {
    $services[] = array('value' => $slug, 'label' => $service['label']);
  }
  $services[] = array('value' => 'not-sure', 'label' => 'Not sure yet / multiple services');

  return array(
    'services'    => $services,
    'projectType' => array('Front yard', 'Backyard', 'Front & backyard', 'Other'),
    'timing'      => array('As soon as possible', 'Within 1–3 months', 'In 3–6 months', 'Just exploring ideas'),
  );
}

/* ---------- Stored requests (wp-admin) ---------- */

function silvercrest_register_requests() {
  register_post_type('consultation_req', array(
    'labels' => array(
      'name'          => 'Consultation Requests',
      'singular_name' => 'Consultation Request',
      'all_items'     => 'All Requests',
      'edit_item'     => 'View Request',
    ),
    'public'          => false,
    'show_ui'         => true,
    'show_in_menu'    => true,
    'menu_icon'       => 'dashicons-email-alt',
    'menu_position'   => 21,
    'supports'        => array('title', 'editor'),
    'capability_type' => 'post',
    'capabilities'    => array('create_posts' => 'do_not_allow'),
    'map_meta_cap'    => true,
  ));
}

add_action('init', 'silvercrest_register_requests');

function silvercrest_request_columns($columns) {
  return array(
    'cb'      => $columns['cb'],
    'title'   => 'Name',
    'service' => 'Service',
    'phone'   => 'Phone',
    'zip'     => 'Location / ZIP',
    'date'    => 'Received',
  );
}

add_filter('manage_consultation_req_posts_columns', 'silvercrest_request_columns');

function silvercrest_request_column_values($column, $post_id) {
  $keys = array('service' => '_req_service_label', 'phone' => '_req_phone', 'zip' => '_req_location');
  if (isset($keys[$column])) {
    echo esc_html(get_post_meta($post_id, $keys[$column], true));
  }
}

add_action('manage_consultation_req_posts_custom_column', 'silvercrest_request_column_values', 10, 2);

/* ---------- REST endpoint ---------- */

function silvercrest_register_form_route() {
  register_rest_route('silvercrest/v1', '/consultation', array(
    'methods'             => 'POST',
    'callback'            => 'silvercrest_handle_consultation',
    'permission_callback' => '__return_true',
  ));
}

add_action('rest_api_init', 'silvercrest_register_form_route');

function silvercrest_emailjs_enabled() {
  return defined('SILVERCREST_EMAILJS_PUBLIC_KEY') && SILVERCREST_EMAILJS_PUBLIC_KEY
    && defined('SILVERCREST_EMAILJS_SERVICE_ID') && SILVERCREST_EMAILJS_SERVICE_ID
    && defined('SILVERCREST_EMAILJS_TEMPLATE_ID') && SILVERCREST_EMAILJS_TEMPLATE_ID;
}

/**
 * reCAPTCHA v3: true when the token checks out, or when no secret is configured (not enforced yet).
 */
function silvercrest_verify_recaptcha($token) {
  if (!defined('SILVERCREST_RECAPTCHA_SECRET') || !SILVERCREST_RECAPTCHA_SECRET) {
    return true;
  }
  if (!$token) {
    return false;
  }
  $response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', array(
    'timeout' => 8,
    'body'    => array(
      'secret'   => SILVERCREST_RECAPTCHA_SECRET,
      'response' => $token,
      'remoteip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '',
    ),
  ));
  if (is_wp_error($response)) {
    return true; // Google unreachable: don't lose a real lead over it; the other checks still apply.
  }
  $result = json_decode(wp_remote_retrieve_body($response), true);
  return !empty($result['success'])
    && (!isset($result['action']) || $result['action'] === 'consultation')
    && (isset($result['score']) ? (float) $result['score'] >= 0.5 : true);
}

/** Signed token that lets the browser ask for the wp_mail fallback for one stored request. */
function silvercrest_notify_token($post_id) {
  return wp_hash('silvercrest-notify-' . (int) $post_id);
}

function silvercrest_send_notification($post_id) {
  $post = get_post($post_id);
  if (!$post || $post->post_type !== 'consultation_req') {
    return false;
  }
  $name  = $post->post_title;
  $email = get_post_meta($post_id, '_req_email', true);
  $label = get_post_meta($post_id, '_req_service_label', true);
  return wp_mail(
    silvercrest_form_recipient(),
    "New consultation request: {$name} ({$label})",
    $post->post_content,
    array('Reply-To: ' . $name . ' <' . $email . '>')
  );
}

function silvercrest_register_notify_route() {
  register_rest_route('silvercrest/v1', '/consultation/notify', array(
    'methods'             => 'POST',
    'callback'            => 'silvercrest_handle_notify',
    'permission_callback' => '__return_true',
  ));
}

add_action('rest_api_init', 'silvercrest_register_notify_route');

// EmailJS failed in the browser → send the notification with wp_mail (once per request).
function silvercrest_handle_notify(WP_REST_Request $request) {
  $p     = $request->get_json_params();
  $id    = isset($p['id']) ? (int) $p['id'] : 0;
  $token = isset($p['token']) && is_string($p['token']) ? $p['token'] : '';
  if (!$id || !hash_equals(silvercrest_notify_token($id), $token)) {
    return new WP_REST_Response(array('ok' => false), 403);
  }
  if (!get_post_meta($id, '_req_notified', true)) {
    update_post_meta($id, '_req_notified', 'wp_mail');
    silvercrest_send_notification($id);
  }
  return new WP_REST_Response(array('ok' => true), 200);
}

function silvercrest_handle_consultation(WP_REST_Request $request) {
  $p = $request->get_json_params();
  if (!is_array($p)) {
    $p = array();
  }

  $field = function ($key) use ($p) {
    return isset($p[$key]) && is_scalar($p[$key]) ? trim((string) $p[$key]) : '';
  };

  // Anti-spam: honeypot filled or form submitted too fast → pretend success, store nothing.
  $elapsed = (int) $field('elapsed');
  if ($field('company_website') !== '' || $elapsed < 3000) {
    return new WP_REST_Response(array('ok' => true), 200);
  }

  if (!silvercrest_verify_recaptcha($field('recaptcha'))) {
    return new WP_REST_Response(array('ok' => false, 'message' => 'We couldn’t verify your request. Please try again or call us.'), 403);
  }

  // Rate limit: 5 requests per IP per 10 minutes.
  $ip_key = 'sc_form_' . md5(isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown');
  $count  = (int) get_transient($ip_key);
  if ($count >= 5) {
    return new WP_REST_Response(array('ok' => false, 'message' => 'Too many requests. Please call us or try again in a few minutes.'), 429);
  }

  $data = array(
    'name'        => sanitize_text_field($field('name')),
    'phone'       => sanitize_text_field($field('phone')),
    'email'       => sanitize_email($field('email')),
    'location'    => sanitize_text_field($field('location')),
    'service'     => sanitize_key($field('service')),
    'projectType' => sanitize_text_field($field('projectType')),
    'timing'      => sanitize_text_field($field('timing')),
    'notes'       => sanitize_textarea_field($field('notes')),
    'consent'     => !empty($p['consent']),
    'source'      => esc_url_raw($field('source')),
  );

  $options        = silvercrest_form_options();
  $service_labels = wp_list_pluck($options['services'], 'label', 'value');

  // Validation (mirrors the client-side rules).
  $errors = array();
  if (mb_strlen($data['name']) < 2)                              $errors['name'] = 'Please enter your name.';
  if (strlen(preg_replace('/\D/', '', $data['phone'])) < 10)    $errors['phone'] = 'Please enter a valid phone number.';
  if (!is_email($data['email']))                                 $errors['email'] = 'Please enter a valid email address.';
  if (mb_strlen($data['location']) < 3)                          $errors['location'] = 'Please enter your city or ZIP code.';
  if (!isset($service_labels[$data['service']]))                 $errors['service'] = 'Please choose a service.';
  if (!$data['consent'])                                         $errors['consent'] = 'Please confirm we can contact you.';
  if ($data['projectType'] && !in_array($data['projectType'], $options['projectType'], true)) $data['projectType'] = '';
  if ($data['timing'] && !in_array($data['timing'], $options['timing'], true))                $data['timing'] = '';
  if (mb_strlen($data['notes']) > 3000)                          $data['notes'] = mb_substr($data['notes'], 0, 3000);

  if ($errors) {
    return new WP_REST_Response(array('ok' => false, 'errors' => $errors), 422);
  }

  set_transient($ip_key, $count + 1, 10 * MINUTE_IN_SECONDS);

  $service_label = $service_labels[$data['service']];
  $summary = implode("\n", array_filter(array(
    "Name: {$data['name']}",
    "Phone: {$data['phone']}",
    "Email: {$data['email']}",
    "Project location / ZIP: {$data['location']}",
    "Service: {$service_label}",
    $data['projectType'] ? "Project area: {$data['projectType']}" : null,
    $data['timing'] ? "Desired timing: {$data['timing']}" : null,
    '',
    'Project notes:',
    $data['notes'] ? $data['notes'] : '(none)',
    '',
    'Consent to be contacted: yes',
    $data['source'] ? "Submitted from: {$data['source']}" : null,
  ), function ($line) { return $line !== null; }));

  // 1) Store
  $post_id = wp_insert_post(array(
    'post_type'    => 'consultation_req',
    'post_status'  => 'private',
    'post_title'   => $data['name'],
    'post_content' => $summary,
  ));

  if ($post_id && !is_wp_error($post_id)) {
    foreach (array('phone', 'email', 'location', 'service', 'projectType', 'timing', 'source') as $key) {
      update_post_meta($post_id, "_req_{$key}", $data[$key]);
    }
    update_post_meta($post_id, '_req_service_label', $service_label);
  }

  if (!$post_id || is_wp_error($post_id)) {
    // Couldn't store it: email it right away so the lead isn't lost.
    wp_mail(silvercrest_form_recipient(), "New consultation request: {$data['name']} ({$service_label})", $summary,
      array('Reply-To: ' . $data['name'] . ' <' . $data['email'] . '>'));
    return new WP_REST_Response(array('ok' => true, 'emailjs' => false), 200);
  }

  // 2) Notify: EmailJS (browser) when configured, else wp_mail now.
  if (silvercrest_emailjs_enabled()) {
    return new WP_REST_Response(array(
      'ok'      => true,
      'emailjs' => true,
      'id'      => $post_id,
      'token'   => silvercrest_notify_token($post_id),
      'service' => $service_label,
    ), 200);
  }

  update_post_meta($post_id, '_req_notified', 'wp_mail');
  silvercrest_send_notification($post_id);
  return new WP_REST_Response(array('ok' => true, 'emailjs' => false), 200);
}
