<?php include 'files.php';
session_start();
if(isset($_SESSION['customer_id'])){
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
$customer_status_check = $fetch['customer_status'];
if ($customer_status_check == "verified") {
  header_remove();
  header("location: account.php?msg=Account Already Verified!");
} else {
}
} else {
  header("location: login.php?err=Please Login First!");
}
?>
<html style="<?php echo $ThemeColor; ?>">

<head>
  <title><?php echo $AppNameWithExt; ?> ! <?php echo $AppTag; ?></title>
  <?php GSI_header_files(); ?>
</head>

<body>

  <div class="container-fluid k-align mb-4">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 col-xl-12 col-xxs-12 mb-5">
        <img src="<?php echo $LogoRec; ?>" class="img-fluid logo mx-auto d-block">
        <p class="text-center text mt-0"><?php echo $AppTag; ?></p>
      </div>
    </div>
  </div>

  <div class="container-fluid mb-0 mt-5">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
        <?php
        if (isset($_POST['CheckOTP'])) {
          $SESSION_OTP = $_SESSION['OTP_SESSION'];
          $SUBMIT_OTP = $_POST['SUBMIT_OTP'];
          $customer_id = $_SESSION['customer_id'];
          if ($SUBMIT_OTP == $SESSION_OTP) {
            $sql = "UPDATE customers SET customer_status='verified' where customer_id='$customer_id'";
            $query = mysqli_query($con, $sql);
            if ($query == true) {
              $sql = "SELECT * FROM customers where customer_id='$customer_id' and customer_status='verified'";
              $query = mysqli_query($con, $sql);
              $fetch = mysqli_fetch_assoc($query);

              $_SESSION['customer_id'] = $fetch['customer_id'];
              $customer_id = $fetch['customer_id'];
              $_SESSION['STORE_ID'] = $fetch['store_id'];
              $store_id = $fetch['store_id'];
              setcookie("customer_id", $customer_id, time() + 60 * 60 * 365);
              setcookie("store_id", $store_id, time() + 60 * 60 * 365);

              NOTIFICATION_ALERT(
                $TITLE = "Account Verified Successfully!",
                $DESC = "Your account is verified with one time password $SESSION_OTP successfully. ",
                $STATUS = "NEW"
              );

              SMS(
                $MSG = "
Dear $customer_name, Your Account is verified with $APP_NAME Successfully. If you have any query feel free to contact us on 24kharido.in",
                $PHONE = "$customer_phone_number"
              );
              SendMail(
                $Valid = "true",
                $Subject = "Account Verified Successfully!",
                $Title = "Dear <b>$customer_name</b>",
                $CustomerMailId = "$customer_mail_id",
                $MAIL_MSG = "<p>Your account is verified successfully on 24kharido.in. 24kharido provide all type daily needs items and delivery it at your door step.</p>
             <h4>Please Update your latest address, email-id for receiving regular updates and offers details.</h4>
             <br>
             ----"
              );


              echo "<h2 style='text-align:center;'><img src='img/verify.gif' style='width:50%;border-radius:50%;'></h2><br><br>
      <p style='text-align:center;font-size:4vw;'>Your Account is verified successfully.</p>
      <meta http-equiv='refresh' content='2, index.php?msg=Welcome $customer_name, Account Created Successfully!'>";
            } else {
              echo "<h2 style='text-align:center;'><img src='../img/6ef9f2fd6425c578274e72ce1f44a778.gif' class='img-fluid' style='border-radius:400px;width:50% !important;'></h2>
      <p style='text-align:center;font-size:3vw;'>Account Verification Failed!.<br></p>
      <a href='verify.php' class='btn btn-md d-block mx-auto text-white' style='background-color: brown;'><i class='fa fa-angle-left'></i> Try Again</a><br>
      <a href='account.php'><button class='btn btn-md btn-block btn-outline-info bottom-text bottom-p' type='SUBMIT'><i class='fa fa-angle-left'></i> Back to Account</button></a><br>";
            }
          } else {
            echo "<h2 style='text-align:center;'><img src='../img/6ef9f2fd6425c578274e72ce1f44a778.gif' class='img-fluid' style='border-radius:400px;width:50% !important;'></h2>
      <p style='text-align:center;font-size:3vw;'><span style='font-size:4vw;'>Wrong OTP!</span><br>
     Please enter valid OTP sent to you.</p>
      <a href='verify.php' class='btn btn-md d-block btn-block bottom-text font-6 bottom-p mx-auto text-white' style='background-color: brown;'> Try Again</a><br>
      <a href='account.php'><button class='btn btn-md btn-block btn-outline-info bottom-text bottom-p' type='SUBMIT'><i class='fa fa-angle-left'></i> Back to Account</button></a><br>";
          }
        } else {
          $RANDOM_OTP = rand(000000, 999999);
          $_SESSION['OTP_SESSION'] = $RANDOM_OTP;
          SMS(
            $MSG = "
$store_name
$RANDOM_OTP is your One Time Password (OTP). Don't share it with anyone. We don't call/email/sms anyone to verify OTP.",
            $PHONE = "$customer_phone_number"
          );
          SendMail(
            $Valid = "true",
            $Subject = "One Time Password",
            $Title = "Dear <br>$customer_name</br>,",
            $CustomerMailId = "$customer_mail_id",
            $MAIL_MSG = "<p><b style='font-size:18px;'>$RANDOM_OTP</b><br><br> is your One Time Password (OTP). Don't share it with anyone. We don't call/email/sms anyone to verify OTP.</p>"
          ); ?>
          <form class="theme-form" action="" method="POST">
            <h2 class="text-center"><img src="../img/tick.gif" class='img-fluid'></h2>
            <br>
            <div class="form-group">
              <center><label class="font-7 text-center"><span>OTP Sent Successfully!</span></label></center>
              <p class="text-center">Please enter OTP sent to your registered phone or mail-id.</p>
              <input type="text" class="form-control tr-input" name="SUBMIT_OTP" placeholder="xxxxxx" maxlength="10" required="" style='letter-spacing: 25px !important;
    font-weight: 400;
    font-size: 30px !important;
    border: none;
    text-align: center !important;' min="6" max="6">
            </div>
            <div class="form-group">
              <button name="CheckOTP" type="submit" class="btn btn-success btn-md KLoginButton bottom-text btn-block bottom-p">
                <i class="fa fa-check-circle"></i> Verify
              </button>
            </div>
          </form>
          <form action='' method="POST">
            <div class="form-group">
              <button class="btn btn-md btn-block btn-secondary bottom-text bottom-p" type="SUBMIT" name="SEND_AGAIN_OTP" id="SendAgain">Send Again</button>
            </div>
          </form>

          <form action='login.php' method="POST">
            <div class="form-group">
              <button class="btn btn-md btn-block btn-outline-info bottom-text bottom-p" type="SUBMIT"><i class="fa fa-angle-left"></i> Back to Login</button>
            </div>
          </form>
        <?php } ?>

      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 pl-0 pr-0">
      <p class="text-center copyrighted mb-4">CopyRighted &copy; <?php echo date("Y"); ?> All Right are Reserved By <span class="text-info"><a href="https://<?php echo $AppNameWithExt; ?>"><?php echo $AppNameWithExt; ?></span></a></p>
      <br>
    </div>

    <!--Section ends-->
    <?php
    if (isset($_POST['SEND_AGAIN_OTP'])) {
      $RANDOM_OTP = rand(000000, 999999);
      $_SESSION['OTP_SESSION'] = $RANDOM_OTP;
      SMS(
        $MSG = "
$AppNameWithExt.
$RANDOM_OTP is your One Time Password (OTP). Don't share it with anyone. We don't call/email/sms anyone to verify OTP.",
        $PHONE = "$customer_phone_number"
      );
      SendMail(
        $Valid = "true",
        $Subject = "One Time Password",
        $Title = "Dear <b>$customer_name</b>,",
        $CustomerMailId = "$customer_mail_id",
        $MAIL_MSG = "<p><b style='font-size:18px;margin-bottom:10px !important;'>$RANDOM_OTP</b><br> is your One Time Password (OTP). Don't share it with anyone. We don't call/email/sms anyone to verify OTP.</p>"
      ); ?>
      <script type="text/javascript">
        document.getElementById("SendAgain").innerHTML = "<i class='fa fa-check-circle'></i> OTP SENT";
        $(document).ready(function() {
          $("#SendAgain").animate(document.getElementById("SendAgain").innerHTML = "Send Again", 1000);
        });
      </script>
    <?php } ?>
  </div>
  </div>
  </div>

  <?php GSI_footer_files(); ?>
</body>

</html>