<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirm</title>
    <link rel="stylesheet" href="../homes/book.css">
</head>
<style>
@import url("https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

:root {
  --btn-bak-color: #00ab93;
  --btn-hov: rgb(58, 58, 99);
  --btn-color: #ececec;
  --btn-padding: 0.7rem;
  --radius: 5px;
  --nav-back-color: #ececec;
  --btn-size: 0.8rem;
  --banner-font-size: 1.8rem;
  --max-cont: 70%;
  --icons-color: rgb(90, 90, 90);
}

.main {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.container {
  display: flex;
  flex-direction: row-reverse;
  justify-content: center;
  /* border: 1px solid rgb(64, 255, 0); */
  width: 100%;
  gap: 4rem;
  /* border: 1px solid rgb(73, 67, 67); */
}
.form-box {
  display: flex;
  flex-direction: column;
  align-items: center;
  height: auto;
  width: 500px;
  /* border: 1px solid red; */
  /* border: 1px solid red; */
  padding: 2rem;
}

.form-box-1 {
  /* border: 1px solid red; */
  width: 700px;
  display: flex;
  padding: 1rem;

  align-items: center;
  justify-content: center;
  height: auto;
  flex-wrap: wrap;
  flex-direction: column;
}

.form-box-1 h1 {
  color: var(--btn-bak-color);
}

.form-box-sub-2 {
  display: flex;
  flex-wrap: wrap;
  align-items: baseline;
  /* border: 1px solid blue; */
  justify-content: center;
  gap: 0.4rem;
}
.form-sub-box {
  height: 220px;
  width: 200px;
  border-radius: var(--radius);
  border: 1px solid rgb(206, 206, 206);
  padding: 1rem;
  box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px,
    rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
}

.form-sub-box h2 {
  margin-bottom: 0.6em;
  font-size: 1.4rem;
}

.form-sub-box:first-child {
  background-color: var(--btn-bak-color);
  color: white;
}
.form-sub-box:nth-child(2) {
  background-color: rgb(70, 70, 70);
  color: white;
}
.form-sub-box:nth-child(3) {
  background-color: var(--btn-bak-color);
  color: white;
}
.form-sub-box:nth-child(4) {
  background-color: rgb(70, 70, 70);
  color: white;
}
.form-sub-box:nth-child(5) {
  background-color: var(--btn-bak-color);
  color: white;
}
.form-sub-box:nth-child(6) {
  background-color: rgb(70, 70, 70);
  color: white;
}
.form-sub-box:nth-child(7) {
  background-color: var(--btn-bak-color);
  color: white;
}
.form-sub-box:nth-child(8) {
  background-color: rgb(70, 70, 70);
  color: white;
}
.form-sub-box:nth-child(9) {
  background-color: var(--btn-bak-color);
  color: white;
}

form {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  /* border: 1px solid red; */
  width: auto;
  border: 1px solid rgb(206, 206, 206);
  border-radius: var(--radius);
  padding: 1.2rem;
  box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px,
    rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
}

input,
select {
  width: 430px;
  height: 37px;
  border-radius: var(--radius);
  margin-bottom: 8px;
  padding-left: 1rem;
}
input {
  border: none;
  border: 1px solid grey;
}

select {
  margin: 0;
}

label {
  margin-bottom: 10px;
}

.item {
  display: flex;
  flex-direction: column;
  /* border: 1px solid red; */
  margin: 0;
}

#toodleButton,
#proceed {
  width: 430px;
  display: flex;
  justify-content: center;
  font-size: 1.1rem;
  margin-bottom: 10px;
}

#people {
  margin-top: 10px;
}
.error-message {
  background-color: rgb(255, 71, 71);
  text-align: center;
  width: 100%;
  font-size: var(--label-sizes);
  /* color: var(--btn-color); */
  color: whitesmoke;
  padding: var(--btn-padding);
}
.success-message {
  background-color: rgb(108, 255, 71);
  text-align: center;
  width: 100%;
  font-size: var(--label-sizes);
  /* color: var(--btn-color); */
  color: whitesmoke;
  padding: var(--btn-padding);
}

.loc p {
  margin-bottom: 1rem;
  margin-top: 0.3rem;
}
.laptop-pc {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.loc {
  display: flex;
  align-items: center;
  flex-direction: column;
  width: 100%;
}

.item-1 {
  padding-left: 0.7rem;
}

.topic {
  background-color: var(--btn-bak-color);
  width: 100%;
  padding: 0.3rem;
  color: whitesmoke;
  font-size: 0.8rem;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: var(--radius);
}
footer {
  /* border: 1px solid red; */
  width: 100%;
}

@media (max-width: 1200px) {
  .form-box-sub-2 {
    display: none;
  }
  .form-box-1 h1 {
    display: none;
  }
  .container {
    flex-direction: column;
    align-items: center;
    /* border: 1px solid red; */
  }
  body {
    /* border: 1px solid blue; */
    width: auto;
  }

  .form-box {
    /* border: 1px solid black; */
    width: inherit;
  }

  .form-sub-box {
    /* border: 1PX solid blue; */
  }

  form {
    /* border: 1px solid blue; */
  }

  input,
  select {
    width: 350px;
  }

  .form-box-1 {
    /* border: 1px solid pink; */
    display: none;
  }
  #toodleButton,
  #proceed {
    width: 350px;
    display: flex;
    justify-content: center;
    font-size: 1.1rem;
    margin-bottom: 10px;
  }
}

</style>

<body>


    <div  class="container">
        <form style="width:500px" action="confirmation.php" method="post" onsubmit="return confirm('These Booking Data has been sent to the your email. Please show the Booking Data to the Train Station when you arrive to take your ticket. Stay Safe!');">
            <?php
            require 'connection.php';

            $lastData = isset($_GET['id']) ? $_GET['id'] : null;
            $result = null;

            if ($lastData) {
                $view = "SELECT id, passenger, Email, setLoc, arrLoc, startdate, returndate, trainClass, People FROM bookingdata WHERE id = $lastData";
                $result = mysqli_query($conn, $view);
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

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                $totalPrice = calculateTotalPrice($row['trainClass'], $row['People']);
            ?>
                <div style="width: 500px;text-align:center" class="loc">
                    <div class="item">
                        <h2>Booking Info</h2>
                        <label for="">Passenger Name:</label>
                        <p><?= $row['passenger']; ?></p>
                        <label for="">Email:</label>
                        <p><?= $row['Email']; ?></p>
                        <label for="">Location:</label>
                        <p><?= $row['setLoc']; ?> to <?= $row['arrLoc']; ?></p>
                        <label for="">Date:</label>
                        <p><?= $row['startdate']; ?></p>
                        <label for="">Return Date:</label>
                        <p><?= $row['returndate']; ?></p>
                        <label for="">Train Class:</label>
                        <p><?= $row['trainClass']; ?></p>
                        <label for="">No of people:</label>
                        <p><?= $row['People']; ?></p>
                        <h3>Total Price:</h3>
                        <p>Rs <?= $totalPrice; ?></p>
                    </div>
                    <div class="item">
                        <div class="imgBox">
                            <img src="" id="qrImage">
                        </div>
                    </div>
                </div>
                <button type="submit" name="submit">Confirm</button>
            <?php
            } else {
                echo 'No records found';
            } ?>
        </form>
    </div>
</body>

</html>