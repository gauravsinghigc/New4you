<center>
<button onclick="window.print();">Print</button>
<a href='delete.php?empty_cart=true'><button class="btn btn-sm btn-info" style="color:white; background-color: red;">Go to Home</button></a>
<h5>For Order Details, Please Check your email_id. Fully Details information is sent to your registered mail-id.</h5>
</center>
<?php
session_start();
require 'config.php';
require 'text.php';
require 'include.php';
      $customer_id = $_SESSION['customer_id'];
        $sql = "SELECT * from customers where customer_id='$customer_id'";
       $query = mysqli_query($con, $sql);
       $fetch = mysqli_fetch_assoc($query);
       $store_id = $fetch['store_id'];

       $customer_name = $fetch['customer_name'];
       $customer_mail_id = $fetch['customer_mail_id'];
       $customer_phone_number = $fetch['customer_phone_number'];
       $delivery_address = $_SESSION['delivery_address'];
       $payment_mode = $_SESSION['payment_mode'];
       $payment_amount = $_SESSION['net_payable_amount'];
       $product_total_amount_whole = $_SESSION['product_total_amount_entry'];
       $coupon_code = $_SESSION['coupon_code'];
       $total_amount_after_discount =  $_SESSION['total_amount_after_discount'];
       $delivery_charge = $_SESSION['delivery_charge'];
       $date_time = date("d M Y h:m A");
       $order_id = $_SESSION['order_id'];
       $store_id = $_SESSION['store_id'];
       $DELIVERY_TYPE = $_SESSION['DELIVERY_TYPE'];
       $order_month = date("m");
       $order_year = date("Y");
       $order_day = date("d");
       $order_date = date("d M Y, h:m a");
       $payment_note = "";
       $delivery_status = "NOT_PICK_UP";
       $delivery_date = "NA";
       $order_status = "NEW_ORDER";
       $PICK_SCHEDULE_TIME = $_SESSION['PICK_SCHEDULE_TIME'];

       $sql = "SELECT * FROM stores where store_id='$store_id'";
       $query = mysqli_query($con, $sql);
       $fetch = mysqli_fetch_assoc($query);
       $store_user_id = $fetch['user_id'];

       if($coupon_code == "REWARD_POINTS"){
        $select = "SELECT sum(rewards_point) FROM customer_rewards where customer_id='$customer_id' and reward_status='active'";
        $action = mysqli_query($con, $select);
        while ($record = mysqli_fetch_array($action)) {
          $TotalActiveRewards = $record['sum(rewards_point)'];
        }
          $RewardsValue = $TotalActiveRewards/100;
        $sql = "UPDATE customer_rewards SET reward_status='Redeemed' where customer_id='$customer_id'";
        $query = mysqli_query($con, $sql);

       } else {
          $TotalActiveRewards = "NA";
          $RewardsValue = "NA";
       }



       if ($payment_mode == "online_payment") {
        if($pay_valid == "true"){
          $payment_status = "Success - TXN ID: $order_id";
        } else {
          $payment_status = "Txn Failed!";
        }
       } elseif($payment_mode == "cash_on_delivery"){
          $payment_status = "NOT PAID";
       }
       $dis_amount = round($product_total_amount_whole/100*5);
       $Sql = "SELECT * FROM customer_orders where order_id='$order_id' and customer_id='$customer_id'";
       $Query = mysqli_query($con, $Sql);
       $CountOrders = mysqli_num_rows($Query);
       if($CountOrders == 0){
       $saveorder = "INSERT INTO customer_orders (order_id, customer_id, store_id, delivery_address, payment_mode, payment_note, coupon_code, net_payable_amount, payment_status, delivery_status, delivery_date, order_status, order_date, total_amount, total_amount_after_discount, delivery_charge, order_month, order_year, order_day, DELIVERY_TYPE, PICK_SCHEDULE_TIME, rewardspoints, rewardsamount, order_type) VALUES ('$order_id', '$customer_id', '$store_id', '$delivery_address', '$payment_mode', '$payment_note', '$coupon_code', '$payment_amount', '$payment_status', '$delivery_status', '$delivery_date', '$order_status', '$order_date', '$product_total_amount_whole', '$total_amount_after_discount', '$delivery_charge', '$order_month', '$order_year', '$order_day', '$DELIVERY_TYPE', '$PICK_SCHEDULE_TIME', '$TotalActiveRewards', '$RewardsValue', 'ONLINE')";
       $query =  mysqli_query($con, $saveorder);
       } else {
           header("location: done.php");
       }

       if ($query == true) {
        mysqli_set_charset($con, 'utf8');
       $savepro = "SELECT * from customer_cart where customer_id='$customer_id' and store_id='$store_id'";
       $query = mysqli_query($con, $savepro);
       $insert = "";
       while ($fetch =  mysqli_fetch_assoc($query)) {

         $product_names = $fetch['user_product_id'];
         $product_mrp = $fetch['product_mrp'];
         $product_price = $fetch['product_price'];
         $product_qty = $fetch['product_quantity'];
         $product_total_price = $fetch['product_total_amount'];
         $product_mrp_total = $fetch['mrp_total'];
         $producttags = $fetch['product_tags'];
         $product_full_name = "$product_names";
         $hindi_name = $fetch['hindi_name'];
         $product_img = $fetch['product_img'];
         $options = $fetch['options'];
         if($options == null ){
          $options = " ";
         } else {
          $options = $options;
         }
         $product_units = "$producttags";
    $letters = preg_replace('/[0-9.]/','',"$producttags");
    $numbers = preg_replace("/[^0-9\.]/", '', "$producttags");
    $Quantity = $product_qty*$numbers;
    

         $insert .= "('$order_id', '$store_id', '$customer_id', '$product_full_name', '$product_mrp', '$product_price', '$Quantity', '$product_total_price', '$product_mrp_total', '$producttags', 'false', '$product_img', '$hindi_name', '$options'),";
       }
          $insert = substr_replace($insert, '', -1, 1);
          mysqli_set_charset($con, 'utf8');
          $insert = "INSERT into ordered_products (order_id, store_id, customer_id, product_names, product_mrp, product_price, product_qty, product_total_price, product_mrp_total, product_tags, item_status, product_img, hindi_name, options) VALUES ".$insert;
         $queryinsert =  mysqli_query($con, $insert);
     if ($queryinsert == true) {
     $sql = "DELETE from customer_cart where customer_id='$customer_id'";
     $query = mysqli_query($con, $sql);
     if($query ==  true){
      $RewardPoints = round($product_total_amount_whole/100);
      $sql = "INSERT INTO customer_rewards (customer_id, order_id, store_id, rewards_point, reward_date, reward_status) VALUES ('$customer_id', '$order_id', '$store_id', '$RewardPoints', '$order_date', 'active')";
      $query = mysqli_query($con, $sql);
    if($RewardPoints != 0){
       NOTIFICATION_ALERT(
      $TITLE = "Rewards Earned!", 
      $DESC = "Your Reward Points $RewardPoints is credited to your Account Successfully, Your earned this on your ORDER ID : $order_id Purchase. You can reedem these any time. T&C Apply", 
      $STATUS = "NEW"
      );
     }

SMS(
$MSG = "$order_id>"."

Your Order Placed Successfully!
Amount : Rs.$payment_amount
Mode : $payment_mode
Status : $payment_status
Delivery Slot : $PICK_SCHEDULE_TIME

Track Order
https://bit.ly/3n9I9Gz", 
$PHONE = "$customer_phone_number"
);

NOTIFICATION_ALERT(
      $TITLE = "Order Placed Successfully!", 
      $DESC = "Your Order having #$order_id is placed Successfully and will be delivered coming $PICK_SCHEDULE_TIME at $delivery_address. Your Paymend mode is $payment_mode. Total Order Amount is Rs.$payment_amount. To know about your order details check My Orders.", 
      $STATUS = "NEW"
    );
     }
     
     }
   }
       ?>
