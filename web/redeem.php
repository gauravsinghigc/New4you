<?php
require 'files.php';
if (isset($_GET['data'])) { ?>
<meta http-equiv="refresh" content="3; checkout.php">
<?php } elseif(isset($_GET['msg'])){?>
<meta http-equiv="refresh" content="3; checkout.php">
<?php } elseif (isset($_GET['err'])) { ?>
<meta http-equiv="refresh" content="3; checkout.php">
<?php } else { } ?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $store_name;?> : Redeem Reward Points</title>
      <?php include 'header_files.php';?>
<script type="text/javascript"></script>
   </head>
   <body style="font-size: 15px !important;">
      <?php require 'header.php'; ?>

      <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <a href="index.php"><strong><span class="fa fa-home"></span> Home</strong></a> <span class="fa fa-angle-right"></span>  How to Redeem Reward Points
               </div>
            </div>
         </div>
      </section>
      <section class="container-fluid">
  <div class="row p-1 bg-white">
   <div class="col-lg-12" style='text-align:justify;' >
   <h4>What is <?php echo $store_name;?> Rewards Points?</h4>
      <p><?php echo $store_name;?> Rewards is the property of <?php echo $store_name;?>. <?php echo $store_name;?> Rewards Points can be earned by Customer when he/she make a purchase or Buy anything from <?php echo $store_name;?> App And Our Partnered/Other App Developed by Only Mobilabs.in. <?php echo $store_name;?> Rewards Points can be also Earned by Our authorised businesses that works with us.</p>

      <hr>

      <h4>How <?php echo $store_name;?> Rewards Point Calculated?</h4>
      <p>
       <?php echo $store_name;?> Rewards Points are earned whenever Customer Make a purchase from Store. It is earned on Both type Orders Home Delivery and Store Pickup.
       <br><br><b><code>Note : </code></b> Delivery Charges are not a part of <?php echo $store_name;?> Rewards Points. <?php echo $store_name;?> Rewards Points are calculated on the Purchase amount excluding delivery charges and other offers.<br>
      <br>
       <b>For Example :</b><br>
        If a customer Placed an Orders of Rs.100, then He earns upto 10 percentage of that amount as a <?php echo $AppNameWithExt;?> Reward Point which are redeemed at the time of other orders.
      </p>
      <p>Reward Point Calculation<br>
      
      Rewards Point : <br>100 / 100 * 10 = 10 Points  (Estimated Points)<br>
      
      <p>Earning Reward Points Varies from order to order and price to price. All Reward Points Before credit is estimated Points actuall value or Points are credit after successfull Checkout.</p>

      <h4>How you can use Reward Points</h4>
      <ul>
        <li>You Redeem All Reward Points when next order is Placed.</li>
        <li>Reward Points are Transferrable into your Wallet/BANK ACCOUNT/UPI Links and You can also request for your recharge and bill payments</li>
        <li>1 Minimum Reward Points is required for Redeemption, You can redeem all points that are above 1 Points</li>
        <li>For Bank/Wallet/Upi Transfer Minimum Reward Points should be 500 Points.</li>
      </ul>
<br>
      <p><code>Note:</code> Currently we not providing Wallet/Bank/Upi Transfer service of Reward Points, as we start the process we update you via notification, sms, and e mails. So Please ensure you are providing your latest contact details to us. </p>

       <h3 class="text-success text-center">If You Have any Query</h3>
<h4 class="text-success text-center">
   Please feel free to contact us via Call on
    <br><br><a href="tel:<?php echo $store_phone;?>" class="text-white btn btn-info btn-md bottom-text bottom-p" style="display: inline-block;"><i class="fa fa-phone"></i> <?php echo $store_phone;?></a>
    <br><br> or Mail at<br><br> 
    <a href="mailto:<?php echo $store_mail_id;?>" class="text-white btn btn-info btn-md bottom-text bottom-p" style="display: inline-block;"><i class="fa fa-envelope"></i> <?php echo $store_mail_id;?></a>
</h4>
<br><br>
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
