<?php
/**
 * Our Process — /our-process/
 * PROPOSED copy (brief): VALIDATE stages, design scope, renderings, payments,
 * HOA approvals and timelines with Silvercrest before launch.
 */

$steps = silvercrest_process_steps();

$faqs = array(
  array(
    'q' => 'How is a landscape project planned?',
    'a' => 'It starts with understanding the property and how you want to use it. From there, a design direction brings together layout, materials, planting, irrigation, and lighting. Once the design is approved, the installation is planned in sequence so each element is built in the right order.',
  ),
  array(
    'q' => 'Do I need HOA approval?',
    'a' => 'Many communities in Las Vegas and Henderson have landscape guidelines. Requirements vary by HOA, so it’s best to review them early; we can talk through how they may affect your design.',
  ),
  array(
    'q' => 'Can I start with just one part of the yard?',
    'a' => 'Yes. Some projects cover the entire property, while others focus on a front yard, backyard, or a single feature. A clear design helps future phases connect with what’s built first.',
  ),
);

get_header(); ?>

<main id="main">

  <?php get_template_part('template-parts/page-hero', null, array(
    'title'       => 'From Concept to Completed Landscape',
    'intro'       => 'A clear, step-by-step approach that keeps your project organized from the first conversation to the finished outdoor space.',
    'image'       => 'process/process-hero',
    'alt'         => 'Landscape installation in progress',
    'breadcrumbs' => array(array('Our Process', '/our-process/')),
  )); ?>

  <section class="py-16 lg:py-24">
    <div class="container-site">
      <ol class="mx-auto max-w-5xl space-y-14 lg:space-y-20">
        <?php foreach ($steps as $i => $step) : $reverse = $i % 2 === 1; ?>
          <li class="grid items-center gap-8 lg:grid-cols-2 lg:gap-16">
            <div class="<?php echo $reverse ? 'lg:order-2' : ''; ?>">
              <span class="flex h-14 w-14 items-center justify-center rounded-full bg-sand font-display text-3xl font-semibold text-ink" aria-hidden="true">
                <?php echo esc_html(sprintf('%02d', $i + 1)); ?>
              </span>
              <h2 class="mt-5 font-display text-3xl font-semibold leading-tight text-ink"><?php echo esc_html($step['title']); ?></h2>
              <p class="mt-4 leading-relaxed text-ink/80"><?php echo esc_html($step['detail']); ?></p>
            </div>
            <?php silvercrest_image('process/step-' . ($i + 1), $step['title'], 'aspect-[4/3] w-full rounded-sm object-cover', false, true); ?>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <?php get_template_part('template-parts/faq', null, array(
    'faqs'  => $faqs,
    'title' => 'Planning Your Project',
    'class' => 'bg-sand/40 py-16 lg:py-20',
  )); ?>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
