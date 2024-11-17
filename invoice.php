<?php
require 'files.php';
if (isset($_GET['order_id'])) {
   $order_id = $_GET['order_id'];
} elseif (isset($_GET['id'])) {
   $order_id = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
 <meta charset="utf-8">
 <title> <?php echo $order_id; ?>_<?php echo date("d_D_M_Y_h_m_s_p"); ?>@<?php echo $store_name; ?></title>
 <link rel="shortcut icon" href="img/favicon.ico">
 <!--STYLESHEET-->
 <!--=================================================-->
 <!--Roboto Slab Font [ OPTIONAL ] -->
 <link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,700" rel="stylesheet">
 <link href="http://fonts.googleapis.com/css?family=Roboto:500,400italic,100,700italic,300,700,500italic,400"
  rel="stylesheet">
 <!--Bootstrap Stylesheet [ REQUIRED ]-->
 <link href="inv/css/bootstrap.min.css" rel="stylesheet">
 <!--Jasmine Stylesheet [ REQUIRED ]-->
 <link href="inv/css/style.css" rel="stylesheet">
 <!--Font Awesome [ OPTIONAL ]-->
 <link href="inv/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
 <!--Switchery [ OPTIONAL ]-->
 <link href="inv/plugins/switchery/switchery.min.css" rel="stylesheet">
 <!--Bootstrap Select [ OPTIONAL ]-->
 <link href="inv/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
 <!--Bootstrap Table [ OPTIONAL ]-->
 <link href="inv/plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
 <link href="inv/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
 <!--Demo [ DEMONSTRATION ]-->
 <link href="inv/css/demo/jasmine.css" rel="stylesheet">
 <!--SCRIPT-->
 <!--=================================================-->
 <!--Page Load Progress Bar [ OPTIONAL ]-->
 <link href="plugins/pace/pace.min.css" rel="stylesheet">
 <script src="plugins/pace/pace.min.js"></script>
 <style type="text/css">
 table tr th,
 td {
  padding: 0.25% !important;
 }

 </style>
</head>
<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body style="font-size: 11px;width:900px !important;">
 <!--NAVBAR-->
 <!--===================================================-->
 <!--END NAVBAR-->
 <div class="boxed" style="width:900px !important;">
  <!--CONTENT CONTAINER-->
  <!--===================================================-->
  <div style="padding-left:0px;width:900px !important;">

   <!--Page Title-->
   <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

   <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
   <!--End page title-->
   <!--Page content-->
   <!--===================================================-->
   <div id="page-content">

    <div class="row">

     <div class="col-lg-8 col-md-12">

      <div class="panel" style="width:800px !important;">
       <div class="panel-heading">
        <h3 class="panel-title">Orders Details
        </h3>

       </div>
       <!--===================================================-->
       <div class="panel-body" style="width: 100% !important;">
        <?php
                        $sql = "SELECT * from customer_orders, customers where customer_orders.order_id='$order_id' and customers.customer_id and customer_orders.customer_id";
                        $query = mysqli_query($con, $sql);
                        $fetch = mysqli_fetch_assoc($query);
                        $countorder = mysqli_num_rows($query);
                        if ($countorder == 0) {
                           header("location: orders.php");
                        }
                        $store_id = $fetch['store_id'];
                        $customer_id = $fetch['customer_id'];
                        $delivery_address = $fetch['delivery_address'];
                        $billing_address = $fetch['billing_address'];
                        $order_date = $fetch['order_date'];
                        $delivery_date = $fetch['delivery_date'];
                        $payment_mode = $fetch['payment_mode'];
                        $payment_status = $fetch['payment_status'];
                        $payment_note = $fetch['payment_note'];
                        $delivery_status = $fetch['delivery_status'];
                        $order_status = $fetch['order_status'];
                        $order_status = str_replace('_', ' ', $order_status);
                        $PICK_SCHEDULE_TIME = $fetch['PICK_SCHEDULE_TIME'];
                        $total_amount = $fetch['total_amount'];
                        $payment_mode = str_replace('_', ' ', $payment_mode);
                        $payment_status = str_replace('_', ' ', $payment_status);
                        $delivery_status = str_replace('_', ' ', $delivery_status);
                        ?>
        <?php

                        $sql = "SELECT * from stores where store_id='$store_id'";
                        $query = mysqli_query($con, $sql);
                        $fetch = mysqli_fetch_assoc($query);
                        $store_name = $fetch['store_name'];
                        $store_address = $fetch['store_address'];
                        $store_arealocality = $fetch['store_arealocality'];
                        $store_city = $fetch['store_city'];
                        $store_state = $fetch['store_state'];
                        $store_pincode = $fetch['store_pincode'];
                        $store_phone = $fetch['store_phone'];
                        $store_mail_id = $fetch['store_mail_id'];
                        $store_profile_img = $fetch['store_profile_img'];
                        $logo = "$img_url/$store_profile_img";
                        $gst = $fetch['GST'];
                        $pan = $fetch['PAN'];
                        $user_id = $fetch['user_id'];
                        $sql = "SELECT * from users where user_id='$user_id'";
                        $query = mysqli_query($con, $sql);
                        $fetch = mysqli_fetch_assoc($query);
                        $full_name = $fetch['full_name'];
                        ?>
        <div class="invoice-wrapper panel" id="print-area">
         <section class="invoice-container" style="margin-top:1rem !important;">
          <div class="invoice-inner" style="padding:1%;">
           <div class="row" style="margin-top: -2%;">
            <div class="col-xs-6">
             <h3 class="mt-0" style="margin-top: 0px;"><?php if ($payment_status == "NOT PAID" or $payment_status == "Not Paid") {
                                                                                    echo "<img src='img/unpaid.png' style='width:20%;'>";
                                                                                 } else {
                                                                                    echo "<img src='img/paid.png' style='width:30%;'>";
                                                                                 }
                                                                                 ?> Invoice </h3>
             <img src="<?php echo $logo; ?>" style="width: 150px;">
            </div>
            <div class="col-xs-6 text-right">
             <h3 style="margin-top: 0px;">ID - #<?php echo $order_id; ?>
             </h3>
             <?php
                                       $SqlOrders = "SELECT * FROM customer_orders";
                                       $QueryOrders = mysqli_query($con, $SqlOrders);
                                       $CountsOrders = mysqli_num_rows($QueryOrders);
                                       $OrderYear = date("Y", strtotime($order_date));
                                       $OrderMonth = date("m", strtotime($order_date));
                                       ?>
             <span><b>InvoiceNo</b> :
              <?php echo $OrderYear; ?>/<?php echo $OrderMonth; ?>/00<?php echo $CountsOrders; ?></span><br>
             <strong>Order Date : <?php echo $order_date; ?></strong>
             <address class="mb-0" style="margin-bottom:0px !important;">
              <?php echo $store_name; ?><br>
              <?php echo $store_address; ?>, <?php echo $store_arealocality; ?>, <br><?php echo $store_city; ?>,
              <?php echo $store_state; ?> - <?php echo $store_pincode; ?><br>
              <b><i class="fa fa-phone"></i></b> <?php echo $store_phone; ?><br>
              <b><i class="fa fa-envelope"></i></b> <?php echo $store_mail_id; ?><br>
              <b>GST :</b> <?php echo $gst; ?> |
              <b>PAN :</b> <?php echo $pan; ?>
             </address>
            </div>
           </div>
           <hr />
           <div class="row">
            <?php
                                    $sql = "SELECT * from customers where customer_id='$customer_id'";
                                    $query = mysqli_query($con, $sql);
                                    $fetch = mysqli_fetch_assoc($query);
                                    $customer_name = $fetch['customer_name'];
                                    $customer_phone = $fetch['customer_phone_number'];
                                    $customer_mail_id = $fetch['customer_mail_id'];
                                    ?>
            <style>
            address p {
             line-height: 14px !important;

            }

            </style>
            <div class="col-xs-6">
             <address style="width: 300px; float:left;">
              <h5>Billing Address</h5>
              <?php echo html_entity_decode($billing_address); ?><br>
             </address>
            </div>
            <div class="col-xs-6 text-right">
             <address style="width: 300px; float:right;">
              <h5>Shipping Address</h5>
              <?php echo html_entity_decode($delivery_address); ?><br>
             </address>
            </div>
           </div>
           <div class="row">
            <div class="col-xs-6">
             <strong style="font-size: 17px;">Payments Details</strong>
             <br /><b>Method:</b> <?php echo $payment_mode; ?>
             <br /><b>Status:</b>
             <?php if ($payment_status == "NOT PAID" or $payment_status == "Not Paid") {
                                          echo "<span class='text-danger' style='color:red;'><i class='fa fa-warning text-danger' style='color:red;'></i> Not Paid</span>";
                                       } else {
                                          echo "<span class='text-success' style='color:green;'><i class='fa fa-check-circle text-success' style='color:green;'></i> Paid</span>";
                                       }
                                       ?>
             <br /><b>Payment Note:</b> <?php echo $payment_note; ?>
            </div>
            <div class="col-xs-6 text-right">
             <strong style="font-size: 17px;">Delivery Details</strong><br>
             <b>Delivery Date :</b> <?php echo $delivery_date; ?><br>
             <b>Delivery Status :</b> <?php echo $delivery_status; ?><br>
             <b>Delivery Slot :</b> <?php echo $PICK_SCHEDULE_TIME; ?>
            </div>
           </div>
           <div class="row">
            <div class="col-md-12 pad-top" style="margin-top: -2%;">
             <div class="panel panel-default" style="background-color: transparent">

              <div class="panel-body" style="padding:0px !important; margin-top:10px !important;">
               <div class="table-responsive">
                <table class="table table-condensed" style="font-size:13px !important;">
                 <style>
                 thead tr th {
                  font-size: 13px !important;
                  padding: 0.3% !important;
                 }

                 tbody tr td {
                  font-size: 12px !important;
                 }

                 </style>
                 <thead>
                  <tr>
                   <th align="left" style="width:25% !important;">Product Name</th>
                   <th align="right" style="text-align: right;">MRP Price</th>
                   <th align="right" style="text-align: right;">Sale Price</th>
                   <th align="right" style="text-align: right;">Quantity</th>
                   <th align="right" style="text-align: right;">Total</th>
                   <th align="right" style="text-align: right;">Taxes</th>
                   <th align="right" style="text-align: right;">Net Price</th>
                  </tr>
                 </thead>
                 <tbody>
                  <?php
                                                      $select = "SELECT sum(product_mrp_total) FROM ordered_products where order_id='$order_id'";
                                                      $action = mysqli_query($con, $select);
                                                      while ($record = mysqli_fetch_array($action)) {
                                                         $total_amount_mrp = $record['sum(product_mrp_total)'];
                                                      }

                                                      $sql = "SELECT * FROM customer_orders where order_id='$order_id'";
                                                      $query = mysqli_query($con, $sql);
                                                      $fetch = mysqli_fetch_assoc($query);
                                                      $coupon_code_order = $fetch['coupon_code'];
                                                      $coupon_code_order = str_replace('_', ' ', $coupon_code_order);
                                                      $total_amount_after_discount = $fetch['total_amount_after_discount'];
                                                      $delivery_charge = $fetch['delivery_charge'];
                                                      $net_payable_amount = $fetch['net_payable_amount'];
                                                      $rewardspoints = $fetch['rewardspoints'];

                                                      $total_product_price2 = $fetch['total_amount'];
                                                      $discount_amount = $total_amount_mrp - $total_amount_after_discount;
                                                      mysqli_set_charset($con, 'utf8');
                                                      $sql = "SELECT * from ordered_products where order_id='$order_id'";
                                                      $query = mysqli_query($con, $sql);
                                                      $productgstamountforsingleitem2 = 0;
                                                      $total_amount_mrp = 0;
                                                      while ($fetch = mysqli_fetch_assoc($query)) {
                                                         $product_qty = $fetch['product_qty'];
                                                         $product_tags = $fetch['product_tags'];
                                                         $hindi_name = $fetch['hindi_name'];
                                                         $product_taxes = $fetch['product_taxes'];
                                                         $product_mrp = $fetch['product_mrp'];
                                                         $product_price = $fetch['product_price'];
                                                         $product_net_prices = $fetch['product_net_prices'];
                                                         $product_total_price = $fetch['product_total_price'];
                                                         $product_HSN = $fetch['product_HSN'];
                                                         $product_units = "$product_tags";
                                                         $letters = preg_replace('/[0-9\.]/', '', "$product_tags");
                                                         $numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
                                                         $Quantity = $product_qty / $numbers;
                                                         $mrp_total = $product_mrp * $product_qty;
                                                         $total_amount_mrp += $mrp_total;

                                                         $ProductTaxAmount = round($product_total_price / 100 * $product_taxes, 2);
                                                         $ProducttaxPeritem = $ProductTaxAmount / $product_qty;
                                                         $ProductRealPrice = $product_price - $ProducttaxPeritem;
                                                         $ProductQtyPrice = $ProductRealPrice * $product_qty;
                                                         $GstTaxAmount = round($ProductQtyPrice / 100 * $product_taxes, 2);
                                                         $ProductNetTotal = $GstTaxAmount + $ProductQtyPrice;
                                                         $productgstamountforsingleitem2 += $ProductNetTotal;
                                                      ?>
                  <tr style="font-size:11px !important;">
                   <td class="text-left" style="font-size:11px !important;width:25% !important;">
                    <?php echo html_entity_decode(ucfirst($fetch['product_names'])); ?> <br> HSN :
                    <?php echo $product_HSN; ?></td>
                   <td class="text-right" style="font-size:11px !important;">Rs.<?php echo $fetch['product_mrp']; ?>
                   </td>
                   <td class="text-right" style="font-size:11px !important;">Rs.<?php echo $ProductRealPrice; ?></td>
                   <td class="text-right" style="font-size:11px !important;"> x <?php echo $Quantity; ?></td>
                   <td class="text-right" style="font-size:11px !important;">Rs.<?php echo $ProductQtyPrice; ?></td>
                   <td class="text-right" style="font-size:11px !important;">GST <?php echo $product_taxes; ?>%<br>+
                    Rs.<?php echo $GstTaxAmount; ?></td>
                   <td class="text-right" style="font-size:13px !important;"><b>Rs.<?php echo $ProductNetTotal; ?></b>
                   </td>
                  </tr>
                  <?php } ?>


                  <tr>
                   <td class="thick-line"></td>
                   <td class="thick-line text-right" colspan="5"><strong>MRP Total :</strong></td>
                   <td class="thick-line text-right">Rs.<?php echo $total_amount_mrp; ?></td>
                  </tr>
                  <tr>
                   <td class="no-line"></td>
                   <td class="no-line text-right" colspan="5"><strong>Discounted Amount :</strong></td>
                   <td class="no-line text-right">
                    <?php
                                                            $select = "SELECT sum(product_total_price) FROM ordered_products where order_id='$order_id'";
                                                            $action = mysqli_query($con, $select);
                                                            while ($record = mysqli_fetch_array($action)) {
                                                               $total_amount = $record['sum(product_total_price)'];
                                                            }
                                                            ?> <?php $discount = $total_amount_mrp - $total_amount;
                                                               if ($discount == 0) {
                                                                  echo "0";
                                                               } else {
                                                                  echo "- Rs.$discount";
                                                               } ?></td>
                  </tr>
                  <tr>
                   <td class="no-line"></td>
                   <td class="no-line text-right" colspan="5"><strong>Total Product Price :</strong></td>
                   <td class="no-line text-right">Rs.<?php
                                                                                             echo $productgstamountforsingleitem2;
                                                                                             ?></td>
                  </tr>
                  <tr>
                   <td class="no-line"></td>
                   <td class="no-line text-right" colspan="5"><strong>Order Amount (Round fig):</strong></td>
                   <td class="no-line text-right">Rs.<?php echo $total_product_price2; ?></td>
                  </tr>
                  <tr>
                   <td class="no-line"></td>
                   <td class="no-line text-right" colspan="5"><strong>Coupon & Reward Points :</strong></td>
                   <td class="no-line text-right"><?php echo $coupon_code_order; ?>
                    <?php if ($coupon_code_order == "REWARD POINTS") {
                                                                                                                              echo "($rewardspoints Points)";
                                                                                                                           } else {
                                                                                                                           } ?></td>
                  </tr>




                  <tr>
                   <td class="no-line"></td>
                   <td class="no-line text-right" colspan="5"><strong>Delivery & Conveniance Charge :</strong></td>
                   <td class="no-line text-right"><?php if ($delivery_charge == 0 or $delivery_charge == "" or $delivery_charge == null) {
                                                                                             echo "Free Delivery";
                                                                                          } else {
                                                                                             echo "+ Rs. $delivery_charge";
                                                                                          } ?></td>
                  </tr>

                  <tr>
                   <td class="no-line"></td>
                   <td class="no-line text-right" colspan="5"><strong>Net Payable Amount :</strong></td>
                   <td class="no-line text-right">
                    <h3>Rs.<?php echo $net_payable_amount; ?></h3>
                   </td>
                  </tr>

                 </tbody>

                </table>
               </div>
               <div class="StampPosition" style="position: absolute;
    width: 90%;
    bottom: -5%;
    opacity: 0.1;">
                <img src="img/24kharidoMark.png" style="width: 100%;">
               </div>
              </div>
             </div>
            </div>
           </div>
           <p><code>*</code>This is a computer Generated invoice. No Need for Signature or Stamp.</p>
           <div class="text-center no-print">
            <a class="btn btn-primary btn-lg" onClick="window.print()">
             <i class="fa fa-print"></i> Print
            </a>
           </div>
          </div>
         </section>
        </div>
       </div>
       <!--===================================================-->
       <!--===================================================-->

      </div>
     </div>
     <!--===================================================-->
     <!--End page content-->
    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
    <!--MAIN NAVIGATION-->
    <!--===================================================-->

    <!--===================================================-->
    <!--END MAIN NAVIGATION-->
    <!--ASIDE-->
    <!--===================================================-->

   </div>
   <!-- FOOTER -->

   <!-- END FOOTER -->
   <!-- SCROLL TOP BUTTON -->
   <!--===================================================-->
   <button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
   <!--===================================================-->

   <!--===================================================-->
   <!-- END OF CONTAINER -->
   <!--JAVASCRIPT-->
   <script src="inv/js/jquery-2.1.1.min.js"></script>
   <!--BootstrapJS [ RECOMMENDED ]-->
   <script src="inv/js/bootstrap.min.js"></script>
   <!--Fast Click [ OPTIONAL ]-->
   <script src="inv/plugins/fast-click/fastclick.min.js"></script>
   <!--Jasmine Admin [ RECOMMENDED ]-->
   <script src="inv/js/scripts.js"></script>
   <!--Switchery [ OPTIONAL ]-->
   <script src="inv/plugins/switchery/switchery.min.js"></script>
   <!--Bootstrap Select [ OPTIONAL ]-->
   <script src="inv/plugins/bootstrap-select/bootstrap-select.min.js"></script>
   <!--Switchery [ OPTIONAL ]-->
   <script src="inv/plugins/jquery-print/jQuery.print.js"></script>
   <!--Fullscreen jQuery [ OPTIONAL ]-->

</html>
