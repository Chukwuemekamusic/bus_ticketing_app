<?php
session_start();    //create or retrieve session

include_once("connection.php");
include_once('./functions.php');

if (IsSet($_SESSION["email"])){ //user must in session to stay here
$email=$_SESSION["email"];   //get user email into the variable $email
$first_name = ucfirst($_SESSION['first_name']); // ucfirst capitalises the first name
$last_name = $_SESSION['last_name'];
$user_id = get_single_detail('uid', 'users', "email = '$email'");
} else {
    header('Location: home.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 minimum-scale=1, maximum-scale=1">
    <title>Edge Bus Home</title>
    <link rel="stylesheet" href="./Assets/css/stylenew.css">
    <link rel="stylesheet" href="unsemantic-grid-responsive-tablet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap-theme.min.css">
    <!-- js for return button -->
    <script src="./app2.js"></script>
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
                        <li><a href="admin.php">Home</a></li>
                        <li><a href="admin_bus_schedules.php">Manage Bus Schedules</a></li>
                        <li><a href="admin_view_feedback.php">User Feedback</a></li>
                        <li><p>Hello <?php print $first_name; ?>!</p>
                            </li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </header>

    <main>
        <div>
            <br><br>
        <div class="container">
                <h3>Users Feedback</h3>
                <?php
                include("connection.php");
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error);
                }

                $sql = "SELECT * FROM feedback";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table table-bordered'><tr class='table-info'><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Delete</th></tr>";
                    while($row = $result->fetch_assoc()) {
                    echo "<tr class='table-success'><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td><td>" . $row["subject"]. "</td><td>" . $row["message"]. "</td><td><a href='deletefeedback.php?id=" . $row["id"]. "'>Delete</a></td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<h6>No feedback found</h6>.";
                }

                $conn->close();
                ?>
        </div>
        <br><br>
    </main>

    <footer>
        <hr>
        <div class="container">
            <div class="col-md-12" id="lastleft">
                <div id="footercontainer" class="row">
                    <section class="col-md-3">
                        <h4>Contact Us</h4>
                        <ul>
                            <li>Email: info@xxxxbus.com</li>
                            <li>Phone No.: +44 7498 xxxxxxx</li>
                        </ul>
                    </section>
                    <section class="col-md-6">
                    </section>
                    <section class="col-md-3">
                        <h4>Quick Guide</h4>
                        <!-- <p><a href="faq.php">Frequently Asked Question</a></p> -->
                    </section>
                </div>
            </div>
        </div>
        <div id="last">
            <p>(c) 2023 xxxx Bus</p>
        </div>

    </footer>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/8c47bf12e3.js" crossorigin="anonymous"></script>
</body>

</html>