<?php
function getBuses($busID) {
    include('../connection.php');
    $sql = "SELECT * FROM bus_schedules b, bus_seats bs
            WHERE b.bus_schedule_id = bs.bus_schedule_id
            AND b.bus_schedule_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // handle the error
        echo 'statement failed!!!';
        echo "Error: " . $conn->error;
        return null;
    } else {
        $stmt->bind_param("i", $busID);
        $stmt->execute();
        $result = $stmt->get_result();
        $buses = $result->fetch_all(MYSQLI_ASSOC);
        return $buses;
    }
}
?>
