import React, { useId } from "react"

/**
 * Silvercrest lockup: mountain-stripes mark + condensed wordmark + extended descriptor.
 * PROVISIONAL recreation of Ana's logo (built from the brand board, live text + SVG).
 * Replace with the official SVG files once delivered — keep the same props/sizing.
 *
 * variant: "dark" (on light backgrounds) | "light" (on rust/dark backgrounds)
 */
export function LogoMark({ className = "h-4 w-14" }) {
  const clipId = useId()
  return (
    <svg viewBox="0 0 100 34" className={className} fill="currentColor" aria-hidden="true">
      <defs>
        <clipPath id={clipId}>
          {/* Two desert ridges */}
          <path d="M4 34C14 21 24 4.5 39 3c8-.8 13 4.5 17 7 4-3.2 8-4.6 13-4 12 1.6 20 15 27 28z" />
        </clipPath>
      </defs>
      <g clipPath={`url(#${clipId})`}>
        <rect x="0" y="0" width="100" height="14.5" />
        <rect x="0" y="17.5" width="100" height="3.6" />
        <rect x="0" y="24" width="100" height="3" />
        <rect x="0" y="29.8" width="100" height="2.4" />
      </g>
      <rect x="0" y="33" width="100" height="1" />
    </svg>
  )
}

export default function Logo({ variant = "dark", className = "" }) {
  const light = variant === "light"

  return (
    <span translate="no" className={`notranslate inline-flex flex-col items-center leading-none ${light ? "text-cream" : "text-rust"} ${className}`}>
      <LogoMark className={`h-3.5 w-12 ${light ? "text-peach" : "text-copper"}`} />
      <span className="relative mt-1 font-display text-[1.8rem] font-bold leading-[0.9] tracking-tight [font-variation-settings:'wdth'_25]">
        SILVERCREST
        <span className="absolute -right-3 bottom-0 font-sans text-[6px] font-semibold tracking-normal">TM</span>
      </span>
      <span className={`mt-1 font-wide text-[8px] font-medium tracking-[0.24em] ${light ? "text-peach" : ""}`}>OUTDOOR SPACES</span>
    </span>
  )
}
