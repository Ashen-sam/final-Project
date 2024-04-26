<?php
require '../connection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['ConfirmPassword'];

    if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirmPassword)) {
        $errorMessage = "All fields are mandatory!";
    } elseif ($password != $confirmPassword) {
        $errorMessage = "Passwords do not match!";
    } else {
        $query = "INSERT INTO admin(name, email, phone, password, gender) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssiss", $name, $email, $phone, $password, $gender);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: addAdmin.php");
                exit();
            } else {
                $errorMessage = "Failed to add admin: " . mysqli_error($conn);
            }
        } else {
            $errorMessage = "Error: Unable to prepare statement";
        }
        mysqli_stmt_close($stmt);
    }
}

if (isset($_POST['delete'])) {
    $Id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    $deleteQuery = "DELETE FROM admin WHERE id = $Id";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        echo "<script>alert('Admin deleted successfully');</script>";
    } else {
        echo "<script>alert('Failed to delete admin');</script>";
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM admin WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $admin = mysqli_fetch_assoc($result);
    }
    mysqli_stmt_close($stmt);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['ConfirmPassword'];

    if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirmPassword)) {
        $errorMessage = "All fields are mandatory!";
    } elseif ($password != $confirmPassword) {
        $errorMessage = "Passwords do not match!";
    } else {
        $query = "UPDATE admin SET name = ?, email = ?, phone = ?, password = ?, gender = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssissi", $name, $email, $phone, $password, $gender, $id);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: addAdmin.php");
                exit();
            } else {
                $errorMessage = "Failed to update admin: " . mysqli_error($conn);
            }
        } else {
            $errorMessage = "Error: Unable to prepare statement";
        }
        mysqli_stmt_close($stmt);
    }
}

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
        padding: 0.5rem;
    }
</style>
<body>
    <header>
    <!-- <li><a href="addAdmin.php" id="addAdmin">Add Admins</a></li>
            <li><a href="addTrainDetails.php" id="addTrain">Add Train Details</a></li>
            <li><a href="#" id="addLostItems">Add Lost Items</a></li>
            <li><a href="manageusers.php" id="addTrain">Manage Users</a></li>
            <li><a href="alert.php" id="sendAlert">Send Train Alert</a></li> -->
        <button id="logout">Logout</button>
    </header>
    <div class="sidebar">
        <h2><a style="text-decoration: none;color :whitesmoke" href="addAdmin.php">Admin Panel</a></h2>
        <ul>
            <li><a href="addAdmin.php" id="addAdmin">Add Admins</a></li>
            <li><a href="addTrainDetails.php" id="addTrain">Add Train Details</a></li>
            <!-- <li><a href="#" id="addLostItems">Add Lost Items</a></li> -->
            <li><a href="manageusers.php" id="addTrain">Manage Users</a></li>
            <li><a href="alert.php" id="sendAlert">Send Train Alert</a></li>
        </ul>
    </div>
    <div class="content">
        <h2><?php echo isset($admin) ? 'Edit Admin Info' : 'Add New Admin Info'; ?></h2>
        <div class="contain">
            <form class="form_add" action="" id="adminForm" method="post" enctype="multipart/form-data">
                <?php if (isset($errorMessage)) : ?>
                    <div class="error"><?php echo $errorMessage; ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="name">Enter New Name:</label><br>
                    <input type="text" id="name" name="name" value="<?php echo isset($admin) ? $admin['name'] : ''; ?>" required><br>
                    <label for="email">Enter Email:</label><br>
                    <input type="email" id="email" name="email" value="<?php echo isset($admin) ? $admin['email'] : ''; ?>" required><br>
                    <label for="phone">Enter Phone No:</label><br>
                    <input type="tel" id="phone" name="phone" value="<?php echo isset($admin) ? $admin['phone'] : ''; ?>" required><br>
                </div>
                <div class="form-group">
                    <label for="gender">Select Gender:</label><br>
                    <select name="gender" id="gender" required>
                        <option value="Male" <?php echo (isset($admin) && $admin['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo (isset($admin) && $admin['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select><br>
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" required><br>
                    <label for="ConfirmPassword">Confirm Password:</label><br>
                    <input type="password" id="ConfirmPassword" name="ConfirmPassword" required><br>
                    <input type="hidden" name="id" value="<?php echo isset($admin) ? $admin['id'] : ''; ?>">
                    <button type="submit" name="<?php echo isset($admin) ? 'update' : 'submit'; ?>">
                        <?php echo isset($admin) ? 'Update' : 'Submit'; ?>
                    </button>
                </div>
            </form>
        </div>
        <?php

        $view = "SELECT id, name, email, phone, password, gender FROM admin";
        $result = mysqli_query($conn, $view);

        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1' style='border: #000; background-color: #fff; text-align: center;'>";
            echo "<tr>
                    <th style='padding: 13px;'>Name</th>
                    <th style='padding: 13px;'>Phone</th>
                    <th style='padding: 13px;'>Gender</th>
                    <th style='padding: 13px;'>Email</th>
                    <th style='padding: 13px;'>Password</th>
                    <th style='padding: 13px;'>Actions</th>
                    </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td style='padding: 13px;'>" . $row['name'] . "</td>";
                echo "<td style='padding: 13px;'>" . $row['phone'] . "</td>";
                echo "<td style='padding: 13px;'>" . $row['gender'] . "</td>";
                echo "<td style='padding: 13px;'>" . $row['email'] . "</td>";
                echo "<td style='padding: 13px;'>" . $row['password'] . "</td>";
                echo "<td style='padding: 13px;'>
                <form method='post' action=''>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button class='btn_ed'  id='edit' type='submit' name='edit'>Edit</button>
                    <button class='btn_de' id='delete' type='submit' name='delete'>Delete</button>
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
    <script>
        document.getElementById("logout").addEventListener("click", function() {
            location.href = "../logout.php";
        });
    </script>
</body>

</html>