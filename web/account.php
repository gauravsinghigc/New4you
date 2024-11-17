<?php
require 'files.php';
if (!isset($_SESSION['customer_id'])) {
   header("location: login.php?msg=Login First!");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $store_name;?> :  Account</title>
     <?php require 'header_files.php';?>
   </head>
   <body>
      <?php require 'header.php';?>
      <section class="account-page section-padding">
         <div class="container-fluid ">
            <div class="row">
               <div class="col-lg-11 mx-auto">
                  <div class="row no-gutters">
                     <div class="col-md-4">
                        <div class="card account-left">
                           <?php include 'account_section.php';?>
                           <div class="list-group" style="font-size: 14px;">
                              <a href="account.php" class="list-group-item list-group-item-action active">
                                 <i aria-hidden="true" class="fa fa-user"></i>  My Account</a>
                              <a href="address.php" class="list-group-item list-group-item-action">
                                 <i aria-hidden="true" class="fa fa-map-marker"></i>  My Address</a>
                              <a href="order_list.php" class="list-group-item list-group-item-action">
                                 <i aria-hidden="true" class="fa fa-shopping-cart"></i> My Orders</a>
                              <a href="rewards.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-star"></i> Reward Points</a>
                              <a href="wallet.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-square"></i> 24kharido Funds</a>
                              <a href="refer.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-share"></i> Refer & Earns</a>
                              <a href="notification.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-bell"></i> Notification</a>

                              <a href="logout.php" class="list-group-item list-group-item-action">
                                 <i aria-hidden="true" class="fa fa-sign-out"></i>  Logout</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="card card-body account-right">
                           <div class="widget">
                              <div class="section-header">
                                 <h5 class="heading-design-h5">
                                   <i class="fa fa-user text-success"></i> My Account
                                 </h5>
                                 <hr>
                              </div>
                              <form action='insert.php' method="POST">
                                 <input type="text" name="customer_id" value="<?php echo $customer_id;?>" hidden>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                          <label class="control-label">Full name <span class="required text-danger">*</span></label>
                                          <input class="form-control border-form-control" name="customer_name" value="<?php echo $customer_name;?>" placeholder="<?php echo $customer_name;?>" type="text" style="padding: 1.5% !important;">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Phone <span class="required text-danger">*</span></label>
                                          <input class="form-control border-form-control" name="customer_phone_number" value="<?php echo $customer_phone_number;?>" placeholder="<?php echo $customer_phone_number;?>" type="text" readonly="">
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Email-ID/Username <span class="required text-danger">*</span></label>
                                          <input class="form-control border-form-control" name="customer_mail_id" value="<?php echo $customer_mail_id;?>" placeholder="<?php echo $customer_mail_id;?>" type="email">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12 text-right">
                                       <button type="submit" name="update_customer_data" class="btn btn-success btn-lg" onclick="SavingData()"><span id="SavingData"><?php
      if(isset($_GET['details_update'])){
        $address_update_value = $_GET['details_update'];
      if($_GET['details_update'] == "true") {
        echo "<i class='fa fa-check-circle mt-0'></i> Changes Saved!";
      } elseif ($_GET['details_update'] == "false") {
        echo "<i class='fa fa-warning mt-0'></i> Failed!";
       } else { echo "Save Changes"; }
      } else {
        echo "Save Changes";
      }
      ?></span></button>
                                    </div>
                                 </div>

                                 <div class="section-header">
                                 <h5 class="heading-design-h5">
                                   <i class="fa fa-lock text-success"></i> Change Password
                                 </h5>
                                 <hr>
                              </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                          <label class="control-label">Current Password</label>
                                          <input type="password" class="form-control border-form-control " name="customer_password_old" value='' placeholder='Enter Current Password' >
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">New Password</label>
                                          <input type="password" class="form-control border-form-control " name="customer_password_new" value='' placeholder='Enter New Password' >
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                         <div class="form-group">
                                          <label class="control-label">RE-Enter New Password</label>
                                          <input type="password" class="form-control border-form-control " name="customer_password_new_2" value='' placeholder='Re Enter New Password' >
                                       </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12 text-right">

                                       <a href='index.php' class="btn btn-info btn-lg"> Go to Home </a>
                                       <button type="submit" name="update_customer_password" class="btn btn-success btn-lg"><?php
      if(isset($_GET['pass_update'])){
        $address_update_value = $_GET['pass_update'];
      if($_GET['pass_update'] == "true") {
        echo "<i class='fa fa-check-circle mt-0'></i> Password Updated!";
      } elseif ($_GET['pass_update'] == "false") {
        echo "<i class='fa fa-warning mt-0'></i> Failed!";
       } else { echo "Update Password"; }
      } else {
        echo "Update Password";
      }
      ?></button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php
      require 'footer.php'; ?>
</body></html>

<div class="modal fade login-modal-main" id="upload-profile-image">
         <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-body">
                  <div class="login-modal">
                     <div class="row">
                        <div class="col-lg-12 pad-left-0">
                           <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true"><i class="fa fa-times"></i></span>
                           <span class="sr-only">Close</span>
                           </button>
                              <div class="login-modal-right">
                                    <div class="tab-pane" role="tabpanel">
                                       <h5 class="heading-design-h5"> <i class="fa fa-user text-info"></i> Upload Profile Image</h5>
                                     <form action="insert.php" method="POST" enctype="multipart/form-data">
                                     <input type="text" name="customer_id" value="<?php echo $customer_id;?>" hidden>
                                      <fieldset class="form-group">
                                         <input type="FILE" class="form-control" name="customer_image_uplaod" placeholder="Full Name" required="" accept="image/*" style="padding: 1% !important;">
                                         <span><code>*</code> Image Ratio 1x1 (SQAURE Image)</span><br>
                                         <span><code>*</code> Only Image formate are accepted like png, jpg, jpeg, gif.</span>
                                       </fieldset>
                                       <fieldset class="form-group">
                                          <button type="submit" name="upload_customer_dp" class="btn btn-lg btn-secondary btn-block"><i class='fa fa-upload'></i>Upload</button>
                                       </fieldset>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
