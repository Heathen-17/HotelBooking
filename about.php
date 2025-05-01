<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking.com - ABOUT</title>
    
    <?php require('inc/link.php');?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- swipper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
      .box:hover{
        border-top-color: var(--teal) !important;

     }
    </style>



  </head>

<body class="bg-light">
  <!-- navbar-->
  <?php require('inc/header.php');?>


  <div class="my-5 px-4">
    <h2 class="text-center fw-bold h-font"> ABOUT Us</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium 
      similique illum porro nisi autem quibusdam unde <br>debitis soluta magnam officiis recusandae, 
      fuga eum nostrum nemo ipsam eaque amet impedit voluptatum.</p>
  </div>


  <div class="container">
    <div class="row justify-content-between align-item-center">
      <div class="col-lg-6 col-md-5 mb-4 order-md-1 order-2">
        <h3 class="mb-3">Laorem ispns dolor sit </h3>
        <p>
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
          Hic facere in alias adipisci atque. Non provident, sequi magnam 
          delectus consequuntur nulla at, sed quam itaque ab maxime alias. Repudiandae, eveniet.
        </p>
        </div>

        <div class="col-lg-5 col-md mb-4  order-md-2 order-1">
          <img src="Hotel-Booking-Website-Assets/images/about/about.jpg" class="w-100">
        </div>
        
      </div>
    </div>
  </div>

  <!-- our hotel Mansgment-->
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="Hotel-Booking-Website-Assets/images/about/customers.svg" width="70px">
          <h4 class="mt-3">200+ Customer</h4>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="Hotel-Booking-Website-Assets/images/about/hotel.svg" width="70px">
          <h4 class="mt-3">100+ ROOMS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="Hotel-Booking-Website-Assets/images/about/hotel.svg" width="70px">
          <h4 class="mt-3">150+ REVIEWS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="Hotel-Booking-Website-Assets/images/about/rating.svg" width="70px">
          <h4 class="mt-3">100+ RATINF</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="Hotel-Booking-Website-Assets/images/about/staff.svg" width="70px">
          <h4 class="mt-3">200+ STAFF</h4>
        </div>
      </div>
    </div>
  </div>



  <!-- Managment -->
  <h3 class="my-5 text-center fw-bold  h-font">Managment Team</h3>
  <div class="container px-4">
  <div class="swiper mySwiper">
    <div class="swiper-wrapper mb-5">
      <div class="swiper-slide bg-white text-center rounded">
        <img src="Hotel-Booking-Website-Assets/images/about/IMG_17352.jpg" class="w-100">
        <h5 class="mt-2">hello</h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="Hotel-Booking-Website-Assets/images/about/IMG_17352.jpg" class="w-100">
        <h5 class="mt-2">hello</h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="Hotel-Booking-Website-Assets/images/about/IMG_17352.jpg" class="w-100">
        <h5 class="mt-2">hello</h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="Hotel-Booking-Website-Assets/images/about/IMG_17352.jpg" class="w-100">
        <h5 class="mt-2">hello</h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="Hotel-Booking-Website-Assets/images/about/IMG_17352.jpg" class="w-100">
        <h5 class="mt-2">hello</h5>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
  </div>

<!--footer -->
<?php require('inc/footer.php');?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
  slidesPerView:4,
  spaceBetween: 40,
    pagination: {
      el: ".swiper-pagination",
    },
    breakpoints: {
      320:{
        slidesPerView: 1,
      },
      640:{
        slidesPerView: 1,
      },
      768:{
        slidesPerView: 3,
      },
      1024:{
        slidesPerView: 3,
      }
    }
  });
</script>
    
</body>