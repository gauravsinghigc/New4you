<?php require 'files.php';
require 'session.php';
if (!isset($_SESSION['customer_id'])) {
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
$customer_password = $fetch['customer_password'];
$cust_dp = $fetch['customer_image'];
$arealocality = $fetch['arealocality'];
$custaddress = $fetch['custaddress'];
$custcity = $fetch['custcity'];
$custstate = $fetch['custstate'];
$custpincode = $fetch['custpincode'];
$contactperson = $fetch['contactperson'];
$alternatenumber = $fetch['alternatenumber'];
?>
<html style="<?php echo $ThemeColor; ?>">

<head>
   <title><?php echo $AppNameWithExt; ?> ! <?php echo $AppTag; ?></title>
   <?php GSI_header_files(); ?>
</head>

<body>
   <?php include 'header.php';
   GetMsg(); ?>

   <section class="container-fluid pb-2">
      <div class="row">
         <div class="col-md-12 col-lg-12 col-12 pl-2 pr-2 account-page">
            <h4 class="font-5"><i class="fa fa-edit text-success"></i> Edit Profile <i class="fa fa-angle-right"></i> Basic Information</h4>
         </div>

         <div class="col-md-12 col-lg-12 col-12 pl-2 pr-2">
            <form action='insert.php' method="POST">
               <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
               <input type="text" name="cr_pass" value="<?php echo $customer_password; ?>" hidden>
               <input type="text" name="customer_password_old" value='<?php CDATA("customer_password"); ?>' hidden>
               <input type="text" name="customer_id" value="<?php CDATA("customer_id"); ?>" hidden>
               <div class="row">
                  <div class="col-sm-12 mt-4">
                     <div class="form-group">
                        <input class="form-control tr-input font-5" name="customer_name" value="<?php CDATA("customer_name"); ?>" placeholder="<?php echo $customer_name; ?>" type="text">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12 mt-4">
                     <div class="form-group">
                        <input class="form-control tr-input font-6 bg-grey text-black" name="customer_phone_number" value="<?php CDATA("customer_phone_number"); ?>" placeholder="<?php echo $customer_phone_number; ?>" type="text" readonly="">
                     </div>
                  </div>
                  <div class="col-sm-12 mt-4">
                     <div class="form-group">
                        <input class="form-control tr-input font-6 bg-grey text-black" name="customer_mail_id" value="<?php CDATA("customer_mail_id"); ?>" placeholder="<?php echo $customer_mail_id; ?>" type="email" readonly="">
                     </div>
                     <span class="font-5"><code>Note : </code> Phone number and mail-id cannot be changed. If you still want to change your phone number or mail-id then please call on <a href="<?php echo $store_phone; ?>" class="text-info"><?php echo $store_phone; ?></a> or mail us at <a href="<?php echo $store_mail_id; ?>" class="text-info"><?php echo $store_mail_id; ?></a></span>
                  </div>
               </div>
               <div class="row mt-5">
                  <div class="col-sm-12 text-right">
                     <button type="submit" name="update_customer_data" class="btn btn-success fixed-bottom btn-block btn-sm bottom-text bottom-p" onclick="SavingData()"> <span id="SavingData">Save Changes</span></button>
                  </div>
               </div>
            </form>

         </div>
      </div>
   </section>

   <?php GSI_footer_files(); ?>
</body>

</html>