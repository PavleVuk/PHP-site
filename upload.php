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
<?php
include('server.php');
if (empty($_SESSION['Korisnicko_ime'])){
header('location:prijava.php');}
if(isset($_POST['uploaduj'])){   
   $ekst_dozvoljene=array( 'jpg', 'jpeg', 'png', 'gif' );    
    $provera_ekst=strtolower(substr(strrchr($_FILES['fajl']['name'], '.') ,1) ) ;
    if (in_array($provera_ekst, $ekst_dozvoljene) ) {    
    $naziv="upload/{$_FILES['fajl']['name']}";
    $result=move_uploaded_file($_FILES['fajl']['tmp_name'], $naziv);
    
    if($result){echo "<img src='$naziv'/>";}
        
    } else { echo '<br>Fajl nije validan'; }
}
else {
    
}
?>
<form method="post" action="upload.php" enctype="multipart/form-data">
        <label for="file"> Izaberite fajl :  </label>
        <input type="file" name="fajl"> 
        <input type="submit" value="Uploaduj" name="uploaduj">
</form>

</div>
</center>
<div class="footer">				
				<p> &copy; Pavle Vukajlović 2020</p>
				</div>
</body>
</html>