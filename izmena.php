<?php 
include('server.php');
if (empty($_SESSION['Korisnicko_ime'])){
header('location:prijava.php');}

$IMEI="";
$proizvodjac="";
$model="";
$br=1;
$greske = array(); 

$konekcija = OstvariKonekciju();

$provera0=("SELECT * FROM mobilni_telefon");
$rezultat0 = mysqli_query($konekcija, $provera0);

if (isset($_POST['dugme_update'])) { 
  $IMEI=mysqli_real_escape_string($konekcija, $_POST['IMEI']);
  $proizvodjac=mysqli_real_escape_string($konekcija, $_POST['proizvodjac']);
  $model=mysqli_real_escape_string($konekcija, $_POST['model']);
 

 if (empty($IMEI)) { array_push($greske, "IMEI je obavezan"); }
  if (empty($proizvodjac)) { array_push($greske, "Naziv proizvođača je obavezan"); }
  if (empty($model)) { array_push($greske, "Naziv modela je obavezan"); }
 

  $provera = "SELECT * FROM mobilni_telefon WHERE IMEI='$IMEI' LIMIT 1";
  $rezultat = mysqli_query($konekcija, $provera);
  $telefon = mysqli_fetch_assoc($rezultat);

  if ($telefon) { 
    if ($telefon['IMEI'] != $IMEI) {
      array_push($greske, "Telefon ne postoji");
    }
}
if (count($greske) == 0) {
  	$unos = "UPDATE mobilni_telefon SET Proizvodjac='$proizvodjac', Model='$model'  WHERE IMEI='$IMEI'";
  	mysqli_query($konekcija, $unos);
  header("location: izmena.php");
  }

}
?>
<!doctype html>
<head>
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="favicon.ico"> 

<link rel="stylesheet" href="css.css">
</head>
<body>
<title> Servis softver  </title>
<div>
        <ul id="meni">
        <li ><a href="glavna.php" id="li">Naslovna</a></li>
        <li ><a href="registracija.php" id="li">Registracija</a></li>
        <li>
            <a href="pretraga.php" id="li1">Pretraga  ￬</a>
            <ul class="drop">
                <li><a href="pretraga2.php">Pretraga svih tabela </a></li>
                <li><a href="pretraga.php">Pretraga delova</a></li>
            </ul>
        </li>
        <li>
          <a href="unosmob.php" id="li1">Unos ￬</a>
            <ul class="drop">
                <li><a href="unosmob.php">Unos svih tabela </a></li>
                <li><a href="unosdela.php">Unos dela</a></li>
                <li><a href="unos.php">Unos samo telefona</a></li>
            </ul>
        </li>
        <li>
          <a href="izmena.php" id="li1"> Izmene ￬</a>
            <ul class="drop">
                <li><a href="izmena.php"> Izmena telefona </a></li>
                <li><a href="izmenakorisnika.php"> Izmena korisnika</a></li>
                <li><a href="izmenadela.php"> Izmena dela</a></li>
            </ul>
        </li>
        <li>
          <a href="brisanje.php" id="li1">Brisanje ￬</a>
            <ul class="drop">
                <li><a href="brisanje.php">Brisanje iz svih tabela </a></li>
                <li><a href="brisanjemob.php">Brisanje telefona</a></li>
                <li><a href="brisanjedeo.php">Brisanje delova</a></li>
                <li><a href="brisanjekorisnik.php">Brisanje korisnika</a></li>
            </ul>
        </li>
        <li><a href="upload.php" id="li3">Upload</a></li>
		<li><a href="join.php" id="li4"> Prikaz svih tabela </a> </li>
        <li>
    </ul>
	</div>              
	<div>

<div class="bg">
</div> 
<center>
<div class="reg">
<h1> Izmenite podatke mobilnog telefona </h1>
<form name="registracija" class="regi" method="post" action="izmena.php" >

<p> Unesite IMEI:  <br><input type="text" size="14" name="IMEI" value="<?php echo $IMEI;?>"> </p>

<p> Izmenite proizvođača: <br><input type="text" size="14" name="proizvodjac" value="<?php echo $proizvodjac;?>"> </p>

<p> Izmenite model: <br><input type="text" size="15" name="model" value="<?php echo $model;?>" > </p>
<p> <input type="submit" value="Prosledite" name="dugme_update"> </p>
<div class="greske">	<?php include ('greske.php'); ?></div>

<table class="tabela">
    <caption class="title">Mobilni telefoni</caption>
    <thead>
      <tr>
        <th>Redni br.</th>
        <th>IMEI</th>
        <th>Proizvodjac</th>
        <th>Model</th>
        <th>JMBG_korisnika</th>
      </tr>
    </thead>
    <tbody>

      <?php
while ($red = mysqli_fetch_array($rezultat0))
    {
      echo '<tr>
          <td>'.$br.'</td>
          <td>'.$red['IMEI'].'</td>
          <td>'.$red['Proizvodjac'].'</td>
          <td>'.$red['Model'].'</td>
          <td>'.$red['JMBG_korisnika'].'</td>
        </tr>';
      $br++;
    }
    ?>
</form>
</div>
<div class="footer">				
				<p> &copy; Pavle Vukajlović 2020</p>
				</div>
</body>
</html>