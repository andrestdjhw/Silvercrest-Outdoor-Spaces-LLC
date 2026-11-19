import React, { useEffect, useRef, useState } from "react"
import Logo from "./Logo"
import Topbar from "./Topbar"
import MegaMenu from "./MegaMenu"
import useShowOnScrollUp from "../hooks/useShowOnScrollUp"
import { ArrowRight, ChevronDown, CloseIcon, MenuIcon, PhoneIcon } from "./Icons"
import { cta, mainNav } from "../data/navigation"
import { isCurrent, site, url } from "../data/site"

const isActive = item => isCurrent(item.path) || (item.children || []).some(child => isCurrent(child.path))

export default function Navbar() {
  const [mobileOpen, setMobileOpen] = useState(false)
  const [dropdownOpen, setDropdownOpen] = useState(false)
  const [mobileServicesOpen, setMobileServicesOpen] = useState(false)
  const dropdownRef = useRef(null)
  const dropdownButtonRef = useRef(null)
  const closeTimer = useRef(null)

  // Hover intent: open right away, close after a short grace period so the pointer
  // can travel from the button into the mega menu without it snapping shut.
  const openDropdown = () => {
    clearTimeout(closeTimer.current)
    setDropdownOpen(true)
  }
  const closeDropdownSoon = () => {
    clearTimeout(closeTimer.current)
    closeTimer.current = setTimeout(() => setDropdownOpen(false), 180)
  }
  const topbarVisible = useShowOnScrollUp()
  const [scrolled, setScrolled] = useState(false)

  // Soft shadow once the page scrolls under the header.
  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 8)
    onScroll()
    window.addEventListener("scroll", onScroll, { passive: true })
    return () => window.removeEventListener("scroll", onScroll)
  }, [])

  useEffect(() => {
    const onKeyDown = e => {
      if (e.key === "Escape") {
        // Return focus to the Services button if it was inside the mega menu
        if (dropdownRef.current && dropdownRef.current.contains(document.activeElement)) dropdownButtonRef.current?.focus()
        setDropdownOpen(false)
        setMobileOpen(false)
      }
    }
    const onPointerDown = e => {
      if (dropdownRef.current && !dropdownRef.current.contains(e.target)) setDropdownOpen(false)
    }
    document.addEventListener("keydown", onKeyDown)
    document.addEventListener("pointerdown", onPointerDown)
    return () => {
      document.removeEventListener("keydown", onKeyDown)
      document.removeEventListener("pointerdown", onPointerDown)
    }
  }, [])

  // Lock page scroll behind the open mobile menu.
  useEffect(() => {
    document.body.classList.toggle("overflow-hidden", mobileOpen)
    // Smooth scroll (motion.js) must pause too, or the page keeps moving behind the menu.
    if (window.silvercrestLenis) window.silvercrestLenis[mobileOpen ? "stop" : "start"]()
  }, [mobileOpen])

  const desktopLink = active =>
    `relative py-2 text-[13px] font-medium transition-colors xl:text-sm hover:text-rust ${
      active ? "text-rust after:absolute after:inset-x-0 after:-bottom-0.5 after:h-0.5 after:bg-rust" : "text-ink/80"
    }`

  return (
    <>
      {/* Topbar + navbar move together: slide up by the topbar height (h-9) to hide it */}
      <div className={`transition-transform duration-300 ease-out ${topbarVisible || mobileOpen ? "" : "md:-translate-y-9"}`}>
      <Topbar visible={topbarVisible} />
      <header className={`relative border-b border-sand bg-cream/95 backdrop-blur transition-shadow duration-300 ${scrolled ? "shadow-[0_8px_24px_-12px_rgb(35_26_21/0.25)]" : ""}`}>
        <div className="container-site flex h-18 items-center justify-between gap-6">
          <div className="flex items-center gap-6 xl:gap-8">
            <a href={url("/")} aria-label={`${site.name} — Home`} className="shrink-0">
              <Logo />
            </a>
            <span className="hidden h-10 w-px bg-sand lg:block" aria-hidden="true" />
          </div>

          {/* Desktop */}
          <nav aria-label="Main" className="hidden flex-1 self-stretch lg:block">
            <ul className="flex h-full items-center justify-center gap-5 xl:gap-7">
              {mainNav.map(item =>
                item.children ? (
                  <li
                    key={item.label}
                    ref={dropdownRef}
                    className="flex h-full items-center"
                    onPointerEnter={e => e.pointerType === "mouse" && openDropdown()}
                    onPointerLeave={e => e.pointerType === "mouse" && closeDropdownSoon()}
                  >
                    <button
                      ref={dropdownButtonRef}
                      type="button"
                      className={`${desktopLink(isActive(item) || dropdownOpen)} flex items-center gap-1`}
                      aria-expanded={dropdownOpen}
                      aria-controls="services-menu"
                      onClick={() => setDropdownOpen(open => !open)}
                    >
                      {item.label}
                      <ChevronDown className={`h-3.5 w-3.5 transition-transform duration-300 ${dropdownOpen ? "rotate-180" : ""}`} />
                    </button>
                    <MegaMenu id="services-menu" open={dropdownOpen} items={item.children} allPath={item.path} />
                  </li>
                ) : (
                  <li key={item.path}>
                    <a href={url(item.path)} aria-current={isActive(item) ? "page" : undefined} className={desktopLink(isActive(item))}>
                      {item.label}
                    </a>
                  </li>
                )
              )}
            </ul>
          </nav>

          <a href={url(cta.path)} className="btn btn-primary hidden shrink-0 px-5 py-2.5 lg:inline-flex">
            {cta.label}
          </a>

          {/* Mobile toggle */}
          <button
            type="button"
            className="-mr-2 rounded-md p-2 text-ink lg:hidden"
            aria-expanded={mobileOpen}
            aria-controls="mobile-menu"
            aria-label={mobileOpen ? "Close menu" : "Open menu"}
            onClick={() => setMobileOpen(open => !open)}
          >
            {mobileOpen ? <CloseIcon className="h-6 w-6" /> : <MenuIcon className="h-6 w-6" />}
          </button>
        </div>

        {/* Mobile menu */}
        {mobileOpen && (
          <nav id="mobile-menu" aria-label="Main" data-lenis-prevent className="absolute inset-x-0 top-full max-h-[calc(100dvh-4.5rem)] overflow-y-auto border-b border-sand bg-cream shadow-lg lg:hidden">
            <ul className="px-4 py-4 sm:px-6">
              {mainNav.map(item =>
                item.children ? (
                  <li key={item.label} className="border-b border-sand/70">
                    <button
                      type="button"
                      className="flex w-full items-center justify-between py-3 text-left font-medium text-ink"
                      aria-expanded={mobileServicesOpen}
                      aria-controls="mobile-services"
                      onClick={() => setMobileServicesOpen(open => !open)}
                    >
                      {item.label}
                      <ChevronDown className={`h-4 w-4 transition-transform ${mobileServicesOpen ? "rotate-180" : ""}`} />
                    </button>
                    {mobileServicesOpen && (
                      <ul id="mobile-services" className="pb-3 pl-4">
                        <li>
                          <a href={url(item.path)} className="block py-2 text-sm font-semibold text-rust">
                            View All Services
                          </a>
                        </li>
                        {item.children.map(child => (
                          <li key={child.path}>
                            <a
                              href={url(child.path)}
                              aria-current={isCurrent(child.path) ? "page" : undefined}
                              className={`block py-2 text-sm ${isCurrent(child.path) ? "text-rust" : "text-ink/80"}`}
                            >
                              {child.label}
                            </a>
                          </li>
                        ))}
                      </ul>
                    )}
                  </li>
                ) : (
                  <li key={item.path} className="border-b border-sand/70">
                    <a
                      href={url(item.path)}
                      aria-current={isActive(item) ? "page" : undefined}
                      className={`block py-3 font-medium ${isActive(item) ? "text-rust" : "text-ink"}`}
                    >
                      {item.label}
                    </a>
                  </li>
                )
              )}
            </ul>
            <div className="flex flex-col gap-3 px-4 pb-6 sm:px-6">
              <a href={url(cta.path)} className="btn btn-primary">
                {cta.label} <ArrowRight className="h-4 w-4" />
              </a>
              <a href={site.phoneHref} className="btn btn-outline">
                <PhoneIcon className="h-4 w-4" /> {site.phone}
              </a>
            </div>
          </nav>
        )}
      </header>
      </div>

      {/* Discreet sticky CTA on mobile (brief, section 09) */}
      {!mobileOpen && (
        <div className="fixed inset-x-0 bottom-0 z-40 grid grid-cols-2 gap-2 border-t border-sand bg-cream/95 p-2 backdrop-blur lg:hidden">
          <a href={site.phoneHref} className="btn btn-outline px-3 py-2.5">
            <PhoneIcon className="h-4 w-4" /> Call
          </a>
          <a href={url(cta.path)} className="btn btn-primary px-3 py-2.5">
            Request a Consultation
          </a>
        </div>
      )}
    </>
  )
}
