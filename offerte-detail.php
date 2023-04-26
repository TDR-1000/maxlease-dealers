<?php
$pageName = 'Dashboard';
$socketActive = true;
$sticky = true;
include 'includes/header.php';

$beheer = true;

$db = app('db');

$result = $db->select(
    "SELECT * FROM `as_offerte` WHERE `as_offerte`.`offerte_id` = :id",
    array("id" => $_GET['id'])
);

if ($result[0]['voertuig_id'] != 0) {
    $voertuig = $db->select(
        "SELECT * FROM `as_voertuig` WHERE `as_voertuig`.`voertuig_basisgegevens_ID` = :id",
        array("id" => $result[0]['voertuig_id'])
    );
}

if (!$result) {
    redirect('offerte');
}

$prijstotaal = number_format((float)$result[0]['aankoopsom'], 2, ',', '.');

if($result[0]['edited'] == 0){
    $berekeningleasebedrag = (float)$result[0]['aankoopsom'] - (float)$result[0]['aanbetaling'];
}else{
    $berekeningleasebedrag = $result[0]['leasebedrag'];
}

$aanbetaling = number_format((float)$result[0]['aanbetaling'], 2, ',', '.');
$slottermijn = number_format((float)$result[0]['slottermijn'], 2, ',', '.');

$leasebedrag = number_format((float)$berekeningleasebedrag, 2, ',', '.');
$totaalbedrag = number_format((float)$result[0]['aankoopsom'], 2, ',', '.');

$looptijd = $result[0]['looptijd_maanden'] . ' maanden';
$afinruil = number_format((float)0, 2, ',', '.');
$inlossingcontract = number_format((float)0, 2, ',', '.');

$maandbedrag = number_format((float)$result[0]['maandbedrag'], 2, ',', '.');

?>

<?php include 'includes/bodytop.php'; ?>
<!-- main header @e -->
<!-- content @s -->


