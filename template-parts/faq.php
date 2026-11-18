<?php
/**
 * FAQ accordion (native <details>, works without JS).
 *
 * $args:
 *   faqs   (array)  [['q' => ..., 'a' => ...], ...]
 *   title  (string)
 *   class  (string) section classes
 *   intro  (string) optional line under the heading
 *   schema (bool)   output FAQPage JSON-LD — use on ONE page per set of questions (default false)
 */
$args = wp_parse_args($args, array(
  'faqs'   => array(),
  'title'  => 'Frequently Asked Questions',
  'class'  => 'py-16 lg:py-20',
  'intro'  => '',
  'schema' => false,
));

if (empty($args['faqs'])) {
  return;
}
?>
<section class="<?php echo esc_attr($args['class']); ?>">
  <div class="container-site">
    <div class="mx-auto max-w-3xl">
      <?php silvercrest_section_heading($args['title']); ?>
      <?php if ($args['intro']) : ?>
        <p class="mt-4 text-center text-ink/75"><?php echo esc_html($args['intro']); ?></p>
      <?php endif; ?>

      <div class="mt-10 divide-y divide-sand border-y border-sand">
        <?php foreach ($args['faqs'] as $faq) : ?>
          <details class="group py-5" data-reveal data-accordion>
            <summary class="flex cursor-pointer list-none items-center justify-between gap-6 font-display text-xl font-semibold text-ink [&::-webkit-details-marker]:hidden">
              <?php echo esc_html($faq['q']); ?>
              <?php silvercrest_icon('plus', 'h-5 w-5 shrink-0 text-copper-dark transition-transform group-open:rotate-45 group-data-closing:rotate-0'); ?>
            </summary>
            <div class="overflow-hidden" data-accordion-panel><p class="pt-3 leading-relaxed text-ink/80"><?php echo esc_html($faq['a']); ?></p></div>
          </details>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<?php if ($args['schema']) : ?>
  <script type="application/ld+json"><?php
    echo wp_json_encode(array(
      '@context'   => 'https://schema.org',
      '@type'      => 'FAQPage',
      'mainEntity' => array_map(function ($faq) {
        return array(
          '@type'          => 'Question',
          'name'           => $faq['q'],
          'acceptedAnswer' => array('@type' => 'Answer', 'text' => $faq['a']),
        );
      }, $args['faqs']),
    ));
  ?></script>
<?php endif; ?>
