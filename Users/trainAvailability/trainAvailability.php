<?php
require '../connection.php';
session_start();

if (isset($_POST['selected_train'])) {
    $_SESSION['selected_train'] = $_POST['selected_train'];
    header('Location: confirmation.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Availability</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="contain">
            <div class="book">
                <label for="">Set Location : <?php echo isset($_SESSION['setLoc']) ? $_SESSION['setLoc'] : 'Location'; ?></label>
                <label for="">Arrival Location : <?php echo isset($_SESSION['arrLoc']) ? $_SESSION['arrLoc'] : 'Location'; ?></label>
                <label for="">No of People : <?php echo isset($_SESSION['people']) ? $_SESSION['people'] : '0'; ?></label>
            </div>
            <div class="boxContainer">
                <?php
                $setLoc = isset($_SESSION['setLoc']) ? $_SESSION['setLoc'] : '';
                $arrLoc = isset($_SESSION['arrLoc']) ? $_SESSION['arrLoc'] : '';

                $sql = "SELECT image, train, datetime, start_station, end_station, train_class, status, seats, price FROM traindetails WHERE start_station = '$setLoc' AND end_station = '$arrLoc'";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="box">
                        <div class="box-image">
                            <img src="../images/train.png" alt="">
                        </div>
                        <div class="boxContain">
                            <h2><?= $row['train'] ?></h2>
                            </br>
                            <p>
                            <h3><?= $row['start_station'] ?></h3> to <h3><?= $row['end_station'] ?></h3>
                            </p>
                            </br>
                            <h4>Distance : <?= $row['seats'] ?>km</h4>
                            <h4>Available from : <?= $row['datetime'] ?>hr(s)</h4>
                            <h4>Status : <?= $row['status'] ?></h4>
                        </div>

                    </div>
                    <form action="trainAvailability.php" method="post">
                        <input type="hidden" name="selected_train" value="<?= $row['train'] ?>">
                        <button style="background-color: #00ab93; width:100%;color:white;padding:0.4rem;border-radius:4px;border:none;font-size:1.2rem" type="submit">Book Now</button>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>