<?php

define('SILVERCREST_PHONE', '+1 (702) 812-0784');
define('SILVERCREST_PHONE_HREF', 'tel:+17028120784');
define('SILVERCREST_LOCATION', 'Las Vegas & Henderson, NV');

// Map on the home page (template-parts/service-map.php). Shows the service area, not an address
// (brand rule: don't publish the address). Once the Google Business Profile is renamed to
// Silvercrest, this can be its name ("Silvercrest Outdoor Spaces, Las Vegas") to show its pin.
define('SILVERCREST_MAP_QUERY', 'Las Vegas Valley, NV');

// TODO: corporate email not purchased yet (questionnaire) — placeholder until confirmed.
define('SILVERCREST_EMAIL', 'info@silvercrestoutdoorspaces.com');

// Contact form email delivery (EmailJS, sent from the browser) — src/components/ContactForm.js.
// These IDs and the public key are meant to be public. Each request is also stored in wp-admin
// (Consultation Requests) and, if EmailJS fails, emailed with wp_mail as a fallback.
define('SILVERCREST_EMAILJS_PUBLIC_KEY', 'SgxiMsDyVyIMrmEf-');
define('SILVERCREST_EMAILJS_SERVICE_ID', 'service_rwlujyg');
define('SILVERCREST_EMAILJS_TEMPLATE_ID', 'template_yjp4bn1');   // "Contact Us": notification to the business
define('SILVERCREST_EMAILJS_AUTOREPLY_ID', 'template_ovrn0v8');  // "Auto-Reply": confirmation to the customer

// Google reCAPTCHA v3 site key (public). The SECRET key never goes in the theme: add
//   define('SILVERCREST_RECAPTCHA_SECRET', '...');
// to wp-config.php. Without it, tokens are not verified (the other anti-spam checks still run).
define('SILVERCREST_RECAPTCHA_SITE_KEY', '6LcSUC8uAAAAAB3YxSkDc06GX34mc9H_uiZ-Rozx');

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

// TEMPORARY: the home reviews section shows SAMPLE reviews (marked "Sample" on screen) until real
// ones are collected. Before launch: add real reviews in silvercrest_reviews() (inc/content.php) with
// the client's permission and set this to false. Never publish the samples as real.
define('SILVERCREST_DEMO_REVIEWS', true);

// TEMPORARY: Unsplash stock photos fill image slots until real project photos arrive.
// Set to false (and delete assets/images/_stock/) before launch — the brief requires real projects only.
define('SILVERCREST_STOCK_IMAGES', true);

// Home hero background video: Media Library attachment ID (0 = photo only).
// The hero photo stays as the poster and as the fallback.
define('SILVERCREST_HERO_VIDEO_ID', 27);
// Lighter portrait cut for phones (< 640px): 720x900, ~1.3 MB vs 3.9 MB. 0 = use the full one everywhere.
define('SILVERCREST_HERO_VIDEO_MOBILE_ID', 28);
// Process section (template-parts/process-steps.php): real crew footage, web cut 540x960 ~3 MB. 0 = photo.
define('SILVERCREST_PROCESS_VIDEO_ID', 49);

require get_theme_file_path('/inc/template-helpers.php');
require get_theme_file_path('/inc/stock-images.php');
require get_theme_file_path('/inc/media-map.php');
require get_theme_file_path('/inc/content.php');
require get_theme_file_path('/inc/projects.php');
require get_theme_file_path('/inc/routing.php');
require get_theme_file_path('/inc/contact-form.php');

function silvercrest_load_assets() {
  $asset = include get_theme_file_path('/build/index.asset.php');

  // Fonts: Roboto + Roboto Condensed, self-hosted (@font-face in src/index.css, files in assets/fonts/web).
  wp_enqueue_style('silvercrest-main', get_theme_file_uri('/build/index.css'), array(), filemtime(get_theme_file_path('/build/index.css')));

  wp_enqueue_script('silvercrest-main', get_theme_file_uri('/build/index.js'), $asset['dependencies'], $asset['version'], true);
  wp_localize_script('silvercrest-main', 'silvercrestData', array(
    'homeUrl'   => home_url('/'),
    'brand'     => array(
      'imagotipoDark'   => silvercrest_brand_url('imagotipo-dark'),
      'imagotipoLight'  => silvercrest_brand_url('imagotipo-light'),
      'horizontalDark'  => silvercrest_brand_url('logotipo-horizontal-dark'),
      'verticalLight'   => silvercrest_brand_url('imagotipo-vertical-light'),
    ),
    'phone'     => SILVERCREST_PHONE,
    'phoneHref' => SILVERCREST_PHONE_HREF,
    'email'     => SILVERCREST_EMAIL,
    'location'  => SILVERCREST_LOCATION,
    'socials'   => array_filter(silvercrest_socials()),
    'services'  => silvercrest_menu_services(),
    'megaMenu'  => array(
      'image' => silvercrest_image_url('services/services-hero'),
    ),
    'form'      => array(
      'endpoint'   => rest_url('silvercrest/v1/consultation'),
      'notifyUrl'  => rest_url('silvercrest/v1/consultation/notify'),
      'recaptcha'  => SILVERCREST_RECAPTCHA_SITE_KEY,
      'emailjs'    => array(
        'publicKey'   => SILVERCREST_EMAILJS_PUBLIC_KEY,
        'serviceId'   => SILVERCREST_EMAILJS_SERVICE_ID,
        'templateId'  => SILVERCREST_EMAILJS_TEMPLATE_ID,
        'autoReplyId' => SILVERCREST_EMAILJS_AUTOREPLY_ID,
      ),
      'privacyUrl' => get_privacy_policy_url(),
      'options'    => silvercrest_form_options(),
    ),
  ));
}

