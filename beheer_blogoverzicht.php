<?php
$pageName = 'blogbeheer';
$sticky = true;
$socketActive = true;
include 'includes/header.php';

$beheer = true;

$db = app('db');

$result = $db->select(
    "SELECT * FROM `as_blog`"
);
?>

<div class="wrapper ovh">
    <div class="preloader"></div>

    <?php include 'includes/navbar-beheer.php'; ?>
    <?php include 'includes/mobile-navbar.php'; ?>


    <section class="our-dashbord dashbord bgc-fff">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-10 offset-xxl-2 dashboard_grid_space">
                    <?php include 'includes/beheersidebar.php'; ?>
                    <div class="row">
                        <div class="col-xl-12">
                        <div class="row">
                            <div class="col-lg-9 mb50">
                                <div class="breadcrumb_content">
                                    <h2 class="breadcrumb_title">Blog artikelen</h2>
                                    <p>Overzicht van alle blogartikelen</p>
                                </div>
                            </div>
                            <div class="col-lg-3 mb50 float-right">
                            <a class="btn btn-thm advnc_search_form_btn buttonaclass" href="beheer/blog/toevoegen">Nieuwe blog toevoegen <i class="fas fa-arrow-right"></i></a>
                                </div>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class=" p10-520">
                                <div class="row">
                                    <!-- Tab panes -->
                                    <div class="col-lg-12">
                                        <div class="tab-content row" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive my_lisging_table">
                                                        <?php if($result){ ?>
                                                        <table class="table">
                                                            <thead class="table-light">
                                                                <tr class="thead_row">
                                                                    <th class="thead_title pl20" scope="col">Blog</th>
                                                                    <th class="thead_title" scope="col">Status</th>
                                                                    <th class="thead_title" scope="col">Datum</th>
                                                                    <th class="thead_title" scope="col">Actie</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php

                                                                    foreach($result as $blog) {  
                                                                        $inhoud_blog = strlen(strip_tags($blog['blog_inhoud'])) > 100 ? substr(strip_tags($blog['blog_inhoud']),0,100)."..." : strip_tags($blog['blog_inhoud']);  

                                                                        if($blog['blog_status'] == 0){
                                                                            $status = 'Inactief';
                                                                        }else if($blog['blog_status'] == 1){
                                                                            $status = 'Actief';
                                                                        }  

                                                                        $datum = date("d-m-Y", strtotime($blog['blog_datum'])); 
                                                                        echo '<tr>
                                                                        <th class="align-middle pl20" scope="row">
                                                                            <div class="car-listing bdr_none d-flex mb0">
                                                                                <div class="thumb w150">
                                                                                    <img class="img-fluid" src="'.$blog['blog_afbeelding'].'" alt="7.jpg">
                                                                                </div>
                                                                                <div class="details ms-1">
                                                                                    <h6 class="title"><a href="">'.$blog['blog_title'].'</a></h6>
                                                                                    <h5 class="price">'.$inhoud_blog.'</h5>
                                                                                </div>
                                                                            </div>
                                                                        </th>
                                                                        <td class="align-middle">'.$status.'</td>
                                                                        <td class="align-middle">'.$datum.'</td>
                                                                        <td class="editing_list align-middle">
                                                                            <ul>
                                                                                <li class="list-inline-item mb-1">
                                                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Bekijken"><span class="flaticon-view"></span></a>
                                                                                </li>
                                                                                <li class="list-inline-item mb-1">
                                                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Aanpassen"><span class="flaticon-pen"></span></a>
                                                                                </li>
                                                                                <li class="list-inline-item mb-1">
                                                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Verwijderen"><span class="flaticon-trash"></span></a>
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                    </tr>';    
                                                                    }
                                                                
                                                                ?>
                                                                
                                                            </tbody>
                                                        </table>
                                                        <?php }else{
                                                            echo '<h2 class="text-center">Nog geen blog geplaatst</h2>';
                                                        } ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="mbp_pagination mt10">
                                                        <ul class="page_navigation">
                                                            <li class="page-item">
                                                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span class="fa fa-arrow-left"></span></a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item active" aria-current="page">
                                                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#"><span class="fa fa-arrow-right"></span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

<?php include 'includes/footer.php'; ?>