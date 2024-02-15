<?php

$servername = "localhost"; 
$username = "trtkp23_10"; 
$password = "4KHaquUZ"; 
$database = "web_trtk23_10"; 



// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    echo "Connected successfully";
}

//$connection->close();
?>
