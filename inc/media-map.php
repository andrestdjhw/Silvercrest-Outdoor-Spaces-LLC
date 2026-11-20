<?php
/**
 * REAL project photos from the Media Library, by image slot.
 *
 * Rule: no portrait photos in full-width heroes (too soft when upscaled); finished work on the home; in-progress shots only where the page is about the work.
 * Priority for every slot: this map (Media Library) → assets/images/{slug}.{ext} → temporary stock.
 * Served with wp_get_attachment_image(), so each photo comes with srcset (WP's resized copies)
 * instead of the 2–3 MB original.
 *
 * 'alt' describes THIS photo: the template's alt was written for the stock photo it replaces.
 * Don't map a photo to a slot whose page would make a claim about it (e.g. a city page saying
 * "project in Henderson") unless that's where the job was.
 *
 * Media IDs (uploaded Nov 2026, "Mesa de trabajo N"):
 *   43 (2)  lit paver walkway to front gate, dusk     41 (17) travertine covered patio, stone columns
 *   46 (3)  curved paver walk, in progress            44 (18) travertine patio along the house
 *   34 (4)  pavers being laid, close-up               39 (19) brick paver entry walkway with planting
 *   33 (5)  finished curved paver drive, turf edges   45 (13) turf backyard with pool
 *   37 (6)  irrigation valve box                      42 (14) desert planting, stepping pads, skid steer
 *   38 (7)  front yard mid-install, finished entry    47 (12) crew truck and skid steer at a home
 *   48 (8)  lit paver walkway at night                35 (16) travertine dry-laid on the base
 *   36 (11) paver steps going in, night work          32 (9), 31 (10), 40 (15) not used yet
 * Videos: 30 = turf crew (original), 49 = its web cut (540x960, 3 MB); 29 = commercial turf removal.
 */
function silvercrest_media_map() {
  return array(
    // Home
    // 43 is already the first photo of the services preview right above, so this one differs.
    'home/detail'    => array(44, 'Shaded travertine patio along the back of the house'),
    // home/xeriscape stays on stock: its copy is about taking out the grass, and the turf + pool photo reads as a lawn.
    'home/project-1' => array(41, 'Travertine patio under a covered porch with stone columns'),
    'home/project-2' => array(33, 'Curved paver drive bordered by artificial turf'),
    'home/project-3' => array(48, 'Paver walkway with in-step lights at night'),

    // About & process
    'about/team'     => array(47, 'Silvercrest crew truck and skid steer at a client’s home'),
    'process/step-3' => array(35, 'Travertine pavers laid out on the prepared base before setting'),
    'process/step-4' => array(41, 'Finished travertine patio under a covered porch'),

    // Services: preview (only the home services list), overview, gallery 1–3.
    // No '-hero' entries on purpose: these are ~1300px-wide portrait phone photos, and a full-width
    // banner crops and upscales them until they look soft. Heroes stay on landscape photos
    // until wide, high-resolution project shots arrive.
    'services/landscape-design-preview'       => array(43, 'Paver walkway with in-step lights leading to a front gate at dusk'),
    'services/landscape-design-overview'   => array(44, 'Travertine patio along the house'),
    'services/landscape-design-1'          => array(41, 'Travertine patio under a covered porch'),
    'services/landscape-design-2'          => array(33, 'Curved paver drive bordered by artificial turf'),
    'services/landscape-design-3'          => array(45, 'Backyard with artificial turf and a pool'),

    'services/landscape-installation-preview'     => array(47, 'Silvercrest crew truck and skid steer at a client’s home'),
    'services/landscape-installation-overview' => array(38, 'Front yard installation in progress with new planting along the entry'),
    'services/landscape-installation-1'        => array(36, 'Paver steps being installed'),
    'services/landscape-installation-2'        => array(46, 'Curved paver walkway being laid'),
    'services/landscape-installation-3'        => array(42, 'Desert planting and stepping pads going in'),

    // Hero stays on stock: the wide crop of this portrait is mostly the skid steer.
    'services/desert-landscaping-1'        => array(42, 'Desert landscaping going in: decorative rock, boulders and stepping pads'),

    'services/paver-installation-preview'     => array(41, 'Travertine patio under a covered porch with stone columns'),
    'services/paver-installation-overview' => array(33, 'Curved paver drive bordered by artificial turf'),
    'services/paver-installation-1'        => array(34, 'Pavers being laid in a pattern, close-up'),
    'services/paver-installation-2'        => array(39, 'Brick paver entry walkway'),
    'services/paver-installation-3'        => array(44, 'Travertine patio along the house'),

    'services/artificial-turf-preview'        => array(45, 'Backyard with artificial turf and a pool'),

    'services/irrigation-systems-overview' => array(37, 'Irrigation valve box with drip valves'),

    'services/landscape-lighting-preview'     => array(48, 'Paver walkway with in-step lights at night'),

    'services/landscape-maintenance-overview' => array(47, 'Silvercrest crew truck at a client’s home'),

    // "How we work" photo on each service page (instead of the turf video); not shown elsewhere on that page.
    'services/landscape-design-process'       => array(43, 'Paver walkway with in-step lights leading to a front gate at dusk'),
    'services/landscape-installation-process' => array(47, 'Silvercrest crew and equipment on site for an installation'),
    'services/paver-installation-process'     => array(35, 'Travertine pavers dry-laid on the prepared base before setting'),
    'services/artificial-turf-process'        => array(45, 'Backyard with artificial turf around a new pool deck'),
    'services/landscape-lighting-process'     => array(48, 'Paver walkway with in-step lights at night'),
  );
}

/**
 * [attachment ID, alt] for a slot when it has a real photo in the Media Library, else null.
 */
function silvercrest_media_for($slug) {
  $map = silvercrest_media_map();
  if (empty($map[$slug])) {
    return null;
  }
  list($id, $alt) = $map[$slug];
  return wp_attachment_is_image($id) ? array((int) $id, $alt) : null;
}

/**
 * /projects/ "Our work" gallery, shown until full project posts (city, challenge, solution) exist.
 * Real photos only. No city or client claims in the captions; in-progress shots say so.
 * [attachment ID, caption, tag, in progress?]
 */
function silvercrest_work_gallery() {
  return array(
    array(41, 'Travertine patio under a covered porch', 'Pavers', false),
    array(45, 'Turf backyard around a new pool deck', 'Turf', false),
    array(43, 'Entry walk with in-step lights', 'Lighting', false),
    array(33, 'Curved paver drive with turf borders', 'Pavers', false),
    array(48, 'The same kind of walk, after dark', 'Lighting', false),
    array(44, 'Shaded travertine along the house', 'Pavers', false),
    array(39, 'Brick paver entry walk', 'Pavers', true),
    array(42, 'Rock, boulders and stepping pads', 'Desert Conversion', true),
    array(38, 'Front yard, planting along the entry', 'Landscape Design', true),
    array(34, 'Laying the pattern, one paver at a time', 'Pavers', true),
    array(46, 'A curved walk taking shape', 'Pavers', true),
    array(36, 'Paver steps, finishing after sunset', 'Pavers', true),
    array(35, 'Travertine dry-laid on the base', 'Pavers', true),
    array(31, 'Travertine on site, ready to set', 'Pavers', true),
    array(37, 'Drip valves in a new valve box', 'Irrigation', true),
    array(47, 'Crew and equipment on site', 'Our Crew', true),
  );
}
