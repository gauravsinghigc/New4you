<?php
require 'files.php';
require 'session.php';

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Help & Support : <?php echo $PosName; ?></title>
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
        <h4 class="users-action">
         <i class="fa fa-info-circle text-warning"></i> Help, Support & Query
         <i class="fa fa-angle-right"></i>
        </h4>
        <br>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table table-striped zero-configuration">
           <thead>
            <tr>
             <th>S.NO</th>
             <th>Subject</th>
             <th>FULL NAME</th>
             <th>Phone Number</th>
             <th>Email ID</th>
             <th>QUERY SOURCE</th>
             <th>Date</th>
            </tr>
           </thead>
           <tbody>
            <?php
												$Select = "SELECT * FROM queryies order by query_id DESC";
												$query = mysqli_query($con, $Select);
												$CountQuery = mysqli_num_rows($query);
												if ($CountQuery == 0) {
													echo "<tr><td colspan='7' align='center'><h4><b>No Query Found!</b></h4></td></tr>";
												} else {
													while ($fetch = mysqli_fetch_assoc($query)) {
														$query_id = $fetch['query_id'];
														$full_name = $fetch['full_name'];
														$email = $fetch['email'];
														$phone_number = $fetch['phone_number'];
														$query_subject = $fetch['query_subject'];
														$query_details = $fetch['query_details'];
														$QUERY_SOURCE = $fetch['QUERY_SOURCE'];
														$device_details = $fetch['device_details'];
														$date_time = $fetch['date_time'];

														echo "<tr>
                                                                <td><a href='query.php?id=$query_id'>#QUERYID$query_id</a></td>
                                                                <td>$query_subject</td>
                                                                <td>$full_name</td>
                                                                <td>$phone_number</td>
                                                                <td>$email</td>
                                                                <td>$QUERY_SOURCE</td>
                                                                <td>$date_time</td>
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