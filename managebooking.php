<?php
session_start();
if (!IsSet($_SESSION["email"]))  //user variable must exist in session to stay here
   header("Location:login.php");  //if not, go back to login page
   $email=$_SESSION["email"];   //get user name into the variable $username
   $first_name = ucfirst($_SESSION['first_name']); // ucfirst capitalises the first name
   $last_name = $_SESSION['last_name'];
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
                        <li><a href="profile.php">My Account</a></li> 
                        <li><a href = "aboutUser.php" class="nav-item">About Us</a></li>
                            <li><a href = "contactusUser.php" class="nav-item">Contact Us</a></li> 
                            <li><p>
        Hello <?php print $first_name; ?>!        
    </p></li>
    <li><a href="logout.php">Logout</a></li> 
                        </ul>
                    </nav>
                    </div>
                </div>    
            </div>

        </header>
    <main>
    <p>
                Welcome back, <?php print $first_name; ?>!
                <!-- This is another page apart from the <a href="home.php">home page</a> -->

            </p>
    <h2>Manage Your Bookings</h2>



    </main>
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
                        <p><a href="faqUser.php">Frequently Asked Question</a></p>      
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