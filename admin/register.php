<?php
session_start();
require 'text.php';
require 'alert.php';
require 'tools.php';

if (isset($_GET['r_type'])) {
  $_SESSION['USER_TYPE'] = $_GET['r_type'];
} elseif (!isset($_GET['r_type'])) {
  $UserTpe = $_SESSION['USER_TYPE'];
} else {
  $UserTpe = "6";
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <title>Register : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  bg-cyan bg-lighten-2 blank-page blank-page"
 data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
 <!-- BEGIN: Content-->
 <div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
   <div class="content-header row">
   </div>
   <div class="content-body">
    <section class="row flexbox-container">
     <div class="col-12 d-flex align-items-center justify-content-center">
      <div class="col-lg-10 col-md-10 col-10 p-0">
       <div class="card border-grey border-lighten-3 m-0">
        <div class="card-header border-0">
         <div class="card-title text-center">
          <div class="p-1">
           <img src="<?php echo $Logo; ?>" alt="<?php echo $PosName; ?>" title='<?php echo $PosName; ?>'
            style='width: 170px;'>
          </div>
         </div>
        </div>
        <div class="card-content">
         <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2">
          <span>Create Your Account</span>
         </p>
         <div class="card-body pt-0">
          <?php notify(); ?>
          <form action="insert.php" method="POST">
           <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
           <input type="text" name="ref" value="0" hidden="">
           <div class="row">
            <input type="text" name="user_role" value="<?php echo $UserTpe; ?>" class="form-control" hidden>

            <div class="col-md-4">
             <div class="form-group">
              <label>Full name</label>
              <input type="text" class="form-control" name="full_name" placeholder="Full Name" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Enter Username</label>
              <input type="text" class="form-control" name="username" placeholder="Email Id" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Enter Email-id</label>
              <input type="email" class="form-control" name="email_id" placeholder="Email Id" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Phone Number (excluding +91)</label>
              <input type="text" class="form-control" name="phone_number" placeholder="+91" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Enter Password</label>
              <input type="password" class="form-control" name="password" placeholder="********" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Enter Confirm Password </label>
              <input type="password" class="form-control" name="password_2" placeholder="********" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Street Address</label>
              <input type="text" class="form-control" name="user_address" placeholder="H no/Flat no/Street Address"
               required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Area Locality</label>
              <input type="text" class="form-control" name="user_arealocality" placeholder="Area/ Sector/ Locality/"
               required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>City</label>
              <input type="text" class="form-control" name="user_city" placeholder="City" required="">
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>State</label>
              <select name="user_state" class="form-control" required="">
               <option value="Andhra Pradesh">Andhra Pradesh</option>
               <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
               <option value="Arunachal Pradesh">Arunachal Pradesh</option>
               <option value="Assam">Assam</option>
               <option value="Bihar">Bihar</option>
               <option value="Chandigarh">Chandigarh</option>
               <option value="Chhattisgarh">Chhattisgarh</option>
               <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
               <option value="Daman and Diu">Daman and Diu</option>
               <option value="Delhi">Delhi</option>
               <option value="Lakshadweep">Lakshadweep</option>
               <option value="Puducherry">Puducherry</option>
               <option value="Goa">Goa</option>
               <option value="Gujarat">Gujarat</option>
               <option value="Haryana">Haryana</option>
               <option value="Himachal Pradesh">Himachal Pradesh</option>
               <option value="Jammu and Kashmir">Jammu and Kashmir</option>
               <option value="Jharkhand">Jharkhand</option>
               <option value="Karnataka">Karnataka</option>
               <option value="Kerala">Kerala</option>
               <option value="Madhya Pradesh">Madhya Pradesh</option>
               <option value="Maharashtra">Maharashtra</option>
               <option value="Manipur">Manipur</option>
               <option value="Meghalaya">Meghalaya</option>
               <option value="Mizoram">Mizoram</option>
               <option value="Nagaland">Nagaland</option>
               <option value="Odisha">Odisha</option>
               <option value="Punjab">Punjab</option>
               <option value="Rajasthan">Rajasthan</option>
               <option value="Sikkim">Sikkim</option>
               <option value="Tamil Nadu">Tamil Nadu</option>
               <option value="Telangana">Telangana</option>
               <option value="Tripura">Tripura</option>
               <option value="Uttar Pradesh">Uttar Pradesh</option>
               <option value="Uttarakhand">Uttarakhand</option>
               <option value="West Bengal">West Bengal</option>
              </select>
             </div>
            </div>

            <div class="col-md-4">
             <div class="form-group">
              <label>Area Pincode</label>
              <input type="text" class="form-control" name="user_pincode" placeholder="Pincode" required="">
              <a href='https://www.indiapost.gov.in/VAS/Pages/findpincode.aspx' target="blank">Don't Know Pincode</a>
             </div>
            </div>

           </div>
           <div class="row">
            <div class="col-lg-12">
             <center>
              <div class="form-group">
               <button type="Submit" name="REGISTER_NEW_USER" class="btn btn-outline-primary btn-block"><i
                 class="fa fa-user"></i> Register</button><br>
              </div>
              <span>Already Register? <a href="login.php" class="btn btn-primary btn-md">Login</a></span>
             </center>
            </div>
           </div>
          </form>
          <p class="text-center mt-1 mobile-font-size">Copyrighted &copy; <?php echo date("Y"); ?> ALL Right Reserved By
           Mobilabs.in <br> AllBiz Global Inc.
           <hr>
          </p>
         </div>
        </div>
       </div>
      </div>
    </section>
   </div>
  </div>
 </div>
 <!-- END: Content-->


 <!-- BEGIN: Vendor JS-->
 <script src="app-assets/vendors/js/vendors.min.js"></script>
 <!-- BEGIN Vendor JS-->

 <!-- BEGIN: Page Vendor JS-->
 <script src="app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
 <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
 <!-- END: Page Vendor JS-->

 <!-- BEGIN: Theme JS-->
 <script src="app-assets/js/core/app-menu.min.js"></script>
 <script src="app-assets/js/core/app.min.js"></script>
 <!-- END: Theme JS-->

 <!-- BEGIN: Page JS-->
 <script src="app-assets/js/scripts/forms/form-login-register.min.js"></script>
 <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>