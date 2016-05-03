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
	<form action="Insert_HRStaff.php" method="post">
	  Email Address:<br>
	  <input type="text" name="emailadd" value=""><br>
	  Create a password for the User:<br>
	  <input type="text" name="password" value=""><br><br>
	  <input type="submit" value="Submit">
	</form>
<?php include 'Site_Footer.php'; ?>
</body>
</html>