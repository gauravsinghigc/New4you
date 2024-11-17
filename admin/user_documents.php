<?php
require 'files.php';
require 'session.php';
$title_name = "User Documents";

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
         <a href="document_types.php"><i class="fa fa-eye"> Document Types</i></a>
        </h4>
       </div><br>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table table-striped zero-configuration" style="font-size: 12px !important;">
           <thead>
            <tr>
             <th>#</th>
             <th>User Name</th>
             <th>Document File</th>
             <th>Document Type</th>
             <th>Upload Date</th>
             <th>Status</th>
             <th>Action</th>
            </tr>
           </thead>
           <tbody>
            <?php
                                                $SQL_user_documents = "SELECT * FROM user_documents";
                                                $QUERY_user_documents = mysqli_query($con, $SQL_user_documents);
                                                $CountSno = 0;
                                                while ($FETCH_user_documents = mysqli_fetch_array($QUERY_user_documents)) {
                                                    $CountSno++;
                                                    $user_id = $FETCH_user_documents['user_id'];
                                                    $document_id = $FETCH_user_documents['document_id'];

                                                    if ($FETCH_user_documents['document_status'] == "verified") {
                                                        $status = '<i class="fa fa-check-circle text-success"></i> Verified';
                                                    } elseif ($FETCH_user_documents['document_status'] == "unverified") {
                                                        $status = '<i class="fa fa-warning text-danger"></i> Unverified';
                                                    }

                                                    $SQL_users = "SELECT * FROM users where user_id='$user_id'";
                                                    $QUERY_users = mysqli_query($con, $SQL_users);
                                                    $FETCH_users = mysqli_fetch_assoc($QUERY_users);

                                                    $SQL_user_documents_types = "SELECT * FROM user_documents_types where document_id='$document_id'";
                                                    $QUERY_user_documents_types = mysqli_query($con, $SQL_user_documents_types);
                                                    $FETCH_user_documents_types = mysqli_fetch_assoc($QUERY_user_documents_types);
                                                ?>
            <tr>
             <td><?php echo $CountSno; ?></td>
             <td>
              <a href="user_edit.php?UserViewID=<?php echo $user_id; ?>"><i class="fa fa-user"></i>
               <?php echo $FETCH_users['full_name']; ?></a>
             </td>
             <td><a href="USER_DATA/userdoc/<?php echo $FETCH_user_documents['document_file']; ?>" target="blank"><i
                class="fa fa-eye"></i> <?php echo $FETCH_user_documents['document_file']; ?></a></td>
             <td><?php echo $FETCH_user_documents_types['document_name']; ?></td>
             <td><?php echo $FETCH_user_documents['document_add_date']; ?></td>
             <td>
              <a
               href="update.php?update_user_documents=<?php echo $FETCH_user_documents['user_documents_id']; ?>&value=<?php echo $FETCH_user_documents['document_status']; ?>&name=<?php echo $FETCH_user_documents_types['document_name']; ?>">
               <?php echo $status; ?></a>
             </td>
             <td><a href="USER_DATA/userdoc/<?php echo $FETCH_user_documents['document_file']; ?>" target="blank"
               class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Open File</a>
              <a href="USER_DATA/userdoc/<?php echo $FETCH_user_documents['document_file']; ?>" target="blank"
               class="btn btn-sm btn-success" download="<?php echo $FETCH_user_documents['document_file']; ?>"><i
                class="fa fa-download"></i> Download</a>
             </td>
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