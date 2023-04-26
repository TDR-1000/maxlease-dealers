<body class="nk-body npc-crypto bg-lighter has-sidebar ">

  <div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
      <!-- sidebar @s -->
      <?php include 'includes/beheersidebar.php'; ?>
      <!-- sidebar @e -->
      <!-- wrap @s -->
      <div class="nk-wrap ">
        <!-- main header @s -->
        <div class="nk-header nk-header-fluid nk-header-fixed is-light">
          <div class="container-fluid">
            <div class="nk-header-wrap">
              <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
              </div>
              <div class="nk-header-brand d-xl-none">
                <a href="html/loan/index.html" class="logo-link">
                  <img class="logo-light logo-img" src="images/logo.png" srcset="images/logo.png 2x" alt="logo">
                  <img class="logo-dark logo-img" src="images/logo.png" srcset="images/logo.png 2x" alt="logo-dark">
                  <span class="nio-version">Extranet</span>
                </a>
              </div>
              <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                  <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                      <div class="user-toggle">
                        <div class="user-avatar sm">
                          <em class="icon ni ni-user-alt"></em>
                        </div>
                        <div class="user-info d-none d-md-block">
                          <div class="user-status user-status-unverified"><?php
$bedrijfsnaam = $dealer[0]['Bedrijfsnaam'];
if (strlen($bedrijfsnaam) > 10) {
  $bedrijfsnaam = substr($bedrijfsnaam, 0, 20) . '...';
}
echo $bedrijfsnaam;
?></div>
                          <div class="user-name dropdown-indicator"><?= ucfirst($currentUser->first_name) ?> <?= ucfirst($currentUser->last_name) ?></div>
                        </div>
                      </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                      <div class="dropdown-inner">
                        <ul class="link-list">
                          <li><a href="html/loan/security-settings.html"><em class="icon ni ni-setting-alt"></em><span>Instellingen</span></a></li>
                          <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Donkere Modus</span></a></li>
                        </ul>
                      </div>
                      <div class="dropdown-inner">
                        <ul class="link-list">
                          <li><a href="logout"><em class="icon ni ni-signout"></em><span>Uitloggen</span></a></li>
                        </ul>
                      </div>
                    </div>
                  </li>
                 
                </ul>
              </div>
            </div>
          </div>
        </div>