<?php
/**
 * Water-saving incentive note (brief, section 11 guardrails).
 * Never: guaranteed rebates, fixed amounts, "we handle your rebate", or "all homes must remove grass".
 *
 * $args:
 *   variant  'full' (educational block with official link) | 'turf' (turf eligibility note)
 */
$variant = isset($args['variant']) ? $args['variant'] : 'full';
?>
<section class="pb-16 lg:pb-20">
  <div class="container-site">
    <div class="mx-auto max-w-4xl rounded-md border border-sand bg-sand/40 p-6 sm:p-10">
      <?php silvercrest_icon('droplet', 'h-9 w-9 text-rust'); ?>

      <?php if ($variant === 'turf') : ?>
        <h2 class="mt-4 font-display text-2xl font-semibold text-ink sm:text-3xl">Artificial Turf and Water-Saving Incentives</h2>
        <p class="mt-4 leading-relaxed text-ink/80">
          Not every artificial turf installation qualifies for local water-saving incentives. Eligibility depends on the specific program requirements, and some programs limit where and how turf can be used. We can discuss the options for your property during your consultation.
        </p>
      <?php else : ?>
        <h2 class="mt-4 font-display text-2xl font-semibold text-ink sm:text-3xl">About Water-Saving Incentives</h2>
        <p class="mt-4 leading-relaxed text-ink/80">
          Some landscape conversions may qualify for local water-saving incentives. Eligibility and program requirements vary. We can discuss available options during your consultation.
        </p>
        <p class="mt-4 leading-relaxed text-ink/80">
          The Southern Nevada Water Authority (SNWA) publishes current program details, including requirements that may need to be met before any work begins. We recommend reviewing them early in your planning.
        </p>
        <a href="https://www.snwa.com/" target="_blank" rel="noopener noreferrer" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-rust hover:underline">
          Visit SNWA’s official website <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
          <span class="sr-only">(opens in a new tab)</span>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>
