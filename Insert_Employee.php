<?php
session_start();
if(  !isset($_SESSION['validhr'])  ){
	// invalid user
	echo "You must be logged in to use this system.<br>";
	echo "Please use the <a href='sample_menu.php'>login page</a><br>";
	
	exit;
}
?>
<?php include 'Page_Head.php';?>
<body>
<?php include 'HR_Header.php'; ?>
<div class="container">	
<?php
$servername = "localhost";
$dbname = "Project419";
$username = "admin419";
$password = "password1";

// retrieve the incoming form's data from the $_POST array
$tID = $_POST['empid'];
$tFirst = $_POST['firstname'];
$tLast = $_POST['lastname'];
$tEmail = $_POST['emailadd'];
$tPhone = $_POST['phone'];
$tStreet = $_POST['street'];
$tCity = $_POST['city'];
$tState = $_POST['state'];
$tZip = $_POST['zip'];
$tPassword = $_POST['password'];
$tMail = $_SESSION['validhr'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	$sql = "INSERT INTO EmployeeList (empid, empfirst, emplast, empemail, empphone, empstreet, empcity, empst, empzip, enteredby)
    VALUES ('" . $tID . "', '" . $tFirst . "', '" . $tLast . "', '" . $tEmail . "', '" . $tPhone . "', '" . $tStreet . "', '" . $tCity . "', '" . $tState . "', '" . $tZip . "', '" . $tMail . "')";
	
	//echo "<h2>" . $sql . "</h2>";
	
	//$somevariable = stringconstant . varvalue . stringcontstant . varvalue . stringconstant
	
    // use exec() because no results are returned
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	$sql = "INSERT INTO EmpLog (empid, emp_email, emp_pwd)
    VALUES ('" . $tID . "', '" . $tEmail . "', '" . $tPassword . "')";
	
	//echo "<h2>" . $sql . "</h2>";
	
	//$somevariable = stringconstant . varvalue . stringcontstant . varvalue . stringconstant
	
    // use exec() because no results are returned
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	$sql = "INSERT INTO FlexBalance (eemail, totalflex, paidout, balance)
    VALUES ('" . $tEmail . "', '0', '0', '0')";
	
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
Thank you for submitting that employee!!!<br>
	<a href="HR_Portal.php">Go back to the menu</a>
<?php include 'Site_Footer.php'; ?>
</body>
</html>