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
<thead><tr><th>ID</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Phone</th><th>Street</th><th>City</th><th>State</th><th>Zip</th><th>Total Flex</th><th>Flex Paid</th><th>Flex Balance</th></tr></thead><tbody>
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
	
	$stmt = $conn->query('SELECT * FROM EmployeeList, FlexBalance WHERE FlexBalance.eid = EmployeeList.empid');
 
	while($emprow = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo "<tr><td>" 
		. $emprow['empid'] 
		. '</td><td>'
		. $emprow['empemail'] 
		. '</td><td>'
		. $emprow['empfirst'] 
		. '</td><td>'
		. $emprow['emplast'] 
		. '</td><td>' 
		. $emprow['empphone'] 
		. '</td><td>'
		. $emprow['empstreet'] 
		. '</td><td>'
		. $emprow['empcity'] 
		. '</td><td>'
		. $emprow['empst']
		. '</td><td>'
		. $emprow['empzip']
		. '</td><td>'
		. $emprow['totalflex']
		. '</td><td>'
		. $emprow['paidout'] 
		. '</td><td>'
		. $emprow['balance'] 
		. "</td></tr>";
	}
	
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

?>

</tbody></table>
Submit New Flex Total Value:<br><br>
	<form action="Benefit_Updated.php" method="post">
	  Enter Emloyee ID:<br>
	  <input type="text" name="id" value=""><br><br>
	  Enter New Total Flex:<br>
	  <input type="text" name="value" value=""><br><br>
	  <input type="submit" value="Submit">
	</form>
<a href="HR_Portal.php">Go back to the menu</a>
<?php include 'Site_Footer.php'; ?>
</body>
</html>
