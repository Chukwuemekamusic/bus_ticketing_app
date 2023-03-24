<?php

// $email = $_POST['email'];
// $psw = $_POST['psw'];
// $hashed_password = password_hash($psw, PASSWORD_BCRYPT);

$servername = "localhost";
// $servername = "lamp-database";
$username = "root";
$password = "root";
// $password = "tiger";
$dbname = "BusApp";
// $dbname = "docker";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//Close the database connection
mysqli_close($conn);

?>