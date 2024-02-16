<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: ../components/index.html');
	exit;
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try{
    $yhteys=mysqli_connect("localhost", "trtkp23_10", "4KHaquUZ", "web_trtkp23_10");
}
catch(Exception $e){
    header("Location:../components/virhe.html");
    exit;
}
// tietoja ei ole 'tallennettu sessionsiin vaan ne haetaan databasesta
$stmt = $yhteys->prepare('SELECT id, salasana FROM sonja23015_asiakasrekisteri WHERE email = ?');

$stmt->bind_param('s', $_SESSION['email']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../style/jasenyys_sonja_lahti.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
<style>
	.prfh2{

		background-color: orangered;
		text-align: center;
		margin: 10px;
		padding: 30px;

		}
		.kotyl{
            background-color: #FF6c22;
            padding: 20px;
        }

</style>

    <header>
        <ul>
            <li><a href="../components/jasenyys_Sonja_Lahti.html" target="_self">Membership</a></li>
            <li><a href="../components/blogYasmin.html" target="_self">Blog</a></li>
            <li><a href="../components/ryhmaliikunta_Sofia_Rots.html" target="_self">Group Exercise </a></li>
            
            <!--Hyperlinkit pääsivuun ja footerin-->
            <li><a href="../components/index.html#lct" target="_self"> Location</a></li>
            <li><a href="../components/index.html#info" target="_self"> Contact Information</a></li>
            <!--aukeaa palkki, jossa on jäsenyys, kuntosali, ryhmäliikunta<-->
        </ul>    
            <div class="dropdown">
                <button class="dropbtn">Hinnasto</button>
                <div class="dropdown-content">
                  <a href="#">Membership</a>
                  <a href="../components/ryhmaliikunta_Sofia_Rots.html#tbl">Group Exercise</a>
                  <a href="../components/ryhmaliikunta_Sofia_Rots.html#tbl">Gym</a>
                </div>
            </div>
        
</header>
<section>
			<div class="kotyl">
				<a href="../php_sonja/kotisivu.php" class="p-a"><i></i>Main</a>
				<a href="../php_sonja/kirjaudu_ulos.php" class="p-a"><i></i>Logout</a>
			</div>
		</section>

  <!-- Sonja-->
   

       
	<h2 class="prfh2">Hello  <?=$_SESSION['etunimi']?>!</h2>






<footer class="main-footer">
    <div class="container footer">
        <div class="textFooter">
            <h4>Discover x Gym</h4>
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
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>