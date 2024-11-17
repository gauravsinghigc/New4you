<?php
require 'files.php';
require 'session.php';
$title_name = "Static Pages";

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title><?php echo $title_name; ?> : <?php echo $PosName; ?></title>
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
        <h4 class="users-action"><i class="fa fa-table text-primary"></i> <?php echo $title_name; ?> <i
          class="fa fa-angle-right"></i>
         <a href="add_static.php"><i class="fa fa-plus"></i> Create Page</a>
        </h4>
       </div><br>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <style>
         table tr th,
         td {
          font-size: 12.5px !important;
         }
         </style>
         <div class="table-responsive">
          <table class="table table-striped zero-configuration" style="font-size: 12px !important;">
           <thead>
            <tr>
             <th>#</th>
             <th>PageId</th>
             <th>AccessKey</th>
             <th>PageTitle</th>
             <th>Status</th>
             <th>CreatedOn</th>
             <th>LastUpdated</th>
             <th>Views</th>
             <th>Action</th>
            </tr>
           </thead>
           <tbody>

            <!-- Modal -->

            <div class="modal fade text-left" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
             aria-hidden="true">
             <div class="modal-dialog" role="document">
              <div class="modal-content">
               <div class="modal-header">
                <h4 class="modal-title font-medium-2" id="myModalLabel1"><i class="fa fa-history text-success"></i>
                 <?php echo $title_name; ?> <i class="fa fa-angle-right"></i> <i class="fa fa-sign-out"></i> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
               </div>
               <div class="modal-body">

               </div>
               <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>

               </div>
              </div>
             </div>
            </div>


           </tbody>
          </table>
         </div>
         <!-- datatable ends -->
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