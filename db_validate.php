<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();   //start a session here in case user login successfully
if (!IsSet($_POST))    //if no $_POST array
{
    session_destroy();   //clear session
    header("Location: login.html");   //send user back to login page
    exit();
}
if (!IsSet($_POST["email"]) || !IsSet($_POST["password"]))  // no username or password submitted
{
    session_destroy();   
    header("Location: login.html"); //send user back to Login page
    exit();
}


// include_once("connection.php");
include_once("connection_lamp.php");



// // Establish a connection to the database
// $conn = mysqli_connect($servername, $username, $password, $dbname);

// Retrieve the submitted email and password
$email = $_POST['email'];
$psw = $_POST['password'];

// Query the database to retrieve the user's details
$sql = "SELECT * FROM users WHERE email = '$email' and auth = '$psw'";
// $sql = "SELECT * FROM users WHERE email = '$email' and password = '$psw'";
$result = mysqli_query($conn, $sql);

// If the user is found, compare the submitted password with the password retrieved from the database
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
      // if ($psw == $row['password']) {
  if ($psw == $row['auth']) {

    // Redirect to user home page
    header('Location: profile.php');
    $_SESSION['email'] = $email;
    $_SESSION['first_name'] = $row['first_name'];
    $_SESSION['last_name'] = $row['last_name'];
    exit();
  } else {
  
    echo "Invalid password";
}
} else {
  echo "Invalid username or password";
}

?>
