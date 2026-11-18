<?php
/**
 * About — /about/
 * Facts used: founded 2021; formerly Mendoza Lawn Services LLC (identity transition, not a new business);
 * name meaning and values from the brief.
 * VALIDATE before adding: insurance badges (need certificates), NSCB license (never claim "licensed" without number).
 */

$values = array(
  array('title' => 'Responsibility', 'text' => 'We take ownership of the work, from planning to the final walkthrough.'),
  array('title' => 'Quality',        'text' => 'Details matter. We care about materials, preparation, and a clean finish.'),
  array('title' => 'Respect',        'text' => 'For your home, your time, your neighbors, and the desert environment.'),
  array('title' => 'Honesty',        'text' => 'Clear conversations about scope, options, and expectations.'),
);

$name_parts = array(
  array('word' => 'Silver',         'text' => 'A nod to the Silver State. We’re a Nevada company, and our work is rooted here.'),
  array('word' => 'Crest',          'text' => 'The summit of the ridgeline: the standard of quality we hold ourselves to.'),
  array('word' => 'Outdoor Spaces', 'text' => 'Yards, patios, and gathering areas: the whole outdoor environment, not just the lawn.'),
);

get_header(); ?>

<main id="main">

  <?php get_template_part('template-parts/page-hero', null, array(
    'title'       => 'About Silvercrest Outdoor Spaces',
    'intro'       => 'A Southern Nevada company focused on designing and building outdoor spaces that feel right at home in the desert.',
    'image'       => 'about/about-hero',
    'alt'         => 'Silvercrest Outdoor Spaces team on a project site',
    'breadcrumbs' => array(array('About', '/about/')),
  )); ?>

  <!-- Story -->
  <section class="py-16 lg:py-24">
    <div class="container-site grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
      <div>
        <?php silvercrest_section_title('Our Story'); ?>
        <p data-reveal class="mt-6 max-w-xl leading-relaxed text-ink/80">
          Silvercrest Outdoor Spaces has been creating outdoor spaces for homeowners in Las Vegas and Henderson since 2021.
        </p>
        <p data-reveal class="mt-4 max-w-xl leading-relaxed text-ink/80">
          You may have known us as Mendoza Lawn Services. As our work grew from landscape care into design and complete outdoor transformations, we adopted a name that better reflects what we do today. Same team, same commitment, with a clearer focus on thoughtfully designed outdoor spaces.
        </p>
        <div class="mt-8" data-reveal><?php silvercrest_cta_button(); ?></div>
      </div>
      <?php silvercrest_image('about/team', 'The Silvercrest Outdoor Spaces team', 'aspect-[4/3] w-full rounded-sm object-cover', false, true); ?>
    </div>
  </section>

  <!-- The name -->
  <section class="bg-rust py-16 text-cream lg:py-20">
    <div class="container-site">
      <h2 class="text-center font-display text-3xl font-semibold sm:text-4xl">What’s in a Name</h2>
      <ul class="mt-12 grid gap-10 md:grid-cols-3">
        <?php foreach ($name_parts as $part) : ?>
          <li class="text-center" data-reveal>
            <p class="font-display text-3xl font-semibold text-peach"><?php echo esc_html($part['word']); ?></p>
            <p class="mx-auto mt-3 max-w-xs text-sm leading-relaxed text-cream/85"><?php echo esc_html($part['text']); ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <!-- Values -->
  <section class="py-16 lg:py-20">
    <div class="container-site">
      <?php silvercrest_section_heading('How We Work'); ?>
      <ul class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
        <?php foreach ($values as $value) : ?>
          <li class="border-t-2 border-copper/60 pt-5" data-reveal>
            <h3 class="font-display text-xl font-semibold text-ink"><?php echo esc_html($value['title']); ?></h3>
            <p class="mt-2 text-sm leading-relaxed text-ink/75"><?php echo esc_html($value['text']); ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <?php get_template_part('template-parts/process-steps', null, array('link' => true)); ?>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
