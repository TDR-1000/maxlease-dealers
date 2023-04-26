<?php
//header('Content-Type: application/json; charset=utf-8');
$curl = curl_init();

if(isset($_GET['kenteken'])){
  $kentekenpost =  $_GET['kenteken'];
}else if(isset($_POST['kenteken'])){
  $kentekenpost =  $_POST['kenteken'];
}else{
  $kentekenpost =  $_POST['kenteken'];
}


$kenteken = str_replace("-","",strtoupper($kentekenpost));
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken='.$kenteken,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
$array = json_decode($response);

echo json_encode($array[0], JSON_UNESCAPED_SLASHES);