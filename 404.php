<?php
  $pageName = '404';
  include 'includes/header.php';

  echo '<div class="wrapper ovh">';
  echo '<div class="preloader"></div>';

  include 'includes/navbar.php';
  include 'includes/mobile-navbar.php';
?>

  <section class="our-error bgc-f9">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 offset-xl-3 text-center pt60 pb80">
          <div class="error_page footer_apps_widget">
            <h1 class="subtitle">Niet gevonden</h1>
            <p>Oeps, deze pagina bestaat niet.</p>
            <div class="erro_code">
              <h2>4<span class="text-thm">0</span>4</h2>
            </div>
          </div>
          <a class="btn_error btn-thm fc-fff" href="index">Terug naar home</a>
        </div>
      </div>
    </div>
  </section>

  <?php
    include 'includes/footerbar.php';
    echo '</div>';
    include 'includes/footer.php';
  ?>