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
	    // Could not get the data that should have been sent.
	    exit('Please fill both the email and password fields!');
    }

    if(!isset($_POST['salasana'])){
        exit('Täytä salasana');
    }

    if ($stmt = $yhteys->prepare('SELECT id, salasana, etunimi FROM sonja23015_asiakasrekisteri WHERE email = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            $etunimi='etunimi';
            $stmt->bind_result($id, $password, $etunimi);
            $stmt->fetch();

            if (password_verify($_POST['salasana'], $password)) {
                // Verification success! User has logged-in!
                // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['id'] = $id;
    
                
                header('Location: ../php_sonja/kotisivu.php');
                if(isset($etunimi)){
                    $_SESSION['etunimi']= $etunimi;
                    echo 'Welcome ' . $_SESSION['etunimi'] . '!';
                }


            } else {
                // Incorrect password
                echo 'Incorrect email and/or password!';
            }
        } else {
            // Incorrect email
            echo 'Incorrect email and/or password!';
        }
    
        $stmt->close();
    } 
?>