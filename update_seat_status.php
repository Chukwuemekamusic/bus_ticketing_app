<?php
session_start();
include('./connection.php');
$seat_number =  $_POST['seat_number'];
$status = $_POST['status'];
if ($_SESSION['return_bus_id']) {
    $busID = $_SESSION['return_bus_id'];
} else {
    $busID = $_SESSION['bus_id'];
}


// Update seat status in database
$sql = "UPDATE bus_seats SET status =? WHERE seat_number =? AND bus_schedule_id =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $status, $seat_number, $busID);
$stmt->execute();

// Handle errors if necessary
if (!$stmt) {
    echo "Error: " . $conn->error;
} else {
    // event to revert status to 'available' after 6 minutes
    $time_limit = 6;
    $event_name = "revert_seat_" . $busID . "_" . $seat_number;
    $event_time = date('Y-m-d H:i:s', strtotime("+{$time_limit} minutes"));

    $sql_trigger = "CREATE EVENT {$event_name}
                ON SCHEDULE AT '{$event_time}'
                DO UPDATE bus_seats SET status = 'available' 
                WHERE seat_number = $seat_number AND bus_schedule_id = $busID AND status = 'reserved'";
    if (mysqli_query($conn, $sql_trigger)) {
        echo "Event close_trip_status created!";
        echo "<br><br>";
    } else {
        echo 'Event not created!' . mysqli_error($conn);
        echo "<br><br>";
    }
}
