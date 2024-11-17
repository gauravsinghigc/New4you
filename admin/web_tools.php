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
  <title>ADD Web Tools: <?php echo $PosName; ?></title>
  <?php include 'header_files.php'; ?>

 </head>
 <!-- END: Head-->

 <!-- BEGIN: Body-->

 <body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

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
         <h4 class="users-action"><i class="fa fa-edit text-primary"></i> WEB TOOL<i class="fa fa-angle-right"></i>
          <a href="add_tools.php" class="btn btn-lg btn-outline-success"><i class="fa fa-plus"></i> ADD Tools</a>
         </h4>
        </div>

        <div class="card-content">
         <div class="card-body">
          <!-- datatable start -->
          <div class="table-responsive">
           <table class="table table-striped zero-configuration">
            <thead>
             <tr>
              <th style="width: 15%;">NAME</th>
              <th>VALUE</th>
              <th style="width: 10%;">ACTION</th>
             </tr>
            </thead>

            <tbody>
             <?php
												$sql = "SELECT * FROM web_tools";
												$query = mysqli_query($con, $sql);
												while ($fetch = mysqli_fetch_assoc($query)) {
													$tool_id = $fetch['tool_id'];
													$NAME = $fetch['NAME'];
													$VALUE = $fetch['VALUE']; ?>
             <tr>
              <form action="update.php" method="POST">
               <td>
                <?PHP echo $NAME; ?>
               </td>
               <td>
                <input type="text" name="VALUE" value="<?php echo $VALUE; ?>" class="form-control d-input" style="font-size: 13px !important;
    padding: 0.3% !important;
    line-height: 7px !important;
    height: 1%;">
               </td>
               <td>
                <button type="SUBMIT" name="UPDATE_WEB_TOOLS" value="<?php echo $tool_id; ?>" class="btn btn-primary btn-sm">UPDATE</button>
               </td>
              </form>
             </tr>
             <?php } ?>
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
