<?php
require 'files.php';
require 'session.php';
?>
<?php
if (isset($_GET['id'])) {
  $SubsId = $_GET['id'];
  $SelectCId = "SELECT * FROM customer_subscriptions where customer_subscription_id='$SubsId'";
  $CIdQuery = mysqli_query($con, $SelectCId);
  $FetchCId = mysqli_fetch_assoc($CIdQuery);
  $CustomerId = $FetchCId['customer_id'];
  $DeliveryAddress = $FetchCId['delivery_address'];
  $SUBSCRIBE_PLAN_TYPE = $FetchCId['SUBSCRIBE_PLAN_TYPE'];
  $SUBSCRIPTION_STATUS = $FetchCId['SUBSCRIPTION_STATUS'];
  if ($SUBSCRIPTION_STATUS == "ACTIVE") {
    $SUBSCRIPTION_STATUS = "<i class='fa fa-check-circle text-success'></i> Active";
  } else {
    $SUBSCRIPTION_STATUS = "<i class='fa fa-warning text-danger'></i> $SUBSCRIPTION_STATUS";
  }
  $SUBS_APPLY_DATE = $FetchCId['SUBS_APPLY_DATE'];
  $SUBS_START_DATE = $FetchCId['SUBS_START_DATE'];

  $SelectC = "SELECT * FROM customers where customer_id='$CustomerId'";
  $CQuery = mysqli_query($con, $SelectC);
  $fetchC = mysqli_fetch_assoc($CQuery);
  $customer_name = $fetchC['customer_name'];
  $customer_mail_id = $fetchC['customer_mail_id'];
  $customer_phone_number = $fetchC['customer_phone_number'];
  $alternatenumber = $fetchC['alternatenumber'];
  $custaddress = $fetchC['custaddress'];
  $arealocality = $fetchC['arealocality'];
  $custaddress = $fetchC['custaddress'];
  $custcity = $fetchC['custcity'];
  $custstate = $fetchC['custstate'];
  $custpincode = $fetchC['custpincode'];
  $contactperson = $fetchC['contactperson'];
  $StoreId = $FetchCId['store_id'];

  $SelectPayWay = "SELECT * FROM customer_subscription_payments where customer_subscription_id='$SubsId'";
  $PayWayQuery = mysqli_query($con, $SelectPayWay);
  $FetchPayWay = mysqli_fetch_assoc($PayWayQuery);
  $payment_cycle = $FetchPayWay['payment_cycle'];
  $payment_mode = $FetchPayWay['payment_mode'];
} else {
  header("location: subscription.php");
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Supplies and Orders : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>

 <style type="text/css">
 table tr th,
 table tr td {
  padding: 1% !important;
 }
 </style>
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
        <h4 class="users-action">SUBSCRIPTION Delivery <i class="fa fa-angle-right"></i> <?php echo $_GET['id']; ?>
         <hr>
        </h4>
        <div class="row">

         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <p><b>Subscription Details :</b> <span class="float-right"><i class="fa fa-calendar"></i>
            <?php echo date("D d M, Y"); ?></span></p>
          <?php
                    $SelectQty = "SELECT * FROM subscription_products where customer_subscription_id='$SubsId'";
                    $QtyQuery = mysqli_query($con, $SelectQty);
                    $fetchQty = mysqli_fetch_assoc($QtyQuery);
                    $product_name = $fetchQty['product_name'];
                    $brand_title = $fetchQty['brand_title'];
                    $product_tags = $fetchQty['product_tags'];
                    $product_offer_price = $fetchQty['product_offer_price'];
                    $product_mrp_price = $fetchQty['product_mrp_price'];
                    $product_quantity = $fetchQty['product_quantity'];
                    $product_total_price = $fetchQty['product_total_price'];
                    $product_mrp_total = $fetchQty['product_mrp_total'];

                    ?>
          <table class="table">
           <tr>
            <th>Item Name</th>
            <td><?php echo $product_name; ?></td>
           </tr>
           <tr>
            <th>Brand Name</th>
            <td><?php echo $brand_title; ?></td>
           </tr>
           <tr>
            <th>Price</th>
            <td><i class="fa fa-inr"></i> <?php echo $product_offer_price; ?> / <?php echo $product_tags; ?></td>
           </tr>
           <tr>
            <th>Subscribed Quantity</th>
            <td>x <?php echo $product_quantity; ?></td>
           </tr>

           <tr>
            <th>Total Amount</th>
            <td>
             <i class="fa fa-inr"></i> <?php echo $product_offer_price * $product_quantity; ?>
            </td>
           </tr>
           <tr>
            <th>Payment Type</th>
            <td>
             <?php echo $payment_cycle; ?>
            </td>
           </tr>
           <tr>
            <th>Payment Mode</th>
            <td>
             <?php echo $payment_mode; ?>
            </td>
           </tr>
          </table>
         </div>

         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <p><b>Complete Today Delivery :</b></p>
          <form action="insert.php" method="POST">
           <input type="text" name="customer_id" value="<?php echo $CustomerId; ?>" hidden="">
           <input type="text" name="store_id" value="<?php echo $StoreId; ?>" hidden="">
           <input type="text" name="payment_cycle" value="<?php echo $payment_cycle; ?>" hidden="">
           <input type="text" name="payment_mode" value="<?php echo $payment_mode; ?>" hidden="">
           <input type="text" name="payment_status" value="UNPAID" hidden="">
           <table class="table">
            <tr>
             <th>SUBS ID</th>
             <td><input type="text" name="customer_subscription_id" value="<?php echo $SubsId; ?>" class="form-control"
               readonly=""></td>
            </tr>
            <tr>
             <th>Delivery Date</th>
             <td><input type="text" name="delivery_date" value="<?php echo date('d M Y'); ?>" class='form-control'
               readonly=''></td>
            </tr>
            <tr>
             <th>Delivered Qty</th>
             <td><input type="number" id="SubsQty" oninput="Quantity()" name="delivered_quantity"
               value="<?php echo $product_quantity; ?>" class='form-control'></td>
            </tr>
            <tr>
             <th>Total Amount (in Rs.)</th>
             <td><input type="text" id='SubsAmount' name="payment_amount" value="<?php echo $product_total_price; ?>"
               class='form-control' readonly=""></td>
            </tr>
            <tr>
             <td colspan="2">
              <div class="row">
               <div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
                <table style="width: 100%;">
                 <tr>
                  <td>
                   <input type="radio" name="delivery_status" value="DELIVERED" required="">
                  </td>
                  <td>DELIVERED</td>
                 </tr>
                </table>
               </div>
               <div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
                <table style="width: 100%;">
                 <tr>
                  <td>
                   <input type="radio" name="delivery_status" value="UNDELIVERED" required="">
                  </td>
                  <td>UNDELIVERED</td>
                 </tr>
                </table>
               </div>
               <div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
                <table style="width: 100%;">
                 <tr>
                  <td>
                   <input type="radio" name="delivery_status" value="REJECTED" required="">
                  </td>
                  <td>REJECTED</td>
                 </tr>
                </table>
               </div>
              </div>
             </td>
            </tr>
            <tr>
             <th>Delivery Note</th>
             <td>
              <textarea class="form-control" name="delivery_note" required="" rows="3"></textarea>
             </td>
            </tr>
            <tr>
             <td colspan="2" align="center">
              <button type="submit" name="CREATE_DELIVERY" class="btn btn-success btn-md">Submit Delivery</button>
             </td>
            </tr>
           </table>
          </form>
         </div>

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
 <script type="text/javascript">
 function Quantity() {
  var SubsQty = document.getElementById('SubsQty').value;
  var SubsAmount = <?php echo $product_offer_price; ?>;

  var TotalAmount = SubsQty * SubsAmount;

  document.getElementById('SubsAmount').value = TotalAmount;
 }
 </script>
 <?php require 'footer.php'; ?>
 <script type="text/javascript">
 $(document).ready(function() {
  $('#table_id').DataTable();
 });
 </script>

 <!-- BEGIN: Vendor JS-->
 <script src="app-assets/vendors/js/vendors.min.js"></script>
 <!-- BEGIN Vendor JS-->

 <!-- BEGIN: Page Vendor JS-->
 <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
 <!-- END: Page Vendor JS-->
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js">
 </script>

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