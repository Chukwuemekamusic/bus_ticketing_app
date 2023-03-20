<?php
session_start();
include('../connection.php');
// if ($_SERVER['REQUEST_METHOD'] == "POST") {
// $busID = $_POST['id'];
$busID = 530;
$_SESSION['bus_id'] = $busID;
$sql = "SELECT * FROM bus_schedules b, bus_seats bs
        WHERE b.bus_schedule_id = bs.bus_schedule_id
        AND b.bus_schedule_id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    // handle the error
    echo 'statement failed!!!';
    echo "Error: " . $conn->error;
} else {
    $stmt->bind_param("i", $busID);
    $stmt->execute();
    $result = $stmt->get_result();
    $buses = [];
    while ($row = $result->fetch_assoc()) {
        $buses[] = $row;
    }
    // $buses = $result->fetch_all(MYSQLI_ASSOC); alternative way to assign the $buses;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Reservation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="./seats.js"></script>
</head>

<body>
    <header class="text-center">
        <h1>Seat Reservation</h1>
        <h5><? echo "{$buses[0]['departure']} to {$buses[0]['arrival']}"; ?></h5>
        <h5><? echo "Departure: {$buses[0]['departure_date']} {$buses[0]['departure_time']} "; ?></h5>
        <h5><? echo "Arrival: {$buses[0]['arrival_date']} {$buses[0]['arrival_time']} "; ?></h5>
        <h5><? echo "Ticket price: £{$buses[0]['ticket_price']}"; ?></h5>

    </header>



    <div class="table-container mt-5">
        <?
        // Check if the returndate parameter is set
        if (isset($_SESSION['returndate'])) {
            // Set the form action to the URL for selecting a return bus and seat
            $form_action = 'select_return_journey.php';     // name of the search return bus page
        } else {
            // Set the form action to the URL for selecting a bus and seat
            $form_action = "./submit_seat_selection.php";
        }

        ?>
        <!-- <form action="" id="submit_seat_selection"></form> -->

        <table>
            <tr>
                <th class="selected">Selected Seat</th>
                <th class="available">Available Seat</th>
                <th class="booked">Booked Seat</th>
            </tr>

        </table>
        <?php
        // Check if the returndate parameter is set
        if (isset($_GET['returndate'])) {
        // Set the form action to the URL for selecting a return bus and seat
        $form_action = 'select_return_journey.php';
        } else {
        // Set the form action to the URL for selecting a bus and seat
        $form_action = "home.html";
        }
        ?>
        <form id="submit_seat_selection" method="post" action="<?php echo $form_action; ?>">
        <?
        $count = 0;
        echo '<table>';


        echo '<tr>
        <td colspan="4"></td>
        <td>
            <img src="steeringwheel2.jpg" alt="steering wheel icon" height="50px">
        </td>
        </tr>';

        echo '<tr>';
        foreach ($buses as $bus) {
            $seat_number = $bus['seat_number'];
            if ($count % 5 == 0 && $count != 0) {
                echo '</tr><tr>';
            }

            echo '<td>';
            if ($count == 1) {
                echo '&nbsp; </td><td>';
                $count++;
            }
            if ($count % 5 == 2 && $count != 47) {
                echo '&nbsp; </td><td>';
                $count++;
            }
            // determine the path of the form
            
            if ($bus['status'] == 'available') {
                echo "<button type='button' class='seat-button' name='selected_seat' value='$seat_number';>$seat_number</button>";
            } else if ($bus['status'] != 'available'){
                // echo "<button class='seat-button-booked' type='button' name='booked_seat' value='$seat_number';>" . $seat_number . "</button>";
                echo "<button type='button' class='seat-button-booked' style='background-color: red; width: 60px; height: 40px; border-radius: 10px;' name='selected_seat' value='$seat_number';>$seat_number</button>";

            }
            echo '</td>';
            $count++;
        }
        echo '</tr>';
        echo '</table>'; ?>

        <input type="hidden" id="selected-seat-input" name="selected_seat" value="">
        <button class="btn btn-primary mt-2" type="submit" id="submit-seat-btn" style="display: none;">Continue</button>
        </form>
    </div>

    <!-- #TODO add the cancel button -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/8c47bf12e3.js" crossorigin="anonymous"></script>
</body>

</html>