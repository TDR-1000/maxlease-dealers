<section class="advance_search_menu_sectn py-2 py-sm-3 bgc-thm2">
  <div class="container">
    <form id="filter" method="POST">
      <div class="row g-sm-4 g-2">
        <div class="col col-xs-6 col-sm-4 col-lg-2">
          <div class="advance_search_style">
            <select class="maxSelector" name="type-auto">
              <option value="Alles">Alle auto's</option>
              <option value="AUTO" <?php if (isset($params['type-auto']) && $params['type-auto'] == 'auto') { echo 'selected'; } ?>>Personenauto's</option>
              <option value="BEDRIJF" <?php if (isset($params['type-auto']) && $params['type-auto'] == 'bedrijf') { echo 'selected'; } ?>>Bedrijfswagens</option>
            </select>
          </div>
        </div>
        <div class="col col-xs-6 col-sm-4 col-lg-2">
          <div class="advance_search_style">
            <select class="maxSelector" name="merk" id="merk">
              <option value="Alles">Alle merken</option>
              <?php
                foreach ($automerken as $merk) {
                  if (isset($params['merk']) && strtolower($params['merk']) == strtolower($merk['voertuig_basisgegevens_merk'])) { $merkChoice = 'selected'; } else { $merkChoice = '';}
                  echo '<option '.$merkChoice.' value="' . $merk['voertuig_basisgegevens_merk'] . '">' . $merk['voertuig_basisgegevens_merk'] . '</option>';
                }
              ?>
            </select>
          </div>
        </div>
        <div class="col col-xs-6 col-sm-4 col-lg-2">
          <div class="advance_search_style">
            <select class="maxSelector modelselector" id="model" name="model">
              <option value="Alles">Selecteer eerst een merk</option>
              <?php if($params['merk']){
                foreach ($resultmodellen as $modellen) {
                  if (isset($params['model']) && strtolower($params['model']) == strtolower($modellen['voertuig_basisgegevens_model'])) { $modelChoice = 'selected'; } else { $modelChoice = '';}
                  echo '<option '.$modelChoice.' value="'.$modellen['voertuig_basisgegevens_model'].'">'.$modellen['voertuig_basisgegevens_model'].'</option>';
              }
              } ?>
            </select>
          </div>
        </div>
        <div class="col col-xs-6 col-sm-4 col-lg-2">
          <div class="advance_search_style">
            <select class="maxSelector" name="carrosserie">
            <option <?php if (!isset($params['carrosserie'])) { echo 'selected'; } ?> value="Alles" selected="">Alle carrosserieën</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'bestelbus') { echo 'selected'; } ?> value="Bestelbus">Bestelbus</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'gatchback') { echo 'selected'; } ?> value="Hatchback">Hatchback</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'bestelauto') { echo 'selected'; } ?> value="Bestelauto">Bestelauto</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'stationwagon') { echo 'selected'; } ?> value="Stationwagon">Stationwagon</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'suv') { echo 'selected'; } ?> value="SUV">SUV</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'personenbus') { echo 'selected'; } ?> value="Personenbus">Personenbus</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'mpv') { echo 'selected'; } ?> value="MPV">MPV</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'coupe') { echo 'selected'; } ?> value="Coupé">Coupé</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'chassis-cabine') { echo 'selected'; } ?> value="Chassis cabine">Chassis cabine</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'sedan') { echo 'selected'; } ?> value="Sedan">Sedan</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'pick-up') { echo 'selected'; } ?> value="Pick-Up">Pick-Up</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'kipper') { echo 'selected'; } ?> value="Kipper">Kipper</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'cabriolet') { echo 'selected'; } ?> value="Cabriolet">Cabriolet</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'bakwagen') { echo 'selected'; } ?> value="Bakwagen">Bakwagen</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'open-laadbak') { echo 'selected'; } ?> value="Open laadbak">Open laadbak</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'koel-vriestransport') { echo 'selected'; } ?> value="Koel-vriestransport">Koel-vriestransport</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'rolstoelvervoer') { echo 'selected'; } ?> value="Rolstoelvervoer">Rolstoelvervoer</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'terreinwagen') { echo 'selected'; } ?> value="Terreinwagen">Terreinwagen</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'glasresteel') { echo 'selected'; } ?> value="Glasresteel">Glasresteel</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'be-trekker') { echo 'selected'; } ?> value="BE-trekker">BE-trekker</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'personenvervoer') { echo 'selected'; } ?> value="Personenvervoer">Personenvervoer</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'autotransporter') { echo 'selected'; } ?> value="Autotransporter">Autotransporter</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'hoogwerker') { echo 'selected'; } ?> value="Hoogwerker">Hoogwerker</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'huifzeil') { echo 'selected'; } ?> value="Huifzeil">Huifzeil</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'targa') { echo 'selected'; } ?> value="Targa">Targa</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'verkoopwagen') { echo 'selected'; } ?> value="Verkoopwagen">Verkoopwagen</option>
              <option <?php if (isset($params['carrosserie']) && strtolower($params['carrosserie']) == 'overig') { echo 'selected'; } ?> value="Overig">Overig</option>
            </select>
          </div>
        </div>
        <div class="col col-xs-6 col-sm-4 col-lg-2">
          <div class="advance_search_style">
            <a class="advance_dd_btn" href="#collapseAdvanceSearch" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseAdvanceSearch">
              <span class="flaticon-cogwheel"></span> Meer filters
            </a>
          </div>
        </div>
        <div class="col col-xs-6 col-sm-4 col-lg-2">
          <div class="advance_search_style float-end">
            <button class="btn search_btn btn-thm" type="submit" name="submit"><span class="flaticon-magnifiying-glass"></span> Zoeken</button>
          </div>
        </div>
      </div>

    <?php if(isset($deviceType) && $deviceType == "phone"){ ?>
    <!-- filter op smartphones -->
      <div class="collapse" id="collapseAdvanceSearch">
        <div class="row bgc-thm2">
          <div class="col-6 combi-field-links">
            <div class="advance_search_style">
              <select class="maxSelector" id="bouwjaar_van" name="bouwjaar-van" onchange="vanTotSelector('bouwjaar_van','bouwjaar_tot')">
                <option value="Alles">Bouwjaar van</option>
                <?php
                foreach ($bouwjaar as $jaar) {
                  if ($jaar['voertuig_historie_bouwjaar_jaar'] != 'onbekend') {
                    if (isset($params['bouwjaar-van']) && $params['bouwjaar-van'] == $jaar['voertuig_historie_bouwjaar_jaar']) { $bouwjaar_van = 'selected'; } else { $bouwjaar_van = '';}
                    echo '<option '.$bouwjaar_van.' value="' . $jaar['voertuig_historie_bouwjaar_jaar'] . '">' . $jaar['voertuig_historie_bouwjaar_jaar'] . '</option>';
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-6 combi-field-rechts">
            <div class="advance_search_style">
              <select class="maxSelector" id="bouwjaar_tot" name="bouwjaar-tot">
                <option value="Alles">Bouwjaar tot</option>
                <?php
                foreach ($bouwjaar as $jaar) {
                  if ($jaar['voertuig_historie_bouwjaar_jaar'] != 'onbekend') {
                    if (isset($params['bouwjaar-tot']) && $params['bouwjaar-tot'] == $jaar['voertuig_historie_bouwjaar_jaar']) { $bouwjaar_tot = 'selected'; } else { $bouwjaar_tot = '';}
                    if(isset($params['bouwjaar-van']) && $params['bouwjaar-van'] >= $jaar['voertuig_historie_bouwjaar_jaar']){ $checkDisabledBouwjaar = 'disabled'; } else { $checkDisabledBouwjaar = '';}
                    echo '<option '.$bouwjaar_tot.' '.$checkDisabledBouwjaar.' value="' . $jaar['voertuig_historie_bouwjaar_jaar'] . '">' . $jaar['voertuig_historie_bouwjaar_jaar'] . '</option>';
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-6 combi-field-links">
            <div class="advance_search_style">
              <select class="maxSelector" id="km_van" name="km-van" onchange="vanTotSelector('km_van','km_tot')">
                <option <?php if (isset($params['km-van']) && $params['km-van'] == 'Alles') { echo 'selected'; } ?> value="Alles" selected="">Km stand van</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '0') { echo 'selected'; } ?> value="0">0</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '50000') { echo 'selected'; } ?> value="50000">50.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '100000') { echo 'selected'; } ?> value="100000">100.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '150000') { echo 'selected'; } ?> value="150000">150.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '200000') { echo 'selected'; } ?> value="200000">200.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '250000') { echo 'selected'; } ?> value="250000">250.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '300000') { echo 'selected'; } ?> value="300000">300.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '350000') { echo 'selected'; } ?> value="350000">350.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '400000') { echo 'selected'; } ?> value="400000">400.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '450000') { echo 'selected'; } ?> value="450000">450.000</option>
              </select>
            </div>
          </div>
          <div class="col-6 combi-field-rechts">
            <div class="advance_search_style">
              <select class="maxSelector" id="km_tot" name="km-tot">
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == 'Alles') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 'Alles'){ echo 'disabled'; } else { echo '';} ?> value="Alles" selected="">Km stand tot</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '50000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 50000){ echo 'disabled'; } else { echo '';} ?> value="50000">50.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '100000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 100000){ echo 'disabled'; } else { echo '';} ?> value="100000">100.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '150000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 150000){ echo 'disabled'; } else { echo '';} ?> value="150000">150.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '200000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 200000){ echo 'disabled'; } else { echo '';} ?> value="200000">200.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '250000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 250000){ echo 'disabled'; } else { echo '';} ?> value="250000">250.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '300000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 300000){ echo 'disabled'; } else { echo '';} ?> value="300000">300.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '350000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 350000){ echo 'disabled'; } else { echo '';} ?> value="350000">350.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '400000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 400000){ echo 'disabled'; } else { echo '';} ?> value="400000">400.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '450000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 450000){ echo 'disabled'; } else { echo '';} ?> value="450000">450.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '500000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 500000){ echo 'disabled'; } else { echo '';} ?> value="500000">500.000</option>
              </select>
            </div>
          </div>
          <div class="col-6 combi-field-links">
            <div class="advance_search_style">
            <select class="maxSelector" id="verkoopprijs_van" name="verkoopprijs-van" onchange="vanTotSelector('verkoopprijs_van','verkoopprijs_tot')">
              <option <?php if (isset($params['verkoopprijs-van']) && $params['verkoopprijs-van'] == 'Alles') { echo 'selected'; } ?> value="Alles" selected="">Verkoopprijs van</option>
              <?php
                $pricesResult = $db->select("SELECT MIN(`voertuig_financieel_verkoopprijs`) AS laagste_prijs, MAX(`voertuig_financieel_verkoopprijs`) AS hoogste_prijs FROM (SELECT DISTINCT `voertuig_financieel_verkoopprijs` FROM `as_voertuig`  WHERE `voertuig_financieel_verkoopprijs` != 0) AS prices;");
                for ($i = floorThousand($pricesResult[0]['laagste_prijs']); $i <= $pricesResult[0]['hoogste_prijs']; $i += 2500) {
                  if (isset($params['verkoopprijs-van']) && $params['verkoopprijs-van'] == $i) { $verkoopprijs_van = 'selected'; } else { $verkoopprijs_van = '';}
                  echo '<option '.$verkoopprijs_van.' value="'.$i.'" data-price="'.$i.'">€ '.number_format($i,0,",",".").'</option>';
                }
              ?>
            </select>
            </div>
          </div>
          <div class="col-6 combi-field-rechts">
            <div class="advance_search_style">
              <select class="maxSelector" id="verkoopprijs_tot"  name="verkoopprijs-tot">
                <option value="Alles" selected="">Verkoopprijs tot</option>
                <?php
                for ($i = (floorThousand($pricesResult[0]['laagste_prijs'])); $i <= $pricesResult[0]['hoogste_prijs']; $i += 2500) {
                  if(isset($params['verkoopprijs-van']) && $params['verkoopprijs-van'] >= $i){ $checkDisabledVerkoopprijs = 'disabled'; } else { $checkDisabledVerkoopprijs = '';}
                  if (isset($params['verkoopprijs-tot']) && $params['verkoopprijs-tot'] == $i) { $verkoopprijs_tot = 'selected'; } else { $verkoopprijs_tot = '';}
                  echo '<option '.$verkoopprijs_tot.' '.$checkDisabledVerkoopprijs.' value="'.$i.'" data-price="'.$i.'">€ '.number_format($i,0,",",".").'</option>';
                }
              ?>
              </select>
            </div>
          </div>
          <div class="col-6">
            <div class="advance_search_style">
              <select class="maxSelector" name="kleur" >
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'Alles') { echo 'selected'; } ?> value="Alles" selected="">Alle kleuren</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'wit') { echo 'selected'; } ?> value="wit">Wit</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'zwart') { echo 'selected'; } ?> value="zwart">Zwart</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'grijs') { echo 'selected'; } ?> value="grijs">Grijs</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'blauw') { echo 'selected'; } ?> value="blauw">Blauw</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'rood') { echo 'selected'; } ?> value="rood">Rood</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'bruin') { echo 'selected'; } ?> value="bruin">Bruin</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'beige') { echo 'selected'; } ?> value="beige">Beige</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'zilver') { echo 'selected'; } ?> value="zilver">Zilver</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'groen') { echo 'selected'; } ?> value="groen">Groen</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'geel') { echo 'selected'; } ?> value="geel">Geel</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'overig') { echo 'selected'; } ?> value="overig">Overig</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'paars') { echo 'selected'; } ?> value="paars">Paars</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'goud') { echo 'selected'; } ?> value="goud">Goud</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'oranje') { echo 'selected'; } ?> value="oranje">Oranje</option>
              </select>
            </div>
          </div>
          <div class="col-6">
            <div class="advance_search_style">
              <select class="maxSelector" name="transmissies">
                <option <?php if (isset($params['transmissies']) && $params['transmissies'] == 'Alles') { echo 'selected'; } ?> value="Alles" selected="">Alle transmissies</option>
                <option <?php if (isset($params['transmissies']) && $params['transmissies'] == 'h') { echo 'selected'; } ?> value="H">Handgeschakeld</option>
                <option <?php if (isset($params['transmissies']) && $params['transmissies'] == 'a') { echo 'selected'; } ?> value="A">Automaat</option>
                <option <?php if (isset($params['transmissies']) && $params['transmissies'] == 's') { echo 'selected'; } ?> value="S">Semi-automaat</option>
              </select>
            </div>
          </div>
          <div class="col-6">
            <div class="advance_search_style">
              <select class="maxSelector" name="brandstoffen">
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'Alles') { echo 'selected'; } ?> value="Alles" selected="">Alle brandstoffen</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'd') { echo 'selected'; } ?> value="D">Diesel</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'h') { echo 'selected'; } ?> value="H">Hybride</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'b') { echo 'selected'; } ?> value="B">Benzine</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'e') { echo 'selected'; } ?> value="E">Elektrisch</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'o') { echo 'selected'; } ?> value="O">Overig</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'l') { echo 'selected'; } ?> value="L">LPG/Gas</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == '3') { echo 'selected'; } ?> value="3">LPG G3</option>
              </select>
            </div>
          </div>
          <div class="col-6">
            <div class="advance_search_style">
              <select class="maxSelector" name="btw-marge">
                <option <?php if (isset($params['btw-marge']) && $params['btw-marge'] == 'Alles') { echo 'selected'; } ?> value="Alles" selected="">BTW of Marge</option>
                <option <?php if (isset($params['btw-marge']) && $params['btw-marge'] == 'btw') { echo 'selected'; } ?> value="btw">BTW</option>
                <option <?php if (isset($params['btw-marge']) && $params['btw-marge'] == 'marge') { echo 'selected'; } ?> value="marge">Marge</option>
              </select>
            </div>
          </div>
          <div class="col-6">
            <div class="advance_search_style">
              <input class="form-control form_control" type="text" name="trefwoord" value="" placeholder="Trefwoord" />
            </div>
          </div>
        </div>
      </div>


    <?php } else { ?>
      <!-- filter op pc's en tablets -->
      <div class="collapse" id="collapseAdvanceSearch">
        <div class="row bgc-thm2">
          <div class="col col-xs-6 col-sm-4 col-lg-2 combi-field-links">
            <div class="advance_search_style">
              <select class="maxSelector" id="bouwjaar_van" name="bouwjaar-van" onchange="vanTotSelector('bouwjaar_van','bouwjaar_tot')">
                <option value="Alles">Bouwjaar van</option>
                <?php
                foreach ($bouwjaar as $jaar) {
                  if ($jaar['voertuig_historie_bouwjaar_jaar'] != 'onbekend') {
                    if (isset($params['bouwjaar-van']) && $params['bouwjaar-van'] == $jaar['voertuig_historie_bouwjaar_jaar']) { $bouwjaar_van = 'selected'; } else { $bouwjaar_van = '';}
                    echo '<option '.$bouwjaar_van.' value="' . $jaar['voertuig_historie_bouwjaar_jaar'] . '">' . $jaar['voertuig_historie_bouwjaar_jaar'] . '</option>';
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col col-xs-6 col-sm-4 col-lg-2 combi-field-rechts">
            <div class="advance_search_style">
              <select class="maxSelector" id="bouwjaar_tot" name="bouwjaar-tot">
                <option value="Alles">Bouwjaar tot</option>
                <?php
                foreach ($bouwjaar as $jaar) {
                  if ($jaar['voertuig_historie_bouwjaar_jaar'] != 'onbekend') {
                    if (isset($params['bouwjaar-tot']) && $params['bouwjaar-tot'] == $jaar['voertuig_historie_bouwjaar_jaar']) { $bouwjaar_tot = 'selected'; } else { $bouwjaar_tot = '';}
                    if(isset($params['bouwjaar-van']) && $params['bouwjaar-van'] >= $jaar['voertuig_historie_bouwjaar_jaar']){ $checkDisabledBouwjaar = 'disabled'; } else { $checkDisabledBouwjaar = '';}
                    echo '<option '.$bouwjaar_tot.' '.$checkDisabledBouwjaar.' value="' . $jaar['voertuig_historie_bouwjaar_jaar'] . '">' . $jaar['voertuig_historie_bouwjaar_jaar'] . '</option>';
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col col-xs-6 col-sm-4 col-lg-2 combi-field-links">
            <div class="advance_search_style">
              <select class="maxSelector" id="km_van" name="km-van" onchange="vanTotSelector('km_van','km_tot')">
                <option <?php if (isset($params['km-van']) && $params['km-van'] == 'Alles') { echo 'selected'; } ?> value="Alles" selected="">Km stand van</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '0') { echo 'selected'; } ?> value="0">0</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '50000') { echo 'selected'; } ?> value="50000">50.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '100000') { echo 'selected'; } ?> value="100000">100.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '150000') { echo 'selected'; } ?> value="150000">150.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '200000') { echo 'selected'; } ?> value="200000">200.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '250000') { echo 'selected'; } ?> value="250000">250.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '300000') { echo 'selected'; } ?> value="300000">300.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '350000') { echo 'selected'; } ?> value="350000">350.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '400000') { echo 'selected'; } ?> value="400000">400.000</option>
                <option <?php if (isset($params['km-van']) && $params['km-van'] == '450000') { echo 'selected'; } ?> value="450000">450.000</option>
              </select>
            </div>
          </div>
          <div class="col col-xs-6 col-sm-4 col-lg-2 combi-field-rechts">
            <div class="advance_search_style">
              <select class="maxSelector" id="km_tot" name="km-tot">
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == 'Alles') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 'Alles'){ echo 'disabled'; } else { echo '';} ?> value="Alles" selected="">Km stand tot</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '50000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 50000){ echo 'disabled'; } else { echo '';} ?> value="50000">50.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '100000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 100000){ echo 'disabled'; } else { echo '';} ?> value="100000">100.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '150000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 150000){ echo 'disabled'; } else { echo '';} ?> value="150000">150.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '200000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 200000){ echo 'disabled'; } else { echo '';} ?> value="200000">200.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '250000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 250000){ echo 'disabled'; } else { echo '';} ?> value="250000">250.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '300000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 300000){ echo 'disabled'; } else { echo '';} ?> value="300000">300.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '350000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 350000){ echo 'disabled'; } else { echo '';} ?> value="350000">350.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '400000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 400000){ echo 'disabled'; } else { echo '';} ?> value="400000">400.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '450000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 450000){ echo 'disabled'; } else { echo '';} ?> value="450000">450.000</option>
                <option <?php if (isset($params['km-tot']) && $params['km-tot'] == '500000') { echo 'selected'; } ?> <?php if(isset($params['km-van']) && $params['km-van'] >= 500000){ echo 'disabled'; } else { echo '';} ?> value="500000">500.000</option>
              </select>
            </div>
          </div>
          <div class="col col-xs-6 col-sm-4 col-lg-2 combi-field-links">
            <div class="advance_search_style">
            <select class="maxSelector" id="verkoopprijs_van" name="verkoopprijs-van" onchange="vanTotSelector('verkoopprijs_van','verkoopprijs_tot')">
              <option <?php if (isset($params['verkoopprijs-van']) && $params['verkoopprijs-van'] == 'Alles') { echo 'selected'; } ?> value="Alles" selected="">Verkoopprijs van</option>
              <?php
                $pricesResult = $db->select("SELECT MIN(`voertuig_financieel_verkoopprijs`) AS laagste_prijs, MAX(`voertuig_financieel_verkoopprijs`) AS hoogste_prijs FROM (SELECT DISTINCT `voertuig_financieel_verkoopprijs` FROM `as_voertuig`  WHERE `voertuig_financieel_verkoopprijs` != 0) AS prices;");
                for ($i = floorThousand($pricesResult[0]['laagste_prijs']); $i <= $pricesResult[0]['hoogste_prijs']; $i += 2500) {
                  if (isset($params['verkoopprijs-van']) && $params['verkoopprijs-van'] == $i) { $verkoopprijs_van = 'selected'; } else { $verkoopprijs_van = '';}
                  echo '<option '.$verkoopprijs_van.' value="'.$i.'" data-price="'.$i.'">€ '.number_format($i,0,",",".").'</option>';
                }
              ?>
            </select>
            </div>
          </div>
          <div class="col col-xs-6 col-sm-4 col-lg-2 combi-field-rechts">
            <div class="advance_search_style">
              <select class="maxSelector" id="verkoopprijs_tot"  name="verkoopprijs-tot">
                <option value="Alles" selected="">Verkoopprijs tot</option>
                <?php
                for ($i = (floorThousand($pricesResult[0]['laagste_prijs'])); $i <= $pricesResult[0]['hoogste_prijs']; $i += 2500) {
                  if(isset($params['verkoopprijs-van']) && $params['verkoopprijs-van'] >= $i){ $checkDisabledVerkoopprijs = 'disabled'; } else { $checkDisabledVerkoopprijs = '';}
                  if (isset($params['verkoopprijs-tot']) && $params['verkoopprijs-tot'] == $i) { $verkoopprijs_tot = 'selected'; } else { $verkoopprijs_tot = '';}
                  echo '<option '.$verkoopprijs_tot.' '.$checkDisabledVerkoopprijs.' value="'.$i.'" data-price="'.$i.'">€ '.number_format($i,0,",",".").'</option>';
                }
              ?>
              </select>
            </div>
          </div>
          <div class="col col-xs-6 col-sm-4 col-lg-2">
            <div class="advance_search_style">
              <select class="maxSelector" name="kleur" >
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'Alles') { echo 'selected'; } ?> value="Alles" selected="">Alle kleuren</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'wit') { echo 'selected'; } ?> value="wit">Wit</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'zwart') { echo 'selected'; } ?> value="zwart">Zwart</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'grijs') { echo 'selected'; } ?> value="grijs">Grijs</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'blauw') { echo 'selected'; } ?> value="blauw">Blauw</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'rood') { echo 'selected'; } ?> value="rood">Rood</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'bruin') { echo 'selected'; } ?> value="bruin">Bruin</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'beige') { echo 'selected'; } ?> value="beige">Beige</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'zilver') { echo 'selected'; } ?> value="zilver">Zilver</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'groen') { echo 'selected'; } ?> value="groen">Groen</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'geel') { echo 'selected'; } ?> value="geel">Geel</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'overig') { echo 'selected'; } ?> value="overig">Overig</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'paars') { echo 'selected'; } ?> value="paars">Paars</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'goud') { echo 'selected'; } ?> value="goud">Goud</option>
                <option <?php if (isset($params['kleur']) && $params['kleur'] == 'oranje') { echo 'selected'; } ?> value="oranje">Oranje</option>
              </select>
            </div>
          </div>
          <div class="col col-xs-6 col-sm-4 col-lg-2">
            <div class="advance_search_style">
              <select class="maxSelector" name="transmissies">
                <option <?php if (isset($params['transmissies']) && $params['transmissies'] == 'Alles') { echo 'selected'; } ?> value="Alles" selected="">Alle transmissies</option>
                <option <?php if (isset($params['transmissies']) && $params['transmissies'] == 'h') { echo 'selected'; } ?> value="H">Handgeschakeld</option>
                <option <?php if (isset($params['transmissies']) && $params['transmissies'] == 'a') { echo 'selected'; } ?> value="A">Automaat</option>
                <option <?php if (isset($params['transmissies']) && $params['transmissies'] == 's') { echo 'selected'; } ?> value="S">Semi-automaat</option>
              </select>
            </div>
          </div>
          <div class="col col-xs-6 col-sm-4 col-lg-2">
            <div class="advance_search_style">
              <select class="maxSelector" name="brandstoffen">
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'Alles') { echo 'selected'; } ?> value="Alles" selected="">Alle brandstoffen</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'd') { echo 'selected'; } ?> value="D">Diesel</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'h') { echo 'selected'; } ?> value="H">Hybride</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'b') { echo 'selected'; } ?> value="B">Benzine</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'e') { echo 'selected'; } ?> value="E">Elektrisch</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'o') { echo 'selected'; } ?> value="O">Overig</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == 'l') { echo 'selected'; } ?> value="L">LPG/Gas</option>
                <option <?php if (isset($params['brandstoffen']) && $params['brandstoffen'] == '3') { echo 'selected'; } ?> value="3">LPG G3</option>
              </select>
            </div>
          </div>
          <div class="col col-xs-6 col-sm-4 col-lg-2">
            <div class="advance_search_style">
              <select class="maxSelector" name="btw-marge">
                <option <?php if (isset($params['btw-marge']) && $params['btw-marge'] == 'Alles') { echo 'selected'; } ?> value="Alles" selected="">BTW of Marge</option>
                <option <?php if (isset($params['btw-marge']) && $params['btw-marge'] == 'btw') { echo 'selected'; } ?> value="btw">BTW</option>
                <option <?php if (isset($params['btw-marge']) && $params['btw-marge'] == 'marge') { echo 'selected'; } ?> value="marge">Marge</option>
              </select>
            </div>
          </div>
          <div class="col col-xs-6 col-sm-4 col-lg-4">
            <div class="advance_search_style">
              <input class="form-control form_control" type="text" name="trefwoord" value="" placeholder="Trefwoord" />
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

    </form>
  </div>
</section>