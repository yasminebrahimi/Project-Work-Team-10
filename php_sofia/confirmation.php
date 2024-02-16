<?php
session_start();

if (!isset($_SESSION['fname']) || !isset($_SESSION['sname']) || !isset($_SESSION['email']) || !isset($_SESSION['phn'])) {
    header("Location: ./varauslomake.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ERROR ^ MYSQLI_REPORT_STRICT);
try {
    $yhteys = mysqli_connect("localhost", "trtkp23_10", "4KHaquUZ", "web_trtkp23_10");
} catch (Exception $e) {
    header("Location:../html/yhteysvirhe.html");
    exit;
}

// Hae varaustiedot tietokannasta
$sql = "SELECT v.*, r.tunti as class_name, r.pvm, r.alkuaika, r.loppuaika
        FROM sofia23008_VarausVierailija v
        JOIN sofia23008_ryhmaliikuntatunnit r ON v.tunninID = r.id
        WHERE v.sahkoposti = '{$_SESSION['email']}'";

$reservationDetails = mysqli_query($yhteys, $sql);

// ??
$reservation = mysqli_fetch_assoc($reservationDetails);


mysqli_close($yhteys);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">   
</head>
<style>
    body{
        background-color: #2b3499;
    }
    div{
        color: #f1f1f1;
        padding: 11px;
        margin: 10px;
       text-align: center;
    }
</style>
<body>
    <h2>Reservation Details</h2>
    <div class="details">
    <?php
    // Display reservation details
    if ($reservation) {
        echo "<p>Name: {$_SESSION['fname']} {$_SESSION['sname']}</p>";
        echo "<p>Email: {$_SESSION['email']}</p>";
        echo "<p>Phone: {$_SESSION['phn']}</p>";
        echo "<p>Class Name: {$reservation['class_name']}</p>";
        echo "<p>Date: {$reservation['pvm']}</p>";
        echo "<p>Time: {$reservation['alkuaika']} to {$reservation['loppuaika']}</p>";

        // Add more details as needed
    } else {
        echo "<p>No reservation details found.</p>";
    } 
    ?>
    </div>
   
</body>
</html>
