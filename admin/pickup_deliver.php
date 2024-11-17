<?php
require 'files.php';
require 'session.php';
mysqli_set_charset($con, 'utf8');
if (isset($_GET['id'])) {
  $ORDERID = $_GET['id'];
  $_SESSION['viewOrderId'] = $_GET['id'];
} elseif (isset($_GET['phone'])) {
  $phone = $_GET['phone'];
  $sql = "SELECT * from customers where customer_phone_number='$phone'";
  $query = mysqli_query($con, $sql);
  $fetch =  mysqli_fetch_assoc($query);
  $customer_id = $fetch['customer_id'];
  $sql = "SELECT * FROM customer_orders where customer_id='$customer_id' and order_status='NEW_ORDER'";
  $query = mysqli_query($con, $sql);
  $fetch =  mysqli_fetch_assoc($query);
  $ORDERID = $fetch['order_id'];
  $_SESSION['viewOrderId'] = $ORDERID;
} else {
  $ORDERID = $_SESSION['viewOrderId'];
  $_GET['id'] = $ORDERID;
}
$sql = "SELECT * FROM customer_orders where order_id='$ORDERID'";
$query = mysqli_query($con, $sql);
$FetchUserDetails = mysqli_fetch_assoc($query);
$delivery_address = $FetchUserDetails['delivery_address'];
$billing_address = $FetchUserDetails['billing_address'];
$payment_mode = $FetchUserDetails['payment_mode'];
$payment_note = $FetchUserDetails['payment_note'];
$coupon_code = $FetchUserDetails['coupon_code'];
$net_payable_amount = $FetchUserDetails['net_payable_amount'];
$payment_status = $FetchUserDetails['payment_status'];
$delivery_status = $FetchUserDetails['delivery_status'];
$delivery_date = $FetchUserDetails['delivery_date'];
$order_status = $FetchUserDetails['order_status'];
$order_date = $FetchUserDetails['order_date'];
$total_amount = $FetchUserDetails['total_amount'];
$total_amount_after_discount = $FetchUserDetails['total_amount_after_discount'];
$amount_after_discount = $FetchUserDetails['total_amount_after_discount'];
$delivery_charge = $FetchUserDetails['delivery_charge'];
$store_id = $FetchUserDetails['store_id'];
$customer_id = $FetchUserDetails['customer_id'];
$delivery_charge = $FetchUserDetails['delivery_charge'];
$DELIVERY_TYPE = $FetchUserDetails['DELIVERY_TYPE'];
$rewardspoints = $FetchUserDetails['rewardspoints'];
$rewardsamount = $FetchUserDetails['rewardsamount'];
$order_type = $FetchUserDetails['order_type'];

$order_status = str_replace('_', ' ', $order_status);
$payment_mode = str_replace('_', ' ', $payment_mode);
$payment_status = str_replace('_', ' ', $payment_status);
$delivery_status = str_replace('_', ' ', $delivery_status);
$coupon_code = str_replace('_', ' ', $coupon_code);
if ($delivery_charge == 0 or $delivery_charge == " " or $delivery_charge == null) {
  $delivery_charge = 0;
} else {
  $delivery_charge = $delivery_charge;
}

$select_store = "SELECT * FROM stores where store_id='$store_id'";
$store_query = mysqli_query($con, $select_store);
$fetch_store = mysqli_fetch_assoc($store_query);
$store_id = $fetch_store['store_id'];
$store_name = $fetch_store['store_name'];
$store_phone = $fetch_store['store_phone'];
$store_mail_id = $fetch_store['store_mail_id'];
$store_address = $fetch_store['store_address'];
$store_arealocality = $fetch_store['store_arealocality'];
$store_city = $fetch_store['store_city'];
$store_state = $fetch_store['store_state'];
$store_pincode = $fetch_store['store_pincode'];
$GST = $fetch_store['GST'];
$PAN = $fetch_store['PAN'];
$sql = "SELECT * from customers where customer_id='$customer_id'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$customer_id = $fetch['customer_id'];
$customer_name = $fetch['customer_name'];
$customer_mail_id = $fetch['customer_mail_id'];
$customer_phone_number = $fetch['customer_phone_number'];
$custaddress = $fetch['custaddress'];
$custcity = $fetch['custcity'];
$custstate = $fetch['custstate'];
$custpincode = $fetch['custpincode'];
$arealocality = $fetch['arealocality'];


