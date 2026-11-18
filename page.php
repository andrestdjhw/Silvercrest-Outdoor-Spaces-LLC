<?php
/**
 * Generic page (Privacy Policy, Terms, etc.) — content from the WordPress editor.
 */

get_header();

while (have_posts()) : the_post(); ?>

<main id="main">

  <section class="border-b border-sand bg-sand/40 py-14 lg:py-20">
    <div class="container-site">
      <h1 class="font-display text-4xl font-semibold leading-tight text-ink sm:text-5xl"><?php the_title(); ?></h1>
    </div>
  </section>

  <section class="py-14 lg:py-20">
    <div class="container-site">
      <div class="prose prose-lg max-w-3xl prose-headings:font-display prose-a:text-rust">
        <?php the_content(); ?>
      </div>
    </div>
  </section>

</main>

<?php endwhile;

get_footer();
