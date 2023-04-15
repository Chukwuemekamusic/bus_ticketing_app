<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 minimum-scale=1, maximum-scale=1">
	<title>Bus Search Results</title>
	<link rel="stylesheet" href="./Assets/css/stylenew.css">
	<link rel="stylesheet" href="unsemantic-grid-responsive-tablet.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap-theme.min.css">
	<!-- js for return button -->
	<script src="./app2.js"></script>
	<style>
		table {
			border-collapse: collapse;
			margin: 50px auto;
			width: 80%;
		}

		th,
		td {
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
</head>

<body>
	<header class="container">
		<div class="col-md-12">
			<div id="headerContainer" class="row">
				<div class="col-md-2">
					<img id="buslogo" src="./Assets/Buslogo.png" alt="Edge Bus Logo">
				</div>

				<div class="col-md-10">
					<nav>
						<ul class="nav justify-content-end">
							<?php if (!isset($_SESSION['email'])) { ?>
								<li><a href="home.html" class="nav-item active">Home</a></li>
								<li><a href="about.php" class="nav-item">About Us</a></li>
								<li><a href="contactus.php" class="nav-item">Contact Us</a></li>
								<li><a href="login.html" class="nav-item">Sign-in|Sign up</a></li>

							<?php } else {
								$first_name = ucfirst($_SESSION['first_name']); ?>
								<li><a href="profile.php">My Account</a></li>
								<li><a href="about.php" class="nav-item">About Us</a></li>
								<li><a href="contactus.php" class="nav-item">Contact Us</a></li>
								<li>
									<p>Hello <?php print $first_name; ?>!</p>
								</li>
								<li><a href="logout.php">Logout</a></li>
							<?php } ?>

						</ul>
					</nav>
				</div>
			</div>
		</div>

	</header>
	<h1>Bus Search Results</h1>
	<?php

	// Connect to the database
	include_once('./connection.php');

	// replace these variables with the user input from the search form
	$departure_location = $_SESSION['arrival'];
	$arrival_location = $_SESSION['departure'];
	$travel_date = $_SESSION['returndate'];
	$_SESSION['selected_seat'] = $_POST['selected_seat'];
	echo $departure_location . '<br>';
	echo $arrival_location . '<br>';
	echo $travel_date;
	echo $_SESSION['selected_seat'];


	// perform the search query
	$search_query = "SELECT * FROM bus_schedules WHERE departure = '$departure_location' AND arrival = '$arrival_location' AND departure_date = '$travel_date'";
	$search_result = mysqli_query($conn, $search_query);
	if (mysqli_num_rows($search_result) > 0) {
	?>

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
	<?php } else {
		echo "<h2 class='text-center'>No bus available for $departure_location to $arrival_location</h2>";
	} ?>

	<footer>
		<hr>
		<div class="container">
			<div class="col-md-12" id="lastleft">
				<div id="footercontainer" class="row">
					<section class="col-md-3">
						<!-- <a href="contactus.html"><h4>Contact Us</h4></a> -->
						<ul>
							<li>Email: info@xxxxbus.com</li>
							<li>Phone No.: +44 7498 xxxxxxx</li>
							<li>Address: Garthdee, Aberdeen, Scotland, UK</li>
						</ul>
					</section>
					<section class="col-md-6">
					</section>
					<section class="col-md-3">
						<h4>Quick Guide</h4>
						<p><a href="faq.php">Frequently Asked Question</a></p>
					</section>
				</div>
			</div>
		</div>
		<div id="last">
			<p>&copy; 2023 Bus Inc. All rights reserved.</p>
		</div>

	</footer>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/8c47bf12e3.js" crossorigin="anonymous"></script>
</body>

</html>

<!-- // $_SESSION['selected_seat'] = $_POST['selected_seat'];
            // $arrival = $_SESSION['departure'];
            // $departure = $_SESSION['arrival'];
            // $return_date = $_SESSION['returndate']; -->