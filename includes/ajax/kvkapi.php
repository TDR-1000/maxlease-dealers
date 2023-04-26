<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.kvk.nl/api/v1/zoeken?handelsnaam='.$_POST['query'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/hal+json',
    'apikey: l7b5c52c4f64b24af39ea6c72397f71c4f'
  ),
));

$response = curl_exec($curl);

$array = json_decode($response, true);

$output = '<ul class="list-unstyled">';  
$i = 0;


  for ($x = 0; $x <= ($array['totaal']-1); $x++) {
    $output .= '<li>'.$array['resultaten'][$x]['handelsnaam'].'<br>'.$array['resultaten'][$x]['kvkNummer'].'</li>';
  }

  $output .= '</ul>'; 
  echo $output; 