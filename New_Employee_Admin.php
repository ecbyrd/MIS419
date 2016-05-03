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
	<form action="Insert_Employee_Admin.php" method="post">
	  Employee ID:<br>
	  <input type="text" name="empid" value=""><br>
	  First name:<br>
	  <input type="text" name="firstname" value=""><br>
	  Last name:<br>
	  <input type="text" name="lastname" value=""><br>
	  Email Address:<br>
	  <input type="text" name="emailadd" value=""><br>
	  Phone Number [Format (xxx)xxx-xxxx]:<br>
	  <input type="text" name="phone" value=""><br><br>
	  Street Adress:<br>
	  <input type="text" name="street" value=""><br><br>
	  City:<br>
	  <input type="text" name="city" value=""><br><br>
	  State:<br>
	  <input type="text" name="state" value=""><br><br>
	  Zip Code:<br>
	  <input type="text" name="zip" value=""><br><br>
	  Create a password for the User:<br>
	  <input type="text" name="password" value=""><br><br>
	  <input type="submit" value="Submit">
	</form>
<?php include 'Site_Footer.php'; ?>
</body>
</html>