<?php
session_start();
include_once('./connection.php');
if ($_SERVER['REQUEST_METHOD'] != "POST") { 
    echo 'nothing sent';
    exit;
}

$return_busID = $_POST['return_bus_id'];
// $return_busID = 554;
$_SESSION['return_bus_id'] = $return_busID;


include('./get_bus_details.php');
$buses = getBuses($return_busID);
$_SESSION['return_price'] = $buses[0]['ticket_price'];

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
    <link rel="stylesheet" href="./Assets/css/stylenew.css">
    <script src="./seatsreturn.js"></script>
</head>

<body>
    <header class="text-center">
        <h1>Seat Reservation</h1>
        <h5><?php echo "{$buses[0]['departure']} to {$buses[0]['arrival']}"; ?></h5>
        <h5><?php echo "Departure: {$buses[0]['departure_date']} {$buses[0]['departure_time']} "; ?></h5>
        <h5><?php echo "Arrival: {$buses[0]['arrival_date']} {$buses[0]['arrival_time']} "; ?></h5>
        <h5><?php echo "Ticket price: £{$buses[0]['ticket_price']}"; ?></h5>

    </header>



    <div class="table-responsive mx-auto mt-4 mb-4">
        <!--  -->
        <!-- <form action="" id="submit_seat_selection"></form> -->

        <table class="mx-auto mb-3">
            <tr>
                <th class="selected">Selected Seat</th>
                <th class="available">Available Seat</th>
                <th class="booked">Booked Seat</th>
            </tr>

        </table>
        <?php
        
        ?>
        <form id="submit_seat_selection" method="post" action="payment.php">
        <?
        
        ?>
        <table class="mx-auto">
        <tr>
        <td colspan="4"></td>
        <td>
            <img src="steeringwheel2.jpg" alt="steering wheel icon" height="50px">
        </td>
    </tr>
    <tr>
        <?php
        $count = 0;
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
                echo "<button type='button' class='seat-button' name='return_selected_seat' value='$seat_number';>$seat_number</button>";
            } else if ($bus['status'] != 'available'){
                // echo "<button class='seat-button-booked' type='button' name='booked_seat' value='$seat_number';>" . $seat_number . "</button>";
                echo "<button type='button' class='seat-button-booked' style='background-color: red; width: 60px; height: 40px; border-radius: 10px;' name='selected_seat' value='$seat_number';>$seat_number</button>";

            }
            echo '</td>';
            $count++;
        }
        ?>
    </tr>
</table>

        
        <input type="hidden" id="selected-seat-input" name="return_selected_seat" value="">
        <button class="btn btn-primary mx-auto mt-2" type="submit" id="submit-seat-btn" style="display: none;">Continue</button>
        </form>
    </div>

    <!-- #TODO add the cancel button -->
    
    <!-- <script src="./tutorial/js/jquery-3.5.1.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/8c47bf12e3.js" crossorigin="anonymous"></script>
</body>

</html>