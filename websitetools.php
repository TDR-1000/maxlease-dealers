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
            <h2 class="nk-block-title fw-normal">Websitetools</h2>

            <div class="card card-bordered card-preview">
              <!-- Tab panes -->
              <div class="card-inner">
                <p><b>Lease calculator iframe:</b></p>

                <p>Met onze handige lease calculator kunnen uw klanten snel en eenvoudig berekenen hoeveel ze maandelijks kwijt zijn aan een leaseauto. Om deze tool op uw eigen website te integreren, hoeft u alleen maar de bijbehorende iframe-code te kopiëren en in uw website te plakken. Dit kan bijvoorbeeld in de footer, sidebar of aparte pagina van uw website. Zodra uw klanten de calculator invullen en hun gegevens achterlaten, worden deze automatisch naar u doorgestuurd. Zo kunt u snel en efficiënt offertes op maat maken en uw klanten nog beter van dienst zijn.</p>
                <pre><code class="language-html">&lt;iframe src="https://maxlease.nl/partners/rekentool/<?= $dealer[0]['magic_url'] ?>" width="100%" height="600"&gt;&lt;/iframe&gt;</code></pre>
                 <i>Dit is uw persoonlijke calculator in een iFrame deel deze code niet met derden.</i>   


                <p class="mt-3"><b >Persoonlijke link:</b></p>

                <p>Als u onze lease calculator gaat gebruiken, krijgt u een persoonlijke link toegewezen waarmee u uw klanten rechtstreeks naar de calculator kunt sturen. Deze link kunt u bijvoorbeeld opnemen in uw nieuwsbrief, social media posts of andere marketinguitingen. Zo kunnen uw klanten nog sneller en gemakkelijker gebruik maken van onze tool en krijgt u meer aanvragen binnen. Om uw persoonlijke link te vinden, hoeft u alleen maar in te loggen op onze website en naar uw dashboard te gaan. Daar vindt u alle informatie die u nodig heeft om van onze lease calculator een succes te maken.</p>
                <pre><code class="language-html">https://maxlease.nl/partners/calculator/<?= $dealer[0]['pretty_name'] ?></code></pre>
                <i>Dit is uw persoonlijke link naar uw landingspagina, deze is vrij te delen met uw klanten.</i> 

              </div>
            </div>
          </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
      </div><!-- .nk-block-head -->

    </div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>