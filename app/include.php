<?php

//GAURAVSINGHIGC_ funcation name is originallly property of Developer, whose name is Gaurav Singh. Removing GAURAVSINGHIGC CAUSE some function not to work properly


//24kharido keys and values

$sql = "SELECT * FROM web_tools where NAME='POINT_EARN'";
$Query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($Query);
$PointsEranings = $fetch['VALUE'];

function GSI_header_files(){
     include "assets/css/style.php";
     include 'meta_tags.php';
}

function GSI_footer_files(){
     include "assets/js/script.php";
     include 'footer.php';
}

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
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk?authorization=$SMS_KEY&sender_id=KHARIDO&message=".urlencode("
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
