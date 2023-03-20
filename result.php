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
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "bus_database";
				// replace this with your own database connection code
				$db_connection = mysqli_connect($servername, $username, $password, $dbname);
				
				// replace these variables with the user input from the search form
				$departure_location = $_POST['departure'];
				$arrival_location = $_POST['arrival'];
				$travel_date = $_POST['date'];
				
				// perform the search query
				$search_query = "SELECT * FROM buses WHERE departure_location = '$departure_location' AND arrival_location = '$arrival_location' AND travel_date = '$travel_date'";
				$search_result = mysqli_query($db_connection, $search_query);
				
				// output the search results as table rows
				while ($row = mysqli_fetch_assoc($search_result)) {
					echo "<tr>";
					echo "<td>" . $row['departure_location'] . "</td>";
					echo "<td>" . $row['arrival_location'] . "</td>";
					echo "<td>" . $row['travel_date'] . "</td>";
					echo "<td>" . $row['departure_time'] . "</td>";
					echo "<td>" . $row['arrival_time'] . "</td>";
					echo "<td>£" . $row['price'] . "</td>";
					echo "<td>" . $row['available_seats'] . "</td>";
					echo "<td><form action='payment.php'><input type='hidden' name='bus_id' value='" . $row['id'] . "'><input type='submit' value='Select'></form></td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
</body>
</html>
