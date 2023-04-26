<?php
$pageName = 'Dashboard';
$socketActive = true;
$sticky = true;
include 'includes/header.php';

$beheer = true;

$db = app('db');
$currentUser = app('current_user');

$result = $db->select(
  "SELECT * FROM `as_offerte` WHERE `partner_id` = :id",
  array ("id" => $currentUser->dealer_id)
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
            <h2 class="nk-block-title fw-normal">Overzicht offertes</h2>

            <div class="card card-bordered card-preview">
            <div class="preloader" id="preloader">
                            <div class="loader"></div>
                        </div>
              <!-- Tab panes -->
              <div class="card-inner">
                <table class="datatable-init-export nowrap table" data-export-title="Export">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Offerte</th>
                      <th>Achternaam</th>
                      <th>Bedrijfsnaam</th>
                      <th>Datum</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($result as $auto) { ?>
                      <tr class=''>
                        <td><?= $auto['merk'] ?> <?= $auto['model'] ?></td>
                        <td><?= $auto['offerte_id'] ?></td>
                        <td><?= $auto['achternaam'] ?></td>
                        <td><?= $auto['bedrijfsnaam'] ?></td>
                        <td><?= date("d-m-Y", strtotime($auto['timestamp'])) ?></td>
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