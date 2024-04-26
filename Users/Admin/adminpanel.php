<?php
require '../connection.php';

$query = "SELECT COUNT(*) AS totalUsers FROM users";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalUsers = $row['totalUsers'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="adminstyle.css">
</head>

<body>
    <header>
        <button id="logout"><a href="../logout.php">Logout</a></button>
    </header>
    <div class="sidebar">
        <h2><a style="text-decoration: none;color :whitesmoke" href="adminpanel.php">Admin Panel</a></h2>
        <ul>
            <li><a href="addAdmin.php" id="addAdmin">Add Admins</a></li>
            <li><a href="addTrainDetails.php" id="addTrain">Add Train Details</a></li>
            <!-- <li><a href="#" id="addLostItems">Add Lost Items</a></li> -->
            <li><a href="manageusers.php" id="addTrain">Manage Users</a></li>
            <li><a href="alert.php" id="sendAlert">Send Train Alert</a></li>
        </ul>
    </div>
    <div class="content">
        <h2>Welcome Admin</h2>
        <div class="set">
            <div class="stats">
                <p>Total Users: <span id="totalUsers"><?php echo $totalUsers; ?></span></p>
                <p>Total Payments: $<span id="totalPayments">5000</span></p>
            </div>
            <div class="stats">
                <p>Extra text <span id="totalUsers">100</span></p>
                <p>Text text $<span id="totalPayments">5000</span></p>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("logout").addEventListener("click", function() {
            location.href = "../logout.php";
        });
    </script>
</body>

</html>