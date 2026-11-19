<?php
/**
 * About — /about/
 * Facts used: founded 2021; formerly Mendoza Lawn Services LLC (identity transition, not a new business);
 * name meaning and values from the brief. Story, mark origin, personality, mission and vision:
 * brand proposal (828 Marketing Solutions, Nov 2026).
 * VALIDATE before adding: insurance badges (need certificates), NSCB license (never claim "licensed" without number).
 */

// Brand personality: with judgment, responsible, close.
$values = array(
  array('title' => 'Judgment',       'text' => 'We know the ground and explain the why. And when something isn’t worth it, we say so.'),
  array('title' => 'Responsibility', 'text' => 'We do what we say, we speak up when something changes, and we own the whole result.'),
  array('title' => 'Respect',        'text' => 'For your home, your time and your money. Warm, direct, and in English or Spanish.'),
  array('title' => 'Craft',          'text' => 'Stone, pavers, drip and light, set with care. We show the real process and credit our crew.'),
);

$name_parts = array(
  array('word' => 'The mountain', 'text' => 'Our mark draws Frenchman Mountain, east of the valley, where the sun rises for much of Las Vegas.'),
  array('word' => 'The strata',   'text' => 'It’s built from horizontal lines: the rock layers of the desert, and the rows of stone and pavers we build with.'),
  array('word' => 'The M',        'text' => 'Its two summits form a discreet M, for Mendoza: the family this company grew from. The name changed; the roots are still there.'),
);

get_header(); ?>

<main id="main">

  <?php get_template_part('template-parts/page-hero', null, array(
    'title'       => 'About Silvercrest Outdoor Spaces',
    'intro'       => 'Same family. Same crew. A new name. We design, build and care for outdoor spaces made for living in the desert.',
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
          You may have known us as Mendoza Lawn Services. A family business serving the valley since 2021, we grew one referral at a time, from lawn care into the design and installation of complete outdoor spaces in Las Vegas and Henderson.
        </p>
        <p data-reveal class="mt-4 max-w-xl leading-relaxed text-ink/80">
          Here, many families pay for a yard they barely use: the afternoon sun, the heat and the lack of shade took it from them. We work to give it back. We start with where the sun hits, design shade where it’s needed, choose plants that don’t ask for water the desert doesn’t have, and build with materials that hold up to the summer.
        </p>
        <p data-reveal class="mt-4 max-w-xl font-semibold leading-relaxed text-ink">
          Our work isn’t done at the handoff. It’s done when you’re having dinner outside again.
        </p>
        <div class="mt-8" data-reveal><?php silvercrest_cta_button(); ?></div>
      </div>
      <?php silvercrest_image('about/team', 'The Silvercrest Outdoor Spaces team', 'aspect-[4/3] w-full rounded-sm object-cover', false, true); ?>
    </div>
  </section>

  <!-- The mark -->
  <section class="relative isolate overflow-hidden bg-ember py-16 text-cream lg:py-20">
    <div class="cross-grid absolute inset-0 -z-10" aria-hidden="true"></div>
    <div class="container-site">
      <div class="flex justify-center text-peach" data-reveal><?php silvercrest_isotype('h-12 w-36'); ?></div>
      <h2 class="mt-6 text-center font-display text-4xl font-bold sm:text-5xl">Where Our Mark Comes From</h2>
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

  <!-- Mission & vision + seal -->
  <section class="bg-dune py-16 lg:py-24">
    <div class="container-site grid items-center gap-12 lg:grid-cols-12">
      <div class="flex justify-center lg:col-span-4" data-reveal="zoom">
        <?php silvercrest_seal('h-56 w-56 sm:h-64 sm:w-64'); ?>
      </div>
      <dl class="divide-y divide-ink/15 border-y border-ink/15 lg:col-span-8">
        <div class="grid gap-3 py-8 sm:grid-cols-4" data-reveal>
          <dt class="annotation pt-1 text-copper-dark">Mission</dt>
          <dd class="text-lg leading-relaxed text-ink/85 sm:col-span-3">Design, build and care for outdoor spaces made for living in the desert, with judgment, honesty and a commitment that runs from the first visit to the first summer.</dd>
        </div>
        <div class="grid gap-3 py-8 sm:grid-cols-4" data-reveal>
          <dt class="annotation pt-1 text-copper-dark">Vision</dt>
          <dd class="text-lg leading-relaxed text-ink/85 sm:col-span-3">To be Southern Nevada’s reference for transforming outdoor spaces, known for proving that a yard designed for the desert gets lived in more and looks better.</dd>
        </div>
      </dl>
    </div>
  </section>

  <?php get_template_part('template-parts/process-steps', null, array('link' => true, 'class' => 'py-16 lg:py-20')); ?>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
