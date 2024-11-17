<?php
require 'files.php';
require 'session.php';
$title_name = "ALL Notifications";

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
         <a href="add_categories.php"><i class="fa fa-plus"></i> Generate Notifications</a>
         <a href="login_logs.php"><i class="fa fa-eye"></i> View Login Logs</a>
        </h4>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table table-striped zero-configuration table-hover" style="font-size: 12px !important;">
           <thead>
            <tr>
             <th style="width: 2% !important;">#</th>
             <th style="width: 19% !important;">Customer Name</th>
             <th style="width: 25% !important;">Notification Title</th>
             <th style="width: 15% !important;">Sent DateTime</th>
             <th style="width: 3% !important;">Status</th>
             <th style="width: 13% !important;">Read Time</th>
             <th style="width: 13% !important;">Actions</th>
            </tr>
           </thead>
           <tbody>
            <?php
                        $SelectNotifications = "SELECT * FROM notifications ORDER BY notification_id DESC";
                        $NotificationQuery = mysqli_query($con, $SelectNotifications);
                        $CountNotifications = mysqli_num_rows($NotificationQuery);
                        if ($CountNotifications == 0) {
                          echo "<tr><td colspan='7'><h2>No Notifications Found!</h2></td></tr>";
                        } else {
                          while ($FetchNotifications = mysqli_fetch_assoc($NotificationQuery)) {
                            $NotificationId = $FetchNotifications['notification_id'];
                            $CustomerId = $FetchNotifications['customer_id'];
                            $NotificationsTitle = $FetchNotifications['notification_title'];
                            $NotificationDatetime = date("d M Y h:m A", strtotime($FetchNotifications['notification_date']));
                            $NotificationStatus = $FetchNotifications['notification_status'];
                            $ReadTime = date("d M Y h:m A", strtotime($FetchNotifications['read_time']));
                            $NotficationDesc = $FetchNotifications['notification_desc'];

                            $SelectCustome = "SELECT * FROM customers where customer_id='$CustomerId'";
                            $CustomerQuery = mysqli_query($con, $SelectCustome);
                            $FetchCustomer = mysqli_fetch_assoc($CustomerQuery);
                            $CustomerName = $FetchCustomer['customer_name'];

                            echo "<tr>
                                                        <td>$NotificationId</td>
                                                        <td>$CustomerName</td>
                                                        <td>$NotificationsTitle</td>
                                                        <td>$NotificationDatetime</td>
                                                        <td>$NotificationStatus</td>
                                                        <td>$ReadTime</td>
                                                        <td><a href='#' class='btn btn-info btn-sm' data-toggle='modal' data-target='#ViewModal$NotificationId'>View Details</a></td>
                                                      </tr>";
                        ?>

            <!-- Modal -->

            <div class="modal fade text-left" id="ViewModal<?php echo $NotificationId; ?>" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel1" aria-hidden="true">
             <div class="modal-dialog" role="document">
              <div class="modal-content">
               <div class="modal-header">
                <h4 class="modal-title font-medium-2" id="myModalLabel1"><i class="fa fa-bell text-success"></i>
                 Notifications <i class="fa fa-angle-right"></i> <?php echo $NotificationsTitle; ?> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
               </div>
               <div class="modal-body">
                <p>
                 <b>NotificationId :</b> <?php echo $NotificationId; ?><br>
                 <b>SentDateTime :</b> <?php echo $NotificationDatetime; ?><br>
                 <b>CustomerName :</b> <?php echo $CustomerName; ?><br>
                 <b>NotificationsTitle :</b> <?php echo $NotificationsTitle; ?><br>
                 <b>NotficationDesc :</b> <?php echo $NotficationDesc; ?><br>
                 <b>NotificationStatus :</b> <?php echo $NotificationStatus; ?><br>
                 <b>ReadTime :</b> <?php echo $ReadTime; ?><br>

                </p>
               </div>
               <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                <a href="cust_details.php?customer_id=<?php echo $CustomerId; ?>" class="btn btn-outline-primary">View
                 Profile</a>
               </div>
              </div>
             </div>
            </div>

            <?php }
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