<?php require 'files.php'; require 'session.php';
$customer_id = $_SESSION['customer_id'];
$sql = "SELECT * from customers where customers.customer_id='$customer_id' ";
$query = mysqli_query($con, $sql);
$count_address = mysqli_num_rows($query);
$fetch = mysqli_fetch_assoc($query);
 $customer_name = $fetch['customer_name'];
 $customer_mail_id = $fetch['customer_mail_id'];
 $customer_phone_number = $fetch['customer_phone_number'];
 $customer_password= $fetch['customer_password'];
 $cust_dp = $fetch['customer_image'];
 $sql = "SELECT * from customer_address where customer_id ='$customer_id' and status='active'";
$query = mysqli_query($con, $sql);
$count_address = mysqli_num_rows($query);
$fetch = mysqli_fetch_assoc($query);
$customer_address_id = $fetch['customer_address_id'];
$street_address = $fetch['street_address'];
$area_locality = $fetch['area_locality'];
$customer_city = $fetch['customer_city'];
$customer_state = $fetch['customer_state'];
$address_pincode = $fetch['address_pincode'];
$contact_person = $fetch['contact_person'];
$alternate_phone = $fetch['alternate_phone']; ?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php';?>

  <!-- header part end --><br>
  <section class="container-fluid pb-0">
   <div class="row">
    <div class="col-md-12 bg-success p-1">
     <h5 class="font-7 text-white"><i class="fa fa-truck"></i> Order Confirmation <i class="fa fa-angle-right"></i></h5>
    </div>
    <div class="col-md-12">
     <?php
         if (isset($_GET['msg'])) {
                $msg = $_GET['msg'];
                 echo "<p class='text-success'>$msg";
                 echo '<button onclick="remove_msg()" href="#" class="btn btn-link float-right close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-times" style="margin-top: -10px;color:red; "></i></button></p>';
                }  elseif (isset($_GET['err'])) {
                    $err= $_GET['err'];
                 echo "<p class='text-danger'>$err";
                 echo '<button onclick="remove_msg()" href="#" class="btn btn-link float-right close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-times" style="margin-top: -10px;color:red; "></i></button></p>';
                }
        ?>
    </div>
   </div>
  </section>

  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-md-12 col-lg-12 col-12">
     <?php
                                   $payment_mode = $_SESSION['payment_mode'];
                                   $order_id = $_SESSION['order_id'];
                                   $customer_id = $_SESSION['customer_id'];
                                   $net_payable_amount = $_SESSION['net_payable_amount'];
                                   $customer_mail_id = $customer_mail_id;
                                   $store_id;
                                   $customer_phone_number;
      if ($payment_mode == "online_payment") {?>
     <form method="post" action="pgRedirect.php">
      <h4 class="font-6">Online Payment</h4>
      <p class="font-3">You choose Online Payment as a Payment Option, so click on Place Order button than your
       are redirect to our Payment Gateway. complete the Payment and then after Payment Success
       your order is Placed Successfully!</p>
      <input type="text" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo $order_id;?>" hidden>
      <input type="text" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo "CUST-ID-".$customer_id;?>" hidden>
      <input type="text" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" hidden>
      <input type="text" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB" hidden>
      <input type="text" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo $net_payable_amount;?>" hidden>
      <input type="text" name="email_id" value="<?php echo $customer_mail_id;?>" hidden>
      <input type="text" name="store_id" value="<?php echo $store_id;?>" hidden>
      <input type="text" name="phone_number" value="<?php echo $customer_phone_number;?>" hidden><br>
      <button type="submit" value="checkout" name="place_order" class="btn btn-lg btn-info">Pay
       Now</button>
      <br><br>
      <p><code>*</code> Your payment is safe and secure with us. Please feel free to make this
       transaction with us.</p>

     </form>
     <?php } else { ?>
     <form method="post" action="order_mail.php">
      <h4 class="text-primary font-6"><i class="fa fa-check-circle text-success"></i> Pay at Delivery</h4>
      <p style="font-size: 13px;">You choose Pay on Cash/Wallet/UPI On Delivery as you Payment Option. Please Pay <b class="text-danger">Rs.<?php echo $net_payable_amount;?></b> at Time of Delivery.
       For Confirm this click below and Place Your Order.</p>
      <input type="text" name="ORDER_ID" value="<?php echo $order_id;?>" hidden>
      <button type="submit" value="" name="place_order_cash" class="btn btn-lg btn-block fixed-bottom bottom-text btn-info bottom-p" onclick="OrderPlacing()" id="OrderPlaced">
       <i class="fa fa-check-circle text-white"></i> Place Order
      </button>
     </form>
     <script type="text/javascript">
     function OrderPlacing() {
      document.getElementById("OrderPlaced").innerHTML = "<i class='fa fa-refresh text-white fa-spin'></i> Creating Order, Please wait...";
     }
     </script>
     <?php } ?><br><br><br>
    </div>
   </div>
  </section>

  <?php GSI_footer_files();?>
 </body>

</html>
