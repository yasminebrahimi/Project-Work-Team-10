<?php
$servername = "db";
$username = "root";
$password = "password";
$database = "blog";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    echo "Connected successfully";
}

if (isset($_GET["poistettava"])) {
    $poistettava = $_GET["poistettava"];
    $sql = "DELETE FROM comments WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $poistettava);
    $stmt->execute();
    $stmt->close();
}

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
            <th>Action</th>
        </tr>
    </thead>
    <tbody>";

    while ($rivi = mysqli_fetch_assoc($tulos)) {
        echo "<tr>
            <td>{$rivi['id']}</td>
            <td>{$rivi['Name']}</td>
            <td>{$rivi['Email']}</td>
            <td>{$rivi['Comment']}</td>
            <td><a href='delete.php?poistettava={$rivi['id']}'>Delete</a></td>
        </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "No results";
}

mysqli_close($connection);
?>
