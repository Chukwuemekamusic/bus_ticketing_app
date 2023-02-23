<?php
// session_start();   //start a session here in case user login successfully
// if (!IsSet($_POST))    //if no $_POST array
// {
//     session_destroy();   //clear session
//     header("Location: login.html");   //send user back to login page
//     exit();
// }
// if (!IsSet($_POST["user"]) || !IsSet($_POST["password"]))  // no username or password submitted
// {
//     session_destroy();   
//     header("Location: login.html"); //send user back to Login page
//     exit();
// }

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "BusApp";

// Establish a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Retrieve the submitted email and password
$email = $_POST['email'];
$psw = $_POST['password'];

// Query the database to retrieve the user's details
$sql = "SELECT * FROM users WHERE email = '$email' and password = '$psw'";
$result = mysqli_query($conn, $sql);

// if (mysqli_query($conn, $sql)) {
//     // echo "Registration successful";
//     header("Location: home.php"); //send user back to Login page
//     exit();
  
//   } 
// else {
//     echo "Invalid username or password";
//   }

// If the user is found, compare the submitted password with the password retrieved from the database
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  if (password_verify($psw, $row['password'])) {
    // Redirect the user to a protected area of your website
    header('Location: home.php');
    exit();
//   } else {
//     echo "Invalid username or password";
}
} else {
  echo "Invalid username or password";
}

// Close the database connection
mysqli_close($conn);
?>
