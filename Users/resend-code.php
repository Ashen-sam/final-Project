<?php
session_start();
require 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/PHPMailer.php';

function resend_email_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "userEmail";
    $mail->Password = "aaig wkbq ecih pfbv";
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";
    $mail->isHTML(true);
    $mail->setFrom("userEmail", $name);
    $mail->addAddress($email);
    $mail->Subject = "Resend - Email Verification from Lanka Railway Explorer";
    $mail->Body = 
        "<h2>You have registered with Lanka Railway Explorer</h2>
        <h4>Verify the email address to login with the below given link</h4>
        <br>
        <a href = 'verify-token.php' ?token=$verify_token>Click Me</a>";

    $mail->send();
}

if(isset($_POST['submit'])){
    if(empty($_POST['email']))
    {
        $_SESSION['status'] = "Enter the field!";
        header("Location: resend-email.php");
        exit(0);
    }
    else
    {
        $email = $_POST['email'];

        $checkemail_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $checkemail_query_run = mysqli_query($conn, $checkemail_query);
        
        if(mysqli_num_rows($checkemail_query_run) > 0)
        {
            $row = mysqli_fetch_array($checkemail_query_run);

            if($row['verify_status'] == "0")
            {
                $name = $row['name'];
                $email = $row['email'];
                $verify_token = $row['verify_token'];
                resend_email_verify($name, $email, $verify_token);
                $_SESSION['status'] = "Verification Link has been sent to your email!";
                header("Location: login.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Email already verified! Please login...";
                header("Location: resend-email.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Email is not registered! Please register again...";
            header("Location: register.php");
            exit(0);
        }
    }
}
?>
