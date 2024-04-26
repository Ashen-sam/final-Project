<?php
session_start();
require 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/PHPMailer.php';

function sendemail_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "userEmail";
    $mail->Password = "generated app password";
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";

    $mail->isHTML(true);
    $mail->setFrom("thiwankadissanayake42@gmail.com", $name);
    $mail->addAddress($email);
    $mail->Subject = "Email Verification from Lanka Railway Explorer";
    $mail->Body = 
        "<h2>You have registered with Lanka Railway Explorer</h2>
        <h4>Verify the email address to login with the below given link</h4>
        <br>
        <a href = http://localhost/train/Users/verify-token.php?token=$verify_token>Click Me</a>";

    $mail->send();
}

if(isset($_POST['submit'])){
    if(!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['password']))
    {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $verify_token = md5(rand());

        $check_email_query = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
        $check_email_query_run = mysqli_query($conn, $check_email_query);

        if(mysqli_num_rows($check_email_query_run) > 0)
        {
            $_SESSION['status'] = "Email ID has already exists!";
            header("Location: register.php");
            exit(0);
        }
        else
        {
            $query = "INSERT INTO users (name, email, phone, password, verify_token) 
            VALUES ('$name', '$email', '$phone', '$password', '$verify_token')";
            $sql = mysqli_query($conn, $query);

            if($sql)
            {
                sendemail_verify("$name", "$email", "$verify_token");
                $_SESSION['status'] = "Registration Successful! Please verify your email address...";
                header("Location: register.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Registration Failed!";
                header("Location: register.php");
                exit(0);
            }
        }
    }
    else
    {
        $_SESSION['status'] = "All fields are Mandetory!";
        header("Location: register.php");
        exit(0);
    }
}

?>
