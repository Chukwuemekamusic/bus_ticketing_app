<?php
session_start();    //create or retrieve session
if (!IsSet($_SESSION["email"])){ //user name must in session to stay here
   header("Location: login.php"); }  //if not, go back to login page
$email=$_SESSION["email"];   //get user name into the variable $username
$first_name = ucfirst($_SESSION['first_name']); // ucfirst captitalises the first name
$last_name = $_SESSION['last_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
</head>
<body>
    <h1>User Home Page</h1>
    <p>
        Welcome back, <?php print $first_name; ?>!
        This is your home page
        You are logged in, you can decide to go <a href="otherhome.php">Personalise Home page</a>
        To logout, click the below button
    </p>
    <!--below form allows you to logout by invoking the logoutphp script-->
    <form method="get" action=logout.php>
        <button type="submit">Logout</button>
    </form>

</body>
</html>

