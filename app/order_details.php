<?php require 'files.php'; require 'session.php'; ?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php';?>
  <br>
  <!-- header part end -->
  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-md-12">
     <h6 class="font-6"><i class="fa fa-shopping-cart font-4 text-info"></i> <b>ORDER ID :</b>
      <?php

         if (isset($_GET['id'])) {
            $id = $_GET['id'];
            echo $id;
          } else {
            header("location: orders.php");
          }
          $sql = "SELECT * FROM customer_orders where order_id='$id'";
    $query = mysqli_query($con, $sql);
    $FetchUserDetails = mysqli_fetch_assoc($query);
$delivery_address = $FetchUserDetails['delivery_address'];
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
$delivery_charge = $FetchUserDetails['delivery_charge'];
$rewardspoints = $FetchUserDetails['rewardspoints'];
$rewardsamount = $FetchUserDetails['rewardsamount'];
$store_id = $FetchUserDetails['store_id'];

$order_status = str_replace('_', ' ', $order_status);
$payment_mode = str_replace('_', ' ', $payment_mode);
$payment_status = str_replace('_', ' ', $payment_status);
$delivery_status = str_replace('_', ' ', $delivery_status);
if ($store_id == null) {?>
      <meta http-equiv="refresh" content="1, orders.php" />
      <?php }
          ?><br>
      <span><i class="fa fa-calendar font-4 text-warning"></i> Date : <?php echo $order_date;?></span><br>
      <span><i class="fa fa-truck font-4 text-success"></i> Status : <?php echo $order_status;?></span>
     </h6>
     <a href="track-order.php?order_id=<?php echo $id;?>" class="btn btn-md btn-info text-white float-right" style="margin-top: -11%;"><i class="fa fa-map-marker"></i> - <i class="fa fa-truck"></i>
      Track Order</a>
    </div>
   </div>
  </section>

  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-md-12 col-lg-12 bg-info p-1">
     <h6 class="font-7 text-white"><b>Order Details :</b>
      <span style="color: green;float: right;margin-top:-10px;"
       class="bg-white p-3 circle"><?php if($payment_status != "PAID"){ echo "<span class='text-danger'><i class='fa fa-warning'></i> $payment_status</span>"; } else { echo "<span class='text-success'><i class='fa fa-check-circle'></i> $payment_status</span>"; } ;?></span>
     </h6>
    </div>
    <div class="col-md-12 col-lg-12">
     <?php
    $customer_id = $_SESSION['customer_id'];
    $order_id = $_GET['id'];
    $sql = "SELECT * FROM ordered_products where customer_id='$customer_id' and order_id='$order_id'";
    $query =  mysqli_query($con, $sql);
    while ($fetch = mysqli_fetch_assoc($query)){
      $options = $fetch['options'];
      $product_tags = $fetch['product_tags'];
    $product_qty = $fetch['product_qty'];
    $hindi_name = $fetch['hindi_name'];
    $product_units = "$product_tags";
    $letters = preg_replace('/[0-9\.]/','', "$product_tags");
    $numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
    $Quantity = $product_qty;
    $qty = $Quantity/$numbers;
    if($Quantity >= 1000 and $letters = "GM"){
      $Quantity = $Quantity/1000;
      $letters = "KG";
    }  else {
      $Quantity = $Quantity;
      $letters = $letters;
    }
    ?>
     <div class="row pro-text-bg p-2 mt-2">
      <div class="col-sm-3 col-xs-3 col-3 p-2">
       <img src="<?php echo $MUrl;?>/admin/img/store_img/<?php echo $fetch['product_img'];?>" style='width: 100%;border-radius: 15px;margin-top: 7%;box-shadow: 0px 0px 1px grey;padding: 2%;'>
      </div>
      <div class="col-sm-9 col-xs-9 col-9 pt-3">
       <p style="color: black;" class="font-5">
        <i class="fa fa-check-circle text-success"></i><span style="font-size: 13px;"> <?php echo $fetch['product_names'];?> - <?php echo $hindi_name;?></span><br>
        <i class="fa fa-inr"></i> <?php echo $fetch['product_price'];?>/<?php echo $product_tags;?> - <i class="fa fa-inr"></i><strike> <?php echo $fetch['product_mrp'];?>/<?php echo $product_tags;?>
        </strike> &nbsp; <br>
        Qty : <?php echo $Quantity;?> <?php echo $letters;?> <br>
        <span style="float: right;"> Total : <i class="fa fa-inr"></i> <?php echo $fetch['product_price'];?> x
         <?php echo $qty;?> = <i class="fa fa-inr"></i> <b style="font-size: 13px;"><?php echo $fetch['product_total_price'];?></b></span><br>
       </p>
      </div>
     </div>

     <?php } ?>
     <?php
    $sql = "SELECT * FROM customer_orders where order_id='$order_id'";
    $query = mysqli_query($con, $sql);
    $FetchUserDetails = mysqli_fetch_assoc($query);
