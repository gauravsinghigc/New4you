<?php
$sql_web_tools = "SELECT * FROM web_tools where NAME='DOMAIN'";
$QUERY_web_tools = mysqli_query($con, $sql_web_tools);
$FETCH_web_tools = mysqli_fetch_assoc($QUERY_web_tools);
$MainUrl = $FETCH_web_tools['VALUE'];
$img_url = $MainUrl . "/admin";

$sql = "SELECT * FROM web_tools where NAME='SMS_KEY'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$sms_api = $fetch['VALUE'];

$sql = "SELECT * FROM web_tools where NAME='APP_LINK'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$PlayStoreLink = $fetch['VALUE'];

$url = $img_url;
$store_id = "1";
$sql = "SELECT * from stores, users where stores.user_id=users.user_id and stores.store_id='$store_id'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$store_id = $fetch['store_id'];
$user_id = $fetch['user_id'];

$sql_web_tools = "SELECT * FROM web_tools where NAME='APP_NAME'";
$QUERY_web_tools = mysqli_query($con, $sql_web_tools);
$FETCH_web_tools = mysqli_fetch_assoc($QUERY_web_tools);
$APP_NAME = $FETCH_web_tools['VALUE'];
$AppNameWithExt = $APP_NAME . ".in";
$store_name = $APP_NAME;

$sql_web_tools = "SELECT * FROM web_tools where NAME='APP_TAGLINE'";
$QUERY_web_tools = mysqli_query($con, $sql_web_tools);
$FETCH_web_tools = mysqli_fetch_assoc($QUERY_web_tools);
$AppTag = $FETCH_web_tools['VALUE'];

$sql_web_tools = "SELECT * FROM web_tools where NAME='APP_LINK'";
$QUERY_web_tools = mysqli_query($con, $sql_web_tools);
$FETCH_web_tools = mysqli_fetch_assoc($QUERY_web_tools);
$APP_LINK = $FETCH_web_tools['VALUE'];

$full_name = $fetch['full_name'];
$store_phone = $fetch['store_phone'];
$store_add_date = $fetch['store_add_date'];
$store_status = $fetch['store_status'];
$store_profile_img = $fetch['store_profile_img'];
$logo = "$url/$store_profile_img";
$store_desc = $fetch['store_description'];
$store_address = $fetch['store_address'];
$store_mail_id = $fetch['store_mail_id'];
$store_arealocality = $fetch['store_arealocality'];
$store_city = $fetch['store_city'];
$store_state = $fetch['store_state'];
$store_pincode = $fetch['store_pincode'];

$STORE_ADDRESS = "$store_address $store_arealocality $store_city $store_state $store_pincode";

$sql = "SELECT * from store_domains where store_id='$store_id'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$domain = $fetch['domain'];

if (isset($_SESSION['customer_id'])) {
  $customer_id = $_SESSION['customer_id'];
  $sql = "SELECT * FROM customers where customer_id='$customer_id'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  $customer_name = $fetch['customer_name'];
  $customer_mail_id = $fetch['customer_mail_id'];
  $customer_phone_number = $fetch['customer_phone_number'];
  $customer_password = $fetch['customer_password'];
  $cust_dp = $fetch['customer_image'];
  if (empty($cust_dp)) {
    $customer_image = "user.jpg";
  } else {
    $customer_image = $cust_dp;
  }
} else {
}

if (isset($_SESSION['customer_id'])) {
  $sql = "SELECT * from customers where customer_id ='$customer_id'";
  $query = mysqli_query($con, $sql);
  $count_address = mysqli_num_rows($query);
  $fetch = mysqli_fetch_assoc($query);
  $street_address = $fetch['custaddress'];
  $area_locality = $fetch['arealocality'];
  $customer_city = $fetch['custcity'];
  $customer_state = $fetch['custstate'];
  $address_pincode = $fetch['custpincode'];
  $contact_person = $fetch['contactperson'];
  $alternate_phone = $fetch['alternatenumber'];
  $customer_status = $fetch['customer_status'];
  $customer_status_check = $fetch['customer_status'];
  if ($customer_status == "verified") {
    $customer_status = "<i class='fa fa-check-circle text-success'></i> Verified";
  } else {
    $customer_status = "<a href='verify.php' class='btn btn-danger btn-sm'><i class='fa fa-warning mt-0'></i> Verify Account</a>";
  }
} else {
}


function get_ip()
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

function detectDevice()
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

function current_date_time()
{
  date_default_timezone_set("Asia/Calcutta");
  $date_time = date("d/m/Y h:i:s A");
  echo $date_time;
}

$sql = "SELECT * from store_coupons where store_id='$store_id' and coupon_status='active'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$percentage = $fetch['percentage'];
$coupon_code = $fetch['coupon_code'];
$coupon_status = $fetch['coupon_status'];
