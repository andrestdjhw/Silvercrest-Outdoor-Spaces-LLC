import React from "react"
import Logo from "./Logo"
import { MapPinIcon, PhoneIcon } from "./Icons"
import { footerNav } from "../data/navigation"
import { site, url } from "../data/site"

export default function Footer() {
  return (
    <footer className="overflow-hidden bg-rust-dark text-cream">
      <div className="container-site flex flex-col gap-8 py-10 lg:flex-row lg:items-center lg:justify-between">
        <a href={url("/")} aria-label={`${site.name} — Home`} className="self-start lg:self-auto">
          <Logo variant="light" />
        </a>

        <div className="flex flex-col gap-5 text-sm sm:flex-row sm:gap-10">
          <p className="flex items-start gap-3">
            <MapPinIcon className="mt-0.5 h-5 w-5 shrink-0 text-peach" />
            <span>
              {site.serviceArea}
              <br />
              <span className="text-cream/70">{site.serviceAreaNote}</span>
            </span>
          </p>
          <a href={site.phoneHref} className="flex items-center gap-3 transition-colors hover:text-peach">
            <PhoneIcon className="h-5 w-5 shrink-0 text-peach" />
            {site.phone}
          </a>
        </div>

        <nav aria-label="Footer">
          <ul className="flex flex-wrap gap-x-6 gap-y-2 text-sm">
            {footerNav.map(item => (
              <li key={item.path}>
                <a href={url(item.path)} className="text-cream/85 transition-colors hover:text-peach">
                  {item.label}
                </a>
              </li>
            ))}
          </ul>
        </nav>
      </div>

      {/* Oversized wordmark that slides sideways with scroll (data-giant → motion.js) */}
      <div className="pointer-events-none select-none overflow-hidden" aria-hidden="true">
        <p data-giant className="whitespace-nowrap pb-4 font-display text-[22vw] font-semibold leading-[0.8] text-cream/[0.07] [font-variation-settings:'wdth'_62]">
          SILVERCREST · OUTDOOR SPACES · SILVERCREST
        </p>
      </div>

      {/* Extra bottom padding on mobile so the sticky CTA bar doesn't cover this row */}
      <div className="border-t border-cream/10">
        <p className="container-site pb-24 pt-5 text-xs text-cream/60 lg:pb-5">
          © {new Date().getFullYear()} {site.legalName}. All rights reserved.
        </p>
      </div>
    </footer>
  )
}
