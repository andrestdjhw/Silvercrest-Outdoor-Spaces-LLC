<?php
get_header(); ?>

<main id="main">
  <section class="py-24 lg:py-32">
    <div class="container-site text-center">
      <div class="flex justify-center"><?php silvercrest_brand_logo('imagotipo-vertical-dark', 'h-40 w-auto'); ?></div>
      <p class="mt-8 annotation text-copper-dark">Error 404 · Off the map</p>
      <h1 class="mt-4 font-display text-4xl font-semibold text-ink sm:text-5xl">This Page Couldn’t Be Found</h1>
      <p class="mx-auto mt-5 max-w-lg leading-relaxed text-ink/75">
        The page you’re looking for may have moved or no longer exists. Try one of these instead.
      </p>
      <div class="mt-8 flex flex-wrap justify-center gap-3">
        <a href="<?php echo silvercrest_url('/'); ?>" class="btn btn-primary">Back to Home</a>
        <a href="<?php echo silvercrest_url('/services/'); ?>" class="btn btn-outline">Our Services</a>
        <a href="<?php echo silvercrest_url('/contact/'); ?>" class="btn btn-outline">Contact Us</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer();
