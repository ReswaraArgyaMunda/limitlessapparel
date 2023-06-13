<?php
session_start();
require '../function/connect.php';
require '../function/query_function.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <title>LIMITLESS</title>
    <style>

@import url("https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,700;1,400;1,700&display=swap");
* {
  margin: 0;
  padding: 0;
  font-family: "Roboto Condensed", sans-serif;
  box-sizing: border-box;
  scroll-behavior: smooth;
  outline: none;
  list-style: none;
  text-decoration: none;
}

        @media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}

.card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;
}

.card-registration .select-arrow {
top: 13px;
}

.bg-grey {
background-color: #eae8e8;
}

@media (min-width: 992px) {
.card-registration-2 .bg-grey {
border-top-right-radius: 16px;
border-bottom-right-radius: 16px;
}
}

@media (max-width: 991px) {
.card-registration-2 .bg-grey {
border-bottom-left-radius: 16px;
border-bottom-right-radius: 16px;
}
}
    </style>

   </head>

   <body style="background-color:rgb(255, 248, 237)">
   <section class="h-100 h-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              
            <?php
            $awd = $_SESSION['session_username'];
            query_cart($awd);
            ?>



            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
   
   </body>


    

    
    <!-- Contact Section end -->

    <!-- Copyright -->
    <!-- JS Link -->
    <script src="../assets/js/script.js"></script>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>
