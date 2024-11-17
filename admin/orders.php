<?php
require 'files.php';
require 'session.php';

if (isset($_GET['start'])) {
  $start = $_GET['start'];
  $end = $_GET['end'];
} else {
  $start = 0;
  $end = 50;
}
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
                <h4 class="users-action mb-0"><i class="fa fa-shopping-cart text-info"></i> ALL Orders <i class="fa fa-angle-right"></i>
                  <?php if (isset($_GET['type'])) {
                    echo "Order Type : <b>" . $_GET['type'] . "</b>";
                  } else {
                    echo "Delivered Orders";
                  }
                  ?>
                </h4>
                <hr>
                <p>Search Order by Filters</p>
                <form action="" method="GET">
                  <div class="row pt-0">
                    <div class="col-lg-3 col-md-3 col-12">
                      <div class="form-group">
                        <label>Order Cities</label>
                        <select class="form-control d-input" name="city">
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
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                      <div class="form-group">
                        <label for="">Order Areas</label>
                        <select class="form-control d-input" name="area_locality">
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
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                      <div class="form-group">
                        <label for="">Ordered Mode</label>
                        <select class="form-control d-input" name="order_type">
                          <option value="ALL_ORDERS">ALL ORDER</option>
                          <option value="ONLINE">ONLINE</option>
                          <option value="OFFLINE">OFFLINE</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                      <div class="form-group">
                        <label for="">Payment Mode</label>
                        <select class="form-control d-input" name="payment_mode">
                          <option value="ALL_MODES">ALL MODES</option>
                          <option value="CASH_PAYMENT">Cash Payment</option>
                          <option value="WALLET">Wallet</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                      <div class="form-group">
                        <label for="">Reward Points</label>
                        <select class="form-control d-input" name="coupon_code">
                          <option value="ALL_ORDERS">ALL ORDERS</option>
                          <option value="REWARD_POINTS">REWARD POINTS</option>
                          <option value="Not Available">Without Reward Points</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                      <div class="form-group">
                        <label for="">Order Date</label>
                        <select class="form-control d-input" name="order_date">
                          <option value="ALL_DATES">ALL DATES</option>
                          <?php
                          $startf = 1;
                          while ($startf <= 31) {
                            echo "<option value='$startf'>$startf</option>";
                            $startf++;
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                      <div class="form-group">
                        <label for="">Order Months</label>
                        <select class="form-control d-input" name="order_month">
                          <option value="ALL_MONTHS">ALL MONTHS</option>
                          <?php
                          $startf = 1;
                          while ($startf <= 12) {
                            echo "<option value='$startf'>" . date('F', mktime(0, 0, 0, $startf, 10)) . "</option>";
                            $startf++;
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                      <div class="form-group">
                        <label for="">Order Years</label>
                        <select class="form-control d-input" name="order_year">
                          <option value="ALL_YEARS">ALL YEARS</option>
                          <?php
                          $startf = 2020;
                          while ($startf <= 2025) {
                            echo "<option value='$startf'>$startf</option>";
                            $startf++;
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                      <div class="form-group">
                        <label for="">Order Status</label>
                        <select class="form-control d-input" name="order_status">
                          <option value="ALL_ORDERS">ALL Orders</option>
                          <option value="NEW_ORDER">Fresh Orders</option>
                          <option value="ACCEPTED">Accepted Orders</option>
                          <option value="OUT_FOR_DELIVERY">Out for Delivery</option>
                          <option value="DELIVERED">Delivered Orders</option>
                          <option value="UNDELIVERED">Undelivered Orders</option>
                          <option value="CANCELLED">Cancelled Orders</option>
                          <option value="REJECTED">Rejected Orders</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-12">
                      <div class="form-group">
                        <label>&nbsp;</label>
                        <button class="btn btn-sm btn-primary form-control text-white" name="SEARCH_APPLY" value="true">
                          APPLY</button>
                      </div>
                    </div>
                  </div>
                </form>
                <?php
                if (isset($_GET['SEARCH_APPLY'])) { ?>
                  <p><b>Search Applied <i class="fa fa-angle-right"></i></b>
                    <span class="btn btn-outlin<?php if (!isset($_GET['SEARCH_APPLY'])) { ?>">
                      <div class="col-lg-9 col-md-9 col-12">
                        <form action='export_order.php' method="GET" target="_blank" class="float-right">
                          <input type="text" name="area_locality" value="ALL_AREA_LOCALITY" hidden="">
                          <input type="text" name="order_type" value="ALL_ORDERS" hidden="">
                          <input type="text" name="payment_mode" value="ALL_MODES" hidden="">
                          <input type="text" name="coupon_code" value="ALL_ORDERS" hidden="">
                          <input type="text" name="order_date" value="ALL_DATES" hidden="">
                          <input type="text" name="order_year" value="ALL_YEARS" hidden="">
                          <input type="text" name="order_month" value="ALL_MONTHS" hidden="">
                          <input type="text" name="city" value="ALL_CITY" hidden="">

                          <button type="Submit" name="EXPORTS_ORDERS" class="btn btn-md btn-success" value="true">
                            <i class="fa fa-file-pdf-o"></i>
                            Exports Orders</button>
                        </form>
                      </div>
                      <?php } ?>e-primary btn-sm"><b>CITY : </b>
                      <?php echo $_GET['city']; ?>,
                    </span>
                    <span class="btn btn-outline-primary btn-sm"><b>AREA : </b>
                      <?php echo $_GET['area_locality']; ?>,</span>
                    <span class="btn btn-outline-primary btn-sm"><b>Order MODE : </b>
                      <?php echo $_GET['order_type']; ?>,</span>
                    <span class="btn btn-outline-primary btn-sm"><b>Payment Mode : </b>
                      <?php echo $_GET['payment_mode']; ?>,</span>
                    <span class="btn btn-outline-primary btn-sm"><b>Rewards : </b>
                      <?php echo $_GET['coupon_code']; ?>,</span>
                    <span class="btn btn-outline-primary btn-sm"><b>Order Date: </b>
                      <?php echo $_GET['order_date']; ?>,</span>
                    <span class="btn btn-outline-primary btn-sm"><b>Order Month: </b>
                      <?php echo $_GET['order_month']; ?>,</span>
                    <span class="btn btn-outline-primary btn-sm"><b>Order Year :</b>
                      <?php echo $_GET['order_year']; ?></span>
                    <span class="btn btn-outline-primary btn-sm"><b>Order Status :</b>
                      <?php echo $_GET['order_status']; ?></span>

                    <span class="btn btn-danger">

                      <a href="orders.php" class="text-white float-right"> Clear Search <i class="fa fa-times"></i></a></span>
                  </p>
                  <form action='export_order.php' method="GET" target="_blank">
                    <input type="text" name="area_locality" value="<?php echo $_GET['area_locality']; ?>" hidden="">
                    <input type="text" name="order_type" value="<?php echo $_GET['order_type']; ?>" hidden="">
                    <input type="text" name="payment_mode" value="<?php echo $_GET['payment_mode']; ?>" hidden="">
                    <input type="text" name="coupon_code" value="<?php echo $_GET['coupon_code']; ?>" hidden="">
                    <input type="text" name="order_date" value="<?php echo $_GET['order_date']; ?>" hidden="">
                    <input type="text" name="order_year" value="<?php echo $_GET['order_year']; ?>" hidden="">
                    <input type="text" name="order_month" value="<?php echo $_GET['order_month']; ?>" hidden="">
                    <input type="text" name="city" value="<?php echo $_GET['city']; ?>" hidden="">
                    <input type="text" name="order_status" value="<?php echo $_GET['order_status']; ?>" hidden="">

                    <button type="submit" name="EXPORTS_ORDERS" class="btn btn-md btn-success">
                      <i class="fa fa-file-pdf-o"></i>
                      Exports Orders</button>
                  </form>
                <?php } ?>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <!-- datatable start -->
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th style="padding: 1%; font-size: 12px;">ORDER ID</th>
                          <th style="padding: 1%; font-size: 12px;">Customer Name</th>
                          <th style="padding: 1%; font-size: 12px;">Payment Mode</th>
                          <th style="padding: 1%; font-size: 12px;">Rewards Points</th>
                          <th class="text-center" style="padding: 1%; font-size: 12px;">
                            Order Amount</th>
                          <th class="hidden-xs" style="padding: 1%; font-size: 12px;">
                            Payment</th>
                          <th style="padding: 1%; font-size: 12px;">ORDER Date</th>
                          <th style="padding: 1%; font-size: 12px;">Status</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        $user_id = $_SESSION['user_id'];
                        $sql = "SELECT * from stores where user_id='$user_id'";
                        $query = mysqli_query($con, $sql);
                        $fetch = mysqli_fetch_assoc($query);
                        $store_id = $fetch['store_id'];
                        $store_phone = $fetch['store_phone'];
                        $store_mail_id = $fetch['store_mail_id'];
                        $store_name = $fetch['store_name'];

                        if (isset($_GET['SEARCH_APPLY'])) {
                          $order_type = $_GET['order_type'];
                          $city = $_GET['city'];
                          $area_locality = $_GET['area_locality'];
                          $payment_mode = $_GET['payment_mode'];
                          $coupon_code = $_GET['coupon_code'];
                          $order_date = $_GET['order_date'];
                          $order_month = $_GET['order_month'];
                          $order_year = $_GET['order_year'];
                          if ($city == "ALL_CITY" and $order_type == "ALL_ORDERS" and $area_locality == "ALL_AREA_LOCALITY" and $payment_mode == "ALL_MODES" and $coupon_code == "ALL_ORDERS" and $order_date == "ALL_DATES" and $order_month == "ALL_MONTHS" and $order_year == "ALL_YEARS" and $_GET['order_status'] == "ALL_ORDERS") {
                            $sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id ORDER BY customer_order_id DESC limit $start, $end";
                          } else {
                            $order_type = $_GET['order_type'];
                            $city = $_GET['city'];
                            $area_locality = $_GET['area_locality'];
                            $payment_mode = $_GET['payment_mode'];
                            $coupon_code = $_GET['coupon_code'];
                            $order_date = $_GET['order_date'];
                            $order_month = $_GET['order_month'];
                            $order_year = $_GET['order_year'];
                            $order_status = $_GET['order_status'];

                            if ($order_type == "ALL_ORDERS") {
                              $order_type = "";
                            }
                            if ($city == "ALL_CITY") {
                              $city = "";
                            }
                            if ($area_locality == "ALL_AREA_LOCALITY") {
                              $area_locality = "";
                            }
                            if ($payment_mode == "ALL_MODES") {
                              $payment_mode = "";
                            }
                            if ($coupon_code == "ALL_ORDERS") {
                              $coupon_code = "";
                            }
                            if ($order_date == "ALL_DATES") {
                              $order_date = "";
                            }
                            if ($order_month == "ALL_MONTHS") {
                              $order_month = "";
                            }
                            if ($order_year == "ALL_YEARS") {
                              $order_year = "";
                            }
                            if ($order_status == "ALL_ORDERS") {
                              $order_status = "";
                            }
                            $sql = "SELECT * FROM customer_orders, customers where customers.customer_id=customer_orders.customer_id and customer_orders.order_status LIKE '%$order_status%' and customer_orders.delivery_address LIKE '%$city%' and customer_orders.delivery_address LIKE '%$area_locality%' and customer_orders.payment_mode LIKE '%$payment_mode%' and customer_orders.coupon_code LIKE '%$coupon_code%' and customer_orders.order_day LIKE '%$order_date%' and customer_orders.order_month LIKE '%$order_month%' and customer_orders.order_year LIKE '%$order_year%' and customer_orders.order_type LIKE '%$order_type%' ORDER BY customer_order_id DESC limit $start, $end";
                          }
                        } else {

                          if (isset($_GET['type'])) {
                            $type = $_GET['type'];
                            $sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id and customer_orders.order_status='$type' ORDER BY customer_order_id DESC limit $start, $end";
                          } else {
                            $sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id and customer_orders.order_status='DELIVERED' ORDER BY customer_order_id DESC limit $start, $end";
                          }
                        }
                        $query = mysqli_query($con, $sql);
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
                                <a href="<?php echo $MDomain; ?>/invoice.php?id=<?php echo $fetch['order_id']; ?>" class='text-info' style="padding: 1%; font-size: 12px;" target="blank"><?php echo $fetch['order_id']; ?></a>

                              </td>
                              <td style="padding: 1%; font-size: 12px;">
                                <a href="cust_details.php?customer_id=<?php echo $fetch['customer_id']; ?>"> <i class="fa fa-user"></i>
                                  <?php echo $fetch['customer_name']; ?></a>
                              </td>
                              <td style="padding: 1%; font-size: 12px;">
                                <?php echo $fetch['payment_mode']; ?></td>
                              <td style="padding: 1%; font-size: 12px;">
                                <?php echo $fetch['coupon_code']; ?></td>
                              <td style="padding: 1%; font-size: 12px;" class="text-center">
                                Rs.<?php echo $fetch['net_payable_amount']; ?></td>
                              <td style="padding: 1%; font-size: 12px;" class="text-success">
                                <?php echo $fetch['payment_status']; ?>
                              <td style="padding: 1%; font-size: 12px;" class="hidden-xs">
                                <?php echo $fetch['order_date']; ?></td>
                              <td style="padding: 1%; font-size: 12px;">
                                <?php echo $fetch['order_status']; ?>
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