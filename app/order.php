<?php require 'files.php'; require 'session.php'; ?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php';?><br>
  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-md-12 col-12">
     <center>
      <h1><img src="img/tenor.gif" style="width: 30%;border-radius: 150px;"></h1>
      <h4 class="font-6">Order Placed Successfully!</h4>
      <h6 class="font-3">#
       <?PHP ECHO $_SESSION['order_id'];?>
      </h6>
      <p class="font-4">
       <?php
        if (isset($_SESSION['order_id'])) {
          $DELIVERY_TYPE = $_SESSION['DELIVERY_TYPE'];
          $order_id = $_SESSION['order_id'];
            if ($DELIVERY_TYPE == "STORE_PICKUP") {
              session_destroy($_SESSION['order_id']);
              session_destroy($_SESSION['DELIVERY_TYPE']);
              echo "<p class='font-4'>You choose your Order for Direct Pickup from store so please Reach at Store on time.</p>";
            } else {
              echo "<p class='font-4'>You Order Will be delivered in respective Delivery Slots.<br><b>Morning:</b> 6:00 AM to 11:00 AM.<br>
              <b>Evening:</b> 2:00 PM to 6:00 PM </p>";
            }
        }?></p>
      <a href="order_details.php?id=<?php echo $order_id;?>" class="btn btn-info btn-lg fixed-bottom text-white bottom-text bottom-p">View
       Order Details <i class="fa fa-angle-right"></i> </a>
     </center>
    </div>
   </div>
  </section>

  <?php GSI_footer_files();?>
 </body>

</html>
