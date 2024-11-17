<?php
require 'files.php';
require 'session.php';
$title_name = "ADD City";
$store_user_id = $_SESSION['user_id'];
$select_store = "SELECT * FROM stores where user_id='$store_user_id'";
$store_query = mysqli_query($con, $select_store);
$fetch_store = mysqli_fetch_assoc($store_query);
$store_id = $fetch_store['store_id'];

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
        <h4 class="users-action"><?php echo $title_name; ?> <i class="fa fa-angle-right"></i>
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
         <form action="insert.php" method="POST" enctype="multipart/form-data">
          <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
          <input type="text" name="store_id" value="<?php echo $store_id; ?>" hidden="">
          <div class="panel-body">
           <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <label>Select State</label>
              <input type="hidden" name="country" id="countryId" value="IN" />
              <select name="state_name" class="states order-alpha form-control" id="stateId">
               <option value="">Select State</option>
              </select>
             </div>
            </div>

            <div class="col-md-6">
             <div class="form-group">
              <label>Select City</label>
              <select name="city_name" class="cities order-alpha form-control" id="cityId">
               <option value="" style='text-transform:uppercase;'>Select City</option>
              </select>
             </div>
            </div>
           </div>
          </div>

          <div class="panel-footer text-right">
           <a href="cities.php" class="btn btn-default">Back to Cities</a>
           <button class="btn btn-success" type="submit" name="create_store_city">Create City</button>
          </div>
         </form>
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