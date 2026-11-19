import React, { useRef, useState } from "react"
import { ArrowRight, PhoneIcon } from "./Icons"
import { site } from "../data/site"

/**
 * Consultation request form (brief, section 09).
 * variant="full"    → /contact/ (all fields, incl. optional project area + timing)
 * variant="compact" → home hero (required fields + message)
 * cf-* classes are styling hooks (e.g. the translucent hero card, .hero-glass in index.css).
 * Backend: inc/contact-form.php
 */

const config = (window.silvercrestData && window.silvercrestData.form) || {}
const options = config.options || { services: [], projectType: [], timing: [] }

const initialValues = {
  name: "",
  phone: "",
  email: "",
  location: "",
  service: "",
  projectType: "",
  timing: "",
  notes: "",
  consent: false,
  company_website: "" // honeypot
}

function validate(v) {
  const errors = {}
  if (v.name.trim().length < 2) errors.name = "Please enter your name."
  if (v.phone.replace(/\D/g, "").length < 10) errors.phone = "Please enter a valid phone number."
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.email.trim())) errors.email = "Please enter a valid email address."
  if (v.location.trim().length < 3) errors.location = "Please enter your city or ZIP code."
  if (!v.service) errors.service = "Please choose a service."
  if (!v.consent) errors.consent = "Please confirm we can contact you."
  return errors
}

const fieldOrder = ["name", "phone", "email", "location", "service", "consent"]

