/**
 * "Fotografía estirada" (brand proposal, Recursos gráficos 02).
 * One column of pixels is pulled horizontally to the edge, so that strip of the photo
 * becomes horizontal lines, like the strata of Frenchman Mountain.
 *
 * Markup: <div data-stretch="left|right" data-stretch-width="0.18"> … <img> … </div>
 * (silvercrest_image(..., $stretch) prints it.)
 *
 * Brand rules: one strip per image, on one side, 10–25% of the width, always horizontal,
 * never over people, faces or the logo — choose the images accordingly.
 */
export default function initStretch() {
  document.querySelectorAll("[data-stretch]").forEach(box => {
    const img = box.querySelector("img")
    if (!img) return

    // A scaling photo would drift away from the strip's seam.
    img.removeAttribute("data-scroll-zoom")

    const side = box.dataset.stretch === "right" ? "right" : "left"
    const ratio = Math.min(0.25, Math.max(0.1, parseFloat(box.dataset.stretchWidth) || 0.18))

    const canvas = document.createElement("canvas")
    canvas.className = "stretch-strip"
    canvas.setAttribute("aria-hidden", "true")
    canvas.style[side] = "0"
    img.insertAdjacentElement("afterend", canvas)

    const draw = () => {
      const cw = img.clientWidth
      const ch = img.clientHeight
      const nw = img.naturalWidth
      const nh = img.naturalHeight
      if (!cw || !ch || !nw || !nh) return

      // Map the displayed (object-cover, centered) box back to source pixels.
      const scale = Math.max(cw / nw, ch / nh)
      const ox = (cw - nw * scale) / 2
      const oy = (ch - nh * scale) / 2

      const stripWidth = Math.round(cw * ratio)
      const seamX = side === "left" ? stripWidth : cw - stripWidth
      const sx = Math.min(nw - 1, Math.max(0, (seamX - ox) / scale))

      const dpr = Math.min(window.devicePixelRatio || 1, 2)
      canvas.width = Math.round(stripWidth * dpr)
      canvas.height = Math.round(ch * dpr)
      canvas.style.width = `${stripWidth}px`

      const ctx = canvas.getContext("2d")
      ctx.imageSmoothingEnabled = false
      ctx.drawImage(img, sx, -oy / scale, 1, ch / scale, 0, 0, canvas.width, canvas.height)
    }

    if (img.complete) draw()
    else img.addEventListener("load", draw, { once: true })

    if ("ResizeObserver" in window) new ResizeObserver(draw).observe(img)
  })
}
