<?php 

include('server.php');
if (empty($_SESSION['Korisnicko_ime'])){
header('location:prijava.php');}
$naziv="";
$greske = array(); 
$br=1;

$konekcija = OstvariKonekciju();
mysqli_query($konekcija, 'SET foreign_key_checks = 0');
//$provera0=("SELECT * FROM servis");
$upit = "SELECT * FROM mobilni_telefon INNER JOIN poseduje ON mobilni_telefon.IMEI=poseduje.IMEI_telefona INNER JOIN deo ON poseduje.ID_dela=deo.ID INNER JOIN korisnik ON mobilni_telefon.JMBG_korisnika=korisnik.JMBG ";
$rezultat0 = mysqli_query($konekcija, $upit);

if(isset($_GET['delete'])){
    $JMBG= $_GET['delete'];
   // mysqli_query ($konekcija, "DELETE FROM servis where ID_s=$id"); 
    mysqli_query ($konekcija, "DELETE poseduje, mobilni_telefon, korisnik from poseduje inner join mobilni_telefon on poseduje.IMEI_telefona=mobilni_telefon.IMEI INNER join korisnik on korisnik.JMBG=mobilni_telefon.JMBG_korisnika where korisnik.JMBG='$JMBG'");
    header('location: brisanje.php');
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
<h1> Obrišite podatke  </h1>
<form name="registracija" class="regi" method="get" action="brisanje1.php" >
<center>
<table class="tabela">
    <caption class="title">Tabele</caption>
    <thead>
      <tr>
      <th>Redni br.</th>
        <th>IMEI</th>
        <th>Proizvodjac</th>
        <th>Model</th>
        <th>ID_dela</th>       
        <th>Naziv dela</th>
        <th>JMBG</th>
        <th>Korisničko ime</th>
        <th>email</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      

      <?php
while ($red = mysqli_fetch_array($rezultat0)) {
 ?>
    
      <tr>
          <td><?php echo $br;?> </td>
          <td><?php echo $red['IMEI'];?></td>
          <td><?php echo $red['Proizvodjac'];?></td>
          <td><?php echo $red['Model'];?></td>
          <td><?php echo $red['ID'];?></td>
          <td><?php echo $red['Naziv'];?></td>
          <td><?php echo $red['JMBG'];?></td>
          <td><?php echo $red['Korisnicko_ime'];?></td>
          <td><?php echo $red['email'];?></td>
          <td><a href="brisanje.php?delete=<?php echo $red['JMBG'];$br++;?>"> Izbriši </a> </td>

        </tr>
    
    
    <?php } ?>
   
  
    
</form>
</div>
<div class="footer">				
				<p> &copy; Pavle Vukajlović 2020</p>
				</div>
</body>
</html>