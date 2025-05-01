<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking.com - Facilities</title>
    
    <?php require('inc/link.php');?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- swipper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
      .pop:hover{
        border-top-color: var(--teal) !important;
        transform: scale(1.03);
        transition: all 0.3s;
      }


      #mm{
        background-color: #0066d1;
        border: solid 1px #57bbf9;
        color: white;
      }


      #mm:hover {
        background-color: #053c9a;
        border: solid 1px #05619a;
        color: white;
        font-weight: 600;
      }

      #b:hover {

    background-color: #2c2c2c;
    border: solid 1px #2c2c2c;
    font-weight: 600;

      }

      #b {

    background-color: #048274;
    border: solid 1px #08f4da;

      }






    </style>
</head>

<body class="bg-light">
  <!-- navbar-->
  <?php require('inc/header.php');?>

  <div class="my-5 px-4">
    <h2 class="text-center fw-bold h-font"> OUR ROOMS</h2>
    <div class="h-line bg-dark"></div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-3">
      <nav class="navbar navbar-expand-lg bg-body-tertiary bg-white rounded shadow">
        <div class="container-fluid flex-lg-column align-items-stretch">
          <h4 class="mt-2">FILTER</h4>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#filterdropdown" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- check Avalibility -->
          <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterdropdown">
            <div class="border bg-light p-3 rounded mb-3">
              <h5 class="mb-3" style="font-size: 18px;">Check Avalibility</h5>
              <label class="form-label" style="font-weight:500;">Check-in</label>
              <input type="date" class="form-control shadow-none mb-3">
              <label class="form-label" style="font-weight:500;">Check-out</label>
              <input type="date" class="form-control shadow-none">
            </div>

            <!--Facilties -->
            <div class="border bg-light p-3 rounded mb-3">
              <h5 class="mb-3" style="font-size: 18px;">Facilities</h5>
              <div class="mb-3">
                <input class="form-check-in shadow-none mb-3" type="checkbox" id="flexCheckDefault">
                <label class="form-label">Wifi</label>
              </div>
              <div class="mb-3">
                <input class="form-check-in shadow-none mb-3" type="checkbox" id="flexCheckDefault">
                <label class="form-label">king</label>
              </div>
              <div class="mb-3">
                <input class="form-check-in shadow-none mb-3" type="checkbox" id="flexCheckDefault">
                <label class="form-label">Wifi</label>
              </div>
              <div class="mb-3">
                <input class="form-check-in shadow-none mb-3" type="checkbox" id="flexCheckDefault">
                <label class="form-label">Wifi</label>
              </div>
            </div>

            <!--Guests -->
            <div class="border bg-light p-3 rounded mb-3">
              <h5 class="mb-3" style="font-size: 18px;">Guests</h5>
              <div class="d-flex">
                <div class="mb-3">
                  <label class="form-label" style="font-weight:500;">Adults</label>
                  <input type="Number" class="form-control shadow-none mb-3">
                </div>
                <div class="mb-3">
                  <label class="form-label" style="font-weight:500;">Childrens</label>
                  <input type="Number" class="form-control shadow-none mb-3">
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
      </div>

      <div class="col-lg-9 col-md-12 px-4">
        <div class="card mb-3 border-0 shadow ">
          <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-md-0 md-3">
              <img src="Hotel-Booking-Website-Assets/images/rooms/IMG_70583.png" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px-0">
              <h5 class="mb-3">Simple Room Name</h5>
              <div class="features mb-3">
                <h6 class="mb-2">features</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Rooms.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Bathroom.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap px-3">
                  2 Balcony.
                </span>
              </div>
              <div class="Facilities mb-3">
                <h6 class="mb-1">Facilities</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Rooms.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Bathroom.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Balcony.
                </span>
              </div>
              <div class="rating mb-4">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  4 Childrens.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Adults.
                </span>
              </div>
            </div>
            <div class="col-md-2 text-align-center">
              <h6 class="mb-4"> $200 per night</h6>
              <a href="javascript:void(0)" class="btn btn-success w-100 text-white custom-bg shadow-none mb-2 book-now-button" 
                 data-checkout-url="https://booking.lemonsqueezy.com/buy/d1e0224e-ec01-416b-bfb5-006ba1f2c79a" id="b">Book Now</a>
              <a href="#" class="btn btn-success w-100 btn-outline-dark shadow-none" id="mm">More details </a> 
            </div>
          </div>
        </div>

        <!-- 2 -->
        <div class="card mb-3 border-0 shadow ">
          <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-md-0 md-3">
              <img src="Hotel-Booking-Website-Assets/images/rooms/IMG_11892.png" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px-0">
              <h5 class="mb-3">Simple Room Name</h5>
              <div class="features mb-3">
                <h6 class="mb-2">features</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Rooms.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Bathroom.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap px-3">
                  2 Balcony.
                </span>
              </div>
              <div class="Facilities mb-3">
                <h6 class="mb-1">Facilities</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Rooms.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Bathroom.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Balcony.
                </span>
              </div>
              <div class="rating mb-4">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  4 Childrens.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Adults.
                </span>
              </div>
            </div>
            <div class="col-md-2 text-align-center">
              <h6 class="mb-4"> $200 per night</h6>
              <a href="javascript:void(0)" class="btn btn-success w-100 text-white custom-bg shadow-none mb-2 book-now-button" 
                 data-checkout-url="https://booking.lemonsqueezy.com/buy/d1e0224e-ec01-416b-bfb5-006ba1f2c79a" id="b">Book Now</a>
              <a href="#" class="btn btn-success w-100 btn-outline-dark shadow-none" id="mm">More details </a>
            </div>
          </div>
        </div>

        <!-- 3 -->
        <div class="card mb-3 border-0 shadow ">
          <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-md-0 md-3">
              <img src="Hotel-Booking-Website-Assets/images/rooms/IMG_78809.png" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px-0">
              <h5 class="mb-3">Simple Room Name</h5>
              <div class="features mb-3">
                <h6 class="mb-2">features</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Rooms.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Bathroom.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap px-3">
                  2 Balcony.
                </span>
              </div>
              <div class="Facilities mb-3">
                <h6 class="mb-1">Facilities</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Rooms.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Bathroom.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Balcony.
                </span>
              </div>
              <div class="rating mb-4">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  4 Childrens.
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Adults.
                </span>
              </div>
            </div>
            <div class="col-md-2 text-align-center">
              <h6 class="mb-4"> $200 per night</h6>
              <a href="javascript:void(0)" class="btn btn-success w-100 text-white custom-bg shadow-none mb-2 book-now-button" 
                 data-checkout-url="https://booking.lemonsqueezy.com/buy/d1e0224e-ec01-416b-bfb5-006ba1f2c79a" id="b">Book Now</a>
              <a href="#" class="btn btn-success w-100 btn-outline-dark shadow-none" id="mm">More details </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php require('inc/footer.php');?>

  <!-- Lemon Squeezy Script -->
  <script src="https://app.lemonsqueezy.com/js/lemon.js"></script>
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
</body>
</html>