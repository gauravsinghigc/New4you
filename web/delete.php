<?php
require 'files.php';

if (isset($_GET['delete_address'])) {
	$address_id= $_GET['delete_address'];
	$sql = " DELETE FROM customer_address where customer_address_id='$address_id' and customer_id='$customer_id' and status='inactive'";
	$query = mysqli_query($con, $sql);
	if ($query == true) {
		header("location: address.php?data=Address Deleted!");
	} else {
		header("location: address.php?err=Unable to Delete Address");
	}
} elseif (isset($_GET['delete_cart'])) {
	$cart_id = $_GET['delete_cart'];
	$sql = "DELETE FROM customer_cart where cart_id='$cart_id'";
	$query =  mysqli_query($con, $sql);
	if ($query == true) {
		header("location: cart.php?data=Item Deleted From Cart");
	} else {
		header("location: cart.php?err=Enable to Delete!");
	}
} elseif(isset($_GET['empty_cart'])){
 $customer_id = 	$_SESSION['customer_id'];
 $sql = "DELETE from customer_cart where customer_id='$customer_id'";
 $query =mysqli_query($con, $sql);
 if ($query == true) {
 	session_destroy();
 	header("location: index.php");
 } else {
 	header("location: index.php?err=");
 }
}