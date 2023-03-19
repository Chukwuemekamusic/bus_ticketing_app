<!DOCTYPE html>
<html>
<head>
	<title>Bus Search Form</title>
	<style>
		form {
			margin: 50px auto;
			max-width: 500px;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}
		label {
			display: block;
			margin-bottom: 10px;
		}
        input, select {
			margin: 5px;
			padding: 5px;
			border-radius: 5px;
			border: none;
			box-shadow: 0px 0px 5px gray;
			width: 100%;
		}
		input[type="text"], input[type="date"] {
			padding: 10px;
			border-radius: 5px;
			border: 1px solid #ccc;
			margin-bottom: 20px;
			width: 100%;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			width: 100%;
		}
	</style>
</head>
<body>
	<form method="post" action="result.php">
    <label for="departure">Departure location:</label>
		<select id="departure" name="departure">
			<option value="London">London</option>
			<option value="Manchester">Manchester</option>
			<option value="Birmingham">Birmingham</option>
			<option value="Liverpool">Liverpool</option>
			<option value="Glasgow">Glasgow</option>
			<option value="Edinburgh">Edinburgh</option>
			<option value="Belfast">Belfast</option>
			<option value="Dublin">Dublin</option>
			<option value="Newcastle">Newcastle</option>
			<option value="Leeds">Leeds</option>
			<option value="Cardiff">Cardiff</option>
			<option value="Bristol">Bristol</option>
			<option value="Southampton">Southampton</option>
			<option value="Portsmouth">Portsmouth</option>
			<option value="Sheffield">Sheffield</option>
			<option value="Nottingham">Nottingham</option>
			<option value="Cambridge">Cambridge</option>
			<option value="Norwich">Norwich</option>
			<option value="Plymouth">Plymouth</option>
			<option value="Exeter">Exeter</option>
		</select>
		<label for="arrival">Arrival location:</label>
		<select id="arrival" name="arrival">
			<option value="London">London</option>
			<option value="Manchester">Manchester</option>
			<option value="Birmingham">Birmingham</option>
			<option value="Liverpool">Liverpool</option>
			<option value="Glasgow">Glasgow</option>
			<option value="Edinburgh">Edinburgh</option>
			<option value="Belfast">Belfast</option>
			<option value="Dublin">Dublin</option>
			<option value="Newcastle">Newcastle</option>
			<option value="Leeds">Leeds</option>
			<option value="Cardiff">Cardiff</option>
			<option value="Bristol">Bristol</option>
			<option value="Southampton">Southampton</option>
			<option value="Portsmouth">Portsmouth</option>
			<option value="Sheffield">Sheffield</option>
			<option value="Nottingham">Nottingham</option>
			<option value="Cambridge">Cambridge</option>
			<option value="Norwich">Norwich</option>
			<option value="Plymouth">Plymouth</option>
			<option value="Exeter">Exeter</option>
		</select>
		<label for="date">Travel Date:</label>
		<input type="date" id="date" name="date" required>

		<input type="submit" value="Search">
	</form>
</body>
</html>
