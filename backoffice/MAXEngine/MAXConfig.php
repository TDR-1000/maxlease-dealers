<?php

//Timezone
date_default_timezone_set('UTC');

//WEBSITE

define('WEBSITE_NAME', 'Max Lease');
define('WEBSITE_DOMAIN', 'https://dealers.maxlease.nl/');
define('SCRIPT_URL', 'https://dealers.maxlease.nl/');

//DATABASE CONFIGURATION
define('DB_HOST', 'localhost');
define('DB_TYPE', 'mysql');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'max');

//SESSION CONFIGURATION
define('SESSION_SECURE', false);
define('SESSION_HTTP_ONLY', true);
define('SESSION_USE_ONLY_COOKIES', true);

//LOGIN CONFIGURATION
define('LOGIN_MAX_LOGIN_ATTEMPTS', 20);
define('LOGIN_FINGERPRINT', false);
define('SUCCESS_LOGIN_REDIRECT', serialize(['default' => "index.php"]));

//PASSWORD CONFIGURATION
define('PASSWORD_RESET_KEY_LIFE', 60);

// REGISTRATION CONFIGURATION
define('MAIL_CONFIRMATION_REQUIRED', true);
define('REGISTER_CONFIRM', "https://maxlease.nl/confirm.php");
define('REGISTER_PASSWORD_RESET', "https://maxlease.nl//passwordreset.php");

// EMAIL SENDING CONFIGURATION
// Available MAILER options are 'mail' for php mail() and 'smtp' for using SMTP server for sending emails
define('MAILER', "mail");
define('SMTP_HOST', "");
define('SMTP_PORT', 25);
define('SMTP_USERNAME', "");
define('SMTP_PASSWORD', "");
define('SMTP_ENCRYPTION', "");

define('MAIL_FROM_NAME', "Max Lease");
define('MAIL_FROM_EMAIL', "info@maxlease.nl");

// SOCIAL LOGIN CONFIGURATION

define('SOCIAL_CALLBACK_URI', "https://maxlease.nl/socialauth_callback.php");

// GOOGLE
define('GOOGLE_ENABLED', false);
define('GOOGLE_ID', "");
define('GOOGLE_SECRET', "");

// FACEBOOK
define('FACEBOOK_ENABLED', false);
define('FACEBOOK_ID', "");
define('FACEBOOK_SECRET', "");

// TWITTER
define('TWITTER_ENABLED', false);
define('TWITTER_KEY', "");
define('TWITTER_SECRET', "");

// TRANSLATION
define('DEFAULT_LANGUAGE', 'en');
