<?php
/**
 * HOA & Commercial Landscape Conversion — /hoa-landscape-conversion/
 * Brief: "Alta, validar alcance" — subject to license and capacity. Created as a DRAFT page.
 * VALIDATE with Silvercrest: HOA/commercial scope, NSCB license classification, capacity, and the
 * AB 356 wording below before publishing. Keep it in the footer/secondary nav, not the main menu.
 */

$points = array(
  array('icon' => 'design',   'title' => 'Conversion Planning',  'text' => 'Evaluate turf areas and plan desert-appropriate alternatives that fit the community’s character.'),
  array('icon' => 'calendar', 'title' => 'Phased Budgets',       'text' => 'Break larger conversions into phases so work can be scheduled and budgeted over time.'),
  array('icon' => 'layers',   'title' => 'Clear Timelines',      'text' => 'Outline the scope and sequence of work so boards and managers know what to expect.'),
  array('icon' => 'droplet',  'title' => 'Water-Conscious Design', 'text' => 'Pair climate-appropriate planting with irrigation planned for the new landscape.'),
);

get_header(); ?>

<main id="main">

  <?php get_template_part('template-parts/page-hero', null, array(
    'title'       => 'Landscape Conversion Planning for HOAs & Property Managers',
    'intro'       => 'Planning, phased budgets, and clear timelines for community and commercial landscape updates in Las Vegas and Henderson.',
    'image'       => 'hoa/hoa-hero',
    'alt'         => 'Community common area with desert landscaping',
    'breadcrumbs' => array(array('HOA & Commercial', '/hoa-landscape-conversion/')),
    'cta'         => false,
  )); ?>

  <section class="py-16 lg:py-24">
    <div class="container-site grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
      <div>
        <?php silvercrest_section_title('Planning Conversions with Confidence'); ?>
        <p data-reveal class="mt-6 max-w-xl leading-relaxed text-ink/80">
          Nevada’s Assembly Bill 356 restricts the use of Colorado River water to irrigate nonfunctional turf on many non-single-family properties, including common areas, streetscapes, and commercial sites. Requirements and timelines vary, and single-family homes are treated differently.
        </p>
        <p data-reveal class="mt-4 max-w-xl leading-relaxed text-ink/80">
          If your community or property is evaluating its options, we can help plan a conversion that respects the site, the budget, and the people who use it.
        </p>
        <a href="<?php echo silvercrest_url('/contact/'); ?>" class="btn btn-primary mt-8">
          Request a Project Consultation <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
      </div>
      <?php silvercrest_image('hoa/hoa-overview', 'Converted common area with desert planting', 'aspect-[4/3] w-full rounded-sm object-cover', false, true); ?>
    </div>
  </section>

  <section class="bg-dune py-16 lg:py-20">
    <div class="container-site">
      <?php silvercrest_section_heading('How We Help'); ?>
      <ul class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
        <?php foreach ($points as $point) : ?>
          <li>
            <?php silvercrest_icon($point['icon'], 'h-10 w-10 text-rust'); ?>
            <h3 class="mt-4 font-display text-xl font-semibold text-ink"><?php echo esc_html($point['title']); ?></h3>
            <p class="mt-2 text-sm leading-relaxed text-ink/75"><?php echo esc_html($point['text']); ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <?php get_template_part('template-parts/snwa-note', null, array('variant' => 'full')); ?>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
