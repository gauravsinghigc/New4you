<?php

//require files
require '../require/config.php';
require '../require/common.php';
require '../require/modules.php';
require '../require/route.php';

//access url 
$access_url = POST("access_url");

//start activity here
//login request
if (isset($_POST['LoginRequest'])) {
 $access_url = $_POST['access_url'];
 $username = $_POST['username'];
 $password = $_POST['password'];

 $CheckUsername = TOTAL("SELECT * FROM users where username='$username' and password='$password'");

 if ($CheckUsername == true) {
  $SQL_users = SELECT("SELECT * FROM users where username='$username' and user_status='Active'");
  $FetchUsers = mysqli_fetch_array($SQL_users);
  $fullname = $FetchUsers['fullname'];
  $emailid = $FetchUsers['emailid'];
  $phonenumber = $FetchUsers['phonenumber'];
  $user_id = $FetchUsers['user_id'];
  $_SESSION['LOGIN_USER'] = $user_id;
 } else {
 }
 //redirect to access pages
 RESPONSE($CheckUsername, "Welcome $fullname, Login Successful!", "Invalid $username and $password!", "$access_url");
}
