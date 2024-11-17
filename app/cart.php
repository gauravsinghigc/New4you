<?php require 'files.php';
require 'session.php';



$sql = "SELECT * FROM web_tools where NAME='POINT_EARN'";
$Query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($Query);
$PointsEranings = $fetch['VALUE'];
if(isset($_SESSION['customer_id'])){
  $customer_id = $_SESSION['customer_id'];
  $select_customer = "SELECT * FROM customers where customer_id='$customer_id'";
  $customer_query = mysqli_query($con, $select_customer);
  $customer_fetch = mysqli_fetch_assoc($customer_query);
  $CMT_arealocality = $customer_fetch['arealocality'];
  $CMT_city = $customer_fetch['custcity'];
  $CMT_state = $customer_fetch['custstate'];
  $CMT_pincode = $customer_fetch['custpincode'];
  $store_id = $customer_fetch['store_id'];
} else {

}
$sql = "SELECT * from store_coupons where store_id='$store_id' and coupon_status='active'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$percentage = $fetch['percentage'];
$coupon_code = $fetch['coupon_code'];
$coupon_status = $fetch['coupon_status'];

$sql = "SELECT * FROM delivery_charges where store_id='$store_id' and delivery_charge_status='active'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$concharge = $fetch['concharge'];
$delivery_charge = $fetch['delivery_charge'];
$est_delivery_amount = $fetch['est_delivery_amount'];

$delivery_charges = $delivery_charge+$concharge;

if (isset($_POST['OC'])) {
  $_SESSION['OC'] = $_POST['OC'];
  $OC = $_SESSION['OC'];
} elseif (!isset($_POST['OC'])) {
  $OC = "";
} else {
  $OC = $_SESSION['OC'];
}

if(isset($_POST['OC'])){
                $coupon_code = "REWARD_POINTS";
              } else {
                $coupon_code = "NO COUPON";
              }

