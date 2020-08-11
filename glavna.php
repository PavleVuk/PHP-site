<?php 
include('server.php'); 

if (!isset($_SESSION['Korisnicko_ime'])) {
  	$_SESSION['msg'] = "Prvo se morate prijaviti";
  	header('location: prijava.php');
  }

  if (isset($_GET['odjavi'])) {
  	session_destroy();
  	unset($_SESSION['Korisnicko_ime']);
  	header("location: prijava.php");
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
<title>Servis softver </title>
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
<h1>Početna stranica </h1>
<div class="poruka">

<?php if (isset($_SESSION['uspeh'])) : ?>
      <div >
      	<h3>
          <?php 
          	echo $_SESSION['uspeh']; 
          	unset($_SESSION['uspeh']);
          ?>
          </h3>
      </div>
  <?php endif ?>
<?php  if (isset($_SESSION['Korisnicko_ime'])) : ?><br>
      <p>Dobrodošli <strong><?php echo $_SESSION['Korisnicko_ime']; ?></strong></p>
      <p> <a href="glavna.php?odjavi='1'" style="color: orange;"> <br> Odjavite se</a> </p>
    <?php endif ?>
<br>
    <p> Ovaj sajt je zamišljen kao softver za servise mobilnih telefona za evidenciju mobilnih telefona koji su primljeni na popravku sa 
        informacijama korisnika i delom koji treba da se zameni. </p> <br>
    <p> Moguće je dodati mnoštvo drugih potrebnih funkcija i napraviti izmene u funkcionisanju ovog sajta.
    </div>
</div>
    <div class="footer">				
				<p> &copy; Pavle Vukajlović 2020</p>
				</div>
</form>
</div>
</body>
</html>