<?php
session_start();
if(  !isset($_SESSION['validemp'])  ){
	// invalid user
	echo "You must be logged in to use this system.<br>";
	echo "Please use the <a href='sample_menu.php'>login page</a><br>";
	
	exit;
}
?>
<html>
<?php include 'Page_Head.php';?>
<body>
<?php include 'Site_Header.php'; ?>
<div class="container">	
<?php
$servername = "localhost";
$dbname = "Project419";
$username = "admin419";
$password = "password1";

// retrieve the incoming form's data from the $_POST array
$tPhone = $_POST['phone'];
$tStreet = $_POST['street'];
$tCity = $_POST['city'];
$tState = $_POST['state'];
$tZip = $_POST['zip'];
$tEmail=$_SESSION['validemp'];


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	//$sql = "INSERT INTO Employee (empid, empfirst, emplast, empemail, empphone, empstreet, empcity, empstate, empzip)
    //VALUES ('" . $tID . "', '" . $tFirst . "', '" . $tLast . "', '" . $tEmail . "', '" . $tPhone . "', '" . $tStreet . "', '" . $tCity . "', '" . $tState . "', '" . $tZip . "')";
	
	$sql = "UPDATE EmployeeList SET empphone ='" . $tPhone . "',empstreet = '" . $tStreet . "',empcity='" . $tCity . "',empst='" . $tState . "',empzip='" . $tZip . "' WHERE empemail = '" . $tEmail . "'";
	
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
Thank you for updating your info!!!<br>
<a href="Employee_Portal.php">Go back to the menu</a>
<?php include 'Site_Footer.php'; ?>
</body>
</html>