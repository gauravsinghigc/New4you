<?php
require 'files.php';
require 'session.php';
ini_set("display_errors", 0);
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Orders : <?php echo $PosName; ?></title>
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
        <h4 class="users-action">Export Stock Purchase <i class="fa fa-angle-right"></i>
         <span> Delivery On :
          <?php echo date("D d M, Y"); ?></span><br>
         <hr>
        </h4>
        <br><br>
        <form action="export_items.php" method="GET" target="blank">
         <div class="row">
          <div class="col-lg-4 col-md-4 col-12">
           <select class="form-control" name="city">
            <option value="ALL_CITY">ALL CITIES</option>
            <?php
												$sql = "SELECT * FROM city";
												$query = mysqli_query($con, $sql);
												while ($fetch = mysqli_fetch_assoc($query)) {
													$area_locality = $fetch['city_name'];
													$city_id = $fetch['city_id'];
													echo "<option value='$area_locality'>$area_locality</option>";
												}
												?>
           </select>
          </div>
          <div class="col-lg-4 col-md-4 col-12">
           <select class="form-control" name="order_date">
            <?php
												$sql = "SELECT * FROM ordered_products where item_status='false' GROUP BY order_date ORDER BY order_date DESC";
												$query = mysqli_query($con, $sql);
												while ($fetch = mysqli_fetch_assoc($query)) {
													$order_date = $fetch['order_date'];
													echo "<option value='$order_date'>$order_date</option>";
												}
												?>
           </select>
          </div>
          <div class="col-lg-4 col-md-4 col-12">
           <button class="btn btn-md btn-primary" name="export_orders" value="true"><i class="fa fa-file-pdf-o"></i>
            Export</button>
          </div>
         </div>
        </form>
        <br><br>
        <form action="" method="GET">
         <div class="row">
          <div class="col-lg-4 col-md-4 col-12">
           <select class="form-control" name="order_date">
            <?php
												$sql = "SELECT * FROM ordered_products where item_status='false' GROUP BY order_date ORDER BY order_date DESC";
												$query = mysqli_query($con, $sql);
												while ($fetch = mysqli_fetch_assoc($query)) {
													$order_date = $fetch['order_date'];
													echo "<option value='$order_date'>$order_date</option>";
												}
												?>
           </select>
          </div>
          <div class="col-lg-4 col-md-4 col-12">
           <button class="btn btn-md btn-primary" name="check_purchase" value="true"><i class="fa fa-warning"></i> Un
            Purchase Stock</button>
          </div>
          <div class="col-lg-4 col-md-4 col-12">
           <a class="btn btn-md btn-primary form-control text-white" href="items.php"><i class="fa fa-calander"></i>
            View Today</a>
          </div>
         </div>
        </form>
        <div class='container-fluid'>
         <div class='row'>
          <div class='col-lg-12 col-md-12 col-sm-12'>
           <br>
           <h4>Stock Order Date : <?php if (isset($_GET['order_date'])) {
																																			echo $_GET['order_date'];
																																		} else {
																																			echo $date = date("d M, Y", strtotime("-1 days"));
																																		} ?></h4>
          </div>
         </div>
        </div>
       </div>

       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table dom-jQuery-events table-striped">
           <thead>
            <tr>
             <th>PRODUCT NAME</th>
             <th>QUANTITY</th>
             <th>Mandi Price/Unit</th>
             <th>Qty Purchased</th>
             <th>Total Price</th>
            </tr>
           </thead>

           <tbody>
            <form action='insert.php' method='POST'>
             <?php
													if (isset($_GET['order_date'])) {
														$date = $_GET['order_date'];
													} else {
														$date = date("d M, Y", strtotime("-1 days"));
													}
													$sql = "SELECT * FROM ordered_products where item_status='false' and order_date like '%$date%' GROUP BY product_names ORDER BY product_names ASC";
													$query = mysqli_query($con, $sql);
													$count = mysqli_num_rows($query);
													if ($count == 0) {
														echo "<tr align='center'><td colspan='5'><h2>No Stock Purchase is Available.</h2></td></tr>";
													}

													while ($fetch = mysqli_fetch_assoc($query)) {
														$product_names = strtoupper($fetch['product_names']);
														$product_title[] = preg_replace('/[0-9]/', '', "$product_names");
													}

													foreach ($product_title as $PRODUCT_TITLE) {
														$countfun = str_replace(' ', '', $PRODUCT_TITLE);
														$sql = "SELECT * from ordered_products where product_names LIKE '%$PRODUCT_TITLE%' and item_status ='false' and order_date like '%$date%' ORDER BY product_names ASC";
														$query = mysqli_query($con, $sql);
														$fetch = mysqli_fetch_assoc($query);
														$hindi_name = $fetch['hindi_name'];
														$product_tags = $fetch['product_tags'];
														$product_qty = $fetch['product_qty'];
														$letters = preg_replace('/[0-9.]/', '', "$product_tags");

														$select = "SELECT sum(product_qty) FROM ordered_products where item_status='false' and product_names like '%$PRODUCT_TITLE%' and order_date like '%$date%'";
														$action = mysqli_query($con, $select);
														$numbers = "";
														while ($record = mysqli_fetch_array($action)) {
															$product_quantity = $record['sum(product_qty)'];
														}

														$product_units = "$product_tags";
														$letters = preg_replace('/[0-9.]/', '', "$product_tags");
														$numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
														$Quantity = $product_quantity;

														if ($Quantity >= 50 and $letters = "GM") {
															$Quantity = $Quantity / 1000;
															$letters = "KG";
														} else {
															$Quantity = $Quantity;
															$letters = $letters;
														}
													?>

             <tr>
              <input type="text" name="PRODUCT_TITLE[<?php echo $PRODUCT_TITLE; ?>][]"
               value='<?php echo $PRODUCT_TITLE; ?>' hidden="">
              <input type="text" name="PRODUCT_TAGS[<?php echo $PRODUCT_TITLE; ?>][]" value="<?php echo $letters; ?>"
               hidden="">
              <input type="text" name="hindi_name[<?php echo $PRODUCT_TITLE; ?>][]" value="<?php echo $hindi_name; ?>"
               hidden="">
              <td><?php echo $PRODUCT_TITLE; ?> - <?php echo $hindi_name; ?></td>
              <td><?php echo $Quantity . " " . $letters; ?></td>
              <td><input type='text' id="P<?php echo $countfun; ?>" name='market_price[<?php echo $PRODUCT_TITLE; ?>][]'
                oninput="m<?php echo $countfun; ?>()" value='' class='form-control' required="" tabindex='1'></td>
              <td>
               <b style="position: absolute;
    margin-top: 1%;">x</b>
               <input type='text' name='purchase_qty[<?php echo $PRODUCT_TITLE; ?>][]' id="Q<?php echo $countfun; ?>"
                oninput="m<?php echo $countfun; ?>()" value='<?php echo $Quantity; ?>' class='form-control'
                placeholder='x' min='1' style="width: 85%;
    float: right;" required="">
              </td>
              <td>
               <b style="position: absolute;margin-top: 1%;">= Rs.</b>
               <input type='text' id="T<?php echo $countfun; ?>" name='total_price[<?php echo $PRODUCT_TITLE; ?>][]'
                value='' class='form-control' placeholder='= ' readonly="" style="width: 80%;float: right;" required="">
              </td>
              <td>
               <script type='text/javascript'>
               function m<?php echo $countfun; ?>() {
                // Get the input values
                a = Number(document.getElementById("Q<?php echo $countfun; ?>").value);
                b = Number(document.getElementById("P<?php echo $countfun; ?>").value);

                // Do the multiplication
                c = Math.round(a * b);

                // Set the value of the total
                document.getElementById("T<?php echo $countfun; ?>").value = c;
               }
               </script>
              </td>

             </tr>

             <?php

													}
													if ($count == 0) {
													} else {
													?> <tr>
              <td colspan="6" align="center">
               <button type='submit' name='ADD_STOCK_PURCHASE' class='btn btn-md btn-primary'>PURCHASE ALL</button>
              </td>
             </tr>
             <?php } ?>
            </form>
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