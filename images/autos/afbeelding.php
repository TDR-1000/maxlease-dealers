<?php

include dirname(__FILE__) . '/../../backoffice/MAXEngine/MAX.php';

$db = app('db');

$check = str_replace(".png", "",$_GET['id']);


$voertuig = $db->select(
    "SELECT * FROM `as_voertuig`,`as_voertuig_media` WHERE `as_voertuig`.`pretty_url_website` = :getdata AND `as_voertuig_media`.`media_first_photo` = 1 AND `as_voertuig`.`voertuig_basisgegevens_ID` = `as_voertuig_media`.`voertuig_id` LIMIT 1",
    array ("getdata" => $check)
);

if(!$voertuig){
    die();
}

header('Content-type: image/png');

// Create a new image with a width of 1200 pixels and a height of 630 pixels
$image = imagecreatetruecolor(1200, 630);

// Load the background image
$background = imagecreatefrompng('background-osg.png');

// Copy the background image onto the new image
imagecopy($image, $background, 0, 0, 0, 0, imagesx($background), imagesy($background));

// Load the PNG image file
$logo = imagecreatefromjpeg($voertuig[0]['media_original_url']);

// Resize the PNG image to a width of 400 pixels and a height of 420 pixels
$logo_resized = imagescale($logo, 400, 420);

// Copy the resized PNG image onto the new image at position (20, 100) with a width of 400 pixels and a height of 420 pixels
imagecopyresized($image, $logo_resized, 90, 250, 0, 0, 405, 310, imagesx($logo_resized), imagesy($logo_resized));

// Set the font and color for the text
$font = 'myrad.ttf';
$color = imagecolorallocate($image, 255, 255, 255);

$text = $voertuig[0]['voertuig_basisgegevens_merk'].' '.$voertuig[0]['voertuig_basisgegevens_model'];
imagettftext($image, 40, 0, 580, 270, $color, $font, $text);

$voertuig_type = strlen($voertuig[0]['voertuig_basisgegevens_type']) > 40 ? substr($voertuig[0]['voertuig_basisgegevens_type'], 0, 40) . "..." : $voertuig[0]['voertuig_basisgegevens_type'];
imagettftext($image, 20, 0, 580, 310, $color, $font, $voertuig_type);

// Write the text on the right side of the new image
$text = number_format($voertuig[0]['voertuig_historie_tellerstand_stand'], 0, ",", ".").' km';
imagettftext($image, 27, 0, 580, 390, $color, $font, $text);

$transmissie =  transmissieCheck($voertuig[0]['voertuig_techischegegevens_transmissie']);
imagettftext($image, 27, 0, 580, 450, $color, $font, $transmissie);

$text = $voertuig[0]['voertuig_techischegegevens_vermogenmotor_PK'] . ' pk (' . $voertuig[0]['voertuig_techischegegevens_vermogenmotor_KW'] . ' kW)';
imagettftext($image, 27, 0, 580, 510, $color, $font, $text);

$brandstof = brandstofCheck($voertuig[0]['voertuig_basisgegevens_brandstof']);
imagettftext($image, 27, 0, 930, 390, $color, $font, $brandstof);

$text = $voertuig[0]['voertuig_historie_bouwjaar_jaar'];
imagettftext($image, 27, 0, 930, 450, $color, $font, $text);


if ($voertuig[0]['voertuig_financieel_verkoopprijs'] == null || !isset($voertuig[0]['voertuig_financieel_verkoopprijs'])) {
    $prijs = 'Onbekend';
  } else {
    $prijs = number_format($voertuig[0]['voertuig_financieel_verkoopprijs'], 0, ",", ".");
  }
$text = '€ '.$prijs.',-';
imagettftext($image, 27, 0, 930, 510, $color, $font, $text);

// Output the image as a PNG file
imagepng($image);

// Destroy the image to free up memory
imagedestroy($image);
?>
