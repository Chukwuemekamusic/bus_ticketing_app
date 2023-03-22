<?php

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "BusApp";

$servername = "lamp-mysql8";
$username = 'root';
$password = 'tiger';
$dbname = 'BusApp';


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>