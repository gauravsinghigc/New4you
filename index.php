<?php
require 'files.php';
$IpAddress = get_ip();
$DeviceType = strtoupper(detectDevice());
$VisitingUrl = basename($_SERVER['PHP_SELF']);

if (isset($_SESSION['customer_id'])) {
  $customer_id = $_SESSION['customer_id'];
  $sql = "SELECT * FROM customers where customer_id='$customer_id'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  $customer_name = $fetch['customer_name'];
  $customer_mail_id = $fetch['customer_mail_id'];
  $customer_phone_number = $fetch['customer_phone_number'];
  $UserStatus = "Login";
  $CustomerId = $customer_id;
} else {
  $customer_id = "Unknown";
  $customer_name = "Unknown";
  $customer_mail_id = "Unknown";
  $customer_phone_number = "Unknown";
  $UserStatus = "Unknown";
  $CustomerId = "Unknown";
}

$UserDetails = "<br><b>UserStatus :</b> $UserStatus
<br><b>CustomerId :</b> $customer_id
<br><b>CustomerName :</b> $customer_name
<br><b>CustomerMailId :</b> $customer_mail_id
<br><b>CustomerPhoneNumber :</b> $customer_phone_number";

$ipv6_n = php_uname('n');
$ipv6_p = php_uname('p');
$os = php_uname('s');
$OS_release = php_uname('r');
$OS_Version = php_uname('v');
$System_Info = php_uname('m');
$DeviceInformations = $_SERVER['HTTP_USER_AGENT'] . "<br><b>IpV6N :</b> $ipv6_n
<br><b>IpV6P :</b> $ipv6_p
<br><b>OS :</b> $os
<br><b>OsRelease :</b> $OS_release
<br><b>OsVersion :</b> $OS_Version
<br><b>SystemType :</b> $System_Info
$UserDetails";
$VistingDOT = date("d M Y h:m:s a");
$VisitingSource = "WEBSITE";

$CheckVisitors = "SELECT * FROM visitors where IpAddress='$IpAddress' and DeviceType='$DeviceType' and VisitingSource='$VisitingSource'";
$VisitorsQuery = mysqli_query($con, $CheckVisitors);
$CountVisitors = mysqli_num_rows($VisitorsQuery);
/**if ($CountVisitors == 0) {
  $InsertVisitors = "INSERT INTO visitors (IpAddress, DeviceType, VisitorType, VistingDOT, VisitingUrl, DeviceInformations, VisitingCounts, VisitingSource, UserStatus, CustomerId) VALUES ('$IpAddress', '$DeviceType', 'NEW', '$VistingDOT', '$VisitingUrl', '$DeviceInformations', '1', '$VisitingSource', '$UserStatus', '$CustomerId')";
  $InsertQuery = mysqli_query($con, $InsertVisitors);
} else {
  $FetchVisitors = mysqli_fetch_assoc($VisitorsQuery);
  $VisitorId = $FetchVisitors['VisitorId'];
  $VisitingCounts = $FetchVisitors['VisitingCounts'];
  $VisitingCounts++;
  $InsertVisitors = "INSERT INTO visitors (IpAddress, DeviceType, VisitorType, VistingDOT, VisitingUrl, DeviceInformations, VisitingCounts, VisitingSource, UserStatus, CustomerId) VALUES ('$IpAddress', '$DeviceType', 'RE-VISIT', '$VistingDOT', '$VisitingUrl', '$DeviceInformations', '1', '$VisitingSource', '$UserStatus', '$CustomerId')";
  $InsertQuery = mysqli_query($con, $InsertVisitors);
}**/ ?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $store_name; ?> : Home</title>
  <?php include 'header_files.php'; ?>
</head>

<body>

  <?php
  include "header.php";
  include "slider.php";
  include "collection.php";
  include "deal_end.php";
  include "best_selling.php";
  include "recommended.php";
  ?>


  <?php include 'footer.php'; ?>
</body>

</html>