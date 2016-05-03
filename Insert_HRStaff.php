<?php
session_start();
if(  !isset($_SESSION['validadmin'])  ){
	// invalid user
	echo "You must be logged in to use this system.<br>";
	echo "Please use the <a href='sample_menu.php'>login page</a><br>";
	
	exit;
}
?>
<html>
<?php include 'Page_Head.php';?>
<body>
<?php include 'Admin_Header.php'; ?>
<div class="container">	
<?php
$servername = "localhost";
$dbname = "Project419";
$username = "admin419";
$password = "password1";

// retrieve the incoming form's data from the $_POST array

$tEmail = $_POST['emailadd'];
$tPassword = $_POST['password'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	$sql = "INSERT INTO HRStaff (hr_email, hr_pwd)
    VALUES ('" . $tEmail . "', '" . $tPassword . "')";
	
	//echo "<h2>" . $sql . "</h2>";
	
	//$somevariable = stringconstant . varvalue . stringcontstant . varvalue . stringconstant
	
    // use exec() because no results are returned
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
Thank you for submitting a new HR Staffer!!!<br>
	<a href="Admin_Portal.php">Go back to the menu</a>
<?php include 'Site_Footer.php'; ?>
</body>
</html>