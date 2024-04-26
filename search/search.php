<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="../search/styles.css" />
  <link rel="stylesheet" href="../homes/styles/home.css">
  <script src="../homes/header.js" defer></script>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>
<?php
include("../homes/includes/header.php");
?>
<style>
  * {
    margin: 0;
    padding: 0;
  }

  .search__container {
    background-color: #00ab93;
    padding: 1em;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  input {
    padding: 0.9rem;
  }

  input {
    width: 400px;
    height: 30px;
    padding: 0 1rem;
  }

  button {
    background-color: darkslateblue;
    color: white;
    font-size: 0.9rem;
  }


  .image_box {

    padding: 1rem;
    border: 1px solid lightgray;
    box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;

  }

  .image_box img {
    height: 300px;
    width: 300px;
    border-radius: 0.5rem;
    object-fit: cover;
  }

  .imagebox__container {
    width: 100%;
    height: auto;
  }

  .image__container--sub {
    display: flex;
    justify-content: center;
    gap: 2rem;
    padding: 4rem;
  }

  .sub-con {
    padding: 1rem;
    max-width: 200px;
    width: 100%;
    border-radius: 0.7rem;
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
  }

  .sub-con .trainstatus {
    padding: 0.4rem;
    background-color: lightblue;
    width: fit-content;
    border-radius: 5px;
  }
</style>

<body>
  <div class="search__container">
    <input style="padding: 1rem;" type="text" class="searchbox" placeholder="Search train..." />
    <button style="padding: 1rem;" onclick="search()">SEARCH</button>
  </div>

  <div class="imagebox__container">
    <div class="image__container--sub">
      <?php
      require '../Users/connection.php';

      $sql = "SELECT image, train, start_station, end_station, train_class, status FROM traindetails";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <form class="image_box">
          <!--<img src="../images/<?= $row['image'] ?>" alt="">-->
          <h1><?= $row['train'] ?></h1>
          <div class="sub-con">
            <h3>Destination:</h3>
            <h2 style="margin-bottom: 0.5rem;"><?= $row['start_station'] ?> to <?= $row['end_station'] ?></h2>
            <h3>Train Classes:</h3>
            <h4><?= $row['train_class'] ?></h4>
            <h4 class="trainstatus"><?= $row['status'] ?></h4>
          </div>
        </form>
      <?php
      }
      ?>
    </div>
  </div>
  <script src="../search/script.js"></script>
</body>

</html>
<?php
    include("../homes/includes/footer.php");
    ?>