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
<body>
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
    <h2>Select a Class</h2>
    <form action="./selectexercise.php" method="post">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<input type='radio' name='selected_class' value='{$row['id']}'> {$row['tunti']} - {$row['alkuaika']} to {$row['loppuaika']} on {$row['pvm']}<br>";
        }
        ?>
        <input type="submit" value="Submit Reservation">
    </form>
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
