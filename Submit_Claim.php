<?php
session_start();
if(  !isset($_SESSION['validemp'])  ){


	// invalid user
	echo "You must be logged in to use this system.<br>";
	echo "Please use the <a href='Employee_Portal.php'>login page</a><br>";
	
	exit;
}
?>
<html>
<?php include 'Page_Head.php';?>
<body>
<?php include 'Site_Header.php'; ?>
<?php



$servername = "localhost";
$dbname = "Project419";
$username = "admin419";
$password = "password1";
$Email=$_SESSION['validemp'];

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected successfully"; 
	
	$sql = $conn->query('SELECT empid FROM EmployeeList WHERE empemail="' . $Email . '"');
	
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}



?>


<div class="container">	
	<form action="Submitted_Claim.php" method="post" enctype="multipart/form-data">
	  Date of Receipt (mm/dd/yyyy):<br>
	  <input type="text" name="daterec" value=""><br>
	  Value of the Receipt (Format: $xxxx.xx):<br>
	  <input type="text" name="dollarvalue" value=""><br>
	  Add an image of the receipt (jpeg or pdf):<br>
	  <input type="file" name="img" >
	  <input type="hidden" name="time" value="<?php echo date("Y-m-d h:m:s"); ?>" > <br><br>
	  <input type="submit" value="Submit">
	</form>

<?php include 'Site_Footer.php'; ?>
</body>
</html>