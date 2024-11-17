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
 <title>ALL Payments : <?php echo $PosName; ?></title>
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
        <h4 class="users-action"> <i class="fa fa-inr text-success"></i> Payments <i class="fa fa-angle-right"></i>
         <?php
                                                                                                                            if (isset($_GET['type'])) {
                                                                                                                              echo $_GET['type'] . " Payments";
                                                                                                                            } else {
                                                                                                                              echo "All Payments";
                                                                                                                            } ?></h4>
       </div>
       <br>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table zero-configuration table-striped">
           <thead>
            <tr>
             <th>ORDER ID</th>
             <th>Customer Name</th>
             <th>Payment Mode</th>
             <th>Coupon Code</th>
             <th class="text-center">Order Amount</th>
             <th class="hidden-xs">Order Date</th>
             <th>Payment</th>
            </tr>
           </thead>

           <tbody>
            <?php
                        $user_role = $_SESSION['user_role'];

                        if ($user_role == "SUPER_ADMIN") {
                          $sql = "SELECT * FROM customer_orders, customers where customers.customer_id=customer_orders.customer_id";
                          $query = mysqli_query($con, $sql);
                        } elseif ($user_role == "STORE_USER") {
                          $user_id = $_SESSION['user_id'];
                          $sql = "SELECT * from stores where user_id='$user_id'";
                          $query = mysqli_query($con, $sql);
                          $fetch = mysqli_fetch_assoc($query);
                          $store_id = $fetch['store_id'];
                          $store_phone = $fetch['store_phone'];
                          $store_mail_id = $fetch['store_mail_id'];
                          $store_name = $fetch['store_name'];

                          if (isset($_GET['type'])) {
                            $trn_type = $_GET['type'];
                            $sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id and customer_orders.payment_status='$trn_type'";
                            $query = mysqli_query($con, $sql);
                          } else {
                            $sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id";
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

                            if ($payment_mode == "online_payment") {
                              $p_s = "";
                            } elseif ($payment_mode == "Cash On Delivery") {
                              $p_s = "p_s=Paid";
                            } ?>
            <tr>
             <td style="padding: 1%; font-size: 12px;">
              <h4><a href="invoice.php?id=<?php echo $fetch['order_id']; ?>" class='text-info'
                style="padding: 1%; font-size: 12px;"><?php echo $fetch['order_id']; ?></a></h4>
             </td>
             <td><a href="cust_details.php?customer_id=<?php echo $fetch['customer_id']; ?>"> <i class="fa fa-user"></i>
               <?php echo $fetch['customer_name']; ?></td>
             <td><?php echo $fetch['payment_mode']; ?></td>
             <td><?php echo $fetch['coupon_code']; ?></td>
             <td class="text-center">Rs.<?php echo $fetch['net_payable_amount']; ?></td>
             <td class="hidden-xs"><?php echo $fetch['order_date']; ?></td>
             <td><?php echo $fetch['payment_status']; ?>


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

</body>
<!-- END: Body-->

</html>