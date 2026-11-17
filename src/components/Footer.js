import React from "react"
import Logo from "./Logo"
import { MapPinIcon, PhoneIcon } from "./Icons"
import { footerNav } from "../data/navigation"
import { site, url } from "../data/site"

export default function Footer() {
  return (
    <footer className="bg-forest-dark text-cream">
      <div className="mx-auto flex max-w-7xl flex-col gap-8 px-4 py-10 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
        <a href={url("/")} aria-label={`${site.name} — Home`} className="self-start lg:self-auto">
          <Logo variant="light" />
        </a>

        <div className="flex flex-col gap-5 text-sm sm:flex-row sm:gap-10">
          <p className="flex items-start gap-3">
            <MapPinIcon className="mt-0.5 h-5 w-5 shrink-0 text-sand" />
            <span>
              {site.serviceArea}
              <br />
              <span className="text-cream/70">{site.serviceAreaNote}</span>
            </span>
          </p>
          <a href={site.phoneHref} className="flex items-center gap-3 transition-colors hover:text-sand">
            <PhoneIcon className="h-5 w-5 shrink-0 text-sand" />
            {site.phone}
          </a>
        </div>

        <nav aria-label="Footer">
          <ul className="flex flex-wrap gap-x-6 gap-y-2 text-sm">
            {footerNav.map(item => (
              <li key={item.path}>
                <a href={url(item.path)} className="text-cream/85 transition-colors hover:text-sand">
                  {item.label}
                </a>
              </li>
            ))}
          </ul>
        </nav>
      </div>

      {/* Extra bottom padding on mobile so the sticky CTA bar doesn't cover this row */}
      <div className="border-t border-cream/10">
        <p className="mx-auto max-w-7xl px-4 pb-24 pt-5 text-xs text-cream/60 sm:px-6 lg:px-8 lg:pb-5">
          © {new Date().getFullYear()} {site.legalName}. All rights reserved.
        </p>
      </div>
    </footer>
  )
}
