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

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

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
                <h4 class="users-action">ALL Orders <i class="fa fa-angle-right"></i></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="reload"><i class="fa fa-refresh"></i></a></li>
                    <li><a data-action="expand"><i class="fa fa-expand"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <!-- datatable start -->
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="padding: 1%; font-size: 12px;">ORDER ID</th>
                          <th style="padding: 1%; font-size: 12px;">Customer Name</th>
                          <th style="padding: 1%; font-size: 12px;">Payment Mode</th>
                          <th style="padding: 1%; font-size: 12px;">Coupon Code</th>
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
                          $sql = "SELECT * FROM customer_orders, customers where customers.customer_id=customer_orders.customer_id";
                          $query = mysqli_query($con, $sql);
                        } elseif ($user_role == "STORE_USER") {


                          $user_id = $_SESSION['user_id'];
                          $sql = "SELECT * FROM users where user_id='$user_id'";
                          $query = mysqli_query($con, $sql);
                          $fetch = mysqli_fetch_assoc($query);
                          $ref_id = $fetch['ref'];

                          $sql = "SELECT * FROM stores where user_id ='$ref_id'";
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

                            $sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id and customer_orders.order_status='DELIVERED'";
                            die($sql);
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

                            if ($payment_mode == "Online Payment") {
                              $p_s = "";
                            } elseif ($payment_mode == "Cash On Delivery") {
                              $p_s = "p_s=Paid";
                            } ?>
                            <tr>
                              <td style="padding: 1%; font-size: 12px;">
                                <h4><a href="invoice.php?id=<?php echo $fetch['order_id']; ?>" class='text-info' style="padding: 1%; font-size: 12px;"><?php echo $fetch['order_id']; ?></a></h4>
                              </td>
                              <td style="padding: 1%; font-size: 12px;"><?php echo $fetch['customer_name']; ?></td>
                              <td style="padding: 1%; font-size: 12px;"><?php echo $fetch['payment_mode']; ?></td>
                              <td style="padding: 1%; font-size: 12px;"><?php echo $fetch['coupon_code']; ?></td>
                              <td style="padding: 1%; font-size: 12px;" class="text-center">Rs.<?php echo $fetch['net_payable_amount']; ?>
                              </td>
                              <td style="padding: 1%; font-size: 12px;" class="text-success"><?php echo $fetch['payment_status']; ?>
                              <td style="padding: 1%; font-size: 12px;" class="hidden-xs"><?php echo $fetch['order_date']; ?></td>
                              <td style="padding: 1%; font-size: 12px;">
                                DELIVERED
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