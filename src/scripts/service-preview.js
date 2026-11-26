/**
 * Home services index (template-parts/services-index.php):
 * the preview photo follows the hovered or focused service row.
 */
export default function initServicePreview() {
  document.querySelectorAll("[data-service-preview]").forEach(section => {
    const imgs = [...section.querySelectorAll("[data-preview-key]")]
    if (!imgs.length) return
    const show = key => {
      const next = imgs.find(img => img.dataset.previewKey === key)
      if (!next || next.classList.contains("is-active")) return
      imgs.forEach(img => img.classList.toggle("is-active", img === next))
    }
    section.querySelectorAll("[data-preview-target]").forEach(row => {
      const key = row.dataset.previewTarget
      row.addEventListener("mouseenter", () => show(key))
      row.addEventListener("focus", () => show(key))
    })
  })
}
