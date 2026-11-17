import React from "react"

/**
 * PROVISIONAL text logo, modeled on the mockup.
 * Replace with Ana's approved logo files once the rebrand is final (brief, section 12).
 */
export default function Logo({ variant = "dark", className = "" }) {
  const light = variant === "light"

  return (
    <span className={`inline-flex flex-col items-center leading-none ${className}`}>
      <svg viewBox="0 0 64 16" className="h-3.5 w-14 text-bronze" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinejoin="round" aria-hidden="true">
        <path d="M2 15L18 4l8 5 10-8 26 14" />
      </svg>
      <span className={`mt-0.5 font-serif text-2xl font-semibold tracking-[0.08em] ${light ? "text-cream" : "text-graphite"}`}>SILVERCREST</span>
      <span className={`mt-1 pl-[0.45em] text-[9px] font-medium tracking-[0.45em] ${light ? "text-cream/70" : "text-graphite/70"}`}>OUTDOOR SPACES</span>
    </span>
  )
}
