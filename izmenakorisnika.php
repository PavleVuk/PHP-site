<?php 
include('server.php');
if (empty($_SESSION['Korisnicko_ime'])){
header('location:prijava.php');}

$JMBG="";
$ime="";
$lozinka="";
$br=1;
$greske = array(); 

$konekcija = OstvariKonekciju();

$provera0=("SELECT * FROM korisnik");
$rezultat0 = mysqli_query($konekcija, $provera0);

if (isset($_POST['dugme_update'])) { 
  $JMBG=mysqli_real_escape_string($konekcija, $_POST['JMBG']);
  $ime=mysqli_real_escape_string($konekcija, $_POST['ime']);
  $lozinka=mysqli_real_escape_string($konekcija, $_POST['lozinka']);
 

if (empty($JMBG)) { array_push($greske, "JMBG je obavezan"); }
if (empty($ime)) { array_push($greske, "Ime je obavezno"); }
//if (empty($lozinka)) { array_push($greske, "Lozinka je obavezna"); }
 

  $provera = "SELECT * FROM korisnik WHERE JMBG='$JMBG' LIMIT 1";
  $rezultat = mysqli_query($konekcija, $provera);
  $korisnik = mysqli_fetch_assoc($rezultat);

  if ($korisnik) { 
    if ($korisnik['JMBG'] != $JMBG) {
      array_push($greske, "Korisnik ne postoji");
    }
}
if (count($greske) == 0) {
  	$unos = "UPDATE korisnik SET Korisnicko_ime='$ime', Lozinka='$lozinka'  WHERE JMBG='$JMBG'";
  	mysqli_query($konekcija, $unos);
  header("location: izmenakorisnika.php");
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
<h1> Izmenite podatke mobilnog korisnika </h1>
<form name="registracija" class="regi" method="post" action="izmenakorisnika.php" >

<p> Unesite JMBG:  <br><input type="text" size="14" name="JMBG" value="<?php echo $JMBG;?>"> </p>

<p> Izmenite ime: <br><input type="text" size="14" name="ime" value="<?php echo $ime;?>"> </p>

<p> Izmenite lozinku: <br><input type="text" size="15" name="lozinka" value="<?php echo $lozinka;?>" > </p>
<p> <input type="submit" value="Prosledite" name="dugme_update"> </p>
<div class="greske">	<?php include ('greske.php'); ?></div>

<table class="tabela">
    <caption class="title">Mobilni korisnik</caption>
    <thead>
      <tr>
        <th>Redni br.</th>
        <th>JMBG</th>
        <th>ime</th>
        <th>lozinka</th>
      
      </tr>
    </thead>
    <tbody>

      <?php
while ($red = mysqli_fetch_array($rezultat0))
    {
      echo '<tr>
          <td>'.$br.'</td>
          <td>'.$red['JMBG'].'</td>
          <td>'.$red['Korisnicko_ime'].'</td>
          <td>'.$red['Lozinka'].'</td>
        
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