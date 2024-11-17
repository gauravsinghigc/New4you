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
 $arealocality = $fetch['arealocality'];
 $custaddress = $fetch['custaddress'];
 $custcity = $fetch['custcity'];
 $custstate = $fetch['custstate'];
 $custpincode = $fetch['custpincode'];
 $contactperson = $fetch['contactperson'];
 $alternatenumber = $fetch['alternatenumber']; 
?>
<html style="<?php echo $ThemeColor;?>">
    <head>
       <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title> 
       <?php GSI_header_files();?>   
    </head>
    <body>
        <?php include 'header.php';?>

 <!-- header part end -->
 <section class="container-fluid">
  <div class="row">
   <div class="col-md-12" style='text-align:justify;'>
    <h5><i class="fa fa-star text-warning fa-spin"></i> <?php echo $APP_NAME;?> Reward Points <i class="fa fa-angle-right"></i></h5>
   </div>
  </div>
 </section>

 <section class="container-fluid">
  <div class="row p-1">
   <div class="col-lg-12" style='text-align:justify;' >
   <h4>What is <?php echo $AppNameWithExt;?> Rewards Points?</h4>
      <p><?php echo $AppNameWithExt;?> Rewards is the property of <?php echo $AppNameWithExt;?>. <?php echo $AppNameWithExt;?> Rewards Points can be earned by Customer when he/she make a purchase or Buy anything from <?php echo $AppNameWithExt;?> App And Our Partnered/Other App Developed by Only Mobilabs.in. <?php echo $AppNameWithExt;?> Rewards Points can be also Earned by Our authorised businesses that works with us.</p>

      <hr>

      <h4>How <?php echo $AppNameWithExt;?> Rewards Point Calculated?</h4>
      <p>
       <?php echo $AppNameWithExt;?> Rewards Points are earned whenever Customer Make a purchase from Store. It is earned on Both type Orders Home Delivery and Store Pickup.<br>
       <br><b><code>Note : </code></b> Delivery Charges are not a part of <?php echo $AppNameWithExt;?> Rewards Points. <?php echo $AppNameWithExt;?> Rewards Points are calculated on the Purchase amount excluding delivery charges and other offers.<br>
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

      <p><code>Note:</code> Currently we not providing Wallet/Bank/Upi Transfer service of Reward Points, as we start the process we update you via notification, sms, and e mails. So Please ensure you are providing your latest contact details to us. </p>

       <h3 class="text-success text-center">If You Have any Query</h3>
<h4 class="text-success text-center">
   Please feel free to contact us via Call on
    <br><br><a href="tel:<?php echo $store_phone;?>" class="text-white btn btn-info btn-md bottom-text bottom-p" style="display: inline-block;"><i class="fa fa-phone"></i> <?php echo $store_phone;?></a>
    <br><br> or Mail at<br><br> 
    <a href="mailto:<?php echo $store_mail_id;?>" class="text-white btn btn-info btn-md bottom-text bottom-p" style="display: inline-block;"><i class="fa fa-envelope"></i> <?php echo $store_mail_id;?></a>
</h4>
<br><br>
  <a href="index.php?msg=Earn Reward Points On Every Orders" class="btn btn-info bottom-text fixed-bottom bottom-p btn-block text-white"><i class="fa fa-star text-white fa-spin"></i> Earn Points Now <i class="fa fa-star text-white fa-spin"></i> </a>
  </div>
  </div>
 </section>
 <br><br><br>





<?php GSI_footer_files();?>
    </body>
</html>
