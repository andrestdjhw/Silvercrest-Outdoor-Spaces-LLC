// Slugs follow the brief's recommended architecture (section 04).

// Services come from PHP (silvercrest_services() → silvercrestData.services) so the menu
// always matches the service pages. The static list is only a fallback.
const fromPhp = (window.silvercrestData && window.silvercrestData.services) || []

export const services = fromPhp.length
  ? fromPhp
  : [
      { label: "Landscape Design", path: "/landscape-design/", group: "design" },
      { label: "Landscape Installation", path: "/landscape-installation/", group: "design" },
      { label: "Desert Landscaping & Turf Conversion", path: "/desert-landscaping/", group: "design" },
      { label: "Paver Installation", path: "/paver-installation/", group: "design" },
      { label: "Artificial Turf", path: "/artificial-turf/", group: "design" },
      { label: "Irrigation Systems", path: "/irrigation-systems/", group: "care" },
      { label: "Landscape Lighting", path: "/landscape-lighting/", group: "care" },
      { label: "Tree & Palm Services", path: "/tree-palm-services/", group: "care" },
      { label: "Landscape Maintenance", path: "/landscape-maintenance/", group: "care" }
    ]

export const serviceGroups = [
  { key: "design", title: "Design & Installation" },
  { key: "care", title: "Systems & Care" }
]

export const mainNav = [
  { label: "Home", path: "/" },
  { label: "Landscape Design", path: "/landscape-design/" },
  { label: "Services", path: "/services/", children: services },
  { label: "Projects", path: "/projects/" },
  { label: "Service Areas", path: "/service-areas/" },
  { label: "About", path: "/about/" },
  { label: "Contact", path: "/contact/" }
]

export const cta = { label: "Request a Consultation", path: "/contact/" }
