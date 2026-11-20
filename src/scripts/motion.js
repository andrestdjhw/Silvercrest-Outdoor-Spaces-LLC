/**
 * Site motion system (GSAP + ScrollTrigger + Lenis).
 * Patterns adapted from lem.828marketingsolutions.com, tuned for Silvercrest.
 *
 * Markup hooks:
 *   main h1 / main h2          words slide up from a mask (opt out: data-no-split)
 *   [data-scroll-zoom]         image eases from 1.12 → 1 while scrolling past
 *   [data-giant]               oversized text that slides sideways with scroll
 *   [data-parallax="10"]       vertical drift (yPercent ±value) while scrolling
 *   [data-hero-pointer]        spotlight + photo parallax that follow the mouse
 *     └ [data-hero-layer]      the element that moves
 *   .kmark__line path          hand-drawn underline drawn after the hero loads
 *   details[data-accordion]    animated open/close (panel: [data-accordion-panel])
 *   [data-tilt]                3D tilt following the mouse
 *   .btn (not .w-full)         magnetic pull toward the cursor
 *   [data-magic-hat]           "pulled out of a magician's hat" entrance + sparkle burst
 *   [data-stack-cards] > li    sticky step cards: the covered card shrinks and dims; icons draw in
 * Block reveals ([data-reveal]) stay CSS-driven in src/scripts/reveal.js.
 *
 * Nothing runs for prefers-reduced-motion; content is fully usable without it.
 */
import gsap from "gsap"
import { ScrollTrigger } from "gsap/ScrollTrigger"
import Lenis from "lenis"

const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches
const finePointer = window.matchMedia("(hover: hover) and (pointer: fine)").matches

export default function initMotion() {
  if (reduceMotion) return
  gsap.registerPlugin(ScrollTrigger)

  initSmoothScroll()
  initSplitHeadings()
  initScrollZoom()
  initGiantText()
  initParallax()
  initHeroMarks()
  initAccordions()
  initProgressBar()
  initMagicHat()
  initStackCards()

  if (finePointer) {
    initHeroPointer()
    initMagnetic()
    initTilt()
  }

  // Images and web fonts change layout after first paint.
  window.addEventListener("load", () => ScrollTrigger.refresh())
  if (document.fonts) document.fonts.ready.then(() => ScrollTrigger.refresh())
}

/* ---------- Smooth scroll ---------- */

function initSmoothScroll() {
  const lenis = new Lenis({
    duration: 1.15,
    easing: t => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    smoothWheel: true,
    anchors: { offset: -110 } // clear the fixed header on #anchor links
  })
  window.silvercrestLenis = lenis
  lenis.on("scroll", ScrollTrigger.update)
  gsap.ticker.add(time => lenis.raf(time * 1000))
  gsap.ticker.lagSmoothing(0)
}

/* ---------- Helpers ---------- */

/**
 * Play when the element comes into view, reset once it's fully off-screen,
 * so the animation replays every time a section is revisited.
 */
function replayOnView(el, tl, start = "top 88%") {
  ScrollTrigger.create({ trigger: el, start, end: "bottom 12%", onEnter: () => tl.play(), onEnterBack: () => tl.play() })
  ScrollTrigger.create({ trigger: el, start: "top bottom", end: "bottom top", onLeave: () => tl.pause(0), onLeaveBack: () => tl.pause(0) })
}

/** Wrap each word in a mask so it can slide up. Keeps <br> and inline elements intact. */
function splitWords(el) {
  const frag = document.createDocumentFragment()
  const wrap = node => {
    const outer = document.createElement("span")
    const inner = document.createElement("span")
    outer.className = "split-w"
    inner.className = "split-w__i"
    inner.appendChild(node)
    outer.appendChild(inner)
    return outer
  }

  Array.from(el.childNodes).forEach(node => {
    if (node.nodeType === Node.TEXT_NODE) {
      // Split on regular whitespace only, so &nbsp; keeps "Las Vegas" together.
      node.textContent.split(/([ \t\n\r]+)/).forEach(part => {
        if (!part) return
        frag.appendChild(/^[ \t\n\r]+$/.test(part) ? document.createTextNode(" ") : wrap(document.createTextNode(part)))
      })
    } else if (node.nodeName === "BR") {
      frag.appendChild(node)
    } else {
      frag.appendChild(wrap(node))
    }
  })

  el.textContent = ""
  el.appendChild(frag)
  el.classList.add("is-split")
  return el.querySelectorAll(".split-w__i")
}

/* ---------- Scroll effects ---------- */

function initSplitHeadings() {
  document.querySelectorAll("main h1, main h2").forEach(heading => {
    if (heading.closest(".prose") || heading.hasAttribute("data-no-split")) return
    const words = splitWords(heading)
    gsap.set(words, { yPercent: 110 })
    const tl = gsap.to(words, {
      yPercent: 0,
      duration: 1.05,
      ease: "expo.out",
      stagger: 0.035,
      delay: heading.tagName === "H1" ? 0.15 : 0,
      paused: true
    })
    replayOnView(heading, tl)
  })
}

