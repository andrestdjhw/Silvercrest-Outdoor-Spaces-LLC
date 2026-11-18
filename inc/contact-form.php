<?php
/**
 * Consultation request form backend (React form: src/components/ContactForm.js).
 *
 * POST /wp-json/silvercrest/v1/consultation
 * - Validates fields from the brief (section 09).
 * - Saves every request as a private "Consultation Request" in wp-admin (nothing is lost if email fails).
 * - Emails the notification recipient with Reply-To set to the customer.
 * - Anti-spam: honeypot + minimum fill time + per-IP rate limit. Add reCAPTCHA/Turnstile before launch if spam appears.
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

  // 2) Notify
  wp_mail(
    silvercrest_form_recipient(),
    "New consultation request: {$data['name']} ({$service_label})",
    $summary,
    array('Reply-To: ' . $data['name'] . ' <' . $data['email'] . '>')
  );

  return new WP_REST_Response(array('ok' => true), 200);
}
