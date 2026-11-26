<?php
/**
 * Home: client reviews, right after the services. Data: silvercrest_reviews() (inc/content.php).
 * Rust band with the strata pattern (horizontal lines of the isotype); glass cards like the process steps.
 * Desktop: 3 columns. Mobile: a row that scrolls sideways (scroll-snap).
 * No aggregate rating or review count is claimed here: add one only from the real Google profile.
 */
$reviews = silvercrest_reviews();
if (empty($reviews)) {
  return;
}
$google = silvercrest_socials()['google'] ?? '';
?>
<section class="relative isolate overflow-clip bg-rust py-16 text-cream lg:py-24">
  <div class="strata-field absolute inset-x-0 bottom-0 top-1/4 -z-10" aria-hidden="true"></div>

  <div class="container-site">
    <div class="flex flex-wrap items-end justify-between gap-6">
      <div>
        <p data-reveal class="annotation flex items-center gap-3 text-peach">
          <span class="h-px w-8 bg-peach/70" aria-hidden="true"></span>In their words
        </p>
        <h2 class="mt-5 max-w-2xl font-display text-4xl font-bold leading-[1] sm:text-5xl">What Our Clients Say</h2>
      </div>
      <?php if ($google) : ?>
        <a data-reveal href="<?php echo esc_url($google); ?>" target="_blank" rel="noopener" class="btn btn-ghost-light">
          Read Our Google Reviews <?php silvercrest_icon('arrow-right', 'h-4 w-4 -rotate-45'); ?>
        </a>
      <?php endif; ?>
    </div>

    <ul class="-mx-4 mt-12 flex snap-x snap-mandatory scroll-px-4 gap-5 sm:scroll-px-6 overflow-x-auto px-4 pb-4 [scrollbar-width:none] sm:-mx-6 sm:px-6 lg:mx-0 lg:grid lg:grid-cols-3 lg:gap-6 lg:overflow-visible lg:px-0 lg:pb-0">
      <?php foreach ($reviews as $review) : ?>
        <li data-reveal class="w-[85%] shrink-0 snap-start sm:w-[60%] lg:w-auto">
          <figure class="relative flex h-full flex-col rounded-md border border-cream/15 bg-linear-160 from-ink/45 to-ink/25 p-7 shadow-2xl shadow-ink/30 backdrop-blur-md sm:p-8">
            <div class="flex items-center justify-between gap-4">
              <?php if (!empty($review['rating'])) : $stars = max(1, min(5, (int) $review['rating'])); ?>
                <span class="flex gap-1 text-peach" role="img" aria-label="<?php echo esc_attr("Rated {$stars} out of 5"); ?>">
                  <?php for ($i = 0; $i < 5; $i++) : ?>
                    <svg class="h-4 w-4<?php echo $i >= $stars ? ' opacity-30' : ''; ?>" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 1.5l2.6 5.3 5.9.9-4.3 4.1 1 5.8L10 14.9l-5.2 2.7 1-5.8L1.5 7.7l5.9-.9L10 1.5z"/></svg>
                  <?php endfor; ?>
                </span>
              <?php endif; ?>
              <?php if (!empty($review['demo'])) : ?>
                <span class="rounded-full border border-cream/30 px-2.5 py-0.5 text-[0.65rem] font-semibold uppercase tracking-widest text-cream/70">Sample</span>
              <?php endif; ?>
            </div>

            <blockquote class="mt-6 flex-1 text-lg leading-relaxed text-cream/90">
              <p>&ldquo;<?php echo esc_html($review['quote']); ?>&rdquo;</p>
            </blockquote>

            <figcaption class="mt-8 border-t border-cream/15 pt-5">
              <span class="block font-display text-xl font-semibold text-cream"><?php echo esc_html($review['name']); ?></span>
              <span class="annotation mt-1 block text-peach"><?php echo esc_html(implode(' · ', array_filter(array($review['area'] ?? '', $review['service'] ?? '')))); ?></span>
            </figcaption>
          </figure>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
