<?php
require 'files.php';
require 'session.php';
$title_name = "Customers List";
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
        <h4 class="users-action"><i class="fa fa-users text-info"></i> All <?php echo $title_name; ?> <i
          class="fa fa-angle-right"></i>
         <?php
                  if (isset($_GET['type'])) {
                    echo $_GET['type'] . " Customers";
                  } else {
                    echo "All Customers";
                  } ?>
        </h4>
        <form action="export_customer_list.php" method="GET" target="blank">
         <div class="row">

          <div class="col-12 col-sm-2 col-md-2 col-lg-2 col-xs-2">
           <div class="form-group">
            <label>Customer Type</label>
            <select class="form-control" name="CUSTOMER_TYPE">
             <option value="ALL_TYPES">All Types</option>
             <option value="verified">Verified</option>
             <option value="unverified">Unverified</option>
            </select>
           </div>
          </div>

          <div class="col-12 col-sm-2 col-md-2 col-lg-2 col-xs-2">
           <div class="form-group">
            <label>Customer Areas</label>
            <select name="CUSTOMER_AREA" class="form-control">
             <option value="ALL_AREAS">ALL Areas</option>
             <?php
                          $sql = "SELECT * FROM services_area where area_status='active'";
                          $query = mysqli_query($con, $sql);
                          while ($fetch = mysqli_fetch_assoc($query)) {
                            $area_localityn = $fetch['area_locality'];
                            echo "<option value='$area_localityn'>$area_localityn</option>";
                          } ?>
            </select>
           </div>
          </div>

          <div class="col-12 col-sm-2 col-md-2 col-lg-2 col-xs-2">
           <div class="form-group">
            <label>Customer Cities</label>
            <select name="CUSTOMER_CITIES" class="form-control">
             <option value="ALL_CITIES">ALL CITIES</option>
             <?php
                          $sql = "SELECT * FROM city where city_status='active' and city_name!='$custcity'";
                          $query = mysqli_query($con, $sql);
                          while ($fetch = mysqli_fetch_assoc($query)) {
                            $city_name = $fetch['city_name'];
                            echo "<option value='$city_name'>$city_name</option>";
                          } ?>
            </select>
           </div>
          </div>

          <div class="col-12 col-sm-2 col-md-2 col-lg-2 col-xs-2">
           <div class="form-group">
            <label>Customer States</label>
            <select name="CUSTOMER_STATE" class="form-control">
             <option value="ALL_STATE">ALL STATES</option>
             <?php
                          $sql = "SELECT * FROM state where state_status='active'";
                          $query = mysqli_query($con, $sql);
                          while ($fetch = mysqli_fetch_assoc($query)) {
                            $state_name = $fetch['state_name'];
                            echo "<option value='$state_name'>$state_name</option>";
                          } ?>
            </select>
           </div>
          </div>

          <div class="col-12 col-sm-2 col-md-2 col-lg-2 col-xs-2">
           <div class="form-group">
            <label>Registration Date</label>
            <input class="form-control" name="REG_DATE" value="" type="date">
           </div>
          </div>

          <div class="col-12 col-sm-2 col-md-2 col-lg-2 col-xs-2">
           <div class="form-group">
            <label>&nbsp;</label>
            <button class="btn btn-success btn-md form-control text-white" name="EXPORT_CUSTOMERS" value="true"
             type="SUBMIT"><i class="fa fa-file-pdf-o"></i> Export Customers</button>
           </div>
          </div>

         </div>
        </form>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table table-striped dom-jQuery-events" style="text-align: left !important;font-size: 13px;">
           <thead>
            <tr align="left;">
             <th>#ID</th>
             <th>Full Name</th>
             <th>Email_id</th>
             <th>Phone_Number</th>
             <th>Area Locality</th>
            </tr>
           </thead>
           <tbody>
            <?php

                        if (isset($_GET['type'])) {
                          $CStatus = $_GET['type'];
                          $SelectUsers = "SELECT * FROM customers where store_id='$store_id' and customer_status='$CStatus'";
                        } else {
                          $SelectUsers = "SELECT * FROM customers where store_id='$store_id'";
                        }
                        $SelectUsersQuery = mysqli_query($con, $SelectUsers);
                        while ($SelectUsersFetch =  mysqli_fetch_assoc($SelectUsersQuery)) {
                          $customer_id = $SelectUsersFetch['customer_id'];
                          $customer_name = $SelectUsersFetch['customer_name'];
                          $customer_mail_id = $SelectUsersFetch['customer_mail_id'];
                          $arealocality = $SelectUsersFetch['arealocality'];
                          if ($customer_mail_id == null) {
                            $customer_mail_id = "Not Available";
                          } else {
                            $customer_mail_id = "<a href='mailto:$customer_mail_id'><i class='fa fa-envelope'></i> $customer_mail_id</a>";
                          }
                          $customer_phone_number = $SelectUsersFetch['customer_phone_number'];
                          $CustomerStatus = $SelectUsersFetch['customer_status'];
                          if ($CustomerStatus == "verified") {
                            $CustomerStatus = "<i class='fa fa-check-circle text-success'></i> Verified";
                            $custview = "<i class='fa fa-check-circle text-success'></i>";
                          } else {
                            $CustomerStatus = "<i class='fa fa-warning text-danger'></i> Unverified";
                            $custview = "<i class='fa fa-warning text-danger'></i>";
                          } ?>
            <tr>
             <td><i class="fa fa-user"></i> <?php echo $customer_id; ?></td>
             <td><a href='cust_details.php?customer_id=<?php echo $customer_id; ?>'><?php echo $custview; ?>
               <?php echo $customer_name; ?></a></td>
             <td><?php echo $customer_mail_id; ?></td>
             <td><a href="tel:<?php echo $customer_phone_number; ?>"><i class="fa fa-phone"></i>
               <?php echo $customer_phone_number; ?></a></td>
             <td><?php echo $arealocality; ?></td>
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