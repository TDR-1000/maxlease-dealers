<?php
$pageName = 'beheeroffertes';
$sticky = true;
$socketActive = true;
$beheer = true;
include 'includes/header.php';

$db = app('db');

$result = $db->select(
    "SELECT * FROM `as_offerte`,`as_voertuig` WHERE `as_offerte`.`voertuig_id` = `as_voertuig`.`voertuig_basisgegevens_ID`"
);

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
                                <div class="col-lg-8 mb20">
                                    <div class="breadcrumb_content">
                                        <h2 class="breadcrumb_title">Offertes</h2>
                                        <p>Overzicht van alle offertes</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb20">
                                    <div class="breadcrumb_content">
                                        <div class="form-group row mb-3">
                                            <div class="col-sm-12">
                                                <input type="text" name="aanbetaling" class="form-control sum" id="myInputTextField" inputmode="numeric" placeholder="Zoeken...">
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
                                    <!-- Tab panes -->
                                    <div class="col-lg-12">
                                        <table id="dataForm" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Offerte</th>
                                                    <th>Achternaam</th>
                                                    <th>Bedrijfsnaam</th>
                                                    <th>Status</th>
                                                    <th>Datum</th>
                                                    <th>Actie</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result as $auto) { ?>
                                                    <tr>
                                                        <td><?= $auto['merk'] ?> <?= $auto['model'] ?></td>
                                                        <td><?= $auto['achternaam'] ?></td>
                                                        <td><?= $auto['achternaam'] ?></td>
                                                        <td><?= $auto['bedrijfsnaam'] ?></td>
                                                        <td>Status</td>
                                                        <td><?= $auto['timestamp'] ?></td>
                                                        <td class="editing_list align-middle">
                                                            <ul>
                                                                <li class="list-inline-item mb-1 w-100">
                                                                    <a href="beheer/offertes/<?= $auto['offerte_id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Openen" aria-label="Bekijken"><span class="flaticon-view"> Openen</span> </a>
                                                                </li>
                                                            </ul>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>

                                        </table>
                                    </div>
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