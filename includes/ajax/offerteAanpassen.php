<?php

  include dirname(__FILE__) . '/../../backoffice/MAXEngine/MAX.php';

  $db = app('db');

  $db->update(
    'as_offerte',
    array ("bedrijfsnaam" => $_POST['bedrijfsnaam'],
    "kvknr" => $_POST['kvknummer'],
    "aanhef" => $_POST['aanhef'],
    "voorletters" => $_POST['voornaam'],
    "tussenvoegsel" => $_POST['tussenvoegsel'],
    "achternaam" => $_POST['achternaam'],
    "gebdatum" => $_POST['geboortedatum'],
    "postcode" => $_POST['postcode'],
    "huisnummer" => $_POST['huisnummer'],
    "toevoeging" => $_POST['toevoeging'],
    "straatnaam" => $_POST['straatnaam'],
    "plaatsnaam" => $_POST['plaatsnaam'],
    "email" => $_POST['email'],
    "telefoonnummer" => $_POST['telefoonnummer'],
    "aankoopsom" => $_POST['Leasebedrag'],
    "aanbetaling" => $_POST['aanbetaling'],
    "looptijd_maanden" => $_POST['looptijd'],
    "slottermijn" => $_POST['slottermijn'],
    "maandbedrag" => $_POST['maandbedrag'],
    "kenteken" => $_POST['kenteken'],
    "MargeBTW" => $_POST['typebtw'],
    "merk" => $_POST['autonaam'],
    "model" => $_POST['modeluitvoering'],
    "advertentie_prijs" => $_POST['prijs'],
    "bouwmaand" => $_POST['bouwmaand'],
    "km_stand" => $_POST['kmstand'],
    "bouwjaar" => $_POST['bouwjaar'],
    "brandstof" => $_POST['brandstoffen'],
    "carrosserie" => $_POST['carrosserie'],
    "edited" => 1,
    "transmissie" => $_POST['transmissies']),
    "offerte_id = :offerteid",
    array("offerteid" => $_POST['offerte_id'])
);

redirect('offerte/'.$_GET['offerte_id']);