function initScrollZoom() {
  gsap.utils.toArray("[data-scroll-zoom]").forEach(img => {
    gsap.fromTo(img, { scale: 1.12 }, { scale: 1, ease: "none", scrollTrigger: { trigger: img.parentElement, start: "top bottom", end: "bottom 30%", scrub: true } })
  })
}

function initGiantText() {
  gsap.utils.toArray("[data-giant]").forEach(el => {
    gsap.fromTo(el, { xPercent: 0 }, { xPercent: -35, ease: "none", scrollTrigger: { trigger: el, start: "top bottom", end: "bottom top", scrub: true } })
  })
}

function initParallax() {
  gsap.utils.toArray("[data-parallax]").forEach(el => {
    const amount = parseFloat(el.dataset.parallax) || 10
    gsap.fromTo(el, { yPercent: -amount }, { yPercent: amount, ease: "none", scrollTrigger: { trigger: el.parentElement, start: "top bottom", end: "bottom top", scrub: true } })
  })
}

function initHeroMarks() {
  gsap.utils.toArray(".kmark__line path").forEach(path => {
    gsap.fromTo(path, { strokeDashoffset: 1 }, { strokeDashoffset: 0, duration: 1.1, ease: "power2.inOut", delay: 1.1 })
  })
}

function initAccordions() {
  document.querySelectorAll("details[data-accordion]").forEach(details => {
    const summary = details.querySelector("summary")
    const panel = details.querySelector("[data-accordion-panel]")
    if (!summary || !panel) return

    summary.addEventListener("click", e => {
      e.preventDefault()
      if (details.open) {
        details.setAttribute("data-closing", "")
        gsap.fromTo(panel, { height: panel.scrollHeight }, {
          height: 0,
          duration: 0.4,
          ease: "power2.inOut",
          onComplete: () => {
            details.open = false
            details.removeAttribute("data-closing")
            gsap.set(panel, { clearProps: "height" })
          }
        })
      } else {
        details.open = true
        gsap.fromTo(panel, { height: 0 }, { height: panel.scrollHeight, duration: 0.45, ease: "power2.out", onComplete: () => gsap.set(panel, { clearProps: "height" }) })
      }
    })
  })
}

function initProgressBar() {
  const bar = document.createElement("div")
  bar.className = "scroll-progress"
  bar.setAttribute("aria-hidden", "true")
  document.body.appendChild(bar)
  const update = () => {
    const max = document.documentElement.scrollHeight - window.innerHeight
    bar.style.transform = `scaleX(${max > 0 ? window.scrollY / max : 0})`
  }
  window.addEventListener("scroll", update, { passive: true })
  update()
}

/* ---------- "Magic hat" entrance ---------- */

/**
 * The card springs up from a small point at its base (like out of a magician's hat),
 * with a soft "poof" and a burst of brand-colored sparkles, then its contents settle in.
 * Replays when the hero is revisited, like the rest of the reveals.
 */
function initMagicHat() {
  gsap.utils.toArray("[data-magic-hat]").forEach(card => {
    const stage = card.parentElement
    const fx = document.createElement("div")
    fx.className = "magic-fx"
    fx.setAttribute("aria-hidden", "true")

    const poof = document.createElement("span")
    poof.className = "magic-poof"
    fx.appendChild(poof)

    const colors = ["var(--color-copper)", "var(--color-peach)", "var(--color-cream)", "var(--color-rust)"]
    const sparks = Array.from({ length: 18 }, (_, i) => {
      const s = document.createElement("span")
      s.className = "magic-spark"
      s.style.background = colors[i % colors.length]
      fx.appendChild(s)
      return s
    })
    stage.appendChild(fx)

    const contents = card.querySelectorAll(":scope > h2, :scope > p, form > *")
    const rand = gsap.utils.random

    const tl = gsap.timeline({ paused: true, delay: 0.35 })
      // 1) Rises out of the "hat": narrow and stretched, with a little sway
      .fromTo(card,
        { autoAlpha: 0, y: 180, scaleX: 0.08, scaleY: 0.25, rotate: -8, filter: "blur(8px)", transformOrigin: "50% 100%" },
        { autoAlpha: 1, y: -14, scaleX: 0.32, scaleY: 1.08, rotate: 3, filter: "blur(2px)", duration: 0.55, ease: "power3.out" })
      // 2) Pops open to full width and settles with an elastic bounce
      .to(card, { y: 0, scaleX: 1, scaleY: 1, rotate: 0, filter: "blur(0px)", duration: 1, ease: "elastic.out(1, 0.55)", clearProps: "filter" })
      .fromTo(poof,
        { scale: 0, autoAlpha: 0.75 },
        { scale: 1.8, autoAlpha: 0, duration: 0.9, ease: "power2.out" }, 0.05)
      .fromTo(sparks,
        { x: 0, y: 0, scale: 0, rotate: 0, autoAlpha: 1 },
        {
          x: () => rand(-240, 240),
          y: () => rand(-300, -60),
          scale: () => rand(0.6, 1.5),
          rotate: () => rand(-180, 180),
          autoAlpha: 0,
          duration: () => rand(0.9, 1.4),
          ease: "power3.out",
          stagger: 0.015
        }, 0.5)
      .from(contents, { autoAlpha: 0, y: 18, duration: 0.6, ease: "power3.out", stagger: 0.05 }, 0.95)

    replayOnView(card, tl, "top 95%")
  })
}

