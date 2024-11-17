<?php require 'files.php'; include 'session.php';?>
<!DOCTYPE html>
<html lang="en">

 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $store_name;?> : Career</title>
  <?php include 'header_files.php';?>
  <script type="text/javascript"></script>
 </head>

 <body style="font-size: 15px !important;">
  <?php require 'header.php'; ?>

  <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
   <div class="container-fluid">
    <div class="row">
     <div class="col-md-12">
      <a href="index.php"><strong><span class="fa fa-home"></span> Home</strong></a> <span class="fa fa-angle-right"></span> Join Us
     </div>
    </div>
   </div>
  </section>
  <section class="container-fluid">
   <div class="row bg-white">
    <img src="img/career-banner.jpg" class="img-fluid" style="width: 100%;">
    <div class="col-md-10 col-lg-10 col-sm-10 col-12 p-2 d-block mx-auto">
     <h4>Find jobs by teams</h4>
     <p>At <?php echo $store_name;?>, we're always on the lookout for someone who believes in putting consumers above everyone and everything else, while envisioning growth and pursuing excellence for
      the years to come. Sounds like you?</p>
     <p>to work with us, please send your update CV or Resume at <a href="mailto:<?php echo $store_mail_id;?>" class="btn btn-info"><?php echo $store_mail_id;?></a></p>
    </div>
   </div>
  </section>

  <?php require 'why_section.php'; require 'login_section.php'; require 'footer.php'; ?>
  <!-- Bootstrap core JavaScript -->
 </body>

</html>
