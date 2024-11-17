<?php 
session_start();
if(!isset($_SESSION['customer_id'])){
	
} else {

$customer_id = $_SESSION['customer_id'];
  $sql = "SELECT * from customers where customer_id='$customer_id' ";
  $query = mysqli_query($con, $sql);
  $count_address = mysqli_num_rows($query);
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
  $store_id = $fetch['store_id'];
  $sql = "SELECT * FROM stores where store_id='$store_id'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  $user_id = $fetch['user_id'];

  if(isset($_SESSION['customer_id'])){
$ip_address = get_ip();
      $device_type = detectDevice();
      date_default_timezone_set("Asia/Calcutta");
      $date_time_c = date("dMY");
      $ipv6_n = php_uname('n');
      $ipv6_p = php_uname('p');
      $os = php_uname('s');
      $OS_release = php_uname('r');
      $OS_Version = php_uname('v');
      $System_Info = php_uname('m');
      $System_more_Info = $_SERVER['HTTP_USER_AGENT'];
      $device_info = "$ip_address$device_type";

      $sql = "UPDATE customer_cart SET customer_id='$customer_id' where ip_address='$device_info' and store_id='$store_id'";
      $query = mysqli_query($con, $sql);
      if($query == true){

      } else {

      }
}
}
?>