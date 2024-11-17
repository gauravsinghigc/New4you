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
 <title>Orders : <?php echo $PosName; ?></title>
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
        <h4 class="users-action">Today Orders <i class="fa fa-angle-right"></i> Regular Orders<br>
         <a href="reg_orders.php" class="btn btn-primary">Regular Orders</a>
         <a href="deliveries.php" class="btn btn-success">Subscription Orders</a>
        </h4>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table id="users-list-datatable" class="table">
           <thead>
            <tr>
             <th style="padding: 1%; font-size: 12px;">ORDER ID</th>
             <th style="padding: 1%; font-size: 12px;">Customer Name</th>
             <th style="padding: 1%; font-size: 12px;">Payment Mode</th>
             <th style="padding: 1%; font-size: 12px;">DELIVERY_TYPE</th>
             <th class="text-center" style="padding: 1%; font-size: 12px;">Order Amount</th>
             <th class="hidden-xs" style="padding: 1%; font-size: 12px;">Payment Status</th>
             <th style="padding: 1%; font-size: 12px;">ORDER Date</th>
             <th style="padding: 1%; font-size: 12px;">Action</th>
            </tr>
           </thead>

           <tbody>
            <?php
                                                $user_role = $_SESSION['user_role'];

                                                if ($user_role == "SUPER_ADMIN") {
                                                    $sql = "SELECT * FROM customer_orders, customers where customers.customer_id=customer_orders.customer_id and customer_orders.order_status='NEW_ORDER' and customer_orders.DELIVERY_TYPE='STORE_PICKUP' or customer_orders.DELIVERY_TYPE='DELIVERY'";
                                                    $query = mysqli_query($con, $sql);
                                                } elseif ($user_role == "STORE_USER" or $user_role == "DELIVERY_BOY") {
                                                    $user_id = $_SESSION['user_id'];
                                                    $sql = "SELECT * from stores where user_id='$user_id'";
                                                    $query = mysqli_query($con, $sql);
                                                    $fetch = mysqli_fetch_assoc($query);
                                                    $store_id = $fetch['store_id'];
                                                    $store_phone = $fetch['store_phone'];
                                                    $store_mail_id = $fetch['store_mail_id'];
                                                    $store_name = $fetch['store_name'];

                                                    $user_id = $_SESSION['user_id'];
                                                    $sql = "SELECT * FROM users where user_id='$user_id'";
                                                    $query = mysqli_query($con, $sql);
                                                    $fetch = mysqli_fetch_assoc($query);
                                                    $ref_id = $fetch['ref'];

                                                    $sql = "SELECT * FROM stores where user_id ='$ref_id'";
                                                    $query = mysqli_query($con, $sql);
                                                    $fetch = mysqli_fetch_assoc($query);
                                                    $store_id = $fetch['store_id'];

                                                    if (isset($_GET['order_type'])) {
                                                        $order_type = $_GET['order_type'];
                                                        $sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id and customer_orders.order_status='$order_type'";
                                                        $query = mysqli_query($con, $sql);
                                                    } elseif (!isset($_GET['order_type'])) {

                                                        $sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id and customer_orders.order_status!='DELIVERED'";
                                                        $query = mysqli_query($con, $sql);
                                                    }
                                                }
                                                $count = mysqli_num_rows($query);
                                                if ($count == 0) {
                                                    echo "<tr align='center'>
                                                        <td colspan='8'><h3><i class='fa fa-warning'></i><br></h3><h3>No Orders are Available!</h3>
                                                    </tr>";
                                                } else {
                                                    while ($fetch = mysqli_fetch_assoc($query)) {
                                                        $payment_mode = $fetch['payment_mode'];
                                                        $order_status = $fetch['order_status'];
                                                        $order_id = $fetch['order_id'];
                                                        $DELIVERY_TYPE = $fetch['DELIVERY_TYPE'];

                                                        if ($payment_mode == "Online Payment") {
                                                            $p_s = "";
                                                        } elseif ($payment_mode == "Cash On Delivery") {
                                                            $p_s = "p_s=Paid";
                                                        } ?>
            <tr>
             <td style="padding: 1%; font-size: 12px;">
              <h4><a href="pickup_deliver.php?id=<?php echo $fetch['order_id']; ?>" class='text-info'
                style="padding: 1%; font-size: 12px;"><?php echo $fetch['order_id']; ?></a></h4>
             </td>
             <td style="padding: 1%; font-size: 12px;"><?php echo $fetch['customer_name']; ?></td>
             <td style="padding: 1%; font-size: 12px;"><?php echo $fetch['payment_mode']; ?></td>
             <td style="padding: 1%; font-size: 12px;"><?php echo $fetch['DELIVERY_TYPE']; ?></td>
             <td style="padding: 1%; font-size: 12px;" class="text-center">
              Rs.<?php echo $fetch['net_payable_amount']; ?>
             </td>
             <td style="padding: 1%; font-size: 12px;" class="text-success"><?php echo $fetch['payment_status']; ?>
             <td style="padding: 1%; font-size: 12px;" class="hidden-xs"><?php echo $fetch['order_date']; ?></td>
             <td style="padding: 1%; font-size: 12px;width: 130px;">

              <?php if ($DELIVERY_TYPE == "STORE_PICKUP") { ?>
              <?php if ($order_status == "NEW_ORDER") { ?>
              <a href="update.php?accept_id=<?php echo $order_id; ?>&store_id=<?php echo $store_id; ?>"
               class='btn btn-info btn-sm float-left'>
               Accept
              </a>
              <a href="update.php?reject_id=<?php echo $order_id; ?>&store_id=<?php echo $store_id; ?>&sms=&s_p=&s_m="
               class='btn btn-warning btn-sm float-right'>
               Reject
              </a>
              <?php } elseif ($order_status == "ACCEPTED") { ?>
              <a href="pickup_deliver.php?id=<?php echo $fetch['order_id']; ?>" class='btn btn-info btn-md'
               style="padding: 1%; font-size: 12px;" class='btn btn-primary btn-sm'>
               View Order
              </a>
              <?php }
                                                                } else { ?>
              <?php if ($order_status == "NEW_ORDER") { ?>
              <a href="update.php?accept_id=<?php echo $order_id; ?>&store_id=<?php echo $store_id; ?>"
               class='btn btn-info btn-sm float-left'>
               Accept
              </a>
              <a href="update.php?reject_id=<?php echo $order_id; ?>&store_id=<?php echo $store_id; ?>&sms=&s_p=&s_m="
               class='btn btn-warning btn-sm float-right'>
               Reject
              </a>
              <?php } elseif ($order_status == "ACCEPTED") { ?>
              <a href="update.php?delivery_out=<?php echo $fetch['order_id']; ?>&store_id=<?php echo $store_id; ?>&sms="
               class='btn btn-primary btn-sm'>
               Out For Delivery
              </a>
              <?php } elseif ($order_status == "OUT_FOR_DELIVERY") { ?>
              <a href="pickup_deliver.php?id=<?php echo $fetch['order_id']; ?>" class='btn btn-warning btn-sm'>
               Delivered?
              </a>
              <?php } elseif ($order_status == "Rejected") { ?>
              <a href="pickup_deliver.php?id=<?php echo $fetch['order_id']; ?>" class='btn btn-sm'>
               Rejected
              </a>
              <?php }
                                                                } ?>
             </td>
            </tr>
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