export default function ContactForm({ variant = "full", idPrefix = "cf" }) {
  const compact = variant === "compact"
  const [values, setValues] = useState(initialValues)
  const [errors, setErrors] = useState({})
  const [status, setStatus] = useState("idle") // idle | sending | success | error
  const [serverMessage, setServerMessage] = useState("")
  const startedAt = useRef(Date.now())
  const formRef = useRef(null)

  const id = name => `${idPrefix}-${name}`

  const update = e => {
    const { name, type, checked, value } = e.target
    setValues(prev => ({ ...prev, [name]: type === "checkbox" ? checked : value }))
    if (errors[name]) setErrors(prev => ({ ...prev, [name]: undefined }))
  }

  const focusFirstError = errs => {
    const first = fieldOrder.find(name => errs[name])
    if (first) formRef.current?.querySelector(`[name="${first}"]`)?.focus()
  }

  const onSubmit = async e => {
    e.preventDefault()
    const errs = validate(values)
    setErrors(errs)
    if (Object.keys(errs).length) {
      focusFirstError(errs)
      return
    }

    setStatus("sending")
    setServerMessage("")
    try {
      const res = await fetch(config.endpoint, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ ...values, elapsed: Date.now() - startedAt.current, source: window.location.href })
      })
      const data = await res.json().catch(() => ({}))

      if (res.ok && data.ok) {
        setStatus("success")
        // GA4 / GTM conversion (brief, section 09)
        window.dataLayer = window.dataLayer || []
        window.dataLayer.push({ event: "consultation_request", form_variant: variant, service: values.service })
        return
      }
      if (data.errors) {
        setErrors(data.errors)
        focusFirstError(data.errors)
      }
      setServerMessage(data.message || "")
      setStatus("error")
    } catch {
      setStatus("error")
    }
  }

  if (status === "success") {
    return (
      <div role="status" className="py-6 text-center">
        <p className="cf-title font-display text-3xl font-semibold text-ink">Thank you.</p>
        <p className="cf-muted mt-3 leading-relaxed text-ink/80">Your request has been received. Our team will be in touch.</p>
      </div>
    )
  }

  const inputClass = name =>
    `cf-input ${compact ? "mt-1 py-2" : "mt-1.5 py-2.5"} block w-full rounded-md border bg-white px-3.5 text-sm text-ink placeholder:text-ink/40 transition-colors focus:outline-none focus:ring-2 focus:ring-rust/30 ${
      errors[name] ? "border-red-600 focus:border-red-600" : "border-sand focus:border-rust"
    }`

  const Field = ({ name, label, optional, children }) => (
    <div>
      <label htmlFor={id(name)} className="cf-label block text-xs font-semibold font-wide uppercase tracking-wide text-ink/80">
        {label}
        {optional ? <span className="cf-optional ml-1 font-normal normal-case tracking-normal text-ink/50">(optional)</span> : <span className="cf-required text-rust"> *</span>}
      </label>
      {children}
      {errors[name] && (
        <p id={id(`${name}-error`)} className="cf-error mt-1 text-xs text-red-700">
          {errors[name]}
        </p>
      )}
    </div>
  )

  const a11y = name => ({
    id: id(name),
    name,
    "aria-invalid": errors[name] ? true : undefined,
    "aria-describedby": errors[name] ? id(`${name}-error`) : undefined
  })

  return (
    <form ref={formRef} onSubmit={onSubmit} noValidate className={compact ? "space-y-3" : "space-y-4"}>
      {/* Honeypot — hidden from people and assistive tech */}
      <div className="absolute -left-[9999px] h-px w-px overflow-hidden" aria-hidden="true">
        <label htmlFor={id("company_website")}>Company website</label>
        <input type="text" id={id("company_website")} name="company_website" tabIndex={-1} autoComplete="off" value={values.company_website} onChange={update} />
      </div>

      <div className={`grid sm:grid-cols-2 ${compact ? "gap-3" : "gap-4"}`}>
        {Field({ name: "name", label: "Name", children: <input type="text" autoComplete="name" className={inputClass("name")} value={values.name} onChange={update} {...a11y("name")} /> })}
        {Field({ name: "phone", label: "Phone", children: <input type="tel" autoComplete="tel" className={inputClass("phone")} value={values.phone} onChange={update} {...a11y("phone")} /> })}
      </div>

      <div className={`grid sm:grid-cols-2 ${compact ? "gap-3" : "gap-4"}`}>
        {Field({ name: "email", label: "Email", children: <input type="email" autoComplete="email" className={inputClass("email")} value={values.email} onChange={update} {...a11y("email")} /> })}
        {Field({
          name: "location",
          label: "Project location / ZIP",
          children: <input type="text" autoComplete="postal-code" placeholder="e.g. Henderson or 89052" className={inputClass("location")} value={values.location} onChange={update} {...a11y("location")} />
        })}
      </div>

      {Field({
        name: "service",
        label: "Interested service",
        children: (
          <select className={inputClass("service")} value={values.service} onChange={update} {...a11y("service")}>
            <option value="">Select a service</option>
            {options.services.map(s => (
              <option key={s.value} value={s.value}>
                {s.label}
              </option>
            ))}
          </select>
        )
      })}

      {!compact && (
        <div className="grid gap-4 sm:grid-cols-2">
          {Field({
            name: "projectType",
            label: "Project area",
            optional: true,
            children: (
              <select className={inputClass("projectType")} value={values.projectType} onChange={update} {...a11y("projectType")}>
                <option value="">Select one</option>
                {options.projectType.map(o => (
                  <option key={o}>{o}</option>
                ))}
              </select>
            )
          })}
          {Field({
            name: "timing",
            label: "Desired timing",
            optional: true,
            children: (
              <select className={inputClass("timing")} value={values.timing} onChange={update} {...a11y("timing")}>
                <option value="">Select one</option>
                {options.timing.map(o => (
                  <option key={o}>{o}</option>
                ))}
              </select>
            )
          })}
        </div>
      )}

      {Field({
        name: "notes",
        label: compact ? "Message" : "Project notes",
        optional: true,
        children: (
          <textarea
            rows={compact ? 3 : 5}
            placeholder="Tell us about your space and what you have in mind."
            className={`${inputClass("notes")} resize-y`}
            value={values.notes}
            onChange={update}
            {...a11y("notes")}
          />
        )
      })}

      <div>
        <label htmlFor={id("consent")} className="cf-muted flex items-start gap-3 text-xs leading-relaxed text-ink/75">
          <input type="checkbox" className="mt-0.5 h-4 w-4 shrink-0 rounded border-sand accent-rust" checked={values.consent} onChange={update} {...a11y("consent")} />
          <span>
            I agree to be contacted by {site.name} about my request by phone or email.
            {config.privacyUrl && (
              <>
                {" "}
                See our{" "}
                <a href={config.privacyUrl} className="cf-link text-rust underline">
                  Privacy Policy
                </a>
                .
              </>
            )}
          </span>
        </label>
        {errors.consent && (
          <p id={id("consent-error")} className="cf-error mt-1 text-xs text-red-700">
            {errors.consent}
          </p>
        )}
      </div>

      {status === "error" && (
        <p role="alert" className="rounded-md bg-red-50 px-4 py-3 text-sm text-red-800">
          {serverMessage || (Object.keys(errors).length ? "Please review the highlighted fields." : "Something went wrong sending your request.")}{" "}
          {!Object.keys(errors).length && (
            <>
              You can also call us at{" "}
              <a href={site.phoneHref} className="font-semibold underline">
                {site.phone}
              </a>
              .
            </>
          )}
        </p>
      )}

      <button type="submit" disabled={status === "sending"} className="btn btn-primary w-full disabled:cursor-wait disabled:opacity-70">
        {status === "sending" ? "Sending…" : "Request a Consultation"}
        {status !== "sending" && <ArrowRight className="h-4 w-4" />}
      </button>

      {compact && (
        <p className="cf-muted text-center text-xs text-ink/70">
          Prefer to talk?{" "}
          <a href={site.phoneHref} className="cf-link inline-flex items-center gap-1 font-semibold text-rust hover:underline">
            <PhoneIcon className="h-3.5 w-3.5" /> {site.phone}
          </a>
        </p>
      )}
    </form>
  )
}
