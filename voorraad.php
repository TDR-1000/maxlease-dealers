<?php
  $pageName = 'voorraad';
  $stickyFilter = true;
  $voorraad = true;

  include 'includes/header.php';

  $db = app('db');

  if (isset($_GET['filter'])) {

    $str = $_GET['filter'];
    $parts = explode('/', $str);

    $params = array();

    foreach ($parts as $part) {
      $key_value = explode(':', $part);
      $key = $key_value[0];
      $value = $key_value[1];
      $params[$key] = $value;
    }
    //print_r($params);
  }

  $num_results_on_page = 24;
  if (isset($params['pagina'])) {
    $page = $params['pagina'];
    if ($page == 1) {
      $pageCounter = '';
    } else {
      $pageCounter = $page * $num_results_on_page . ',';
    }
  } else {
    $page = 1;
    $pageCounter = '';
  }

  $autocounter = $db->select(
    "SELECT count(*) FROM `as_voertuig`"
  );

  $automerken = $db->select(
    "SELECT DISTINCT `voertuig_basisgegevens_merk` FROM `as_voertuig` ORDER BY `voertuig_basisgegevens_merk` ASC"
  );

  if (isset($params['merk'])) {
    $resultmodellen = $db->select(
      "SELECT DISTINCT `voertuig_basisgegevens_model` FROM `as_voertuig` WHERE `voertuig_basisgegevens_merk` = :merk ORDER BY `voertuig_basisgegevens_model` ASC",
      array("merk" => $params['merk'])
    );
  }

  $bouwjaar = $db->select(
    "SELECT DISTINCT `voertuig_historie_bouwjaar_jaar` FROM `as_voertuig` ORDER BY `voertuig_historie_bouwjaar_jaar` ASC;"
  );

?>

<div class="wrapper ovh">

<?php
  include 'includes/navbar.php';
  include 'includes/mobile-navbar.php';
  include 'includes/voorraad-filter.php';
?>

  <section class="featured-product">
    <div class="container">
      <div class="row justify-content-center" id="resulthead">
        <div class="col">
          <div class="main-title">
            <h2><span id="counterGetal">0 auto's op voorraad</span></h2>
          </div>
        </div>
        <div class="col-sm-6 text-sm-end">
          Gesorteerd op:
          <select name="sortering" form="filter" class="mr30" id="sortering">
            <option value="Alles">Sorteer op</option>
            <option value="1">Leasebedrag, oplopend</option>
            <option value="2">Leasebedrag, aflopend</option>
            <option value="3">KM stand, oplopend</option>
            <option value="4">KM stand, aflopend</option>
            <option value="5">Bouwjaar, oplopend</option>
            <option value="6">Bouwjaar, aflopend</option>
            <option value="7">Merk, oplopend</option>
            <option value="8">Merk, aflopend</option>
          </select>
          <a href="voorraad" class="more_listing">Filters resetten</span></a>
        </div>
      </div>
      <div class="row" id="resultfiltered">
        <div class="col-lg-12">
          <div class="popular_listing_sliders">
            <div class="row" id="load_data_test">
              <?php include 'includes/ajax/voorraad-plain.php'; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php
  onzePartners('grijs');
  include 'includes/footerbar.php';
  echo '</div>';
  include 'includes/footer.php';
?>