import React from "react"
import { MailIcon, MapPinIcon, PhoneIcon } from "./Icons"
import { site } from "../data/site"
import { socials } from "../data/socials"

export default function Topbar({ visible = true }) {
  return (
    // Fixed height: hiding is done by translating the whole header (Navbar), never by resizing,
    // so the page layout doesn't shift while scrolling.
    <div className="hidden bg-linear-to-r from-rust-dark via-rust to-rust-dark text-cream md:block" aria-hidden={!visible}>
        <div className={`container-site grid h-9 grid-cols-3 items-center gap-4 text-xs transition-opacity duration-300 ${visible ? "opacity-100" : "opacity-0"}`}>
          {/* Left: email + phone */}
          <div className="flex items-center gap-5">
            {site.email && (
              <a href={`mailto:${site.email}`} tabIndex={visible ? undefined : -1} className="flex items-center gap-2 whitespace-nowrap transition-colors hover:text-peach">
                <MailIcon className="h-3.5 w-3.5 text-peach" />
                <span className="hidden lg:inline">{site.email}</span>
                <span className="lg:hidden">Email</span>
              </a>
            )}
            <a href={site.phoneHref} tabIndex={visible ? undefined : -1} className="flex items-center gap-2 whitespace-nowrap transition-colors hover:text-peach">
              <PhoneIcon className="h-3.5 w-3.5 text-peach" />
              {site.phone}
            </a>
          </div>

          {/* Center: location */}
          <p className="flex items-center justify-center gap-2 whitespace-nowrap">
            <MapPinIcon className="h-3.5 w-3.5 text-peach" />
            {site.serviceArea}
            <span className="hidden text-cream/60 lg:inline">· Se habla español</span>
          </p>

          {/* Right: social */}
          <ul className="flex items-center justify-end gap-3">
            {socials.map(({ key, href, label, Icon }) => (
              <li key={key}>
                <a href={href} target="_blank" rel="noopener noreferrer" aria-label={label} tabIndex={visible ? undefined : -1} className="block p-1 transition-colors hover:text-peach">
                  <Icon className="h-4 w-4" />
                </a>
              </li>
            ))}
          </ul>
        </div>
    </div>
  )
}
