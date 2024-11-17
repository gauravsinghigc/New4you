<?php
require 'files.php';
require 'session.php';
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
         <a href="notifications_logs.php"><i class="fa fa-eye"></i> View Notifications</a>
        </h4>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table table-striped zero-configuration" style="font-size: 12px !important;">
           <thead>
            <tr>
             <th style="width: 4% !important;">#</th>
             <th style="width: 12% !important;">Customer Name</th>
             <th style="width: 15% !important;">Ip Address</th>
             <th style="width: 12% !important;">Server Msg</th>
             <th style="width: 10% !important;">Status</th>
             <th style="width: 10% !important;">Source Type</th>
             <th style="width: 14% !important;">Req DateTime</th>
             <th style="width: 10% !important">Action</th>
            </tr>
           </thead>
           <tbody>
            <?php
                                                $SelectLoginlogs = "SELECT * FROM loginlogs ORDER BY LogsId DESC";
                                                $LogsQuery = mysqli_query($con, $SelectLoginlogs);
                                                $CountLogins = mysqli_num_rows($LogsQuery);
                                                if ($CountLogins == 0) {
                                                    echo "<tr><td colspan='8' align='center'><h2>No Logins Found!</h2></td></tr>";
                                                } else {
                                                    while ($FetchLogs = mysqli_fetch_assoc($LogsQuery)) {
                                                        $LogsId = $FetchLogs['LogsId'];
                                                        $UserId = $FetchLogs['UserId'];
                                                        $LogsAddDOT = date("d M Y h:m A", strtotime($FetchLogs['LogsAddDOT']));
                                                        $LogsStatus = $FetchLogs['LogsStatus'];
                                                        $SourceType = $FetchLogs['SourceType'];
                                                        $IpAddress = $FetchLogs['IpAddress'];
                                                        $LogsMsg = $FetchLogs['LogsMsg'];

                                                        $SelectCustomer = "SELECT * FROM users where user_id='$UserId'";
                                                        $CustomerQuery = mysqli_query($con, $SelectCustomer);
                                                        $FetchCustomer = mysqli_fetch_assoc($CustomerQuery);
                                                        $CustomerName = $FetchCustomer['full_name'];

                                                        echo "<tr>
                                                        <td>$LogsId</td>
                                                        <td>$CustomerName</td>
                                                        <td>$IpAddress</td>
                                                        <td>$LogsMsg</td>
                                                        <td>$LogsStatus</td>
                                                        <td>$SourceType</td>
                                                        <td>$LogsAddDOT</td>
                                                        <td><a href='logsdetails.php?LogsId=$LogsId' class='btn btn-info btn-sm'>View Details</a></td>
                                                      </tr>";
                                                    }
                                                } ?>
           </tbody>
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