import React, { useEffect, useState } from "react"
import { FacebookIcon, GoogleIcon, InstagramIcon, MailIcon, MapPinIcon, PhoneIcon, TikTokIcon, YouTubeIcon } from "./Icons"
import { site } from "../data/site"

const socialMeta = {
  facebook: { label: "Facebook", Icon: FacebookIcon },
  instagram: { label: "Instagram", Icon: InstagramIcon },
  tiktok: { label: "TikTok", Icon: TikTokIcon },
  youtube: { label: "YouTube", Icon: YouTubeIcon },
  google: { label: "Google Business Profile", Icon: GoogleIcon }
}

/**
 * Hidden while scrolling down, shown again when scrolling up or near the top.
 */
function useShowOnScrollUp(threshold = 40, tolerance = 6) {
  const [visible, setVisible] = useState(true)

  useEffect(() => {
    let lastY = window.scrollY
    let ticking = false

    const update = () => {
      const y = window.scrollY
      if (y < threshold) setVisible(true)
      else if (y > lastY + tolerance) setVisible(false)
      else if (y < lastY - tolerance) setVisible(true)
      if (Math.abs(y - lastY) > tolerance || y < threshold) lastY = y
      ticking = false
    }

    const onScroll = () => {
      if (!ticking) {
        ticking = true
        window.requestAnimationFrame(update)
      }
    }

    window.addEventListener("scroll", onScroll, { passive: true })
    return () => window.removeEventListener("scroll", onScroll)
  }, [threshold, tolerance])

  return visible
}

export default function Topbar() {
  const visible = useShowOnScrollUp()
  const socials = Object.entries(site.socials).filter(([key, href]) => href && socialMeta[key])

  return (
    // Collapses its height smoothly (grid-rows 1fr → 0fr) so the navbar slides up with it.
    <div className={`hidden bg-forest-dark text-cream transition-[grid-template-rows] duration-300 ease-out md:grid ${visible ? "grid-rows-[1fr]" : "grid-rows-[0fr]"}`} aria-hidden={!visible}>
      <div className="overflow-hidden">
        <div className={`mx-auto grid h-9 max-w-7xl grid-cols-3 items-center gap-4 px-4 text-xs transition-opacity duration-300 sm:px-6 lg:px-8 ${visible ? "opacity-100" : "opacity-0"}`}>
          {/* Left: email + phone */}
          <div className="flex items-center gap-5">
            {site.email && (
              <a href={`mailto:${site.email}`} tabIndex={visible ? undefined : -1} className="flex items-center gap-2 whitespace-nowrap transition-colors hover:text-sand">
                <MailIcon className="h-3.5 w-3.5 text-sand" />
                <span className="hidden lg:inline">{site.email}</span>
                <span className="lg:hidden">Email</span>
              </a>
            )}
            <a href={site.phoneHref} tabIndex={visible ? undefined : -1} className="flex items-center gap-2 whitespace-nowrap transition-colors hover:text-sand">
              <PhoneIcon className="h-3.5 w-3.5 text-sand" />
              {site.phone}
            </a>
          </div>

          {/* Center: location */}
          <p className="flex items-center justify-center gap-2 whitespace-nowrap">
            <MapPinIcon className="h-3.5 w-3.5 text-sand" />
            {site.serviceArea}
          </p>

          {/* Right: social */}
          <ul className="flex items-center justify-end gap-3">
            {socials.map(([key, href]) => {
              const { label, Icon } = socialMeta[key]
              return (
                <li key={key}>
                  <a href={href} target="_blank" rel="noopener noreferrer" aria-label={label} tabIndex={visible ? undefined : -1} className="block p-1 transition-colors hover:text-sand">
                    <Icon className="h-4 w-4" />
                  </a>
                </li>
              )
            })}
          </ul>
        </div>
      </div>
    </div>
  )
}
