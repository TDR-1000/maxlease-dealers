<?php
  $pageName = '404';
  include 'includes/header.php';

  $db = app('db');

  $check = $db->select(
    "SELECT * FROM `as_offerte` WHERE `refkey` = :id",
    array("id" => $_GET['refkey'])
  );

  if ($check[0]['voertuig_id'] == 0) {

    $result = $db->select(
      "SELECT * FROM `as_offerte` WHERE `refkey` = :id",
      array("id" => $_GET['refkey'])
    );

    if ($result[0]['aanhef'] == 1) {
      $aanhef = 'heer';
    } else if ($result[0]['aanhef'] == 2) {
      $aanhef = 'mevrouw';
    } else {
      $aanhef = 'heer/mevrouw';
    }

    $achternaam = $result[0]['achternaam'];
    $merk = $result[0]['merk'];
    $afbeelding = 'images/hidden-car.png';
  } else {
    $result = $db->select(
      "SELECT * FROM `as_offerte`,`as_voertuig_media` WHERE `as_offerte`.`voertuig_id` = `as_voertuig_media`.`voertuig_id` AND `as_voertuig_media`.`media_first_photo` = 1  AND `refkey` = :id",
      array("id" => $_GET['refkey'])
    );

    if ($result[0]['aanhef'] == 1) {
      $aanhef = 'heer';
    } else if ($result[0]['aanhef'] == 2) {
      $aanhef = 'mevrouw';
    } else {
      $aanhef = 'heer/mevrouw';
    }

    $achternaam = $result[0]['achternaam'];
    $merk = $result[0]['merk'];
    $afbeelding = $result[0]['media_original_url'];
  }

?>

<div class="wrapper ovh">
  <div class="preloader"></div>

  <?php 
    include 'includes/navbar.php';
    include 'includes/mobile-navbar.php'; 
  ?>

  <section class="our-service">
    <div class="container">
      <form action="berekenen" method="POST">
        <div class="row justify-content-md-center">
          <div class="col-lg-7 col-xl-6">
            <h1 class="mb50">Aanvraag succesvol ontvangen</h1>
            <h4>Beste <?= $aanhef ?> <?= $achternaam ?>,</h4>
            <p>Uw offerte voor dit voertuig is succesvol aangevraagd. U wilt natuurlijk zo snel mogelijk in uw nieuwe <?= $merk ?> zitten.</p>
            <p>Wij zullen zo snel mogelijk contact met u opnemen om dit te kunnen realiseren.</p>
            <p class="mt-3">Mocht u nog vragen hebben over uw offerteaanvraag of andere zaken? Dan kunt u ons te allen tijde bereiken via telefoonnummer <b>085 0685 620</b> of per e-mail op <b><a href="mailto:info@maxlease.nl" title="email Max Lease">info@maxlease.nl</a></b>.</p>
          </div>
          <div class="col-lg-5 col-xl-4">
            <img class="br-8" src="<?= $afbeelding ?>" />
          </div>
        </div>
    </div>
  </section>

  <section class="our-blog pb90">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-lg-10">
          <div class="main-title">
            <h3 class="w-100 text-center">Tip! Lees nu alles over financial lease in onze blogs</h3>
          </div>
        </div>
      </div>
      <div class="row justify-content-md-center">
        <div class="col-lg-10">
          <div class="row">
            <?= recenteBlog(3) ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php 
    include 'includes/footerbar.php';
    echo '</div>';
    include 'includes/footer.php'; 
  ?>