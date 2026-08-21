<?php
$title = $title ?? 'Talley Site Services | Site Repair & Maintenance in DFW';
$description = $description ?? 'Talley Site Services provides parking lot striping, asphalt repair, and maintenance for commercial properties across Northeast Dallas-Fort Worth, TX.';
$canonical = $canonical ?? ('https://www.talleysiteservices.com' . $_SERVER['REQUEST_URI']);
$ogImage = $ogImage ?? 'https://www.talleysiteservices.com/images/parking-lot-striping-aerial.jpg';
$noindex = $noindex ?? false;
?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($title) ?></title>
<meta name="description" content="<?= htmlspecialchars($description) ?>">
<?php if ($noindex): ?>
<meta name="robots" content="noindex, follow">
<?php endif; ?>
<link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<meta property="og:title" content="<?= htmlspecialchars($title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($description) ?>">
<meta property="og:image" content="<?= htmlspecialchars($ogImage) ?>">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/style.css">
<script type="application/ld+json">
<?php
echo json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'HomeAndConstructionBusiness',
    'name' => 'Talley Site Services',
    'description' => 'Commercial parking lot striping, asphalt repair, and parking lot maintenance in Northeast Dallas-Fort Worth, TX.',
    'url' => 'https://www.talleysiteservices.com/',
    'telephone' => '+1-469-274-4977',
    'email' => 'talley.siteservices@gmail.com',
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => 'Caddo Mills',
        'addressRegion' => 'TX',
        'addressCountry' => 'US',
    ],
    'areaServed' => [
        ['@type' => 'City', 'name' => 'Caddo Mills, TX'],
        ['@type' => 'City', 'name' => 'Rockwall, TX'],
        ['@type' => 'City', 'name' => 'Royse City, TX'],
        ['@type' => 'City', 'name' => 'Fate, TX'],
        ['@type' => 'City', 'name' => 'Greenville, TX'],
        ['@type' => 'City', 'name' => 'McKinney, TX'],
        ['@type' => 'City', 'name' => 'Wylie, TX'],
        ['@type' => 'City', 'name' => 'Garland, TX'],
    ],
    'makesOffer' => [
        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Parking Lot Striping']],
        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Asphalt Repair']],
        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Parking Lot Maintenance']],
        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Site Repairs (Bollards, Signage, Fencing, Concrete)']],
    ],
], JSON_UNESCAPED_SLASHES);
?>
</script>
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
      <a href="/blog/">Resources</a>
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
