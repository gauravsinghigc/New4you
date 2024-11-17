<?php require 'files.php';
if (isset($_SESSION['customer_id'])) {
 header("location: account.php");
} ?>
<!DOCTYPE html>
<html>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <title><?php echo $store_name; ?> : Verify OTP</title>
 <?php include 'header_files.php'; ?>
</head>

<body>
 <?php
 include "header.php"; ?>
 <!--section start-->
 <section class="login-page section-big-py-space b-g-light">
  <div class="custom-container">
   <div class="row">
    <div class="col-lg-4 offset-lg-4">
     <div class="theme-card bg-white">
      <h3 class="text-center"><i class="fa fa-lock text-success"></i> Verify your account</h3>
      <hr>
      <p>Enter one time password sent on <?php echo $_SESSION['VERIFICATION_PHONE_NUMBER']; ?></p>
      <form class="theme-form bg-white" action="insert.php" method="POST">
       <?php if (isset($_SESSION['redirect_url'])) { ?>
        <input type="text" name="cr_url" value="index.php" hidden="">
       <?php } else { ?>
        <input type="text" name="cr_url" value="account.php" hidden="">
       <?php } ?>
       <div class="form-group">
        <label for="phone_number">Enter OTP</label>
        <input type="password" class="form-control" id="phone_number" name="submitted_otp" placeholder="X X X X X" required="">
       </div>
       <div class="form-group">
        <button type="submit" class="btn btn-solid btn-md btn-block " name="VERIFY_OTP">Verify Account <i class="fa fa-angle-right"></i></button>
       </div>
       <div class="accout-fwd" style="display:flex; justify-content:space-between;">
        <a href="insert.php?sent_otp=true">Send OTP Again</a>
        <a href="login.php">Back to Login</a>
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