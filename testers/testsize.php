<?php 

$url = "https://media-maxlease.export.doorlinkenvoorraad.nl/11265360192/image1.jpg";

$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_HEADER, true); 
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    $head = curl_exec($ch);

    echo $size = curl_getinfo($ch,CURLINFO_CONTENT_LENGTH_DOWNLOAD);

?>