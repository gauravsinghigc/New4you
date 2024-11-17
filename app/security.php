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
 ?>
<html style="<?php echo $ThemeColor;?>">
    <head>
       <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title> 
       <?php GSI_header_files();?>   
    </head>
    <body>
        <?php include 'header.php'; GetMsg();?>

<section class="container-fluid pb-2">
    <div class="row">
    <div class="col-md-12 col-lg-12 col-12 pl-2 pr-2 account-page">
      <h4 class="font-5"><i class="fa fa-edit text-success"></i> Edit Profile <i class="fa fa-angle-right"></i> Login & Security</h4>
    </div>

      <div class="col-md-12 col-lg-12 col-12 pl-2 pr-2">
        <br>
          <form action='insert.php' method="POST">
            <input type="text" name="cr_url" value="<?php echo get_url();?>" hidden="">
              <input type="text"  name="customer_password_old" value='<?php echo $customer_password;?>' hidden>
              <input type="text" name="customer_mail_id" value="<?php echo $customer_mail_id;?>" hidden="">    
                   
                                 <div class="row">
                                     <div class="col-sm-12">
                                      <br>
                                       <div class="form-group">
                                          <input type="password" class="form-control tr-input font-6" name="cr_pass" value='' placeholder='Enter Current Password' required="">
                                       </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <br>
                                       <div class="form-group">
                                          <input type="password" class="form-control tr-input font-6" name="customer_password_new" value='' placeholder='Enter New Password' required="">
                                       </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                        <br>
                                         <div class="form-group">
                                          <input type="password" class="form-control tr-input font-6" name="customer_password_new_2" value='' placeholder='Re Enter New Password' required="" >
                                       </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                      <br>
                                       <button type="submit" name="update_customer_password" class="btn btn-success btn-sm fixed-bottom btn-block bottom-p bottom-text" onlick="SavingData()"><span id="SavingData">Update Password</span></button>
                                       <br>
                                       <a href="forget.php" class="btn btn-md btn-outline-info float-right bottom-text mt-2 w-60 mx-auto fixed-bottom" style="margin-bottom: 13%;">Forget Password?</a>
                                    </div>
                                 </div><br><br><br><br><br>
                              </form>
      </div>
    </div>
</section>

<?php GSI_footer_files();?>
    </body>
</html>