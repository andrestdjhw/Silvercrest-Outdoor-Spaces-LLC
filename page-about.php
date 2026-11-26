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

  <!-- Values + mission & vision: one dark band over a desert photo.
       Motion: photo drifts (data-parallax), giant word slides (data-giant), cards reveal in a
       stagger and tilt on hover (data-tilt), the seal's lettering turns slowly (.seal-spin). -->
  <section class="relative isolate overflow-clip bg-ink py-20 text-cream lg:py-28">
    <div class="absolute inset-x-0 -inset-y-[12%] -z-20" data-parallax="8" aria-hidden="true">
      <?php silvercrest_image('about/values-bg', '', 'h-full w-full object-cover'); ?>
    </div>
    <div class="absolute inset-0 -z-10 bg-linear-to-b from-ink/90 via-ink/75 to-rust-dark/90" aria-hidden="true"></div>
    <div class="strata-field absolute inset-x-0 bottom-0 -z-10 h-1/3" aria-hidden="true"></div>

    <!-- Giant word sliding with the scroll -->
    <p class="pointer-events-none absolute left-0 top-10 -z-10 whitespace-nowrap font-display text-[9rem] font-bold uppercase leading-none text-cream/[0.03] sm:text-[13rem]" data-giant aria-hidden="true">
      Judgment · Responsibility · Respect · Craft ·
    </p>

    <div class="container-site">
      <div class="flex flex-wrap items-end justify-between gap-6">
        <div>
          <p data-reveal class="annotation flex items-center gap-3 text-peach">
            <span class="h-px w-8 bg-peach/70" aria-hidden="true"></span>Our values
          </p>
          <h2 class="mt-5 font-display text-4xl font-bold leading-[1] sm:text-6xl">What We Stand On</h2>
        </div>
        <p data-reveal class="max-w-md leading-relaxed text-cream/80">
          Four things that don’t change from one job to the next, whatever the size of the yard.
        </p>
      </div>

      <ul class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <?php foreach ($values as $i => $value) : ?>
          <li data-reveal>
            <article data-tilt class="group relative h-full overflow-hidden rounded-md border border-cream/15 bg-linear-160 from-cream/[0.10] to-cream/[0.03] p-7 shadow-2xl shadow-ink/40 backdrop-blur-md transition-colors duration-500 hover:border-peach/50">
              <span class="text-sunset block font-display text-6xl font-bold leading-none" aria-hidden="true"><?php echo esc_html(sprintf('%02d', $i + 1)); ?></span>
              <span class="mt-6 block h-0.5 w-10 bg-peach transition-[width] duration-500 group-hover:w-20" aria-hidden="true"></span>
              <h3 class="mt-5 font-display text-2xl font-bold"><?php echo esc_html($value['title']); ?></h3>
              <p class="mt-3 text-sm leading-relaxed text-cream/80"><?php echo esc_html($value['text']); ?></p>
            </article>
          </li>
        <?php endforeach; ?>
      </ul>

      <!-- Mission & vision -->
      <div class="mt-20 grid items-center gap-12 lg:mt-28 lg:grid-cols-12">
        <div class="seal-float flex justify-center lg:col-span-4" data-reveal="zoom">
          <?php silvercrest_seal('h-auto w-64 drop-shadow-2xl sm:w-80', 'light'); ?>
        </div>
        <dl class="divide-y divide-cream/15 rounded-md border border-cream/15 bg-ink/40 px-7 backdrop-blur-md sm:px-10 lg:col-span-8">
          <div class="grid gap-3 py-8 sm:grid-cols-4" data-reveal>
            <dt class="annotation pt-1.5 text-peach">Mission</dt>
            <dd class="text-lg leading-relaxed text-cream/90 sm:col-span-3 lg:text-xl">Design, build and care for outdoor spaces made for living in the desert, with judgment, honesty and a commitment that runs from the first visit to the first summer.</dd>
          </div>
          <div class="grid gap-3 py-8 sm:grid-cols-4" data-reveal>
            <dt class="annotation pt-1.5 text-peach">Vision</dt>
            <dd class="text-lg leading-relaxed text-cream/90 sm:col-span-3 lg:text-xl">To be Southern Nevada’s reference for transforming outdoor spaces, known for proving that a yard designed for the desert gets lived in more and looks better.</dd>
          </div>
        </dl>
      </div>
    </div>
  </section>

  <?php get_template_part('template-parts/process-steps', null, array('link' => true, 'class' => 'py-16 lg:py-20')); ?>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
