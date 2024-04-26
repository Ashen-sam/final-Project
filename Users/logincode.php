<?php
session_start();
require 'connection.php';

if (isset($_POST['submit'])) {

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the user is an admin
        $login_query_admin = "SELECT * FROM admin WHERE email = '$email' AND password = '$password' LIMIT 1";
        $login_query_run_admin = mysqli_query($conn, $login_query_admin);

        if (mysqli_num_rows($login_query_run_admin) > 0) {
            $_SESSION['authenticated'] = TRUE;
            $_SESSION['admin'] = TRUE; // Flag to identify admin login
            $_SESSION['status'] = "You are logged in as admin!";
            header("Location: Admin/adminpanel.php"); // Redirect admin directly to dashboard.php
            exit(0);
        }

        // Check if the user is a regular user
        $login_query_user = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
        $login_query_run_user = mysqli_query($conn, $login_query_user);

        if (mysqli_num_rows($login_query_run_user) > 0) {
            $row_user = mysqli_fetch_array($login_query_run_user);

            if ($row_user['verify_status'] == "1") {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['admin'] = FALSE; // Flag to identify regular user login
                $_SESSION['auth_user'] = [
                    'username' => $row_user['name'],
                    'phone' => $row_user['phone'],
                    'email' => $row_user['email'],
                ];
                $_SESSION['status'] = "You are logged in successfully!";
                header("Location: dashboard.php");
                exit(0);
            } else {
                $_SESSION['status'] = "Please verify your Email Address to Login...";
                header("Location: login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = '<div style="background-color: red; color: white; padding: 10px;text-align:center">Invalid Email and Password!</div>';
            header("Location: login.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "All fields are Mandatory!";
        header("Location: login.php");
        exit(0);
    }
}
