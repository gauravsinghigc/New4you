<?php
require 'files.php';
if (!isset($_SESSION['customer_id'])) {
   header("location: index.php?msg=logout");
}
if (isset($_GET['data'])) { ?>
<meta http-equiv="refresh" content="3; payment.php">
<?php } elseif(isset($_GET['msg'])){?>
<meta http-equiv="refresh" content="3; payment.php">
<?php } elseif (isset($_GET['err'])) { ?>
<meta http-equiv="refresh" content="3; payment.php">
<?php } else { } ?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $store_name;?> :  Payment</title>
     <?php require 'header_files.php';?>
<script type="text/javascript"></script>
   </head>
   <body>
      <?php require 'header.php'; ?>

      <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="index.php"><strong><span class="fa fa-home"></span> Home</strong></a> <span class="fa fa-angle-right"></span> <a href="">PAYMENT</a>
               </div>
            </div>
         </div>
      </section>

      <section class="checkout-page section-padding">
         <div class="container">
            <div class="row">
               <div class="col-md-8 mx-auto">
                  <div class="checkout-step">
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                           <div>
                              <div class="card-body">
                                 <div class="text-left">

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
       <h3>Online Payment</h3>
       <p>You choose Online Payment as a Payment Option, so click on Place Order button than your are redirect to our Payment Gateway. complete the Payment and then after Payment Success your order is Placed Successfully!</p>
       <input type="text" name="CUSTOMER_ID" value="<?php echo $customer_id;?>" hidden="">
        <input type="text" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo $order_id;?>" hidden>
        <input type="text" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo "CUST-ID-".$customer_id;?>" hidden>
        <input type="text" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" hidden >
        <input type="text" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB" hidden >
        <input type="text" tabindex="10" type="text" name="TXN_AMOUNT" value="2" hidden>
        <input type="text" name="email_id" value="<?php echo $customer_mail_id;?>" hidden>
        <input type="text" name="store_id" value="<?php echo $store_id;?>" hidden>
        <input type="text" name="phone_number" value="<?php echo $customer_phone_number;?>" hidden><br>
        <button type="submit" value="checkout" name="place_order" class="btn btn-lg btn-info" >Pay Now</button>
        <br><br>
        <p><code>*</code> Your payment is safe and secure with us. Please feel free to make this transaction with us.</p>

      </form>
    <?php } else { ?>
      <center>
      <img src="img/7VozH.gif" style="width: 25%;">
      <meta http-equiv="refresh" content="1, order_mail.php">
       <h3><i class="fa fa-refresh fa-spin text-success"></i> Creating Order, Please wait...</h3>
     </center>
      <?php } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </section>
 <?php require 'why_section.php'; require 'login_section.php'; require 'footer.php'; ?>
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
