<?php
/**
 * Projects portfolio — /projects/ and /projects/type/{type}/
 * Filters appear only once there are enough projects to make them useful (brief, section 07).
 */

$current_term = is_tax('project_type') ? get_queried_object() : null;
$total        = (int) wp_count_posts('project')->publish;
$types        = get_terms(array('taxonomy' => 'project_type', 'hide_empty' => true));
$show_filters = $total >= 6 && !is_wp_error($types) && count($types) >= 2;

$breadcrumbs = array(array('Projects', '/projects/'));
if ($current_term) {
  $breadcrumbs[] = array($current_term->name, wp_make_link_relative(get_term_link($current_term)));
}

get_header(); ?>

<main id="main">

  <?php get_template_part('template-parts/page-hero', null, array(
    'title'       => $current_term ? $current_term->name . ' Projects' : 'See the Difference in the Details',
    'intro'       => 'Discover outdoor spaces shaped around how people live, move, and gather.',
    'image'       => 'projects/projects-hero',
    'alt'         => 'Completed Silvercrest outdoor space',  // slot photo + alt: inc/media-map.php
    'breadcrumbs' => $breadcrumbs,
  )); ?>

  <section class="py-16 lg:py-20">
    <div class="container-site">

      <?php if ($show_filters) : ?>
        <nav aria-label="Filter projects" class="mb-12">
          <ul class="flex flex-wrap justify-center gap-2">
            <li>
              <a href="<?php echo esc_url(get_post_type_archive_link('project')); ?>" class="inline-block rounded-full border px-4 py-2 text-sm font-medium transition-colors <?php echo $current_term ? 'border-sand text-ink/80 hover:border-rust hover:text-rust' : 'border-rust bg-rust text-white'; ?>" <?php echo $current_term ? '' : 'aria-current="page"'; ?>>All</a>
            </li>
            <?php foreach ($types as $type) : $active = $current_term && $current_term->term_id === $type->term_id; ?>
              <li>
                <a href="<?php echo esc_url(get_term_link($type)); ?>" class="inline-block rounded-full border px-4 py-2 text-sm font-medium transition-colors <?php echo $active ? 'border-rust bg-rust text-white' : 'border-sand text-ink/80 hover:border-rust hover:text-rust'; ?>" <?php echo $active ? 'aria-current="page"' : ''; ?>>
                  <?php echo esc_html($type->name); ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </nav>
      <?php endif; ?>

      <?php if (have_posts()) : ?>
        <div class="grid gap-x-8 gap-y-12 sm:grid-cols-2 lg:grid-cols-3">
          <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/project-card'); ?>
          <?php endwhile; ?>
        </div>

        <div class="mt-14 flex justify-center gap-3 text-sm">
          <?php
          echo paginate_links(array(
            'prev_text' => '← Previous',
            'next_text' => 'Next →',
            'class'     => 'pagination',
          ));
          ?>
        </div>
      <?php else : ?>
        <!-- No project posts yet: real photos from our crews (template-parts/work-gallery.php);
             the plain empty state only if those are missing too. -->
        <?php if (!$current_term && silvercrest_work_gallery()) : ?>
          <?php get_template_part('template-parts/work-gallery'); ?>
        <?php else : ?>
          <div class="mx-auto max-w-2xl text-center">
            <?php silvercrest_section_heading('Our Portfolio Is Growing'); ?>
            <p class="mt-6 leading-relaxed text-ink/80">
              We’re documenting recent projects to share here soon. In the meantime, we’re happy to talk through ideas for your space and show you examples during your consultation.
            </p>
            <div class="mt-8"><?php silvercrest_cta_button(); ?></div>
          </div>
        <?php endif; ?>
      <?php endif; ?>

    </div>
  </section>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
