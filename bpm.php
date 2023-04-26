<?php
$waarde = '32000';
$kenteken = 'G138LF';
$bpm = '8454';

  $url = "https://opendata.rdw.nl/resource/5xwu-cdq3.json?kenteken=".$kenteken;
  $api_key = "jouw_api_key"; // vul hier jouw API key in
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Ocp-Apim-Subscription-Key: $api_key"));
  $response = curl_exec($ch);
  curl_close($ch);
  $data = json_decode($response, true);
  
  // bereken de rest BPM
  echo $brutoBPM = $data[0]['bruto_bpm'];

// haal de waarden uit het formulier

//$totaal = number_format($totaal,2,",",".");

// toon de rest BPM aan de gebruiker
//echo " €$totaal";
?>
