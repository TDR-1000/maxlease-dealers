
<?php 
include dirname(__FILE__) . '/../../backoffice/MAXEngine/MAX.php';

$db = app('db');

$refkey = str_random();

$voertuig_id = $_POST['voertuig_id'] ?? '0';
$bedrijfsnaam = $_POST['organisation_name'] ?? 'null';
$kvknr = $_POST['kvknummer'] ?? 'null';
$aanhef = $_POST['sex'] ?? 'null';
$voorletters = $_POST['firstname'] ?? 'null';
$tussenvoegsel = $_POST['insertion'] ?? 'null';
$achternaam = $_POST['lastname'] ?? 'null';
$postcode = $_POST['postalcode'] ?? 'null';
$huisnummer = $_POST['housenumber'] ?? 'null';
$toevoeging = $_POST['houseaddition'] ?? 'null';
$straatnaam = $_POST['straatnaam'] ?? 'null';
$plaatsnaam = $_POST['plaatsnaam'] ?? 'null';
$email = $_POST['email'] ?? 'null';
$telefoonnummer = $_POST['phone'] ?? 'null';
$aankoopsom = $_POST['aankoopsom'] ?? 'null';
$aanbetaling = $_POST['aanbetaling'] ?? 'null';
$looptijd_maanden = $_POST['looptijd_maand'] ?? 'null';
$slottermijn = $_POST['slottermijn'] ?? 'null';
$kenteken = $_POST['kenteken'] ?? 'null';
$merk = $_POST['merk'] ?? 'null';
$model = $_POST['model'] ?? 'null';
$link = $_POST['link'] ?? 'null';

$db->insert('as_offerte', array(
    "voertuig_id" => $voertuig_id,
    "refkey" => $refkey,
    "bedrijfsnaam" => $bedrijfsnaam,
    "kvknr"  => $kvknr,
    "aanhef"  => $aanhef,
    "voorletters" => $voorletters,
    "tussenvoegsel"  => $tussenvoegsel,
    "achternaam"  => $achternaam,
    "postcode" => $postcode,
    "huisnummer"  => $huisnummer,
    "straatnaam"  => $straatnaam,
    "plaatsnaam" => $plaatsnaam,
    "email"  => $email,
    "telefoonnummer"  => $telefoonnummer,
    "aankoopsom" => $aankoopsom,
    "aanbetaling"  => $aanbetaling,
    "looptijd_maanden"  => $looptijd_maanden,
    "slottermijn" => $slottermijn,
    "kenteken"  => $kenteken,
    "merk"  => $merk,
    "model" => $model,
    "link"  => $link
));

redirect('afgerond/'.$refkey);
?>