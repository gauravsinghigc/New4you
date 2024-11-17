<?php
session_start();
require 'text.php';
require 'alert.php';
require 'tools.php';
require 'config.php';
$_SESSION['password'] = $_GET['data'];
$user_id = $_SESSION['password'];

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <title>Change Password : <?php echo $PosName; ?></title>
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
      <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
       <div class="card border-grey border-lighten-3 m-0">
        <div class="card-header border-0">
         <div class="card-title text-center">
          <div class="p-1">
           <img src="<?php echo $Logo; ?>" alt="<?php echo $PosName; ?>" title='<?php echo $PosName; ?>'>
          </div>
         </div>
        </div>
        <div class="card-content">
         <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2">
          <span>Change Password</span>
         </p>
         <div class="card-body pt-0">
          <?php
                                        if (isset($_POST['CHANGE_PASSWORD'])) {
                                            $password = $_POST['password'];
                                            $password_c = $_POST['password_c'];
                                            $user_id = $_POST['user_id'];

                                            if ($password == $password_c) {
                                                $sql = "UPDATE users SET password='$password' where user_id='$user_id'";
                                                $query =  mysqli_query($con, $sql);
                                                if ($query == true) { ?>
          <H4><b><i class="fa fa-check-circle text-success"></i> Password Changed</b></h4>
          <p>Your Password is changed. Login with new password</p>
          <a href='login.php'>
           <button class="btn btn-outline-primary btn-block">
            <i class="fa fa-sign-in"></i> Login
           </button>
          </a>
          <hr>
          <p class="text-center mt-1">Copyrighted &copy; ALL Right Reserved By Mobilabs.in <br> AllBiz Global Inc.
           <hr>
          </p>
          <?php } else { ?>


          <?php }
                                            } else { ?>
          <?php notify(); ?>
          <H4><b><i class="fa fa-warning text-danger"></i> Password Not Matched</b></h4>
          <form class="form-horizontal" action='' method="POST">
           <input type='text' name="cr_url" value='<?php echo get_url(); ?>' hidden>
           <fieldset class="form-group floating-label-form-group">
            <label for="user-name">New Password</label>
            <input type="password" class="form-control" id="user-name" name="password" placeholder="***********"
             required="">
           </fieldset>
           <fieldset class="form-group floating-label-form-group mb-1">
            <label for="user-password">Confirm Password</label>
            <input type="password" class="form-control" id="user-password" name="password_c" placeholder="*********"
             required="">
           </fieldset>
           <button type="submit" name="CHANGE_PASSWORD" class="btn btn-outline-primary btn-block">
            <i class="fa fa-sign-in"></i> Change Password
           </button>
          </form>
          <p class="text-center mt-1">Copyrighted &copy; ALL Right Reserved By Mobilabs.in <br> AllBiz Global Inc.
           <hr>
          </p>

          <?php  }
                                        } else { ?>
          <form class="form-horizontal" action='' method="POST">
           <input type='text' name='user_id' value='<?php echo $user_id; ?>' hidden>
           <fieldset class="form-group floating-label-form-group">
            <label for="user-name">New Password</label>
            <input type="password" class="form-control" id="user-name" name="password" placeholder="***********"
             required="">
           </fieldset>
           <fieldset class="form-group floating-label-form-group mb-1">
            <label for="user-password">Confirm Password</label>
            <input type="password" class="form-control" id="user-password" name="password_c" placeholder="*********"
             required="">
           </fieldset>
           <button type="submit" name="CHANGE_PASSWORD" class="btn btn-outline-primary btn-block">
            <i class="fa fa-sign-in"></i> Change Password
           </button>
          </form>
          <p class="text-center mt-1">Copyrighted &copy; ALL Right Reserved By Mobilabs.in <br> AllBiz Global Inc.
           <hr>
          </p>
         </div>
         <?php } ?>
         <!--<p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>New to
                            Stack ?</span></p>
                    <div class="card-body">
                        <a href="register-with-bg.html" class="btn btn-outline-danger btn-block"><i
                                class="feather icon-user"></i> Register</a>
                    </div>-->
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