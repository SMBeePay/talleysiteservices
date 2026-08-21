# Talley Site Services

A static website for Talley Site Services.

## Project structure

```
index.html
about.html
contact.html
css/style.css
js/main.js
```

No build step required — plain HTML/CSS/JS. Open `index.html` directly in a browser to preview locally, or serve the folder with any static file server.

## Deploying to Hostinger

This site is a static site, so the simplest way to host it on Hostinger shared hosting is via **hPanel's built-in Git deployment feature**, which pulls directly from this GitHub repository.

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
4. Choose **GitHub** and authorize Hostinger to access your GitHub account (or paste the repository's HTTPS clone URL and add a deploy key if you'd rather not grant OAuth access).
5. Set:
   - **Repository**: `SMBeePay/talleysiteservices`
   - **Branch**: the branch you want live (commonly `main` — see note below)
   - **Directory**: `public_html` (or a subfolder if you're hosting on a subdomain)
6. Save. Hostinger will do an initial pull of the repo into that directory.

### 3. Deploy updates

Each time you push new commits to the connected branch, go back to **Git** in hPanel and click **Deploy** (some plans support auto-deploy on push via a webhook — look for that toggle if you want it automatic).

### Note on branches

You're currently developing on `claude/website-github-hostinger-1u0ar6`. For production hosting, it's best to merge that into your repo's main branch (e.g. `main`) and point Hostinger's Git deployment at `main`, so ongoing feature work doesn't go live until you're ready.

### Custom domain

In hPanel, under **Domains**, point your domain's nameservers to Hostinger (or add an A/CNAME record if the domain is registered elsewhere) and attach it to this website.
