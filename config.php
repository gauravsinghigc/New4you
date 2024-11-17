<?php

//App Configurations
$APP_NAME = "New4you";
$DOMAIN = "http://192.168.1.21/projects/navion";
$APP_DOMAIN = $DOMAIN . "/app";
$ADMIN_DOMAIN = $DOMAIN . "/admin";
$APP_PHONE = "8447572565";
$store_mail_id = "navion@gmail.com";
$SENDER_MAIL = "notification@navion.in";
$RECEIVER_MAIL = "navion@gmail.com";
$SMS_KEY = "KDNCSKJDBCJHBSAHYUASDG87WQEYGBDWEDWUBCG872EGBOHDBEWOCBXUODCB";
$STORE_ADDRESS = "Y6/37 2nd Floor, Sector 76, Near Police Station Sector 75, Faridabad Haryana -121004";
$DOWNLOAD_LINK = "https://play.google.com/store/apps/details?id=com.gauravsinghigc.u24kharido&hl=en_IN&gl=US";

//DATABASE CONFIGURATION
$Host = "localhost";
$User = "root";
$Pass = "";
$DataBase = "navion";
$con = mysqli_connect($Host, $User, $Pass, $DataBase);
$Connection = $con;


//SMS GATEWAYS FOR sending sms or msg
function SMS($MSG, $PHONE)
{
  global $SMS_KEY;

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://www.fast2sms.com/dev/bulk?authorization=$SMS_KEY&sender_id=KHARIDO&message=" . urlencode("
    ---
    $MSG") . "&language=english&route=p&numbers=" . urlencode("$PHONE"),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache"
    ),
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
}

