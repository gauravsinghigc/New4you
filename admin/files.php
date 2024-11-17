<?php
require 'config.php';
require 'text.php';
require 'tools.php';
require 'alert.php';

//Insert Data
function SAVE($tablename, array $INSERT)
{
 global $con;
 $DBConnection = $con;
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
 $Query = mysqli_query($DBConnection, $InsertNewData);
 return $Query;
}

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
