<?php
session_start();
if (!IsSet($_SESSION["email"]))  //user variable must exist in session to stay here
   header("Location:login.php");  //if not, go back to login page
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
    <h1>Manage Booking Page</h1>
      <nav>
        <ul>
          <li><a href="home.php">My account</a>
          </li>
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
                <!-- This is another page apart from the <a href="home.php">home page</a> -->

            </p>
    <h2>Manage Your Bookings</h2>



</main>
</body>
<footer>
  &copy; 2023 Bus Booking
</footer>

</body>
</html>