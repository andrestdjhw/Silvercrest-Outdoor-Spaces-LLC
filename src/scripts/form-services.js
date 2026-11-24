/**
 * Third-party services used by the consultation form (src/components/ContactForm.js).
 * Keys come from functions.php via silvercrestData.form.
 */

/* ---------- Google reCAPTCHA v3 ---------- */

let recaptchaPromise = null

// Loaded on first interaction with a form (not on page load) to keep pages light.
export function loadRecaptcha(siteKey) {
  if (!siteKey) return Promise.resolve(null)
  if (recaptchaPromise) return recaptchaPromise
  recaptchaPromise = new Promise(resolve => {
    const s = document.createElement("script")
    s.src = `https://www.google.com/recaptcha/api.js?render=${encodeURIComponent(siteKey)}`
    s.async = true
    s.onload = () => window.grecaptcha.ready(() => resolve(window.grecaptcha))
    s.onerror = () => resolve(null)
    document.head.appendChild(s)
  })
  return recaptchaPromise
}

// Token for one submission, or "" if reCAPTCHA can't run (blocked, offline, wrong domain).
// The server decides what to do without one.
export async function recaptchaToken(siteKey) {
  try {
    const grecaptcha = await Promise.race([loadRecaptcha(siteKey), new Promise(r => setTimeout(() => r(null), 6000))])
    if (!grecaptcha) return ""
    return await grecaptcha.execute(siteKey, { action: "consultation" })
  } catch {
    return ""
  }
}

/* ---------- EmailJS (REST API, no SDK needed) ---------- */

export async function emailjsSend({ publicKey, serviceId }, templateId, params) {
  const res = await fetch("https://api.emailjs.com/api/v1.0/email/send", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ service_id: serviceId, template_id: templateId, user_id: publicKey, template_params: params })
  })
  if (!res.ok) throw new Error(`EmailJS ${res.status}: ${await res.text().catch(() => "")}`)
}
