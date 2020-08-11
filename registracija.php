<?php include('server.php'); ?>
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

<center>
<div class="reg">
<h1> Napravite svoj administratorski nalog </h1>
<form name="registracija" class="regi" method="post" action="registracija.php" >

<p> Vaš JMBG : <br> <input type="text" size="14" name="JMBG" value="<?php echo $JMBG;?>"> </p>
<p> Korisničko ime: <br><input type="text" size="14" name="ime" value="<?php echo $kor_ime;?>"> </p>

<p> Lozinka: <br><input type="password" size="15" name="lozinka1" > </p>

<p> Potvrdite lozinku: <br><input type="password" size="15" name="lozinka2"> </p>

<p> Vaša e-mail adresa: <br><input type="text" size="15" name="email" value="<?php echo $email;?>"> </p>
<p> Već imate administratorski nalog? <a href="prijava.php"> Prijavite se </a> </p>

<p> <input type="submit" value="Submit" name="dugme"> </p>
<div class="greske">	<?php include ('greske.php'); ?></div>
<p name="success">
</form>
</div>
<div class="footer">				
				<p> &copy; Pavle Vukajlović 2020</p>
				</div>
</body>
</html>