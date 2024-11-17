<?php
require 'files.php';
require 'session.php';

if (isset($_POST['view_person_id'])) {
    $user_view_id = $_POST['view_person_id'];
    $_SESSION['view_person_id'] = $_POST['view_person_id'];
} else {
    $user_view_id = $_SESSION['view_person_id'];
}
$sql = "SELECT * FROM users where user_id='$user_view_id'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);

$full_name_user = $fetch['full_name'];
$username = $fetch['username'];
$password = $fetch['password'];
$email_id = $fetch['email_id'];
$phone_number = $fetch['phone_number'];
$user_address = $fetch['user_address'];
$user_arealocality = $fetch['user_arealocality'];
$user_city = $fetch['user_city'];
$user_state = $fetch['user_state'];
$user_pincode = $fetch['user_pincode'];
$DateTime = $fetch['date_time'];
$user_status_check = $fetch['user_status'];
$user_verification_check = $fetch['user_verification'];
$user_role = $fetch['user_role'];

if ($user_status_check == "Inactive" or $user_status_check == "BLOCK" or $user_status_check == "LEAVED") {
    $user_status_show = "<i class='text-warning fa fa-warning'> Inactive</i>";
} else {
    $user_status_show = "<i class='text-success fa fa-check-circle'> Active</i>";
}

if ($user_verification_check == "Unverified") {
    $user_verification = "<i class='text-warning fa fa-warning'> Unverified</i>";
} else {
    $user_verification = "<i class='text-success fa fa-check-circle'> Verified</i>";
}
$tnc = $fetch['tnc'];
$ref = $fetch['ref'];
$user_img = $fetch['user_img'];
if ($user_img == null) {
    $userimg = "app-assets/images/portrait/small/avatar-s-26.png";
} else {
    $userimg = $fetch['user_img'];
}

