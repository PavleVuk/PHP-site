<?php 
include('server.php');
if (empty($_SESSION['Korisnicko_ime'])){
header('location:prijava.php');}

$ID="";
$naziv="";
$br=1;
$greske = array(); 

$konekcija = OstvariKonekciju();

$provera0=("SELECT * FROM deo");
$rezultat0 = mysqli_query($konekcija, $provera0);

if (isset($_POST['dugme_update'])) { 
  $ID=mysqli_real_escape_string($konekcija, $_POST['ID']);
  $naziv=mysqli_real_escape_string($konekcija, $_POST['naziv']);

if (empty($ID)) { array_push($greske, "ID je obavezan"); }
if (empty($naziv)) { array_push($greske, "Ime je obavezno"); }

  $provera = "SELECT * FROM deo WHERE ID='$ID' LIMIT 1";
  $rezultat = mysqli_query($konekcija, $provera);
  $deo = mysqli_fetch_assoc($rezultat);

  if ($deo) { 
    if ($deo['ID'] != $ID) {
      array_push($greske, "deo ne postoji");
    }
}
if (count($greske) == 0) {
  	$unos = "UPDATE deo SET Naziv='$naziv' WHERE ID='$ID'";
  	mysqli_query($konekcija, $unos);
  header("location: izmenadela.php");
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
<h1> Izmenite podatke mobilnog dela </h1>
<form name="registracija" class="regi" method="post" action="izmenadela.php" >
<p> Unesite ID:  <br><input type="text" size="14" name="ID" value="<?php echo $ID;?>"> </p>
<p> Izmenite ime: <br><input type="text" size="14" name="naziv" value="<?php echo $naziv;?>"> </p>
<p> <input type="submit" value="Prosledite" name="dugme_update"> </p>
<div class="greske">	<?php include ('greske.php'); ?></div>
<table class="tabela">
    <caption class="title">Mobilni deo</caption>
    <thead>
      <tr>
        <th>Redni br.</th>
        <th>ID</th>
        <th>Naziv</th>    
      </tr>
    </thead>
    <tbody>

      <?php
while ($red = mysqli_fetch_array($rezultat0))
    {
      echo '<tr>
          <td>'.$br.'</td>
          <td>'.$red['ID'].'</td>
          <td>'.$red['Naziv'].'</td        
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