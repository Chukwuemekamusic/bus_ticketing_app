<?php 
    $seat_array = range(1,40);



    $count = 0;
    echo '<table>';
    echo '<tr>
        <td colspan="4"></td>
        <td>
            <a href="https://www.flaticon.com/free-icons/steering-wheel" title="steering wheel icons">Steering wheel icons created by deemakdaksina - Flaticon</a></>
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
        echo "<button style='background-color: green; width: 50px;' value='$seat';>$seat</button>";
        // class='btn btn-info btn-block'
        echo '</td>';
        $count++;
        

    }
    echo '</tr>';
    echo '</table>';


?>