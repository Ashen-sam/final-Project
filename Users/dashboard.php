<?php
require 'authentication.php';

if (isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) {
    header("Location: Admin/adminpanel.php");
    exit();
}

$page_title = "Dashboard Page";
require 'include/header.php';
?>

<head>
    <link rel="icon" type="image/x-icon" href="../homes/images/TECH.png">
    <link rel="stylesheet" href="../homes/styles/home.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
</head>
<div class="container " style="display: flex;justify-content:center;align-items:center;height:100vh">
    <div class="contain">
        <?php
        if (isset($_SESSION['status'])) {
        ?>
            <div style="background-color:rgb(255, 71, 71);color:whitesmoke;text-align:center; font-size: 1.5rem;top:0;padding:1rem;margin:0.5rem 0" class="alert">
                <h5><?= $_SESSION['status'] ?></h5>
            </div>
        <?php
            unset($_SESSION['status']);
        }
        ?>
        <div class="card mb-3 " style="margin: auto;border:1px solid gray ;display:flex;flex-direction:column;align-items:center;width:500px;justify-content:center ;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;padding:3rem;border-radius:1rem">
            <img style="width: 200px;" width=50 src="../Users/images/teamwork.png" alt="asdasd">
            <h1 style="font-size: 2rem;">User Dashboard</h1>
            <div class="card-body " style="display: flex;flex-direction:column;justify-content:center;">
                <h2 style="padding-top: 0.6rem;">Username: <?= $_SESSION['auth_user']['username']; ?></h2>
                <h2 style="padding-top: 0.6rem;">Email ID: <?= $_SESSION['auth_user']['email']; ?></h2>
                <h2 style="padding: 0.6rem 0;">Phone No: <?= $_SESSION['auth_user']['phone']; ?></h2>
            </div>
            <div class="card-body">
                <div class="linkbtn">
                    <!-- <button><a id="book" href="../Users/booking/booking.php">BOOK NOW</a></button>
                        <button><a id="book" href="../Users/password-reset.php">RESET PASSWORD</a></button> -->
                    <button style="background-color: #4CAF50; border: none;
  color: white;
  padding: 0.5rem;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  margin: 4px 2px;
  width:100%;
  cursor: pointer;
  border-radius: 8px;">
                        <a id="book" href="../Users/booking/booking.php" style="color: white; text-decoration: none;">BOOK NOW</a>
                    </button>

                    <button style="background-color: #008CBA; 
  border: none;
  color: white;
  padding: 0.5rem;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  width:100%;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 8px;">
                        <a id="book" href="../Users/password-reset.php" style="color: white; text-decoration: none;">RESET PASSWORD</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>