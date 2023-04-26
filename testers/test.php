<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "max";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM as_voertuig_media WHERE media_first_photo = 1 AND checked = 0 LIMIT 100";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        
        $filename = str_replace("https://media-maxlease.export.doorlinkenvoorraad.nl/","", $row['media_original_url']);
        $str_arr = explode ("/", $filename); 
            if (!file_exists('css/images/autos/'.$str_arr[0])) {
                mkdir('css/images/autos/'.$str_arr[0], 0777, true);
            }
        $url = $row['media_original_url'];
        $img = 'css/images/autos/'.$filename;
        file_put_contents($img, file_get_contents($url));


        $sql = "UPDATE as_voertuig_media SET checked='1',media_image_url='".$img."' WHERE voertuig_media_id=".$row['voertuig_media_id'];

        if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        }

    }
} else {
 
}
$conn->close();
