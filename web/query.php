<?php require 'files.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $store_name;?> : Have a Query?</title>
      <?php include 'header_files.php';?>
<script type="text/javascript"></script>
   </head>
   <body style="font-size: 15px !important;">
      <?php require 'header.php'; ?>

      <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <a href="index.php"><strong><span class="fa fa-home"></span> Home</strong></a> <span class="fa fa-angle-right"></span> Have a Query?
               </div>
            </div>
         </div>
      </section>
      <section class="container-fluid" style="background-image: url('img/feedback-page-24kharido.jpg');background-size: cover;background-position: center; background-repeat: no-repeat;">
         <div class="row p-5" style="padding: 10% !important;">
         <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12 col-12 mx-auto p-4 pt-5 pb-5" style="background-color: #fffffff0!important;">
            <h4>Send Us your Queries & Suggestion</h4>
            <p>Feel free to send us your queries, suggestions and feedback.</p><hr>
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
               <div class="form-group">
                  <input type="text" name="query_subject" class="form-control" placeholder="Subject" required="">
               </div>
                <div class="form-group">
                  <textarea class="form-control" name="query_details" placeholder="Enter Your Query Details" required="" rows="5"></textarea>
               </div>
               <div class="form-group">
                  <button class="btn btn-md btn-success btn-block font-15 p-3" type="submit" name="SAVE_QUERY" onclick="QueryClick()"><span id="QueryClick bottom-text"><i class="fa fa-send"></i> Send Query</span></button>
               </div>
            </form>
         </div>
      </div>
      </section>

 <?php require 'why_section.php'; require 'login_section.php'; require 'footer.php'; ?>
<!-- Bootstrap core JavaScript -->
</body></html>
