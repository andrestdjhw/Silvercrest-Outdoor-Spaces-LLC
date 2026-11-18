<?php
/**
 * Small helpers shared by the page templates.
 */

/**
 * Escaped URL for an internal page path, e.g. silvercrest_url('/contact/').
 */
function silvercrest_url($path = '/') {
  return esc_url(home_url($path));
}

/**
 * Prints an image from /assets/images/{slug}.{webp|avif|jpg|jpeg|png}.
 * Until the file exists it prints a labeled placeholder of the same size,
 * so real project photos can be dropped in without touching the templates.
 * The brief requires real Silvercrest projects only: no stock, no competitors' work.
 *
 * $reveal = true wraps the image in a box (that takes $class) which opens like a
 * curtain on scroll, while the photo inside eases from a slight zoom (src/scripts/motion.js).
 */
function silvercrest_image($slug, $alt, $class = '', $priority = false, $reveal = false) {
  $found = null;
  foreach (array('webp', 'avif', 'jpg', 'jpeg', 'png') as $ext) {
    if (file_exists(get_theme_file_path("/assets/images/{$slug}.{$ext}"))) {
      $found = "/assets/images/{$slug}.{$ext}";
      break;
    }
  }

  // Temporary stock fallback (inc/stock-images.php) — remove before launch.
  $is_stock = false;
  if (!$found) {
    $found    = silvercrest_stock_image($slug);
    $is_stock = (bool) $found;
  }

  if ($reveal) {
    printf('<div class="%s overflow-hidden" data-reveal="clip">', esc_attr($class));
    $class = 'h-full w-full object-cover';
  }

  if ($found) {
    printf(
      '<img src="%1$s" alt="%2$s" class="%3$s" %4$s decoding="async"%5$s%6$s>',
      esc_url(get_theme_file_uri($found)),
      esc_attr($alt),
      esc_attr($class),
      $priority ? 'fetchpriority="high"' : 'loading="lazy"',
      $is_stock ? ' data-stock-photo="' . esc_attr($slug) . '"' : '',
      $reveal ? ' data-scroll-zoom' : ''
    );
  } else {
    printf(
      '<div class="img-placeholder %1$s" role="img" aria-label="%2$s"><span>Photo pending: %3$s</span></div>',
      esc_attr($class),
      esc_attr($alt),
      esc_html($slug)
    );
  }

  if ($reveal) {
    echo '</div>';
  }
}

/**
 * Prints an inline line icon (24×24, stroke = currentColor).
 */
function silvercrest_icon($name, $class = 'h-5 w-5') {
  $icons = array(
    'arrow-right'   => '<path d="M5 12h14M13 6l6 6-6 6"/>',
    'chevron-right' => '<path d="M9 6l6 6-6 6"/>',
    'design'        => '<path d="M3 21V3l18 18H3z"/><path d="M7 17v-5l5 5H7z"/><path d="M3 7h2M3 11h2M3 15h2"/>',
    'cactus'        => '<path d="M10 21V5a2 2 0 0 1 4 0v16"/><path d="M14 13h2a2 2 0 0 0 2-2V8"/><path d="M10 15H8a2 2 0 0 1-2-2v-3"/><path d="M6 21h12"/>',
    'pavers'        => '<path d="M12 3l9 4.5-9 4.5-9-4.5L12 3z"/><path d="M7.5 5.25l9 4.5M16.5 5.25l-9 4.5"/><path d="M3 12l9 4.5 9-4.5"/><path d="M3 16.5L12 21l9-4.5"/>',
    'turf'          => '<path d="M5 20c0-5 1-9 3-12M9.5 20c0-4-1.5-8-4.5-10M12 20V7M14.5 20c0-4 1.5-8 4.5-10M19 20c0-5-1-9-3-12"/><path d="M3 20h18"/>',
    'droplet'       => '<path d="M12 3s6 6.5 6 11a6 6 0 0 1-12 0c0-4.5 6-11 6-11z"/><path d="M9.5 15.5a2.5 2.5 0 0 0 2.5 2"/>',
    'layers'        => '<path d="M12 3l9 5-9 5-9-5 9-5z"/><path d="M3 13l9 5 9-5"/><path d="M3 17.5l9 5 9-5" opacity=".6"/>',
    'lamp'          => '<path d="M9 3h6l1 4H8l1-4z"/><path d="M12 7v13"/><path d="M8 21h8"/><path d="M6 10.5l-1.5 1M18 10.5l1.5 1M12 9.5v0"/>',
    'palm'          => '<path d="M12 21c0-5 .5-9 1-12"/><path d="M13 9c-2-3-5.5-3.5-8-2 2.5.3 4.5 1 6 2.5"/><path d="M13 9c2-3 5.5-3.5 8-2-2.5.3-4.5 1-6 2.5"/><path d="M13 9c-.5-3 1-5 3.5-6-1 1.5-1.5 3.5-1.5 5.5"/><path d="M8 21h8"/>',
    'calendar'      => '<rect x="3.5" y="5" width="17" height="15.5" rx="2"/><path d="M3.5 10h17M8 3v4M16 3v4"/><path d="M8 14h3M8 17h6"/>',
    'phone'         => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
    'mail'          => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
    'map-pin'       => '<path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>',
    'plus'          => '<path d="M12 5v14M5 12h14"/>',
  );

  if (!isset($icons[$name])) {
    return;
  }

  printf(
    '<svg class="%1$s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%2$s</svg>',
    esc_attr($class),
    $icons[$name]
  );
}

/**
 * Centered section title flanked by thin copper rules (as in the mockup).
 */
function silvercrest_section_heading($text) {
  ?>
  <div class="flex items-center gap-4 sm:gap-8">
    <span class="h-px flex-1 bg-copper/50" aria-hidden="true" data-reveal="line-l"></span>
    <h2 class="text-center font-display text-3xl font-semibold leading-tight text-ink sm:text-4xl"><?php echo esc_html($text); ?></h2>
    <span class="h-px flex-1 bg-copper/50" aria-hidden="true" data-reveal="line-r"></span>
  </div>
  <?php
}

/**
 * Left-aligned section title with the short copper rule above it.
 */
function silvercrest_section_title($text, $class = '') {
  ?>
  <span class="block h-px w-14 bg-copper" aria-hidden="true" data-reveal="line-r"></span>
  <h2 class="mt-6 font-display text-3xl font-semibold leading-tight text-ink sm:text-4xl <?php echo esc_attr($class); ?>"><?php echo esc_html($text); ?></h2>
  <?php
}

/**
 * Card label for a service (short version where one exists).
 */
function silvercrest_service_label($slug) {
  $services = silvercrest_services();
  if (!isset($services[$slug])) {
    return '';
  }
  return isset($services[$slug]['short']) ? $services[$slug]['short'] : $services[$slug]['label'];
}

/**
 * "Request a Consultation" button — the site-wide primary CTA.
 */
function silvercrest_cta_button($label = 'Request a Consultation', $class = 'btn-primary') {
  printf('<a href="%1$s" class="btn %2$s">%3$s ', silvercrest_url('/contact/'), esc_attr($class), esc_html($label));
  silvercrest_icon('arrow-right', 'h-4 w-4');
  echo '</a>';
}
