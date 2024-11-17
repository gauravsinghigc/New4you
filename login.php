<?php require 'files.php';
if (isset($_SESSION['customer_id'])) {
  header("location: account.php");
} ?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $store_name; ?> : Login</title>
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
            <h3 class="text-center"><i class="fa fa-lock text-success"></i> Login / Signup </h3>
            <hr>
            <p>Enter your registered phone number</p>
            <form class="theme-form bg-white" action="insert.php" method="POST">
              <?php if (isset($_SESSION['redirect_url'])) { ?>
                <input type="text" name="cr_url" value="<?php echo $_SESSION['redirect_url']; ?>" hidden="">
              <?php } else { ?>
                <input type="text" name="cr_url" value="account.php" hidden="">
              <?php } ?>
              <div class="form-group">
                <label for="phone_number">Enter Your Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="customer_phone_number" placeholder="+91 00000 00000" required="">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-solid btn-md btn-block " name="login_request">Send OTP <i class="fa fa-angle-right"></i></button>
              </div>
              <div class="accout-fwd">
                <a href="register.php" class="d-block text-primary">
                  <h6>you have no account ?<span> signup now</span></h6>
                </a>
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