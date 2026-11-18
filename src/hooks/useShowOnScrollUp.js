import { useEffect, useState } from "react"

/**
 * Hidden while scrolling down, shown again when scrolling up or near the top.
 */
export default function useShowOnScrollUp(threshold = 40, tolerance = 6) {
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
