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

$result = mysqli_query($yhteys, "SELECT * FROM sofia23008_ryhmaliikuntatunnit");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedClass = isset($_POST["selected_class"]) ? $_POST["selected_class"] : "";

    // Insert data into the 'VarausVierailija' table
    $sql = "INSERT INTO sofia23008_VarausVierailija (etunimi, sukunimi, sahkoposti, puh, tunninID) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, "sssii", $_SESSION['fname'], $_SESSION['sname'], $_SESSION['email'], $_SESSION['phn'], $selectedClass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect to confirmation page after insertion
    header("Location: confirmation.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select</title>
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

    <h2>Select a Class</h2>
    <form action="./selectexercise.php" method="post">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<input type='radio' name='selected_class' value='{$row['id']}'> {$row['tunti']} - {$row['alkuaika']} to {$row['loppuaika']} on {$row['pvm']}<br>";
        }
        ?>
        <input type="submit" value="Submit Reservation">
    </form>
</body>
</html>
