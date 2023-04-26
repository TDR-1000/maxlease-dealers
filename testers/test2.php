<?php

$array = 'a:3:{s:4:"Teun";s:4:"Homo";s:5:"Georg";s:9:"Geen Homo";s:4:"Bron";s:8:"You know";}';

$serialized = unserialize($array);

echo json_encode($serialized);

?>