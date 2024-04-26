<?php
    $dbhost = "localhost";
    $dbserver = "trainticket";
    $dbuser = "root";
    $dbpass = "";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbserver);

    if(!$conn){
        die("Connection Failed!" . mysqli_connect_error());
    }
?>