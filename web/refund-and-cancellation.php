<?php require 'files.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title><?php echo $store_name; ?> : Refund & Cancellation</title>
   <?php include 'header_files.php'; ?>
   <script type="text/javascript"></script>
</head>

<body style="font-size: 15px !important;">
   <?php require 'header.php'; ?>

   <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <a href="index.php"><strong><span class="fa fa-home"></span> Home</strong></a> <span class="fa fa-angle-right"></span> <a href="about-us.php">About Us</a> <span class="fa fa-angle-right"></span> Refund & Cancellation <?php echo $store_name; ?>
            </div>
         </div>
      </div>
   </section>
   <section class="container-fluid">
      <div class="row bg-white">
         <div class="col-md-12 col-lg-12 col-sm-12 p-1" style="text-align: justify; padding-left: 1% !important;">
            <h3 class="mt-2"><?php echo $store_name; ?> Refund & Cancellation</h3>
            <h5>Refund</h5>
            <p><b>></b> Refund for an order takes place 5-6 working days after verify order details and accepting refund request.<br>
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
   <?php require 'why_section.php';
   require 'login_section.php';
   require 'footer.php'; ?>
   <!-- Bootstrap core JavaScript -->
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <!-- select2 Js -->
   <script src="js/select2.min.js"></script>
   <!-- Owl Carousel -->
   <script src="js/owl.carousel.js"></script>
   <!-- Custom -->
   <script src="js/custom.js"></script>


</body>

</html>