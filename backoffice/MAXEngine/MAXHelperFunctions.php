<?php

/* ==  functie redirect()  == */
function redirect($url): void
{
  $isExternal = stripos($url, "http://") !== false || stripos($url, "https://") !== false;

  if (!$isExternal) {
    $url = rtrim(SCRIPT_URL, '/') . '/' . ltrim($url, '/');
  }

  if (!headers_sent()) {
    header('Location: ' . $url, true, 302);
  } else {
    echo '<script type="text/javascript">';
    echo 'window.location.href="' . $url . '";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
    echo '</noscript>';
  }
  exit;
}


function btwMargeChecker($btwMarge)
{
  if ($btwMarge == 1) {
    return 'Marge Auto';
  } else {
    return 'BTW Auto';
  }
}

/* ==  functie prijsRounder()  == */
function prijsRounder($prijs)
{
  if ($prijs > 999) {
    return number_format($prijs, 0, ",", ".") . ',-';
  } else {
    return number_format($prijs, 2, ",", ".");
  }
}

/* ==  functie get_redirect_page()  == */
function get_redirect_page(): string
{
  $role = app('login')->isLoggedIn() ? app('user')->getRole(MAXSession::get("user_id")) : 'default';

  $redirect = unserialize(SUCCESS_LOGIN_REDIRECT);

  if (!isset($redirect['default'])) {
    $redirect['default'] = 'index.php';
  }

  return $redirect[$role] ?? $redirect['default'];
}


function e(string $value): string
{
  return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
}


/* ==  functie str_random()  == */
function str_random(int $length = 16): string
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[random_int(0, strlen($characters) - 1)];
  }

  return $randomString;
}


/* ==  functie trans()  == */
function trans(string $key, array $bindings = [])
{
  return MAXLang::get($key, $bindings);
}


/* ==  functie respond()  == */
function respond(array $data, int $statusCode = 200)
{
  $response = new MAXResponse();

  $response->send($data, $statusCode);
}


/* ==  functie app()  == */
function app($service = null)
{
  $c = MAXContainer::getInstance();

  if (is_null($service)) {
    return $c;
  }

  return $c[$service];
}

/* ==  functie number_checker()  == */
function number_checker($value)
{
  if (isset($value) && !empty($value) || $value == null) {
    return number_format($value, 0, ",", ".");
  } else {
    return 'Onbekend';
  }
}

/* ==  functie brandstofCheck()  == */
function brandstofCheck($brandstof)
{
  switch ($brandstof) {
    case "B":
      return "Benzine";
      break;
    case "D":
      return "Diesel";
      break;
    case "H":
      return "Hybride";
      break;
    case "3":
      return "LPG";
      break;
    default:
      return "Onbekend";
  }
}

/* ==  functie transmissieCheck()  == */
function transmissieCheck($trans)
{
  switch ($trans) {
    case "A":
      return "Automaat";
      break;
    case "H":
      return "Handgeschakeld";
      break;
    default:
      return "Onbekend";
  }
}

/* ==  functie onzePartners()  == */
function onzePartners($bgkleur)
{
  if ($bgkleur == "wit" || $bgkleur == "") {
    $bgclass = " bg-wit";
  } elseif ($bgkleur == "grijs") {
    $bgclass = " bg-grijs";
  } else {
    $bgclass = "";
  }

  echo '
<section class="our-partner' . $bgclass . '">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="main-title">
          <h2>Onze partners</h2>
        </div>
      </div>
    </div>
    <div class="partner_divider">
      <div class="row">
        <div class="col-6 col-sm-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
          <div class="partner_item">
            <img src="images/partners/alphera.png" alt="logo Alphera" />
          </div>
        </div>
        <div class="col-6 col-sm-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
          <div class="partner_item">
            <img src="images/partners/dutch-finance.png" alt="logo Dutch Finance" />
          </div>
        </div>
        <div class="col-6 col-sm-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
          <div class="partner_item">
            <img src="images/partners/hiltermann.png" alt="logo Hiltermann" />
          </div>
        </div>
        <div class="col-6 col-sm-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.7s">
          <div class="partner_item">
            <img src="images/partners/santander.png" alt="logo Santander" />
          </div>
        </div>
      </div>
    </div>
  </div>
</section>';
}


