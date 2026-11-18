<?php
/**
 * "Projects" portfolio (brief, section 07).
 * Each project: descriptive title, verifiable city, challenge, solution, 4–8 real photos
 * (featured image + images in the editor), project type for filtering.
 * Archive: /projects/ — single: /projects/{slug}/ — filter: /projects/type/{type}/
 */

function silvercrest_register_projects() {
  // Taxonomy first: its /projects/type/{term}/ rewrite rule must come before the
  // project CPT's /projects/{a}/{b}/ attachment rule, or filter URLs 404.
  register_taxonomy('project_type', 'project', array(
    'labels' => array(
      'name'          => 'Project Types',
      'singular_name' => 'Project Type',
    ),
    'public'            => true,
    'hierarchical'      => true,
    'show_in_rest'      => true,
    'show_admin_column' => true,
    'rewrite'           => array('slug' => 'projects/type', 'with_front' => false),
  ));

  register_post_type('project', array(
    'labels' => array(
      'name'          => 'Projects',
      'singular_name' => 'Project',
      'add_new_item'  => 'Add New Project',
      'edit_item'     => 'Edit Project',
      'all_items'     => 'All Projects',
    ),
    'public'       => true,
    'has_archive'  => 'projects',
    'rewrite'      => array('slug' => 'projects', 'with_front' => false),
    'menu_icon'    => 'dashicons-format-gallery',
    'menu_position' => 20,
    'show_in_rest' => true,
    'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
  ));
}

add_action('init', 'silvercrest_register_projects');

/**
 * Filter categories from the brief. Created once; editable in wp-admin.
 */
function silvercrest_project_type_terms() {
  return array(
    'landscape-design'  => 'Landscape Design',
    'desert-conversion' => 'Desert Conversion',
    'pavers'            => 'Pavers',
    'turf'              => 'Turf',
    'irrigation'        => 'Irrigation',
    'lighting'          => 'Lighting',
  );
}

function silvercrest_seed_project_types() {
  foreach (silvercrest_project_type_terms() as $slug => $name) {
    if (!term_exists($slug, 'project_type')) {
      wp_insert_term($name, 'project_type', array('slug' => $slug));
    }
  }
}

function silvercrest_activate_theme() {
  silvercrest_register_projects();
  silvercrest_seed_project_types();
  flush_rewrite_rules();
}

add_action('after_switch_theme', 'silvercrest_activate_theme');

/* ---------- Project details meta box: City, Challenge, Solution ---------- */

function silvercrest_project_fields() {
  return array(
    'city'      => array('label' => 'City (verifiable, e.g. Henderson)', 'type' => 'text'),
    'challenge' => array('label' => 'The challenge', 'type' => 'textarea'),
    'solution'  => array('label' => 'The solution', 'type' => 'textarea'),
  );
}

function silvercrest_project_meta_box() {
  add_meta_box('silvercrest_project_details', 'Project Details', 'silvercrest_render_project_meta_box', 'project', 'normal', 'high');
}

add_action('add_meta_boxes', 'silvercrest_project_meta_box');

function silvercrest_render_project_meta_box($post) {
  wp_nonce_field('silvercrest_project_details', 'silvercrest_project_nonce');
  echo '<p style="color:#646970">Use real Silvercrest projects only. Add 4–8 photos in the editor below (before/after pairs only if they are authentic).</p>';

  foreach (silvercrest_project_fields() as $key => $field) {
    $value = get_post_meta($post->ID, "_project_{$key}", true);
    printf('<p><label for="project_%1$s"><strong>%2$s</strong></label><br>', esc_attr($key), esc_html($field['label']));
    if ($field['type'] === 'textarea') {
      printf('<textarea id="project_%1$s" name="project_%1$s" rows="4" style="width:100%%">%2$s</textarea></p>', esc_attr($key), esc_textarea($value));
    } else {
      printf('<input type="text" id="project_%1$s" name="project_%1$s" value="%2$s" style="width:100%%"></p>', esc_attr($key), esc_attr($value));
    }
  }
}

function silvercrest_save_project_meta($post_id) {
  if (!isset($_POST['silvercrest_project_nonce']) || !wp_verify_nonce($_POST['silvercrest_project_nonce'], 'silvercrest_project_details')) {
    return;
  }
  if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !current_user_can('edit_post', $post_id)) {
    return;
  }

  foreach (silvercrest_project_fields() as $key => $field) {
    if (isset($_POST["project_{$key}"])) {
      $raw   = wp_unslash($_POST["project_{$key}"]);
      $value = $field['type'] === 'textarea' ? sanitize_textarea_field($raw) : sanitize_text_field($raw);
      update_post_meta($post_id, "_project_{$key}", $value);
    }
  }
}

add_action('save_post_project', 'silvercrest_save_project_meta');

/**
 * Projects whose City field matches, for the city landing pages.
 */
function silvercrest_projects_in_city($city, $limit = 3) {
  return get_posts(array(
    'post_type'      => 'project',
    'posts_per_page' => $limit,
    'meta_query'     => array(
      array('key' => '_project_city', 'value' => $city, 'compare' => 'LIKE'),
    ),
  ));
}
