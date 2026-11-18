<?php
get_header(); ?>

<main id="main">
  <section class="py-24 lg:py-32">
    <div class="container-site text-center">
      <p class="font-display text-7xl font-semibold text-copper-dark">404</p>
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
