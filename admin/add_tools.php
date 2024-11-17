<?php
require 'files.php';
require 'session.php';
ini_set("display_errors", 0);
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Web Tools Settings : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click"
 data-menu="vertical-menu-modern" data-col="2-columns">

 <?php require 'header.php'; ?>


 <?php require 'sidebar.php'; ?>

 <!-- BEGIN: Content-->
 <div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
   <div class="content-header row">
    <div class="col-lg-12 card-content">
     <?php notification(); ?>
    </div>
   </div>

   <div class="content-body">
    <!-- users list start -->
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action"><i class="fa fa-edit text-primary"></i> Web Tools Settings <i
          class="fa fa-angle-right"></i>
         <a href="web_tools.php" class="btn btn-lg btn-outline-success"><i class="fa fa-eye"></i> View Tools</a>
        </h4>
        <hr>
       </div>

       <div class="card-content">
        <div class="card-body">
         <form action="insert.php" method="POST">
          <div class="row">
           <div class="col-lg-3 col-sm-3 col-12 col-md-3">
            <div class="form-group">
             <label>Tool Name</label>
             <input type="text" name="NAME" value="" class="form-control" placeholder="ABC_XYZ">
            </div>
           </div>
           <div class="col-lg-9 col-sm-9 col-12 col-md-9">
            <div class="form-group">
             <label>Tool VALUE</label>
             <input type="text" name="VALUE" value="" class="form-control" placeholder="hjdhjgsbdhgb">
            </div>
           </div>
           <div class="col-lg-2 col-sm-2 col-12 col-md-2">
            <div class="form-group">
             <label>&nbsp;</label>
             <button class="btn btn-success btn-lg" type="submit" name="WEB_TOOL_INSERT"> Save Tools</button>
            </div>
           </div>
          </div>
         </form>
        </div>
       </div>
      </div>
     </div>
    </section>
    <!-- users list ends -->
   </div>
  </div>
 </div>
 <!-- END: Content-->

 <?php require 'footer.php'; ?>

</body>
<!-- END: Body-->

</html>