
<?php
$host = "localhost";
$dbName = "asai_hwy1_cards"; 
$username = "zaasai"; 
$pwd = "Subie25RS"; 

//creates connection
$dbConn = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $pwd);

// Sets Error handling to Exception so it shows ALL errors when trying to get data
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
 