/* ==  functie populaireMerken()  == */
function populaireMerken($type, $minimum, $aantal, $bgcolor)
{
  // voertuig_basisgegevens_soortvoertuig
  // $type = strtoupper($cat);

  if ($bgcolor == "wit") {
    $bgclass = "bg-wit";
  } elseif ($bgcolor == "grijs") {
    $bgclass = "bg-grijs";
  } else {
    $bgclass = "";
  }

  if (strtolower($type)  == 'auto') {
    $voertuigtype = "personenauto's";
    $callType = ' WHERE `voertuig_basisgegevens_soortvoertuig` = \'AUTO\'';
  } else if (strtolower($type) == 'bedrijf') {
    $voertuigtype = "bedrijfswagens";
    $callType = ' WHERE `voertuig_basisgegevens_soortvoertuig` = \'BEDRIJF\'';
  } else {
    $voertuigtype = "leaseauto's";
    $callType = '';
  }

  $db = app('db');
  $result = $db->select(
    "SELECT `voertuig_basisgegevens_merk` AS `ml_voertuig`
    FROM (SELECT `voertuig_basisgegevens_merk`, count(*) as Counter
    FROM `as_voertuig` " . $callType . "
    GROUP BY `voertuig_basisgegevens_merk`)
    AS `merken`
    WHERE Counter > $minimum
    ORDER BY Counter DESC
    LIMIT $aantal"
  );

  echo '
  <section class="our-brands ' . $bgclass . '">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="main-title">
            <h2>Populaire merken ' . $voertuigtype . '</h2>
          </div>
        </div>
      </div>
      <div class="brands_divider">
        <div class="row g-2">';

  // cleanup
  foreach ($result as $voertuig) {
    $merk = $voertuig['ml_voertuig'];
    $merk_tmp = trim(strip_tags(strtolower($merk)));
    $zoek = array("Š", "ë", " ");;
    $vervang = array("s", "e", "+");
    $merk_clean = str_replace($zoek, $vervang, $merk_tmp);
    if (strtolower($merk) == "mercedes-benz") {
      $merk = "Mercedes";
      $merk_clean = "mercedes-benz";
    }


    echo '
          <div class="col-3 col-sm-1 wow">
            <div class="brand_item">
              <a href="voorraad/merk:' . $merk_clean . '" title="bekijk voorraad ' . $merk . '">
                <img srcset="images/merken/' . $merk_clean . '.png 1x, images/merken/' . $merk_clean . '@2x.png 2x" alt="logo ' . $merk . '" loading="lazy" />
              </a>
              <span>' . $merk . '</span>
            </div>
          </div>';
  }

  echo '
        </div>
      </div>
    </div>
  </section>';
}



/* ==  functie checkAanbetaling()  == */
function checkAanbetaling($waardeauto, $btw, $marge)
{
  $db = app('db');
  $result = $db->select("SELECT * FROM `as_settings`");

  $aanbetalingsPercentage = $result[1]['setting_value'];

  if ($btw == 0 || empty($btw)) {
    $nieuwprijs = $waardeauto * 1.21;
  } else {
    $nieuwprijs = $waardeauto;
  }

  if ($marge == 0 || empty($marge)) {
    return 0;
  } else {
    return $nieuwprijs - $waardeauto;
  }
}

/* ==  functie renteCalc()  == */
function renteCalc($prijs, $looptijd, $marge, $slottermijn)
{
  $db = app('db');
  $result = $db->select("SELECT * FROM `as_settings`");

  $rekenRente = $result[0]['setting_value'];
  $aanbetalingsPercentage = $result[1]['setting_value'];

  $rekenRente = floatval($rekenRente);
  $prijs = $prijs;

  if ($marge = 0 || empty($marge)) {
    $aanbetaling = 0;
  } else {
    $aanbetaling = ($prijs / 100) * $aanbetalingsPercentage;
  }

  $looptijd = $looptijd;
  $slottermijn = $prijs * 0.15;

  // Looptijd in maanden
  // rente in percentage 7.99 bijv.

  // HET KREDIET BEDRAG
  $kredietBedrag = $prijs - $aanbetaling;

  // DE NOMINALE MAAND RENTE
  //$nominaleMaandRente = pow(($rente/100)+1,(1/12))-1;
  $nominaleMaandRente = ($rekenRente / 100) / 12;

  // SLOT TERMIJN
  $maandelijkseRenteSlottermijn = $nominaleMaandRente * $slottermijn;

  // VARIABEL KREDIET
  $variabelKrediet = $kredietBedrag - $slottermijn;

  $variabelTermijn = ($nominaleMaandRente / (1 - pow(1 + $nominaleMaandRente, -$looptijd))) * $variabelKrediet;

  // SLOT TERMIJN RENTE PLUS VARIABELTERMIJN
  $leaseBedrag = $variabelTermijn + $maandelijkseRenteSlottermijn;
  $leaseBedrag = $leaseBedrag < 0 ? '0' : round($leaseBedrag, 2);

  return prijsRounder($leaseBedrag);
}


