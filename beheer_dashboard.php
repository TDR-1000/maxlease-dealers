<?php
  $pageName = 'beheerdashboard';
  $socketActive = true;
  $sticky = true;
  include 'includes/header.php';

  $beheer = true;

  $db = app('db');

  $result = $db->select(
    "SELECT * FROM `as_blog`"
  );
?>

<div class="wrapper ovh">
  <div class="preloader"></div>
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
                <div class="col-lg-9 mb50">
                  <div class="breadcrumb_content">
                    <h2 class="breadcrumb_title">Dashboard</h2>
                    <p>Overzicht van alle blogartikelen</p>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include 'includes/footer.php'; ?>