<?php
session_start();
if(  !isset($_SESSION['validemp'])  ){
	// invalid user
	echo "You must be logged in to use this system.<br>";
	echo "Please use the <a href='Employee_Portal.php'>login page</a><br>";
	
	exit;
}
?><html>
<head>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">

<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js">
</script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js">
</script>

<script type="text/javascript" class="init">
	$(document).ready(function() {
		$('#emptable').DataTable();
	} );
</script>

</head>
<body>
<table id="emptable">
<thead><tr><th>ID</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Phone</th><th>Street</th><th>City</th><th>State</th><th>Zip</th></tr></thead><tbody>
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
	
	$stmt = $conn->query('SELECT * FROM EmployeeList WHERE empemail="' . $Email . '"');
 
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
		. "</td></tr>";
	}
	
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

?>

</tbody></table>

<a href="Employee_Portal.php">Go back to the menu</a>
</body>
</html>