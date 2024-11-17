<?php
require 'files.php';
require 'session.php';
$title_name = "Visitors Logs";

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
        </h4>
       </div><br>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <style>
         table tr th,
         td {
          font-size: 12.5px !important;
         }
         </style>
         <div class="table-responsive">
          <table class="table table-striped zero-configuration" style="font-size: 12px !important;">
           <thead>
            <tr>
             <th style="width: 5% !important;">#</th>
             <th style="width: 18% !important;">Ip Address</th>
             <th style="width: 8% !important;">DeviceType</th>
             <th style="width: 7% !important;">VisitorType</th>
             <th style="width: 13% !important;">VisitingDOT</th>
             <th style="width: 7% !important;">Page</th>
             <th style="width: 7% !important;">UserStatus</th>
             <th style="width: 8% !important">Source</th>
             <th style="width: 12%">Action</th>
            </tr>
           </thead>
           <tbody>
            <?php
                                                $visitors = "SELECT * FROM visitors";
                                                $visitorsquery = mysqli_query($con, $visitors);
                                                $count = 0;
                                                while ($fetchvisitors = mysqli_fetch_assoc($visitorsquery)) {
                                                    $count++; ?>
            <tr>
             <td><?php echo $count; ?></td>
             <td><?php echo $fetchvisitors['IpAddress']; ?></td>
             <td><?php echo $fetchvisitors['DeviceType']; ?></td>
             <td><?php echo $fetchvisitors['VisitorType']; ?></td>
             <td><?php echo $fetchvisitors['VistingDOT']; ?></td>
             <td><?php echo $fetchvisitors['VisitingUrl']; ?></td>
             <td><?php echo $fetchvisitors['UserStatus']; ?></td>
             <td><?php echo $fetchvisitors['VisitingSource']; ?></td>
             <td><a href="#" class="btn btn-sm btn-info" data-toggle="modal"
               data-target="#ViewModal<?php echo $fetchvisitors['VisitorId']; ?>"><i class="fa fa-list"></i></a>
              <?php if ($fetchvisitors['UserStatus'] == "Login") { ?>
              <a href="cust_details.php?customer_id=<?php echo $fetchvisitors['CustomerId']; ?>"
               class="btn btn-sm btn-primary"><i class="fa fa-user"></i></a>
              <?php } ?>
             </td>
            </tr>
            <!-- Modal -->

            <div class="modal fade text-left" id="ViewModal<?php echo $fetchvisitors['VisitorId']; ?>" tabindex="-1"
             role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
             <div class="modal-dialog" role="document">
              <div class="modal-content">
               <div class="modal-header">
                <h4 class="modal-title font-medium-2" id="myModalLabel1"><i class="fa fa-history text-success"></i>
                 Visitor Logs <i class="fa fa-angle-right"></i> <?php echo $fetchvisitors['VisitorId']; ?> <i
                  class="fa fa-sign-out"></i> <?php echo $fetchvisitors['IpAddress']; ?> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
               </div>
               <div class="modal-body">
                <p>
                 <b>VisitorId :</b> <?php echo $fetchvisitors['VisitorId']; ?><br>
                 <b>VistingDOT :</b> <?php echo $fetchvisitors['VistingDOT']; ?><br>
                 <b>DeviceType :</b> <?php echo $fetchvisitors['DeviceType']; ?><br>
                 <b>VisitorType :</b> <?php echo $fetchvisitors['VisitorType']; ?><br>
                 <b>VisitingUrl :</b> <?php echo $fetchvisitors['VisitingUrl']; ?><br>
                 <b>VisitingCounts :</b> <?php echo $fetchvisitors['VisitingCounts']; ?><br>
                 <b>VisitingSource :</b> <?php echo $fetchvisitors['VisitingSource']; ?><br>
                 <b>DeviceInformations :</b> <?php echo $fetchvisitors['DeviceInformations']; ?><br>
                </p>
               </div>
               <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                <?php if ($fetchvisitors['UserStatus'] == "Login") { ?>
                <a href="cust_details.php?customer_id=<?php echo $fetchvisitors['CustomerId']; ?>"
                 class="btn btn-outline-primary">View Profile</a>
                <?php } ?>
               </div>
              </div>
             </div>
            </div>

            <?php } ?>
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