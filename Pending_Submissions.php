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
<thead><tr><th>Submission ID</th><th>First Name</th><th>Last Name</th><th>Employee ID</th><th>Date</th><th>Value</th><th>Status</th></tr></thead><tbody>
<?php
$servername = "localhost";
$dbname = "Project419";
$username = "admin419";
$password = "password1";
$Email=$_SESSION['validhr'];

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected successfully"; 
	
	$stmt = $conn->query('SELECT * FROM Submissions, EmployeeList WHERE Submissions.employemail = EmployeeList.empemail AND Submissions.status = "Submitted" ORDER BY subnum');
 
	while($emprow = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo "<tr><td>" 
		. $emprow['subnum'] 
		. '</td><td>'
		. $emprow['empfirst'] 
		. '</td><td>'		
		. $emprow['emplast'] 
		. '</td><td>'
		. $emprow['empid'] 
		. '</td><td>'
		. $emprow['date'] 
		. '</td><td>'
		. $emprow['dollarval'] 
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

Update Submission:<br><br>
	<form action="Submissions_Updated.php" method="post">
	  Enter Submissions ID:<br>
	  <input type="text" name="subid" value=""><br><br>
	  Upate Status (Approved or Denied):<br>
	  <input type="text" name="statusupdate" value=""><br><br>
	  Enter the Approved Value( or 0 if declined):<br>
	  <input type="text" name="value" value=""><br><br>
	  <input type="submit" value="Submit Update">
	</form>


<a href="HR_Portal.php">Go back to the menu</a>
<?php include 'Site_Footer.php'; ?>
</body>
</html>