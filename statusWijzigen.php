<?php

include "backoffice/MAXEngine/MAX.php";

if (app('login')->isLoggedIn()) {
    $currentUser = app('current_user');
  } else {
    redirect('login');
  }

  $db = app('db');
  
  $db->update(
    'as_offerte',
    array ("status" => $_GET['status']),
    "offerte_id = :id",
    array("id" => $_GET['offerte_id'])
);


redirect('offerte/'.$_GET['offerte_id']);
