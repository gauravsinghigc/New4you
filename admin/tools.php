<?php
function ip_address()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
  {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
  {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
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

  echo $url;
}

$DownloadLink = "https://bit.ly/2N1QTOi";


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


function sms_data($MSG, $PHONE)
{
  global $con;
  $sql = "SELECT * FROM web_tools where NAME='SMS_KEY'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  $SMS_KEY = $fetch['VALUE'];
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://www.fast2sms.com/dev/bulk?authorization=$SMS_KEY&sender_id=KHARIDO&message=" . urlencode("$MSG") . "&language=english&route=p&numbers=" . urlencode("$PHONE"),
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


function SortBy()
{
  echo '<select name="sortby" class="form-control" required="">
         <option value=" ">Default</option>';
  $CountNo = 1;
  while ($CountNo <= 10) {
    echo "<option value='$CountNo'>$CountNo</option>";
    $CountNo++;
  }
  echo "</select>";
}


function SendMail($Valid, $Subject, $Title, $CustomerMailId, $MAIL_MSG, $ResponseUrl)
{
  global $con;
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
  $Redirect = $ResponseUrl;

  if ($EnableMail == "true") {

    // Subject
    $subject = "24kharido : $Subject";

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
$MailingContent<br>
<hr>
<p style='font-size: 9px !important;'>
<b>Note:</b> This is an auto generated email sent from 24kharido.in. If you find something incorrect in this mail or have any query then mail us at $reply_mail</p>

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
    $from =  "notification" . "<" . $SendByMail . ">";

    // Email Headers
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $ReplyToMail . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    ini_set("sendmail_from", $store_mail_id); // for windows server
    $mail = mail($CustomerMailId, $subject, $message, $headers);

    if ($mail == true) {
      header("location: $Redirect");
    } else {
      header("location: $Redirect");
    }
  }
}

function SYS_CONFIG($Data)
{
  global $con;
  $CheckData = "SELECT * FROM web_tools where NAME='$Data'";
  $DataQuery = mysqli_query($con, $CheckData);
  $FetchData = mysqli_fetch_assoc($DataQuery);
  $ValueofData = $FetchData['VALUE'];
  return $ValueofData;
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

  $CheckData = "SELECT * FROM $tablename where $checkrows";
  $CheckDataQuery = mysqli_query($con, $CheckData);
  $CountData = mysqli_num_rows($CheckDataQuery);

  if ($CountData == 0) {
    $InsertNewData = "INSERT INTO $tablename ($Datatables) VALUES ($TableValues)";
    if ($auth == "0") {
    } elseif ($auth == "1") {
      die($InsertNewData);
    }
    $InsertNewDataQuery = mysqli_query($con, $InsertNewData);
    if ($InsertNewDataQuery == true) {
      header("location: $cr_url?t=success&m=Saved&a=$FocusedData is Saved Successfully!");
    } else {
      header("location: $cr_url?t=danger&m=FAILED&a=Unable to save $FocusedData!");
    }
  } else {
    header("location: $cr_url?t=warning&m=Duplicate&a=$FocusedData is Already Exits!");
  }
}

function GSI_DATA($string, $action = 'e')
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


function UPDATE_DATA($table, array $tablerows, $auth, $condition)
{
  global $con;
  $tablerowdata = "";
  $arraycount = count($tablerows);
  $mainarray = $arraycount - 1;
  $data = $tablerows[0];
  $FocusedData = $_REQUEST["$data"];
  $cr_url = $_REQUEST['cr_url'];

  foreach ($tablerows as $key => $value) {
    if ($key == $mainarray) {
      $tablerowdata .= "$value='" . $_REQUEST["$value"] . "'";
    } else {
      $tablerowdata .= "$value='" . $_REQUEST["$value"] . "', ";
    }
  }

  $UpdateData = "UPDATE $table SET $tablerowdata where $condition";
  if ($auth == "0") {
  } elseif ($auth == "1") {
    die($UpdateData);
  }
  $InsertNewDataQuery = mysqli_query($con, $UpdateData);
  if ($InsertNewDataQuery == true) {
    header("location: $cr_url?t=success&m=Saved&a=$FocusedData is updated Successfully!");
  } else {
    header("location: $cr_url?t=danger&m=FAILED&a=Unable to update $FocusedData!");
  }
}

function UpdateStatus($table, $data, $name, $status, $id, $c_name)
{
  if ($status == "active") {
    $statusv = '<input type="checkbox" id="switcherySize3" class="switchery mt-0" data-size="xs" checked/>';
  } else {
    $statusv = '<input type="checkbox" id="switcherySize3" class="switchery mt-0" data-size="xs"/>';
  }
  echo "<a href='update.php?UpdateData=true&table=$table&data=$data&name=$name&value=$status&id=$id&c_name=$c_name' alt='Click to Change Status'>$statusv</a>";
}

function DeleteData($table, $data, $id, $name)
{
  global $CR_PAGE;
  $cr_url = $CR_PAGE;
  echo "<a href='delete.php?delete=$table&data=$data&id=$id&cr_url=$cr_url&name=$name' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></a>";
}
