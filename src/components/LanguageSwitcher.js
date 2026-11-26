import React, { useEffect, useState } from "react"

/*
 * Floating EN/ES switcher.
 * The site is written in English; Spanish is machine-translated by Google
 * Translate, which is only loaded when a visitor picks ES (choice kept in the
 * standard `googtrans` cookie, so it follows them across pages).
 */

const COOKIE = "googtrans"
const SCRIPT_ID = "silvercrest-gt"

const readLang = () => {
  const m = document.cookie.match(/(?:^|;\s*)googtrans=([^;]+)/)
  return m && decodeURIComponent(m[1]).split("/").pop() === "es" ? "es" : "en"
}

// Google sets the cookie on both the host and the parent domain; write/clear both.
const domains = () => {
  const host = location.hostname
  const parts = host.split(".")
  const list = ["", host]
  if (parts.length > 2) list.push("." + parts.slice(-2).join("."))
  return list
}

const setCookie = value => {
  domains().forEach(d => {
    const domain = d ? `; domain=${d}` : ""
    document.cookie = value
      ? `${COOKIE}=${value}; path=/${domain}; max-age=31536000; SameSite=Lax`
      : `${COOKIE}=; path=/${domain}; expires=Thu, 01 Jan 1970 00:00:00 GMT`
  })
}

// Google Translate wraps text in <font> nodes behind React's back; without this,
// a later React update can throw "removeChild/insertBefore: not a child".
let patched = false
const patchDom = () => {
  if (patched || typeof Node !== "function") return
  patched = true
  const remove = Node.prototype.removeChild
  Node.prototype.removeChild = function (child) {
    if (child.parentNode !== this) return child
    return remove.call(this, child)
  }
  const insert = Node.prototype.insertBefore
  Node.prototype.insertBefore = function (node, ref) {
    if (ref && ref.parentNode !== this) return node
    return insert.call(this, node, ref)
  }
}

// Keep the brand name in English: wrap it in translate="no" before Google runs.
// Surrounding spaces move inside the span : Google drops them around untranslated nodes.
const BRAND = /Silvercrest(?: Outdoor Spaces(?: LLC)?)?/g
const protectBrand = () => {
  const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, {
    acceptNode: n =>
      !n.parentElement || n.parentElement.closest("script,style,noscript,textarea,.notranslate") || !/Silvercrest/.test(n.nodeValue)
        ? NodeFilter.FILTER_REJECT
        : NodeFilter.FILTER_ACCEPT,
  })
  const nodes = []
  while (walker.nextNode()) nodes.push(walker.currentNode)
  nodes.forEach(node => {
    const frag = document.createDocumentFragment()
    let last = 0
    const text = node.nodeValue
    const prev = node.previousSibling?.textContent || ""
    const next = node.nextSibling?.textContent || ""
    text.replace(BRAND, (match, offset) => {
      frag.appendChild(document.createTextNode(text.slice(last, offset)))
      // When the name is its own text node (React's "by {name} about"), Google drops the
      // spaces in the neighbouring nodes, so carry them inside the protected span.
      const lead = offset === 0 && /\s$/.test(prev)
      const trail = offset + match.length === text.length && /^\s/.test(next)
      const span = document.createElement("span")
      span.className = "notranslate"
      span.setAttribute("translate", "no")
      span.textContent = (lead ? " " : "") + match + (trail ? " " : "")
      frag.appendChild(span)
      last = offset + match.length
    })
    frag.appendChild(document.createTextNode(text.slice(last)))
    node.parentNode.replaceChild(frag, node)
  })
}

const loadGoogle = () => {
  patchDom()
  protectBrand()
  const combo = document.querySelector(".goog-te-combo")
  if (combo) {
    combo.value = "es"
    combo.dispatchEvent(new Event("change"))
    return
  }
  if (document.getElementById(SCRIPT_ID)) return
  window.silvercrestTranslateInit = () => {
    new window.google.translate.TranslateElement(
      { pageLanguage: "en", includedLanguages: "en,es", autoDisplay: false },
      "silvercrest-gt-element"
    )
  }
  const s = document.createElement("script")
  s.id = SCRIPT_ID
  s.src = "https://translate.google.com/translate_a/element.js?cb=silvercrestTranslateInit"
  s.async = true
  document.body.appendChild(s)
}

