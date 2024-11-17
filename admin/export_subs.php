<html>

<head>
 <title>
  Customer Subscription Sheet
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
 font-size: 10px !important;
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
 padding: 1%;
 box-shadow: 0px 0px 1px grey;
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
   <table style="width: 100%;font-size: 12px;">
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
      <p><b>Delivery Date : </b> <?php echo date("D d M, Y h:m A"); ?><br>
       <b>Delivery Area : </b> <?php echo $_GET['area_locality']; ?><br>
       <b>Delivery City : </b> <?php echo $_GET['city']; ?>
       <br><b>Delivery Time :</b> MORNING<br>
      </p>
     </td>
    </tr>
   </table>
   <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 12px;">
    <tr>
     <th>
      <h2>Subscription Delivery Sheet</h2>
     </th>
    </tr>
   </table>
   <table style="width: 100%;font-size: 12px;">
    <tr>
     <th style="width: 5%;">#</th>
     <th style="width: 30%;">Name & Address</th>
     <th style="width: 30%;">Item Name</th>
     <th style="width: 10%;">Quantity</th>
     <th style="width: 15%;">Payments Details</th>
     <th style="width: 10%;">Delivery Status</th>
    </tr>
    <div
     style="height:auto !important;display:inline-block !important; overflow:auto; position: static; box-shadow:0px 0px 1px grey; margin-top:1.5%;">
     <?php
          if (isset($_GET['export_orders'])) {
            $export_orders = $_GET['export_orders'];
            if ($export_orders == "true") {
              $city = $_GET['city'];
              $area_locality = $_GET['area_locality'];

              if ($city == "ALL_CITY") {
                $city = "";
              } else {
                $city = $_GET['city'];
              }

              if ($area_locality == "ALL_AREA_LOCALITY") {
                $area_locality = "";
              } else {
                $area_locality = $_GET['area_locality'];
              }

              $CheckSubscription = "SELECT * FROM customer_subscriptions, customers where customer_subscriptions.SUBSCRIPTION_STATUS='ACTIVE' and customer_subscriptions.customer_id=customers.customer_id and customer_subscriptions.delivery_address like '%$city%' and customer_subscriptions.delivery_address like '%$area_locality%'";
              $QueryForSubscription = mysqli_query($con, $CheckSubscription);
              $CountSubscription = mysqli_num_rows($QueryForSubscription);
              if ($CountSubscription == 0) {
                $SubscriptionPayments = "";
              } else {
                $count = 0;
                while ($FetchSubscription = mysqli_fetch_assoc($QueryForSubscription)) {
                  $customer_subscription_id = $FetchSubscription['customer_subscription_id'];
                  $customer_name = $FetchSubscription['customer_name'];
                  $delivery_address = $FetchSubscription['delivery_address'];
                  $customer_phone_number = $FetchSubscription['customer_phone_number'];
                  $alternatenumber = $FetchSubscription['alternatenumber'];

                  $SelectSubscriptionProducts = "SELECT * FROM subscription_products where customer_subscription_id='$customer_subscription_id'";
                  $QueryForSubscriptionProducts = mysqli_query($con, $SelectSubscriptionProducts);
                  $CountProducts = mysqli_num_rows($QueryForSubscriptionProducts);


                  if ($CountProducts == 0) {
                    echo "<tr>
           <td colspan='7'><h2>No Subscription Available!</h2></td>
        </tr>";
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
                    $net_payable_amount = $product_total_price_subs;
                    $count++;
                    $SubscriptionPayments = "<b>Subscription Payments</b><br>Monthly Billings<br>";

                    echo "<tr>
       <td>$count</td>
       <td><b>ID: $customer_subscription_id</b><br>$customer_name<br>
       $delivery_address<br>
       <b>Phone:</b> $customer_phone_number, $alternatenumber
       </td>
       <td>$product_name_subs ($product_tags_subs)</td>
       <td>x $QuantitySubs</td>
       <td>Monthly Billings</td>
       <td></td>
    </tr>";
                  }
                }
              }
            }
          }
          ?>
     <tr>
      <td colspan="3" align="right"><b>Total Qauntity</b></td>
      <td colspan="4" align="left"><?php
                                          $select = "SELECT sum(product_quantity) FROM subscription_products, customer_subscriptions where subscription_products.customer_subscription_id=customer_subscriptions.customer_subscription_id and customer_subscriptions.SUBSCRIPTION_STATUS='ACTIVE' and customer_subscriptions.delivery_address LIKE '%$city%' and customer_subscriptions.delivery_address like '%$area_locality%'";
                                          $action = mysqli_query($con, $select);
                                          while ($record = mysqli_fetch_array($action)) {
                                            $total_amount = $record['sum(product_quantity)'];
                                          }

                                          if ($total_amount == 0) {
                                            echo "0 KG";
                                          } else {
                                            echo $total_amount;
                                          }
                                          ?> <?php echo $QuantityNames; ?></td>
     </tr>
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