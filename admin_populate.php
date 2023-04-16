<?php

include_once("../cmm004_bus_app/tables_creation/connection_pdo.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departure = $_POST["departure"];
    $arrival = $_POST["arrival"];
    $departure_date = $_POST["departure_date"];
    $departure_time = $_POST["departure_time"];
    $arrival_date = $_POST["arrival_date"];
    $arrival_time = $_POST["arrival_time"];
    $bus_capacity = intval($_POST["bus_capacity"]);
    $seats_booked = 0;
    $bus_number = $_POST["bus_number"];
    

    $sql = "INSERT INTO bus_schedules (departure, arrival, departure_date, departure_time, arrival_date, arrival_time, bus_capacity, bus_number)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute(array(
    $departure,
    $arrival,
    $departure_date,
    $departure_time,
    $arrival_date,
    $arrival_time,
    $bus_capacity,
    $bus_number
));


    echo "New record created successfully" . '<br>' . '<a href="admin_bus_schedules.php">Return to Bus Schedule</a>';

    // get the bus_id of the newly added bus
    $bus_id = $conn->lastInsertId();
    // add seats for the bus to the 'bus_seats' table
    for ($i = 1; $i <= $bus_capacity; $i++) {
        $seat_number = $i;
        $status = 'available';
        $stmt = $conn->prepare("INSERT INTO bus_seats (bus_schedule_id, seat_number, status)
                VALUES (:bus_id, :seat_number, :status)");
        $stmt->execute(array(
            ':bus_id' => $bus_id,
            ':seat_number' => $seat_number,
            ':status' => $status
        ));
        // echo "Seat $seat_number added for bus $bus_id" . '<br>';
    }
}

$conn = null;


?>
