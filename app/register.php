<?php require 'files.php';
if (isset($_COOKIE['customer_id']) and isset($_COOKIE['store_id'])) {
  $customer_id = $_COOKIE['customer_id'];
  $store_id = $_COOKIE['store_id'];

  $_SESSION['customer_id'] = $customer_id;
  $_SESSION['store_id'] = $store_id;
}
if (isset($_SESSION['customer_id'])) {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Mobilabs">
  <meta name="keywords" content="Mobilabs">
  <meta name="author" content="Mobilabs">
  <link rel="icon" href="<?php echo $app_logo_sq;?>" type="image/x-icon" />
  <link rel="shortcut icon" href="<?php echo $app_logo_sq;?>" type="image/x-icon" />
  <title>Register : <?php echo $app_name;?></title>

  <!--Google font-->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:300,400,700" rel="stylesheet">

  <!-- Vendor CSS -->
  <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="libs/font-material/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="libs/nivo-slider/css/nivo-slider.css">
  <link rel="stylesheet" href="libs/nivo-slider/css/animate.css">
  <link rel="stylesheet" href="libs/nivo-slider/css/style.css">
  <link rel="stylesheet" href="libs/owl.carousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="libs/slider-range/css/jslider.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reponsive.css">

 </head>

 <body
  style="background-image: url('img/isabella-and-louisa-fischer-5tlxS_jlVGY-unsplash.jpg'); background-size: cover; background-repeat: no-repeat;color:black;background-position: center center;background-attachment: fixed;">
  <!-- header part start -->
  <header class="header-2">
   <div class="container-fluid">
    <div class="row header-content">
     <div class="col-lg-12 col-sm-12" style="padding: 1%;">
      <div class="content-header">
       <div class="left-section">
        <div class="header-top" style="padding-top: 2%; padding-bottom: 2%;border-bottom: none;">
         <div class="navbar" style="margin-bottom: 1%;">
          <a href="intro.php">
           <div class="bar-style">
            <img src="img/white.png" style="width: 10%; position: fixed;border-radius: 25px;">
           </div>
          </a>
          <center>
           <a href="">
            <img src="<?php echo $Logo;?>"
                          style="width:25%;border-radius: 3px;margin-top:0%;background-color: white;
    box-shadow: 0px 0px 3px grey;
    padding: 3%;
    border-radius: 4vw;">
           </a>
          </center>
         </div>
        </div>
       </div>

      </div>
     </div>
    </div>
   </div>
  </header>

  <!--section start-->
  <section class="login-page section-b-space">
   <div class="container">
    <div class="row">
     <div class="col-lg-6" style="padding-right: 2%; padding-left: 2%;">
      <h3 class="title">Create An Account</h3>
      <div class="theme-card">
       <?php
                        if (isset($_GET['err'])) {
                            $err = $_GET['err'];?>
       <p class="text-danger" style=" padding: 1%;text-align: center;background-color: #ffffffd6;">
        Oops...<?php echo $err;?>
       </p>
       <?php } else {
                            echo "";
                        }?>

       <?php
  $store_id = $_GET['store_id'];
$sql = "SELECT * FROM stores where store_id='$store_id'";
$query = mysqli_query($con, $sql);
$fetch_store = mysqli_fetch_assoc($query);
$store_name = $fetch_store['store_name'];
$store_phone = $fetch_store['store_phone'];
$store_mail_id = $fetch_store['store_mail_id'];
$store_address = $fetch_store['store_address'];
$store_arealocality = $_GET['area'];
$store_city = $fetch_store['store_city'];
$store_state = $fetch_store['store_state'];
$store_pincode = $fetch_store['store_pincode'];
$store_gst = $fetch_store['GST'];
$store_pan = $fetch_store['PAN'];
  ?>
       <form class="theme-form" action="insert.php" method="POST">

        <input type="text" class="form-control" name="street_address" value="" hidden="" style="display: none;">
        <input type="text" class="form-control" name="area_locality" value="<?php echo $store_arealocality;?>" hidden=""
         style="display: none;">
        <input type="text" class="form-control" name="customer_city" value="<?php echo $store_city;?>" hidden=""
         style="display: none;">
        <input type="text" class="form-control" name="customer_state" value="<?php echo $store_state;?>" hidden=""
         style="display: none;">
        <input type="text" class="form-control" name="address_pincode" value="<?php echo $store_pincode;?>" hidden=""
         style="display: none;">
        <input type="text" class="form-control" name="store_id" value="<?php echo $store_id;?>" hidden=""
         style="display: none;">

        <input type="text" name="cr_url" value="<?php get_url();?>" hidden>
        <div class="row">
         <div class="col-sm-12" style="padding-top: 1%;
    padding-bottom: 2%;">
          <input type="text" class="form-control" name="customer_name" placeholder="Full Name" required="" style="padding: 5.5%;">
         </div>
        </div>
        <div class="row">
         <div class="col-sm-12" style="padding-top: 1%;
    padding-bottom: 2%;">
          <input type="text" class="form-control" name="customer_phone_number" min="10" max="10" maxlength="10" minlength="10" placeholder="Without +91" required="" style="padding: 5.5%;">
         </div>
         <div class="col-sm-12" style="padding-top: 1%;
    padding-bottom: 2%;">
          <input type="text" class="form-control" name="customer_password" placeholder="********" required="" style="padding: 5.5%;">
         </div>
         <div class="col-sm-12" style="padding-top: 1%;
    padding-bottom: 2%;">
          <input type="text" class="form-control" name="customer_password_2" placeholder="********" required="" style="padding: 5.5%;">
         </div>

         <div class="col-sm-12" style="padding-top: 1%;
    padding-bottom: 2%;">
          <button type="submit" name="register_customer" class="btn btn-solid"
           style='background-color: #006493; font-family:auto;'>Create
           Account</button>
         </div>


        </div>
       </form>
      </div>
     </div>
     <div class="col-sm-12 right-login" style='margint-bottom:5%;'>
      <h4 class="title">Already Have an Account?</h4>
      <div class="theme-card authentication-right">
       <a href="login.php" class="btn btn-solid" style="background-color: brown;font-family:auto;">Login</a>
      </div><br><br>
     </div>
     <div class="col-sm-12" style='position: absolute; bottom:0;'>
      <h6 style="text-align: center;">

       <hr style="width:50%;">
      </h6>

     </div>
    </div>
   </div>
  </section>
  <!--Section ends-->


  <?php if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
 ?>

  <div class="modal fade bd-example-modal-lg theme-modal newsletter-popup" id="exampleModal" tabindex="-1" role="dialog"
   aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style='border-radius: 20px;'>
     <div class="modal-body" style='background-image:none;border-radius:20px;'>
      <div class="container-fluid p-0">
       <div class="row">
        <div class="col-12">
         <div class="modal-bg">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
          <div class="offer-content text-center">
           <img src='img/full-width-white.png' style='width:100px;'>
           <h4 style='text-transform:none;'>
            <?php echo $msg;?>
           </h4>
           <button type="submit" class="btn btn-solid text-center" data-dismiss="modal">Close</button>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
  <?php }?>



  <!-- latest jquery-->
  <script src="assets/js/jquery-3.3.1.min.js"></script>

  <!-- menu js-->
  <script src="assets/js/menu.js"></script>

  <!-- popper js-->
  <script src="assets/js/popper.min.js"></script>

  <!-- slick js-->
  <script src="assets/js/slick.js"></script>

  <!-- Bootstrap js-->
  <script src="assets/js/bootstrap.js"></script>


  <!-- Bootstrap Notification js-->
  <script src="assets/js/bootstrap-notify.min.js"></script>

  <!-- Theme js-->
  <script src="assets/js/script.js"></script>

  <script>
  function openSearch() {
   document.getElementById("search-overlay").style.display = "block";
  }

  function closeSearch() {
   document.getElementById("search-overlay").style.display = "none";
  }
  </script>

 </body>

</html>
