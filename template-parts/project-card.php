<?php
/**
 * Project card for grids. Expects to be called inside the loop or with $args['post'].
 */
$project = isset($args['post']) ? $args['post'] : get_post();
$city    = get_post_meta($project->ID, '_project_city', true);
$types   = get_the_terms($project->ID, 'project_type');
?>
<a href="<?php echo esc_url(get_permalink($project)); ?>" class="group block" data-reveal>
  <div class="overflow-hidden rounded-sm" data-tilt>
    <?php if (has_post_thumbnail($project)) : ?>
      <?php echo get_the_post_thumbnail($project, 'large', array('class' => 'aspect-[4/3] w-full object-cover transition-transform duration-500 group-hover:scale-105', 'loading' => 'lazy')); ?>
    <?php else : ?>
      <div class="img-placeholder aspect-[4/3] w-full"><span>Add a featured image</span></div>
    <?php endif; ?>
  </div>
  <div class="mt-4">
    <p class="text-xs font-medium font-wide uppercase tracking-wide text-copper-dark">
      <?php echo esc_html(implode(' · ', array_filter(array($city, ($types && !is_wp_error($types)) ? $types[0]->name : '')))); ?>
    </p>
    <h3 class="mt-1 font-display text-2xl font-semibold leading-tight text-ink transition-colors group-hover:text-rust">
      <?php echo esc_html(get_the_title($project)); ?>
    </h3>
  </div>
</a>
