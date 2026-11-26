<?php
/**
 * "Here’s what happens next, and when" — 4 steps (brand voice: show the real process).
 * Layout after the "clear path" section of remake.828marketingsolutions.com:
 * sticky intro + photo on the left, step cards that stack on scroll on the right
 * (desktop; motion.js → initStackCards). Mobile: intro, then the cards in a column.
 *
 * $args:
 *   title     (string) section heading
 *   link      (bool)   show "See our process" link (default false)
 *   class     (string) spacing classes (the section is always dark)
 *   image     (string) image slug to show instead of the crew video (service pages)
 *   image_alt (string) its alt text
 *   tag       (string) short phrase on the photo
 */
$args = wp_parse_args($args, array(
  'title' => 'Here’s What Happens Next, and When',
  'link'  => false,
  'class' => 'py-16 lg:py-24',
  'image'     => '',
  'image_alt' => '',
  'tag'       => 'Shade first. People always.',
));
$photo = $args['image'] && silvercrest_image_url($args['image']) ? $args['image'] : '';

$steps = silvercrest_process_steps();
$icons = array('map-pin', 'design', 'calendar', 'pavers');
// Glass tints, deepening step by step: Ink → Rust deeper → Rust → Copper (dark).
// Translucent like the hero form (.hero-glass); the photo-less Silver State shows through.
$tones = array(
  'rgb(33 26 22 / .55), rgb(33 26 22 / .4)',
  'rgb(74 29 9 / .52), rgb(74 29 9 / .38)',
  'rgb(101 41 15 / .55), rgb(101 41 15 / .4)',
  'rgb(140 82 38 / .62), rgb(140 82 38 / .48)',
);
?>
<!-- overflow-clip, not overflow-hidden: hidden would make the section the sticky container -->
<section class="relative isolate overflow-clip bg-dusk text-cream <?php echo esc_attr($args['class']); ?>">
  <div class="cross-grid absolute inset-0 -z-10 opacity-60" aria-hidden="true"></div>

  <div class="container-site grid gap-12 lg:grid-cols-12 lg:gap-16">

    <div class="lg:col-span-5">
      <div class="lg:sticky lg:top-32">
        <p data-reveal class="annotation flex items-center gap-3 text-cream/90">
          <span class="h-px w-8 bg-cream/70" aria-hidden="true"></span>How we work
        </p>
        <!-- data-no-split: it's sticky, so the word split would think it scrolled away -->
        <h2 data-no-split data-reveal class="mt-5 font-display text-4xl font-bold leading-[1] sm:text-5xl"><?php echo esc_html($args['title']); ?></h2>
        <p data-reveal class="mt-6 max-w-md text-lg leading-relaxed text-cream/90">
          A conversation to start, a design you approve, a plan with a timeline and a crew that finishes clean. At every step you know what comes next.
        </p>

        <!-- Service pages: a photo of that service ($args image). Elsewhere: real crew footage
             (SILVERCREST_PROCESS_VIDEO_ID, web cut of the turf install video); photo if it's missing.
             Lazy: desktop only, starts when it scrolls into view. -->
        <div class="relative mt-10 hidden aspect-[4/3] overflow-hidden rounded-md bg-ink/40 lg:block">
          <?php if ($photo) : ?>
            <?php silvercrest_image($photo, $args['image_alt'], 'h-full w-full object-cover'); ?>
          <?php else : ?>
            <?php silvercrest_video(SILVERCREST_PROCESS_VIDEO_ID, 'process/step-3', 'Silvercrest crew brushing in a new artificial turf lawn', 'h-full w-full object-cover', 0, true); ?>
          <?php endif; ?>
          <span class="absolute bottom-4 left-4 inline-flex items-center gap-2 rounded-full bg-ink/70 px-3 py-1.5 text-xs font-medium text-cream backdrop-blur" aria-hidden="true">
            <span class="h-2 w-2 rounded-full bg-peach"></span> <?php echo esc_html($args['tag']); ?>
          </span>
        </div>

        <?php if ($args['link']) : ?>
          <a data-reveal href="<?php echo silvercrest_url('/our-process/'); ?>" class="btn btn-light mt-8">
            See Our Process <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>

    <div class="lg:col-span-7">
      <p data-reveal class="text-2xl text-cream/90 md:text-3xl">Four steps, start to finish:</p>
      <ol class="mt-10 grid gap-6 pb-4" data-stack-cards>
        <?php foreach ($steps as $i => $step) : ?>
          <li class="stack-card rounded-md p-7 text-cream shadow-2xl shadow-ink/30 sm:p-9 lg:sticky"
              style="--stack-i: <?php echo (int) $i; ?>; --card-bg: <?php echo esc_attr($tones[$i % 4]); ?>">
            <div class="flex items-start justify-between gap-6">
              <span class="stack-card__num text-sunset font-display text-7xl font-bold leading-none sm:text-8xl" aria-hidden="true"><?php echo esc_html(sprintf('%02d', $i + 1)); ?></span>
              <span class="stack-card__art text-peach" aria-hidden="true"><?php silvercrest_icon($icons[$i % 4], 'h-12 w-12 sm:h-14 sm:w-14'); ?></span>
            </div>
            <h3 class="mt-8 font-display text-3xl font-bold leading-tight sm:text-4xl">
              <span class="sr-only">Step <?php echo (int) $i + 1; ?>: </span><?php echo esc_html($step['title']); ?>
            </h3>
            <p class="mt-3 max-w-xl leading-relaxed text-cream/85"><?php echo esc_html($step['text']); ?></p>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>

  </div>
</section>
