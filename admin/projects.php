<?php require 'files.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8" />
 <title>ALL Projects | <?php echo $name; ?></title>

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
   <h1 class="page-header">ALL Projects
    <small>
     <a href="#add_projects" data-toggle="modal"><button type="button" class="btn btn-link text-info btn-sm"><i
        class="fa fa-plus text-primary"></i> Projects</button></a>
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
       <table class="table table-hover responsive" id="example">
        <thead>
         <tr>
          <th>PROJECT ID</th>
          <th>ACTION</th>
          <th>PROJECT NAME</th>
          <th>DOMAIN</th>
          <th>PROJECT TYPE</th>
          <th>CATEGORY</th>
          <th>ASSIGN DATE</th>
          <th>LAST DATE</th>
          <th>STATUS</th>
         </tr>
        </thead>
        <tbody>
         <?php
                                    $sql = "SELECT * FROM projects, contacts_list where projects.contact_id=contacts_list.contact_id ORDER BY projects_id";
                                    $query = mysqli_query($con, $sql);
                                    $count = mysqli_num_rows($query);
                                    $count = 0;
                                    while ($fetch = mysqli_fetch_assoc($query)) {
                                        $count++;
                                    ?>
         <tr>
          <td>PRJID<?php echo $fetch['projects_id']; ?></td>
          <td>
           <form action='project_view.php' method='POST' class="margin-bottom-0 float-left">
            <input type='text' name='projects_id' value='<?php echo $fetch['projects_id']; ?>' hidden=''>
            <button type='submit' name='view_project' value='view_project'
             class='btn btn-sm btn-link text-primary font-size-13'>
             <i class="fa fa-eye"></i>
            </button>
           </form>
           <a href='#update_project_<?php echo $fetch['projects_id']; ?>' data-toggle='modal'
            class='btn btn-sm btn-link text-success float-left'><i class='fa fa-edit'></i></a>
           <div class="modal fade" id="update_project_<?php echo $fetch['projects_id']; ?>">
            <div class="modal-dialog modal-lg">
             <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                 class="fa fa-times"></i></button>
               <h5 class="modal-title">Update Project
                <i class="fa fa-angle-right"></i> <?php echo modify($fetch['contact_fullname'], "d"); ?> <i
                 class="fa fa-angle-right"></i> <?php echo modify($fetch['project_title'], 'd'); ?>
               </h5>
              </div>
              <div class="modal-body">
               <form action="update.php" method="POST">
                <input type="text" name="projects_id" value="<?php echo $fetch['projects_id']; ?>" hidden="">
                <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
                <div class="row">
                 <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="form-group">
                   <label>Project Title</label>
                   <input type="text" name="project_title" class="form-control"
                    value="<?php echo modify($fetch['project_title'], 'd'); ?>">
                  </div>
                 </div>
                 <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="form-group">
                   <label>Domain Name <small class="text-muted"><i class="fa fa-angle-right"></i> Like example.com (not
                     https://or http://)</small></label>
                   <input type="text" name="domain_name" class="form-control"
                    value="<?php echo modify($fetch['domain_name'], 'd'); ?>" placeholder="example.com">
                  </div>
                 </div>
                 <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="form-group">
                   <label>Project Type</label>
                   <input type="text" name="project_type" class="form-control"
                    value="<?php echo modify($fetch['project_type'], 'd'); ?>" placeholder="project type" readonly>
                  </div>
                 </div>
                 <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="form-group">
                   <label>Project Category</label>
                   <input type="text" name="project_category" class="form-control"
                    value="<?php echo modify($fetch['project_category'], 'd'); ?>" placeholder="project Category"
                    readonly>
                  </div>
                 </div>
                 <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="form-group">
                   <label>Project Priority</label>
                   <input type="text" name="project_priority" class="form-control"
                    value="<?php echo modify($fetch['project_priority'], 'd'); ?>" placeholder="project Priority"
                    readonly>
                  </div>
                 </div>
                 <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="form-group">
                   <label>Delivery Date</label>
                   <input type="text" name="project_delivery_date"
                    value="<?php echo modify($fetch['project_delivery_date'], 'd'); ?>" placeholder="DD MM YEAR"
                    class="form-control" required="">
                  </div>
                 </div>
                 <div class="col-lg-12 col-md-12 col-sm-6">
                  <div class="form-group">
                   <label>Project Tags <small class="text-muted"><i class="fa fa-angle-right"></i> like dynamic site,
                     blue and black theme color, fixed header and much more...</small></label>
                   <input type="text" name="projects_tags" value="<?php echo modify($fetch['projects_tags'], 'd'); ?>"
                    placeholder="" class="form-control" required="">
                  </div>
                 </div>
                 <div class="col-lg-12 col-md-12 col-sm-6">
                  <div class="form-group">
                   <label>Project Description</label>
                   <textarea class="textarea form-control" name="project_desc" placeholder="Enter text ..." rows="15"
                    data-height='200'><?php echo modify($fetch['project_desc'], 'd'); ?></textarea>
                  </div>
                 </div>
                </div>
              </div>
              <div class="modal-footer">
               <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
               <button class="btn btn-md btn-success" type="submit" name="update_projects">
                Update Project
               </button>
               </form>
              </div>
             </div>
            </div>
           </div>
           <a href="#delete_projects_<?php echo modify($fetch['projects_id'], 'e'); ?>" data-toggle='modal'
            class='btn btn-sm btn-link text-danger float-left'><i class='fa fa-trash'></i></a>
           <div class="modal fade" id="delete_projects_<?php echo modify($fetch['projects_id'], 'e'); ?>">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h4 class="modal-title"><i class="fa fa-warning text-danger"></i> Confirm Delete Action</h4>
              </div>
              <div class="modal-body">
               <p>Are you sure for Delete this? you cannot recover this data if you delete it permanently.<br> Try to
                Deactive this if you want to hide this temperary.</p><br><br><br><br><br><br>
               <div class="modal-footer">
                <a href="javascript:;" class="btn btn-md btn-default" data-dismiss="modal">Close</a>
                <a
                 href="delete.php?delete_projects=<?php echo modify($fetch['projects_id'], 'e'); ?>&cr_url=<?php echo get_url(); ?>"
                 class="btn btn-md btn-danger text-white">Delete</a>
               </div>
              </div>
             </div>
            </div>
           </div>
           <a href="#update_projects_status_<?php echo $fetch['projects_id']; ?>" data-toggle='modal'
            class='btn btn-sm btn-link text-info float-left'><i class='fa fa-pencil'></i></a>
           <div class="modal fade" id="update_projects_status_<?php echo $fetch['projects_id']; ?>">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                 class="fa fa-times"></i></button>
               <h5 class="modal-title">Update Project
                <i class="fa fa-angle-right"></i> <?php echo modify($fetch['contact_fullname'], "d"); ?> <i
                 class="fa fa-angle-right"></i> <?php echo modify($fetch['project_title'], 'd'); ?>
               </h5>
              </div>
              <div class="modal-body">
               <form action="update.php" method="POST">
                <input type="text" name="projects_id" value="<?php echo $fetch['projects_id']; ?>" hidden="">
                <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
                <div class="row">
                 <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="form-group">
                   <label>Project Status</label>
                   <select name="project_status" class="form-control" required="">
                    <option value="New">New</option>
                    <option value="Running">Running</option>
                    <option value="Pause">Pause</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Cancelled">Cancelled</option>
                   </select>
                  </div>
                 </div>
                </div>
              </div>
              <div class="modal-footer">
               <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
               <button class="btn btn-md btn-success" type="submit" name="update_projects_status">
                Update Status
               </button>
               </form>
              </div>
             </div>
            </div>
           </div>
          </td>
          <td>
           <form action='project_view.php' method='POST' class="margin-bottom-0">
            <input type='text' name='projects_id' value='<?php echo $fetch['projects_id']; ?>' hidden=''>
            <button type='submit' name='view_project' value='view_project'
             class='btn btn-sm btn-link text-primary font-size-13'>
             <i class="fa fa-tasks"></i> <?php echo modify($fetch['project_title'], "d"); ?>
            </button>
           </form>
          </td>
          <TD><?php echo website($fetch['domain_name']); ?></TD>
          <td><?php echo modify($fetch['project_type'], "d"); ?></td>
          <td><?php echo modify($fetch['project_category'], "d"); ?></td>
          <td><?php echo modify($fetch['project_entry_date'], "d"); ?></td>
          <td><?php echo modify($fetch['project_delivery_date'], "d"); ?></td>
          <td><?php echo modify($fetch['project_status'], "d"); ?></td>
         </tr>



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
<div class="modal fade" id="add_projects">

 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
    <h4 class="modal-title">ADD Projects </h4>
   </div>
   <div class="modal-body">
    <form action="insert.php" method="POST">
     <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
     <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
       <div class="form-group">
        <label>SELECT CUSTOMER</label>
        <select name="contact_id" class="form-control" required="">
         <?php
                                    $active = modify("active", "e");
                                    $sql = "SELECT * FROM contacts_list where contact_status='$active' ORDER BY contact_id ASC";
                                    $query = mysqli_query($con, $sql);
                                    $count = mysqli_num_rows($query);
                                    while ($fetch = mysqli_fetch_assoc($query)) {
                                        $contact_id = $fetch['contact_id'];
                                        $contact_fullname_option = modify($fetch['contact_fullname'], 'd');
                                        $contact_emailid_option = modify($fetch['contact_emailid'], 'd');
                                        $contact_phone_option = modify($fetch['contact_phone'], 'd');
                                        if ($count == 0) {
                                            echo "<option value='null'>No Customer Available, Please Add Some Contact Data</option>";
                                        } else {
                                            echo "<option value='$contact_id'>UID$contact_id > $contact_fullname_option > $contact_emailid_option > +91$contact_phone_option </option>";
                                        }
                                    } ?>
        </select>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6">
       <div class="form-group">
        <label>Project Title</label>
        <input type="text" name="project_title" class="form-control" value="">
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6">
       <div class="form-group">
        <label>Domain Name <small class="text-muted"><i class="fa fa-angle-right"></i> Like example.com (not https://or
          http://)</small></label>
        <input type="text" name="domain_name" class="form-control" value="" placeholder="example.com">
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6">
       <div class="form-group">
        <label>Project Type</label>
        <select name="project_type" class="form-control" required="">
         <option value="STATIC_SITE">Static/Informative Website</option>
         <option value="DYNAMIC_SITE">Dynamic/CSM Based</option>
         <option value="SEMI_DYNAMIC">Semi-Dynamic/Without CMS</option>
         <option value="E_COMMERCE_STORE">E-Commerce/Online Store</option>
         <option value="CRM_CMS">CRM/CMS Web Apps</option>
         <option value="PG">Payment Gateway Integration</option>
         <option value="EMAIL_SETUP">GSuite/Email Config/Webmail Setup</option>
         <option value="UPDATE">Maintanance/Update/Content</option>
         <option value="ADDON_SERVICES">Widgets Addon/Form Set/Addon Services</option>
         <option value="SEARCH_ENGINE_OPTIMISATION">Search Engine Optimisation</option>
         <option value="SOCIAL_MEDIA_OPTIMISATION">Social Media Optimisation/Account SetUp</option>
        </select>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6">
       <div class="form-group">
        <label>Project Category</label>
        <select name="project_category" class="form-control" required="">
         <option value="WEB_DEVELOPMENT">Web Development</option>
         <option value="E_COMMERCE_DEVELOPMENT">E-Commerce Development</option>
         <option value="CMS_DEVELOPMENT">CMS Development</option>
         <option value="PG_SETUP">Payment Gateway Integration</option>
         <option value="DOMAIN_SERVICES">Domain Hosting Services</option>
         <option value="SEO_SMO_DM">SEO/SMO/Digital Marketing</option>
        </select>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6">
       <div class="form-group">
        <label>Project Priority</label>
        <select name="project_priority" class="form-control" required="">
         <option value="LOW">Low</option>
         <option value="NORMAL">Normal</option>
         <option value="HIGH">High</option>
         <option value="URGENT">Urgent</option>
        </select>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6">
       <div class="form-group">
        <label>Delivery Date</label>
        <input type="text" name="project_delivery_date" value="" placeholder="DD MM YEAR" class="form-control"
         required="">
       </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-6">
       <div class="form-group">
        <label>Project Tags <small class="text-muted"><i class="fa fa-angle-right"></i> like dynamic site, blue and
          black theme color, fixed header and much more...</small></label>
        <input type="text" name="projects_tags" value="" placeholder="" class="form-control" required="">
       </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-6">
       <div class="form-group">
        <label>Project Description</label>
        <textarea class="textarea form-control" name="project_desc" id="summernote" placeholder="Enter text ..."
         rows="15" data-height='200'></textarea>
       </div>
      </div>
     </div>
   </div>
   <div class="modal-footer">
    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
    <button class="btn btn-md btn-success" type="submit" name="save_projects">
     Save Project
    </button>
    </form>
   </div>
  </div>
 </div>
</div>
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