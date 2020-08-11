<!doctype html>
<head>
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="favicon.ico"> 
<link rel="stylesheet" href="css.css">
</head>
<body>
<title> Servis softver </title>
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

<center>
<div class="reg">
<h1>Pretraga   </h1>
<table>
    <caption class="title">Prikaz svih tabela:</caption>
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
      </tr>
    </thead>
    <tbody>
<?php
include('server.php');
if (empty($_SESSION['Korisnicko_ime'])){
header('location:prijava.php');}
$konekcija = OstvariKonekciju();
$ispis="";
$rbr=1;
$br=0;

$upit=("SELECT * FROM mobilni_telefon INNER JOIN poseduje ON mobilni_telefon.IMEI=poseduje.IMEI_telefona INNER JOIN deo ON poseduje.ID_dela=deo.ID INNER JOIN korisnik ON mobilni_telefon.JMBG_korisnika=korisnik.JMBG ");
$rezultat0=mysqli_query($konekcija,$upit);

if(isset($_POST['pretraga'])){
  $pretraga=$_POST['pretraga'];
  $pretraga=preg_replace("#[^0-9a-z]#i","",$pretraga);
  $provera=("SELECT * FROM deo where ID LIKE '%$pretraga%' or Naziv LIKE '%$pretraga%'");
  $upit="SELECT * FROM mobilni_telefon INNER JOIN poseduje ON mobilni_telefon.IMEI=poseduje.IMEI_telefona INNER JOIN deo ON poseduje.ID_dela=deo.ID INNER JOIN korisnik ON mobilni_telefon.JMBG_korisnika=korisnik.JMBG WHERE JMBG LIKE '%$pretraga%' or Korisnicko_ime LIKE '%$pretraga%' or IMEI LIKE '%$pretraga%' ";
  $rezultat=mysqli_query($konekcija, $upit);
  $broji=mysqli_num_rows($rezultat);

  if($broji==0 || $pretraga==null){
    $ispis= 'Nije nađeno';
  }

while ($red = mysqli_fetch_array($rezultat))
    {
      echo '<tr>
      <td>'.$rbr.'</td>
      <td>'.$red['IMEI'].'</td>
      <td>'.$red['Proizvodjac'].'</td>
      <td>'.$red['Model'].'</td>                
      <td>'.$red['ID_dela'].'</td>       
      <td>'.$red['Naziv'].'</td>
      <td>'.$red['JMBG'].'</td>
      <td>'.$red['Korisnicko_ime'].'</td>
      <td>'.$red['email'].'</td>  
        </tr>';
      $br++;
    }
}
    ?>
<form action="pretraga2.php" method="post">
  <input type="text" name="pretraga" placeholder="Pretrazi"><br>
  <input type="submit" value="Pretrazi">
<div class="ispis">

<?php
print ("$ispis");
?>

</div>
</div>
</form>
<div class="footer">				
				<p> &copy; Pavle Vukajlović 2020</p>
				</div>
</body>
</html>