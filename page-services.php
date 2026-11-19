<?php
/**
 * Services hub — /services/
 * Design & installation first, care services second (brief: don't lead with maintenance).
 */

$services = silvercrest_services();
$design   = array_keys(array_filter($services, fn($s) => $s['group'] === 'design'));
$care     = array_keys(array_filter($services, fn($s) => $s['group'] === 'care'));

get_header(); ?>

<main id="main">

  <?php get_template_part('template-parts/page-hero', null, array(
    'title'       => 'Landscape Services for Southern Nevada Outdoor Spaces',
    'intro'       => 'From the first design conversation to installation and long-term care, every service is part of creating an outdoor space that works for your property and the desert climate.',
    'image'       => 'services/services-hero',
    'alt'         => 'Completed outdoor space with pavers, desert planting and lighting',
    'breadcrumbs' => array(array('Services', '/services/')),
  )); ?>

  <?php get_template_part('template-parts/service-cards', null, array(
    'slugs' => $design,
    'title' => 'Design & Installation',
  )); ?>

  <?php get_template_part('template-parts/service-cards', null, array(
    'slugs' => $care,
    'title' => 'Systems & Care',
    'class' => 'bg-dune py-16 lg:py-20',
    'cols'  => 'sm:grid-cols-2 lg:grid-cols-4',
  )); ?>

  <?php get_template_part('template-parts/process-steps', null, array('link' => true, 'class' => 'py-16 lg:py-20')); ?>

  <?php get_template_part('template-parts/cta-final'); ?>

</main>

<?php get_footer();
