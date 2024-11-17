<?php require 'files.php';

if(isset($_POST['check_user'])) {
  $data = $_POST['check_data'];
  $_SESSION['data'] = $_POST['check_data'];
}

if(!isset($_SESSION['data'])){
  header("location: login.php");
} else { ?>
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
                    <h3 class="text-center">Password Reset</h3>
     <?php 

  $data = $_SESSION['data'];
  $sql = "SELECT * FROM customers where customer_mail_id='$data'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  $mail_id = $fetch['customer_mail_id'];
  $customer_name = $fetch['customer_name'];
  if($mail_id == null){
      
      $sql = "SELECT * from customers where customer_phone_number='$data'";
      $query = mysqli_query($con, $sql);
      $fetch = mysqli_fetch_assoc($query);
      $customer_phone_number = $fetch['customer_phone_number'];
      $customer_name = $fetch['customer_name'];
      $customer_mail_id = $fetch['customer_mail_id'];

      if($customer_phone_number == null) {

        echo "<img src='img/no-account-found.gif' class='img-fluid' style='width:30%;'>
        <h4><i class='fa fa-warning text-danger'></i> No Account Found!</h4>
        <h5 class='mb-5'>Sorry, there is no account that linked or created with <b>$data</b>. Please try again with valid search that have account with us.</h5>
        <a href='forget.php' class='btn btn-block btn-success p-3 mt-5' style='font-size:15px;'>Try Again</a>
        <a href='index.php' class='btn btn-block text-link text-info p-3 mt-1' style='font-size:15px;'><i class='fa fa-angle-left text-info'></i> Back to Home</a>";

      } else {
       
       if(isset($_POST['CHECK_PASSWORD_RESET_OTP'])) {

         $RequestedOtp = $_SESSION['OTP_PASSWORD_FORGET_SESSION'];
         $ProvidedOtp = $_POST['C_ENTER_OTP'];
         if($RequestedOtp == $ProvidedOtp){
           echo "<img src='img/phone-verification-success.gif' class='img-fluid' style='width:35%;'>
                <h5><i class='fa fa-check-circle text-success'></i> OTP Verified Successfully</h5>
                <br>
            <meta http-equiv='refresh' content='2, changes.php'>";
         } else {
           echo "<img src='img/6ef9f2fd6425c578274e72ce1f44a778.gif' class='img-fluid' style='width:35%;'>
                <h5><i class='fa fa-warning text-danger'></i> OTP Verification Failed!</h5><br>
                <a href='reset.php' class='btn btn-block btn-info p-3 mt-1' style='font-size:15px;'>Try Again</a>
                <br>";
         }

       } elseif(isset($_POST['SEND_AGAIN_OTP'])) {
         echo "
<img src='img/phone-verification-success.gif' class='img-fluid' style='width:35%;'>
<h5><i class='fa fa-check-circle text-success'></i> OTP Sent Successfully on Phone & Email-id.</h5>
<p>Please check your phone or email-id.</p>
<form action='' method='POST'>
  <div class='form-group'>
    <label class='float-left'>Please Enter OTP </label>
    <input type='text' class='form-control' required='' name='C_ENTER_OTP' placeholder='XXXXXX' style='letter-spacing: 40px;
    font-weight: 800;
    font-size: 30px;
    border: none;
    text-align: center;'>
  </div>
  <div class='form-group mt-5'>
    <button type='submit' name='CHECK_PASSWORD_RESET_OTP' class='btn btn-block btn-success p-3' style='font-size:15px;'>Continue</button>
  </div>
</form>
<form action='' method='POST'>
<input type='text' name='check_user' value='' hidden=''>
<input type='text' name='check_data' value='$customer_phone_number' hidden=''>
<input type='text' name='customer_mail_id' value='$customer_mail_id' hidden=''>
  <div class='form-group'>
  <button class='btn btn-md btn-block btn-secondary bottom-text p-2' type='SUBMIT' name='SEND_AGAIN_OTP' id='SendAgain' style='font-size: 15px;'>Send Again</button>
  </div>
</form>

<a href='index.php' class='btn btn-block text-link text-info p-3 mt-1' style='font-size:15px;'><i class='fa fa-angle-left text-info'></i> Back to Home</a>";  
       
       } else {
           
         $RANDOM_OTP = rand(000000, 999999);
         $_SESSION['OTP_PASSWORD_FORGET_SESSION'] = $RANDOM_OTP;
         $_SESSION['C_PHONE_NUMBER'] = $customer_phone_number;
         $SENDING_OTP = $RANDOM_OTP;
         SMS(
            $MSG = "OTP for Password Reset at $store_name is $SENDING_OTP. Don't share it with anyone. We don't call/email/sms anyone to verify OTP.",
            $PHONE = "$customer_phone_number"
         );
         SendMail(
             $Valid = "true",
             $Subject = "One Time Password",
             $Title = "One Time Password",
             $CustomerMailId = "$customer_mail_id",
             $MAIL_MSG = "<p>Dear <b>$customer_name</b>,<br><br>
             <b style='font-size:18px;'>$SENDING_OTP</b><br><br>is your One Time Password (OTP) for $store_name. Don't share it with anyone. We don't call/email/sms anyone to verify OTP.</p>"
          );
 echo "
<img src='img/phone-verification-success.gif' class='img-fluid' style='width:35%;'>
<h5><i class='fa fa-check-circle text-success'></i> OTP Sent Successfully on Phone & Email-id.</h5>
<p>Please check your phone or email-id.</p>
<form action='' method='POST'>
  <div class='form-group'>
    <label class='float-left'>Please Enter OTP </label>
    <input type='text' class='form-control' required='' name='C_ENTER_OTP' placeholder='XXXXXX' style='letter-spacing: 40px;
    font-weight: 800;
    font-size: 30px;
    border: none;
    text-align: center;'>
  </div>
  <div class='form-group mt-5'>
    <button type='submit' name='CHECK_PASSWORD_RESET_OTP' class='btn btn-block btn-success p-3' style='font-size:15px;'>Continue</button>
  </div>
</form>
<form action='' method='POST'>
<input type='text' name='check_user' value='' hidden=''>
<input type='text' name='check_data' value='$customer_phone_number' hidden=''>
<input type='text' name='customer_mail_id' value='$customer_mail_id' hidden=''>
  <div class='form-group'>
  <button class='btn btn-md btn-block btn-secondary bottom-text p-2' type='SUBMIT' name='SEND_AGAIN_OTP' id='SendAgain' style='font-size: 15px;'>Send Again</button>
  </div>
</form>

<a href='index.php' class='btn btn-block text-link text-info p-3 mt-1' style='font-size:15px;'><i class='fa fa-angle-left text-info'></i> Back to Home</a>";

       }
?>
       
<?php 

if(isset($_POST['SEND_AGAIN_OTP'])){
  $RANDOM_OTP = rand(000000, 999999);
  $customer_phone_number = $_POST['check_data'];
  $customer_mail_id = $_POST['customer_mail_id'];
  $_SESSION['OTP_PASSWORD_FORGET_SESSION'] = $RANDOM_OTP;
SMS(
$MSG="
OTP for Password Reset at $store_name is $RANDOM_OTP. Don't share it with anyone. We don't call/email/sms anyone to verify OTP.",
$PHONE = "$customer_phone_number"
   );
   SendMail(
             $Valid = "true",
             $Subject = "One Time Password",
             $Title = "One Time Password",
             $CustomerMailId = "$customer_mail_id",
             $MAIL_MSG = "<p>Dear <b>$customer_name</b>,<br><br>
             <b style='font-size:18px;'>$RANDOM_OTP</b><br>is your One Time Password (OTP) for $store_name. Don't share it with anyone. We don't call/email/sms anyone to verify OTP.</p>"
    );?>
   <script type="text/javascript">
    document.getElementById("SendAgain").innerHTML = "<i class='fa fa-check-circle'></i> OTP SENT";
    $(document).ready(function(){
    $("#SendAgain").animate(document.getElementById("SendAgain").innerHTML = "Send Again", 1000);
});
   </script>
<?php } ?>

      <?php }
  } else {

          $subject = "Password Reset";
          $sms_mail = "notification@24kharido.in";
          $reply_mail = "support@24kharido.in";

          // Set Message
          $message = "<body style='text-shadow: 0px 0px 0.5px grey;font-weight: 400;'>
<center>
<img src='$logo' style='width:100%;'>
</center>
<h2><b style='font-weight: 400;'>Dear</b> $customer_name,</h2>

<p>Password Reset request is received. You can reset your password by using below link.</p>

<a href='https://24kharido.in/app/changes.php?id=$mail_id' style='background-color:green; color:white; padding:2%;padding-left:3%; padding-right:3%;border-radius:24px;text-decoration:none;'>Reset Password</a>
<br>
<br>
<hr style='margin-top:5vw;'>
<p style='font-size: 12px;'><b>* Note:</b> This is a auto generated mail, send from $APP_NAME.in. If you find something incorrect in this mail, than mail us at $reply_mail. If This request is not send by you then please login into your account and change your password.</p>
</body>";

          // Set From: header
          $from =  $sms_mail;

          // Email Headers
          $headers = "From: " . $from . "\r\n";
          $headers .= "Reply-To: " . $reply_mail . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

          ini_set("sendmail_from", $sms_mail); // for windows server
          $mail = mail($mail_id, $subject, $message, $headers);

          echo "
          <img src='img/sending.gif' class='img-fluid d-block mx-auto' style='width:50%;'>
          <h5 class='text-center'><i class='fa fa-check-circle text-success'></i> Please Check your <b>$mail_id</b> mail. <br> Password Reset link is send successfully.</h5>
          <br>
          <a href='index.php' class='btn btn-success btn-block text-white bottom-text p-3 mt-2' style='font-size:15px;'><i class='fa fa-angle-left mt-0'> Back to Home</i></a>";

  }
}
?>
    </div>
  </div>
</section>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->


<?php include 'footer.php'; ?>
</body>
</html>