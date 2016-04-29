<?php
session_start();
if(  !isset($_SESSION['EmpEmail'])  ){
	// invalid user
	echo "You must be logged in to use this system.<br>";
	echo "Please use the <a href='sample_menu.php'>login page</a><br>";
	
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
<thead><tr><th>First Name</th><th>Last Name</th></tr></thead><tbody>
<?php
$servername = "localhost";
$dbname = "Project419";
$username = "admin419";
$password = "password1";
$email=$_POST['EmpEmail']

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected successfully"; 
	
	$stmt = $conn->query('SELECT * FROM Employee WHERE empemail = $email');
 
	while($emprow = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo "<tr><td>" 
		. $emprow['empfirst'] 
		. '</td><td>'
		. $emprow['emplast'] 
		. "</td></tr>"; 
	}
	
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

?>

</tbody></table>

<a href="sample_menu.php">Go back to the menu</a>
</body>
</html>