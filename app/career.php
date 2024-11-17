<?php require 'files.php'; include 'session.php';?>
<html style="<?php echo $ThemeColor; ?>">

 <head>
  <title><?php echo $AppNameWithExt; ?> ! <?php echo $AppTag; ?></title>
  <?php GSI_header_files(); ?>
 </head>

 <body>
  <!-- header part end -->
  <?php include("header.php");?><br>
  <section class="container-fluid">
   <div class="row">
    <div class="col-lg-12 bg-success p-1">
     <h3 class="font-7 text-white ml-2">Career or Join Us</h3>
    </div>
    <a href="index.php">
     <button class="btn btn-lg fixed-bottom btn-block bottom-p bottom-text btn-info"><i class="fa fa-angle-left"></i> Back to Home</button>
    </a>
    <div class="col-lg-12" style='text-align:justify;'>
     <br>
     <img src="../img/career-banner.jpg" class="img-fluid mb-2" style="width: 100%;">
     <h4>Find jobs by teams</h4>
     <p>At 24Kharido, we're always on the lookout for someone who believes in putting consumers above everyone and everything else, while envisioning growth and pursuing excellence for the years to
      come. Sounds like you?</p>
     <p>to work with us, please send your update CV or Resume at <br><br><a href="mailto:<?php echo $store_mail_id;?>"
       class="btn btn-info text-white p-2 d-block mx-auto"><?php echo $store_mail_id;?></a>
     </p>
    </div>
   </div>
  </section>
  <br><br><br>

  <?php GSI_footer_files(); ?>
 </body>

</html>
