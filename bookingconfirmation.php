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
if (isset($_SESSION['returndate'])) {
    $returnBusId =  $_SESSION['return_bus_id'];    
    $returnSeat = $_POST['return_selected_seat'] ?? '';
    $seat = $_SESSION['selected_seat'] ?? '';
}else {
    $seat = $_POST['selected_seat'] ?? '';
}

$totalprice = ($price+$returnPrice);

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
$return_ticket_price = $returnbus[0]['ticket_price'] ?? '';


echo 'Your booking ID is: ' . $return_departure . '<br>';
echo 'Your booking ID is: ' . $return_arrival_time . '<br>';
echo 'Your booking ID is: ' . $totalprice . '<br>';
echo 'Your booking ID is: ' . $first_n . '<br>';
echo 'Your booking ID is: ' . $one_bus_number . '<br>';
echo 'Your booking ID is: ' . $one_arrival_date . '<br>';



// // Prepare the SQL query
// $stmt2 = $conn->prepare("INSERT INTO bookings (booking_id, firstname, lastname, one_departure, one_arrival, one_departure_date, one_departure_time,
// one_arrival_date, one_arrival_time, one_bus_number, one_ticket_price, return_departure, return_arrival, return_departure_date, return_departure_time,
// return_arrival_date, return_arrival_time, return_bus_number, return_ticket_price, total_paid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
// $stmt2->bind_param("ssssssssssdsssssssdd", $booking_id, $first_n, $last_n, $one_departure, $one_arrival, $one_departure_date, $one_departure_time, $one_arrival_date, $one_arrival_time, $one_bus_number, $one_ticket_price, $return_departure, $return_arrival, $return_departure_date, $return_departure_time, $return_arrival_date, $return_arrival_time, $return_bus_number, $return_ticket_price, $totalprice);

// Prepare the SQL query
$stmt2 = $conn->prepare("INSERT INTO bookings5 (booking_id, firstname, lastname, one_departure, one_arrival, one_bus_number,one_ticket_price, total_paid) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt2->bind_param("ssssssdd", $booking_id, $first_n, $last_n, $one_departure, $one_arrival, $one_bus_number, $one_ticket_price, $totalprice);

//Set the parameters
$booking_id = 'EDGE-BUS-BOOKID-' . uniqid();
// $user = 123; // Replace with the user's ID
// $date = '2023-03-09'; // Replace with the booking date

$stmt2->execute();
$stmt2->close();

//Check for errors
if ($stmt2->error) {
    die('Error: ' . $stmt2->error);
}

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