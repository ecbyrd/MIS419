<?php 
session_start();
   
// Unset all of the session variables.
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
   
?>
<html>
<?php include 'Page_Head.php';?>
<body>
<?php include 'Admin_Header.php'; ?>
<div class="container">
Thanks for logging out!<br>
<br>
<a href="HR_Portal.php">Return to the login page</a>
<?php include 'Site_Footer.php'; ?>
</body>
</html>