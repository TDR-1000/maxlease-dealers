<?php

$pageName = 'beheeroffertes';
$sticky = true;
$socketActive = true;
$beheer = true;
include 'includes/header.php';

$db = app('db');

$result = $db->select(
    "SELECT * FROM `as_offerte` WHERE `offerte_id` = :id",
    array("id" => $_GET['offerteid'])
);

if ($result[0]['voertuig_id'] != 0) {
    $result = $db->select(
        "SELECT * FROM `as_offerte`,`as_voertuig` WHERE `as_offerte`.`voertuig_id` = `as_voertuig`.`voertuig_basisgegevens_ID` AND `as_offerte`.`offerte_id` = :id",
        array("id" => $_GET['offerteid'])
    );
}


?>

<div class="wrapper ovh">
    <div class="preloader"></div>
    <?php include 'includes/navbar-beheer.php'; ?>
    <?php include 'includes/mobile-navbar.php'; ?>

    <section class="our-dashbord dashbord bgc-fff">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-10 offset-xxl-2 dashboard_grid_space">
                    <?php include 'includes/beheersidebar.php'; ?>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="breadcrumb_content">
                                        <h2 class="breadcrumb_title">Offerte #<?= $result[0]['offerte_id'] ?></h2>
                                        <p>Overzicht van alle offertes</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="breadcrumb_content">
                                        <div class="form-group row mb-3">
                                            <div class="col-sm-12 ui_kit_button">
                                                <button type="button" class="btn btn-lg btn-dark">Status wijzigen</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class=" p10-520">
                                <div class="row">
                                    <div class="ui_kit_tab mt30">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#overzicht">Overzicht</a> </li>
                                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#klant">Klant</a> </li>
                                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#auto">Auto</a> </li>
                                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#offerte">Offerte</a> </li>

                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div id="overzicht" class="tab-pane active">
                                                <div class="col-12">
                                                    <h2 class="mb10">Klantgegevens</h2>
                                                </div>
                                                <div class="col-sm-6">
                                                    <table class="table-spec">
                                                        <tbody>
                                                            <tr>
                                                                <td>Bedrijfsnaam</td>
                                                                <th><?= $result[0]['bedrijfsnaam'] ?></th>
                                                            </tr>
                                                            <tr>
                                                                <td>KvK nr.</td>
                                                                <th><?= $result[0]['kvknr'] ?></th>
                                                            </tr>
                                                            <tr>
                                                                <td>Naam</td>
                                                                <th><?= aanhefCheck($result[0]['aanhef']) ?> <?= $result[0]['voorletters'] ?> <?= $result[0]['tussenvoegsel'] ?> <?= $result[0]['achternaam'] ?></th>
                                                            </tr>
                                                            <tr>
                                                                <td>Adres</td>
                                                                <th><?= $result[0]['straatnaam'] ?> <?= $result[0]['huisnummer'] ?> <?= $result[0]['toevoeging'] ?></th>
                                                            </tr>
                                                            <tr>
                                                                <td>Postcode + Plaatsnaam</td>
                                                                <th><?= $result[0]['postcode'] ?>, <?= $result[0]['plaatsnaam'] ?></th>
                                                            </tr>
                                                            <tr>
                                                                <td>E-mail</td>
                                                                <th><?= $result[0]['email'] ?></th>
                                                            </tr>
                                                            <tr>
                                                                <td>Telefoonnummer</td>
                                                                <th><?= $result[0]['telefoonnummer'] ?></th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <h4 class="mb10 mt10">Lease gegevens</h4>
                                                    <table class="table-spec">
                                                        <tbody>
                                                            <tr>
                                                                <td>Aankoopsom</td>
                                                                <th><?= $result[0]['aankoopsom'] ?></th>
                                                            </tr>
                                                            <tr>
                                                                <td>Aanbetaling</td>
                                                                <th><?= $result[0]['aanbetaling'] ?></th>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-6">
                                                </div>
                                            </div>
                                            <?php if ($result[0]['voertuig_id'] != 0) { ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h2 class="mb10">Voertuig gegevens</h2>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h4 class="mb10">Algemeen</h4>
                                                        <table class="table-spec">
                                                            <tbody>
                                                                <tr class="kenteken">
                                                                    <td>Kenteken</td>
                                                                    <th><input name="form_name" class="form-control kentekenplaat mini-kenteken" disabled type="text" value="<?= $result[0]['voertuig_basisgegevens_kenteken'] ?>" maxlength="8"></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Merk</td>
                                                                    <th><?= $result[0]['voertuig_basisgegevens_merk'] ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Model</td>
                                                                    <th><?= $result[0]['voertuig_basisgegevens_model'] ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Carrosserievorm</td>
                                                                    <th><?= $result[0]['voertuig_carrosseriegegevens_carrosserie'] ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Km. stand</td>
                                                                    <th><?= $result[0]['voertuig_historie_tellerstand_stand'] ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Bouwjaar</td>
                                                                    <th><?= $result[0]['voertuig_historie_bouwjaar_jaar'] ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Datum Deel 1</td>
                                                                    <th><?= $result[0]['voertuig_historie_bouwjaar_datumdeel1'] ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Brandstof</td>
                                                                    <th><?= brandstofCheck($result[0]['voertuig_basisgegevens_brandstof']); ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Transmissie</td>
                                                                    <th><?= transmissieCheck($result[0]['voertuig_techischegegevens_transmissie']) ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Aantal zitplaatsen</td>
                                                                    <th><?= $result[0]['voertuig_carrosseriegegevens_aantalZitplaatsen'] ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kleur</td>
                                                                    <th><?= $result[0]['voertuig_carrosseriegegevens_kleur'] ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Bekleding</td>
                                                                    <th><?= $result[0]['voertuig_carrosseriegegevens_bekleding'] ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>BTW/Marge</td>
                                                                    <th><?php if ($result[0]['voertuig_financieel_BTW'] == 1) {
                                                                            echo 'Marge';
                                                                        } else {
                                                                            echo 'BTW';
                                                                        } ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Wegenbelasting</td>
                                                                    <th><?php if ($result[0]['voertuig_financieel_wegenbelastingkwartaal_min'] == 0) {
                                                                            echo 'Onbekend';
                                                                        } else { ?>€ <?= $result[0]['voertuig_financieel_wegenbelastingkwartaal_min'] ?> - € <?= $result[0]['voertuig_financieel_wegenbelastingkwartaal_max'] ?> per kwartaal <?php } ?></th>
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
                                                                    <th><?= $result[0]['voertuig_techischegegevens_vermogenmotor_PK'] ?> pk (<?= $result[0]['voertuig_techischegegevens_vermogenmotor_KW'] ?> kW)</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Aantal cilinders</td>
                                                                    <th><?= $result[0]['voertuig_techischegegevens_cilinder_aantal'] ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Cilinderinhoud</td>
                                                                    <th><?= $result[0]['voertuig_techischegegevens_cilinder_inhoud'] ?> cc</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gewicht (leeg)</td>
                                                                    <th><?= $result[0]['voertuig_carrosseriegegevens_massa'] ?> kg</th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <h4 class="mt30 mb10">Milieu en verbruik</h4>
                                                        <table class="table-spec" id="verbruik">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Gemiddeld verbruik</td>
                                                                    <th><?php if ($result[0]['voertuig_milieu_gemiddeldverbruik'] < 1) {
                                                                            echo 'Onbekend';
                                                                        } else { ?><?= $result[0]['voertuig_milieu_gemiddeldverbruik'] ?> l/100km <span>(1 op <?php echo number_format(100 / $result[0]['voertuig_milieu_gemiddeldverbruik'], 2); ?>)</span><?php } ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Verbruik stad</td>
                                                                    <th><?php if ($result[0]['voertuig_milieu_verbruikStad'] < 1) {
                                                                            echo 'Onbekend';
                                                                        } else { ?><?= $result[0]['voertuig_milieu_verbruikStad'] ?> l/100km <span>(1 op <?php echo number_format(100 / $result[0]['voertuig_milieu_verbruikStad'], 2); ?>)</span><?php } ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Verbruik snelweg</td>
                                                                    <th><?php if ($result[0]['voertuig_milieu_verbruikSnelweg'] < 1) {
                                                                            echo 'Onbekend';
                                                                        } else { ?><?= $result[0]['voertuig_milieu_verbruikSnelweg'] ?> l/100km <span>(1 op <?php echo number_format(100 / $result[0]['voertuig_milieu_verbruikSnelweg'], 2); ?>)</span><?php } ?></th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div id="termijnen">
                                                            <div class="termijnen-box">
                                                                <div class="header-slot">
                                                                    72 maanden
                                                                </div>
                                                                <div class="body-slot">
                                                                    <span class="termijnen-prijs">€ <?= renteCalc($result[0]['voertuig_financieel_verkoopprijs'], 72, $result[0]['voertuig_financieel_BTW'], 1) ?><span class="periode">p/m</span></span>
                                                                </div>
                                                            </div>
                                                            <div class="termijnen-box">
                                                                <div class="header-slot">
                                                                    60 maanden
                                                                </div>
                                                                <div class="body-slot">
                                                                    <span class="termijnen-prijs">€ <?= renteCalc($result[0]['voertuig_financieel_verkoopprijs'], 60, $result[0]['voertuig_financieel_BTW'], 1) ?><span class="periode">p/m</span></span>
                                                                </div>
                                                            </div>
                                                            <div class="termijnen-box last">
                                                                <div class="header-slot">
                                                                    48 maanden
                                                                </div>
                                                                <div class="body-slot">
                                                                    <span class="termijnen-prijs">€ <?= renteCalc($result[0]['voertuig_financieel_verkoopprijs'], 48, $result[0]['voertuig_financieel_BTW'], 1) ?><span class="periode">p/m</span></span>
                                                                </div>
                                                            </div>
                                                            <div class="disclaimer">* Getoonde leasebedragen zijn bij een slot&shy;termijn van <span class="text-nowrap">&euro; <?= number_format($result[0]['voertuig_financieel_verkoopprijs'] * 0.15, 2, ",", ".") ?></span>. Vraag naar de voorwaarden.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div id="klant" class="tab-pane fade">
                                            2
                                        </div>
                                        <div id="auto" class="tab-pane fade">
                                            3
                                        </div>
                                        <div id="offerte" class="tab-pane fade">
                                            4
                                        </div>
                                    </div>
                                </div>
                                <?php var_dump($result); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>


</div>

<?php include 'includes/footer.php'; ?>