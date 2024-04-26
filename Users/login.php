<?php
session_start();
// Check if the user is already logged in
if (isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "You are already logged in!";
    header("Location: dashboard.php");
    exit(0);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lanka Explorer Sign In</title>
    <link rel="icon" type="image/x-icon" href="../homes/images/TECH.png">
    <link rel="stylesheet" href="../Users/style.css">
    <link rel="stylesheet" href="../homes/home.css" />
</head>

<div class="container">
    <div class="contain">
        <?php
        if (isset($_SESSION['status'])) {
        ?>
            <div style="background-color:rgb(255, 71, 71);color:whitesmoke;text-align:center; font-size: 1.5rem;top:0;padding:1rem" class="alert">
                <h5><?= $_SESSION['status'] ?></h5>
            </div>
        <?php
            unset($_SESSION['status']);
        }
        ?>
        <div class="card">
            <h2>Login Form</h2>
            <div class="card-body">
                <form action="logincode.php" method="post">
                    <div class="form-group">
                        <label for="">Email ID:</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password:</label>
                        <input type="password" name="password" class="form-control">
                        <a style="text-decoration: none;color:blue;text-align:right" href="../Users/password-reset.php" class="float-end">Forget Your Password?</a>

                    </div>
                    <div class="form-group">
                        <button style="margin:1rem 0" type="submit" name="submit" class="btn btn-primary">Login Now</button>
                        <p style="text-align:center;">don't have an Account?<a style="text-decoration: none;color:blue" href="../Users/register.php"> &nbsp;Sign up</a></p>
                    </div>
                </form>
                <hr>
                <h5>
                    Did not receive a Verification Email?
                    <a href="../Users/verify-token.php">Resend</a>
                </h5>
            </div>
        </div>
    </div>
</div>

<!-- <?php
        // require 'include/footer.php';
        ?> -->