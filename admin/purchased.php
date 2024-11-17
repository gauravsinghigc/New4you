<?php
require 'files.php';
require 'session.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM stores where user_id='$user_id'";
$query =  mysqli_query($con, $sql);
$fetchstore = mysqli_fetch_assoc($query);

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title><?php echo $fetchstore['store_name']; ?> : <?php echo $PosName; ?></title>
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
        <h4 class="users-action"><i class="fa fa-home"></i> <?php echo $fetchstore['store_name']; ?> <i
          class="fa fa-angle-right"></i>
         Stock Purchased <i class="fa fa-angle-right"></i>

        </h4>
        <p>Search Required Stock Purchase of a specific date or date range <i class="fa fa-angle-right"></i></p>
        <form action="" method="GET">
         <div class="row">
          <div class="col-md-4 col-lg-4">
           <div class="form-group">
            <label>Start Date</label>
            <input type="date" name="from" value="" class="form-control">
           </div>
          </div>
          <div class="col-md-4 col-lg-4">
           <div class="form-group">
            <label>End Date</label>
            <input type="date" name="to" value="" class="form-control">
           </div>
          </div>
          <div class="col-md-4 col-lg-4">
           <div class="form-group">
            <label>&nbsp;</label>
            <button type="submit" name="FILTER_VIEW" value="true"
             class="btn btn-md btn-primary form-control text-white">APPLY</button>
           </div>
          </div>
         </div>
        </form>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <h3 class="text-center">Purchase Date:
           <?php if (isset($_GET['FILTER_VIEW'])) {
												$from = $_GET['from'];
												$to = $_GET['to'];


												if ($from == null) {
													$to = date("D d M, Y", strtotime($to));
													echo " to $to <a href='purchased.php' class='btn btn-sm btn-primary'><i class='fa fa-times'></i> clear</a>";
												} elseif ($to == null) {
													$from = date("D d M, Y", strtotime($from));
													echo "from $from <a href='purchased.php' class='btn btn-sm btn-primary'><i class='fa fa-times'></i> clear</a>";
												} else {
													$from = date("D d M, Y", strtotime($from));
													$to = date("D d M, Y", strtotime($to));
													echo "From $from - to $to <a href='purchased.php' class='btn btn-sm btn-primary'><i class='fa fa-times'></i> clear</a>";
												}
											} else {
												echo date("D d M, Y");
											} ?>

           <i class="fa fa-angle-right"></i> <a href="export_stock.php" class="btn btn-sm btn-primary float-right"
            target="_blank"><i class="fa fa-file-pdf-o"></i> Export Stock</a>
          </h3>
          <table class="table table-striped dom-jQuery-events" style="font-size: 12px;">
           <thead>
            <tr>
             <th>#</th>
             <th>Product Name</th>
             <th>Market Price/Unit</th>
             <th>Quantity</th>
             <th>Total Price</th>
             <th>Purchase Date</th>
            </tr>
           </thead>
           <tbody>
            <?php

												if (isset($_GET['FILTER_VIEW'])) {
													$from = $_GET['from'];
													$to = $_GET['to'];
													if ($from == null) {
														$to = date("D d M, Y", strtotime($to));
														$from = "";
													} elseif ($to == null) {
														$from = date("D d M, Y", strtotime($from));
														$to = "";
													}

													$sql = "SELECT * FROM stock_purchase where purchase_day like '%$from%' or purchase_day like '%$to%'";
												} else {
													$today = date("D d M, Y");
													$sql = "SELECT * FROM stock_purchase where purchase_day='$today' ORDER BY product_name ASC";
												}

												$query = mysqli_query($con, $sql);
												$count = mysqli_num_rows($query);
												if ($count == 0) {
													echo "
   <tr>
      <td colspan='11' align='center'><h2>No Purchase Avaialable</h2></td>
   </tr>
  ";
												}
												$num = 0;
												while ($fetch = mysqli_fetch_assoc($query)) {
													$purchase_id = $fetch['purchase_id'];
													$product_name = $fetch['product_name'];
													$quantiy_purchased = $fetch['quantiy_purchased'];
													$market_price_per_unit = $fetch['market_price_per_unit'];
													$purchase_date = $fetch['purchase_date'];
													$total_price = $fetch['total_price'];
													$hindi_name = $fetch['hindi_name'];
													$num++;

													echo "
   <tr>
     <td>$num</td>
     <td>$product_name - $hindi_name</td>
     <td>Rs.$market_price_per_unit</td>
     <td>$quantiy_purchased</td>
     <td>Rs.$total_price</td>
     <td>$purchase_date</td>
</tr>

  ";
												}

												if (isset($_GET['FILTER_VIEW'])) {


													$from = $_GET['from'];
													$to = $_GET['to'];
													if ($from == null) {
														$to = date("D d M, Y", strtotime($to));
													} elseif ($to == null) {
														$from = date("D d M, Y", strtotime($from));
													}

													$select = "SELECT sum(total_price) FROM stock_purchase where purchase_day like '%$from%' OR purchase_day  like '%$to%'";
													$action = mysqli_query($con, $select);
													while ($record = mysqli_fetch_array($action)) {
														$product_total_amount = $record['sum(total_price)'];
													}
												} else {
													$today = date("D d M, Y");
													$select = "SELECT sum(total_price) FROM stock_purchase where purchase_day='" . $today . "'";
													$action = mysqli_query($con, $select);
													while ($record = mysqli_fetch_array($action)) {
														$product_total_amount = $record['sum(total_price)'];
													}
												}

												echo "<tr>
<td colspan='4' align='right'><b>Total Amount</b></td>
  <td colspan='1' align='left'><b>Rs.$product_total_amount</b></td>
  <td></td>
</tr>";
												?>
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