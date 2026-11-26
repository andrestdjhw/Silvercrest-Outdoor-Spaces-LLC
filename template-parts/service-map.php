<?php
/**
 * Home: service-area map after the FAQs. Google Maps embed (no API key), lazy-loaded.
 * Centered on the service area, never on an address (brand rule). Query: SILVERCREST_MAP_QUERY.
 */
$locations = silvercrest_locations();
$map_src   = 'https://maps.google.com/maps?q=' . rawurlencode(SILVERCREST_MAP_QUERY) . '&z=10&hl=en&output=embed';
?>
<section class="relative isolate overflow-hidden py-16 lg:py-24">
  <!-- Strata behind the map side (brand pattern) -->
  <div class="strata-field strata-field-light absolute bottom-0 right-0 -z-10 h-1/2 w-full lg:h-full lg:w-1/2 lg:[--strata-fade:to_right]" aria-hidden="true"></div>
  <div class="container-site grid items-center gap-10 lg:grid-cols-12 lg:gap-16">

    <div class="lg:col-span-5">
      <?php silvercrest_annotation(array('Where we work', 'Southern Nevada'), 'mb-6 text-copper-dark'); ?>
      <?php silvercrest_section_title('Serving Las Vegas & Henderson', 'sm:text-5xl'); ?>
      <p data-reveal class="mt-6 max-w-md leading-relaxed text-ink/80">
        We design, build and care for outdoor spaces across the valley. Tell us where your project is and we’ll confirm availability for your area.
      </p>

      <ul class="mt-8 border-b border-ink/15">
        <?php foreach ($locations as $slug => $location) : ?>
          <li class="border-t border-ink/15" data-reveal>
            <a href="<?php echo silvercrest_url("/{$slug}/"); ?>" class="group flex items-center justify-between gap-4 py-4 transition-colors hover:text-rust">
              <span class="flex items-center gap-3 font-display text-2xl font-semibold text-ink group-hover:text-rust">
                <?php silvercrest_icon('map-pin', 'h-5 w-5 text-copper-dark'); ?><?php echo esc_html($location['city']); ?>
              </span>
              <?php silvercrest_icon('arrow-right', 'h-4 w-4 text-rust transition-transform group-hover:translate-x-1'); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>

      <div class="mt-8 flex flex-wrap gap-3" data-reveal>
        <?php silvercrest_cta_button(); ?>
        <a href="<?php echo silvercrest_url('/service-areas/'); ?>" class="btn btn-outline">Service Areas</a>
      </div>
    </div>

    <div class="lg:col-span-7" data-reveal="clip">
      <div class="relative aspect-[4/3] overflow-hidden rounded-md border border-ink/10 bg-sand shadow-xl shadow-ink/10 lg:aspect-[5/4]">
        <iframe src="<?php echo esc_url($map_src); ?>" title="Map of the Silvercrest Outdoor Spaces service area in Las Vegas and Henderson, Nevada"
                class="absolute inset-0 h-full w-full border-0 [filter:saturate(.75)_sepia(.12)]"
                loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
      </div>
    </div>

  </div>
</section>
