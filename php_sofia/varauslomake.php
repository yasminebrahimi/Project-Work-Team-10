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
    <link rel="stylesheet" href="/style/ryhmaliikunta_Sofia_Rots.css">
</head>
<header>
        <ul>
            <li><a href="/components/jasenyys_Sonja_Lahti.html" target="_self">Membership</a></li>
            <li><a href="/components/blogYasmin.html" target="_self">Blog</a></li>
            <li><a href="/components/ryhmaliikunta_Sofia_Rots.html" target="_self">Group Exercise </a></li>
            
            
            <li><a href="/components/index.html#lct" target="_self"> Location</a></li>
            <li><a href="/components/index.html#info" target="_self"> Contact Information</a></li>
            
        </ul>    
            <div class="dropdown">
                <button class="dropbtn">Hinnasto</button>
                <div class="dropdown-content">
                  <a href="/components/jasenyys_Sonja_Lahti.html#Memberprice">Membership</a>
                  <a href="/components/ryhmaliikunta_Sofia_Rots.html#tbl">Group Exercise</a>
                  <a href="/components/ryhmaliikunta_Sofia_Rots.html#tbl">Gym</a>
                </div>
            </div>
        
</header>
<body>
    <div>
        <h2>Täytä varaajan tiedot</h2>
        <form class="form-horizontal" action="./varauslomake.php" method="post">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" value=""><br>

            <label for="sname">Second Name:</label>
            <input type="text" name="sname" value=""><br>

            <label for="email">Email:</label>
            <input type="text" name="email" value=""><br>

            <label for="phn">Phone Number:</label>
            <input type="text" name="phn" value=""><br>

            <input type="submit" name="next_page" value="Jatka valitsemaan tuntia">
        </form>
    </div>
    <footer class="main-footer">
        <div class="container footer">
            <div class="textFooter">
                <h4 class="fotsikko4">Discover x Gym</h4>
                <p> Transform yourself with our top-notch facilities, 
                    expert trainers, and diverse classes. Join us in the
                     pursuit of wellness – your goals, our commitment.</p>
                     <p class="cta">Ready to start your fitness journey? <a href="">Join Now!</a></p>
            </div>
       
          <div class="getInTouch">
            <h4>Get in Touch</h4>
            <a class="hyperLinks" href="">123 Fittness Street, Cityville</a>
            <a class="hyperLinks" href="">+358 567 4786</a>
            <a class="hyperLinks" href="mailto:info@example.com">info@example.com</a>
            <div class="social-icons">
            <a href="https://facebook.com/examplegym" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://twitter.com/examplegym" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://instagram.com/examplegym" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

            <div class="links">
                <h4>Links</h4>
                <a class="hyperLinks" href="#">FAQ</a>
                <a class="hyperLinks" href="#">Team & conditions</a>
                <a class="hyperLinks" href="#">Reporting</a>
                <a class="hyperLinks" href="#">Privacy</a>
            </div>
           
          </div>
         
      </footer>
</body>
</html>
