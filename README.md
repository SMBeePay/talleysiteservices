# Talley Site Services

Marketing website for Talley Site Services — commercial parking lot striping, signage, bollards, fencing, and lot mowing in Northeast Dallas-Fort Worth, TX.

## Project structure

```
index.php                          Home
about.php
contact.php                        Contact form (posts to contact-handler.php)
contact-handler.php                Server-side form handler (PHPMailer via SMTP, falls back to mail() if unconfigured)
thank-you.php
404.php
services/
  index.php                        Services overview
  parking-lot-striping.php
  sign-installation-repair.php
  bollard-installation-repair.php
  fence-gate-repair.php
  commercial-lot-mowing.php
areas-we-serve.php                 Service area hub (all target cities)
areas-we-serve/
  caddo-mills-tx.php                Home base
  rockwall-tx.php
  fate-tx.php
  royse-city-tx.php
  greenville-tx.php
  mckinney-tx.php
  wylie-tx.php
  garland-tx.php
blog/
  index.php                        Resources hub
  how-often-restripe-parking-lot-texas.php
  ada-parking-lot-compliance-checklist.php
partials/
  header.php                       Shared <head>/nav, sets $title/$description/$canonical per page, sitewide LocalBusiness JSON-LD
  footer.php                       Shared footer
lib/phpmailer/                     Vendored PHPMailer source (3 files: PHPMailer.php, SMTP.php, Exception.php)
config/
  smtp.example.php                 Template for the contact form's SMTP credentials — copy to smtp.php on the server
  smtp.php                         Real credentials (gitignored, created directly on the server, never committed)
css/style.css
js/main.js
images/                            Optimized site photography (JPEG + WebP), see Images section below
images/brand/                      Web-ready logo + favicon files, see Brand Assets section below
brand-assets/                      Source/print logo files (not served on the live site), see Brand Assets section below
robots.txt
sitemap.xml
.htaccess                          404 handling, directory listing off, redirects old domain + non-www to canonical www
```

**This site requires PHP** (used for shared header/footer includes and the contact form). Hostinger shared hosting supports PHP by default, so no extra setup is needed on their end. It cannot be previewed by just opening the `.php` files in a browser — run a local PHP server to preview: `php -S localhost:8000` from the project root, then visit `http://localhost:8000`.

## Hosting status

**Live** at [talleysiteservices.com](https://www.talleysiteservices.com), hosted on Hostinger shared hosting with Git auto-deploy from this repo's `claude/website-github-hostinger-1u0ar6` branch (hPanel currently tracks that branch, not `main` — keep them in sync, or repoint hPanel's Git deployment at `main` for convention). The domain's nameservers point to Hostinger (`nova.dns-parking.com` / `cosmos.dns-parking.com`), which also hosts `cody@talleysiteservices.com`'s mailbox (MX → `mx1/mx2.hostinger.com`) and the domain's SPF record. SSL is active.

The site was originally developed under a temporary placeholder domain, `dfwparkinglotservices.com` (also on this Hostinger account). `.htaccess` now 301-redirects that domain — and the bare `talleysiteservices.com` apex — to `https://www.talleysiteservices.com`, to avoid duplicate content across hostnames.

## Deploying to Hostinger

### 1. Push your changes to GitHub

```bash
git add .
git commit -m "Update site"
git push -u origin <branch-name>
```

### 2. Auto-deploy

Hostinger auto-deploys on push from the connected branch (see "Hosting status" above) — no manual "Deploy" click needed unless auto-deploy gets disabled, in which case use **Websites → this site → Deployments → Deploy** in hPanel.

### Note on branches

Development happens on `claude/website-github-hostinger-1u0ar6`, which is also what's currently deployed. Keep `main` fast-forwarded to match it (or switch Hostinger's Git deployment to track `main` instead, for convention).

## Contact form

`contact.php` posts to `contact-handler.php`, which validates input, strips header-injection characters, and sends mail to `cody@talleysiteservices.com` via **PHPMailer over authenticated SMTP** (vendored at `lib/phpmailer/` — 3 source files, no Composer dependency). A hidden honeypot field filters basic bots.

**Why SMTP instead of PHP's `mail()`**: `mail()` was the original implementation, but in production it reported success while the message never arrived (no inbox, no spam folder) — a known failure mode on shared hosting, where `mail()` only confirms the message was handed to the local queue, not that it was actually delivered. Authenticated SMTP against the mailbox's own provider is far more reliable.

