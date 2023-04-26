<?php
// AGB: bepaal of site live of lokaal bezocht wordt
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
  $siteStatus  = "live";
  $minified = "min.";
} else {
  $siteStatus  = "lokaal";
  $minified = "";
}

// forceer browser nieuwe versie van css/js in te laden ipv cache
$versie = "3.22b";

include dirname(__FILE__) . '/../backoffice/MAXEngine/MAX.php';

// AGB: voeg '$detect = new Mobile_Detect;' toe aan pagina waar je devicetype wilt checken
require_once dirname(__FILE__) . '/../plugins/Mobile_Detect.php';

$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

if (app('login')->isLoggedIn()) {
  $currentUser = app('current_user');
} else {
  redirect('login');
}
$db = app('db');
$dealer = $db->select(
  "SELECT * FROM `as_dealers` WHERE `dealer_id` = :id",
  array ("id" => $currentUser->dealer_id)
);
?>

<!DOCTYPE html>
<html lang="nl" class="js">

<head>
  <base href="<?= WEBSITE_DOMAIN ?>" />
  <meta charset="utf-8">
  <meta name="author" content="MarketingOptimaal">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Lease oplossingen voor de zakelijke markt. Direct contact: 085 0685 620" />
  <!-- Fav Icon  -->
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png" />
  <link rel="apple-touch-icon" type="image/png" href="images/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="192x192" href="images/android-chrome-192x192" />
  <link rel="icon" type="image/png" sizes="512x512" href="images/android-chrome-512x512" />

  <meta name="apple-mobile-web-app-title" content="Max Lease" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <!-- Page Title  -->
  <title>Max Lease | Uw partner in financial lease</title>

  <link rel="preload" href="elements/assets/css/maxadmin.css?ver=3.1.2" as="style" />
  <!-- StyleSheets  -->
  <link rel="stylesheet" href="elements/assets/css/maxadmin.css?ver=3.1.2">
  <link id="skin-default" rel="stylesheet" href="elements/assets/css/theme.css?ver=3.1.2">
  <link rel="stylesheet" href="https://kit.fontawesome.com/6f2d558395.css" crossorigin="anonymous">
  <link rel="stylesheet" href="css/kentekenplaat.min.css" />

  <link rel="stylesheet" href="magnific-popup/magnific-popup.css">

</head>

<?php if (isset($WYSeditorNeeded)) { ?>
  <script src="https://cdn.tiny.cloud/1/k1cilkbvcvjueskjeet0286j8vtw7be1jpkoguq77esafafr/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<?php } ?>