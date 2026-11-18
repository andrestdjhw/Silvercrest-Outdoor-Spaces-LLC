<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
      // Enable scroll-reveal styles only when they can run; if the main script never
      // initializes (error/blocked), show everything after 2.5s.
      (function (d) {
        if (!('IntersectionObserver' in window) || matchMedia('(prefers-reduced-motion: reduce)').matches) return;
        d.classList.add('js-reveal');
        setTimeout(function () { if (!window.__silvercrestReveal) d.classList.remove('js-reveal'); }, 2500);
      })(document.documentElement);
    </script>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-md focus:bg-rust focus:px-4 focus:py-2 focus:text-white">Skip to content</a>

    <!-- React: src/components/Navbar.js -->
    <!-- Header is fixed; this spacer reserves its height (navbar 4.5rem + topbar 2.25rem on md+) so nothing shifts. -->
    <div class="h-18 md:h-27" aria-hidden="true"></div>
    <div id="silvercrest-navbar" class="fixed inset-x-0 z-50"></div><!-- top offset lives in src/index.css (admin bar aware) -->
