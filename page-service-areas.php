<?php
/**
 * Service Areas — /service-areas/
 * Confirmed coverage: Las Vegas and Henderson only. Priority zones from the industry report
 * (Anthem, Summerlin, Inspirada, etc.) are NOT confirmed coverage — don't list them until validated.
 */

$locations = silvercrest_locations();

get_header(); ?>

<main id="main">

  <?php get_template_part('template-parts/page-hero', null, array(
    'title'       => 'Landscape Design & Installation Across Las Vegas and Henderson',
    'intro'       => 'Based in Las Vegas, Silvercrest Outdoor Spaces works with homeowners throughout Las Vegas and Henderson to design and build outdoor spaces suited to the Southern Nevada desert.',
    'image'       => 'locations/service-areas-hero',
    'alt'         => 'Desert landscape with the Las Vegas valley mountains',
    'breadcrumbs' => array(array('Service Areas', '/service-areas/')),
  )); ?>

  <section class="py-16 lg:py-24">
    <div class="container-site">
      <?php silvercrest_section_heading('Where We Work'); ?>

      <ul class="mx-auto mt-12 grid max-w-5xl gap-6 md:grid-cols-2">
        <?php foreach ($locations as $slug => $location) : ?>
          <li data-reveal>
            <a href="<?php echo silvercrest_url("/{$slug}/"); ?>" class="group block overflow-hidden rounded-md border border-sand bg-white transition hover:border-copper/50 hover:shadow-md">
              <?php silvercrest_image("locations/{$slug}-overview", 'Outdoor space in ' . $location['city'], 'aspect-[16/9] w-full object-cover'); ?>
              <div class="p-6">
                <p class="flex items-center gap-2 text-xs font-medium font-wide uppercase tracking-wide text-copper-dark">
                  <?php silvercrest_icon('map-pin', 'h-4 w-4'); ?> Nevada
                </p>
                <h3 class="mt-2 font-display text-3xl font-semibold text-ink transition-colors group-hover:text-rust"><?php echo esc_html($location['city']); ?></h3>
                <p class="mt-3 text-sm leading-relaxed text-ink/75"><?php echo esc_html($location['intro']); ?></p>
                <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-rust">
                  Landscaping in <?php echo esc_html($location['city']); ?> <?php silvercrest_icon('arrow-right', 'h-4 w-4 transition-transform group-hover:translate-x-1'); ?>
                </span>
              </div>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>

      <div class="mx-auto mt-12 max-w-2xl text-center">
        <p class="leading-relaxed text-ink/80">
          Not sure if your property is in our area? Share your project location when you contact us and we’ll confirm availability.
        </p>
        <div class="mt-6 flex flex-wrap justify-center gap-3">
          <?php silvercrest_cta_button(); ?>
          <a href="<?php echo esc_attr(SILVERCREST_PHONE_HREF); ?>" class="btn btn-outline">
            <?php silvercrest_icon('phone', 'h-4 w-4'); ?> <?php echo esc_html(SILVERCREST_PHONE); ?>
          </a>
        </div>
      </div>
    </div>
  </section>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
