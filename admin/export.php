<html>

<head>
 <title>
  Orders_Delivery_Sheet_<?php echo $_GET['order_type']; ?>_<?php echo $_GET['area_locality']; ?>_<?php echo $_GET['delivery_slot']; ?>_<?php echo date("D_d_M_h_m_a"); ?>
 </title>
</head>
<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Commissioner&display=swap');

html,
body,
table,
tr,
th,
td,
h1,
h2,
h3,
h4,
h5,
h6,
p,
span,
div,
section {
 font-family: 'Commissioner', sans-serif !important;
 font-size: 11px !important;
}

@media print {
 #main {
  position: relative;
  padding: 0;
  height: 1px;
  overflow: visible;
 }

 #printarea {
  position: absolute;
  width: 100%;
  top: 0;
  padding: 0;
  margin: -1px;
 }
}

@page {
 size: 5.5in 8.5in;
}

@page {
 size: A4 portrait;
}

@page :blank {
 @top-center {
  content: "This page is intentionally left blank."
 }
}

@page: right {
 @bottom-left {
  margin: 10pt 0 30pt 0;
  border-top: .25pt solid #666;
  content: "My book";
  font-size: 9pt;
  color: #333;
 }
}

table,
figure {
 page-break-inside: avoid;
}

@page: right {
 @bottom-right {
  content: counter(page);
 }
}

@page: left {
 @bottom-left {
  content: counter(page);
 }
}

@page: left {
 @bottom-left {
  content: "Page "counter(page) " of "counter(pages);
 }
}
</style>
<style type="text/css">
table tr td {
 padding: 0.2%;
 box-shadow: 0px 0.7px 0.7px 0px #80808026;
}

table {
 page-break-inside: auto
}

tr {
 page-break-inside: avoid;
 page-break-after: auto
}

thead {
 display: table-header-group
}

tfoot {
 display: table-footer-group
}
</style>

