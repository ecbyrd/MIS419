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
<table id="emptable">
<thead><tr><th>Submission ID</th><th>Date</th><th>Submitted Value</th><th>Approved Value</th><th>Status</th></tr></thead><tbody>
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
	
	$stmt = $conn->query('SELECT * FROM Submissions WHERE Submissions.employemail="' . $Email . '" ORDER by subnum');
 
	while($emprow = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo "<tr><td>" 
		. $emprow['subnum'] 
		. '</td><td>'
		. $emprow['date'] 
		. '</td><td>'
		. $emprow['dollarval'] 
		. '</td><td>'
		. $emprow['approvedval'] 
		. '</td><td>'
		. $emprow['status'] 
		. "</td></tr>";
	}
	
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

?>

</tbody></table><br>

<a href="Employee_Portal.php">Go back to the menu</a>
<?php include 'Site_Footer.php'; ?>
</body>
</html>