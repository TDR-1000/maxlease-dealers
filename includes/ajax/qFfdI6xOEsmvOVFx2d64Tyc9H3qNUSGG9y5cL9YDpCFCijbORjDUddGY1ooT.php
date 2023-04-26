<?php
  include dirname(__FILE__) . '/../../backoffice/MAXEngine/MAX.php';

  $db = app('db');

  $result = $db->select(
    "SELECT * FROM `as_voip_gesprekken` WHERE `notify_completed` = :id",
    array("id" => 0)
  );

  if ($result) {

    $offerteResult = $db->select(
      "SELECT * FROM `as_offerte` WHERE `telefoonnummer` = :id",
      array("id" => $result[0]['caller_number'])
    );

    if ($offerteResult) {
      $response = array(
        "new_data" => 'bellen',
        "name" => $offerteResult[0]['bedrijfsnaam'],
        "phone" => $result[0]['caller_number'],
        "offerteid" => $offerteResult[0]['offerte_id'],
      );
      echo json_encode($response);
    } else {
      $response = array(
        "new_data" => 'bellen',
        "name" => 'Onbekend',
        "phone" => $result[0]['caller_number'],
        "offerteid" => 'onbekend',
      );
      echo json_encode($response);
    }
  } else {
    $response = array(
      "new_data" => 'false',
      "name" => 'Onbekend',
      "phone" => 'Onbekend',
      "offerteid" => 'Onbekend',
    );
    echo json_encode($response);
  }
