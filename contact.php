<?php
$title = 'Contact Talley Site Services | Free Estimate in DFW, TX';
$description = 'Request a free estimate from Talley Site Services for parking lot striping, asphalt repair, or parking lot maintenance in Northeast Dallas-Fort Worth, TX.';
$canonical = 'https://www.talleysiteservices.com/contact.php';

$errors = [];
if (!empty($_GET['error'])) {
    $errorCode = $_GET['error'];
    if ($errorCode === 'validation') {
        $errors[] = 'Please fill in your name, phone or email, and a brief message.';
    } elseif ($errorCode === 'send') {
        $errors[] = 'Something went wrong sending your message. Please call 555-555-0100 or email info@example.com directly.';
    }
}

include __DIR__ . '/partials/header.php';
?>

<section class="page-hero">
  <div class="container">
    <p class="breadcrumbs"><a href="/">Home</a> / Contact</p>
    <h1>Contact Us</h1>
    <p>Request a free estimate or ask a question &mdash; we'll get back to you promptly.</p>
  </div>
</section>

<section class="section">
  <div class="container two-col">
    <div>
      <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
          <?php foreach ($errors as $error): ?>
            <p><?= htmlspecialchars($error) ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <form action="/contact-handler.php" method="post">
        <div class="form-field">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="form-field">
          <label for="company">Company / Property Name</label>
          <input type="text" id="company" name="company">
        </div>
        <div class="form-field">
          <label for="phone">Phone</label>
          <input type="tel" id="phone" name="phone">
        </div>
        <div class="form-field">
          <label for="email">Email</label>
          <input type="email" id="email" name="email">
        </div>
        <div class="form-field">
          <label for="city">City</label>
          <input type="text" id="city" name="city" placeholder="e.g. Rockwall, TX">
        </div>
        <div class="form-field">
          <label for="message">What do you need done?</label>
          <textarea id="message" name="message" required></textarea>
        </div>
        <!-- honeypot field, hidden from real users via CSS, catches basic bots -->
        <div class="form-field" style="position:absolute; left:-9999px;" aria-hidden="true">
          <label for="website">Leave this field blank</label>
          <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
        </div>
        <p class="form-note">Please fill in your name, a phone number or email, and a brief message so we can follow up.</p>
        <button class="btn btn-primary" type="submit">Send Request</button>
      </form>
    </div>
    <aside class="sidebar">
      <h3>Direct Contact</h3>
      <ul>
        <li><a href="tel:+15555550100">555-555-0100</a></li>
        <li><a href="mailto:info@example.com">info@example.com</a></li>
        <li>Caddo Mills, TX</li>
      </ul>
      <h3>Service Area</h3>
      <p>Caddo Mills, Rockwall, Royse City, Greenville, McKinney, Wylie, Garland, and surrounding Northeast DFW communities.</p>
    </aside>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
