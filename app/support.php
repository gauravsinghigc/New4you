<?php require 'files.php';
require 'session.php'; ?>
<html style="<?php echo $ThemeColor; ?>">

 <head>
  <title><?php echo $AppNameWithExt; ?> ! <?php echo $AppTag; ?></title>
  <?php GSI_header_files(); ?>
 </head>

 <body>
  <?php include 'header.php';
   GetMsg(); ?>
  <br>
  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-12 bg-success p-1">
     <h4 class="font-7 text-white"><i class="fa fa-info-circle"></i> Feel Free to Contact Us</h4>
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12 col-12 pt-1">
     <p><small class="text-black font-3 pt-1">
       <?php if (isset($_SESSION['customer_id'])) {
                                                   echo "<i class='fa fa-star text-danger'></i> Dear $customer_name, you are already loged in So we pick Default contact details, please fill Subject and query now.";
                                                } ?></small></p>
     <hr>
     <form action="insert.php" method="POST">
      <input type="text" name="QUERY_SOURCE" value="ANDROID_APP" hidden="">
      <div class="form-group">
       <input type="text" name="full_name" class="form-control pl-4 font-5" placeholder="Full Name" required="" value="<?php if (isset($_SESSION['customer_id'])) {
                                                                                                                                       echo $customer_name;
                                                                                                                                    } else {
                                                                                                                                    } ?>" style="border-radius: 50px !important;">
      </div>
      <div class="form-group">
       <input type="email" name="email" class="form-control pl-4 font-5" placeholder="Email Id" required="" value="<?php if (isset($_SESSION['customer_id'])) {
                                                                                                                                 echo $customer_mail_id;
                                                                                                                              } else {
                                                                                                                              } ?>" style="border-radius: 50px !important;">
      </div>
      <div class="form-group">
       <input type="text" name="phone_number" class="form-control pl-4 font-5" placeholder="Phone Number" required="" value="<?php if (isset($_SESSION['customer_id'])) {
                                                                                                                                             echo $customer_phone_number;
                                                                                                                                          } else {
                                                                                                                                          } ?>" style="border-radius: 50px !important;">
      </div>
      <div class="form-group">
       <input type="text" name="query_subject" class="form-control pl-4 font-5" placeholder="Subject" required="" style="border-radius: 50px !important;">
      </div>
      <div class="form-group">
       <textarea class="form-control pl-3 font-5" name="query_details" placeholder="Enter Your Query Details" required="" rows="5" style="border-radius: 5px !important;"></textarea>
      </div>
      <div class="form-group">
       <button class="btn btn-md btn-success btn-block bottom-p bottom-text" type="submit" name="SAVE_QUERY" onclick="QueryClick()"><span id="QueryClick bottom-text"><i class="fa fa-send"></i> Send
         Query</span></button>
      </div>
     </form>
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12 col-12 p-2">
     <hr>
     <h3 class="text-success text-center">If You Have any Query</h3>
     <h4 class="text-success text-center font-6">
      Please feel free to contact us via Call <a href="tel:<?php echo $store_phone; ?>" class="text-white btn btn-md bottom-text fixed-bottom btn-info bottom-p"><i class="fa fa-phone"></i> Call @
       <?php echo $store_phone; ?></a>or Mail at <br><br><a href="mailto:<?php echo $store_mail_id; ?>" class="text-white btn btn-md btn-info bottom-text bottom-p"><i class="fa fa-envelope"></i>
       <?php echo $store_mail_id; ?></a>
     </h4><br><br>
    </div>
   </div>
  </section>

  <?php GSI_footer_files(); ?>
 </body>

</html>
