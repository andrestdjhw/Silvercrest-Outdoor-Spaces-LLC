import React from "react"

/**
 * Silvercrest lockup — official "Imagotipo principal" (Frenchman Mountain mark, SILVERCREST,
 * OUTDOOR SPACES). Files in assets/images/brand, made from the logo PNGs in the Media Library:
 *   imagotipo-dark.png  → rust + copper, for light backgrounds (navbar)
 *   imagotipo-light.png → white + copper, for rust/dark backgrounds (footer)
 *
 * variant: "dark" (on light backgrounds) | "light" (on rust/dark backgrounds)
 *          | "horizontal" (rust, compact header) | "vertical" (white + copper, footer)
 */
const brand = (window.silvercrestData && window.silvercrestData.brand) || {}

// Proposal p. 30 variants: imagotipo (default), vertical (footer), horizontal (compact header).
const files = {
  dark: [brand.imagotipoDark, 720, 377],
  light: [brand.imagotipoLight, 720, 377],
  horizontal: [brand.horizontalDark, 900, 156],
  vertical: [brand.verticalLight, 360, 587]
}

export default function Logo({ variant = "dark", className = "h-13", alt = "Silvercrest Outdoor Spaces" }) {
  const [src, width, height] = files[variant] || files.dark

  return (
    <img
      src={src}
      alt={alt}
      width={width}
      height={height}
      translate="no"
      className={`notranslate block w-auto ${className}`}
      decoding="async"
    />
  )
}
