<?php
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
$device_info = "$ip_address";
if (isset($_SESSION['customer_id'])) {
  $customer_id = $_SESSION['customer_id'];
  $sql = "SELECT * from customer_cart where customer_id='$customer_id'";
  $query = mysqli_query($con, $sql);
  $count = mysqli_num_rows($query);

  $select = "SELECT sum(product_total_amount) FROM customer_cart where customer_id='$customer_id'";
  $action = mysqli_query($con, $select);
  while ($record = mysqli_fetch_array($action)) {
    $total_amount = $record['sum(product_total_amount)'];
  }
} else {
  $sql = "SELECT * from customer_cart where device_info='$device_info' and ip_address='$ip_address'";
  $query = mysqli_query($con, $sql);
  $count = mysqli_num_rows($query);

  $select = "SELECT sum(product_total_amount) FROM customer_cart where ip_address='$ip_address' and device_info='$device_info'";
  $action = mysqli_query($con, $select);
  while ($record = mysqli_fetch_array($action)) {
    $total_amount = $record['sum(product_total_amount)'];
  }
}

$sql = "SELECT * FROM delivery_charges where delivery_charge_status='active'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$concharge = $fetch['concharge'];
$delivery_charge = $fetch['delivery_charge'];
$est_delivery_amount = $fetch['est_delivery_amount'];

$delivery_charges = $delivery_charge + $concharge;
