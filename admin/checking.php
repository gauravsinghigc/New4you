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
 <meta name="author" content="24kharido.in">
 <meta http-equiv="refresh" content="5, checking.php" />
 <title>Checking Fresh Orders : <?php echo $PosName; ?></title>
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
       <div class="card-content">
        <div class="card-body d-block mx-auto">
         <center>
          <img src="img/lsb-loading.gif" class="d-block mx-auto">
          <h3>Checking For New Orders</h3>

          <hr style="width: 50%;">
          <?php
										$sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id and customer_orders.order_status='NEW_ORDER' ORDER BY customer_orders.customer_order_id DESC";
										$query = mysqli_query($con, $sql);
										$count = mysqli_num_rows($query);
										if ($count == 0) {
											echo "
                                               <img src='img/GrimyPlainKakarikis-size_restricted.gif' style='width:5%;'>
                                              <h2>No New Order Found!</h2>
                                              <p>Please Open This Page in Background for Checking Live Orders...<br>
                                              For Continue Processing, Open Dashboard in New Tab.</p>
                                              <a href='index.php' target='blank' class='btn btn-success btn-lg'>Open Dashboard</a>";
										} else {
											echo "<h2><b><span class='text-danger'>$count</span></b> New Order found</h2>";
										}
										?>
         </center>
         <br><br>
         <!-- datatable start -->
         <?php if ($count != 0) { ?>
         <div class="table-responsive">
          <table id="users-list-datatable" class="table">
           <thead>
            <tr>
             <th style="padding: 1%; font-size: 12px;">ORDER ID</th>
             <th style="padding: 1%; font-size: 12px;">Customer Name</th>
             <th style="padding: 1%; font-size: 12px;">Order Amount</th>
             <th style="padding: 1%; font-size: 12px;">Payment Status</th>
             <th style="padding: 1%; font-size: 12px;">ORDER Date</th>
             <th style="padding: 1%; font-size: 12px;">Delivery Slot</th>
             <th style="padding: 1%; font-size: 12px;">Action</th>
            </tr>
           </thead>

           <tbody>
            <?php
													$user_role = $_SESSION['user_role'];

													if ($user_role == "SUPER_ADMIN") {
														$sql = "SELECT * FROM customer_orders, customers where customers.customer_id=customer_orders.customer_id and customer_orders.order_status='NEW_ORDER' and customer_orders.DELIVERY_TYPE='STORE_PICKUP' or customer_orders.DELIVERY_TYPE='DELIVERY' ORDER BY customer_orders.customer_order_id DESC";
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
															$sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id and customer_orders.order_status='$order_type' ORDER BY customer_orders.customer_order_id DESC";
															$query = mysqli_query($con, $sql);
														} elseif (!isset($_GET['order_type'])) {

															$sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id and customer_orders.order_status='NEW_ORDER' ORDER BY customer_orders.customer_order_id DESC";
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
															$order_id = $fetch['order_id'];
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
                style="padding: 1%; font-size: 12px;"><?php echo $fetch['order_id']; ?></a>
              </h4>
             </td>
             <td style="padding: 1%; font-size: 12px;">
              <?php echo $fetch['customer_name']; ?></td>
             <td style="padding: 1%; font-size: 12px;" class="text-center">
              Rs.<?php echo $fetch['net_payable_amount']; ?>
             </td>
             <td style="padding: 1%; font-size: 12px;" class="text-success">
              <?php echo $fetch['payment_status']; ?>
             <td style="padding: 1%; font-size: 12px;" class="hidden-xs">
              <?php echo $fetch['order_date']; ?></td>
             <td style="padding: 1%; font-size: 12px;" class="hidden-xs">
              <?php echo $fetch['PICK_SCHEDULE_TIME']; ?></td>
             <td style="padding: 1%; font-size: 12px;width: 130px;">

              <?php if ($DELIVERY_TYPE == "STORE_PICKUP") { ?>
              <?php if ($order_status == "NEW_ORDER") { ?>
              <a
               href="update.php?accept_id=<?php echo $order_id; ?>&store_id=<?php echo $store_id; ?>&cr_url=<?php echo get_url(); ?>"
               class='btn btn-info btn-sm float-left'>
               Accept
              </a>
              <a
               href="update.php?reject_id=<?php echo $order_id; ?>&store_id=<?php echo $store_id; ?>&sms=&s_p=&s_m=&cr_url=<?php echo get_url(); ?>"
               class='btn btn-danger btn-sm float-right'>
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
              <a
               href="update.php?accept_id=<?php echo $order_id; ?>&store_id=<?php echo $store_id; ?>&cr_url=<?php echo get_url(); ?>"
               class='btn btn-info btn-sm float-left'>
               Accept
              </a>
              <a
               href="update.php?reject_id=<?php echo $order_id; ?>&store_id=<?php echo $store_id; ?>&sms=&s_p=&s_m=&cr_url=<?php echo get_url(); ?>"
               class='btn btn-danger btn-sm float-right'>
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
              <?php } elseif ($order_status == "REJECTED") { ?>
              <span class="text-danger">Rejected</span>
              <a href="update.php?accept_id=<?php echo $order_id; ?>&store_id=<?php echo $store_id; ?>"
               class='btn btn-info btn-sm float-right'>
               Re-Accept
              </a>
              <?php }
																	} ?>
             </td>
            </tr>
            <?php }
													} ?>
            <tr>
             <td colspan="2" align="right"><b>Total Order Amount</b></td>
             <td align="center">
              <h4>Rs.<?php
																						$select = "SELECT sum(net_payable_amount) FROM customer_orders where payment_status='Not Paid' and order_status='NEW_ORDER'";
																						$action = mysqli_query($con, $select);
																						while ($record = mysqli_fetch_array($action)) {
																							$total_amount = $record['sum(net_payable_amount)'];

																							if ($total_amount == 0) {
																								echo "0";
																							} else {
																								echo $total_amount;
																							}
																						}
																						?></h4>
             </td>
             <td colspan="4"></td>
            </tr>
           </tbody>
          </table>
          <center>
           <img src='img/GrimyPlainKakarikis-size_restricted.gif' style='width:5%;'>
           <p>Please Open This Page in Background for Checking Live Orders...<br>
            For Continue Processing, Open Dashboard in New Tab.</p>
           <a href='index.php' target='blank' class='btn btn-success btn-lg'>Open Dashboard</a>
          </center>



         </div>
         <!-- datatable ends -->
         <?php } ?>

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