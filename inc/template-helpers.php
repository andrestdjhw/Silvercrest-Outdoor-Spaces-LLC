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
 */
function silvercrest_image($slug, $alt, $class = '', $priority = false) {
  foreach (array('webp', 'avif', 'jpg', 'jpeg', 'png') as $ext) {
    $relative = "/assets/images/{$slug}.{$ext}";
    if (file_exists(get_theme_file_path($relative))) {
      printf(
        '<img src="%1$s" alt="%2$s" class="%3$s" %4$s decoding="async">',
        esc_url(get_theme_file_uri($relative)),
        esc_attr($alt),
        esc_attr($class),
        $priority ? 'fetchpriority="high"' : 'loading="lazy"'
      );
      return;
    }
  }

  printf(
    '<div class="img-placeholder %1$s" role="img" aria-label="%2$s"><span>Photo pending: %3$s</span></div>',
    esc_attr($class),
    esc_attr($alt),
    esc_html($slug)
  );
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
 * Centered section title flanked by thin bronze rules (as in the mockup).
 */
function silvercrest_section_heading($text) {
  ?>
  <div class="flex items-center gap-4 sm:gap-8">
    <span class="h-px flex-1 bg-bronze/50" aria-hidden="true"></span>
    <h2 class="text-center font-serif text-3xl font-semibold leading-tight text-graphite sm:text-4xl"><?php echo esc_html($text); ?></h2>
    <span class="h-px flex-1 bg-bronze/50" aria-hidden="true"></span>
  </div>
  <?php
}
