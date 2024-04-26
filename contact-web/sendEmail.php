<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body>


    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once 'PHPMailer/Exception.php';
    require_once 'PHPMailer/SMTP.php';
    require_once 'PHPMailer/PHPMailer.php';

    $mail = new PHPMailer(true);

    if (isset($_POST['submit'])) {
        $name = filter_input(INPUT_POST, 'Name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
        $subject = filter_input(INPUT_POST, 'Subject', FILTER_SANITIZE_STRING);
        $message = filter_input(INPUT_POST, 'Message', FILTER_SANITIZE_STRING);

        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            echo "<script>Swal.fire({
            title: 'Warning',
            text: 'All fields are required. Please fill in all the fields.',
            icon: 'warning',
            confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'index.php';
            }
          });
          ;</script>";
        } else {
            try {
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "thiwankadissanayake42@gmail.com";
                $mail->Password = "aaig wkbq ecih pfbv";
                $mail->Port = 465;
                $mail->SMTPSecure = "ssl";

                $mail->isHTML(true);
                $mail->setFrom($email, $name);
                $mail->addAddress("thiwankadissanayake42@gmail.com");
                $mail->Subject = $subject;
                $mail->Body    = 'Name: ' . $name . '<br>Email: ' . $email . '<br>Message: ' . $message;

                $mail->send();

                echo "<script>Swal.fire({
                title: 'Success',
                text: 'Message has been sent Successfully',
                icon: 'success',
                confirmButtonText: 'OK'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = 'index.php';
                }
              });
              ;</script>";
            } catch (Exception $e) {
                // echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}'); window.location.href = 'index.php';</script>";
                echo "<script>Swal.fire({
                title: 'Warning',
                text: 'Message could not be sent. Mailer Error: {$mail->ErrorInfo}'',
                icon: 'error',
                confirmButtonText: 'OK'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = 'index.php';
                }
              });
              ;</script>";
            }
        }
    }



    ?>


</body>

</html>