<?php
session_start();
require 'config.php';
require 'text.php';
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

define("CONTROL_SMS", true);

function SEND_SMS($authkey, $SENDER_ID, $ROUTE, $PHONE_NUMBER, $MESSAGE, $TEMPLATE_ID, $method, array $params = [])
{

  //store the sample api key in a variable
  //authkey : 343650554e4545543538353936361630581726 (sample)
  //sender id : APP_NAME
  //message : Your OTP is : 12345
  //template id: 1207163092286282857
  //route : 1
  //phone number : 9999999999

  //sms api url
  $SMS_API_URL = "http://sms.tddigitalsolution.com/http-tokenkeyapi.php?authentic-key=$authkey&senderid=$SENDER_ID&route=$ROUTE&number=$PHONE_NUMBER&message=$MESSAGE&templateid=$TEMPLATE_ID";
  $url = $SMS_API_URL;

  //get the response from the server
  //sms sending function
  if (CONTROL_SMS == true) {

    //send request for url 
    $EncrypteRequest = SECURE($SMS_API_URL);
    //sender end
    // url check
    $parts = parse_url($url);
    if ($parts === false)
      throw new Exception('Unable to parse URL');
    $host = $parts['host'] ?? null;
    $port = $parts['port'] ?? 80;
    $path = $parts['path'] ?? '/';
    $query = $parts['query'] ?? '';
    parse_str($query, $queryParts);

    if ($host === null)
      throw new Exception('Unknown host');
    $connection = fsockopen($host, $port, $errno, $errstr, 30);
    if ($connection === false)
      throw new Exception('Unable to connect to ' . $host);
    $method = strtoupper($method);

    if (!in_array($method, ['POST', 'PUT', 'PATCH'], true)) {
      $queryParts = $params + $queryParts;
      $params = [];
    }

    // Build request
    $request  = $method . ' ' . $path;
    if ($queryParts) {
      $request .= '?' . http_build_query($queryParts);
    }
    $request .= ' HTTP/1.1' . "\r\n";
    $request .= 'Host: ' . $host . "\r\n";

    $body = http_build_query($params);
    if ($body) {
      $request .= 'Content-Type: application/x-www-form-urlencoded' . "\r\n";
      $request .= 'Content-Length: ' . strlen($body) . "\r\n";
    }
    $request .= 'Connection: Close' . "\r\n\r\n";
    $request .= $body;

    // Send request to server
    fwrite($connection, $request);
    fclose($connection);


    //if sender is not working or not enabled
    //sms are not enabled

    return true;

    //if sender is working and enabled
  } else {

    return false;
  }
}

$pincodearray = array("110044");
?>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">