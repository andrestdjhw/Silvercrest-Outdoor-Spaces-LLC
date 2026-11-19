<?php
/**
 * Inner-page hero: photo background, breadcrumbs, H1, intro, CTA.
 *
 * $args:
 *   title        (string)  H1
 *   intro        (string)
 *   image        (string)  image slug for silvercrest_image()
 *   alt          (string)
 *   breadcrumbs  (array)   [[label, path], ...] — current page last, Home added automatically
 *   cta          (bool)    show "Request a Consultation" (default true)
 */
$args = wp_parse_args($args, array(
  'title'       => get_the_title(),
  'intro'       => '',
  'image'       => '',
  'alt'         => '',
  'breadcrumbs' => array(),
  'cta'         => true,
));

$crumbs = array_merge(array(array('Home', '/')), $args['breadcrumbs']);

// BreadcrumbList schema (brief, section 10).
$schema_items = array();
foreach ($crumbs as $i => $crumb) {
  $schema_items[] = array(
    '@type'    => 'ListItem',
    'position' => $i + 1,
    'name'     => $crumb[0],
    'item'     => home_url($crumb[1]),
  );
}
?>
<section class="relative isolate overflow-hidden bg-ink">
  <?php if ($args['image']) : ?>
    <?php silvercrest_image($args['image'], $args['alt'], 'hero-zoom absolute inset-0 -z-10 h-full w-full object-cover', true); ?>
  <?php endif; ?>
  <div class="absolute inset-0 -z-10 bg-linear-to-t from-ink/90 via-rust-dark/60 to-ink/35 sm:bg-linear-to-r sm:from-ink/90 sm:via-rust-dark/50 sm:to-ink/5" aria-hidden="true"></div>

  <div class="container-site flex min-h-[22rem] items-end pb-14 pt-20 lg:min-h-[28rem] lg:pb-16">
    <div class="max-w-3xl">
      <nav aria-label="Breadcrumb" data-reveal>
        <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs font-medium font-wide uppercase tracking-wide text-cream/70">
          <?php foreach ($crumbs as $i => $crumb) : $is_last = $i === count($crumbs) - 1; ?>
            <li class="flex items-center gap-2">
              <?php if ($is_last) : ?>
                <span aria-current="page" class="text-peach"><?php echo esc_html($crumb[0]); ?></span>
              <?php else : ?>
                <a href="<?php echo silvercrest_url($crumb[1]); ?>" class="transition-colors hover:text-cream"><?php echo esc_html($crumb[0]); ?></a>
                <span aria-hidden="true">/</span>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ol>
      </nav>

      <h1 class="mt-5 font-display text-4xl font-semibold leading-[1.05] text-cream sm:text-5xl lg:text-[3.5rem]">
        <?php echo esc_html($args['title']); ?>
      </h1>

      <?php if ($args['intro']) : ?>
        <p data-reveal class="mt-5 max-w-2xl text-base leading-relaxed text-cream/90 sm:text-lg"><?php echo esc_html($args['intro']); ?></p>
      <?php endif; ?>

      <?php if ($args['cta']) : ?>
        <div class="mt-8" data-reveal><?php silvercrest_cta_button('Request a Consultation', 'btn-primary border border-cream/60'); ?></div>
      <?php endif; ?>
    </div>
  </div>
</section>

<script type="application/ld+json"><?php echo wp_json_encode(array('@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $schema_items)); ?></script>