<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block">
                    <div class="nk-block-head-content">
                        <div class="card card-bordered card-preview">
                            <div class="preloader" id="preloader">
                                <div class="loader"></div>
                            </div>
                            <!-- Tab panes -->
                            <form action="includes/ajax/offerteAanpassen.php" method="POST">
                            <input type="hidden" name="offerte_id" value="<?= $_GET['id'] ?>">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block">
                                        <?php if (isset($_GET['melding']) && $_GET['melding'] == 'voertuig-onbekend') { ?>

                                            <div class="alert alert-warning mb-5">
                                                <div class="alert-cta flex-wrap flex-md-nowrap">
                                                    <div class="alert-text">
                                                        <p>Helaas is de actie die u probeerde uit te voeren mislukt, omdat het voertuig onbekend is. Mocht u dit probleem vaker tegenkomen, dan verzoeken wij u vriendelijk om dit te melden aan onze websitebeheerders.</p>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>
                                        <div class="nk-block-head">
                                            <div class="nk-block-between-md g-4">

                                                <div class="nk-block-head-content">
                                                    <h4 class="nk-block-title">Offerte #<?= $result[0]['offerte_id'] ?> - <?= changeDate($result[0]['timestamp']) ?></h4>
                                                </div>
                                                <div class="nk-block-head nk-block-head-sm nk-block-between">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalDefault" class="btn btn-outline-primary mr-5"><span>Ander voertuig selecteren</span></button>
                                                    <div class="btn-group"><button type="button" class="btn btn-<?= statusOfferteColor($result[0]['status']); ?> dropdown-toggle" data-bs-toggle="dropdown"><span><?= statusOfferte($result[0]['status']) ?></span> <em class="icon ni ni-chevron-down"></em></button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="statusWijzigen?status=1&offerte_id=<?= $result[0]['offerte_id'] ?>"><span>In behandeling</span></a></li>
                                                                <li><a href="statusWijzigen?status=2&offerte_id=<?= $result[0]['offerte_id'] ?>"><span>Akkoord</span></a></li>
                                                                <li><a href="statusWijzigen?status=3&offerte_id=<?= $result[0]['offerte_id'] ?>"><span>Afgeleverd</span></a></li>
                                                                <li><a href="statusWijzigen?status=4&offerte_id=<?= $result[0]['offerte_id'] ?>"><span>Afgewezen</span></a></li>
                                                                <li><a href="statusWijzigen?status=5&offerte_id=<?= $result[0]['offerte_id'] ?>"><span>Afgelegd</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#offerte"><em class="fa-solid fa-file-invoice mr-5"></em><span>Offerte</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#auto"><em class="fa-solid fa-car mr-5"></em><span>Auto</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#bedrijf"><em class="fa-solid fa-building mr-5"></em><span>Bedrijf</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#rdw"><em class="fa-solid fa-car mr-5"></em><span>RDW</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#belhistorie"><em class="fa-solid fa-phone mr-5"></em><span>Belhistorie</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#offertevoorbeeld"><em class="fa-solid fa-file-invoice mr-5"></em><span>Voorbeeld offerte</span></a> </li>
                                    </ul>
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="offerte">
                                            <div class="row g-gs">
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Leasebedrag">Leasebedrag</label>
                                                        <div class="form-control-wrap"><input type="text" <?= formValue($leasebedrag); ?> class="form-control eurokr" id="Leasebedrag" name="Leasebedrag" placeholder="Leasebedrag"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Looptijd">Looptijd</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2" name="looptijd">
                                                                <option <?= selectFormCheck($result[0]['looptijd_maanden'], '24'); ?> value="24"> 24 maanden</option>
                                                                <option <?= selectFormCheck($result[0]['looptijd_maanden'], '36'); ?> value="36"> 36 maanden</option>
                                                                <option <?= selectFormCheck($result[0]['looptijd_maanden'], '48'); ?> value="48"> 48 maanden</option>
                                                                <option <?= selectFormCheck($result[0]['looptijd_maanden'], '60'); ?> value="60"> 60 maanden</option>
                                                                <option <?= selectFormCheck($result[0]['looptijd_maanden'], '72'); ?> value="72"> 72 maanden</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Slottermijn">Aanbetaling</label>
                                                        <div class="form-control-wrap"><input type="text" <?= formValue($aanbetaling); ?> class="form-control eurokr" name="aanbetaling" id="Slottermijn" placeholder="Slottermijn"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Maandbedrag">Maandbedrag</label>
                                                        <div class="form-control-wrap"><input type="text" <?= formValue($result[0]['maandbedrag']); ?> class="form-control eurokr" name="maandbedrag" id="Maandbedrag" placeholder="Maandbedrag"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Koopsom">Slottermijn</label>
                                                        <div class="form-control-wrap"><input type="text" <?= formValue($slottermijn); ?> class="form-control eurokr" name="slottermijn" id="Koopsom" placeholder="Koopsom"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="BTW 21%">BTW</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" name="btw" id="BTW 21%" value="<?php if (isset($voertuig[0]['voertuig_financieel_BTW'])) {
                                                                                                                                                                    echo checkBTWForm($voertuig[0]['voertuig_financieel_BTW']);
                                                                                                                                                                } else {
                                                                                                                                                                    echo '0%';
                                                                                                                                                                } ?>" placeholder="BTW 21%"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Prijs totaal">Prijstotaal</label>
                                                        <div class="form-control-wrap"><input type="text" <?= formValue($result[0]['aankoopsom']); ?> class="form-control eurokr" name="prijstotaal" id="Prijs totaal" placeholder="Prijs totaal"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Resterend bedrag">Type BTW</label>
                                                        <div class="form-control-wrap"><input type="text" <?= formValue($result[0]['MargeBTW']); ?> class="form-control" name="typebtw" id="Resterend bedrag" placeholder="Type BTW"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Af: Inruil">Af: Inruil</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control eurokr" id="Af: Inruil" placeholder="Af: Inruil"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Af: Inlossing">Af: Inlossing</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control eurokr" id="Af: Inlossing" placeholder="Af: Inlossing"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="auto">
                                            <div class="row g-gs">
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Auto">Auto</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['merk']); ?> name="autonaam" id="Auto" placeholder="Auto"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"> <label class="form-label">Soort auto</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2" name="soortauto">
                                                                <option value="Incl. BTW">Inclusief BTW</option>
                                                                <option value="Excl. BTW">Exclusief BTW</option>
                                                                <option value="Marge">Marge</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group"><label class="form-label" for="Model & Uitvoering">Model & Uitvoering</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['model']) ?> id="Model & Uitvoering" name="modeluitvoering" placeholder="Model & Uitvoering"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Prijs">Prijs</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control eurokr" <?= formValue($result[0]['aankoopsom']) ?> id="Prijs" name="prijs" placeholder="Prijs"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Km stand">Km stand</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-text-hint"><span class="overline-title">KM</span></div><input type="text" class="form-control" <?= formValue($result[0]['km_stand']) ?> id="Km stand" name="kmstand" placeholder="Km stand">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Bouwjaar maand">Bouwjaar maand</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2" name="bouwjaarmaand">
                                                                <option <?php if (!isset($result[0]['bouwmaand'])) {
                                                                            echo monthFormCheck($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'], '01');
                                                                        }else{ echo monthFormCheck($result[0]['bouwmaand'], '01'); } ?> value="01">Januari</option>
                                                                <option <?php if (!isset($result[0]['bouwmaand'])) {
                                                                            echo monthFormCheck($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'], '02');
                                                                        }else{ echo monthFormCheck($result[0]['bouwmaand'], '02'); } ?> value="02">Februari</option>
                                                                <option <?php if (!isset($result[0]['bouwmaand'])) {
                                                                            echo monthFormCheck($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'], '03');
                                                                        }else{ echo monthFormCheck($result[0]['bouwmaand'], '03'); } ?> value="03">Maart</option>
                                                                <option <?php if (!isset($result[0]['bouwmaand'])) {
                                                                            echo monthFormCheck($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'], '04');
                                                                        }else{ echo monthFormCheck($result[0]['bouwmaand'], '04'); } ?> value="04">April</option>
                                                                <option <?php if (!isset($result[0]['bouwmaand'])) {
                                                                            echo monthFormCheck($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'], '05');
                                                                        }else{ echo monthFormCheck($result[0]['bouwmaand'], '05'); } ?> value="05">Mei</option>
                                                                <option <?php if (!isset($result[0]['bouwmaand'])) {
                                                                            echo monthFormCheck($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'], '06');
                                                                        }else{ echo monthFormCheck($result[0]['bouwmaand'], '06'); } ?> value="06">Juni</option>
                                                                <option <?php if (!isset($result[0]['bouwmaand'])) {
                                                                            echo monthFormCheck($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'], '07');
                                                                        }else{ echo monthFormCheck($result[0]['bouwmaand'], '07'); } ?> value="07">Juli</option>
                                                                        <option <?php if (!isset($result[0]['bouwmaand'])) {
                                                                            echo monthFormCheck($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'], '08');
                                                                        }else{ echo monthFormCheck($result[0]['bouwmaand'], '08'); } ?> value="08">Augustus</option>
                                                                <option <?php if (!isset($result[0]['bouwmaand'])) {
                                                                            echo monthFormCheck($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'], '09');
                                                                        }else{ echo monthFormCheck($result[0]['bouwmaand'], '09'); } ?> value="09">September</option>
                                                                <option <?php if (!isset($result[0]['bouwmaand'])) {
                                                                            echo monthFormCheck($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'], '10');
                                                                        }else{ echo monthFormCheck($result[0]['bouwmaand'], '10'); } ?> value="10">Oktober</option>
                                                                <option <?php if (!isset($result[0]['bouwmaand'])) {
                                                                            echo monthFormCheck($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'], '11');
                                                                        }else{ echo monthFormCheck($result[0]['bouwmaand'], '11'); } ?> value="11">November</option>
                                                                <option <?php if (!isset($result[0]['bouwmaand'])) {
                                                                            echo monthFormCheck($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'], '12');
                                                                        }else{ echo monthFormCheck($result[0]['bouwmaand'], '12'); } ?> value="12">December</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Bouwjaar jaar">Bouwjaar jaar</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?php if (isset($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'])) {
                                                                                                                                    echo dateFormCheck($voertuig[0]['voertuig_historie_bouwjaar_datumdeel1'], 2);
                                                                                                                                } ?> id="Bouwjaar jaar" name="bouwjaarjaar" placeholder="Bouwjaar jaar"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Brandstof">Brandstof</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2" name="brandstoffen">
                                                                <option value="Onbekend">Onbekend</option>
                                                                <option <?php if (isset($voertuig[0]['voertuig_basisgegevens_brandstof'])) {
                                                                            echo selectFormCheck($voertuig[0]['voertuig_basisgegevens_brandstof'], 'D');
                                                                        } ?> value="D">Diesel</option>
                                                                <option <?php if (isset($voertuig[0]['voertuig_basisgegevens_brandstof'])) {
                                                                            echo selectFormCheck($voertuig[0]['voertuig_basisgegevens_brandstof'], 'H');
                                                                        } ?> value="H">Hybride</option>
                                                                <option <?php if (isset($voertuig[0]['voertuig_basisgegevens_brandstof'])) {
                                                                            echo selectFormCheck($voertuig[0]['voertuig_basisgegevens_brandstof'], 'B');
                                                                        } ?> value="B">Benzine</option>
                                                                <option <?php if (isset($voertuig[0]['voertuig_basisgegevens_brandstof'])) {
                                                                            echo selectFormCheck($voertuig[0]['voertuig_basisgegevens_brandstof'], 'E');
                                                                        } ?> value="E">Elektrisch</option>
                                                                <option <?php if (isset($voertuig[0]['voertuig_basisgegevens_brandstof'])) {
                                                                            echo selectFormCheck($voertuig[0]['voertuig_basisgegevens_brandstof'], 'O');
                                                                        } ?> value="O">Overig</option>
                                                                <option <?php if (isset($voertuig[0]['voertuig_basisgegevens_brandstof'])) {
                                                                            echo selectFormCheck($voertuig[0]['voertuig_basisgegevens_brandstof'], 'L');
                                                                        } ?> value="L">LPG/Gas</option>
                                                                <option <?php if (isset($voertuig[0]['voertuig_basisgegevens_brandstof'])) {
                                                                            echo selectFormCheck($voertuig[0]['voertuig_basisgegevens_brandstof'], '3');
                                                                        } ?> value="3">LPG G3</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Carrosserie">Carrosserie</label>
                                                        <div class="form-control-wrap"><input type="text" name="carrosserie" class="form-control" <?php if (isset($voertuig[0]['voertuig_carrosseriegegevens_carrosserie'])) {
                                                                                                                                                        echo formValue($voertuig[0]['voertuig_carrosseriegegevens_carrosserie']);
                                                                                                                                                    } ?> id="Carrosserie" placeholder="Carrosserie"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Kenteken">Kenteken</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control kentekenplaat mini-kenteken" <?= formValue($result[0]['kenteken']); ?> name="kenteken" id="Kenteken" placeholder="Kenteken"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Transmissie">Transmissie</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2" name="transmissies">
                                                                <option value="Alles">Onbekend</option>
                                                                <option <?php if (isset($voertuig[0]['voertuig_techischegegevens_transmissie'])) {
                                                                            echo selectFormCheck($voertuig[0]['voertuig_techischegegevens_transmissie'], 'H');
                                                                        } ?> value="H">Handgeschakeld</option>
                                                                <option <?php if (isset($voertuig[0]['voertuig_techischegegevens_transmissie'])) {
                                                                            echo selectFormCheck($voertuig[0]['voertuig_techischegegevens_transmissie'], 'A');
                                                                        } ?> value="A">Automaat</option>
                                                                <option <?php if (isset($voertuig[0]['voertuig_techischegegevens_transmissie'])) {
                                                                            echo selectFormCheck($voertuig[0]['voertuig_techischegegevens_transmissie'], 'S');
                                                                        } ?> value="S">Semi-automaat</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="bedrijf">
                                            <div class="row g-gs">
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Bedrijfsnaam">Bedrijfsnaam</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['bedrijfsnaam']); ?> id="Bedrijfsnaam" name="bedrijfsnaam" placeholder="Bedrijfsnaam"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="KVK Nummer">KVK Nummer</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['kvknr']); ?> id="KVK Nummer" name="kvknummer" placeholder="KVK Nummer"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group"><label class="form-label" for="Aanhef">Aanhef</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2" name="aanhef">
                                                                <option <?= selectFormCheck($result[0]['aanhef'], '1'); ?> value="1"> Dhr</option>
                                                                <option <?= selectFormCheck($result[0]['aanhef'], '2'); ?> value="2"> Mevr</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group"><label class="form-label" for="Voorletters">Voorletters</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['voorletters']); ?> id="Voorletters" name="voornaam" placeholder="Voorletters"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group"><label class="form-label" for="Tussenvoegsel">Tussenvoegsel</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['tussenvoegsel']); ?> id="Tussenvoegsel" name="tussenvoegsel" placeholder="Tussenvoegsel"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group"><label class="form-label" for="Achternaam">Achternaam</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['achternaam']); ?> id="Achternaam" name="achternaam" placeholder="Achternaam"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group"><label class="form-label" for="Geboortedatum">Geboortedatum</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['slottermijn']); ?> id="Geboortedatum" name="geboortedatum" placeholder="Geboortedatum"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Straatnaam">Straatnaam</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['straatnaam']); ?> id="Straatnaam" name="straatnaam" placeholder="Straatnaam"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group"><label class="form-label" for="Huisnummer">Huisnummer</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['huisnummer']); ?> id="Huisnummer" name="huisnummer" placeholder="Huisnummer"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group"><label class="form-label" for="Toevoeging">Toevoeging</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['toevoeging']); ?> id="Toevoeging" name="toevoeging" placeholder="Toevoeging"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Postcode">Postcode</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['postcode']); ?> id="Postcode" name="postcode" placeholder="Postcode"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Plaatsnaam">Plaatsnaam</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['plaatsnaam']); ?> id="Plaatsnaam" name="plaatsnaam" placeholder="Plaatsnaam"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="E-mailadres">E-mailadres</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['email']); ?> id="E-mailadres" name="email" placeholder="E-mailadres"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label class="form-label" for="Telefoonnummer">Telefoonnummer</label>
                                                        <div class="form-control-wrap"><input type="text" class="form-control" <?= formValue($result[0]['telefoonnummer']); ?> id="Telefoonnummer" name="telefoonnummer" placeholder="Telefoonnummer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="rdw">
                                            <div class="row g-gs">

                                                <?php
                                                if (isset($result[0]['kenteken']) && !empty($result[0]['kenteken'])) {
                                                    $kenteken_trim = str_replace("-", "", $result[0]['kenteken']);

                                                    $curl = curl_init();

                                                    curl_setopt_array($curl, array(
                                                        CURLOPT_URL => 'https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken=' . $kenteken_trim,
                                                        CURLOPT_RETURNTRANSFER => true,
                                                        CURLOPT_ENCODING => '',
                                                        CURLOPT_MAXREDIRS => 10,
                                                        CURLOPT_TIMEOUT => 0,
                                                        CURLOPT_FOLLOWLOCATION => true,
                                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                        CURLOPT_CUSTOMREQUEST => 'GET',
                                                    ));

                                                    $response = curl_exec($curl);

                                                    curl_close($curl);
                                                    //echo '<pre>' . var_export($response, true) . '</pre>';

                                                    $json = json_decode($response, true);

                                                    if (count($json) === 0) { ?>
                                                        <div class="col-lg-12">
                                                            <h4 class="text-center">Kan gegevens niet ophalen uit het RDW</h4>
                                                        </div> <?php } else { ?>

                                                        <div class="col-lg-12">
                                                            <table class="table table-striped">
                                                                <tbody>
                                                                    <?php foreach ($json[0] as $x => $val) {
                                                                        if ($x == 'api_gekentekende_voertuigen_assen' || $x == 'api_gekentekende_voertuigen_brandstof' || $x == 'api_gekentekende_voertuigen_carrosserie' || $x == 'api_gekentekende_voertuigen_carrosserie_specifiek' || $x == 'api_gekentekende_voertuigen_voertuigklasse') {
                                                                        } else { ?>
                                                                            <tr>
                                                                                <th><?= $x ?></th>
                                                                                <td><?= $val ?></td>
                                                                            </tr>
                                                                    <?php }
                                                                    } ?>

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    <?php
                                                            }
                                                        } else { ?>
                                                    <div class="col-lg-12">
                                                        <h4 class="text-center">Geen kenteken bekend</h4>
                                                    </div>
                                                <?php } ?>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="belhistorie">
                                            <div class="row g-gs">
                                                <div class="col-lg-12">
                                                    <?php echo callhistorie($result[0]['telefoonnummer']); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="offertevoorbeeld">
                                            <div class="row g-gs">
                                                <div class="row g-gs">
                                                    <div class="col-lg-12">
                                                        <iframe src="includes/pdf/offerte/<?= $_GET['id'] ?>" width="100%" height="900px" title="offerte"></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nk-block">

                                        <button type="submit" name="submit" class="btn btn-primary mt-3 mr-5"><span>Wijzigingen opslaan</span></button>

                                    </div>
                            </form>
                        </div>
                    </div>
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->

    </div>
</div>
</div>

<!-- Modal Trigger Code -->
<div class="modal fade" tabindex="-1" id="modalDefault">
    <form method="GET" action="voertuigVervangen">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ander voertuig selecteren</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="form-group"><label class="form-label" for="url">URL van voertuig op maxlease.nl</label>
                            <div class="form-control-wrap"><input type="text" class="form-control" required id="url" name="url" placeholder="https://maxlease.nl/i/voorbeeld-voertuig-link"><input type="hidden" name="offerte_id" value="<?= $_GET['id'] ?>"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text"><button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-outlined-primary mr-5"><span>Annuleren</span></button><button type="submit" class="btn btn-primary"><span>Selecteren</span></button></span>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include 'includes/footer.php'; ?>