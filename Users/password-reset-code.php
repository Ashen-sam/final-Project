<?php
require 'connection.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/PHPMailer.php';

function send_pw_reset($getname, $getemail, $token)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "thiwankadissanayake42@gmail.com";
    $mail->Password = "aaig wkbq ecih pfbv";
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";

    $mail->isHTML(true);
    $mail->setFrom("thiwankadissanayake42@gmail.com", $getname);
    $mail->addAddress($getemail);
    $mail->Subject = "Password Reset Link from Lanka Railway Explorer";
    $mail->Body = 
        "<h2>You have registered with Lanka Railway Explorer</h2>
        <h4>Verify the email address to login with the below given link</h4>
        <br>
        <a href = http://localhost/train/Users/password-change.php?token=$token&email=$getemail>Click Me</a>";

    $mail->send();
}

if(isset($_POST['submit']))
{
    if(!empty($_POST['email']))
    {
        $email = $_POST['email'];
        $token = md5(rand());

        $check_email = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
        $check_email_run = mysqli_query($conn, $check_email);

        if(mysqli_num_rows($check_email_run) > 0)
        {
            $row = mysqli_fetch_array($check_email_run);
            $getname = $row['name'];
            $getemail = $row['email'];

            $update_token = "UPDATE users SET verify_token = '$token' WHERE email = '$getemail' LIMIT 1";
            $update_token_run = mysqli_query($conn, $update_token);

            if($update_token_run)
            {
                send_pw_reset($getname, $getemail, $token);
                $_SESSION['status'] = "Password Reset Link is sent to your email!";
                header("Location: password-reset.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Something went wrong!";
                header("Location: password-reset.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "No Email Found!";
            header("Location: password-reset.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "Enter the field!";
        header("Location: register.php");
        exit(0);
    }
}

if(isset($_POST['reset-pw']))
{
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
        $new_pass = $_POST['new-password'];
        $confirm_pass = $_POST['confirm-password'];
        $token = $_POST['password_token'];

        if(!empty($token))
        {
            if(!empty($email) && !empty($new_pass) && !empty($confirm_pass))
            {
                $check_token = "SELECT verify_token FROM users WHERE verify_token = '$token' LIMIT 1";
                $check_token_run = mysqli_query($conn, $check_token);

                if(mysqli_num_rows($check_token_run) > 0)
                {
                    if($new_pass == $confirm_pass)
                    {
                        $update_pass = "UPDATE users SET password = '$new_pass' WHERE verify_token = '$token' LIMIT 1";
                        $update_pass_run = mysqli_query($conn, $update_pass);

                        if($update_pass_run)
                        {
                            $new_token = md5(rand())."funda";

                            $update_new_token = "UPDATE users SET verify_token = '$new_token' WHERE verify_token = '$token' LIMIT 1";
                            $update_new_token_run = mysqli_query($conn, $update_new_token);

                            $_SESSION['status'] = "New Password Successfully Updated!";
                            header("Location: login.php");
                            exit(0);
                        }
                        else
                        {
                            $_SESSION['status'] = "Coundn't Update the Password! Something went wrong...";
                            header("Location: password-change.php?token=$token&email-$email");
                            exit(0);
                        }
                    }
                    else
                    {
                        $_SESSION['status'] = "New Password and Confirm Password do not match!";
                        header("Location: password-change.php?token=$token&email-$email");
                        exit(0);
                    }
                }
                else
                {
                    $_SESSION['status'] = "Invalid Token!";
                    header("Location: password-change.php?token=$token&email-$email");
                    exit(0);
                }
            }
            else
            {
                $_SESSION['status'] = "All Fields are Mandetory!";
                header("Location: password-change.php?token=$token&email-$email");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "No Token Available!";
            header("Location: password-change.php");
            exit(0);
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