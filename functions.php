<?php
include_once('./connection.php');
function get_user_details($details, $table, $condition = '', $order_by = '')
{
    global $conn;
    $sql = "SELECT $details FROM $table";
    if ($condition !== '') {
        $sql .= " WHERE $condition";
    }
    if ($order_by !== '') {
        $sql .= " ORDER BY $order_by";
    }
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // handle the error
        echo 'statement failed!!!';
        echo "Error: " . $conn->error;
        return null;
    } else {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "Error: " . $conn->error;
            return null;
        }
    }
}

function get_single_detail($name, $table, $condition)
{
    return get_user_details($name, $table, $condition)[0][$name];
}

function update_bus_seats($table,$status, $seat_number, $busID)
{
    global $conn;

    // Update seat status in database
    $sql = "UPDATE $table SET status =? WHERE seat_number =? AND bus_schedule_id =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $status, $seat_number, $busID);
    $stmt->execute();

    // Handle errors if necessary
    if (!$stmt) {
        echo "Error: " . $conn->error;
    } else {
        echo 'done!!!';
    }
}
