<?php require 'files.php';
if(isset($_SESSION['customer_id'])){
header("location: account.php");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $store_name;?> : Login</title>
      <?php include 'header_files.php';?>
<style type="text/css">
   input {
      padding: 3% !important;
   }
</style>
   </head>
   <body style="font-size: 15px !important;">
      <?php require 'header.php'; ?>

      <section class="container-fluid" style="background-image: url('img/lucrezia-carnelos-wQ9VuP_Njr4-unsplash.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center; padding: 6%;">
         <form action="insert.php" method="POST">
                                 <input type="text" name="cr_url" value="<?php get_url();?>" hidden>
                                 <div class="tab-content">

                                    <div class="tab-pane active" id="login" role="tabpanel">
                                     <div class="row">
                                        <div class="col-lg-6 mx-auto bg-white rounded">
                                          <img src="<?php echo $logo;?>" class="img-fluid w-50 d-block mx-auto mt-2">
                                          <h4 class="heading-design-h4 text-center"><i class="fa fa-lock text-info"></i> Login to Your Account</h4>
                                          <hr>
                                       
                                    <fieldset class="form-group">
                                       <div class="col-auto">
                                             <div class="input-group mb-2">
                                                 <div class="input-group-prepend">
                                                    <div class="input-group-text">+91</div>
                                                 </div>
                                                 <input type="text" class="form-control" value="" id="LoginPhoneNumber" name="customer_mail_id" placeholder="Enter Phone Number" required="">
                                             </div>
                                              <small class="text-danger" style="display: none;" id="PhoneErr"><span> * Please Enter Phone Number...</span></small>
                                       </div>
                                    </fieldset>

                                    <fieldset class="form-group" style="margin-bottom: 0;">
                                       <div class="col-auto">
                                             <div class="input-group mb-2">
                                                 <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fa fa-key mt-0"></i></div>
                                                 </div>
                                                 <input type="password" class="form-control" value="" id="LoginPassword" name="customer_password" placeholder="Password" required="">
                                             </div>
                                             <small class="text-danger" style="display: none;" id="PasswordErr"><span> * Please Enter Password...</span></small>
                                       </div>
                                    </fieldset>

                                    <fieldset class="form-group">
                                       <div class="col-auto text-center">
                                          <a href="forget.php" class="text-info text-center">
                                             Forget Password?
                                          </a>
                                       </div>
                                    </fieldset>

                                       <fieldset class="form-group">
                                          <div class="col-auto">
                                             <button type="submit" name="login_request" onclick="CheckingLoginDetails()" class="btn btn-lg btn-success btn-block p-3" style="font-size: 15px;">
                                                <span id="CheckingLoginDetails">
                                                <i class="fa fa-lock mt-0"></i> Secured Login
                                                </span>
                                             </button>
                                          </div>
                                       </fieldset>
                                    </form>
                                        </div>
                                     </div>

                                 </div>

                                 <div class="tab-pane" id="register" role="tabpanel">
                                    <div class="row">
                                   <div class="col-lg-6 mx-auto bg-white rounded">
                                     <img src="<?php echo $logo;?>" class="img-fluid w-50 d-block mx-auto mt-2">
                                    <h4 class="heading-design-h4 text-center"><i class="fa fa-user text-info"></i> Create Account</h4>
                                    <hr>
                                     <form action="insert.php" method="POST">
                                      <input type="text" name="cr_url" value="<?php get_url();?>" hidden>
                                     <div class="row">
                                       <div class="col-lg-12">

                                    <fieldset class="form-group">
                                       <div class="col-auto">
                                             <div class="input-group mb-2">
                                                 <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fa fa-user mt-0"></i></div>
                                                 </div>
                                                 <input type="text" class="form-control" value="" id="LoginPhoneNumber" name="customer_name" placeholder="Full Name" required="">
                                             </div>
                                              <small class="text-danger" style="display: none;" id="NameErr"><span> * Please Enter Full Name...</span></small>
                                       </div>
                                    </fieldset>

                                    <fieldset class="form-group">
                                       <div class="col-auto">
                                             <div class="input-group mb-2">
                                                 <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fa fa-envelope mt-0"></i></div>
                                                 </div>
                                                 <input type="mail" class="form-control" value="" id="LoginPhoneNumber" name="customer_mail_id" placeholder="Email Id" required="">
                                             </div>
                                              <small class="text-danger" style="display: none;" id="MailErr"><span> * Please Enter Mail Id...</span></small>
                                       </div>
                                    </fieldset>

                                    <fieldset class="form-group">
                                       <div class="col-auto">
                                             <div class="input-group mb-2">
                                                 <div class="input-group-prepend">
                                                    <div class="input-group-text">+91</div>
                                                 </div>
                                                 <input type="text" class="form-control" value="" id="LoginPhoneNumber" name="customer_phone_number" placeholder="Phone Number" required="">
                                             </div>
                                              <small class="text-danger" style="display: none;" id="CPhoneErr"><span> * Please Enter Phone Number...</span></small>
                                       </div>
                                    </fieldset>

                                    <fieldset class="form-group">
                                       <div class="col-auto">
                                             <div class="input-group mb-2">
                                                 <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fa fa-key mt-0"></i></div>
                                                 </div>
                                                 <input type="text" class="form-control" value="" id="LoginPhoneNumber" name="customer_password" placeholder="Password" required="">
                                             </div>
                                              <small class="text-danger" style="display: none;" id="CPassErr"><span> * Please Enter Password...</span></small>
                                       </div>
                                    </fieldset>


                                    <fieldset class="form-group">
                                       <div class="col-auto">
                                             <div class="input-group mb-2">
                                                 <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fa fa-key mt-0"></i></div>
                                                 </div>
                                                 <input type="text" class="form-control" value="" id="LoginPhoneNumber" name="customer_password_2" placeholder="Re-Enter Password" required="">
                                             </div>
                                              <small class="text-danger" style="display: none;" id="CPass2Err"><span> * Please Re Enter Password...</span></small>
                                       </div>
                                    </fieldset>

                                    <fieldset class="form-group">
                                       <div class="col-auto">
                                          <div class="custom-control custom-checkbox">
                                              <input type="checkbox" class="custom-control-input" id="customCheck2" required="">
                                                 <label class="custom-control-label" for="customCheck2"> By checking this you accept our  
                                                   <a href="terms-and-conditions.php" class="text-danger">Term and Conditions</a> and <a href="privacy-policy.php" class="text-danger">Privacy Policies.</a>
                                                </label>
                                           </div>
                                           <small class="text-danger" style="display:none ;" id="TncErr"><span> * Please Accept Terms and Conditions...</span></small>
                                       </div>
                                    </fieldset>


                                    <fieldset class="form-group">
                                       <div class="col-auto">
                                          <button type="submit" name="register_customer" class="btn btn-lg btn-info btn-block p-3" style="font-size: 15px;"><i class="fa fa-user mt-0"></i> Create Your Account</button>
                                       </div>
                                    </fieldset>

                                    </div>  
                                   </div>
                                  
                                 </form>
                                       </div>
                                     </div>


                                    </div>
                                 </div>
                              <div class="clearfix"></div>
                                 <div class="text-center login-footer-tab pb-3">
                                    <ul class="nav nav-tabs" role="tablist">
                                       <li class="nav-item">
                                          <a class="nav-link active" data-toggle="tab" href="#login" role="tab" style="box-shadow: 0px 0px 1px #130101;
    background-color: green !important;
    color: white;"><i class="fa fa-sign-in"></i> LOGIN</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#register" role="tab" style="box-shadow: 0px 0px 1px #130101;
    background-color: #007a80 !important;
    color: white;"><i class="fa fa-pencil"></i> REGISTER</a>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="clearfix"></div>
                                 
                              </div>
                           </form>
      </div>
      </section>
      <br>
 <?php require 'footer.php'; ?>
 <script type="text/javascript">
    function CheckingLoginDetails(){

      var LoginPhoneNumber = document.getElementById('LoginPhoneNumber').value;
      var LoginPassword = document.getElementById("LoginPassword").value;
   if (LoginPhoneNumber === "" || LoginPassword === "") {
      if (LoginPhoneNumber === "") {
          document.getElementById("PhoneErr").style.display = "block";
      }
      if (LoginPassword === "") {
         document.getElementById("PasswordErr").style.display = "block";
      } 
   } else {
      document.getElementById('CheckingLoginDetails').innerHTML = "<i class='fa fa-refresh mt-0 fa-spin'></i> Checking login details...";
   }

    }
 </script>
<!-- Bootstrap core JavaScript -->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <!-- select2 Js -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel -->
      <script src="js/owl.carousel.js"></script>
      <!-- Custom -->
      <script src="js/custom.js"></script>


</body></html>
