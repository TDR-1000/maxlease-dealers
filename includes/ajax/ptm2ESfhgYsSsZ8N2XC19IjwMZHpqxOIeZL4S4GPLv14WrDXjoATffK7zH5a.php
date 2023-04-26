<?php

  include dirname(__FILE__) . '/../../backoffice/MAXEngine/MAX.php';

  $db = app('db');

  // Ontvang de JSON-gegevens van de notificatie
  $json_data = file_get_contents('php://input');

  // Decodeer de JSON-gegevens naar een PHP-array
  $data = json_decode($json_data, true);

  // Haal de relevante gegevens uit de JSON-data
  $call_id = $data["call_id"];
  $timestamp = $data["timestamp"];
  $status = $data["status"];
  $direction = $data["direction"];
  $caller_number = $data["caller"]["number"];
  $caller_name = $data["caller"]["name"];
  $destination_number = $data["destination"]["number"];

  $redirector_account_number = $data["destination"]["target"]["account_number"];
  $redirector_number = $data["destination"]["target"]["number"];
  $redirector_user_number = $data["destination"]["target"]["user_numbers"][0];
  $redirector_name = $data["destination"]["target"]["name"];

  // Voeg de gegevens toe aan de database
  $db->insert('as_voip_gesprekken', array(
    "call_voip_id" => $call_id,
    "status"  => $status,
    "direction"  => $direction,
    "caller_number" => $caller_number,
    "caller_name" => $caller_name,
    "destination_number" => $destination_number,
    "redirector_account_number"  => $redirector_account_number,
    "redirector_number"  => $redirector_number,
    "redirector_user_number" => $redirector_user_number,
    "redirector_name" => $redirector_name,
  ));

  if ($status == 'in-progress' || $status == 'ended') {

    $db->update(
      'as_voip_gesprekken',
      array("notify_completed" => 1),
      "call_voip_id = :id",
      array("id" => $call_id)
    );
  }
