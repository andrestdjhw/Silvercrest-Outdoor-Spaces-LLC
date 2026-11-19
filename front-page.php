<?php
/**
 * Home.
 * Section order: Brief Estratégico v02 (Nov 2026), section 05. Layout: approved homepage mockup.
 * Concept, voice and copy: brand proposal (828 Marketing Solutions, Nov 2026) —
 * "Más horas afuera" / More hours outside, mantra "Shade first, people always."
 * Voice: calm, concrete, no exclamation marks; avoid oasis/paradise/dream backyard/best in town
 * and never lead with the rebate.
 */

$capabilities = array(
  array('label' => 'Landscape Design',      'icon' => 'design',  'path' => '/landscape-design/'),
  array('label' => 'Desert Landscaping',    'icon' => 'cactus',  'path' => '/desert-landscaping/'),
  array('label' => 'Pavers & Hardscaping',  'icon' => 'pavers',  'path' => '/paver-installation/'),
  array('label' => 'Artificial Turf',       'icon' => 'turf',    'path' => '/artificial-turf/'),
  array('label' => 'Irrigation & Lighting', 'icon' => 'droplet', 'path' => '/irrigation-systems/'),
);

// Latest real projects when published; static photos (or placeholders) until then.
$recent_projects = get_posts(array('post_type' => 'project', 'posts_per_page' => 3));

$projects = array(
  array('slug' => 'home/project-1', 'alt' => 'Completed backyard with desert trees, planting beds and landscape lighting'),
  array('slug' => 'home/project-2', 'alt' => 'Covered patio with paver flooring and outdoor fire feature'),
  array('slug' => 'home/project-3', 'alt' => 'Lit paver pathway through desert planting'),
);

get_header(); ?>

