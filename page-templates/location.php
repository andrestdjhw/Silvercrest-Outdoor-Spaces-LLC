<?php
/**
 * City landing page — used for every slug in silvercrest_locations() (see inc/routing.php).
 * Projects appear automatically when a Project's City field matches.
 * Images: assets/images/locations/{slug}-hero, -overview
 */

$slug     = silvercrest_current_slug();
$location = silvercrest_locations()[$slug];
$projects = silvercrest_projects_in_city($location['city']);

get_header(); ?>

<main id="main">

  <?php get_template_part('template-parts/page-hero', null, array(
    'title'       => $location['h1'],
    'intro'       => $location['intro'],
    'image'       => "locations/{$slug}-hero",
    'alt'         => 'Outdoor space in ' . $location['city'] . ' by Silvercrest Outdoor Spaces',
    'breadcrumbs' => array(array('Service Areas', '/service-areas/'), array($location['city'], "/{$slug}/")),
  )); ?>

  <section class="py-16 lg:py-24">
    <div class="container-site grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
      <div>
        <?php silvercrest_section_title($location['section_title']); ?>
        <?php foreach ($location['section'] as $paragraph) : ?>
          <p data-reveal class="mt-6 max-w-xl leading-relaxed text-ink/80"><?php echo esc_html($paragraph); ?></p>
        <?php endforeach; ?>
        <div class="mt-8 flex flex-wrap gap-3">
          <?php silvercrest_cta_button(); ?>
          <a href="<?php echo esc_attr(SILVERCREST_PHONE_HREF); ?>" class="btn btn-outline">
            <?php silvercrest_icon('phone', 'h-4 w-4'); ?> <?php echo esc_html(SILVERCREST_PHONE); ?>
          </a>
        </div>
      </div>
      <?php silvercrest_image("locations/{$slug}-overview", 'Landscape project in ' . $location['city'], 'aspect-[4/3] w-full rounded-sm object-cover', false, true); ?>
    </div>
  </section>

  <?php get_template_part('template-parts/service-cards', null, array(
    'slugs' => $location['services'],
    'title' => 'Services in ' . $location['city'],
    'class' => 'bg-sand/40 py-16 lg:py-20',
  )); ?>

  <?php if ($projects) : ?>
    <section class="py-16 lg:py-20">
      <div class="container-site">
        <?php silvercrest_section_heading('Recent Projects in ' . $location['city']); ?>
        <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
          <?php foreach ($projects as $project) : ?>
            <?php get_template_part('template-parts/project-card', null, array('post' => $project)); ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php get_template_part('template-parts/faq', null, array(
    'faqs'  => $location['faqs'],
    'title' => 'Questions from ' . $location['city'] . ' Homeowners',
  )); ?>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
