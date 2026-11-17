// Values passed from PHP via wp_localize_script (functions.php).
const data = window.silvercrestData || {}
const homeUrl = (data.homeUrl || "/").replace(/\/$/, "")

export const site = {
  name: "Silvercrest Outdoor Spaces",
  legalName: "Silvercrest Outdoor Spaces LLC",
  phone: data.phone || "+1 (702) 812-0784",
  phoneHref: data.phoneHref || "tel:+17028120784",
  email: data.email || "",
  serviceArea: data.location || "Las Vegas & Henderson, NV",
  serviceAreaNote: "(and surrounding areas)",
  socials: data.socials || {}
}

/** Absolute URL for an internal path, e.g. url("/contact/"). */
export const url = (path = "/") => homeUrl + path

const normalize = pathname => pathname.replace(/\/+$/, "") || "/"

/** True when the given internal path is the page being viewed. */
export const isCurrent = path => normalize(new URL(url(path), window.location.origin).pathname) === normalize(window.location.pathname)
