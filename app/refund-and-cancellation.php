<?php require 'files.php'; include 'session.php';?>
<html style="<?php echo $ThemeColor; ?>">

 <head>
  <title><?php echo $AppNameWithExt; ?> ! <?php echo $AppTag; ?></title>
  <?php GSI_header_files(); ?>
 </head>

 <body>
  <!-- header part end -->
  <?php include ("header.php");?><br>
  <section class="container-fluid">
   <div class="row">
    <div class="col-lg-12 bg-success p-1">
     <h3 class="font-7 text-white ml-2">Refund & Cancellation</h3>
    </div>
    <div class="col-lg-12" style='text-align:justify;'>
     <a href="index.php">
      <button class="btn btn-lg fixed-bottom btn-block bottom-p bottom-text btn-info"><i class="fa fa-angle-left"></i> Back to Home</button>
     </a>
     <p class="mt-2"><b>></b> Refund for an order takes place 5-6 working days after verify order details and accepting refund request.<br>
      <b>></b> Refund request can be raise by app or website, it depends on customer which method they feel confortable.<br>
      <b>></b> Refund request can also be raise by sending email of invoice to support@24kharido.in, after verify order we proceed for refund methods.
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
  </section>
  <br><br><br>

  <?php GSI_footer_files(); ?>
 </body>

</html>
