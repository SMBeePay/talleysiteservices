<?php
// Copy this file to config/smtp.php on the SERVER (via Hostinger's File
// Manager, NOT git — config/smtp.php is gitignored and must never be
// committed) and fill in the real mailbox password.
//
// Recommended: create a dedicated mailbox for sending (e.g.
// website@talleysiteservices.com) in Hostinger's Email section rather
// than using Cody's personal cody@talleysiteservices.com password here,
// so this script never holds credentials to his actual inbox.
//
// Hostinger SMTP settings (same for any mailbox on this domain, since
// the domain's mail is hosted on Hostinger): host smtp.hostinger.com,
// port 465 with SSL (or port 587 with STARTTLS — set encryption to
// 'tls' and port to 587 if 465 is blocked on this plan).

return [
    'host' => 'smtp.hostinger.com',
    'port' => 465,
    'encryption' => 'ssl',
    'username' => 'website@talleysiteservices.com',
    'password' => 'REPLACE_WITH_REAL_MAILBOX_PASSWORD',
    'from_email' => 'website@talleysiteservices.com',
    'from_name' => 'Talley Site Services Website',
];
