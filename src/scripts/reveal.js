/**
 * Scroll reveal for [data-reveal] elements (styles in src/index.css).
 * Siblings are staggered automatically; set style="--reveal-delay:…" to override.
 */
export default function initReveal() {
  const root = document.documentElement
  if (!root.classList.contains("js-reveal")) return

  const items = Array.from(document.querySelectorAll("[data-reveal]"))

  // Stagger: position among revealed siblings in the same parent, capped.
  items.forEach(el => {
    if (el.style.getPropertyValue("--reveal-delay")) return
    const siblings = Array.from(el.parentElement.children).filter(c => c.hasAttribute("data-reveal"))
    const index = siblings.indexOf(el)
    if (index > 0) el.style.setProperty("--reveal-delay", `${Math.min(index, 6) * 90}ms`)
  })

  // Replays every time a section is revisited:
  // shows at ≥12% visible, resets only once the element is completely off-screen
  // (the gap between the two avoids flicker at the edge).
  const SHOW_AT = 0.12
  const observer = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting && entry.intersectionRatio >= SHOW_AT) {
          entry.target.classList.add("is-visible")
        } else if (!entry.isIntersecting) {
          entry.target.classList.remove("is-visible")
        }
      })
    },
    { threshold: [0, SHOW_AT] }
  )

  items.forEach(el => observer.observe(el))
  window.__silvercrestReveal = true
}
