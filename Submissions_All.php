<?php

session_start();
if(  !isset($_SESSION['validadmin'])  ){
	// invalid user
	echo "You must be logged in to use this system.<br>";
	echo "Please use the <a href='Admin_Portal.php'>login page</a><br>";
	
	exit;
}
?>
<html>
<?php include 'Page_Head.php';?>
<body>
<?php include 'Admin_Header.php'; ?>
<div class="container">	
<table id="emptable">
<thead><tr><th>Employee ID</th><th>Submission ID</th><th>Time Stamp</th><th>Date of Receipt</th><th>Value</th><th>Status</th><th>Approved By</th></tr></thead><tbody>
<?php
$servername = "localhost";
$dbname = "Project419";
$username = "admin419";
$password = "password1";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected successfully"; 
	
	$stmt = $conn->query('SELECT empid, subnum, timestamp, date, dollarval, status, approvedby FROM Submissions, EmployeeList WHERE Submissions.employemail = EmployeeList.empemail');
 
	while($emprow = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo "<tr><td>" 
		. $emprow['empid'] 
		. '</td><td>'		
		. $emprow['subnum'] 
		. '</td><td>'
		. $emprow['timestamp'] 
		. '</td><td>'
		. $emprow['date'] 
		. '</td><td>'
		. $emprow['dollarval'] 
		. '</td><td>'
		. $emprow['status'] 
		. '</td><td>'
		. $emprow['approvedby'] 
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