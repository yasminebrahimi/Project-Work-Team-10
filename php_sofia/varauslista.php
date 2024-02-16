
<?php
mysqli_report(MYSQLI_REPORT_ERROR ^ MYSQLI_REPORT_STRICT);
try {
    $yhteys = mysqli_connect("localhost","trtkp23_10","4KHaquUZ","web_trtkp23_10");
} catch (Exception $e) {
    header("Location:../html/yhteysvirhe.html");
    exit;
}

print "<a href='/Projekti/varauslomake.php'>Lomake</a>";

$tulos=mysqli_query($yhteys, "select * from sofia23008_VarausVierailija");
while ($rivi=mysqli_fetch_object($tulos)){
    print "<p>$rivi->etunimi $rivi->sukunimi".
    "<a href='./poistavaraus.php?poistettava=$rivi->id'>Poista</a></p>";
}
mysqli_close($yhteys);





?>