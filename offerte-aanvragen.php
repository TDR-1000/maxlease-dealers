<?php
  $pageName = 'auto';
  $openGraph = '<meta property="og:title" content="Max Lease | Uw partner in financial lease" />
  <meta property="og:description" content="Eerste test" />
  <meta property="og:image" content="http://localhost:8888/max-lease/images/autos/social/' . $_GET['prettylink'] . '.png" />';
  include 'includes/header.php';
?>

<div class="wrapper ovh">
  <div class="preloader"></div>

<?php
  include 'includes/navbar.php';
  include 'includes/mobile-navbar.php';
  redirect('berekenen');
?>