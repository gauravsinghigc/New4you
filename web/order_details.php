<?php
require 'files.php';
if (!isset($_SESSION['customer_id'])) {
   header("location: index.php?msg=logout");
}
?>
<?php

         if (isset($_GET['id'])) {
            $id = $_GET['id'];
          } else {
            header("location: order_list.php");
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
          ?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $store_name;?> : Order Details</title>
     <?php require 'header_files.php';?>
   </head>
   <body>
      <?php require 'header.php';?>
      <section class="account-page section-padding">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-11 mx-auto">
                  <div class="row no-gutters">
                     <div class="col-md-4">
                        <div class="card account-left">
                           <div class="user-profile-header">
                              <img alt="logo" src="img/user_img/<?php echo $customer_image;?>"><br>
                              <a data-target="#upload-profile-image" data-toggle="modal" class="btn btn-link text-secondary" href=""><i class="fa fa-upload"></i> Update Image</a>
                              <h4 class="mb-0 text-success"><?php echo $customer_name;?></h4>
                              <p class="mb-0"> +91 <?php echo $customer_phone_number;?></p>
                              <p class="mb-0"> <?php echo $customer_mail_id;?></p>
                           </div>
                           <div class="list-group" style="font-size: 14px;">
                              <a href="account.php" class="list-group-item list-group-item-action">
                                 <i aria-hidden="true" class="fa fa-user"></i>  My Account</a>
                              <a href="address.php" class="list-group-item list-group-item-action">
                                 <i aria-hidden="true" class="fa fa-map-marker"></i>  My Address</a>
                              <a href="order_list.php" class="list-group-item list-group-item-action active">
                                 <i aria-hidden="true" class="fa fa-shopping-cart"></i> My Orders</a>
                              <a href="rewards.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-star"></i> Reward Points</a>
                              <a href="wallet.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-square"></i> 24kharido Funds</a>
                              <a href="refer.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-share"></i> Refer & Earns</a>
                              <a href="notification.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-bell"></i> Notification</a>

                              <a href="logout.php" class="list-group-item list-group-item-action">
                                 <i aria-hidden="true" class="fa fa-sign-out"></i>  Logout</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="card card-body account-right">
                           <div class="widget">
                              <div class="section-header" style="padding-left: 0%;
    padding-right: 1%;">
    <h4><i class="fa fa-list text-info mt-0"></i> Order Details : <?php echo $_GET['id'];?>
      <span class="float-right" style="
margin-top: -0.5%;
      color: #020000;
    background-color: #ffffff;
    padding: 1%;
    padding-left: 2%;
    border-radius: 20px;
    padding-right: 2%;
    font-size: 12px;
    box-shadow: 0px 0px 3px grey;">
                    <?php $order_status = str_replace('_', ' ', $order_status); 
                    if($order_status == "NEW ORDER"){
                      echo "<i class='fa fa-star text-warning mt-0'></i> $order_status";
                    } elseif($order_status == "ACCEPTED") {
                      echo "<i class='fa fa-check-circle text-success mt-0'></i> $order_status";
                    } elseif($order_status == "OUT FOR DELIVERY"){
                      echo "<i class='fa fa-truck text-info mt-0'></i> $order_status";
                    } elseif($order_status == "REJECTED") {
                      echo "<i class='fa fa-times text-danger mt-0'></i> $order_status";
                    } elseif($order_status == "UNDELIVERED") {
                      echo "<i class='fa fa-times text-danger mt-0'></i> <i class='fa fa-truck text-info'></i> $order_status";
                    } elseif($order_status == "DELIVERED"){
                      echo "<i class='fa fa-check-circle text-success mt-0'></i> <i class='fa fa-truck text-info'></i> $order_status";
                    } else {
                      echo "<i class='fa fa-info text-danger mt-0'></i> $order_status";
                    }?></span>
    </h4>
    <hr>
                                 <h6 class="font-2" style="font-size: 15px;"><i class="fa fa-shopping-cart font-3"></i> <b>ORDER ID : #<?php echo $id;?></b>
     <br>
     <span><i class="fa fa-calendar"></i> Date : <?php echo $order_date;?></span><br>
      <span><i class="fa fa-truck font-3"></i> Status : <?php echo $order_status;?></span></h6>
      <a href="track-order.php?order_id=<?php echo $id;?>" class="btn btn-lg btn-info text-white float-right font-3" style="margin-top: -10%;"><i class="fa fa-map-marker mt-0"></i> - <i class="fa fa-truck mt-0"></i> Track Order</a>
                              </div>
                                 <section class="container-fluid pb-2">
  <div class="row">
   <div class="col-md-12 col-lg-12" style="padding-left: 0%;
    padding-right: 1%;">
    <h5 class="font-3">
      <span style="font-size: 15px;
    color: green;
    float: right;
    background-color: white;
    box-shadow: 0px 0px 1px grey;
    padding: 1%;
    padding-left: 2%;
    border-radius: 20px;
    padding-right: 2%;"><?php if($payment_status != "PAID"){ echo "<span class='text-danger'><i class='fa fa-warning mt-0'></i> $payment_status</span>"; } else { echo "<span class='text-success'><i class='fa fa-check-circle mt-0'></i> $payment_status</span>"; } ;?></span></h5>
   </div>
   <div class="col-md-12 col-lg-12" style="padding-left: 0%; padding-right: 0%;">
    <?php
    $customer_id = $_SESSION['customer_id'];
    $order_id = $_GET['id'];
     mysqli_set_charset($con, 'utf8');
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
    <div class="row pro-text-bg p-2 mt-2" style="background-color: #f3f3f3;">
      <div class="col-sm-2 col-xs-2 col-2 p-2">
        <img src="<?php echo $img_url;?>img/store_img/<?php echo $fetch['product_img'];?>" style='width: 78%;border-radius: 15px;margin-top: 7%;box-shadow: 0px 0px 1px grey;padding: 2%;' class="d-block mx-auto">
      </div>
      <div class="col-sm-10 col-xs-10 col-10 pt-3">
     <p style="color: black; font-size: 14px;">
     <i class="fa fa-check-circle text-success" style="font-size: 14px;"></i><span style="font-size: 16px;"> <?php echo $fetch['product_names'];?> - <?php echo $hindi_name;?></span><br>
     <i class="fa fa-inr"></i> <?php echo $fetch['product_price'];?>/<?php echo $product_tags;?> - <i class="fa fa-inr"></i><strike> <?php echo $fetch['product_mrp'];?>/<?php echo $product_tags;?> </strike> &nbsp; <br>
      Qty : <?php echo $Quantity;?> <?php echo $letters;?> <br>
     <span style="float: right;
    font-size: 15px;
    margin-top: -14px;
"> Total : <i class="fa fa-inr"></i> <?php echo $fetch['product_price'];?> x
      <?php echo $qty;?>  = <i class="fa fa-inr"></i> <b
       style="font-size: 17px;"><?php echo $fetch['product_total_price'];?></b></span><br>
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
  table.price tr td, th {
   padding: 0.5%;
  }
</style>
    <hr>
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
         <th>Delivery & Conveniance Charges</th>
         <td align="right"><?php if($delivery_charge == 0) { echo "Free Delivery"; } else { echo "+ Rs.$delivery_charge"; }?></td>
       </tr>
       <tr style="box-shadow: 0px 0.1px 0px 0px grey;">
         <th>Net Payable Amount</th>
         <td align="right" class="text-success" style="font-size: 17px;"><b>Rs.<?php
                                  echo $net_payable_amount;
                                   ?>
                                 </b></td>
       </tr>
       
       
       <tr style="box-shadow: 0px 0.1px 0px 0px grey;">
         <th>Payment Status</th>
         <td align="right"><b style="font-size: 17px; color: green;float: right;"> <?php if($payment_status != "PAID"){ echo "<span class='text-danger'>$payment_status</span>"; } else { echo "<span class='text-success'>$payment_status</span>"; } ;?></b></td>
       </tr>

     </table>
     
    
    
    <p style="font-size: 12px; color: black;float: left;margin-top: 4%;line-height: 140%;width: 50%;">
     <b class="font-15">Shipping & Billing Information:</b><br><br>
     <span style="font-size: 13px;"><b><?php echo $customer_name;?></b></span><br>
     <?php echo $customer_phone_number;?><br>
     <?php echo $customer_mail_id;?><br>
     <?php echo $delivery_address;?><br><br>
</p>
<p style="font-size: 12px; color: black;float: right;margin-top: 4%;line-height: 140%;width: 50%;text-align: right;margin-bottom: 0px;">
     <b class="font-15">Store Information:</b><br><br>
     <span style="font-size: 13px;"><b><?php echo $store_name;?></b></span><br>
    <?php echo $store_phone;?><br>
     <?php echo $store_mail_id;?><br>
     <i class="fa fa-map-marker text-warning"></i> <?php echo $store_address;?> <?php echo $store_arealocality;?> <?php echo $store_city;?><br>
     <?php echo $store_state;?> - <?php echo $store_pincode;?><br>
     <b>GST:</b> <?php echo $store_gst;?>
     <br><b>PAN:</b> <?php echo $store_pan;?>
</p>
    <p style="width: 100% !important;float: left;color: black;" class="mb-0 mt-0">
     <b><i class="fa fa-truck text-info mt-0"></i> DELIVERY SLOT <i class="fa fa-angle-right"></i></b> <?php echo $PICK_SCHEDULE_TIME;?>
    </p>

    
    <h5 style="color: black;float: left;width: 100%;"><hr><b>Order Information</b></h5>
    <style type="text/css">
      table.info tr td, th {
        padding: 0.5%;
      }
    </style>
    <table style="width: 100%; color: black; font-size: 14px;" class="info">
       <tr>
      <th>Invoice No</th>
      <td><?php echo $order_id;?></td>
     </tr>
     <tr>
      <th>Payment Mode</th>
      <td><?php if($payment_mode == "CASH PAYMENT"){ echo "Cash Payment";} else { echo strtoupper($payment_mode);}?></td>
     </tr>
     <tr>
      <th>Coupon & Rewards Points</th>
      <td><?php if($coupon_code == "REWARD POINTS"){ echo "Reedemed";} else { echo $coupon_code; }?> <?php if($coupon_code == "REWARD POINTS"){ echo "($rewardspoints Points)";} else {}?></td>
     </tr>
     <tr>
      <th>Payment Status</th>
      <td><?php echo $payment_status;?></td>
     </tr>
     <tr>
      <th>Delivery Type</th>
      <td><?php echo $DELIVERY_TYPE;?></td>
     </tr>
     <tr>
      <th>Delivery Status</th>
      <td><?php echo $delivery_status;?></td>
     </tr>
     <tr>
      <th>Delivery Date</th>
      <td><?php echo $delivery_date;?></td>
     </tr>
     <tr>
      <th>Delivery & Conveniance Charge</th>
      <td><?php if($delivery_charge == 0) { echo "Free Delivery"; } else { echo "Rs.$delivery_charge"; }?></td>
     </tr>
      <tr>
      <th style="width: 30%;">Net Payable Amount</th>
      <td>Rs.<?php echo $net_payable_amount; ?></td>
     </tr>
     <tr>
      <th>Order Status</th>
      <td><?php echo $order_status;?></td>
     </tr>
     <?php if($DELIVERY_TYPE == "STORE_PICKUP") { ?>
     <tr>
      <th>PICK SCHEDULE TIME</th>
      <td><?php echo $PICK_SCHEDULE_TIME;?></td>
     </tr>
     <tr>
      <th>PICKUP</th>
      <td><?php echo $PICKUP_TIME;?></td>
     </tr>
     <?php } else { } ?>
     <tr>
      <td colspan="2" style="width:55% !important;"><br><b>Payment Note:</b> <br><?php echo $payment_note;?></td>
     </tr>

    </table>
<hr>
<h4><b>Reward Points Earned</b></h4>
    <?php 
     $sql = "SELECT * FROM customer_rewards where customer_id='$customer_id' and order_id='$order_id' ORDER BY rewards_id DESC";
     $query = mysqli_query($con, $sql);
     while($fetch = mysqli_fetch_assoc($query)){
       $order_id = $fetch['order_id'];
       $rewards_point = $fetch['rewards_point'];
       $reward_date = $fetch['reward_date'];
       $order_id = $fetch['order_id']; ?>

    <table style="width: 100%; font-size: 15px;">
  <tr>
    <td align="left">#<?php echo $order_id;?><br>
     <i class="fa fa-star text-success"></i> <?php echo $rewards_point;?> Points</td>
    <td align="right"><i class="fa fa-calendar"></i> <?php echo $reward_date;?><br><span class='text-success' style="float: right;">Earned</span></td>
  </tr>
</table>
<hr class="mt-1 mb-2">

     <?php } ?>
     <br>
    <p class="text-center">
     <a href="invoice.php?order_id=<?php echo $order_id;?>"
      class="btn btn-md btn-success" target="blank"><i class="fa fa-file mt-0"></i> View Invoice</a>
    </p>
<h3 class="text-success text-center">If You Have any Query for Your Order</h3>
<h4 class="text-success text-center">
   Please feel free to contact us via Call on <a href="tel:<?php echo $store_phone;?>" class="text-info" style="display: inline-block;"><i class="fa fa-phone"></i> <?php echo $store_phone;?></a> or Mail at <a href="mailto:<?php echo $store_mail_id;?>" class="text-info" style="display: inline-block;"><i class="fa fa-envelope"></i> <?php echo $store_mail_id;?></a>
</h4>
    
   </div>
  </div>
 </section>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
      <?php
      require 'footer.php';?>

      <!-- Bootstrap core JavaScript -->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <!-- select2 Js -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel -->
      <script src="js/owl.carousel.js"></script>
      <!-- Custom -->
      <script src="js/custom.js"></script>



</body></html>

<div class="modal fade login-modal-main" id="upload-profile-image">
         <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-body">
                  <div class="login-modal">
                     <div class="row">
                        <div class="col-lg-12 pad-left-0">
                           <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true"><i class="fa fa-times"></i></span>
                           <span class="sr-only">Close</span>
                           </button>
                              <div class="login-modal-right">
                                    <div class="tab-pane" role="tabpanel">
                                       <h5 class="heading-design-h5">Upload Profile Image</h5>
                                     <form action="insert.php" method="POST" enctype="multipart/form-data">
                                     <input type="text" name="customer_id" value="<?php echo $customer_id;?>" hidden>
                                      <fieldset class="form-group">
                                         <input type="FILE" class="form-control" name="customer_image_uplaod" placeholder="Full Name" required="">
                                         <span><code>*</code> for better view please upload square images</span>
                                       </fieldset>
                                       <fieldset class="form-group">
                                          <button type="submit" name="upload_customer_dp" class="btn btn-lg btn-secondary btn-block"><i class='fa fa-upload'></i>Upload</button>
                                       </fieldset>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
