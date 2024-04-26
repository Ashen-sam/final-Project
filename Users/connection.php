<?php
$dbhost = "localhost";
$dbserver = "useraccount";
$dbuser = "root";
$dbpass = "";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbserver);

if (!$conn) {
    die("Connection Failed!!" . mysqli_connect_error());
}
