<?php
session_start();
require 'files.php';

if (isset($_POST['UPDATE_PROFILE_IMG'])) {
  $user_id = $_POST['user_id'];
  $cr_url = $_POST['cr_url'];
  $userimg = $_FILES['userimg']['name'];
  $tmp_name = $_FILES['userimg']['tmp_name'];
  $dir      = "USER_DATA/userimg/";
  move_uploaded_file($_FILES['userimg']['tmp_name'], $dir . $userimg);
  $userimgsave = $dir . $userimg;

  $sql = "UPDATE users SET user_img='$userimgsave' where user_id='$user_id'";
  $query =  mysqli_query($con, $sql);
  if ($query == true) {
    header("location: $cr_url?t=success&m=Saved&a=Profile Image Updated Successfully!");
  } else {
    header("location: $cr_url?t=warning&m=Failed&a=Unable to Save Profile Image");
  }
} elseif (isset($_POST['UPDATE_STORE_IMG'])) {
  $user_id = $_POST['user_id'];
  $cr_url = $_POST['cr_url'];
  $STORE_IMG = $_FILES['STORE_IMG']['name'];
  $tmp_name = $_FILES['STORE_IMG']['tmp_name'];
  $dir      = "img/store_img/dp_img/";
  move_uploaded_file($_FILES['STORE_IMG']['tmp_name'], $dir . $STORE_IMG);
  $userimgsave = $dir . $STORE_IMG;

  $sql = "UPDATE stores SET store_profile_img='$userimgsave' where user_id='$user_id'";

  $query =  mysqli_query($con, $sql);
  if ($query == true) {
    header("location: $cr_url?t=success&m=Saved&a=Profile Image Updated Successfully!");
  } else {
    header("location: $cr_url?t=warning&m=Failed&a=Unable to Save Profile Image");
  }
} elseif (isset($_POST['UPDATE_USERS'])) {
  $user_id = $_POST['user_id'];
  $cr_url = $_POST['cr_url'];
  $user_role = $_POST['user_type_id'];
  $full_name = $_POST['full_name'];
  $email_id = $_POST['email_id'];
  $phone_number = $_POST['phone_number'];
  $user_address = $_POST['user_address'];
  $user_arealocality = $_POST['user_arealocality'];
  $user_city = $_POST['user_city'];
  $user_state = $_POST['user_state'];
  $user_pincode = $_POST['user_pincode'];
  $DateTime = date("d M Y");
  $user_status = $_POST['user_status'];
  $user_verification = $_POST['user_verification'];


  $sql = "UPDATE users SET
   full_name='$full_name', email_id='$email_id', phone_number='$phone_number', user_address='$user_address', user_arealocality='$user_arealocality', user_city='$user_city', user_state='$user_state', user_pincode='$user_pincode', update_date='$DateTime', user_status='$user_status', user_role='$user_role',
   user_verification='$user_verification' where user_id='$user_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: $cr_url?t=success&m=Updated&a=$full_name is Updated Successfully!");
  } else {
    header("location: $cr_url?t=warning&m=Failed&a=Unable to Update $full_name");
  }
} elseif (isset($_POST['UPDATE_SETTINGS'])) {
  $user_id = $_POST['user_id'];
  $cr_url = $_POST['cr_url'];
  $cr_pass = $_POST['cr_pass'];
  $username = $_POST['username'];
  $cr_password = $_POST['cr_password'];
  $new_pass = $_POST['new_pass'];
  $new_pass_2 = $_POST['new_pass_2'];

  if ($cr_pass == $cr_password) {
    if ($new_pass == $new_pass_2) {
      $sql = "UPDATE users SET password='$new_pass_2', username='$username' where user_id='$user_id'";
      $query = mysqli_query($con, $sql);
      if ($query == true) {
        header("location: $cr_url?t=success&m=Updated&a=Password is Updated!");
      } else {
        header("location: $cr_url?t=danger&m=Failed&a=Password Update failed!");
      }
    } else {
      header("location: $cr_url?t=warning&m=Error&a=New Password Do Not Match!");
    }
  } else {
    header("location: $cr_url?t=warning&m=Failed&a=Incorrect Current Password!");
  }
} elseif (isset($_POST['UPDATE_STORE'])) {
  $cr_url = $_POST['cr_url'];
  $user_owner_id = $_POST['user_owner_id'];
  $store_name = $_POST['store_name'];
  $store_phone = $_POST['store_phone'];
  $store_mail_id = $_POST['store_mail_id'];
  $store_description = $_POST['store_description'];
  $store_address = $_POST['store_address'];
  $store_arealocality = $_POST['store_arealocality'];
  $store_city = $_POST['store_city'];
  $store_state = $_POST['store_state'];
  $store_pincode = $_POST['store_pincode'];
  $payment_use = $_POST['payment_use'];
  $domain_type = $_POST['domain_type'];
  $domain_avaibility = $_POST['domain_avaibility'];
  $domain = $_POST['domain'];
  $pg_mid = $_POST['pg_mid'];
  $pg_key = $_POST['pg_key'];
  $pg_web = $_POST['pg_web'];
  $pg_mode = $_POST['pg_mode'];
  $store_update_date = date("d M Y h:m a");
  $store_id = $_POST['store_id'];
  $GST = $_POST['GST'];
  $PAN = $_POST['PAN'];

  $sql = "UPDATE stores SET store_name='$store_name', store_phone='$store_phone', store_mail_id='$store_mail_id', store_description='$store_description', store_address='$store_address', store_arealocality='$store_arealocality', store_city='$store_city', store_state='$store_state', store_pincode='$store_pincode', store_update_date='$store_update_date', GST='$GST', PAN='$PAN' where user_id='$user_owner_id'";
  $query =  mysqli_query($con, $sql);
  if ($query == true) {
    $sql = "UPDATE store_domains SET domain_type='$domain_type', domain='$domain', domain_avaibility='$domain_avaibility' where store_id='$store_id'";
    $query = mysqli_query($con, $sql);
    if ($query == true) {
      $sql = "UPDATE payment_gateway SET pg_mode='$pg_mode', pg_mid='$pg_mid', pg_key='$pg_key', pg_web='$pg_web' where store_id='$store_id'";
      $query = mysqli_query($con, $sql);
      if ($query == true) {
        header("location: $cr_url?t=success&m=Updated&a=$store_name updated!");
      } else {
        header("location: $cr_url?t=danger&m=failed&a=Unable to Update $store_name");
      }
    }
  }
} elseif (isset($_GET['cat_id'])) {
  $product_cat_id = $_GET['cat_id'];
  $cat_title = $_GET['cat_title'];
  $value = $_GET['value'];
  if ($value == "active") {
    $status = "inactive";
  } elseif ($value == "inactive") {
    $status = "active";
  }
  $update_date = date("d M Y h:m A");
  $sql = "UPDATE product_categories SET product_cat_status='$status', product_cat_update_date='$update_date' where product_cat_id='$product_cat_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: categories.php?msg=$cat_title is $status now");
  } else {
    header("location: categories.php?err=Falied to $status $cat_title");
  }
} elseif (isset($_GET['sub_cat_id'])) {
  $sub_cat_id = $_GET['sub_cat_id'];
  $sub_cat_title = $_GET['sub_cat_title'];
  $value = $_GET['value'];
  if ($value == "active") {
    $status = "inactive";
  } elseif ($value == "inactive") {
    $status = "active";
  }
  $update_date = date("d M Y h:m A");
  $sql = "UPDATE product_sub_categories SET sub_cat_status='$status', sub_cat_update_date='$update_date' where sub_cat_id='$sub_cat_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: sub_categories.php?msg=$sub_cat_title is $status now");
  } else {
    header("location: sub_categories.php?err=Falied to $status $sub_cat_title");
  }
} elseif (isset($_GET['brand_status_update'])) {
  $brand_id = $_GET['brand_status_update'];
  $value = $_GET['value'];
  $brand_title = $_GET['brand_title'];
  $update_date = date("d M Y h:m A");
  if ($value == "active") {
    $status = "inactive";
  } elseif ($value == "inactive") {
    $status = "active";
  }
  $sql = "UPDATE pro_brands SET brand_status='$status', brand_update_date='$update_date' where brand_id='$brand_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: brands.php?msg=$brand_title is $status Now");
  } else {
    header("location: brands.php?msg=Unable to $status $brand_title");
  }
} elseif (isset($_POST['update_coupons'])) {
  $store_id = $_POST['store_id'];
  $coupon_code = $_POST['coupon_code'];
  $percentage = $_POST['percentage'];
  $sql = "UPDATE store_coupons SET coupon_code='$coupon_code', percentage='$percentage' where store_id='$store_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: coupon.php?msg=$coupon_code Update Successfully!");
  } else {
    header("location: coupon.php?msg=$coupon_code  Unbale to Udpate!");
  }
} elseif (isset($_POST['update_delivery_charges'])) {
  $store_id = $_POST['store_id'];
  $delivery_charge = $_POST['delivery_charge'];
  $est_delivery_amount = $_POST['est_delivery_amount'];

  $sql = "UPDATE delivery_charges SET delivery_charge='$delivery_charge', est_delivery_amount='$est_delivery_amount' where store_id='$store_id'";
  $query =  mysqli_query($con, $sql);
  if ($query == true) {
    header("location: delivery.php?msg=Delivery Charges Updated");
  } else {
    header("location: delivery.php?warning=Unable to Update Delivery Charges!");
  }
} elseif (isset($_GET['product_status_update'])) {
  $user_product_id = $_GET['product_status_update'];
  $value = $_GET['value'];
  $product_title = $_GET['product_title'];

  if ($value == "active") {
    $status = "inactive";
  } elseif ($value == "inactive") {
    $status = "active";
  }

  $sql = "UPDATE user_products SET product_status='$status' where user_product_id='$user_product_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: stock.php?t=success&m=Deleted&a=Product Updated Successfully!");
  } else {
    header("location: stock.php?t=danger&m=Deleted&a=Product Update Failed!");
  }
} elseif (isset($_POST['update_products'])) {
  $user_product_id = $_POST['user_product_id'];
  $product_cat_id = $_POST['product_cat_id'];
  $product_sub_cat_id = $_POST['product_sub_cat_id'];
  $product_brand_id = $_POST['product_brand_id'];
  $product_title = $_POST['product_title'];
  $ProductModalNo = $_POST['ProductModalNo'];
  $product_modal_for_seo = $_POST['product_modal_for_seo'];
  $ProductSizeCapacity = $_POST['ProductSizeCapacity'];
  $product_size_capacity_status = $_POST['product_size_capacity_status'];
  $unique_feature = $_POST['unique_feature'];
  $ProductEdition = $_POST['ProductEdition'];
  $product_edition_status = $_POST['product_edition_status'];
  $product_warranty_in_diff_time = $_POST['product_warranty_in_diff_time'];
  $product_warranty_in_break = $_POST['product_warranty_in_break'];
  $product_top_list_status = $_POST['product_top_list_status'];
  $product_measure_unit = $_POST['product_measure_unit'];
  $unit_type = $_POST['unit_type'];
  $product_offer_status = $_POST['product_offer_status'];
  $product_stock_in = $_POST['product_stock_in'];
  $product_stock_alert_on = $_POST['product_stock_alert_on'];
  $product_type = $_POST['product_type'];
  $product_offer_price = $_POST['product_offer_price'];
  $product_mrp_price = $_POST['product_mrp_price'];
  $product_save_amount = (int)$product_mrp_price - (int)$product_offer_price;
  $product_HSN = $_POST['product_HSN'];
  $products_taxes = $_POST['products_taxes'];
  $product_net_price = $_POST['product_net_price'];
  $product_return_policy_status = $_POST['product_return_policy_status'];
  $product_return_policy_charge_amount = $_POST['product_return_policy_charge_amount'];
  $product_return_time_in_days = $_POST['product_return_time_in_days'];
  $product_installation_charge_status = $_POST['product_installation_charge_status'];
  $product_installation_charge = $_POST['product_installation_charge'];
  $product_installation_charge_pincode_wise = $_POST['product_installation_charge_pincode_wise'];
  $product_delivery_charge_status = $_POST['product_delivery_charge_status'];
  $product_delivery_charge = $_POST['product_delivery_charge'];
  $product_delivery_charge_pincode_wise = $_POST['product_delivery_charge_pincode_wise'];
  $product_description = SECURE($_POST['product_description'], "e");
  $product_created_at = date("Y-m-d H:i:s");
  $product_status = $_POST['product_status'];
  $product_sort_by_order = $_POST['product_sort_by_order'];



  $Update = "UPDATE user_products SET 
  product_cat_id='$product_cat_id',
  product_sub_cat_id='$product_sub_cat_id', 
  product_brand_id='$product_brand_id',
    product_title='$product_title',
    ProductModalNo='$ProductModalNo', 
    product_modal_for_seo='$product_modal_for_seo', 
    ProductSizeCapacity='$ProductSizeCapacity',
    product_size_capacity_status='$product_size_capacity_status', 
    unique_feature='$unique_feature', 
    ProductEdition='$ProductEdition', 
    product_edition_status='$product_edition_status',
    product_warranty_in_diff_time='$product_warranty_in_diff_time', 
    product_warranty_in_break='$product_warranty_in_break', 
    product_top_list_status='$product_top_list_status',
    product_measure_unit='$product_measure_unit',
    unit_type='$unit_type',
    product_offer_price='$product_offer_price', 
    product_mrp_price='$product_mrp_price',
    product_save_amount='$product_save_amount', 
    product_HSN='$product_HSN', 
    products_taxes='$products_taxes', 
    product_net_price='$product_net_price',
    product_return_policy_status='$product_return_policy_status',
    product_return_policy_charge_amount='$product_return_policy_charge_amount',
    product_return_time_in_days='$product_return_time_in_days', 
    product_installation_charge_status='$product_installation_charge_status',
    product_installation_charge='$product_installation_charge', 
    product_delivery_charge_status='$product_delivery_charge_status',
    product_delivery_charge='$product_delivery_charge', 
    product_delivery_charge_pincode_wise='$product_delivery_charge_pincode_wise',
    product_description='$product_description', 
    product_created_at='$product_created_at', 
    product_status='$product_status',
    product_sort_by_order='$product_sort_by_order',
    product_stock_in='$product_stock_in',
    product_stock_alert_on='$product_stock_alert_on',
    product_installation_charge_pincode_wise='$product_installation_charge_pincode_wise',
    product_type='$product_type' where user_product_id='$user_product_id'";

  $query = mysqli_query($con, $Update);

  if ($query) {
    header("location: edit_product.php?t=success&m=Success&a=Successfully Added!");
  } else {
    header("location: edit_product.php?t=danger&m=Failed&a=Failed to Add!");
  }
} elseif (isset($_POST['update_payment_settings'])) {
  $store_id = $_POST['store_id'];
  $PAYTM_ENVIRONMENT = $_POST['PAYTM_ENVIRONMENT'];
  $PAYTM_MERCHANT_KEY = $_POST['PAYTM_MERCHANT_KEY'];
  $PAYTM_MERCHANT_MID = $_POST['PAYTM_MERCHANT_MID'];
  $PAYTM_MERCHANT_WEBSITE = $_POST['PAYTM_MERCHANT_WEBSITE'];

  $sql = "UPDATE payment_gateway SET PAYTM_ENVIRONMENT='$PAYTM_ENVIRONMENT', PAYTM_MERCHANT_KEY='$PAYTM_MERCHANT_KEY', PAYTM_MERCHANT_MID='$PAYTM_MERCHANT_MID', PAYTM_MERCHANT_WEBSITE='$PAYTM_MERCHANT_WEBSITE' where store_id='$store_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: pay_gate.php?msg=Payment Gateway Settings Updated!");
  } else {
    header("location: pay_gate.php?warning=Unable to Update Payment Gateway Settings");
  }
} elseif (isset($_POST['update_cart'])) {
  $cart_id = $_POST['update_cart'];
  $value = $_POST['value'];
  $sql = "SELECT * from customer_cart where cart_id='$cart_id'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);

  $product_price = $fetch['product_price'];
  $new_amount = $value * $product_price;
  $sql = "UPDATE customer_cart SET product_quantity='$value', product_total_amount='$new_amount' where cart_id='$cart_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: order_products.php?t=success&m=Updated&a=Product Quantity Updated!");
  } else {
    header("location: order_products.php?t=success&m=failed&a=Unab to Update!");
  }
} elseif (isset($_POST['DECREASE'])) {
  $cart_id = $_POST['cart_id'];
  $product_price = $_POST['product_price'];
  $quantity = $_POST['quantity'];
  $product_mrp = $_POST['product_mrp'];
  $product_taxes = $_POST['product_taxes'];
  $numbers = $_POST['numbers'];
  $priceq = $quantity / $numbers;
  $newqty = $quantity;

  if ($newqty == 0) {
    $newqty = $quantity;
  } else {
    $newqty = $newqty;
  }

  $new_price = $priceq * $product_price;
  $taxamount = round($new_price / 100 * $product_taxes);
  $new_net_price = $new_price + $taxamount;

  $new_mrp = $priceq * $product_mrp;
  $sql = "UPDATE customer_cart SET product_net_prices='$new_net_price', product_quantity='$newqty', product_total_amount='$new_price', mrp_total='$new_mrp' where cart_id='$cart_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: order_products.php");
  } else {
    header("location: order_products.php");
  }
} elseif (isset($_POST['INCREASE'])) {
  $cart_id = $_POST['cart_id'];
  $product_price = $_POST['product_price'];
  $quantity = $_POST['quantity'];
  $numbers = $_POST['numbers'];
  $product_mrp = $_POST['product_mrp'];
  $product_taxes = $_POST['product_taxes'];

  $priceq = $quantity / $numbers;
  $newqty = $quantity;

  $new_price = $priceq * $product_price;
  $taxamount = round($new_price / 100 * $product_taxes);
  $new_net_price = $new_price + $taxamount;

  $new_mrp = $priceq * $product_mrp;
  $sql = "UPDATE customer_cart SET product_net_prices='$new_net_price', product_quantity='$newqty', product_total_amount='$new_price', mrp_total='$new_mrp' where cart_id='$cart_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: order_products.php");
  } else {
    header("location: order_products.php");
  }
} elseif (isset($_GET['alert_action'])) {
  $status = $_GET['alert_action'];
  $cr_url = $_GET['cr_url'];
  $user_id = $_SESSION['user_id'];
  $sql = "UPDATE stores SET alert_status='$status' where user_id='$user_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: $cr_url?&alert_status=true");
  } else {
    header("location: $cr_url?&alert_status=false");
  }
} elseif (isset($_GET['accept_id'])) {
  $order_id = $_GET['accept_id'];
  $store_id = $_GET['store_id'];
  $cr_url = $_GET['cr_url'];
  $sql = "UPDATE customer_orders SET order_status='ACCEPTED', delivery_status='Yet Not Start' where store_id='$store_id' and order_id='$order_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: pickup_orders.php?t=success&a=Accepted&m=ORDER ID: $order_id is Accepted!");
  } else {
    header("location: pickup_orders.php?t=danger&a=Failed&m=Unable to Accept ORDER ID: $order_id");
  }
} elseif (isset($_GET['delivery_out'])) {
  $order_id = $_GET['delivery_out'];
  $store_id = $_GET['store_id'];

  $sql = "UPDATE customer_orders SET delivery_status='OUT_FOR_DELIVERY', order_status ='OUT_FOR_DELIVERY' where store_id='$store_id' and order_status='ACCEPTED'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: pickup_orders.php?msg= $order_id Out For Delivery!");
  } else {
    header("location: pickup_orders.php?warning= Unable to Update Delivery Status of $order_id");
  }
} elseif (isset($_GET['delivered'])) {
  $order_id = $_GET['delivered'];
  $store_id = $_GET['store_id'];
  $date_time = date("d M Y h:m");

  $sql = "UPDATE customer_orders SET delivery_status='DELIVERED', delivery_date='$date_time', order_status='DELIVERED' where store_id='$store_id' and order_id='$order_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {

    //get sms data
    $fetchdata = "SELECT * FROM customer_orders where order_id='$order_id'";
    $query = mysqli_query($con, $fetchdata);
    $fetchdata = mysqli_fetch_array($query);
    $customer_id = $fetchdata['order_id'];
    $net_payable_amount = $fetchdata['net_payable_amount'];

    $fetchc = "SELECT * FROM customers where customer_id='$customer_id'";
    $query2 = mysqli_query($con, $fetchc);
    $fetchc = mysqli_fetch_array($query2);
    $customer_name = $fetchc['customer_name'];
    $customer_phone_number = $fetchc['customer_phone_number'];

    //send sms
    $smsstatus = SEND_SMS(
      "38314e455734594f553234351658469066",
      "NEWFRU",
      "1",
      "$customer_phone_number",
      "Hi $customer_name, Thank you for shopping at new4you.in. You order with Rs.$net_payable_amount and order id: $order_id has been delivered. NEW4YOU&templateid=1507165580652860370",
      "1507165580652860370",
      "POST"
    );

    header("location: pickup_orders.php");
  } else {
    header("location: pickup_orders.php");
  }
} elseif (isset($_GET['reject_id'])) {
  $order_id = $_GET['reject_id'];
  $store_id = $_GET['store_id'];

  $sql = "UPDATE customer_orders SET order_status='REJECTED', delivery_status='REJECTED' where store_id='$store_id' and order_id='$order_id'";
  $query = mysqli_query($con, $sql);

  if ($query == true) {
    header("location: pickup_orders.php");
  } else {
    header("location: pickup_orders.php?warning= Unable to Update Delivery of $order_id");
  }
} elseif (isset($_POST['UPDATE_STOCK_PRICE'])) {
  /* This loop will iterate through all days.  */
  foreach ($_POST["USER_PRODUCT_ID"] as $key => $USER_PRODUCT_ID) {
    /* This loop will give start & end times for a particular day, i.e. $day */

    foreach ($USER_PRODUCT_ID as $timeIndex => $startTime) {
      $product_mrp_price = $_POST["product_mrp_price"][$key][$timeIndex];
      $Userproductid = $_POST['USER_PRODUCT_ID'][$key][$timeIndex];
      $product_offer_price = $_POST['product_offer_price'][$key][$timeIndex];
      $product_tags = $_POST['product_tags'][$key][$timeIndex];
      $sortby = $_POST['sortby'][$key][$timeIndex];
      $approx_weight = $_POST['approx_weight'][$key][$timeIndex];

      $UpdateStock = "UPDATE user_products SET product_offer_price='$product_offer_price', product_mrp_price='$product_mrp_price', product_tags='$product_tags', sortby='$sortby', approx_weight='$approx_weight' where user_product_id='$Userproductid'";
      $UpdateQuery = mysqli_query($con, $UpdateStock);
    }
  }

  if ($UpdateQuery == true) {
    header("location: stock_price.php?t=success&m=Updated&a=All Stock Prices are Updated Successfully!");
  } else {
    header("location: stock_price.php?t=danger&m=Failed&a=Unable to Update Stock Prices!");
  }
} elseif (isset($_POST['update_charges'])) {
  $delivery_charge_id = $_POST['delivery_charge_id'];
  $delivery_charge = $_POST['delivery_charge'];
  $est_delivery_amount = $_POST['est_delivery_amount'];
  $concharge = $_POST['concharge'];
  $Update = "UPDATE delivery_charges SET delivery_charge='$delivery_charge', est_delivery_amount='$est_delivery_amount', concharge='$concharge' where delivery_charge_id='$delivery_charge_id'";
  $query = mysqli_query($con, $Update);
  if ($query == true) {
    header("location: charges.php?t=success&m=Updated&a=Delivery Charges Updated and applied on next orders.");
  } else {
    header("location; charges.php?t=danger&m=failed&a=Delivery Charges are not Updated, Last Charges are running...");
  }
} elseif (isset($_GET['update_area'])) {
  $area_id = $_GET['update_area'];
  $area_status = $_GET['status'];
  if ($area_status == "active") {
    $new_status = "inactive";
  } else {
    $new_status = "active";
  }

  $UpdateArea = "UPDATE services_area SET area_status='$new_status' where area_id='$area_id'";
  $query = mysqli_query($con, $UpdateArea);
  if ($query == true) {
    header("location: areas.php?t=success&m=Updated&a=Service Area is Now $new_status");
  } else {
    header("location: areas.php?t=danger&m=failed&a=Unable to $new_status Serice Area");
  }
} elseif (isset($_GET['update_city'])) {
  $city_id = $_GET['update_city'];
  $city_status = $_GET['status'];
  if ($city_status == "active") {
    $new_status = "inactive";
  } else {
    $new_status = "active";
  }

  $UpdateArea = "UPDATE city SET city_status='$new_status' where city_id='$city_id'";
  $query = mysqli_query($con, $UpdateArea);
  if ($query == true) {
    header("location: cities.php?t=success&m=Updated&a=City is Now $new_status");
  } else {
    header("location: cities.php?t=danger&m=failed&a=Unable to $new_status City");
  }
} elseif (isset($_POST['UPDATE_ITEM_IMAGE'])) {
  $user_product_id = $_POST['user_product_id'];
  $dir = "img/store_img/pro_img/";
  $product_image = $_FILES['product_image']['name'];
  $tmp_name = $_FILES['product_image']['tmp_name'];
  move_uploaded_file($_FILES['product_image']['tmp_name'], $dir . $product_image);

  $Update = "UPDATE user_products SET product_image='$product_image' where user_product_id='$user_product_id'";
  $query = mysqli_query($con, $Update);
  if ($query == true) {
    header("location: edit_product.php?product_id=$user_product_id&t=success&m=Uploaded&a=Product Image Changed!");
  } else {
    header("location: edit_product.php?product_id=$user_product_id&t=danger&m=Failed&a=Unable to Update Image");
  }
} elseif (isset($_POST['UPDATE_WEB_TOOLS'])) {
  $tool_id = $_POST['UPDATE_WEB_TOOLS'];
  $VALUE = $_POST['VALUE'];
  $sql = "UPDATE web_tools SET VALUE='$VALUE' where tool_id='$tool_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: web_tools.php?t=success&m=Updated&a=Value of $NAME is Updated Successfully!");
  } else {
    header("location: web_tools.php?t=danger&m=FAILED&a=Unbale to Update Value of $NAME");
  }
} elseif (isset($_POST['UPDATE_CUSTOMER'])) {
  $customer_id = $_POST['customer_id'];
  $cr_url = $_POST['cr_url'];
  $store_id = $_POST['store_id'];
  $customer_name = $_POST['customer_name'];
  $customer_mail_id = $_POST['customer_mail_id'];
  $customer_phone_number = $_POST['customer_phone_number'];
  $custaddress = $_POST['custaddress'];
  $arealocality = $_POST['arealocality'];
  $custcity = $_POST['custcity'];
  $custstate = $_POST['custstate'];
  $custpincode = $_POST['custpincode'];
  $contactperson = $_POST['contactperson'];
  $alternatenumber = $_POST['alternatenumber'];
  $customer_password = $_POST['customer_password'];
  $customer_password_re = $_POST['customer_password_re'];
  $customer_status = $_POST['customer_status'];

  if ($customer_password == $customer_password_re) {
    $UpdateCustomer = "UPDATE customers SET customer_name='$customer_name', customer_phone_number='$customer_phone_number', customer_mail_id='$customer_mail_id', custaddress='$custaddress', arealocality='$arealocality', custcity='$custcity', custstate='$custstate', custpincode='$custpincode', contactperson='$contactperson', alternatenumber='$alternatenumber', customer_password='$customer_password', customer_status='$customer_status' where customer_id='$customer_id'";
    $UpdateQuery = mysqli_query($con, $UpdateCustomer);
    if ($UpdateQuery == true) {
      header("location: edit_customer.php?t=success&m=Updated&a=$customer_name, Profile Updated!");
    } else {
      header("location: edit_customer.php?t=danger&m=Failed&a=Unable to Update Profile $customer_name");
    }
  } else {
    header("location: edit_customer.php?t=warning&m=Failed&a=Password do not matched!");
  }
} elseif (isset($_GET['update_state'])) {
  $state_id = $_GET['update_state'];
  $state_status = $_GET['status'];
  if ($state_status == "active") {
    $new_status = "inactive";
  } else {
    $new_status = "active";
  }

  $UpdateArea = "UPDATE state SET state_status='$new_status' where state_id='$state_id'";
  $query = mysqli_query($con, $UpdateArea);
  if ($query == true) {
    header("location: states.php?t=success&m=Updated&a=State is Now $new_status");
  } else {
    header("location: states.php?t=danger&m=failed&a=Unable to $new_status State");
  }
} elseif (isset($_POST['UpdateArea'])) {
  $area_id = $_POST['UpdateArea'];
  $city_id = $_POST['city_id'];
  $area_locality = $_POST['area_locality'];
  $state_name = $_POST['state_name'];
  $Check = "SELECT * FROM services_area where area_locality='$area_locality'";
  $checkquery = mysqli_query($con, $Check);
  $countquery = mysqli_num_rows($checkquery);
  if ($countquery == 0) {
    $UpdateArea = "UPDATE services_area SET city_id='$city_id', area_locality='$area_locality', state_name='$state_name' where area_id='$area_id'";
    $UpdateQuery = mysqli_query($con, $UpdateArea);
    if ($UpdateQuery == true) {
      header("location: areas.php?t=success&m=Updated&a=$area_locality is Updated Successfully!");
    } else {
      header("location: areas.php?t=danger&m=Failed&a=Unable to Update $area_locality");
    }
  } else {
    header("location: areas.php?t=warning&m=Failed&a=$area_locality is Already Exits!");
  }
} elseif (isset($_POST['UpdateCategories'])) {
  $product_cat_id = $_POST['UpdateCategories'];
  $product_cat_title = $_POST['product_cat_title'];
  $category_img = $_FILES['category_img']['name'];
  $tmp_name = $_FILES['category_img']['tmp_name'];
  $updatedat = date("D d M, Y h:m: A");
  $sortby = $_POST['sortby'];

  if ($_FILES['category_img']['name'] == "") {
    $sql = "UPDATE product_categories SET product_cat_title='$product_cat_title', product_cat_update_date='$updatedat', sortby='$sortby'  where product_cat_id='$product_cat_id'";
  } else {
    $dir = "img/store_img/cat_img/";
    move_uploaded_file($_FILES['category_img']['tmp_name'], $dir . $category_img);
    $CategoryImage = $category_img;
    $sql = "UPDATE product_categories SET category_img='$CategoryImage', product_cat_title='$product_cat_title', product_cat_update_date='$updatedat', sortby='$sortby'  where product_cat_id='$product_cat_id'";
  }

  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: categories.php?t=success&m=Updated&a=$product_cat_title is Updated Successfully!");
  } else {
    header("location: categories.php?t=danger&m=Failed&a=Unable to update $product_cat_title!");
  }
} elseif (isset($_POST['UpdateSubCategories'])) {
  $sub_cat_id = $_POST['UpdateSubCategories'];
  $sub_cat_title = $_POST['sub_cat_title'];
  $product_cat_id = $_POST['product_cat_id'];
  $UpdateDate = date("D d M, Y h:m A");
  $subcatsortby = $_POST['subcatsortby'];
  $sub_cat_img = $_FILES['sub_cat_img_file']['name'];

  if ($_FILES['sub_cat_img_file']['name'] == null or $_FILES['sub_cat_img_file']['name'] == "") {
    $UpdateSubCategories = "UPDATE product_sub_categories SET product_cat_id='$product_cat_id', sub_cat_title='$sub_cat_title', sub_cat_update_date='$UpdateDate', subcatsortby='$subcatsortby' where sub_cat_id='$sub_cat_id'";
  } else {
    $dir = "img/store_img/sub_cat_img/";
    move_uploaded_file($_FILES['sub_cat_img_file']['tmp_name'], $dir . $sub_cat_img);
    $sub_cat_img_2 = "$dir" . $_FILES['sub_cat_img_file']['name'];
    $UpdateSubCategories = "UPDATE product_sub_categories SET product_cat_id='$product_cat_id', sub_cat_title='$sub_cat_title', sub_cat_update_date='$UpdateDate', subcatsortby='$subcatsortby', sub_cat_img='$sub_cat_img_2' where sub_cat_id='$sub_cat_id'";
  }

  $query = mysqli_query($con, $UpdateSubCategories);
  if ($query == true) {
    header("location: sub_categories.php?t=info&m=Updated&a=$sub_cat_title is Updated Successfully!");
  } else {
    header("location: sub_categories.php?t=danger&m=Failed&a=Failed to Update $sub_cat_title");
  }
} elseif (isset($_POST['UpdateBrand'])) {
  $brand_id = $_POST['UpdateBrand'];
  $brand_title = $_POST['brand_title'];
  $brand_update_date = date("D d M, Y");

  if ($_FILES['brand_img_file']['name'] == null or $_FILES['brand_img_file']['name'] == "") {
    $UpdateBrands = "UPDATE pro_brands SET brand_title='$brand_title', brand_update_date='$brand_update_date' where brand_id='$brand_id'";
  } else {
    $brand_img_file = $_FILES['brand_img_file']['name'];
    $dir = "img/store_img/brand_img";
    move_uploaded_file($_FILES['brand_img_file']['tmp_name'], $dir . "/" . $brand_img_file);
    $UpdateBrands = "UPDATE pro_brands SET brand_title='$brand_title', brand_update_date='$brand_update_date', brand_img='$dir/$brand_img_file' where brand_id='$brand_id'";
  }
  $query = mysqli_query($con, $UpdateBrands);
  if ($query == true) {
    header("location: brands.php?t=success&m=Update&a=$brand_title is updated Successfully!");
  } else {
    header("location: brands.php?t=danger&m=Failed&a=Unable to Update $brand_title");
  }
} elseif (isset($_GET['slider_status'])) {
  $slider_id = $_GET['slider_status'];
  $slider_status = $_GET['status'];
  if ($slider_status == "active") {
    $new_status = "inactive";
  } else {
    $new_status = "active";
  }
  $UpdateSliderStatus = "UPDATE slider set slider_status='$new_status' where slider_id='$slider_id'";
  $SliderStatusQuery = mysqli_query($con, $UpdateSliderStatus);
  if ($SliderStatusQuery == true) {
    header("location: slider.php?t=success&m=Updated&a=Slider is now $new_status");
  } else {
    header("location: slider.php?t=danger&m=Failed&a=Unable to update slider status");
  }
} elseif (isset($_GET['update_user_status'])) {
  $user_id = $_GET['update_user_status'];
  $value = $_GET['value'];
  $user_name = $_GET['user_name'];
  $update_date = date("d M Y h:m A");
  if ($value == "active") {
    $status = "Inactive";
  } elseif ($value == "Inactive") {
    $status = "active";
  }
  $sql = "UPDATE users SET user_status='$status', update_date='$update_date' where user_id='$user_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: users.php?msg=$user_name is $status Now");
  } else {
    header("location: users.php?msg=Unable to $status $user_name");
  }
} elseif (isset($_GET['update_doc_type'])) {
  $document_id = $_GET['update_doc_type'];
  $value = $_GET['value'];
  $update_date = date("d M Y h:m A");
  $name = $_GET['name'];
  if ($value == "active") {
    $status = "inactive";
  } elseif ($value == "inactive") {
    $status = "active";
  }
  $sql = "UPDATE user_documents_types SET doc_type_status='$status', update_date='$update_date' where document_id='$document_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: document_types.php?msg=$name is $status Now");
  } else {
    header("location: document_types.php?msg=Unable to $status $name");
  }
} elseif (isset($_POST['Update_User_Docs'])) {
  $document_id = $_POST['Update_User_Docs'];
  $document_name = $_POST['document_name'];
  $update_date = date("d M Y h:m A");
  $sql = "UPDATE user_documents_types SET document_name='$document_name', update_date='$update_date' where document_id='$document_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: document_types.php?msg=$document_name is updated Successfully!");
  } else {
    header("location: document_types.php?msg=Unable to Update $document_name");
  }
} elseif (isset($_GET['update_user_documents'])) {
  $user_documents_id = $_GET['update_user_documents'];
  $value = $_GET['value'];
  $update_date = date("d M Y h:m A");
  $name = $_GET['name'];
  if ($value == "verified") {
    $status = "unverified";
  } elseif ($value == "unverified") {
    $status = "verified";
  }
  $sql = "UPDATE user_documents SET document_status='$status', update_date='$update_date' where user_documents_id='$user_documents_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: user_documents.php?msg=$name is $status Now");
  } else {
    header("location: user_documents.php?msg=Unable to $status $name");
  }
} elseif (isset($_POST['UPDATESHARELINKS'])) {

  UPDATE_DATA(
    $table = "sharelinks",
    $tablerows = array("linktitle", "fafacode", "linkaltname", "linkstatus", "linkurl", "linklastupdated"),
    $auth = "0",
    $condition = "sharelinkid='" . $_POST['UPDATESHARELINKS'] . "'"
  );
} elseif (isset($_GET['UpdateData'])) {
  if ($_GET['UpdateData'] == "true") {
    $table = $_GET['table'];
    $data = $_GET['data'];
    $name = $_GET['name'];
    $value = $_GET['value'];
    $c_name = $_GET['c_name'];
    $Page = $table . ".php";
    $id = $_GET['id'];
    if ($value == "active") {
      $status = "inactive";
    } elseif ($value == "inactive") {
      $status = "active";
    }
    $Update = "UPDATE $table SET $c_name='$status' where $data='$id'";
    $query = mysqli_query($con, $Update);
    if ($query == true) {
      header("location: $Page?msg=$name is $status now");
    } else {
      header("location: $Page?err=Unable to Update Status of $name");
    }
  } else {
    header("location: error.php?err=Invalid_Update_Request_Observed: Please Check the action queries to know more about the update queries.");
  }
} elseif (isset($_GET['update_reviews'])) {
  $ProReviewId = $_GET['update_reviews'];
  $status = $_GET['status'];
  $name = $_GET['name'];
  $Update = "UPDATE product_reviews SET ProReviewStatus='$status' where ProReviewId='$ProReviewId'";
  $Query = mysqli_query($con, $Update);
  if ($Query == true) {
    header("location: reviews.php?msg=$name is $status now");
  } else {
    header("location: reviews.php?err=Unbale to Update $name status");
  }
} else {
  header("location: error.php?err=update_request_not_available : the request you are trying to give is not valid or maybe changed or not for this action. please re-check the action/href/request methods/links to solve this error.");
}
