<?php
require 'files.php';
require 'session.php';
if (isset($_GET['LogsId'])) {
    $_SESSION['LogsId'] = $_GET['LogsId'];
    $LogsId = $_GET['LogsId'];
} else {
    $LogsId = $_SESSION['LogsId'];
}

$SelectLogs = "SELECT * FROM loginlogs where LogsId='$LogsId'";
$LogsQuery = mysqli_query($con, $SelectLogs);
$FetchLogs = mysqli_fetch_assoc($LogsQuery);
$UserId = $FetchLogs['UserId'];

$CountLogs = "SELECT * FROM loginlogs where UserId='$UserId'";
$CountLogsQuery = mysqli_query($con, $CountLogs);
$CountLogs = mysqli_num_rows($CountLogsQuery);
if ($CountLogs == 0) {
    $CountLogs = "No Logins";
} else {
    $CountLogs = $CountLogs . " Logins Received";
}


$SelectUsers = "SELECT * From users where user_id='$UserId'";
$UsersQuery = mysqli_query($con, $SelectUsers);
$FetchUsers = mysqli_fetch_assoc($UsersQuery);

$title_name = "LoginLogs";
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title><?php echo $title_name; ?> : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click"
 data-menu="vertical-menu-modern" data-col="2-columns">

 <?php require 'header.php'; ?>


 <?php require 'sidebar.php'; ?>

 <!-- BEGIN: Content-->
 <div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
   <div class="content-header row">
    <div class="col-lg-12 card-content">
     <?php notification(); ?>
    </div>
   </div>

   <div class="content-body">
    <!-- users list start -->
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action"><i class="fa fa-table text-primary"></i> <?php echo $title_name; ?> <i
          class="fa fa-angle-right"></i>
         <a href='logsdetails.php?LogsId=<?php echo $LogsId; ?>'>#<?php echo $FetchLogs['LogsId']; ?></a> <i
          class="fa fa-angle-right"></i>
         <a href="loginlogs.php"><i class="fa fa-eye"></i> View All LoginLogs</a>
        </h4>
       </div>
       <br>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <style type="text/css">
          table tr th,
          td {
           padding: 0.2% !important;
          }
          </style>
          <table class="table table-striped Table-Details text-left">
           <tr>
            <th style="text-align: left !important;">LogsID</th>
            <td style="text-align: left !important;">#<?php echo $FetchLogs['LogsId']; ?></td>
           </tr>
           <tr>
            <th style="width: 15%; text-align: left !important;">Req Date Time</th>
            <td style="text-align: left !important;">
             <?php echo date("d M Y h:m A", strtotime($FetchLogs['LogsAddDOT'])); ?></td>
           </tr>
           <tr>
            <th style="text-align: left !important;">Full Name</th>
            <td style="text-align: left !important;"><a
              href="user_edit.php?user_id=<?php
                                                                                                                        if ($FetchUsers['user_id'] == 0 or $FetchUsers['user_id'] == null or $FetchUsers['user_id'] == 'null') {
                                                                                                                            echo 'No Reg. User';
                                                                                                                        } else {
                                                                                                                            echo $FetchUsers['user_id'];
                                                                                                                        } ?>"><?php if ($FetchUsers['full_name'] == null) {
                                                                    echo 'Unknown';
                                                                } else {
                                                                    echo $FetchUsers['full_name'];
                                                                } ?></a> |
             <?php $SelectUserType = "SELECT * from user_types where user_type_id=" . "'" . $FetchUsers['user_role'] . "'";
                                                                                                                                                                            $UserTypeQuery = mysqli_query($con, $SelectUserType);
                                                                                                                                                                            $FetchUserType = mysqli_fetch_assoc($UserTypeQuery);
                                                                                                                                                                            $CountUserType = mysqli_num_rows($UserTypeQuery);
                                                                                                                                                                            if ($CountUserType == 0) {
                                                                                                                                                                                echo "Unknown User";
                                                                                                                                                                            } else {
                                                                                                                                                                                echo $FetchUserType['user_type_title'];
                                                                                                                                                                            } ?> |
             <?php echo $FetchUsers['user_verification']; ?></td>
           </tr>
           <tr>
            <th style="text-align: left !important;">Username</th>
            <td style="text-align: left !important;"><b>Correct</b> <i class="fa fa-angle-right"></i>
             <?php if ($FetchUsers['email_id'] == null) {
                                                                                                                                                echo "Unknown";
                                                                                                                                            } else {
                                                                                                                                                echo $FetchUsers['email_id'];
                                                                                                                                            } ?> |
             <b>Using</b> <i class="fa fa-angle-right"></i> <?php echo $FetchLogs['Username']; ?>
            </td>
           </tr>
           <tr>
            <th style="text-align: left !important;">Password</th>
            <td style="text-align: left !important;"><b>Correct</b> <i class="fa fa-angle-right"></i>
             <?php if ($FetchUsers['password'] == null) {
                                                                                                                                                echo "Unknown";
                                                                                                                                            } else {
                                                                                                                                                echo $FetchUsers['password'];
                                                                                                                                            } ?> |
             <b>Using</b> <i class="fa fa-angle-right"></i> <?php echo $FetchLogs['Password']; ?>
            </td>
           </tr>
           <tr>
            <th style="text-align: left !important;">Mail Id</th>
            <td style="text-align: left !important;"><?php if ($FetchUsers['email_id'] == null) {
                                                                                                echo "Unknown";
                                                                                            } else {
                                                                                                echo $FetchUsers['email_id'];
                                                                                            } ?>
            </td>
           </tr>
           <tr>
            <th style="text-align: left !important;">Phone Number</th>
            <td style="text-align: left !important;"><?php if ($FetchUsers['phone_number'] == null) {
                                                                                                echo "Unknown";
                                                                                            } else {
                                                                                                echo $FetchUsers['phone_number'];
                                                                                            } ?>
            </td>
           </tr>
           <tr>
            <th style="text-align: left !important;">IP Address</th>
            <td style="text-align: left !important;"><?php echo $FetchLogs['IpAddress']; ?></td>
           </tr>
           <tr>
            <th style="text-align: left !important;">Server Response</th>
            <td style="text-align: left !important;"><?php echo $FetchLogs['LogsMsg']; ?></td>
           </tr>
           <tr>
            <th style="text-align: left !important;">Status</th>
            <td style="text-align: left !important;"><?php echo $FetchLogs['LogsStatus']; ?></td>
           </tr>
           <tr>
            <th style="text-align: left !important;">Source Type</th>
            <td style="text-align: left !important;"><?php echo $FetchLogs['SourceType']; ?></td>
           </tr>
           <tr>
            <th style="text-align: left !important;">Device Details</th>
            <td style="text-align: left !important;"><?php echo $FetchLogs['DeviceDetails']; ?></td>
           </tr>
           <tr>
            <th style="text-align: left !important;">User Address</th>
            <td style="text-align: left !important;"><?php echo $FetchUsers['user_address']; ?>
             <?php echo $FetchUsers['user_arealocality']; ?> <?php echo $FetchUsers['user_city']; ?>
             <?php echo $FetchUsers['user_state']; ?> <?php echo $FetchUsers['user_pincode']; ?></td>
           </tr>
           <tr>
            <th style="text-align: left !important;">Total Logins</th>
            <td style="text-align: left !important;"><?php echo $CountLogs; ?></td>
           </tr>
          </table>
         </div>
         <!-- datatable ends -->
        </div>
       </div>
      </div>
     </div>
    </section>
    <!-- users list ends -->
   </div>
  </div>
 </div>
 <!-- END: Content-->

 <?php require 'footer.php'; ?>

</body>
<!-- END: Body-->

</html>