<?php
// LAMP SERVER
// $servername = "lamp-mysql8";
// $username = "root";
// $password = "tiger";
// $dbname = "BusApp";

// XAMPP/MAMP SERVER
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BusApp";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'success';
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
