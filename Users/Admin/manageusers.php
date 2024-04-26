<?php
require '../connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="adminstyle.css">
</head>

<style>

  input{
    padding: 1rem;
  }

</style>
<body>
  <header>
    <button id="logout">Logout</button>
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
        <?php

        if (isset($_POST['delete'])) {
          $Id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

          $deleteQuery = "DELETE FROM users WHERE id = $Id";
          $deleteResult = mysqli_query($conn, $deleteQuery);

          if ($deleteResult) {
            echo "<script>alert('Reservation deleted successfully');</script>";
          } else {
            echo "<script>alert('Failed to delete reservation');</script>";
          }
        }

        $view = "SELECT id, name, email, phone, created_at FROM users";
        $result = mysqli_query($conn, $view);

        if (mysqli_num_rows($result) > 0) {
          echo "<table border='1' style='border: #000; background-color: #fff; text-align: center;'>";
          echo "<tr>
                    <th style='padding: 13px;'>Name</th>
                    <th style='padding: 13px;'>Email</th>
                    <th style='padding: 13px;'>Phone</th>
                    <th style='padding: 13px;'>Created At</th>
                    <th style='padding: 13px;'>Actions</th>
                    </tr>";

          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td style='padding: 13px;'>" . $row['name'] . "</td>";
            echo "<td style='padding: 13px;'>" . $row['email'] . "</td>";
            echo "<td style='padding: 13px;'>" . $row['phone'] . "</td>";
            echo "<td style='padding: 13px;'>" . $row['created_at'] . "</td>";
            echo "<td style='padding: 13px;'>
                <form method='post' action=''>
                    <input  type='hidden' name='id' value='" . $row['id'] . "'>
                    <button class='btn_ed' type='submit' name='delete'>Delete</button>
                </form></td>";
            echo "</tr>";
          }
          echo "</table>";
        } else {
          echo "0 results";
        }

        mysqli_close($conn);
        ?>
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