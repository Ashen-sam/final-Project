<?php
require '../connection.php';
session_start();
if (!isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "Please login to access the User Dashboard!";
    header("Location: ../login.php");
    exit(0);
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

if (isset($_POST['submit'])) {
    $setLoc = filter_var($_POST['setLoc'], FILTER_SANITIZE_STRING);
    $arrLoc = filter_var($_POST['arrLoc'], FILTER_SANITIZE_STRING);
    $bookingDate = $_POST['startdate'];
    $returnDate = isset($_POST['returndate']) && $_POST['returndate'] !== '' ? $_POST['returndate'] : NULL;
    $trainClass = filter_var($_POST['trainClass'], FILTER_SANITIZE_STRING);
    $people = filter_var($_POST['People'], FILTER_SANITIZE_NUMBER_INT);

    if (
        empty($setLoc) || empty($arrLoc) || empty($bookingDate) ||
        empty($people) || empty($trainClass)
    ) {
        $error_message = '<div style="background-color: red; color: white; padding: 10px;text-align:center">Please fill all the required fields!</div>';
    } elseif (!preg_match("/^[0-9]*$/", $people)) {
        $error_message = '<div style="background-color: red; color: white; padding: 10px;text-align:center">Only numeric value is allowed for the number of passengers!</div> ';
    } else {
        $sql = "INSERT INTO bookingdata (setLoc, arrLoc, startdate, returndate, trainClass, People)
                VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $setLoc, $arrLoc, $bookingDate, $returnDate, $trainClass, $people);
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            die('Could not enter data: ' . mysqli_error($conn));
        } else {
            $_SESSION['setLoc'] = $setLoc;
            $_SESSION['arrLoc'] = $arrLoc;
            $_SESSION['bookingDate'] = $bookingDate;
            $_SESSION['returnDate'] = $returnDate;
            $_SESSION['trainClass'] = $trainClass;
            $_SESSION['people'] = $people;
            // Validation successful, redirect to train availability page
            header('Location: ../trainAvailability/trainAvailability.php');
            exit;
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="booking.css">
</head>

<body>
    <div class="container">
        <?php if (isset($error_message)) : ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="booking.php" method="post">
            <div class="loc">
                <div class="item">
                    <label for="SetLoc">Set From:</label><br>
                    <select name="setLoc" id="SetLoc">
                        <option value="Choose Station">Choose Station</option>
                        <option value="Ahangama">Ahangama</option>
                        <option value="Aluthgama">Aluthgama</option>
                        <option value="Ambalangoda">Ambalangoda</option>
                        <option value="Ambewela">Ambewela</option>
                        <option value="Angulana">Angulana</option>
                        <option value="Anuradhapura">Anuradhapura</option>
                        <option value="Avissawela">Avissawela</option>
                        <option value="Badulla">Badulla</option>
                        <option value="Balapitiya">Balapitiya</option>
                        <option value="Bambalapitiya">Bambalapitiya</option>
                        <option value="Bandarawela">Bandarawela</option>
                        <option value="Bangadeniya">Bangadeniya</option>
                        <option value="Batticaloa">Batticaloa</option>
                        <option value="Beruwala">Beruwala</option>
                        <option value="Chilaw">Chilaw</option>
                        <option value="Colombo">Colombo</option>
                        <option value="China Bay">China Bay</option>
                        <option value="Dehiwala">Dehiwala</option>
                        <option value="Demodera">Demodera</option>
                        <option value="Diyatalawa">Diyatalawa</option>
                        <option value="Dodanduwa">Dodanduwa</option>
                        <option value="Galgamuwa">Galgamuwa</option>
                        <option value="Galle">Galle</option>
                        <option value="Galoya">Galoya</option>
                        <option value="Gampaha">Gampaha</option>
                        <option value="Ganemulla">Ganemulla</option>
                        <option value="Gintota">Gintota</option>
                        <option value="Haliela">Haliela</option>
                        <option value="Haputale">Haputale</option>
                        <option value="Hatton">Hatton</option>
                        <option value="Hingurakgoda">Hingurakgoda</option>
                        <option value="Homagama">Homagama</option>
                        <option value="Hunupitiya">Hunupitiya</option>
                        <option value="Induwara">Induwara</option>
                        <option value="Inguruoya">Inguruoya</option>
                        <option value="Ja-Ela">Ja-Ela</option>
                        <option value="Kadugannawa">Kadugannawa</option>
                        <option value="Kahawe">Kahawe</option>
                        <option value="Kaluthara South">Kaluthara South</option>
                        <option value="Kaluthara North">Kaluthara North</option>
                        <option value="Kamburugamuwa">Kamburugamuwa</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Kantalai">Kantalai</option>
                        <option value="Katugastota">Katugastota</option>
                        <option value="Katunayake">Katunayake</option>
                        <option value="Kelaniya">Kelaniya</option>
                        <option value="Kollupitiya">Kollupitiya</option>
                        <option value="Kollonnawa">Kollonnawa</option>
                        <option value="Kompannaveediya">Kompannaveediya</option>
                        <option value="Kosgoda">Kosgoda</option>
                        <option value="Kottawa">Kottawa</option>
                        <option value="Kurunegala">Kurunegala</option>
                        <option value="Lunuwila">Lunuwila</option>
                        <option value="Maho">Maho</option>
                        <option value="Matale">Matale</option>
                        <option value="Matara">Matara</option>
                        <option value="Medawachchiya">Medawachchiya</option>
                        <option value="Meerigama">Meerigama</option>
                        <option value="Mihintale">Mihintale</option>
                        <option value="Moratuwa">Moratuwa</option>
                        <option value="Mt Lavinia">Mt Lavinia</option>
                        <option value="Nanuoya">Nanuoya</option>
                        <option value="Narahenpita">Narahenpita</option>
                        <option value="Nattandiya">Nattandiya</option>
                        <option value="Nawalapitiya">Nawalapitiya</option>
                        <option value="Negombo">Negombo</option>
                        <option value="Nugegoda">Nugegoda</option>
                        <option value="Nuwara Eliya">Nuwara Eliya</option>
                        <option value="Padukka">Padukka</option>
                        <option value="Pallewela">Pallewela</option>
                        <option value="Panadura">Panadura</option>
                        <option value="Payagala">Payagala</option>
                        <option value="Peradeniya">Peradeniya</option>
                        <option value="Polgahawela">Polgahawela</option>
                        <option value="Puttalam">Puttalam</option>
                        <option value="Ragama">Ragama</option>
                        <option value="Rambukkana">Rambukkana</option>
                        <option value="Ratmalana">Ratmalana</option>
                        <option value="Rozella">Rozella</option>
                        <option value="Sarasavi Uyana">Sarasavi Uyana</option>
                        <option value="Seeduwa">Seeduwa</option>
                        <option value="Talawakele">Talawakele</option>
                        <option value="Trincomalee">Trincomalee</option>
                        <option value="Ukuwela">Ukuwela</option>
                        <option value="Ulapane">Ulapane</option>
                        <option value="Vauniya">Vauniya</option>
                        <option value="Veyangoda">Veyangoda</option>
                        <option value="Waga">Waga</option>
                        <option value="Watawala">Watawala</option>
                        <option value="Wattegama">Wattegama</option>
                        <option value="Weligama">Weligama</option>
                        <option value="Wellawatte">Wellawatte</option>
                    </select><br>
                </div>
                <div class="item">
                    <label for="ArrLoc">Arrive To:</label><br>
                    <select name="arrLoc" id="ArrLoc">
                        <option value="Choose Station">Choose Station</option>
                        <option value="Ahangama">Ahangama</option>
                        <option value="Aluthgama">Aluthgama</option>
                        <option value="Ambalangoda">Ambalangoda</option>
                        <option value="Ambewela">Ambewela</option>
                        <option value="Angulana">Angulana</option>
                        <option value="Anuradhapura">Anuradhapura</option>
                        <option value="Avissawela">Avissawela</option>
                        <option value="Badulla">Badulla</option>
                        <option value="Balapitiya">Balapitiya</option>
                        <option value="Bambalapitiya">Bambalapitiya</option>
                        <option value="Bandarawela">Bandarawela</option>
                        <option value="Bangadeniya">Bangadeniya</option>
                        <option value="Batticaloa">Batticaloa</option>
                        <option value="Beruwala">Beruwala</option>
                        <option value="Chilaw">Chilaw</option>
                        <option value="Colombo">Colombo</option>
                        <option value="China Bay">China Bay</option>
                        <option value="Dehiwala">Dehiwala</option>
                        <option value="Demodera">Demodera</option>
                        <option value="Diyatalawa">Diyatalawa</option>
                        <option value="Dodanduwa">Dodanduwa</option>
                        <option value="Galgamuwa">Galgamuwa</option>
                        <option value="Galle">Galle</option>
                        <option value="Galoya">Galoya</option>
                        <option value="Gampaha">Gampaha</option>
                        <option value="Ganemulla">Ganemulla</option>
                        <option value="Gintota">Gintota</option>
                        <option value="Haliela">Haliela</option>
                        <option value="Haputale">Haputale</option>
                        <option value="Hatton">Hatton</option>
                        <option value="Hingurakgoda">Hingurakgoda</option>
                        <option value="Homagama">Homagama</option>
                        <option value="Hunupitiya">Hunupitiya</option>
                        <option value="Induwara">Induwara</option>
                        <option value="Inguruoya">Inguruoya</option>
                        <option value="Ja-Ela">Ja-Ela</option>
                        <option value="Kadugannawa">Kadugannawa</option>
                        <option value="Kahawe">Kahawe</option>
                        <option value="Kaluthara South">Kaluthara South</option>
                        <option value="Kaluthara North">Kaluthara North</option>
                        <option value="Kamburugamuwa">Kamburugamuwa</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Kantalai">Kantalai</option>
                        <option value="Katugastota">Katugastota</option>
                        <option value="Katunayake">Katunayake</option>
                        <option value="Kelaniya">Kelaniya</option>
                        <option value="Kollupitiya">Kollupitiya</option>
                        <option value="Kollonnawa">Kollonnawa</option>
                        <option value="Kompannaveediya">Kompannaveediya</option>
                        <option value="Kosgoda">Kosgoda</option>
                        <option value="Kottawa">Kottawa</option>
                        <option value="Kurunegala">Kurunegala</option>
                        <option value="Lunuwila">Lunuwila</option>
                        <option value="Maho">Maho</option>
                        <option value="Matale">Matale</option>
                        <option value="Matara">Matara</option>
                        <option value="Medawachchiya">Medawachchiya</option>
                        <option value="Meerigama">Meerigama</option>
                        <option value="Mihintale">Mihintale</option>
                        <option value="Moratuwa">Moratuwa</option>
                        <option value="Mt Lavinia">Mt Lavinia</option>
                        <option value="Nanuoya">Nanuoya</option>
                        <option value="Narahenpita">Narahenpita</option>
                        <option value="Nattandiya">Nattandiya</option>
                        <option value="Nawalapitiya">Nawalapitiya</option>
                        <option value="Negombo">Negombo</option>
                        <option value="Nugegoda">Nugegoda</option>
                        <option value="Nuwara Eliya">Nuwara Eliya</option>
                        <option value="Padukka">Padukka</option>
                        <option value="Pallewela">Pallewela</option>
                        <option value="Panadura">Panadura</option>
                        <option value="Payagala">Payagala</option>
                        <option value="Peradeniya">Peradeniya</option>
                        <option value="Polgahawela">Polgahawela</option>
                        <option value="Puttalam">Puttalam</option>
                        <option value="Ragama">Ragama</option>
                        <option value="Rambukkana">Rambukkana</option>
                        <option value="Ratmalana">Ratmalana</option>
                        <option value="Rozella">Rozella</option>
                        <option value="Sarasavi Uyana">Sarasavi Uyana</option>
                        <option value="Seeduwa">Seeduwa</option>
                        <option value="Talawakele">Talawakele</option>
                        <option value="Trincomalee">Trincomalee</option>
                        <option value="Ukuwela">Ukuwela</option>
                        <option value="Ulapane">Ulapane</option>
                        <option value="Vauniya">Vauniya</option>
                        <option value="Veyangoda">Veyangoda</option>
                        <option value="Waga">Waga</option>
                        <option value="Watawala">Watawala</option>
                        <option value="Wattegama">Wattegama</option>
                        <option value="Weligama">Weligama</option>
                        <option value="Wellawatte">Wellawatte</option>
                    </select><br>
                </div>
            </div>
            <div class="loc">
                <div class="item">
                    <label for="date">Select date:</label><br>
                    <input type="date" name="startdate" id="date"><br><br>
                </div>
                <div class="item" id="returnDateContainer" style="display:none;">
                    <label for="Returndate">Select Return date:</label><br>
                    <input type="date" name="returndate" id="Returndate"><br><br>
                </div>
            </div>
            <button type="button" onclick="toggleToodle()" id="toodleButton">One Way</button><br><br>
            <div class="loc">
                <div class="item">
                    <label for="TrainClass">Select Class:</label><br>
                    <select name="trainClass" id="TrainClass">
                        <option value="Choose Train Option">Choose Train Option</option>
                        <option value="First Class">First Class</option>
                        <option value="Second Class">Second Class</option>
                        <option value="Third Class">Third Class</option>
                    </select>
                </div>
                <div class="item">
                    <label for="People">No. of Passengers:</label><br>
                    <input type="number" name="People" id="people" autocomplete="off"><br><br>
                </div>
            </div>
            <button type="submit" name="submit">Proceed</button>
        </form>
    </div>
    <script src="../script.js"></script>
</body>

</html>