<?php
require '../connection.php';
session_start();

if (!isset($_SESSION['selected_train'])) {
    echo "No train selected.";
    exit;
}

function calculateTotalPrice($trainClass, $people)
{
    $pricePerPerson = 0;

    switch ($trainClass) {
        case 'First Class':
            $pricePerPerson = 1200;
            break;
        case 'Second Class':
            $pricePerPerson = 800;
            break;
        case 'Third Class':
            $pricePerPerson = 500;
            break;
    }

    $totalPrice = $pricePerPerson * $people;
    return $totalPrice;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="con">
            <h1>Booking Confirmation</h1>
            <h3>Please take a picture of this confirmation page to inform the railway 
                station to confirm your booking!</h3>
            <h2>Booking Details</h2>
            <p><b>Set Location</b> : <?php echo isset($_SESSION['setLoc']) ? $_SESSION['setLoc'] : 'Location'; ?></p>
            <p><b>Arrival Location</b> : <?php echo isset($_SESSION['arrLoc']) ? $_SESSION['arrLoc'] : 'Location'; ?></p>
            <p><b>Date</b> : <?php echo isset($_SESSION['bookingDate']) ? $_SESSION['bookingDate'] : 'Date'; ?></p>
            <p><b>Return date</b> : <?php echo isset($_SESSION['returnDate']) ? $_SESSION['returnDate'] : 'Date'; ?></p>
            <p><b>Train class</b> : <?php echo isset($_SESSION['trainClass']) ? $_SESSION['trainClass'] : 'trainClass'; ?></p>
            <p><b>No of People</b> : <?php echo isset($_SESSION['people']) ? $_SESSION['people'] : 'people'; ?></p>
            <h2>Train Details</h2>
            <?php
            $selectedTrainName = $_SESSION['selected_train'];

            $sql = "SELECT * FROM traindetails WHERE train = ?";
            $stmt = mysqli_prepare($conn, $sql);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $selectedTrainName);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $trainDetails = mysqli_fetch_assoc($result);

                if ($trainDetails) {
                    echo "<p><b>Train name</b> : " . $trainDetails['train'] . "</p>";
                    echo "<p><b>Train price</b> : Rs " . $trainDetails['price'] . "</p>";
                    echo "<p><b>Distance</b> : " . $trainDetails['seats'] . " km</p>";
                    echo "<p><b>Time taken</b> : " . $trainDetails['datetime'] . " hr(s)</p>";
                    echo "<p><b>Train status</b> : " . $trainDetails['status'] . "</p>";
                } else {
                    echo "<p>No train details found for the selected train.</p>";
                }
            } else {
                echo "<p>Error: Unable to prepare statement.</p>";
            }
            mysqli_stmt_close($stmt);
            ?>
            <h2>Overall Price</h2>
            <p><b>Total price</b> : Rs <?php echo isset($_SESSION['people']) ? calculateTotalPrice($_SESSION['trainClass'], $_SESSION['people']) + $trainDetails['price'] : ''; ?></p>
            </br>
            <button id="confirmBookingBtn">Confirm Booking</button>
        </div>
    </div>
    <script src="../script.js"></script>
</body>
</html>
