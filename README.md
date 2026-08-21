# Talley Site Services

Marketing website for Talley Site Services — commercial parking lot striping, asphalt repair, and parking lot maintenance in Northeast Dallas-Fort Worth, TX.

## Project structure

```
index.php                          Home
about.php
contact.php                        Contact form (posts to contact-handler.php)
contact-handler.php                Server-side form handler (PHP mail())
thank-you.php
404.php
services/
  index.php                        Services overview
  parking-lot-striping.php
  asphalt-repair.php
  parking-lot-maintenance.php
  site-repairs.php                 Bollards, signage, fencing, concrete, punch lists
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
css/style.css
js/main.js
images/                            Optimized site photography (JPEG + WebP), see Images section below
favicon.svg
robots.txt
sitemap.xml
.htaccess                          404 handling, directory listing off
```

**This site requires PHP** (used for shared header/footer includes and the contact form). Hostinger shared hosting supports PHP by default, so no extra setup is needed on their end. It cannot be previewed by just opening the `.php` files in a browser — run a local PHP server to preview: `php -S localhost:8000` from the project root, then visit `http://localhost:8000`.

## Deploying to Hostinger

### 1. Push your changes to GitHub

```bash
git add .
git commit -m "Update site"
git push -u origin <branch-name>
```

### 2. Connect Hostinger to this GitHub repo (one-time setup)

1. Log in to [hPanel](https://hpanel.hostinger.com).
2. Go to **Websites** → select your site → **Advanced** → **Git**.
3. Click **Create a new repository**.
4. Choose **GitHub** and authorize Hostinger to access your GitHub account.
5. Set:
   - **Repository**: `SMBeePay/talleysiteservices`
   - **Branch**: the branch you want live (commonly `main`)
   - **Directory**: `public_html`
6. Save. Hostinger will pull the repo into that directory.

### 3. Deploy updates

After pushing new commits, go back to **Git** in hPanel and click **Deploy** (or enable auto-deploy on push if your plan offers it).

### 4. Point the domain at Hostinger

In hPanel, under **Domains**, point your domain to Hostinger and attach it to this website. Update `$canonical` values and `sitemap.xml`/`robots.txt` if the live domain differs from `talleysiteservices.com`.

### Note on branches

Development happens on `claude/website-github-hostinger-1u0ar6`. Merge into `main` when ready to go live, and point Hostinger's Git deployment at `main`.

## Contact form

`contact.php` posts to `contact-handler.php`, which validates input, strips header-injection characters, and sends mail via PHP's `mail()` to `talley.siteservices@gmail.com`. A hidden honeypot field filters basic bots.

**Known limitation**: PHP's `mail()` deliverability on shared hosting can be inconsistent (messages sometimes land in spam). If leads aren't arriving reliably after launch, consider switching to SMTP-based sending (e.g. PHPMailer with Hostinger's SMTP credentials, or a transactional email service).

## Images

Site photography in `/images` is stock photography (not photos of Talley Site Services' own completed work), sourced from Unsplash and used under the [Unsplash License](https://unsplash.com/license) (free for commercial use, no attribution legally required, but credited here as good practice):

- `parking-lot-striping-aerial.*` — Photo by Tim Meyer on Unsplash
- `ada-accessible-parking-space.*` — Photo by Seoyoung Choi on Unsplash
- `asphalt-crack-repair-striping.*` — Photo by Emily Sandoval on Unsplash
- `parking-lot-line-striping-closeup.*` — Photo by Brian Patrick Tagalog on Unsplash
- `parking-garage-pavement-markings.*` — Photo by Sven Mieke on Unsplash

Each is provided as both `.jpg` (broad compatibility) and `.webp` (smaller, modern browsers), resized from the original uploads and re-encoded with PHP's GD library — a `<picture>` element serves WebP with a JPEG fallback. GD's encoder is decent but not best-in-class; if page load time matters before launch, re-compressing these with a dedicated tool (e.g. Squoosh, TinyPNG) can likely shave off another 20-30%.

**Replace these with real photos as they become available** — actual completed jobs, the branded truck, real signage — since genuine project photography is a stronger trust signal than stock imagery, and several competitors already use their own project photos.

## Content notes

Copy is intentionally conservative — no invented years-in-business, project counts, or review numbers, since this is a new business and competitors' sites lean heavily on unverified stats. Replace/expand copy with real specifics (years operating, licensing/insurance details, certifications, actual project photos) as they become available; these are strong local-SEO trust signals once they're real.

## SEO / local search — next steps

The page architecture (service pages + city pages) is built to compete with local competitors (ppm.us, beelineservices.com, pmpstriping.com, canddservicesinc.com), but on-page content is only part of ranking locally. Fastest-moving levers, roughly in priority order:

1. **Claim and fully build out the Google Business Profile** (currently unclaimed) — category, service area, phone, hours, photos, and services list matching the site. This affects Google's local pack faster than on-page SEO alone.
2. **Start collecting reviews** on Google as soon as jobs are completed — review count/recency is a major local ranking factor and the site currently has zero, unlike all four competitors.
3. **NAP-consistent citations** (name/address/phone matching exactly) on major directories — Bing Places, Apple Maps, Yelp, industry directories.
4. **Expand city pages** beyond Caddo Mills/Rockwall/McKinney to Royse City, Greenville, Wylie, and Garland once there's real project content (photos, specifics) for each — avoids thin/duplicate-content pages that can hurt more than help.
5. **Backlinks** — local business associations, chamber of commerce, supplier/partner sites, press mentions.
6. Set up **Google Search Console** and submit `sitemap.xml` once the domain is live.
