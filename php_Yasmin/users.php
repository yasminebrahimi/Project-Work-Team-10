<?php

if (isset($_POST["Name"])) {
    $Name = $_POST["Name"];
} else {
    header("Location: article.html");
    exit;
}

if (isset($_POST["Email"])) {
    $Email = $_POST["Email"];
} else {
    $Email = "";
}

if (isset($_POST["Comment"])) {
    $Comment = $_POST["Comment"];
} else {
    $Comment = "";
}


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
    $yhteys=mysqli_connect("localhost", "trtkp23_10", "4KHaquUZ", "web_trtkp23_10");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}




$sql = "INSERT INTO comments (Name, Email, Comment) VALUES ('$Name','$Email','$Comment')"; 
$stmt = mysqli_query($connection, $sql);

    if ($connection->query($sql) === TRUE)
    {
        echo "<h2>You have insert the new comment</h2>";

    }
    else
    {
        echo $sql.$connection->error;
    }

?>
<a href="">
<input type ="button" value="Go back">
</a>