<?php
declare(strict_types=1);

require_once __DIR__ . '/lib/phpmailer/Exception.php';
require_once __DIR__ . '/lib/phpmailer/PHPMailer.php';
require_once __DIR__ . '/lib/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

$recipient = 'cody@talleysiteservices.com';

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

$smtpConfigPath = __DIR__ . '/config/smtp.php';
$sent = false;

if (is_file($smtpConfigPath)) {
    // Production path: send via authenticated SMTP. Plain PHP mail() on
    // shared hosting can report success while silently never delivering;
    // SMTP auth against the mailbox's own provider is far more reliable.
    $smtp = require $smtpConfigPath;
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $smtp['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $smtp['username'];
        $mail->Password = $smtp['password'];
        $mail->SMTPSecure = $smtp['encryption'];
        $mail->Port = $smtp['port'];

        $mail->setFrom($smtp['from_email'], $smtp['from_name']);
        $mail->addAddress($recipient);
        if ($emailValid) {
            $mail->addReplyTo($email, $name);
        }
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->isHTML(false);

        $sent = $mail->send();
    } catch (PHPMailerException $e) {
        $sent = false;
        error_log('Contact form SMTP send failed: ' . $mail->ErrorInfo);
    }
} else {
    // Fallback for local development, where no real mailbox credentials
    // exist. Not used in production once config/smtp.php is in place.
    $fromAddress = 'website@talleysiteservices.com';
    $headers = "From: Talley Site Services Website <$fromAddress>\r\n";
    if ($emailValid) {
        $headers .= "Reply-To: $email\r\n";
    }
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $sent = mail($recipient, $subject, $body, $headers);
}

if ($sent) {
    header('Location: /thank-you.php');
} else {
    header('Location: /contact.php?error=send');
}
exit;
