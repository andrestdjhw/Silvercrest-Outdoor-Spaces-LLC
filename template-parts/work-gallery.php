<?php
/**
 * /projects/: real photos from our crews (silvercrest_work_gallery(), inc/media-map.php),
 * shown while there are no project posts yet. Portrait tiles, like the phone photos they are.
 * The turf crew video sits in the grid as one more tile (lazy, plays when on screen).
 */
$items = array_values(array_filter(silvercrest_work_gallery(), function ($item) {
  return wp_attachment_is_image($item[0]);
}));
if (empty($items)) {
  return;
}
?>
<div class="mx-auto max-w-2xl text-center">
  <?php silvercrest_annotation(array('Real jobs', 'Real crews', 'No stock'), 'text-copper-dark'); ?>
  <h2 class="mt-5 font-display text-4xl font-bold leading-[1] text-ink sm:text-5xl">From Our Crews</h2>
  <p data-reveal class="mt-5 leading-relaxed text-ink/80">
    Finished spaces and the work that gets them there. Full project stories are on the way; for now, here’s what our days look like.
  </p>
</div>

<ul class="mt-12 grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4">
  <?php foreach ($items as $i => $item) : list($id, $caption, $tag, $in_progress) = $item; ?>
    <?php if ($i === 3 && defined('SILVERCREST_PROCESS_VIDEO_ID') && SILVERCREST_PROCESS_VIDEO_ID) : ?>
      <li data-reveal>
        <figure class="group relative aspect-[3/4] overflow-hidden rounded-sm bg-ink">
          <?php silvercrest_video(SILVERCREST_PROCESS_VIDEO_ID, 'process/step-3', 'Crew brushing in a new turf lawn', 'h-full w-full object-cover', 0, true); ?>
          <figcaption class="pointer-events-none absolute inset-x-0 bottom-0 bg-linear-to-t from-ink/90 via-ink/60 to-transparent p-4 pt-16 text-cream">
            <span class="annotation block text-peach">Turf · In progress</span>
            <span class="mt-1 block text-sm font-medium leading-snug">Brushing in a new turf lawn</span>
          </figcaption>
        </figure>
      </li>
    <?php endif; ?>
    <li data-reveal>
      <figure class="group relative aspect-[3/4] overflow-hidden rounded-sm bg-sand">
        <?php echo wp_get_attachment_image($id, 'large', false, array(
          'alt'      => $caption,
          'class'    => 'h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.04]',
          'sizes'    => '(min-width: 1024px) 25vw, 50vw',
          'loading'  => 'lazy',
          'decoding' => 'async',
        )); ?>
        <figcaption class="pointer-events-none absolute inset-x-0 bottom-0 bg-linear-to-t from-ink/90 via-ink/60 to-transparent p-4 pt-16 text-cream">
          <span class="annotation block text-peach"><?php echo esc_html($tag . ($in_progress ? ' · In progress' : '')); ?></span>
          <span class="mt-1 block text-sm font-medium leading-snug"><?php echo esc_html($caption); ?></span>
        </figcaption>
      </figure>
    </li>
  <?php endforeach; ?>
</ul>

<div class="mt-12 text-center">
  <p class="text-ink/75">Want to see more, or something close to what you have in mind?</p>
  <div class="mt-6"><?php silvercrest_cta_button(); ?></div>
</div>
