<?php
require 'files.php';

if (isset($_GET['delete_address'])) {
	$address_id= $_GET['delete_address'];
	$customer_id = $_SESSION['customer_id'];
	$sql = " DELETE FROM customer_address where customer_address_id='$address_id' and customer_id='$customer_id' and status='inactive'";
	$query = mysqli_query($con, $sql);
	if ($query == true) {
		header("location: address.php?msg=Address Deleted!");
	} else {
		header("location: address.php?msg=Unable to Delete Address");
	}
} elseif (isset($_GET['delete_cart'])) {
	$cart_id = $_GET['delete_cart'];
	$sql = "DELETE FROM customer_cart where cart_id='$cart_id'";
	$query =  mysqli_query($con, $sql);
	if ($query == true) {
		header("location: cart.php?msg=Item Deleted From Cart");
	} else {
		header("location: cart.php?msg=Enable to Delete!");
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
} elseif(isset($_GET['delete_subs_items'])){
		$id = $_GET['delete_subs_items'];

		$sql = "DELETE from subscription_cart where subs_refrenece_id='$id'";
		$query =  mysqli_query($con, $sql);
		if($query == true){
			header("location: subscribe.php?msg=Item Deleted from Cart");
		} else {
			header("location: subscribe.phpmsg=Unable to Delete Items from Cart");
		}
} elseif (isset($_GET['subs_items_delete'])) {
	$del_id = $_GET['subs_items_delete'];
	$id = $_GET['id'];
	$sql = "DELETE from subscription_products where subs_refrenece_id='$del_id'";
	$query =  mysqli_query($con, $sql);
	if($query == true){
		header("location: subs_details.php?id=$id&note=Subscription Add On Item is Deleted!");
	} else {
		header("location: subs_details.php?id=$id&note=Unable to Delete Add On Items!");
	}
}
