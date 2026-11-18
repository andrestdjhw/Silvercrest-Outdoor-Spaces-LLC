<?php
/**
 * Home.
 * Copy and section order: Brief Estratégico v02 (Nov 2026), section 05.
 * Layout: approved homepage mockup.
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
          <div class="absolute inset-0 bg-linear-to-t from-ink/90 via-ink/60 to-ink/30 sm:bg-linear-to-r sm:from-ink/85 sm:via-ink/50 sm:to-ink/25"></div>
        </div>
        <!-- Warm spotlight that follows the mouse (desktop) -->
        <div class="pointer-events-none absolute inset-0 -z-10 hidden bg-[radial-gradient(38rem_circle_at_var(--mx,50%)_var(--my,35%),rgb(214_160_121/0.2),transparent_60%)] lg:block" aria-hidden="true"></div>

        <h1 class="max-w-2xl font-display text-4xl font-semibold leading-[1.05] text-cream sm:text-5xl lg:text-6xl">
          Thoughtfully Designed Outdoor Spaces in Las&nbsp;Vegas &amp; <span class="kmark relative inline-block">Henderson<svg class="kmark__line pointer-events-none absolute -bottom-2 left-0 h-3 w-full text-copper" viewBox="0 0 300 12" preserveAspectRatio="none" fill="none" aria-hidden="true"><path d="M3 8.5C48 3.5 96 2.8 150 5.2s104 4.6 147-1.4" stroke="currentColor" stroke-width="3" stroke-linecap="round" pathLength="1" vector-effect="non-scaling-stroke"/></svg></span>
        </h1>
        <p data-reveal class="mt-6 max-w-lg text-base leading-relaxed text-cream/90 sm:text-lg">
          From landscape design to complete installation, create an outdoor space that feels right at home in the Southern Nevada desert.
        </p>
        <!-- Mobile: jump to the form below -->
        <a data-reveal href="#consultation" class="btn btn-primary mt-8 border border-cream/60 lg:hidden">
          Request a Consultation <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
      </div>

      <div id="consultation" class="relative scroll-mt-24 py-10 lg:col-span-5 lg:py-0">
        <!-- "Magic hat" entrance (motion.js → initMagicHat) -->
        <div data-magic-hat class="rounded-md border border-sand bg-cream p-5 shadow-xl sm:p-6 lg:bg-cream/95 lg:backdrop-blur">
          <h2 class="font-display text-2xl font-semibold leading-tight text-ink sm:text-3xl">Request a Consultation</h2>
          <p class="mt-1 text-sm text-ink/75">Tell us about your project and we’ll be in touch.</p>
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
  <nav aria-label="Our services" class="border-b border-sand bg-sand/60">
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
        <span class="block h-px w-14 bg-copper" aria-hidden="true" data-reveal="line-r"></span>
        <h2 class="mt-6 font-display text-4xl font-semibold leading-tight text-ink sm:text-5xl">
          Outdoor Spaces Designed for the Way You Live
        </h2>
        <p data-reveal class="mt-6 max-w-xl leading-relaxed text-ink/80">
          Your outdoor space should feel like a natural extension of your home. From the layout and pavers to planting, irrigation, and lighting, every detail contributes to a cohesive result suited to the Southern Nevada climate.
        </p>
        <a data-reveal href="<?php echo silvercrest_url('/contact/'); ?>" class="btn btn-primary mt-8">
          Request a Consultation <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
      </div>
      <?php silvercrest_image('home/detail', 'Paver pathway with boulders, agave and low-voltage landscape lighting', 'aspect-[4/3] w-full rounded-sm object-cover', false, true); ?>
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
      <?php silvercrest_image('home/xeriscape', 'Water-conscious desert planting with cactus and decorative rock', 'h-full w-full', false, true); ?>
      <div class="absolute inset-0 hidden bg-linear-to-r from-transparent via-transparent to-sand lg:block" aria-hidden="true"></div>
    </div>

    <div class="container-site relative py-14 lg:grid lg:grid-cols-12 lg:py-24">
      <div class="lg:col-span-5 lg:col-start-8">
        <h2 class="font-display text-4xl font-semibold leading-tight text-ink sm:text-5xl">
          Beautiful Outdoor Spaces. Smarter Water Choices.
        </h2>
        <p data-reveal class="mt-6 leading-relaxed text-ink/80">
          Explore desert-conscious landscape design and conversion options tailored to your property, your goals, and the Las Vegas environment.
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
      <?php silvercrest_section_heading('See the Difference in the Details'); ?>
      <p class="mx-auto mt-4 max-w-xl text-center text-ink/75">
        Discover outdoor spaces shaped around how people live, move, and gather.
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
    'class'  => 'bg-sand/40 py-16 lg:py-20',
    'schema' => true,
  )); ?>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
