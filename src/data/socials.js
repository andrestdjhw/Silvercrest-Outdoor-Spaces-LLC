import { FacebookIcon, GoogleIcon, InstagramIcon, TikTokIcon, YouTubeIcon } from "../components/Icons"
import { site } from "./site"

const socialMeta = {
  facebook: { label: "Facebook", Icon: FacebookIcon },
  instagram: { label: "Instagram", Icon: InstagramIcon },
  tiktok: { label: "TikTok", Icon: TikTokIcon },
  youtube: { label: "YouTube", Icon: YouTubeIcon },
  google: { label: "Google Business Profile", Icon: GoogleIcon }
}

/** Social profiles with a URL set in functions.php (silvercrest_socials()), in display order. */
export const socials = Object.entries(site.socials)
  .filter(([key, href]) => href && socialMeta[key])
  .map(([key, href]) => ({ key, href, ...socialMeta[key] }))
