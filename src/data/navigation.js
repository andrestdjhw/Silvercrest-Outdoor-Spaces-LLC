// Slugs follow the brief's recommended architecture (section 04).

export const services = [
  { label: "Landscape Installation", path: "/landscape-installation/" },
  { label: "Desert Landscaping & Turf Conversion", path: "/desert-landscaping/" },
  { label: "Paver Installation", path: "/paver-installation/" },
  { label: "Artificial Turf", path: "/artificial-turf/" },
  { label: "Irrigation Systems", path: "/irrigation-systems/" },
  { label: "Landscape Lighting", path: "/landscape-lighting/" },
  { label: "Tree & Palm Services", path: "/tree-palm-services/" },
  { label: "Landscape Maintenance", path: "/landscape-maintenance/" }
]

export const mainNav = [
  { label: "Home", path: "/" },
  { label: "Landscape Design", path: "/landscape-design/" },
  { label: "Services", children: services },
  { label: "Projects", path: "/projects/" },
  { label: "Service Areas", path: "/service-areas/" },
  { label: "About", path: "/about/" },
  { label: "Contact", path: "/contact/" }
]

export const footerNav = [
  { label: "Home", path: "/" },
  { label: "Services", path: "/services/" },
  { label: "Projects", path: "/projects/" },
  { label: "About", path: "/about/" },
  { label: "Contact", path: "/contact/" }
]

export const cta = { label: "Request a Consultation", path: "/contact/" }
