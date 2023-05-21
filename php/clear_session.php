<?php

session_start(); // Start the session

setcookie(session_name(), '',100);

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();
$_SESSION=array();
$_COOKIE=array();
header('location: ../webproj/login.php');
?>