/* ---------- Stacking step cards ---------- */

function initStackCards() {
  document.querySelectorAll("[data-stack-cards]").forEach(list => {
    const cards = [...list.children]

    // Line icons draw themselves when their card comes in.
    cards.forEach(card => {
      const strokes = card.querySelectorAll(".stack-card__art svg *")
      strokes.forEach(el => el.setAttribute("pathLength", "1"))
      gsap.fromTo(strokes, { strokeDasharray: 1, strokeDashoffset: 1 }, {
        strokeDashoffset: 0, duration: 1.2, ease: "power2.inOut", stagger: 0.1,
        scrollTrigger: { trigger: card, start: "top 80%", toggleActions: "play none none reverse" }
      })
    })

    // Desktop only: the cards are sticky there, so each one gets covered by the next.
    gsap.matchMedia().add("(min-width: 64rem)", () => {
      cards.slice(0, -1).forEach((card, i) => {
        const next = cards[i + 1]
        // Explicit start values: tweening filter from "none" starts at brightness(0).
        gsap.fromTo(card, { scale: 1, filter: "brightness(1) saturate(1)" }, {
          scale: 0.94,
          filter: "brightness(0.82) saturate(0.8)",
          ease: "none",
          scrollTrigger: {
            trigger: next,
            start: "top bottom",
            end: () => `top ${parseFloat(getComputedStyle(next).top) || 0}px`,
            scrub: true,
            invalidateOnRefresh: true
          }
        })
      })
    })
  })
}

/* ---------- Pointer effects (mouse / trackpad only) ---------- */

function initHeroPointer() {
  const hero = document.querySelector("[data-hero-pointer]")
  if (!hero) return
  const layer = hero.querySelector("[data-hero-layer]")
  const spot = { x: 50, y: 35 }
  const draw = () => {
    hero.style.setProperty("--mx", `${spot.x}%`)
    hero.style.setProperty("--my", `${spot.y}%`)
  }
  const moveTo = (x, y, duration) => gsap.to(spot, { x, y, duration, ease: "power3.out", overwrite: true, onUpdate: draw })

  hero.addEventListener("mousemove", e => {
    const r = hero.getBoundingClientRect()
    const x = ((e.clientX - r.left) / r.width) * 100
    const y = ((e.clientY - r.top) / r.height) * 100
    moveTo(x, y, 1.2)
    if (layer) gsap.to(layer, { x: (50 - x) * 0.25, y: (50 - y) * 0.15, duration: 1.6, ease: "power3.out", overwrite: "auto" })
  })
  hero.addEventListener("mouseleave", () => {
    moveTo(50, 35, 1.8)
    if (layer) gsap.to(layer, { x: 0, y: 0, duration: 1.8, ease: "power3.out" })
  })
}

function initMagnetic() {
  // Uses the CSS `translate` property, so it never fights the reveal/fill transforms.
  const settle = "translate .6s cubic-bezier(.16,1,.3,1), color .7s, background-color .7s, border-color .7s"
  const follow = "translate .2s ease-out, color .7s, background-color .7s, border-color .7s"
  let current = null

  const release = el => {
    el.style.transition = settle
    el.style.translate = ""
  }

  document.addEventListener("mousemove", e => {
    const el = e.target.closest ? e.target.closest(".btn:not(.w-full)") : null
    if (current && current !== el) release(current)
    current = el
    if (!el) return
    const r = el.getBoundingClientRect()
    el.style.transition = follow
    el.style.translate = `${(e.clientX - r.left - r.width / 2) * 0.28}px ${(e.clientY - r.top - r.height / 2) * 0.38}px`
  })
}

function initTilt() {
  document.querySelectorAll("[data-tilt]").forEach(el => {
    el.addEventListener("mousemove", e => {
      const r = el.getBoundingClientRect()
      const x = (e.clientX - r.left) / r.width - 0.5
      const y = (e.clientY - r.top) / r.height - 0.5
      gsap.to(el, { rotateY: 8 * x, rotateX: -8 * y, y: -6, transformPerspective: 900, duration: 0.6, ease: "power3.out" })
    })
    el.addEventListener("mouseleave", () => gsap.to(el, { rotateY: 0, rotateX: 0, y: 0, duration: 0.9, ease: "elastic.out(1, 0.5)" }))
  })
}
