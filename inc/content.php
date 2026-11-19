<?php
/**
 * Page content registry.
 *
 * H1, intro and CTA copy come verbatim from the Brief Estratégico v02 (sections 05–08).
 * Supporting copy (overview, highlights, FAQs) was written to fill the pages while following
 * the brief's guardrails: no license claims, no guaranteed rebates, no "zero maintenance",
 * no prices, no 3D/technical-plan promises, no arborist certification.
 * Everything marked VALIDATE must be confirmed with Silvercrest before launch.
 */

/**
 * Service pages, keyed by page slug. Rendered by page-templates/service.php.
 * Order = order in the Services dropdown and the /services/ hub.
 */
function silvercrest_services() {
  return array(

    'landscape-design' => array(
      'label'     => 'Landscape Design',
      'menu'      => 'Layouts, materials, and planting with purpose',
      'group'     => 'design',
      'icon'      => 'design',
      'h1'        => 'Landscape Design Built Around the Way You Live',
      'intro'     => 'We start with the space you have and the possibilities it holds. Thoughtful layouts, materials, and plant selections can turn an ordinary yard into an outdoor space with purpose.',
      'seo_title' => 'Landscape Design in Las Vegas & Henderson | Silvercrest',
      'seo_desc'  => 'Explore landscape design for Southern Nevada outdoor spaces. Discuss your vision with Silvercrest Outdoor Spaces.',
      'overview_title' => 'Design Is Where Every Good Outdoor Space Begins',
      'overview'  => array(
        'Before anything is installed, we look at how you want to use your property: where people gather, how they move through it, what you see from inside the home, and how the space should feel at different times of day.',
        'The design brings those answers together with materials and plants suited to the Southern Nevada desert. Whether it’s a front yard that needs a stronger first impression or a backyard ready to become a place to gather, it gives the project a clear direction before installation begins.',
      ),
      // VALIDATE: design deliverables (no renderings/3D/technical plans promised).
      'highlights' => array(
        array('title' => 'Front & Backyard Layouts',     'text' => 'Plan circulation, gathering areas, and planting zones so each part of the yard has a purpose.'),
        array('title' => 'Materials & Finishes',         'text' => 'Select pavers, rock, and hardscape materials that work together and complement your home.'),
        array('title' => 'Desert-Appropriate Planting',  'text' => 'Choose plants suited to the local climate, sun exposure, and the level of care you want.'),
        array('title' => 'Irrigation & Lighting in Mind', 'text' => 'Consider how water and light will support the design from the start, not as an afterthought.'),
      ),
      'related' => array('landscape-installation', 'desert-landscaping', 'paver-installation'),
    ),

    'landscape-installation' => array(
      'label'     => 'Landscape Installation',
      'menu'      => 'Bringing the design to life, detail by detail',
      'group'     => 'design',
      'icon'      => 'layers',
      'h1'        => 'Landscape Installation with Every Detail in Mind',
      'intro'     => 'From hardscape elements to plants, irrigation, and lighting, installation brings the design together in the real world.',
      'seo_title' => 'Landscape Installation in Las Vegas & Henderson | Silvercrest',
      'seo_desc'  => 'From hardscape to planting, irrigation and lighting, landscape installation that brings your outdoor design to life in Las Vegas and Henderson.',
      'overview_title' => 'Bringing the Design to Life',
      'overview'  => array(
        'Installation is where planning becomes something you can walk through and enjoy. We coordinate the different elements of the project, from preparation and hardscape to planting, irrigation, and lighting, so they come together as one cohesive space.',
        'Each phase is planned around the design and the conditions of your property, with attention to clean execution and a professional finish. Depending on the scope, permits or HOA approvals may apply; we’ll talk through what your project needs.',
      ),
      'highlights' => array(
        array('title' => 'Site Preparation',       'text' => 'Prepare the ground so every element that follows has a solid, well-planned base.'),
        array('title' => 'Hardscape & Pavers',     'text' => 'Install paths, patios, and edges that give the space its structure.'),
        array('title' => 'Planting & Rock',        'text' => 'Place plants, boulders, and decorative rock according to the design.'),
        array('title' => 'Irrigation & Lighting',  'text' => 'Integrate the systems that support the landscape day and night.'),
      ),
      'related' => array('landscape-design', 'paver-installation', 'irrigation-systems'),
    ),

    'desert-landscaping' => array(
      'label'     => 'Desert Landscaping & Turf Conversion',
      'menu'      => 'Xeriscape and turf conversion for the desert',
      'short'     => 'Desert Landscaping',
      'group'     => 'design',
      'icon'      => 'cactus',
      'h1'        => 'Desert Landscaping for Southern Nevada Living',
      'intro'     => 'Create an outdoor space that feels considered, looks beautiful, and responds to the realities of our desert climate.',
      'seo_title' => 'Desert Landscaping & Turf Conversion | Silvercrest',
      'seo_desc'  => 'Explore desert landscaping and water-smart design options for Las Vegas and Henderson properties.',
      'overview_title' => 'Designed for the Desert, Not Against It',
      'overview'  => array(
        'Desert landscaping, often called xeriscape, combines climate-appropriate plants, decorative rock, well-planned irrigation, and thoughtful hardscape into a yard that suits the Las Vegas environment. Done well, it’s anything but bare: texture, color, shade, and structure all play a role.',
        'If you’re thinking about replacing grass, we can walk you through the options for your property and how a conversion could fit into a complete landscape design.',
      ),
      'highlights' => array(
        array('title' => 'Turf Conversion',             'text' => 'Replace grass with a planned landscape that still feels inviting and complete.'),
        array('title' => 'Climate-Appropriate Plants',  'text' => 'Select plants that handle desert heat and sun while adding color and texture.'),
        array('title' => 'Rock, Boulders & Texture',    'text' => 'Use natural materials to add depth, contrast, and structure to the yard.'),
        array('title' => 'Irrigation Planned for It',   'text' => 'Match the irrigation to a low-water planting plan instead of a lawn.'),
      ),
      'snwa'    => 'full',
      // AEO questions from the brief (section 10). Generic, educational answers — VALIDATE wording.
      'faqs'    => array(
        array(
          'q' => 'How does desert landscaping work?',
          'a' => 'Desert landscaping groups plants that are suited to the local climate, uses rock and hardscape to add structure, and pairs everything with irrigation planned for those plants. The result is a landscape designed around the conditions of Southern Nevada rather than one that fights them.',
        ),
        array(
          'q' => 'What should I know before removing grass?',
          'a' => 'Think about how you use the space today and how you want to use it after the conversion, how the new layout will connect with the rest of the yard, and whether any HOA guidelines apply. If you’re interested in water-saving incentives, review the program requirements before any work begins, as some programs have conditions that must be met in advance.',
        ),
      ),
      'related' => array('landscape-design', 'landscape-installation', 'artificial-turf'),
    ),

    'paver-installation' => array(
      'label'     => 'Paver Installation',
      'menu'      => 'Paths, patios, and gathering areas',
      'short'     => 'Pavers & Hardscaping',
      'group'     => 'design',
      'icon'      => 'pavers',
      'h1'        => 'Paver Installation That Defines the Space',
      'intro'     => 'Paths, patios, and gathering areas add structure and function to the way an outdoor space is used.',
      'seo_title' => 'Paver Installation in Las Vegas & Henderson | Silvercrest',
      'seo_desc'  => 'Discover paver installation and hardscaping options that bring structure and function to outdoor spaces.',
      'overview_title' => 'Structure, Function, and Finish',
      'overview'  => array(
        'Pavers shape how a space is used: where you walk, where you gather, and how different areas of the yard connect. We look at layout, pattern, color, and edging so the hardscape feels like part of the overall design rather than an add-on.',
        'Careful base preparation and attention to the edges and transitions are what make a paver installation look right and hold up over time.',
      ),
      // VALIDATE: NSCB license/classification before offering walls or specific structures.
      'highlights' => array(
        array('title' => 'Paths & Walkways',          'text' => 'Create clear, comfortable routes through the yard and to the home.'),
        array('title' => 'Patios & Gathering Areas',  'text' => 'Define places to sit, dine, and spend time outdoors.'),
        array('title' => 'Pattern, Color & Texture',  'text' => 'Choose a paver style that complements the architecture and the landscape.'),
        array('title' => 'Edges & Transitions',       'text' => 'Finish the details where pavers meet planting, rock, and turf.'),
      ),
      'related' => array('landscape-design', 'landscape-installation', 'landscape-lighting'),
    ),

    'artificial-turf' => array(
      'label'     => 'Artificial Turf',
      'menu'      => 'Turf planned as part of the whole yard',
      'group'     => 'design',
      'icon'      => 'turf',
      'h1'        => 'Artificial Turf with a Thoughtful Landscape Plan',
      'intro'     => 'Artificial turf can be one element of a complete outdoor design. We consider how it connects with planting, paving, and drainage.',
      'seo_title' => 'Artificial Turf Installation in Las Vegas & Henderson | Silvercrest',
      'seo_desc'  => 'Artificial turf planned as part of a complete outdoor design, with attention to layout, drainage, and how it connects with the rest of your yard.',
      'overview_title' => 'Turf as Part of the Bigger Picture',
      'overview'  => array(
        'Artificial turf works best when it’s planned as part of the whole yard: where it sits relative to planting beds, pavers, and shade, and how water drains through and around it.',
        'We consider how the area will be used, whether for kids, pets, or as a clean green accent, and how it transitions into the rest of the space.',
      ),
      'highlights' => array(
        array('title' => 'Layout & Transitions', 'text' => 'Size and shape the turf area so it fits naturally within the overall design.'),
        array('title' => 'Base & Drainage',      'text' => 'Prepare the base with drainage in mind so the area performs as intended.'),
        array('title' => 'Planned for Use',      'text' => 'Choose a turf approach based on how the space will actually be used.'),
      ),
      'snwa'    => 'turf',
      'related' => array('desert-landscaping', 'landscape-design', 'paver-installation'),
    ),

    'irrigation-systems' => array(
      'label'     => 'Irrigation Systems',
      'menu'      => 'Water planned around the landscape',
      'group'     => 'care',
      'icon'      => 'droplet',
      'h1'        => 'Irrigation Planned for the Landscape',
      'intro'     => 'A well-planned irrigation system supports the plants, layout, and long-term care of an outdoor space.',
      'seo_title' => 'Irrigation Systems in Las Vegas & Henderson | Silvercrest',
      'seo_desc'  => 'Irrigation systems planned around your landscape, supporting plants, layout, and long-term care for Southern Nevada outdoor spaces.',
      'overview_title' => 'Water Where It’s Needed',
      'overview'  => array(
        'An irrigation system should be designed around the landscape it serves: the types of plants, their sun exposure, and how they’re grouped. Planning zones and coverage carefully helps plants establish and keeps the landscape healthy as it matures.',
        'For new landscapes and conversions, irrigation is planned alongside the design so the system fits the layout from day one.',
      ),
      // VALIDATE: only describe drip irrigation if Silvercrest installs it; no water-savings figures.
      'highlights' => array(
        array('title' => 'Zone Planning',          'text' => 'Group plants with similar needs so each zone can be watered appropriately.'),
        array('title' => 'Planned with the Design', 'text' => 'Lay out lines and components to match the planting and hardscape plan.'),
        array('title' => 'System Installation',     'text' => 'Install the system with care so it supports the landscape for the long term.'),
      ),
      'related' => array('desert-landscaping', 'landscape-installation', 'landscape-design'),
    ),

    'landscape-lighting' => array(
      'label'     => 'Landscape Lighting',
      'menu'      => 'Paths and gathering spaces after sunset',
      'group'     => 'care',
      'icon'      => 'lamp',
      'h1'        => 'Landscape Lighting that Changes the Experience',
      'intro'     => 'Lighting brings a new perspective to pathways, planting, and outdoor gathering spaces after sunset.',
      'seo_title' => 'Landscape Lighting in Las Vegas & Henderson | Silvercrest',
      'seo_desc'  => 'Landscape lighting for pathways, planting, and gathering spaces, planned as part of your outdoor design in Las Vegas and Henderson.',
      'overview_title' => 'Your Outdoor Space, After Sunset',
      'overview'  => array(
        'In the desert, evenings are often the best time to be outside. Landscape lighting extends how you use the space, guiding the way along paths, highlighting trees and planting, and creating a comfortable atmosphere where people gather.',
        'We plan placement and light levels as part of the overall design so the result feels balanced, not overlit.',
      ),
      'highlights' => array(
        array('title' => 'Paths & Steps',          'text' => 'Light the way through the yard for comfort and safety.'),
        array('title' => 'Accent & Feature Lighting', 'text' => 'Highlight trees, plants, and architectural details.'),
        array('title' => 'Gathering Areas',        'text' => 'Create a warm, usable atmosphere on patios and seating areas.'),
      ),
      'related' => array('landscape-design', 'paver-installation', 'landscape-installation'),
    ),

    'tree-palm-services' => array(
      'label'     => 'Tree & Palm Services',
      'menu'      => 'Planting and care for trees and palms',
      'group'     => 'care',
      'icon'      => 'palm',
      'h1'        => 'Tree & Palm Services for Southern Nevada Properties',
      'intro'     => 'Trees and palms shape the character of a landscape and require care suited to their environment.',
      'seo_title' => 'Tree & Palm Services in Las Vegas & Henderson | Silvercrest',
      'seo_desc'  => 'Tree and palm planting and care suited to the Southern Nevada environment, for homes in Las Vegas and Henderson.',
      'overview_title' => 'Care Suited to the Desert',
      'overview'  => array(
        'Trees and palms provide shade, height, and structure in a desert landscape. Choosing the right species and placement, and caring for them properly over time, helps them contribute to the space for years.',
        'We’ll confirm what your trees and palms need during the consultation.',
      ),
      // VALIDATE: confirm scope (planting vs. pruning vs. ongoing care). No arborist certification claims.
      'highlights' => array(
        array('title' => 'Planting',            'text' => 'Select and place trees and palms as part of a new or updated landscape.'),
        array('title' => 'Pruning & Trimming',  'text' => 'Keep trees and palms shaped, healthy, and in proportion with the space.'),
        array('title' => 'Ongoing Care',        'text' => 'Support long-term health with care suited to the desert climate.'),
      ),
      'related' => array('landscape-maintenance', 'landscape-design', 'landscape-installation'),
    ),

    'landscape-maintenance' => array(
      'label'     => 'Landscape Maintenance',
      'menu'      => 'Care that keeps the design intact',
      'group'     => 'care',
      'icon'      => 'calendar',
      'h1'        => 'Landscape Maintenance that Protects Your Investment',
      'intro'     => 'Keep your landscape looking cared for as it matures and changes through the seasons.',
      'seo_title' => 'Landscape Maintenance in Las Vegas & Henderson | Silvercrest',
      'seo_desc'  => 'Landscape maintenance that keeps your outdoor space looking cared for as it matures, for properties in Las Vegas and Henderson.',
      'overview_title' => 'Care That Keeps the Design Intact',
      'overview'  => array(
        'A landscape keeps changing after installation. Regular care keeps plants healthy, hardscape clean, and systems working as intended, so the space continues to look the way it was designed.',
      ),
      // No public pricing (the $160 figure is an internal average, not a rate).
      'highlights' => array(
        array('title' => 'Routine Care',        'text' => 'Keep planting areas, rock, and hardscape tidy and well kept.'),
        array('title' => 'Seasonal Attention',  'text' => 'Adjust care as the landscape moves through the desert seasons.'),
        array('title' => 'Irrigation Checks',   'text' => 'Keep an eye on the system so plants get the water they need.'),
      ),
      'related' => array('tree-palm-services', 'irrigation-systems', 'landscape-design'),
    ),
  );
}

