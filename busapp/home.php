<?php
session_start();    //create or retrieve session
if (!IsSet($_SESSION["email"])){ //user name must in session to stay here
   header("Location: login.php"); }  //if not, go back to login page
$email=$_SESSION["email"];   //get user name into the variable $username
$first_name = ucfirst($_SESSION['first_name']); // ucfirst capitalises the first name
$last_name = $_SESSION['last_name'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>User Home</title>
    <!-- <link rel="stylesheet" href="../cmm004_bus_app/style.css"> -->
    <link rel="stylesheet" href="style.css">
    <script src="app.js"></script>
  </head>
  <body>
    <header>
    <h1>User Home Page</h1>
      <nav>
        <ul>
          <li><a href="managebooking.php">Manage booking</a></li>
          <li>
              <!--below form allows you to logout by invoking the logoutphp script-->  
          <form method="get" action=logout.php>
        <button type="submit">Logout</button>
    </form>
  </li>
        </ul>
      </nav>
    </header>
    <main>
    <p>
        Welcome back, <?php print $first_name; ?>!
        This is your home page
        You are logged in, you can decide to go to <a href="managebooking.php">Manage bookings</a> page
    </p>
    <h2>Book Your Bus Ticket</h2>
      <form id="booking-form" action="search-buses.php" method="get">
        <label for="departure">From:</label>
        <input type="text" id="departure" name="departure" required>
        <br><br> 
        <label for="arrival">To:</label>
        <input type="text" id="arrival" name="arrival" required>
        <br><br>
        <label for="departuredate">Departure Date:</label>
        <input type="date" id="departuredate" name="departuredate" required><br>
        <button id="searchbusbtn" type="submit">Search for Bus</button>
        <br><br>
      </form>
      <br><br>
      <button id="oneway" class="trip-button" onclick="removeReturnInput()">One Way</button>
      <button id="roundtrip" class="trip-button" onclick="addReturnInput()">Round Trip</button>
      <br><br>
    <!--below form allows you to logout by invoking the logoutphp script-->
    <!-- <form method="get" action=logout.php>
        <button type="submit">Logout</button>
    </form> -->
    </main>
</body>
<footer>
  &copy; 2023 Bus Booking
</footer>

</body>
</html>

