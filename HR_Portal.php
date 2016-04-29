<?php
session_start();
?>
<html>
<body>
<?php

if( $_POST['HRemail'] > ""){
	// if set then process their login by looking up in DB

	$servername = "localhost";
	$dbname = "Project419";
	$username = "admin419";
	$password = "password1";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully"; 
		
		$tempEmail = $_POST['HRemail'];
		$tempPassword = $_POST['HRPass'];
		
		$sql = 'SELECT * FROM HRStaff '
			 . ' WHERE UserEmail="' . $tempEmail . '" AND UserPassword = "'
			 . $tempPassword . '"';
		
		$stmt = $conn->query($sql);
		
		$matchFound = false;		
		while($emprow = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$matchFound = true;
		}
		
		if($matchFound) $_SESSION['validhr'] = $tempEmail;
		
	}
	catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	
	
} // end if(isset($_POST['EmpEmail']))
	
	
if(  isset($_SESSION['validhr'])  ){
	// valid user
?>
<h2>Employee System Menu</h2>
<ul>
  <li><a href="SampleForm.php">Add New Employee</a></li>
  <li><a href="Sample_EmployeeReport.php">View All Employees</a><br><br>&nbsp;</li>
  <li><a href="logout.php">Log out of the system</a></li>
</ul>
<?php
} else {
	// not logged in yet
?>
Hello [COMPANY NAME] Human Resources Staff, please enter your email and password:<br>
<br>
<form action="sample_menu.php" method="post">
Email Address: <input type="text" name="HRemail"><br>
Password: <input type="password" name="HRPass"><br>
<input type = "submit">
</form>
<?php 	
}

?>

</body>
</html>
