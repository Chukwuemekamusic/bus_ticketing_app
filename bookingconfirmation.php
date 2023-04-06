<?php
session_start();    //create or retrieve session
if (isset($_SESSION["email"])){ //user must be in session to stay here
    $email=$_SESSION["email"];   //get user email into the variable $email
    $first_name = ucfirst($_SESSION['first_name']); // ucfirst capitalizes the first name
    $last_name = $_SESSION['last_name'];
}


$first_n = $_SESSION['first_n'] ?? '';
$last_n = $_SESSION['last_n'] ?? '';

$busId =  $_SESSION['bus_id'] ?? '';
$price = $_SESSION['price'] ?? 0;
$returnPrice = $_SESSION['return_price'] ?? 0;
$returnSeat = $_SESSION['return_selected_seat'] ?? '';
$returnBusId =  $_SESSION['return_bus_id'] ?? ''; 

// if (isset($_SESSION['returndate'])) {
//     $returnBusId =  $_SESSION['return_bus_id'];    
// }
$seat = $_SESSION['selected_seat'] ?? '';

//$totalprice = ($price+$returnPrice);


// Connect to the database
include_once("connection.php");
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

include('./get_bus_details.php');
$onebus = getBuses($busId);
$one_departure = $onebus[0]['departure'] ?? '';
$one_arrival = $onebus[0]['arrival'] ?? '';
$one_departure_date = $onebus[0]['departure_date'] ?? '';
$one_departure_time = $onebus[0]['departure_time'] ?? '';
$one_arrival_date = $onebus[0]['arrival_date'] ?? '';
$one_arrival_time = $onebus[0]['arrival_time'] ?? '';
$one_bus_number = $onebus[0]['bus_number'] ?? '';
$one_ticket_price = $onebus[0]['ticket_price'] ?? '';

$returnbus = getBuses($returnBusId);
$return_departure = $returnbus[0]['departure'] ?? '';
$return_arrival = $returnbus[0]['arrival'] ?? '';
$return_departure_date = $returnbus[0]['departure_date'] ?? '';
$return_departure_time = $returnbus[0]['departure_time'] ?? '';
$return_arrival_date = $returnbus[0]['arrival_date'] ?? '';
$return_arrival_time = $returnbus[0]['arrival_time'] ?? '';
$return_bus_number = $returnbus[0]['bus_number'] ?? '';
$return_ticket_price = $returnbus[0]['ticket_price'] ?? 0;

$total_price = ($one_ticket_price+$return_ticket_price);
//echo $totalprice;

if (empty($return_departure_date)) {
    $return_departure_date = NULL;
}
if (empty($return_arrival_date)) {
    $return_arrival_date = NULL;
}


// // Generate a new booking ID
// $booking_id = 'EDGE-BUS-BOOKID-' . uniqid();

