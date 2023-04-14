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
    echo "<br><br>";

    // this ensures that the trip_status changes if the day for trip is passed!
    $sql2 = "CREATE EVENT close_trip_status
    ON SCHEDULE EVERY 12 HOUR
    DO
    UPDATE bus_schedules SET trip_status = 'closed' WHERE departure_date < CURDATE() OR seats_available = 0;
    ";
    if (mysqli_query($conn, $sql2)) {
        echo "Event close_trip_status created!";
        echo "<br><br>";
    } else {
        echo 'Event not created!' . mysqli_error($conn);
        echo "<br><br>";
    }
} else {
    echo "Error creating table: " . mysqli_error($conn);
    echo "<br><br>";
}

// Create the bus_seats table
$sql3 = "CREATE TABLE bus_seats (
    seat_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    bus_schedule_id INT(6) UNSIGNED,
    seat_number INT(11) NOT NULL,
    status ENUM('available', 'reserved', 'booked') NOT NULL DEFAULT 'available',
    FOREIGN KEY (bus_schedule_id) REFERENCES bus_schedules(bus_schedule_id) on DELETE CASCADE
  )";

if (mysqli_query($conn, $sql3)) {
    echo "Table bus_seats created successfully";
    echo "<br><br>";
} else {
    echo "Error creating bus_seats table: " . mysqli_error($conn);
    echo "<br><br>";
}

// this trigger updates seats_booked and trip_status in bus_schedules table. 
$sql4 = "CREATE TRIGGER update_seats_booked_and_trip_status 
  AFTER UPDATE ON bus_seats 
  FOR EACH ROW
  BEGIN
    IF NEW.status = 'booked' THEN
      UPDATE bus_schedules SET seats_booked = seats_booked + 1 WHERE bus_schedule_id = NEW.bus_schedule_id;
      IF (SELECT seats_booked FROM bus_schedules WHERE bus_schedule_id = NEW.bus_schedule_id) = 40 THEN
        UPDATE bus_schedules SET trip_status = 'closed' WHERE bus_schedule_id = NEW.bus_schedule_id;
      END IF;
    END IF;
  END";

if (mysqli_query($conn, $sql4)) {
    echo "Trigger update_seats_booked_and_trip_status created successfully";
    echo "<br><br>";
} else {
    echo "Error creating trigger: " . mysqli_error($conn);
    echo "<br><br>";
}

// create users table
$sql5 = "CREATE TABLE users (
    uid int(11) AUTO_INCREMENT PRIMARY KEY,
    first_name varchar(20) NOT NULL,
    last_name varchar(20) NOT NULL,
    phone_number varchar(30) NOT NULL,
    email varchar(30) NOT NULL,
    username varchar(15) NOT NULL,
    auth varchar(30) NOT NULL
    )";

if (mysqli_query($conn, $sql5)) {
    echo "Table users created successfully";
    echo "<br><br>";
} else {
    echo "Error creating users table: " . mysqli_error($conn);
    echo "<br><br>";
}

// create bookings table
$sql6 = "CREATE TABLE bookings (                        
    booking_id VARCHAR(50) NOT NULL PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    one_bus_id INT NOT NULL,
    one_seat_number INT NOT NULL,
    one_departure VARCHAR(30) NOT NULL,
    one_arrival VARCHAR(30) NOT NULL,
    one_departure_date DATE NOT NULL,
    one_departure_time TIME NOT NULL,
    one_arrival_date DATE NOT NULL,
    one_arrival_time TIME NOT NULL,
    one_bus_number VARCHAR(30) NOT NULL,
    one_ticket_price DECIMAL(10,2) NOT NULL,
    return_bus_id INT,
    return_seat_number INT,
    return_departure VARCHAR(30),
    return_arrival VARCHAR(30),
    return_departure_date DATE ,
    return_departure_time TIME,
    return_arrival_date DATE,
    return_arrival_time TIME,
    return_bus_number VARCHAR(30),
    return_ticket_price DECIMAL(10,2),
    total_paid DECIMAL(10,2) NOT NULL
    )";

if (mysqli_query($conn, $sql6)) {
    echo "Table bookings created successfully";
    echo "<br><br>";
} else {
    echo "Error creating bookings table: " . mysqli_error($conn);
    echo "<br><br>";
}

// create users_bookings table
$sql7 = "CREATE TABLE users_bookings (
    uid INT(11) NOT NULL,
       booking_id VARCHAR(50) NOT NULL,
       PRIMARY KEY (uid, booking_id),
       FOREIGN KEY (uid) REFERENCES users(uid) ON DELETE CASCADE,
       FOREIGN KEY (booking_id) REFERENCES bookings(booking_id) ON DELETE CASCADE
   )";
if (mysqli_query($conn, $sql7)) {
    echo "Table users_bookings created successfully";
    echo "<br><br>";
} else {
    echo "Error creating users table: " . mysqli_error($conn);
    echo "<br><br>";
}

// create admin_feedback table
$sql8 = "CREATE TABLE feedback (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    subject VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  )";

if (mysqli_query($conn, $sql8)) {
    echo "Table feedback created successfully";
    echo "<br><br>";
} else {
    echo "Error creating feedback table: " . mysqli_error($conn);
    echo "<br><br>";
}

mysqli_close($conn);
