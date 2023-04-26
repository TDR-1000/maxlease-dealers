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
              <?php if (isset($socketActive) && $socketActive == true) {
                include 'includes/ajax/visuals/call.php';
              } ?>
              <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                  <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                      <div class="user-toggle">
                        <div class="user-avatar sm">
                          <em class="icon ni ni-user-alt"></em>
                        </div>
                        <div class="user-info d-none d-md-block">
                          <div class="user-status user-status-unverified">Max Lease</div>
                          <div class="user-name dropdown-indicator">Georg Rabat</div>
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
                  <li class="dropdown notification-dropdown me-n1">
                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                      <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                      <div class="dropdown-head">
                        <span class="sub-title nk-dropdown-title">Notifications</span>
                        <a href="#">Mark All as Read</a>
                      </div>
                      <div class="dropdown-body">
                        <div class="nk-notification">
                          <div class="nk-notification-item dropdown-inner">
                            <div class="nk-notification-icon">
                              <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                            </div>
                            <div class="nk-notification-content">
                              <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                              <div class="nk-notification-time">2 hrs ago</div>
                            </div>
                          </div><!-- .dropdown-inner -->
                          <div class="nk-notification-item dropdown-inner">
                            <div class="nk-notification-icon">
                              <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                            </div>
                            <div class="nk-notification-content">
                              <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                              <div class="nk-notification-time">2 hrs ago</div>
                            </div>
                          </div><!-- .dropdown-inner -->
                          <div class="nk-notification-item dropdown-inner">
                            <div class="nk-notification-icon">
                              <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                            </div>
                            <div class="nk-notification-content">
                              <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                              <div class="nk-notification-time">2 hrs ago</div>
                            </div>
                          </div><!-- .dropdown-inner -->
                          <div class="nk-notification-item dropdown-inner">
                            <div class="nk-notification-icon">
                              <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                            </div>
                            <div class="nk-notification-content">
                              <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                              <div class="nk-notification-time">2 hrs ago</div>
                            </div>
                          </div><!-- .dropdown-inner -->
                          <div class="nk-notification-item dropdown-inner">
                            <div class="nk-notification-icon">
                              <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                            </div>
                            <div class="nk-notification-content">
                              <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                              <div class="nk-notification-time">2 hrs ago</div>
                            </div>
                          </div><!-- .dropdown-inner -->
                          <div class="nk-notification-item dropdown-inner">
                            <div class="nk-notification-icon">
                              <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                            </div>
                            <div class="nk-notification-content">
                              <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                              <div class="nk-notification-time">2 hrs ago</div>
                            </div>
                          </div><!-- .dropdown-inner -->
                        </div>
                      </div><!-- .nk-dropdown-body -->
                      <div class="dropdown-foot center">
                        <a href="#">View All</a>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>