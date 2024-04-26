<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Train Booking</title>
    <link rel="icon" type="image/x-icon" href="../homes/images/TECH.png" />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
      }

      .booking__container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
      }

      .booking__container h1 {
        font-size: 2.5rem;
        margin-bottom: 30px;
      }

      .booking__container__box {
        display: flex;
        justify-content: center;
        gap: 20px;
      }

      .booking_box {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 30px;
        text-align: center;
        transition: transform 0.3s ease;
      }

      .booking_box:hover {
        transform: translateY(-5px);
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
      }

      .booking_box h1 {
        font-size: 1.5rem;
        margin-bottom: 20px;
      }

      .booking_box button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      .booking_box button:hover {
        background-color: #0056b3;
      }

      .price {
        display: none;
        margin-top: 20px;
      }

      .price h2 {
        font-size: 1.2rem;
        margin-bottom: 10px;
      }

      .price p {
        font-size: 1rem;
        margin-bottom: 5px;
      }
    </style>
  </head>
  <body>
    <div class="booking__container">
      <h1>Train Booking</h1>
      <div class="booking__container__box">
        <div class="booking_box">
          <h1>1st class</h1>
          <button class="show-price">Show Price</button>
          <button class="proceed">
            <a href="../homes/book.php">Proceed</a>
          </button>
          <div class="price">
            <h2>Price for 1st class:</h2>
            <p>- Includes meal service</p>
            <p>- Free Wi-Fi</p>
            <p>- Comfortable seating</p>
            <p>- Rs. 7000 per seat</p>
            <img
              height="180px"
              style="object-fit: contain"
              src="../homes/images/SriLanka-bluetrain-1st.jpg"
              alt="asdadad"
            />
          </div>
        </div>
        <div class="booking_box">
          <h1>2nd class</h1>
          <button class="show-price">Show Price</button>
          <button class="proceed"><a href="../book.php">Proceed</a></button>
          <div class="price">
            <h2>Price for 2nd class:</h2>
            <p>- Limited meal options</p>
            <p>- Basic amenities</p>
            <p>- Rs. 4900 per seat</p>
            <img
              height="180px"
              style="object-fit: contain"
              src="../homes/images/3727-inside.jpg"
              alt="asdadad"
            />
          </div>
        </div>
        <div class="booking_box">
          <h1>3rd class</h1>
          <button class="show-price">Show Price</button>
          <button class="proceed">
            <a href="../homes/book.php">Proceed</a>
          </button>
          <div class="price">
            <h2>Price for 3rd class:</h2>
            <p>- No meal service</p>
            <p>- Limited amenities</p>
            <p>- Rs. 3500 per seat</p>
            <img
              height="180px"
              style="object-fit: contain"
              src="../homes/images/kandy-sri-lanka-december-2017-people-traveling-in-third-class-in-the-train-between-kandy-and-ella-in-sri-lanka-MXJ4KY.jpg"
              alt="asdadad"
            />
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const showPriceButtons = document.querySelectorAll(".show-price");
        showPriceButtons.forEach((button) => {
          button.addEventListener("click", () => {
            const price = button.parentElement.querySelector(".price");
            price.style.display =
              price.style.display === "block" ? "none" : "block";
          });
        });

        const proceedButtons = document.querySelectorAll(".proceed");
        proceedButtons.forEach((button) => {
          button.addEventListener("click", () => {
            // Redirect to another page or perform desired action
            alert("Proceeding to next page...");
          });
        });
      });
    </script>
  </body>
</html>
