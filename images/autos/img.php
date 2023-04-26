<?php
// Set the content type header to image/png
header('Content-type: image/png');

// Create a new image with a width of 1200 pixels and a height of 630 pixels
$image = imagecreatetruecolor(1200, 630);

// Load the background image
$background = imagecreatefrompng('background-osg.png');

// Copy the background image onto the new image
imagecopy($image, $background, 0, 0, 0, 0, imagesx($background), imagesy($background));

// Load the PNG image file
$logo = imagecreatefromjpeg('https://media-maxlease.export.doorlinkenvoorraad.nl/10358553053/image1.jpg');

// Resize the PNG image to a width of 400 pixels and a height of 420 pixels
$logo_resized = imagescale($logo, 400, 420);

// Copy the resized PNG image onto the new image at position (20, 100) with a width of 400 pixels and a height of 420 pixels
imagecopyresized($image, $logo_resized, 90, 250, 0, 0, 405, 310, imagesx($logo_resized), imagesy($logo_resized));

// Set the font and color for the text
$font = 'myrad.ttf';
$color = imagecolorallocate($image, 255, 255, 255);

$text = 'Volkswagen Golf';
imagettftext($image, 30, 0, 580, 270, $color, $font, $text);

$text = 'TCe 90 Zen | Apple Carplay | Stoelverwarming | Airco';
imagettftext($image, 12, 0, 580, 300, $color, $font, $text);

// Write the text on the right side of the new image
$text = '134.853 km';
imagettftext($image, 20, 0, 580, 370, $color, $font, $text);

$text = 'Handgeschakeld';
imagettftext($image, 20, 0, 580, 420, $color, $font, $text);

$text = '91 pk (67 kW)';
imagettftext($image, 20, 0, 580, 470, $color, $font, $text);


$text = 'Benzine';
imagettftext($image, 20, 0, 880, 370, $color, $font, $text);

$text = '2022';
imagettftext($image, 20, 0, 880, 420, $color, $font, $text);

$text = '€ 19.900';
imagettftext($image, 20, 0, 880, 470, $color, $font, $text);

// Output the image as a PNG file
imagepng($image);

// Destroy the image to free up memory
imagedestroy($image);
?>