**Required server-side setup** (one-time, not handled by git deploy — credentials can't be committed):
1. Sends via `cody@dfwparkinglotservices.com` — `talleysiteservices.com` isn't registered through this Hostinger account (only parked/DNS-pointed here), so Hostinger's email UI doesn't offer it as a mailbox domain. The sending mailbox lives on `dfwparkinglotservices.com` instead; this only affects what the SMTP server authenticates as, not anything a visitor sees, and the lead still always lands in `cody@talleysiteservices.com`.
2. Via Hostinger's File Manager, copy `config/smtp.example.php` to `config/smtp.php` **directly on the server** and fill in that mailbox's real password. `config/smtp.php` is gitignored and must never be committed.
3. Without `config/smtp.php` present, the handler falls back to plain `mail()` — this is what runs during local development (`php -S localhost:8000`), where no real SMTP credentials exist.

After setup, test via the live contact form and confirm the email actually lands in `cody@talleysiteservices.com`'s inbox.

## Images

Site photography in `/images` is stock photography (not photos of Talley Site Services' own completed work), sourced from Unsplash and used under the [Unsplash License](https://unsplash.com/license) (free for commercial use, no attribution legally required, but credited here as good practice):

- `parking-lot-striping-aerial.*` — Photo by Tim Meyer on Unsplash
- `ada-accessible-parking-space.*` — Photo by Seoyoung Choi on Unsplash
- `asphalt-crack-repair-striping.*` — Photo by Emily Sandoval on Unsplash
- `parking-lot-line-striping-closeup.*` — Photo by Brian Patrick Tagalog on Unsplash
- `parking-garage-pavement-markings.*` — Photo by Sven Mieke on Unsplash

Each is provided as both `.jpg` (broad compatibility) and `.webp` (smaller, modern browsers), resized from the original uploads and re-encoded with PHP's GD library — a `<picture>` element serves WebP with a JPEG fallback. GD's encoder is decent but not best-in-class; if page load time matters before launch, re-compressing these with a dedicated tool (e.g. Squoosh, TinyPNG) can likely shave off another 20-30%.

**Replace these with real photos as they become available** — actual completed jobs, the branded truck, real signage — since genuine project photography is a stronger trust signal than stock imagery, and several competitors already use their own project photos.

## Brand assets

The real Talley Site Services logo (Texas-star "T" mark, black/white/red) is wired into the site header and footer.

**`/images/brand/`** — web-ready files actually referenced by the site:
- `logo-horizontal.png` / `.webp` — the header/footer logo (transparent background, sized for web use)
- `favicon-16.png`, `favicon-32.png`, `favicon-180.png` — favicon and Apple touch icon, generated from the black-background icon mark padded to a square

**`/brand-assets/`** — original source files, kept for reference but not linked from any page: the horizontal and icon-only logo in transparent PNG, black-background JPG, `@4x` high-res PNG, and an SVG wrapper (embeds the raster artwork — not a true redrawn vector) for each. Also includes the original source PNG and reference crop. **For print, embroidery, signage, or CNC work, get a proper vector redraw** — these SVGs are raster images in an SVG wrapper, not real vector paths, so they won't scale losslessly to large-format output.

**Sampled brand colors** (from the approved logo artwork, applied to the site's CSS variables in `css/style.css`): black `#080808`, white `#FFFFFF`, red accent `#D71920`.

## Content notes

Copy is intentionally conservative — no invented years-in-business, project counts, or review numbers, since this is a new business and competitors' sites lean heavily on unverified stats. Replace/expand copy with real specifics (years operating, licensing/insurance details, certifications, actual project photos) as they become available; these are strong local-SEO trust signals once they're real.

## SEO / local search — next steps

The page architecture (service pages + city pages) is built to compete with local competitors (ppm.us, beelineservices.com, pmpstriping.com, canddservicesinc.com), but on-page content is only part of ranking locally. Fastest-moving levers, roughly in priority order:

1. **Fully build out the Google Business Profile** (Cody has claimed it) — category, service area, phone, hours, photos, and services list matching the site's 5 official services.
2. **Start collecting reviews** on Google as soon as jobs are completed — review count/recency is a major local ranking factor and the site currently has zero, unlike all four competitors.
3. **NAP-consistent citations** (name/address/phone matching exactly) on major directories — Bing Places, Apple Maps, Yelp, industry directories.
4. **Expand city pages** beyond Caddo Mills/Rockwall/McKinney to Royse City, Greenville, Wylie, Fate, and Garland once there's real project content (photos, specifics) for each — avoids thin/duplicate-content pages that can hurt more than help.
5. **Backlinks** — local business associations, chamber of commerce, supplier/partner sites, press mentions.
6. Set up **Google Search Console** for `talleysiteservices.com` and submit `sitemap.xml` — the site is live now, so this is ready to do.
