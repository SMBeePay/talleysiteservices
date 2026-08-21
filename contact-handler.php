<?php
declare(strict_types=1);

$recipient = 'info@example.com';

function clean_field(string $value): string
{
    // Strip line breaks to prevent email header injection and trim whitespace.
    return trim(str_replace(["\r", "\n"], '', $value));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /contact.php');
    exit;
}

// Honeypot: real visitors never fill this hidden field in.
if (!empty($_POST['website'])) {
    header('Location: /thank-you.php');
    exit;
}

$name = clean_field($_POST['name'] ?? '');
$company = clean_field($_POST['company'] ?? '');
$phone = clean_field($_POST['phone'] ?? '');
$email = clean_field($_POST['email'] ?? '');
$city = clean_field($_POST['city'] ?? '');
$message = trim($_POST['message'] ?? '');

$emailValid = $email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) !== false;

if ($name === '' || $message === '' || (!$emailValid && $phone === '')) {
    header('Location: /contact.php?error=validation');
    exit;
}

$subject = 'New Website Lead: ' . $name;

$bodyLines = [
    "Name: $name",
    "Company / Property: $company",
    "Phone: $phone",
    "Email: $email",
    "City: $city",
    '',
    'Message:',
    $message,
];
$body = implode("\n", $bodyLines);

$fromAddress = 'website@talleysiteservices.com';
$headers = "From: Talley Site Services Website <$fromAddress>\r\n";
if ($emailValid) {
    $headers .= "Reply-To: $email\r\n";
}
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$sent = mail($recipient, $subject, $body, $headers);

if ($sent) {
    header('Location: /thank-you.php');
} else {
    header('Location: /contact.php?error=send');
}
exit;
