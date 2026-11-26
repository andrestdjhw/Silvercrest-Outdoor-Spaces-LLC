<?php
/**
 * Service page — used for every slug in silvercrest_services() (see inc/routing.php).
 * Images: assets/images/services/{slug}-hero, -overview, -1, -2, -3
 */

$slug    = silvercrest_current_slug();
$service = silvercrest_services()[$slug];

get_header(); ?>

<main id="main">

  <?php get_template_part('template-parts/page-hero', null, array(
    'title'       => $service['h1'],
    'intro'       => $service['intro'],
    'image'       => "services/{$slug}-hero",
    'alt'         => $service['label'] . ' project by Silvercrest Outdoor Spaces',
    'breadcrumbs' => array(array('Services', '/services/'), array($service['label'], "/{$slug}/")),
  )); ?>

  <!-- Overview -->
  <section class="py-16 lg:py-24">
    <div class="container-site grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
      <div>
        <?php silvercrest_section_title($service['overview_title']); ?>
        <?php foreach ($service['overview'] as $paragraph) : ?>
          <p data-reveal class="mt-6 max-w-xl leading-relaxed text-ink/80"><?php echo esc_html($paragraph); ?></p>
        <?php endforeach; ?>
        <div class="mt-8" data-reveal><?php silvercrest_cta_button(); ?></div>
      </div>
      <?php silvercrest_image("services/{$slug}-overview", $service['label'] . ' detail', 'aspect-[4/3] w-full rounded-sm object-cover', false, true); ?>
    </div>
  </section>

  <!-- Highlights: photo cards (slots services/{slug}-focus-N; stock until real photos) -->
  <?php $focus_count = count($service['highlights']); ?>
  <section class="relative isolate overflow-hidden bg-dune py-16 lg:py-24">
    <div class="strata-field strata-field-light absolute inset-x-0 bottom-0 -z-10 h-1/2" aria-hidden="true"></div>
    <div class="container-site">
      <div class="flex flex-wrap items-end justify-between gap-6">
        <div>
          <?php silvercrest_annotation(array($service['label'], 'What we focus on'), 'text-copper-dark'); ?>
          <h2 class="mt-4 max-w-xl font-display text-4xl font-bold leading-[1] text-ink sm:text-5xl">
            <?php echo esc_html($focus_count === 4 ? 'Four Things We Get Right' : 'Three Things We Get Right'); ?>
          </h2>
        </div>
        <p class="max-w-sm leading-relaxed text-ink/75">The details that decide whether a yard gets used, planned from the first visit.</p>
      </div>

      <ul class="mt-12 grid gap-5 sm:grid-cols-2 <?php echo $focus_count === 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3'; ?>">
        <?php foreach ($service['highlights'] as $i => $item) : ?>
          <li data-reveal>
            <article class="focus-card group relative isolate flex aspect-[4/5] flex-col justify-end overflow-hidden rounded-md bg-ink sm:aspect-[3/4] p-6 text-cream shadow-xl shadow-ink/15 sm:p-7 <?php echo $focus_count === 3 ? 'lg:aspect-[4/5]' : ''; ?>">
              <div class="absolute inset-0 -z-20" aria-hidden="true">
                <?php silvercrest_image("services/{$slug}-focus-" . ($i + 1), '', 'h-full w-full object-cover transition-transform duration-[1200ms] ease-out group-hover:scale-[1.06]'); ?>
              </div>
              <div class="absolute inset-0 -z-10 bg-linear-to-t from-ink via-ink/55 to-ink/5 transition-opacity duration-500 group-hover:opacity-90" aria-hidden="true"></div>

              <span class="text-sunset absolute left-6 top-5 font-display text-6xl font-bold leading-none sm:left-7 sm:top-6" aria-hidden="true"><?php echo esc_html(sprintf('%02d', $i + 1)); ?></span>

              <span class="mb-4 block h-0.5 w-10 bg-peach transition-[width] duration-500 group-hover:w-16" aria-hidden="true"></span>
              <h3 class="font-display text-2xl font-bold leading-tight sm:text-[1.7rem]"><?php echo esc_html($item['title']); ?></h3>
              <p class="mt-2 text-sm leading-relaxed text-cream/85"><?php echo esc_html($item['text']); ?></p>
            </article>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <!-- Gallery -->
  <section class="py-16 lg:py-20">
    <div class="container-site">
      <?php silvercrest_section_heading('See the Difference in the Details'); ?>
      <div class="mt-10 grid gap-3 sm:grid-cols-3">
        <?php for ($i = 1; $i <= 3; $i++) : ?>
          <?php silvercrest_image("services/{$slug}-{$i}", $service['label'] . ' project photo ' . $i, 'aspect-[4/3] w-full object-cover', false, true); ?>
        <?php endfor; ?>
      </div>
      <div class="mt-10 text-center">
        <a href="<?php echo silvercrest_url('/projects/'); ?>" class="btn btn-outline">
          View Recent Projects <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
      </div>
    </div>
  </section>

  <?php if (!empty($service['snwa'])) : ?>
    <?php get_template_part('template-parts/snwa-note', null, array('variant' => $service['snwa'])); ?>
  <?php endif; ?>

  <?php get_template_part('template-parts/process-steps', null, array(
    'link'      => true,
    'image'     => "services/{$slug}-process",
    'image_alt' => $service['label'] . ' by Silvercrest Outdoor Spaces',
    'tag'       => silvercrest_service_process_tag($slug),
  )); ?>

  <?php if (!empty($service['faqs'])) : ?>
    <?php get_template_part('template-parts/faq', null, array('faqs' => $service['faqs'])); ?>
  <?php endif; ?>

  <?php get_template_part('template-parts/service-cards', null, array(
    'slugs' => $service['related'],
    'title' => 'Related Services',
    'class' => !empty($service['faqs']) ? 'bg-dune py-16 lg:py-20' : 'py-16 lg:py-20',
  )); ?>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
