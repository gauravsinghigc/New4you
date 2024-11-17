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
        <h4 class="users-action mb-0">Print Bills <i class="fa fa-angle-right"></i>
         <span> Delivery On : <?php echo date("D d M, Y", strtotime("+1 days")); ?></span><br>
         <hr>
        </h4>

        <form action="export_bills.php" method="GET" target="_blank">
         <div class="row pt-0">
          <div class="col-lg-2 col-md-2 col-12 mb-1">
           <select class="form-control" name="city">
            <option value="ALL_CITY">ALL CITIES</option>
            <?php
                        $sql = "SELECT * FROM city";
                        $query = mysqli_query($con, $sql);
                        while ($fetch = mysqli_fetch_assoc($query)) {
                          $area_locality = $fetch['city_name'];
                          $city_id = $fetch['city_id'];
                          echo "<option value='$area_locality'>$area_locality</option>";
                        }
                        ?>
           </select>
          </div>
          <div class="col-lg-2 col-md-2 col-12 mb-1">
           <select class="form-control" name="area_locality">
            <option value="ALL_AREA_LOCALITY">ALL AREAS</option>
            <?php
                        $sql = "SELECT * FROM services_area";
                        $query = mysqli_query($con, $sql);
                        while ($fetch = mysqli_fetch_assoc($query)) {
                          $area_locality = $fetch['area_locality'];
                          echo "<option value='$area_locality'>$area_locality</option>";
                        }
                        ?>
           </select>
          </div>
          <div class="col-lg-2 col-md-2 col-12 mb-1">
           <select class="form-control" name="order_type">
            <option value="ALL_ORDERS">ALL ORDER</option>
            <option value="ONLINE">ONLINE</option>
            <option value="OFFLINE">OFFLINE</option>
           </select>
          </div>
          <div class="col-lg-2 col-md-2 col-12 mb-1">
           <select class="form-control" name="delivery_slot">
            <option value="ALL_SLOTS">ALL SLOTS</option>
            <option value="MORNING">MORNING</option>
            <option value="EVENING">EVENING</option>
           </select>
          </div>
          <div class="col-lg-2 col-md-2 col-12 mb-1">
           <button class="btn btn-md btn-primary text-white form-control" name="export_orders" value="true"><i
             class="fa fa-file-pdf-o"></i> Export Bills</button>
          </div>
         </div>
        </form>

       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table table-striped dom-jQuery-events">
           <thead>
            <tr>
             <th>ORDER ID</th>
             <th>Customer Name</th>
             <th>Order Amount</th>
             <th>Payment Status</th>
             <th>ORDER Date</th>
             <th>Delivery Slot</th>
             <th>Action</th>
            </tr>
           </thead>

           <tbody>
            <?php
                        $user_role = $_SESSION['user_role'];

                        if ($user_role == "SUPER_ADMIN") {
                          $sql = "SELECT * FROM customer_orders, customers where customers.customer_id=customer_orders.customer_id and customer_orders.order_status='NEW_ORDER' and customer_orders.DELIVERY_TYPE='STORE_PICKUP' or customer_orders.DELIVERY_TYPE='DELIVERY'";
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
                                                        <td colspan='8'><h3><i class='fa fa-warning'></i><br></h3><h3>No Orders.</h3>
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
             <td style="padding: 1%; font-size: 12px;" class="text-center">
              Rs.<?php echo $fetch['net_payable_amount']; ?>
             </td>
             <td style="padding: 1%; font-size: 12px;" class="text-success"><?php echo $fetch['payment_status']; ?>
             <td style="padding: 1%; font-size: 12px;" class="hidden-xs"><?php echo $fetch['order_date']; ?></td>
             <td style="padding: 1%; font-size: 12px;" class="hidden-xs">
              <?php echo $fetch['PICK_SCHEDULE_TIME']; ?></td>
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
              <a href="pickup_deliver.php?id=<?php echo $order_id; ?>" class='btn btn-info btn-md'
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
              <a href="update.php?delivery_out=<?php echo $order_id; ?>&store_id=<?php echo $store_id; ?>&sms="
               class='btn btn-primary btn-sm'>
               Out For Delivery
              </a>
              <?php } elseif ($order_status == "OUT_FOR_DELIVERY") { ?>
              <a href="pickup_deliver.php?id=<?php echo $order_id; ?>" class='btn btn-warning btn-sm'>
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

</body>
<!-- END: Body-->

</html>