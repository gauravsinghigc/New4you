<?php
require 'files.php';
require 'session.php';
$Select = "SELECT * FROM queryies order by query_id DESC";
$query = mysqli_query($con, $Select);
$CountQuery = mysqli_num_rows($query);
$fetch = mysqli_fetch_assoc($query);
$query_id = $fetch['query_id'];
$full_name = $fetch['full_name'];
$email = $fetch['email'];
$phone_number = $fetch['phone_number'];
$query_subject = $fetch['query_subject'];
$query_details = $fetch['query_details'];
$QUERY_SOURCE = $fetch['QUERY_SOURCE'];
$device_details = $fetch['device_details'];
$date_time = $fetch['date_time'];
$query_status = $fetch['query_status'];

if($query_status == null){
	$query_status = "<img src='img/WltQ.txt' style='width:21%;position:fixed;right:3%;top:1%:' class='float-right'>";
} elseif($query_status == "running") {
   $query_status = "<img src='img/gears_animated.gif' style='width:18%;position:fixed;right:3%;top:1%:' class='float-right'>";
} elseif($query_status == "closed"){
   $query_status = "<img src='img/CLOSEDGIF1.gif' style='width:18%;position:fixed;right:3%;top:1%:' class='float-right'>";
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName;?>">
 <title>#QUERYID<?php echo $query_id?> : <?php echo $PosName;?></title>
 <?php include 'header_files.php';?>

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
     <?php notification();?>
    </div>
   </div>



   <div class="content-body">
    <!-- users list start -->
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action">
         <i class="fa fa-info-circle text-info"></i> #QUERYID<?php echo $query_id;?>
         <i class="fa fa-angle-right"></i>
         <?php echo $query_subject;?> <i class="fa fa-angle-right"></i> <?php echo $query_status;?>
        </h4>
       </div>
       <div class="card-content">
        <div class="card-body">

         <div class="row">
          <div class="col-lg-12">
           <h2><b><?php echo $query_subject;?> </b></h2>
           <h6>#QUERYID<?php echo $query_id;?> - <?php echo $date_time;?><br>
            Query Source <i class="fa fa-angle-right"></i> <?php echo $QUERY_SOURCE;?></h6>
           <h5><i class="fa fa-user btn-sm btn btn-outline-info"></i> <?php echo $full_name;?><br>
            <span><i class="fa fa-phone btn-sm btn btn-outline-info"></i> <?php echo $phone_number;?></span><br>
            <span><i class="fa fa-envelope btn-sm btn btn-outline-info"></i> <?php echo $email;?></span>
           </h5>
           <b>Query Details:</b>
           <p><i class="fa fa-pencil"></i> <?php echo $query_details;?></p>
           <hr>
           <a href="update.php?execute_query=<?php echo $query_id;?>" class="btn btn-md btn-success">Execute Query</a>
          </div>
         </div>
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


 <!-- BEGIN: Vendor JS-->
 <script src="app-assets/vendors/js/vendors.min.js"></script>
 <!-- BEGIN Vendor JS-->

 <!-- BEGIN: Page Vendor JS-->
 <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
 <!-- END: Page Vendor JS-->

 <!-- BEGIN: Theme JS-->
 <script src="app-assets/js/core/app-menu.min.js"></script>
 <script src="app-assets/js/core/app.min.js"></script>
 <script src="app-assets/js/scripts/customizer.min.js"></script>
 <!-- END: Theme JS-->

 <!-- BEGIN: Page JS-->
 <script src="app-assets/js/scripts/pages/page-users.min.js"></script>

</body>
<!-- END: Body-->

</html>