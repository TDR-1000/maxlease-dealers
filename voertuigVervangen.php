<?php

include "backoffice/MAXEngine/MAX.php";

if (app('login')->isLoggedIn()) {
    $currentUser = app('current_user');
} else {
    redirect('login');
}

$db = app('db');

$only_pretty = trim($_GET['url'], "https://maxlease.nl/i/");


$result = $db->select(
    "SELECT * FROM `as_voertuig` WHERE `pretty_url_website` = :id",
    array("id" => $only_pretty)
);

if ($result) {

    $kenteken = $result[0]['voertuig_basisgegevens_kenteken'];
    $merk = $result[0]['voertuig_basisgegevens_merk'];
    $model = $result[0]['voertuig_basisgegevens_model'];
    $advertentie_prijs = $result[0]['voertuig_financieel_verkoopprijs'];
    $km_stand = $result[0]['voertuig_historie_tellerstand_stand'];
    $bouwjaar = $result[0]['voertuig_historie_bouwjaar_datumdeel1'];
    $brandstof = $result[0]['voertuig_basisgegevens_brandstof'];
    $carrosserie = $result[0]['voertuig_carrosseriegegevens_carrosserie'];
    $transmissie = $result[0]['voertuig_techischegegevens_transmissie'];

    $db->update(
        'as_offerte',
        array("voertuig_id" => $result[0]['voertuig_basisgegevens_ID'], "kenteken" => $kenteken, "merk" => $merk, "model" => $model, "advertentie_prijs" => $advertentie_prijs, "km_stand" => $km_stand, "bouwjaar" => $bouwjaar, "brandstof" => $brandstof, "carrosserie" => $carrosserie, "transmissie" => $transmissie),
        "offerte_id = :id",
        array("id" => $_GET['offerte_id'])
    );

    redirect('offerte/' . $_GET['offerte_id']);
}else{
    redirect('offerte/' . $_GET['offerte_id'].'?melding=voertuig-onbekend');
}




