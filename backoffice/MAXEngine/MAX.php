<?php

define('MAX_VERSION', '1.0.0');

// Debug Mode
// DON'T FORGET TO SET IT TO FALSE FOR PRODUCTION!
define('DEBUG', true);

// If debug mode is turned on, we will
// show all errors to the user.
if (DEBUG) {
    ini_set("display_errors", "1");
    error_reporting(E_ALL);
}else{
    error_reporting(0);
}

// Redirect user to installation page if script is not installed
if (!file_exists(dirname(__FILE__) . '/MAXConfig.php')) {
    header("Location: install/index.php");
}

include_once dirname(__FILE__) . "/../vendor/autoload.php";

MAXSession::startSession();

$container = new Pimple\Container();

$container['db'] = function () {
    try {
        $db = new MAXDatabase(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        $db->debug(DEBUG);

        return $db;
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
};

$container['mailer'] = $container->factory(function () {
    return new MAXEmail;
});

$container['hasher'] = $container->factory(function () {
    return new MAXPasswordHasher;
});

$container['validator'] = $container->factory(function ($c) {
    return new MAXValidator($c['db']);
});

$container['login'] = $container->factory(function ($c) {
    return new MAXLogin($c['db']);
});

$container['register'] = $container->factory(function ($c) {
    return new MAXRegister($c['db'], $c['mailer'], $c['validator'], $c['login'], $c['hasher']);
});

$container['user'] = $container->factory(function ($c) {
    return new MAXUser($c['db'], $c['hasher'], $c['validator'], $c['login'], $c['register']);
});

$container['comment'] = $container->factory(function ($c) {
    return new MAXComment($c['db'], $c['user'], $c['validator']);
});

$container['role'] = $container->factory(function ($c) {
    return new MAXRole($c['db'], $c['validator']);
});

$container['current_user'] = function ($c) {
    if (!$c['login']->isLoggedIn()) {
        return null;
    }

    $result = $c['db']->select(
        "SELECT as_users.*, as_user_details.*, as_user_roles.role 
        FROM as_users, as_user_details, as_user_roles 
        WHERE as_users.user_id = :id
        AND as_user_details.user_id = as_users.user_id
        AND as_user_roles.role_id = as_users.user_role",
        ["id" => MAXSession::get('user_id')]
    );

    if (!$result) {
        return null;
    }

    $result = $result[0];

    return (object)[
        'id' => (int)$result['user_id'],
        'email' => $result['email'],
        'username' => $result['username'],
        'first_name' => $result['first_name'],
        'last_name' => $result['last_name'],
        'confirmed' => $result['confirmed'] == 'Y',
        'role' => $result['role'],
        'role_id' => (int)$result['user_role'],
        'phone' => $result['phone'],
        'address' => $result['address'],
        'is_banned' => $result['banned'] == 'Y',
        'is_admin' => strtolower($result['role']) === 'admin',
        'last_login' => $result['last_login']
    ];
};

MAXContainer::setContainer($container);

if (isset($_GET['lang'])) {
    MAXLang::setLanguage($_GET['lang']);
}


//if ($_SERVER['REQUEST_METHOD'] == 'POST' && !MAXCsrf::validate($_POST)) {
//    die('Invalid CSRF token.');
//}
