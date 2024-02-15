<?php

include ('db_connect.php');


// Fetch and display comments
$tulos = mysqli_query($connection, "SELECT * FROM comments");

if (mysqli_num_rows($tulos) > 0) { 
    // Output data of each row
    echo "<table class='table' border=1>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>comment</th>
            <th>id</th>
        </tr>
    </thead>
    <tbody>";
 
    while ($rivi = mysqli_fetch_assoc($tulos)) {

    echo "<tr>
    <td>{$rivi['id']}</td>
    <td>{$rivi['Name']}</td>
    <td>{$rivi['Email']}</td>
    <td>{$rivi['Comment']}</td>

    </tr>";
    }

    } else {
    echo "No results";
    }

    echo "</table>";

mysqli_close($connection);
?>
