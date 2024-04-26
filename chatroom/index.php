<?php
session_start();

if (isset($_GET['logout'])) {
  $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>" . htmlspecialchars($_SESSION['name']) . "</b> has left the chat session.</span><br></div>";
  file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
  session_destroy();
  header("Location: index.php");
  exit();
}

if (isset($_POST['enter'])) {
  if ($_POST['name'] != "") {
    $_SESSION['name'] = htmlspecialchars($_POST['name']);
  } else {
    echo '<script>alert("Please type in a name");</script>';
  }
}

function loginForm()
{
  echo
  '<div id="loginform"> 
        <p>Please enter your name to continue!</p> 
        <form action="index.php" method="post"> 
            <label for="name">Name:</label> 
            <input type="text" name="name" id="name" /> 
            <input type="submit" name="enter" id="enter" value="Enter" /> 
        </form> 
    </div>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Chat Application</title>
  <meta name="description" content="Tuts+ Chat Application" />
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../homes/styles/home.css">
  <script src="../homes/header.js" defer></script>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
  * {
    margin: 0;
    padding: 0;
  }

  body {
    margin: 20px auto;
    font-family: 'Inter';
  }

  form {
    padding: 15px 25px;
    display: flex;
    gap: 10px;
    justify-content: center;
  }

  form label {
    font-size: 1.5rem;
    font-weight: bold;
  }

  a {
    color: #0000ff;
    text-decoration: none;
  }

  #wrapper,
  #loginform {
    margin: 4rem auto;
    padding-bottom: 25px;
    background: #05ac90;
    width: 600px;
    max-width: 100%;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
    border-radius: 6px;
  }

  #loginform {
    padding-top: 18px;
    text-align: center;
  }

  #loginform p {
    padding: 15px 25px;
    font-size: 1.4rem;
    font-weight: bold;
  }

  #chatbox {
    text-align: left;
    margin: 0 auto;
    margin-bottom: 25px;
    padding: 10px;
    background: #fff;
    height: 300px;
    width: 530px;
    overflow: auto;
  }

  #name,
  #usermsg {
    padding: 0.5rem;
    border-radius: 4px;
    width: 100%;
  }

  #submitmsg,
  #enter {
    background: #ff9800;
    border: none;
    color: #000000;
    padding: 0.5rem;
    font-size: 1.1rem;
    border-radius: 1rem;
    font-weight: 600;
  }

  .error {
    color: #ff0000;
  }

  #menu {
    padding: 15px 25px;
    display: flex;
  }

  #menu p.welcome {
    flex: 1;
    font-weight: 600;
  }

  a#exit,
  a#delete {
    color: white;
    background: #c62828;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: bold;
  }

  .msgln {
    margin: 0.5rem;
  }

  .msgln span.left-info {
    color: orangered;
  }

  .msgln span.chat-time {
    color: #666;
    font-size: 60%;
    vertical-align: super;
  }

  .msgln b.user-name,
  .msgln b.user-name-left {
    font-weight: bold;
    background: #2a8cb9;
    border-radius: 1rem;
    color: rgb(0, 0, 0);
    padding: 2px 4px;
    font-size: 90%;
    border-radius: 4px;
    margin: 0 5px 0 0;
  }

  .msgln b.user-name-left {
    background: #ff0000;
  }
</style>

<body>
  <?php
  include("../homes/includes/header.php");
  ?>

  <?php if (!isset($_SESSION['name'])) {
    loginForm();
  } else { ?>
    <div id="wrapper">
      <div id="menu">
        <p class="welcome">Welcome, <b><?php echo htmlspecialchars($_SESSION['name']); ?></b></p>
        <p class="actions">
          <a id="delete" href="#">Delete Chats</a> |
          <a id="exit" href="#">Exit Chat</a>
        </p>
      <?php } ?>
      </div>
      <?php
      if (isset($_SESSION['name'])) {
      ?>
        <div id="chatbox">
          <?php
          if (file_exists("log.html") && filesize("log.html") > 0) {
            $contents = file_get_contents("log.html");
            echo htmlspecialchars($contents);
          }
          ?>
        </div>
        <form name="message" action="" onsubmit="return validateForm()">
          <input name="usermsg" type="text" id="usermsg" />
          <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
        </form>
      <?php } ?>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>

<?php
include("../homes/includes/footer.php");
?>