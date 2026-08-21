<?php
$title = $title ?? 'Talley Site Services | Commercial Site Repair & Maintenance in Northeast DFW';
$description = $description ?? 'Talley Site Services provides parking lot striping, asphalt repair, and parking lot maintenance for commercial properties across Northeast Dallas-Fort Worth, TX.';
$canonical = $canonical ?? ('https://www.talleysiteservices.com' . $_SERVER['REQUEST_URI']);
?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($title) ?></title>
<meta name="description" content="<?= htmlspecialchars($description) ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<meta property="og:title" content="<?= htmlspecialchars($title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($description) ?>">
<meta property="og:type" content="website">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/style.css">
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header">
  <div class="container header-inner">
    <a class="brand" href="/">
      <span class="brand-name">TALLEY</span>
      <span class="brand-sub">SITE SERVICES</span>
    </a>
    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
      <span></span><span></span><span></span>
      <span class="sr-only">Menu</span>
    </button>
    <nav id="primary-nav" class="primary-nav">
      <a href="/">Home</a>
      <a href="/services/">Services</a>
      <a href="/areas-we-serve.php">Areas We Serve</a>
      <a href="/about.php">About</a>
      <a href="/contact.php">Contact</a>
    </nav>
    <a class="phone-cta" href="tel:+14692744977">
      <span class="phone-label">Call Now</span>
      <span class="phone-number">469-274-4977</span>
    </a>
  </div>
</header>
<main id="main">
