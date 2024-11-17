<?php
session_start();
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$checkSum = "";
$paramList = array();

$ORDER_ID = $_POST["ORDER_ID"];
$CUST_ID = $_POST["CUST_ID"];
$INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
$CHANNEL_ID = $_POST["CHANNEL_ID"];
$TXN_AMOUNT = $_POST["TXN_AMOUNT"];
$EMAIL = $_POST['email_id'];
$MSISDN = $_POST['phone_number'];
$_SESSION['CUSTOMER_ID'] = $_POST['CUSTOMER_ID'];
$CUSTOMER_ID = $_POST['CUSTOMER_ID'];

       $delivery_address = $_SESSION['delivery_address'];
       $payment_mode = $_SESSION['payment_mode'];
       $payment_amount = $_SESSION['net_payable_amount'];
       $product_total_amount_whole = $_SESSION['product_total_amount_entry'];
       $coupon_code = $_SESSION['coupon_code'];
       $total_amount_after_discount =  $_SESSION['total_amount_after_discount'];
       $delivery_charge = $_SESSION['delivery_charge'];
       $order_id = $_SESSION['order_id'];
       $store_id = $_SESSION['store_id'];
       $DELIVERY_TYPE = $_SESSION['DELIVERY_TYPE'];
       $PICK_SCHEDULE_TIME = $_SESSION['PICK_SCHEDULE_TIME'];

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"] = "http://192.168.43.14/projects/24Kharido/website/pgResponse.php?response=$CUSTOMER_ID&delivery_address=$delivery_address&payment_mode=$payment_mode&payment_amount=$payment_amount&product_total_amount_whole=$product_total_amount_whole&coupon_code=$coupon_code&total_amount_after_discount=$total_amount_after_discount&delivery_charge=$delivery_charge&order_id=$order_id&store_id=$store_id&DELIVERY_TYPE=$DELIVERY_TYPE&PICK_SCHEDULE_TIME=$PICK_SCHEDULE_TIME";
$paramList["EMAIL"] = $EMAIL; //Email ID of customer
$paramList["MSISDN"] = $MSISDN; //Mobile number of customer

/*



$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //

*/

//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

?>
<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
	<center><h1>Please do not refresh this page...</h1></center>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
</body>
</html>
