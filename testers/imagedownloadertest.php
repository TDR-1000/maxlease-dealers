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

$sql = "SELECT * FROM as_voertuig_media WHERE avai='0' AND media_first_photo = 1 LIMIT 50";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        if (@getimagesize($row['media_original_url'])) {
           echo $row['voertuig_media_id'];
           echo 'Beschikbaar<br>';
           $sql = "UPDATE as_voertuig_media SET img_available='1', avai='1' WHERE voertuig_media_id=".$row['voertuig_media_id'];

          if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
          } else {
            echo "Error updating record: " . $conn->error;
          }
          } else {
            echo $row['voertuig_media_id'];
            echo 'Geupdate<br>';
            $sql = "UPDATE as_voertuig_media SET img_available='0', avai='1' WHERE voertuig_media_id=".$row['voertuig_media_id'];

          if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
          } else {
            echo "Error updating record: " . $conn->error;
          }
          }

          
    }
} else {
 
}
$conn->close();
