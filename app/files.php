<?php
include 'text.php';
include 'config.php'; 
include 'tools.php';
include 'include.php';
include 'img.php';
include 'fetch.php';

$store_id = "1";
$sql = "SELECT * from stores, users where stores.user_id=users.user_id and stores.store_id='$store_id'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$store_id = $fetch['store_id'];
$user_id = $fetch['user_id'];
$store_name = $fetch['store_name'];
$full_name = $fetch['full_name'];
$store_phone = $fetch['store_phone'];
$store_add_date = $fetch['store_add_date'];
$store_status = $fetch['store_status'];
$store_profile_img = $fetch['store_profile_img'];
$store_desc = $fetch['store_description'];
$store_address = $fetch['store_address'];
$store_mail_id = $fetch['store_mail_id'];
$store_arealocality = $fetch['store_arealocality'];
$store_city = $fetch['store_city'];
$store_state = $fetch['store_state'];
$store_pincode = $fetch['store_pincode'];

if(isset($_GET['start'])){
  $start = $_GET['start'];
  $end = $_GET['end'];
} else {
  $start = 0;
  $end = 10;
}

$DeviceType = detectDevice();
if($DeviceType == "Computer" or $DeviceType == "Tablet"){
    header("location: ../index.php");
}

if(isset($_SESSION['customer_id'])){
$customer_id = $_SESSION['customer_id'];
$sql = "SELECT * from customers where customers.customer_id='$customer_id' ";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$customer_name = $fetch['customer_name'];
$customer_mail_id = $fetch['customer_mail_id'];
$customer_phone_number = $fetch['customer_phone_number'];
$customer_password = $fetch['customer_password'];
$cust_dp = $fetch['customer_image'];
$arealocality = $fetch['arealocality'];
$custaddress = $fetch['custaddress'];
$custcity = $fetch['custcity'];
$custstate = $fetch['custstate'];
$custpincode = $fetch['custpincode'];
$contactperson = $fetch['contactperson'];
$alternatenumber = $fetch['alternatenumber'];
$customer_status = $fetch['customer_status'];
}

?>
