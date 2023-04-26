<?php
$pageName = 'beheerleveranciers';
$sticky = true;
$beheer = true;
$socketActive = true;
include 'includes/header.php';



$db = app('db');

$result = $db->select(
    "SELECT * FROM `as_adverteerder`"
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
                                        <h2 class="breadcrumb_title">Leveranciers</h2>
                                        <p>Overzicht van alle leveranciers</p>
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
                            <div class="p10-520">
                                <div class="row">
                                    <!-- Tab panes -->
                                    <div class="col-lg-12">
                                        <table id="dataForm" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Adverteerder Nr.</th>
                                                    <th>Adverteerder Naam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result as $auto) { ?>
                                                    <tr>
                                                        <td><?= $auto['adverteerder_naam'] ?></td>
                                                        <td><?= htmlspecialchars_decode($auto['adverteerder_nr']) ?></td>
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