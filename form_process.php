<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$user = $_POST['user'];
$psw = $_POST['password'];
// $hashed_password = password_hash($psw, PASSWORD_BCRYPT);

// include("connection.php");
include_once('connection_lamp.php');
// // Establish a connection to the database
// $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

$sql = "INSERT INTO users (first_name,last_name,phone_number,email,username,auth) VALUES ('$first_name','$last_name','$phone','$email','$user','$psw')";
if (mysqli_query($conn, $sql)) {
  // echo "Registration successful";
  header("Location: reg_completed.html"); //send user back to Login page
  exit();

} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>




