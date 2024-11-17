<?php
session_start();
require 'text.php';
require 'config.php';
require 'tools.php';

if (isset($_POST['POS_LOGIN_REQUEST'])) {
  $USERNAME = $_POST['username'];
  $PASSWORD = $_POST['password'];
  $IP_ADDRESS = ip_address();
  $Attempts = $_SESSION['ControlUserAttempts'];
  $Attempts++;
  $_SESSION['ControlUserAttempts'] = $Attempts;

  //DEVICE DETAILS
  $IP_ADDRESS = $IP_ADDRESS;
  $DEVICE_TYPE = detectDevice();
  $SYSTEM_INFO = $_SERVER['HTTP_USER_AGENT'];
  date_default_timezone_set("Asia/Calcutta");
  $CURRENT_DATE_TIME = date("d D M Y, h:m a");
  $HOST_NAME = php_uname('n');
  $GSI_GET_SYSTEM_DATA = "<b>Date_TIME:</b> $CURRENT_DATE_TIME<br>
 <b>IP_ADDRESS:</b> $IP_ADDRESS<br>
 <b>DEVICE_TYPE:</b> $DEVICE_TYPE<br>
 <b>SYSTEM_INFO:</b> $SYSTEM_INFO<br>
 <b>HOST_NAME:</b> $HOST_NAME";

  $DeviceDetails = "$GSI_GET_SYSTEM_DATA";

  $sql = "SELECT * from users where users.username='$USERNAME' and users.password='$PASSWORD'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  if ($fetch == true) {

    $user_status = $fetch['user_status'];
    if ($user_status == "BLOCK" or $user_status == "Inactive" or $user_status == "inactive" or $user_status == "LEAVED") {

      //Create Logs for Login Provided Data
      $CreateLog = "INSERT INTO loginlogs (UserId, Username, Password, DeviceDetails, IpAddress, LogsAddDOT, LogsStatus, LogsMsg, SourceType) VALUES ('$user_id', '$EmailId', '$PASSWORD', '$DeviceDetails', '$IP_ADDRESS', CURRENT_TIMESTAMP, 'Login Failed', '$user_status Account<br> Login Attempts $Attempts', 'ADMIN_PANEL')";
      $logQuery = mysqli_query($con, $CreateLog);

      header("location: login.php?t=warning&m=INACTIVE&a=Your Account is Deactivated!");
    } else {
      $user_id = $fetch['user_id'];
      $user_role_id = $fetch['user_role'];
      $user_type = $fetch['user_type'];
      $EmailId = $fetch['email_id'];

      $sql = "SELECT * FROM user_types where user_type_id='$user_role_id'";
      $query =  mysqli_query($con, $sql);

      if ($query == true) {
        $fetch = mysqli_fetch_assoc($query);
        $user_type_title = $fetch['user_type_title'];

        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_role'] = $user_type_title;
        $_SESSION['user_type'] = $user_type;


        if ($user_type_title == "STORE_USER" or $user_type_title == "SUPER_ADMIN") {
          //Create Logs for Login Provided Data
          $CreateLog = "INSERT INTO loginlogs (UserId, Username, Password, DeviceDetails, IpAddress, LogsAddDOT, LogsStatus, LogsMsg, SourceType) VALUES ('$user_id', '$EmailId', '$PASSWORD', '$DeviceDetails', '$IP_ADDRESS', CURRENT_TIMESTAMP, 'Success', 'Login Successfull by $user_type_title', 'ADMIN_PANEL')";
          $logQuery = mysqli_query($con, $CreateLog);
          header("location: index.php?t=success&m=Success&a=Login Successfull!");
        } elseif ($user_type_title == "DELIVERY_MAN") {
          //Create Logs for Login Provided Data
          $CreateLog = "INSERT INTO loginlogs (UserId, Username, Password, DeviceDetails, IpAddress, LogsAddDOT, LogsStatus, LogsMsg, SourceType) VALUES ('$user_id', '$EmailId', '$PASSWORD', '$DeviceDetails', '$IP_ADDRESS', CURRENT_TIMESTAMP, 'Success', 'Login Successfull by $user_type_title', 'ADMIN_PANEL')";
          $logQuery = mysqli_query($con, $CreateLog);

          header("location: ../delivery/index.php?t=success&m=Success&a=Login Successfull!");
        } else {
          //Create Logs for Login Provided Data
          $CreateLog = "INSERT INTO loginlogs (UserId, Username, Password, DeviceDetails, IpAddress, LogsAddDOT, LogsStatus, LogsMsg, SourceType) VALUES ('$user_id', '$EmailId', '$PASSWORD', '$DeviceDetails', '$IP_ADDRESS', CURRENT_TIMESTAMP, 'Login Blocked', 'Login Blocked system. One $user_type_title wants to try unauthorised access of system', 'DELIVERY_PANEL')";
          $logQuery = mysqli_query($con, $CreateLog);

          header("location: error.php?err=INVALID_USER_ACCESS: Dear $HOST_NAME, you are trying to login at unathorised access. So System blocks your logins and deactivated your accounts, if if this is not done by you then please contact us otherwise you are not able to do future logins.");
        }
      } else {

        //Create Logs for Login Provided Data
        $CreateLog = "INSERT INTO loginlogs (UserId, Username, Password, DeviceDetails, IpAddress, LogsAddDOT, LogsStatus, LogsMsg, SourceType) VALUES ('null', '$EmailId', '$PASSWORD', '$DeviceDetails', '$IP_ADDRESS', CURRENT_TIMESTAMP, 'Login Failed', 'No User Found', 'ADMIN_PANEL')";
        $logQuery = mysqli_query($con, $CreateLog);
        header("location: login.php?t=warning&m=failed&m=Something Went Wrong!");
      }
    }
  } else {

    //Create Logs for Login Provided Data
    $CreateLog = "INSERT INTO loginlogs (UserId, Username, Password, DeviceDetails, IpAddress, LogsAddDOT, LogsStatus, LogsMsg, SourceType) VALUES ('$user_id', '$EmailId', '$PASSWORD', '$DeviceDetails', '$IP_ADDRESS', CURRENT_TIMESTAMP, 'Login Failed', 'Invalid Data', 'ADMIN_PANEL')";
    $logQuery = mysqli_query($con, $CreateLog);
    header("location: login.php?t=danger&m=Invalid&a=Invalid Username and Password!");
  }
} else {
  header("location: error.php?err=INVLD_LGIN_REQ : Unable to proceed Login request! Try Again After Sometime. Also contact to administrator for support. Please mention Error Type while contacting to administrator for early solution.");
}
