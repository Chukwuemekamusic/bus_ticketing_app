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
$conn = new mysqli($servername, $username, $password, $dbname);


// when form for changing the password is submitted
if (isset($_POST['change_password'])) {
    $userid = $_POST['userid'];
    $newpassword = $_POST['newpassword'];
    
    // Update the password in the database
    $update_query = "UPDATE users SET auth = ? WHERE uid = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $newpassword, $userid);
    $stmt->execute();
    $stmt->close();
}

$sql = "SELECT uid, first_name, last_name, phone_number, email, username, auth
        FROM users order by uid DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$allusers = $stmt->get_result();
$stmt->close();

$sql2 = "SELECT count(*) as usercount FROM users";
$stmt = $conn->prepare($sql2);
$stmt->execute();
$result2 = $stmt->get_result();
$usercount = mysqli_fetch_assoc($result2)['usercount'];
$stmt->close();

$sql3 = "SELECT count(*) as bookingcount FROM bookings";
$stmt = $conn->prepare($sql3);
$stmt->execute();
$result3 = $stmt->get_result();
$bookingcount = mysqli_fetch_assoc($result3)['bookingcount'];
$stmt->close();

$sql5 = "SELECT id, name, email, message
        FROM feedback order by id DESC";
$stmt = $conn->prepare($sql5);
$stmt->execute();
$feedback = $stmt->get_result();
$stmt->close();

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
                        <li><a href="admin.php">Manage System</a></li>
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
                    <hr>
                    <div class="container">
            <form class="contactinfo">
            <label><strong>Number of Bookings: </strong><?php echo $bookingcount; ?></label>
            </form>
        </div><br>

        <div class="container">
        <form class="contactinfo">

            <label><strong>Number of Users: </strong><?php echo $usercount; ?></p>
            </form>

        </div><br>

        <div class="container">
        <label><strong>Registered Users:</strong></label>
            <table class="table table-bordered">

    <tr class="table-info">
        <th>User ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Username</th>
        <th>Password</th>
    </tr>
                <?php while ($row = $allusers->fetch_assoc()) { ?>
                <tr class="table-success">
                    <td><?php echo $row['uid']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['auth']; ?></td>
    </tr>
    <?php } ?>
</table>

        </div>
        <br>

        <div class="container">
         
  <h6>Change User Password:</h6>
  <form class="contactinfo" method="POST" action="">
    <label for="userid">User ID:</label>
    <input type="text" name="userid" id="userid" required>
   
    <label for="newpassword">New Password:</label>
    <input type="password" name="newpassword" id="newpassword" required>
    
    <input type="submit" name="change_password" value="Change Password">
</form>
</div>
            <br><br>
            <div class="container">
                <h3>Users Feedback</h3>

<table class="table table-bordered">

<tr class="table-info">
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Message</th>
</tr>
            <?php while ($row = $feedback->fetch_assoc()) { ?>
            <tr class="table-success">
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['Message']; ?></td>
</tr>
<?php } ?>
</table>

            </div>
            <br><br>  
            <div class="container">
                <h3>Manage Bookings</h3>
            </div>
        </div>
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