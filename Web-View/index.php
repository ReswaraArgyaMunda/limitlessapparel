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
    <style>
      .mySlides {
        display: none;
      }

      /* Slideshow container */
      .slideshow-container {
        max-width: 100%;
        position: relative;
        margin: auto;
      }

      /* Next & prev-slideious buttons */
      .prev-slide,
      .next-slide {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -22px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
      }

      /* Caption text */
      .dot-containter {
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
      }

      /* Position the "next button" to the right */
      .next-slide {
        right: 0;
        border-radius: 3px 0 0 3px;
      }

      /* On hover, add a black background color with a little bit see-through */
      .prev-slide:hover,
      .next-slide:hover {
        background-color: rgba(0, 0, 0, 0.8);
      }

      /* Caption text */

      /* Number text (1/3 etc) */
      .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
      }

      /* The dots/bullets/indicators */
      .dot-containter .dot {
        cursor: pointer;
        height: 10px;
        width: 10px;
        margin: 0 2px;
        background-color: #000000;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
      }

      .active,
      .dot-containter .dot:hover {
        background-color: #ffffff;
        border: 0.1px solid black;
      }

      /* Fading animation */
      .fade {
        animation-name: fade;
        animation-duration: 1.5s;
      }

      @keyframes fade {
        from {
          opacity: 0.4;
        }
        to {
          opacity: 1;
        }
      }
    </style>

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
          <a class="nav-section" href="#categories" onclick="toggleMenu();">
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

    <section class="promo-slideshow">
      <div class="slideshow-container">
        <div class="mySlides fade">
          <img
            src="../assets/image/banner1.png"
            style="width: 100%"
          />
          <div class="dot-containter">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
          </div>
        </div>

        <div class="mySlides fade">
          <img src="../assets/image/banner2.png" style="width: 100%" />
          <div class="dot-containter">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
          </div>
        </div>

        <div class="mySlides fade">
          <img src="../assets/image/banner3.png" style="width: 100%" />
          <div class="dot-containter">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
          </div>
        </div>

        <a class="prev-slide" onclick="plusSlides(-1)">❮</a>
        <a class="next-slide" onclick="plusSlides(1)">❯</a>
      </div>
      <br />
    </section>

    <!-- Landing Page Start -->
    <div class="home-title">
      <h1>
        WE ARE TOGETHER
        <i class="fa-solid fa-arrow-right">
          <i class="fa-solid fa-arrow-up"></i
        ></i>
        <i class="fa-solid fa-arrow-down"></i>
        <i class="fa-solid fa-arrow-left"></i>
      </h1>
      <p>Never Stop, Never Surrender</p>
    </div>

    <section class="home" id="home">
      <!-- Hero Image-->
      <div class="home-image"></div>

      <!-- Hero Content -->
      <div class="home-content">
        <div class="home-motto">
          <h3>
            "Embrace the Infinite Possibilities of Limitless Fashion
            Exploration"
          </h3>
          <a href="products.php" class="btn-1">
            Shop Now
          </a>
        </div>
      </div>
    </section>

    <div class="home-title-2">
      <h1>
        THE HIGHEST LEVEL
        <i class="fa-sharp fa-solid fa-chevron-up"></i>
        <i class="fa-sharp fa-solid fa-chevron-up"></i>
        <i class="fa-sharp fa-solid fa-chevron-up"></i>
      </h1>
      <p>To be on the top, on the highest.</p>
    </div>

    <section class="home" id="home">
      <!-- Hero Image-->

      <!-- Hero Content -->
      <div class="home-content-2">
        <div class="home-motto-2">
          <h3>"Expressive Touches Representing a Fashionable Self-Identity"</h3>
          <p>
            Implies that the individual's personal style choices and fashion
            preferences are reflective of their unique personality and fashion
            sense. It suggests that through their fashion choices, they are able
            to creatively express themselves and showcase their distinct
            identity.
          </p>
          <a href="products.php" class="btn-1">
            SEE MORE
          </a>
        </div>
      </div>
      <div class="home-image-2"></div>
    </section>

    <!-- Landing Page end -->

    <!-- About Section Start -->

    <!-- System Section start -->

    <!-- System Section end -->

    <!-- Service Section start -->
    <div class="product-title">
      <h1>
        <i class="fa-sharp fa-solid fa-chevron-right"></i>
        <i class="fa-sharp fa-solid fa-chevron-right"></i>
        <i class="fa-sharp fa-solid fa-chevron-right"></i>
        RECOMMEDED FOR YOU <i class="fa-sharp fa-solid fa-chevron-left"></i>
        <i class="fa-sharp fa-solid fa-chevron-left"></i>
        <i class="fa-sharp fa-solid fa-chevron-left"></i>
      </h1>
      <p>Choose The Best of all</p>
    </div>

    <section class="service" id="service">
      <div class="container">
        <div class="menu">

        <?php
          query_products(6, '', '', '');

        ?>




          <!-- Service menu item end -->

          <!-- Service menu end -->

          <!-- Servce menu item start -->

          <!-- Service menu item end -->

          <!-- Service menu item start -->

        
          <!-- Service menu item end -->
        </div>
      </div>
    </section>

    <!-- Service Section end -->

    <!-- OurMember Section start -->
    <div class="home-title-3">
      <h1>
        FROM OUR COMMUNITY
        <i class="fa-solid fa-hand-fist"></i>
        <i class="fa-solid fa-hand-fist"></i>
      </h1>
      <p>Never Stop, Never Surrender</p>
    </div>

    <section class="home-3" id="home-3">
      <!-- Hero Image-->
      <div class="home-image-3"></div>

      <!-- Hero Content -->
      <div class="home-content-3">
        <div class="home-motto-3"></div>
      </div>
    </section>
    <!-- OurMember Section end -->

    <!-- Contact Section start -->

    <div class="home-title" style="margin-top:4rem;">
      <h1 style="text-align:center">
      <i class="fa-sharp fa-solid fa-chevron-right"></i>
      <i class="fa-sharp fa-solid fa-chevron-right"></i>
      <i class="fa-sharp fa-solid fa-chevron-right"></i>
        CATEGORIES
        <i class="fa-sharp fa-solid fa-chevron-left"></i>
        <i class="fa-sharp fa-solid fa-chevron-left"></i>
        <i class="fa-sharp fa-solid fa-chevron-left"></i>

      </h1>
    </div>

    <section class="type-product" id="categories">
      <div class="content">
        <!-- Testi item start -->
        <a href="products.php?category=skirt">

        <div class="box" data-aos="fade-up" data-aos-delay="100">
          <div class="imgBx">
            <img src="../assets/image/Parley Skirt.jpg" alt="" />
          </div>
          <div class="text">

            <h3>S K I R T </h3>
          </div>
        </div>
        </a>

        <a href="products.php?category=jacket">
          
        <div class="box" data-aos="fade-up" data-aos-delay="100">
          <div class="imgBx">
            <img src="../assets/image/Bold Sport Jacket.jpg" alt="" />
          </div>
          <div class="text">
      
            <h3>J A C K E T</h3>
          </div>
        </div>
        </a>


        <a href="products.php?category=T-shirt">
          
        <div class="box" data-aos="fade-up" data-aos-delay="100">
          <div class="imgBx">
            <img src="../assets/image/Trefoil T-Shirt.jpg" alt="" />
          </div>
          <div class="text">
           
            <h3>T - S H I R T </h3>
          </div>
        </div>
        </a>


        <a href="products.php?category=dress">
        <div class="box" data-aos="fade-up" data-aos-delay="100">
          <div class="imgBx">
            <img src="../assets/image/Dress Poplin Essentials.jpg" alt="" />
          </div>
          <div class="text">
        
            <h3>D R E S S </h3>
          </div>
        </div>
        </a>


        <a href="products.php?category=leggings">
        <div class="box" data-aos="fade-up" data-aos-delay="100">
          <div class="imgBx">
            <img src="../assets/image/Dailyrun Leggings.jpg" alt="" />
          </div>
          <div class="text">
        
            <h3>L E G G I N G S </h3>
          </div>
        </div>
        </a>


        <a href="products.php?category=Track Top">
        <div class="box" data-aos="fade-up" data-aos-delay="100">
          <div class="imgBx">
            <img src="../assets/image/tracktop.jpg" alt="" />
          </div>
          <div class="text">
        
            <h3>T R A C K  T O P  </h3>
          </div>
        </div>
        </a>



        <!-- Testi item end -->
      </div>
    </section>

    <section class="contact" id="contact">
      <div class="container">
        <div class="box">
          <div class="icon-container" data-aos="fade-up">
            <div class="icons" data-aos="fade-up" data-aos-delay="100">
              <span><ion-icon name="compass"></ion-icon>Location :</span>
              <p>St Winangun No.10 Manado, Sulawesi Utara</p>
            </div>
            <div class="icons" data-aos="fade-up" data-aos-delay="200">
              <span><ion-icon name="mail"></ion-icon>Email :</span>
              <p>limitlessapparel@gmail.com</p>
            </div>
            <div class="icons" data-aos="fade-up" data-aos-delay="200">
              <span> <ion-icon name="call"></ion-icon>Phone Number :</span>
              <p>08123456789</p>
            </div>
            <div class="icons" data-aos="fade-up" data-aos-delay="200">
              <span> <ion-icon name="logo-instagram"></ion-icon>  Instagram :</span>
              <p>@limitless_apparel</p>
            </div>
            <div class="icons" data-aos="fade-up" data-aos-delay="200">
              <span> <ion-icon name="logo-facebook"></ion-icon>Facebook : </span>
              <p>Limitless Apparel</p>
            </div>




          </div>
        </div>

      </div>
    </section>

    <footer>
      <div class="footer-container">
        <p> Guides | Privacy | Policy | © 2023 limitless apparel</p>
      </div> 


    </footer>

    
    <!-- Contact Section end -->

    <!-- Copyright -->
    <!-- JS Link -->
    <script src="../assets/js/script.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- AOS JS -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
      integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <script>
      var form = document.getElementById('search-form');

// Menangani event keydown pada elemen formulir
form.addEventListener('keydown', function(event) {
  // Mengambil kode tombol yang ditekan
  var keyCode = event.keyCode || event.which;

  // Cek jika tombol Enter ditekan (kode 13)
  if (keyCode === 13) {
    // Mencegah aksi default (pindah ke baris berikutnya)
    event.preventDefault();

    // Submit formulir
    form.submit();
  }
});
    </script>

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