?>
<html>

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php';?>
  <?php CreateSlider("CART");?><br>
  <section class="container-fluid">
   <div class="row">
    <div class="col-sm-12 col-xs-12 bg-success p-1">
     <h4 class="font-7 text-white">
      <i class="fa fa-shopping-cart"></i> Shopping Cart <i class="fa fa-angle-right"></i>
     </h4>
    </div>
    <br>
    <?php
      $store_id = $store_id;
      $ip_address = get_ip();
      $device_type = detectDevice();
      date_default_timezone_set("Asia/Calcutta");
      $date_time_c = date("dMY");
      $ipv6_n = php_uname('n');
      $ipv6_p = php_uname('p');
      $os = php_uname('s');
      $OS_release = php_uname('r');
      $OS_Version = php_uname('v');
      $System_Info = php_uname('m');
      $System_more_Info = $_SERVER['HTTP_USER_AGENT'];
      $device_info = "$ip_address$device_type";

      if (isset($_SESSION['customer_id'])) {
        $customer_id = $_SESSION['customer_id'];
        $sql = "SELECT * from customer_cart where store_id='$store_id' and customer_id='$customer_id'";
        $query = mysqli_query($con, $sql);
        $count = mysqli_num_rows($query);

        $select = "SELECT sum(product_total_amount) FROM customer_cart where store_id='$store_id' and customer_id='$customer_id'";
        $action = mysqli_query($con, $select);
        while ($record = mysqli_fetch_array($action)) {
          $total_amount = $record['sum(product_total_amount)'];
        }
      } else {

        $sql = "SELECT * from customer_cart where ip_address='$device_info' and store_id='$store_id'";
        $query = mysqli_query($con, $sql);
        $count = mysqli_num_rows($query);

        $select = "SELECT sum(product_total_amount) FROM customer_cart where ip_address='$device_info' and store_id='$store_id'";
        $action = mysqli_query($con, $select);
        while ($record = mysqli_fetch_array($action)) {
          $total_amount = $record['sum(product_total_amount)'];
        }
      }
      if ($count == 0) { ?>
    <div class="col-sm-12 col-xs-12 top_brand_left">
     <center>
      <img src="img/noresult.gif" style="width:45%; margin-top:5%; border-radius: 500px;"><br><br>
      <h4><i class="fa fa-warning text-danger"></i> Shopping Cart in Empty</h4>
      <p class="font-2">Please add some products in Shopping cart.</p>
      <a href="index.php" class="btn btn-info btn-lg btn-block bottom-text fixed-bottom text-white bottom-p"><i class="fa fa-angle-left"></i> Back to
       Home</a><br><br><br>
     </center>
    </div>

    <?php } else { ?>
    <div class="col-sm-12 col-xs-12 pl-1 pr-1 pt-2">
     <?php 
            $fetch = mysqli_fetch_assoc($query);
              $user_product_id = $fetch['user_product_id'];
              if (isset($_SESSION['customer_id'])) {
                $sql = "SELECT * FROM customer_cart where store_id='$store_id' and customer_id='$customer_id'";
              } else {
                $sql = "SELECT * FROM customer_cart where store_id='$store_id' and ip_address='$device_info'";
              }
              $query = mysqli_query($con, $sql);

              while ($fetch = mysqli_fetch_assoc($query)) {
                $cart_id = $fetch['cart_id'];
                $user_product_id_value = $fetch['user_product_id'];
                $product_price = $fetch['product_price'];
                $product_tags = $fetch['product_tags'];
                $product_quantity = $fetch['product_quantity'];
                $product_total_amount = $fetch['product_total_amount'];
                $combo_id = $fetch['combo_id'];
                $hindi_name = $fetch['hindi_name'];
                 $product_mrp = $fetch['product_mrp'];
                 $product_price = $fetch['product_price'];
                 $product_quantity = $fetch['product_quantity'];
                 $product_total_amount = $fetch['product_total_amount'];
                 $product_img=$fetch['product_img'];
                 $options = $fetch['options'];
    $product_qty = $fetch['product_quantity'];
    $product_units = "$product_tags";
    $letters = preg_replace('/[0-9\.]/','',"$product_tags");
    $numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
    $Quantity = $product_qty*$numbers;
    if($Quantity >= 1000 and $letters = "GM"){
    	$Quantity = $Quantity/1000;
    	$letters = "KG";
    }  else {
    	$Quantity = $Quantity;
    	$letters = $letters;
    }
              ?>
     <div class="row p-2 pro-text-bg mb-2" id="Hide<?php echo $cart_id;?>" style="background-color: white !important;">
      <div class="col-sm-3 col-xs-3 col-3 pro-text-bg" style='padding-left:2%; padding-right:1%;padding:1%;'>
       <div style="margin-top: -18%;height: 14vh;">
        <img src='<?php echo $MUrl;?>/admin/img/store_img/<?php echo $product_img;?>'
         style='width:100%;padding: 2%; background-color: white;margin-top: 19%;border-radius: 12px;box-shadow: 0px 0px 1px grey;'>
       </div>
      </div>
      <div class='col-sm-9 col-xs-9 col-9 pro-text-bg' style='padding-left:1%;'>
       <div style="padding: 3%;padding-right: 0;padding-left: 0;">
        <a class="btn btn-sm btn-danger text-white float-right" data-original-title="Remove Item" href="delete.php?delete_cart=<?php echo $cart_id;?>" title="" data-placement="top"
         data-toggle="tooltip" style="float: right; background-color: red;font-size:15px;padding: 3%;padding-left: 3%; padding-right: 3%;"><i class="fa fa-trash"></i></a>
        <p style='font-size: 14px;margin-bottom:3%;line-height: 12px;'>
         <i class="fa fa-check-circle text-success"></i><b> <?php echo $user_product_id_value;?> <?php echo $hindi_name;?>
          <?php echo $options;?></b>
        </p>

        <div class="input-group" style='width:50%;'>
         <table style="width: 100%;max-width: 99px;">
          <tr>
           <td>
            <form action='update.php' method='POST' class="float-right mb-0">
             <input type="text" name="product_price" value="<?php echo $product_price; ?>" hidden="">
             <input type="text" name="cart_id" value="<?php echo $cart_id; ?>" hidden="">
             <input type="text" name="quantity" value="<?php echo $product_quantity; ?>" hidden="">
             <input type="text" name="product_mrp" value="<?php echo $product_mrp; ?>" hidden="">
             <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
             <button class="btn btn-md btn-info" name="DECREASE" type="submit"><i class="fa fa-minus"></i></button>
            </form>
           </td>
           <td>
            <input type='number' min='1' max='10' class="form-control" value='<?php echo $product_quantity; ?>' id="qty<?php echo $user_product_id_value; ?>"
             style="height: 25px !important;min-height: 25px !important; line-height: 25px !important;padding-left: 13% !important;width: 30px;margin-left: 4px;">
           </td>
           <td>
            <form action='update.php' method='POST' class="mb-0">
             <input type="text" name="product_price" value="<?php echo $product_price; ?>" hidden="">
             <input type="text" name="cart_id" value="<?php echo $cart_id; ?>" hidden="">
             <input type="text" name="quantity" value="<?php echo $product_quantity; ?>" hidden="">
             <input type="text" name="product_mrp" value="<?php echo $product_mrp; ?>" hidden="">
             <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
             <button class="btn btn-md btn-info" name="INCREASE" type="submit"><i class="fa fa-plus"></i></button>
            </form>
           </td>
          </tr>
          <tr>
           <td colspan="3" style="padding-top: 2% !important;font-size: 12px;">
            Qty <i class="fa fa-angle-right"></i> <?php
												if($Quantity >= 1000 and $letters = "GM"){
    	$Quantity = $Quantity/1000;
    	$letters = "KG";
    }  else {
    	$Quantity = $Quantity;
    	$letters = $letters;
    }
           echo $Quantity." $letters";
    ?>
           </td>
          </tr>
         </table>

        </div>
        <p
         style="color: black !important; font-size: 13px;text-align:right;margin-bottom:0%;clear:right;padding-top:1%;margin-top: -47px;padding: 3%;margin-left: -4px;border-radius: 12px;line-height: 95%;">
         <span>MRP : Rs. <?php echo $product_mrp;?> /
          <?php echo $product_tags;?></span><br>
         <span>PRICE : Rs.<?php echo $product_price;?> /
          <?php echo $product_tags;?></span><br>
         <span> Total : <i class="fa fa-inr"></i> <?php echo $product_price; ?> x
          <?php echo $product_quantity; ?> = <i class="fa fa-inr"></i> <b style="font-size: 13px;"><?php echo $product_total_amount; ?></b>
         </span>
        </p>
       </div>
      </div>
     </div>
     <?php } ?>

     <table style="width: 100%; font-size: 13px;" id="check">
      <tr>
       <td colspan="7">
        <?php
                    if (isset($_POST['OC'])) {
                      $OC = $_POST['OC'];
                      if(isset($_POST['OC'])){
                $coupon_code = "REWARD_POINTS";
              } else {
                $coupon_code = "NO COUPON";
              }
                      $REWARD_POINTS_VALUES = $_POST['REWARD_POINTS_VALUES'];

                      if ($OC == "REWARD_POINTS") {
                        $discount_price = $total_amount - $REWARD_POINTS_VALUES;
                        echo "<h6 class='text-success' style='width: 100%;'>
                               <span style='font-size:20px; color:black'><i class='fa fa-star text-danger'></i> Reward Points</span><br><br>
                                        <span style='font-size:3vw !important;' class='font-3'>Congratulation! <a href='cart.php' data-placement='top' data-toggle='tooltip' data-original-title='Remove Points' class='btn btn-danger text-white font-3 float-right' style='float:right;'><i class='fa fa-times'></i> Remove</a><br>
                                         Reward Points Redeem Successfully!<br> Your Points <i class='fa fa-inr'></i> $REWARD_POINTS_VALUES is now adjusted in This Purchase.<br></span></h6>
                                       ";
                      } elseif ($OC != $coupon_code) { ?>
        <h6 class='text-danger'><span class="text-left">INVALID Coupon Code</span>
         <a href='cart.php' data-placement='top' data-toggle='tooltip' data-original-title='Remove Coupon' class='text-danger text-right' style='margin-top:-25px;'><i class='fa fa-times'></i> Remove
        </h6>
        <?php } ?>
        <?php } else { ?>
        <h5 class="font-9"><i class="fa fa-star bottom-text text-success"></i> Reward Points </h5>

        <?php
if(isset($_SESSION['customer_id'])){
echo '<h5 class="font-6"><i class="fa fa-star text-success"></i>';
$select = "SELECT sum(rewards_point) FROM customer_rewards where customer_id='$customer_id' and reward_status='active'";
        $action = mysqli_query($con, $select);
        while ($record = mysqli_fetch_array($action)) {
          $TotalActiveRewards = $record['sum(rewards_point)'];
        }
         if($TotalActiveRewards == 0){
           echo "0";
         } else {
           echo $TotalActiveRewards;
         }

      ?>
        <small> Points</small><br>
        <?php
$select = "SELECT sum(rewards_point) FROM customer_rewards where customer_id='$customer_id' and reward_status='active'";
        $action = mysqli_query($con, $select);
        while ($record = mysqli_fetch_array($action)) {
          $TotalActiveRewards = $record['sum(rewards_point)'];
        }
         if($TotalActiveRewards == 0){
           echo "0";
         } else {
           echo $TotalActiveRewards;
         }
      ?> Points = <i class="fa fa-inr"></i> <?php
$select = "SELECT sum(rewards_point) FROM customer_rewards where customer_id='$customer_id' and reward_status='active'";
        $action = mysqli_query($con, $select);
        while ($record = mysqli_fetch_array($action)) {
          $TotalActiveRewards = $record['sum(rewards_point)'];
        }
         if($TotalActiveRewards == 0){
           echo "0";
         } else {
           echo $TotalActiveRewards;
         }
      ?>
        </h5>
        <p style="margin-top: -45px;">
         <?php
     if($TotalActiveRewards >= 1){ ?>
        <form class="float-right" action="" method="POST" style="width: 100%;">
         <input type="text" placeholder="Enter code" name='OC' class="form-control border-form-control" value="REWARD_POINTS" hidden="" style="display:none;">
         <input type="text" placeholder="Enter code" name='REWARD_POINTS_VALUES' class="form-control border-form-control" value="<?php
$select = "SELECT sum(rewards_point) FROM customer_rewards where customer_id='$customer_id' and reward_status='active'";
        $action = mysqli_query($con, $select);
        while ($record = mysqli_fetch_array($action)) {
          $TotalActiveRewards = $record['sum(rewards_point)'];
        }
         if($TotalActiveRewards == 0){
           echo "0";
         } else {
           echo $TotalActiveRewards;
         }
      ?>" hidden="" style="display: none;">
         <button class="btn btn-success btn-md float-right font-7" type="submit" style="float: right !important;"> Redeem</button>
        </form>
        <?php } else { ?>
        <span class="float-right" style="float: right;">Minimum : 1 Points</span><br>
        <a href="" class="float-right btn btn-outline-success btn-disable mt-2" style='clear:both;float: right;'>
         Not Applicable</a>
        <?php } ?>
        </p>
        <?php } else { ?>

        <h5 class="font-7">Please login to Check Reward Points</h5>
        <a href="login.php?go_url=<?php echo get_url();?>" class="btn btn-md btn-success bottom-text bottom-p text-white float-right pl-3 pr-3">Login First <i class="fa fa-angle-right"></i></a>
        <?php  } }  ?>

       </td>
      </tr>
      <tr>
       <td colspan="7">
        <hr>
       </td>
      </tr>

      <tr>
       <td colspan="7">
        <h5><b>Payment Details</b></h5>
       </td>
      </tr>
      <tr>
       <td class="text-left" colspan="4">Total MRP Price :</td>
       <td colspan="2" class="text-right"> <i class="fa fa-inr"></i> <?php
      if(isset($_SESSION['customer_id'])){
        $select = "SELECT sum(mrp_total) FROM customer_cart where  store_id='$store_id' and customer_id='$customer_id'";
        $action = mysqli_query($con, $select);
        while ($record = mysqli_fetch_array($action)) {
         echo $mrp_total = $record['sum(mrp_total)'];
        }
      } else {
        $select = "SELECT sum(mrp_total) FROM customer_cart where  store_id='$store_id' and ip_address='$device_info'";
        $action = mysqli_query($con, $select);
        while ($record = mysqli_fetch_array($action)) {
         echo $mrp_total = $record['sum(mrp_total)'];
        }
      }
        ?> </td>
      </tr>
      <tr>
       <td class="text-left" colspan="4">Total Product Price :</td>
       <td colspan="2" class="text-right"> <i class="fa fa-inr"></i>
        <?php echo $total_amount; ?> </td>
      </tr>
      <?php if (isset($_POST['OC'])) { ?>
      <tr>
       <td class="text-left" colspan="4">Points Redeemed:</td>
       <td colspan="2" class="text-right">
        - <?php
                      if ($OC == $coupon_code) {
                        echo "<i class='fa fa-inr'></i>" . $REWARD_POINTS_VALUES;
                      } elseif ($OC != $coupon_code) {
                        echo " 0 ";
                      }
                      ?>
       </td>
      </tr>
      <?php  } ?>
      <?php if (isset($_POST['OC'])) { ?>
      <tr>
       <td class="text-left" colspan="4">After Discount Price:</td>
       <td colspan="2" class="text-right">
        <?php if (isset($_POST['OC'])) {
                        if ($OC == $coupon_code) {
                          $discount_price = $REWARD_POINTS_VALUES;
                          $new_total_amount = $total_amount - $discount_price;
                          echo "<i class='fa fa-inr'></i> $new_total_amount";
                        } elseif ($OC != $coupon_code) {
                          echo "<i class='fa fa-inr'></i>" . $total_amount;
                        }
                      } ?>
       </td>
      </tr>
      <?php } ?>
      <tr>
       <td class="text-left" colspan="4">Delivery & Convenience Charges:
        <?php if (isset($_POST['OC'])) {

                      if ($OC == $coupon_code) {
                        $discount_price = $REWARD_POINTS_VALUES;
                        $new_total_amount = $total_amount - $discount_price;

                        if ($total_amount < $est_delivery_amount) {
                          
                        } elseif ($est_delivery_amount <= $total_amount) {
                          
                        } ?></td>
       <td colspan="2" class="text-right">
        <?php if ($total_amount < $est_delivery_amount) {
                          echo '+ <i class="fa fa-inr"></i> ' . $delivery_charges;
                        } elseif ($est_delivery_amount <= $total_amount) {
                          echo "Free";
                        }
                      } elseif ($OC != $coupon_code) { ?>:</td>
       <td colspan="2" class="text-right"> <?php if ($total_amount < $est_delivery_amount) {
                                      echo '<i class="fa fa-inr"></i> ' . $delivery_charges;
                                    } elseif ($est_delivery_amount <= $total_amount) {
                                      echo "<i class='fa fa-inr'></i> $concharge";
                                    }
                                  }
                                } else { ?></td>

       <td colspan="2" class="text-right">
        <?php if ($total_amount < $est_delivery_amount) {
                                    echo '+ <i class="fa fa-inr"></i> ' . $delivery_charges;
                                  } elseif ($est_delivery_amount <= $total_amount) {
                                    echo "<i class='fa fa-inr'></i> $concharge";
                                  }
                                } ?>

       </td>
      </tr>
      <tr>
       <td class="text-left" colspan="4" style="width: 75% !important;"><strong>Net Payable
         Amount :</strong></td>
       <td class="text-success text-right" colspan="2" style="width: 25% !important;font-size: 20px;"><strong><b><i class="fa fa-inr"></i>
          <?php if (isset($_POST['OC'])) {
                          if ($OC == $coupon_code) {
                            $discount_price = $REWARD_POINTS_VALUES;
                            $new_total_amount = $total_amount - $discount_price;
                            if ($total_amount < $est_delivery_amount) {
                              echo $delivery_charge + $new_total_amount + $concharge;
                            } elseif ($est_delivery_amount <= $total_amount) {
                              echo $new_total_amount + $concharge;
                            }
                          } else {
                            if ($total_amount < $est_delivery_amount) {
                              echo $delivery_charge + $total_amount + $concharge;
                            } elseif ($est_delivery_amount <= $total_amount) {
                              echo $total_amount + $concharge;
                            }
                          }
                        } else {
                          if ($total_amount < $est_delivery_amount) {
                            echo $delivery_charge + $total_amount + $concharge;
                          } elseif ($est_delivery_amount <= $total_amount) {
                            echo $total_amount + $concharge;
                          }
                        } ?></b> </strong></td>
      </tr>
      <tr>
       <td colspan="4">Estimate Reward Earning</td>
       <td align="right" colspan="2">
        <?php echo round($total_amount/100*$PointsEranings);?> Points
       </td>
      </tr>
      </tfoot>
     </table>
     <form action="insert.php" method="POST" name="checkoutForm">
      <?php
              if (isset($_GET['del'])) {
                $del = $_GET['del'];
                if ($del == "STORE_PICKUP") { ?>
      <input type="text" name="DELIVERY_TYPE" value="STORE_PICKUP" hidden="">
      <?php } elseif ($del == "DELIVERY") { ?>
      <input type="text" name="DELIVERY_TYPE" value="HOME_DELIVERY" hidden="">
      <?php  } else { ?>
      <input type="text" name="DELIVERY_TYPE" value="HOME_DELIVERY" hidden="">
      <?php }
              } else { ?>
      <input type="text" name="DELIVERY_TYPE" value="HOME_DELIVERY" hidden="">
      <?php }
              ?>
      <input type="text" name="product_total_amount" value="<?php echo $total_amount; ?>" hidden>
      <?php if (isset($_POST['OC'])) { ?>
      <input type="text" name="coupon_code" value="<?php echo $coupon_code; ?>" hidden="">
      <?php } elseif(!isset($_POST['OC'])) { ?>
      <input type="text" name="coupon_code" value="Not Redeemed" hidden="">
      <?php } ?>
      <input type="text" name="total_amount_after_discount" value="<?php
                                                                            if (isset($_POST['OC'])) {
                                                                              if ($OC == $coupon_code) {
                                                                                echo $new_total_amount;
                                                                              } else {
                                                                                echo $total_amount;
                                                                              }
                                                                            } else {
                                                                              echo $total_amount;
                                                                            } ?>" hidden>
      <input type="text" name="delivery_charge" value="
                        <?php if ($total_amount < $est_delivery_amount) {
                          echo $delivery_charge + $concharge;
                        } elseif ($total_amount >= $est_delivery_amount) {
                          echo $concharge;
                        } ?>" hidden>
      <div class="row">
       <div class="col-sm-12 col-xs-12">
        <hr>
        <h4 class="font-5"><i class="fa fa-truck text-success"></i> <b>Choose Delivery Slot</b></h4>
        <p class="font-5"><b>Morning</b> <i class="fa fa-angle-right"></i> 6:00 AM to 11:00 AM<br>
         <b>Evening </b><i class="fa fa-angle-right"></i> 2:00 PM to 6:00 PM
        </p>
        <p class="font-5"><span class="text-danger"><b>*</b></span> If you placed an order in morning time and choose morning slot for delivery then your order will be delivered next morning. If you
         placed order in morning time and choose evening slot for delivery than order will be delivered same day in evening slot.</p>
        <p id='TimeNotSelected' style="font-size: 14px;
      }
    color: red;
    font-weight: 600;"></p>
       </div>
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
        border-style: groove !important;
        box-shadow: 0px 0px 5px green !important;
        border-radius: 10px !important;
        border-width: thin;
        border-color: green;
       }

       </style>
       <div class="col-xs-6 col-sm-6 col-6">
        <label>
         <input type="radio" name="PICK_SCHEDULE_TIME" id="PICKSCHEDULETIME" value="MORNING" required="">
         <img src="img/morning.png" style="width: 100%; box-shadow: 0px 0px 4px grey;
    border-radius: 5px;
    padding: 3%;">
        </label>
       </div>
       <div class="col-xs-6 col-sm-6 col-6">
        <label>
         <input type="radio" name="PICK_SCHEDULE_TIME" id="PICKSCHEDULETIME2" value="EVENING" required="">
         <img src="img/evening.png" style="width: 100%; box-shadow: 0px 0px 4px grey;
    border-radius: 5px;
    padding: 3%;">
        </label>
       </div>
      </div>

      <input type="text" name="store_id" value="<?php echo $store_id; ?>" hidden="">
      <input type="text" name="net_payable_amount" value="<?php if (isset($_POST['OC'])) {
                                                                    if ($OC == $coupon_code) {
                                                                      $discount_price = $REWARD_POINTS_VALUES;
                                                                      $new_total_amount = $total_amount - $discount_price;
                                                                      if ($total_amount < $est_delivery_amount) {
                                                                        echo $delivery_charge + $new_total_amount + $concharge;
                                                                      } elseif ($est_delivery_amount <= $total_amount) {
                                                                        echo $new_total_amount + $concharge;
                                                                      }
                                                                    } else {
                                                                      if ($total_amount < $est_delivery_amount) {
                                                                        echo $delivery_charge + $total_amount + $concharge;
                                                                      } elseif ($est_delivery_amount <= $total_amount) {
                                                                        echo $total_amount + $concharge;
                                                                      }
                                                                    }
                                                                  } else {
                                                                    if ($total_amount < $est_delivery_amount) {
                                                                      echo $delivery_charge + $total_amount + $concharge;
                                                                    } elseif ($est_delivery_amount <= $total_amount) {
                                                                      echo $total_amount + $concharge;
                                                                    }
                                                                  } ?>" hidden>

      <br><br>

      <?php
              if (isset($_SESSION['customer_id'])) { ?>
      <a href="index.php" class="btn btn-lg btn-info w-50 rounded-0 float-left text-center bottom-text fixed-bottom text-white bottom-p"><i class="fa fa-angle-left"></i> Shop More</a>
      <button class="btn btn-lg btn-success fixed-bottom rounded-0 text-center w-50 float-right bottom-p bottom-text" type="submit" name='save_products_into_session' onclick="return validateform()"
       style="left: 50%;">
       <span class="text-center"><i class="fa fa-truck"></i> Delivery Address <i class="fa fa-angle-right"></i></span>
      </button>
      <?php } else { ?>
      <a href="index.php" class="btn btn-lg btn-info w-50 text-center bottom-text fixed-bottom text-white bottom-p"><i class="fa fa-angle-left"></i> Shop More</a>

      <a href="login.php?go_url=<?php echo get_url();?>" class="btn btn-lg btn-success fixed-bottom w-50 text-center bottom-p bottom-text text-white" style="float: right !important;left: auto;">
       Login for Checkout <i class="fa fa-angle-right"></i></a>
      <?php }
              ?>

     </form>
    </div>
    <?php } ?>
   </div>
   <div class="mb-15"></div>
  </section>
  <?php GetMsg();?>

  <?php GSI_footer_files();?>
  <script type="text/javascript">
  $('#carouselExampleIndicators').carousel({
   interval: 2300
  })
  </script>
 </body>

</html>
