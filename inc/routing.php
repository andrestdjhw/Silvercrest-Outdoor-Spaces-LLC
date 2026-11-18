<?php
/**
 * Template routing and per-page SEO.
 */

function silvercrest_current_slug() {
  $object = get_queried_object();
  return ($object instanceof WP_Post) ? $object->post_name : '';
}

/**
 * Service and city pages share one template each, driven by inc/content.php.
 * Other pages use the normal hierarchy (page-{slug}.php, page.php).
 */
function silvercrest_template_include($template) {
  if (!is_page() || is_front_page()) {
    return $template;
  }

  $slug = silvercrest_current_slug();
  $map  = array(
    'page-templates/service.php'  => silvercrest_services(),
    'page-templates/location.php' => silvercrest_locations(),
  );

  foreach ($map as $file => $registry) {
    if (isset($registry[$slug])) {
      $located = locate_template($file);
      if ($located) {
        return $located;
      }
    }
  }

  return $template;
}

add_filter('template_include', 'silvercrest_template_include');

/**
 * [title, description] for the current request, or null to keep WordPress defaults.
 */
function silvercrest_seo_for_request() {
  if (is_front_page()) {
    return array(
      'Landscape Design & Installation | Silvercrest Outdoor Spaces',
      'Landscape design, installation, pavers, turf and outdoor improvements in Las Vegas and Henderson. Explore projects and request a consultation.',
    );
  }

  if (is_page()) {
    $slug      = silvercrest_current_slug();
    $services  = silvercrest_services();
    $locations = silvercrest_locations();
    $pages     = silvercrest_page_seo();

    if (isset($services[$slug])) {
      return array($services[$slug]['seo_title'], $services[$slug]['seo_desc']);
    }
    if (isset($locations[$slug])) {
      return array($locations[$slug]['seo_title'], $locations[$slug]['seo_desc']);
    }
    if (isset($pages[$slug])) {
      return $pages[$slug];
    }
  }

  if (is_post_type_archive('project')) {
    return array(
      'Recent Landscape Projects | Silvercrest Outdoor Spaces',
      'Explore recent landscape design and installation projects in Las Vegas and Henderson by Silvercrest Outdoor Spaces.',
    );
  }

  if (is_tax('project_type')) {
    $term = get_queried_object();
    return array(
      $term->name . ' Projects | Silvercrest Outdoor Spaces',
      'Recent ' . strtolower($term->name) . ' projects in Las Vegas and Henderson by Silvercrest Outdoor Spaces.',
    );
  }

  if (is_singular('project')) {
    $city = get_post_meta(get_the_ID(), '_project_city', true);
    return array(
      get_the_title() . ($city ? " in {$city}" : '') . ' | Silvercrest Outdoor Spaces',
      has_excerpt() ? get_the_excerpt() : 'A landscape project by Silvercrest Outdoor Spaces' . ($city ? " in {$city}, NV." : '.'),
    );
  }

  return null;
}

function silvercrest_document_title($title) {
  $seo = silvercrest_seo_for_request();
  // pre_get_document_title output is printed as-is, so escape it here.
  return $seo ? esc_html($seo[0]) : $title;
}

add_filter('pre_get_document_title', 'silvercrest_document_title');

function silvercrest_meta_description() {
  $seo = silvercrest_seo_for_request();
  if ($seo && !empty($seo[1])) {
    echo '<meta name="description" content="' . esc_attr($seo[1]) . '">' . "\n";
  }
}

add_action('wp_head', 'silvercrest_meta_description', 1);
