<?php
session_start();

if(!isset($_SESSION['authenticated'])) 
{
    $_SESSION['status'] = "Please login to access the User Dashboard!";
    header("Location: ../Users/login.php");
    exit(0);
}

?>
