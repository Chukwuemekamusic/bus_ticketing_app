<?php

include_once("./connection_header.php");

$sql = "CREATE TABLE users (
    first_name VARCHAR(30) NOT NULL,
    last_name
-- bus_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
-- departure VARCHAR(30) NOT NULL,
-- arrival VARCHAR(30) NOT NULL,
-- departure_date DATE NOT NULL,
-- departure_time TIME NOT NULL,
-- arrival_date DATE NOT NULL,
-- arrival_time TIME NOT NULL,
-- bus_capacity INT(11) NOT NULL,
-- seats_booked INT(11) NOT NULL DEFAULT 0,
-- seats_remaining INT(11) AS (bus_capacity - seats_booked),
-- bus_number VARCHAR(30) NOT NULL,
-- cost DECIMAL(10,2) NOT NULL DEFAULT 100.49,        # TODO added cost but not yet executed
-- UNIQUE(bus_number, departure_time)      
)";


if (mysqli_query($conn, $sql)) {
    echo "Table buses created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}


mysqli_close($conn);
?>
