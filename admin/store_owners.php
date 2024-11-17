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
 <title>STORE Owners : <?php echo $PosName; ?></title>
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
       <h4 class="modal-title" id="myModalLabel17">All OWNERS <i class="fa fa-angle-right"></i> ADD Owner</h4>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
       </button>
      </div>
      <div class="modal-body">
       <form action="insert.php" method="POST">
        <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
        <input type="text" name="user_type" value="STORE_USER" hidden>
        <div class="row">
         <div class="col-md-4">
          <div class="form-group">
           <label>USER TYPE</label>
           <select class="form-control" name="user_role">
            <?php
                        $user_id = $_SESSION['user_id'];
                        $SelectUserTypes = "SELECT * FROM user_types WHERE user_type_title='STORE_USER'";
                        $SelectUserTypesQuery = mysqli_query($con, $SelectUserTypes);
                        while ($SelectUserTypesFetch = mysqli_fetch_assoc($SelectUserTypesQuery)) {
                          $UserTypeid = $SelectUserTypesFetch['user_type_id'];
                          $UserTypeTitle = $SelectUserTypesFetch['user_type_title'];
                          $UserTypeDate = $SelectUserTypesFetch['user_type_date']; ?>
            <option value="<?php echo $UserTypeid; ?>" selected><?php echo $UserTypeTitle; ?></option>
            <?php } ?>
           </select>
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
           <label>Enter Username</label>
           <input type="text" class="form-control" name="username" placeholder="Email Id" required="">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Enter Email-id</label>
           <input type="email" class="form-control" name="email_id" placeholder="Email Id" required="">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Phone Number (without +91)</label>
           <input type="text" class="form-control" name="phone_number" placeholder="+91" required="">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Enter Password</label>
           <input type="password" class="form-control" name="password" placeholder="********" required="">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Enter Confirm Password </label>
           <input type="password" class="form-control" name="password_2" placeholder="********" required="">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Home Address</label>
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
           <label>City</label>
           <input type="text" class="form-control" name="user_city" placeholder="City" required="">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Select State</label>
           <select name="user_state" class="form-control" required="">
            <option value="Andhra Pradesh">Andhra Pradesh</option>
            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
            <option value="Assam">Assam</option>
            <option value="Bihar">Bihar</option>
            <option value="Chandigarh">Chandigarh</option>
            <option value="Chhattisgarh">Chhattisgarh</option>
            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
            <option value="Daman and Diu">Daman and Diu</option>
            <option value="Delhi">Delhi</option>
            <option value="Lakshadweep">Lakshadweep</option>
            <option value="Puducherry">Puducherry</option>
            <option value="Goa">Goa</option>
            <option value="Gujarat">Gujarat</option>
            <option value="Haryana">Haryana</option>
            <option value="Himachal Pradesh">Himachal Pradesh</option>
            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
            <option value="Jharkhand">Jharkhand</option>
            <option value="Karnataka">Karnataka</option>
            <option value="Kerala">Kerala</option>
            <option value="Madhya Pradesh">Madhya Pradesh</option>
            <option value="Maharashtra">Maharashtra</option>
            <option value="Manipur">Manipur</option>
            <option value="Meghalaya">Meghalaya</option>
            <option value="Mizoram">Mizoram</option>
            <option value="Nagaland">Nagaland</option>
            <option value="Odisha">Odisha</option>
            <option value="Punjab">Punjab</option>
            <option value="Rajasthan">Rajasthan</option>
            <option value="Sikkim">Sikkim</option>
            <option value="Tamil Nadu">Tamil Nadu</option>
            <option value="Telangana">Telangana</option>
            <option value="Tripura">Tripura</option>
            <option value="Uttar Pradesh">Uttar Pradesh</option>
            <option value="Uttarakhand">Uttarakhand</option>
            <option value="West Bengal">West Bengal</option>
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
       <button type="Submit" name="REGISTER_NEW_USER" class="btn btn-outline-primary">Save Data</button>
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
        <h5 class="users-action">Store Owners <i class="fa fa-angle-right"></i>
         <a href="" data-toggle="modal" data-target="#add_users"><i class="fa fa-plus"></i> ADD Store Owner</a>
         <a href="team_stores.php"> View Stores</a>
        </h5>
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
          <table id="users-list-datatable" class="table">
           <thead>
            <tr>
             <th style="width: 5%;">ID</th>
             <th style="width: 5%;"><i class="fa fa-gears"></i></th>
             <th style="width: 20%;">FULL_NAME</th>
             <th style="width: 25%;">EMAIL_ID</th>
             <th style="width: 10%;">CONTACT</th>
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
                          $SelectUsers = "SELECT * FROM users, user_types where users.user_role=user_types.user_type_id and user_type_title='STORE_USER' and ref='$user_id' and user_status='$type'";
                        } else {
                          $SelectUsers = "SELECT * FROM users, user_types where users.user_role=user_types.user_type_id and ref='$user_id' and user_type_title='STORE_USER' and ref='$user_id'";
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
              <form action='team_edit.php' method="POST">
               <button type="submit" value="<?php echo $user_id; ?>" name='id'
                class="btn btn-link btn-outline-success btn-sm"><i class="fa fa-edit"></i></button>
              </form>
             </td>
             <td>
              <form action='team_edit.php' method="POST">
               <button type="submit" value="<?php echo $user_id; ?>" name='id'
                class='btn btn-link text-info btn-sm font-small-3'><?php echo $full_name; ?></button>
              </form>
             </td>
             <td><?php echo $email_id; ?></td>
             <td><?php echo $phone_number; ?></td>
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
</body>
<!-- END: Body-->

</html>
</body>
<!-- END: Body-->

</html>