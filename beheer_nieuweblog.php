<?php
$pageName = 'blogbeheer';
$sticky = true;
$WYSeditorNeeded = true;
$socketActive = true;
$beheer = true;
include 'includes/header.php';

$db = app('db');

?>

<div class="wrapper ovh">
    <div class="preloader"></div>

    <?php include 'includes/navbar-beheer.php'; ?>
    <?php include 'includes/mobile-navbar.php'; ?>


    <section class="our-dashbord dashbord bgc-f9">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-10 offset-xxl-2 dashboard_grid_space">
                    <?php include 'includes/beheersidebar.php'; ?>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-lg-9 mb50">
                                    <div class="breadcrumb_content">
                                        <h2 class="breadcrumb_title">Nieuwe blog artikel toevoegen</h2>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard_favorites_contents dashboard_my_lising_tabs p10-520">
                                <div class="row">
                                    <!-- Tab panes -->
                                    <form action="backoffice/MAXEngine/executor/blogToevoegen.php" method="POST" enctype="multipart/form-data">
                                    <div class="col-lg-12">
                                        <div class="tab-content row" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <!-- Tab panes -->
                                                        <h5 class="short_code_title">Blog Url/Link</h5>
                                                        <div class="col-lg-2 placeholderurlbeheer">
                                                            https://maxlease.nl/blog/
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control urlboxbeheer" name="prettyurl" placeholder="dit-is-een-voorbeeld">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5 class="short_code_title">Afbeelding uploaden. Aangeraden formaat (3840x1200 px)</h5>
                                                    <div class="form-group">
                                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                                    </div>
                                                    <h5 class="short_code_title mt20">Blog Titel</h5>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="blogtitel" placeholder="Blog titel">
                                                    </div>
                                                    <h5 class="short_code_title mt20">Blog Inhoud</h5>
                                                    <textarea name="inhoud"></textarea>
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-lg btn-thm mt20">Toevoegen</button>
                                                <input type="hidden" name="<?= MAXCsrf::getTokenName() ?>" value="<?= MAXCsrf::getToken() ?>">
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

<script>
    tinymce.init({
        selector: 'textarea',
        language: 'nl',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>

<?php include 'includes/footer.php'; ?>