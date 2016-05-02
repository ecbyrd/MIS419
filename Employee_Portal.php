<?php
session_start();
?>
<html>
<?php include 'Page_Head.php';?>
<body>
<?php include 'Site_Header.php'; ?>
<div class="container">	
<?php

if( $_POST['EmpEmail'] > ""){
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
		
		$tempEmail = $_POST['EmpEmail'];
		$tempPassword = $_POST['EmpPass'];
		
		$sql = 'SELECT * FROM EmpLog '
			 . ' WHERE emp_email="' . $tempEmail . '" AND emp_pwd = "'
			 . $tempPassword . '"';
		
		$stmt = $conn->query($sql);
		
		$empid = 'SELECT empid FROM EmpLog WHERE emp_email="' . $tempEmail . '"';
		$_SESSION['id_emp']=$empid;
		$matchFound = false;		
		while($emprow = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$matchFound = true;
		}
		
		if($matchFound) $_SESSION['validemp'] = $tempEmail;
		
	}
	catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	
	
} // end if(isset($_POST['EmpEmail']))
	
	
if(  isset($_SESSION['validemp'])  ){
	// valid user
?>
<h2>Howdy [user]"</h2>

<?php
} else {
	// not logged in yet
?>
<h2>Hello [COMPANY NAME] Employee, please enter your email and password:</h2>
<form action="Employee_Portal.php" method="post">
Email Address: <input type="text" name="EmpEmail"><br>
Password: <input type="password" name="EmpPass"><br>
<input type = "submit">
</form>
<?php 	
}
?>
</div>
</body>
</html>