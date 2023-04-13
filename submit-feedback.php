<?php
include("connection.php");

  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  $conn = new mysqli($servername, $username, $password, $dbname);

  $sql = "INSERT INTO feedback (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
  if (mysqli_query($conn, $sql)) {
    header('Location: thankyou.php');
    exit;
  } else {
    header('Location: contactus.php');
    exit;
  }

?>