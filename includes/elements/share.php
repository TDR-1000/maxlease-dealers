<?php if (isset($deeldit)) { $deeldittekst = $deeldit; } else { $deeldittekst = "delen"; } ?>

<div class="share d-flex align-items-center justify-content-between">
  <h6 class="d-none d-sm-block"><?= ucfirst($deeldittekst) ?>:</h6>
  <h6 class="d-block d-sm-none">Delen:</h6>
  <ul class="list-inline mb-0">
    <li class="list-inline-item"><span id="shareFacebook"></span></li>
    <li class="list-inline-item"><span id="shareTwitter"></span></li>
    <li class="list-inline-item"><span id="shareMail"></span></li>
    <li class="list-inline-item"><span id="shareLinkedin"></span></li>
    <li class="list-inline-item"><span id="shareWhatsapp"></span></li>
  </ul>
</div>

<script>
  var uri = "https://maxlease.nl/<?= $shareURL ?>";
  var resuri = encodeURIComponent(uri);
  var titel = "<?= $shareTitle ?>";
  var restitel = encodeURIComponent(titel);
  var check = "Check deze link: ";
  var rescheck = encodeURIComponent(check);

  document.getElementById("shareFacebook").innerHTML = '<a class="share-icon icfacebook" href="https://www.facebook.com/sharer/sharer.php?u=' + resuri + '" title="deel dit artikel op Facebook" target="_blank"><span class="fab fa-facebook-f"></span></a>';
  document.getElementById("shareTwitter").innerHTML = '<a class="share-icon ictwitter" href="https://twitter.com/intent/tweet?text=' + rescheck + '%0A' + resuri + '" title="deel dit artikel op Twitter" target="_blank"><span class="fab fa-twitter"></span></a>';
  document.getElementById("shareMail").innerHTML = '<a class="share-icon icmail" href="mailto:?subject=ik%20las%20dit%20leuke%20artikel&body=Ik%20zag%20onderstaand%20artikel%20en%20dacht%20je%20dit%20wellicht%20interessant%20zou%20vinden%3A%0A%0A' + restitel + '%0A' + resuri + '" title="mail dit artikel" target="_blank"><span class="fa fa-envelope"></span></a>';
  document.getElementById("shareLinkedin").innerHTML = '<a class="share-icon iclinkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=' + resuri + '" title="deel dit artikel op LinkedIn" target="_blank"><span class="fab fa-linkedin-in"></span></a>';
  document.getElementById("shareWhatsapp").innerHTML = '<a class="share-icon icwhatsapp" href="https://wa.me/?text=' + rescheck + '%0A' + resuri + '" title="deel dit artikel via Whatsapp" target="_blank"><span class="fab fa-whatsapp"></span></a>';
</script>