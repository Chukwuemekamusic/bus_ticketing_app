<?php
session_start();
include('../connection.php');
$seat_number =  $_POST['seat_number'];
$status = $_POST['status'];
$busID = $_SESSION['bus_id'];

// Update seat status in database
$sql = "UPDATE bus_seats SET status =? WHERE seat_number =? AND bus_schedule_id =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $status, $seat_number, $busID);
$stmt->execute();

// Handle errors if necessary
if (!$stmt) {
    echo "Error: ". $conn->error;
}else {
    echo 'done!!!';
}
?>
