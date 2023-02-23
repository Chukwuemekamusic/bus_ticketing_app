<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$user = $_POST['user'];
$psw = $_POST['password'];
?>

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "BusApp";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO users (first_name,last_name,phone_number,email,username,password) VALUES ('$first_name','$last_name','$phone','$email','$user','$psw')";
if (mysqli_query($conn, $sql)) {
  // echo "Registration successful";
  header("Location: reg_completed.html"); //send user back to Login page
  exit();

} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>

<!-- Close the connection to the MySQL database at the end of your PHP file using the following code: -->
<?php
// $conn->close();
mysqli_close($conn);
?>