/**
 * Process steps. PROPOSED copy from the brief — VALIDATE stages, design scope,
 * HOA approvals, payments and timing with Silvercrest.
 */
function silvercrest_process_steps() {
  return array(
    array(
      'title'  => 'Tell us about your space',
      'text'   => 'Share your ideas, goals, and how you want to use your outdoor area.',
      'detail' => 'It starts with a conversation. We’ll learn about your property, what you like and don’t like about the space today, how you want to use it, and any guidelines your HOA may have.',
    ),
    array(
      'title'  => 'Review the design direction',
      'text'   => 'We’ll develop a design approach with the right materials, layout, and solutions for the desert climate.',
      'detail' => 'Together we’ll review a design direction for the space: layout, materials, planting, and how irrigation and lighting fit in. This is the moment to refine ideas before anything is built.',
    ),
    array(
      'title'  => 'Plan the installation',
      'text'   => 'Once the design is approved, we’ll prepare a clear plan and timeline for your project.',
      'detail' => 'With the design approved, we’ll outline the scope and sequence of the work so you know what to expect before installation begins.',
    ),
    array(
      'title'  => 'See the space come together',
      'text'   => 'Our team handles the installation with attention to detail, quality, and a clean, professional finish.',
      'detail' => 'Our team carries out the installation, keeping the work organized and the details consistent with the design, through to a clean, professional finish.',
    ),
  );
}

