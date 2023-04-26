<?php if (!isset($beheer)) { ?>

<style>
  .header_top_contact_opening_widget li,
  .header_top_contact_opening_widget ul,
  .header_top_contact_opening_widget a {
    transition: none!important;
  }
</style>

<div class="header_top dn-992 ">
  <div class="container">
    <div class="row">
      <div class="col-auto">
        <div class="header_top_contact_opening_widget text-center text-md-start">
          <ul class="mb0">
            <li class="list-inline-item">
              <a href="tel:0850685620" title="bel ons" style="color: #fff;"><span class="flaticon-phone-call" style="width: 15px; margin-right: 10px;"></span>085 0685 620</a>
            </li>
            <li class="list-inline-item text-white">
              <a href="#"><span class="flaticon-map"></span>Lloydsweg 41, 9641KJ Veendam</a>
            </li>
            <li class="list-inline-item stars">
              <span class="text-white pe-2"><?php $getal = ReviewShower(1); echo starCounter($getal); ?></span><a href="https://www.klantenvertellen.nl/reviews/1032303/max_lease" target="_blank" class="text-white" title="lees reviews over Max Lease op klantenvertellen.nl">Klanten geven ons een <?= $getal; ?></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col">
        <div class="header_top_social_widgets text-center text-md-end">
          <ul class="m0">
            <li class="list-inline-item">
              <a href="https://www.facebook.com/maxlease.nl/" rel="me" title="like ons op Facebook" target="_blank"><span class="fab fa-facebook-f"></span></a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.instagram.com/maxlease.nl/" rel="me" title="volg ons op Instagram" target="_blank"><span class="fab fa-instagram"></span></a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.linkedin.com/company/maxlease/" rel="me" title="connect met ons op LinkedIn" target="_blank"><span class="fab fa-linkedin"></span></a>
            </li>
            <li class="list-inline-item">
              <a href="javascript:void(Tawk_API.toggle())" title="stel direct je vraag via onze chat"><span class="fa-solid fa-comment-smile"></span></a>
            </li>
            <?php /* <li class="list-inline-item d-none"><a href="#" data-bs-toggle="modal" data-bs-target="#logInModal">Inloggen</a></li>
            <li class="list-inline-item d-none"><a href="#" data-bs-toggle="modal" data-bs-target="#logInModal">Registreren</a></li> */ ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<?php } ?>

<header class=" header-nav menu_style_home_one transparent main-menu<?php if (isset($sticky)) { echo ' navbar-scrolltofixed border-nav-enable'; } ?>">
  <nav>
    <div class="container posr">
      <div class="menu-toggle">
        <button type="button" id="menu-btn">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <a href="index" class="navbar_brand float-start dn-md">
        <img class="logo1 img-fluid" src="images/logo.png" alt="logo Max Lease" />
      </a>
      <ul id="respMenu" class="ace-responsive-menu text-end" data-menu-style="horizontal">
        <li><a href="voorraad" title="bekijk actuele voorraad"><span class="title menu-item<?= $pageName == 'auto' ? ' menu-active' : '' ?> <?= $pageName == 'voorraad' ? ' menu-active' : '' ?>">Auto Voorraad</span></a></li>
        <li><a href="berekenen" title="bereken uw maandbedragen bij financial lease"><span class="title menu-item<?= $pageName == 'berekenen' ? ' menu-active' : '' ?>">Bereken Direct</span></a></li>
        <li><a href="financial-lease" title="lees meer over Financial Lease"><span class="title menu-item<?= $pageName == 'financial-lease' ? ' menu-active' : '' ?>">Financial Lease</span></a></li>
        <li><a href="over-ons" title="Wie zijn wij?"><span class="title menu-item<?= $pageName == 'over-ons' ? ' menu-active' : '' ?>">Over ons</span></a></li>
        <li><a href="blog" title="ga naar ons blog"><span class="title menu-item<?= $pageName == 'blog' ? ' menu-active' : '' ?>">Blog</span></a></li>
        <li class="add_listing ms-md-1 ms-xl-5 pe-0"><a href="offerte-aanvragen" title="vrijblijvende offerte aanvragen">Offerte aanvragen</a></li>
      </ul>
    </div>
  </nav>
</header>