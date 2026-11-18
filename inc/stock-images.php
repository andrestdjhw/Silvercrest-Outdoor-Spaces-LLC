<?php
/**
 * TEMPORARY stock photos (Unsplash License) used while real project photos are pending.
 *
 * The brief requires REAL Silvercrest projects at launch — no stock. Before launch:
 *   1. set SILVERCREST_STOCK_IMAGES to false in functions.php, and
 *   2. delete assets/images/_stock/ (sources listed in assets/images/_stock/CREDITS.md).
 *
 * A real photo at assets/images/{slug}.{ext} always wins over the stock one,
 * so photos can be replaced one by one.
 */

function silvercrest_stock_map() {
  $map = array(
    // Home
    'home/hero'      => 'patio-firepit',
    'home/detail'    => 'paved-walkway',
    'home/xeriscape' => 'barrel-cactus-gravel',
    'home/project-1' => 'desert-home-driveway',
    'home/project-2' => 'pergola-dining',
    'home/project-3' => 'night-garden-lights',

    // Hubs & single pages
    'services/services-hero'           => 'desert-home-modern',
    'projects/projects-hero'           => 'pergola-dining',
    'about/about-hero'                 => 'crew-wheelbarrow',
    'about/team'                       => 'crew-shovel',
    'process/process-hero'             => 'desert-home-modern',
    'process/step-1'                   => 'desert-home-driveway',
    'process/step-2'                   => 'cactus-garden-path',
    'process/step-3'                   => 'crew-wheelbarrow',
    'process/step-4'                   => 'patio-firepit',
    'contact/contact-hero'             => 'patio-sunset',
    'hoa/hoa-hero'                     => 'palms-neighborhood',
    'hoa/hoa-overview'                 => 'gravel-garden',
    'locations/service-areas-hero'     => 'desert-mountains',
    'locations/las-vegas-landscaping-hero'     => 'desert-mountains',
    'locations/las-vegas-landscaping-overview' => 'desert-home-driveway',
    'locations/henderson-landscaping-hero'     => 'desert-valley',
    'locations/henderson-landscaping-overview' => 'desert-home-spanish',
  );

  // Service pages: hero, overview, gallery 1–3
  $services = array(
    'landscape-design'       => array('cactus-garden-path', 'desert-home-spanish', 'gravel-garden', 'patio-sunset', 'paver-patio-circle'),
    'landscape-installation' => array('crew-wheelbarrow', 'crew-shovel', 'desert-home-driveway', 'pergola-dining', 'night-path-light'),
    'desert-landscaping'     => array('gravel-garden', 'barrel-cactus-gravel', 'cactus-garden-path', 'desert-home-modern', 'agave-detail'),
    'paver-installation'     => array('paver-patio-circle', 'paved-walkway', 'stone-texture', 'patio-firepit', 'covered-patio'),
    'artificial-turf'        => array('green-lawn', 'turf-install', 'pergola-dining', 'modern-home-hedges', 'patio-sunset'),
    'irrigation-systems'     => array('sprinklers-lawn', 'sprinkler-tree', 'gravel-garden', 'green-lawn', 'barrel-cactus-gravel'),
    'landscape-lighting'     => array('night-garden-lights', 'night-bollard', 'night-path-light', 'patio-sunset', 'brick-garden-path'),
    'tree-palm-services'     => array('palms-neighborhood', 'palm-trees', 'desert-home-driveway', 'desert-home-spanish', 'crew-wheelbarrow'),
    'landscape-maintenance'  => array('crew-shovel', 'crew-wheelbarrow', 'green-lawn', 'brick-garden-path', 'modern-home-hedges'),
  );

  foreach ($services as $slug => $files) {
    $map["services/{$slug}-hero"]     = $files[0];
    $map["services/{$slug}-overview"] = $files[1];
    $map["services/{$slug}-1"]        = $files[2];
    $map["services/{$slug}-2"]        = $files[3];
    $map["services/{$slug}-3"]        = $files[4];
  }

  return $map;
}

/**
 * Relative path of the stock photo for a slot, or null.
 */
function silvercrest_stock_image($slug) {
  if (!defined('SILVERCREST_STOCK_IMAGES') || !SILVERCREST_STOCK_IMAGES) {
    return null;
  }
  $map = silvercrest_stock_map();
  if (!isset($map[$slug])) {
    return null;
  }
  $relative = '/assets/images/_stock/' . $map[$slug] . '.jpg';
  return file_exists(get_theme_file_path($relative)) ? $relative : null;
}
