<?php
require 'files.php';
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Recover Password : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column   blank-page blank-page" data-open="click"
 data-menu="vertical-menu-modern" data-col="1-column"
 style="background-image: url('img/erik-mclean-nfoRa6NHTbU-unsplash.jpg') !important; background-size: cover; background-repeat: no-repeat;background-position: center;">
 <!-- BEGIN: Content-->
 <div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
   <div class="content-header row">
   </div>
   <div class="content-body">
    <section class="row flexbox-container">
     <div class="col-12 d-flex align-items-center justify-content-center">
      <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-1">
       <div class="card border-grey border-lighten-3 px-2 py-2 m-0" style="background-color: #ffffffbf !important;">
        <div class="card-header border-0 pb-0" style="background-color: #ffffffbf !important;">
         <div class="card-title text-center" style="background-color: #ffffffbf !important;">
          <?php
                                        $sql = "SELECT * FROM stores where store_id='1'";
                                        $query = mysqli_query($con, $sql);
                                        $fetch = mysqli_fetch_assoc($query);
                                        $StoreLogo = $fetch['store_profile_img']; ?>
          <img src="<?php echo $StoreLogo; ?>" alt="<?php echo $PosName; ?>" title='<?php echo $PosName; ?>'
           style='width: 170px;'>
         </div>
         <h6 class="card-subtitle line-on-side text-center font-small-3"><span>We will send
           you a link to reset password.</span></h6>
        </div>
        <?php
                                if (isset($_POST['PASS_RECOVER'])) {
                                    $recover_mail_id = $_POST['recover_mail_id'];
                                    $sql = "SELECT * FROM users where email_id='$recover_mail_id'";
                                    $query =  mysqli_query($con, $sql);
                                    $fetch = mysqli_fetch_array($query);
                                    if ($fetch == true) {
                                        $user_name = $fetch['full_name'];
                                        $recover_user_id = $fetch['user_id'];

                                        // Subject
                                        $subject = "Password Reset";
                                        $sms_mail = "notification@mobilabs.in";
                                        $reply_mail = "support@mobilabs.in";
                                        $sendto = $recover_mail_id;
                                        $message = "<body style='text-shadow: 0px 0px 0.5px grey;font-weight: 400;'>
                  <hr>
                  <h4>Dear <b>$user_name</b>, </h4>
                  <p>You are trying to change your password. you can change it from below link.</p>

                  <a href='https://store.mobilabs.in/pos/reset.php?data=$recover_user_id'> Change Password!</a>
                  <hr>
                  <p style='font-size: 12px;'><b>* Note:</b> Password reset mail is generated when someone forget his/her password. This is send when user submit a password reset request to us. If this request is not make by you than it is suggested that you should change your password If you find something incorrect in this mail, than mail us at $reply_mail.</p>
                  <img src='$img_url/reg-bottom-banner.jpg' style='width: 100%;'>

                 </body>";

                                        // Set From: header
                                        $from =  "<" . $sms_mail . ">";

                                        // Email Headers
                                        $headers = "From: " . $from . "\r\n";
                                        $headers .= "Reply-To: " . $reply_mail . "\r\n";
                                        $headers .= "MIME-Version: 1.0\r\n";
                                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                                        ini_set("sendmail_from", $sms_mail); // for windows server
                                        $mail = mail($sendto, $subject, $message, $headers);

                                        if ($mail == true) { ?>
        <div class="card-content" style="background-color: #ffffffbf !important;">
         <div class="card-body">
          <h4><i class="fa fa-check-circle text-success"></i> Password Reset Link Sent!</h4>
          <hr>
          <p>Please check your mail id <b><?php echo $recover_mail_id; ?></b>. We sent a password reset link at your
           mail id. Change the password by using that link!.</p>
         </div>
        </div>

        <?php } else { ?>
        <div class="card-content" style="background-color: #ffffffbf !important;">
         <div class="card-body">
          <h4><i class="fa fa-warning text-danger"></i> Unable to Send Link!</h4>
          <hr>
          <p>currently we are unable to send password reset link at your mail id <b><?php echo $recover_mail_id; ?></b>.
           You can try again after sometimes.</p>
         </div>
        </div>

        <?php } ?>

        <?php } else { ?>
        <div class="card-content" style="background-color: #ffffffbf !important;">
         <div class="card-body">
          <h4><i class="fa fa-warning text-danger"></i> Sorry, No Registered User Found.</h4>
          <p>We don't find any registered user at <b><?php echo $recover_mail_id; ?></b> mail id. Please check your mail
           twice, maybe there is something missing in the mail id. You check and re-enter it.</p>
         </div>
        </div>

        <?php }
                                } else {
                                    ?>
        <div class="card-content" style="background-color: #ffffffbf !important;">
         <div class="card-body" style="background-color: #ffffffbf !important;">
          <form class="form-horizontal" action="" method="POST" novalidate>
           <fieldset class="form-group position-relative has-icon-left"></fieldset>
           <fieldset class="form-group position-relative has-icon-left"></fieldset>
           <fieldset class="form-group floating-label-form-group p-1">
            <input type="email" class="form-control" id="user-email" name='recover_mail_id'
             placeholder="Your Email Address" required style="font-size: 13px !important;">
           </fieldset>
           <fieldset class="form-group position-relative p-1">
            <button type="submit" name='PASS_RECOVER' class="btn btn-outline-primary btn-lg btn-block"><i
              class="fa fa-unlock"></i> Recover Password</button>
           </fieldset>
          </form>
         </div>
        </div>
        <?php } ?>
        <div class="card-footer border-0">
         <p class="float-sm-left text-center"><a href="login.php" class="card-link"><i class="fa fa-sign-in"></i>
           Login</a></p>
         <p class="float-sm-right text-center"><a href="pass-reset.php" class="card-link">Forget Password? </a></p>
        </div>
        <hr>
        <p class="text-center mt-1">&copy; <?php echo date("Y"); ?> <?php echo $CopyRight; ?></p>
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