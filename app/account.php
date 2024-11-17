<?php require 'files.php'; require 'session.php';
if(!isset($_SESSION['customer_id'])){
  header("location: index.php?msg=You are Logout, Please Login First!");
}
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
$customer_status_check = $fetch['customer_status'];
if ($customer_status_check == "verified") {
  $customer_statusview = "<i class='fa fa-check-circle text-success'></i> Verified";
} else {
  $customer_statusview = "<a href='verify.php' class='btn btn-danger btn-sm text-white'><i class='fa fa-warning mt-0'></i> Verify Account</a>";
}
 ?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php'; GetMsg();?>

  <section class="container-fluid pb-2">
   <div class="row" style="background-image: linear-gradient(#f1fff0, #1bff000f) !important;">
    <div class="col-md-12 col-lg-12 col-12 text-center pt-2">

     <i class="fa fa-user bg-white p-2 circle pl-5 pr-5 mt-2" style="font-size:30vw;"></i>

    </div>
    <div class="col-md-12 col-lg-12 col-12 text-left p-2 pt-2 mt-2 pr-1 pl-2">
     <p class="text-black">
      <span class="font-6" style="text-transform: uppercase;"><b><?php echo $customer_name;?></b></span><br>
      <spna class="font-4"><b>Status :</b> <?php echo $customer_statusview;?></spna><br>
      <span class="font-4"><i class="fa fa-phone-square"></i> +91-<?php echo $customer_phone_number;?></span><br>
      <span class="font-4"><i class="fa fa-envelope"></i> <?php echo $customer_mail_id;?></span><br>
      <span class="font-4"><i class="fa fa-map-marker"></i> <?php echo "$custaddress, $arealocality, $custcity,  $custstate - $custpincode";?></span><br>
      <span class="font-4"><i class="fa fa-info-circle"></i> <?php echo $contactperson;?></span>,
      <span class="font-4"><?php echo $alternatenumber;?></span>
     </p>
    </div>
   </div>

   <div class="row">
    <div class="col-md-12 col-lg-12 col-12 pl-1 pr-1 account-page pt-2">
     <h4 class="font-7"><i class="fa fa-edit text-success"></i> Edit Profile</h4>

     <a href="information.php">
      <h4><i class="fa fa-user"></i> Basic Information <i class="fa fa-angle-right font-11 float-right mr-2"></i></h4>
     </a>

     <a href="address.php">
      <h4><i class="fa fa-map-marker"></i> My Address <i class="fa fa-angle-right font-11 float-right mr-2"></i></h4>
     </a>

     <a href="security.php">
      <h4><i class="fa fa-gear"></i> Login & Security <i class="fa fa-angle-right font-11 float-right mr-2"></i></h4>
     </a>
     <hr>
    </div>

    <div class="col-md-12 col-lg-12 col-12 pl-1 pr-2 account-page">
     <h4 class="font-7"><i class="fa fa-user text-success"></i> My Account</h4>

     <a href="cart.php">
      <h4><i class="fa fa-shopping-cart"></i> Shopping Cart <i class="fa fa-angle-right font-11 float-right mr-2"></i></h4>
     </a>

     <a href="orders.php">
      <h4><i class="fa fa-shopping-cart"></i> All Orders <i class="fa fa-angle-right font-11 float-right mr-2"></i></h4>
     </a>

     <a href="rewards.php">
      <h4><i class="fa fa-star"></i> Reward Points <i class="fa fa-angle-right font-11 float-right mr-2"></i></h4>
     </a>

     <a href="notification.php">
      <h4><i class="fa fa-bell"></i> Notifications <i class="fa fa-angle-right font-11 float-right mr-2"></i></h4>
     </a>

     <a href="wallet.php">
      <h4><i class="fa fa-inr"></i> &nbsp;24kharido Funds <i class="fa fa-angle-right font-11 float-right mr-2"></i></h4>
     </a>

     <a href="track-order.php">
      <h4><i class="fa fa-truck"></i> Track Orders <i class="fa fa-angle-right font-11 float-right mr-2"></i></h4>
     </a>

     <a href="refers.php">
      <h4><i class="fa fa-refresh"></i> Refer & Earn <i class="fa fa-angle-right font-11 float-right mr-2"></i></h4>
     </a>

     <a href="support.php">
      <h4><i class="fa fa-info-circle"></i> Help & Support <i class="fa fa-angle-right font-11 float-right mr-2"></i></h4>
     </a>

     <a href="logout.php">
      <h4><i class="fa fa-sign-out"></i> Logout <i class="fa fa-angle-right font-11 float-right mr-2"></i></h4>
     </a>

     <hr>
     <br>
    </div>

   </div>
  </section>

  <?php GSI_footer_files();?>
 </body>

</html>
