<?php
session_start();    //create or retrieve session
if (isset($_SESSION["email"])) { //user must in session to stay here
  $email = $_SESSION["email"];   //get user email into the variable $email
  $first_name = ucfirst($_SESSION['first_name']); // ucfirst capitalises the first name
  $last_name = ucfirst($_SESSION['last_name']);
}
$returnPrice = $_SESSION['return_price'] ?? 0;
if (isset($_SESSION['returndate']) && strpos($_SERVER['HTTP_REFERER'], 'seatsreturn.php') !== false) {

  $returnBusId =  $_SESSION['return_bus_id'];

  $_SESSION['return_selected_seat'] = $_POST['selected_seat'];
}
// if (strpos($_SERVER['HTTP_REFERER'], 'seats.php' !== false)) {
//     $_SESSION['selected_seat'] = $_POST['selected_seat'];
//     // save it into session
// }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_seat']) && strpos($_SERVER['HTTP_REFERER'], 'seats.php') !== false) {
  $_SESSION['selected_seat'] = $_POST['selected_seat'];
}

$seat = $_SESSION['selected_seat'];
$returnSeat = $_SESSION['return_selected_seat'] ?? '';
$busId =  $_SESSION['bus_id'];
$price = $_SESSION['price'];
$totalprice = ($price + $returnPrice);
$_SESSION['total_price'] = $totalprice;

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0 minimum-scale=1, maximum-scale=1">
  <title>Payment</title>
  <link rel="stylesheet" href="./Assets/css/stylenew.css">
  <link rel="stylesheet" href="unsemantic-grid-responsive-tablet.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap-theme.min.css">
  <!-- js for return button -->
  <script src="../app2.js"></script>
  <style>
    .label-width {
      width: 150px;
    }

    .input-width {
      width: 100%;
    }
  </style>
</head>

<body>
  <header class="container">
    <div class="col-md-12">
      <div id="headerContainer" class="row">
        <div class="col-md-2">
          <img id="buslogo" src="./Assets/Buslogo.png" alt="Edge Bus Logo">
        </div>

        <div class="col-md-10">
          <nav>
            <ul class="nav justify-content-end">
              <?php

              // echo $seat .'<br>';
              // echo $returnBusId .'<br>';
              // echo $_SESSION['price'] . "<br>";
              // echo  . "<br>";
              // echo $_SESSION['bus_id'] . "<br>";
              // echo . "<br>";
              // echo $_SESSION['selected_seat'];
              if (isset($_SESSION["email"])) { ?>
                <li><a href="profile.php" class="nav-item">My Account</a></li>
                <li><a href="about.php" class="nav-item">About Us</a></li>
                <li><a href="contactus.php" class="nav-item">Contact Us</a></li>

                <li>
                  <p>
                    Hello <?php print $first_name; ?>!
                  </p>
                </li>
                <li><a href="logout.php">Logout</a></li>
              <?php } else { ?>
                <li><a href="home.html" class="nav-item active">Home</a></li>
                <li><a href="about.php" class="nav-item">About Us</a></li>
                <li><a href="contactus.php" class="nav-item">Contact Us</a></li>
                <li><a href="login.html" class="nav-item">Sign-in|Sign up</a></li>
              <?php } ?>

            </ul>
          </nav>
        </div>
      </div>
    </div>

  </header>
  <div class="container">
    <div class="py-9">


      <h2 style="text-align: center;">Payment Gateway</h2>
      <h6 style="text-align: center;">Pay with Card</h6>

    </div>

  </div>
  </div>
  <br>
  <div class="container text-center">
    <h3>Amount to Pay: <?php echo '£' . ($totalprice); ?></h3>

  </div>
  <form method="post" action="payvalidate.php">
    <div class="row">
      <div class="col-md-6">
        <label for="first_name" class="form-label label-width">First Name</label>
        <input type="text" name="first_n" class="form-control input-width" value="<?php echo $first_name ?? ''; ?>" required>
      </div>
      <div class="col-md-6">
        <label for="last_name" class="form-label label-width">Last Name</label>
        <input type="text" name="last_n" class="form-control input-width" value="<?php echo $last_name ?? ''; ?>" required>
      </div>
      <br>
      <div class="col-md-6">
        <label for="cardholder" class="form-label label-width">Cardholder Name</label>
        <input type="text" class="form-control input-width">
        <small class="text">Name as displayed on Card</small>
        <div class="invalid-feedback">
          Card Holder Name Required
        </div>
        <br>
      </div>
      <div class="col-md-6">
        <label for="cardnumber" class="form-label label-width">Card Number</label>
        <input id="cardnumber" type="number" placeholder="1111222233334444" name="card_number" class="form-control input-width" required>
        <div class="invalid-feedback">
          Card Number required
        </div>
      </div>
      <br>
      <div class="col-md-6">
        <label for="cardExpiremnth" class="form-label label-width">Expiration Month</label>
        <input id="cardExpire" type="number" placeholder="01" name="expiry_month" class="form-control input-width" required>
        <div class="invalid-feedback">
          expiration details required
        </div>
      </div>
      <div class="col-md-6">
        <label for="cardExpireyr" class="form-label label-width">Expiration Year</label>
        <input id="cardExpire" type="number" placeholder="2027" name="expiry_year" class="form-control input-width" required>
        <div class="invalid-feedback">
          expiration details required
        </div>
      </div>
      <div class="col-md-6">
        <label for="cvv" class="form-label label-width">CVV</label>
        <input id="CVV" type="number" placeholder="123" name="cvv" class="form-control input-width" required>
        <div class="invalid-feedback">
          CVV required
        </div>
      </div>

    </div>
    <hr class="my-4">
    <button class="btn btn-primary btn-lg btn-block"> Make Payment</button>
  </form>

  </div>
  <footer>
    <hr>
    <div class="container">
      <div class="col-md-12" id="lastleft">
        <div id="footercontainer" class="row">
          <section class="col-md-3">
            <!-- <a href="contactus.html"><h4>Contact Us</h4></a> -->
            <ul>
              <li>Email: info@xxxxbus.com</li>
              <li>Phone No.: +44 7498 xxxxxxx</li>
              <li>Address: Garthdee, Aberdeen, Scotland, UK</li>
            </ul>
          </section>
          <section class="col-md-6">
          </section>
          <section class="col-md-3">
            <h4>Quick Guide</h4>
            <p><a href="faq.php">Frequently Asked Question</a></p>
          </section>
        </div>
      </div>
    </div>
    <div id="last">
      <p>&copy; 2023 Bus Inc. All rights reserved.</p>
    </div>

  </footer>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/8c47bf12e3.js" crossorigin="anonymous"></script>
</body>

</html>