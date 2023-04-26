<?php
  $pageName = 'beheerautos';
  $sticky = true;
  $beheer = true;
  $socketActive = true;
  include 'includes/header.php';

  $db = app('db');

  $result = $db->select(
    "SELECT * FROM `as_voertuig` ORDER BY `voertuig_basisgegevens_ID` ASC"
  );
?>

<div class="wrapper ovh">
  <?php
    include 'includes/navbar-beheer.php';
    include 'includes/mobile-navbar.php';
  ?>
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
                    <h2 class="breadcrumb_title">Auto's op de website</h2>
                    <p>Overzicht van alle auto's</p>
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
                  <div class="col-lg-12">
                    <table id="dataForm" class="table" style="width:100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Kenteken</th>
                          <th>Naam</th>
                          <th>Brandstof</th>
                          <th>Transmissie</th>
                          <th>Marktplaats</th>
                          <th>Gaspedaal</th>
                          <th>Datum</th>
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
                            <td class="text-center"><span class="reddot"></span></td>
                            <td class="text-center"><span class="reddot"></span></td>
                            <td><?= date("d-m-Y", strtotime($auto['voertuig_toegevoegd_datum'])) ?></td>
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