$delivery_address = $FetchUserDetails['delivery_address'];
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
$PICK_SCHEDULE_TIME = $FetchUserDetails['PICK_SCHEDULE_TIME'];
$PICKUP_TIME = $FetchUserDetails['PICKUP_TIME'];
$DELIVERY_TYPE = $FetchUserDetails['DELIVERY_TYPE'];
$rewardspoints = $FetchUserDetails['rewardspoints'];

$order_status = str_replace('_', ' ', $order_status);
$payment_mode = str_replace('_', ' ', $payment_mode);
$payment_status = str_replace('_', ' ', $payment_status);
$delivery_status = str_replace('_', ' ', $delivery_status);
$DELIVERY_TYPE = str_replace('_', ' ', $DELIVERY_TYPE);
$coupon_code = str_replace('_', ' ', $coupon_code);

//store info
$sql = "SELECT * FROM stores where store_id='$store_id'";
$query = mysqli_query($con, $sql);
$fetch_store = mysqli_fetch_assoc($query);
$store_name = $fetch_store['store_name'];
$store_phone = $fetch_store['store_phone'];
$store_mail_id = $fetch_store['store_mail_id'];
$store_address = $fetch_store['store_address'];
$store_arealocality = $fetch_store['store_arealocality'];
$store_city = $fetch_store['store_city'];
$store_state = $fetch_store['store_state'];
$store_pincode = $fetch_store['store_pincode'];
$store_gst = $fetch_store['GST'];
$store_pan = $fetch_store['PAN'];
$sql = "SELECT * FROM customers where customer_id='$customer_id'";
$query =  mysqli_query($con, $sql);
$fetch =  mysqli_fetch_assoc($query);
$customer_name = $fetch['customer_name'];
$customer_mail_id = $fetch['customer_mail_id'];
$customer_phone_number = $fetch['customer_phone_number'];

