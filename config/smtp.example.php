<?php
// Copy this file to config/smtp.php on the SERVER (via Hostinger's File
// Manager, NOT git — config/smtp.php is gitignored and must never be
// committed) and fill in the real mailbox password.
//
// Sends via cody@dfwparkinglotservices.com — talleysiteservices.com isn't
// registered through this Hostinger account (only its DNS points here via
// a parked domain), so Hostinger's email UI wouldn't offer it as an
// option. dfwparkinglotservices.com's mailbox works fine for sending:
// the "From" address here is only what the SMTP server authenticates
// as, not something visitors see (they see the "Talley Site Services
// Website" display name), and replies still go to the visitor via
// Reply-To. The lead itself always lands in cody@talleysiteservices.com.
//
// Hostinger SMTP settings (same for any mailbox on this account's
// domains): host smtp.hostinger.com, port 465 with SSL (or port 587
// with STARTTLS — set encryption to 'tls' and port to 587 if 465 is
// blocked on this plan).

return [
    'host' => 'smtp.hostinger.com',
    'port' => 465,
    'encryption' => 'ssl',
    'username' => 'cody@dfwparkinglotservices.com',
    'password' => 'REPLACE_WITH_REAL_MAILBOX_PASSWORD',
    'from_email' => 'cody@dfwparkinglotservices.com',
    'from_name' => 'Talley Site Services Website',
];
