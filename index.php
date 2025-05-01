<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking.com - HOME</title>
    
    <?php require('inc/link.php');?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- swipper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
    #bb{
      background-color: #06a896;
      border: solid 1px #09f2d8;
    }
    #bb:hover{
      background-color: #048274;
      border: solid 1px #08f4da; 
      font-weight: 600;
      
    }



    #more{
      background-color: #0066d1;
      border: solid 1px #57bbf9;
      color: white;
    }

    #more:hover{
      background-color: #053c9a;
      border: solid 1px #05619a;
      color: white;
      font-weight: 600;
    }



    .availability-form{
      margin-top: -50px;
      z-index: 2;
      position: relative;
    }
    @media screen and (max-width: 575px){
      .availability-form{
        margin-top: 25px;
        padding: 0 35px;
      }
    }
    </style>
</head>

<body class="bg-light">
  <!-- navbar-->
  <?php require('inc\header.php');?>

  <!-- carousel -->
  <div class="container-fluid px-lg-3 mt-4">
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="Hotel-Booking-Website-Assets/images/carousel/IMG_15372.png" class="w-100 d-block" />
        </div>
        <div class="swiper-slide">
          <img src="Hotel-Booking-Website-Assets/images/carousel/IMG_40905.png" class="w-100 d-block"/>
        </div>
        <div class="swiper-slide">
          <img src="Hotel-Booking-Website-Assets/images/carousel/IMG_55677.png" class="w-100 d-block"/>
        </div>
        <div class="swiper-slide">
          <img src="Hotel-Booking-Website-Assets/images/carousel/IMG_62045.png" class="w-100 d-block"/>
        </div>
        <div class="swiper-slide">
          <img src="Hotel-Booking-Website-Assets/images/carousel/IMG_93127.png" class="w-100 d-block"/>
        </div>
        <div class="swiper-slide">
          <img src="Hotel-Booking-Website-Assets/images/carousel/IMG_99736.png" class="w-100 d-block"/>
        </div>
      </div>
    </div>
  </div>

  <!-- check availability form -->
  <div class="container availability-form">
    <div class="row">
      <div class="col-lg-12 bg-white shadow p-4 rounded">
        <h5 class="mb-4">Check Booking Availability</h5>
        <form>
          <div class="row align-items-end">
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight:500;">Check-in</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight:500;">Check-out</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <!-- adults -->
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight:500;">Adults</label>
              <select class="form-select shadow-none">
                <option selected>2 Adults</option>
                <option value="1">1 Adult</option>
                <option value="2">2 Adults</option>
              </select>
            </div>
            <!-- children -->
            <div class="col-lg-2 mb-3">
              <label class="form-label" style="font-weight:500;">Children</label>
              <select class="form-select shadow-none">
                <option selected>2 children</option>
                <option value="1">1 child</option>
                <option value="2">2 children</option>
              </select>
            </div>
            <!-- button -->
            <div class="col-lg-1 mb-lg-3 mt-2">
              <button type="submit" class="btn btn-primary shadow-none custom-bg" id="bb">Search</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Our Rooms -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <img src="Hotel-Booking-Website-Assets/images/rooms/1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5>Simple Room Name</h5>
            <h6 class="mb-4"> £2000 per night </h6>
            <div class="features mb-4">
              <h6 class="mb-1">features</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Rooms.
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Bathroom.
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Balcony.
              </span>
            </div>
            <div class="Facilities mb-4">
              <h6 class="mb-1">Facilities</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Rooms.
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Bathroom.
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Balcony.
              </span>
            </div>
            <div class="rating mb-4">
              <h6 class="mb-1">Rating</h6>
              <span class="badge rounded bg-light">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span>
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <a href="javascript:void(0)" class="btn btn-primary text-white custom-bg shadow-none book-now-button" 
                 data-checkout-url="https://booking.lemonsqueezy.com/buy/d1e0224e-ec01-416b-bfb5-006ba1f2c79a" id="bb">Book Now</a>
              <a href="#" class="btn btn-primary btn-outline-dark shadow-none" id="more">More details</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <img src="Hotel-Booking-Website-Assets/images/rooms/IMG_11892.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5>Simple Room Name</h5>
            <h6 class="mb-4"> £2000 per night </h6>
            <div class="features mb-4">
              <h6 class="mb-1">features</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Rooms.
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Bathroom.
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Balcony.
              </span>
            </div>
            <div class="Facilities mb-4">
              <h6 class="mb-1">Facilities</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Rooms.
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Bathroom.
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Balcony.
              </span>
            </div>
            <div class="rating mb-4">
              <h6 class="mb-1">Rating</h6>
              <span class="badge rounded bg-light">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span>
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <a href="javascript:void(0)" class="btn btn-primary text-white custom-bg shadow-none book-now-button" 
                 data-checkout-url="https://booking.lemonsqueezy.com/buy/d1e0224e-ec01-416b-bfb5-006ba1f2c79a"id="bb">Book Now</a>
              <a href="#" class="btn btn-primary btn-outline-dark shadow-none" id="more">More details</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <img src="Hotel-Booking-Website-Assets/images/rooms/IMG_39782.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5>Simple Room Name</h5>
            <h6 class="mb-4"> £2000 per night </h6>
            <div class="features mb-4">
              <h6 class="mb-1">features</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Rooms.
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Bathroom.
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Balcony.
              </span>
            </div>
            <div class="Facilities mb-4">
              <h6 class="mb-1">Facilities</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Rooms.
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Bathroom.
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Balcony.
              </span>
            </div>
            <div class="rating mb-4">
              <h6 class="mb-1">Rating</h6>
              <span class="badge rounded bg-light">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span>
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <a href="javascript:void(0)" class="btn btn-primary text-white custom-bg shadow-none book-now-button" 
                 data-checkout-url="https://booking.lemonsqueezy.com/buy/d1e0224e-ec01-416b-bfb5-006ba1f2c79a" id="bb">Book Now</a>
              <a href="#" class="btn btn-primary btn-outline-dark shadow-none" id="more">More details</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 text-center mt-5">
        <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms</a>
      </div>
    </div>
  </div>

  <!-- Our Facilities -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
  <div class="container">
    <div class="row justify-content-between px-lg-0 px-md-0 px-5">
      <div class="col-lg-2 col-md-2 text-center bg-light rounded shadow py-4 my-3">
        <img src="Hotel-Booking-Website-Assets/images/facilities/IMG_43553.svg" alt="" width="80px">
        <h5 class="mt-3">Wifi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-light rounded shadow py-4 my-3">
        <img src="Hotel-Booking-Website-Assets/images/facilities/IMG_41622.svg" alt="" width="80px">
        <h5 class="mt-3">Wifi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-light rounded shadow py-4 my-3">
        <img src="Hotel-Booking-Website-Assets/images/facilities/IMG_47816.svg" alt="" width="80px">
        <h5 class="mt-3">Wifi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-light rounded shadow py-4 my-3">
        <img src="Hotel-Booking-Website-Assets/images/facilities/IMG_49949.svg" alt="" width="80px">
        <h5 class="mt-3">Wifi</h5>
      </div> 
      <div class="col-lg-2 col-md-2 text-center bg-light rounded shadow py-4 my-3">
        <img src="Hotel-Booking-Website-Assets/images/facilities/IMG_96423.svg" alt="" width="80px">
        <h5 class="mt-3">Wifi</h5>
      </div>
      <div class="col-lg-12 text-center mt-5">
        <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities</a>
      </div>
    </div>
  </div>

  <!-- Testimonial -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Testimonial</h2>
  <div class="container mt-5">
    <div class="swiper swiper-testimonial">
      <div class="swiper-wrapper">
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="Hotel-Booking-Website-Assets/images/testimonials/IMG_12345" width="30px">
            <h6 class="m-0 ms-2">king</h6>
          </div>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus ea animi commodi, voluptates
           saepe dicta ut quos a. Nam suscipit itaque sed consequuntur cum aperiam reiciendis 
           unde nisi molestiae facilis?</p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="Hotel-Booking-Website-Assets/images/testimonials/IMG_12345" width="30px">
            <h6 class="m-0 ms-2">king</h6>
          </div>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus ea animi commodi, voluptates
           saepe dicta ut quos a. Nam suscipit itaque sed consequuntur cum aperiam reiciendis 
           unde nisi molestiae facilis?</p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="Hotel-Booking-Website-Assets/images/testimonials/IMG_12345" width="30px">
            <h6 class="m-0 ms-2">king</h6>
          </div>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus ea animi commodi, voluptates
           saepe dicta ut quos a. Nam suscipit itaque sed consequuntur cum aperiam reiciendis 
           unde nisi molestiae facilis?</p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
    <div class="col-lg-12 text-center mt-5">
      <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know More</a>
    </div>
  </div>

  <!-- Reach US -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Reach US</h2>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
        <iframe class="w-100 rounded" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158858.5851838428!2d-0.26640253299971084!3d51.52852620463016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C%20UK!5e0!3m2!1sen!2s!4v1739004948143!5m2!1sen!2s" loading="lazy"></iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="bg-white p-4 rounded mb-4">
          <h5>Call us</h5>
          <a href="tel:+923355392030" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-outbound-fill me-1"></i> +923355392030
          </a>
        </div>
        <div class="bg-white p-4 rounded mb-4">
          <h5>Follow us</h5>
          <a href="#" class="d-inline-block mb-2">
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-facebook me-1"></i> facebook
            </span>
          </a>
          <a href="#" class="d-inline-block mb-2">
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-instagram me-1"></i> Instagram
            </span>
          </a>
          <a href="#" class="d-inline-block mb-2">
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-twitter me-1"></i> Twitter
            </span>
          </a>
        </div>
        <div class="bg-white p-4 rounded mb-4">
          <h5>Call us</h5>
          <a href="tel:+923355392030" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-outbound-fill"></i> +923355392030
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php require('inc/footer.php');?>

  <!-- Lemon Squeezy Script -->
  <script src="https://app.lemonsqueezy.com/js/lemon.js"></script>

  <!-- Initialize Lemon Squeezy Buttons -->
  <script>
    function initializeLemonSqueezyButtons(buttonSelector) {
      const buttons = document.querySelectorAll(buttonSelector);
      buttons.forEach(button => {
        const checkoutUrl = button.getAttribute('data-checkout-url');
        if (checkoutUrl) {
          button.addEventListener('click', (event) => {
            event.preventDefault();
            LemonSqueezy.Url.Open(checkoutUrl, {
              embed: 0,
              media: 0,
              logo: 0,
              discount: 0,
              dark: 0,
              test_mode: 1
            });
          });
        }
      });
    }

    document.addEventListener('DOMContentLoaded', () => {
      initializeLemonSqueezyButtons('.book-now-button');
    });
  </script>

  <!-- Initialize Swiper carousel -->
  <script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      }
    });

    var swiper = new Swiper(".swiper-testimonial", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView: "3",
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        }
      }
    });
  </script>
</body>
</html>