//IP_ADDRESS
function IP_ADDRESS()
{
  $ipaddress = '';
  if (getenv('HTTP_CLIENT_IP'))
    $ipaddress = getenv('HTTP_CLIENT_IP');
  else if (getenv('HTTP_X_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
  else if (getenv('HTTP_X_FORWARDED'))
    $ipaddress = getenv('HTTP_X_FORWARDED');
  else if (getenv('HTTP_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_FORWARDED_FOR');
  else if (getenv('HTTP_FORWARDED'))
    $ipaddress = getenv('HTTP_FORWARDED');
  else if (getenv('REMOTE_ADDR'))
    $ipaddress = getenv('REMOTE_ADDR');
  else
    $ipaddress = 'UNKNOWN';
  return $ipaddress;
}


//Get running url
function get_url()
{
  if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
  else
    $url = "http://";
  // Append the host(domain name, ip) to the URL.
  $url .= $_SERVER['HTTP_HOST'];

  // Append the requested resource location to the URL
  $url .= $_SERVER['REQUEST_URI'];

  return $url;
}

// Device Type
function DeviceType()
{
  $deviceName = "";
  $userAgent = $_SERVER["HTTP_USER_AGENT"];
  $devicesTypes = array(
    "Computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
    "Tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
    "Mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
    "Bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
  );
  foreach ($devicesTypes as $deviceType => $devices) {
    foreach ($devices as $device) {
      if (preg_match("/" . $device . "/i", $userAgent)) {
        $deviceName = $deviceType;
      }
    }
  }
  return ucfirst($deviceName);
}

//Send Mails
function SendMail($Valid, $Subject, $Title, $CustomerMailId, $MAIL_MSG)
{
  global $con;
  global $SENDING_OTP;
  global $store_mail_id;
  global $SENDER_MAIL;
  global $RECEIVER_MAIL;

  //Mail Variables
  $EnableMail = $Valid;
  $Subject = $Subject;
  $Title = $Title;
  $SendByMail = $SENDER_MAIL;
  $ReplyToMail = $RECEIVER_MAIL;
  $CustomerMailId = $CustomerMailId;
  $MailingContent = $MAIL_MSG;


  //Device Details
  $ip_address = IP_ADDRESS();
  $device_type = DeviceType();
  date_default_timezone_set("Asia/Calcutta");
  $date_time_c = date("D d M, Y h:m:s a");
  $ipv6_n = php_uname('n');
  $ipv6_p = php_uname('p');
  $os = php_uname('s');
  $OS_release = php_uname('r');
  $OS_Version = php_uname('v');
  $System_Info = php_uname('m');
  $System_more_Info = $_SERVER['HTTP_USER_AGENT'];
  $device_Details = "<b>Date Time:</b> $date_time_c<br><b>Ip-Address :</b> $ip_address<br><b>Device Type :</b> $device_type<br><b>Host Name :</b> $ipv6_n<br><b> System Information :</b> $System_more_Info";

  if ($EnableMail == "true") {

    // Subject
    $subject = "$Subject";

    // Set Message
    $message = "
<style>
@import url('https://fonts.googleapis.com/css2?family=Commissioner&display=swap');
  html,
body, table, tr, th, td, h1, h2, h3, h4, h5, h6, p, span, div, section, b {
    font-family: 'Commissioner', sans-serif !important;
    font-size: 11px !important;
    text-align: justify !important;
    background-color: lightgrey !important;
}
</style>
<div style='text-shadow: 0px 0px 0.2px grey;background-color: lightgrey !important; max-width:900px !important;margin: auto;'>
<div style='padding: 2% !important;'>

<h3><b>$Title</b></h3>
$MailingContent
<br><br>
<p style='font-size: 9px !important;'>
<b style='font-size: 10px !important;'>Device Details:</b><br>$device_Details
</p>

<hr>
<p style='font-size: 9px !important;'>
<b>Note:</b> This is an auto generated email sent by system. If you find something incorrect in this mail or have any query then mail us at $ReplyToMail</p>
</div>
</div>
";

    // Set From: header
    $from =  "notification" . "<" . $SendByMail . ">";

    // Email Headers
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $ReplyToMail . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    ini_set("sendmail_from", $store_mail_id); // for windows server
    mail($CustomerMailId, $subject, $message, $headers);
  }
}

//Save Data
function Save_DATA($tablename, $checkrows, array $tablerows, $auth)
{
  global $con;
  $Datatables = "";
  $TableValues = "";
  $data = $tablerows[0];
  $tablerows = $tablerows;
  $arraycount = count($tablerows);
  $mainarray = $arraycount - 1;
  $FocusedData = $_REQUEST["$data"];
  $cr_url = $_REQUEST['cr_url'];

  foreach ($tablerows as $key => $value) {
    if ($key == $mainarray) {
      $TableValues .= "'" . $_REQUEST["$value"] . "'";
    } else {
      $TableValues .= "'" . $_REQUEST["$value"] . "', ";
    }
  }

  foreach ($tablerows as $key => $value) {
    if ($key == $mainarray) {
      $Datatables .= "$value";
    } else {
      $Datatables .= "$value, ";
    }
  }

  if ($checkrows != 0) {
    $CheckData = "SELECT * FROM $tablename where $checkrows";
    $CheckDataQuery = mysqli_query($con, $CheckData);
    $CountData = mysqli_num_rows($CheckDataQuery);
  } else {
    $CountData = 0;
  }

  if ($CountData == 0) {
    $InsertNewData = "INSERT INTO $tablename ($Datatables) VALUES ($TableValues)";
    if ($auth == "0") {
    } elseif ($auth == "1") {
      die($InsertNewData);
    }
    $InsertNewDataQuery = mysqli_query($con, $InsertNewData);
    if ($InsertNewDataQuery == true) {
      header("location: $cr_url&msg=$FocusedData is Saved Successfully!");
    } else {
      header("location: $cr_url&err=Unable to save $FocusedData!");
    }
  } else {
    header("location: $cr_url&msg=$FocusedData is Already Exits!");
  }
}


//More Requirements
$ip_address = IP_ADDRESS();
$device_type = DeviceType();
date_default_timezone_set("Asia/Calcutta");
$date_time_c = date("D d M, Y h:m:s a");
$ipv6_n = php_uname('n');
$ipv6_p = php_uname('p');
$os = php_uname('s');
$OS_release = php_uname('r');
$OS_Version = php_uname('v');
$System_Info = php_uname('m');
$System_more_Info = $_SERVER['HTTP_USER_AGENT'];
$device_Details = "<p>
<b>Date Time:</b> $date_time_c<br>
<b>Ip-Address :</b> $ip_address<br>
<b>Device Type :</b> $device_type<br>
<b>Ipv6_N :</b> $ipv6_n<br>
<b>Tpv6_P :</b> $ipv6_p<br>
<b>OS :</b> $os<br>
<b>OS_RELEASE :</b> $OS_release<br>
<b>OS_VERSION :</b> $$OS_Version<br>
<b>System :</b> $System_Info<br>
<br>Host Name :</br> $ipv6_n<br>
<b>System Information :</b> $System_more_Info</p>";


function APP_CONFIG($DATA)
{
  global $con;
  $sql_web_tools = "SELECT * FROM web_tools where NAME='$DATA'";
  $QUERY_web_tools = mysqli_query($con, $sql_web_tools);
  $FETCH_web_tools = mysqli_fetch_assoc($QUERY_web_tools);
  $value = $FETCH_web_tools['VALUE'];
  return $value;
}

function cart_count()
{
  global $con;
  global $store_id;
  if (isset($_SESSION['ADD_TO_CART_SESSION'])) {
    $ip_address = $_SESSION['ADD_TO_CART_SESSION'];
  } else {
    $ip_address = "";
  }

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
    mysqli_set_charset($con, 'utf8');
    $customer_id = $_SESSION['customer_id'];
    $sql = "SELECT * FROM customer_cart, user_products, pro_brands, product_categories where customer_id='$customer_id' and customer_cart.user_product_id=user_products.user_product_id and user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id";
  } else {
    mysqli_set_charset($con, 'utf8');
    $sql = "SELECT * FROM customer_cart, user_products, pro_brands, product_categories where customer_cart.ip_address='$ip_address' and customer_cart.user_product_id=user_products.user_product_id and user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id";
  }

  $query = mysqli_query($con, $sql);
  $count = mysqli_num_rows($query);
  if ($count == 0) {
    $count = 0;
  } else {
    $count = $count;
  }
  return $count;
}

function NOTIFICATION_ALERT($TITLE, $DESC, $STATUS)
{
  global $con;
  global $store_id;
  global $customer_id;
  date_default_timezone_set("Asia/Calcutta");
  $DESC_NOTE = $DESC;
  $NotificationSql = "INSERT INTO notifications (customer_id, store_id, notification_title, notification_date, notification_desc, notification_status) VALUES ('$customer_id', '$store_id', '$TITLE', CURRENT_TIMESTAMP, '$DESC_NOTE', '$STATUS')";
  mysqli_query($con, $NotificationSql);
}

//Insert Data
function SAVE($tablename, array $INSERT)
{
  global $con;
  $tablename = $tablename;
  $Datatables = "";
  $TableValues = "";
  $tablerows = $INSERT;
  $arraycount = count($tablerows);
  $mainarray = $arraycount - 1;
  $DBConnection = $con;

  foreach ($tablerows as $key => $value) {
    global $$value;
  }


  foreach ($tablerows as $key => $value) {
    if ($key == $mainarray) {
      $TableValues .= "'" . htmlentities($$value) . "'";
    } else {
      $TableValues .= "'" . htmlentities($$value) . "', ";
    }
  }

  foreach ($tablerows as $key => $value) {
    if ($key == $mainarray) {
      $Datatables .= "$value";
    } else {
      $Datatables .= "$value, ";
    }
  }
  $InsertNewData = "INSERT INTO $tablename ($Datatables) VALUES ($TableValues)";
  //die($InsertNewData);
  $Query = mysqli_query($DBConnection, $InsertNewData);
  return $Query;
}
