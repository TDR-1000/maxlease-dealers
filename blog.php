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
                <div class="nk-block">
                    <div class="nk-block-head-content">
                        
                        <h2 class="nk-block-title fw-normal">Blog</h2>
                        <div class="card card-bordered card-preview">
                        <div class="preloader" id="preloader">
                            <div class="loader"></div>
                        </div>
                            <!-- Tab panes -->
                            <div class="card-inner">
                                <table class="datatable-init-export nowrap table" data-export-title="Export">
                                    <thead>
                                        <tr>
                                            <th width="70px">#</th>
                                            <th width="116px">Titel</th>
                                            <th width="116px">Status</th>
                                            <th width="50px">Datum</th>
                                            <th width="70px">Actie</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $blog) {
                                          $datum = date("d-m-Y", strtotime($blog['blog_datum'])); 
                                          if($blog['blog_status'] == 0){ $status = '<span class="badge rounded-pill bg-danger">Inactief</span>'; }else if($blog['blog_status'] == 1){ $status = '<span class="badge rounded-pill bg-success">Actief</span>'; } 
                                        ?>
                                            <tr class='clickable-row' data-href='url://'>
                                                <td><img class="img-fluid" src="https://maxlease.nl/images/blog/<?= $blog['blog_pretty_url'] ?>-thumb.jpg" alt="<?= $blog['blog_pretty_url'] ?>"></td>
                                                <td><?= strtolower($blog['blog_title']) ?></td>
                                                <td><?= $status ?></td>
                                                <td><?= $datum ?></td>
                                                <td>Openen</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>