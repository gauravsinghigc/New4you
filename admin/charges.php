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
 <meta charset="utf-8">
 <title>Edit Product : <?php echo $PosName; ?></title>
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
        <h4 class="users-action"><b>Store Charges</b> <i class="fa fa-angle-right"></i>
        </h4>
        <p><small><code>Note </code>All units and values are in Rs.</small></p>
       </div>
       <div class="card-content">
        <div class="card-body">
         <form action="update.php" method="POST" enctype="multipart/form-data">
          <div class="panel-body">
           <?php
											$SelectCharges = "SELECT * FROM delivery_charges";
											$ChargesQuery = mysqli_query($con, $SelectCharges);
											$fetchCharges = mysqli_fetch_assoc($ChargesQuery);
											$delivery_charge_id = $fetchCharges['delivery_charge_id'];
											$delivery_charge = $fetchCharges['delivery_charge'];
											$est_delivery_amount = $fetchCharges['est_delivery_amount'];
											$concharge = $fetchCharges['concharge'];
											?>
           <input type="text" name="delivery_charge_id" value="<?php echo $delivery_charge_id; ?>" hidden="">
           <div class="row">
            <div class="col-sm-12">
             <div class="form-group">
              <label class="control-label">Delivery Charges below Min Order Amount</label>
              <input type="text" name="delivery_charge" value='<?php echo $delivery_charge; ?>' class="form-control"
               required="">
             </div>
            </div>
            <div class="col-sm-12">
             <div class="form-group">
              <label class="control-label">Minimum Order Amount</label>
              <input type="text" name="est_delivery_amount" value='<?php echo $est_delivery_amount; ?>'
               class="form-control" required="">
             </div>
            </div>
            <div class="col-sm-12">
             <div class="form-group">
              <label class="control-label">Convenience Charges</label>
              <input type="text" name="concharge" value='<?php echo $concharge; ?>' class="form-control" required=""
               placeholder="example:0, 5, 10, 15, 20">
             </div>
            </div>
           </div>

           <div class="panel-footer text-right">
            <button class="btn btn-success" type="submit" name="update_charges">Update Charges</button>
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