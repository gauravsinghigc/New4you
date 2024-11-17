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

table tr td {
 padding: 1%;
 box-shadow: 0px 0px 1px grey;
}
</style>
<?php
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
   <p><b>Purchase Date:</b> <?php echo date("D d M, Y"); ?></p>
  </td>
 </tr>
</table>
<table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 12px;">
 <tr>
  <th>STOCK PRUCHASED SHEET - <?php echo date("D d M, Y"); ?></th>
 </tr>
</table>
<table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 13px;">
 <tr align="left">
  <th>S.no</th>
  <th>Item Name</th>
  <th>Mandi Price</th>
  <th>Quantity</th>
  <th>Total Price</th>
 </tr>
 <?php
  if (isset($_GET['FILTER_VIEW'])) {
    $sql = "SELECT * FROM stock_purchase ORDER BY purchase_date DESC";
  } else {
    $sql = "SELECT * FROM stock_purchase ORDER BY purchase_date DESC";
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
</tr>

  ";
  }

  if (isset($_GET['FILTER_VIEW'])) {


    $select = "SELECT sum(total_price) FROM stock_purchase";
    $action = mysqli_query($con, $select);
    while ($record = mysqli_fetch_array($action)) {
      $product_total_amount = $record['sum(total_price)'];
    }
  } else {

    $select = "SELECT sum(total_price) FROM stock_purchase";
    $action = mysqli_query($con, $select);
    while ($record = mysqli_fetch_array($action)) {
      $product_total_amount = $record['sum(total_price)'];
    }
  }

  echo "<tr>
<td colspan='4' align='right'><b>Total Amount</b></td>
  <td colspan='1' align='left'><b>Rs.$product_total_amount</b></td>
</tr>";
  ?>
</table>