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
 <title>Supplies and Orders : <?php echo $PosName; ?></title>
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
        <h4 class="users-action">SUBSCRIPTION ID <i class="fa fa-angle-right"></i> <?php echo $_GET['id']; ?>
         <hr>
        </h4>
        <div class="row">
         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <p><b>Customer Information:</b><br>
           <?php if (isset($_GET['id'])) {
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
                                            } else {
                                                header("location: subscription.php");
                                            }
                                            ?>
           <style type="text/css">
           table tr th,
           table tr td {
            padding: 1% !important;
           }
           </style>
          <table class="table">
           <tr>
            <th>Full Name</td>
            <td><?php echo $customer_name; ?></td>
           </tr>
           <tr>
            <th>Phone Number</td>
            <td><?php echo $customer_phone_number; ?></td>
           </tr>
           <tr>
            <th>Alt Phone</th>
            <td><?php echo $alternatenumber; ?></td>
           </tr>
           <tr>
            <th>Email Id</td>
            <td><?php echo $customer_mail_id; ?></td>
           </tr>
           <tr>
            <th>Customer Address</td>
            <td><?php echo $DeliveryAddress; ?></td>
           </tr>
           <tr>
            <th>Delivery Address</td>
            <td><?php echo "$custaddress, $arealocality, $custcity, $custstate, $custpincode"; ?></td>
           </tr>
          </table>
         </div>

         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <p><b>Subscription Information:</b></p>
          <table class="table">
           <tr>
            <th>Apply Date</th>
            <td><?php echo $SUBS_APPLY_DATE; ?></td>
           </tr>
           <tr>
            <th>Start Date</th>
            <td><?php echo $SUBS_APPLY_DATE; ?></td>
           </tr>
           <tr>
            <th>Plan Type</th>
            <td><?php echo $SUBSCRIBE_PLAN_TYPE; ?></td>
           </tr>
           <tr>
            <th>Delivery Days</th>
            <td>
             <?php
                                                    $Selectdays = "SELECT * FROM customer_subscriptions_days where customer_subscription_id='$SubsId'";
                                                    $DaysQuery = mysqli_query($con, $Selectdays);
                                                    while ($FetchDays = mysqli_fetch_assoc($DaysQuery)) {
                                                        $SUBSCRIPTION_DAYS = $FetchDays['SUBSCRIPTION_DAYS'];
                                                        echo "<span style='box-shadow: 0px 0px 3px #00b5b8;
    padding: 1%;
    margin: 2%;
    border-radius: 3px;
    display:inline-block;
    font-size:11px;'>$SUBSCRIPTION_DAYS</span>";
                                                    } ?>
            </td>
           </tr>
           <tr>
            <th>Status</th>
            <td><?php echo $SUBSCRIPTION_STATUS; ?></td>
           </tr>
          </table>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <p><b>Current Month Report:</b> <span class="float-right"><i class="fa fa-calendar"></i>
            <?php echo date("M, Y"); ?></span></p>
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
            <td><?php echo $product_quantity; ?> (<?php echo $product_tags; ?>)</td>
           </tr>
           <tr>
            <th>Total Deliveries</th>
            <td>
             <?php
                                                    $CurrentMonth = date("M Y");
                                                    $SelectDeliveries = "SELECT * FROM subscription_deliveries where customer_subscription_id='$SubsId' and delivery_date LIKE '%$CurrentMonth%'";
                                                    $DeliveriesQuery = mysqli_query($con, $SelectDeliveries);
                                                    $countDeliveries = mysqli_num_rows($DeliveriesQuery);
                                                    if ($countDeliveries == 0) {
                                                        echo "No Deliveries";
                                                    } else {
                                                        echo "$countDeliveries";
                                                    } ?>
            </td>
           </tr>
           <tr>
            <th>Delivered Qty</th>
            <td>
             <?php
                                                    $select = "SELECT sum(delivered_quantity) FROM subscription_deliveries where customer_subscription_id='$SubsId' and delivery_date LIKE '%$CurrentMonth%' and delivery_status='DELIVERED'";
                                                    $action = mysqli_query($con, $select);
                                                    while ($record = mysqli_fetch_array($action)) {
                                                        $delivered_quantity = $record['sum(delivered_quantity)'];
                                                    }
                                                    if ($delivered_quantity == 0) {
                                                        echo "No Delivery";
                                                    } else {
                                                        echo $delivered_quantity;
                                                    }
                                                    ?>
            </td>
           </tr>
           <tr>
            <th>Billing Amount</th>
            <td>
             <i class="fa fa-inr"></i>
             <?php
                                                    $select = "SELECT sum(payment_amount) FROM subscription_deliveries where customer_subscription_id='$SubsId' and delivery_status='DELIVERED'";
                                                    $action = mysqli_query($con, $select);
                                                    while ($record = mysqli_fetch_array($action)) {
                                                        $delivered_quantity = $record['sum(payment_amount)'];
                                                    }
                                                    if ($delivered_quantity == 0) {
                                                        echo "0";
                                                    } else {
                                                        echo $delivered_quantity;
                                                    }
                                                    ?>
            </td>
           </tr>
           <tr>
            <th>Payment Status</th>
            <td>
             <span class="text-danger">Not Paid</span>
            </td>
           </tr>
          </table>
         </div>
        </div>
       </div>

       <div class="card-content">
        <div class="card-body">

         <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <h4>Current Month Deliveries <i class="fa fa-angle-right"></i>
            <a href='subs_delivery.php?id=<?php echo $SubsId; ?>' class='btn btn-link btn-sm'><i
              class="fa fa-truck"></i> Add Delivery</a>
           </h4>
          </div>
         </div>

         <div class="table-responsive">
          <table class="table" style="font-size: 12px;text-align: left;" id="table_id">
           <thead>
            <tr>
             <th style="padding: 1%; font-size: 12px;">DATE</th>
             <th style="padding: 1%; font-size: 12px;">Delivered Qty</th>
             <th style="padding: 1%; font-size: 12px;">Amount</th>
             <th style="padding: 1%; font-size: 12px;">Delivery Status</th>
             <th style="padding: 1%; font-size: 12px;">Payment Status</th>
            </tr>
           </thead>
           <tbody>
            <?php
                                                $SelectDeliveries = "SELECT * FROM subscription_deliveries where customer_subscription_id='$SubsId'";
                                                $DeliveriesQuery = mysqli_query($con, $SelectDeliveries);
                                                $countDeliveries = mysqli_num_rows($DeliveriesQuery);
                                                if ($countDeliveries == 0) {
                                                    echo "<tr><td colspan='5' align='center'><h3>No Deliveries</h3></td></tr>";
                                                } else {
                                                    while ($FetchDeliveries = mysqli_fetch_assoc($DeliveriesQuery)) {
                                                        $delivery_date = $FetchDeliveries['delivery_date'];
                                                        $delivered_quantity = $FetchDeliveries['delivered_quantity'];
                                                        $payment_amount = $FetchDeliveries['payment_amount'];
                                                        $delivery_status = $FetchDeliveries['delivery_status'];
                                                        $payment_status = $FetchDeliveries['payment_status'];
                                                        echo "<tr>
                                                        <td>$delivery_date</td>
                                                        <td>$delivered_quantity</td>
                                                        <td><i class='fa fa-inr'></i> $payment_amount</td>
                                                        <td>$delivery_status</td>
                                                        <td>$payment_status</td>
                                                    </tr>";
                                                    }
                                                }

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