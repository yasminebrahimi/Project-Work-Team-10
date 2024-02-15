<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try{
    $yhteys=mysqli_connect("localhost", "trtkp23_10", "4KHaquUZ", "web_trtkp23_10");
}
catch(Exception $e){
    header("Location:../html2/virhe_sonja.html");
    exit;
}


if (!isset($_POST['etunimi'],$_POST['sukunimi'], $_POST['email'], $_POST['osoite'],
     $_POST['postinro'], $_POST['postitmp'], $_POST['puhelinnro'], $_POST['salasana'])) {
	// Could not get the data that should have been sent.
	exit('Fill the whole form please!');
}



// Make sure the submitted registration values are not empty.
if (empty($_POST['etunimi']) ) {
	exit('etunimi');
   // header("Location:../html2/jasenyys_sonja.html");
}
if(empty($_POST['sukunimi'])){
    exit('lisää sukunimi');
}
if(empty($_POST['email'])){
    exit('lisää email');
}
if(empty($_POST['osoite'])){
    exit('lisää osoite');
}

if(empty($_POST['postitmp'])){
    exit('lisää postitoimipaikka');
}
if(empty($_POST['postinro'])){
    exit('lisää postinumero');
}
if(empty($_POST['puhelinnro'])){
    exit('lisää puhelinnumero');
}
if(empty($_POST['salasana'])){
    exit('lisää salasana');
}


    //testaa onko säpolla ja käyttäjä olemassa
if ($stmt = $yhteys->prepare('SELECT id, salasana, etunimi FROM sonja23015_asiakasrekisteri WHERE email = ?')) {
    //tarkastaa, että kyseessä on oikeasti email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            exit('Email is not valid!');
        }
        if (strlen($_POST['salasana']) > 20 || strlen($_POST['salasana']) < 5) {
            exit('Password must be between 5 and 20 characters long!');
        }

        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            // Username already exists
            echo 'You already have account, please login!';
        } else {

    if ($stmt = $yhteys->prepare('INSERT INTO sonja23015_asiakasrekisteri (  etunimi, sukunimi, email, osoite, postinro, postitmp, puhelinnro, salasana ) VALUES (?, ?, ?, ?, ?, ?, ? ,?)')) {   



            $password = password_hash($_POST['salasana'], PASSWORD_DEFAULT);
            $etunimi='etunimi';
            $stmt->bind_param('ssssisis',$_POST['etunimi'], $_POST['sukunimi'],$_POST['email'], $_POST['osoite'], $_POST['postinro'], $_POST['postitmp'], $_POST['puhelinnro'], $password);
            $stmt->execute();
            echo'Sinut on rekisteröity!';
           
            // header('Location: ../phplogin/index.html');
    } else {
// Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
echo 'Could not prepare statement!';
    }
        }
        $stmt->close();
} else {
	// Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$yhteys->close();
?>