<?php
session_start();
$page_title = "Registration Page";
// require '../homes/includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lanka Explorer Sign up </title>
    <link rel="icon" type="image/x-icon" href="../homes/images/TECH.png">
    <link rel="stylesheet" href="../homes/home.css">
    <link rel="stylesheet" href="../Users/style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="../homes/header.js" defer></script>
</head>

<body>
    <div style="position:relative" class="container">
        <img id="img" style="object-fit:contain" src="../homes/images/LOGO-1.png" alt="logo">

        <div style="position: relative;" class="contain">

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
            <div style="padding:1rem" class="card">
                <h2 style="text-align: center;">Lanka Explorer Sign Up</h2>
                <div class="card-body">
                    <form action="code.php" method="post">
                        <div class="form-group">
                            <label for="">Name:</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number:</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email ID:</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Password:</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <button style="margin:1rem 0" type="submit" name="submit" class="btn btn-primary">Register Now</button>
                        </div>
                        <p>Already have an Account ?<a style="text-decoration: none;color:blue" href="../Users/login.php">Sign in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
<?php
// require '../homes/includes/footer.php';
?>