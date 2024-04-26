<?php
require 'connection.php';
session_start();



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/PHPMailer.php';

$mail = new PHPMailer(true);

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
    $passenger = filter_var($_POST['passenger'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['Phone'], FILTER_SANITIZE_NUMBER_INT);
    $setLoc = filter_var($_POST['setLoc'], FILTER_SANITIZE_STRING);
    $arrLoc = filter_var($_POST['arrLoc'], FILTER_SANITIZE_STRING);
    $bookingDate = $_POST['startdate'];
    $returnDate = isset($_POST['returndate']) && $_POST['returndate'] !== '' ? $_POST['returndate'] : NULL;
    $trainClass = filter_var($_POST['trainClass'], FILTER_SANITIZE_STRING);
    $people = filter_var($_POST['People'], FILTER_SANITIZE_NUMBER_INT);

    $pattern = "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

    if (
        empty($passenger) || empty($email) || empty($phone) ||
        empty($setLoc) || empty($arrLoc) || empty($bookingDate) ||
        empty($people) || empty($trainClass)
    ) {
        $error_message = 'Please fill all the required fields!';
    } elseif (!preg_match("/^[a-zA-Z\s]*$/", $passenger)) {
        $error_message = 'Only alphabets and whitespace are allowed for the passenger name!';
    } elseif (!preg_match($pattern, $email)) {
        $error_message = 'Invalid Email Format!';
    } elseif (!preg_match("/^[0-9]*$/", $phone)) {
        $error_message = 'Only numeric value is allowed for the phone number!';
    } elseif (!preg_match("/^[0-9]*$/", $people)) {
        $error_message = 'Only numeric value is allowed for the number of passengers!';
    } else {
        $sql = "INSERT INTO bookingdata (passenger, Email, Phone, setLoc, arrLoc, startdate, returndate, trainClass, People)
                VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssisssssi", $passenger, $email, $phone, $setLoc, $arrLoc, $bookingDate, $returnDate, $trainClass, $people);
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            die('Could not enter data: ' . mysqli_error($conn));
        } else {
            $totalPrice = calculateTotalPrice($trainClass, $people);

            try {
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "userEmail";
                $mail->Password = "aaig wkbq ecih pfbv";
                $mail->Port = 587;
                $mail->SMTPSecure = "tls";

                $mail->isHTML(true);
                $mail->setFrom("thiwankadissanayake42@gmail.com", "Thiwanka Dissanayake");
                $mail->addAddress($email, $passenger);
                $mail->Subject = 'New Booking: ' . $passenger;
                $mail->Body = 'Name: ' . $passenger . '<br>Email: ' . $email . '<br>Phone No: ' . $phone . '<br><br>Travel Location: ' . $setLoc . ' to ' . $arrLoc . '<br>Date: ' . $bookingDate . '<br>Return Date: ' . $returnDate . '<br><br>Train Class: ' . $trainClass . '<br>No of People: ' . $people . '<br>Total Price: ' . $totalPrice;

                $mail->send();

                $success_message = 'Your Booking Was Successful!';
                header('Location: confirmation.php?id=' . $conn->insert_id);
                exit;
            } catch (Exception $e) {
                $error_message = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
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
    <title>Ticket Booking</title>
    <link rel="icon" type="image/x-icon" href="../homes/images/TECH.png">

    <link rel="stylesheet" href="../homes/styles/home.css">
    <link rel="stylesheet" href="../homes/styles/book.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="header.js" defer></script>
</head>

<body>
    <div style="width: auto;background-color:grey; " id="google_translate_element">
    </div>
    <?php
    include("includes/header.php");
    ?>

    <div class="main">
        <?php if (isset($error_message)) : ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)) : ?>
            <p class="success-message"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <div class="container">

            <div class="form-box">
                <form action="../homes/book.php" method="post">
                    <div style="margin-bottom: 1.6rem;" class="topic">
                        <h1>Book Your Seat</h1>
                    </div>
                    <input type="text" name="passenger" id="name" autocomplete="off" placeholder="Enter Your Name:">
                    <input type="text" name="Email" id="email" autocomplete="off" placeholder="Enter Your Email:">
                    <input type="number" name="Phone" id="phone" autocomplete="off" placeholder="Enter Your Phone No:">
                    <div class="loc">
                        <div class="item">
                            <label for="SetLoc">Set From:</label>
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
                            <label for="ArrLoc">Arrive To:</label>
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
                    <div class="laptop-pc">
                        <div class="loc">
                            <div class="item">
                                <label class="date-lab" for="date">Select date:</label>
                                <input type="date" name="startdate" id="date">
                            </div>
                            <div class="item-1" id="returnDateContainer" style="display:none;">
                                <label for="Returndate">Select Return date:</label>
                                <input type="date" name="returndate" id="Returndate">
                            </div>
                        </div>
                        <button type="button" onclick="toggleToodle()" id="toodleButton">One Way</button>
                        <div class="loc">
                            <div class="item">
                                <label for="TrainClass">Select Class:</label>
                                <select name="trainClass" id="TrainClass">
                                    <option value="Choose Train Option">Choose Train Option</option>
                                    <option value="First Class">First Class</option>
                                    <option value="Second Class">Second Class</option>
                                    <option value="Third Class">Third Class</option>
                                </select>
                            </div>
                            <div class="item">
                                <input type="number" name="People" id="people" autocomplete="off" placeholder="No. of Passengers:">
                            </div>
                        </div>
                        <button id="proceed" type="submit" name="submit">Proceed</button>
                    </div>
                </form>
            </div>
            <div class="form-box-1">
                <!-- <h1 style="margin-bottom:1rem">Our Services</h1> -->

                <div class="form-box-sub-2">

                    <div class="form-sub-box">
                        <ul>
                            <h2>
                                <li>Colombo Fort - Beliatta</li>
                            </h2>
                            <li>Intercity & Express trains</li>
                            <li>Available class types : 1st ,2nd and 3rd</li>
                        </ul>
                    </div>
                    <div class="form-sub-box">
                        <ul>
                            <h2>
                                <li>Colombo Fort - Jaffna</li>
                            </h2>
                            <li>Intercity, Express & Night mail trains</li>
                            <li>Available class types : 1st ,2nd and 3rd</li>
                        </ul>
                    </div>
                    <div class="form-sub-box">
                        <ul>
                            <h2>
                                <li>Colombo Fort - Kandy</li>
                            </h2>
                            <li>Intercity & Express trains</li>
                            <li>Available class types : 1st ,2nd, 3rd and observations saloon</li>
                        </ul>
                    </div>
                    <div class="form-sub-box">
                        <ul>
                            <h2>
                                <li>Colombo Fort - Trincomalee</li>
                            </h2>
                            <li>Night mail train</li>
                            <li>Available class types : 2nd and 3rd</li>
                        </ul>
                    </div>
                    <div class="form-sub-box">
                        <ul>
                            <h2>
                                <li>Colombo Fort - Batticaloaa</li>
                            </h2>
                            <li>Intercity, Express & Night mail trains</li>
                            <li>Available class types : 1st ,2nd and 3rd</li>
                        </ul>
                    </div>

                    <div class="form-sub-box">
                        <ul>
                            <h2>
                                <li>Colombo Fort - Kelaniya</li>
                            </h2>
                            <li>Intercity & Express trains</li>
                            <li>Available class types : 1st ,2nd and 3rd</li>
                        </ul>
                    </div>
                    <div class="form-sub-box">
                        <ul>
                            <h2>
                                <li>Kandy - Badulla</li>
                            </h2>
                            <li>Slow train</li>
                            <li>AAvailable class types : Observations saloon</li>
                        </ul>
                    </div>
                    <div class="form-sub-box">
                        <ul>
                            <h2>
                                <li>Colombo Fort - Talaimannar</li>
                            </h2>
                            <li>Night mail train</li>
                            <li>Available class types : 2nd class</li>
                        </ul>
                    </div>
                    <div class="form-sub-box">
                        <ul>
                            <h2>
                                <li>Colombo Fort - Beliatta</li>
                            </h2>
                            <li>Intercity & Express trains</li>
                            <li>Available class types : 1st ,2nd and 3rd</li>
                        </ul>
                    </div>




                </div>
            </div>
        </div>

        <?php
        include("includes/footer.php");
        ?>

        <script src="script.js"></script>
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en'
                }, 'google_translate_element');
            }
        </script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <!--Script End-->
        <script src="script.js"></script>
</body>

</html>
