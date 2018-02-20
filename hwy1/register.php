<?php
session_start();

if (!isset($_SESSION['username'])){
  header("Location: login.php");
}




if (isset($_POST['register'])) {  //login form has been submitted
    include 'db_connection.php';
     $sql = "INSERT INTO logins
             (`first_name`, `last_name`, `username`, `password`, `admin`)
             VALUES
             (:fName, :lName, :user, :pass, :admin)";
$stmt = $dbConn->prepare($sql);
$stmt->execute( array (":fName" => $_POST['fName'],
		        	   ":lName" => $_POST['lName'],
		        	   ":user" => $_POST['user'],
		        	   ":pass" => hash("sha1",$_POST['pass']),
		        	   ":admin" => $_POST['admin']));

 
echo $_POST['fName'];
}


?> 

<!DOCTYPE HTML>

<body>

      <h1>Thank you for registering   <?php echo $_POST['fName'] . " " . $_POST['lName']; ?></h1>
      
      </br>
      <form action="logout.php">
           <input type="submit" value="Return to Login"/>
      </form>  

      
 </div>
</body>
</html>
 