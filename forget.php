<?php require 'files.php';?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $store_name;?> : Login</title>
       <?php include 'header_files.php';?>
</head>
<body>
<?php
include "header.php"; ?>
<!--section start-->
<section class="login-page section-big-py-space b-g-light">
    <div class="custom-container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="theme-card">
                    <h3 class="text-center">Forget password</h3>
    <form class="theme-form" action="reset.php" method="POST">
      <div class="form-group">
        <label>Please Enter Your Registered Phone Number <br><small class="text-danger">Don't Include +91.</small></label>
        <div class="input-group mb-2">
                                                 <div class="input-group-prepend">
                                                    <div class="input-group-text">+91</div>
                                                 </div>
                                                 <input type="text" class="form-control tr-input font-15" value="" id="LoginPhoneNumber" name="check_data" placeholder="XXXXXXXXXX" required="">
                                             </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-solid btn-md btn-block " name="check_user">Check Account</button>
      </div>
      <div class="accout-fwd">
        <a href="login.php" class="d-block"><h5>Know Password? Login Now</h5></a>
        <a href="register.php" class="d-block"><h6 >you have no account ?<span>signup now</span></h6></a>
      </div>
    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->


<?php include 'footer.php'; ?>
</body>
</html>
