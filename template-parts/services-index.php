<?php
/**
 * Home: index of every service (silvercrest_services()), design & build first, care second
 * (brief: don't lead with maintenance).
 * Desktop: numbered list on the right; the photo on the left follows the hovered/focused row
 * (src/scripts/service-preview.js). Mobile: the list only.
 */
$services = silvercrest_services();
$groups   = array(
  'design' => 'Design & Build',
  'care'   => 'Systems & Care',
);
$n = 0;
?>
<section class="py-16 lg:py-24" data-service-preview>
  <div class="container-site grid gap-10 lg:grid-cols-12 lg:gap-16">

    <div class="lg:col-span-5">
      <div class="lg:sticky lg:top-32">
        <?php silvercrest_annotation(array(count($services) . ' services', 'Design', 'Build', 'Care'), 'mb-6 text-copper-dark'); ?>
        <?php silvercrest_section_title('Everything Your Outdoor Space Needs', 'sm:text-5xl'); ?>
        <p data-reveal class="mt-6 max-w-md leading-relaxed text-ink/80">
          From the first sketch to the drip line and the last light on the path. One team plans it, builds it and stays to care for it.
        </p>

        <!-- Preview: every photo stacked, the active one fades in -->
        <div class="relative mt-10 hidden aspect-[4/3] overflow-hidden rounded-sm bg-sand lg:block" aria-hidden="true" data-reveal="clip">
          <?php $first = true; foreach ($services as $slug => $service) : $url = silvercrest_image_url("services/{$slug}-preview") ?: silvercrest_image_url("services/{$slug}-hero"); if (!$url) continue; ?>
            <img src="<?php echo esc_url($url); ?>" alt="" loading="lazy" decoding="async"
                 class="service-preview__img absolute inset-0 h-full w-full object-cover<?php echo $first ? ' is-active' : ''; ?>"
                 data-preview-key="<?php echo esc_attr($slug); ?>">
          <?php $first = false; endforeach; ?>
          <div class="pointer-events-none absolute inset-x-0 bottom-0 h-1/3 bg-linear-to-t from-rust-dark/50 to-transparent"></div>
        </div>

        <a data-reveal href="<?php echo silvercrest_url('/services/'); ?>" class="btn btn-primary mt-8">
          View All Services <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
        </a>
      </div>
    </div>

    <div class="space-y-12 lg:col-span-7">
      <?php foreach ($groups as $group => $group_label) : ?>
        <div>
          <?php silvercrest_annotation(array($group_label), 'text-copper-dark'); ?>
          <ul class="mt-4 border-b border-ink/15">
            <?php foreach ($services as $slug => $service) : if ($service['group'] !== $group) continue; $n++; ?>
              <li class="border-t border-ink/15" data-reveal>
                <a href="<?php echo silvercrest_url("/{$slug}/"); ?>" data-preview-target="<?php echo esc_attr($slug); ?>"
                   class="group grid grid-cols-[2.5rem_1fr_auto] items-center gap-x-4 py-5 transition-colors duration-300 hover:bg-dune focus-visible:bg-dune sm:grid-cols-[3.5rem_1fr_auto] sm:py-6 lg:px-3">
                  <span class="annotation text-ink/50 transition-colors group-hover:text-copper-dark"><?php echo esc_html(sprintf('%02d', $n)); ?></span>
                  <span>
                    <span class="block font-display text-2xl font-semibold leading-tight text-ink transition-colors group-hover:text-rust sm:text-3xl"><?php echo esc_html($service['label']); ?></span>
                    <span class="mt-1 block text-sm leading-relaxed text-ink/70"><?php echo esc_html($service['menu']); ?></span>
                  </span>
                  <span class="flex h-10 w-10 items-center justify-center rounded-full border border-ink/20 text-rust transition-[background-color,border-color,color,transform] duration-300 group-hover:border-rust group-hover:bg-rust group-hover:text-cream group-hover:-rotate-45">
                    <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
                  </span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
