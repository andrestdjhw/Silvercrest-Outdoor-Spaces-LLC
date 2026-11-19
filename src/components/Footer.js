import React from "react"
import Logo from "./Logo"
import { ArrowRight, ArrowUp, MailIcon, MapPinIcon, PhoneIcon } from "./Icons"
import { services } from "../data/navigation"
import { socials } from "../data/socials"
import { site, url } from "../data/site"

const companyLinks = [
  { label: "About", path: "/about/" },
  { label: "Our Process", path: "/our-process/" },
  { label: "Projects", path: "/projects/" },
  { label: "Service Areas", path: "/service-areas/" },
  { label: "Contact", path: "/contact/" }
]

const privacyUrl = (window.silvercrestData && window.silvercrestData.form && window.silvercrestData.form.privacyUrl) || ""

const scrollToTop = () => {
  if (window.silvercrestLenis) window.silvercrestLenis.scrollTo(0, { duration: 1.6 })
  else window.scrollTo({ top: 0, behavior: "smooth" })
}

function ColumnTitle({ children }) {
  return <h2 className="font-wide text-[11px] font-medium uppercase tracking-[0.18em] text-peach">{children}</h2>
}

function FooterLink({ href, children }) {
  return (
    <a href={href} className="group inline-flex items-center text-sm text-cream/75 transition-colors hover:text-cream">
      {/* Copper dash slides in on hover; takes no space otherwise */}
      <span className="mr-0 h-px w-0 bg-copper transition-all duration-300 group-hover:mr-2 group-hover:w-3" aria-hidden="true" />
      {children}
    </a>
  )
}

export default function Footer() {
  return (
    <footer className="relative isolate overflow-hidden bg-night text-cream">
      {/* Isotype strata as a quiet background (brand graphic resource 01) */}
      <svg className="pointer-events-none absolute -bottom-6 -right-10 -z-10 h-64 w-[44rem] text-cream/[0.04]" viewBox="0 0 100 34" fill="currentColor" aria-hidden="true">
        <path d="M0 0h100v14.5H0zM0 17.5h100v3.6H0zM0 24h100v3H0zM0 29.8h100v2.4H0zM0 33h100v1H0z" clipPath="url(#footer-iso)" />
        <clipPath id="footer-iso"><path d="M4 34C14 21 24 4.5 39 3c8-.8 13 4.5 17 7 4-3.2 8-4.6 13-4 12 1.6 20 15 27 28z M0 33h100v1H0z" /></clipPath>
      </svg>
      <div className="container-site grid grid-cols-2 gap-x-6 gap-y-12 pb-14 pt-16 lg:grid-cols-12 lg:gap-10 lg:pt-20">
        {/* Brand */}
        <div className="col-span-2 lg:col-span-4">
          <a href={url("/")} aria-label={`${site.name} — Home`} className="inline-block">
            <Logo variant="light" />
          </a>
          <p className="mt-6 max-w-xs text-sm leading-relaxed text-cream/70">
            We design, build and care for outdoor spaces made for desert living, so you can use your yard in July, not just in March.
          </p>
          <p className="mt-4 font-wide text-[11px] font-medium uppercase tracking-[0.2em] text-peach">Design · Build · Care</p>
          {socials.length > 0 && (
            <ul className="mt-6 flex items-center gap-2">
              {socials.map(({ key, href, label, Icon }) => (
                <li key={key}>
                  <a
                    href={href}
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label={label}
                    className="flex h-9 w-9 items-center justify-center rounded-full border border-cream/15 text-cream/80 transition-colors hover:border-copper hover:bg-copper hover:text-ink"
                  >
                    <Icon className="h-4 w-4" />
                  </a>
                </li>
              ))}
            </ul>
          )}
        </div>

        {/* Services */}
        <nav aria-label="Services" className="lg:col-span-3">
          <ColumnTitle>Services</ColumnTitle>
          <ul className="mt-5 space-y-2.5">
            {services.map(item => (
              <li key={item.path}>
                <FooterLink href={url(item.path)}>{item.label}</FooterLink>
              </li>
            ))}
          </ul>
        </nav>

        {/* Company */}
        <nav aria-label="Company" className="lg:col-span-2">
          <ColumnTitle>Company</ColumnTitle>
          <ul className="mt-5 space-y-2.5">
            {companyLinks.map(item => (
              <li key={item.path}>
                <FooterLink href={url(item.path)}>{item.label}</FooterLink>
              </li>
            ))}
          </ul>
        </nav>

        {/* Contact */}
        <div className="col-span-2 lg:col-span-3">
          <ColumnTitle>Get in Touch</ColumnTitle>
          <ul className="mt-5 space-y-4 text-sm">
            <li>
              <a href={site.phoneHref} className="group flex items-center gap-3">
                <PhoneIcon className="h-4 w-4 shrink-0 text-copper" />
                <span className="font-display text-xl font-semibold tracking-wide transition-colors group-hover:text-peach">{site.phone}</span>
              </a>
            </li>
            {site.email && (
              <li>
                <a href={`mailto:${site.email}`} className="flex items-center gap-3 break-all text-cream/75 transition-colors hover:text-cream">
                  <MailIcon className="h-4 w-4 shrink-0 text-copper" />
                  {site.email}
                </a>
              </li>
            )}
            <li className="flex items-start gap-3 text-cream/75">
              <MapPinIcon className="mt-0.5 h-4 w-4 shrink-0 text-copper" />
              <span>
                {site.serviceArea}
                <span className="block text-cream/50">{site.serviceAreaNote}</span>
              </span>
            </li>
          </ul>
          <a href={url("/contact/")} className="btn btn-light mt-7 px-5 py-2.5">
            Request a Consultation <ArrowRight className="h-4 w-4" />
          </a>
        </div>
      </div>

      {/* Bottom bar — extra bottom padding on mobile so the sticky CTA bar doesn't cover it */}
      <div className="border-t border-cream/10">
        <div className="container-site flex flex-col gap-4 pb-24 pt-6 text-xs text-cream/55 sm:flex-row sm:items-center sm:justify-between lg:pb-6">
          <p>
            © {new Date().getFullYear()} {site.legalName}. All rights reserved.
            <span className="mt-1 block sm:ml-2 sm:mt-0 sm:inline">Formerly Mendoza Lawn Services LLC. Se habla español.</span>
          </p>
          <div className="flex items-center gap-6">
            {privacyUrl && (
              <a href={privacyUrl} className="transition-colors hover:text-cream">
                Privacy Policy
              </a>
            )}
            <button type="button" onClick={scrollToTop} className="group inline-flex items-center gap-2 font-wide uppercase tracking-[0.14em] transition-colors hover:text-cream">
              Back to top
              <span className="flex h-8 w-8 items-center justify-center rounded-full border border-cream/20 transition-colors group-hover:border-copper group-hover:bg-copper group-hover:text-ink">
                <ArrowUp className="h-3.5 w-3.5" />
              </span>
            </button>
          </div>
        </div>
      </div>
    </footer>
  )
}
