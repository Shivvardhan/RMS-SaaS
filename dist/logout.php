<?php
session_start();

// unset all session variables
$_SESSION = array();

// destroy the session
session_destroy();

// redirect the user to the login page or any other page you want
header("Location: index.php");
exit;
?>
