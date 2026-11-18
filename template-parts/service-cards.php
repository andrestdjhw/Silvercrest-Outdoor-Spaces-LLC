<?php
/**
 * Grid of service cards linking to each service page.
 *
 * $args:
 *   slugs  (array)  service slugs from silvercrest_services()
 *   title  (string) optional centered heading
 *   class  (string) section classes
 *   cols   (string) grid column classes
 */
$args = wp_parse_args($args, array(
  'slugs' => array(),
  'title' => '',
  'class' => 'py-16 lg:py-20',
  'cols'  => 'sm:grid-cols-2 lg:grid-cols-3',
));

$services = silvercrest_services();
?>
<section class="<?php echo esc_attr($args['class']); ?>">
  <div class="container-site">
    <?php if ($args['title']) : ?>
      <div class="mb-10"><?php silvercrest_section_heading($args['title']); ?></div>
    <?php endif; ?>

    <ul class="grid gap-5 <?php echo esc_attr($args['cols']); ?>">
      <?php foreach ($args['slugs'] as $slug) : if (!isset($services[$slug])) continue; $service = $services[$slug]; ?>
        <li data-reveal>
          <a href="<?php echo silvercrest_url("/{$slug}/"); ?>" class="group flex h-full flex-col rounded-md border border-sand bg-white p-6 transition-[border-color,box-shadow] duration-300 hover:border-copper/50 hover:shadow-lg" data-tilt>
            <?php silvercrest_icon($service['icon'], 'h-10 w-10 text-rust'); ?>
            <h3 class="mt-5 font-display text-2xl font-semibold leading-tight text-ink transition-colors group-hover:text-rust">
              <?php echo esc_html($service['label']); ?>
            </h3>
            <p class="mt-3 flex-1 text-sm leading-relaxed text-ink/75"><?php echo esc_html($service['intro']); ?></p>
            <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-rust">
              Learn more <?php silvercrest_icon('arrow-right', 'h-4 w-4 transition-transform group-hover:translate-x-1'); ?>
            </span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
