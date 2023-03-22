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
$seat = $_SESSION['selected_seat'] ?? '';

$totalprice = ($_SESSION['total_price']);

// Connect to the database
include_once("connection.php");
// Create connection

include('./get_bus_details.php');
$onebus = getBuses($busId);

//$returnbus = getBuses($returnBusId);



// echo 'Your booking ID is: ' . $return_departure . '<br>';
// echo 'Your booking ID is: ' . $return_arrival_time . '<br>';
echo 'Your booking ID is: ' . $totalprice . '<br>';
echo 'Your booking ID is: ' . $first_n . '<br>';
echo 'bus return id is: ' .$returnBusId . '<br>';
// echo 'Your booking ID is: ' . $one_bus_number . '<br>';
// echo 'Your booking ID is: ' . $one_arrival_date . '<br>';

$booking_id = 'EDGE-BUS-BOOKID-' . uniqid();
$booking_date = date("Y-m-d"); // Get the current date in YYYY-MM-DD format

// Prepare the SQL query
// if ($returnBusId) { 
$stmt2 = $conn->prepare("INSERT INTO bookings (booking_id, departure_schedule_id, return_schedule_id, 
departure_seat_number, return_seat_number, first_name, last_name, one_ticket_price, return_ticket_price, booking_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt2->bind_param("siiiissdds", $booking_id, $busId, $returnBusId, $seat, $returnSeat, $first_n, $last_n, $price, $returnPrice, $booking_date);
// } else {
//     $stmt2 = $conn->prepare("INSERT INTO bookings (booking_id, departure_schedule_id, 
// departure_seat_number, first_name, last_name, one_ticket_price, booking_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
// $stmt2->bind_param("siiisds", $booking_id, $busId, $seat, $first_n, $last_n, $price, $booking_date);
// }
//Set the parameters

// $user = 123; // Replace with the user's ID
// $date = '2023-03-09'; // Replace with the booking date
if ($stmt2->execute()) {
    // Query was successful
} else {
    // Query failed, show error message
    echo 'Error: ' . $conn->error;
}



// $stmt2->close();

//Check for errors


// Display the booking ID to the user
// echo 'Your booking ID is: ' . $booking_id;

//Close the statement and connection

//$conn->close();


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
            <h3>Credit card number is valid and Approved.</h3>
            <h4>Here are your booking details<h4>

 

        </div>
    </main>

    <footer>
        <hr>
        <div class="container">
            <div class="col-md-12" id="lastleft">
                <div id="footercontainer" class="row">
                    <section class="col-md-3">
                        <h4>Contact Us</h4>
                        <ul>
                            <li>Email: info@xxxxbus.com</li>
                            <li>Phone No.: +44 7498 xxxxxxx</li>
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