<?php
session_start();
session_destroy();
if (isset($_GET['n'])) {
  $n = $_GET['n'];
} else {
  $n = "";
}
if (isset($_COOKIE['customer_id']) and isset($_COOKIE['store_id'])) {
  $customer_id = $_COOKIE['customer_id'];
  $store_id = $_COOKIE['store_id'];

  setcookie('customer_id', $customer_id, time()-60*60*365);
  setcookie('store_id', $customer_id, time()-60*60*365);
  header("location: index.php?msg=Dear $n , Your are Logout Successfully!");
} else {
	header("location: cart.php");
}


?>
