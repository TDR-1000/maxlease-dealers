<?php

include "backoffice/MAXEngine/MAX.php";

if (app('login')->isLoggedIn()) {
    redirect('index.php');
}

$token = app('register')->socialToken();
MAXSession::set('as_social_token', $token);
app('register')->botProtection();
?>
<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Login extra/intra-net Max Lease">
    <meta name="author" content="Marketing Optimaal B.V.">

    <title>Login | <?= WEBSITE_NAME ?></title>

    <link href="images/favicon.png" rel="icon">

    <!-- // Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet">
    <!-- Google Web Fonts // -->

    <!-- // Font Awesome 5 Free -->
    <link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous" rel="stylesheet">
    <!-- Font Awesome 5 Free // -->

    <!-- // Template CSS files -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <!-- Template CSS files  // -->
</head>

<body>
    <!-- // Preloader -->
    <div id="nm-preloader" class="nm-aic nm-vh-md-100">
        <div class="nm-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Preloader // -->

    <main class="d-flex">
        <div class="container main-container">
            <div class="row nm-aic">
                <div class="col-md-6 col-lg-5 offset-lg-1 nm-mb-1 nm-mb-md-1">
                    <div class="card">
                        <div class="card-content">
                            <div class="form-wrapper active" id="login">
                                <h2 class="nm-tc nm-mb-1">Inloggen Intranet</h2>
                                <form class="form-horizontal">
                                    <!-- start: Username -->
                                    <div class="mb-3">
                                        <label for="login-username">
                                            Gebruikersnaam
                                        </label>
                                        <input type="text" name="username" class="form-control">
                                    </div>
                                    <!-- end: Username -->

                                    <!-- start: Password -->
                                    <div class="mb-3">
                                        <label>
                                            Wachtwoord
                                        </label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <!-- end: Password -->

                                    <div>
                                        <a href="#forgot" class="form-change text-decoration-none mb-1">
                                            Wachtwoord vergeten?
                                        </a>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" id="btn-login" class="btn btn-block btn-primary text-uppercase nm-btn mt-10" data-loading-text="Inloggen...">
                                            Inloggen
                                        </button>
                                    </div>

                                    <div class="row social nm-mb-1">
                                    </div>
                                </form>
                            </div>

                            <div class="form-wrapper" id="forgot">
                                <h2 class="nm-tc nm-mb-1">Wachtwoord vergeten</h2>

                                <form id="forgot-pass-form">
                                    <div class="mb-3">
                                        <label>
                                            Email
                                        </label>
                                        <input type="email" name="email" class="form-control">
                                    </div>

                                    <div class="d-grid">
                                        <button id="btn-forgot-password" type="submit" class="btn btn-block btn-primary text-uppercase nm-btn">
                                            Wachtwoord resetten
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>

    <!-- // Vendor JS files -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Vendor JS files // -->

    <!-- Template JS files // -->
    <script src="js/login.js"></script>
    <!-- Template JS files // -->

    <script src="backoffice/assets/js/vendor/sha512.js"></script>
    <script src="backoffice/assets/js/vendor/jquery.min.js"></script>
    <script src="backoffice/assets/js/vendor/jquery-validate/jquery.validate.min.js"></script>
    <script src="backoffice/assets/js/app/bootstrap.php"></script>
    <script src="backoffice/assets/js/app/common.js"></script>
    <?php if (MAXLang::getLanguage() != DEFAULT_LANGUAGE) : ?>
        <script src="backoffice/assets/js/vendor/jquery-validate/localization/messages_<?= MAXLang::getLanguage() ?>.js"></script>
    <?php endif; ?>

    <!-- Page Scripts -->
    <script type="text/javascript" src="backoffice/assets/js/app/login.js"></script>
    <script type="text/javascript" src="backoffice/assets/js/app/register.js"></script>
    <script type="text/javascript" src="backoffice/assets/js/app/passwordreset.js"></script>

</body>

</html>