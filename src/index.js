import React from "react"
import { createRoot } from "react-dom/client"
import Navbar from "./components/Navbar"
import Footer from "./components/Footer"

const mount = (id, Component) => {
  const el = document.getElementById(id)
  if (el) createRoot(el).render(<Component />)
}

mount("silvercrest-navbar", Navbar)
mount("silvercrest-footer", Footer)
