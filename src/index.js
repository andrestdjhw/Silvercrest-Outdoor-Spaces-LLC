import React from "react"
import { flushSync } from "react-dom"
import { createRoot } from "react-dom/client"
import Navbar from "./components/Navbar"
import Footer from "./components/Footer"
import ContactForm from "./components/ContactForm"
import initReveal from "./scripts/reveal"
import initMotion from "./scripts/motion"
import initStretch from "./scripts/stretch"

// Render synchronously so React-built markup (footer giant text, etc.) exists
// before the motion system scans the page.
const render = (el, element) => {
  const root = createRoot(el)
  flushSync(() => root.render(element))
}

const navbar = document.getElementById("silvercrest-navbar")
if (navbar) render(navbar, <Navbar />)

const footer = document.getElementById("silvercrest-footer")
if (footer) render(footer, <Footer />)

// Contact forms: <div data-react="contact-form" data-variant="full|compact"></div>
document.querySelectorAll('[data-react="contact-form"]').forEach((el, i) => {
  render(el, <ContactForm variant={el.dataset.variant || "full"} idPrefix={`cf${i}`} />)
})

initStretch() // before motion: it opts its images out of the scroll zoom
initMotion()
initReveal()