/**
 * City landing pages (brief, section 08). Each one must keep UNIQUE copy — don't clone and swap the city name.
 */
function silvercrest_locations() {
  return array(

    'las-vegas-landscaping' => array(
      'city'      => 'Las Vegas',
      'h1'        => 'Landscape Design & Installation in Las Vegas',
      'intro'     => 'Based in Las Vegas, Silvercrest Outdoor Spaces designs and installs outdoor spaces made for the realities of the Mojave Desert: intense summer heat, very little rain, and evenings made for being outside.',
      'seo_title' => 'Landscape Design & Installation in Las Vegas | Silvercrest',
      'seo_desc'  => 'Landscape design, installation, desert landscaping, pavers and turf for Las Vegas homes. Request a consultation with Silvercrest Outdoor Spaces.',
      'section_title' => 'Landscaping for Las Vegas Homes',
      'section'   => array(
        'From established neighborhoods to newer developments, Las Vegas yards come in every shape and stage. Some need a complete redesign; others are builder-grade backyards waiting to be finished with a plan.',
        'We work with the space you have, the way you want to use it, and the desert conditions it has to handle, bringing design, hardscape, planting, irrigation, and lighting together into one cohesive result.',
      ),
      'services'  => array('landscape-design', 'desert-landscaping', 'paver-installation', 'artificial-turf', 'landscape-lighting'),
      'faqs'      => array(
        array(
          'q' => 'Do you work throughout Las Vegas?',
          'a' => 'We serve properties across Las Vegas. Share your project location when you contact us and we’ll confirm availability for your area.',
        ),
        array(
          'q' => 'What kind of landscaping works best in Las Vegas?',
          'a' => 'Landscapes that respond to the climate tend to perform best: plants suited to heat and sun, irrigation planned around them, and hardscape and shade that make the space comfortable to use. The right mix depends on your property and how you want to use it.',
        ),
      ),
    ),

    'henderson-landscaping' => array(
      'city'      => 'Henderson',
      'h1'        => 'Landscape Design & Installation in Henderson',
      'intro'     => 'Outdoor spaces in Henderson deserve the same care as the homes they surround. We design and install landscapes that feel cohesive, comfortable, and suited to the desert.',
      'seo_title' => 'Landscape Design & Installation in Henderson | Silvercrest',
      'seo_desc'  => 'Thoughtful landscape design and installation for Henderson homes, from backyard transformations to desert landscaping and pavers.',
      'section_title' => 'Outdoor Spaces That Fit the Home and the Community',
      'section'   => array(
        'Many Henderson homes are part of planned communities with their own landscape guidelines, so it pays to consider those requirements early in the design rather than after the fact.',
        'Whether you’re finishing the backyard of a newer home or rethinking an older landscape, we focus on layouts, materials, and planting that work with the architecture and the way your household lives outdoors.',
      ),
      'services'  => array('landscape-design', 'landscape-installation', 'desert-landscaping', 'paver-installation', 'landscape-lighting'),
      'faqs'      => array(
        array(
          'q' => 'Do you work in Henderson?',
          'a' => 'Yes. We serve homeowners throughout Henderson. Tell us where your project is located when you reach out and we’ll confirm the details.',
        ),
        array(
          'q' => 'Do I need HOA approval for landscape changes in Henderson?',
          'a' => 'Many communities require it, and requirements vary by HOA. We recommend checking your community’s guidelines early; we can talk through how they may affect your design during the consultation.',
        ),
      ),
    ),
  );
}

