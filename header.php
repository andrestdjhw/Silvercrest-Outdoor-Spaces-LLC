<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-md focus:bg-forest focus:px-4 focus:py-2 focus:text-white">Skip to content</a>

    <!-- React: src/components/Navbar.js -->
    <!-- The inner div reserves the header height until React replaces it (avoids layout shift). -->
    <div id="silvercrest-navbar" class="sticky top-0 z-50"><div class="h-18 md:h-27"></div></div>
