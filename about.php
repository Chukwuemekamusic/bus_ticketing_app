<?php
session_start();    //create or retrieve session
if (IsSet($_SESSION["email"])){ //user must in session to stay here
$email=$_SESSION["email"];   //get user email into the variable $email
$first_name = ucfirst($_SESSION['first_name']); // ucfirst capitalises the first name
$last_name = $_SESSION['last_name'];

} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./Assets/css/stylenew.css">
    <link rel="stylesheet" href="unsemantic-grid-responsive-tablet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/sch work/style.css">
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
       
       <div class="row">
        <div class="col-md-12">
            
            <img src="rsz_adobestock_122358477.webp" alt="" id="banner">
        
            <h2 style="text-align: center;">ABOUT US</h2>
            <h4 style="text-align: center;">
                We  are currently in operation across all routes within the city. At the heart of ABCD Bus mandate are commuters, everyday people who rely on Bus Services to get to and from their homes and places of interests. 
We are an awarding wining Team ,that has been for over five decades, and we continue to play a significant role in ensuring quality commuting within  the city
            
            </h4> 

        </div>
       </div> <br>
       <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" style="margin-left: 300px;">Our mission Statement</a>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2" style="margin-left: 115px;">Our Vision</button>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample3" aria-expanded="false" aria-controls="multiCollapseExample3" style="margin-left: 115px;">Our Team</button>
        
      </p>
      <div class="row">
        <div class="col-md-4">
          <div class="collapse multi-collapse" id="multiCollapseExample1">
            <div class="card card-body">
                To Offer Sustainable and Intelligent Bus Transportation Systems to Suit the Needs of a Modern City"
            </div>
          </div>
        </div>

        <div class="col-md-4">
            <div class="collapse multi-collapse" id="multiCollapseExample2">
              <div class="card card-body">
               To be theleader in mobility in our city, in relation to the services offered and their quality.

              </div>
            </div>
          </div>
        <div class="col-md-4">
          <div class="collapse multi-collapse" id="multiCollapseExample3">
            <div class="card card-body">
                We are 800+ men and women passionate about connecting people to families, friends and loved
            </div>
          </div>
        </div>
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
                        <p><a href="faqUser.php">Frequently Asked Question</a></p>      
                    </section>
                </div>  
            </div>
        </div>   
        <div id="last">
            <p>&copy; 2023 Bus Inc. All rights reserved.</p>
        </div>
        
    </footer>


    <!-- <footer>
        <div class="container-fliud">
            <div>
                <div>
                    <nav class="menu">
                        <ul>
                            <li><a href="#"></a><ion-icon name="logo-facebook"></ion-icon></li>
                            <li><a href="#"></a><ion-icon name="logo-instagram"></ion-icon></li>
                            <li><a href="#"></a><ion-icon name="logo-twitter"></ion-icon></li>

                        </ul>
                    </nav>
                </div>
                
                    
                
            </div>
        </div>
        <div class="wrapper">
            <div class="button">
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                </div>
            </div>
        </div>


    </footer> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>