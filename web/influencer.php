<?php require 'files.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $store_name;?> : Become an Influence</title>
      <?php include 'header_files.php';?>
<script type="text/javascript"></script>
   </head>
   <body style="font-size: 15px !important;">
      <?php require 'header.php'; ?>

      <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <a href="index.php"><strong><span class="fa fa-home"></span> Home</strong></a> <span class="fa fa-angle-right"></span> Earn with Us
               </div>
            </div>
         </div>
      </section>
      <section class="container-fluid">
         <div class="row bg-white">
            <img src="img/SP0y.txt" class="img-fluid" style="width: 100%;">
         <div class="col-md-6 col-lg-6 col-sm-10 col-12 p-2 d-block mx-auto">
           <h2 class="text-center">Influence Program is Coming Soon</h2>
           <p>Show your Intrest By Sending you Details. We will inform as we start the program...</p>
           <form action="insert.php" method="POST">
               <input type="text" name="QUERY_SOURCE" value="website" hidden="">
               <div class="form-group">
                  <input type="text" name="full_name" class="form-control" placeholder="Full Name" required="">
               </div>
               <div class="form-group">
                  <input type="email" name="email" class="form-control" placeholder="Email Id" required="">
               </div>
               <div class="form-group">
                  <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required="">
               </div>
                  <input type="text" name="query_subject" class="form-control" placeholder="Subject" required="" value="INFLUENCER PROGRAM" hidden="">
                <div class="form-group">
                  <textarea class="form-control" name="query_details" placeholder="Enter Your Query Details" required="" rows="5"></textarea>
               </div>
               <div class="form-group">
                  <button class="btn btn-md btn-success btn-block p-3" type="submit" name="SAVE_QUERY" onclick="QueryClick()" style="font-size: 15px;"><span id="QueryClick">Send Query</span></button>
               </div>
            </form>
         </div>
      </div>
      </section>

 <?php require 'why_section.php'; require 'login_section.php'; require 'footer.php'; ?>
<!-- Bootstrap core JavaScript -->
</body></html>