$sql = "SELECT * from user_types where user_type_id='$user_role'";
$query = mysqli_query($con, $sql);
$fetch =  mysqli_fetch_assoc($query);
$user_role_cr = $fetch['user_type_title'];
$user_type_id = $fetch['user_type_id'];
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title><?php echo $full_name_user; ?> : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click"
 data-menu="vertical-menu-modern" data-col="2-columns">

 <?php require 'header.php'; ?>


 <?php require 'sidebar.php'; ?>

 <!-- BEGIN: Content-->
 <div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
   <div class="content-header row">
    <div class="col-lg-12 card-content">
     <?php notification(); ?>
    </div>
   </div>
   <div class="content-body">
    <!-- users edit start -->
    <section class="users-edit">
     <div class="card">
      <div class="card-content">
       <div class="card-body">
        <ul class="nav nav-tabs mb-2" role="tablist">
         <li class="nav-item">
          <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account"
           aria-controls="account" role="tab" aria-selected="true">
           <i class="fa fa-user mr-25"></i>Account<span class="d-none d-sm-block"></span>
          </a>
         </li>
         <li class="nav-item">
          <a class="nav-link d-flex align-items-center" id="documents-tab" data-toggle="tab" href="#documents"
           aria-controls="documents" role="tab" aria-selected="false">
           <i class="fa fa-file mr-25"></i>Documents<span class="d-none d-sm-block"></span>
          </a>
         </li>
         <li class="nav-item">
          <a class="nav-link d-flex align-items-center" id="setting-tab" data-toggle="tab" href="#setting"
           aria-controls="setting" role="tab" aria-selected="false">
           <i class="fa fa-gears mr-25"></i>Setting<span class="d-none d-sm-block"></span>
          </a>
         </li>
         <?php
                                    if ($user_role_cr == "STORE_USER") { ?>
         <li class="nav-item">
          <a class="nav-link d-flex align-items-center" id="store-set-tab" data-toggle="tab" href="#store-set"
           aria-controls="store-set" role="tab" aria-selected="false">
           <i class="fa fa-home mr-25"></i> Store Setting<span class="d-none d-sm-block"></span>
          </a>
         </li>
         <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="subs.php?store_id=<?php echo $store_id; ?>">
           <i class="fa fa-inr mr-25"></i> Subscription<span class="d-none d-sm-block"></span>
          </a>
         </li>

         <?php }
                                    ?>
        </ul>
        <!-- users edit media object start -->
        <div class="media mb-2">
         <a class="mr-2" href="#">
          <img src="<?php echo $userimg; ?>" alt="<?php echo $full_name; ?>" title="<?php echo $full_name; ?>"
           class="users-avatar rounded-circle" height="64" width="64">
         </a>
         <div class="media-body">
          <h4 class="media-heading"><i class="fa fa-user"></i>
           <?php echo $full_name_user; ?><br>
           <small class="font-small-3"><i class="fa fa-briefcase"></i>
            <?php echo $user_role_cr; ?> <i class="fa fa-angle-right"></i>
            <?php echo $user_status_show; ?> <i class="fa fa-angle-right"></i>
            <?php echo $user_verification; ?> </small>
          </h4>
          <div class="col-12 px-0 d-flex">
           <a href="#" data-toggle="modal" data-target="#upload_profile" class="btn btn-sm btn-primary mr-25">Upload
            Profile</a>
          </div>
         </div>
         <div class="modal fade text-left" id="upload_profile" tabindex="-1" role="dialog"
          aria-labelledby="myModalLabel17" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
            <div class="modal-header">
             <h4 class="modal-title" id="myModalLabel17">
              <?php echo $full_name_user; ?> <i class="fa fa-angle-right"></i> Upload Profile</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
             </button>
            </div>
            <div class="modal-body">
             <form class="form" action="update.php" method="POST" enctype="multipart/form-data">
              <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
              <input type="text" name="user_id" value="<?php echo $user_view_id; ?>" hidden>
              <div class="row">
               <div class="col-md-12">
                <label>Upload Profile<small class="text-muted"><i class="fa fa-angle-right"></i> square
                  image are best fit like 100x100.
                 </small></label>
                <input type="FILE" name="userimg" value="" class="form-control" required="">
               </div>
              </div>

            </div>
            <div class="modal-footer">
             <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
             <button type="submit" class="btn btn-outline-primary" name="UPDATE_PROFILE_IMG">Save Profile</button>
             </form>
            </div>
           </div>
          </div>
         </div>
        </div>
        <!-- users edit media object ends -->
        <div class="tab-content">
         <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">

          <!-- users edit account form start -->
          <form action="update.php" method="POST">
           <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
           <input type="text" name="user_id" value="<?php echo $user_view_id; ?>" hidden>
           <input type='text' name='user_type_id' value='<?php echo $user_type_id; ?>'>
           <div class="row">
            <div class="col-md-4">
             <div class="form-group">
              <label>USER ROLE</label>
              <input type="text" class="form-control" name="" value="<?php echo $user_role_cr; ?>"
               placeholder="USER ROLE" required="" readonly>
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Full name</label>
              <input type="text" class="form-control" name="full_name" value="<?php echo $full_name_user; ?>"
               placeholder="Full Name" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Enter Email-id</label>
              <input type="email" class="form-control" name="email_id" value="<?php echo $email_id; ?>"
               placeholder="Email Id">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Phone Number (excluding +91)</label>
              <input type="text" class="form-control" name="phone_number" value="<?php echo $phone_number; ?>"
               placeholder="+91" required="">
             </div>
            </div>


            <div class="col-md-4">
             <div class="form-group">
              <label>Street Address</label>
              <input type="text" class="form-control" value="<?php echo $user_address; ?>" name="user_address"
               placeholder="H no/Flat no/Street Address" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Area Locality</label>
              <input type="text" class="form-control" value="<?php echo $user_arealocality; ?>" name="user_arealocality"
               placeholder="Area/ Sector/ Locality/" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>City</label>
              <input type="text" class="form-control" value="<?php echo $user_city; ?>" name="user_city"
               placeholder="City" required="" readonly>
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>State</label>
              <input type="text" class="form-control" name="user_state" value="<?php echo $user_state; ?>"
               placeholder="State" required="" readonly>
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Area Pincode</label>
              <input type="text" class="form-control" name="user_pincode" value="<?php echo $user_pincode; ?>"
               placeholder="Pincode" required="" readonly>
              <a href='
                                                    https://www.indiapost.gov.in/VAS/Pages/findpincode.aspx'
               target="blank">Don't Know Pincode</a>
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>User Status</label>
              <select class="form-control" name="user_status">
               <option value="active">Active</option>
               <option value="Inactive">Inactive</option>
               <option value="BLOCK">BLOCK</option>
               <option value="LEAVED">LEAVED</option>
              </select>
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>User Verification</label>
              <select class="form-control" name="user_verification">
               <option value="Verified">Verified</option>
               <option value="Unverified">UnVerified</option>
              </select>
             </div>
            </div>
            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
             <button type="submit" name="UPDATE_USERS" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1"> Save
              Updates</button>
            </div>
           </div>
          </form>
          <!-- users edit account form ends -->
         </div>
         <div class="tab-pane" id="documents" aria-labelledby="documents-tab" role="tabpanel">
          <!-- users edit Info form start -->
          <div class="row">
           <div class="col-lg-12">
            <h4>Uploaded Documents <i class="fa fa-angle-right"></i>
             <small>Compulsory documents pancard, adhaar card.</small>
            </h4>

            <table class="table" style="width: 100% !important;">
             <?php
                                                    $sql = "SELECT * FROM user_documents, user_documents_types where user_documents.user_id='$user_view_id' and user_documents.document_id=user_documents_types.document_id ";
                                                    $query =  mysqli_query($con, $sql);
                                                    $countdoc = mysqli_num_rows($query);
                                                    if ($countdoc == 0) {
                                                        echo "<tr><td><h6 class='text-warning'><i class='fa fa-warning'></i>  Please Upload documents, for account verification.</h2></t6>";
                                                    } else {
                                                        while ($fetch = mysqli_fetch_assoc($query)) { ?>
             <tr>
              <td><?php echo $fetch['document_name']; ?></td>
              <td><a href="USER_DATA/userdoc/<?php echo $fetch['document_file']; ?>" target='blank'><i
                 class="fa fa-eye"></i>
                <?php echo $fetch['document_file']; ?></a></td>
             </tr>
             <?php }
                                                    } ?>
            </table>
           </div>
          </div>
          <form action="insert.php" method="POST" enctype="multipart/form-data">

           <input type="text" name="user_id" value="<?php echo $user_view_id; ?>" hidden>
           <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
           <div class="row">
            <div class="col-lg-12">
             <hr>
             <hr>
             <h6>Upload New Documents</h6>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
             <div class="form-group">
              <label>SELECT Type</label>
              <select class="form-control" name="document_id" required="">
               <?php

                                                            $sql = "SELECT * FROM user_documents_types";
                                                            $query =  mysqli_query($con, $sql);
                                                            while ($fetch = mysqli_fetch_assoc($query)) {
                                                                $document_id = $fetch['document_id'];
                                                                $document_name = $fetch['document_name'];
                                                                echo "<option value='$document_id'>$document_name</option>";
                                                            }
                                                            ?>
              </select>
             </div>
            </div>

            <div class="col-md-6 col-lg-6 col-sm-12">
             <div class="form-group">
              <label>&nbsp;</label>
              <input class="form-control" type="FILE" name="document_file" value="" required>
             </div>
            </div>

            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
             <button type="submit" name="SAVE_DOCUMENTS" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Upload
              Documents</button>
             <button type="reset" class="btn btn-light">Cancel</button>
            </div>
           </div>
          </form>
          <!-- users edit Info form ends -->
         </div>

         <div class="tab-pane" id="setting" aria-labelledby="setting-tab" role="tabpanel">
          <!-- users edit Info form start -->
          <form action="update.php" method="POST">
           <input type="text" name="user_id" value="<?php echo $user_view_id; ?>" hidden>
           <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
           <input type="text" name="cr_pass" value="<?php echo $password; ?>" hidden>
           <div class="row">
            <div class="col-md-12 col-lg-12">
             <h5 class="mb-1"><i class="fa fa-key mr-25"> Login Settings</i>
             </h5>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
             <div class="form-group">
              <label>Username</label>
              <input class="form-control" type="text" name="username" value="<?php echo $username; ?>" required>
             </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
             <div class="form-group">
              <label>Current Password</label>
              <input class="form-control" type="text" value="" name="cr_password" required=""
               placeholder="<?php echo $password; ?>">
             </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
             <div class="form-group">
              <label>New password</label>
              <input class="form-control" type="text" name="new_pass" required="">
             </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
             <div class="form-group">
              <label>Re-Enter New Password</label>
              <input class="form-control" type="text" value="" name="new_pass_2" required="">
             </div>
            </div>
            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
             <button type="submit" name="UPDATE_SETTINGS" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save
              changes</button>
             <button type="reset" class="btn btn-light">Cancel</button>
            </div>
           </div>
          </form>
          <!-- users edit Info form ends -->
         </div>

         <?php
                                    if ($user_role_cr == "STORE_USER") {

                                        $sql = "SELECT * from stores, payment_gateway, store_domains where stores.store_id=payment_gateway.store_id and stores.store_id=store_domains.store_id and stores.user_id='$user_view_id'";
                                        $query =  mysqli_query($con, $sql);
                                        $fetch = mysqli_fetch_assoc($query);
                                        $store_name = $fetch['store_name'];
                                        $store_phone = $fetch['store_phone'];
                                        $store_mail_id = $fetch['store_mail_id'];
                                        $store_description = $fetch['store_description'];
                                        $store_address = $fetch['store_address'];
                                        $store_arealocality = $fetch['store_arealocality'];
                                        $store_city = $fetch['store_city'];
                                        $store_state = $fetch['store_state'];
                                        $store_pincode = $fetch['store_pincode'];
                                        $activation_fee_status = $fetch['activation_fee_status'];
                                        $payment_use = $fetch['payment_use'];
                                        $domain_type = $fetch['domain_type'];
                                        $domain_avaibility = $fetch['domain_avaibility'];
                                        $domain = $fetch['domain'];
                                        $pg_mid = $fetch['pg_mid'];
                                        $pg_key = $fetch['pg_key'];
                                        $pg_web = $fetch['pg_web'];
                                        $pg_mode = $fetch['pg_mode'];
                                        $store_id = $fetch['store_id'];
                                        $store_view_id = $fetch['store_id'];



                                    ?>
         <div class="tab-pane" id="store-set" aria-labelledby="store-set-tab" role="tabpanel">
          <!-- users edit Info form start -->
          <?php
                                            if ($store_view_id == null) {
                                                echo "
                          <h3>No Store Found.</h3>
                          <p>It look like no store is created for <b>$full_name_user</b>. Please create a store first.</p>
                        <a href='stores.php' class='btn btn-link text-info'><i class='fa fa-plus'></i> Create Store</a>";
                                            } else {
                                            ?>
          <form action="update.php" method="POST">
           <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
           <input type="text" name="user_owner_id" value="<?php echo $user_view_id; ?>" hidden>
           <input type="text" name="store_id" value="<?php echo $store_id; ?>" hidden>
           <div class="row">
            <div class="col-lg-12">
             <h4><b>Store
               Information:<?php echo $activation_fee_status; ?></b>
             </h4>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Store Name</label>
              <input type="text" class="form-control" name="store_name" value="<?php echo $store_name; ?>"
               placeholder="STORE Name" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Store Phone</label>
              <input type="text" class="form-control" name="store_phone" value="<?php echo $store_phone; ?>"
               placeholder="Store Phone" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Store Small Description</label>
              <input type="text" class="form-control" name="store_description" value="<?php echo $store_description; ?>"
               placeholder="Store Intro" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Store Mail-ID</label>
              <input type="email" class="form-control" name="store_mail_id" value="<?php echo $store_mail_id; ?>"
               placeholder="Store Email" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Store Address</label>
              <input type="text" class="form-control" name="store_address" value="<?php echo $store_address; ?>"
               placeholder="SHop no/building/number" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Store AreaLocality</label>
              <input type="text" class="form-control" name="store_arealocality"
               value="<?php echo $store_arealocality; ?>" placeholder="AREA/SECTOR/BLOCK" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Store city</label>
              <input type="text" class="form-control" name="store_city" value="<?php echo $store_city; ?>"
               placeholder="City" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Store State</label>
              <select name="store_state" class="form-control" required="" readonly disabled="">
               <option value="<?php echo $store_state; ?>" selected>
                <?php echo $store_state; ?></option>
              </select>
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Pincode </label>
              <input type="text" class="form-control" minlength="6" maxlength="6" name="store_pincode"
               value="<?php echo $store_pincode; ?>" placeholder="000000" required="">
             </div>
            </div>

            <div class="col-lg-12">
             <h4><b>Store Domain:</b></h4>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Store Already Have Domain?</label>
              <select class="form-control" name="domain_avaibility" required="">
               <option value="<?php echo $domain_avaibility; ?>">
                <?php echo $domain_avaibility; ?></option>
              </select>
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Domain Type </label>
              <select class="form-control" name="domain_type" required="">
               <option value="<?php echo $domain_type; ?>">
                <?php echo $domain_type; ?></option>
              </select>
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Enter Domain Name </label>
              <input type="text" class="form-control" name="domain" value="<?php echo $domain; ?>"
               placeholder="example.com" required="">
             </div>
            </div>

            <div class="col-lg-12">
             <hr>
             <h4><b>Payment Gateway:</b></h4>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>PAYMENT GATEWAY (PG)</label>
              <select class="form-control" name="payment_use" required="">
               <option value="<?php echo $store_name; ?>">
                <?php echo $payment_use; ?></option>
              </select>
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>PROD_MID</label>
              <input type="text" class="form-control" value="<?php echo $pg_mid; ?>" name="pg_mid"
               placeholder="xGhbgFfgHH1H146765">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>PROD_KEY</label>
              <input type="text" class="form-control" value="<?php echo $pg_key; ?>" name="pg_key"
               placeholder="HbGVGSG125BVvg">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>WEBSITE TYPE </label>
              <input type="text" class="form-control" value="<?php echo $pg_web; ?>" name="pg_web"
               placeholder="HbGVGSG125BVvg">
             </div>
            </div>

            <div class="col-lg-12">
             <hr>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>ACTIVATION Status : </label>
              <input type="text" class="form-control" name="store_activation_fee" placeholder="Rs." hidden>
              <?php
                                                                if ($activation_fee_status == "Activated") {
                                                                    echo "<h2 class='text-success fa fa-check-circle'> Activated</h2>";
                                                                } else {
                                                                    echo "<h2 class='text-danger fa fa-warning'> NOT Activated</h2>";
                                                                }
                                                                ?>
             </div>
            </div>

           </div>
         </div>
         <div class="modal-footer">
          <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
          <button type="Submit" name="UPDATE_STORE" class="btn btn-outline-primary">Update
           Data</button>
          </form>
          <?php } ?>
         </div>
        </div>
       </div>
      </div>
      <!-- users edit Info form ends -->
     </div>

     <?php } ?>
   </div>
  </div>
 </div>
 </div>
 </section>
 <!-- users edit ends -->
 </div>
 </div>
 </div>
 <!-- END: Content-->

 <?php require 'footer.php'; ?>


 <!-- BEGIN: Vendor JS-->
 <script src="app-assets/vendors/js/vendors.min.js"></script>
 <!-- BEGIN Vendor JS-->

 <!-- BEGIN: Page Vendor JS-->
 <script src="app-assets/vendors/js/forms/select/select2.full.min.js"></script>
 <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
 <script src="app-assets/vendors/js/pickers/pickadate/picker.js"></script>
 <script src="app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
 <!-- END: Page Vendor JS-->

 <!-- BEGIN: Theme JS-->
 <script src="app-assets/js/core/app-menu.min.js"></script>
 <script src="app-assets/js/core/app.min.js"></script>
 <script src="app-assets/js/scripts/customizer.min.js"></script>
 <!-- END: Theme JS-->

 <!-- BEGIN: Page JS-->
 <script src="app-assets/js/scripts/pages/page-users.min.js"></script>
 <script src="app-assets/js/scripts/navs/navs.min.js"></script>

</body>
<!-- END: Body-->

</html>
</body>
<!-- END: Body-->

</html>