<?php
session_start();
require 'config.php';
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg



//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";

$CUSTOMER_ID = $_SESSION['CUSTOMER_ID'];
$ORDER_ID = $_SESSION['ORDER_ID'];
$TXN_AMOUNT = $_SESSION['TXN_AMOUNT'];


if($TXN_AMOUNT >= 500){
	$FUND_VALUE = $TXN_AMOUNT;
} elseif ($TXN_AMOUNT >= 1000) {
	$FUND_VALUE = $TXN_AMOUNT+50;
} elseif ($TXN_AMOUNT >= 1500) {
	$FUND_VALUE = $TXN_AMOUNT+75;
} elseif ($TXN_AMOUNT >= 2000) {
	$FUND_VALUE = $TXN_AMOUNT+100;
} else {
	$FUND_VALUE = $TXN_AMOUNT + 100;
}


		$sql = "INSERT INTO walletfills (txnid, customer_id, txndate, fundstatus, txnamount, txnstatus, funds) VALUES ('$ORDER_ID', '$CUSTOMER_ID', CURRENT_TIMESTAMP, 'CREDIT', '$FUND_VALUE', 'SUCCESS', '$TXN_AMOUNT')";
		$query = mysqli_query($con, $sql);
		if($query == true){
			header("location: credit.php?status=true&fund=valid");
		} else {
			header("location: credit.php?status=false&fund=valid");
		}
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";

$CUSTOMER_ID = $_SESSION['CUSTOMER_ID'];
$ORDER_ID = $_SESSION['ORDER_ID'];
$TXN_AMOUNT = $_SESSION['TXN_AMOUNT'];

if($TXN_AMOUNT >= 500){
	$FUND_VALUE = $TXN_AMOUNT;
} elseif ($TXN_AMOUNT >= 1000) {
	$FUND_VALUE = $TXN_AMOUNT+50;
} elseif ($TXN_AMOUNT >= 1500) {
	$FUND_VALUE = $TXN_AMOUNT+75;
} elseif ($TXN_AMOUNT >= 2000) {
	$FUND_VALUE = $TXN_AMOUNT+100;
} else {
	$FUND_VALUE = $TXN_AMOUNT + 100;
}

		$sql = "INSERT INTO walletfills (txnid, customer_id, txndate, fundstatus, txnamount, txnstatus, funds) VALUES ('$ORDER_ID', '$CUSTOMER_ID', CURRENT_TIMESTAMP, 'CREDIT', '$FUND_VALUE', 'SUCCESS', '$TXN_AMOUNT')";
		$query = mysqli_query($con, $sql);
		if($query == true){
			header("location: credit.php?status=true&fund=invalid");
		} else {
			header("location: credit.php?status=false&fund=invalid");
		}

	}

	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>