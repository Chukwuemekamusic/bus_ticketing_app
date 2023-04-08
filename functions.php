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

function get_single_detail($name, $table, $condition) {
    return get_user_details($name, $table, $condition)[0][$name];
}

?>