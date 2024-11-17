<html>

<head>
 <title>
  Customer_Bill_<?php echo date("d M, Y"); ?>
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
$STORE_LOGO = "img/store_img/dp_img/$store_profile_img";
?>
<center>
 <button onclick="printPageArea('printableArea')"> Save & Print</button>
</center> <br>

<body style="width:21cm; margin-left:auto; margin-right:auto;height:auto;">
 <div id="printableArea">
  <?php
		if (isset($_GET['export_orders'])) {
			$export_orders = $_GET['export_orders'];
			if ($export_orders == "true") {
				$city = $_GET['city'];
				$area_locality = $_GET['area_locality'];
				$order_type = $_GET['order_type'];

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
					$sql = "SELECT * from customer_orders, customers where customer_orders.customer_id=customers.customer_id and customer_orders.order_status!='DELIVERED' and customer_orders.order_type LIKE '%$order_type%' and customer_orders.PICK_SCHEDULE_TIME LIKE '%$delivery_slot%'";
				} elseif ($city == "ALL_CITY" and $area_locality != "ALL_AREA_LOCALITY") {
					$city = $_GET['city'];
					$area_locality = $_GET['area_locality'];
					$sql = "SELECT * from customer_orders, customers where customer_orders.customer_id=customers.customer_id and customer_orders.order_status!='DELIVERED' and customer_orders.delivery_address LIKE '%$area_locality%' and customer_orders.order_type LIKE '%$order_type%' and customer_orders.PICK_SCHEDULE_TIME LIKE '%$delivery_slot%'";
				} elseif ($area_locality == "ALL_AREA_LOCALITY" and $city != "ALL_CITY") {
					$city = $_GET['city'];
					$area_locality = $_GET['area_locality'];
					$sql = "SELECT * from customer_orders, customers where customer_orders.customer_id=customers.customer_id and customer_orders.order_status!='DELIVERED' and customer_orders.delivery_address LIKE '%$city%' and customer_orders.order_type LIKE '%$order_type%' and customer_orders.PICK_SCHEDULE_TIME LIKE '%$delivery_slot%'";
				} else {
					$city = $_GET['city'];
					$area_locality = $_GET['area_locality'];
					$sql = "SELECT * from customer_orders, customers where customer_orders.customer_id=customers.customer_id and customer_orders.order_status!='DELIVERED' and customer_orders.delivery_address LIKE '%$city%' and customer_orders.delivery_address like '%$area_locality%' and customer_orders.order_type LIKE '%$order_type%' and customer_orders.PICK_SCHEDULE_TIME LIKE '%$delivery_slot%'";
				}
				$query = mysqli_query($con, $sql);
				$countData = mysqli_num_rows($query);
				if ($countData == 0) {
					echo "<tr><td colspan='4'><h2>No Orders</h2></td></tr>";
				} else {
					while ($fetch = mysqli_fetch_assoc($query)) {
						$order_id[] = $fetch['order_id'];
					}

					foreach ($order_id as $OID) {
						$sql = "SELECT * from customer_orders, customers where customer_orders.customer_id=customers.customer_id and customer_orders.order_id='$OID'";
						$query = mysqli_query($con, $sql);
						$fetch = mysqli_fetch_assoc($query);
						$customer_id = $fetch['customer_id'];
						$order_id = $fetch['order_id'];
						$customer_name = $fetch['customer_name'];
						$delivery_address = $fetch['delivery_address'];
						$customer_phone = $fetch['customer_phone_number'];
						$customer_alt_phone = $fetch['alternatenumber'];
						$net_payable_amount = $fetch['net_payable_amount'];
						$payment_status = $fetch['payment_status'];
						$total_amount = $fetch['total_amount'];
						$delivery_charge = $fetch['delivery_charge'];
						$net_payable_amount = $fetch['net_payable_amount'];
						$coupon_code = $fetch['coupon_code'];
						$rewardspoints = $fetch['rewardspoints'];
						$order_type = $fetch['order_type'];
						$PICK_SCHEDULE_TIME = $fetch['PICK_SCHEDULE_TIME'];

						$select = "SELECT sum(product_total_price) FROM ordered_products where order_id='$OID'";
						$action = mysqli_query($con, $select);
						while ($record = mysqli_fetch_array($action)) {
							$total_product_amount = $record['sum(product_total_price)'];
						}

		?>
  <div
   style="height:auto !important;display:inline-block !important; overflow:auto; position: static; box-shadow:0px 0px 1px grey; margin-top:1.5%;">
   <table style="width:100%;box-shadow: 0px 0px 1px grey;font-size: 12px;">
    <tr>
     <td><b>INV :</b> #<?php echo $order_id; ?></td>
     <td><b>Order Date :</b> <?php echo $fetch['order_date']; ?></td>
     <td><b>Delivery Date :</b> <?php echo date("D d M Y"); ?></td>
     <td><b>Order From :</b> <?php echo $order_type; ?></td>
     <td><b>Delivery Slot : </b><?php echo $PICK_SCHEDULE_TIME; ?></b></td>
    </tr>
   </table>
   <table style="width:100%;box-shadow: 0px 0px 1px grey;font-size: 12px;">
    <tr>
     <td style="width: 60%;">
      <table style="width: 100%;font-size: 12px;">
       <tr>
        <td style="width: 30%;">
         <img src="<?php echo $store_profile_img; ?>" style="width: 100%;">
        </td>
        <td style="width: 70%;">
         <p style="font-size: 12px;margin-bottom: 0px;margin-top: 0px;">
          <b>Store Address</b>
          <br>
          <b style="font-size: 14px;"><?php echo $store_name; ?></b><br>
          <?php echo "$store_address, $store_arealocality, $store_city, $store_state - $store_pincode"; ?><br>
          <?php echo $store_phone; ?>, <?php echo $store_mail_id; ?> <br>
          <b>GST :</b> <?php echo $store_gst; ?> <br>
          <b>PAN :</b> <?php echo $store_pan; ?>
         </p><br>
        </td>
       </tr>
      </table>
     </td>
     <td style="width: 40%;">
      <p style="font-size: 12px;">
       <b>Shipping & Billing Address</b>
       <br>
       <b style="font-size: 14px;"><?php echo $customer_name; ?></b><br>
       <?php echo $delivery_address; ?>, <br>
       <b>Phone:</b> <?php echo $customer_phone; ?><br>
       <b>Alt Phone:</b> <?php echo  $customer_alt_phone; ?><br><br>
      </p>
     </td>
    </tr>
   </table>
   <table style="width: 100%; font-size: 12px;box-shadow: 0px 0px 1px grey;text-align: right;">
    <tr>
     <th>S.No</th>
     <th>Item Name</th>
     <th>Market Price</th>
     <th>Price Per Unit</th>
     <th>Quantity</th>
     <th>Total Price</th>
    </tr>
    <?php
								mysqli_set_charset($con, 'utf8');
								$sql = "SELECT * FROM ordered_products where order_id='$OID'";
								$query = mysqli_query($con, $sql);
								$count = 0;
								while ($fetch = mysqli_fetch_assoc($query)) {
									$product_names = $fetch['product_names'];
									$product_tags = $fetch['product_tags'];
									$product_qty = $fetch['product_qty'];
									$product_mrp = $fetch['product_mrp'];
									$product_price = $fetch['product_price'];
									$product_total_price = $fetch['product_total_price'];
									$hindi_name = $fetch['hindi_name'];

									$product_units = "$product_tags";
									$letters = preg_replace('/[0-9]/', '', "$product_tags");
									$numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
									$Quantity = $product_qty / $numbers;
									$count++;
									echo "
                 <tr>
                   <td>$count</td>
                   <td>$product_names - $hindi_name</td>
                   <td>Rs.$product_mrp</td>
                   <td>Rs.$product_price / $product_tags</td>
                   <td>x $Quantity </td>
                   <td>Rs.$product_total_price</td>
                 </tr>
                  ";
								}
								?>

    <tr style="box-shadow: 0px 0px 1px grey;text-align: right;">
     <td colspan="5" style="text-align: right;">Total Price</td>
     <th>Rs.<?php echo $total_product_amount; ?></th>
    </tr>
    <tr style="box-shadow: 0px 0px 1px grey;text-align: right;">
     <td colspan="5" style="text-align: right;">Coupon & Reward Points</td>
     <th><?php echo $coupon_code; ?>
      <?php if ($coupon_code == "Not Available" or $coupon_code == null or $coupon_code == "NO Coupon Applied" or $coupon_code == "Not Redeemed" or $rewardspoints == "NA") {
											echo "";
										} else {
											echo "(-Rs.$rewardspoints)";
										}
										?>
     </th>
    </tr>
    <tr style="box-shadow: 0px 0px 1px grey;text-align: right;">
     <td colspan="5" style="text-align: right;">Delivery & Convenience Charge</td>
     <th><?php
													if ($delivery_charge == 0) {
														echo "Free";
													} else {
														echo "+ Rs.$delivery_charge";
													}
													?>
     </th>
    </tr>

    <tr style="box-shadow: 0px 0px 1px grey;text-align: right;">
     <td colspan="5" style="text-align: right;">Net Payable Amount</td>
     <th style="font-size: 17px;">Rs.<?php echo $net_payable_amount; ?>
     </th>
    </tr>
   </table>

   <table style="width: 100%; font-size: 12px;text-align: center;">
    <tr>
     <td>
      <p style="margin-top:1%;"><b>*</b> This is a computer generated Invoice No need of
       Signature.
      </p>
     </td>
    </tr>
   </table>
  </div>
  <hr style="border-style:dashed;margin-top: 2%;
    margin-bottom: 0.6%;">
  <?php }
				}
			} else {
				echo "<center><h4>Invalid Export Data</h4>
    <a href='export_orders.php'>Go Back</a></center>";
			}
		}
		?>

 </div>
</body>
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

</html>