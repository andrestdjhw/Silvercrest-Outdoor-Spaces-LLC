<?php
/**
 * Closing CTA band — reusable at the end of any page.
 * Frenchman Rust with the plan-drawing cross grid and the isotype strata (brand proposal).
 */
?>
<section class="relative isolate overflow-hidden bg-ember py-16 text-center lg:py-24">
  <div class="cross-grid absolute inset-0 -z-10" aria-hidden="true"></div>
  <div data-parallax="18" class="absolute inset-x-0 bottom-6 -z-10 flex justify-center text-cream/[0.07]" aria-hidden="true">
    <?php silvercrest_isotype('h-40 w-[28rem] sm:h-56 sm:w-[40rem]'); ?>
  </div>

  <div class="mx-auto max-w-3xl px-4 sm:px-6">
    <?php silvercrest_annotation(array('7:00 A.M.', '6:30 P.M.', 'The hours we design for'), 'text-peach'); ?>
    <h2 class="mt-5 font-display text-4xl font-bold leading-[0.98] text-cream sm:text-6xl">
      Stay Out a Little Longer
    </h2>
    <p data-reveal class="mx-auto mt-5 max-w-xl text-sm leading-relaxed text-cream/85 sm:text-base">
      Tell us about your space. We’ll start with where the sun hits, and we’ll tell you what happens next, and when.
    </p>
    <a href="<?php echo silvercrest_url('/contact/'); ?>" data-reveal class="btn btn-light mt-8">
      Request a Consultation <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
    </a>
  </div>
</section>
