<?php
  $pageName = 'berekenen';
  $noChat = true;
  include 'includes/header.php';
  $db = app('db');

  $solocalc = true;
  $hidefooterbox = true;
  $sticky = true;
  $rdwapi = true;
?>

<div class="wrapper ovh">

<?php
  include 'includes/navbar.php';
  if ($deviceType == "phone") { include 'includes/mobile-navbar.php'; }
?>

  <section class="service-forms bgc-fff pt0 mb30">
    <div class="container">
      <div class="row justify-content-md-center paddingformbox">
        <div class="col-md-7 col-xl-8">
          <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
              <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                <p>Stap 1</p>
              </div>
              <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p>Stap 2</p>
              </div>
              <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p>Stap 3</p>
              </div>
            </div>
          </div>
          <form role="form" id="myform" action="includes/executor/offerte" method="POST">
            <?php if (isset($_POST['formsubmitted'])) { ?>
              <input type="hidden" name="voertuig_id" value="<?= $_POST['voertuig_id'] ?>">
            <?php } ?>

          <!-- stap 1/3 -->
            <div class="row setup-content" id="step-1">
              <h1 class="title mb30">Bereken uw leasebedrag<div class="stappenteller disable-mobile">Stap 1 van 3</div>
              </h1>
              <div class="form-group row g-3">
                <div class="col-6 mb-3">
                  <label for="aankoopsom" class="col-form-label label-new req">Aanschafprijs</label>
                  <input type="text" class="form-control eurokr sum" name="aankoopsom" <?php if (isset($_POST['formsubmitted'])) { echo 'readonly'; } ?> id="aankoopsom" required inputmode="numeric" min="0" value="<?php if (isset($_POST['aankoopbedrag'])) { echo $_POST['aankoopbedrag']; } else { echo '0'; } ?>" placeholder="Aankoopsom" />
                </div>
                <div class="col-6 mb-3">
                  <label for="aanbetaling" class="col-form-label label-new">Aanbetaling</label>
                  <input type="text" class="form-control eurokr sum" name="aanbetaling" id="aanbetalingfield" inputmode="numeric" min="0" value="<?php if (isset($_POST['aanbetaling'])) { echo $_POST['aanbetaling']; } else { echo '0';  } ?>" placeholder="Aanbetaling" />
                </div>

                <div class="col-12 mb-3">
                <label for="inputPassword" class="col-sm-4 col-form-label  label-new">Looptijd maanden</label>
                  <div class="row g-2">
                    <label class="labl col">
                      <input type="radio" name="looptijd_maand" id="looptijd_maand" value="24" <?php if (isset($_POST['looptijd_maand']) && $_POST['looptijd_maand'] == 24) { echo 'checked="checked"'; } ?>>
                      <div>24</div>
                    </label>
                    <label class="labl col">
                      <input type="radio" name="looptijd_maand" id="looptijd_maand" value="36" <?php if (isset($_POST['looptijd_maand']) && $_POST['looptijd_maand'] == 36) { echo 'checked="checked"'; } ?>>
                      <div>36</div>
                    </label>
                    <label class="labl col">
                      <input type="radio" name="looptijd_maand" id="looptijd_maand" value="48" <?php if (isset($_POST['looptijd_maand']) && $_POST['looptijd_maand'] == 48) { echo 'checked="checked"'; } ?>>
                      <div>48</div>
                    </label>
                    <label class="labl col">
                      <input type="radio" name="looptijd_maand" id="looptijd_maand" value="60" <?php if (isset($_POST['looptijd_maand']) && $_POST['looptijd_maand'] == 60) { echo 'checked="checked"'; } ?>>
                      <div>60</div>
                    </label>
                    <label class="labl col">
                      <input type="radio" name="looptijd_maand" id="looptijd_maand" value="72" <?php if (isset($_POST['looptijd_maand']) && $_POST['looptijd_maand'] == 72) { echo 'checked="checked"'; } ?><?php if (!isset($_POST['looptijd_maand'])) { echo 'checked="checked"'; } ?>>
                      <div>72</div>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group row gx-3 mb-3">
                <div class="col-6">
                  <label for="slottermijnfield" class="col-form-label label-new">Slottermijn</label>
                  <input type="text" class="form-control eurokr sum" name="slottermijn" id="slottermijnfield" value="<?php if (isset($_POST['slottermijn'])) { echo $_POST['slottermijn']; } else { echo '0'; } ?>" inputmode="numeric" placeholder="Slottermijn">
                </div>
              </div>

              <div class="footerbox-sticky">
                <div class="container">
                  <div class="row mb0 justify-content-md-center">
                    <div class="col-md-8">
                      <div class="prijspmoverview">€
                        <?php if (isset($_POST['aankoopbedrag']) && isset($_POST['looptijd_maand']) && isset($_POST['aanbetaling']) && isset($_POST['slottermijn'])) { echo renteCalc($_POST['aankoopbedrag'], $_POST['looptijd_maand'], $_POST['aanbetaling'], $_POST['slottermijn']); } else { if (isset($_POST['aankoopbedrag']) && !empty($_POST['aankoopbedrag'])) { echo renteCalc($_POST['aankoopbedrag'], 72, 0, 0); } else { echo '0,00'; } } ?><span>p/m</span>
                      </div>
                      <button class="btn btn-thm advnc_search_form_btn fs-127 w-200pix mb-2 nextBtn pull-right" id="step-1" form="myform" type="button">Volgende stap</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          <!-- stap 2/3 -->
            <div class="row setup-content" id="step-2">
              <h1 class="title mb30">Gegevens voertuig<div class="stappenteller ">Stap 2 van 3</div></h1>
              <label for="kenteken" class="col col-form-label label-new mb0">Kenteken <?php if (!isset($_POST['formsubmitted'])) { echo '(indien bekend)'; } ?></label>
              <br />
              <div class="form-group row mb-3">
                <div class="col-sm-3">
                  <input class="form-control kentekenplaat" name="kenteken" <?php if (isset($_POST['formsubmitted'])) { echo 'readonly'; } ?> id="kentekenberekenen" value="<?php if (isset($_POST['kenteken'])) { echo $_POST['kenteken']; } ?>" style="max-width: 100%;" type="text" placeholder="XX-XX-XX">
                </div>
              </div>

              <div class="form-group row mb-3">
                <div class="col-sm-6 mb-sm-0 mb-3">
                  <label for="merk" class="col col-form-label label-new req">Merk</label>
                  <input type="text" class="form-control sum" id="merk" name="merk" <?php if (isset($_POST['formsubmitted'])) { echo 'readonly'; } ?> value="<?php if (isset($_POST['merk'])) { echo $_POST['merk']; } ?>" placeholder="Merk" required />
                </div>
                <div class="col-sm-6">
                  <label for="model" class="col col-form-label label-new">Model</label>
                  <input type="text" class="form-control sum" id="model" name="model" <?php if (isset($_POST['formsubmitted'])) { echo 'readonly'; } ?> value="<?php if (isset($_POST['model'])) { echo $_POST['model']; } ?>" placeholder="Model" />
                </div>
              </div>

              <div class="form-group row mb-3">
                <div class="col-12">
                  <label for="link" class="col col-form-label label-new">Link naar voertuigadvertentie <?php if (!isset($_POST['formsubmitted'])) { echo '(indien bekend)'; } ?></label>
                  <input type="text" class="form-control sum" id="link" name="link" placeholder="https://.." <?php if (isset($_POST['formsubmitted'])) { echo 'readonly'; } ?> value="<?php if (isset($_POST['link'])) { echo $_POST['link']; } ?>" />
                </div>
              </div>

              <div class="footerbox-sticky">
                <div class="container">
                  <div class="row mb0 justify-content-md-center">
                    <div class="col-md-8">
                      <div class="prijspmoverview">
                        € <?php if (isset($_POST['aankoopbedrag']) && isset($_POST['looptijd_maand']) && isset($_POST['aanbetaling']) && isset($_POST['slottermijn'])) { echo renteCalc($_POST['aankoopbedrag'], $_POST['looptijd_maand'], $_POST['aanbetaling'], $_POST['slottermijn']); } else { if (isset($_POST['aankoopbedrag']) && !empty($_POST['aankoopbedrag'])) { echo renteCalc($_POST['aankoopbedrag'], 72, 0, 0); } else { echo '0,00'; } } ?><span>p/m</span>
                      </div>
                      <button class="btn btn-thm advnc_search_form_btn fs-127 w-200pix mb-2 nextBtn pull-right" id="step-1" form="myform" type="button">Volgende stap</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          <!-- stap 3/3 -->
            <div class="row g-3 setup-content" id="step-3">
              <h1 class="title mb30 col-12">Persoonlijke gegevens<div class="stappenteller ">Stap 3 van 3</div></h1>
                <div class="form-group col-sm-6 col-8 mb-sm-3 mb-0">
                  <label for="organisation_name" class="col-form-label label-new req">Bedrijfsnaam</label>
                  <input type="text" class="form-control sum" name="organisation_name" id="Bedrijfsnaam" value="" placeholder="Bedrijfsnaam" required />
                </div>

                <div class="form-group col-sm-6 col-4 mb-sm-3 mb-0">
                  <label for="kvknummer" class="col-form-label label-new req">KvK nummer</label>
                  <input type="text" class="form-control sum kvknr" name="kvknummer" id="KvK nummer" value="" placeholder="<?=$deviceType=="phone"?'KvK nr.':'KvK nummer'?>" required />
                  <div id="userList"></div>
                </div>

                <div class="form-group col-sm-2 col-6 mb-sm-3 mb-0">
                  <label for="aanhef" class="col-form-label label-new">Aanhef</label>
                  <select name="sex" class="form-control sum" id="aanhef" required />
                    <option selected disabled>Selecteer</option>
                    <option value="1">Dhr</option>
                    <option value="2">Mevr</option>
                  </select>
                </div>

                <div class="form-group col-sm-4 col-6 mb-sm-3 mb-0">
                  <label for="firstname" class="col-form-label label-new req">Voorletter(s)</label>
                  <input type="text" class="form-control sum" name="firstname" id="Voorletters" value="" placeholder="Voorletter(s)" required />
                </div>

                <div class="form-group col-sm-2 col-5 mb-sm-3 mb-0">
                  <label for="insertion" class="col-form-label label-new">Tussenvoegsel</label>
                  <input type="text" class="form-control sum" name="insertion" id="Tussenvoegsel" placeholder="<?=$deviceType=="phone"?'Tussenv.':'Tussenvoegsel'?>" />
                </div>

                <div class="form-group col-sm-4 col-7 mb-sm-3 mb-0">
                  <label for="lastname" class="col-form-label label-new req">Achternaam</label>
                  <input type="text" class="form-control sum" name="lastname" id="Achternaam" placeholder="Achternaam" required />
                </div>

                <div class="form-group col-sm-6 col-5 mb-sm-3 mb-0">
                  <label for="postalcode" class="col-form-label label-new req">Postcode</label>
                  <input type="text" class="form-control sum" name="postalcode" id="postcodeTexthuischeck" value="" placeholder="Postcode" required />
                </div>

                <div class="form-group col-sm-3 col-4 mb-sm-3 mb-0">
                  <label for="housenumber" class="col-form-label label-new req">Huisnummer</label>
                  <input type="number" inputmode="numeric" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="housenrTexthuischeck" class="form-control sum" name="housenumber" value="" placeholder="<?=$deviceType=="phone"?'Huisnr.':'Huisnummer'?>" required />
                </div>

                <input type="hidden" name="straatnaam" id="straatnaam" value="" />
                <input type="hidden" name="plaatsnaam" id="plaatsnaam" value="" />

                <div class="form-group col-sm-3 col-3 mb-sm-3 mb-0">
                  <label for="Toevoeging" class="col-form-label label-new">Toevoeging</label>
                  <input type="text" class="form-control sum uc" name="houseaddition" id="Toevoeging" value="" placeholder="<?=$deviceType=="phone"?'Toev.':'Toevoeging'?>" />
                </div>

                <div class="postcodehuischeck col-12 mb-sm-3 adresboxShower">
                  <span id="straatnaamhuisnummer"></span>
                </div>

                <div class="form-group col-sm-6 mb-sm-3 mb-0">
                  <label for="email" class="col-form-label label-new req">Email</label>
                  <input type="email" class="form-control sum" name="email" id="Email" placeholder="Email" required />
                </div>

                <div class="form-group col-sm-6 mb-sm-3 mb-0">
                  <label for="phone" class="col-form-label label-new req">Telefoonnummer</label>
                  <input type="text" class="form-control sum input-tel" name="phone" id="Telefoonnummer" placeholder="<?=$deviceType=="phone"?'Tel.nummer':'Telefoonnummer'?>" required />
                </div>

                <div class="footerbox-sticky">
                  <div class="container">
                    <div class="row mb0 justify-content-md-center">
                      <div class="col-md-8">
                        <div class="row mb-0">
                          <div class="col-md-6">
                            <div class="df mt10">
                              <input type="checkbox" class="custom-control-input mr10" id="akkoordcheck" required />
                              <label class="custom-control-label label-new" for="akkoordcheck"> Ik ga akkoord met de <a target="_blank">algemene voorwaarden</a></label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <button class="btn btn-thm advnc_search_form_btn fs-127 w-200pix mb-2 nextBtn pull-right" id="frmSubmit" form="myform" type="submit">Versturen</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php
    include 'includes/footerbar.php';
    echo '</div>';
    include 'includes/footer.php';
  ?>