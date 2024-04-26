<?php
require '../connection.php';

if (isset($_POST['submit'])) {
    $image = $_FILES['image']['name'];
    $train = $_POST['train'];
    $datetime = $_POST['datetime'];
    $start_station = $_POST['start_station'];
    $end_station = $_POST['end_station'];
    $train_class = isset($_POST['train_class']) ? implode(',', $_POST['train_class']) : '';
    $status = $_POST['status'];
    $seats = $_POST['seats'];
    $price = $_POST['price'];

    $datetime_rt = date('Y-m-d H:i:s', strtotime($datetime));

    if (empty($image) || empty($train) || empty($datetime) || empty($start_station) || empty($end_station) || empty($train_class) || empty($status) || empty($seats) || empty($price)) {
        $errorMessage = "All fields are mandatory!";
    } else {
        $target_directory = "../images/";
        $image_file = $target_directory . $image;

        move_uploaded_file($_FILES['image']['tmp_name'], $image_file);

        $query = "INSERT INTO traindetails (image, train, datetime, start_station, end_station, train_class, status, seats, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssssii", $image, $train, $datetime_rt, $start_station, $end_station, $train_class, $status, $seats, $price);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Train details added successfully');</script>";
            } else {
                echo "<script>alert('Failed to add train details');</script>";
            }
        } else {
            echo "<script>alert('Error: Unable to prepare statement');</script>";
        }
        mysqli_stmt_close($stmt);
    }
}

if (isset($_POST['delete'])) {
    $Id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    $deleteQuery = "DELETE FROM traindetails WHERE id = $Id";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        echo "<script>alert('Train Info deleted successfully');</script>";
    } else {
        echo "<script>alert('Failed to delete Train Info');</script>";
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM traindetails WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $admin = mysqli_fetch_assoc($result);
    }
    mysqli_stmt_close($stmt);
}

