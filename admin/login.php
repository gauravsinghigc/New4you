<?php
session_start();
header_remove();
require 'config.php';
require 'text.php';
require 'alert.php';
require 'tools.php';

$_SESSION['ControlUserAttempts'] = 0;

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <title>Login : <?php echo $PosName; ?></title>
  <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  bg-cyan bg-lighten-2 blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" style="background-image:url('img/firmbee-com-jrh5lAq-mIs-unsplash.jpg') !important; background-size: cover; background-repeat: no-repeat;background-position: center;">
  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="row flexbox-container">
          <div class="col-12 d-flex align-items-right justify-content-right ml-4">
            <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-1">
              <div class="card border-grey border-lighten-3 m-0" style="background-color: #ffffffbf !important;">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <div class="p-2 bg-white">
                      <?php
                      $sql = "SELECT * FROM stores where store_id='1'";
                      $query = mysqli_query($con, $sql);
                      $fetch = mysqli_fetch_assoc($query);
                      $StoreLogo = $fetch['store_profile_img']; ?>
                      <img src="<?php echo $StoreLogo; ?>" alt="<?php echo $PosName; ?>" title='<?php echo $PosName; ?>' style='width: 170px;'>
                    </div>
                  </div>
                </div>
                <div class="card-content" style="background-color: #ffffffbf !important;">
                  <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2" style="background-color: #ffffffbf !important;">
                    <span>ONLY ADMIN LOGIN</span>
                  </p>
                  <div class="card-body p-2" style="background-color: #ffffffbf !important;">
                    <?php notify(); ?>

                    <form class="form-horizontal" action="req.php" method="POST">
                      <fieldset class="form-group floating-label-form-group">

                      </fieldset>
                      <fieldset class="form-group floating-label-form-group">
                        <label for="user-name">Your Username</label>
                        <input type="text" class="form-control" id="user-name" name="username" placeholder="Your Username" required="">
                      </fieldset>
                      <fieldset class="form-group floating-label-form-group mb-1">
                        <label for="user-password">Your Password</label>
                        <input type="password" class="form-control" id="user-password" name="password" placeholder="*********" required="">
                      </fieldset>
                      <button type="submit" name="POS_LOGIN_REQUEST" class="btn btn-outline-primary btn-block">
                        <i class="fa fa-sign-in"></i> Login
                      </button><br><br>
                      <div class="row">
                        <div class="col-sm-12 col-lg-12 float-sm-left text-center text-sm-center">
                          <a href="pass-reset.php" class="card-link">Forgot Password?</a>
                        </div>
                      </div>
                    </form>
                    <p class="text-center mt-1" style="background-color: #ffffffbf !important;">&copy; <?php echo date("Y"); ?>
                      <?php echo $CopyRight; ?>
                    </p>
                  </div>

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