<?php
session_start();    //create or retrieve session

include_once("connection.php");
include_once('./functions.php');

if (IsSet($_SESSION["email"])){ //user must in session to stay here
$email=$_SESSION["email"];   //get user email into the variable $email
$first_name = ucfirst($_SESSION['first_name']); // ucfirst capitalises the first name
$last_name = $_SESSION['last_name'];
$user_id = get_single_detail('uid', 'users', "email = '$email'");
} else {
    header('Location: home.html');
    exit;
}
$conn = new mysqli($servername, $username, $password, $dbname);
 
$sql6 = "SELECT * FROM bus_schedules ORDER BY departure_date";
$stmt = $conn->prepare($sql6);
$stmt->execute();
$buses = $stmt->get_result();
$stmt->close();

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
                        <li><a href="admin.php">Home</a></li>
                        <li><a href="admin_bus_schedules.php">Manage Bus Schedules</a></li>
                                               <li><p>Hello <?php print $first_name; ?>!</p>
                            </li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </header>

    <main>
        <div>
                    <hr>
            <div class="container">
            <h6><strong>Add Bus Schedule</strong></h6>
            <form action="./admin_populate.php" method="post">
                    <div class="mb-3">
                        <label for="departure" class="form-label">Departure</label>
                        <input type="text" class="form-control" id="departure" name="departure">
                    </div>
                    <div class="mb-3">
                        <label for="arrival" class="form-label">Arrival</label>
                        <input type="text" class="form-control" id="arrival" name="arrival">
                    </div>
                    <div class="mb-3">
                        <label for="departure_date" class="form-label">Departure Date</label>
                        <input type="date" class="form-control" id="departure_date" name="departure_date">
                    </div>
                    <div class="mb-3">
                        <label for="departure_time" class="form-label">Departure Time</label>
                        <input type="time" class="form-control" id="departure_time" name="departure_time">
                    </div>
                    <div class="mb-3">
                        <label for="arrival_date" class="form-label">Arrival Date</label>
                        <input type="date" class="form-control" id="arrival_date" name="arrival_date">
                    </div>
                    <div class="mb-3">
                        <label for="arrival_time" class="form-label">Arrival Time</label>
                        <input type="time" class="form-control" id="arrival_time" name="arrival_time">
                    </div>
                    <div class="mb-3">
                        <label for="bus_capacity" class="form-label">Bus Capacity</label>
                        <input type="number" class="form-control" id="bus_capacity" name="bus_capacity">
                    </div>
                    <div class="mb-3">
                        <label for="bus_number" class="form-label">Bus Number</label>
                        <input type="text" class="form-control" id="bus_number" name="bus_number">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div><br><br>
<div>
<h6><strong>Modify bus_schedules</strong></h6>
<table class="table table-striped">
<thead>
    <tr>
      <th scope="col" data-sortable>#</th>
      <th scope="col" data-sortable>Departure</th>
      <th scope="col" data-sortable>Arrival</th>
      <th scope="col" data-sortable>Departure_date</th>
      <th scope="col" data-sortable>Departure_time</th>
      <th scope="col" data-sortable>Arrival_date</th>
      <th scope="col" data-sortable>Arrival_time</th>
      <th scope="col" data-sortable>Bus_capacity</th>
      <th scope="col" data-sortable>Seats_booked</th>
      <th scope="col" data-sortable>Seats_remaining</th>
      <th scope="col" data-sortable>Bus_number</th>
      <th scope="col" data-sortable><b>Action!</b></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($buses as $i => $bus) : ?>
    <tr>
      <th scope="row"><?php echo $i + 1 ?></th>
      <td><?php echo $bus['departure']?></td>
      <td><?php echo $bus['arrival']?></td>
      <td><?php echo $bus['departure_date']?></td>
      <td><?php echo $bus['departure_time']?></td>
      <td><?php echo $bus['arrival_date']?></td>
      <td><?php echo $bus['arrival_time']?></td>
      <td><?php echo $bus['bus_capacity']?></td>
      <td><?php echo $bus['seats_booked']?></td>
      <td><?php echo $bus['seats_available']?></td>  
      <td><?php echo $bus['bus_number']?></td>
      <td>
        <button type="button" class="btn-sm btn-primary">Edit</button>
        <button type="button" class="btn-sm btn-danger">Delete</button>
      </td>
      
      
    </tr>
    <?php endforeach ?>
    
  </tbody>
</table>
<div>
<div><br>
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
                        <!-- <p><a href="faq.php">Frequently Asked Question</a></p> -->
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