<main id="main">

  <!-- Desktop: hero + capabilities strip fill the first screen (viewport minus topbar + navbar = 6.75rem). -->
  <div class="lg:flex lg:min-h-[calc(100svh-6.75rem)] lg:flex-col">

  <!--
    Hero with consultation form.
    Desktop: text left, form card right, both over the photo.
    Mobile: the photo only sits behind the text; the form follows below it, so it never covers the image (brief, section 05).
  -->
  <section class="relative isolate overflow-hidden bg-sand/40 lg:flex lg:flex-1 lg:flex-col lg:bg-ink" data-hero-pointer>
    <div class="container-site grid lg:flex-1 lg:grid-cols-12 lg:items-center lg:gap-12 lg:py-10">

      <div class="relative py-20 lg:static lg:col-span-7 lg:py-0">
        <!-- Photo layer: full-bleed behind the text on mobile, behind the whole hero on desktop -->
        <!-- lg:-inset-6 leaves room for the mouse parallax so edges never show -->
        <div class="absolute inset-y-0 left-1/2 -z-10 w-screen -translate-x-1/2 lg:-inset-6 lg:w-auto lg:translate-x-0" aria-hidden="true" data-hero-layer>
          <?php silvercrest_image('home/hero', 'Completed Silvercrest outdoor space with paver patio and desert planting', 'hero-zoom h-full w-full object-cover', true); ?>
          <div class="absolute inset-0 bg-linear-to-t from-ink/90 via-rust-dark/55 to-ink/30 sm:bg-linear-to-r sm:from-ink/85 sm:via-rust-dark/45 sm:to-ink/10"></div>
          <!-- Low warm light rising from the ground, like the 6:30 p.m. sun -->
          <div class="absolute inset-x-0 bottom-0 h-1/2 bg-linear-to-t from-copper/30 to-transparent mix-blend-soft-light"></div>
        </div>
        <!-- Warm spotlight that follows the mouse (desktop) -->
        <div class="pointer-events-none absolute inset-0 -z-10 hidden bg-[radial-gradient(38rem_circle_at_var(--mx,50%)_var(--my,35%),rgb(214_160_121/0.2),transparent_60%)] lg:block" aria-hidden="true"></div>

        <h1 class="max-w-2xl font-display text-5xl font-bold leading-[0.98] text-cream sm:text-6xl lg:text-7xl">
          Spend More Hours <span class="kmark text-sunset relative inline-block">Outside<svg class="kmark__line pointer-events-none absolute -bottom-2 left-0 h-3 w-full text-copper" viewBox="0 0 300 12" preserveAspectRatio="none" fill="none" aria-hidden="true"><path d="M3 8.5C48 3.5 96 2.8 150 5.2s104 4.6 147-1.4" stroke="currentColor" stroke-width="3" stroke-linecap="round" pathLength="1" vector-effect="non-scaling-stroke"/></svg></span>
        </h1>
        <p data-reveal class="mt-6 max-w-lg text-base leading-relaxed text-cream/90 sm:text-lg">
          We design, build and care for outdoor spaces made for desert living, so you can use your yard in July, not just in March.
        </p>
        <?php silvercrest_annotation(array('Las Vegas', 'Henderson', 'Se habla español'), 'mt-6 text-peach'); ?>
        <!-- Mobile: jump to the form below -->
        <a data-reveal href="#consultation" class="btn btn-primary mt-8 border border-cream/60 lg:hidden">
          Request a Consultation <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
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

  <!-- Capabilities strip -->
  <nav aria-label="Our services" class="border-b border-sand bg-linear-to-r from-sand/80 via-cream to-sand/80">
    <ul class="container-site grid grid-cols-2 py-3 sm:grid-cols-3 lg:grid-cols-5 lg:divide-x lg:divide-copper/30">
      <?php foreach ($capabilities as $item) : ?>
        <li data-reveal>
          <a href="<?php echo silvercrest_url($item['path']); ?>" class="group flex items-center gap-3 px-3 py-4 lg:justify-center">
            <?php silvercrest_icon($item['icon'], 'h-9 w-9 shrink-0 text-rust'); ?>
            <span class="max-w-[8rem] font-display text-lg font-semibold leading-tight text-ink transition-colors group-hover:text-rust">
              <?php echo esc_html($item['label']); ?>
            </span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </nav>

  </div>

  <!-- Problem / opportunity -->
  <section class="py-16 lg:py-24">
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
      <?php silvercrest_image('home/detail', 'Paver pathway with boulders, agave and low-voltage landscape lighting', 'aspect-[4/3] w-full rounded-sm object-cover', false, true, 'right'); ?>
    </div>
  </section>

  <!-- Brand mantra: Silver State surface (the palette's second color) -->
  <section class="relative isolate overflow-hidden bg-dusk py-16 text-cream lg:py-24">
    <div class="cross-grid absolute inset-0 -z-10 opacity-60" aria-hidden="true"></div>
    <div class="container-site grid items-center gap-12 lg:grid-cols-12">
      <div class="lg:col-span-7">
        <?php silvercrest_annotation(array('Our promise'), 'text-cream/80'); ?>
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

  <!-- Services ticker: loops on its own and speeds up with scroll (motion.js) -->
  <section class="overflow-hidden border-y border-sand bg-cream py-8 lg:py-10" aria-label="Services">
    <div class="flex w-max" data-ticker aria-hidden="true">
      <?php for ($set = 0; $set < 2; $set++) : ?>
        <ul class="flex shrink-0 items-center gap-10 pr-10 lg:gap-14 lg:pr-14">
          <?php foreach (array('Landscape Design', 'Desert Landscaping', 'Pavers & Hardscaping', 'Artificial Turf', 'Irrigation', 'Landscape Lighting', 'Tree & Palm Care') as $i => $word) : ?>
            <li class="flex items-center gap-10 lg:gap-14">
              <span class="whitespace-nowrap font-display text-5xl font-semibold uppercase leading-none lg:text-7xl <?php echo $i % 2 ? 'text-transparent [-webkit-text-stroke:1.5px_var(--color-rust)]' : 'text-ink'; ?>"><?php echo esc_html($word); ?></span>
              <?php silvercrest_icon('plus', 'h-7 w-7 shrink-0 text-copper lg:h-9 lg:w-9'); ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endfor; ?>
    </div>
    <!-- Screen readers get the list once -->
    <p class="sr-only">Landscape design, desert landscaping, pavers and hardscaping, artificial turf, irrigation, landscape lighting, and tree and palm care.</p>
  </section>

  <!-- Turf conversion / water-conscious design -->
  <section class="relative overflow-hidden bg-sand">
    <div class="relative h-72 sm:h-96 lg:absolute lg:inset-y-0 lg:left-0 lg:h-auto lg:w-[58%]">
      <?php silvercrest_image('home/xeriscape', 'Water-conscious desert planting with cactus and decorative rock', 'h-full w-full', false, true, 'left'); ?>
      <div class="absolute inset-0 hidden bg-linear-to-r from-transparent via-transparent to-sand lg:block" aria-hidden="true"></div>
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

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
