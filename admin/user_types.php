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
 <title>Users Types : <?php echo $PosName; ?></title>
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

   <div class="modal fade text-left" id="add_Types" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title" id="myModalLabel17">All Users <i class="fa fa-angle-right"></i> User Types</h4>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
       </button>
      </div>
      <div class="modal-body">
       <form class="form" action="insert.php" method="POST">
        <input type="text" name="CR_URL" value="<?php echo get_url(); ?>" hidden>
        <div class="row">
         <div class="col-md-12">
          <label>Enter User Type <small class="text-muted"><i class="fa fa-angle-right"></i> like employee, store_user,
            teamleaders </small></label>
          <input type="text" name="USER_TYPE_TITLE" value="" class="form-control" required="">
         </div>
        </div>

      </div>
      <div class="modal-footer">
       <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
       <button type="submit" class="btn btn-outline-primary" name="SAVE_USER_TYPES">Save Data</button>
       </form>
      </div>
     </div>
    </div>
   </div>




   <div class="content-body">
    <!-- users list start -->
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action">ALL User Types <i class="fa fa-angle-right"></i>
         <a href="" data-toggle="modal" data-target="#add_Types"><i class="fa fa-plus"></i> User Type</a>
         <a href="users.php">ALL Users</a>
        </h4>

        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
         <ul class="list-inline mb-0">
          <li><a data-action="reload"><i class="fa fa-refresh"></i></a></li>
          <li><a data-action="expand"><i class="fa fa-expand"></i></a></li>
         </ul>
        </div>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table table-striped zero-configuration">
           <thead>
            <tr>
             <th>DATA_ID</th>
             <th>USER_TYPE</th>
             <th>Available Users</th>
             <th>ENTRY_DATE</th>
             <th>Action</th>
            </tr>
           </thead>
           <tbody>
            <?php
                        $SelectUserTypes = "SELECT * FROM user_types";
                        $SelectUserTypesQuery = mysqli_query($con, $SelectUserTypes);
                        while ($SelectUserTypesFetch = mysqli_fetch_assoc($SelectUserTypesQuery)) {
                          $UserTypeid = $SelectUserTypesFetch['user_type_id'];
                          $UserTypeTitle = $SelectUserTypesFetch['user_type_title'];
                          $UserTypeDate = $SelectUserTypesFetch['user_type_date']; ?>
            <tr>
             <td><?php echo $UserTypeid; ?></td>
             <td><?php echo $UserTypeTitle; ?></td>
             <td><?php
                                $CheckUsers = "SELECT * FROM users where user_role='$UserTypeid'";
                                $UserQuery = mysqli_query($con, $CheckUsers);
                                $CountUsers = mysqli_num_rows($UserQuery);
                                if ($CountUsers == 0) {
                                  echo "0";
                                  $btnst = "";
                                } else {
                                  echo "$CountUsers";
                                  $btnst = "disabled";
                                } ?></td>
             <td><?php echo $UserTypeDate; ?></td>
             <td><a href="delete.php?UserTypes=<?php echo $UserTypeid; ?>"
               class='btn btn-sm btn-danger <?php echo $btnst; ?>'><i class="fa fa-trash"></i></a></td>
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