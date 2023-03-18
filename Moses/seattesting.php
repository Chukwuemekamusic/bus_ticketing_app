


<div class="table-container">
<?php 
    $seat_array = range(1,40);
    $selected_seats = array(); // Initialize array to store selected seats
    $booked_seats = array(); // Initialize array to store booked seats

    $count = 0;
    echo '<table>';
    echo '<tr>
        <td colspan="4"></td>
        <td>
            <img src="steeringwheel2.jpg" alt="steering wheel icon" height="50px">
        </td>
    </tr>';

    // Add labels for selected, available, and booked seats
    echo '<tr>
        <th class="selected">Selected Seats</th>
        <th class="available">Available Seats</th>
        <th class="booked">Booked Seated</th>
    </tr>';

    echo '<tr>' ;
    foreach($seat_array as $seat) {
        if($count % 5 == 0 && $count != 0) {
            echo '</tr><tr>';
        }

        // Determine if seat is selected or booked and add to appropriate array
        if (in_array($seat, $selected_seats)) {
            $class = 'selected';
        } else if (in_array($seat, $booked_seats)) {
            $class = 'booked';
        } else {
            $class = 'available';
        }

        echo '<td class="' . $class . '">';
        if ($count == 1) {
            echo '&nbsp; </td><td>';
            $count++;
        }
        if ($count % 5 == 2 && $count != 47) {
            echo '&nbsp; </td><td>';
            $count++;
        }
        echo "<button style='background-color: lightblue; width: 60px; height: 40px;' value='$seat';>$seat</button>";
        // class='btn btn-info btn-block'

        // Update selected or booked seats array when button is clicked
        echo "<script>
            document.querySelector(\"button[value='$seat']\").addEventListener('click', function() {
                if (this.parentElement.classList.contains('selected')) {
                    this.parentElement.classList.remove('selected');
                    $selected_seats = $selected_seats.filter(function(seat) {
                        return seat != $seat;
                    });
                } else if (this.parentElement.classList.contains('booked')) {
                    alert('This seat is already booked.');
                } else {
                    this.parentElement.classList.add('selected');
                    $selected_seats.push($seat);
                }
            });
        </script>";
        
        $count++;
    }
    echo '</tr>';
    echo '</table>';
?>

<style>
    th.selected {
        background-color: lightblue;
    }
    th.available {
        background-color: lightgreen;
    }
    th.booked {
        background-color: lightgrey;
    }
</style>