?><br>
     <style type="text/css">
     table.price tr td,
     th {
      padding: 0.6%;
      font-size: 14px;
     }

     </style>
     <table style="width: 100%; font-size: 14px;color: black;" class="price">
      <tr style="box-shadow: 0px 0.1px 0px 0px grey;">
       <th>MRP Total</th>
       <td align="right">Rs.<?php
                                 $select = "SELECT sum(product_mrp_total) FROM ordered_products where order_id='$order_id'";
                                  $action = mysqli_query($con, $select);
                                   while ($record = mysqli_fetch_array($action)) {
                                    echo $product_mrp_total= $record['sum(product_mrp_total)'];
                                   }
                                   ?></td>
      </tr>
      <tr style="box-shadow: 0px 0.1px 0px 0px grey;">
       <th>Product Price</th>
       <td align="right">Rs.<?php
                                 $select = "SELECT sum(product_total_price) FROM ordered_products where order_id='$order_id'";
                                  $action = mysqli_query($con, $select);
                                   while ($record = mysqli_fetch_array($action)) {
                                    echo $product_total_price= $record['sum(product_total_price)'];
                                   }
                                   ?></td>
      </tr>

      <tr style="box-shadow: 0px 0.1px 0px 0px grey;">
       <th>Coupon & Reward Points</th>
       <td align="right">
        <?php
          if($coupon_code == "Not Redeemed"){ echo "No Coupons"; } elseif($coupon_code == "NO Coupon Applied") { echo "No Coupons"; } else { echo $coupon_code;} ?>
        <?php if($coupon_code == "REWARD POINTS"){
            echo "($rewardspoints Points)";
          } else {

        }?>
       </td>
      </tr>
      <tr style="box-shadow: 0px 0.1px 0px 0px grey;">
       <th>Discount Amount</th>
       <td align="right">
        <?php
          $select = "SELECT * FROM customer_orders where order_id='$order_id'";
          $action = mysqli_query($con, $select);
          $record = mysqli_fetch_array($action);
          $total_amount_of_order= $record['total_amount_after_discount'];
        ?>
        <?php $discount = $total_amount_of_order - $total_amount_after_discount;
          if($coupon_code == "Not Available" or $coupon_code == "Not Redeemed"){
           echo "- Rs.$discount";
          } else {
            if($rewardspoints == null or $rewardspoints == "Not Available" or $rewardspoints == "NA"){
              $rewardspoints = 0;
            } else {
              $rewardspoints = $rewardspoints;
            }
            echo "- Rs.$rewardspoints";
          }
        ?>
       </td>
      </tr>
      <tr style="box-shadow: 0px 0.1px 0px 0px grey;">
       <th>Order Amount</th>
       <td align="right">
        Rs.<?php echo $total_amount_after_discount; ?>
       </td>
      </tr>
      <tr style="box-shadow: 0px 0.1px 0px 0px grey;">
       <th>Delivery & Convenience Charges</th>
       <td align="right"><?php if($delivery_charge == 0) { echo "Free Delivery"; } else { echo "+ Rs.$delivery_charge"; }?></td>
      </tr>
      <tr style="box-shadow: 0px 0.1px 0px 0px grey;">
       <th>Net Payable Amount</th>
       <td align="right" class="text-success" style="font-size: 16px !important;"><b>Rs.<?php
                                  echo $net_payable_amount;
                                   ?>
        </b></td>
      </tr>

      <tr style="box-shadow: 0px 0.1px 0px 0px grey;">
       <th>Payment Status</th>
       <td align="right" class="mr-0 pr-0"><b style="font-size: 15px; color: green;float: right;" class="bg-white p-2 circle border pl-3 pr-3">
         <?php if($payment_status != "PAID"){ echo "<span class='text-danger'>$payment_status</span>"; } else { echo "<span class='text-success'><i class='fa fa-check-circle'></i> $payment_status</span>"; } ;?></b>
       </td>
      </tr>

     </table>

     <hr>
     <p style="font-size: 12.6px; color: black;line-height: 15px;">
      <b>Shipping & Billing Information:</b><br>
      <?php echo $customer_name;?><br>
      <?php echo $customer_phone_number;?><br>
      <?php echo $customer_mail_id;?><br>
      <?php echo $delivery_address;?><br><br>
      <b>DELIVERY SLOT <i class="fa fa-angle-right"></i></b> <?php echo $PICK_SCHEDULE_TIME;?>
     </p>
     <hr>

     <p style="font-size: 12.6px; color: black;line-height: 15px;">
      <b>Store Information:</b><br>
      <?php echo $store_name;?><br>
      <a href='tel:<?php echo $store_phone;?>'><i class="fa fa-phone text-success"></i> <?php echo $store_phone;?></a><br>
      <a href='mailto:<?php echo $store_mail_id;?>'><i class="fa fa-envelope text-primary"></i> <?php echo $store_mail_id;?></a><br>
      <i class="fa fa-map-marker text-warning"></i> <?php echo $store_address;?> <?php echo $store_arealocality;?> <?php echo $store_city;?><br>
      <?php echo $store_state;?> - <?php echo $store_pincode;?><br>
      <b>GST:</b> <?php echo $store_gst;?>
      <br><b>PAN:</b> <?php echo $store_pan;?>
      <hr>
     </p>
     <h5 style="color: black;" class="font-6"><b>Order Information</b></h5>

     <style type="text/css">
     table.OrderDetails tr th {
      font-size: 13px !important;
      padding: 0.2%;
     }

     table.OrderDetails tr td {
      font-size: 13px !important;
      padding: 0.2%;
     }

     </style>

     <table style="width: 100%; color: black;" class="OrderDetails">
      <tr>
       <th>Invoice No</th>
       <td align="right"><?php echo $order_id;?></td>
      </tr>
      <tr>
       <th>Payment Mode</th>
       <td align="right"><?php if($payment_mode == "CASH_PAYMENT"){ echo "Cash Payment";} else { echo strtoupper($payment_mode);}?></td>
      </tr>
      <tr>
       <th>Rewards Points</th>
       <td align="right"><?php if($coupon_code == "REWARD POINTS"){ echo "Reedemed";} else { echo $coupon_code; }?>
        <?php if($coupon_code == "REWARD POINTS"){ echo "($rewardspoints Points)";} else {}?></td>
      </tr>
      <tr>
       <th>Payment Status</th>
       <td align="right"><?php echo $payment_status;?></td>
      </tr>
      <tr>
       <th>Delivery Type</th>
       <td align="right"><?php echo $DELIVERY_TYPE;?></td>
      </tr>
      <tr>
       <th>Delivery Status</th>
       <td align="right"><?php echo $delivery_status;?></td>
      </tr>
      <tr>
       <th>Delivery Date</th>
       <td align="right"><?php echo $delivery_date;?></td>
      </tr>
      <tr>
       <th>Delivery & Conveniance Charge</th>
       <td align="right"><?php if($delivery_charge == 0) { echo "Free Delivery"; } else { echo "Rs.$delivery_charge"; }?></td>
      </tr>
      <tr>
       <th style="width: 30%;">Net Payable Amount</th>
       <td align="right">Rs.<?php echo $net_payable_amount; ?></td>
      </tr>
      <tr>
       <th>Order Status</th>
       <td align="right"><?php echo $order_status;?></td>
      </tr>
      <?php if($DELIVERY_TYPE == "STORE_PICKUP") { ?>
      <tr>
       <th>PICK SCHEDULE TIME</th>
       <td align="right"><?php echo $PICK_SCHEDULE_TIME;?></td>
      </tr>
      <tr>
       <th>PICKUP</th>
       <td align="right"><?php echo $PICKUP_TIME;?></td>
      </tr>
      <?php } else { } ?>
      <tr>
       <td colspan="2" style="width:55% !important;"><br><b>Payment Note:</b> <br><?php echo $payment_note;?></td>
      </tr>

     </table>
     <hr>
     <h4 class="font-6"><b>Reward Points</b></h4>
     <?php 
     $sql = "SELECT * FROM customer_rewards where customer_id='$customer_id' and order_id='$order_id' ORDER BY rewards_id DESC";
     $query = mysqli_query($con, $sql);
     while($fetch = mysqli_fetch_assoc($query)){
       $order_id = $fetch['order_id'];
       $rewards_point = $fetch['rewards_point'];
       $reward_date = $fetch['reward_date'];
       $order_id = $fetch['order_id'];
       $reward_status = $fetch['reward_status']; ?>

     <table style="width: 100%; font-size: 12px;">
      <tr>
       <td align="left">#<?php echo $order_id;?><br>
        <i class="fa fa-star text-success"></i> <?php echo $rewards_point;?> Points
       </td>
       <td align="right"><i class="fa fa-calendar"></i> <?php echo $reward_date;?><br><span class='text-success' style="float: right;">Earned</span></td>
      </tr>
     </table>
     <hr class="mt-1 mb-2">

     <?php } ?>
     <br>
     <h3 class="text-success text-center font-7">If You Have any Query for Your Order</h3>
     <h4 class="text-success text-center font-7">
      Please feel free to contact us via Call on
      <br><br><a href="tel:<?php echo $store_phone;?>" class="text-white btn btn-info btn-md font-8" style="display: inline-block;"><i class="fa fa-phone"></i> <?php echo $store_phone;?></a>
      <br><br> or Mail at<br><br>
      <a href="mailto:<?php echo $store_mail_id;?>" class="text-white btn btn-info btn-md font-8" style="display: inline-block;"><i class="fa fa-envelope"></i> <?php echo $store_mail_id;?></a>
     </h4>
     <br><br><br>
    </div>
   </div>
  </section>

  <?php GSI_footer_files();?>
 </body>

</html>
