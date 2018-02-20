<?php
 
function OpenCon()
 {
 $dbhost = "localhost:3306";
 $dbuser = "zaasai";
 $dbpass = "Subie25RS";
 $db = "asai_hwy1_cards";
 
 
 $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>