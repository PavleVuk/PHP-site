<?php
session_start();

$JMBG="";
$kor_ime="";
$email="";
$lozinka_1="";
$lozinka_2="";
$greske=array(); 
$_SESSION['uspeh']="";
$ispis="";

include ('konekcija.php');

$konekcija = OstvariKonekciju();

// REGISTER USER
if (isset($_POST['dugme'])) { //provera da li je dugme stisnuto
  // receive all input values from the form
  $JMBG=mysqli_real_escape_string($konekcija, $_POST['JMBG']);
  $ime=mysqli_real_escape_string($konekcija, $_POST['ime']);
  $email=mysqli_real_escape_string($konekcija, $_POST['email']);
  $lozinka_1=mysqli_real_escape_string($konekcija, $_POST['lozinka1']);
  $lozinka_2=mysqli_real_escape_string($konekcija, $_POST['lozinka2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($JMBG)){array_push($greske, "JMBG je obavezan"); }
  if (empty($ime)) { array_push($greske, "Korisničko ime je obavezno"); }
  if (empty($email)) { array_push($greske, "Email je obavezan"); }
  if (empty($lozinka_1)) { array_push($greske, "Lozinka je obavezna"); }
  if ($lozinka_1 != $lozinka_2) {
	array_push($greske, "Lozinke se ne podudaraju");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $provera = "SELECT * FROM korisnik WHERE Korisnicko_ime='$ime' OR email='$email' LIMIT 1";
  $rezultat = mysqli_query($konekcija, $provera);
  $korisnik = mysqli_fetch_assoc($rezultat);
  
  if ($korisnik) { // if user exists
    if ($korisnik['Korisnicko_ime'] === $ime) {
      array_push($greske, "Korisnik već postoji");
    }
  
    if ($korisnik['email'] === $email) {
      array_push($greske, "Email već postoji");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($greske) == 0) {
  	$unos = "INSERT INTO korisnik (JMBG, Korisnicko_ime, Lozinka, email) 
  			  VALUES('$JMBG','$ime' ,'$lozinka_1','$email')";
  	mysqli_query($konekcija, $unos);
  $_SESSION['Korisnicko_ime'] = $ime;
  $_SESSION['uspeh'] = "Sada ste prijavljeni";
  	header('location: join.php');
  }
}

 //LOGIN USER
if (isset($_POST['dugme_prijava'])) {
  $kor_ime = mysqli_real_escape_string($konekcija, $_POST['ime']);
  $lozinka_1 = mysqli_real_escape_string($konekcija, $_POST['lozinka']);

  if (empty($kor_ime)) {
    array_push($greske, "Korisničko ime je obavezno");
  }
  if (empty($lozinka_1)) {
    array_push($greske, "Lozinka je obavezna");
  }

  if (count($greske) == 0) {
    $ispis = "SELECT * FROM korisnik WHERE Korisnicko_ime='$kor_ime' AND Lozinka='$lozinka_1'";
    $results = mysqli_query($konekcija, $ispis);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['Korisnicko_ime'] = $kor_ime;
      $_SESSION['success'] = "Sada ste ulogovani";
      header('location: glavna.php');
    }else {
      array_push($greske, "Pogrešne vrednosti korisničkog imena i lozinke");
    }
  }
} 
?>