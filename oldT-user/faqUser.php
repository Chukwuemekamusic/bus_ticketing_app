<?php
session_start();    //create or retrieve session
if (!IsSet($_SESSION["email"])){ //user must in session to stay here
   header("Location: login.php"); }  //if not, go back to login page
$email=$_SESSION["email"];   //get user email into the variable $email
$first_name = ucfirst($_SESSION['first_name']); // ucfirst capitalises the first name
$last_name = $_SESSION['last_name'];
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Edge Bus Home</title>
        <link rel="stylesheet" href="./Assets/css/stylenew.css">
        <link rel="stylesheet" href="unsemantic-grid-responsive-tablet.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap-theme.min.css">
    </head>

    <body>
        <div>
            <header class="container">
                <div class="col-md-12">
                    <div id="headerContainer" class="row">
                        <div class="col-md-2">
                            <img id="buslogo" src="./Assets/Buslogo.png" alt="Edge Bus Logo">
                        </div>
                    
                        <div class="col-md-10">
                        <nav>
                            <ul class="nav justify-content-end">
                            <li><a href = "profile.php" class="nav-item">My Account</a></li>
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
                <h3>Q: How do I buy tickets?</h3>
                <!-- #TODO update this response -->
            <p>A: Buying tickets is easy! Tap the Ticket button on the app, click buy, choose your area, select your ticket from the product catalogue, choose a sit, and then simply choose a payment method. There is no minimum purchase. You can simply buy the ticket you want in advance of your journey or buy several at once.</p>

            <h3>Q:How do I know if my tickets have been booked and paid for?</h3>
            <p>A: Once you have confirmed your trip, personal and payment details, a deduction will occur in your account and a summary of this message will be displayed with your booking reference number. Email notification stating it a successful transaction will be sent to your email address. The booking reference indicates that your reservation has been confirmed.</p>
    
            <h3>Q: Can I get a refund for my ticket</h3>
            <p>A: Purchased tickets are valid for one year. So, in a situation where your trip is canceled, your ticket is valid for a year.</p>
            
            <h3>Q:If I book my ticket online, how do I get my ticket?</h3>
            <p>A: If you make a reservation online, you will receive an email notification communicating details of your trip. Kindly present a print out of this email or show the reference code for your boarding tickets to be issued to you at the terminal.</p>

            <h3>Q: I have money in my account, but my card is declining</h3>
            <p>A: Some higher value transactions (typically over £100) can trigger a further fraud check from your card issuer. However, the bank server might be slow. You can refresh your app and try again.</p>
            

            <h3>Q: What luggage capacity am I entitled to?</h3>
            <p>A: Guests are allowed to bring one medium size luggage. Should luggage exceed the acceptable limit, kindly book an extra seat before trip date.</p>
        
            <!-- <h3>Q: Can I trade in my reservation?</h3>
            <p>A: Sometimes your schedule changes. We get that. We want to ensure you can quickly and easily change your reservation to match your new schedule. You can trade in your reservation online as long as it is more than 3 hours before your scheduled departure. The cost of your initial reservation will go towards crediting the new one.</p> -->
            
            <h3>Q: Can I bring food on the bus?</h3>
            <p>A: You are welcome to snack on our buses. However, alcoholic beverages are not permitted on the bus (including checked baggage).</p>

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
                        </div>  
                    </div>
                </div>   
                <div id="last">
                    <p>&copy; 2023 Bus Inc. All rights reserved.</p>
                </div>
                
            </footer>
        </div>
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/8c47bf12e3.js" crossorigin="anonymous"></script>
    </body>

</html>

    