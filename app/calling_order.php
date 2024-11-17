<?php require 'files.php'; require 'session.php'; ?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php'; GetMsg();?>
  <br>
  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 bg-success p-1">
     <h4 class="font-7 text-white"><i class="fa fa-shopping-cart text-warning"></i> Order On Call or Whatsapp</h4>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
     <p class="font-5 mt-1" style="text-align: justify;">Now you can place your order via a phone call or through your whatsapp, just click below icon of phone or whatsapp and than you will redirect
      to
      respective app and place your order.</p>

     <p class="font-5" style="text-align: justify;">Please ensure you will provide your basic information while placing order on phone or on whatsapp;</p>
     <ul class="font-5">
      <li>Your Name or Contact Person at Delivery Time</li>
      <li>Right Phone number</li>
      <li>Delivery Address</li>
      <li>Product list or Item Names.</li>
     </ul>

     <p class="font-5" style="text-align: justify;">You will recieve a notification on registered phone number or provided phone when your order is placed.</p>
     <h4 class="text-center font-6"><i class="fa fa-angle-left"></i> Place Order On <i class="fa fa-angle-right"></i></h4>
     <a href="tel:<?php echo $store_phone;?>"><img src="img/d8ef39_c465c2ab7aaa4c019cfe63babbab3ff7_mv2.gif" class="img-fluid float-left"
       style="width: 35%;background-color: white;border-radius: 100px; box-shadow: 0px 0px 2px grey;"></a>
     <a href="whatsapp://<?php echo $store_phone;?>"><img src="img/wp.gif" class="img-fluid float-right"
       style="width: 35%;background-color: white;border-radius: 100px; box-shadow: 0px 0px 2px grey;"></a>
     <a href="index.php" class="btn btn-info btn-block fixed-bottom bottom-text bottom-p text-white"><i class="fa fa-angle-left"></i> Back to Home</a>
     <br>
     <br><br>
    </div>
   </div>
  </section>

  <?php GSI_footer_files();?>
 </body>

</html>
