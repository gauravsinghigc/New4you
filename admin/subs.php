<?php
require 'files.php';
require 'session.php';
$store_id = $_GET['store_id'];
$sql = "SELECT * from stores, payment_gateway, store_domains where stores.store_id=payment_gateway.store_id and stores.store_id=store_domains.store_id and stores.store_id='$store_id' and activation_fee_status!='Activated'";
$query =  mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$store_name = $fetch['store_name'];
$store_phone = $fetch['store_phone'];
$store_mail_id = $fetch['store_mail_id'];
$store_description = $fetch['store_description'];
$store_address = $fetch['store_address'];
$store_arealocality = $fetch['store_arealocality'];
$store_city = $fetch['store_city'];
$store_state = $fetch['store_state'];
$store_pincode = $fetch['store_pincode'];
$activation_fee_status = $fetch['activation_fee_status'];
$payment_use = $fetch['payment_use'];
$domain_type = $fetch['domain_type'];
$store_add_date = $fetch['store_add_date'];
$domain_avaibility = $fetch['domain_avaibility'];
$domain = $fetch['domain'];
$pg_mid = $fetch['pg_mid'];
$pg_key = $fetch['pg_key'];
$pg_web = $fetch['pg_web'];
$pg_mode = $fetch['pg_mode'];
$store_activation_fee = $fetch['store_activation_fee'];
$store_user_id = $fetch['user_id'];
$user_id = $store_user_id;

$sql = "SELECT * FROM users, user_types where user_id='$store_user_id' and users.user_role=user_types.user_type_id";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$full_name_user = $fetch['full_name'];
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title><?php echo $store_name; ?> : <?php echo $PosName; ?></title>
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
        <h4 class="users-action">Store Payments</h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table id="users-list-datatable" class="table">
           <thead>
            <tr>
             <th>STRID</th>
             <th>STORE Name</th>
             <th>OWNER NAME</th>
             <th>PAY MONTH</th>
             <th>PAY TYPE</th>
             <th>AMOUNT</th>
             <th>Action</th>
            </tr>
           </thead>
           <tbody>
            <?php
                        if ($store_id == null) { ?>
            <tr>
             <td colspan="7" class="text-center">
              <h3>No Pending Subscription Found</h3>
             </td>
            </tr>

            <?php } else { ?>
            <tr>
             <td><?php echo $store_id; ?></td>
             <td><?php echo $store_name; ?></td>
             <td><?php echo $full_name_user; ?></td>
             <td><?php echo $store_add_date; ?></td>
             <td>Activation FEE</td>
             <td>Rs.<?php echo $store_activation_fee; ?></td>
             <td><A href='' class='btn btn-info'> Click to Pay</A></td>
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