add_action('wp_enqueue_scripts', 'silvercrest_load_assets');

// Preload the two faces every page shows above the fold (body text + headings), so text
// doesn't swap fonts after the first paint.
function silvercrest_preload_fonts() {
  foreach (array('roboto-regular', 'roboto-boldcondensed') as $font) {
    printf('<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url(get_theme_file_uri("/assets/fonts/web/{$font}.woff2")));
  }
}

add_action('wp_head', 'silvercrest_preload_fonts', 1);

function silvercrest_add_support() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script'));
}

add_action('after_setup_theme', 'silvercrest_add_support');

/**
 * Services for the navbar mega menu (React), from the same registry as the service pages.
 * Icon markup is the theme's own static SVG paths.
 */
function silvercrest_menu_services() {
  $items = array();
  foreach (silvercrest_services() as $slug => $service) {
    $items[] = array(
      'label' => $service['label'],
      'path'  => "/{$slug}/",
      'desc'  => $service['menu'],
      'group' => $service['group'],
      'icon'  => silvercrest_icon_paths($service['icon']),
    );
  }
  return $items;
}

/**
 * UpdraftPlus: leave this theme's node_modules (~600 MB of build tooling) out of backups.
 * It's rebuilt with `npm install`; the compiled site lives in /build.
 */
add_filter('updraftplus_exclude_directory', function ($exclude, $fullpath) {
  if ($exclude) {
    return $exclude;
  }
  return wp_normalize_path($fullpath) === wp_normalize_path(get_theme_file_path('/node_modules'));
}, 10, 2);

// Site icon (browser tab, bookmarks, phone home screen) from assets/icons/: the official SC
// monogram (Media Library "SC_Monograma", without the ™) in cream on Frenchman Rust. If a Site
// Icon is set in Appearance → Customize → Site Identity, WordPress prints that one instead.
function silvercrest_site_icons() {
  if (has_site_icon()) {
    return;
  }
  $dir = get_theme_file_uri('/assets/icons');
  $ver = filemtime(get_theme_file_path('/assets/icons/favicon-32.png'));
  printf('<link rel="icon" href="%s" sizes="48x48">' . "\n", esc_url("$dir/favicon.ico?v=$ver"));
  printf('<link rel="icon" href="%s" sizes="32x32" type="image/png">' . "\n", esc_url("$dir/favicon-32.png?v=$ver"));
  printf('<link rel="icon" href="%s" sizes="16x16" type="image/png">' . "\n", esc_url("$dir/favicon-16.png?v=$ver"));
  printf('<link rel="icon" href="%s" sizes="192x192" type="image/png">' . "\n", esc_url("$dir/icon-192.png?v=$ver"));
  printf('<link rel="apple-touch-icon" href="%s">' . "\n", esc_url("$dir/apple-touch-icon.png?v=$ver"));
  echo '<meta name="theme-color" content="#65290f">' . "\n";
}

add_action('wp_head', 'silvercrest_site_icons', 2);
add_action('admin_head', 'silvercrest_site_icons');
add_action('login_head', 'silvercrest_site_icons');

// Official logo and brand colors on the WordPress login screen. Printed in login_head (after
// WordPress's own login styles) so it wins without !important.
function silvercrest_login_logo() {
  $logo = esc_url(get_theme_file_uri('/assets/images/brand/imagotipo-dark.png'));
  echo "<style>
    body.login { background: #f2ece4; }
    body.login h1.wp-login-logo a { background: url('{$logo}') center / contain no-repeat; width: 240px; height: 126px; }
    body.login .button.button-primary { background: #65290f; border-color: #65290f; color: #fff; }
    body.login .button.button-primary:hover, body.login .button.button-primary:focus { background: #4a1d09; border-color: #4a1d09; }
    body.login input:focus { border-color: #65290f; box-shadow: 0 0 0 1px #65290f; }
    body.login .button-secondary, body.login .dashicons { color: #65290f; }
    body.login #backtoblog a, body.login #nav a { color: #8c5226; }
  </style>";
}

add_action('login_head', 'silvercrest_login_logo', 20);
add_filter('login_headerurl', function () { return home_url('/'); });
add_filter('login_headertext', function () { return 'Silvercrest Outdoor Spaces'; });
