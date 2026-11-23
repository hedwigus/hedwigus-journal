# Hedwigus Journal

A modern, minimalist WordPress theme for [hedwigus.com](https://hedwigus.com).

Built from the real content structure of the live blog (Teknologi, Sport, Hobby, Komunitas, Personal) — not placeholder content. Clean editorial layout, optional dark mode, responsive post grid, zero build step.

## Theme files

```
style.css              Theme header + full design system
screenshot.png         WordPress theme thumbnail (1200x900)
functions.php          Setup, menus, widgets, assets
header.php / footer.php
index.php              Blog front page with featured hero
single.php / page.php / archive.php / search.php / 404.php
comments.php / sidebar.php
template-parts/        Post card, single content, empty state
inc/                   Template tags, customizer, default menu
assets/js/             Theme JS + customizer live preview
assets/images/         SVG placeholder thumbnail
readme.txt             WordPress-standard theme readme
```

## Install

1. Copy the **theme root files** (everything except `preview/`) into `wp-content/themes/hedwigus-journal/`.
2. Activate **Hedwigus Journal** in *Appearance → Themes*.
3. Assign menus to the **Primary** and **Footer** locations.
4. Set the accent color and footer text in *Appearance → Customize → Hedwigus Journal*.

## Features

- Featured latest-post hero on the front page
- Responsive card grid with categories and reading time
- Dark mode with `localStorage` persistence + system preference fallback
- Customizer: accent color, dark-by-default, footer text
- Sidebar + three footer widget areas
- Translation ready (`hedwigus-journal`), accessible markup, reduced-motion support

## Analytics & ads — all theme parameters

Nothing is hardcoded. Open **Appearance → Customize → Analytics & Ads** and set:

- **Google Analytics ID** — (defaults to G-XNGGJMYSSB) GA4 `G-…`, Universal `UA-…-…`, or GTM `GTM-…`
- **AdSense Publisher ID** — (defaults to ca-pub-8211264289325117) `ca-pub-……`
- **Default Ad Slot** — used by `[hedwigus_ad]` when no slot is passed
- **Skip tags for administrators** — on by default, keeps your own visits out
- **Additional `<head>` tags** — any other verification/meta tag
- **Tags after `<body>`** — for tags that must sit right after `<body>`

Leave a field blank and that tag is never printed. Place an ad unit in any post or page with `[hedwigus_ad slot="1234567890"]`.

⚠️ quick vibe-check: there's no cookie-consent UI in this theme — tags load for all non-admin visitors. If you need GDPR/consent gating, add a consent plugin and move the tag output behind its condition.

## Preview without WordPress

`preview/` contains a small WordPress stub and real post data from hedwigus.com, so the **actual theme templates** can be rendered and verified without a WP install:

```bash
cd hedwigus-journal
php -S 127.0.0.1:4174
# open http://127.0.0.1:4174/preview/index.php
```

`preview/` is development-only — do **not** upload it to a production WordPress install.

## Verification performed

- PHP 8.3 syntax check on all 17 theme PHP files — all clean
- Real render through the stub: HTTP 200, 8 real posts, 8 images loaded
- Browser checks: dark-mode toggle, search toggle, category nav, desktop + mobile layouts

Previews: [`preview-desktop.png`](preview-desktop.png) · [`preview-mobile.png`](preview-mobile.png)