// Round flags (decorative; the button label carries the meaning).
const FlagUS = () => (
  <svg viewBox="0 0 20 20" className="h-4 w-4 shrink-0 rounded-full ring-1 ring-ink/15" aria-hidden="true">
    <defs><clipPath id="sc-flag-us"><circle cx="10" cy="10" r="10" /></clipPath></defs>
    <g clipPath="url(#sc-flag-us)">
      <rect width="20" height="20" fill="#fff" />
      {[0, 2, 4, 6, 8, 10, 12].map(i => (
        <rect key={i} y={(i * 20) / 13} height={20 / 13} width="20" fill="#b22234" />
      ))}
      <rect width="10" height={(20 / 13) * 7} fill="#3c3b6e" />
      {[[2.5, 2.5], [5.5, 2.5], [8, 2.5], [4, 5], [7, 5], [2.5, 7.5], [5.5, 7.5], [8, 7.5], [4, 10], [7, 10]].map(([x, y], i) => (
        <circle key={i} cx={x} cy={y} r="0.6" fill="#fff" />
      ))}
    </g>
  </svg>
)

const FlagMX = () => (
  <svg viewBox="0 0 20 20" className="h-4 w-4 shrink-0 rounded-full ring-1 ring-ink/15" aria-hidden="true">
    <defs><clipPath id="sc-flag-mx"><circle cx="10" cy="10" r="10" /></clipPath></defs>
    <g clipPath="url(#sc-flag-mx)">
      <rect width="20" height="20" fill="#fff" />
      <rect width="6.67" height="20" fill="#006847" />
      <rect x="13.33" width="6.67" height="20" fill="#ce1126" />
      <circle cx="10" cy="10" r="2.1" fill="none" stroke="#3f7a2b" strokeWidth="0.7" />
      <ellipse cx="10" cy="9.7" rx="1.1" ry="1.3" fill="#8a5a2b" />
    </g>
  </svg>
)

const OPTIONS = [
  { code: "en", label: "EN", name: "English", Flag: FlagUS },
  { code: "es", label: "ES", name: "Español", Flag: FlagMX },
]

export default function LanguageSwitcher() {
  const [lang, setLang] = useState(readLang)

  useEffect(() => {
    if (lang === "es") loadGoogle()
  }, [])

  const choose = code => {
    if (code === lang) return
    if (code === "es") {
      setCookie("/en/es")
      setLang("es")
      loadGoogle()
    } else {
      // Restoring the original text reliably means reloading the untouched page.
      setCookie(null)
      location.reload()
    }
  }

  return (
    <div
      translate="no"
      className="notranslate fixed bottom-19 left-3 z-40 lg:bottom-6 lg:left-6"
    >
      <div id="silvercrest-gt-element" className="hidden" aria-hidden="true" />
      <div
        role="group"
        aria-label="Language / Idioma"
        className="flex items-center gap-1 rounded-full border border-sand bg-chalk/95 p-1 text-ink shadow-[0_8px_30px_-12px_rgba(33,26,22,0.45)] backdrop-blur"
      >
        {OPTIONS.map(o => {
          const active = lang === o.code
          return (
            <button
              key={o.code}
              type="button"
              lang={o.code}
              title={o.name}
              aria-label={o.name}
              aria-pressed={active}
              onClick={() => choose(o.code)}
              className={`flex items-center gap-1.5 rounded-full py-1.5 pl-2 pr-3 text-xs font-semibold tracking-[0.12em] transition-colors focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rust ${
                active ? "bg-rust text-white" : "text-ink/70 hover:bg-sand hover:text-ink"
              }`}
            >
              <o.Flag />
              {o.label}
            </button>
          )
        })}
      </div>
    </div>
  )
}
