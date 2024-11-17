<?php require 'files.php';
require 'include.php';
if($customer_status_check == "verified"){
  header_remove();
  header("location: account.php?msg=Account Already Verified!");
} else {
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $store_name;?> : Verification</title>
      <?php include 'header_files.php';?>
<script type="text/javascript"></script>
   </head>
   <body style="font-size: 15px !important;">
      <?php require 'header.php'; ?>

      <section class="container-fluid">
         <div class="row p-2 pb-4">
         <div class="col-md-6 col-lg-6 col-sm-12 bg-white p-4 mx-auto" style="text-align: justify; padding-left: 1% !important;">
         
            <?php  
if(isset($_POST['CheckOTP'])){
  $SESSION_OTP = $_SESSION['OTP_SESSION'];
  $SUBMIT_OTP = $_POST['SUBMIT_OTP'];
  $customer_id = $_SESSION['customer_id'];
  if($SUBMIT_OTP == $SESSION_OTP){
    $sql = "UPDATE customers SET customer_status='verified' where customer_id='$customer_id'";
    $query = mysqli_query($con, $sql);
    if($query == true){
      $sql = "SELECT * FROM customers where customer_id='$customer_id' and customer_status='verified'";
      $query = mysqli_query($con, $sql);
      $fetch = mysqli_fetch_assoc($query);
      
    $_SESSION['customer_id'] = $fetch['customer_id'];
    $customer_id = $fetch['customer_id'];
    $_SESSION['STORE_ID'] = $fetch['store_id'];
    $store_id = $fetch['store_id'];

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
   
   //Create Logs for Login Provided Data
  $CreateLog = "INSERT INTO loginlogs (UserId, Username, Password, DeviceDetails, IpAddress, LogsAddDOT, LogsStatus, LogsMsg, SourceType) VALUES ('$customer_id', '$customer_mail_id', '$customer_password', '$DeviceDetails', '$IP_ADDRESS', CURRENT_TIMESTAMP, 'User Verified', 'User Verified by providing One Time Password $SESSION_OTP at final verifications', 'WEBSITE')";

      echo "<h2 style='text-align:center;'><img src='img/phone-verification-success.gif' class='img-fluid' style='width:50%;'></h2><br>
      <p style='text-align:center;font-size:15px;color:black;'>OTP Verified Successfully.<br> Now, you will auto redirect to your account page with in 4sec...</p>
      <meta http-equiv='refresh' content='4, account.php'>";

    } else {
      //Create Logs for Login Provided Data
  $CreateLog = "INSERT INTO loginlogs (UserId, Username, Password, DeviceDetails, IpAddress, LogsAddDOT, LogsStatus, LogsMsg, SourceType) VALUES ('$customer_id', '$customer_mail_id', '$customer_password', '$DeviceDetails', '$IP_ADDRESS', CURRENT_TIMESTAMP, 'Unable to Verify OTP', 'Required OTP $SESSION_OTP, Provided OTP $SUBMIT_OTP', 'WEBSITE')";
       echo "<h2 style='text-align:center;'><i class='fa fa-warning' style='color:red;'></i></h2>
      <p style='text-align:center;'>Unable to Verify OTP.<br></p>
      <a href='login.php' class='btn btn-md d-block mx-auto text-white p-3' style='background-color: brown;font-size:15px;'><i class='fa fa-angle-left mt-0'></i> Try Again</a>";
    }
  } else {
    //Create Logs for Login Provided Data
  $CreateLog = "INSERT INTO loginlogs (UserId, Username, Password, DeviceDetails, IpAddress, LogsAddDOT, LogsStatus, LogsMsg, SourceType) VALUES ('$customer_id', '$customer_mail_id', '$customer_password', '$DeviceDetails', '$IP_ADDRESS', CURRENT_TIMESTAMP, 'Wrong OTP', 'Required OTP $SESSION_OTP, Provided OTP $SUBMIT_OTP', 'WEBSITE')";
      echo "<h2 style='text-align:center;'><i class='fa fa-warning'></i></h2>
      <p style='text-align:center;'>Invalid Otp.<br>
      Unable to verify account. Please try again...</p>
      <a href='login.php' class='btn btn-md d-block mx-auto text-white p-3' style='background-color: brown;font-size:15px;'> Try Again</a>";
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
             $Title = "Dear <b>$customer_name</b>,",
             $CustomerMailId = "$customer_mail_id",
             $MAIL_MSG = "<p><b style='font-size:18px;'>$RANDOM_OTP</b><br><br> is your One Time Password (OTP). Don't share it with anyone. We don't call/email/sms anyone to verify OTP.</p>"
          ); ?>
   <img src="app/img/tenor.gif" class="img-fluid d-block mx-auto" style="width: 20%;">
          <h5 class="text-center"><i class="fa fa-check-circle text-success"></i> One Time Password (OTP) Send on Your Phone or Email-id Successfully.</h5>
          <p>Please check your mail or phone number. Be patient OTP delivery takes 30-60 sec sometimes.</p>
          <h4>Enter OTP <i class="fa fa-angle-right"></i></h4>
                            <form class="theme-form" action="" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control tr-input font-9" name="SUBMIT_OTP"
                                        placeholder="******" maxlength="10" required="" style='letter-spacing: 40px;
    font-weight: 800;
    font-size: 30px;
    border: none;
    text-align: center;'>
                                </div>
                                <div class="form-group">
                                <button name="CheckOTP" type="submit" class="btn btn-success btn-md KLoginButton bottom-text btn-block p-3" style="font-size: 15px;">
                                    <i class="fa fa-check-circle mt-0"></i> Verify
                                </button>
                                </div>
                            </form>
                          <form action='' method="POST">
                                <div class="form-group">
                              <button class="btn btn-md btn-block btn-secondary bottom-text p-2" type="SUBMIT" name="SEND_AGAIN_OTP" id="SendAgain" style="font-size: 15px;">Send Again</button>
                          </div>
                            </form>

                             <form action='login.php' method="POST">
                                <div class="form-group">
                              <button class="btn btn-md btn-block text-link text-info bottom-text p-3" type="SUBMIT" style="font-size: 15px;"><i class="fa fa-angle-left mt-0"></i> Back to Login</button>
                          </div>
                            </form>
<?php } ?>
                        </div>
                    </div>

        <!--Section ends-->
<?php 
if(isset($_POST['SEND_AGAIN_OTP'])){
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
             $Title = "Dear <b>$customer_name</b>,",
             $CustomerMailId = "$customer_mail_id",
             $MAIL_MSG = "<p><b style='font-size:18px;'>$RANDOM_OTP</b><br><br> is your One Time Password (OTP). Don't share it with anyone. We don't call/email/sms anyone to verify OTP.</p>"
          );
      //Create Logs for Login Provided Data
  $CreateLog = "INSERT INTO loginlogs (UserId, Username, Password, DeviceDetails, IpAddress, LogsAddDOT, LogsStatus, LogsMsg, SourceType) VALUES ('$customer_id', '$customer_mail_id', '$customer_password', '$DeviceDetails', '$IP_ADDRESS', CURRENT_TIMESTAMP, 'OTP SENT AGAIN', '$RANDOM_OTP is again send  from verification page.', 'WEBSITE')";     ?>
   <script type="text/javascript">
    document.getElementById("SendAgain").innerHTML = "<i class='fa fa-check-circle'></i> OTP SENT";
    $(document).ready(function(){
    $("#SendAgain").animate(document.getElementById("SendAgain").innerHTML = "Send Again", 1000);
});
   </script>
<?php } ?>
         </div>
      </div>
      </section>
 <?php require 'footer.php'; ?>

</body></html>
