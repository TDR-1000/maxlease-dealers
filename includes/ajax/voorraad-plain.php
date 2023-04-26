<?php

  $dataset = 0;
  $filterquery = '';
  $orderChanger = '';
  $newURL = '';

  if (isset($params)) {
    if (!isset($params['type-auto']) || $params['type-auto'] == "Alles") {
      $filterquery .= '';
    } else {
      $filterquery .= "`as_voertuig`.`voertuig_basisgegevens_soortvoertuig` = '" . $params['type-auto'] . "' AND";
      $newURL .= '/type-auto:' . replaceFilterTermsEncode($params['type-auto']);
    }
    if (!isset($params['merk']) || $params['merk'] == "Alles") {
      $filterquery .= '';
    } else {
      $filterquery .= "`as_voertuig`.`voertuig_basisgegevens_merk` = '" . $params['merk'] . "' AND";
      $newURL .= '/merk:' . replaceFilterTermsEncode($params['merk']);
    }
    if (!isset($params['model']) || $params['model'] == "Alles") {
      $filterquery .= '';
    } else {
      $filterquery .= "`as_voertuig`.`voertuig_basisgegevens_model` = '" . $params['model'] . "' AND";
      $newURL .= '/model:' . replaceFilterTermsEncode($params['model']);
    }
    if (!isset($params['carrosserie']) || $params['carrosserie'] == "Alles") {
      $filterquery .= '';
    } else {
      $filterquery .= "`as_voertuig`.`voertuig_carrosseriegegevens_carrosserie` = '" . $params['carrosserie'] . "' AND";
      $newURL .= '/carrosserie:' . replaceFilterTermsEncode($params['carrosserie']);
    }

    if (!isset($params['bouwjaar-van']) || $params['bouwjaar-van'] == "Alles") {
      $filterquery .= '';
    } else {
      $bouwjaarVan_query = "`as_voertuig`.`voertuig_historie_bouwjaar_jaar` >= '" . $params['bouwjaar-van'] . "' AND";
      $newURL .= '/bouwjaar-van:' . replaceFilterTermsEncode($params['bouwjaar-van']);
    }

    if (!isset($params['bouwjaar-tot']) || $params['bouwjaar-tot'] == "Alles") {
      $filterquery .= '';
    } else {
      $filterquery .= "`as_voertuig`.`voertuig_historie_bouwjaar_jaar` <= '" . $params['bouwjaar-tot'] . "' AND";
      $newURL .= '/bouwjaar-tot:' . replaceFilterTermsEncode($params['bouwjaar-tot']);
    }

    if (!isset($params['km-van']) || $params['km-van'] == "Alles") {
      $filterquery .= '';
    } else {
      $filterquery .= "`as_voertuig`.`voertuig_historie_tellerstand_stand` >= '" . $params['km-van'] . "' AND ";
      $newURL .= '/km-van:' . replaceFilterTermsEncode($params['km-van']);
    }

    if (!isset($params['km-tot']) || $params['km-tot'] == "Alles") {
      $filterquery .= '';
    } else {
      $filterquery .= "`as_voertuig`.`voertuig_historie_tellerstand_stand` <= '" . $params['km-tot'] . "' AND ";
      $newURL .= '/km-tot:' . replaceFilterTermsEncode($params['km-tot']);
    }

    if (!isset($params['verkoopprijs-van']) || $params['verkoopprijs-van'] == "Alles") {
      $filterquery .= '';
    } else {
      $filterquery .= "`as_voertuig`.`voertuig_financieel_verkoopprijs` >= '" . $params['verkoopprijs-van'] . "' AND ";
      $newURL .= '/verkoopprijs-van:' . replaceFilterTermsEncode($params['verkoopprijs-van']);
    }

    if (!isset($params['verkoopprijs-tot']) || $params['verkoopprijs-tot'] == "Alles") {
      $filterquery .= '';
    } else {
      $filterquery .= "`as_voertuig`.`voertuig_financieel_verkoopprijs` <= '" . $params['verkoopprijs-tot'] . "' AND ";
      $newURL .= '/verkoopprijs-tot:' . replaceFilterTermsEncode($params['verkoopprijs-tot']);
    }

    if (!isset($params['kleur']) || $params['kleur'] == "Alles") {
      $filterquery .= '';
    } else {
      $filterquery .= "`as_voertuig`.`voertuig_carrosseriegegevens_kleur` = '" . $params['kleur'] . "' AND ";
      $newURL .= '/kleur:' . replaceFilterTermsEncode($params['kleur']);
    }

    if (!isset($params['transmissies']) || $params['transmissies'] == "Alles") {
      $filterquery .= '';
    } else {
      $filterquery .= "`as_voertuig`.`voertuig_techischegegevens_transmissie` = '" . $params['transmissies'] . "' AND ";
      $newURL .= '/transmissies:' . replaceFilterTermsEncode($params['transmissies']);
    }

    if (!isset($params['brandstoffen']) || $params['brandstoffen'] == "Alles") {
      $filterquery .= '';
    } else {
      $filterquery .= "`as_voertuig`.`voertuig_basisgegevens_brandstof` = '" . $params['brandstoffen'] . "' AND ";
      $newURL .= '/brandstoffen:' . replaceFilterTermsEncode($params['brandstoffen']);
    }

    if (!isset($params['btw-marge']) || $params['btw-marge'] == "Alles") {
      $filterquery .= '';
    } else {
      if ($params['btw-marge'] == 'marge') {
        $filterquery .= "`as_voertuig`.`voertuig_financieel_BTW` != 1 AND ";
      } else {
        $filterquery .= "`as_voertuig`.`voertuig_financieel_BTW` = 1 AND ";
      }
      $newURL .= '/btw-marge:' . replaceFilterTermsEncode($params['btw-marge']);
    }

    if (!isset($params['sortering']) || $params['sortering'] == "Alles") {
      $orderChanger = "ORDER BY `as_voertuig`.`voertuig_basisgegevens_ID` ASC";
      $newURL .= '';
    } else {
      if ($params['sortering'] == 'leasebedrag-oplopend') {
        $orderChanger = "ORDER BY `as_voertuig`.`voertuig_financieel_verkoopprijs` ASC";
        $newURL .= '/sortering:leasebedrag-oplopend';
      } else if ($params['sortering'] == 'leasebedrag-aflopend') {
        $orderChanger = "ORDER BY `as_voertuig`.`voertuig_financieel_verkoopprijs` DESC";
        $newURL .= '/sortering:leasebedrag-aflopend';
      } else if ($params['sortering'] == 'kmstand-aflopend') {
        $orderChanger = "ORDER BY `as_voertuig`.`voertuig_historie_tellerstand_stand` ASC";
        $newURL .= '/sortering:kmstand-aflopend';
      } else if ($params['sortering'] == 'kmstand-aflopend') {
        $orderChanger = "ORDER BY `as_voertuig`.`voertuig_historie_tellerstand_stand` DESC";
        $newURL .= '/sortering:kmstand-aflopend';
      } else if ($params['sortering'] == 'bouwjaar-aflopend') {
        $orderChanger = "ORDER BY `as_voertuig`.`voertuig_historie_bouwjaar_jaar` ASC";
        $newURL .= '/sortering:bouwjaar-aflopend';
      } else if ($params['sortering'] == 'bouwjaar-aflopend') {
        $orderChanger = "ORDER BY `as_voertuig`.`voertuig_historie_bouwjaar_jaar` DESC";
        $newURL .= '/sortering:bouwjaar-aflopend';
      } else if ($params['sortering'] == 'merk-aflopend') {
        $orderChanger = "ORDER BY `as_voertuig`.`voertuig_basisgegevens_merk` ASC";
        $newURL .= '/sortering:merk-aflopend';
      } else if ($params['sortering'] == 'merk-aflopend') {
        $orderChanger = "ORDER BY `as_voertuig`.`voertuig_basisgegevens_merk` DESC";
        $newURL .= '/sortering:merk-aflopend';
      } else {
        $orderChanger = "ORDER BY `as_voertuig`.`voertuig_basisgegevens_ID` ASC";
        $newURL .= '';
      }
    }
  }

  $result = $db->select(
    "SELECT * FROM `as_voertuig`,`as_voertuig_media` WHERE " . $filterquery . " `as_voertuig`.`voertuig_basisgegevens_ID`> :getdata AND `as_voertuig_media`.`media_first_photo` = 1 AND `as_voertuig`.`voertuig_basisgegevens_ID` = `as_voertuig_media`.`voertuig_id` " . $orderChanger . " LIMIT " . $pageCounter . "24",
    array("getdata" => $dataset)
  );

  $resultCounter = $db->select(
    "SELECT count(*) FROM `as_voertuig`,`as_voertuig_media` WHERE " . $filterquery . " `as_voertuig`.`voertuig_basisgegevens_ID`> :getdata AND `as_voertuig_media`.`media_first_photo` = 1 AND `as_voertuig`.`voertuig_basisgegevens_ID` = `as_voertuig_media`.`voertuig_id`  ORDER BY `as_voertuig`.`voertuig_basisgegevens_ID` ASC LIMIT 24",
    array("getdata" => $dataset)
  );

  foreach ($result as $voertuig) {

    $voertuig_type = strlen($voertuig['voertuig_basisgegevens_type']) > 30 ? substr($voertuig['voertuig_basisgegevens_type'], 0, 30) . "..." : $voertuig['voertuig_basisgegevens_type'];
    $brandstof = brandstofCheck($voertuig['voertuig_basisgegevens_brandstof']);
    $transmissie =  transmissieCheck($voertuig['voertuig_techischegegevens_transmissie']);

    if ($voertuig['voertuig_financieel_verkoopprijs'] == null || !isset($voertuig['voertuig_financieel_verkoopprijs'])) {
      $prijs = 'Onbekend';
    } else {
      $prijs = number_format((float)$voertuig['voertuig_financieel_verkoopprijs'], 0, ",", ".");
    }

    $prijspermaand = renteCalc((float)$voertuig['voertuig_financieel_verkoopprijs'], 72, $voertuig['voertuig_financieel_BTW'], 1);

    if ($voertuig['img_available'] == 1) {
      $afbeelding = 'images/uploads/voertuigen/' . $voertuig['media_image_url'];
      $thumbclass = "";
      $tagtext = '';
    } else {
      $afbeelding = 'https://cdn.imagin.studio/getImage?customer=img&make=' . $voertuig['voertuig_basisgegevens_merk'] . '&modelFamily=' . $voertuig['voertuig_basisgegevens_model'] . '&width=1024&zoomtype=relative&countryCode=NL&licenseplateNumber=MAX&aspectRatio=4:3&margins=0&zoomLevel=60&groundplaneadjustment=0&v3=true&angle=23';
      $thumbclass = "render";
      $tagtext = '<div class="tag">foto&apos;s volgen</div>';
    }

    if ($voertuig['voertuig_financieel_BTW'] == 1) {
      if ($voertuig['voertuig_basisgegevens_soortvoertuig'] == 'BEDRIJF') {
        $btwMargeCheck = "excl. BTW";
      } else {
        $btwMargeCheck = "incl. BTW";
      }
    } else {
      $btwMargeCheck = "Marge";
    }

    echo '
    <div class="col-sm-6 col-md-4 col-xxl-3">
      <div class="car-listing">
        <a class="text-white" href="i/' . $voertuig['pretty_url_website'] . '">
          <div class="thumb ' . $thumbclass . '">
            '. $tagtext .'
            <img src="' . $afbeelding . '" alt="' . $voertuig['voertuig_basisgegevens_merk'] . ' ' . $voertuig['voertuig_basisgegevens_model'] . '" loading="lazy" />
            <div class="thmb_cntnt2">
              <ul class="mb0">
                <li class="list-inline-item"><span class="flaticon-photo-camera mr3"></span></li>
              </ul>
            </div>
          </div>
        </a>
        <div class="details">
          <div class="wrapper pb-0">
            <h6 class="title">
              <a href="i/' . $voertuig['pretty_url_website'] . '">' . $voertuig['voertuig_basisgegevens_merk'] . ' ' . $voertuig['voertuig_basisgegevens_model'] . '</a>
            </h6>
            <p>' . $voertuig_type . '</p>
          </div>
          <div class="listing_footer">
            <table class="w-100 mb-3">
              <tr>
                <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . number_format((float)$voertuig['voertuig_historie_tellerstand_stand'], 0, ",", ".") . ' km</a></td>
                <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $brandstof . '</a></td>
              </tr>
              <tr>
                <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $transmissie . '</a></td>
                <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $voertuig['voertuig_historie_bouwjaar_jaar'] . '</a></td>
              </tr>
              <tr>
                <td><a href="i/' . $voertuig['pretty_url_website'] . '">€ ' . $prijs . '</a></td>
                <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $btwMargeCheck . '</a></td>
              </tr>
            </table>
          </div>
          <div class="listing_footer">
            <h5 class="price"><span>€ ' . $prijspermaand . ' </span>p/m</h5>
            <a class="btn btn-thm advnc_search_form_btn button-deal buttonaclass" href="i/' . $voertuig['pretty_url_website'] . '">Bekijk deal <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>';
    }

  if (!$result) { ?>
    <div class="d-flex justify-content-center align-items-center" id="main">
      <div class="inline-block align-middle">
        <h2 class="font-weight-normal lead" id="desc">Momenteel hebben wij geen auto's beschikbaar die voldoen aan je zoekcriteria.</h2>
        <p>We begrijpen dat je op zoek bent naar auto's, maar helaas hebben we momenteel geen auto's beschikbaar die voldoen aan je zoekcriteria. Onze excuses hiervoor. We raden je aan om je zoekopdracht te verruimen en te kijken of er andere opties zijn die beter bij je passen. Als je vragen hebt of hulp nodig hebt bij het vinden van een auto die aan je behoeften voldoet, neem dan gerust contact met ons op. Ons team staat voor je klaar om je te helpen bij het vinden van de juiste auto.</p>
      </div>
    </div>

  <?php
    echo "<div class='loader-symbol'><div class='loader' id='NIKS' style='display: none;'><svg class='car' width='102' height='40' xmlns='http://www.w3.org/2000/svg'>
      <g transform='translate(2 1)' stroke='#002742' fill='none' fill-rule='evenodd' stroke-linecap='round' stroke-linejoin='round'>
        <path class='car__body' d='M47.293 2.375C52.927.792 54.017.805 54.017.805c2.613-.445 6.838-.337 9.42.237l8.381 1.863c2.59.576 6.164 2.606 7.98 4.531l6.348 6.732 6.245 1.877c3.098.508 5.609 3.431 5.609 6.507v4.206c0 .29-2.536 4.189-5.687 4.189H36.808c-2.655 0-4.34-2.1-3.688-4.67 0 0 3.71-19.944 14.173-23.902zM36.5 15.5h54.01' stroke-width='3'/>
        <ellipse class='car__wheel--left' stroke-width='3.2' fill='#FFF' cx='83.493' cy='30.25' rx='6.922' ry='6.808'/>
        <ellipse class='car__wheel--right' stroke-width='3.2' fill='#FFF' cx='46.511' cy='30.25' rx='6.922' ry='6.808'/>
        <path class='car__line car__line--top' d='M22.5 16.5H2.475' stroke-width='3'/>
        <path class='car__line car__line--middle' d='M20.5 23.5H.4755' stroke-width='3'/>
        <path class='car__line car__line--bottom' d='M25.5 9.5h-19' stroke-width='3'/>
      </g>
    </svg></div></div>";
    }

    if (empty($output['type_auto']) || empty($output['merk']) || empty($output['model']) || empty($output['carrosserie'])) {
      $text = "auto's op voorraad";
    } else {
      $text = 'resultaten gevonden';
    }
  ?>
  <style>
    .pagination {
      list-style-type: none;
      padding: 10px 0;
      display: inline-flex;
      justify-content: space-between;
      box-sizing: border-box;
    }

    .pagination li {
      box-sizing: border-box;
      padding-right: 10px;
    }

    .pagination li a {
      box-sizing: border-box;
      background-color: #e2e6e6;
      padding: 8px;
      text-decoration: none;
      font-size: 12px;
      font-weight: bold;
      color: #616872;
      border-radius: 4px;
    }

    .pagination li a:hover {
      background-color: #d4dada;
    }

    .pagination .next a,
    .pagination .prev a {
      text-transform: uppercase;
      font-size: 12px;
    }

    .pagination .currentpage a {
      background-color: #133f8d;
      color: #fff;
    }

    .pagination .currentpage a:hover {
      background-color: #133f8d;
    }
  </style>

  <div class="row mt20">
    <div class="col-sm-4">
      <?php $total_pages = $resultCounter[0]['count(*)'] / $num_results_on_page - 1; ?>
      <?php if (ceil($total_pages / 24) > 0) : ?>
        <ul class="pagination">
          <?php if ($page > 1) : ?>
            <li class="prev"><a href="<?= WEBSITE_DOMAIN . 'voorraad' . $newURL ?>/pagina:<?php echo $page - 1 ?>">Vorige</a></li>
          <?php endif; ?>

          <?php if ($page > 3) : ?>
            <li class="start"><a href="<?= WEBSITE_DOMAIN . 'voorraad' . $newURL ?>/pagina:1">1</a></li>
            <li class="dots">...</li>
          <?php endif; ?>

          <?php if ($page - 2 > 0) : ?><li class="page"><a href="<?= WEBSITE_DOMAIN . 'voorraad' . $newURL ?>/pagina:<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
          <?php if ($page - 1 > 0) : ?><li class="page"><a href="<?= WEBSITE_DOMAIN . 'voorraad' . $newURL ?>/pagina:<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

          <li class="currentpage"><a href="<?= WEBSITE_DOMAIN . 'voorraad' . $newURL ?>/pagina:<?php echo $page ?>"><?php echo $page ?></a></li>

          <?php if ($page + 1 < ceil($total_pages) + 1) : ?><li class="page"><a href="<?= WEBSITE_DOMAIN . 'voorraad' . $newURL ?>/pagina:<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
          <?php if ($page + 2 < ceil($total_pages) + 1) : ?><li class="page"><a href="<?= WEBSITE_DOMAIN . 'voorraad' . $newURL ?>/pagina:<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

          <?php if ($page < ceil($total_pages) - 2) : ?>
            <li class="dots">...</li>
            <li class="end"><a href="<?= WEBSITE_DOMAIN . 'voorraad' . $newURL ?>/pagina:<?php echo ceil($total_pages)  ?>"><?php echo ceil($total_pages) ?></a></li>
          <?php endif; ?>

          <?php if ($page < ceil($total_pages)) : ?>
            <li class="next"><a href="<?= WEBSITE_DOMAIN . 'voorraad' . $newURL ?>/pagina:<?php echo $page + 1 ?>">Volgende</a></li>
          <?php endif; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>

  <script>
    <?php
    if (isset($page) && isset($params['pagina'])) {
      $newURL .= '/pagina:' . $params['pagina'];
    }
    ?>
    // This will replace the current entry in the browser's history, reloading afterwards
    window.history.replaceState(null, null, 'voorraad<?= $newURL ?>');

    document.getElementById("counterGetal").innerHTML = "<?= $resultCounter[0]['count(*)'] ?> <?= $text ?>";
  </script>