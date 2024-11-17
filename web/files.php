<?php
session_start();
require 'text.php';
require 'msg.php';
//DEVICE DETAILS
  
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
  $ip_address = get_ip();
$IP_ADDRESS = $ip_address;
$DEVICE_TYPE = detectDevice();
$SYSTEM_INFO = $_SERVER['HTTP_USER_AGENT'];
date_default_timezone_set("Asia/Calcutta");
$CURRENT_DATE_TIME = date("d D M Y, h:m a");
$HOST_NAME = php_uname('n');
$GSI_GET_SYSTEM_DATA = "
 <b>Date_TIME:</b> $CURRENT_DATE_TIME<br>
 <b>IP_ADDRESS:</b> $IP_ADDRESS<br> 
 <b>DEVICE_TYPE:</b> $DEVICE_TYPE<br> 
 <b>HOST_NAME:</b> $HOST_NAME<br>
 <b>ipv6_n:</b> $ipv6_n<br>
 <b>ipv6_p:</b> $ipv6_p<br>
 <b>OS:</b> $os<br>
 <b>OS_RELESE:</b> $OS_release<BR>
 <b>OS_VERSION:</b> $OS_Version<br>
 <b>SYSTEM_INFO:</b> $System_Info<br>
 <b>SYSTEM_DETAIL:</b> $System_more_Info";


?>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
