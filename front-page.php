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

// PROPOSED copy (brief): validate stages, design scope, HOA approvals and timing with Silvercrest.
$process = array(
  array('title' => 'Tell us about your space',      'text' => 'Share your ideas, goals, and how you want to use your outdoor area.'),
  array('title' => 'Review the design direction',   'text' => 'We’ll develop a design approach with the right materials, layout, and solutions for the desert climate.'),
  array('title' => 'Plan the installation',         'text' => 'Once the design is approved, we’ll prepare a clear plan and timeline for your project.'),
  array('title' => 'See the space come together',   'text' => 'Our team handles the installation with attention to detail, quality, and a clean, professional finish.'),
);

$projects = array(
  array('slug' => 'home/project-1', 'alt' => 'Completed backyard with desert trees, planting beds and landscape lighting'),
  array('slug' => 'home/project-2', 'alt' => 'Covered patio with paver flooring and outdoor fire feature'),
  array('slug' => 'home/project-3', 'alt' => 'Lit paver pathway through desert planting'),
);

get_header(); ?>

<main id="main">

  <!-- Hero -->
  <section class="relative isolate overflow-hidden bg-graphite">
    <?php silvercrest_image('home/hero', 'Completed Silvercrest outdoor space with paver patio and desert planting', 'absolute inset-0 -z-10 h-full w-full object-cover', true); ?>
    <div class="absolute inset-0 -z-10 bg-linear-to-t from-graphite/90 via-graphite/60 to-graphite/30 sm:bg-linear-to-r sm:from-graphite/85 sm:via-graphite/45 sm:to-transparent" aria-hidden="true"></div>

    <div class="mx-auto flex min-h-[32rem] max-w-7xl items-center px-4 py-20 sm:px-6 lg:min-h-[40rem] lg:px-8">
      <div class="max-w-2xl">
        <h1 class="font-serif text-4xl font-semibold leading-[1.05] text-cream sm:text-5xl lg:text-6xl">
          Thoughtfully Designed Outdoor Spaces in Las&nbsp;Vegas &amp; Henderson
        </h1>
        <p class="mt-6 max-w-lg text-base leading-relaxed text-cream/90 sm:text-lg">
          From landscape design to complete installation, create an outdoor space that feels right at home in the Southern Nevada desert.
        </p>
        <a href="<?php echo silvercrest_url('/contact/'); ?>" class="btn btn-primary mt-8 border border-cream/60">
          Request a Consultation <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
      </div>
    </div>
  </section>

  <!-- Capabilities strip -->
  <nav aria-label="Our services" class="border-b border-sand bg-sand/60">
    <ul class="mx-auto grid max-w-7xl grid-cols-2 px-4 py-3 sm:grid-cols-3 sm:px-6 lg:grid-cols-5 lg:divide-x lg:divide-bronze/30 lg:px-8">
      <?php foreach ($capabilities as $item) : ?>
        <li>
          <a href="<?php echo silvercrest_url($item['path']); ?>" class="group flex items-center gap-3 px-3 py-4 lg:justify-center">
            <?php silvercrest_icon($item['icon'], 'h-9 w-9 shrink-0 text-forest'); ?>
            <span class="max-w-[8rem] font-serif text-lg font-semibold leading-tight text-graphite transition-colors group-hover:text-forest">
              <?php echo esc_html($item['label']); ?>
            </span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </nav>

  <!-- Problem / opportunity -->
  <section class="py-16 lg:py-24">
    <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:px-8">
      <div>
        <span class="block h-px w-14 bg-bronze" aria-hidden="true"></span>
        <h2 class="mt-6 font-serif text-4xl font-semibold leading-tight text-graphite sm:text-5xl">
          Outdoor Spaces Designed for the Way You Live
        </h2>
        <p class="mt-6 max-w-xl leading-relaxed text-graphite/80">
          Your outdoor space should feel like a natural extension of your home. From the layout and pavers to planting, irrigation, and lighting, every detail contributes to a cohesive result suited to the Southern Nevada climate.
        </p>
        <a href="<?php echo silvercrest_url('/contact/'); ?>" class="btn btn-primary mt-8">
          Request a Consultation <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
      </div>
      <?php silvercrest_image('home/detail', 'Paver pathway with boulders, agave and low-voltage landscape lighting', 'aspect-[4/3] w-full rounded-sm object-cover'); ?>
    </div>
  </section>

  <!-- Process -->
  <section class="bg-sand/40 py-16 lg:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <?php silvercrest_section_heading('From Concept to Completed Landscape'); ?>

      <ol class="mt-12 grid gap-10 sm:grid-cols-2 lg:grid-cols-4 lg:gap-8">
        <?php foreach ($process as $i => $step) : ?>
          <li class="relative lg:pr-6">
            <span class="flex h-12 w-12 items-center justify-center rounded-full bg-sand font-serif text-2xl font-semibold text-graphite" aria-hidden="true">
              <?php echo esc_html(sprintf('%02d', $i + 1)); ?>
            </span>
            <h3 class="mt-4 font-serif text-xl font-semibold text-graphite"><?php echo esc_html($step['title']); ?></h3>
            <p class="mt-2 text-sm leading-relaxed text-graphite/75"><?php echo esc_html($step['text']); ?></p>
            <?php if ($i < count($process) - 1) : ?>
              <?php silvercrest_icon('chevron-right', 'absolute right-0 top-16 hidden h-5 w-5 text-bronze lg:block'); ?>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <!-- Turf conversion / water-conscious design -->
  <section class="relative overflow-hidden bg-sand">
    <div class="relative h-72 sm:h-96 lg:absolute lg:inset-y-0 lg:left-0 lg:h-auto lg:w-[58%]">
      <?php silvercrest_image('home/xeriscape', 'Water-conscious desert planting with cactus and decorative rock', 'h-full w-full object-cover'); ?>
      <div class="absolute inset-0 hidden bg-linear-to-r from-transparent via-transparent to-sand lg:block" aria-hidden="true"></div>
    </div>

    <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:grid lg:grid-cols-12 lg:px-8 lg:py-24">
      <div class="lg:col-span-5 lg:col-start-8">
        <h2 class="font-serif text-4xl font-semibold leading-tight text-graphite sm:text-5xl">
          Beautiful Outdoor Spaces. Smarter Water Choices.
        </h2>
        <p class="mt-6 leading-relaxed text-graphite/80">
          Explore desert-conscious landscape design and conversion options tailored to your property, your goals, and the Las Vegas environment.
        </p>
        <a href="<?php echo silvercrest_url('/desert-landscaping/'); ?>" class="btn btn-primary mt-8">
          Explore Desert Landscaping <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
        <!-- SNWA guardrail (brief, section 11): no guaranteed rebates. -->
        <p class="mt-6 text-xs leading-relaxed text-graphite/60">
          Some landscape conversions may qualify for local water-saving incentives. Eligibility and program requirements vary. We can discuss available options during your consultation.
        </p>
      </div>
    </div>
  </section>

  <!-- Portfolio -->
  <section class="py-16 lg:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <?php silvercrest_section_heading('See the Difference in the Details'); ?>
      <p class="mx-auto mt-4 max-w-xl text-center text-graphite/75">
        Discover outdoor spaces shaped around how people live, move, and gather.
      </p>

      <div class="mt-10 grid gap-3 sm:grid-cols-3">
        <?php foreach ($projects as $project) : ?>
          <?php silvercrest_image($project['slug'], $project['alt'], 'aspect-[4/3] w-full object-cover'); ?>
        <?php endforeach; ?>
      </div>

      <div class="mt-10 text-center">
        <a href="<?php echo silvercrest_url('/projects/'); ?>" class="btn btn-outline">
          View Recent Projects <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
      </div>
    </div>
  </section>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
