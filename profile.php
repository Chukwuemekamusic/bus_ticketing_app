<?php
session_start();    //create or retrieve session
include_once("connection.php");
include_once('./functions.php');

if (isset($_SESSION["email"])) { //user must in session to stay here
    $email = $_SESSION["email"];   //get user email into the variable $email
    $first_name = ucfirst($_SESSION['first_name']); // ucfirst capitalises the first name
    $last_name = $_SESSION['last_name'];
    $user_id = get_single_detail('uid', 'users', "email = '$email'");
} else {
    header('Location: home.html');
    exit;
}

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
    <!-- js for return button -->
    <script src="./app2.js"></script>
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
                            <li><a href="managebooking.php">Manage trip</a></li>
                            <li><a href="about.php" class="nav-item">About Us</a></li>
                            <li><a href="contactus.php" class="nav-item">Contact Us</a></li>
                            <li>
                                <p>Hello <?php print $first_name; ?>!</p>
                            </li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </header>

    <main>
        <div class="design">
            <div class="darker">
                <form action="./result.php" method="post">
                    <div>
                        <table>
                            <thead>.
                                <tr>
                                    <th><img id="vectors" src="./Assets/booking.PNG"></th>
                                    <th><img id="vectors" src="./Assets/payment.PNG"></th>
                                    <th><img id="vectors" src="./Assets/luggage.PNG"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>BOOK</td>
                                    <td>PAY</td>
                                    <td>TRAVEL</td>
                                </tr>
                            </tbody>
                        </table>
                        <p id="slogan">"Your Better Way To Travel"</p>
                    </div>
                    <hr>
                    <div class="container">
                        <div class="col-md-12">
                            <div id="bigmainContainer" class="row">
                                <div class="col-md-4">
                                    <label for="departure"></label>
                                    <input type="text" id="departure" name="departure" placeholder="Departure" required>
                                    <br><br>
                                    <button type="button" id="oneway" class="trip-button" onclick="removeReturnInput()">One Way</button>
                                </div>
                                <div class="col-md-4">
                                    <!-- <i class="fa-solid fa-location-dot"></i>  -->
                                    <label for="arrival"></label>
                                    <input type="text" id="arrival" name="arrival" placeholder="Arrival" required>
                                    <br><br>
                                    <button type="button" id="roundtrip" class="trip-button" onclick="addReturnInput()">Return</button>
                                </div>
                                <div class="col-md-4">
                                    <div id="traveldate">
                                        <label for="departuredate"></label>
                                        <input type="date" id="departuredate" name="departuredate" required><br><br>
                                        <!-- <label for="return"></label>
                                        <input type="date" id="returndate" name="returndate"><br><br> -->
                                    </div>
                                    <button id="searchbusbtn" type="submit">Search for Bus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>

        <div id="latab" class="container-fluid">
            <div>
                <h3>Booking History</h3>
                <?php
                $result = get_user_details(
                    "b.*",
                    "users u, bookings b, users_bookings ub",
                    "u.uid = ub.uid and b.booking_id = ub.booking_id and u.uid = '$user_id'",
                    "b.one_departure_date desc"
                );
                ?>
                <?php if ($result) : ?>
                    <table id="tab" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Inbound Departure</a>
                                </th>
                                <th class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">One-way Arrival</a>
                                </th>
                                <th class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">One-way Departure Date</a>
                                </th>
                                <th class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">One-way Departure Time</a>
                                </th>
                                <th class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Return Departure</a>
                                </th>
                                <th class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Return Arrival</a>
                                </th>
                                <th class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Return Departure Date</a>
                                </th>
                                <th class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Return Departure Time</a>
                                </th>
                                <th class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Total Paid</a>
                                </th>
                                <th class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Status</a>
                                </th>
                            </tr>
                        </thead>

                        <tbody style="font-size: 14px" ;>
                            <?php foreach ($result as $row) : ?>
                                <?php $date1 = $row['one_departure_date'];
                                $dayWeek1 = date('D', strtotime($date1));
                                if ($row['return_departure_date']) {
                                    $date2 = $row['return_departure_date'];
                                    $dayWeek2 = date('D', strtotime($date2));
                                } else {
                                    $date2 = "";
                                    $dayWeek2 = "";
                                }
                                ?>
                                <tr class="bg-dark">
                                    <td><dropdown-item><?php echo $row['one_departure']; ?></dropdown-item></td>
                                    <td><dropdown-item><?php echo $row['one_arrival']; ?></dropdown-item></td>
                                    <td><dropdown-item><?php echo "{$date1} {$dayWeek1}"; ?></dropdown-item></td>
                                    <td><dropdown-item><?php echo $row['one_departure_time']; ?></dropdown-item></td>
                                    <td><dropdown-item><?php echo $row['return_departure']; ?></dropdown-item></td>
                                    <td><dropdown-item><?php echo $row['return_arrival']; ?></dropdown-item></td>
                                    <!-- <td><dropdown-menu><?php echo $row['return_departure_date']; ?></dropdown-menu></td> -->
                                    <td><dropdown-item><?php echo "{$date2} {$dayWeek2}"; ?></dropdown-item></td>
                                    <td><dropdown-item><?php echo $row['return_departure_time']; ?></dropdown-item></td>
                                    <td><dropdown-item><?php echo $row['total_paid']; ?></dropdown-item></td>
                                    <td><dropdown-item>
                                            <?php
                                            $trip_date1 = strtotime($date1); // Convert trip 1 date to Unix timestamp
                                            $trip_date2 = strtotime($date2); // Convert trip 2 date to Unix timestamp
                                            $current_date = time(); // Get current Unix timestamp
                                            if ($current_date > $trip_date1 && $current_date > $trip_date2) {
                                                echo "Completed"; // If both trip dates have passed, trip is completed
                                            } else {
                                                echo "Active"; // If one or none of the trip dates have passed, trip is active
                                            }
                                            ?></dropdown-item>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No bookings found.</p>
                <?php endif; ?>
            </div>

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