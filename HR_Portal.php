<?php
session_start();
?>
<html>
<?php include 'Page_Head.php';?>
<body>
<?php include 'HR_Header.php'; ?>
<div class="container">	
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
			 . ' WHERE hr_email="' . $tempEmail . '" AND hr_pwd = "'
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
<h2>Welcome HR Staff of Byrds.co</h2>

<?php
} else {
	// not logged in yet
?>
<h2>Hello HR Staff, please enter your email and password:</h2>
<form action="HR_Portal.php" method="post">
Email Address: <input type="text" name="HRemail"><br>
Password: <input type="password" name="HRPass"><br>
<input type = "submit">
</form>
<?php 	
}
?>
</div>
<?php include 'Site_Footer.php'; ?>
</body>
</html>
