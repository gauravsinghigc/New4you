<?php require 'files.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8" />
 <title>ALL Users | <?php echo $name; ?></title>

 <?php require 'meta.php';
    require 'stylesheet.php'; ?>

</head>

<body>
 <!-- begin #page-loader -->

 <!-- end #page-loader -->



 <!-- begin #page-container -->
 <div id="page-container"
  class="fade page-container page-header-fixed page-sidebar-fixed page-with-two-sidebar page-with-footer">

  <?php require 'header.php';
        require 'sidebar.php'; ?>

  <!-- begin #content -->
  <div id="content" class="content">

   <!-- begin page-header -->
   <h1 class="page-header">ALL Customers
    <small>
     <a href="#add_contacts" data-toggle="modal"><button type="button" class="btn btn-link text-info btn-sm"><i
        class="fa fa-plus text-primary"></i> Contacts</button></a>
    </small>

   </h1>
   <hr class="hr-mr">
   <!-- end page-header -->
   <!-- content -- >
<!-- begin section-container -->

   <div class="section-container">
    <!-- begin panel -->
    <div class="panel pagination-inverse m-b-0 clearfix">
     <div class="row">
      <div class="col-lg-12 col-md-12">
       <table class="table table-hover" id='example'>
        <thead>
         <tr>
          <th style="width: 7%;">UID</th>
          <th style="width: 8%;">ACTION</th>
          <th style="width: 18%;">FULL_NAME</th>
          <th style="width: 12%;">PROFESSION</th>
          <th style="width: 22%;">MAIL_ID</th>
          <th style="width: 15%;">PHONE_NUMBER</th>
          <th style="width: 15%;">REG_DATE</th>
          <th style="width: 6%;">STATUS</th>
         </tr>
        </thead>
        <tbody>
         <?php
                                    $contact_view = modify("customer", "e");
                                    $delete = modify("delete", "e");
                                    $sql = "SELECT * from contacts_list where contact_type='$contact_view' and contact_status!='$delete' ORDER BY contact_id ASC";
                                    $query = mysqli_query($con, $sql);
                                    $count = 0;
                                    while ($fetch = mysqli_fetch_assoc($query)) {
                                        $id = modify($fetch['contact_id'], "e");
                                        $contact_fullname = $fetch['contact_fullname'];
                                        $contact_emailid = $fetch['contact_emailid'];
                                        $contact_phone = $fetch['contact_phone'];
                                        $contact_title = $fetch['contact_title'];
                                        $contact_type = $fetch['contact_type'];
                                        $contact_entry_date = $fetch['contact_entry_date'];
                                        $type = modify($contact_type, "d");
                                        $contact_username = $fetch['contact_username'];
                                        $contact_password = $fetch['contact_password'];
                                        $count++;
                                        $edit = "<a href='#$id" . "_update_contact' data-toggle='modal' class='btn btn-sm btn-link text-success float-right'><i class='fa fa-edit'></i></a>";
                                        $delete = "<a href='#delete_confirm_" . $id . "' data-toggle='modal' class='btn btn-sm btn-link text-danger float-right'><i class='fa fa-trash'></i></a>"; ?>

         <?php
                                        $view = "<form action='contacts_list_view.php' method='POST' class='margin-bottom-0 float-right'>
            <input type='text' name='id' value='$id' hidden=''>
            <button type='submit' name='view' value='contacts_list' class='btn btn-sm btn-link text-primary'>
            <i class='fa fa-info-circle'></i>
            </button>
            </form>"; ?>
         <tr>
          <td>UID<?php echo modify($id, "d"); ?></td>
          <td class="text-center">
           <center><?php if ($type == "super_admin") {
                                                            echo "";
                                                        } else {
                                                            echo $delete;
                                                        }
                                                        echo $edit;
                                                        echo $view; ?><a href='' class="float-right">
             <i class="fa fa-refresh"></i></a></center>
          </td>
          <td>
           <form action='contacts_list_view.php' method='POST' class="margin-bottom-0">
            <input type='text' name='id' value='<?php echo $id; ?>' hidden=''>
            <button type='submit' name='view' value='contacts_list'
             class='btn btn-sm btn-link text-primary font-size-13'>
             <i class="fa fa-user"></i> <?php echo modify($fetch['contact_fullname'], "d"); ?>
            </button>
           </form>
          </td>
          <td><i class="fa fa-briefcase"></i> <?php echo modify($fetch['contact_title'], "d"); ?> </td>
          <td><?php mail_id($fetch['contact_emailid']); ?></td>
          <td><?php whatsapp($fetch['contact_phone']);
                                                phone_number($fetch['contact_phone']); ?></td>
          <td><?php echo modify($contact_entry_date, "d"); ?></td>
          <td><?php status_view(modify($fetch['contact_status'], "d")); ?></td>
         </tr>

         <div class="modal fade" id="<?php echo $id . "_update_contact"; ?>">
          <div class="modal-dialog">
           <div class="modal-content">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
               class="fa fa-times"></i></button>
             <h4 class="modal-title">Update <i class="fa fa-angle-right"></i>
              <?php echo modify($fetch['contact_fullname'], "d"); ?></h4>
            </div>
            <div class="modal-body">
             <form action="update.php" method="POST">
              <input type="text" name="contact_id" value="<?php echo $id; ?>" hidden>
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
                 <input type="text" name="contact_phone" class="form-control"
                  value="<?php echo modify($contact_phone, "d"); ?>">
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
                 <input type="text" name="contact_title" value="<?php echo modify($contact_title, "d"); ?>"
                  class="form-control">
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
                 <input type="text" name="contact_type" value="<?php echo modify($contact_type, "d"); ?>"
                  class="form-control">
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
         <?php
                                        echo '
    <div class="modal fade" id="delete_confirm_' . $id . '">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-warning text-danger"></i> Confirm Delete Action</h4>
                </div>
                <div class="modal-body">
                 <p>Are you sure for Delete this? you cannot recover this data if you delete it permanently.<br> Try to Deactive this if you want to hide this temperary.</p>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-md btn-default" data-dismiss="modal">Close</a>
                    <a href="delete.php?delete_contacts_list=true&id=' . $id . '" class="btn btn-md btn-danger text-white">Delete</a>
                </div>
            </div>
        </div>
    </div>';
                                        ?>


      </div>

      <?php } ?>
      </tbody>
      </table>
     </div>
    </div>
    <!-- end panel -->
   </div>
   <!-- end section-container -->


   <!-- content -- >
            <?php require 'footer.php'; ?>
        </div>
        <!-- end #content -->
   <?php require 'sidebar-right.php'; ?>

  </div>
  <div class="sidebar-bg sidebar-right"></div>
  <!-- end #sidebar-right -->
 </div>
 <!-- end page container -->


 </div>
 <!-- end page container -->



 <?php require 'script.php'; ?>
</body>

</html>
<div class="modal fade" id="add_contacts">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
    <h4 class="modal-title">ADD Customers</h4>
   </div>
   <div class="modal-body">
    <form action="insert.php" method="POST">
     <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
     <input type="text" name="contact_type" value="<?php echo $contact_view; ?>" hidden>
     <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
       <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="contact_fullname" class="form-control" required="">
       </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
       <div class="form-group">
        <label>Phone Number</label>
        <input type="text" name="contact_phone" class="form-control" required="">
       </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
       <div class="form-group">
        <label>Email ID</label>
        <input type="email" name="contact_emailid" class="form-control" required="">
       </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
       <div class="form-group">
        <label>Contact Title</label>
        <input type="text" name="contact_title" value="" class="form-control" required="">
       </div>
      </div>
     </div>
   </div>
   <div class="modal-footer">
    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
    <button class="btn btn-md btn-success" type="submit" name="save_contacts">
     Save Contacts
    </button>
    </form>
   </div>
  </div>
 </div>
</div>