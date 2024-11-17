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
        <h4 class="users-action">Today Orders <i class="fa fa-angle-right"></i> Subscription Orders<br>
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
             <th style="padding: 1%; font-size: 12px;">ID</th>
             <th style="padding: 1%; font-size: 12px;">Customer Name</th>
             <th class="text-left" style="padding: 1%; font-size: 12px;">
              Payment / Mode</th>
             <th style="padding: 1%; font-size: 12px;">STATUS</th>
            </tr>
           </thead>

           <tbody>
            <?php
                                                if (isset($_GET['day'])) {

                                                    $v_day = $_GET['day'];
                                                    $v_month = $_GET['month'];
                                                    $v_year = $_GET['year'];
                                                    $filter_view = "$v_day $v_month $v_year";
                                                    $daily_plan = "DAILY_PLAN";
                                                    $current_dates = date("Y-m-d", strtotime($filter_view));
                                                    $view_day = strtoupper(date("D", strtotime($filter_view)));
                                                } else {

                                                    $v_day = date("d");
                                                    $v_month = date("m");
                                                    $v_year = date("Y");
                                                    $filter_view = "$v_day $v_month $v_year";
                                                    $daily_plan = "DAILY_PLAN";
                                                    $current_dates = date("Y-m-d", strtotime($filter_view));
                                                    $view_day = strtoupper(date("D", strtotime($filter_view)));
                                                }

                                                $user_id = $_SESSION['user_id'];
                                                $sql = "SELECT * FROM users where user_id='$user_id'";
                                                $query = mysqli_query($con, $sql);
                                                $fetch = mysqli_fetch_assoc($query);
                                                $ref_id = $fetch['ref'];

                                                $sql = "SELECT * FROM stores where user_id ='$ref_id'";
                                                $query = mysqli_query($con, $sql);
                                                $fetch = mysqli_fetch_assoc($query);
                                                $store_id = $fetch['store_id'];

                                                $sql = "SELECT * FROM customer_subscriptions_days where store_id='$store_id' and SUBSCRIPTION_DAYS='$view_day' and SUBS_START_DATE<>'$current_dates' or SUBSCRIPTION_DAYS='DAILY_PLAN' ";
                                                $query = mysqli_query($con, $sql);
                                                $count_subs = mysqli_num_rows($query);
                                                if ($count_subs == 0) {
                                                    echo "<tr align='center'>
           <td colspan='4'><h5>No Subscription Found!</h5></td>
        </tr>";
                                                } else {
                                                    while ($fetch = mysqli_fetch_assoc($query)) {
                                                        $sql = "SELECT * from customer_subscriptions where store_id='$store_id' and SUBSCRIPTION_STATUS='ACTIVE'";
                                                        $query = mysqli_query($con, $sql);
                                                        while ($fetch = mysqli_fetch_assoc($query)) {
                                                            $SUBS_ID[] = $fetch['customer_subscription_id'];
                                                        }
                                                    }

                                                    foreach ($SUBS_ID as $SUB_ID) {

                                                        $sql = "SELECT * FROM subscription_deliveries where customer_subscription_id!='$SUB_ID' and delivery_day!='$v_day' and delivery_month!='$v_month' and delivery_year!='$v_year'";
                                                        $query = mysqli_query($con, $sql);
                                                        $fetch = mysqli_fetch_assoc($query);
                                                        $sub_id = $fetch['customer_subscription_id'];
                                                        $sql = "SELECT * from customer_subscriptions, customers where customer_subscriptions.customer_subscription_id='$SUB_ID'  and customer_subscriptions.SUBSCRIPTION_STATUS='ACTIVE' and customer_subscriptions.customer_id=customers.customer_id";
                                                        $query = mysqli_query($con, $sql);
                                                        $fetch = mysqli_fetch_assoc($query);
                                                        $customer_subscription_id = $fetch['customer_subscription_id'];
                                                        $customer_name = $fetch['customer_name'];
                                                        $delivery_address = $fetch['delivery_address'];

                                                        $select = "SELECT sum(product_total_price) FROM subscription_products where customer_subscription_id='$customer_subscription_id'";
                                                        $action = mysqli_query($con, $select);
                                                        while ($record = mysqli_fetch_array($action)) {
                                                            $total_amount = $record['sum(product_total_price)'];
                                                        }
                                                        $sql = "SELECT * from customer_subscription_payments where customer_subscription_id='$customer_subscription_id'";
                                                        $query = mysqli_query($con, $sql);
                                                        $fetch =  mysqli_fetch_assoc($query);
                                                        $payment_mode = $fetch['payment_mode'];

                                                        $sql = "SELECT * from subscription_deliveries";
                                                        $query = mysqli_query($con, $sql);
                                                        while ($fetch = mysqli_fetch_assoc($query)) {
                                                            $subscription = $fetch['customer_subscription_id'];
                                                            $delivery_status = $fetch['delivery_status'];
                                                            $delivery_date = $fetch['delivery_date'];


                                                            if ($subscription == $customer_subscription_id and $delivery_status == "DELIVERED") {
                                                                $del_status = "DELIVERED!";
                                                            } else {
                                                                $del_status = "UN Delivered!";
                                                            }
                                                        }
                                                        echo "
            <tr>
                <td><a href='delivered_order.php?id=$customer_subscription_id'>$customer_subscription_id</a></td>
                <td>$customer_name</td>
                <td>Rs.$total_amount / $payment_mode</td>
                <td>$del_status</td>
            </tr>
          ";
                                                    }
                                                }
                                                ?>

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