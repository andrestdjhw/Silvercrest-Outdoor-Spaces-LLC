<?php
/**
 * Contact — /contact/
 * The form is a React component (src/components/ContactForm.js) mounted on [data-react="contact-form"].
 * Brief, section 09: Name, Phone, Email, Project Location/ZIP, Interested Service, Project Notes,
 * contact consent; optional project type + timing; no required budget; no "24h" promise.
 */

get_header(); ?>

<main id="main">

  <?php get_template_part('template-parts/page-hero', null, array(
    'title'       => 'Let’s Talk About Your Outdoor Space',
    'intro'       => 'Whether you’re starting with a design idea or ready to build, tell us a little about your project and we’ll be in touch.',
    'image'       => 'contact/contact-hero',
    'alt'         => 'Patio and desert landscape at dusk',
    'breadcrumbs' => array(array('Contact', '/contact/')),
    'cta'         => false,
  )); ?>

  <section class="py-16 lg:py-24">
    <div class="container-site grid gap-12 lg:grid-cols-12 lg:gap-16">

      <!-- Contact details -->
      <aside class="lg:col-span-4">
        <?php silvercrest_section_title('Get in Touch'); ?>
        <ul class="mt-8 space-y-6">
          <li>
            <a href="<?php echo esc_attr(SILVERCREST_PHONE_HREF); ?>" class="group flex items-start gap-4">
              <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-sand text-rust"><?php silvercrest_icon('phone', 'h-5 w-5'); ?></span>
              <span>
                <span class="block text-xs font-medium font-wide uppercase tracking-wide text-copper-dark">Call</span>
                <span class="mt-1 block font-semibold text-ink group-hover:text-rust"><?php echo esc_html(SILVERCREST_PHONE); ?></span>
              </span>
            </a>
          </li>
          <?php if (SILVERCREST_EMAIL) : ?>
            <li>
              <a href="mailto:<?php echo esc_attr(SILVERCREST_EMAIL); ?>" class="group flex items-start gap-4">
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-sand text-rust"><?php silvercrest_icon('mail', 'h-5 w-5'); ?></span>
                <span>
                  <span class="block text-xs font-medium font-wide uppercase tracking-wide text-copper-dark">Email</span>
                  <span class="mt-1 block break-all font-semibold text-ink group-hover:text-rust"><?php echo esc_html(SILVERCREST_EMAIL); ?></span>
                </span>
              </a>
            </li>
          <?php endif; ?>
          <li class="flex items-start gap-4">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-sand text-rust"><?php silvercrest_icon('map-pin', 'h-5 w-5'); ?></span>
            <span>
              <span class="block text-xs font-medium font-wide uppercase tracking-wide text-copper-dark">Service Area</span>
              <span class="mt-1 block font-semibold text-ink"><?php echo esc_html(SILVERCREST_LOCATION); ?></span>
              <a href="<?php echo silvercrest_url('/service-areas/'); ?>" class="mt-1 inline-block text-sm text-rust hover:underline">See service areas</a>
            </span>
          </li>
        </ul>

        <div class="mt-10 rounded-md bg-sand/50 p-6">
          <h3 class="font-display text-xl font-semibold text-ink">What happens next?</h3>
          <p class="mt-2 text-sm leading-relaxed text-ink/80">
            Once we receive your request, our team will reach out to learn more about your space and talk through the next steps.
          </p>
        </div>
      </aside>

      <!-- Form (React) -->
      <div class="lg:col-span-8">
        <div class="rounded-md border border-sand bg-white p-6 shadow-sm sm:p-10">
          <h2 class="font-display text-3xl font-semibold text-ink">Request a Consultation</h2>
          <div data-react="contact-form" data-variant="full" class="mt-6">
            <!-- Fallback until the React form mounts -->
            <p class="text-ink/75">
              Call us at <a href="<?php echo esc_attr(SILVERCREST_PHONE_HREF); ?>" class="font-semibold text-rust"><?php echo esc_html(SILVERCREST_PHONE); ?></a> to discuss your project.
            </p>
          </div>
        </div>
      </div>

    </div>
  </section>

</main>

<?php get_footer();
