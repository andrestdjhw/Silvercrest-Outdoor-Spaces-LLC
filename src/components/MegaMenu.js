import React from "react"
import { ArrowRight } from "./Icons"
import { serviceGroups } from "../data/navigation"
import { isCurrent, url } from "../data/site"

const featuredImage = (window.silvercrestData && window.silvercrestData.megaMenu && window.silvercrestData.megaMenu.image) || ""

/**
 * Full-width Services panel (desktop). Lives inside the <header> (which is `relative`),
 * so it spans the whole bar. Links stay unfocusable while closed (`invisible`).
 */
export default function MegaMenu({ id, open, items, allPath }) {
  let index = 0 // running index for the staggered entrance across both columns

  return (
    <div
      id={id}
      className={`absolute inset-x-0 top-full border-b border-sand bg-cream shadow-[0_32px_48px_-28px_rgb(35_26_21/0.35)] transition-[opacity,translate,visibility] duration-300 ease-out ${
        open ? "visible translate-y-0 opacity-100" : "invisible -translate-y-2 opacity-0"
      }`}
    >
      <div className="container-site grid grid-cols-12 gap-10 py-10">
        {/* Service columns */}
        <div className="col-span-8 grid grid-cols-2 gap-x-8">
          {serviceGroups.map(group => (
            <div key={group.key}>
              <p className="border-b border-sand pb-3 font-wide text-[11px] font-medium uppercase tracking-[0.18em] text-copper-dark">{group.title}</p>
              <ul className="mt-3 space-y-0.5">
                {items
                  .filter(item => (item.group || "design") === group.key)
                  .map(item => {
                    const delay = open ? 60 + index++ * 35 : 0
                    const current = isCurrent(item.path)
                    return (
                      <li
                        key={item.path}
                        style={{ transitionDelay: `${delay}ms` }}
                        className={`transition-[opacity,translate] duration-500 ease-out ${open ? "translate-y-0 opacity-100" : "translate-y-2 opacity-0"}`}
                      >
                        <a
                          href={url(item.path)}
                          aria-current={current ? "page" : undefined}
                          className={`group/item flex items-start gap-4 rounded-md p-3 transition-colors hover:bg-white ${current ? "bg-white" : ""}`}
                        >
                          {item.icon && (
                            <span className="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-sand text-rust transition-colors duration-300 group-hover/item:bg-rust group-hover/item:text-cream">
                              {/* Icon paths are the theme's own static SVG markup (inc/template-helpers.php) */}
                              <svg
                                viewBox="0 0 24 24"
                                className="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="1.4"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                aria-hidden="true"
                                dangerouslySetInnerHTML={{ __html: item.icon }}
                              />
                            </span>
                          )}
                          <span className="min-w-0">
                            <span className={`block font-display text-lg font-semibold leading-tight transition-colors group-hover/item:text-rust ${current ? "text-rust" : "text-ink"}`}>
                              {item.label}
                            </span>
                            {item.desc && <span className="mt-1 block text-sm leading-snug text-ink/65">{item.desc}</span>}
                          </span>
                        </a>
                      </li>
                    )
                  })}
              </ul>
            </div>
          ))}
        </div>

        {/* Featured card */}
        <div
          style={{ transitionDelay: open ? "180ms" : "0ms" }}
          className={`col-span-4 transition-[opacity,translate] duration-700 ease-out ${open ? "translate-y-0 opacity-100" : "translate-y-3 opacity-0"}`}
        >
          <div className="group/card relative isolate flex h-full min-h-80 flex-col justify-end overflow-hidden rounded-md bg-ink p-7 text-cream">
            {featuredImage && (
              <img
                src={featuredImage}
                alt=""
                loading="lazy"
                className="absolute inset-0 -z-10 h-full w-full object-cover transition-transform duration-[1.2s] ease-out group-hover/card:scale-105"
              />
            )}
            <div className="absolute inset-0 -z-10 bg-linear-to-t from-ink/95 via-rust-dark/55 to-ink/10" aria-hidden="true" />
            <p className="font-wide text-[11px] font-medium uppercase tracking-[0.18em] text-peach">Not sure where to start?</p>
            <p className="mt-2 font-display text-3xl font-semibold uppercase leading-[1.05]">Every project starts with a conversation.</p>
            <div className="mt-6 flex flex-wrap items-center gap-x-5 gap-y-3">
              <a href={url("/contact/")} className="btn btn-light px-5 py-2.5">
                Request a Consultation
              </a>
              <a href={url(allPath)} className="inline-flex items-center gap-2 text-sm font-semibold text-cream/90 transition-colors hover:text-peach">
                View All Services <ArrowRight className="h-4 w-4" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
