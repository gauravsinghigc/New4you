<?php include 'files.php';
if (isset($_COOKIE['customer_id']) and isset($_COOKIE['store_id'])) {
    $customer_id = $_COOKIE['customer_id'];
    $store_id = $_COOKIE['store_id'];

    $_SESSION['customer_id'] = $customer_id;
    $_SESSION['store_id'] = $store_id;
}
if (isset($_SESSION['customer_id'])) {
    header("location: index.php?msg=Already Login");
}

if (isset($_GET['go_url'])) {
    $Go_Url = $_GET['go_url'];
} else {
    $Go_Url = "index.php";
} ?>
<html>

 <head>
  <title><?php echo $AppNameWithExt; ?> ! <?php echo $AppTag; ?></title>
  <?php GSI_header_files(); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 </head>
 <style type="text/css">
 #loader {
  border: 12px solid #f3f3f3;
  border-radius: 50%;
  border-top: 12px solid #444444;
  width: 70px;
  height: 70px;
  animation: spin 1s linear infinite;
  z-index: 100000000000000000;
 }

 @keyframes spin {
  100% {
   transform: rotate(360deg);
  }
 }

 .center {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
 }

 </style>

 <body>

  <div id="loader" class="center"></div>
  <div class="container-fluid k-align mt-0">
   <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 col-xl-12 col-xxs-12 mb-0 mt-4">
     <img src="<?php echo $LogoRec; ?>" class="img-fluid mx-auto d-block w-50 mb-0">
     <p class="text-center kharido-TagLine mt-0 font-3" id='KharidoTagLine' style="margin-top: -3px !important;"><?php echo $AppTag; ?></p>
    </div>
   </div>
  </div>

  <div class="container-fluid mb-0 mt-5">
   <div class="row">
    <?php if (isset($_GET['err'])) {
                GetMsg();
            } else { ?>
    <div class="mt-5"></div>
    <?php } ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-0 mt-5" style="margin-top:10% !important;">
     <div class="mt-5"></div>
     <span id="LoginErrorMsgBoth" class="text-danger font-4"></span>
     <form action="insert.php" method="POST" id="LoginForm" name="loginForm" class="font-4 mb-0">
      <input type="text" name="go_url" value="<?php echo $Go_Url; ?>" hidden="">
      <div class="form-group">
       <span id="LoginErrorPhoneMsg" class="text-danger font-4"></span>
       <input type="phone" class="form-control tr-input pl-4 font-8" value="" id="LoginPhoneNumber" name="CustomerPhone" placeholder="Enter Phone Number" required=""
        style="border-radius: 50px !important;">
      </div>
      <div class="form-group">
       <span id="LoginErrorPassMsg" class="text-danger font-4"></span>
       <input type="password" name="CustomerPassword" id="CustomerPassword" value="" class="form-control tr-input pl-4 font-8" placeholder="********" required=""
        style="border-radius: 50px !important;">
      </div>
      <div class="form-group">
       <button class="btn btn-success btn-md KLoginButton btn-block bottom-text" name="login_request" onclick="LoginAction()"><span id="LoginAction">Login <i class="fa fa-sign-in"></i></span>
       </button>
      </div>
     </form>

     <form action="insert.php" method="POST" id="SignupForm" class="k-Hide mb-0" style="display:none;">
      <input type="text" name="go_url" value="<?php echo $Go_Url; ?>" hidden="">
      <div class="form-group">
       <span id="CustomerNameMsg" class="text-danger font-4"></span>
       <input type="text" name="CustomerName" id="RegCustomerName" class="form-control tr-input pl-4 font-8" placeholder="Full Name" required="">
      </div>
      <div class="form-group">
       <span id="CustomerPhoneMsg" class="text-danger font-4"></span>
       <input type="text" name="CustomerPhone" id="RegCustomerPhone" class="form-control tr-input pl-4 font-8" placeholder="Phone without +91" required="">
      </div>
      <div class="form-group">
       <span id="CustomerEmailMsg" class="text-danger font-4"></span>
       <input type="email" name="CustomerEmail" id="RegCustomerEmail" class="form-control tr-input pl-4 font-8" placeholder="Email ID" required="">
      </div>
      <div class="form-group">
       <span id="CustomerPasswordMsg" class="text-danger font-4"></span>
       <input type="password" name="CustomerPassword" id="RegCustomerPass" oninput="CheckPassword()" class="form-control tr-input pl-4 font-8" placeholder="********" required="">
      </div>
      <div class="form-group">
       <span id="CustomerPasswordMsg2" class="text-danger font-4"></span>
       <input type="text" name="CustomerPassword" id="RegCustomerPass2" oninput="CheckPassword()" class="form-control tr-input pl-2 font-7" placeholder="********" required="">
       <span id="PasswordNotMatch" class="text-danger font-5"></span>
      </div>
      <div class="form-group">
       <button class="btn btn-success btn-md KLoginButton btn-block mb-0 bottom-text disabled" name="register_customer" onclick="RegisterAction()" id="RegBtn"><span id="RegisterAction"> Signup <i
          class="fa fa-sign-in"></i></span></button>
      </div>
     </form>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
     <button class="btn btn-outline-info KLoginButton btn-block bottom-text mt-0" onclick="CustomerAction()" style="margin-top: -6px !important;"><i class="fa fa-sign-in"></i><span id='ActionName'>
       Create an Account</span></button>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3 pl-3 pr-3">
     <a href="forget.php" class="btn btn-sm btn-link float-left text-black font-5 pl-1 p-2">Forget Password?</a>
     <a href="index.php" class="btn btn-sm float-right btn-info text-white font-5 p-2 pl-3 pr-3 rounded" style="border-radius: 50px !important;">Skip Login/SignUp</a>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-2 pl-1 pr-1">
     <hr class="text-center d-block mx-auto mt-2 mb-2">
     <p class="text-center copyrighted mb-1">CopyRighted &copy; <?php echo date("Y"); ?> All Right are Reserved By <a href="https://<?php echo $AppNameWithExt; ?>"
       class="text-info"><?php echo $AppNameWithExt; ?></a><br>
      By Continue this, You agree our <a href="terms-and-conditions.php" class="text-info">terms & condition.</a></p>
    </div>
   </div>
  </div>

  <?php GSI_footer_files(); ?>

  <script type="text/javascript">
  document.onreadystatechange = function() {
   if (document.readyState !== "complete") {
    document.querySelector(
     "body").style.visibility = "hidden";
    document.querySelector(
     "#loader").style.visibility = "visible";
   } else {
    document.querySelector(
     "#loader").style.display = "none";
    document.querySelector(
     "body").style.visibility = "visible";
   }
  };
  </script>

  <script type="text/javascript">

  </script>
 </body>

</html>
