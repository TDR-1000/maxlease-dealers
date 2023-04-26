<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="index" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="images/logo.png" srcset="images/logo.png 2x" alt="logo">
                            <img class="logo-dark logo-img" src="images/logo.png" srcset="images/logo.png 2x" alt="logo-dark">
                            <span class="nio-version">Extranet</span>
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-body" data-simplebar>
                        <div class="nk-sidebar-content">
                            <div class="nk-sidebar-widget d-none d-xl-block">
                                <div class="user-account-actions">
                                    <ul class="g-3">
                                        <li><a href="https://maxlease.nl/partners/calculator/<?= $dealer[0]['pretty_name'] ?>" target="_blank" class="btn btn-lg btn-primary"><span>Calculator <i class="fa-solid fa-arrow-up-right-from-square"></i></span></a></li>
                                        <li><a href="https://maxlease.nl/partners/rekentool/<?= $dealer[0]['magic_url'] ?>" target="_blank" class="btn btn-lg btn-outline-primary popupBerekenen"><span> <i class="fa-solid fa-plus"></i> Offerte</span></a></li>
                                    </ul>
                                </div>
                            </div><!-- .nk-sidebar-widget -->
                            <div class="nk-sidebar-menu">
                                <!-- Menu -->
                                <ul class="nk-menu">
                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title">Menu</h6>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="index" class="nk-menu-link">
                                            <span class="nk-menu-icon"><i class="fa-solid fa-gauge"></i></span>
                                            <span class="nk-menu-text">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="offerte" class="nk-menu-link">
                                            <span class="nk-menu-icon"><i class="fa-solid fa-scroll"></i></span>
                                            <span class="nk-menu-text">Offertes</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="websitetools" class="nk-menu-link">
                                            <span class="nk-menu-icon"><i class="fa-solid fa-file-code"></i></span>
                                            <span class="nk-menu-text">Websitetools</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item d-none">
                                        <a href="besdrijfsgegevens" class="nk-menu-link">
                                            <span class="nk-menu-icon"><i class="fa-solid fa-building"></i></span>
                                            <span class="nk-menu-text">Bedrijfsgegevens</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item d-none">
                                        <a href="openingstijden" class="nk-menu-link">
                                            <span class="nk-menu-icon"><i class="fa-solid fa-square-clock"></i></span>
                                            <span class="nk-menu-text">Openingstijden</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="logout" class="nk-menu-link">
                                            <span class="nk-menu-icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                                            <span class="nk-menu-text">Uitloggen</span>
                                        </a>
                                    </li>

                                </ul><!-- .nk-menu -->
                            </div><!-- .nk-sidebar-menu -->
                            <div class="nk-sidebar-footer">
                                <ul class="nk-menu nk-menu-footer">
                                    <li class="nk-menu-item">
                                        <a href="#" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-help-alt"></em></span>
                                            <span class="nk-menu-text">Support</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item ms-auto">
                                        <div class="dropup">
                                            <a href="#" class="nk-menu-link dropdown-indicator has-indicator" data-bs-toggle="dropdown" data-bs-offset="0,10">
                                                <span class="nk-menu-text">Voorwaarden</span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                <ul class="language-list">
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <span class="language-name">Algemene voorwaarden</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <span class="language-name">Privacy verklaring</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <span class="language-name">Cookies</span>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul><!-- .nk-footer-menu -->
                            </div><!-- .nk-sidebar-footer -->
                        </div><!-- .nk-sidebar-content -->
                    </div><!-- .nk-sidebar-body -->
                </div><!-- .nk-sidebar-element -->
            </div>