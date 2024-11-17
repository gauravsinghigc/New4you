<?php
session_start();
require 'files.php';

if (isset($_GET['login_logs'])) {
	$user_id = $_SESSION['user_id'];
	$sql = "DELETE from login_logs where user_id='$user_id'";
	$query = mysqli_query($con, $sql);
	if ($query == true) {
		header("location: logins.php?msg=Login Logs Deleted!");
	} else {
		header("location: logins.php?err=Unable to Delete Login Logs");
	}
} elseif (isset($_GET['delete_product'])) {
	$user_product_id = $_GET['delete_product'];
	$File = $_GET['file'];
	$sql = "DELETE FROM user_products where user_product_id='$user_product_id'";
	$query = mysqli_query($con, $sql);
	if ($query == true) {
		$Location = "img/store_img/pro_img/$File";
		unlink($Location);
		header("location: stock.php?t=success&m=Deleted&a=Product Deleted Successfully!");
	} else {
		header("location: stock.php?t=danger&m=Failed&a=Failed to Delete!");
	}
} elseif (isset($_GET['delete_cart'])) {
	$cart_id = $_GET['delete_cart'];
	$sql = "DELETE FROM customer_cart where cart_id='$cart_id'";
	$query =  mysqli_query($con, $sql);
	if ($query == true) {
		header("location: order_products.php?t=success&m=Deleted&a=Product Deleted Successfully!");
	} else {
		header("location: order_products.php?t=danger&m=Failed&a=Failed to Delete!");
	}
} elseif (isset($_GET['empty_cart'])) {
	$customer_id = $_SESSION['customer_id'];
	$sql = "DELETE from customer_cart where customer_id='$customer_id'";
	$query = mysqli_query($con, $sql);
	if ($query == true) {
		session_destroy();
		header("location: index.php");
	} else {
		header("location: index.php?err=");
	}
} elseif (isset($_GET['delete_slider'])) {
	$slider_id = $_GET['delete_slider'];
	$File = $_GET['file'];
	$sql = "DELETE from slider where slider_id='$slider_id'";
	$query = mysqli_query($con, $sql);
	if ($query == true) {
		$Location = "img/store_img/slider/$File";
		unlink($Location);
		header("location: slider.php?t=success&m=Deleted&a=Slide Deleted");
	} else {
		header("location: slider.php?t=danger&m=Failed&a=Unable to Delete Slide");
	}
} elseif (isset($_GET['delete_city'])) {
	$city_id = $_GET['delete_city'];
	$sql = "DELETE FROM city where city_id='$city_id'";
	$query = mysqli_query($con, $sql);
	if ($query == true) {
		header("location: cities.php?t=success&m=Deleted&a=City Deleted!");
	} else {
		header("location: cities.php?t=danger&m=failed&a=Unable to Delete!");
	}
} elseif (isset($_GET['delete_state'])) {
	$state_id = $_GET['delete_state'];
	$SQL = "DELETE from state where state_id='$state_id'";
	$query = mysqli_query($con, $SQL);
	if ($query == true) {
		header("location: states.php?t=success&m=Deleted&a=State Deleted!");
	} else {
		header("location: states.php?t=danger&m=Failed&a=Please inactive the State First!");
	}
} elseif (isset($_GET['delete_area'])) {
	$area_id = $_GET['delete_area'];
	$sql = "DELETE FROM services_area where area_id='$area_id' ";
	$query = mysqli_query($con, $sql);
	if ($query == true) {
		header("location: areas.php?t=success&m=Deleted&a=Service Area Deleted!");
	} else {
		header("location: areas.php?t=danger&m=Failed&a=Please Inactive the Service Area first!");
	}
} elseif (isset($_GET['delete_cat'])) {
	$product_cat_id = $_GET['delete_cat'];
	$DeleteCategory = "DELETE FROM product_categories where product_cat_id='$product_cat_id'";
	$Deletequery = mysqli_query($con, $DeleteCategory);
	if ($Deletequery == true) {
		header("location: categories.php?t=info&m=Deleted&a=Product Category Deleted!");
	} else {
		header("location: categories.php?t=danger&m=FAILED&a=Please Inactive the Category first!");
	}
} elseif (isset($_GET['delete_sub_cat'])) {
	$sub_cat_id = $_GET['delete_sub_cat'];
	$DeleteSubCategory = "DELETE from product_sub_categories where sub_cat_id='$sub_cat_id' ";
	$Deletequery = mysqli_query($con, $DeleteSubCategory);
	if ($Deletequery == true) {
		header("location: sub_categories.php?t=info&m=Deleted&a=Product Sub Category Deleted!");
	} else {
		header("location: sub_categories.php?t=danger&m=failed&a=Please Inactive Sub Category FIRST!");
	}
} elseif (isset($_GET['delete_brand'])) {
	$brand_id = $_GET['delete_brand'];
	$DeleteBrand = "DELETE FROM pro_brands where brand_id='$brand_id'";
	$Deletequery = mysqli_query($con, $DeleteBrand);
	if ($Deletequery == true) {
		header("location: brands.php?t=info&m=Deleted&a=Brand Deleted Successfully!");
	} else {
		header("location: brands.php?t=danger&m=Failed&a=Unable to Delete Brand!");
	}
} elseif (isset($_GET['UserTypes'])) {
	$user_type_id = $_GET['UserTypes'];
	$DELETE = "DELETE FROM user_types where user_type_id='$user_type_id'";
	$query = mysqli_query($con, $DELETE);
	if ($query == true) {
		header("location: user_types.php?t=info&m=Deleted&a=User Type Deleted Successfully!");
	} else {
		header("location: user_types.php?t=danger&m=Failed&a=Unable to Delete User Type!");
	}
} elseif (isset($_GET['delete_user_documents'])) {
	$document_id = $_GET['delete_user_documents'];
	$name = $_GET['name'];
	$DELETE = "DELETE FROM user_documents_types where document_id='$document_id'";
	$query = mysqli_query($con, $DELETE);
	if ($query == true) {
		header("location: document_types.php?t=info&m=Deleted&a=$name Deleted Successfully!");
	} else {
		header("location: document_types.php?t=danger&m=Failed&a=Unable to Delete $name!");
	}
} elseif (isset($_GET['delete'])) {
	$table = $_GET['delete'];
	$data = $_GET['data'];
	$id = $_GET['id'];
	$cr_url = $_GET['cr_url'];
	$name = $_GET['name'];

	$DELETE = "DELETE FROM $table where $data='$id'";
	$query = mysqli_query($con, $DELETE);
	if($query == true){
		header("location: $cr_url?msg=$name deleted Successfully!");
	} else {
		header("location: $cr_url?err=Unable to delete $name");
	}
} else {
	header("location: error.php?err=invalid_delete_request : The request you are trying to get archive is not valid request for Deletion of Data, due no data avaibility. contact to administrator now.");
}