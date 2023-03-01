<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "BusApp";



$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    $servername = "lamp-database";
    $username = "root";
    $password = "tiger";
    $dbname = "docker";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
}


// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);

// //Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// //Close the database connection
// // mysqli_close($conn);

?>