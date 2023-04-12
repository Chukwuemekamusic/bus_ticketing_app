<?php
include("connection.php");

$feedback_id = $_GET['id'];

$conn->query("DELETE FROM feedback WHERE id = $feedback_id");

header('Location: admin_view_feedback.php');
?>