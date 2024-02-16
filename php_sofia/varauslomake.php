<?php
session_start();
if (isset($_SESSION['userName'])) {
    echo "Your session is running " . $_SESSION['userName'];
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //?
    $fname = isset($_POST["fname"]) ? $_POST["fname"] : "";
    $sname = isset($_POST["sname"]) ? $_POST["sname"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $phn = isset($_POST["phn"]) ? $_POST["phn"] : "";

    //?
    $errors = [];

    //tarkistaa onko kohdat tyhjät
    if(empty($fname) || empty($sname) || empty($email) || empty($phn)){
        $errors[] = "All fields are required!";
    }
    //strlen?
    if (strlen($fname) <= 3) {
        $errors[] = "First name must have more than 3 characters";
    }
    if(strlen($sname) <= 3) {
        $errors[] = "Second name must have more than 3 characters";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address";
    }
    if (strlen($phn) <10){
        $errors[] = "Phone number must be 10 digits long";
    }
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
    } else {
        // If validation passes, store data in session and redirect to the next page
        $_SESSION['fname'] = $fname;
        $_SESSION['sname'] = $sname;
        $_SESSION['email'] = $email;
        $_SESSION['phn'] = $phn;

        header("Location: ./selectexercise.php");
        exit;
    }
    // $_SESSION['fname'] = isset($_POST["fname"]) ? $_POST["fname"] : "";
    // $_SESSION['sname'] = isset($_POST["sname"]) ? $_POST["sname"] : "";
    // $_SESSION['email'] = isset($_POST["email"]) ? $_POST["email"] : "";
    // $_SESSION['phn'] = isset($_POST["phn"]) ? $_POST["phn"] : "";

    // Redirect to the next page
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>varauslomake</title>
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
<div class="container">
    <h2>Fill in the information of the booker</h2>
    <form class="row g-3" action="./varauslomake.php" method="post">

        <div class="col-md-6 mb-3">
            <label for="fname" class="form-label">First Name:</label>
            <input type="text" class="form-control" name="fname" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="sname" class="form-label">Second Name:</label>
            <input type="text" class="form-control" name="sname" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="phn" class="form-label">Phone Number:</label>
            <input type="tel" class="form-control" name="phn" required>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary" name="next_page">Jatka valitsemaan tuntia</button>
        </div>
    </form>
</div>


   
</html>
