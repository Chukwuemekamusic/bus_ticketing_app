<?php
// $servername = "lamp-mysql8";
// $username = "root";
// $password = "tiger";
// $dbname = "BusApp";

$servername = "localhost";
$username = "root";
$password = "root";
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