/* ==  functie checkImage()  == */
function checkImage($url)
{
  if (file_exists($url)) {
    return $url;
  } else {
    return $url;
    //return 'images/afbeelding-niet-beschikbaar.png';
  }
}


/* ==  functie displayAutoFronter()  == */
function displayAutoFronter()
{
  $db = app('db');

  $result = $db->select(
    "SELECT * FROM `as_voertuig`,`as_voertuig_media` WHERE `as_voertuig_media`.`media_first_photo` = 1 AND `as_voertuig_media`.`img_available` = 1 AND `as_voertuig`.`voertuig_basisgegevens_ID` = `as_voertuig_media`.`voertuig_id` AND `as_voertuig`.`voertuig_basisgegevens_soortvoertuig` = :typevoertuig ORDER BY RAND() LIMIT 4",
    array("typevoertuig" => 'AUTO')
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

    $prijspermaand = renteCalc($voertuig['voertuig_financieel_verkoopprijs'], 72, $voertuig['voertuig_financieel_BTW'], 1);

    if ($voertuig['img_available'] == 1) {
      $afbeelding = 'images/uploads/voertuigen/' . $voertuig['media_image_url'];
    } else {
      $afbeelding = 'images/afbeelding-niet-beschikbaar.png';
    }

    if ($voertuig['voertuig_financieel_BTW'] == 1) {
      if ($voertuig['voertuig_basisgegevens_soortvoertuig'] == 'BEDRIJF') {
        $btwMargeCheckNEW = "excl. BTW";
      } else {
        $btwMargeCheckNEW = "incl. BTW";
      }
    } else {
      $btwMargeCheckNEW = "Marge";
    }

    echo '
    <div class="col-sm-6 col-xl-3">
      <div class="car-listing">
        <a class="text-white" href="i/' . $voertuig['pretty_url_website'] . '">
          <div class="thumb">
            <div class="tag">AANBEVOLEN</div>
            <img src="' . $afbeelding . '" alt="' . $voertuig['voertuig_basisgegevens_merk'] . ' ' . $voertuig['voertuig_basisgegevens_model'] . '" loading="lazy">
            <div class="thmb_cntnt2">
              <ul class="mb0">
                <li class="list-inline-item"><span class="flaticon-photo-camera mr3"></span></li>
              </ul>
            </div>
          </div>
        </a>
        <div class="details">
          <div class="wrapper pb-0">
            <h6 class="title"><a href="i/' . $voertuig['pretty_url_website'] . '">' . $voertuig['voertuig_basisgegevens_merk'] . ' ' . $voertuig['voertuig_basisgegevens_model'] . '</a></h6>
            <p>' . $voertuig_type . '</p>
          </div>
          <div class="listing_footer">
            <table class="w-100 mb-3">
              <tr>
                <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . number_checker($voertuig['voertuig_historie_tellerstand_stand']) . ' km</a></td>
                <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $brandstof . '</a></td>
              </tr>
              <tr>
                <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $transmissie . '</a></td>
                <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $voertuig['voertuig_historie_bouwjaar_jaar'] . '</a></td>
              </tr>
              <tr>
                <td><a href="i/' . $voertuig['pretty_url_website'] . '">€ ' . $prijs . '</a></td>
                <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $btwMargeCheckNEW . '</a></td>
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
}

/* ==  functie displayBedrijfFronter()  == */
function displayBedrijfFronter()
{
  $db = app('db');

  $result = $db->select(
    "SELECT * FROM `as_voertuig`,`as_voertuig_media` WHERE `as_voertuig_media`.`media_first_photo` = 1 AND `as_voertuig_media`.`img_available` = 1 AND `as_voertuig`.`voertuig_basisgegevens_ID` = `as_voertuig_media`.`voertuig_id` AND `as_voertuig`.`voertuig_basisgegevens_soortvoertuig` = :typevoertuig ORDER BY RAND() LIMIT 4",
    array("typevoertuig" => 'BEDRIJF')
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

    $prijspermaand = renteCalc($voertuig['voertuig_financieel_verkoopprijs'], 72, $voertuig['voertuig_financieel_BTW'], 1);

    if ($voertuig['img_available'] == 1) {
      $afbeelding = 'images/uploads/voertuigen/' . $voertuig['media_image_url'];
    } else {
      $afbeelding = 'images/afbeelding-niet-beschikbaar.png';
    }

    if ($voertuig['voertuig_financieel_BTW'] == 1) {
      if ($voertuig['voertuig_basisgegevens_soortvoertuig'] == 'BEDRIJF') {
        $btwMargeCheckNEW = "excl. BTW";
      } else {
        $btwMargeCheckNEW = "incl. BTW";
      }
    } else {
      $btwMargeCheckNEW = "Marge";
    }

    echo '
        <div class="col-sm-6 col-xl-3">
          <div class="car-listing">
            <a class="text-white" href="i/' . $voertuig['pretty_url_website'] . '">
              <div class="thumb">
                <div class="tag">AANBEVOLEN</div>
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
                <h6 class="title"><a href="i/' . $voertuig['pretty_url_website'] . '">' . $voertuig['voertuig_basisgegevens_merk'] . ' ' . $voertuig['voertuig_basisgegevens_model'] . '</a></h6>
                <p>' . $voertuig_type . '</p>
              </div>
              <div class="listing_footer">
                <table class="w-100 mb-3">
                  <tr>
                    <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . number_checker($voertuig['voertuig_historie_tellerstand_stand']) . ' km</a></td>
                    <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $brandstof . '</a></td>
                  </tr>
                  <tr>
                    <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $transmissie . '</a></td>
                    <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $voertuig['voertuig_historie_bouwjaar_jaar'] . '</a></td>
                  </tr>
                  <tr>
                  <td><a href="i/' . $voertuig['pretty_url_website'] . '">€ ' . $prijs . '</a></td>
                  <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $btwMargeCheckNEW . '</a></td>
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
}


/* ==  functie displayVoorraad()  == */
function displayVoorraad()
{
  $db = app('db');

  $result = $db->select(
    "SELECT * FROM `as_voertuig` ORDER BY voertuig_basisgegevens_ID DESC LIMIT 50",
  );

  foreach ($result as $voertuig) {

    $afbeelding = $db->select(
      "SELECT * FROM `as_voertuig_media` WHERE `voertuig_id` = :voertuig_id AND `media_first_photo` = :type_foto",
      array("voertuig_id" => $voertuig['voertuig_basisgegevens_ID'], "type_foto" => '1')
    );

    $afbeeldingCounter = $db->select(
      "SELECT count(*) FROM `as_voertuig_media` WHERE `voertuig_id` = :voertuig_id",
      array("voertuig_id" => $voertuig['voertuig_basisgegevens_ID'])
    );

    $aantalAfbeeldingen = $afbeeldingCounter[0]['count(*)'];

    $voertuig_type = strlen($voertuig['voertuig_basisgegevens_type']) > 30 ? substr($voertuig['voertuig_basisgegevens_type'], 0, 30) . "..." : $voertuig['voertuig_basisgegevens_type'];
    $brandstof = brandstofCheck($voertuig['voertuig_basisgegevens_brandstof']);
    $transmissie =  transmissieCheck($voertuig['voertuig_techischegegevens_transmissie']);

    if ($voertuig['voertuig_financieel_verkoopprijs'] == null || !isset($voertuig['voertuig_financieel_verkoopprijs'])) {
      $prijs = 'Onbekend';
    } else {
      $prijs = number_format((float)$voertuig['voertuig_financieel_verkoopprijs'], 0, ",", ".");
    }

    $prijspermaand = renteCalc($voertuig['voertuig_financieel_verkoopprijs'], 72, 1, 0);

    if ($afbeelding[0]['img_available'] == 1) {
      $afbeelding = 'images/uploads/voertuigen/' . $afbeelding[0]['media_image_url'];
    } else {
      $afbeelding = 'images/afbeelding-niet-beschikbaar.png';
    }

    if ($voertuig['voertuig_financieel_BTW'] == 1) {
      if ($voertuig['voertuig_basisgegevens_soortvoertuig'] == 'BEDRIJF') {
        $btwMargeCheckNEW = "excl. BTW";
      } else {
        $btwMargeCheckNEW = "incl. BTW";
      }
    } else {
      $btwMargeCheckNEW = "Marge";
    }


    echo '
      <div class="col-sm-6 col-xl-3">
        <div class="car-listing">
          <a class="text-white" href="i/' . $voertuig['pretty_url_website'] . '">
          <div class="thumb">
            <div class="tag">AANBEVOLEN</div>
            <img src="' . $afbeelding . '" alt="' . $voertuig['voertuig_basisgegevens_merk'] . ' ' . $voertuig['voertuig_basisgegevens_model'] . '" loading="lazy" />
            <div class="thmb_cntnt2">
              <ul class="mb0">
                <li class="list-inline-item"><a class="text-white" href="#"><span class="flaticon-photo-camera mr3"></span> ' . $aantalAfbeeldingen . '</a></li>
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
                  <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . number_checker($voertuig['voertuig_historie_tellerstand_stand']) . ' km</a></td>
                  <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $brandstof . '</a></td>
                </tr>
                <tr>
                  <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $transmissie . '</a></td>
                  <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $voertuig['voertuig_historie_bouwjaar_jaar'] . '</a></td>
                </tr>
                <tr>
                  <td><a href="i/' . $voertuig['pretty_url_website'] . '">€ ' . $prijs . '</a></td>
                  <td><a href="i/' . $voertuig['pretty_url_website'] . '">' . $btwMargeCheckNEW . '</a></td>
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
}


/* ==  functie ReviewShower()  == */
function ReviewShower($type)
{
  $db = app('db');

  $result = $db->select("SELECT * FROM `as_settings`");

  if ($type == 1) {
    return $result[2]['setting_value'];
  } else if ($type == 2) {
    return $result[3]['setting_value'];
  }
}


/* ==  functie starCounter()  == */
function starCounter($rating)
{
  $rating = str_replace(',', '.', $rating);
  $rating_round = round($rating / 2);
  if ($rating_round <= 0.5 && $rating_round > 0) {
    echo '<i class="fa fa-star-half-o"></i><i class="fa-solid fa-star-half-stroke"></i><i class="fa-solid fa-star-half-stroke"></i><i class="fa-solid fa-star-half-stroke"></i><i class="fa-solid fa-star-half-stroke"></i>';
  }
  if ($rating_round <= 1 && $rating_round > 0.5) {
    echo '<i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i><i class="fa-solid fa-star-half-stroke"></i><i class="fa-solid fa-star-half-stroke"></i><i class="fa-solid fa-star-half-stroke"></i>';
  }
  if ($rating_round <= 1.5 && $rating_round > 1) {
    echo '<i class="fa-solid fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa-solid fa-star-half-stroke"></i><i class="fa-solid fa-star-half-stroke"></i><i class="fa-solid fa-star-half-stroke"></i>';
  }
  if ($rating_round <= 2 && $rating_round > 1.5) {
    echo '<i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i><i class="fa-solid fa-star-half-stroke"></i><i class="fa-solid fa-star-half-stroke"></i>';
  }
  if ($rating_round <= 2.5 && $rating_round > 2) {
    echo '<i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa-solid fa-star-half-stroke"></i><i class="fa-solid fa-star-half-stroke"></i>';
  }
  if ($rating_round <= 3 && $rating_round > 2.5) {
    echo '<i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i><i class="fa-solid fa-star-half-stroke"></i>';
  }
  if ($rating_round <= 3.5 && $rating_round > 3) {
    echo '<i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa-solid fa-star-half-stroke"></i>';
  }
  if ($rating_round <= 4 && $rating_round > 3.5) {
    echo '<i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>';
  }
  if ($rating_round <= 4.5 && $rating_round > 4) {
    echo '<i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa fa-star-half-o"></i>';
  }
  if ($rating_round <= 5 && $rating_round > 4.5) {
    echo '<i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>';
  }
}


/* ==  functie recenteBlog() == */
// 3-koloms overzicht op home
// selecteer alleen artikelen ouder dan morgen (dus t/m vandaag)
function recenteBlog($aantal)
{
  $db = app('db');
  $result = $db->select(
    "SELECT * FROM `as_blog` WHERE `blog_status` = :blog_status AND DATE(NOW()) >= DATE(blog_datum) ORDER BY blog_id DESC LIMIT $aantal",
    array("blog_status" => 1)
  );

  foreach ($result as $blog) {
    $datum_blog = date("d M Y", strtotime($blog['blog_datum']));
    // $snippet_blog = strlen(strip_tags($blog['blog_preview'])) > 150 ? substr(strip_tags($blog['blog_preview']), 0, 100) . "..." : strip_tags($blog['blog_preview']);
    $snippet_blog = strip_tags($blog['blog_preview']);
    $blog_titel = strlen(strip_tags($blog['blog_title'])) > 45 ? substr(strip_tags($blog['blog_title']), 0, 43) . "..." : strip_tags($blog['blog_title']);
    $blog_prettyUrl = $blog['blog_pretty_url'];
    $blog_thumb = "images/blog/" . $blog_prettyUrl . "-960w.jpg";

    echo '
    <div class="col-sm-6 col-md-4 d-flex">
      <div class="for_blog">
        <div class="thumb">
          <div class="tag">' . $datum_blog . '</div>
          <a href="artikel/' . $blog_prettyUrl . '">
          <div class="afb" style="background: url(' . $blog_thumb . ') no-repeat top center; background-size: cover;" alt="lees artikel"></div>
          </a>
        </div>
        <div class="details">
          <div class="wrapper">
            <h4 class="title"><a href="artikel/' . $blog_prettyUrl . '">' . $blog_titel . '</a></h4>
            <p>' . $snippet_blog . '</p>
          </div>
        </div>
        <div class="lees">
          <a href="artikel/' . $blog_prettyUrl . '" class="more_listing">Lees artikel <span class="fa-solid fa-arrow-right ps-1"></span></span></a>
        </div>
      </div>
    </div>';
  }
}

/* ==  functie optiesWeerageBlock()  == */
function optiesWeerageBlock($blob)
{
  $data = preg_split("/\,/", $blob);

  foreach ($data as $opties) {
    echo "<li>" . $opties . "</li>";
  }
}

/* ==  functie CheckAndShowOpties()  == */
function CheckAndShowOpties($datatablename, $autoid)
{

  $db = app('db');

  $result = $db->select(
    "SELECT * FROM `as_voertuig` WHERE `voertuig_basisgegevens_ID` = :voertuig_basisgegevens_ID",
    array("voertuig_basisgegevens_ID" => $autoid)
  );

  $block = '';

  $echotitle = str_replace("accessoires_", "", $datatablename);
  $data = preg_split("/\,/", $result[0][$datatablename]);

  if (isset($result[0][$datatablename]) && !empty($result[0][$datatablename])) {
    $block .=  '<h4 class="mb10">' . ucfirst($echotitle) . '</h4>
  <div class="opties-list">
    <ul class="blockshower">';

    foreach ($data as $opties) {
      $block .= "<li>" . $opties . "</li>";
    }

    $block .= '</ul>
  </div>';
  }

  return $block;
}

function p($prijs)
{
  return number_format($prijs, 0, ",", ".");
}


/* ==  functie voorraadCounter()  == */
function voorraadCounter()
{
  $db = app('db');

  $autocounter = $db->select(
    "SELECT count(*) FROM `as_voertuig`"
  );

  return $autocounter[0]['count(*)'];
}


/* ==  functie financieringCounter()  == */
function financieringCounter()
{
  $db = app('db');

  $autocounter = $db->select(
    "SELECT count(*) FROM `as_offerte` WHERE `status` = 4"
  );

  return $autocounter[0]['count(*)'] + 434;
}


/* ==  functie dealerCounter()  == */
function dealerCounter()
{
  $db = app('db');

  $autocounter = $db->select(
    "SELECT count(*) FROM `as_adverteerder`"
  );

  return $autocounter[0]['count(*)'];
}

/* toon aantal reviews op klantenvertellen.nl */
/* TODO: aantal uit database halen */
function reviewsCounter()
{
  return '56';
}

/* ==  functie dealerCounter()  == */
function voertuigCounterPersonen()
{
  $db = app('db');

  $autocounter = $db->select(
    "SELECT count(*) FROM `as_voertuig` WHERE `voertuig_basisgegevens_soortvoertuig` = 'AUTO'"
  );

  return $autocounter[0]['count(*)'];
}

/* ==  functie dealerCounter()  == */
function voertuigCounterBedrijf()
{
  $db = app('db');

  $autocounter = $db->select(
    "SELECT count(*) FROM `as_voertuig` WHERE `voertuig_basisgegevens_soortvoertuig` = 'BEDRIJF'"
  );

  return $autocounter[0]['count(*)'];
}


/* ==  functie aanhefCheck()  == */
function aanhefCheck($aanhef)
{

  switch ($aanhef) {
    case "1":
      echo "Dhr";
      break;
    case "2":
      echo "Mevr";
      break;
    default:
      echo "Dhr/Mevr";
  }
}


// Converteer een datum of timestamp naar het Nederlands.
// Voorbeeld: dateToNed("2014-09-11" ,"l j F Y") wordt: 'donderdag 11 september 2014'
function dateToNed($date, $format)
{
  $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
  $nl_dagen = array('maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag', 'zondag');
  $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
  $nl_maanden = array('januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december');

  return str_replace($english_months, $nl_maanden, str_replace($english_days, $nl_dagen, date($format, strtotime($date))));
}


// Converteer een datum of timestamp naar een korte Nederlandse versie.
// voorbeeld: dateToNedKort("2014-09-11" ,"D j F") wordt: 'do 11 september'
function dateToNedKort($date, $format)
{
  $english_days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
  $nl_dagen = array('ma', 'di', 'wo', 'do', 'vr', 'za', 'zo');
  $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
  $nl_maanden = array('januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december');

  return str_replace($english_months, $nl_maanden, str_replace($english_days, $nl_dagen, date($format, strtotime($date))));
}

function replaceFilterTermsEncode($term)
{
  return str_replace(" ", "+", strtolower($term));
}

function replaceFilterTermsDecode($term)
{
  return str_replace("+", " ", strtolower($term));
}

function floorThousand($num)
{
  $multiple = 2000;
  return $rounded_num = floor($num / $multiple) * $multiple;
}

function vervang_placeholders($tekst)
{
  $db = app("db");
  $totalResultaat = '';

  preg_match_all('/{([^|]+)\|([^|]+)\|([^|]+)\|([^|]+)\|([^}]+)}/', $tekst, $matches, PREG_SET_ORDER);

  foreach ($matches as $match) {
    $placeholder = $match[1];
    $waarde1 = $match[2];
    $waarde2 = $match[3];
    $waarde3 = $match[4];
    $waarde4 = $match[5];
    $query = '';

    if ($placeholder == 'autovoorraad') {

      if ($waarde1 == "ALLES") {
        $query .= "";
      } else {
        $query .= "AND `as_voertuig`.`voertuig_basisgegevens_soortvoertuig` = '" . $waarde1 . "' ";
      }

      if ($waarde2 == "ALLES") {
        $query .= "";
      } else {
        $query .= "AND `as_voertuig`.`voertuig_basisgegevens_merk` = '" . $waarde2 . "' ";
      }

      if ($waarde3 == "ALLES") {
        $query .= "";
      } else {
        $query .= "AND `as_voertuig`.`voertuig_basisgegevens_brandstof` = '" . $waarde3 . "' ";
      }

      $result = $db->select(
        "SELECT * FROM `as_voertuig`,`as_voertuig_media` WHERE `as_voertuig_media`.`media_first_photo` = 1 AND `as_voertuig_media`.`img_available` = 1 AND `as_voertuig`.`voertuig_basisgegevens_ID` = `as_voertuig_media`.`voertuig_id` " . $query . " ORDER BY RAND() LIMIT " . $waarde4
      );

      $totalResultaat .= '<div class="blogcarousel row g-2">';

      foreach ($result as $voertuig) {

        $prijspermaand = renteCalc($voertuig['voertuig_financieel_verkoopprijs'], 72, $voertuig['voertuig_financieel_BTW'], 1);

        if ($voertuig['img_available'] == 1) {
          $afbeelding = 'images/uploads/voertuigen/' . $voertuig['media_image_url'];
        } else {
          $afbeelding = 'images/afbeelding-niet-beschikbaar.png';
        }

        $totalResultaat .= '
            <div class="col">
              <div class="car-listing">
                <a class="text-white" href="i/' . $voertuig['pretty_url_website'] . '">
                <div class="thumb">
                  <img src="' . $afbeelding . '" alt="' . $voertuig['voertuig_basisgegevens_merk'] . ' ' . $voertuig['voertuig_basisgegevens_model'] . '" loading="lazy">
                  <div class="thmb_cntnt2">
                    <ul class="mb0">
                      <li class="list-inline-item"><span class="flaticon-photo-camera mr3"></span></li>
                    </ul>
                  </div>
                </div>
                </a>
                <div class="details">
                  <div class="wrapper pb-0">
                    <h6 class="title"><a href="i/' . $voertuig['pretty_url_website'] . '">' . $voertuig['voertuig_basisgegevens_merk'] . ' ' . $voertuig['voertuig_basisgegevens_model'] . '</a></h6>
                  </div>
                  <div class="listing_footer">
                    <h5 class="price"><span>€ ' . $prijspermaand . ' </span>p/m</h5>
                    <a class="btn btn-thm advnc_search_form_btn button-deal buttonaclass" href="i/' . $voertuig['pretty_url_website'] . '">Bekijk deal <i class="fas fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>';
      }
      $totalResultaat .= '</div>';
      // vervang de huidige match in de tekst
      $tekst = str_replace($match[0], $totalResultaat, $tekst);
      $totalResultaat = '';
    }
  }

  // retourneer de volledige tekst met alle matches vervangen
  return $tekst;
}

function changeDate($date)
{
  return $newDate = date("d-m-Y", strtotime($date));
}


function formValue($value)
{
  if (isset($value)) {
    return 'value="' . $value . '"';
  } else {
    return null;
  }
}

function selectFormCheck($value, $check)
{
  if (isset($value) && $value == $check) {
    return 'selected';
  } else {
    return null;
  }
}

function dateFormCheck($date, $mode)
{
  if ($mode == 1) {
    $newdate = date("m", strtotime($date));
    return 'value="' . $newdate . '"';
  } else if ($mode == 2) {
    $newdate = date("Y", strtotime($date));
    return 'value="' . $newdate . '"';
  }
}


function monthFormCheck($date, $check)
{
  $newdate = date("m", strtotime($date));

  if ($newdate == $check) {
    return 'selected';
  }
}

function checkBTWForm($value)
{
  if (isset($value)) {
    if ($value == '1') {
      return '21%';
    } else {
      return '0%';
    }
  } else {
    return '0%';
  }
}

function statusOfferte($id)
{
  if ($id == 0) {
    return 'Nieuw';
  } else if ($id == 1) {
    return 'In behandeling';
  } else if ($id == 2) {
    return 'Akkoord';
  } else if ($id == 3) {
    return 'Afgeleverd';
  } else if ($id == 4) {
    return 'Afgewezen';
  } else if ($id == 5) {
    return 'Afgelegd';
  }
}

function statusOfferteColor($id)
{
  if ($id == 0) {
    return 'success';
  } else if ($id == 1) {
    return 'warning';
  } else if ($id == 2) {
    return 'primary';
  } else if ($id == 3) {
    return 'primary';
  } else if ($id == 4) {
    return 'danger';
  } else if ($id == 5) {
    return 'danger';
  }
}


function callhistorie($telefoonnummer)
{
  $db = app('db');
  $result = $db->select(
    "SELECT * FROM `as_voip_gesprekken` WHERE `status` = 'ended' AND `caller_number` = :id",
    array("id" => $telefoonnummer)
  );

  if ($result) {
    echo '<table class="table">
      <thead>
      <tr>
          <th scope="col">Type</th>
          <th scope="col">Beller</th>
          <th scope="col">Gebeld naar</th>
          <th scope="col">Datum</th>
        </tr>
    </thead>
    <tbody>';
    foreach ($result as $phone) {
      if($phone['direction'] == 'inbound'){
        $icon = '<i class="fa-solid fa-phone-arrow-down-left mr-5"></i> Inkomend';
      }else{
        $icon = '<i class="fa-solid fa-phone-arrow-up-right mr-5"></i> Uitgaand';
      }
      echo '<tr>
              <td>'.$icon.'</td>
              <td>'.$phone['caller_number'].'</td>
              <td>'.$phone['destination_number'].'</td>
              <th scope="row">'.date("d-m-Y H:i", strtotime($phone['timestamp'])).'</th>
          </tr>';
    }
    echo '      </tbody>
    </table>';
  } else {
    echo '<h4 class="text-center">Nog geen gespreksgeschiedenis</h4>';
  }
}
