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
<div class="container">	
<?php
$servername = "localhost";
$dbname = "Project419";
$username = "admin419";
$password = "password1";


// retrieve the incoming form's data from the $_POST array
$tTime=$_POST['time'];
$tDate = $_POST['daterec'];
$tValue = $_POST['dollarvalue'];
$tMail=$_SESSION['validemp'];

echo "You will receive a confirmation email with the hour. Thank you for submitting.";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	$sql = "INSERT INTO Submissions (timestamp, employemail, date, dollarval, status)
    VALUES ('" . $tTime . "', '" . $tMail . "', '" . $tDate . "', '" . $tValue . "', 'Submitted')";
	
	//echo "<h2>" . $sql . "</h2>";
	
	//$somevariable = stringconstant . varvalue . stringcontstant . varvalue . stringconstant
	
    // use exec() because no results are returned
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    
$email=$_SESSION['validemp'];
mail($email, "Flex Benefits Submition", "Your benefits submission has been received");

?>
<?php include 'Site_Footer.php'; ?>
</body>
</html>