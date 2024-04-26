<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if (isset($page_title)) {
            echo "$page_title";
        } ?>
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Work+Sans:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="/home-websss/home.css">
</head>

<body>
    <header>
        <nav style="background-color: #1CAC78; padding:0.5rem;display:flex;justify-content:center;gap:3rem" class="navbar">
            <a style="color:white;" href="../homes/index.php">Home</a>
            <a style="color:white;" href="../Users/dashboard.php">Dashboard</a>
            <?php if (!isset($_SESSION['authenticated'])) : ?>
                <a style="color:white;" href="./register.php">Register</a>
                <a style="color:white;" href="./login.php">Login</a>
            <?php endif ?>
            <?php if (isset($_SESSION['authenticated'])) : ?>
                <a style="color:white;" href="../Users/logout.php">Logout</a>
            <?php endif ?>
        </nav>
    </header>