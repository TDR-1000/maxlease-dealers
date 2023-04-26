<?php if (!isset($hidefooterbox)) { ?>
  <section class="d-none" id="disclaimer-widget">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="row">
            <style>
              #locatie {
                line-height: 1.5;
              }

              #locatie a {
                -webkit-font-smoothing: initial;
              }

              #locatie .icon {
                width: 20px;
              }
            </style>

            <div class="col-sm-4" id="locatie">
              <div itemscope="" itemtype="http://schema.org/LocalBusiness">
                <h3 itemprop="name">Max Lease</h3>
                <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                  <div class="row">
                    <div class="col-auto icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                    <div class="col"><a href="tel:0850685620"><span itemprop="telephone">085-0685620</span></a></div>
                  </div>
                  <div class="row">
                    <div class="col-auto icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                    <div class="col">
                      <span itemprop="streetAddress">Lloydsweg 41</span><br />
                      <span itemprop="postalCode">9641KJ</span>
                      <span itemprop="addressLocality">Veendam</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-auto icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                    <div class="col"><a href="mailto:info@max-lease.nl" title="email Max Lease">info@max-lease.nl</a></div>
                  </div>
                </div>
              </div>
              <div class="social">
                <div class="row">
                  <div class="col-auto icon"><span class="fab fa-instagram"></span> </div>
                  <div class="col"><a target="_blank" href="https://www.instagram.com/maxleasehoogeveen/">Instagram</a></div>
                </div>
                <div class="row">
                  <div class="col-auto icon"><span class="fab fa-facebook-f"></span></div>
                  <div class="col"><a target="_blank" href="https://www.facebook.com/Max-Lease-413766982062348/?fref=ts">Facebook</a></div>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="openingstijden">
                <h4>Openingstijden</h4>
                <div class="tijden_row">
                  <p><span>Maandag</span> 09:00 - 17:00</p>
                </div>
                <div class="tijden_row">
                  <p><span>Dinsdag</span> 09:00 - 17:00</p>
                </div>
                <div class="tijden_row">
                  <p><span>Woensdag</span> 09:00 - 17:00</p>
                </div>
                <div class="tijden_row">
                  <p><span>Donderdag</span> 09:00 - 17:00</p>
                </div>
                <div class="tijden_row">
                  <p><span>Vrijdag</span> 09:00 - 17:00</p>
                </div>
                <div class="tijden_row">
                  <p><span>Zaterdag</span> Gesloten</p>
                </div>
                <div class="tijden_row">
                  <p><span>Zondag</span> Gesloten</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="footer_one">
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="copyright-widget text-sm-start">
              &copy; <?= date("Y") ?> Max Lease BV. Alle rechten voorbehouden.
            </div>
          </div>
          <div class="col-sm-6">
            <div class="text-sm-end">
              <a href="#">Algemene Voorwaarden</a> | <a href="#">Privacy Policy</a> | <a href="cookiewet">Cookiewet</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </section>
<?php } ?>


<a class="scrollToHome" href="#"><i class="fas fa-arrow-up"></i></a>