/**
 * Home FAQs. Includes the AEO questions from the brief (section 10).
 * Guardrails: no guaranteed rebates, no license claims, no promised timelines. VALIDATE wording.
 */
function silvercrest_home_faqs() {
  $desert = silvercrest_services()['desert-landscaping']['faqs'];

  return array(
    array(
      'q' => 'What areas do you serve?',
      'a' => 'We work with homeowners in Las Vegas and Henderson, Nevada. If you’re not sure whether your property is in our area, share your project location when you contact us and we’ll confirm availability.',
    ),
    array(
      'q' => 'How is a landscape project planned?',
      'a' => 'It starts with understanding your property and how you want to use it. From there, a design direction brings together layout, materials, planting, irrigation, and lighting. Once the design is approved, the installation is planned in sequence so each element is built in the right order.',
    ),
    $desert[0], // How does desert landscaping work?
    $desert[1], // What should I know before removing grass?
    array(
      'q' => 'Are there incentives for replacing grass?',
      'a' => 'Some landscape conversions may qualify for local water-saving incentives. Eligibility and program requirements vary, and some must be met before any work begins. We can discuss available options during your consultation.',
    ),
    array(
      'q' => 'Do I need HOA approval for landscape changes?',
      'a' => 'Many communities in Las Vegas and Henderson have landscape guidelines, and requirements vary by HOA. It’s best to review them early; we can talk through how they may affect your design.',
    ),
    array(
      'q' => 'Can I start with just one part of the yard?',
      'a' => 'Yes. Some projects cover the entire property, while others focus on a front yard, a backyard, or a single feature like a patio or lighting. A clear design helps future phases connect with what’s built first.',
    ),
    array(
      'q' => 'How do I get started?',
      'a' => 'Request a consultation using the form on this page or call us at ' . SILVERCREST_PHONE . '. Tell us a little about your space and what you have in mind, and our team will be in touch.',
    ),
  );
}

