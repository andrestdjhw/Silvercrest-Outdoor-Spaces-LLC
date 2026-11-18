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

  <!-- Highlights -->
  <section class="bg-sand/40 py-16 lg:py-20">
    <div class="container-site">
      <?php silvercrest_section_heading('What We Focus On'); ?>
      <ul class="mt-12 grid gap-8 sm:grid-cols-2 <?php echo count($service['highlights']) === 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3'; ?>">
        <?php foreach ($service['highlights'] as $item) : ?>
          <li class="border-t-2 border-copper/60 pt-5" data-reveal>
            <h3 class="font-display text-xl font-semibold text-ink"><?php echo esc_html($item['title']); ?></h3>
            <p class="mt-2 text-sm leading-relaxed text-ink/75"><?php echo esc_html($item['text']); ?></p>
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

  <?php get_template_part('template-parts/process-steps', null, array('link' => true)); ?>

  <?php if (!empty($service['faqs'])) : ?>
    <?php get_template_part('template-parts/faq', null, array('faqs' => $service['faqs'])); ?>
  <?php endif; ?>

  <?php get_template_part('template-parts/service-cards', null, array(
    'slugs' => $service['related'],
    'title' => 'Related Services',
    'class' => !empty($service['faqs']) ? 'bg-sand/40 py-16 lg:py-20' : 'py-16 lg:py-20',
  )); ?>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
