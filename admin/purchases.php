<?php
require 'files.php';
require 'session.php';
$title_name = "ALL Purchases";

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

    <!-- Purchase Block Entry -->
    <!-- Modal -->
    <div class="modal fade text-left" id="ADD_NEW_PURCHASE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
     aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
       <div class="modal-header">
        <h4 class="modal-title font-medium-2" id="myModalLabel1"><i class="fa fa-shopping-cart text-success"></i>
         <?php echo $title_name; ?> <i class="fa fa-angle-right"></i> Add New Purchase </h4>
        <button type="button" class="close font-medium-2" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
       </div>
       <div class="modal-body">
        <form action="pruchases_items.php" method="POST">
         <div class="row">

          <div class="col-md-6 col-sm-6 col-12 col-xs-12 mb-1">
           <fieldset>
            <div class="input-group">
             <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Created By</span>
             </div>
             <input type="text" class="form-control" placeholder="Created By" aria-describedby="basic-addon1"
              name="UserId" value="<?php echo $full_name; ?>" readonly="">
            </div>
           </fieldset>
          </div>

          <div class="col-md-6 col-sm-6 col-12 col-xs-12 mb-1">
           <fieldset>
            <div class="form-group">
             <select class="form-control" placeholder="Select Customer" required="" name="CustomerId">
              <option value="null">Select Customers :---</option>
              <?php
                            $SQL_customers = "SELECT * FROM customers where customer_status='verified'";
                            $QUERY_customers = mysqli_query($con, $SQL_customers);
                            $COUNT_customers = mysqli_num_rows($QUERY_customers);
                            if ($COUNT_customers == NULL) {
                              echo "<option value='null'>Please Create Customer First...</option>";
                            } else {
                              while ($FETCH_customers = mysqli_fetch_assoc($QUERY_customers)) { ?>
              <option value="<?php echo $FETCH_customers['customer_id']; ?>">
               CID_<?php echo $FETCH_customers['customer_id']; ?> : <?php echo $FETCH_customers['customer_name']; ?> :
               <?php echo $FETCH_customers['customer_phone_number']; ?></option>
              <?php }
                            }  ?>
             </select>
            </div>
           </fieldset>
          </div>

          <div class="col-md-6 col-sm-6 col-12 col-xs-12 mb-1">
           <fieldset>
            <div class="input-group">
             <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Purchase Category</span>
             </div>
             <input type="text" class="form-control" placeholder="Enter Category Name" aria-describedby="basic-addon1"
              name="ExpansesCategories" value="" required="">
            </div>
            <span><small>Like Foods, electronics, furniture, clothes, recharges etc...</small></span>
           </fieldset>
          </div>

          <div class="col-md-6 col-sm-6 col-12 col-xs-12 mb-1">
           <fieldset>
            <div class="input-group">
             <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Purchase Date</span>
             </div>
             <input type="date" class="form-control" placeholder="DD/MM/YYYY" aria-describedby="basic-addon1"
              name="ExpansesDate" value="" required="">
            </div>
           </fieldset>
          </div>

          <div class="col-md-6 col-sm-6 col-12 col-xs-12 mb-1">
           <fieldset>
            <div class="input-group">
             <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Due Date</span>
             </div>
             <input type="date" class="form-control" placeholder="DD/MM/YYYY" aria-describedby="basic-addon1"
              name="ExpansesDueDate" value="" required="">
            </div>
           </fieldset>
          </div>

         </div>
       </div>
       <div class="modal-footer">
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="CREATE_NEW_PURCHASE" value="PURCHASE" class="btn btn-primary">Create
         Purchase</button>
        </form>
       </div>
      </div>
     </div>
    </div>
    <!-- end pruchase block -->

    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action"><i class="fa fa-shopping-cart text-primary"></i> <?php echo $title_name; ?> <i
          class="fa fa-angle-right"></i>
         <a href="#" data-toggle='modal' data-target='#ADD_NEW_PURCHASE'><i class="fa fa-plus"></i> New Purchase</a>
        </h4>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table table-striped zero-configuration table-hover" style="font-size: 12px !important;">
           <thead>
            <tr>
             <th style="width: 3% !important;">#</th>
             <th>PurchaseId</th>
             <th>CreatedBy</th>
             <th>CustomerName</th>
             <th>Category</th>
             <th>Amount</th>
             <th>PurchaseDate</th>
             <th>Status</th>
             <th>Action</th>
            </tr>
           </thead>
           <tbody>

            <!-- Modal -->
            <div class="modal fade text-left" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
             aria-hidden="true">
             <div class="modal-dialog" role="document">
              <div class="modal-content">
               <div class="modal-header">
                <h4 class="modal-title font-medium-2" id="myModalLabel1"><i class="fa fa-bell text-success"></i>
                 Notifications <i class="fa fa-angle-right"></i> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
               </div>
               <div class="modal-body">

               </div>
               <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                <a href="cust_details.php?customer_id=" class="btn btn-outline-primary">View Profile</a>
               </div>
              </div>
             </div>
            </div>

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