<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$initials=parse_ini_file(".ht.asetukset.ini");
try{
    $yhteys=mysqli_connect($initials["databaseserver"], $initials["username"], $initials["password"], $initials["database"]);
    
}
catch(Exception $e){
    header("Location:../components/virhe_sonja.html");
    exit;
}


if (!isset($_POST['etunimi'],$_POST['sukunimi'], $_POST['email'], $_POST['osoite'],
     $_POST['postinro'], $_POST['postitmp'], $_POST['puhelinnro'], $_POST['salasana'])) {
	// Could not get the data that should have been sent.
	exit('Fill the whole form please!');
}



// Varmistaa, että täytettävät alueet on täytte
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


    //testaa onko säpolla olemassa
if ($stmt = $yhteys->prepare('SELECT id, salasana, etunimi FROM sonja23015_asiakasrekisteri WHERE email = ?')) {
    //tarkastaa, että kyseessä on oikeasti email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            exit('Email is not valid!');
        }
        if (strlen($_POST['salasana']) > 20 || strlen($_POST['salasana']) < 5) {
            $viesti2='Password must be between 5 and 20 characters long!';
            echo($viesti2);
        }

        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            // Ja jos käyttäjä on jo olemassa 
            $viesti3='You already have account, please login!';
            echo ($viesti3);
        } else {
            //jos sähköpostia ei löydy luodaan uusi tili
    if ($stmt = $yhteys->prepare('INSERT INTO sonja23015_asiakasrekisteri (  etunimi, sukunimi, email, osoite, postinro, postitmp, puhelinnro, salasana ) VALUES (?, ?, ?, ?, ?, ?, ? ,?)')) {   



            $password = password_hash($_POST['salasana'], PASSWORD_DEFAULT);
            $etunimi='etunimi';
            $stmt->bind_param('ssssisis',$_POST['etunimi'], $_POST['sukunimi'],$_POST['email'], $_POST['osoite'], $_POST['postinro'], $_POST['postitmp'], $_POST['puhelinnro'], $password);
            $stmt->execute();
            header("Location:../components/index.html");
           
            // header('Location: ../phplogin/index.html');
    } else {
// jos sql statementissa on ongelma
echo 'Could not prepare statement!';
    }
        }
        $stmt->close();
} else {
	// jos sql statementissa on ongelma
	echo 'Could not prepare statement!';
}
$yhteys->close();
?>