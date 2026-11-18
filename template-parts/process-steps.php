<?php
/**
 * "From Concept to Completed Landscape" — 4 steps.
 *
 * $args:
 *   title     (string) section heading
 *   link      (bool)   show "See our process" link (default false)
 *   class     (string) section classes (background, spacing)
 */
$args = wp_parse_args($args, array(
  'title' => 'From Concept to Completed Landscape',
  'link'  => false,
  'class' => 'bg-sand/40 py-16 lg:py-20',
));

$steps = silvercrest_process_steps();
?>
<section class="<?php echo esc_attr($args['class']); ?>">
  <div class="container-site">
    <?php silvercrest_section_heading($args['title']); ?>

    <ol class="mt-12 grid gap-10 sm:grid-cols-2 lg:grid-cols-4 lg:gap-8">
      <?php foreach ($steps as $i => $step) : ?>
        <li class="relative lg:pr-6" data-reveal>
          <span class="flex h-12 w-12 items-center justify-center rounded-full bg-sand font-display text-2xl font-semibold text-ink" aria-hidden="true">
            <?php echo esc_html(sprintf('%02d', $i + 1)); ?>
          </span>
          <h3 class="mt-4 font-display text-xl font-semibold text-ink"><?php echo esc_html($step['title']); ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-ink/75"><?php echo esc_html($step['text']); ?></p>
          <?php if ($i < count($steps) - 1) : ?>
            <?php silvercrest_icon('chevron-right', 'absolute right-0 top-16 hidden h-5 w-5 text-copper-dark lg:block'); ?>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ol>

    <?php if ($args['link']) : ?>
      <div class="mt-12 text-center">
        <a href="<?php echo silvercrest_url('/our-process/'); ?>" class="btn btn-outline">
          See Our Process <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
      </div>
    <?php endif; ?>
  </div>
</section>
