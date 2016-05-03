<?php
session_start();
if(  !isset($_SESSION['validhr'])  ){
	// invalid user
	echo "You must be logged in to use this system.<br>";
	echo "Please use the <a href='Employee_Portal.php'>login page</a><br>";
	
	exit;
}
?><html>
<?php include 'Page_Head.php';?>
<body>
<?php include 'HR_Header.php'; ?>
<div class="container">	
<table id="emptable">
<?php
$servername = "localhost";
$dbname = "Project419";
$username = "admin419";
$password = "password1";


// retrieve the incoming form's data from the $_POST array
$tSubID=$_POST['subid'];
$tStatus = $_POST['statusupdate'];
$tValue = $_POST['value'];
$tMail=$_SESSION['validhr'];

echo "You will receive a confirmation email with the hour. Thank you for submitting.";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	$sql = "UPDATE Submissions SET status ='" . $tStatus . "',approvedval = '" . $tValue . "',approvedby='" . $tMail . "' WHERE Submissions.subnum= '" . $tSubID . "' ";
	
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
	//$sql = "INSERT INTO Employee (empid, empfirst, emplast, empemail, empphone, empstreet, empcity, empstate, empzip)
    //VALUES ('" . $tID . "', '" . $tFirst . "', '" . $tLast . "', '" . $tEmail . "', '" . $tPhone . "', '" . $tStreet . "', '" . $tCity . "', '" . $tState . "', '" . $tZip . "')";
	
	$sql = "UPDATE FlexBalance SET balance = FlexBalance.totalflex - FlexBalance.paidout";
	
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
<a href="HR_Portal.php">Go back to the menu</a>
<?php include 'Site_Footer.php'; ?>
</body>
</html>