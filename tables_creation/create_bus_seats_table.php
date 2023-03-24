<!-- this scripts creates the bus_seats table
      it also creates functions that automatically updates the number of seats booked 
      on a bus schedule when a seat is booked.-->

<?php 
include_once("connection.php");

// Create the bus_seats table
$sql = "CREATE TABLE bus_seats (
  seat_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  bus_schedule_id INT(6) UNSIGNED,
  seat_number INT(11) NOT NULL,
  status ENUM('available', 'reserved', 'booked') NOT NULL DEFAULT 'available',
  FOREIGN KEY (bus_schedule_id) REFERENCES bus_schedules(bus_schedule_id) on DELETE CASCADE
)";

if (mysqli_query($conn, $sql)) {
    echo "Table bus_seats created successfully";
} else {
    echo "Error creating bus_seats table: " . mysqli_error($conn);
}

// this trigger updates seats_booked and trip_status in bus_schedules table. 
$sql2 = "CREATE TRIGGER update_seats_booked_and_trip_status 
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

if (mysqli_query($conn, $sql2)) {
    echo "Trigger update_seats_booked_and_trip_status created successfully";
} else {
    echo "Error creating trigger: " . mysqli_error($conn);
}
mysqli_close($conn);
?>

