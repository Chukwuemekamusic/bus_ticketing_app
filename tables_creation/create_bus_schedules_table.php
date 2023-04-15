<?php
// creates bus_schedules trip and sets an event scheduler to handle trip_status
// RUN ONLY ONCE!

include_once("../connection.php");

$sql = "CREATE TABLE bus_schedules (                        
bus_schedule_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
departure VARCHAR(30) NOT NULL,
arrival VARCHAR(30) NOT NULL,
departure_date DATE NOT NULL,
departure_time TIME NOT NULL,
arrival_date DATE NOT NULL,
arrival_time TIME NOT NULL,
bus_capacity INT(11) NOT NULL DEFAULT 40,
seats_booked INT(11) NOT NULL DEFAULT 0,
seats_available INT(11) AS (bus_capacity - seats_booked),
bus_number VARCHAR(30) NOT NULL,
ticket_price DECIMAL(10,2) NOT NULL DEFAULT 60.45,        
trip_status VARCHAR(15) DEFAULT 'open',
UNIQUE(bus_number, departure_time, departure_date)      
)";


if (mysqli_query($conn, $sql)) {
    echo "Table bus_schedules created successfully";
    
    // this ensures that the trip_status changes if the day for trip is passed!
    $sql2 = "CREATE EVENT close_trip_status
    ON SCHEDULE EVERY 12 HOUR
    DO
    UPDATE bus_schedules SET trip_status = 'closed' WHERE departure_date < CURDATE() OR seats_available = 0;
    ";
    if (mysqli_query($conn, $sql2)) {
        echo "Event close_trip_status created!";
    }else{
        echo 'Event not created!' . mysqli_error($conn);
    }
} else {
    echo "Error creating table: " . mysqli_error($conn);
}



mysqli_close($conn);
