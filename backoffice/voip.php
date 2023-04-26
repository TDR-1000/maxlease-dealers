<?php
// Ontvang de JSON-gegevens van de notificatie
$json_data = file_get_contents('php://input');

// Decodeer de JSON-gegevens naar een PHP-array
$data = json_decode($json_data, true);

// Verbind met de database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer op fouten bij het verbinden met de database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Haal de relevante gegevens uit de JSON-data
$call_id = $data["call_id"];
$timestamp = $data["timestamp"];
$status = $data["status"];
$direction = $data["direction"];
$caller_number = $data["caller"]["number"];
$caller_name = $data["caller"]["name"];
$destination_number = $data["destination"]["number"];

// Voeg de gegevens toe aan de database
$sql = "INSERT INTO gesprekken (call_id, timestamp, status, direction, caller_number, caller_name, destination_number) VALUES ('$call_id', '$timestamp', '$status', '$direction', '$caller_number', '$caller_name', '$destination_number')";

if ($conn->query($sql) === TRUE) {
    echo "Gespreksgegevens opgeslagen in de database";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Sluit de databaseverbinding
$conn->close();
?>