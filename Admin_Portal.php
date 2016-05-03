<?php
session_start();
?>
<html>
<?php include 'Page_Head.php';?>
<body>
<?php include 'Admin_Header.php'; ?>
<div class="container">	
<?php

if( $_POST['AdminEmail'] > ""){
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
		
		$tempEmail = $_POST['AdminEmail'];
		$tempPassword = $_POST['AdminPass'];
		
		$sql = 'SELECT * FROM DBAdmin '
			 . ' WHERE email="' . $tempEmail . '" AND password = "'
			 . $tempPassword . '"';
		
			
		$stmt = $conn->query($sql);
		
		
		$matchFound = false;		
		while($emprow = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$matchFound = true;
		}
		
		if($matchFound) $_SESSION['validadmin'] = $tempEmail;
		
	}
	catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	
	
} // end if(isset($_POST['EmpEmail']))
	
	
if(  isset($_SESSION['validadmin'])  ){
	// valid user
?>
<h2>Welcome DB Admin of Byrds.co</h2>

<?php
} else {
	// not logged in yet
?>
<h2>Hello Admin, please enter your email and password:</h2>
<form action="Admin_Portal.php" method="post">
Email Address: <input type="text" name="AdminEmail"><br>
Password: <input type="password" name="AdminPass"><br>
<input type = "submit">
</form>
<?php 	
}
?>
</div>
<?php include 'Site_Footer.php'; ?>
</body>
</html>
