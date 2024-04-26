<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="../search/styles.css" />
</head>
<body>
  <div class="search__container">
    <input type="text" class="searchbox" placeholder="Search train..." />
    <button onclick="search()">SEARCH</button>
  </div>

  <div class="imagebox__container">
    <div class="image__container--sub">
      <?php
      require '../connection.php';

      $sql = "SELECT image, train, start_station, end_station, train_class, status FROM traindetails";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <form class="image_box">
        <img src="../images/<?= $row['image'] ?>" alt="">         
        <h1><?= $row['train'] ?></h1>
        <div class="sub-con">
          <h3>Destination:</h3>
          <h2><?= $row['start_station'] ?> to <?= $row['end_station'] ?></h2>
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
