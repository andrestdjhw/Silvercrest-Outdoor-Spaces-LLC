<?php
/**
 * Home.
 * Section order: Brief Estratégico v02 (Nov 2026), section 05. Layout: approved homepage mockup.
 * Concept, voice and copy: brand proposal (828 Marketing Solutions, Nov 2026) —
 * "Más horas afuera" / More hours outside, mantra "Shade first, people always."
 * Voice: calm, concrete, no exclamation marks; avoid oasis/paradise/dream backyard/best in town
 * and never lead with the rebate.
 */

// Latest real projects when published; static photos (or placeholders) until then.
$recent_projects = get_posts(array('post_type' => 'project', 'posts_per_page' => 3));

$projects = array(
  array('slug' => 'home/project-1', 'alt' => 'Completed backyard with desert trees, planting beds and landscape lighting'),
  array('slug' => 'home/project-2', 'alt' => 'Covered patio with paver flooring and outdoor fire feature'),
  array('slug' => 'home/project-3', 'alt' => 'Lit paver pathway through desert planting'),
);

get_header(); ?>

<main id="main">

  <!-- Desktop: the hero fills the first screen (viewport minus topbar + navbar = 6.75rem). -->
  <div class="hero-fit lg:flex lg:min-h-[calc(100svh-6.75rem)] lg:flex-col">

  <!--
    Hero with consultation form.
    Desktop: text left, form card right, both over the photo.
    Mobile: the photo only sits behind the text; the form follows below it, so it never covers the image (brief, section 05).
  -->
  <section class="relative isolate overflow-hidden bg-sand/40 lg:flex lg:flex-1 lg:flex-col lg:bg-ink" data-hero-pointer>
    <div class="container-site grid lg:flex-1 lg:grid-cols-12 lg:items-center lg:gap-12 lg:py-10">

      <div class="relative py-20 lg:static lg:col-span-7 lg:py-0">
        <!-- Video layer (Media Library: SILVERCREST_HERO_VIDEO_ID, phone cut SILVERCREST_HERO_VIDEO_MOBILE_ID; hero photo as fallback): full-bleed behind the text on mobile, behind the whole hero on desktop -->
        <!-- lg:-inset-6 leaves room for the mouse parallax so edges never show -->
        <div class="absolute inset-y-0 left-1/2 -z-10 w-screen -translate-x-1/2 lg:-inset-6 lg:w-auto lg:translate-x-0" aria-hidden="true" data-hero-layer>
          <?php silvercrest_video(SILVERCREST_HERO_VIDEO_ID, 'home/hero', 'Completed Silvercrest outdoor space with paver patio and desert planting', 'h-full w-full object-cover', SILVERCREST_HERO_VIDEO_MOBILE_ID); ?>
          <div class="absolute inset-0 bg-linear-to-t from-ink/90 via-rust-dark/55 to-ink/30 sm:bg-linear-to-r sm:from-ink/85 sm:via-rust-dark/45 sm:to-ink/10"></div>
          <!-- Low warm light rising from the ground, like the 6:30 p.m. sun -->
          <div class="absolute inset-x-0 bottom-0 h-1/2 bg-linear-to-t from-copper/30 to-transparent mix-blend-soft-light"></div>
        </div>
        <!-- Warm spotlight that follows the mouse (desktop) -->
        <div class="pointer-events-none absolute inset-0 -z-10 hidden bg-[radial-gradient(38rem_circle_at_var(--mx,50%)_var(--my,35%),rgb(214_160_121/0.2),transparent_60%)] lg:block" aria-hidden="true"></div>

        <h1 class="max-w-2xl font-display text-5xl font-bold leading-[0.98] text-cream sm:text-6xl lg:text-7xl">
          Your Yard, Back. <span class="kmark text-sunset relative inline-block">Even in July.<svg class="kmark__line pointer-events-none absolute -bottom-2 left-0 h-3 w-full text-copper" viewBox="0 0 300 12" preserveAspectRatio="none" fill="none" aria-hidden="true"><path d="M3 8.5C48 3.5 96 2.8 150 5.2s104 4.6 147-1.4" stroke="currentColor" stroke-width="3" stroke-linecap="round" pathLength="1" vector-effect="non-scaling-stroke"/></svg></span>
        </h1>
        <p data-reveal class="mt-6 max-w-lg text-base leading-relaxed text-cream/90 sm:text-lg">
          Shade where you sit, plants that sip water, stone that takes the heat. We design, build and care for outdoor spaces made for the desert.
        </p>
        <?php silvercrest_annotation(array('Las Vegas', 'Henderson', 'Se habla español'), 'mt-6 text-peach'); ?>
        <!-- CTAs. The form sits beside the text on desktop, so there the primary leads to the services;
             on mobile it jumps down to the form. -->
        <div data-reveal class="mt-8 flex flex-wrap gap-3">
          <a href="#consultation" class="btn btn-primary border border-cream/60 lg:hidden">
            Request a Consultation <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
          </a>
          <a href="<?php echo silvercrest_url('/services/'); ?>" class="btn btn-light hidden lg:inline-flex">
            Explore Our Services <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
          </a>
          <a href="<?php echo esc_attr(SILVERCREST_PHONE_HREF); ?>" class="btn btn-ghost-light">
            <?php silvercrest_icon('phone', 'h-4 w-4'); ?> <span class="lg:hidden">Call Us</span><span class="hidden lg:inline"><?php echo esc_html(SILVERCREST_PHONE); ?></span>
          </a>
        </div>
      </div>

      <div id="consultation" class="relative scroll-mt-24 py-10 lg:col-span-5 lg:py-0">
        <!-- "Magic hat" entrance (motion.js → initMagicHat) -->
        <!-- Solid card on mobile (it sits on a light background); translucent glass over the photo from lg (.hero-glass) -->
        <div data-magic-hat class="hero-glass rounded-md border border-sand bg-linear-to-b from-cream to-[#ebe1d4] p-5 shadow-xl sm:p-6">
          <!-- data-no-split: the card has its own entrance; the word split would be measured mid-animation -->
          <h2 data-no-split class="cf-title font-display text-2xl font-semibold leading-tight text-ink sm:text-3xl">Request a Consultation</h2>
          <p class="cf-muted mt-1 text-sm text-ink/75">Tell us about your project and we’ll be in touch.</p>
          <div data-react="contact-form" data-variant="compact" class="mt-4">
            <p class="text-sm text-ink/75">
              Call us at <a href="<?php echo esc_attr(SILVERCREST_PHONE_HREF); ?>" class="font-semibold text-rust"><?php echo esc_html(SILVERCREST_PHONE); ?></a> to discuss your project.
            </p>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Services ribbon: endless smooth drift left → right (CSS .marquee). The list is printed twice so
       the loop is seamless; the copy is hidden from assistive tech and keyboard. Hover pauses it;
       reduced motion stops it and lets the row scroll by hand. -->
  <nav aria-label="Our services" class="marquee border-b border-sand/70 bg-chalk">
    <div class="marquee__track">
      <?php for ($copy = 0; $copy < 2; $copy++) : ?>
        <ul class="marquee__group"<?php echo $copy ? ' aria-hidden="true"' : ''; ?>>
          <?php foreach (silvercrest_services() as $slug => $service) : ?>
            <li>
              <a href="<?php echo silvercrest_url("/{$slug}/"); ?>"<?php echo $copy ? ' tabindex="-1"' : ''; ?> class="group flex items-center gap-3 px-8 py-5">
                <?php silvercrest_icon($service['icon'], 'h-8 w-8 shrink-0 text-rust'); ?>
                <span class="whitespace-nowrap font-display text-lg font-semibold text-ink transition-colors group-hover:text-rust"><?php echo esc_html($service['label']); ?></span>
              </a>
            </li>
            <li class="flex items-center text-copper" aria-hidden="true"><?php silvercrest_isotype('h-3 w-8'); ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endfor; ?>
    </div>
  </nav>

  </div>

  <!-- All services -->
  <?php get_template_part('template-parts/services-index'); ?>

  <?php get_template_part('template-parts/reviews'); ?>

  <!-- Problem / opportunity -->
  <section class="relative isolate overflow-hidden bg-dune py-16 lg:py-24">
    <!-- Strata behind the photo side (brand pattern), fading in toward the edge -->
    <div class="strata-field strata-field-light absolute bottom-0 right-0 -z-10 h-1/2 w-full [--strata-fade:to_bottom] lg:h-full lg:w-1/2 lg:[--strata-fade:to_right]" aria-hidden="true"></div>
    <div class="container-site grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
      <div>
        <?php silvercrest_section_title('Your Evenings, Back', 'sm:text-5xl'); ?>
        <p data-reveal class="mt-6 max-w-xl leading-relaxed text-ink/80">
          In Las Vegas, plenty of families pay for a yard they barely use. The afternoon sun, the heat and the missing shade took it from them.
        </p>
        <p data-reveal class="mt-4 max-w-xl leading-relaxed text-ink/80">
          We start with where the sun hits. Shade where it’s needed, plants that don’t ask for water the desert doesn’t have, and materials built for 112-degree summers. Coffee at seven. Dinner outside in September.
        </p>
        <a data-reveal href="<?php echo silvercrest_url('/contact/'); ?>" class="btn btn-primary mt-8">
          Request a Consultation <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
      </div>
      <?php silvercrest_image('home/detail', 'Paver pathway with boulders, agave and low-voltage landscape lighting', 'aspect-[4/3] w-full rounded-sm object-cover', false, true); ?>
    </div>
  </section>

  <!-- Brand mantra: warm night surface (same as the footer) -->
  <section class="relative isolate overflow-hidden bg-night py-16 text-cream lg:py-24">
    <div class="cross-grid absolute inset-0 -z-10 opacity-40" aria-hidden="true"></div>
    <div class="container-site grid items-center gap-12 lg:grid-cols-12">
      <div class="lg:col-span-7">
        <?php silvercrest_annotation(array('Our promise'), 'text-peach'); ?>
        <h2 class="mt-4 font-display text-5xl font-bold leading-[0.95] sm:text-6xl lg:text-7xl">Shade First. People Always.</h2>
        <div class="strata mt-8 w-24 [--strata-color:var(--color-cream)] [--strata-gap:4px] [--strata-line:2px]" aria-hidden="true" data-reveal="line-r"></div>
      </div>
      <dl class="grid gap-8 sm:grid-cols-2 lg:col-span-5 lg:grid-cols-1">
        <div data-reveal>
          <dt class="font-display text-2xl font-bold uppercase">Shade first</dt>
          <dd class="mt-2 leading-relaxed text-cream/90">Every design decision starts with the sun and the desert: orientation, shade, planting, water and light, so you can stay out more hours of the day and more months of the year.</dd>
        </div>
        <div data-reveal>
          <dt class="font-display text-2xl font-bold uppercase">People always</dt>
          <dd class="mt-2 leading-relaxed text-cream/90">We do what we say, we answer when you call, and we tell you what happens next, and when. In English and in Spanish.</dd>
        </div>
      </dl>
    </div>
  </section>

  <?php get_template_part('template-parts/process-steps'); ?>

  <!-- Turf conversion / water-conscious design -->
  <section class="relative overflow-hidden bg-sand">
    <div class="relative h-72 sm:h-96 lg:absolute lg:inset-y-0 lg:left-0 lg:h-auto lg:w-[58%]">
      <?php silvercrest_image('home/xeriscape', 'Water-conscious desert planting with cactus and decorative rock', 'h-full w-full', false, true); ?>
      <!-- Short fade only at the seam with the text, so the photo keeps its contrast -->
      <div class="absolute inset-y-0 right-0 hidden w-1/4 bg-linear-to-r from-sand/0 to-sand lg:block" aria-hidden="true"></div>
    </div>

    <div class="container-site relative py-14 lg:grid lg:grid-cols-12 lg:py-24">
      <div class="lg:col-span-5 lg:col-start-8">
        <h2 class="font-display text-4xl font-semibold leading-tight text-ink sm:text-5xl">
          Less Water. More Living.
        </h2>
        <p data-reveal class="mt-6 leading-relaxed text-ink/80">
          Taking out the grass shouldn’t feel like giving up. A desert yard, designed for the place, looks better than the lawn it replaces and asks for less: less water, less upkeep, more evenings outside.
        </p>
        <a data-reveal href="<?php echo silvercrest_url('/desert-landscaping/'); ?>" class="btn btn-primary mt-8">
          Explore Desert Landscaping <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
        <!-- SNWA guardrail (brief, section 11): no guaranteed rebates. -->
        <p data-reveal class="mt-6 text-xs leading-relaxed text-ink/60">
          Some landscape conversions may qualify for local water-saving incentives. Eligibility and program requirements vary. We can discuss available options during your consultation.
        </p>
      </div>
    </div>
  </section>

  <!-- Portfolio -->
  <section class="py-16 lg:py-20">
    <div class="container-site">
      <?php silvercrest_section_heading('Desert Yards, Done Right'); ?>
      <p class="mx-auto mt-4 max-w-xl text-center text-ink/75">
        Clean lines, local stone and shade where the sun hits. Outdoor spaces shaped around how people live, gather and stay out a little longer.
      </p>

      <?php if ($recent_projects) : ?>
        <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
          <?php foreach ($recent_projects as $project) : ?>
            <?php get_template_part('template-parts/project-card', null, array('post' => $project)); ?>
          <?php endforeach; ?>
        </div>
      <?php else : ?>
        <div class="mt-10 grid gap-3 sm:grid-cols-3">
          <?php foreach ($projects as $project) : ?>
            <?php silvercrest_image($project['slug'], $project['alt'], 'aspect-[4/3] w-full object-cover', false, true); ?>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <div class="mt-10 text-center">
        <a href="<?php echo silvercrest_url('/projects/'); ?>" class="btn btn-outline">
          View Recent Projects <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
      </div>
    </div>
  </section>

  <?php get_template_part('template-parts/faq', null, array(
    'faqs'   => silvercrest_home_faqs(),
    'title'  => 'Frequently Asked Questions',
    'intro'  => 'Answers to common questions about planning an outdoor space in Southern Nevada.',
    'class'  => 'bg-dune py-16 lg:py-20',
    'schema' => true,
  )); ?>

  <?php get_template_part('template-parts/service-map'); ?>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
