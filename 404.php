<?php
http_response_code(404);
$title = 'Page Not Found | Talley Site Services';
$description = 'The page you were looking for could not be found.';
$canonical = 'https://www.talleysiteservices.com/404.php';
$noindex = true;
include __DIR__ . '/partials/header.php';
?>

<section class="page-hero">
  <div class="container">
    <h1>Page Not Found</h1>
    <p>The page you're looking for doesn't exist or may have moved.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <a class="btn btn-primary" href="/">Back to Home</a>
    <a class="btn btn-outline" href="/contact.php" style="margin-left:0.75rem;">Contact Us</a>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
