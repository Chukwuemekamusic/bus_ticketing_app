<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div>

    <div>
        <h3>Passenger Details</h3>
        <label for="firstname">First name</label>
        <input type="text", name="firstname">
        <label for="lastname">Last name</label>
        <input type="text", name="lastname">
    </div>

    <div class="table-container">
        <h3>Seat Selection</h3>
    <?php 
        $seat_array = range(1,40);

        echo '<table>';
        echo '<tr>
        <th class="selected">Selected Seat</th>
        <th class="available">Available Seat</th>
        <th class="booked">Booked Seat</th>
        </tr>';
        echo '</table>';
        
        $count = 0;
        echo '<form method="POST">';
        echo '<table>';
        
        
        echo '<tr>
            <td colspan="4"></td>
            <td>
                <img src="steeringwheel2.jpg" alt="steering wheel icon" height="50px">
            </td>
        </tr>';

        echo '<tr>' ;
        foreach($seat_array as $seat) {
            if($count % 5 == 0 && $count != 0) {
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
            echo "<button type='submit' style='background-color: lightblue; width: 60px; height: 40px; cursor: pointer;' value='$seat'; name='seat'>$seat</button>";
            // class='btn btn-info btn-block'
            echo '</td>';
            $count++;
            

        }
        echo '</tr>';
        echo '</table>';
        echo '</form>';

    ?>
    </div>

    <div>
        <h3>Payment</h3>
    </div>

    </div>


</body>
</html>