<?php
include("../homes/includes/header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Send Email</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="../homes/styles/home.css">
  <link rel="icon" type="image/x-icon" href="../homes/images/TECH.png">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script src="../homes/header.js" defer></script>
</head>

<body>

  <div class="main-box">
    <div class="container">
      <form action="sendEmail.php" method="post">
        <h2>Send an Email</h2>
        <label for="Name">Name</label>
        <input type="text" name="Name" id="name" placeholder="Enter Your Name...">
        <label for="Email">Email</label>
        <input type="email" name="Email" id="email" placeholder="Enter Your Email...">
        <label for="Subject">Subject</label>
        <input type="text" name="Subject" id="subject" placeholder="Enter Your Subject...">
        <label for="Message">Message</label>
        <textarea name="Message" id="message" cols="30" rows="10" placeholder="Enter Message..."></textarea>
        <button class="submit-btn" type="submit" name="submit" id="submit">Submit</button>
      </form>
    </div>
  </div>

  <?php
  include '../homes/includes/footer.php';
  ?>
</body>

</html>