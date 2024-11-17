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
 <title>Delivery Staff : <?php echo $PosName; ?></title>
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

   <div class="modal fade text-left" id="add_users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
     <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title" id="myModalLabel17">All DELIVERY STAFF <i class="fa fa-angle-right"></i> ADD DELIVERY
        STAFF</h4>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
       </button>
      </div>
      <div class="modal-body">
       <form action="insert.php" method="POST">
        <input type='text' name='user_type' value='ON_ROLE' hidden=''>
        <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
        <div class="row">
         <div class="col-md-4">
          <div class="form-group">
           <label>USER TYPE</label>
           <input type='text' name='user_role' value='8' hidden=''>
           <input type='text' value='DELIVERY_BOY' Placeholder='DELIVERY_BOY' class='form-control' readonly=''>
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Username</label>
           <input type="text" class="form-control" name="username" value='<?php
                                                                                                            $sql = "SELECT * FROM users where user_role='8'";
                                                                                                            $query = mysqli_query($con, $sql);
                                                                                                            $count = mysqli_num_rows($query);
                                                                                                            $count_boys = $count;
                                                                                                            $new_boy = $count_boys + 1;
                                                                                                            echo "DEL$new_boy";
                                                                                                            ?>'
            readonly=''>
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Password</label>
           <input type="text" class="form-control" name="password" value='12345' placeholder="********" readonly=''>
           <input type="password" class="form-control" name="password_2" value='12345' placeholder="********" hidden=''>
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Full name</label>
           <input type="text" class="form-control" name="full_name" placeholder="Full Name" required="">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Enter Email-id (Optional)</label>
           <input type="email" class="form-control" name="email_id" placeholder="Email Id">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Phone Number (excluding +91)</label>
           <input type="text" class="form-control" name="phone_number" placeholder="+91" required="">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Street Address</label>
           <input type="text" class="form-control" name="user_address" placeholder="H no/Flat no/Street Address"
            required="">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Area Locality</label>
           <input type="text" class="form-control" name="user_arealocality" placeholder="Area/ Sector/ Locality/"
            required="">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>SELECT State</label>
           <input type="hidden" name="country" id="countryId" value="IN" />
           <select name="user_state" class="states order-alpha form-control" id="stateId">
            <option value="">Select State</option>
           </select>
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Select City</label>
           <select name="user_city" class="cities order-alpha form-control" id="cityId">
            <option value="" style='text-transform:uppercase;'>Select City
            </option>
           </select>
          </div>
         </div>



         <div class="col-md-4">
          <div class="form-group">
           <label>Area Pincode</label>
           <input type="text" class="form-control" name="user_pincode" placeholder="Pincode" required="">
           <a href='https://www.indiapost.gov.in/VAS/Pages/findpincode.aspx' target="blank">Don't Know Pincode</a>
          </div>
         </div>

        </div>
      </div>
      <div class="modal-footer">
       <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
       <button type="Submit" name="REGISTER_NEW_USER" class="btn btn-outline-primary">Save
        Data</button>
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
        <h4 class="users-action">All DELIVERY STAFF <i class="fa fa-angle-right"></i>
         <a href="" data-toggle="modal" data-target="#add_users"><i class="fa fa-plus"></i> ADD DELIVERY PERSON</a>
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
          <table id="users-list-datatable" class="table" style='font-size:12px; padding:1%;'>
           <thead>
            <tr>
             <th style="width: 5%;">ID</th>
             <th style="width: 5%;"><i class="fa fa-gears"></i></th>
             <th style="width: 40%;">FULL_NAME</th>
             <th style="width: 15%;">PHONE</th>
             <th style="width: 10%;">USER_ROLE</th>
             <th style="widows: 7%">TYPE</th>
             <th style="width: 10%;">STATUS</th>
             <th style="width: 10%;">REG_DATETIME</th>
            </tr>
           </thead>
           <tbody>
            <?php
                                                if (isset($_GET['type'])) {
                                                    $type = $_GET['type'];
                                                    $SelectUsers = "SELECT * FROM users, user_types where users.user_role=user_types.user_type_id and user_type_title!='SUPER_ADMIN' AND user_type_title!='TEAM_LEADER' AND user_type_title!='EMPLOYEE' AND user_type_title!='VENDORS' and user_type_title!='STORE_USER' and ref='$user_id' and user_type='$type'";
                                                } else {
                                                    $SelectUsers = "SELECT * FROM users, user_types where users.user_role=user_types.user_type_id and user_type_title!='SUPER_ADMIN' AND user_type_title!='TEAM_LEADER' AND user_type_title!='EMPLOYEE' AND user_type_title!='VENDORS' and ref='$user_id' and user_type_title!='STORE_USER'";
                                                }

                                                $SelectUsersQuery = mysqli_query($con, $SelectUsers);
                                                while ($SelectUsersFetch =  mysqli_fetch_assoc($SelectUsersQuery)) {
                                                    $user_id = $SelectUsersFetch['user_id'];
                                                    $full_name = $SelectUsersFetch['full_name'];
                                                    $email_id = $SelectUsersFetch['email_id'];
                                                    $phone_number = $SelectUsersFetch['phone_number'];
                                                    $user_role = $SelectUsersFetch['user_type_title'];
                                                    $user_status = $SelectUsersFetch['user_status'];
                                                    $user_action = $SelectUsersFetch['user_action'];
                                                    $date_time = $SelectUsersFetch['date_time'];
                                                    $user_type = $SelectUsersFetch['user_type']; ?>
            <tr>
             <td><?php echo $user_id; ?></td>
             <td>
              <form action='person_edit.php' method="POST">
               <button type="submit" value="<?php echo $user_id; ?>" name='view_person_id'
                class="btn btn-link btn-outline-success btn-sm"><i class="fa fa-edit"></i></button>
              </form>
             </td>
             <td><?php echo $full_name; ?></td>
             <td><a href='tel:<?php echo $phone_number; ?>'><?php echo $phone_number; ?></a>
             </td>
             <td><?php echo $user_role; ?></td>
             <td><?php echo $user_type; ?></td>
             <td><?php echo $user_status; ?></td>
             <td><?php echo $date_time; ?></td>
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


 <!-- BEGIN: Vendor JS-->
 <script src="app-assets/vendors/js/vendors.min.js"></script>
 <!-- BEGIN Vendor JS-->

 <!-- BEGIN: Page Vendor JS-->
 <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
 <!-- END: Page Vendor JS-->

 <!-- BEGIN: Theme JS-->
 <script src="app-assets/js/core/app-menu.min.js"></script>
 <script src="app-assets/js/core/app.min.js"></script>
 <script src="app-assets/js/scripts/customizer.min.js"></script>
 <!-- END: Theme JS-->

 <!-- BEGIN: Page JS-->
 <script src="app-assets/js/scripts/pages/page-users.min.js"></script>

</body>
<!-- END: Body-->

</html>