?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="<?php echo $PosName; ?>">
  <title>Orders Payments : <?php echo $PosName; ?></title>
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

      <div class="content-body">
        <!-- users list start -->
        <section class="users-list-wrapper">
          <div class="users-list-table">
            <div class="card">
              <div class="card-header">
                <h6 class="users-action mobile-font-size pl-0 ml-0"><b><i class="fa fa-shopping-cart text-primary"></i> ORDERID
                    :</b> <?php echo $ORDERID; ?> <i class="fa fa-angle-right"></i> Order On <?php echo $order_date; ?> <i class="fa fa-angle-right"></i>
                </h6>
                <hr>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <?php if ($DELIVERY_TYPE == "STORE_PICKUP") { ?>
                      <?php if ($order_status == "NEW_ORDER") { ?>
                        <a href="update.php?accept_id=<?php echo $_GET['id']; ?>&store_id=<?php echo $store_id; ?>&cr_url=<?php echo get_url(); ?>" class='btn btn-info btn-sm float-left'>
                          Accept
                        </a>
                        <a href="update.php?reject_id=<?php echo $_GET['id']; ?>&store_id=<?php echo $store_id; ?>&sms=&s_p=&s_m=&cr_url=<?php echo get_url(); ?>" class='btn btn-warning btn-sm float-right'>
                          Reject
                        </a>
                      <?php } elseif ($order_status == "ACCEPTED") { ?>
                        <a href="pickup_deliver.php?id=<?php echo $_GET['id']; ?>" class='btn btn-info btn-md' style="padding: 1%; font-size: 12px;" class='btn btn-primary btn-sm'>
                          View Order
                        </a>
                      <?php }
                    } else { ?>
                      <?php if ($order_status == "NEW_ORDER") { ?>
                        <a href="update.php?accept_id=<?php echo $_GET['id']; ?>&store_id=<?php echo $store_id; ?>" class='btn btn-info btn-sm float-left'>
                          Accept
                        </a>
                        <a href="update.php?reject_id=<?php echo $_GET['id']; ?>&store_id=<?php echo $store_id; ?>&sms=&s_p=&s_m=" class='btn btn-warning btn-sm float-right'>
                          Reject
                        </a>
                      <?php } elseif ($order_status == "ACCEPTED") { ?>
                        <a href="update.php?delivery_out=<?php echo $_GET['id']; ?>&store_id=<?php echo $store_id; ?>&sms=" class='btn btn-primary btn-sm'>
                          Out For Delivery
                        </a>
                      <?php } elseif ($order_status == "OUT_FOR_DELIVERY") { ?>
                        <a href="pickup_deliver.php?id=<?php echo $_GET['id']; ?>" class='btn btn-warning btn-sm'>
                          Delivered?
                        </a>
                      <?php } elseif ($order_status == "REJECTED") { ?>
                        <span class="text-danger">Rejected</span>&nbsp;
                        <a href="update.php?accept_id=<?php echo $_GET['id']; ?>&store_id=<?php echo $store_id; ?>" class='btn btn-info btn-sm float-right'>
                          Re-Accept
                        </a>
                    <?php }
                    } ?>
                  </ul>
                </div>
              </div>
              <br>
              <div class="card-content">
                <div class="card-body" style="margin-top: -46px;">
                  <div class="row">
                    <div class="col-lg-6 col-6">
                      <h6 style="font-size: 1vw;"><b>Customer Information:</b></h6>
                      <p class="mobile-font-size font-small-5"><b><i class="fa fa-user" style="width: 13px;"></i></b> <a href="cust_details.php?customer_id=<?php echo $customer_id; ?>"><b><?php echo $customer_name; ?></b></a><br>
                        <b><a href="mailto:<?php echo $customer_mail_id; ?>"><i class="fa fa-envelope" style="width: 13px;"></i>
                        </b> <?php echo $customer_mail_id; ?></a><br>
                        <b><a href="tel:<?php echo $customer_phone_number; ?>"><i class="fa fa-phone" style="width: 13px;"></i> </b>
                        <?php echo $customer_phone_number; ?></a><br>
                        <b><i class="fa fa-map-marker" style="width: 13px;"></i> Delivery/Shipping Address </b><br>
                        <?php echo html_entity_decode($delivery_address); ?> <br>
                        <b><i class="fa fa-map-marker" style="width: 13px;"></i> Billing Address </b><br>
                        <?php echo html_entity_decode($billing_address); ?> <br>
                        <a href='https://google.com/maps/search/<?php echo $arealocality; ?> <?php echo $custcity; ?> <?php echo $custstate; ?>' class='btn btn-info btn-sm m-1' target="blank"><i class='fa fa-search'></i> Search in Maps</a>
                        <a href='https://www.google.com/maps/dir/<?php echo $delivery_address; ?>/<?php echo $store_address; ?> <?php echo $store_arealocality; ?> <?php echo $store_city; ?> <?php echo $store_state; ?> <?php echo $store_pincode; ?>/' class='btn btn-info btn-sm m-1' target="blank"><i class='fa fa-map-marker'></i> Check Distance</a>
                      </p>
                    </div>
                    <div class="col-lg-6 col-6 text-right">
                      <h6 class="mobile-font-size"><b>Store Information:</b></h6>
                      <p class="mobile-font-size font-small-5"><?php echo $store_name; ?><br>
                        <?php echo $store_phone; ?><br>
                        <?php echo $store_mail_id; ?><br>
                        <?php echo $store_address; ?> <?php echo $store_arealocality; ?> <?php echo $store_city; ?>
                        <?php echo $store_state; ?> <?php echo $store_pincode; ?><br>
                        <b>GST :</b> <?php echo $GST; ?><br>
                        <b>PAN :</b> <?php echo $PAN; ?>
                      </p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <div class="">
                        <table class="table cart_summary" style="font-size: 12px;">
                          <thead>
                            <tr>
                              <th style="padding: 1%; font-size: 12px;width:30%;">Item Name</th>
                              <th style="padding: 1%; font-size: 12px;" class="text-right">Market Price</th>
                              <th style="padding: 1%; font-size: 12px;" class="text-right">Offer price</th>
                              <th style="padding: 1%; font-size: 12px;" class="text-right">Qty</th>
                              <th style="padding: 1%; font-size: 12px;" class="text-right">Total</th>
                              <th style="padding: 1%; font-size: 12px;" class="text-right">Taxes</th>
                              <th style="padding: 1%; font-size: 12px;" class="text-right">Net Price</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            mysqli_set_charset($con, 'utf8');
                            $sql = "SELECT * FROM ordered_products where order_id='$ORDERID'";
                            $query = mysqli_query($con, $sql);
                            $productgstamountforsingleitem2 = 0;
                            while ($fetch = mysqli_fetch_assoc($query)) {
                              $user_product_id_value = $fetch['product_names'];
                              $product_price = $fetch['product_price'];
                              $product_quantity = $fetch['product_qty'];
                              $product_total_amount = $fetch['product_total_price'];
                              $product_mrp = $fetch['product_mrp'];
                              $product_tags = $fetch['product_tags'];
                              $hindi_name = $fetch['hindi_name'];
                              $product_qty = $fetch['product_qty'];
                              $product_HSN = $fetch['product_HSN'];
                              $product_taxes = $fetch['product_taxes'];
                              $product_net_prices = $fetch['product_net_prices'];
                              $product_units = "$product_tags";
                              $letters = preg_replace('/[0-9]/', '', "$product_tags");
                              $numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
                              $Quantity = $product_qty / $numbers;
                              $Quantity = $product_qty / $numbers;
                              $ProductTaxAmount = round($product_total_amount / 100 * $product_taxes, 2);
                              $productgstamountforsingleitem2 += (int)$product_total_amount;
                              $ProducttaxPeritem = $ProductTaxAmount / $product_qty;
                              $ProductRealPrice = $product_price - $ProducttaxPeritem;
                              $ProductQtyPrice = $ProductRealPrice * $product_qty;


                            ?>
                              <tr>
                                <td class="cart_description" style="padding: 1%; font-size: 12px;">
                                  <h6><b><?php echo $user_product_id_value; ?> (<?php echo $hindi_name; ?>) </b>
                                    <br><B>HSN :</B> <?php echo $product_HSN; ?>
                                  </h6>
                                </td>
                                <td class="cart_description text-right" style="padding: 1%; font-size: 12px;">
                                  <h6><i class="fa fa-inr"></i> <?php echo $product_mrp; ?> / <?php echo $product_tags; ?></h6>
                                </td>
                                <td class="price text-right" style="padding: 1%; font-size: 12px;">
                                  <span><i class="fa fa-inr"></i> <?php echo $ProductRealPrice; ?> / <?php echo $product_tags; ?></span>
                                </td>
                                <td class="qty text-right" style="padding: 1%; font-size: 12px;">x <?php echo $Quantity; ?></td>
                                <td class="price text-right" style="padding: 1%; font-size: 12px;">
                                  <span><i class="fa fa-inr"></i> <?php echo $ProductQtyPrice; ?></span>
                                </td>

                                <td align="right">+ Rs.<?php echo $Taxeamount = round($product_total_amount / 100 * $product_taxes, 2); ?> <br> GST <?php echo $product_taxes; ?>%</td>
                                <td align="right"><b>Rs.<?php echo $product_net_prices; ?></b></td>
                              </tr>

                            <?php } ?>
                          </tbody>
                        </table>

                        <style type="text/css">
                          table tr th,
                          td {
                            padding: 0.2% !important;
                          }
                        </style>
                        <table style="width: 100%; font-size: 14px !important;" class="table cart_summary">
                          <tr>
                            <th style="text-align: right;">MRP Total</th>
                            <td align="right">Rs.<?php
                                                  $select = "SELECT sum(product_mrp_total) FROM ordered_products where order_id='$ORDERID'";
                                                  $action = mysqli_query($con, $select);
                                                  while ($record = mysqli_fetch_array($action)) {
                                                    echo $product_mrp_total = $record['sum(product_mrp_total)'];
                                                  }
                                                  ?></td>
                          </tr>
                          <tr>
                            <th style="text-align: right;">Discount Amount</th>
                            <td align="right">
                              <?php
                              $select = "SELECT sum(product_total_price) FROM ordered_products where order_id='$ORDERID'";
                              $action = mysqli_query($con, $select);
                              while ($record = mysqli_fetch_array($action)) {
                                $total_amount = $record['sum(product_total_price)'];
                              }
                              ?>
                              <?php $discount = $product_mrp_total - $total_amount;
                              if ($discount == 0) {
                                echo "0";
                              } else {
                                echo "- Rs.$discount";
                              } ?>
                            </td>
                          </tr>
                          <tr>
                            <th style="text-align: right;">Product Price</th>
                            <td align="right">Rs.<?php
                                                  $select = "SELECT sum(product_total_price) FROM ordered_products where order_id='$ORDERID'";
                                                  $action = mysqli_query($con, $select);
                                                  while ($record = mysqli_fetch_array($action)) {
                                                    echo $total_amount = $record['sum(product_total_price)'];
                                                  }
                                                  ?></td>
                          </tr>

                          <tr>
                            <th style="text-align: right;">Order Amount</th>
                            <td align="right" colspan="5">
                              Rs.<?php echo $total_amount_after_discount; ?>
                            </td>
                          </tr>
                          <tr>
                            <th style="text-align: right;">Coupon & Reward Points</th>
                            <td align="right" colspan="5">
                              <?php
                              if ($coupon_code == "Not Redeemed") {
                                echo "No Coupons";
                              } elseif ($coupon_code == "NO Coupon Applied") {
                                echo "No Coupons";
                              } else {
                                echo $coupon_code;
                              } ?>
                              <?php if ($coupon_code == "REWARD POINTS") {
                                echo "($rewardspoints Points)";
                              } else {
                              } ?>
                            </td>
                          </tr>

                          <tr>
                            <th style="text-align: right;">Delivery & Convenience Charges</th>
                            <td align="right"><?php if ($delivery_charge == 0) {
                                                echo "Free Delivery";
                                              } else {
                                                echo "+ Rs.$delivery_charge";
                                              } ?></td>
                          </tr>

                          <tr>
                            <th style="text-align: right;">Net Payable Amount</th>
                            <td align="right" class="text-success" style="font-size: 25px;"><b>Rs.<?php
                                                                                                  echo $net_payable_amount;
                                                                                                  ?>
                              </b></td>
                          </tr>


                          <tr>
                            <th style="text-align: right;">Payment Status</th>
                            <td align="right"><b style="font-size: 17px; color: green;float: right;"> <?php if ($payment_status != "PAID") {
                                                                                                        echo "<span class='text-danger'>$payment_status</span>";
                                                                                                      } else {
                                                                                                        echo "<span class='text-success'>$payment_status</span>";
                                                                                                      }; ?></b></td>
                          </tr>

                        </table>
                        <br><br>
                        <div class="row">
                          <style type="text/css">
                            /* HIDE RADIO */
                            [type=radio] {
                              position: absolute;
                              opacity: 0;
                              width: 0;
                              height: 0;
                            }

                            /* IMAGE STYLES */
                            [type=radio]+img {
                              cursor: pointer;
                            }

                            /* CHECKED STYLES */
                            [type=radio]:checked+img {
                              outline: 2px solid #f00;
                            }
                          </style>
                        </div>
                        <form action="" method="POST">
                          <input type="text" name="order_id" value="<?php echo $ORDERID; ?>" hidden=''>
                          <div class="row">
                            <?php if ($payment_mode == "cash on delivery") { ?>
                              <div class="col-lg-6 col-md-6 col-6">
                                <h5><b>Payment Information</b></h5>
                                <p><b>Payment Mode:</b> <?php echo $payment_mode; ?><br>
                                  <b>Payment Status:</b> <?php echo $payment_status; ?>
                                </p>
                                <br>

                              </div>
                              <div class="col-lg-6 col-md-6 col-6">
                                <h5><b>Order Information</b></h5>
                                <p>
                                  <b>Order Date:</b> <?php echo $order_date; ?><br>
                                  <b>ORDER Mode:</b> <?php echo $order_type; ?><br>
                                  <b>Reward Points:</b> <?php if ($coupon_code == "REWARD_POINTS") {
                                                          echo "Reedemed";
                                                        } else {
                                                          echo "$rewardspoints";
                                                        } ?> - Points <?php echo $rewardspoints; ?><br>
                                  <b></b>
                                </p>
                                <br>
                              </div>

                              <div class="col-lg-12 col-md-12 col-12">
                                <h5><b>Select Payment Method</b></h5>
                              </div>
                              <div class="col-lg-2 col-md-4 col-6">
                                <label>
                                  <input type="radio" name="payment_mode" value="CASH_PAYMENT" required="">
                                  <img src="img/cash-payment.png" style="width: 100%; box-shadow: 0px 0px 1px grey;">
                                </label>
                              </div>
                              <div class="col-lg-2 col-md-4 col-6">
                                <label>
                                  <input type="radio" name="payment_mode" value="WALLET" required="">
                                  <img src="img/wallet.png" style="width: 100%;box-shadow: 0px 0px 1px grey;">
                                </label>
                              </div>
                              <div class="col-lg-8 col-md-4 col-12">
                                <div class="form-group">
                                  <label>Payment Note</label>
                                  <textarea class="form-control" rows='4' name="payment_note" required=""></textarea>
                                </div>
                              </div>
                            <?php } else { ?>
                              <div class="col-lg-12">
                                <h5><b>Payment Information</b></h5>
                                <p><b>Payment Mode:</b> <?php echo $payment_mode; ?><br>
                                  <b>Payment Status:</b> <?php echo $payment_status; ?>
                                </p>
                                <br>
                              </div>
                            <?php }   ?>
                            <div class="col-lg-12">
                              <button type="Submit" name="GENERATE_ORDER" class="btn btn-primary btn-md float-right">Deliver
                                Order</button>
                            </div>
                          </div>
                          <?php
                          if (isset($_POST['GENERATE_ORDER'])) {
                            if ($payment_mode == "cash on delivery") {
                              $ORDERID = $_POST['order_id'];
                              $payment_modes = $_POST['payment_mode'];
                              $payment_note = $_POST['payment_note'];
                              $payment_status = "PAID";
                              $delivery_status = "DELIVERED";
                              $delivery_date = date("d M Y, h:m a");
                              $order_status = "DELIVERED";
                              $coupon_code = $coupon_code;
                              $PICKUP_TIME = date("d M, Y h:m A");
                              $PICKUP_STATUS = "DELIVERED";
                              $sql = "UPDATE customer_orders SET payment_mode='$payment_modes', payment_note='$payment_note', payment_status='$payment_status', delivery_status='$delivery_status', delivery_date='$delivery_date', order_status='$order_status', PICKUP_TIME='$PICKUP_TIME', PICKUP_STATUS='$PICKUP_STATUS' where order_id='$ORDERID'";
                              $query = mysqli_query($con, $sql);
                              if ($query == true) {
                                $sql = "UPDATE ordered_products SET item_status='true' where order_id='$ORDERID'";
                                $query = mysqli_query($con, $sql);
                                if ($query == true) {

                                  //get sms data
                                  $fetchdata = "SELECT * FROM customer_orders where order_id='$ORDERID'";
                                  $query = mysqli_query($con, $fetchdata);
                                  $fetchdata = mysqli_fetch_array($query);
                                  $customer_id = $fetchdata['order_id'];
                                  $net_payable_amount = $fetchdata['net_payable_amount'];

                                  $fetchc = "SELECT * FROM customers where customer_id='$customer_id'";
                                  $query2 = mysqli_query($con, $fetchc);
                                  $fetchc = mysqli_fetch_array($query2);
                                  $customer_name = $fetchc['customer_name'];
                                  $customer_phone_number = $fetchc['customer_phone_number'];

                                  //send sms
                                  $smsstatus = SEND_SMS(
                                    "38314e455734594f553234351658469066",
                                    "NEWFRU",
                                    "1",
                                    "$customer_phone_number",
                                    "Hi $customer_name, Thank you for shopping at new4you.in. You order with Rs.$net_payable_amount and order id: $order_id has been delivered. NEW4YOU&templateid=1507165580652860370",
                                    "1507165580652860370",
                                    "POST"
                                  );
                          ?>
                                  <meta http-equiv="refresh" content="1; pickup_orders.php?t=success&m=Created&a=ORDERID : <b><?php echo $ORDERID; ?></b> is Created Successfully! to view Go to Orders." />
                                <?php } else { ?>
                                  <meta http-equiv="refresh" content="1; pickup_orders.php?t=danger&m=Failed&a=ORDERID : <b><?php echo $ORDERID; ?></b> is not Created." />
                                <?php }
                              } else {
                                echo "failed to generate order";
                              }
                            } else {
                              $ORDERID = $_POST['order_id'];
                              $delivery_status = "DELIVERED";
                              $PICKUP_TIME = date("d M, Y h:m A");
                              $PICKUP_STATUS = "DELIVERED";
                              $order_status = "DELIVERED";

                              $sql = "UPDATE customer_orders SET delivery_status='$delivery_status', delivery_date='$delivery_date', order_status='$order_status', PICKUP_TIME='$PICKUP_TIME', PICKUP_STATUS='$PICKUP_STATUS' where order_id='$ORDERID'";
                              $query = mysqli_query($con, $sql);
                              if ($query == true) { ?>
                                <meta http-equiv="refresh" content="1; pickup_orders.php?t=success&m=Created&a=ORDERID : <b><?php echo $ORDERID; ?></b> is Created Successfully! to view Go to Orders." />
                              <?php } else { ?>
                                <meta http-equiv="refresh" content="1; pickup_orders.php?t=danger&m=Failed&a=ORDERID : <b><?php echo $ORDERID; ?></b> is not Created." />
                          <?php }
                            }
                          }
                          ?>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>
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
<script type="text/javascript">
  function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) {
        return false;
      }
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
            /*insert the value for the autocomplete text field:*/
            inp.value = this.getElementsByTagName("input")[0].value;
            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
            closeAllLists();
          });
          a.appendChild(b);
        }
      }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
    });

    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }

    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function(e) {
      closeAllLists(e.target);
    });
  }
  autocomplete(document.getElementById("product_names"), products);
  autocomplete(document.getElementById("product_tags"), products_tags);
</script>