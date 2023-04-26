<?php

include dirname(__FILE__) . '/../MAXEngine/MAX.php';

if (! app('login')->isLoggedIn()) {
    redirect("login.php");
}

$currentUser = app('current_user');
?>
<!doctype html>
<html lang="<?= MAXLang::getLanguage() ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Milos Stojanovic (@loshmis)">

        <title><?= trans('home') ?> | <?= WEBSITE_NAME ?></title>

        <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" media="all" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" media="all" />
        <link rel="stylesheet" href="assets/css/app.css" type="text/css" media="all" />
    </head>

    <body>
        <div class="cover-container d-flex flex-column">
            <?php include 'navbar.php'; ?>

            <!-- start: container -->
            <div class="container pt-4">
