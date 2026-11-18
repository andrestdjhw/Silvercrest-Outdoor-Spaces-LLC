<?php
/**
 * Single project / case study — /projects/{slug}/
 * Title, city, challenge, solution (Project Details box) + photos in the editor content.
 */

get_header();

while (have_posts()) : the_post();
  $city      = get_post_meta(get_the_ID(), '_project_city', true);
  $challenge = get_post_meta(get_the_ID(), '_project_challenge', true);
  $solution  = get_post_meta(get_the_ID(), '_project_solution', true);
  $types     = get_the_terms(get_the_ID(), 'project_type');
  $type      = ($types && !is_wp_error($types)) ? $types[0] : null;
?>

<main id="main">

  <section class="relative isolate overflow-hidden bg-ink">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('full', array('class' => 'hero-zoom absolute inset-0 -z-10 h-full w-full object-cover', 'fetchpriority' => 'high', 'loading' => 'eager')); ?>
    <?php endif; ?>
    <div class="absolute inset-0 -z-10 bg-linear-to-t from-ink/90 via-ink/50 to-ink/20" aria-hidden="true"></div>

    <div class="container-site flex min-h-[26rem] items-end pb-14 pt-20 lg:min-h-[34rem]">
      <div class="max-w-3xl">
        <nav aria-label="Breadcrumb">
          <ol class="flex flex-wrap items-center gap-2 text-xs font-medium font-wide uppercase tracking-wide text-cream/70">
            <li><a href="<?php echo silvercrest_url('/'); ?>" class="hover:text-cream">Home</a> <span aria-hidden="true">/</span></li>
            <li><a href="<?php echo esc_url(get_post_type_archive_link('project')); ?>" class="hover:text-cream">Projects</a> <span aria-hidden="true">/</span></li>
            <li aria-current="page" class="text-peach"><?php the_title(); ?></li>
          </ol>
        </nav>
        <?php if ($city || $type) : ?>
          <p class="mt-5 text-sm font-medium font-wide uppercase tracking-wide text-peach">
            <?php echo esc_html(implode(' · ', array_filter(array($city, $type ? $type->name : '')))); ?>
          </p>
        <?php endif; ?>
        <h1 class="mt-3 font-display text-4xl font-semibold leading-[1.05] text-cream sm:text-5xl lg:text-[3.5rem]"><?php the_title(); ?></h1>
      </div>
    </div>
  </section>

  <?php if ($challenge || $solution) : ?>
    <section class="py-16 lg:py-20">
      <div class="container-site grid gap-10 md:grid-cols-2 lg:gap-16">
        <?php foreach (array('The Challenge' => $challenge, 'The Solution' => $solution) as $heading => $text) : if (!$text) continue; ?>
          <div>
            <?php silvercrest_section_title($heading); ?>
            <p class="mt-6 whitespace-pre-line leading-relaxed text-ink/80"><?php echo esc_html($text); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if (get_the_content()) : ?>
    <section class="pb-16 lg:pb-20 <?php echo ($challenge || $solution) ? '' : 'pt-16 lg:pt-20'; ?>">
      <div class="container-site">
        <div class="prose prose-lg mx-auto max-w-5xl prose-headings:font-display prose-img:rounded-sm">
          <?php the_content(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <section class="border-t border-sand py-10">
    <div class="container-site text-center">
      <a href="<?php echo esc_url(get_post_type_archive_link('project')); ?>" class="btn btn-outline">
        View All Projects <?php silvercrest_icon('arrow-right', 'h-4 w-4'); ?>
      </a>
    </div>
  </section>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php endwhile;

get_footer();
