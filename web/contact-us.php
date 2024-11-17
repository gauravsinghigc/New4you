<?php require 'files.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $store_name;?> : Contact Us</title>
      <?php include 'header_files.php';?>
<script type="text/javascript"></script>
   </head>
   <body style="font-size: 15px !important;">
      <?php require 'header.php'; ?>

      <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <a href="index.php"><strong><span class="fa fa-home"></span> Home</strong></a> <span class="fa fa-angle-right"></span> Contact Us
               </div>
            </div>
         </div>
      </section>
      <section class="container-fluid">
         <div class="row bg-white">
            <img src="img/contact-us-banner.png" class="img-fluid" style="width: 100%;">
         <div class="col-md-6 col-lg-6 col-sm-6 col-12 p-2 pl-5">
            <br>
           <h2 class="text-center">Feel free to Contact Us</h2>
           <p>Fill your details we, will contact you as soon as possible.</p>
           <p><small class="text-info"><?php if(isset($_SESSION['customer_id'])) { echo "Dear $customer_name, you are already loged in So we pick Default contact details, please fill your message or query now." ;} ?></small></p>
           <form action="insert.php" method="POST">
               <input type="text" name="QUERY_SOURCE" value="website" hidden="">
              <div class="form-group">
                  <input type="text" name="full_name" class="form-control" placeholder="Full Name" required="" value="<?php if(isset($_SESSION['customer_id'])) { echo $customer_name; } else {} ?>">
               </div>
               <div class="form-group">
                  <input type="email" name="email" class="form-control" placeholder="Email Id" required="" value="<?php if(isset($_SESSION['customer_id'])) { echo $customer_mail_id; } else {} ?>">
               </div>
               <div class="form-group">
                  <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required="" value="<?php if(isset($_SESSION['customer_id'])) { echo $customer_phone_number; } else {} ?>">
               </div>
                  <input type="text" name="query_subject" class="form-control" placeholder="Subject" required="" value="Contact Details" hidden="">
                <div class="form-group">
                  <textarea class="form-control" name="query_details" placeholder="Enter Your Query Details" required="" rows="5"></textarea>
               </div>
               <div class="form-group">
                  <button class="btn btn-md btn-success btn-block font-15 p-3" type="submit" name="SAVE_QUERY" onclick="QueryClick()"><span id="QueryClick">Send Query</span></button>
               </div>
            </form>
            
         </div>
         <div class="col-md-6 col-lg-6 col-sm-6 col-12 p-2 pl-5">
            <br>
           <h4 class="mb-4 mt-0"><a class="logo" href="<?php echo $domain;?>"><img src="<?php echo $logo;?>" alt="<?php echo $store_name;?>" style="width:50%;"></a></h4>
                  <p class="mb-0" style="margin-top: -6%;
"><a href="text-dark"><i class="fa fa-map-marker"> </i> <?php echo $store_address;?></a></p>
                  <p class="mb-0"><a class="text-dark" href="tel:<?php echo $store_phone;?>"><i class="fa fa-phone"></i> +91-<?php echo $store_phone;?></a></p>
                  <p class="mb-0"><a class="text-success" href="mailto:<?php echo $store_mail_id;?>"><i class="fa fa-envelope"></i> <?php echo $store_mail_id;?></a></p>
                  <p class="mb-0"><a class="text-primary" href="<?php echo $domain;?> "><i class="fa fa-globe"></i> <?php echo $domain;?> </a></p>
<hr>
                   <h2 class="mb-2">Download App</h2>
                  <div class="app">
                     <a href="https://play.google.com/store/apps/details?id=com.gauravsinghigc.u24kharido"><img src="img/google.png" alt=""></a>
                     <!--<a href=""><img src="img/apple.png" alt=""></a> -->
                  </div>
                  <div class="mt-2">
                    <hr>
                    <h5>Like, Follow & Share </h5>
                    <style type="text/css">
                .Footer-menu-list li {
                   display: inline-block;
                   padding: 0.2%;
                   margin:0.2%;
                   text-decoration: underline green;
                }
                .Footer-menu-list li:hover {
                   display: inline-block;
                   padding: 0.2%;
                   margin:0.2%;
                   text-decoration: underline red !important;
                }
              </style>
                    <ul style="font-size: 13px;" class="Footer-menu-list">
                     <a href="https://www.facebook.com/24kharido" target="blank" class="text-white"><li style="font-size: 22px;
    background: #205fae;
    border-radius: 50%;
    padding: 1%;
    padding-left: 4%;
    padding-right: 4%;
    color: white;"><i class="fa fa-facebook mt-2"></i></li></a>
    <a href="https://twitter.com/24kharido" target="blank" class="text-white">
                    <li style="font-size: 22px;
    background:#3d8df1;
    border-radius: 50%;
    padding: 1%;
    padding-left: 3%;
    padding-right: 3%;
    color: white;"><i class="fa fa-twitter mt-2"></i></li></a>

    <a href="https://www.instagram.com/24kharido/" target="blank" class="text-white">
                    <li style="font-size: 22px;
    background:#f13d90;
    border-radius: 50%;
    padding: 1%;
    padding-left: 3%;
    padding-right: 3%;
    color: white;"><i class="fa fa-instagram mt-2"></i></li></a>

     <a href="https://www.linkedin.com/company/24kharido" target="blank" class="text-white">
                    <li style="font-size: 22px;
    background:#1e8fc5;
    border-radius: 50%;
    padding: 1%;
    padding-left: 3%;
    padding-right: 3%;
    color: white;"><i class="fa fa-linkedin mt-2"></i></li></a>

    <a href="https://www.youtube.com/channel/UCFTQ9lssYJuTYGOLHlNO8Iw" target="blank" class="text-white">
                    <li style="font-size: 22px;
    background:red;
    border-radius: 50%;
    padding: 1%;
    padding-left: 3%;
    padding-right: 3%;
    color: white;"><i class="fa fa-youtube mt-2"></i></li></a>

                    </ul>
                 </div>
            
         </div>
         <div class="col-md-12 col-lg-12 col-sm-12 col-12 p-2">
            <hr>
            <h3 class="text-success text-center">If You Have any Query</h3>
<h4 class="text-success text-center">
   Please feel free to contact us via Call on <a href="tel:<?php echo $store_phone;?>" class="text-info"><i class="fa fa-phone"></i> <?php echo $store_phone;?></a> or Mail at <a href="mailto:<?php echo $store_mail_id;?>" class="text-info"><i class="fa fa-envelope"></i> <?php echo $store_mail_id;?></a>
</h4>
         </div>
      </div>
      </section>

 <?php require 'why_section.php'; require 'login_section.php'; require 'footer.php'; ?>
<!-- Bootstrap core JavaScript -->
</body></html>
