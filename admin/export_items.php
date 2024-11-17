<html>

<head>
 <title>
  Stock_Purchase_Sheet_<?php echo $_GET['order_date']; ?>
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

table tr td {
 padding: 0.5%;
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
 <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 12px;">
  <tr>
   <td style="width: 150px;">
    <img src="<?php echo $store_profile_img; ?>" style="width: 100%;">
   </td>
   <td>
    <p><span style="font-size: 13px;"><b><?php echo $store_name; ?></b></span><br>
     Address: <?php echo "$store_address, $store_arealocality, $store_city, $store_state - $store_pincode"; ?><br>
     Phone : <?php echo $store_phone; ?> <br>
     Mail ID: <?php echo $store_mail_id; ?><br>
     GST : <?php echo $store_gst; ?> <br>
     PAN : <?php echo $store_pan; ?>
    </p>
   </td>
   <td>
    <p><b>Delivery Date :</b> <?php $date = $_GET['order_date'];
                                  echo date("d M, Y", strtotime($date . ' +1 day')); ?><br>
     <b>Order Date:</b> <?php echo $_GET['order_date']; ?><br>
     <b>Delivery City :</b> <?php echo $_GET['city']; ?>
     <br><b>Delivery Time : </b> Morning 6:00 AM to 9:00 AM
     <br><b>Order Date : </b><?php echo $_GET['order_date']; ?>
    </p>
   </td>
  </tr>
 </table>
 <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 12px;">
  <tr>
   <th>STOCK PRUCHASE SHEET for Order Date <?php echo $_GET['order_date']; ?></th>
  </tr>
 </table>
 <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 14px;">
  <tr align="left">
   <th>Image</th>
   <th>Product Name</th>
   <th>Required Quantity</th>
   <th>Purchase Quantity</th>
   <th>Market Price Per Unit</th>
   <th>Total Price</th>
  </tr>
  <?php
    if (isset($_GET['export_orders'])) {
      $export_orders = $_GET['export_orders'];

      if ($export_orders == "true") {
        $city = $_GET['city'];
        $order_date = $_GET['order_date'];

        if ($_GET['order_date'] == "ALL_STOCK") {
          $order_date = "";
        } else {
          $order_date = $order_date;
        }

        if ($city == "ALL_CITY" and $order_date == "") {
          $sql = "SELECT * from customer_orders, customers where customer_orders.customer_id=customers.customer_id and customer_orders.order_status='ACCEPTED'";
        } else {
          $city = $_GET['city'];
          $sql = "SELECT * from customer_orders, customers where customer_orders.customer_id=customers.customer_id and customer_orders.order_status='ACCEPTED' and customer_orders.delivery_address LIKE '%$city%' and order_date like '%$order_date%'";
        }

        $sql = "SELECT * FROM ordered_products where item_status='false' and order_date like '%$order_date%' GROUP BY product_names ORDER BY product_names ASC";
        $query = mysqli_query($con, $sql);
        $count = mysqli_num_rows($query);
        if ($count == 0) {
          echo "<tr align='center'><td colspan='5'><h2>No Stock Purchase is Available.</h2></td></tr>";
        } else {

          while ($fetch = mysqli_fetch_assoc($query)) {
            $product_names = strtoupper($fetch['product_names']);
            $product_title[] = preg_replace('/[0-9]/', '', "$product_names");
          }

          foreach ($product_title as $PRODUCT_TITLE) {
            mysqli_set_charset($con, 'utf8');
            $sql = "SELECT * from ordered_products where product_names LIKE '%$PRODUCT_TITLE%' and item_status ='false' and order_date like '%$order_date%' ORDER BY product_names ASC";
            $query = mysqli_query($con, $sql);
            $fetch = mysqli_fetch_assoc($query);
            $product_tags = $fetch['product_tags'];
            $product_qty = $fetch['product_qty'];
            $hindi_name = $fetch['hindi_name'];
            $product_img = $fetch['product_img'];

            $select = "SELECT sum(product_qty) FROM ordered_products where item_status='false' and order_date like '%$order_date%'and product_names like '%$PRODUCT_TITLE%'";
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
              $letterss = "KG";
            } else {
              $Quantity = $Quantity;
              $letterss = $letters;
            }


            echo "<tr>
            <td><img src='img/store_img/$product_img' style='width:30px;'></td>
            <td> $PRODUCT_TITLE - $hindi_name</td>
            <td>$Quantity $letterss</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>";
          }
        }
      }
    } else {
      echo "<center><h4>Invalid Export Data</h4>
    <a href='items.php'>Go Back</a></center>";
    }

    ?>
 </table>