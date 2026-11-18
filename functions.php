<?php

define('SILVERCREST_PHONE', '+1 (702) 812-0784');
define('SILVERCREST_PHONE_HREF', 'tel:+17028120784');
define('SILVERCREST_LOCATION', 'Las Vegas & Henderson, NV');

// TODO: corporate email not purchased yet (questionnaire) — placeholder until confirmed.
define('SILVERCREST_EMAIL', 'info@silvercrestoutdoorspaces.com');

// Social profiles. Empty URLs are hidden in the topbar.
// TODO: Instagram is still under the old name (@mendoza.lawnservices) — validate/rename before launch (brief, section 01).
// TODO: Facebook, TikTok, YouTube and Google are DEMO links (platform home pages) — replace or empty before launch.
function silvercrest_socials() {
  return array(
    'facebook'  => 'https://www.facebook.com/',
    'instagram' => 'https://www.instagram.com/mendoza.lawnservices/',
    'tiktok'    => 'https://www.tiktok.com/',
    'youtube'   => 'https://www.youtube.com/',
    'google'    => 'https://www.google.com/business/', // Google Business Profile
  );
}

// TEMPORARY: Unsplash stock photos fill image slots until real project photos arrive.
// Set to false (and delete assets/images/_stock/) before launch — the brief requires real projects only.
define('SILVERCREST_STOCK_IMAGES', true);

require get_theme_file_path('/inc/template-helpers.php');
require get_theme_file_path('/inc/stock-images.php');
require get_theme_file_path('/inc/content.php');
require get_theme_file_path('/inc/projects.php');
require get_theme_file_path('/inc/routing.php');
require get_theme_file_path('/inc/contact-form.php');

function silvercrest_load_assets() {
  $asset = include get_theme_file_path('/build/index.asset.php');

  // Archivo with its width axis (condensed headings / extended labels). Swap if Ana delivers the official brand font.
  wp_enqueue_style('silvercrest-fonts', 'https://fonts.googleapis.com/css2?family=Archivo:wdth,wght@62..125,300..800&display=swap', array(), null);
  wp_enqueue_style('silvercrest-main', get_theme_file_uri('/build/index.css'), array('silvercrest-fonts'), filemtime(get_theme_file_path('/build/index.css')));

  wp_enqueue_script('silvercrest-main', get_theme_file_uri('/build/index.js'), $asset['dependencies'], $asset['version'], true);
  wp_localize_script('silvercrest-main', 'silvercrestData', array(
    'homeUrl'   => home_url('/'),
    'phone'     => SILVERCREST_PHONE,
    'phoneHref' => SILVERCREST_PHONE_HREF,
    'email'     => SILVERCREST_EMAIL,
    'location'  => SILVERCREST_LOCATION,
    'socials'   => array_filter(silvercrest_socials()),
    'form'      => array(
      'endpoint'   => rest_url('silvercrest/v1/consultation'),
      'privacyUrl' => get_privacy_policy_url(),
      'options'    => silvercrest_form_options(),
    ),
  ));
}

add_action('wp_enqueue_scripts', 'silvercrest_load_assets');

function silvercrest_resource_hints($urls, $relation_type) {
  if ($relation_type === 'preconnect') {
    $urls[] = 'https://fonts.googleapis.com';
    $urls[] = array('href' => 'https://fonts.gstatic.com', 'crossorigin');
  }
  return $urls;
}

add_filter('wp_resource_hints', 'silvercrest_resource_hints', 10, 2);

function silvercrest_add_support() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script'));
}

add_action('after_setup_theme', 'silvercrest_add_support');
