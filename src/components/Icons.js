import React from "react"

const Icon = ({ className = "h-5 w-5", children }) => (
  <svg className={className} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    {children}
  </svg>
)

export const ArrowRight = props => (
  <Icon {...props}>
    <path d="M5 12h14M13 6l6 6-6 6" />
  </Icon>
)

export const ChevronDown = props => (
  <Icon {...props}>
    <path d="M6 9l6 6 6-6" />
  </Icon>
)

export const MenuIcon = props => (
  <Icon {...props}>
    <path d="M4 7h16M4 12h16M4 17h16" />
  </Icon>
)

export const CloseIcon = props => (
  <Icon {...props}>
    <path d="M6 6l12 12M18 6L6 18" />
  </Icon>
)

export const PhoneIcon = props => (
  <Icon {...props}>
    <path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2" />
  </Icon>
)

export const MailIcon = props => (
  <Icon {...props}>
    <rect x="3" y="5" width="18" height="14" rx="2" />
    <path d="M3 7l9 6 9-6" />
  </Icon>
)

export const InstagramIcon = props => (
  <Icon {...props}>
    <rect x="3" y="3" width="18" height="18" rx="5" />
    <circle cx="12" cy="12" r="4" />
    <circle cx="17.5" cy="6.5" r="0.75" fill="currentColor" stroke="none" />
  </Icon>
)

export const FacebookIcon = props => (
  <Icon {...props}>
    <path d="M14 8h3V4h-3a4 4 0 0 0-4 4v3H7v4h3v6h4v-6h3l1-4h-4V8z" />
  </Icon>
)

export const TikTokIcon = props => (
  <Icon {...props}>
    <path d="M14 3v11.5a3.5 3.5 0 1 1-3.5-3.5" />
    <path d="M14 3a5 5 0 0 0 5 5" />
  </Icon>
)

export const YouTubeIcon = props => (
  <Icon {...props}>
    <rect x="2.5" y="5.5" width="19" height="13" rx="4" />
    <path d="M10 9.5v5l4.5-2.5L10 9.5z" fill="currentColor" />
  </Icon>
)

export const GoogleIcon = props => (
  <Icon {...props}>
    <path d="M20 12.2c0-.6 0-1.1-.1-1.7H12v3.3h4.5a4 4 0 0 1-1.7 2.6v2.1h2.8c1.6-1.5 2.4-3.7 2.4-6.3z" />
    <path d="M12 20.5c2.3 0 4.2-.8 5.6-2l-2.8-2.1c-.8.5-1.7.8-2.8.8-2.2 0-4-1.5-4.7-3.4H4.5v2.2A8.5 8.5 0 0 0 12 20.5z" />
    <path d="M7.3 13.8a5 5 0 0 1 0-3.6V8H4.5a8.5 8.5 0 0 0 0 7.8l2.8-2z" />
    <path d="M12 6.8c1.3 0 2.4.4 3.3 1.3l2.5-2.5A8.5 8.5 0 0 0 4.5 8l2.8 2.2C8 8.3 9.8 6.8 12 6.8z" />
  </Icon>
)

export const MapPinIcon = props => (
  <Icon {...props}>
    <path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21z" />
    <circle cx="12" cy="9.5" r="2.5" />
  </Icon>
)
