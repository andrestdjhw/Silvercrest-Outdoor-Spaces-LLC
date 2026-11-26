/**
 * Background videos ([data-bg-video], printed by silvercrest_video()).
 * - Reduced motion: stop on the first frame.
 * - Off screen or tab hidden: pause, so it doesn't burn battery/CPU.
 */
export default function initBgVideo() {
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)")

  document.querySelectorAll("video[data-bg-video]").forEach(video => {
    let onScreen = true
    const sync = () => {
      if (reduce.matches || !onScreen || document.hidden) video.pause()
      else video.play().catch(() => {}) // autoplay blocked: the first frame stays
    }

    if ("IntersectionObserver" in window) {
      new IntersectionObserver(([entry]) => {
        onScreen = entry.isIntersecting
        sync()
      }).observe(video)
    }
    document.addEventListener("visibilitychange", sync)
    reduce.addEventListener?.("change", sync)
    sync()
  })
}
