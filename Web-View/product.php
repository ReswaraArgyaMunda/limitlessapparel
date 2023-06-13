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
    <!-- Style Link -->
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


    <!-- Product -->
    <section class="product-section">
      <?php
      query_product();
      ?>
    </section>
    <!-- Product End -->

    <script>
  var total_price_value = document.getElementById('total-price-value');
  var temp_price = document.getElementById('price-temp');
  var input_qty = document.getElementById('qty-input');

  input_qty.addEventListener('input', function() {
    var totalPriceValue = input_qty.value * parseInt(temp_price.textContent);
    total_price_value.textContent = 'Rp.' + totalPriceValue.toLocaleString();
  });
</script>

    <script>
      AOS.init({
        duration: 600,
      });
    </script>

    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
  </body>
</html>
