<?php require 'text.php'; ?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <title>ERROR : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column blank-page blank-page bg-white" data-open="click"
 data-menu="vertical-menu-modern" data-col="1-column">
 <!-- BEGIN: Content-->
 <div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
   <div class="content-header row">
   </div>
   <div class="content-body">
    <section class="flexbox-container">
     <div class="col-12 d-flex align-items-center justify-content-center">
      <div class="col-md-10 col-10 p-0 pl-0">
       <div class="card-header bg-transparent border-0 pl-0">
        <img src="img/404.gif">
        <h1 class="error-code mb-2 pl-0"><i class="fa fa-warning text-danger"></i> Oopss... Something went wrong!</h1>
        <hp class="text-left"><B>ERROR_DETAILS :</B>
         <?php if (isset($_GET['err'])) {
                                        $ERR = $_GET['err'];
                                        echo $ERR;
                                    } else {
                                        header("location: index.php");
                                    } ?></hp>
       </div>
       <div class="card-content">
        <div class="row py-2">
         <div class="col-12 col-sm-6 col-md-6 mb-1 ">
          <a href="index.php" class="btn btn-md btn-primary"><i class="fa fa-angle-left"></i> Back to Home</a>
         </div>
        </div>
       </div>
      </div>
     </div>
    </section>

   </div>
  </div>
 </div>
 <!-- END: Content-->
 <?php include 'footer.php'; ?>

</body>

</html>