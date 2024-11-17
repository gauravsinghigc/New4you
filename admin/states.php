<?php
require 'files.php';
require 'session.php';
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Service States : <?php echo $PosName; ?></title>
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
        <h4 class="users-action">All States <i class="fa fa-angle-right"></i>
         <a href="add_state.php" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Add State</a>
         <a href="cities.php" class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i> View Cities</a>
         <a href="areas.php" class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i> View Areas</a>
        </h4>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table table-striped dom-jQuery-events" style="padding: 1%; font-size: 12px;">
           <thead>
            <tr>
             <th>#</th>
             <th>State Name</th>
             <th>Add Date</th>
             <th>Status</th>
             <th>Active Cities</th>
             <th>Action</th>
            </tr>
           </thead>

           <tbody>
            <?php

                        $SelectArea = "SELECT * FROM state";
                        $AreaQuery = mysqli_query($con, $SelectArea);
                        while ($FetchArea = mysqli_fetch_assoc($AreaQuery)) {
                          $state_id = $FetchArea['state_id'];
                          $state_name = $FetchArea['state_name'];
                          $state_status = $FetchArea['state_status'];
                          $add_date = $FetchArea['add_date'];

                          $sql = "SELECT * FROM city where state_name='$state_name'";
                          $araeq = mysqli_query($con, $sql);
                          $countareas = mysqli_num_rows($araeq);

                          if ($countareas == 0) {
                            $btn_disabled = "";
                          } else {
                            $btn_disabled = "disabled";
                          }

                          if ($state_status == "active") {
                            $area_statuss = "<i class='fa fa-check-circle text-success'></i> Active";
                            $btn_type = "btn-success";
                          } else {
                            $area_statuss = "<i class='fa fa-warning text-danger'></i> Inactive";
                            $btn_type = "btn-danger";
                          }

                          echo "<tr>
                                                  <td>$state_id</td>
                                                  <td><a href='cities.php?state=$state_name'><i class='fa fa-info-circle'></i> $state_name</a></td>
                                                  <td>$add_date</td>
                                                  <td>$area_statuss</td>
                                                  <td>$countareas City</td>
                                                   <td>
                                                   <a href='update.php?update_state=$state_id&status=$state_status' class='btn btn-sm $btn_type uppercase'>$state_status</a>
                                                   <a href='delete.php?delete_state=$state_id' class='btn btn-danger btn-sm $btn_disabled'><i class='fa fa-trash'></i></a>
                                                  </td>
                                               </tr>";
                        }
                        ?>
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