<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lanka Railway Explorer</title>
  <link rel="icon" type="image/x-icon" href="../homes/images/TECH.png">
  <link rel="stylesheet" href="../homes/styles/home.css" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
</head>


<body>
  <div style="width: auto;background-color:grey " id="google_translate_element">
  </div>

  <?php
  include("includes/header.php");
  ?>
  <section>
    <div class="hero-section">
      <div class="hero-para-section">
        <h1 data-aos="fade-left">Elevate Your Travel Experience</h1>
        <h2 data-aos="fade-left">
          Place a bid to upgrade your reservation <br />
          to a premium class of service.
        </h2>
        <button><a id="book" href="../Users/booking/booking.php">BOOK NOW &nbsp; <i class="bx bxs-right-down-arrow-circle"></i></a>

        </button>
      </div>

    </div>
  </section>
  <div>
  <?php
    $message = isset($_POST['message']) ? $_POST['message'] : '';
    if (!empty($message)) {
      echo "<h1 style='text-align:center;color:whitesmoke;background-color:red;padding:0.6rem'>Alert : $message</h1>";
    }
    ?> 
  </div>

  <section>
    <div class="box-main">
      <h1 data-aos="fade-left">
        <i class="bx bxs-quote-left"></i>&nbsp; From local trips to
        cross-country adventures, <br />find info and book train tickets for
        popular journeys in the Sri Lanka.&nbsp;
        <i class="bx bxs-quote-right"></i>
      </h1>
      <div class="box-sub">
        <div data-aos="fade-left" class="box">
          <div class="icon">
            <i class="bx bx-location-plus bx-tada-hover"></i>
          </div>
          <div class="para">
            <p>Customer service on hand every step of the way</p>
          </div>
        </div>
        <div data-aos="fade-left" class="box">
          <div class="icon"><i class="bx bx-group bx-tada-hover"></i></div>
          <div class="para">
            <p>Join millions of people who use us every day</p>
          </div>
        </div>
        <div data-aos="fade-left" class="box">
          <div class="icon"><i class="bx bx-train bx-tada-hover"></i></div>
          <div class="para">
            <p>ravel thousands of destinations in and across 45 countries</p>
          </div>
        </div>
        <div data-aos="fade-left" class="box">
          <div class="icon"><i class="bx bx-money bx-tada-hover"></i></div>
          <div class="para">
            <p>Compare cheap prices for train and bus tickets</p>
          </div>
        </div>
      </div>
    </div>
  </section>




  <section>
    <div class="travel-main">
      <div class="travel-sub">
        <div class="travel-image">
          <img data-aos="fade-up" src="../homes/images/gallery-1.jpg" alt="" />
        </div>

        <div class="travel-para">
          <h1 data-aos="fade-up">
            Get the best experience with <span>Lanka Railway Explorer</span>
          </h1>
          <h2 data-aos="fade-up">
            From finding you the best deal to live updates on your journey.
          </h2>
          <ul data-aos="fade-up">
            <li data-aos="fade-up">
              <i class="bx bx-check bx-tada"></i>&nbsp; Exclusive offers with
              Lanka Railway Explorer
            </li>
            <li data-aos="fade-up">
              <i class="bx bx-check bx-tada"></i>&nbsp; Choose your favourite
              seat
            </li>
            <li>
              <i class="bx bx-check bx-tada"></i>&nbsp; Get the best prices
              with Deal Finder
            </li>
            <li>
              <i class="bx bx-check bx-tada"></i>&nbsp; Real time journey
              updates
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="choose-main">
      <h1 data-aos="fade-up">Why choose Lanka Railway Explorer ?</h1>
      <div class="choose-sub">
        <div data-aos="fade-up" class="choose-box">
          <div data-aos="fade-up" class="choose-icon">
            <i id="Choose" class="bx bx-handicap"></i>
          </div>
          <div class="choose-para">
            <h1 data-aos="fade-up">Choose your favourite seat</h1>
            <p data-aos="fade-up">
              When you book direct you can take control of your journey and
              bag the best spot onboard. Sit back for a comfortable ride.
            </p>
          </div>
        </div>
        <div data-aos="fade-up" class="choose-box">
          <div data-aos="fade-up" class="choose-icon">
            <i id="Choose" class="bx bx-group"></i>
          </div>
          <div class="choose-para">
            <h1 data-aos="fade-up">Book together, save 20%</h1>
            <p data-aos="fade-up">
              If you’re travelling in a group of 3-9 people, you can save 20%
              off LNER Advance tickets.
            </p>
          </div>
        </div>
        <div data-aos="fade-up" class="choose-box">
          <div data-aos="fade-up" class="choose-icon">
            <i id="Choose" class="bx bx-refresh"></i>
          </div>
          <div class="choose-para">
            <h1 data-aos="fade-up">Delay repay made easier</h1>
            <p data-aos="fade-up">
              "Amazing that you make the process for a refund due to a delay
              so easy. One click and it is done.
            </p>
          </div>
        </div>
        <div data-aos="fade-up" class="choose-box">
          <div data-aos="fade-up" class="choose-icon">
            <i id="Choose" class="bx bx-money-withdraw"></i>
          </div>
          <div class="choose-para">
            <h1 data-aos="fade-up">Rs.800 free with Perks</h1>
            <p data-aos="fade-up">
              Get £5 free when you join LNER Perks, and 2% back to save on
              your LNER journeys
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>
  <a href="/" id="paragraph"></a>
  <?php
  include("includes/footer.php");
  ?>


  <!--js codes translator and click events -->

  <script src="script.js"></script>
  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'en'
      }, 'google_translate_element');
    }
  </script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
      },
    });
    AOS.init({
      duration: 1400,
    });

    const menu = document.querySelector(".menu");
    const sidebar = document.querySelector(".nav-bar-mobile");

    menu.addEventListener("click", function() {
      menu.classList.toggle("active");
      sidebar.classList.toggle("active");
    });
    window.onload = function() {
      var alertElement = document.getElementById('alert');
      if (alertElement) {
        alertElement.style.display = 'none';
      }
    };
  </script>
</body>

</html>