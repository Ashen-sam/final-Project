<?php
session_start();

if (isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "You are already logged in!";
    header("Location: dashboard.php");
    exit(0);
}

// $page_title = "Email Verification";
// require 'include/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="icon" type="image/x-icon" href="../homes/images/TECH.png">
    <link rel="stylesheet" href="../Users/style.css">

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
            <h2>Resend Email Verification</h2>
            <div class="card-body">
                <form action="resend-code.php" method="post">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
// require 'include/footer.php';
?>