<body style="width:21cm; margin-left:auto; margin-right:auto;height:auto;">
 <div id="printableArea">
  <?php
    require 'config.php';
    $user_id = "1";
    $sql = "SELECT * FROM stores where user_id='$user_id'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    $store_id = "1";

    $sql = "SELECT * from stores where store_id='$store_id'";
    $query =  mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    $store_name = $fetch['store_name'];
    $store_phone = $fetch['store_phone'];
    $store_mail_id = $fetch['store_mail_id'];
    $store_description = $fetch['store_description'];
    $store_address = $fetch['store_address'];
    $store_arealocality = $fetch['store_arealocality'];
    $store_city = $fetch['store_city'];
    $store_state = $fetch['store_state'];
    $store_pincode = $fetch['store_pincode'];
    $activation_fee_status = $fetch['activation_fee_status'];
    $store_user_id = $fetch['user_id'];
    $user_view_id = $store_user_id;
    $store_gst = $fetch['GST'];
    $store_pan = $fetch['PAN'];
    $store_profile_img = $fetch['store_profile_img'];
    ?>
  <center>
   <button onclick="window.print()"> Save & Print</button>
  </center> <br>
  <div>
   <table style="width: 100%;font-size: 12px; box-shadow: 0px 0px 1px grey;">
    <tr>
     <td style="width: 150px;">
      <img src="<?php echo $store_profile_img; ?>" style="width: 100%;">
     </td>
     <td>
      <p><span style="font-size: 13px;"><b><?php echo $store_name; ?></b></span><br>
       Address : <?php echo "$store_address, $store_arealocality, $store_city, $store_state - $store_pincode"; ?><br>
       Phone : <?php echo $store_phone; ?> <br>
       Mail ID : <?php echo $store_mail_id; ?><br>
       GST : <?php echo $store_gst; ?> <br>
       PAN : <?php echo $store_pan; ?>
      </p>
     </td>
     <td>
      <p><b>Delivery Date :</b> <?php echo date("D d M, Y", strtotime("+1 Day")); ?><br>
       <b>Order Date:</b> <?php echo date("D d M, Y"); ?><br>
       <b>Delivery Area :</b> <?php echo $_GET['area_locality']; ?><br>
       <b>Delivery City :</b> <?php echo $_GET['city']; ?>
       <br><b>Delivery Time :</b> <?php echo $_GET['delivery_slot']; ?><br>
       <b>Order Type : </b><?php echo $_GET['order_type']; ?></b>
      </p>
     </td>
    </tr>
   </table>
   <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 12px;">
    <tr>
     <th>
      <h2 style='margin-bottom: 0px;'>Order Delivery Sheet</h2>
     </th>
    </tr>
   </table>
   <table style="width: 100%;font-size: 11px;box-shadow: 0px 0px 1px grey;">
    <tr>
     <th style="width: 5%;">#</th>
     <th style="width: 15%;">Name & Address</th>
     <th style="width: 55%;">Order Items</th>
     <th style="width: 15%;">Payments Details</th>
     <th style="width: 10%;">Delivery Status</th>
    </tr>
    <div
     style="height:auto !important;display:inline-block !important; overflow:auto; position: static; margin-top:1.5%;">
     <?php
          if (isset($_GET['export_orders'])) {
            $export_orders = $_GET['export_orders'];
            if ($export_orders == "true") {
              $city = $_GET['city'];
              $area_locality = $_GET['area_locality'];
              $order_type = $_GET['order_type'];
              $delivery_slot = $_GET['delivery_slot'];

              if ($order_type == "ALL_ORDERS") {
                $order_type = "";
              } else {
                $order_type = $order_type;
              }
              $delivery_slot = $_GET['delivery_slot'];
              if ($delivery_slot == "ALL_SLOTS") {
                $delivery_slot = "";
              } else {
                $delivery_slot = $delivery_slot;
              }

              if ($city == "ALL_CITY" and $area_locality == "ALL_AREA_LOCALITY") {
                $sql = "SELECT * from customer_orders, customers where customer_orders.customer_id=customers.customer_id and customer_orders.order_status!='DELIVERED' and customer_orders.order_status!='REJECTED' and customer_orders.order_type LIKE '%$order_type%' and customer_orders.PICK_SCHEDULE_TIME LIKE '%$delivery_slot%'";
              } elseif ($city == "ALL_CITY" and $area_locality != "ALL_AREA_LOCALITY") {
                $city = $_GET['city'];
                $area_locality = $_GET['area_locality'];
                $sql = "SELECT * from customer_orders, customers where customer_orders.customer_id=customers.customer_id and customer_orders.order_status!='DELIVERED' and customer_orders.order_status!='REJECTED' and customer_orders.delivery_address LIKE '%$area_locality%' and customer_orders.order_type LIKE '%$order_type%' and customer_orders.PICK_SCHEDULE_TIME LIKE '%$delivery_slot%' ";
              } elseif ($area_locality == "ALL_AREA_LOCALITY" and $city != "ALL_CITY") {
                $city = $_GET['city'];
                $area_locality = $_GET['area_locality'];
                $sql = "SELECT * from customer_orders, customers where customer_orders.customer_id=customers.customer_id and customer_orders.order_status!='DELIVERED' and customer_orders.order_status!='REJECTED' and customer_orders.delivery_address LIKE '%$city%' and customer_orders.order_type LIKE '%$order_type%' and customer_orders.PICK_SCHEDULE_TIME LIKE '%$delivery_slot%' ";
              } else {
                $city = $_GET['city'];
                $area_locality = $_GET['area_locality'];
                $sql = "SELECT * from customer_orders, customers where customer_orders.customer_id=customers.customer_id and customer_orders.order_status!='DELIVERED' and customer_orders.order_status!='REJECTED' and customer_orders.delivery_address LIKE '%$city%' and customer_orders.delivery_address like '%$area_locality%' and customer_orders.order_type LIKE '%$order_type%' and customer_orders.PICK_SCHEDULE_TIME LIKE '%$delivery_slot%' ";
              }
              $query = mysqli_query($con, $sql);
              $countData = mysqli_num_rows($query);
              if ($countData == 0) {
                echo "<tr><td colspan='4'><h2>No Orders</h2></td></tr>";
              } else {
                while ($fetch = mysqli_fetch_assoc($query)) {
                  $order_id[] = $fetch['order_id'];
                }
                $countNo = 0;

                foreach ($order_id as $OID) {
                  $countNo = $countNo + 1;
                  mysqli_set_charset($con, 'utf8');
                  $sql = "SELECT * from customer_orders, customers where customer_orders.customer_id=customers.customer_id and customer_orders.order_id='$OID' ORDER BY delivery_address ASC";
                  $query = mysqli_query($con, $sql);
                  $fetch = mysqli_fetch_assoc($query);
                  $customer_id = $fetch['customer_id'];
                  $customer_name = $fetch['customer_name'];
                  $delivery_address = $fetch['delivery_address'];
                  $customer_phone = $fetch['customer_phone_number'];
                  $customer_alt_phone = $fetch['alternatenumber'];
                  $net_payable_amount = $fetch['net_payable_amount'];
                  $payment_status = $fetch['payment_status'];
                  $order_type = $fetch['order_type'];
                  $PICK_SCHEDULE_TIME = $fetch['PICK_SCHEDULE_TIME'];
                  $total_amountPro = $fetch['total_amount_after_discount'];
                  $delivery_charge = $fetch['delivery_charge'];
                  if ($delivery_charge == 0) {
                    $delivery_charge = "Free Delivery";
                  } else {
                    $delivery_charge = "Rs.$delivery_charge";
                  }

                  $select = "SELECT sum(product_total_price) FROM ordered_products where order_id='$OID'";
                  $action = mysqli_query($con, $select);
                  while ($record = mysqli_fetch_array($action)) {
                    echo $total_product_amount = $record['sum(product_total_price)'];
                  }

                  echo "<tr style='box-shadow: 0px 0px 1px grey;'>
        <td>$countNo</td>
            <td>
              <p><b>ID : </b>$OID<br>
              ORDER BY : $order_type<br>
              <hr>
              <b>$customer_name</b><br>
              $delivery_address<br>
              $customer_phone</p>
            </td>
            <td>
            <table style='width:100%;font-size:11px;'>
            <tr>
              <td>S.NO</td>
              <td>Item Name</td>
              <td>Price/Unit</td>
              <td>Unit</td>
              <td>Quanity</td>
              <td>Total</td>
            </tr>";
                  $sql = "SELECT * FROM ordered_products where order_id='$OID'";
                  $query = mysqli_query($con, $sql);
                  $count = 0;
                  while ($fetch = mysqli_fetch_assoc($query)) {
                    $product_names = $fetch['product_names'];
                    $product_tags = $fetch['product_tags'];
                    $product_qty = $fetch['product_qty'];
                    $product_tags = $fetch['product_tags'];
                    $hindi_name = $fetch['hindi_name'];
                    $product_price = $fetch['product_price'];
                    $product_total_price = $fetch['product_total_price'];
                    $product_qty = $fetch['product_qty'];
                    $product_units = "$product_tags";
                    $letters = preg_replace('/[0-9]/', '', "$product_tags");
                    $numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
                    $Quantity = $product_qty / $numbers;
                    $count++;
                    echo "
                <tr>
                 <td>$count</td>
                 <td>$product_names - $hindi_name</td>
                 <td>Rs.$product_price</td>
                 <td>$product_tags</td>
                 <td>x $Quantity</td>
                 <td>Rs.$product_total_price</td>
                </tr>
                ";
                    $CheckSubscription = "SELECT * FROM customer_subscriptions where customer_id='$customer_id' and SUBSCRIPTION_STATUS='ACTIVE'";
                    $QueryForSubscription = mysqli_query($con, $CheckSubscription);
                    $CountSubscription = mysqli_num_rows($QueryForSubscription);
                    if ($CountSubscription == 0) {
                      $SubscriptionPayments = "";
                    } else {
                      $FetchSubscription = mysqli_fetch_assoc($QueryForSubscription);
                      $customer_subscription_id = $FetchSubscription['customer_subscription_id'];

                      $SelectSubscriptionProducts = "SELECT * FROM subscription_products where customer_subscription_id='$customer_subscription_id'";
                      $QueryForSubscriptionProducts = mysqli_query($con, $SelectSubscriptionProducts);
                      $CountProducts = mysqli_num_rows($QueryForSubscriptionProducts);
                      if ($CountProducts == 0) {
                      } else {
                        $FetchSubsciptionProducts = mysqli_fetch_assoc($QueryForSubscriptionProducts);
                        $product_name_subs = $FetchSubsciptionProducts['product_name'];
                        $product_tags_subs = $FetchSubsciptionProducts['product_tags'];
                        $product_quantity_subs = $FetchSubsciptionProducts['product_quantity'];
                        $product_total_price_subs = $FetchSubsciptionProducts['product_total_price'];
                        $product_quantity_subs = $FetchSubsciptionProducts['product_quantity'];
                        $product_tags_subs = "$product_tags_subs";
                        $QuantityNames = preg_replace('/[0-9]/', '', "$product_tags_subs");
                        $QuanityNumbers = preg_replace("/[^0-9\.]/", '', "$product_tags_subs");
                        $QuantitySubs = $product_quantity_subs;
                        $net_payable_amount = $net_payable_amount + $product_total_price_subs;
                        $count++;
                        $SubscriptionPayments = "<b>Subscription Payments</b><br>Monthly Billings<br>";

                        echo "<tr>
       <td>$count</td>
       <td>$product_name_subs</td>
       <td>$product_tags_subs</td>
       <td>x $QuantitySubs</td>
    </tr>";
                      }
                    }
                  }

                  echo "
           <tr>
             <td colspan='5' align='right'>Total Price</td>
             <td><b>Rs.$total_product_amount</b></td>
           </tr>
           </table></td>
            <td>
            <br>
              Product Price : <br><b>Rs.$total_product_amount</b><br><hr>
              Delivery & Convenience Charges : <br><b>$delivery_charge</b><br><hr>
              Net Payable Amount : <br><b style='font-size:14px;'>Rs. $net_payable_amount</b><br><hr>
              Payment Status : <br><b>$payment_status</b><br>
            <br>
            $SubscriptionPayments<br>
            </td>
            <td></td>
        </tr>";
                }
              }
            } else {
              echo "<center><h4>Invalid Export Data</h4>
    <a href='export_orders.php'>Go Back</a></center>";
            }
          }
          ?>
    </div>
   </table>
  </div>
 </div>
</body>

</html>

<script type="text/javascript">
function printPageArea(areaid) {
 var printContent = document.getElementById(areaid);
 var WinPrint = window.open('', '', 'width=1200,height=650');
 WinPrint.document.write(printContent.innerHTML);
 WinPrint.document.close();
 WinPrint.focus();
 WinPrint.print();
 WinPrint.close();
}
</script>