$stmt2 = $conn->prepare("INSERT INTO bookings (booking_id, firstname, lastname, one_bus_id, one_seat_number, one_departure, one_arrival, one_departure_date, one_departure_time, one_arrival_date, one_arrival_time, one_bus_number, one_ticket_price, return_bus_id, return_seat_number, return_departure, return_arrival, return_departure_date, return_departure_time, return_arrival_date, return_arrival_time, return_bus_number, return_ticket_price, total_paid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt2->bind_param("sssiisssssssdiisssssssdd", $booking_id, $first_n, $last_n, $busId, $seat, $one_departure, $one_arrival, $one_departure_date, $one_departure_time, $one_arrival_date, $one_arrival_time, $one_bus_number, $one_ticket_price, $returnBusId, $returnSeat, $return_departure, $return_arrival, $return_departure_date, $return_departure_time, $return_arrival_date, $return_arrival_time, $return_bus_number, $return_ticket_price, $total_price);

// Set the parameters
$booking_id = 'EDGE-BUS-BOOKID-' . uniqid();

if (isset($_SESSION["booking_id"])) {
    // Booking ID already generated, display it to the user
    $booking_id = $_SESSION["booking_id"];
    // echo "Your booking ID is: " . $booking_id;
} else {
    // Generate a new booking ID
    $booking_id = 'EDGE-BUS-BOOKID-' . uniqid();
    
    // Store the booking ID in the session
    $_SESSION["booking_id"] = $booking_id;

    // Display the booking ID to the user
    // echo 'Your booking ID is: ' . $booking_id;
    if ($stmt2->execute()) {
    
    } else {
        echo "Error inserting record: " . $stmt2->error;
    }
    $result = $stmt2->get_result();
    //     // Close the statement and connection
    $stmt2->close();
//     $conn->close();
}

//Close the connection
//$conn->close();
$sql3 = "SELECT * FROM bookings where booking_id = '$booking_id'";
$stmt3 = $conn->prepare($sql3);
if ($stmt3->execute()) {
    
} else {
    echo "Error inserting record: " . $stmt2->error;
}
$result3 = $stmt3->get_result();
$stmt3->close();
$row = $result3->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 minimum-scale=1, maximum-scale=1">
    <title>Edge Bus Home</title>
    <link rel="stylesheet" href="./Assets/css/stylenew.css">
    <link rel="stylesheet" href="unsemantic-grid-responsive-tablet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap-theme.min.css">
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
                            <?php if (isset($_SESSION["email"])) { ?>
                                <li><a href = "profile.php" class="nav-item">My Account</a></li>
                        <li><a href = "about.php" class="nav-item">About Us</a></li>
                        <li><a href = "contactus.php" class="nav-item">Contact Us</a></li>   

                        <li><p>
        Hello <?php print $first_name; ?>!        
    </p></li>                    
    <li><a href="logout.php">Logout</a></li> 
    <?php } else { ?>
        <li><a href = "home.html" class="nav-item active">Home</a></li>
                            <li><a href = "about.php" class="nav-item">About Us</a></li>
                            <li><a href = "contactus.php" class="nav-item">Contact Us</a></li>   
                            <li><a href = "login.html" class="nav-item">Sign-in|Sign up</a></li>  
    <?php } ?>

                    </ul>
                 
                </nav>
                </div>
            </div>
        </div>

    </header>

    <main>
    <div class="container">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Booking Confirmation</h5>
      <p class="card-text">Card number is valid and approved.</p>
      <hr>
      <h5 class="card-subtitle mb-2 text-muted">Booking Details</h5>
      <p class="card-text"><strong>Booking ID:</strong> <?php echo $booking_id; ?></p>
      <!-- <p class="card-text"><strong>Name:</strong> <?php echo $first_name . ' ' . $last_name; ?></p> -->
      <h5 class="card-text mb-2"><strong>Inbound Trip</strong></h5>
      <p class="card-text"><strong>Inbound Departure:</strong> <?php echo $row['one_departure']; ?></p>
      <p class="card-text"><strong>One-way Arrival:</strong> <?php echo $row['one_arrival']; ?></p>
      <?php $date1 = $row['one_departure_date']; $dayWeek1 = date('l', strtotime($date1));?>
      <p class="card-text"><strong>One-way Departure Date:</strong> <?php echo "{$dayWeek1} {$date1}" ; ?></p>
      <p class="card-text"><strong>One-way Departure Time:</strong> <?php echo date('h:i A', strtotime($row['one_departure_time'])); ?></p>
      <p class="card-text"><strong>One-way Arrival Date:</strong> <?php echo $row['one_arrival_date']; ?></p>
      <p class="card-text"><strong>One-way Arrival Time:</strong> <?php echo $row['one_arrival_time']; ?></p>
      <p class="card-text"><strong>One-way Bus Number:</strong> <?php echo $row['one_bus_number']; ?></p>
      <p class="card-text"><strong>One-way Seat Number:</strong> <?php echo $row['one_seat_number']; ?></p>
      <p class="card-text"><strong>One-way Ticket Price:</strong> <?php echo "£".$row['one_ticket_price']; ?></p>
      <?php if (isset($_SESSION['return_price'])) { ?>
        <h5 class="card-text mt-3"><strong>Return Trip</strong></h5>
        <p class="card-text"><strong>Return Departure:</strong> <?php echo $row['return_departure']; ?></p>
        <p class="card-text"><strong>Return Arrival:</strong> <?php echo $row['return_arrival']; ?></p>
        <?php $date2 = $row['one_departure_date']; $dayWeek2 = date('l', strtotime($date2));?>
        <p class="card-text"><strong>Return Departure Date:</strong> <?php echo "{$dayWeek2} {$date2}" ; ?></p>
        <p class="card-text"><strong>Return Departure Time:</strong> <?php echo date('h:i A', strtotime($row['return_departure_time'])); ?></p>
        <p class="card-text"><strong>Return Arrival Date:</strong> <?php echo $row['return_arrival_date']; ?></p>
        <p class="card-text"><strong>Return Arrival Time:</strong> <?php echo $row['return_arrival_time']; ?></p>
        <p class="card-text"><strong>Return Bus Number:</strong> <?php echo $row['return_bus_number']; ?></p>
        <p class="card-text"><strong>Return Seat Number:</strong> <?php echo $row['return_seat_number']; ?></p>
        <p class="card-text"><strong>Return Ticket Price:</strong> <?php echo "£".$row['return_ticket_price']; ?></p>
      <?php } ?>
      <hr>
      <p class="card-text"><strong>Total Paid:</strong> <?php echo "£".$total_price; ?></p>
      <a href="#" class="card-link">Print Confirmation</a>
    </div>
  </div>
</div>

    </main>

    <footer>
        <hr>
        <div class="container">
            <div class="col-md-12" id="lastleft">
                <div id="footercontainer" class="row">
                    <section class="col-md-3">
                        <h5>Contact Us</h5>
                        <ul>
                            <li>Email: info@xxxxbus.com</li>
                            <li>Phone No.: +44 7498 xxxxxxx</li>
                        </ul>
                    </section>
                    <section class="col-md-6">
                    </section>
                    <section class="col-md-3">
                        <h5>Quick Guide</h5>
                        <p><a href="faq.php">Frequently Asked Question</a></p>
                    </section>
                </div>
            </div>
        </div>
        <div id="last">
            <p>(c) 2023 xxxx Bus</p>
        </div>

    </footer>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/8c47bf12e3.js" crossorigin="anonymous"></script>
</body>

</html>