if (isset($_POST['update'])) {
    if (empty($_POST['train']) || empty($_POST['datetime']) || empty($_POST['start_station']) || empty($_POST['end_station']) || empty($_POST['train_class']) || empty($_POST['status']) || empty($_POST['seats']) || empty($_POST['price'])) {
        $errorMessage = "All fields are mandatory!";
    } else {
        $id = $_POST['id'];
        $train = $_POST['train'];
        $datetime = $_POST['datetime'];
        $start_station = $_POST['start_station'];
        $end_station = $_POST['end_station'];
        $train_class = isset($_POST['train_class']) ? implode(',', $_POST['train_class']) : '';
        $status = $_POST['status'];
        $seats = $_POST['seats'];
        $price = $_POST['price'];

        $datetime_rt = date('Y-m-d H:i:s', strtotime($datetime));

        $image = $_FILES['image']['name'];
        $target_directory = "../images/";
        $image_file = $target_directory . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $image_file);

        $query = "UPDATE traindetails SET image = ?, train = ?, datetime = ?, start_station = ?, end_station = ?, train_class = ?, status = ?, seats = ?, price = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssssiii", $image, $train, $datetime_rt, $start_station, $end_station, $train_class, $status, $seats, $price, $id);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: addTrainDetails.php");
                exit();
            } else {
                $errorMessage = "Failed to update train details: " . mysqli_error($conn);
            }
        } else {
            $errorMessage = "Error: Unable to prepare statement";
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="adminstyle.css">
</head>

<body>
    <header>
        <button id="logout">Logout</button>
    </header>
    <div class="sidebar">
        <h2><a style="text-decoration: none;color :whitesmoke" href="adminpanel.php">Admin Panel</a></h2>
        <ul>
            <li><a href="addAdmin.php" id="addAdmin">Add Admins</a></li>
            <li><a href="addTrainDetails.php" id="addTrain">Add Train Details</a></li>
            <!-- <li><a href="#" id="addLostItems">Add Lost Items</a></li> -->
            <li><a href="manageusers.php" id="addTrain">Manage Users</a></li>
            <li><a href="#" id="sendAlert">Send Train Alert</a></li>
        </ul>
    </div>
    <div class="content">
        <h2><?php echo isset($admin) ? 'Edit Train Details' : 'Add Train Details'; ?></h2>
        <div class="contain">
            <form class="form_details" id="trainForm" action="#" method="post" enctype="multipart/form-data">
                <?php if (isset($errorMessage)) : ?>
                    <div class="error"><?php echo $errorMessage; ?></div>
                <?php endif; ?>
                <div class="con">
                    <?php if (isset($admin) && !empty($admin['image'])) : ?>
                        <label>Current Image:</label><br>
                        <img src="../images/<?php echo $admin['image']; ?>" style="width:150px;"><br>
                    <?php endif; ?>
                    <label for="image">Upload New Image:</label><br>
                    <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png"><br>
                    <label for="train">Select Train:</label><br>
                    <select name="train" id="train">
                        <option value="Choose Train">Choose Train</option>
                        <option value="Udarata Menike" <?php echo (isset($admin) && $admin['train'] == 'Udarata Menike') ? 'selected' : ''; ?>>Udarata Menike</option>
                        <option value="Podi Menike" <?php echo (isset($admin) && $admin['train'] == 'Podi Menike') ? 'selected' : ''; ?>>Podi Menike</option>
                        <option value="Senkadagala Menike" <?php echo (isset($admin) && $admin['train'] == 'Senkadagala Menike') ? 'selected' : ''; ?>>Senkadagala Menike</option>
                        <option value="Udaya Devi" <?php echo (isset($admin) && $admin['train'] == 'Udaya Devi') ? 'selected' : ''; ?>>Udaya Devi</option>
                        <option value="Tikiri Menike" <?php echo (isset($admin) && $admin['train'] == 'Tikiri Menike') ? 'selected' : ''; ?>>Tikiri Menike</option>
                        <option value="Ruhunu Kumari" <?php echo (isset($admin) && $admin['train'] == 'Ruhunu Kumari') ? 'selected' : ''; ?>>Ruhunu Kumari</option>
                        <option value="Samudra Devi" <?php echo (isset($admin) && $admin['train'] == 'Samudra Devi') ? 'selected' : ''; ?>>Samudra Devi</option>
                        <option value="Galu Kumari" <?php echo (isset($admin) && $admin['train'] == 'Galu Kumari') ? 'selected' : ''; ?>>Galu Kumari</option>
                        <option value="Muthu Kumari" <?php echo (isset($admin) && $admin['train'] == 'Muthu Kumari') ? 'selected' : ''; ?>>Muthu Kumari</option>
                    </select><br>
                    <label for="datetime">Enter Date and Time:</label><br>
                    <input type="datetime-local" id="datetime" name="datetime" value="<?php echo isset($admin) ? date('Y-m-d\TH:i', strtotime($admin['datetime'])) : ''; ?>"><br>
                    <label for="price">Enter Train Price:</label><br>
                    <input type="number" id="price" name="price" value="<?php echo isset($admin) ? $admin['price'] : ''; ?>"><br>
                    <label for="seats">Number of Seats:</label><br>
                    <input type="number" id="seats" name="seats" value="<?php echo isset($admin) ? $admin['seats'] : ''; ?>"><br>
                </div>
                <div class="con">
                    <label for="start_station">Select Start-point Train Station:</label><br>
                    <select name="start_station" id="start_station">
                        <option value="Choose Location">Choose Location</option>
                        <option value="Ahangama" <?php echo (isset($admin) && $admin['start_station'] == 'Ahangama') ? 'selected' : ''; ?>>Ahangama</option>
                        <option value="Aluthgama" <?php echo (isset($admin) && $admin['start_station'] == 'Aluthgama') ? 'selected' : ''; ?>>Aluthgama</option>
                        <option value="Ambalangoda" <?php echo (isset($admin) && $admin['start_station'] == 'Ambalangoda') ? 'selected' : ''; ?>>Ambalangoda</option>
                        <option value="Ambewela" <?php echo (isset($admin) && $admin['start_station'] == 'Ambewela') ? 'selected' : ''; ?>>Ambewela</option>
                        <option value="Angulana" <?php echo (isset($admin) && $admin['start_station'] == 'Angulana') ? 'selected' : ''; ?>>Angulana</option>
                        <option value="Anuradhapura" <?php echo (isset($admin) && $admin['start_station'] == 'Anuradhapura') ? 'selected' : ''; ?>>Anuradhapura</option>
                        <option value="Avissawela" <?php echo (isset($admin) && $admin['start_station'] == 'Avissawela') ? 'selected' : ''; ?>>Avissawela</option>
                        <option value="Badulla" <?php echo (isset($admin) && $admin['start_station'] == 'Badulla') ? 'selected' : ''; ?>>Badulla</option>
                        <option value="Balapitiya" <?php echo (isset($admin) && $admin['start_station'] == 'Balapitiya') ? 'selected' : ''; ?>>Balapitiya</option>
                        <option value="Bambalapitiya" <?php echo (isset($admin) && $admin['start_station'] == 'Bambalapitiya') ? 'selected' : ''; ?>>Bambalapitiya</option>
                        <option value="Bandarawela" <?php echo (isset($admin) && $admin['start_station'] == 'Bandarawela') ? 'selected' : ''; ?>>Bandarawela</option>
                        <option value="Bangadeniya" <?php echo (isset($admin) && $admin['start_station'] == 'Bangadeniya') ? 'selected' : ''; ?>>Bangadeniya</option>
                        <option value="Batticaloa" <?php echo (isset($admin) && $admin['start_station'] == 'Batticaloa') ? 'selected' : ''; ?>>Batticaloa</option>
                        <option value="Beruwala" <?php echo (isset($admin) && $admin['start_station'] == 'Beruwala') ? 'selected' : ''; ?>>Beruwala</option>
                        <option value="Chilaw" <?php echo (isset($admin) && $admin['start_station'] == 'Chilaw') ? 'selected' : ''; ?>>Chilaw</option>
                        <option value="Colombo" <?php echo (isset($admin) && $admin['start_station'] == 'Colombo') ? 'selected' : ''; ?>>Colombo</option>
                        <option value="China Bay" <?php echo (isset($admin) && $admin['start_station'] == 'China Bay') ? 'selected' : ''; ?>>China Bay</option>
                        <option value="Dehiwala" <?php echo (isset($admin) && $admin['start_station'] == 'Dehiwala') ? 'selected' : ''; ?>>Dehiwala</option>
                        <option value="Demodera" <?php echo (isset($admin) && $admin['start_station'] == 'Demodera') ? 'selected' : ''; ?>>Demodera</option>
                        <option value="Diyatalawa" <?php echo (isset($admin) && $admin['start_station'] == 'Diyatalawa') ? 'selected' : ''; ?>>Diyatalawa</option>
                        <option value="Dodanduwa" <?php echo (isset($admin) && $admin['start_station'] == 'Dodanduwa') ? 'selected' : ''; ?>>Dodanduwa</option>
                        <option value="Galgamuwa" <?php echo (isset($admin) && $admin['start_station'] == 'Galgamuwa') ? 'selected' : ''; ?>>Galgamuwa</option>
                        <option value="Galle" <?php echo (isset($admin) && $admin['start_station'] == 'Galle') ? 'selected' : ''; ?>>Galle</option>
                        <option value="Galoya" <?php echo (isset($admin) && $admin['start_station'] == 'Galoya') ? 'selected' : ''; ?>>Galoya</option>
                        <option value="Gampaha" <?php echo (isset($admin) && $admin['start_station'] == 'Gampaha') ? 'selected' : ''; ?>>Gampaha</option>
                        <option value="Ganemulla" <?php echo (isset($admin) && $admin['start_station'] == 'Ganemulla') ? 'selected' : ''; ?>>Ganemulla</option>
                        <option value="Gintota" <?php echo (isset($admin) && $admin['start_station'] == 'Gintota') ? 'selected' : ''; ?>>Gintota</option>
                        <option value="Haliela" <?php echo (isset($admin) && $admin['start_station'] == 'Haliela') ? 'selected' : ''; ?>>Haliela</option>
                        <option value="Haputale" <?php echo (isset($admin) && $admin['start_station'] == 'Haputale') ? 'selected' : ''; ?>>Haputale</option>
                        <option value="Hatton" <?php echo (isset($admin) && $admin['start_station'] == 'Hatton') ? 'selected' : ''; ?>>Hatton</option>
                        <option value="Hingurakgoda" <?php echo (isset($admin) && $admin['start_station'] == 'Hingurakgoda') ? 'selected' : ''; ?>>Hingurakgoda</option>
                        <option value="Homagama" <?php echo (isset($admin) && $admin['start_station'] == 'Homagama') ? 'selected' : ''; ?>>Homagama</option>
                        <option value="Hunupitiya" <?php echo (isset($admin) && $admin['start_station'] == 'Hunupitiya') ? 'selected' : ''; ?>>Hunupitiya</option>
                        <option value="Induwara" <?php echo (isset($admin) && $admin['start_station'] == 'Induwara') ? 'selected' : ''; ?>>Induwara</option>
                        <option value="Inguruoya" <?php echo (isset($admin) && $admin['start_station'] == 'Inguruoya') ? 'selected' : ''; ?>>Inguruoya</option>
                        <option value="Ja-Ela" <?php echo (isset($admin) && $admin['start_station'] == 'Ja-Ela') ? 'selected' : ''; ?>>Ja-Ela</option>
                        <option value="Kadugannawa" <?php echo (isset($admin) && $admin['start_station'] == 'Kadugannawa') ? 'selected' : ''; ?>>Kadugannawa</option>
                        <option value="Kahawe" <?php echo (isset($admin) && $admin['start_station'] == 'Kahawe') ? 'selected' : ''; ?>>Kahawe</option>
                        <option value="Kaluthara South" <?php echo (isset($admin) && $admin['start_station'] == 'Kaluthara South') ? 'selected' : ''; ?>>Kaluthara South</option>
                        <option value="Kaluthara North" <?php echo (isset($admin) && $admin['start_station'] == 'Kaluthara North') ? 'selected' : ''; ?>>Kaluthara North</option>
                        <option value="Kamburugamuwa" <?php echo (isset($admin) && $admin['start_station'] == 'Kamburugamuwa') ? 'selected' : ''; ?>>Kamburugamuwa</option>
                        <option value="Kandy" <?php echo (isset($admin) && $admin['start_station'] == 'Kandy') ? 'selected' : ''; ?>>Kandy</option>
                        <option value="Kantalai" <?php echo (isset($admin) && $admin['start_station'] == 'Kantalai') ? 'selected' : ''; ?>>Kantalai</option>
                        <option value="Katugastota" <?php echo (isset($admin) && $admin['start_station'] == 'Katugastota') ? 'selected' : ''; ?>>Katugastota</option>
                        <option value="Katunayake" <?php echo (isset($admin) && $admin['start_station'] == 'Katunayake') ? 'selected' : ''; ?>>Katunayake</option>
                        <option value="Kelaniya" <?php echo (isset($admin) && $admin['start_station'] == 'Kelaniya') ? 'selected' : ''; ?>>Kelaniya</option>
                        <option value="Kollupitiya" <?php echo (isset($admin) && $admin['start_station'] == 'Kollupitiya') ? 'selected' : ''; ?>>Kollupitiya</option>
                        <option value="Kollonnawa" <?php echo (isset($admin) && $admin['start_station'] == 'Kollonnawa') ? 'selected' : ''; ?>>Kollonnawa</option>
                        <option value="Kompannaveediya" <?php echo (isset($admin) && $admin['start_station'] == 'Kompannaveediya') ? 'selected' : ''; ?>>Kompannaveediya</option>
                        <option value="Kosgoda" <?php echo (isset($admin) && $admin['start_station'] == 'Kosgoda') ? 'selected' : ''; ?>>Kosgoda</option>
                        <option value="Kottawa" <?php echo (isset($admin) && $admin['start_station'] == 'Kottawa') ? 'selected' : ''; ?>>Kottawa</option>
                        <option value="Kurunegala" <?php echo (isset($admin) && $admin['start_station'] == 'Kurunegala') ? 'selected' : ''; ?>>Kurunegala</option>
                        <option value="Lunuwila" <?php echo (isset($admin) && $admin['start_station'] == 'Lunuwila') ? 'selected' : ''; ?>>Lunuwila</option>
                        <option value="Maho" <?php echo (isset($admin) && $admin['start_station'] == 'Maho') ? 'selected' : ''; ?>>Maho</option>
                        <option value="Matale" <?php echo (isset($admin) && $admin['start_station'] == 'Matale') ? 'selected' : ''; ?>>Matale</option>
                        <option value="Matara" <?php echo (isset($admin) && $admin['start_station'] == 'Matara') ? 'selected' : ''; ?>>Matara</option>
                        <option value="Medawachchiya" <?php echo (isset($admin) && $admin['start_station'] == 'Medawachchiya') ? 'selected' : ''; ?>>Medawachchiya</option>
                        <option value="Meerigama" <?php echo (isset($admin) && $admin['start_station'] == 'Meerigama') ? 'selected' : ''; ?>>Meerigama</option>
                        <option value="Mihintale" <?php echo (isset($admin) && $admin['start_station'] == 'Mihintale') ? 'selected' : ''; ?>>Mihintale</option>
                        <option value="Moratuwa" <?php echo (isset($admin) && $admin['start_station'] == 'Moratuwa') ? 'selected' : ''; ?>>Moratuwa</option>
                        <option value="Mt Lavinia" <?php echo (isset($admin) && $admin['start_station'] == 'Mt Lavinia') ? 'selected' : ''; ?>>Mt Lavinia</option>
                        <option value="Nanuoya" <?php echo (isset($admin) && $admin['start_station'] == 'Nanuoya') ? 'selected' : ''; ?>>Nanuoya</option>
                        <option value="Narahenpita" <?php echo (isset($admin) && $admin['start_station'] == 'Narahenpita') ? 'selected' : ''; ?>>Narahenpita</option>
                        <option value="Nattandiya" <?php echo (isset($admin) && $admin['start_station'] == 'Nattandiya') ? 'selected' : ''; ?>>Nattandiya</option>
                        <option value="Nawalapitiya" <?php echo (isset($admin) && $admin['start_station'] == 'Nawalapitiya') ? 'selected' : ''; ?>>Nawalapitiya</option>
                        <option value="Negombo" <?php echo (isset($admin) && $admin['start_station'] == 'Negombo') ? 'selected' : ''; ?>>Negombo</option>
                        <option value="Nugegoda" <?php echo (isset($admin) && $admin['start_station'] == 'Nugegoda') ? 'selected' : ''; ?>>Nugegoda</option>
                        <option value="Nuwara Eliya" <?php echo (isset($admin) && $admin['start_station'] == 'Nuwara Eliya') ? 'selected' : ''; ?>>Nuwara Eliya</option>
                        <option value="Padukka" <?php echo (isset($admin) && $admin['start_station'] == 'Padukka') ? 'selected' : ''; ?>>Padukka</option>
                        <option value="Pallewela" <?php echo (isset($admin) && $admin['start_station'] == 'Pallewela') ? 'selected' : ''; ?>>Pallewela</option>
                        <option value="Panadura" <?php echo (isset($admin) && $admin['start_station'] == 'Panadura') ? 'selected' : ''; ?>>Panadura</option>
                        <option value="Payagala" <?php echo (isset($admin) && $admin['start_station'] == 'Payagala') ? 'selected' : ''; ?>>Payagala</option>
                        <option value="Peradeniya" <?php echo (isset($admin) && $admin['start_station'] == 'Peradeniya') ? 'selected' : ''; ?>>Peradeniya</option>
                        <option value="Polgahawela" <?php echo (isset($admin) && $admin['start_station'] == 'Polgahawela') ? 'selected' : ''; ?>>Polgahawela</option>
                        <option value="Puttalam" <?php echo (isset($admin) && $admin['start_station'] == 'Puttalam') ? 'selected' : ''; ?>>Puttalam</option>
                        <option value="Ragama" <?php echo (isset($admin) && $admin['start_station'] == 'Ragama') ? 'selected' : ''; ?>>Ragama</option>
                        <option value="Rambukkana" <?php echo (isset($admin) && $admin['start_station'] == 'Rambukkana') ? 'selected' : ''; ?>>Rambukkana</option>
                        <option value="Ratmalana" <?php echo (isset($admin) && $admin['start_station'] == 'Ratmalana') ? 'selected' : ''; ?>>Ratmalana</option>
                        <option value="Rozella" <?php echo (isset($admin) && $admin['start_station'] == 'Rozella') ? 'selected' : ''; ?>>Rozella</option>
                        <option value="Sarasavi Uyana" <?php echo (isset($admin) && $admin['start_station'] == 'Sarasavi Uyana') ? 'selected' : ''; ?>>Sarasavi Uyana</option>
                        <option value="Seeduwa" <?php echo (isset($admin) && $admin['start_station'] == 'Seeduwa') ? 'selected' : ''; ?>>Seeduwa</option>
                        <option value="Talawakele" <?php echo (isset($admin) && $admin['start_station'] == 'Talawakele') ? 'selected' : ''; ?>>Talawakele</option>
                        <option value="Trincomalee" <?php echo (isset($admin) && $admin['start_station'] == 'Trincomalee') ? 'selected' : ''; ?>>Trincomalee</option>
                        <option value="Ukuwela" <?php echo (isset($admin) && $admin['start_station'] == 'Ukuwela') ? 'selected' : ''; ?>>Ukuwela</option>
                        <option value="Ulapane" <?php echo (isset($admin) && $admin['start_station'] == 'Ulapane') ? 'selected' : ''; ?>>Ulapane</option>
                        <option value="Vauniya" <?php echo (isset($admin) && $admin['start_station'] == 'Vauniya') ? 'selected' : ''; ?>>Vauniya</option>
                        <option value="Veyangoda" <?php echo (isset($admin) && $admin['start_station'] == 'Veyangoda') ? 'selected' : ''; ?>>Veyangoda</option>
                        <option value="Waga" <?php echo (isset($admin) && $admin['start_station'] == 'Waga') ? 'selected' : ''; ?>>Waga</option>
                        <option value="Watawala" <?php echo (isset($admin) && $admin['start_station'] == 'Watawala') ? 'selected' : ''; ?>>Watawala</option>
                        <option value="Wattegama" <?php echo (isset($admin) && $admin['start_station'] == 'Wattegama') ? 'selected' : ''; ?>>Wattegama</option>
                        <option value="Weligama" <?php echo (isset($admin) && $admin['start_station'] == 'Weligama') ? 'selected' : ''; ?>>Weligama</option>
                        <option value="Wellawatte" <?php echo (isset($admin) && $admin['start_station'] == 'Wellawatte') ? 'selected' : ''; ?>>Wellawatte</option>
                    </select><br>
                    <label for="end_station">Select End-point Train Station:</label><br>
                    <select name="end_station" id="end_station">
                        <option value="Choose Location">Choose Location</option>
                        <option value="Ahangama" <?php echo (isset($admin) && $admin['start_station'] == 'Ahangama') ? 'selected' : ''; ?>>Ahangama</option>
                        <option value="Aluthgama" <?php echo (isset($admin) && $admin['start_station'] == 'Aluthgama') ? 'selected' : ''; ?>>Aluthgama</option>
                        <option value="Ambalangoda" <?php echo (isset($admin) && $admin['start_station'] == 'Ambalangoda') ? 'selected' : ''; ?>>Ambalangoda</option>
                        <option value="Ambewela" <?php echo (isset($admin) && $admin['start_station'] == 'Ambewela') ? 'selected' : ''; ?>>Ambewela</option>
                        <option value="Angulana" <?php echo (isset($admin) && $admin['start_station'] == 'Angulana') ? 'selected' : ''; ?>>Angulana</option>
                        <option value="Anuradhapura" <?php echo (isset($admin) && $admin['start_station'] == 'Anuradhapura') ? 'selected' : ''; ?>>Anuradhapura</option>
                        <option value="Avissawela" <?php echo (isset($admin) && $admin['start_station'] == 'Avissawela') ? 'selected' : ''; ?>>Avissawela</option>
                        <option value="Badulla" <?php echo (isset($admin) && $admin['start_station'] == 'Badulla') ? 'selected' : ''; ?>>Badulla</option>
                        <option value="Balapitiya" <?php echo (isset($admin) && $admin['start_station'] == 'Balapitiya') ? 'selected' : ''; ?>>Balapitiya</option>
                        <option value="Bambalapitiya" <?php echo (isset($admin) && $admin['start_station'] == 'Bambalapitiya') ? 'selected' : ''; ?>>Bambalapitiya</option>
                        <option value="Bandarawela" <?php echo (isset($admin) && $admin['start_station'] == 'Bandarawela') ? 'selected' : ''; ?>>Bandarawela</option>
                        <option value="Bangadeniya" <?php echo (isset($admin) && $admin['start_station'] == 'Bangadeniya') ? 'selected' : ''; ?>>Bangadeniya</option>
                        <option value="Batticaloa" <?php echo (isset($admin) && $admin['start_station'] == 'Batticaloa') ? 'selected' : ''; ?>>Batticaloa</option>
                        <option value="Beruwala" <?php echo (isset($admin) && $admin['start_station'] == 'Beruwala') ? 'selected' : ''; ?>>Beruwala</option>
                        <option value="Chilaw" <?php echo (isset($admin) && $admin['start_station'] == 'Chilaw') ? 'selected' : ''; ?>>Chilaw</option>
                        <option value="Colombo" <?php echo (isset($admin) && $admin['start_station'] == 'Colombo') ? 'selected' : ''; ?>>Colombo</option>
                        <option value="China Bay" <?php echo (isset($admin) && $admin['start_station'] == 'China Bay') ? 'selected' : ''; ?>>China Bay</option>
                        <option value="Dehiwala" <?php echo (isset($admin) && $admin['start_station'] == 'Dehiwala') ? 'selected' : ''; ?>>Dehiwala</option>
                        <option value="Demodera" <?php echo (isset($admin) && $admin['start_station'] == 'Demodera') ? 'selected' : ''; ?>>Demodera</option>
                        <option value="Diyatalawa" <?php echo (isset($admin) && $admin['start_station'] == 'Diyatalawa') ? 'selected' : ''; ?>>Diyatalawa</option>
                        <option value="Dodanduwa" <?php echo (isset($admin) && $admin['start_station'] == 'Dodanduwa') ? 'selected' : ''; ?>>Dodanduwa</option>
                        <option value="Galgamuwa" <?php echo (isset($admin) && $admin['start_station'] == 'Galgamuwa') ? 'selected' : ''; ?>>Galgamuwa</option>
                        <option value="Galle" <?php echo (isset($admin) && $admin['start_station'] == 'Galle') ? 'selected' : ''; ?>>Galle</option>
                        <option value="Galoya" <?php echo (isset($admin) && $admin['start_station'] == 'Galoya') ? 'selected' : ''; ?>>Galoya</option>
                        <option value="Gampaha" <?php echo (isset($admin) && $admin['start_station'] == 'Gampaha') ? 'selected' : ''; ?>>Gampaha</option>
                        <option value="Ganemulla" <?php echo (isset($admin) && $admin['start_station'] == 'Ganemulla') ? 'selected' : ''; ?>>Ganemulla</option>
                        <option value="Gintota" <?php echo (isset($admin) && $admin['start_station'] == 'Gintota') ? 'selected' : ''; ?>>Gintota</option>
                        <option value="Haliela" <?php echo (isset($admin) && $admin['start_station'] == 'Haliela') ? 'selected' : ''; ?>>Haliela</option>
                        <option value="Haputale" <?php echo (isset($admin) && $admin['start_station'] == 'Haputale') ? 'selected' : ''; ?>>Haputale</option>
                        <option value="Hatton" <?php echo (isset($admin) && $admin['start_station'] == 'Hatton') ? 'selected' : ''; ?>>Hatton</option>
                        <option value="Hingurakgoda" <?php echo (isset($admin) && $admin['start_station'] == 'Hingurakgoda') ? 'selected' : ''; ?>>Hingurakgoda</option>
                        <option value="Homagama" <?php echo (isset($admin) && $admin['start_station'] == 'Homagama') ? 'selected' : ''; ?>>Homagama</option>
                        <option value="Hunupitiya" <?php echo (isset($admin) && $admin['start_station'] == 'Hunupitiya') ? 'selected' : ''; ?>>Hunupitiya</option>
                        <option value="Induwara" <?php echo (isset($admin) && $admin['start_station'] == 'Induwara') ? 'selected' : ''; ?>>Induwara</option>
                        <option value="Inguruoya" <?php echo (isset($admin) && $admin['start_station'] == 'Inguruoya') ? 'selected' : ''; ?>>Inguruoya</option>
                        <option value="Ja-Ela" <?php echo (isset($admin) && $admin['start_station'] == 'Ja-Ela') ? 'selected' : ''; ?>>Ja-Ela</option>
                        <option value="Kadugannawa" <?php echo (isset($admin) && $admin['start_station'] == 'Kadugannawa') ? 'selected' : ''; ?>>Kadugannawa</option>
                        <option value="Kahawe" <?php echo (isset($admin) && $admin['start_station'] == 'Kahawe') ? 'selected' : ''; ?>>Kahawe</option>
                        <option value="Kaluthara South" <?php echo (isset($admin) && $admin['start_station'] == 'Kaluthara South') ? 'selected' : ''; ?>>Kaluthara South</option>
                        <option value="Kaluthara North" <?php echo (isset($admin) && $admin['start_station'] == 'Kaluthara North') ? 'selected' : ''; ?>>Kaluthara North</option>
                        <option value="Kamburugamuwa" <?php echo (isset($admin) && $admin['start_station'] == 'Kamburugamuwa') ? 'selected' : ''; ?>>Kamburugamuwa</option>
                        <option value="Kandy" <?php echo (isset($admin) && $admin['start_station'] == 'Kandy') ? 'selected' : ''; ?>>Kandy</option>
                        <option value="Kantalai" <?php echo (isset($admin) && $admin['start_station'] == 'Kantalai') ? 'selected' : ''; ?>>Kantalai</option>
                        <option value="Katugastota" <?php echo (isset($admin) && $admin['start_station'] == 'Katugastota') ? 'selected' : ''; ?>>Katugastota</option>
                        <option value="Katunayake" <?php echo (isset($admin) && $admin['start_station'] == 'Katunayake') ? 'selected' : ''; ?>>Katunayake</option>
                        <option value="Kelaniya" <?php echo (isset($admin) && $admin['start_station'] == 'Kelaniya') ? 'selected' : ''; ?>>Kelaniya</option>
                        <option value="Kollupitiya" <?php echo (isset($admin) && $admin['start_station'] == 'Kollupitiya') ? 'selected' : ''; ?>>Kollupitiya</option>
                        <option value="Kollonnawa" <?php echo (isset($admin) && $admin['start_station'] == 'Kollonnawa') ? 'selected' : ''; ?>>Kollonnawa</option>
                        <option value="Kompannaveediya" <?php echo (isset($admin) && $admin['start_station'] == 'Kompannaveediya') ? 'selected' : ''; ?>>Kompannaveediya</option>
                        <option value="Kosgoda" <?php echo (isset($admin) && $admin['start_station'] == 'Kosgoda') ? 'selected' : ''; ?>>Kosgoda</option>
                        <option value="Kottawa" <?php echo (isset($admin) && $admin['start_station'] == 'Kottawa') ? 'selected' : ''; ?>>Kottawa</option>
                        <option value="Kurunegala" <?php echo (isset($admin) && $admin['start_station'] == 'Kurunegala') ? 'selected' : ''; ?>>Kurunegala</option>
                        <option value="Lunuwila" <?php echo (isset($admin) && $admin['start_station'] == 'Lunuwila') ? 'selected' : ''; ?>>Lunuwila</option>
                        <option value="Maho" <?php echo (isset($admin) && $admin['start_station'] == 'Maho') ? 'selected' : ''; ?>>Maho</option>
                        <option value="Matale" <?php echo (isset($admin) && $admin['start_station'] == 'Matale') ? 'selected' : ''; ?>>Matale</option>
                        <option value="Matara" <?php echo (isset($admin) && $admin['start_station'] == 'Matara') ? 'selected' : ''; ?>>Matara</option>
                        <option value="Medawachchiya" <?php echo (isset($admin) && $admin['start_station'] == 'Medawachchiya') ? 'selected' : ''; ?>>Medawachchiya</option>
                        <option value="Meerigama" <?php echo (isset($admin) && $admin['start_station'] == 'Meerigama') ? 'selected' : ''; ?>>Meerigama</option>
                        <option value="Mihintale" <?php echo (isset($admin) && $admin['start_station'] == 'Mihintale') ? 'selected' : ''; ?>>Mihintale</option>
                        <option value="Moratuwa" <?php echo (isset($admin) && $admin['start_station'] == 'Moratuwa') ? 'selected' : ''; ?>>Moratuwa</option>
                        <option value="Mt Lavinia" <?php echo (isset($admin) && $admin['start_station'] == 'Mt Lavinia') ? 'selected' : ''; ?>>Mt Lavinia</option>
                        <option value="Nanuoya" <?php echo (isset($admin) && $admin['start_station'] == 'Nanuoya') ? 'selected' : ''; ?>>Nanuoya</option>
                        <option value="Narahenpita" <?php echo (isset($admin) && $admin['start_station'] == 'Narahenpita') ? 'selected' : ''; ?>>Narahenpita</option>
                        <option value="Nattandiya" <?php echo (isset($admin) && $admin['start_station'] == 'Nattandiya') ? 'selected' : ''; ?>>Nattandiya</option>
                        <option value="Nawalapitiya" <?php echo (isset($admin) && $admin['start_station'] == 'Nawalapitiya') ? 'selected' : ''; ?>>Nawalapitiya</option>
                        <option value="Negombo" <?php echo (isset($admin) && $admin['start_station'] == 'Negombo') ? 'selected' : ''; ?>>Negombo</option>
                        <option value="Nugegoda" <?php echo (isset($admin) && $admin['start_station'] == 'Nugegoda') ? 'selected' : ''; ?>>Nugegoda</option>
                        <option value="Nuwara Eliya" <?php echo (isset($admin) && $admin['start_station'] == 'Nuwara Eliya') ? 'selected' : ''; ?>>Nuwara Eliya</option>
                        <option value="Padukka" <?php echo (isset($admin) && $admin['start_station'] == 'Padukka') ? 'selected' : ''; ?>>Padukka</option>
                        <option value="Pallewela" <?php echo (isset($admin) && $admin['start_station'] == 'Pallewela') ? 'selected' : ''; ?>>Pallewela</option>
                        <option value="Panadura" <?php echo (isset($admin) && $admin['start_station'] == 'Panadura') ? 'selected' : ''; ?>>Panadura</option>
                        <option value="Payagala" <?php echo (isset($admin) && $admin['start_station'] == 'Payagala') ? 'selected' : ''; ?>>Payagala</option>
                        <option value="Peradeniya" <?php echo (isset($admin) && $admin['start_station'] == 'Peradeniya') ? 'selected' : ''; ?>>Peradeniya</option>
                        <option value="Polgahawela" <?php echo (isset($admin) && $admin['start_station'] == 'Polgahawela') ? 'selected' : ''; ?>>Polgahawela</option>
                        <option value="Puttalam" <?php echo (isset($admin) && $admin['start_station'] == 'Puttalam') ? 'selected' : ''; ?>>Puttalam</option>
                        <option value="Ragama" <?php echo (isset($admin) && $admin['start_station'] == 'Ragama') ? 'selected' : ''; ?>>Ragama</option>
                        <option value="Rambukkana" <?php echo (isset($admin) && $admin['start_station'] == 'Rambukkana') ? 'selected' : ''; ?>>Rambukkana</option>
                        <option value="Ratmalana" <?php echo (isset($admin) && $admin['start_station'] == 'Ratmalana') ? 'selected' : ''; ?>>Ratmalana</option>
                        <option value="Rozella" <?php echo (isset($admin) && $admin['start_station'] == 'Rozella') ? 'selected' : ''; ?>>Rozella</option>
                        <option value="Sarasavi Uyana" <?php echo (isset($admin) && $admin['start_station'] == 'Sarasavi Uyana') ? 'selected' : ''; ?>>Sarasavi Uyana</option>
                        <option value="Seeduwa" <?php echo (isset($admin) && $admin['start_station'] == 'Seeduwa') ? 'selected' : ''; ?>>Seeduwa</option>
                        <option value="Talawakele" <?php echo (isset($admin) && $admin['start_station'] == 'Talawakele') ? 'selected' : ''; ?>>Talawakele</option>
                        <option value="Trincomalee" <?php echo (isset($admin) && $admin['start_station'] == 'Trincomalee') ? 'selected' : ''; ?>>Trincomalee</option>
                        <option value="Ukuwela" <?php echo (isset($admin) && $admin['start_station'] == 'Ukuwela') ? 'selected' : ''; ?>>Ukuwela</option>
                        <option value="Ulapane" <?php echo (isset($admin) && $admin['start_station'] == 'Ulapane') ? 'selected' : ''; ?>>Ulapane</option>
                        <option value="Vauniya" <?php echo (isset($admin) && $admin['start_station'] == 'Vauniya') ? 'selected' : ''; ?>>Vauniya</option>
                        <option value="Veyangoda" <?php echo (isset($admin) && $admin['start_station'] == 'Veyangoda') ? 'selected' : ''; ?>>Veyangoda</option>
                        <option value="Waga" <?php echo (isset($admin) && $admin['start_station'] == 'Waga') ? 'selected' : ''; ?>>Waga</option>
                        <option value="Watawala" <?php echo (isset($admin) && $admin['start_station'] == 'Watawala') ? 'selected' : ''; ?>>Watawala</option>
                        <option value="Wattegama" <?php echo (isset($admin) && $admin['start_station'] == 'Wattegama') ? 'selected' : ''; ?>>Wattegama</option>
                        <option value="Weligama" <?php echo (isset($admin) && $admin['start_station'] == 'Weligama') ? 'selected' : ''; ?>>Weligama</option>
                        <option value="Wellawatte" <?php echo (isset($admin) && $admin['start_station'] == 'Wellawatte') ? 'selected' : ''; ?>>Wellawatte</option>
                    </select><br>
                    <label>Select Train Classes:</label><br>
                    <input type="checkbox" name="train_class[]" value="class1" <?php echo (isset($admin) && strpos($admin['train_class'], 'class1') !== false) ? 'checked' : ''; ?>>Class 1<br>
                    <input type="checkbox" name="train_class[]" value="class2" <?php echo (isset($admin) && strpos($admin['train_class'], 'class2') !== false) ? 'checked' : ''; ?>>Class 2<br>
                    <input type="checkbox" name="train_class[]" value="class3" <?php echo (isset($admin) && strpos($admin['train_class'], 'class3') !== false) ? 'checked' : ''; ?>>Class 3<br>

                    <label for="status">Choose Status:</label><br>
                    <select name="status" id="status">
                        <option value="Available" <?php echo (isset($admin) && $admin['status'] == 'Available') ? 'selected' : ''; ?>>Available</option>
                        <option value="Not Available" <?php echo (isset($admin) && $admin['status'] == 'Not Available') ? 'selected' : ''; ?>>Not Available</option>
                        <option value="Checking" <?php echo (isset($admin) && $admin['status'] == 'Checking') ? 'selected' : ''; ?>>Checking</option>
                    </select><br>
                    <?php if (isset($admin)) : ?>
                        <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
                        <button type="submit" name="update">Update</button>
                    <?php else : ?>
                        <button type="submit" name="submit">Submit</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="contain">
            <?php
            if (isset($_POST['delete'])) {
                $Id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

                $deleteQuery = "DELETE FROM traindetails WHERE id = $Id";
                $deleteResult = mysqli_query($conn, $deleteQuery);

                if ($deleteResult) {
                    echo "<script>alert('Admin deleted successfully');</script>";
                } else {
                    echo "<script>alert('Failed to delete admin');</script>";
                }
            }

            $view = "SELECT id, image, train, datetime, start_station, end_station, train_class, status, seats, price FROM traindetails";
            $result = mysqli_query($conn, $view);

            if (mysqli_num_rows($result) > 0) {
                echo "<table border='1' style='border: #000; background-color: #fff; text-align: center;'>";
                echo "<tr>
                        <th style='padding: 13px;'>Image</th>
                        <th style='padding: 13px;'>Train Name</th>
                        <th style='padding: 13px;'>Date & time</th>
                        <th style='padding: 13px;'>Start Loc</th>
                        <th style='padding: 13px;'>End Loc</th>
                        <th style='padding: 13px;'>Train Class</th>
                        <th style='padding: 13px;'>Status</th>
                        <th style='padding: 13px;'>Seats</th>
                        <th style='padding: 13px;'>Price</th>
                        <th style='padding: 13px;'>Actions</th>
                      </tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td style='padding: 10px;'><img src='../images/{$row['image']}' style='width: 100px;'></td>";
                    echo "<td style='padding: 10px;'>{$row['train']}</td>";
                    echo "<td style='padding: 10px;'>{$row['datetime']}</td>";
                    echo "<td style='padding: 10px;'>{$row['start_station']}</td>";
                    echo "<td style='padding: 10px;'>{$row['end_station']}</td>";
                    echo "<td style='padding: 10px;'>{$row['train_class']}</td>";
                    echo "<td style='padding: 10px;'>{$row['status']}</td>";
                    echo "<td style='padding: 10px;'>{$row['seats']}</td>";
                    echo "<td style='padding: 10px;'>{$row['price']}</td>";
                    echo "<td style='padding: 10px;'>
                                <form method='post' action='#'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button style='background-color:blue' type='submit' name='edit'>Edit</button>
                                    <button style='background-color:red' type='submit' name='delete'>Delete</button>
                                </form>
                              </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No train details available</p>";
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
    <script>
        document.getElementById("logout").addEventListener("click", function() {
            location.href = "../logout.php";
        });
    </script>
</body>

</html>