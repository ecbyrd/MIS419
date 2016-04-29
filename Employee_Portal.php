<?php
session_start();
?>
<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
<body>
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
<h2>Employee System Menu</h2>
<ul>
  <li><a href="SampleForm[CHANGE].php">Check Submissions</a></li>
  <li><a href="Sample_EmployeeReport[CHANGE].php">View or Update your information</a><br><br>&nbsp;</li>
  <li><a href="Logout.php">Log out of the system</a></li>
</ul>
<?php
} else {
	// not logged in yet
?>
Hello [COMPANY NAME] Employee, please enter your email and password:<br>
<br>
<form action="Employee_Portal.php" method="post">
Email Address: <input type="text" name="EmpEmail"><br>
Password: <input type="password" name="EmpPass"><br>
<input type = "submit">
</form>
<?php 	
}

?>

</body>
</html>
