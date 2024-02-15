<?php

if (isset($_POST["Name"])) {
    $Name = $_POST["Name"];
} else {
    header("Location: ./article.html");
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



require_once('db_connect.php');


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
<a href="./article.html">
<input type ="button" value="Go back">
</a>