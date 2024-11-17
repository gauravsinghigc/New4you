<head>
 <title>
  <?php echo $_GET['order_status']; ?>_<?php echo $_GET['order_date']; ?>_<?php echo $_GET['order_month']; ?>_<?php echo $_GET['order_year']; ?>_<?php echo $_GET['order_type']; ?>_<?php echo $_GET['city']; ?>_<?php echo date("D_d_M_Y_h_m_a"); ?>
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
<?php
session_start();
require 'config.php';
$user_id = $_SESSION['user_id'];
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

<body style="width:21cm; margin-left:auto; margin-right:auto;height:auto;">
 <center>
  <button onclick="window.print()"> Save & Print</button>
 </center> <br>
 <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 12px;">
  <tr>
   <td style="width: 150px;">
    <img src="<?php echo $store_profile_img; ?>" style="width: 100%;">
   </td>
   <td>
    <p style="font-size: 12px !important;"><span
      style="font-size: 14px !important;"><b><?php echo $store_name; ?></b></span><br>
     Address :
     <?php echo "$store_address, $store_arealocality, $store_city, $store_state - $store_pincode"; ?><br>
     Phone : <?php echo $store_phone; ?> <br>
     Mail ID : <?php echo $store_mail_id; ?><br>
     GST : <?php echo $store_gst; ?> <br>
     PAN : <?php echo $store_pan; ?>
    </p>
   </td>
  </tr>
 </table>
 <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 12px;">
  <tr>
   <th>
    <h2 style="font-size: 13px !important;margin-bottom: 0px;"><?php echo $_GET['order_status']; ?> Order Reports @
     <?php echo $_GET['order_date']; ?> <?php echo $_GET['order_month']; ?>, <?php echo $_GET['order_year']; ?></h2>
   </th>
  </tr>
 </table>
 <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 12px;">
  <thead>
   <tr>
    <th style="padding: 1%; font-size: 12px;">ORDER ID</th>
    <th style="padding: 1%; font-size: 12px;">Customer Name</th>
    <th style="padding: 1%; font-size: 12px;">Payment Mode</th>
    <th style="padding: 1%; font-size: 12px;">Coupon Code</th>
    <th class="text-center" style="padding: 1%; font-size: 12px;">
     Order Amount</th>
    <th class="hidden-xs" style="padding: 1%; font-size: 12px;">
     Payment Status</th>
    <th style="padding: 1%; font-size: 12px;">ORDER Date</th>
    <th style="padding: 1%; font-size: 12px;">Action</th>
   </tr>
  </thead>
  <?php
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * from stores where user_id='$user_id'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    $store_id = $fetch['store_id'];
    $store_phone = $fetch['store_phone'];
    $store_mail_id = $fetch['store_mail_id'];
    $store_name = $fetch['store_name'];

    if (isset($_GET['EXPORTS_ORDERS'])) {
      $order_type = $_GET['order_type'];
      $city = $_GET['city'];
      $area_locality = $_GET['area_locality'];
      $payment_mode = $_GET['payment_mode'];
      $coupon_code = $_GET['coupon_code'];
      $order_date = $_GET['order_date'];
      $order_month = $_GET['order_month'];
      $order_year = $_GET['order_year'];
      $order_status = $_GET['order_status'];
      if ($city == "ALL_CITY" and $order_type == "ALL_ORDERS" and $area_locality == "ALL_AREA_LOCALITY" and $payment_mode == "ALL_MODES" and $coupon_code == "ALL_ORDERS" and $order_date == "ALL_DATES" and $order_month == "ALL_MONTHS" and $order_year == "ALL_YEARS" and $_GET['order_status'] == "ALL_ORDERS") {
        $sql = "SELECT * FROM customer_orders, customers where customers.customer_id=customer_orders.customer_id";
      } else {
        $order_type = $_GET['order_type'];
        $city = $_GET['city'];
        $area_locality = $_GET['area_locality'];
        $payment_mode = $_GET['payment_mode'];
        $coupon_code = $_GET['coupon_code'];
        $order_date = $_GET['order_date'];
        $order_month = $_GET['order_month'];
        $order_year = $_GET['order_year'];

        if ($order_type == "ALL_ORDERS") {
          $order_type = "";
        }
        if ($city == "ALL_CITY") {
          $city = "";
        }
        if ($area_locality == "ALL_AREA_LOCALITY") {
          $area_locality = "";
        }
        if ($payment_mode == "ALL_MODES") {
          $payment_mode = "";
        }
        if ($coupon_code == "ALL_ORDERS") {
          $coupon_code = "";
        }
        if ($order_date == "ALL_DATES") {
          $order_date = "";
        }
        if ($order_month == "ALL_MONTHS") {
          $order_month = "";
        }
        if ($order_year == "ALL_YEARS") {
          $order_year = "";
        }
        $sql = "SELECT * FROM customer_orders, customers where customers.customer_id=customer_orders.customer_id and customer_orders.order_status='DELIVERED' and customer_orders.delivery_address LIKE '%$city%' and customer_orders.delivery_address LIKE '%$area_locality%' and customer_orders.payment_mode LIKE '%$payment_mode%' and customer_orders.coupon_code LIKE '%$coupon_code%' and customer_orders.order_day LIKE '%$order_date%' and customer_orders.order_month LIKE '%$order_month%' and customer_orders.order_year LIKE '%$order_year%' and customer_orders.order_type LIKE '%$order_type%'";
      }
    } else {
    }
    $query = mysqli_query($con, $sql);
    $count = mysqli_num_rows($query);
    if ($count == 0) {
      echo "<tr align='center'>
                                                        <td colspan='8'><h3><i class='fa fa-warning'></i><br></h3><h3>No Orders are Available!</h3>
                                                    </tr>";
    } else {
      while ($fetch = mysqli_fetch_assoc($query)) {
        $payment_mode = $fetch['payment_mode'];

        if ($payment_mode == "Online Payment") {
          $p_s = "";
        } elseif ($payment_mode == "Cash On Delivery") {
          $p_s = "p_s=Paid";
        }
    ?>
  <tr>
   <td style="padding: 1%; font-size: 12px;">
    <h4><a href="http://24kharido.in/invoice.php?id=<?php echo $fetch['order_id']; ?>" class='text-info'
      style="padding: 1%; font-size: 12px;"><?php echo $fetch['order_id']; ?></a>
    </h4>
   </td>
   <td style="padding: 1%; font-size: 12px;">
    <?php echo $fetch['customer_name']; ?></td>
   <td style="padding: 1%; font-size: 12px;">
    <?php echo $fetch['payment_mode']; ?></td>
   <td style="padding: 1%; font-size: 12px;">
    <?php echo $fetch['coupon_code']; ?></td>
   <td style="padding: 1%; font-size: 12px;" class="text-center">
    Rs.<?php echo $fetch['net_payable_amount']; ?></td>
   <td style="padding: 1%; font-size: 12px;" class="text-success">
    <?php echo $fetch['payment_status']; ?>
   <td style="padding: 1%; font-size: 12px;">
    <?php echo $fetch['order_date']; ?></td>
   <td style="padding: 1%; font-size: 12px;">
    <?php echo $fetch['order_status']; ?>
   </td>
  </tr>
  <?php }
    } ?>
  <tr>
   <td colspan="4"></td>
   <td>
    <h4 style="font-size: 13px !important;"><b><?php
                                                    $order_type = $_GET['order_type'];
                                                    $city = $_GET['city'];
                                                    $area_locality = $_GET['area_locality'];
                                                    $payment_mode = $_GET['payment_mode'];
                                                    $coupon_code = $_GET['coupon_code'];
                                                    $order_date = $_GET['order_date'];
                                                    $order_month = $_GET['order_month'];
                                                    $order_year = $_GET['order_year'];
                                                    $order_status = $_GET['order_status'];
                                                    if ($city == "ALL_CITY" and $order_type == "ALL_ORDERS" and $area_locality == "ALL_AREA_LOCALITY" and $payment_mode == "ALL_MODES" and $coupon_code == "ALL_ORDERS" and $order_date == "ALL_DATES" and $order_month == "ALL_MONTHS" and $order_year == "ALL_YEARS" and $_GET['order_status'] == "ALL_ORDERS") {
                                                      $sql = "SELECT sum(net_payable_amount) FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id ORDER BY customer_order_id DESC";
                                                    } else {
                                                      $order_type = $_GET['order_type'];
                                                      $city = $_GET['city'];
                                                      $area_locality = $_GET['area_locality'];
                                                      $payment_mode = $_GET['payment_mode'];
                                                      $coupon_code = $_GET['coupon_code'];
                                                      $order_date = $_GET['order_date'];
                                                      $order_month = $_GET['order_month'];
                                                      $order_year = $_GET['order_year'];
                                                      $order_status = $_GET['order_status'];

                                                      if ($order_type == "ALL_ORDERS") {
                                                        $order_type = "";
                                                      }
                                                      if ($city == "ALL_CITY") {
                                                        $city = "";
                                                      }
                                                      if ($area_locality == "ALL_AREA_LOCALITY") {
                                                        $area_locality = "";
                                                      }
                                                      if ($payment_mode == "ALL_MODES") {
                                                        $payment_mode = "";
                                                      }
                                                      if ($coupon_code == "ALL_ORDERS") {
                                                        $coupon_code = "";
                                                      }
                                                      if ($order_date == "ALL_DATES") {
                                                        $order_date = "";
                                                      }
                                                      if ($order_month == "ALL_MONTHS") {
                                                        $order_month = "";
                                                      }
                                                      if ($order_year == "ALL_YEARS") {
                                                        $order_year = "";
                                                      }
                                                      if ($order_status == "ALL_ORDERS") {
                                                        $order_status = "";
                                                      }

                                                      $sql = "SELECT sum(net_payable_amount) FROM customer_orders, customers where customers.customer_id=customer_orders.customer_id and customer_orders.order_status like '%$order_status%' and customer_orders.delivery_address LIKE '%$city%' and customer_orders.delivery_address LIKE '%$area_locality%' and customer_orders.payment_mode LIKE '%$payment_mode%' and customer_orders.coupon_code LIKE '%$coupon_code%' and customer_orders.order_day LIKE '%$order_date%' and customer_orders.order_month LIKE '%$order_month%' and customer_orders.order_year LIKE '%$order_year%' and customer_orders.order_type LIKE '%$order_type%' ORDER BY customer_order_id DESC";
                                                    }

                                                    $query = mysqli_query($con, $sql);
                                                    while ($record = mysqli_fetch_array($query)) {
                                                      $total_amount = $record['sum(net_payable_amount)'];
                                                    }

                                                    if ($total_amount == 0) {
                                                      echo "No Payment";
                                                    } else {
                                                      echo "Rs.$total_amount";
                                                    }
                                                    ?></b>
   </td>
   <td colspan="3"></td>
  </tr>
 </table>
</body>