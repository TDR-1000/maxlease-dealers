<?php

require_once 'MAXEngine/MAX.php';

$provider = $_GET['p'] ?? null;
$token = $_GET['token'] ?? null;

if (!$token || $token !== MAXSession::get('as_social_token')) {
    MAXSession::destroy('as_social_token');
    die('Wrong social auth token!');
}

if (! $provider) {
    die('Wrong provider.');
}

switch ($provider) {
    case 'twitter':
        if (!TWITTER_ENABLED) {
            die('This provider is not enabled.');
        }
        break;
    case 'facebook':
        if (!FACEBOOK_ENABLED) {
            die('This provider is not enabled.');
        }
        break;
    case 'google':
        if (!GOOGLE_ENABLED) {
            die('This provider is not enabled.');
        }
        break;

    default:
        die('This provider is not supported!');
}

MAXSession::set('social_login_provider', $provider);

require_once __DIR__ . '/socialauth_callback.php';
