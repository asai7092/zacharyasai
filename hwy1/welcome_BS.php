<?php
	session_start();

	if (!isset($_SESSION['username'])){
  		header("Location: login.php");
	}
	
	if (isset($_POST['cardUpdate'])){
  		$_SESSION['cardUpdate'] = $_POST['cardUpdate'];
  		header("Location: transactions.php");
	}
	
	if (isset($_POST['transactions'])){
  		header("Location: transactions.php");
	}
	
?> 

<!doctype html>
<html lang="en">
	<head>
    	<!-- Required meta tags -->
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
		<!-- Optional JavaScript -->
    	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
    	<!-- Bootstrap CSS -->
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    	<title>Hello, world!</title>
    
		<style>
			.table {
				border-collapse:collapse;
				}
		
			.table th, .table td {
				border:1px solid black;
				}
			
			.table tr:nth-child(even){
				background-color: #f2f2f2;
				}

			.table tr:hover {
				background-color: #ddd;
				}
			.table th {
    			padding-top: 12px;
    			padding-bottom: 12px;
    			text-align: left;
    			background-color: #4CAF50;
    			color: white;
				}
				
			.nav {
				position:relative;
				float:left;
				}
		</style>
    
  </head>
  <body>
  	<div class="container">
  		<div class="row">
    		<div class="col-md">
    			<h1>Hello, world!</h1>
    			<span id="greeting" style="font-size:40px; font-weight:bold;">
    				Welcome Administrator   <?php echo $_SESSION['first_name'] . $_SESSION['employee_id'] ?>
   				</span>
    			</br>
    			<form class="nav" method="POST" action="">
        			<input type="submit" name="transactions" value="Transactions" />
   				</form>
    			<form class="nav" action="logout.php">
        			<input type="submit" value="Sign out" />
    			</form>  
    			</br>
    			</br>
    		</div>
    	</div>
    </div>

    
  
  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-md-2">
      			filler column
    		</div>
    		
    		<div class="col-md-4">
      			<div class='content'>
					<span style='font-size:25px;'>
						Upload a Card
					</span> 
					</br>
					</br>
					 
        			<form method='POST' action='reload.php'>
        				<label>Card No.:</label>
      					<input class='input_register' type='text' name='uploadCard'>
      					</br>
      					</br>
      					<label>Amount:</label>
						<input class='input_register' type='text' name='uploadAmount'>
      					</br>
      					</br>
      					</br>
      					</br>
      					</br>
      					</br>
      					<label>Position:&nbsp;</label>
      					<select class='input_register' name='admin'>
      						<option value='no'>
      							Associate
      						</option>
      						<option value='yes'>
      							Manager
      						</option>
      					</select>
      					</br>
      					</br>
      					<input class='input_register' type='submit' value='Submit' name='register'>
      				</form>
				</div>
    		</div>
    		<div class="col-md-4">
      			<?php
    				if($_SESSION['admin'] == 'yes'){
						echo "<div class='content'>
					  			<span style='font-size:25px;'>
									Register a new employee
					 			</span> 
								</br>
					 			</br>
					 
        						<form method='POST' action='register.php'>
        							<label>First Name:</label>
      								<input class='input_register' type='text' name='fName'>
      								</br>
      								</br>
      								<label>Last Name:</label>
									<input class='input_register' type='text' name='lName'>
      								</br>
      								</br>
      								<label>Username:</label>
      								<input class='input_register' type='text' name='user'>
      								</br>
      								</br>
      								<label>Password:</label>
      								<input class='input_register' type='password' name='pass'>
      								</br>
      								</br>
      								<label>Position:&nbsp;</label>
      								<select class='input_register' name='admin'>
      									<option value='no'>
      										Associate
      									</option>
      									<option value='yes'>
      										Manager
      									</option>
      								</select>
      								</br>
      								</br>
      								<input class='input_register' type='submit' value='Submit' name='register'>
      							</form>
							</div>";
					}
				?>
    		</div>
    		<div class="col-md-2">
      			filler column
    		</div>
  		</div>
	</div>
	
	</br>
	</br>
	
	<div class="container-fluid">
  		<div class="row">
    		<div class="col-md-2">
      			filler column
    		</div>
    		<div class="col-md-8">
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
					<input type="submit">
				</form>
				</br>

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
    					echo "<table class='table' cellpadding='5px';'> 
    							<tr>
    								<th> 
    									Card Number
    								</th>
    								<th>
    									Card Type
    								</th>
    								<th>
    									Purchase Date
    								</th>
    								<th>
    									Expiration
    								</th>
    								<th>
    									Balance
    								</th>
    								<th>
    								</th>
    							</tr>";
    					// output data of each row
    					while($row = $result->fetch_assoc()) {
        					echo "<tr>
        							<td>" . 
        								$row["card_number"] . 
        							"</td>
        							<td>" . 
        								$row["card_type"]. 
        							"</td>
        							<td>" .
        								$row["purchased"]. 
        							"</td>
        							<td>" .
        								$row["expiration"]. 
        							"</td>
        							<td>$" .
        								$row["balance"]. 
        							"</td>
        							<td>
        								<form method='POST' >
        									<button type='submit' name='cardUpdate' value='" . $row["card_number"] . "'>
        										Use as Tender
        									</button>
        								</form>
        							</td>
        					 	</tr>";
    					}
    					echo "</table>";
					} else {
    					echo "0 results";
    				}
			?>
    		</div>
    		<div class="col-md-2">
      			filler column
    		</div>
  		</div>
	</div>
  
  
  
  
  </body>
</html>