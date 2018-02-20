<!DOCTYPE html>
<head>
	<style>
		.table {
			border-collapse:collapse;
		}
		
		.table, th, td {
			border:1px solid black;
			
			}
			
		.table tr:nth-child(even){
			background-color: #f2f2f2;
			}

		.table tr:hover {
			background-color: #ddd;
			}
	</style>
</head>
	<body>
<!-- DB Connect -->
		<?php


			include 'db_connect.php';
 
			$conn = OpenCon();
 
			echo "Connected Successfully <br>";

		?>

<!-- Populate <select> -->
		<?php
			$sql = "SELECT * 
					FROM cards";
		

			$result = $conn->query($sql);
		?>

		Search by card number:
		</br>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> " method="post">
		
		<?php
			if ($result->num_rows > 0) {
    			echo "<select name='name'>";
    			echo "<option value='*'>All Cards</option>";
    			// output data of each row
    			while($row = $result->fetch_assoc()) {
        			echo "<option value='" . $row['card_number'] . "'>" . $row["card_number"]. "</option>";
    			}
    			echo "</select>";
			} else {
    			echo "0 results";
			}

		?>

		<?php
			$name  = "";

			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$name = ($_POST["name"]);

				if( $name > 0){	

				$sql = "SELECT * 
						FROM cards
						WHERE card_number='$name'";
		
				$result = $conn->query($sql);
		
				} elseif ( $name == 0 ) {

					$sql = "SELECT * 
							FROM cards";
		

					$result = $conn->query($sql);
				}
			}

		?>
		
		<input type="submit">
		</form>



<!-- Switch SQL Query -->

		<?php
			$name  = "";

			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$name = ($_POST["name"]);	
		

				if($name == '*'){

        			$sql = "SELECT * 
					FROM cards";
        
				} elseif ($name > 1) {
	
					$sql = "SELECT * 
					FROM cards
					WHERE card_number = '$name'";
        
				}
			}

			$result = $conn->query($sql);


		?>




<!-- Build table -->
		<?php



/* Cards */
			if ($result->num_rows > 0) {
    			echo "<table class='table' cellpadding='5px';'><tr><th>Card Number</th><th>Card Type</th><th>Purchase Date</th><th>Expiration</th><th>Balance</th></tr>";
    			// output data of each row
    			while($row = $result->fetch_assoc()) {
        			echo "<tr><td>" . $row["card_number"]. "</td><td>" . $row["card_type"]. "</td><td>" .$row["purchased"]. "</td><td>" .$row["expiration"]. "</td><td>" .$row["balance"]. "</td></tr>";
    			}
    			echo "</table>";
			} else {
    		echo "0 results";
    		}

		?>

</body>