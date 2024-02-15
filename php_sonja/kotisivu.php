<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location:../components/index.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link rel="stylesheet" href="../css/jasenyys_sonja_lahti.css" >
		
	</head>
    <style>
       
        .kotyl{
            background-color: #FF6c22;
            padding: 20px;
        }


    </style>
<!--^^ Sonja ^^ -->

<header>
        <ul>
            <li><a href="../components/jasenyys.html" target="_self">Membership</a></li>
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
<!--vv Sonja vv -->
	<body class="loggedin">
		<section class="profkirj">
			<div class="kotyl">
				<a href="../php2/profiili.php" class="p-a"><i></i>Profile</a>
				<a href="../php2/kirjaudu_ulos.php" class="p-a"><i></i>Logout</a>
			</div>
		</section>
		<div class="prof-content">
			<h2 class="h2-sonja">Home Page</h2>
			<p>Welcome back, <?=$_SESSION['etunimi']?>!</p>
		</div>

<!--^^ Sonja ^^ -->


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



	</body>
</html>