/**
 * SEO title + meta description for pages that aren't in the registries above.
 */
function silvercrest_page_seo() {
  return array(
    'services'      => array('Landscape Services in Las Vegas & Henderson | Silvercrest', 'Landscape design, installation, desert landscaping, pavers, turf, irrigation, lighting and care for Southern Nevada outdoor spaces.'),
    'about'         => array('About Silvercrest Outdoor Spaces | Las Vegas Landscape Design', 'Silvercrest Outdoor Spaces designs and installs outdoor spaces in Las Vegas and Henderson. Learn about our story and the way we work.'),
    'our-process'   => array('Our Process | Silvercrest Outdoor Spaces', 'From the first conversation to the finished landscape: how a landscape project is planned and built with Silvercrest Outdoor Spaces.'),
    'service-areas' => array('Service Areas: Las Vegas & Henderson | Silvercrest', 'Landscape design and installation across Las Vegas and Henderson, Nevada. See the areas Silvercrest Outdoor Spaces serves.'),
    'contact'       => array('Contact Us | Request a Consultation | Silvercrest', 'Request a consultation for your landscape project in Las Vegas or Henderson. Call +1 (702) 812-0784 or send us your project details.'),
    'hoa-landscape-conversion' => array('HOA & Commercial Landscape Conversion | Silvercrest', 'Landscape conversion planning for HOAs and property managers in Las Vegas and Henderson: phased budgets, clear timelines and compliance-minded design.'),
  );
}
