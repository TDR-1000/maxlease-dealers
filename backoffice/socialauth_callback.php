<?php

require_once 'MAXEngine/MAX.php';

$provider = MAXSession::get('social_login_provider');

if (!$provider) {
    die('Invalid social login provider.');
}

$config = [
    "callback" => SOCIAL_CALLBACK_URI,

    "providers" => [
        "Google" => [
            "enabled" => GOOGLE_ENABLED,
            "keys" => ["id" => GOOGLE_ID, "secret" => GOOGLE_SECRET],
            "scope" => "profile email"
        ],
        "Facebook" => [
            "enabled" => FACEBOOK_ENABLED,
            "keys" => ["id" => FACEBOOK_ID, "secret" => FACEBOOK_SECRET],
            "scope"   => 'email public_profile',
            "trustForwarded" => true,
        ],
        "Twitter" => [
            "enabled" => TWITTER_ENABLED,
            "keys" => ["key" => TWITTER_KEY, "secret" => TWITTER_SECRET],
            "includeEmail" => false,
        ],
    ],
];

$register = app('register');
$login = app('login');
$validator = app('validator');
$db = app('db');

try {
    $hybridauth = new Hybridauth\Hybridauth($config);

    $adapter = $hybridauth->authenticate($provider);

    $userProfile = $adapter->getUserProfile();

    // determine if this is first time that user logs in via this social network
    if ($register->registeredViaSocial($provider, $userProfile->identifier)) {
        // user already exist and his account is connected with this provider, log him in
        $user = $register->getBySocial($provider, $userProfile->identifier);
        $userInfo = app('user')->getInfo($user['user_id']);

        if ($userInfo['banned'] == 'Y') {
            // this user is banned, we will just redirect him to login page
            redirect('login.php');
        } else {
            $login->byId($user['user_id']);
            redirect(get_redirect_page());
        }
    }

    // user is not registered via this social network, check if his email exist in db
    // and associate his account with this provider
    if ($validator->emailExist($userProfile->email)) {
        // hey, this user is registered here, just associate social account with his email
        $user = $register->getByEmail($userProfile->email);
        $register->addSocialAccount($user['user_id'], $provider, $userProfile->identifier);
        $login->byId($user['user_id']);
    } else {
        // this is first time that user is registering on this website, we need to create an account for him

        // Generate unique username
        // for example, if two users with same display name (that is usually first and last name)
        // are registered, they will have the same username, so we have to add some random number here
        $username = str_replace(' ', '', $userProfile->displayName);
        $tmpUsername = $username;

        $i = 0;
        $max = 50;

        while ($validator->usernameExist($tmpUsername)) {
            // try maximum 50 times
            // Note: Chances for going over 2-3 times are really really low but just in case,
            // if somehow it always generate username that is already in use, prevent database from crashing
            // and generate some random unique username (it can be changed by administrator later)
            if ($i > $max) {
                break;
            }

            $tmpUsername = $username . rand(1, 10000);
            $i++;
        }

        // there are more than 50 trials, generate random username
        if ($i > $max) {
            $tmpUsername = uniqid('user', true);
        }

        $username = $tmpUsername;

        $info = [
            'email' => $userProfile->email == null ? '' : $userProfile->email,
            'username' => $username,
            'password' => $register->hashPassword(hash('sha512', $register->randomPassword())),
            'confirmation_key' => '',
            'confirmed' => 'Y',
            'password_reset_key' => '',
            'password_reset_confirmed' => 'N',
            'register_date' => date('Y-m-d H:i:s')
        ];

        $details = [
            'first_name' => $userProfile->firstName == null ? '' : $userProfile->firstName,
            'last_name' => $userProfile->lastName == null ? '' : $userProfile->lastName,
            'address' => $userProfile->address == null ? '' : $userProfile->address,
            'phone' => $userProfile->phone == null ? '' : $userProfile->phone
        ];

        $db->insert('as_users', $info);

        $userId = $db->lastInsertId();

        $details['user_id'] = $userId;

        $db->insert('as_user_details', $details);

        $register->addSocialAccount($userId, $provider, $userProfile->identifier);
        $login->byId($userId);
    }

    MAXSession::destroy('social_login_provider');
    redirect(get_redirect_page());
} catch (Exception $e) {
    // something happened (social auth cannot be completed), just redirect user to login page
    // Note: to debug check HybridAuth documentation for error codes:
    // http://hybridauth.sourceforge.net/userguide/Errors_and_Exceptions_Handling.html

    if (DEBUG) {
        echo "<p><strong>Social Authentication Error #{$e->getCode()}: </strong> {$e->getMessage()}</p>";
        echo "<pre><code>";
        var_dump($e);
        echo "</code></pre>";
        exit;
    }

    redirect('login.php');
}