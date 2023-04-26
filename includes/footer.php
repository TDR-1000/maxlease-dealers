       <!-- content @e -->
       <div class="nk-footer">
          <div class="container-fluid">
            <div class="nk-footer-wrap">
              <div class="nk-footer-copyright"> &copy; <?= date('Y') ?> Max Lease. Realisatie door Marketing Optimaal B.V.</a>
              </div>
            </div>
          </div>
        </div>
        <!-- footer @e -->
      </div>
      <!-- wrap @e -->
    </div>
    <!-- main @e -->
  </div>
  <!-- app-root @e -->
  <!-- JavaScript -->
  <script src="js/kentekenplaat.min.js"></script>
  <script>
    new Kentekenplaat(document.querySelector('.kentekenplaat'));

  </script>

  <script src="elements/assets/js/bundle.js?ver=3.1.2"></script>
  <script src="elements/assets/js/scripts.js?ver=3.1.2"></script>

  <script src="elements/assets/js/libs/datatable-btns.js?ver=3.1.2"></script>



  <script src="magnific-popup/jquery.magnific-popup.js"></script>
  <script>

jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});

    $(document).ready(function () {
      hidePreloader();
    });

function hidePreloader() {
  const preloader = document.getElementById("preloader");
  preloader.style.opacity = 0;
  setTimeout(function () {
    preloader.style.display = "none";
  }, 1);
}

    $(document).ready(function() {
      function pollServer() {
        $.ajax({
          url: 'includes/ajax/qFfdI6xOEsmvOVFx2d64Tyc9H3qNUSGG9y5cL9YDpCFCijbORjDUddGY1ooT.php',
          type: 'GET',
          success: function(callData) {
            myResult = JSON.parse(callData);

            if (myResult.new_data == 'bellen') {

              var name = myResult.name;
              var phone = myResult.phone;
              var offerteID = myResult.offerteid;


              $("#naamCall").replaceWith(name);
              $("#telefoonnummerCall").replaceWith(phone);
              $("#offerteIDCall").replaceWith(offerteID);
              $("#linkId").attr("href", "/offerte/" + offerteID);
              $("#callCHeck").addClass("active");
            } else {
              $("#callCHeck").removeClass("active");
            }
          },
          error: function() {
            console.log('Error polling server');
          },
          complete: function() {
            // poll again after 2 seconds
            setTimeout(pollServer, 1000);
          }
        });

      }

      pollServer();
    });

    $('.popupBerekenen').magnificPopup({
      type: 'iframe'
    });
  </script>

<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.1.0"></script>
<script src="js/autonummeric-config.min.js"></script>
</body>

</html>