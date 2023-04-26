<?php

include dirname(__FILE__) . '/../MAX.php';

$db = app('db');

$xml=simplexml_load_file("https://www.klantenvertellen.nl/v1/review/feed.xml?hash=mdjzbjlshgj0fqx") or die("Error: Cannot create object");

$averageRating = str_replace('.', ',', $xml->averageRating);
$numberReviews = $xml->numberReviews;

$db->update(
    'as_settings',
    array ("setting_value" => $averageRating),
    "settings_id = :id",
    array("id" => 3)
);

$db->update(
    'as_settings',
    array ("setting_value" => $numberReviews),
    "settings_id = :id",
    array("id" => 4)
);
?>