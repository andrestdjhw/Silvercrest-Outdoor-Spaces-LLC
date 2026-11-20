<?php
/**
 * Service Areas — /service-areas/
 * Confirmed coverage: Las Vegas and Henderson only. Priority zones from the industry report
 * (Anthem, Summerlin, Inspirada, etc.) are NOT confirmed coverage — don't list them as served.
 * Maps instead of photos. "Nearby areas" (silvercrest_nearby_areas()) are framed as
 * "ask about availability", never as places we serve.
 */
$nearby = silvercrest_nearby_areas();

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

      <ul class="mx-auto mt-12 grid max-w-6xl gap-6 md:grid-cols-2">
        <?php foreach ($locations as $slug => $location) : ?>
          <li data-reveal>
            <article class="group flex h-full flex-col overflow-hidden rounded-md border border-sand bg-chalk shadow-sm transition hover:border-copper/50 hover:shadow-lg">
              <?php silvercrest_map_embed($location['city'] . ', NV', 'Map of ' . $location['city'] . ', Nevada', 11, 'aspect-[16/10]'); ?>
              <div class="flex flex-1 flex-col p-6 sm:p-7">
                <p class="flex items-center gap-2 text-xs font-medium font-wide uppercase tracking-wide text-copper-dark">
                  <?php silvercrest_icon('map-pin', 'h-4 w-4'); ?> Clark County, Nevada
                </p>
                <h3 class="mt-2 font-display text-3xl font-semibold text-ink"><?php echo esc_html($location['city']); ?></h3>
                <p class="mt-3 flex-1 text-sm leading-relaxed text-ink/75"><?php echo esc_html($location['intro']); ?></p>
                <a href="<?php echo silvercrest_url("/{$slug}/"); ?>" class="mt-5 inline-flex items-center gap-2 self-start text-sm font-semibold text-rust hover:underline">
                  Landscaping in <?php echo esc_html($location['city']); ?> <?php silvercrest_icon('arrow-right', 'h-4 w-4 transition-transform group-hover:translate-x-1'); ?>
                </a>
              </div>
            </article>
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

  <!-- Nearby areas: not confirmed coverage, so the copy asks, it doesn't promise -->
  <section class="relative isolate overflow-hidden bg-dune py-16 lg:py-24">
    <div class="strata-field strata-field-light absolute inset-x-0 bottom-0 -z-10 h-1/3" aria-hidden="true"></div>
    <div class="container-site">
      <div class="flex flex-wrap items-end justify-between gap-6">
        <div>
          <?php silvercrest_annotation(array('Clark County', 'Nye County', 'Nearby'), 'text-copper-dark'); ?>
          <h2 class="mt-4 max-w-2xl font-display text-4xl font-bold leading-[1] text-ink sm:text-5xl">Just Outside the Valley?</h2>
        </div>
        <p class="max-w-md leading-relaxed text-ink/75">
          We get asked about these areas too. Availability depends on the project and the schedule, so tell us where you are and we’ll let you know.
        </p>
      </div>

      <ul class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($nearby as $area) : ?>
          <li data-reveal>
            <article class="flex h-full flex-col overflow-hidden rounded-md border border-ink/10 bg-chalk shadow-sm">
              <?php silvercrest_map_embed($area['query'], 'Map of ' . $area['name'] . ', Nevada', $area['zoom'], 'aspect-[4/3]'); ?>
              <div class="flex flex-1 items-end justify-between gap-4 p-5">
                <div>
                  <p class="annotation text-copper-dark"><?php echo esc_html($area['county']); ?></p>
                  <h3 class="mt-1 font-display text-2xl font-semibold text-ink"><?php echo esc_html($area['name']); ?></h3>
                </div>
                <a href="<?php echo silvercrest_url('/contact/'); ?>" class="inline-flex shrink-0 items-center gap-1.5 text-sm font-semibold text-rust hover:underline">
                  Ask about availability <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
                </a>
              </div>
            </article>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
