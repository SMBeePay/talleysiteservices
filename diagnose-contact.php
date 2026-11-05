<?php
declare(strict_types=1);

// Temporary diagnostic script — not linked from anywhere, delete after use.
// Requires a one-off token so it can't be triggered or read by anyone who
// happens to find the URL. Never logs raw SMTP transcripts (those can
// contain base64-encoded auth credentials) — only high-level status and
// PHPMailer's own human-readable error message.

header('Content-Type: text/plain');

$token = $_GET['key'] ?? '';
if (!hash_equals('t5s-diag-7f2b91', $token)) {
    http_response_code(404);
    exit;
}

$smtpConfigPath = __DIR__ . '/config/smtp.php';

echo "Looking for: $smtpConfigPath\n";
echo "File exists: " . (is_file($smtpConfigPath) ? 'YES' : 'NO') . "\n\n";

if (!is_file($smtpConfigPath)) {
    echo "config/smtp.php was not found at that path. Check the exact filename\n";
    echo "and location in File Manager (must be public_html/config/smtp.php,\n";
    echo "not config/smtp.example.php).\n";
    exit;
}

$smtp = require $smtpConfigPath;

echo "Config loaded. Keys present:\n";
foreach (['host', 'port', 'encryption', 'username', 'password', 'from_email', 'from_name'] as $key) {
    $present = isset($smtp[$key]) && $smtp[$key] !== '';
    if ($key === 'password') {
        $display = $present ? '(set, ' . strlen((string) $smtp[$key]) . ' chars)' : '(empty)';
    } elseif ($key === 'username') {
        $display = $present ? substr((string) $smtp[$key], 0, 3) . '***' : '(empty)';
    } else {
        $display = $present ? $smtp[$key] : '(empty)';
    }
    echo "  $key: $display\n";
}

if (($smtp['password'] ?? '') === 'REPLACE_WITH_REAL_MAILBOX_PASSWORD') {
    echo "\nThe password is still the placeholder value — it was never changed.\n";
    exit;
}

echo "\nAttempting a real SMTP connection + send...\n\n";

require_once __DIR__ . '/lib/phpmailer/Exception.php';
require_once __DIR__ . '/lib/phpmailer/PHPMailer.php';
require_once __DIR__ . '/lib/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

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
    $mail->addAddress('cody@talleysiteservices.com');
    $mail->Subject = 'Diagnostic test — safe to delete';
    $mail->Body = 'This is a one-off diagnostic send from diagnose-contact.php.';
    $mail->isHTML(false);

    $result = $mail->send();
    echo "send() returned: " . ($result ? 'true (accepted by SMTP server)' : 'false') . "\n";
    if (!$result) {
        echo "ErrorInfo: " . $mail->ErrorInfo . "\n";
    }
} catch (PHPMailerException $e) {
    echo "EXCEPTION — ErrorInfo: " . $mail->ErrorInfo . "\n";
}
