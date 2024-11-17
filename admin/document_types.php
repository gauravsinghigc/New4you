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

    <div class="modal fade text-left" id="add_document_types" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel17" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
       <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel17">All Documents Types <i class="fa fa-angle-right"></i> Add Document
         Type</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
       </div>
       <div class="modal-body">
        <form class="form" action="insert.php" method="POST">
         <input type="text" name="CR_URL" value="<?php echo get_url(); ?>" hidden>
         <div class="row">
          <div class="col-md-12">
           <label>Enter Document Type <small class="text-muted"><i class="fa fa-angle-right"></i> pancard, adhaar card,
             votar card, driving liscence etc </small></label>
           <input type="text" name="document_name" value="" class="form-control" required="">
          </div>
         </div>

       </div>
       <div class="modal-footer">
        <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
        <button type="submit" class="btn btn-outline-primary" name="SAVE_NEW_DOCUMENT_TYPE">Save Data</button>
        </form>
       </div>
      </div>
     </div>
    </div>


    <!-- users list start -->
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action"><i class="fa fa-table text-primary"></i> <?php echo $title_name; ?> <i
          class="fa fa-angle-right"></i>
         <a href="#" data-toggle="modal" data-target="#add_document_types"><i class="fa fa-plus"> Document Type</i></a>
         <a href="user_documents.php"><i class="fa fa-eye"> User Documents</i></a>
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
             <th>Document Type</th>
             <th>Available Docs</th>
             <th>Add Date</th>
             <th>Status</th>
             <th>Action</th>
            </tr>
           </thead>
           <tbody>
            <?php
                                                $SQL_user_documents_types = "SELECT * FROM user_documents_types ORDER BY document_name ASC";
                                                $QUERY_user_documents_types = mysqli_query($con, $SQL_user_documents_types);
                                                $CountSno = 0;
                                                while ($FETCH_user_documents_types = mysqli_fetch_assoc($QUERY_user_documents_types)) {
                                                    $CountSno++;
                                                    if ($FETCH_user_documents_types['doc_type_status'] == "active") {
                                                        $status = '<input type="checkbox" id="switcherySize3" class="switchery mt-0" data-size="xs" checked/>';
                                                    } elseif ($FETCH_user_documents_types['doc_type_status'] == "inactive") {
                                                        $status = '<input type="checkbox" id="switcherySize3" class="switchery bg-danger mt-0" data-size="xs"/>';
                                                    }
                                                    $SQL_user_documents = "SELECT * FROM user_documents where document_id='" . $FETCH_user_documents_types['document_id'] . "'";
                                                    $QUERY_user_documents = mysqli_query($con, $SQL_user_documents);
                                                    $CountDocs = mysqli_num_rows($QUERY_user_documents);
                                                    if ($CountDocs == null) {
                                                        $CountDocs = "0";
                                                        $Btnst = "";
                                                    } else {
                                                        $CountDocs = $CountDocs;
                                                        $Btnst = "disabled";
                                                    } ?>
            <tr>
             <form action="update.php" method="POST">
              <td><?php echo $CountSno; ?></td>
              <td><input type="text" value="<?php echo $FETCH_user_documents_types['document_name']; ?>"
                name="document_name" class="form-control d-input" required=""></td>
              <td><?php echo $CountDocs; ?></td>
              <td><?php echo $FETCH_user_documents_types['doc_type_add_date']; ?></td>
              <td><a
                href="update.php?update_doc_type=<?php echo $FETCH_user_documents_types['document_id']; ?>&value=<?php echo $FETCH_user_documents_types['doc_type_status']; ?>&name=<?php echo $FETCH_user_documents_types['document_name']; ?>"><?php echo $status; ?></a>
              </td>
              <td>
               <button class='btn btn-sm btn-info' type="submit" name="Update_User_Docs"
                value="<?php echo $FETCH_user_documents_types['document_id']; ?>"><i class="fa fa-edit"></i></button>
               <a
                href="delete.php?delete_user_documents=<?php echo $FETCH_user_documents_types['document_id']; ?>&name=<?php echo $FETCH_user_documents_types['document_name']; ?>"
                class="btn btn-sm btn-danger <?php echo $Btnst; ?>"><i class="fa fa-trash"></i></a>
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