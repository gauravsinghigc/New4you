<?php 

function NOTIFICATION_ALERT($TITLE, $DESC, $STATUS){
    global $con;
    global $store_id;
    global $customer_id;
    date_default_timezone_set("Asia/Calcutta");
    $DESC_NOTE = $DESC;
    $NotificationSql = "INSERT INTO notifications (customer_id, store_id, notification_title, notification_date, notification_desc, notification_status) VALUES ('$customer_id', '$store_id', '$TITLE', CURRENT_TIMESTAMP, '$DESC_NOTE', '$STATUS')";
    mysqli_query($con, $NotificationSql);
}


function SMS($MSG, $PHONE){
    global $con;
    $sql = "SELECT * FROM web_tools where NAME='SMS_KEY'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    $SMS_KEY = $fetch['VALUE'];
    $curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk?authorization=$SMS_KEY&sender_id=SHAKIN&message=".urlencode("
---
$MSG")."&language=english&route=p&numbers=".urlencode("$PHONE"),
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

function SendMail($Valid, $Subject, $Title, $CustomerMailId, $MAIL_MSG){
global $con;
global $SENDING_OTP;
global $store_mail_id;
//Sender Mail
$sql = "SELECT * FROM web_tools where NAME='SENDER_MAIL'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$SENDER_MAIL = $fetch['VALUE'];

//Receiver mail
$sql = "SELECT * FROM web_tools where NAME='RECEIVER_MAIL'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$RECEIVER_MAIL = $fetch['VALUE'];

//Mail Variables 
$EnableMail = $Valid;
$Subject = $Subject;
$Title = $Title;
$SendByMail = $SENDER_MAIL;
$ReplyToMail = $RECEIVER_MAIL;
$CustomerMailId = $CustomerMailId;
$MailingContent = $MAIL_MSG;

if($EnableMail == "true"){

// Subject
$subject = "$Subject";

// Set Message
$message = "
<style>
@import url('https://fonts.googleapis.com/css2?family=Commissioner&display=swap');
  html,
body, table, tr, th, td, h1, h2, h3, h4, h5, h6, p, span, div, section, b {
    font-family: 'Commissioner', sans-serif !important;
    font-size: 12px !important;
    text-align: justify !important;
    background-color: #d6fcd673 !important;
}
</style>
<div style='text-shadow: 0px 0px 0.5px grey;background-color: #d6fcd673 !important; max-width:600px !important;margin: auto;'>
<img src='https://24kharido.in/img/MailTopBanner.png' style='width:100%;'>
<div style='padding: 2% !important;'>

<h3><b>$Title</b></h3>
$MailingContent
<br>
<hr>
<p style='text-align:left !important;font-size:9.5px !important;'>
<img src='http://24kharido.in/app/img/24kharidorectangle.png' style='width:150px;'><br>
<b>Address : </b> Shop no 1, C-1511, Pipal Vali Gali, Sector 4, <br>Ballabgarh, Faridabad, Haryana 121004.<br>
<b>Call or Whatsapp :</b> +91-9871620117<br>
<b>Email-id :</b> 24kharido@gmail.com<br>
<b>Website :</b> 24kharido.in
</p>
<p style='font-size: 9px !important;'>
<b>Note:</b> This is an auto generated email sent from 24kharido.in. If you find something incorrect in this mail or have any query then mail us at $ReplyToMail</p>

</div>
<a href='https://play.google.com/store/apps/details?id=com.gauravsinghigc.u24kharido'>
<img src='https://24kharido.in/img/DownloadMailButton.png' style='width: 100%;'>
</a>
<a href='https://24kharido.in/'>
<img src='https://24kharido.in/img/MailBottomBanner.png' style='width:100%;'>
</a>
</div>
";

// Set From: header
 $from =  "24kharido Team" . "<" . $SendByMail . ">";
 
// Email Headers
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $ReplyToMail . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

ini_set("sendmail_from", $store_mail_id); // for windows server
 mail($CustomerMailId, $subject, $message, $headers);
 
  }
}

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
  
  if($checkrows != 0){
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
      header("location: $cr_url?msg=$FocusedData is Saved Successfully!");
    } else {
      header("location: $cr_url?err=Unable to save $FocusedData!");
    }
  } else {
    header("location: $cr_url?msg=$FocusedData is Already Exits!");
  }
}

?>