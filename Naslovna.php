<?php
include ('server.php');

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $korisnicko_ime = mysqli_real_escape_string($konekcija, $_POST['korisnicko']);
      $lozinka = mysqli_real_escape_string($konekcija,$_POST['lozinka']); 
      
      $sql = "SELECT JMBG FROM korisnik WHERE Korisnicko_ime = '$korisnicko_ime' and Lozinka = '$lozinka'";
      $result = mysqli_query($konekcija,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //$_SESSION['korisnicko']= "Your value";
         $_SESSION['login_user'] = $korisnicko_ime;
         header("location: glavna.php");
      }else {
         $greska = "Vaše korisničko ime ili lozinka nisu validni";
      }
   }
?>
<!doctype html>
<head>
<meta charset="UTF-8"> 
<link rel="icon" href="favicon.ico"> 
<link rel="stylesheet" href="css.css">
</head>
<body>
<title> Servis softver  </title>
<div>
   <label for="meni" class="meni">Otvori meni</label>
    <input type="checkbox" id="meni" role="button">
        <ul id="meni">
        <li><a href="Naslovna.php">Naslovna</a></li>
        <li><a href="Registracija.php">Registracija</a></li>
	<span><?php include('greske.php'); ?> </span>
    </ul>
	<form  class="login" method="post" action="Naslovna.php">
                        <input type="text"  name="korisnicko" placeholder="Korisničko ime">             
                        <input type="password"  name="lozinka" placeholder="Lozinka">                 
                    <input type="submit" value="Uloguj se" name="login_dugme">
					</div>
                </form>
<!--<div class="footer">				
				<p> &copy; Pavle Vukajlović 2020</p>
				</div>
				-->
</body>
</html>