<?php session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Bus Search Results</title>
	<style>
		table {
			border-collapse: collapse;
			margin: 50px auto;
			width: 80%;
		}
		th, td {
			padding: 10px;
			text-align: left;
			border: 1px solid black;
		}
		th {
			background-color: #0fe228;
			color: white;
		}
		input[type="submit"] {
			background-color: #00ff00;
			color: white;
			cursor: pointer;
			padding: 10px;
			border: none;
			border-radius: 5px;
		}
	</style>
<body>
	<h1>Bus Search Results</h1>
	<table>
		<thead>
			<tr>
				<th>Departure Location</th>
				<th>Arrival Location</th>
				<th>Travel Date</th>
				<th>Departure Time</th>
				<th>Arrival Time</th>
				<th>Price</th>
				<th>Available Seats</th>
				<th>Book</th>
			</tr>
		</thead>
		<tbody>
			<?php
            
                // Connect to the database
                include_once('./connection.php');
				
				// replace these variables with the user input from the search form
				$departure_location = $_SESSION['arrival'];				
				$arrival_location = $_SESSION['departure'];
				$travel_date = $_SESSION['returndate'];
                $_SESSION['selected_seat'] = $_POST['selected_seat'];
				

				//store returndate in as session
				// if ($search_returndate) {
					
				// }
				
				// perform the search query
				$search_query = "SELECT * FROM bus_schedules WHERE departure = '$departure_location' AND arrival = '$arrival_location' AND departure_date = '$travel_date'";
				$search_result = mysqli_query($conn, $search_query);
				
				// output the search results as table rows
				while ($row = mysqli_fetch_assoc($search_result)) {
					echo "<tr>";
					echo "<td>" . $row['departure'] . "</td>";
					echo "<td>" . $row['arrival'] . "</td>";
					echo "<td>" . $row['departure_date'] . "</td>";
					echo "<td>" . $row['departure_time'] . "</td>";
					echo "<td>" . $row['arrival_time'] . "</td>";
					echo "<td>£" . $row['ticket_price'] . "</td>";
					echo "<td>" . $row['seats_available'] . "</td>";
					echo "<td><form action='./seatsreturn.php' method='post'><input type='hidden' name='return_bus_id' value='" . $row['bus_schedule_id'] . "'><input type='submit' value='Select'></form></td>";
					echo "</tr>";


				}
                // echo $_SESSION['returndate'];
			?>
            
		</tbody>
	</table>
</body>
</html>

<!-- // $_SESSION['selected_seat'] = $_POST['selected_seat'];
            // $arrival = $_SESSION['departure'];
            // $departure = $_SESSION['arrival'];
            // $return_date = $_SESSION['returndate']; -->
