<?php

//secure
function SECURE($string, $action = 'e')
{
 // you may change these values to your own
 $secret_key = 'my_simple_secret_key';
 $secret_iv = 'my_simple_secret_iv';

 $output = false;
 $encrypt_method = "AES-256-CBC";
 $key = hash('sha256', $secret_key);
 $iv = substr(hash('sha256', $secret_iv), 0, 16);

 if ($action == 'e') {
  $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
 } else if ($action == 'd') {
  $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
 }

 return $output;
}

//SMS GATEWAYS FOR sending sms or msg
function SMS($MSG, $PHONE)
{
 global $SMS_KEY;

 $curl = curl_init();
 curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk?authorization=$SMS_KEY&sender_id=&message=" . urlencode("
-
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

//store running url in the session
$_SESSION['url'] = get_url();

//Include Current Running Url
function R_URL($url)
{
 echo "<input type='text' name='cr_url' value='$url' hidden='' />";
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
function SendMail($Valid, $Subject, $Title, $Sendto, $MAIL_MSG)
{
 global $store_mail_id;
 global $SENDER_MAIL;
 global $RECEIVER_MAIL;
 global $APP_PHONE;
 global $APP_MAIL_ID;
 global $DOMAIN;
 global $STORE_ADDRESS;
 global $OWNER_NAME;
 global $APP_NAME;
 global $APP_LOGO;

 //Mail Variables
 $EnableMail = $Valid;
 $Subject = $Subject;
 $Title = $Title;
 $SendByMail = $SENDER_MAIL;
 $ReplyToMail = $RECEIVER_MAIL;
 $Sendto = $Sendto;
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
  $message = '
    <body>
  <div style="padding: 1rem !important; background-color: rgb(245, 244, 244) !important; font-family: Verdana, Geneva, Tahoma, sans-serif !important; border-radius:20px !important;box-shadow:0px 0px 7px grey !important; font-weight:300 !important; color:#333 !important;">
    <h2 style="margin-bottom: 1px !important;
    background-image: repeating-linear-gradient(
45deg
, #0000001c, transparent 1px);
    padding: 0.5rem;
    border-radius: 42px;
    padding-left: 1rem;
    font-size: 16px!important;
    color: #3a3939!important;
    font-weight: 600;">
      <img
        src="https://www.pinclipart.com/picdir/big/185-1850576_png-file-white-bell-notification-icon-transparent-clipart.png"
        style="width: 1rem !important;
    margin-top: 1px !important;
    padding-top: 0.5%;">
    </h2>

    <div style="padding:1rem !important;">
      <img src="' . $APP_LOGO . '" style="width:9rem !important;">
      <h2 style="color:black !important; font-weight:400 !important;">' . $Title . '</h2>

      <p style="text-decoration:none !important; color: grey !important;font-size:13px;font-weight:300 !important;">We received a password request for your account having mail id:' . $MAIL_MSG . '</p>

      <br><br><br>
     <p>
        <span>TEAM ' . $APP_NAME . '</span><br>
        <span style="color:grey !important; font-size:13px;font-weight:300 !important;">' . $STORE_ADDRESS . '</span><br>
        <span style="text-decoration:none !important; color: grey !important;font-size:13px;font-weight:300 !important;">' . $APP_MAIL_ID . '</span>
        <span style="text-decoration:none !important; color: grey !important;font-size:13px;font-weight:300 !important;">|' . $APP_PHONE . '</span><br>
        <span style="text-decoration:none !important; color: grey !important;font-size:13px;font-weight:300 !important;">|' . $DOMAIN . '</span>
      </p>

      <br>
    </div>
   <p style="font-size:11px !important; color:grey !important; font-weight:300 !important;">
      <b>Note: </b> This is an auto generated mail. do not reply this. if you find something incorrect then forward this at ' . $ReplyToMail . '
   </p>

</body>
';

  // Set From: header
  $from =  "notifications" . "<" . $SendByMail . ">";

  // Email Headers
  $headers = "From: " . $from . "\r\n";
  $headers .= "Reply-To: " . $ReplyToMail . "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  ini_set("sendmail_from", $store_mail_id); // for windows server
  mail($Sendto, $subject, $message, $headers);
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
$PAGE_LOCATION = get_url();
$SYSTEM_CONFIGURATIONS = "
    Date Time: $date_time_c
    Page_Location: $PAGE_LOCATION
    Ip-Address : $ip_address
    Device Type : $device_type
    Ipv6_P : $ipv6_p
    OS : $os
    OS_RELEASE : $OS_release
    OS_VERSION : $OS_Version
    System : $System_Info
    Host Name : $ipv6_n
    System Information : $System_more_Info";



//Generate Log file for the project
function APP_LOGS($TITLE, $ACTION)
{
 $TITLE = strtoupper($TITLE);
 global $IP_ADDRESS;
 global $SYSTEM_CONFIGURATIONS;
 global $PAGE_LOCATION;
 global $DOMAIN;
 global $DBConnection;
 global $LOGS_STATUS;
 //Check work environment
 global $WORK_ENV;

 if ($LOGS_STATUS == "ACTIVE") {
  $logTitle = SECURE("$TITLE", "e");
  $logdesc = SECURE("$ACTION", "e");

  $SaveLogs = "INSERT INTO applogs (logTitle, logdesc, created_at) VALUES ('$logTitle', '$logdesc', CURRENT_TIMESTAMP)";
  $logquery = mysqli_query($DBConnection, $SaveLogs);
 } else {
 }
}



//Update function
function UPDATE($SQL)
{
 global $DBConnection;
 $Update = "$SQL";
 APP_LOGS($TITLE = "UPDATE_QUERY", $ACTION = "$SQL");
 $Query = mysqli_query($DBConnection, $Update);
 return $Query;
}

//Check function
function CHECK($SQL)
{
 global $DBConnection;
 $Check = "$SQL";
 APP_LOGS($TITLE = "CHECKING_QUERY", $ACTION = "$SQL");
 $Query = mysqli_query($DBConnection, $Check);
 $Count = mysqli_num_rows($Query);
 return $Count;
}


//Insert Data
function SAVE($tablename, array $INSERT)
{
 global $DBConnection;
 $tablename = $tablename;
 $Datatables = "";
 $TableValues = "";
 $tablerows = $INSERT;
 $arraycount = count($tablerows);
 $mainarray = $arraycount - 1;

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
 APP_LOGS($TITLE = "INSERT_QUERY", $ACTION = "$InsertNewData");
 $Query = mysqli_query($DBConnection, $InsertNewData);
 return $Query;
}


//Select Data
function SELECT($SQL)
{
 global $DBConnection;
 $SELECT = "$SQL";
 //die($SELECT);
 APP_LOGS($TITLE = "INSERT_QUERY", $ACTION = "$SELECT");
 $QUERY = mysqli_query($DBConnection, $SELECT);
 return $QUERY;
}

//Count Data
function TOTAL($SQL)
{
 global $DBConnection;
 $SQL = "$SQL";
 $Query = mysqli_query($DBConnection, $SQL);
 $Count = mysqli_num_rows($Query);
 if ($Count == 0) {
  return "0";
 } else {
  return $Count;
 }
}

//configuration
function CONFIG($Data)
{
 global $DBConnection;
 $SELECT_configurations = "SELECT * FROM configurations where Data='$Data'";
 $QUERY_configurations = mysqli_query($DBConnection, $SELECT_configurations);
 $Configurations = mysqli_fetch_array($QUERY_configurations);
 $Value = $Configurations['Value'];
 return $Value;
}


//flash msg
function MSG($type, $msg)
{
 $_SESSION["$type"] = "$msg";
}


//token on submit requests
function S_TOKEN()
{
 global $SYSTEM_CONFIGURATIONS;
 $RandomData = $SYSTEM_CONFIGURATIONS;
 $Token = SECURE("$RandomData", "e");
 return $Token;
}

//token that pass on every request if it is missing or not available then is show errors it must be passed over submit request at submit button
$Token = S_TOKEN();
APP_LOGS($TITLE = "PAGE_VISITS", $ACTION = "$PAGE_LOCATION");

//function for msg and redirect same
function LOCATION($type, $msg, $url)
{
 MSG("$type", "$msg");
 header("location: $url");
}

//responser for all controllers
function RESPONSE($act, $msg, $msg2)
{
 global $access_url;
 if ($act == true) {
  LOCATION("success", "$msg", "$access_url");
 } else {
  LOCATION("danger", "$msg2", "$access_url");
 }
}


//file uploader and directory maker 
function UPLOAD_FILES($dir, $checkfile, $pre, $ref, $NewFile)
{
 if ($checkfile == "0") {
 } else {
  if (file_exists("$dir/$checkfile")) {
   unlink("$dir/$checkfile");
  }
 }

 if (!file_exists("$dir/")) {
  mkdir("$dir/", 0777, true);
 }
 $FileName = $_FILES["$NewFile"]['name'];
 $temp_name = $_FILES["$NewFile"]['tmp_name'];
 $Folder = "$dir/";
 $temp = explode(".", $_FILES["$NewFile"]["name"]);
 $newfilename = "$pre" . "_" . $ref . "_" . date("_d_M_Y_h_m_s") . '.' . end($temp);
 move_uploaded_file($_FILES["$NewFile"]['tmp_name'], $Folder . $newfilename);

 return $newfilename;
}


//amount total
function AMOUNT($SQL, $T)
{
 global $DBConnection;
 $TotalAmountPaid = SELECT("$SQL");
 while ($fetchtotalpayment = mysqli_fetch_array($TotalAmountPaid)) {
  $TotalAmount = $fetchtotalpayment["sum($T)"];
 }
 if ($TotalAmount == 0 or $TotalAmount == null) {
  $TotalAmount = 0;
 } else {
  $TotalAmount = $TotalAmount;
 }
 return $TotalAmount;
}


//Suggestion List
function SUGGEST($table, $column, $order,)
{
 $CHECK_project_tags = CHECK("SELECT * FROM $table");
 if ($CHECK_project_tags != 0) {
  echo "<datalist id='$column'>";
  $SQL_project_tags = SELECT("SELECT * FROM $table GROUP by $column ORDER BY $column $order");
  while ($FetchTags = mysqli_fetch_array($SQL_project_tags)) { ?>
   <option value='<?php echo $FetchTags["$column"]; ?>'></option>
 <?php }
  echo "</datalist>";
 }
}

//search form
function SEARCH_FORM(array $data)
{ ?>
 <form action="" method="GET" class="d-flex flex-row justify-content-end">
  <div class="form-group m-b-0 img-fluid text-right">
   <span class="w-100 p-2 mt-2 text-right text-grey">Filter By</span>
  </div>
  <div class="form-group m-b-0 img-fluid w-25 text-right">
   <select class="form-control w-100" name="search_type">
    <?php
    foreach ($data as $key => $value) { ?>
     <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
    <?php  } ?>
   </select>
  </div>
  <div class="form-group m-b-0 img-fluid text-right">
   <input type="text" name="search_value" placeholder="Enter Search Value" class="form-control w-100">
  </div>
  <div class="form-group m-b-0 img-fluid text-right">
   <button class="btn btn-sm btn-primary mt-0 mb-0 search-btn" name="search" value="true">Search</button>
  </div>
 </form>
<?php }

//search data clear
function CLEAR_SEARCH()
{ ?>
 <div class="row">
  <div class="col-md-12">
   <?php if (isset($_GET['search'])) { ?>
    <p class="fs-12 lh-1-1"><b>Search View :</b> <span class="text-grey">Search Data :</span> <?php echo $_GET['search_type']; ?> | <span class="text-grey">Search Value:</span> <?php echo $_GET['search_value']; ?>
     <a href="index.php" class="text-right float-end"><span class="text-danger"><i class="fa fa-times"></i>Clear Search</span></a>
    </p>
   <?php } ?>
  </div>
 </div>
<?php }


//fetch values 
function FETCH($SQL, $data)
{
 $Query = SELECT($SQL);
 $FetchDATA = mysqli_fetch_array($Query);
 $ReturnData = $FetchDATA["$data"];
 if ($ReturnData == null) {
  $results = "Null";
 } else {
  $results = $ReturnData;
 }

 return $results;
}


//POST
function POST($data)
{
 $results = $_POST["$data"];

 if ($results == null) {
  return false;
 } else {
  return $results;
 }
}
