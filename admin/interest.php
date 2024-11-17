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
 <title>Interest Customers : <?php echo $PosName; ?></title>
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
         <i class="fa fa-star text-warning"></i> Interested Customers
         <i class="fa fa-angle-right"></i>
        </h4>

       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table dom-jQuery-events table-striped">
           <thead>
            <tr>
             <th>S.NO</th>
             <th>FULL_NAME</th>
             <th>Phone Number</th>
             <th>INTEREST TYPE</th>
             <th>Date</th>
            </tr>
           </thead>
           <tbody>
            <?php
												if (isset($_GET['ut'])) {
													$ut = $_GET['ut'];
													$SelectUsers = "SELECT * FROM interest, customers where interest.customer_id=customers.customer_id and interest.interest_type='$ut'";
												} else {
													$SelectUsers = "SELECT * FROM interest, customers where interest.customer_id=customers.customer_id";
												}
												$count = 0;
												$SelectUsersQuery = mysqli_query($con, $SelectUsers);
												while ($SelectUsersFetch =  mysqli_fetch_assoc($SelectUsersQuery)) {
													$customer_id = $SelectUsersFetch['customer_id'];
													$customer_name = $SelectUsersFetch['customer_name'];
													$phone_number = $SelectUsersFetch['customer_phone_number'];
													$interest_type = $SelectUsersFetch['interest_type'];
													$date_time = $SelectUsersFetch['submitdate'];
													$count++;
												?>
            <tr>
             <td><?php echo $count; ?></td>
             <td>
              <a href="cust_details.php?customer_id=<?php echo $customer_id; ?>"> <i class="fa fa-user"></i>
               <?php echo $customer_name; ?>
             </td>
             <td><?php echo $phone_number; ?></td>
             <td>
              <?php echo $interest_type; ?>
             </td>
             <td><?php echo $date_time; ?></td>

            </tr>
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