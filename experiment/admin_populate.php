<?php

include_once("connection_pdoheader.php");

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
    
        // $departure = $busData[0];
        // $arrival = $busData[1];
        // $departure_date = date("Y-m-d", strtotime($busData[2]));
        // $departure_time = date("H:i", strtotime($busData[3]));
        // $arrival_date = date("Y-m-d", strtotime($busData[4]));
        // $arrival_time = date("H:i", strtotime($busData[5]));
        // $bus_capacity = intval($busData[6]);
        // $seats_booked = 0;
        // $bus_number = $busData[7];

    $sql = "INSERT INTO buses (departure, arrival, departure_date, departure_time, arrival_date, arrival_time, bus_capacity, bus_number)
    VALUES (:departure, :arrival, :departure_date, :departure_time, :arrival_date, :arrival_time, :bus_capacity, :bus_number)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(
        ':departure' => $departure,
        ':arrival' => $arrival,
        ':departure_date' => $departure_date,
        ':departure_time' => $departure_time,
        ':arrival_date' => $arrival_date,
        ':arrival_time' => $arrival_time,
        ':bus_capacity' => $bus_capacity,
        ':bus_number' => $bus_number
    ));

    echo "New record created successfully" . '<br>';
    // get the bus_id of the newly added bus
    $bus_id = $conn->lastInsertId();
    // add seats for the bus to the 'bus_seats' table
    for ($i = 1; $i <= $bus_capacity; $i++) {
        $seat_number = $i;
        $status = 'available';
        $stmt = $conn->prepare("INSERT INTO bus_seats (bus_id, seat_number, status)
                VALUES (:bus_id, :seat_number, :status)");
        $stmt->execute(array(
            ':bus_id' => $bus_id,
            ':seat_number' => $seat_number,
            ':status' => $status
        ));
        echo "Seat $seat_number added for bus $bus_id" . '<br>';
    }
}

$conn = null;


?>