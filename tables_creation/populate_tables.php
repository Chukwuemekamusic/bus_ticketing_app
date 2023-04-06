<?php
// this populates the bus_schedueles and automatically populate the bus seats table

include_once("connection_pdo.php");
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

try {
    $file = fopen("clean_bus_schedules_updated.csv", "r");

// Read the header
$header = fgetcsv($file);

while (!feof($file)) {
    $busData = fgetcsv($file);

    $departure = $busData[0];
    $arrival = $busData[1];
    $departure_date = date("Y-m-d", strtotime($busData[2]));
    $departure_time = date("H:i", strtotime($busData[3]));
    $arrival_date = date("Y-m-d", strtotime($busData[4]));
    $arrival_time = date("H:i", strtotime($busData[5]));
    $bus_capacity = intval($busData[6]);
    $seats_booked = 0;
    $bus_number = $busData[7];
    $ticket_price = floatval($busData[8]);

     // check if the record already exists
     $stmt = $conn->prepare("SELECT bus_schedule_id FROM bus_schedules WHERE bus_number = :bus_number AND departure_date = :departure_date AND departure_time = :departure_time");
     $stmt->execute(array(
         ':bus_number' => $bus_number,
         ':departure_date' => $departure_date,
         ':departure_time' => $departure_time
     ));
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
     if ($row) {
         // the record already exists, do nothing
         echo "Record already exists: " . $bus_number . '-' . $departure_time . '<br>';
     } else {

    $sql = "INSERT INTO bus_schedules (departure, arrival, departure_date, departure_time, arrival_date, arrival_time, bus_capacity, seats_booked, bus_number, ticket_price)
    VALUES (:departure, :arrival, :departure_date, :departure_time, :arrival_date, :arrival_time, :bus_capacity, :seats_booked, :bus_number, :ticket_price)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(
        ':departure' => $departure,
        ':arrival' => $arrival,
        ':departure_date' => $departure_date,
        ':departure_time' => $departure_time,
        ':arrival_date' => $arrival_date,
        ':arrival_time' => $arrival_time,
        ':bus_capacity' => $bus_capacity,
        ':seats_booked' => $seats_booked,
        ':bus_number' => $bus_number,
        ':ticket_price' => $ticket_price
    ));

    echo "New record created successfully" . '<br>';
    // get the bus_id of the newly added bus
    $bus_schedule_id = $conn->lastInsertId();
    // add seats for the bus to the 'bus_seats' table
    for ($i = 1; $i <= $bus_capacity; $i++) {
        $seat_number = $i;
        $status = 'available';
        $stmt = $conn->prepare("INSERT INTO bus_seats (bus_schedule_id, seat_number, status)
                VALUES (:bus_schedule_id, :seat_number, :status)");
        $stmt->execute(array(
            ':bus_schedule_id' => $bus_schedule_id,
            ':seat_number' => $seat_number,
            ':status' => $status
        ));
        echo "Seat $seat_number added for bus $bus_schedule_id" . '<br>';
    }
}}

fclose($file);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
