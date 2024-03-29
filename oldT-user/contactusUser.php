<?php
session_start();    //create or retrieve session
if (IsSet($_SESSION["email"])){ //user must in session to stay here
$email=$_SESSION["email"];   //get user email into the variable $email
$first_name = ucfirst($_SESSION['first_name']); // ucfirst capitalises the first name
$last_name = $_SESSION['last_name'];

}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
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
                            <?php if (isset($_SESSION["email"])) { ?>
                                <li><a href = "profile.php" class="nav-item">My Account</a></li>
                        <li><a href = "about.php" class="nav-item">About Us</a></li>
                        <li><a href = "contactus.php" class="nav-item">Contact Us</a></li>   

                        <li><?php if(isset($_SESSION['email'])) { ?>
                            <p>
        Hello <?php print $first_name; ?>!        
    </p>
<?php } ?></li>                    
    <li><a href="logout.php">Logout</a></li> 
    <?php } else { ?>
        <li><a href = "home.html" class="nav-item active">Home</a></li>
                            <li><a href = "about.php" class="nav-item">About Us</a></li>
                            <li><a href = "contactus.php" class="nav-item">Contact Us</a></li>   
                            <li><a href = "login.html" class="nav-item">Sign-in|Sign up</a></li>  
    <?php } ?>

                    </ul>
                 
                </nav>
                </div>
            </div>    
        </div>

    </header>
    <main class=>
        <h1 style="text-align: center;">Customer Feedback</h1>
            <p style="text-align: center;">Please get in touch with us. We'll contact you as soon as we can after you complete the form below.
            </p>
        <div id="customerfeedback">
            <form class="contactinfo" action="thankyou.html" method="get">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required><br><br>
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" cols="30" required></textarea><br><br>
                <input type="submit" value="Submit">
            </form>
        </div>
        <div  id="contactfooterlist">            
            <p><strong>You can also contact us directly</strong></p>
            <p><strong>Email:</strong><a href="mailto:e.oloruntobi@rgu.ac.uk">e.oloruntobi@rgu.ac.uk</a></p>
            <p><strong>Phone:</strong> +44-245-7894-234</p>
            <p><strong>Address:</strong> Garthdee, Aberdeen, Scotland, UK</p>
            
        </div>
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