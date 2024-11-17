<?php
require 'files.php'; require 'include.php';
if (isset($_POST['update_cart'])) {
	$cart_id = $_POST['update_cart'];
	$value = $_POST['value'];
	$sql = "SELECT * from customer_cart where cart_id='$cart_id'";
	$query = mysqli_query($con, $sql);
	$fetch=mysqli_fetch_assoc($query);

	$product_price=$fetch['product_price'];
	$new_amount = $value*$product_price;
	$sql = "UPDATE customer_cart SET product_quantity='$value', product_total_amount='$new_amount' where cart_id='$cart_id'";
	$query = mysqli_query($con, $sql);
	if ($query == true) {
		header("location: cart.php?data=Cart Quantity updated");
	} else {
		header("location: cart.php?err=failed to Update Qty");
	}
} elseif (isset($_GET['active_address'])) {
	$address_id = $_GET['active_address'];
	$sql = "UPDATE customer_address SET status='active' where customer_address_id='$address_id' and customer_id='$customer_id'";
	$query = mysqli_query($con, $sql);
	if ($query == true) {
		$sql = "UPDATE customer_address SET status='inactive' where customer_address_id!='$address_id' and customer_id='$customer_id'";
		$query =  mysqli_query($con, $sql);
		if ($query == true) {
			header("location: address.php?data=Default Address Changed!");
		} else {
			header("location: address.php?err=Unable to Change Default Address!");
		}
	} else {
		header("location: address.php?err=Unable to Change Address!");
	}
}  elseif (isset($_POST['update_customer_address'])) {
	$customer_id = $_SESSION['customer_id'];
	$cr_url = $_POST['cr_url'];
	$street_address = $_POST['street_address'];
	$area_locality = $_POST['area_locality'];
	$customer_city = $_POST['customer_city'];
	$customer_state = $_POST['customer_state'];
	$address_pincode = $_POST['address_pincode'];
	$contact_person = $_POST['contact_person'];
	$alternate_phone = $_POST['alternate_phone'];

	$sql = "UPDATE customers SET custaddress='$street_address', arealocality='$area_locality', custcity='$customer_city', custstate='$customer_state', custpincode='$address_pincode', contactperson='$contact_person', alternatenumber='$alternate_phone' where customer_id='$customer_id'";
	$query =  mysqli_query($con, $sql);
	if ($query == true) {
			header("location: address.php?address_update=true");
	} else {
			header("location: address.php?address_update=false");
	}
} elseif (isset($_POST['DECREASE'])) {
	$cart_id = $_POST['cart_id'];
	$product_price = $_POST['product_price'];
	$quantity = $_POST['quantity'];
	$product_mrp = $_POST['product_mrp'];
	$cr_url = $_POST['cr_url'];

	$newqty = $quantity;
	$newqty--;

	if ($newqty == 0) {
			$newqty = 1;
	} else {
			$newqty = $newqty;
	}

	$new_price = $newqty*$product_price;
	$new_mrp = $newqty*$product_mrp;
	$sql = "UPDATE customer_cart SET product_quantity='$newqty', product_total_amount='$new_price', mrp_total='$new_mrp' where cart_id='$cart_id'";
	$query = mysqli_query($con, $sql);
	if ($query == true) {
			header("location: $cr_url");
	} else {
			header("location: $cr_url");
	}
} elseif (isset($_POST['INCREASE'])) {
	$cart_id = $_POST['cart_id'];
	$product_price = $_POST['product_price'];
	$quantity = $_POST['quantity'];
	$product_mrp = $_POST['product_mrp'];
	$cr_url = $_POST['cr_url'];

	$newqty = $quantity;
	$newqty++;

	$new_price = $newqty*$product_price;
	$new_mrp = $newqty*$product_mrp;
	$sql = "UPDATE customer_cart SET product_quantity='$newqty', product_total_amount='$new_price', mrp_total='$new_mrp' where cart_id='$cart_id'";
	$query = mysqli_query($con, $sql);
	if ($query == true) {
			header("location: $cr_url");
	} else {
			header("location: $cr_url");
	}
} elseif(isset($_POST['Update_Password'])){
  $customer_id = $_SESSION['C_PHONE_NUMBER'];
  $pass_1 = $_POST['pass_1'];
  $pass_2 = $_POST['pass_2'];

  $sql = "SELECT * FROM customers where customer_phone_number='$customer_id'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  $customer_name = $fetch['customer_name'];
  $customer_mail_id = $fetch['customer_mail_id'];

  if($pass_1 == $pass_2){
    $sql = "UPDATE customers SET customer_password='$pass_1' where customer_phone_number='$customer_id'";
    $query = mysqli_query($con, $sql);
    if($query == true){
     SendMail(
             $Valid = "true",
             $Subject = "Account Password Changed",
             $Title = "Dear <b>$customer_name</b>",
             $CustomerMailId = "$customer_mail_id",
             $MAIL_MSG = "<p>Your account password is changed successfully.If this is done by you then please use latest password for future login.<br>If this is not done by then please reset your password as soon as possible.</p>"
    );
      header("location: changes.php?pass_update=true");
    }
  } else {
    header("location: changes.php?msg=Password Do Not Match!");
  }
}
?>
