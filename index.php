<?php
$pageName = 'Dashboard';
$socketActive = true;
$sticky = true;
include 'includes/header.php';

$beheer = true;

$db = app('db');

$result = $db->select(
  "SELECT * FROM `as_blog`"
);
?>

<?php include 'includes/bodytop.php'; ?>
<!-- main header @e -->
<!-- content @s -->
<div class="nk-content nk-content-fluid">
  <div class="container-xl wide-lg">
    <div class="nk-content-body">
      <div class="nk-block-head">
        <div class="nk-block-between-md g-4">
          <div class="nk-block-head-content">
            <h2 class="nk-block-title fw-normal">Dashboard</h2>

            <div class="nk-block">

                                    <div class="alert alert-warning mb-5">
                                        <div class="alert-cta flex-wrap flex-md-nowrap">
                                            <div class="alert-text">
                                                <p>Op dit moment zijn een aantal functies in ons systeem uitgeschakeld om het systeem verder te verfijnen. We begrijpen dat deze functies essentieel zijn voor de gebruikerservaring en willen u verzekeren dat ze binnenkort weer beschikbaar zullen zijn. We werken momenteel aan een update om deze functies te verbeteren en te optimaliseren, zodat u de best mogelijke ervaring krijgt. We danken u voor uw geduld en begrip terwijl we ons systeem upgraden. Houd onze updates in de gaten om te zien wanneer deze functies weer beschikbaar zullen zijn.</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
          </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
      </div><!-- .nk-block-head -->

    </div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>