<?php
    $pageName = 'auto';
    $openGraph = '<meta property="og:title" content="Max Lease | 085 0685 620" />
    <meta property="og:description" content="Deze auto voordelig zakelijk leasen?" />
    <meta property="og:image" content="http://maxlease.nl/images/autos/social/' . $_GET['prettylink'] . '.png" />';
    include 'includes/header.php';
?>

<div class="wrapper ovh">
  <?php
    include 'includes/navbar.php';
    if ($deviceType == "phone") { include 'includes/mobile-navbar.php'; }

    $db = app('db');
    $prettylink = $_GET['prettylink'];
    $voertuig = $db->select(
      "SELECT * FROM `as_voertuig` WHERE `pretty_url_website` = :prettyurl",
      array("prettyurl" => $prettylink)
    );

    $afbeeldingen = $db->select(
      "SELECT * FROM `as_voertuig_media` WHERE `voertuig_id` = :voertuig_id",
      array("voertuig_id" => $voertuig[0]['voertuig_basisgegevens_ID'])
    );

    if (!$voertuig) {
      redirect('404');
    }

    /* benaming categorie waar huidig voertuig onder valt */
    if ($voertuig[0]['voertuig_basisgegevens_soortvoertuig'] == 'AUTO') {
      $displayVoertuigCat = "auto's";
      $displayVoertuigFilter = "auto";
      $displayVoertuigCounter = voertuigCounterPersonen();
    } else if ($voertuig[0]['voertuig_basisgegevens_soortvoertuig'] == 'BEDRIJF') {
      $displayVoertuigCat = "bedrijfswagens";
      $displayVoertuigFilter = "bedrijf";
      $displayVoertuigCounter = voertuigCounterBedrijf();
    } else {
      $displayVoertuigCat = "auto's en bedrijfswagens";
      $displayVoertuigFilter = "";
      $displayVoertuigCounter = voorraadCounter();
    }

  ?>
  <section class="our-agent-single bgc-E7EBF3 pb10 mt70-992 pt30" id="cartitle">
    <div class="container">
      <div class="row mb0">
        <div class="col-lg-7 col-xl-7">
          <div class="single_page_heading_content">
            <div class="car_single_content_wrapper">
              <h2 class="title"><?= $voertuig[0]['voertuig_basisgegevens_merk'] ?> <?= $voertuig[0]['voertuig_basisgegevens_model'] ?></h2> <span><?php if($voertuig[0]['voertuig_basisgegevens_soortvoertuig'] == 'BEDRIJF'){ ?>
                <div class="totaaltextbox"><span class="finleasebedrag">€ <?= number_format($voertuig[0]['voertuig_financieel_verkoopprijs'], 0, ",", ".") ?>,-</span><span class="btw"><?php if ($voertuig[0]['voertuig_financieel_BTW'] == 1) {  if($voertuig[0]['voertuig_basisgegevens_soortvoertuig'] == 'BEDRIJF'){ ?> excl. BTW <?php }else{ ?> incl. BTW <?php } } else { ?> Marge auto <?php } ?></span></div>
            <?php } ?></span>
              <p class="para"><?= htmlspecialchars_decode($voertuig[0]['voertuig_basisgegevens_type']) ?></p>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-xl-5 d-none">
          <div class="row mb0">
            <div class="col-lg-6 col-xl-6">
              <div class="single_page_heading_content text-start text-lg-end">
                <div class="price_content">
                  <div class="price mt10 mb10 mt10-md">
                    <div class="offer_btns">
                      <div class="text-end">
                        <button class="btn ofr_btn2 btn-block mt0 mb20">
                          <span class="flaticon-profit-report mr10 fz18 vam"></span>Rapport downloaden
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-xl-6 d-none">
              <div class="single_page_heading_content text-start text-lg-end">
                <div class="price_content">
                  <div class="price mt10 mb10 mt10-md">
                    <div class="offer_btns">
                      <div class="text-end">
                        <button class="btn btn-thm ofr_btn1 btn-block mt0 mb20">
                          <span class="flaticon-profit-report mr10 fz18 vam"></span>Offerte aanvragen
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="our-agent-single bgc-ff pb0 mt70-992 pt30" id="cargallery">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-xl-7">
          <div class="row">
            <div class="col-12">
              <div class="outer">
                <div id="big" class="owl-carousel owl-theme">
                  <?php
                    foreach ($afbeeldingen as $afbeelding) {

                      if($afbeelding['media_first_photo'] == 1){
                        if ($afbeelding['img_available'] == 1) {
                          $showthumbs = true;
                          echo '<div class="item" style="background: url(images/uploads/voertuigen/'.$afbeelding['media_image_url'] . ') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"></div>';
                          $afbeeldingSticky = 'images/uploads/voertuigen/'.$afbeelding['media_image_url'];
                        } else {
                          $showthumbs = false;
                          echo '<div class="item" style="background: url(https://cdn.imagin.studio/getImage?customer=img&make='.$voertuig[0]['voertuig_basisgegevens_merk'].'&modelFamily='.$voertuig[0]['voertuig_basisgegevens_model'].'&width=1024&zoomtype=relative&countryCode=NL&licenseplateNumber=MAX&aspectRatio=4:3&margins=0&zoomLevel=60&groundplaneadjustment=0&v3=true&angle=23) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"><div class="tag render">Let op: de kleur en staat van de auto kan afwijken van de tijdelijke afbeelding</div></div>';
                          $afbeeldingSticky = 'https://cdn.imagin.studio/getImage?customer=img&make='.$voertuig[0]['voertuig_basisgegevens_merk'].'&modelFamily='.$voertuig[0]['voertuig_basisgegevens_model'].'&width=1024&zoomtype=relative&countryCode=NL&licenseplateNumber=MAX&aspectRatio=4:3&margins=0&zoomLevel=60&groundplaneadjustment=0&v3=true&angle=23';
                        }
                        } else {
                        echo '<div class="item" style="background: url(' . $afbeelding['media_original_url'] . ') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"></div>';
                      }
                    }
                  ?>
                </div>
              <?php if($showthumbs == true){ ?>
                <div id="thumbs" class="owl-carousel owl-theme">
                  <?php
                    foreach ($afbeeldingen as $afbeelding) {
                      echo '<div class="item" style="background: url(' . $afbeelding['media_original_url'] . ') no-repeat center center fixed; background-size: cover;"></div>';
                    }
                    ?>
                </div>
              <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-xl-5">
          <div class="leaseboxtext">
            <h3 class="mb0 txtc-prim text-center"><i class="fa-solid fa-calculator"></i> Bereken <span class="disable-mobile">financial </span>lease termijn</h3>
            <?php if($voertuig[0]['voertuig_basisgegevens_soortvoertuig'] == 'BEDRIJF'){ ?>
              <div class="totaaltextbox"><span class="finleasebedrag">€ <?= number_format($voertuig[0]['voertuig_financieel_verkoopprijs'] * 1.21, 2, ",", ".") ?></span><span class="btw"><?php if ($voertuig[0]['voertuig_financieel_BTW'] == 1) {  if($voertuig[0]['voertuig_basisgegevens_soortvoertuig'] == 'BEDRIJF'){ ?> incl. BTW <?php }else{ ?> incl. BTW <?php } } else { ?> Marge auto <?php } ?></span></div>
            <?php }else{ ?>
              <div class="totaaltextbox"><span class="finleasebedrag">€ <?= number_format($voertuig[0]['voertuig_financieel_verkoopprijs'], 0, ",", ".") ?>,-</span><span class="btw"><?php if ($voertuig[0]['voertuig_financieel_BTW'] == 1) {  if($voertuig[0]['voertuig_basisgegevens_soortvoertuig'] == 'BEDRIJF'){ ?> excl. BTW <?php }else{ ?> incl. BTW <?php } } else { ?> Marge auto <?php } ?></span></div>
            <?php } ?>
          </div>
          <div class="sidebar_seller_contact" id="sticky-element">
            <div class="form-group row mb-3">
              <?php
                $aanbetalingsbedrag = checkAanbetaling($voertuig[0]['voertuig_financieel_verkoopprijs'], $voertuig[0]['voertuig_financieel_prijs_in_ex_BTW'], $voertuig[0]['voertuig_financieel_BTW']);
                $autoprijs = $voertuig[0]['voertuig_financieel_verkoopprijs'];
                $slottermijnecho = $voertuig[0]['voertuig_financieel_verkoopprijs'] * 0.15;
              ?>
              <style>
                .col-form-label {
                  height: 50px;
                  line-height: 50px;
                  padding-top: 0;
                  padding-bottom: 0;
                  margin:0
                }
              </style>

              <form id="offerteaanvragen" action="berekenen" method="POST">
                <input type="hidden" name="aankoopbedrag" value="<?= $voertuig[0]['voertuig_financieel_verkoopprijs']; ?>" />
                <input type="hidden" name="kenteken" value="<?= $voertuig[0]['voertuig_basisgegevens_kenteken']; ?>" />
                <input type="hidden" name="merk" value="<?= $voertuig[0]['voertuig_basisgegevens_merk']; ?>" />
                <input type="hidden" name="model" value="<?= $voertuig[0]['voertuig_basisgegevens_model']; ?>" />
                <input type="hidden" name="link" value="https://maxlease.nl/i/<?= $_GET['prettylink'] ?>" />
                <input type="hidden" name="voertuig_id" value="<?= $voertuig[0]['voertuig_basisgegevens_ID']; ?>" />
                <input type="hidden" name="formsubmitted" value="autopage" />
                <input type="hidden" name="device" value="<?=$deviceType?>" />

                <?php if($deviceType == "phone"){ ?>
                <div class="form-group row g-2 mb-3">
                  <div class="col-6">
                    <label for="slottermijnfield" class="col-sm-4 col-form-label">Slottermijn</label>
                    <input type="text" class="form-control eurokr sum" name="slottermijn" id="slottermijnfield" value="<?= $slottermijnecho ?>" inputmode="numeric" placeholder="Slottermijn" />
                  </div>
                  <div class="col-6">
                    <label for="aanbetalingfield" class="col-sm-4 col-form-label">Aanbetaling</label>
                    <input type="text" name="aanbetaling" class="form-control eurokr sum" id="aanbetalingfield" inputmode="numeric" min="<?= $aanbetalingsbedrag ?>" value="<?= $aanbetalingsbedrag ?>" placeholder="Aanbetaling" />
                  </div>
                </div>

                <?php } else { ?>
                <div class="form-group row mb-3">
                  <label for="aanbetaling" class="col-sm-4 col-form-label">Aanbetaling <i class="fa-duotone fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Optioneel: hier kunt u aangeven of u een gedeelte wil aanbetalen. Hoe hoger de aanbetaling, des te lager uw maandlasten zullen zijn."></i></label>
                  <div class="col-sm-8">
                    <input type="text" name="aanbetaling" class="form-control eurokr sum" id="aanbetalingfield" inputmode="numeric" min="<?= $aanbetalingsbedrag ?>" value="<?= $aanbetalingsbedrag ?>" placeholder="Aanbetaling" />
                  </div>
                </div>
              <?php } ?>

                <div class="form-group row mb-3">
                  <label for="looptijd_maand" class="col-sm-4 col-form-label">Looptijd maanden</label>
                  <div class="col-sm-8">
                    <div class="row g-2">
                      <label class="labl col">
                        <input type="radio" name="looptijd_maand" id="looptijd_maand" value="24" />
                        <div>24</div>
                      </label>
                      <label class="labl col">
                        <input type="radio" name="looptijd_maand" id="looptijd_maand" value="36" />
                        <div>36</div>
                      </label>
                      <label class="labl col">
                        <input type="radio" name="looptijd_maand" id="looptijd_maand" value="48" />
                        <div>48</div>
                      </label>
                      <label class="labl col">
                        <input type="radio" name="looptijd_maand" id="looptijd_maand" value="60" />
                        <div>60</div>
                      </label>
                      <label class="labl col">
                        <input type="radio" name="looptijd_maand" id="looptijd_maand" value="72" checked="checked" />
                        <div>72</div>
                      </label>
                    </div>
                  </div>
                </div>
            <?php if($deviceType !== "phone"){ ?>
              <div class="form-group row mb-3">
                <label for="inputPassword" class="col-sm-4 col-form-label">Slottermijn <i class="fa-duotone fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Met de slottermijn 'bevriest' u een deel van de financiering. Over de slottermijn betaalt u alleen rente en geen aflossing."></i></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control eurokr sum" name="slottermijn" id="slottermijnfield" value="<?= $slottermijnecho ?>" inputmode="numeric" placeholder="Slottermijn" />
                </div>
              </div>
            <?php } ?>

              <div class="form-group row mb-3">
                <label class="col-sm-4 col-form-label">Maandbedrag <i class="fa-duotone fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Het bedrag dat u maandelijks betaalt. Dit is mede gebaseerd op de aanbetaling, slottermijn en gekozen termijnen."></i></label>
                <div class="col-sm-8">
                  <div class="prijspmoverview">
                    &euro; <?= renteCalc($voertuig[0]['voertuig_financieel_verkoopprijs'], 72, $voertuig[0]['voertuig_financieel_BTW'], 1) ?><span>p/m</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="offerteaanvraagboxtext bgc-E7EBF3">
              <button class="btn btn-thm advnc_search_form_btn fs-127 w-100 mb-2" type="submit">Vraag gratis een offerte aan</button>
              <ul class="fa-ul zekerheden-ch mb-0">
                <li><span class="fa-li"><i class="fa-solid checked-groen fa-check-square"></i></span>Geheel vrijblijvend, geen verplichtingen</li>
                <li><span class="fa-li"><i class="fa-solid checked-groen fa-check-square"></i></span>Leasen zonder jaarcijfers</li>
                <li class="mb-0"><span class="fa-li"><i class="fa-solid checked-groen fa-check-square"></i></span>Rij morgen al in uw nieuwe auto</li>
              </ul>
            </div>
            </form>
            <div class="tip-contact row text-center justify-content-between">
            <div class="col-sm-auto text-sm-start ps-0">
                <div class="share align-items-center justify-content-between">
                  <ul class="list-inline mb-0">
                    <li class="list-inline-item"><span id="shareFacebook"></span></li>
                    <li class="list-inline-item"><span id="shareTwitter"></span></li>
                    <li class="list-inline-item"><span id="shareMail"></span></li>
                    <li class="list-inline-item"><span id="shareLinkedin"></span></li>
                    <li class="list-inline-item"><span id="shareWhatsapp"></span></li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-auto text-sm-end">
              <?php $shareURL = true;
                $shareTitle = '';
                $siteURL = ''; ?>
                <script>
                  var uri = "https://maxlease.nl/<?= $siteURL . $shareURL ?>";
                  var resuri = encodeURIComponent(uri);
                  var titel = "<?= $shareTitle ?>";
                  var restitel = encodeURIComponent(titel);
                  var check = "Check deze link: ";
                  var rescheck = encodeURIComponent(check);

                  document.getElementById("shareFacebook").innerHTML = '<a class="share-icon icfacebook" href="https://www.facebook.com/sharer/sharer.php?u=' + resuri + '" title="deel dit artikel op Facebook" target="_blank"><span class="fab fa-facebook-f"></span></a>';
                  document.getElementById("shareTwitter").innerHTML = '<a class="share-icon ictwitter" href="https://twitter.com/intent/tweet?text=' + rescheck + '%0A' + resuri + '" title="deel dit artikel op Twitter" target="_blank"><span class="fab fa-twitter"></span></a>';
                  document.getElementById("shareMail").innerHTML = '<a class="share-icon icmail" href="mailto:?subject=ik%20las%20dit%20leuke%20artikel&body=Ik%20zag%20onderstaand%20artikel%20en%20dacht%20je%20dit%20wellicht%20interessant%20zou%20vinden%3A%0A%0A' + restitel + '%0A' + resuri + '" title="mail dit artikel" target="_blank"><span class="fa fa-envelope"></span></a>';
                  document.getElementById("shareLinkedin").innerHTML = '<a class="share-icon iclinkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=' + resuri + '" title="deel dit artikel op LinkedIn" target="_blank"><span class="fab fa-linkedin-in"></span></a>';
                  document.getElementById("shareWhatsapp").innerHTML = '<a class="share-icon icwhatsapp" href="https://wa.me/?text=' + rescheck + '%0A' + resuri + '" title="deel dit artikel via Whatsapp" target="_blank"><span class="fab fa-whatsapp"></span></a>';
                </script>
                <a href="javascript:void(Tawk_API.toggle())" class="contacttip"><i class="fa-solid fa-circle-question"></i> Vraag het ons</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <div class="container" id="reviews">
    <div class="row">
      <div class="col-12 review-box">
    <?php if($deviceType == "phone"){ ?>
        Onze klanten beoordelen ons met een <span class="score"><span class="cijfer"><?= $getal ?></span><?php $getal = ReviewShower(1); echo starCounter($getal); ?></span>
        <span>uit <?= ReviewShower(2) ?> reviews op <a href="https://www.klantenvertellen.nl/reviews/1032303/max_lease" target="_blank" class="klantenvertellen_url underline">klantenvertellen.nl</a></span>
    <?php } else { ?>
        Onze klanten beoordelen ons met een <span class="score"><?php $getal = ReviewShower(1); echo starCounter($getal); ?><span class="cijfer"><?= $getal ?></span></span>
        <span>uit <?= ReviewShower(2) ?> reviews op <a href="https://www.klantenvertellen.nl/reviews/1032303/max_lease" target="_blank" class="klantenvertellen_url underline">klantenvertellen.nl</a></span>
    <?php } ?>
      </div>
    </div>
  </div>
  <div class="sticky-sticky" id="stickyHeader">
    <div class="container">
      <div class="row mb-sm-0">
        <div class="col-sm-1 col-2">
          <img src="<?= $afbeeldingSticky ?>" loading="lazy" />
        </div>
        <div class="col-sm-7 col-5">
          <h4 class="title sticky-layer-title"><?= $voertuig[0]['voertuig_basisgegevens_merk'] ?> <?= $voertuig[0]['voertuig_basisgegevens_model'] ?></h4>
          <?php $typeshort = strlen($voertuig[0]['voertuig_basisgegevens_type']) > 100 ? substr($voertuig[0]['voertuig_basisgegevens_type'], 0, 100) . "..." : $voertuig[0]['voertuig_basisgegevens_type']; ?>
          <p class="para sticky-layer-para"><?= htmlspecialchars_decode($typeshort) ?></p>
        </div>
        <div class="col no-desktop">
          <div class="single_page_heading_content">
            <div class="price_content">
              <div class="offer_btns text-end">
                <button class="btn btn-thm ofr_btn1 btn-block button-sticky-layer" form="offerteaanvragen" type="submit">
                  <span class="flaticon-profit-report fz18 vam"></span> Offerte aanvragen
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 disable-mobile">
          <div class="row mb0 justify-content-end">
            <div class="col-lg-6 col-xl-6 d-none">
              <div class="single_page_heading_content text-start text-lg-end">
                <div class="price_content">
                  <div class="price">
                    <div class="offer_btns">
                      <div class="text-end">
                        <button class="btn ofr_btn2 btn-block mt0 mb20 button-sticky-layer">
                          <span class="flaticon-profit-report mr10 fz18 vam"></span>Rapport downloaden
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-xl-6">
              <div class="single_page_heading_content text-start text-lg-end">
                <div class="price_content">
                  <div class="price">
                    <div class="offer_btns">
                      <div class="text-end">
                        <button class="btn btn-thm ofr_btn1 btn-block mt0 mb0 button-sticky-layer" form="offerteaanvragen" type="submit"><span class="flaticon-profit-report mr10 fz18 vam"></span>Offerte aanvragen</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="break"></div>

  <section class="our-agent-single bgc-ff pb50 mt70-992 pt30">
    <div class="container">
      <div class="row mb0">
        <div class="col-12">
          <div class="popular_listing_sliders single_page6_tabs row">
            <div class="nav nav-tabs col-12" role="tablist">
              <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-description" role="tab" aria-controls="nav-description" aria-selected="true">Specificaties</button>
              <button class="nav-link" id="nav-overview-tab" data-bs-toggle="tab" data-bs-target="#nav-overview" role="tab" aria-controls="nav-overview" aria-selected="false">Opties</button>
              <button class="nav-link" id="nav-features-tab" data-bs-toggle="tab" data-bs-target="#nav-features" role="tab" aria-controls="nav-features" aria-selected="false">Omschrijving</button>
            </div>
            <div class="tab-content col-12" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                <div class="row">
                  <div class="col-sm-6">
                    <h4 class="mb10">Algemeen</h4>
                    <table class="table-spec">
                      <tbody>
                        <tr class="kenteken">
                          <td>Kenteken</td>
                          <th><input name="form_name" class="form-control kentekenplaat mini-kenteken" disabled type="text" value="<?= $voertuig[0]['voertuig_basisgegevens_kenteken'] ?>" maxlength="8"></th>
                        </tr>
                        <tr>
                          <td>Merk</td>
                          <th><?= $voertuig[0]['voertuig_basisgegevens_merk'] ?></th>
                        </tr>
                        <tr>
                          <td>Model</td>
                          <th><?= $voertuig[0]['voertuig_basisgegevens_model'] ?></th>
                        </tr>
                        <tr>
                          <td>Carrosserievorm</td>
                          <th><?= $voertuig[0]['voertuig_carrosseriegegevens_carrosserie'] ?></th>
                        </tr>
                        <tr>
                          <td>Km. stand</td>
                          <th><?= $voertuig[0]['voertuig_historie_tellerstand_stand'] ?></th>
                        </tr>
                        <tr>
                          <td>Bouwjaar</td>
                          <th><?= $voertuig[0]['voertuig_historie_bouwjaar_jaar'] ?></th>
                        </tr>
                        <tr>
                          <td>Datum Deel 1</td>
                          <th><?= $voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'] ?></th>
                        </tr>
                        <tr>
                          <td>Brandstof</td>
                          <th><?= brandstofCheck($voertuig[0]['voertuig_basisgegevens_brandstof']); ?></th>
                        </tr>
                        <tr>
                          <td>Transmissie</td>
                          <th><?= transmissieCheck($voertuig[0]['voertuig_techischegegevens_transmissie']) ?></th>
                        </tr>
                        <tr>
                          <td>Aantal zitplaatsen</td>
                          <th><?= $voertuig[0]['voertuig_carrosseriegegevens_aantalZitplaatsen'] ?></th>
                        </tr>
                        <tr>
                          <td>Kleur</td>
                          <th><?= $voertuig[0]['voertuig_carrosseriegegevens_kleur'] ?></th>
                        </tr>
                        <tr>
                          <td>Bekleding</td>
                          <th><?= $voertuig[0]['voertuig_carrosseriegegevens_bekleding'] ?></th>
                        </tr>
                        <tr>
                          <td>BTW/Marge</td>
                          <th><?php if($voertuig[0]['voertuig_financieel_BTW'] == 1){ echo 'BTW'; } else { echo 'Marge'; } ?></th>
                        </tr>
                        <tr>
                          <td>Wegenbelasting</td>
                          <th><?php if($voertuig[0]['voertuig_financieel_wegenbelastingkwartaal_min'] == 0){ echo 'Onbekend'; } else{ ?>€ <?= $voertuig[0]['voertuig_financieel_wegenbelastingkwartaal_min'] ?> - € <?= $voertuig[0]['voertuig_financieel_wegenbelastingkwartaal_max'] ?> per kwartaal <?php } ?></th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-sm-6">
                    <h4 class="mb10">Technisch</h4>
                    <table class="table-spec">
                      <tbody>
                        <tr>
                          <td>Vermogen motor</td>
                          <th><?= $voertuig[0]['voertuig_techischegegevens_vermogenmotor_PK'] ?> pk (<?= $voertuig[0]['voertuig_techischegegevens_vermogenmotor_KW'] ?> kW)</th>
                        </tr>
                        <tr>
                          <td>Aantal cilinders</td>
                          <th><?= $voertuig[0]['voertuig_techischegegevens_cilinder_aantal'] ?></th>
                        </tr>
                        <tr>
                          <td>Cilinderinhoud</td>
                          <th><?= $voertuig[0]['voertuig_techischegegevens_cilinder_inhoud'] ?> cc</th>
                        </tr>
                        <tr>
                          <td>Gewicht (leeg)</td>
                          <th><?= $voertuig[0]['voertuig_carrosseriegegevens_massa'] ?> kg</th>
                        </tr>
                      </tbody>
                    </table>
                    <h4 class="mt30 mb10">Milieu en verbruik</h4>
                    <table class="table-spec" id="verbruik">
                      <tbody>
                        <tr>
                          <td>Gemiddeld verbruik</td>
                          <th><?php if($voertuig[0]['voertuig_milieu_gemiddeldverbruik'] < 1){ echo 'Onbekend'; }else{ ?><?= $voertuig[0]['voertuig_milieu_gemiddeldverbruik'] ?> l/100km <span>(1 op <?php echo number_format(100 / $voertuig[0]['voertuig_milieu_gemiddeldverbruik'],2); ?>)</span><?php } ?></th>
                        </tr>
                        <tr>
                          <td>Verbruik stad</td>
                          <th><?php if($voertuig[0]['voertuig_milieu_verbruikStad'] < 1){ echo 'Onbekend'; }else{ ?><?= $voertuig[0]['voertuig_milieu_verbruikStad'] ?> l/100km <span>(1 op <?php echo number_format(100 / $voertuig[0]['voertuig_milieu_verbruikStad'],2); ?>)</span><?php } ?></th>
                        </tr>
                        <tr>
                          <td>Verbruik snelweg</td>
                          <th><?php if($voertuig[0]['voertuig_milieu_verbruikSnelweg'] < 1){ echo 'Onbekend'; }else{ ?><?= $voertuig[0]['voertuig_milieu_verbruikSnelweg'] ?> l/100km <span>(1 op <?php echo number_format(100 / $voertuig[0]['voertuig_milieu_verbruikSnelweg'],2); ?>)</span><?php } ?></th>
                        </tr>
                      </tbody>
                    </table>
                    <div id="termijnen">
                      <div class="termijnen-box">
                        <div class="header-slot">
                          72 maanden
                        </div>
                        <div class="body-slot">
                          <span class="termijnen-prijs">€ <?= renteCalc($voertuig[0]['voertuig_financieel_verkoopprijs'], 72, $voertuig[0]['voertuig_financieel_BTW'], 1) ?><span class="periode">p/m</span></span>
                        </div>
                      </div>
                      <div class="termijnen-box">
                        <div class="header-slot">
                          60 maanden
                        </div>
                        <div class="body-slot">
                          <span class="termijnen-prijs">€ <?= renteCalc($voertuig[0]['voertuig_financieel_verkoopprijs'], 60, $voertuig[0]['voertuig_financieel_BTW'], 1) ?><span class="periode">p/m</span></span>
                        </div>
                      </div>
                      <div class="termijnen-box last">
                        <div class="header-slot">
                          48 maanden
                        </div>
                        <div class="body-slot">
                          <span class="termijnen-prijs">€ <?= renteCalc($voertuig[0]['voertuig_financieel_verkoopprijs'], 48, $voertuig[0]['voertuig_financieel_BTW'], 1) ?><span class="periode">p/m</span></span>
                        </div>
                      </div>
                      <div class="disclaimer">* Getoonde leasebedragen zijn incl. een slot&shy;termijn van <span class="text-nowrap">&euro; <?= number_format($voertuig[0]['voertuig_financieel_verkoopprijs'] * 0.15,2,",",".") ?></span>. Vraag naar de voorwaarden.</div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
                <?= CheckAndShowOpties('accessoires_comfort', $voertuig[0]['voertuig_basisgegevens_ID']) ?>
                <?= CheckAndShowOpties('accessoires_exterieur', $voertuig[0]['voertuig_basisgegevens_ID']) ?>
                <?= CheckAndShowOpties('accessoires_infotainment', $voertuig[0]['voertuig_basisgegevens_ID']) ?>
                <?= CheckAndShowOpties('accessoires_interieur', $voertuig[0]['voertuig_basisgegevens_ID']) ?>
                <?= CheckAndShowOpties('accessoires_Milieu', $voertuig[0]['voertuig_basisgegevens_ID']) ?>
                <?= CheckAndShowOpties('accessoires_Veiligheid', $voertuig[0]['voertuig_basisgegevens_ID']) ?>
                <?= CheckAndShowOpties('accessoires_Overige', $voertuig[0]['voertuig_basisgegevens_ID']) ?>
              </div>
              <div class="tab-pane fade" id="nav-features" role="tabpanel" aria-labelledby="nav-features-tab">
                <h4 class="mb10"><span class="text-nowrap">Max Lease</span> is <strong>de specialist</strong> in het leasen van <strong>gebruikte auto's en bedrijfswagens</strong>.</h4>
                <p>Bij <span class="text-nowrap">Max Lease</span> zoeken wij samen met u de gewenste (bestel)auto en verzorgen daarbij een passend lease&shy;contract. Omdat er zoveel lease&shy;maatschappijen zijn kunnen wij het voorstellen dat u door de bomen het bos niet meer ziet. Bij <span class="text-nowrap">Max Lease</span> werken wij samen met meerdere lease&shy;maatschappijen, zodat u van ons een scherpe maandprijs mag verwachten. Wij verzorgen zowel de levering van de auto, als het lease&shy;contract, waardoor u nergens naar hoeft om te kijken. <span class="text-nowrap">Max Lease</span> is er ook voor starters en zzp-ers. Ook als er geen jaar&shy;cijfers beschikbaar zijn, kan <span class="text-nowrap">Max Lease</span> u toch een lease aanbieden.</p>
                <h5>De belangrijkste punten van <span class="text-nowrap">Max Lease</span> nog even op een rijtje:</h5>
              <?php include 'includes/elements/zekerheden.php'; ?>
                <p>Vul gratis een offerte aanvraag&shy;formulier in op onze website en ontvang <strong>binnen 24 uur</strong> een reactie. <em>Vraag naar onze voorwaarden.</em></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="our-shop bg-grijs pb50">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="main-title text-center text-md-start">
        <?php if($deviceType == "phone"){ ?>
          <h2>Alternatieven:</h2>
        <?php } else { ?>
          <h2>Interessante alternatieven:</h2>
        <?php } ?>
        </div>
      </div>
      <div class="col-md-4">
        <div class="text-center text-md-end mb30-sm">
          <a href="voorraad?type=<?=$displayVoertuigFilter?>" class="more_listing" title="bekijk alle <?= $displayVoertuigCounter ?> voorradige <?= $displayVoertuigCat ?>">Bekijk alle <?= $displayVoertuigCounter ?> <?= $displayVoertuigCat ?><span class="icon"><span class="fas fa-plus"></span></span></a>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
      if ($voertuig[0]['voertuig_basisgegevens_soortvoertuig'] == 'AUTO') {
        displayAutoFronter();
      } else if ($voertuig[0]['voertuig_basisgegevens_soortvoertuig'] == 'BEDRIJF') {
        displayBedrijfFronter();
      } else {
        displayAutoFronter();
      }
      ?>
    </div>
    <div class="text-center">
      <a href="voorraad?type=<?=$displayVoertuigFilter?>" class="more_listing" title="bekijk alle <?= $displayVoertuigCounter ?> voorradige <?= $displayVoertuigCat ?>">Bekijk alle <?= $displayVoertuigCounter ?> <?= $displayVoertuigCat ?><span class="icon"><span class="fas fa-arrow-right"></span></span></a>
    </div>
  </div>
</section>


<?php

  // toon lijst met populaire leasemerken ('type', minimaal in database, aantal te tonen, kleur achtergrond wit/grijs/leeg)
  if($deviceType == "phone"){
    populaireMerken($displayVoertuigFilter,75,8,'');
  } else {
    populaireMerken($displayVoertuigFilter,55,12,'wit');
  }

  include 'includes/footerbar.php';

  echo '</div>';

  include 'includes/footer.php';

  ?>
