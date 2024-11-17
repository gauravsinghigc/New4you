<?php require 'files.php'; ?>
<!DOCTYPE html>
<html>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <title><?php echo $store_name; ?> : Refund & Cancellation</title>
 <?php include 'header_files.php'; ?>
</head>

<body>
 <?php
 include "header.php"; ?>
 <!-- about section start -->
 <section class="about-page section-big-py-space">
  <div class="custom-container">
   <div class="row">
    <div class="col-lg-12 col-md-12">
     <h2><?php echo $APP_NAME; ?> Refund & Cancellation!</h2>
     <p><b>></b> Refund for an order takes place 5-6 working days after verify order details and accepting refund request.<br>
      <b>></b> Refund request can be raise by app or website, it depends on customer which method they feel confortable.<br>
      <b>></b> Refund request can also be raise by sending email of invoice to <?php echo $store_mail_id; ?>, after verify order we proceed for refund methods.
      <b>></b> No Refund for Fruits & vegetables, we replace the item on refund request instead of refund.<br>
      <b>> </b> Grocery items can be refunded after verify quality, order details, checking mfd date and way where it is dilevered.<br>
      <b>></b> Refund cannot be processed in cash, it is only processed UPI/DIRECT BANK DEPOSIT/WALLET methods/24kharido Funds only.<br>
      <b>Note: </b> Refund policy varies from item to item, so if you are raising a refund request it maybe rejected or non refundable in some case, which can be defines in mails
     </p>

     <h5>Order Cancellation</h5>
     <p><b>></b> An order be cancelled before "OUT OF DELIVERY" status, after Out for Delivery order cannot be cancelled. <br>
      <b>></b> You have to request for cancel your order from app or website, distributor verify your request. they may be accept of reject it. <br>
      <b>> </b> Cancellation depends on disributor decission.
     </p>
    </div>
   </div>
  </div>
 </section>
 <!-- about section end -->


 <?php include 'footer.php'; ?>
</body>

</html>