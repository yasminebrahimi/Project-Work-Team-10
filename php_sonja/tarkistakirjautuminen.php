<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try{
    $yhteys=mysqli_connect("localhost", "trtkp23_10", "4KHaquUZ", "web_trtkp23_10");
}
catch(Exception $e){
    header("Location:../components/virhe_sonja.html");
    exit;
}


    if ( !isset($_POST['email'], $_POST['salasana']) ) {
	    
	    exit('Please fill both the email and password fields!');
    }

    if(!isset($_POST['salasana'])){
        exit('You have to add password');
    }

    if ($stmt = $yhteys->prepare('SELECT id, salasana, etunimi FROM sonja23015_asiakasrekisteri WHERE email = ?')) {
        // Bind parameters
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        // Tallentaa löysetyt tiedot, että voidaan tarkastaa onko kyseisellä sähköpostilla jo tili olemassa.
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            $etunimi='etunimi';
            $stmt->bind_result($id, $password, $etunimi);
            $stmt->fetch();

            if (password_verify($_POST['salasana'], $password)) {
                
                // luo session, joka kertoo käyttäjän kirjautuneen
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['id'] = $id;
                //kotisivu.php ja profiili.php
                
                header('Location: ../php_sonja/kotisivu.php');
                
                    $_SESSION['etunimi']= $etunimi;
                
            
            } else {
                // väärä salasana
                echo 'Incorrect password!';
            }
        } else {
            // väärä email
            echo 'Incorrect email!';
        }
    
        $stmt->close();
    } 
?>