<?php
session_start();
if(!isset($_SESSION['session_username'])){
    header("location:login.php");
    exit();
}
?>

<?php

require '../function/connect.php';
require '../function/query_function.php';

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LIMITLESS</title>
  

    <!-- Sytle Link -->
    <link rel="stylesheet" href="../assets/css/style.css" />

    <!-- Font Awesome CDN Link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Scrollbar Settings -->
    <style>
      html::-webkit-scrollbar {
        width: 1vw;
      }

      html::-webkit-scrollbar-thumb {
        background: rgb(37, 37, 37);
        border-radius: 10px;
      }
    </style>
  </head>
  <body>
    <!-- Navigation -->

    <header>
      <div href="#" class="logo" data-aos="fade-down">
        <img
          src="../assets/image/MainLogoLimitelss.png"
          style="width: 7rem; margin-top: 0.5rem"
          alt="logo"
        />
      </div>
      <ul class="nav">
        <li data-aos="fade-down" data-aos-delay="50">
          <a class="nav-section" href="index.php#home" onclick="toggleMenu();"> Home </a>
        </li>
        <li data-aos="fade-down" data-aos-delay="100">
          <a class="nav-section" href="products.php?sex=MALE" onclick="toggleMenu();"> Man </a>
        </li>
        <li data-aos="fade-down" data-aos-delay="150">
          <a class="nav-section" href="products.php?sex=FEMALE" onclick="toggleMenu();">
            Woman
          </a>
        </li>

        <li data-aos="fade-down" data-aos-delay="250">
          <a class="nav-section" href="index.php#categories" onclick="toggleMenu();">
            Categories
          </a>
        </li>
        <li data-aos="fade-down" data-aos-delay="250">
          <a class="nav-section" href="../function/logout.php" onclick="toggleMenu();">
            Logout</a
          >
        </li>
        <li data-aos="fade-down" data-aos-delay="250">
          <a id="search-item-button"
            ><ion-icon class="nav-icon" name="search-outline"></ion-icon>
          </a>
        </li>
        <li data-aos="fade-down" data-aos-delay="250">
          <a href="cart.php"> <ion-icon class="nav-icon" name="cart-outline"></ion-icon></a>
        </li>
        <li data-aos="fade-down" data-aos-delay="250">
          <form class="search-item-form" id="search-item" method="GET" action="products.php">
            <input
              class="search-item-input"
              type="search"
              placeholder="search..."
              id="search-box"
              name="search-param"
            />

            <input
              type="submit" style="display:none"
            />
          </form>
        </li>
      </ul>
    </header>

    <!-- Navigation bar end -->



    <section class="service" id="service">
      <div class="container">
        <div class="menu">

        <?php
          
          $search_param = isset($_GET['search-param']) ? $_GET['search-param'] : '';
          $sex_param = isset($_GET['sex']) ? $_GET['sex'] : '';
          $category_param = isset($_GET['category']) ? $_GET['category'] : '';

          query_products(100, $category_param, $sex_param, $search_param);

        ?>
          <!-- Service menu item end -->
        </div>
      </div>
    </section>

    <!-- Service Section end -->


    <!-- Contact Section end -->

    <!-- Copyright -->
    <!-- JS Link -->
    <script src="../assets/js/script.js"></script>

    <!-- AOS JS -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
      integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <script>
      let slideIndex = 1;
      showSlides(slideIndex);

      function plusSlides(n) {
        showSlides((slideIndex += n));
      }

      function currentSlide(n) {
        showSlides((slideIndex = n));
      }

      function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
          slideIndex = 1;
        }
        if (n < 1) {
          slideIndex = slides.length;
        }
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 2000); // Change image every 2 seconds
      }
    </script>

    <script>
      AOS.init({
        duration: 600,
      });
    </script>

    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
  </body>
</html>
