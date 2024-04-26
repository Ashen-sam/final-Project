<?php
session_start();

$page_title = "Password Reset";
// require 'include/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../Users/style.css">
    <link rel="icon" type="image/x-icon" href="../homes/images/TECH.png">

    <link rel="stylesheet" href="../homes/home.css" />
</head>


<div class="container">
    <img id="img" style="object-fit:contain" src="../homes/images/LOGO-1.png" alt="logo">

    <div class="contain">
        <?php
        if (isset($_SESSION['status'])) {
        ?>
            <div class="alert">
                <h5><?= $_SESSION['status'] ?></h5>
            </div>
        <?php
            unset($_SESSION['status']);
        }
        ?>
        <div class="card">
            <h2>Reset Password</h2>
            <div class="card-body">
                <form action="password-reset-code.php" method="post">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary">Send Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>