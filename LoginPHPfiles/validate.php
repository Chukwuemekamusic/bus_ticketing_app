<?php
session_start();   //start a session here in case user login successfully
if (!IsSet($_POST))    //if no $_POST array
{
    session_destroy();   //clear session
    header("Location: /app/cmm004_bus_app/login.html");   //send user back to login page
    exit();
}
if (!IsSet($_POST["user"]) || !IsSet($_POST["password"]))  // no username or password submitted
{
    session_destroy();   
    header("Location: /app/cmm004_bus_app/login.html"); //send user back to Login page
    exit();
}
/* 
All accounts into separate PHP file, 
reference file here then use "required_once" as script can run without
account information and not neccessary to be added more than once
*/

require_once "accounts.php";

/* 
below function return true/false for a given username and password.
It will only retrun true if the username-password pair appears in the array
*/
function valid_login($username,$password)
{
    global $accounts;  //$accounts is a global variable
    //defined in accounts.php, which is included above.
    if (!IsSet($accounts[$username]))  //check to see if this username has a password
        return(false);  //return false if no password exists

    return($password==$accounts[$username]);  //use username as index to retrieve password
    //then compare
}


//get username & password from form submission
$username=$_POST["user"];   //get username from form
$password=$_POST["password"]; 

//check for correct credential here
if (valid_login($username,$password))  //validate login
  {
  //store username into session
  $_SESSION["user"]=$username;
  //then forward to another URL
  header("Location: home.php");  //forward to home page
  exit();   //stop PHP script here
  }

/*
below happens for unsuccessful login
*/

session_destroy();    //destroy the session
header("Location: login.html");  //send user back to login page

?>


<!-- 

session_start();	  //create or retrieve session

//check for existence of userID in session
if (!IsSet($_SESSION["user"]))
	{
	//if it is not there, forward to login page
	header("Location: /app/cmm004_bus_app/login.html");
	exit();
	} -->


<!-- //the remaining page can only be seen by
//a logged-in user -->
