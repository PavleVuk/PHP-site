<?php
function OstvariKonekciju()
 {
 $dbhost = "localhost";
 $dbkor_ime = "root";
 $db_loz = "";
 $dbaza = "baza";
 
 
 $konekcija = new mysqli($dbhost, $dbkor_ime, $db_loz,$dbaza) or die("Konekcija nije uspela %s\n". $konekcija -> greska);
 
 
 return $konekcija;
 }
 
function ZatvoriKonekciju($konekcija)
 {
 $konekcija -> close();
 }
   
?>