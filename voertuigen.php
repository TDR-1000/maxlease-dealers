<?php
$pageName = 'Dashboard';
$socketActive = true;
$sticky = true;
include 'includes/header.php';

$beheer = true;

$db = app('db');

$result = $db->select(
    "SELECT * FROM `as_voertuig` ORDER BY `voertuig_basisgegevens_ID` ASC"
);
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
                        
                        <h2 class="nk-block-title fw-normal">Voertuigen</h2>
                        <div class="card card-bordered card-preview">
                        <div class="preloader" id="preloader">
                            <div class="loader"></div>
                        </div>
                            <!-- Tab panes -->
                            <div class="card-inner">
                                <table class="datatable-init-export nowrap table" data-export-title="Export">
                                    <thead>
                                        <tr>
                                            <th width="70px">#</th>
                                            <th width="116px">Kenteken</th>
                                            <th width="290px">Naam</th>
                                            <th width="70px">Brandstof</th>
                                            <th width="70px">Transmissie</th>
                                            <th width="136px">Marktplaats</th>
                                            <th width="124px">Gaspedaal</th>
                                            <th width="118px">Datum</th>
                                            <th width="118px">Bekijken</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $auto) {
                                        ?>
                                            <tr>
                                                <td><?= $auto['voertuig_basisgegevens_ID'] ?></td>
                                                <td><?= $auto['voertuig_basisgegevens_kenteken'] ?></td>
                                                <td><?= $auto['voertuig_basisgegevens_merk'] ?> <?= $auto['voertuig_basisgegevens_model'] ?><Br><?= $auto['voertuig_basisgegevens_uitvoering'] ?></td>
                                                <td><?= $auto['voertuig_basisgegevens_brandstof'] ?></td>
                                                <td><?= $auto['voertuig_techischegegevens_transmissie'] ?></td>
                                                <td class="text-center"><span class="badge rounded-pill bg-danger">Inactief</span></td>
                                                <td class="text-center"><span class="badge rounded-pill bg-danger">Inactief</span></td>
                                                <td><?= date("d-m-Y", strtotime($auto['voertuig_toegevoegd_datum'])) ?></td>
                                                <td><a href="https://maxlease.nl/i/<?= $auto['pretty_url_website'] ?>" target="_blank">Bekijken</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>