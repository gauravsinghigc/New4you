<?php require 'files.php';
if (isset($_POST['view'])) {
    $_SESSION['view_id'] = $_POST['id'];
    $id = $_SESSION['view_id'];
} else {
    $id = $_SESSION['view_id'];
}
$id_d = modify("$id", "d");
$sql = "SELECT * FROM contacts_list where contact_id='$id_d'";
$query =  mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$contact_entry_date = $fetch['contact_entry_date'];
$contact_emailid = $fetch['contact_emailid'];
$contact_fullname = $fetch['contact_fullname'];
$contact_phone = $fetch['contact_phone'];
$contact_title = $fetch['contact_title'];
$contact_username = $fetch['contact_username'];
$contact_password = $fetch['contact_password'];
$contact_type = $fetch['contact_type'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8" />
 <title><?php echo modify($fetch['contact_fullname'], "d"); ?> @ <?php echo modify($fetch['contact_title'], "d"); ?> |
  <?php echo $name; ?></title>

 <?php require 'meta.php';
    require 'stylesheet.php'; ?>

</head>

<body>
 <!-- begin #page-loader -->
 <div id="page-loader" class="page-loader fade in"><span class="spinner">Loading...</span></div>
 <!-- end #page-loader -->



 <!-- begin #page-container -->
 <div id="page-container"
  class="fade page-container page-header-fixed page-sidebar-fixed page-with-two-sidebar page-with-footer">

  <?php require 'header.php';
        require 'sidebar.php'; ?>

  <!-- begin #content -->
  <div id="content" class="content">
   <!-- begin page-header -->
   <h1 class="page-header"><i class="fa fa-user"></i> <?php echo modify($fetch['contact_fullname'], "d"); ?> <i
     class="fa fa-angle-right"></i>
    <small>
     <a href='#<?php echo $id; ?>_update_contact' data-toggle="modal">
      <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-edit"></i> Update</button>
     </a>
     <a href="#more_info" data-toggle="modal">
      <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> More Details</button>
     </a>
     <a href="#modal-dialog" data-toggle="modal">
      <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> Projects</button>
     </a>
     <a href="#modal-dialog" data-toggle="modal">
      <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> Credentials</button>
     </a>
     <a href="#modal-dialog" data-toggle="modal">
      <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> Transaction</button>
     </a>
     <a href="#modal-dialog" data-toggle="modal">
      <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> Invoices</button>
     </a>
     <a href="#modal-dialog" data-toggle="modal">
      <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> Reference
       links</button>
     </a>
    </small>
   </h1>
   <hr class="hr-mr">
   <!-- end page-header -->
   <!-- content -- >
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
            <!-- begin widget -->
   <div class="widget widget-blog">
    <div class="widget-blog-cover list-bg-style">
    </div>
    <div class="widget-blog-author">
     <div class="widget-blog-author-image">
      <img src="assets/img/user_img/user_3.jpg" alt="<?php echo modify($fetch['contact_fullname'], "d"); ?>"
       title="<?php echo modify($fetch['contact_fullname'], "d"); ?>">
     </div>
     <div class="widget-blog-author-info">
      <h5 class="m-t-0 m-b-1"><?php echo modify($fetch['contact_fullname'], "d"); ?>
       <span class="float-right f-s-11 text-muted">
        <b>Reg.</b> <?php echo modify($fetch['contact_entry_date'], "d"); ?> / UID<?php echo modify($id, "d"); ?><br>
        <hr>
        <b>Last Updated.</b> <?php echo modify($fetch['contact_update_date'], "d"); ?>
       </span>
      </h5>
      <p class="text-muted m-0 f-s-11"><?php echo status_view(modify($fetch['contact_status'], "d")); ?> | <i
        class="fa fa-user"></i> <?php echo modify($contact_type, "d"); ?> | <i class="fa fa-briefcase"></i>
       <?php echo modify($fetch['contact_title'], "d"); ?></p>
      <hr>
     </div>
    </div>
    <div class="widget-blog-content">
     <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-6">
       <h4 class="font-size-13 m-b-0 m-t-0">Phone Numbers <a href='#edit_phones' data-toggle="modal"
         class="float-right f-s-11 text-info"><i class="fa fa-edit"></i></a>
        <hr class="hr-mr">
       </h4>
       <p><?php whatsapp($fetch['contact_phone']);
                                phone_number($fetch['contact_phone']); ?>
        <?php
                                $id = modify($id, "d");
                                $phone_number = modify("phone_number", "e");
                                $sql = "SELECT * from contact_list_details where contact_id='$id' and detail_title='$phone_number'";
                                $query = mysqli_query($con, $sql);
                                while ($fetch = mysqli_fetch_assoc($query)) {
                                    whatsapp($fetch['detail_value'], 'd');
                                    phone_number($fetch['detail_value'], "d") . "<br>";
                                } ?></p>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-6">
       <h4 class="f-s-13 m-b-0 m-t-0">Email_IDS
        <a href='#edit_user_mails' data-toggle="modal" class="float-right f-s-11 text-info"><i
          class="fa fa-edit"></i></a>
        <hr>
       </h4>
       <p><?php echo mail_id($contact_emailid); ?>
        <?php
                                $email_id = modify("email_id", "e");
                                $sql = "SELECT * from contact_list_details where contact_id='$id' and detail_title='$email_id'";
                                $query = mysqli_query($con, $sql);
                                while ($fetch = mysqli_fetch_assoc($query)) {
                                    mail_id($fetch['detail_value'], "d") . "<br>";
                                } ?></p>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-6">
       <h4 class="font-size-13 m-b-0 m-t-0">Address <a href='#edit_user_address' data-toggle="modal"
         class="float-right f-s-11 text-info"><i class="fa fa-edit"></i></a>
        <hr>
       </h4>
       <p>
        <?php
                                $address = modify("address", "e");
                                $sql = "SELECT * from contact_list_details where contact_id='$id' and detail_title='$address'";
                                $query = mysqli_query($con, $sql);
                                $count = mysqli_num_rows($query);
                                if ($count != true) {
                                    echo "<br><br><br><span class='text-muted'>No data Available</span>";
                                } else {
                                    while ($fetch = mysqli_fetch_assoc($query)) {
                                        address($fetch['detail_value'], "d") . "<br>";
                                    }
                                } ?></p>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-6">
       <h4 class="font-size-13 m-b-0 m-t-0">Websites <a href='#edit_user_websites' data-toggle="modal"
         class="float-right f-s-11 text-info"><i class="fa fa-edit"></i></a>
        <hr>
       </h4>
       <p>
        <?php
                                $website = modify("website", "e");
                                $sql = "SELECT * from contact_list_details where contact_id='$id' and detail_title='$website'";
                                $query = mysqli_query($con, $sql);
                                $count = mysqli_num_rows($query);
                                if ($count != true) {
                                    echo "<br><br><br><span class='text-muted'>No data Available</span>";
                                } else {
                                    while ($fetch = mysqli_fetch_assoc($query)) {

                                        website($fetch['detail_value'], "d") . "<br>";
                                    }
                                } ?></p>
      </div>
     </div>
    </div>
   </div>
   <!-- end widget -->
  </div>
  <div class="col-sm-12 col-md-12 col-lg-12">

  </div>
 </div>


 <!-- content -- >
            <?php require 'footer.php'; ?>
        </div>
        <!-- end #content -->



 </div>
 <!-- end page container -->



 <?php require 'script.php'; ?>
</body>

</html>
<div class="modal fade" id="edit_phones">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
    <h5 class="modal-title">
     <i class="fa fa-user"></i> <?php echo modify($contact_fullname, "d"); ?> <i class="fa fa-angle-right"></i>
     <i class="fa fa-edit"></i> Edit Details <i class="fa fa-angle-right"></i>
     <i class="fa fa-phone"></i> Phone Number
    </h5>
   </div>
   <div class="modal-body">
    <div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12">
      <table class="table-hover table" style="width:100% !important;font-size:13px;">
       <thead>
        <tr>
         <th><i class="fa fa-hashtag"></i></th>
         <th>Action</th>
         <th>Phone Numbers</th>
        </tr>
       </thead>
       <tbody>
        <?php
                                $phone_number = modify("phone_number", "e");
                                $sql = "SELECT * from contact_list_details where contact_id='$id' and detail_title='$phone_number'";
                                $query = mysqli_query($con, $sql);
                                $count_row = mysqli_num_rows($query);
                                $count = 0;
                                while ($fetch = mysqli_fetch_assoc($query)) {
                                    $count++;
                                    $details_value = modify($fetch['detail_value'], "d");
                                    if ($count_row = 0) {
                                        echo "<tr>
                                                                  <td colspan='2'><h2>No Data Available</td>
                                                                </tr>";
                                    } else { ?>
        <tr>
         <td><?php echo $count; ?></td>
         <td>
          <?php
                                                $list_id = modify($fetch['contact_list_details_id'], "e");
                                                $edit = "<a href='#update_phones_" . $list_id . "' data-toggle='modal' class='btn btn-sm btn-link text-success'><i class='fa fa-edit'></i></a>";
                                                $delete = "<a href='#delete_confirm_" . $list_id . "' data-toggle='modal' class='btn btn-sm btn-link text-danger'><i class='fa fa-trash'></i></a>";

                                                echo $edit;
                                                echo $delete;

                                                echo ' <div class="modal fade" id="delete_confirm_' . $list_id . '">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-warning text-danger"></i> Confirm Delete Action</h4>
                </div>
                <div class="modal-body">
                 <p>Are you sure for Delete this? you cannot recover this data if you delete it permanently.<br> Try to Deactive this if you want to hide this temperary.</p><br><br><br><br><br><br>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-md btn-default" data-dismiss="modal">Close</a>
                    <a href="delete.php?delete_contact_details=true&id=' . $list_id . '" class="btn btn-md btn-danger text-white">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="update_phones_' . $list_id . '">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-edit text-info"></i> Update</h4>
                </div>
                <form action="update.php" method="POST">
                <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                   <div class="form-group">
                   <input type="text" name="contact_list_details_id" value="' . $list_id . '" hidden>
                    <input type="text" name="detail_value" class="form-control" value="' . $details_value . '">
                   </div>
                   </div>
                  </div>
                 <br><br>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-md btn-default" data-dismiss="modal">Close</a>
                    <button type="submit" name="update_contact_details" class="btn btn-md btn-success text-white">Update Data</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>';
                                                ?>
         </td>
         <td>
          <?php
                                                whatsapp($fetch['detail_value'], 'd');
                                                phone_number($fetch['detail_value'], "d"); ?>
         </td>
         <?php }
                                } ?>
        </tr>
       </tbody>
      </table>
     </div>
    </div>
   </div>
   <div class="modal-footer">
    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
   </div>
  </div>
 </div>
</div>


<div class="modal fade" id="edit_user_mails">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
    <h5 class="modal-title">
     <i class="fa fa-user"></i> <?php echo modify($contact_fullname, "d"); ?> <i class="fa fa-angle-right"></i>
     <i class="fa fa-edit"></i> Edit Details <i class="fa fa-angle-right"></i>
     <i class="fa fa-envelope"></i> Mail-ids
    </h5>
   </div>
   <div class="modal-body">
    <div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12">
      <table class="table-hover table" style="width:100% !important;font-size:13px;">
       <thead>
        <tr>
         <th><i class="fa fa-hashtag"></i></th>
         <th>Action</th>
         <th>Mail IDs</th>
        </tr>
       </thead>
       <tbody>
        <?php
                                $email_id = modify("email_id", "e");
                                $sql = "SELECT * from contact_list_details where contact_id='$id' and detail_title='$email_id'";
                                $query = mysqli_query($con, $sql);
                                $count_row = mysqli_num_rows($query);
                                $count = 0;
                                while ($fetch = mysqli_fetch_assoc($query)) {
                                    $count++;
                                    $details_value = modify($fetch['detail_value'], "d");
                                    if ($count_row = 0) {
                                        echo "<tr>
                                                                  <td colspan='2'><h2>No Data Available</td>
                                                                </tr>";
                                    } else { ?>
        <tr>
         <td><?php echo $count; ?></td>
         <td>
          <?php
                                                $list_id = modify($fetch['contact_list_details_id'], "e");
                                                $edit = "<a href='#update_phones_" . $list_id . "' data-toggle='modal' class='btn btn-sm btn-link text-success'><i class='fa fa-edit'></i></a>";
                                                $delete = "<a href='#delete_confirm_" . $list_id . "' data-toggle='modal' class='btn btn-sm btn-link text-danger'><i class='fa fa-trash'></i></a>";

                                                echo $edit;
                                                echo $delete;

                                                echo ' <div class="modal fade" id="delete_confirm_' . $list_id . '">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-warning text-danger"></i> Confirm Delete Action</h4>
                </div>
                <div class="modal-body">
                 <p>Are you sure for Delete this? you cannot recover this data if you delete it permanently.<br> Try to Deactive this if you want to hide this temperary.</p><br><br><br><br><br><br>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-md btn-default" data-dismiss="modal">Close</a>
                    <a href="delete.php?delete_contact_details=true&id=' . $list_id . '" class="btn btn-md btn-danger text-white">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="update_phones_' . $list_id . '">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-edit text-info"></i> Update</h4>
                </div>
                <form action="update.php" method="POST">
                <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                   <div class="form-group">
                   <input type="text" name="contact_list_details_id" value="' . $list_id . '" hidden>
                    <input type="text" name="detail_value" class="form-control" value="' . $details_value . '">
                   </div>
                   </div>
                  </div>
                 <br><br>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-md btn-default" data-dismiss="modal">Close</a>
                    <button type="submit" name="update_contact_details" class="btn btn-md btn-success text-white">Update Data</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>';
                                                ?>
         </td>
         <td>
          <?php
                                                mail_id($fetch['detail_value'], "d"); ?>
         </td>
         <?php }
                                } ?>
        </tr>
       </tbody>
      </table>
     </div>
    </div>
   </div>
   <div class="modal-footer">
    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
   </div>
  </div>
 </div>
</div>


<div class="modal fade" id="edit_user_address">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
    <h5 class="modal-title">
     <i class="fa fa-user"></i> <?php echo modify($contact_fullname, "d"); ?> <i class="fa fa-angle-right"></i>
     <i class="fa fa-edit"></i> Edit Details <i class="fa fa-angle-right"></i>
     <i class="fa fa-map-marker"></i> Address
    </h5>
   </div>
   <div class="modal-body">
    <div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12">
      <table class="table-hover table" style="width:100% !important;font-size:13px;">
       <thead>
        <tr>
         <th><i class="fa fa-hashtag"></i></th>
         <th>Action</th>
         <th>Address</th>
        </tr>
       </thead>
       <tbody>
        <?php
                                $address = modify("address", "e");
                                $sql = "SELECT * from contact_list_details where contact_id='$id' and detail_title='$address'";
                                $query = mysqli_query($con, $sql);
                                $count_row = mysqli_num_rows($query);
                                $count = 0;
                                while ($fetch = mysqli_fetch_assoc($query)) {
                                    $count++;
                                    $details_value = modify($fetch['detail_value'], "d");
                                    if ($count_row = 0) {
                                        echo "<tr>
                                                                  <td colspan='2'><h2>No Data Available</td>
                                                                </tr>";
                                    } else { ?>
        <tr>
         <td><?php echo $count; ?></td>
         <td>
          <?php
                                                $list_id = modify($fetch['contact_list_details_id'], "e");
                                                $edit = "<a href='#update_phones_" . $list_id . "' data-toggle='modal' class='btn btn-sm btn-link text-success'><i class='fa fa-edit'></i></a>";
                                                $delete = "<a href='#delete_confirm_" . $list_id . "' data-toggle='modal' class='btn btn-sm btn-link text-danger'><i class='fa fa-trash'></i></a>";

                                                echo $edit;
                                                echo $delete;

                                                echo ' <div class="modal fade" id="delete_confirm_' . $list_id . '">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-warning text-danger"></i> Confirm Delete Action</h4>
                </div>
                <div class="modal-body">
                 <p>Are you sure for Delete this? you cannot recover this data if you delete it permanently.<br> Try to Deactive this if you want to hide this temperary.</p><br><br><br><br><br><br>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-md btn-default" data-dismiss="modal">Close</a>
                    <a href="delete.php?delete_contact_details=true&id=' . $list_id . '" class="btn btn-md btn-danger text-white">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="update_phones_' . $list_id . '">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-edit text-info"></i> Update</h4>
                </div>
                <form action="update.php" method="POST">
                <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                   <div class="form-group">
                   <input type="text" name="contact_list_details_id" value="' . $list_id . '" hidden>
                    <input type="text" name="detail_value" class="form-control" value="' . $details_value . '">
                   </div>
                   </div>
                  </div>
                 <br><br>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-md btn-default" data-dismiss="modal">Close</a>
                    <button type="submit" name="update_contact_details" class="btn btn-md btn-success text-white">Update Data</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>';
                                                ?>
         </td>
         <td>
          <?php
                                                address($fetch['detail_value'], "d"); ?>
         </td>
         <?php }
                                } ?>
        </tr>
       </tbody>
      </table>
     </div>
    </div>
   </div>
   <div class="modal-footer">
    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
   </div>
  </div>
 </div>
</div>



<div class="modal fade" id="edit_user_websites">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
    <h5 class="modal-title">
     <i class="fa fa-user"></i> <?php echo modify($contact_fullname, "d"); ?> <i class="fa fa-angle-right"></i>
     <i class="fa fa-edit"></i> Edit Details <i class="fa fa-angle-right"></i>
     <i class="fa fa-globe"></i> Websites
    </h5>
   </div>
   <div class="modal-body">
    <div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12">
      <table class="table-hover table" style="width:100% !important;font-size:13px;">
       <thead>
        <tr>
         <th><i class="fa fa-hashtag"></i></th>
         <th>Action</th>
         <th>Address</th>
        </tr>
       </thead>
       <tbody>
        <?php
                                $website = modify("website", "e");
                                $sql = "SELECT * from contact_list_details where contact_id='$id' and detail_title='$website'";
                                $query = mysqli_query($con, $sql);
                                $count_row = mysqli_num_rows($query);
                                $count = 0;
                                while ($fetch = mysqli_fetch_assoc($query)) {
                                    $count++;
                                    $details_value = modify($fetch['detail_value'], "d");
                                    if ($count_row = 0) {
                                        echo "<tr>
                                                                  <td colspan='2'><h2>No Data Available</td>
                                                                </tr>";
                                    } else { ?>
        <tr>
         <td><?php echo $count; ?></td>
         <td>
          <?php
                                                $list_id = modify($fetch['contact_list_details_id'], "e");
                                                $edit = "<a href='#update_phones_" . $list_id . "' data-toggle='modal' class='btn btn-sm btn-link text-success'><i class='fa fa-edit'></i></a>";
                                                $delete = "<a href='#delete_confirm_" . $list_id . "' data-toggle='modal' class='btn btn-sm btn-link text-danger'><i class='fa fa-trash'></i></a>";

                                                echo $edit;
                                                echo $delete;

                                                echo ' <div class="modal fade" id="delete_confirm_' . $list_id . '">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-warning text-danger"></i> Confirm Delete Action</h4>
                </div>
                <div class="modal-body">
                 <p>Are you sure for Delete this? you cannot recover this data if you delete it permanently.<br> Try to Deactive this if you want to hide this temperary.</p><br><br><br><br><br><br>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-md btn-default" data-dismiss="modal">Close</a>
                    <a href="delete.php?delete_contact_details=true&id=' . $list_id . '" class="btn btn-md btn-danger text-white">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="update_phones_' . $list_id . '">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-edit text-info"></i> Update</h4>
                </div>
                <form action="update.php" method="POST">
                <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                   <div class="form-group">
                   <input type="text" name="contact_list_details_id" value="' . $list_id . '" hidden>
                    <input type="text" name="detail_value" class="form-control" value="' . $details_value . '">
                   </div>
                   </div>
                  </div>
                 <br><br>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-md btn-default" data-dismiss="modal">Close</a>
                    <button type="submit" name="update_contact_details" class="btn btn-md btn-success text-white">Update Data</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>';
                                                ?>
         </td>
         <td>
          <?php
                                                website($fetch['detail_value'], "d"); ?>
         </td>
         <?php }
                                } ?>
        </tr>
       </tbody>
      </table>
     </div>
    </div>
   </div>
   <div class="modal-footer">
    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
   </div>
  </div>
 </div>
</div>


<div class="modal fade" id="more_info">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
    <h4 class="modal-title">ADD More Details <i class="fa fa-angle-right"></i> <?php user_name(); ?></h4>
   </div>
   <div class="modal-body">
    <form action="insert.php" method="POST">
     <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
     <input type="text" name="contact_id" value="<?php echo $id_d; ?>" hidden="">
     <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
       <div class="form-group">
        <label>Select Information Type</label>
        <select class="form-control" name="detail_title">
         <option value="phone_number"> Phone Number</option>
         <option value="email_id"> Email ID</option>
         <option value="address">Addresses</option>
         <option value="website">Website</option>
        </select>
       </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
       <div class="form-group">
        <label>Information Value <small class="text-muted"> <i class="fa fa-angle-right"></i> like phone, email, address
          (excluding +91 or country code)</small></label>
        <input type="text" class="form-control" name="detail_value" required="">
       </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
       <div class="form-group">
        <label>Information Tag <small class="text-muted"> <i class="fa fa-angle-right"></i> like home, personal,
          professional others</small></label>
        <input type="text" class="form-control" name="details_tag" required="">
       </div>
      </div>

     </div>
   </div>
   <div class="modal-footer">
    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
    <button class="btn btn-md btn-success" type="submit" name="save_contact_details">
     Save Information
    </button>
    </form>
   </div>
  </div>
 </div>
</div>



<div class="modal fade" id="<?php echo $_SESSION['view_id'] . "_update_contact"; ?>">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
    <h4 class="modal-title">Update <i class="fa fa-angle-right"></i>
     <?php echo modify($fetch['contact_fullname'], "d"); ?></h4>
   </div>
   <div class="modal-body">
    <form action="update.php" method="POST">
     <input type="text" name="contact_id" value="<?php echo $_SESSION['view_id']; ?>" hidden="">
     <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
     <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
       <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="contact_fullname" class="form-control"
         value="<?php echo modify($contact_fullname, "d"); ?>">
       </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
       <div class="form-group">
        <label>Phone Number</label>
        <input type="text" name="contact_phone" class="form-control" value="<?php echo modify($contact_phone, "d"); ?>">
       </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
       <div class="form-group">
        <label>Email ID</label>
        <input type="email" name="contact_emailid" value="<?php echo modify($contact_emailid, "d"); ?>"
         class="form-control">
       </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
       <div class="form-group">
        <label>Status</label>
        <select name="contact_status" class="form-control">
         <option value="active">Active</option>
         <option value="inactive">Inactive</option>
        </select>
       </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
       <div class="form-group">
        <label>Contact Title</label>
        <input type="text" name="contact_title" value="<?php echo modify($contact_title, "d"); ?>" class="form-control">
       </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
       <div class="form-group">
        <label>Contact Username</label>
        <input type="text" name="contact_username" value="<?php echo modify($contact_username, "d"); ?>"
         class="form-control">
       </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
       <div class="form-group">
        <label>Contact Password</label>
        <input type="text" name="contact_password" value="<?php echo modify($contact_password, "d"); ?>"
         class="form-control">
       </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
       <div class="form-group">
        <label>Contact Type</label>
        <input type="text" name="contact_type" value="<?php echo modify($contact_type, "d"); ?>" class="form-control">
       </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
       <div class="form-group">
        <label>Change Type</label>
        <select name="contact_type_update" class="form-control">
         <option value="null">Default</option>
         <option value="customer">Customer</option>
         <option value="team">Team</option>
         <option value="provider">Provider</option>
         <option value="super_admin">Super Admin</option>
         <option value="admin">Admin</option>
        </select>
       </div>
      </div>
     </div>
   </div>
   <div class="modal-footer">
    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
    <button class="btn btn-md btn-success" type="submit" name="update_contacts">
     Update Contacts
    </button>
    </form>
   </div>
  </div>
 </div>
</div>