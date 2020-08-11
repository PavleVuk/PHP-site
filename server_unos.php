<?php
session_start();

$JMBG="";
$ime="";
$email="";
$IMEI="";
$proizvodjac="";
$model="";
$ID_dela="";
$greske=array(); 
$_SESSION['uspeh']="";
$ispis="";
$rbr=1;
$option = '';

include ('konekcija.php');
$konekcija = OstvariKonekciju();

$upit3 ="SELECT ID FROM deo";
$rezultat5 = mysqli_query($konekcija,$upit3);
$fetch= mysqli_fetch_assoc($rezultat5);

while($row = mysqli_fetch_assoc($rezultat5))
{
  $option .= '<option value = "'.$row['ID'].'">'.$row['ID'].'</option>';
}

$upit="SELECT * FROM mobilni_telefon INNER JOIN poseduje ON mobilni_telefon.IMEI=poseduje.IMEI_telefona INNER JOIN deo ON poseduje.ID_dela=deo.ID INNER JOIN korisnik ON mobilni_telefon.JMBG_korisnika=korisnik.JMBG ";
$rezultat=mysqli_query($konekcija,$upit);

// REGISTER USER
if (isset($_POST['dugme_unos'])) { 
  $JMBG=mysqli_real_escape_string($konekcija, $_POST['JMBG']);
  $ime=mysqli_real_escape_string($konekcija, $_POST['ime']);
  $email=mysqli_real_escape_string($konekcija, $_POST['email']);
  $IMEI=mysqli_real_escape_string($konekcija, $_POST['IMEI']);
  $proizvodjac=mysqli_real_escape_string($konekcija, $_POST['proizvodjac']);
  $model=mysqli_real_escape_string($konekcija, $_POST['model']);
  $IDdela = mysqli_real_escape_string($konekcija, $_POST['select']);
  
  if (empty($JMBG)){array_push($greske, "JMBG je obavezan"); }
  if (empty($ime)) { array_push($greske, "Ime je obavezno"); }
  if (empty($email)) { array_push($greske, "Email je obavezan"); }
  if (empty($IMEI)) { array_push($greske, "IMEI telefona je obavezan"); }
  if (empty($proizvodjac)) { array_push($greske, "Proizvođač telefona je obavezan"); }
  if (empty($model)) { array_push($greske, "Model telefona je obavezan"); }
 
  
 $provera = "SELECT * FROM korisnik WHERE Korisnicko_ime='$ime' OR email='$email' LIMIT 1";
  $rezultat1 = mysqli_query($konekcija, $provera);
  $korisnik = mysqli_fetch_assoc($rezultat1);

  if ($korisnik) { // if user exists
    if ($korisnik['Korisnicko_ime'] === $ime) {
      array_push($greske, "Korisnik već postoji");
    }
    if ($korisnik['email'] === $email) {
      array_push($greske, "Email već postoji");
    }
  }

  $provera2 = "SELECT * FROM mobilni_telefon WHERE IMEI='$IMEI' LIMIT 1";
  $rezultat2 = mysqli_query($konekcija, $provera2);
  $telefon = mysqli_fetch_assoc($rezultat2);
  
  if($telefon){
    if($telefon['IMEI'] === $IMEI)
    array_push($greske, "Ovaj telefon je već na popravci");
  }

  $provera3 = "SELECT * FROM poseduje WHERE IMEI_telefona='$IMEI' and ID_dela='$ID_dela' ";
  $rezultat3 = mysqli_query($konekcija, $provera3);
  $deo = mysqli_fetch_assoc($rezultat3);
  
 
  if (count($greske) == 0) {
  	$unos = "INSERT INTO korisnik (JMBG, Korisnicko_ime, email) VALUES('$JMBG','$ime', '$email')";
    mysqli_query($konekcija, $unos);
    $unos2 = "INSERT INTO mobilni_telefon (IMEI, Proizvodjac, Model, JMBG_korisnika) VALUES('$IMEI', '$proizvodjac', '$model', '$JMBG')";
    mysqli_query($konekcija, $unos2);
    $unos3 = "INSERT INTO poseduje (IMEI_telefona, ID_dela) VALUES('$IMEI', '$IDdela')";
    mysqli_query($konekcija, $unos3);
    
  $_SESSION['Korisnicko_ime'] = $ime;
  $_SESSION['uspeh'] = "Sada ste prijavljeni";
      header('location: unosmob.php');
      
}
//}

 /*//LOGIN USER
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
} */
}
?>