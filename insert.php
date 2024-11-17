<?php
require "files.php";
require 'include.php';



if (isset($_POST['register_customer'])) {
  $customer_name = $_POST['customer_name'];
  $customer_phone_number = $_POST['customer_phone_number'];
  $customer_mail_id = $_POST['customer_mail_id'];
  $customer_password = $_POST['customer_password'];
  $customer_password_2 = $_POST['customer_password_2'];
  $customer_reg_date = date("d M Y h:m A");
  $street_address = "";
  $area_locality = "";
  $customer_city = "";
  $customer_state = "";
  $address_pincode = "";
  $status = "active";
  $cr_url = $_POST['cr_url'];
  $customer_add_month  = date("m");
  $customer_add_year  = date("Y");
  $sql = "SELECT * from customers where customer_mail_id='$customer_mail_id' and customer_phone_number='$customer_phone_number'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);

  if ($fetch == true) {
    header("location: register.php?err=User Already Registered!");
  } else {
    if ($customer_password == $customer_password_2) {

      if (isset($_SESSION['REFER_PERSON_ID'])) {
        $ReferedPersonId = $_SESSION['REFER_PERSON_ID'];
        $refer_date = date("d D M, Y");
        $sql = "SELECT * FROM referred_person where referred_phone='$customer_phone_number'";
        $query = mysqli_query($con, $sql);
        $fetch = mysqli_fetch_assoc($query);
        if ($fetch != true) {
          $sql = "INSERT INTO referred_person (referred_phone, customer_id, refer_date) VALUES ('$customer_phone_number', '$ReferedPersonId', '$refer_date')";
          $query = mysqli_query($con, $sql);
        }
      }
      $sql = "INSERT INTO customers (customer_name, customer_phone_number, customer_mail_id, customer_password, customer_reg_date, customer_add_month, customer_add_year, customer_image, store_id, arealocality, custaddress, custcity, custstate, custpincode, contactperson, alternatenumber, customer_status) VALUES ('$customer_name', '$customer_phone_number', '$customer_mail_id', '$customer_password', '$customer_reg_date', '$customer_add_month', '$customer_add_year', 'user.jpg', '$store_id', '$area_locality', '$street_address', '$customer_city', '$customer_state', '$address_pincode', '$customer_name', '$customer_phone_number', 'unverified')";
      $query = mysqli_query($con, $sql);
      if ($query == true) {

        $sql = "SELECT * from customers where customer_password='$customer_password' and customer_phone_number='$customer_phone_number'";
        $query = mysqli_query($con, $sql);
        $fetch = mysqli_fetch_assoc($query);
        if ($fetch == true) {
          $_SESSION['CUSTOMER_PHONE_NUMBER'] = $customer_phone_number;
          $customer_id = $fetch['customer_id'];
          $_SESSION['STORE_ID'] = $fetch['store_id'];
          $store_id = $fetch['store_id'];

          //OTP SESSIONAL DATA
          $_SESSION['VERIFICATION_PHONE_NUMBER'] = $customer_phone_number;
          $_SESSION['VERICATION_OTP'] = rand(000000, 999999);
          $SentOTP = $_SESSION['VERICATION_OTP'];

          //send sms
          $smsstatus = SEND_SMS(
            "38314e455734594f553234351658469066",
            "NEWFOR",
            "1",
            "$customer_phone_number",
            "$SentOTP is your new4u code and is valid for 10 minutes. Do not share the OTP with anyone. NAMAN ELECTRONIC",
            "1507165846646761890",
            "POST"
          );

          //keep customer cart items into customer cart via session id to customer id
          if (isset($_SESSION['ADD_TO_CART_SESSION'])) {
            $ip_address = $_SESSION['ADD_TO_CART_SESSION'];
          } else {
            $ip_address = "";
          }

          $device_type = detectDevice();
          date_default_timezone_set("Asia/Calcutta");
          $date_time_c = date("dMY");
          $ipv6_n = php_uname('n');
          $ipv6_p = php_uname('p');
          $os = php_uname('s');
          $OS_release = php_uname('r');
          $OS_Version = php_uname('v');
          $System_Info = php_uname('m');
          $System_more_Info = $_SERVER['HTTP_USER_AGENT'];
          $device_info = "$ip_address";

          //Update cart cart
          $SqlCartItems = "UPDATE customer_cart SET customer_id='$customer_id' where ip_address='$ip_address'";
          $QueryCartItems = mysqli_query($con, $SqlCartItems);

          SendMail(
            $Valid = "true",
            $Subject = "Account Created Successfully!",
            $Title = "Dear <b>$customer_name</b>",
            $CustomerMailId = "$customer_mail_id",
            $MAIL_MSG = "<p>Your account is created successfully on $APP_NAME. $APP_NAME provide all type daily needs items and delivery it at your door step.</p>
             <h4>Please Update your latest address, email-id for receiving regular updates and offers details.</h4>
             <br>
             ----"
          );

          NOTIFICATION_ALERT(
            $TITLE = "Registered Successfully!",
            $DESC = "Dear $customer_name, your account is created with $APP_NAME Successfully!. Please update your address and other contact details as soon as possible to avail latest offers and benefits.",
            $STATUS = "NEW"
          );

          if (isset($_SESSION['redirect_url'])) {
            $go_url = $_SESSION['redirect_url'];
          } else {
            $go_url = "verify.php";
          }
          header("location: $go_url?msg=Account Created Successfully!");
        }
      } else {
        header("location: $cr_url?err=Registration Failed!");
      }
    } else {
      header("location: $cr_url?err=Password Do Not Match!");
    }
  }
} elseif (isset($_POST['login_request'])) {
  $customer_phone_number = $_POST['customer_phone_number'];
  $go_url = $_POST['cr_url'];

  $sql = "SELECT * from customers where customer_phone_number='$customer_phone_number'";
  $query = mysqli_query($con, $sql);
  $count_users = mysqli_num_rows($query);
  if ($count_users != 0) {
    $fetch = mysqli_fetch_assoc($query);
    $UserStatus = $fetch['customer_status'];
    $customer_phone_number = $fetch['customer_phone_number'];
    $customer_mail_id = $fetch['customer_mail_id'];
    $customer_id = $fetch['customer_id'];
    $customer_name = $fetch['customer_name'];

    //OTP SESSIONAL DATA
    $_SESSION['VERIFICATION_PHONE_NUMBER'] = $customer_phone_number;
    $_SESSION['VERICATION_OTP'] = rand(000000, 999999);
    $SentOTP = $_SESSION['VERICATION_OTP'];

    //send sms
    $smsstatus = SEND_SMS(
      "38314e455734594f553234351658469066",
      "NEWFOR",
      "1",
      "$customer_phone_number",
      "$SentOTP is your new4u code and is valid for 10 minutes. Do not share the OTP with anyone. NAMAN ELECTRONIC",
      "1507165846646761890",
      "POST"
    );

    //keep customer cart items into customer cart via session id to customer id
    if (isset($_SESSION['ADD_TO_CART_SESSION'])) {
      $ip_address = $_SESSION['ADD_TO_CART_SESSION'];
    } else {
      $ip_address = "";
    }

    //Update cart cart
    $SqlCartItems = "UPDATE customer_cart SET customer_id='$customer_id' where ip_address='$ip_address'";
    $QueryCartItems = mysqli_query($con, $SqlCartItems);

    $device_type = detectDevice();
    date_default_timezone_set("Asia/Calcutta");
    $date_time_c = date("dMY");
    $ipv6_n = php_uname('n');
    $ipv6_p = php_uname('p');
    $os = php_uname('s');
    $OS_release = php_uname('r');
    $OS_Version = php_uname('v');
    $System_Info = php_uname('m');
    $System_more_Info = $_SERVER['HTTP_USER_AGENT'];
    $device_info = "$ip_address";


    //DEVICE DETAILS
    $IP_ADDRESS = $ip_address;
    $DEVICE_TYPE = detectDevice();
    $SYSTEM_INFO = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $CURRENT_DATE_TIME = date("d D M Y, h:m a");
    $HOST_NAME = php_uname('n');
    $GSI_GET_SYSTEM_DATA = "<b>Date_TIME:</b> $CURRENT_DATE_TIME<br>
 <b>IP_ADDRESS:</b> $IP_ADDRESS<br>
 <b>DEVICE_TYPE:</b> $DEVICE_TYPE<br>
 <b>SYSTEM_INFO:</b> $SYSTEM_INFO<br>
 <b>HOST_NAME:</b> $HOST_NAME";

    $DeviceDetails = "$GSI_GET_SYSTEM_DATA";

    //Create Logs for Login Provided Data
    $CreateLog = "INSERT INTO loginlogs (UserId, Username, Password, DeviceDetails, IpAddress, LogsAddDOT, LogsStatus, LogsMsg, SourceType) VALUES ('$customer_id', '$customer_mail_id', '$customer_password', '$DeviceDetails', '$IP_ADDRESS', CURRENT_TIMESTAMP, 'Success', 'Login Successfull!', 'WEBSITE')";
    $logQuery = mysqli_query($con, $CreateLog);

    //verify otp
    if ($smsstatus == true) {
      header("location: otp.php?msg=One Time Password is sent to your $customer_phone_number, Verify your account");
    } else {
      header("location: login.php?err=Unable to sent otp at the moment!");
    }
  } else {
    header("location: login.php?err=Entered phone number $customer_phone_number is not registered phone number");
  }

  //send otp again
} elseif (isset($_GET['sent_otp'])) {

  $customer_phone_number = $_SESSION['VERIFICATION_PHONE_NUMBER'];
  $_SESSION['VERICATION_OTP'] = rand(000000, 999999);
  $SentOTP = $_SESSION['VERICATION_OTP'];

  //send sms
  $smsstatus = SEND_SMS(
    "38314e455734594f553234351658469066",
    "NEWFOR",
    "1",
    "$customer_phone_number",
    "$SentOTP is your new4u code and is valid for 10 minutes. Do not share the OTP with anyone. NAMAN ELECTRONIC",
    "1507165846646761890",
    "POST"
  );

  //verify otp
  if ($smsstatus == true) {
    header("location: otp.php?msg=One Time Password is sent to your $customer_phone_number, Verify your account");
  } else {
    header("location: login.php?err=Unable to sent otp at the moment!");
  }


  //verify otp
} elseif (isset($_POST['VERIFY_OTP'])) {
  $RequiredOTP = $_SESSION['VERICATION_OTP'];
  $SubmittedOTP = $_POST['submitted_otp'];

  if ($SubmittedOTP == $RequiredOTP) {

    //DEVICE DETAILS
    $IP_ADDRESS = $ip_address;
    $DEVICE_TYPE = detectDevice();
    $SYSTEM_INFO = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $CURRENT_DATE_TIME = date("d D M Y, h:m a");
    $HOST_NAME = php_uname('n');
    $GSI_GET_SYSTEM_DATA = "<b>Date_TIME:</b> $CURRENT_DATE_TIME<br>
 <b>IP_ADDRESS:</b> $IP_ADDRESS<br>
 <b>DEVICE_TYPE:</b> $DEVICE_TYPE<br>
 <b>SYSTEM_INFO:</b> $SYSTEM_INFO<br>
 <b>HOST_NAME:</b> $HOST_NAME";

    $DeviceDetails = "$GSI_GET_SYSTEM_DATA";

    //customer phone number
    $customer_phone_number = $_SESSION['VERIFICATION_PHONE_NUMBER'];
    $sql = "SELECT * from customers where customer_phone_number='$customer_phone_number'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    $UserStatus = $fetch['customer_status'];
    $customer_phone_number = $fetch['customer_phone_number'];
    $customer_mail_id = $fetch['customer_mail_id'];
    $customer_id = $fetch['customer_id'];
    $customer_name = $fetch['customer_name'];

    //Update cart cart
    $SqlCartItems = "UPDATE customer_cart SET customer_id='$customer_id' where ip_address='$ip_address'";
    $QueryCartItems = mysqli_query($con, $SqlCartItems);

    $customer_name = $fetch['customer_name'];
    $_SESSION['customer_id'] = $customer_id;
    $_SESSION['STORE_ID'] = $fetch['store_id'];
    $store_id = $fetch['store_id'];
    setcookie("customer_id", $customer_id, time() + 60 * 60 * 365);
    setcookie("store_id", $store_id, time() + 60 * 60 * 365);

    //Create Logs for Login Provided Data
    $CreateLog = "INSERT INTO loginlogs (UserId, Username, Password, DeviceDetails, IpAddress, LogsAddDOT, LogsStatus, LogsMsg, SourceType) VALUES ('$customer_id', '$customer_mail_id', '$customer_password', '$DeviceDetails', '$IP_ADDRESS', CURRENT_TIMESTAMP, 'Success', 'Login Successfull!', 'WEBSITE')";
    $logQuery = mysqli_query($con, $CreateLog);
    if (isset($_SESSION['redirect_url'])) {
      $go_url = $_SESSION['redirect_url'];
    } else {
      $go_url = $go_url;
    }
    header("location: index.php?msg=Welcome, $customer_name. Login Successfully!");
  } else {
    header("location: otp.php?err=Please entered correct otp. entered otp is invalid!");
  }

  //save product into cart
} elseif (isset($_POST['save_to_cart'])) {
  $user_product_id = $_POST['user_product_id_value'];
  $cr_url = $_POST['save_to_cart'];

  $sql = "SELECT * from user_products, product_categories,  pro_brands, product_sub_categories where user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id and user_products.user_product_id='$user_product_id' and product_categories.product_cat_id=product_sub_categories.product_cat_id and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);

  $user_product_id = $fetch['user_product_id'];
  $product_tags = $fetch['product_measure_unit'] . " " . $fetch['unit_type'];
  $product_price = $fetch['product_offer_price'];
  $product_mrp = $fetch['product_mrp_price'];
  $brand_title = $fetch['brand_title'];
  $product_offer_price = $fetch['product_offer_price'];
  $product_mrp_price = $fetch['product_mrp_price'];
  $amount = 1 * (int)$product_offer_price;
  $mrp_total = 1 * (int)$product_mrp_price;
  $product_quantity = 1;
  $product_total_amount = 1 * (int)$product_offer_price;
  $product_img = $fetch['product_image'];
  $hindi_name = $fetch['unique_feature'];
  $product_HSN = $fetch['product_HSN'];
  $product_taxes = $fetch['products_taxes'];
  $product_net_prices = $product_offer_price * $product_quantity;
  $total_charges = (int)$fetch['product_installation_charge'] + (int)$fetch['product_delivery_charge'];

  if ($fetch['product_installation_charge'] == null) {
    $product_installation_charge = "";
  } else {
    $product_installation_charge = "Installation : Rs." . $fetch['product_installation_charge'] . "<br>";
  }

  if ($fetch['product_delivery_charge'] == null) {
    $product_delivery_charge = "";
  } else {
    $product_delivery_charge = "Delivery : Rs." . $fetch['product_delivery_charge'] . "<br>";
  }

  if ($fetch['product_return_policy_charge_amount'] == null) {
    $product_return_policy_charge_amount = "";
  } else {
    $product_return_policy_charge_amount = "Return Policy : Rs." . $fetch['product_return_policy_charge_amount'] . "<br>";
  }
  $product_title = $fetch['product_title'] . "-" . $brand_title . "-" . $fetch['ProductModalNo'] . "-" . $fetch['product_modal_for_seo'] . "-" . $fetch['ProductSizeCapacity'] . "-" . $fetch['unique_feature'] . "-" . $fetch['ProductEdition'] . "-" . $fetch['product_warranty_in_diff_time'] . "-" . $fetch['product_warranty_in_break'] . "-" . $fetch['product_HSN'] . "-" . $product_tags . "<br>
  $product_installation_charge
  $product_delivery_charge
  $product_return_policy_charge_amount";

  $device_type = detectDevice();
  date_default_timezone_set("Asia/Calcutta");
  $date_time_c = date("dMY");
  $ipv6_n = php_uname('n');
  $ipv6_p = php_uname('p');
  $os = php_uname('s');
  $OS_release = php_uname('r');
  $OS_Version = php_uname('v');
  $System_Info = php_uname('m');
  $System_more_Info = $_SERVER['HTTP_USER_AGENT'];
  $device_info = SECURE($ip_address, "e");
  $cart_add_date = date("d D M Y, h:m a");

  if (isset($_SESSION['customer_id'])) {

    $customer_id = $_SESSION['customer_id'];
    $sql = "SELECT * from customer_cart where device_info='$user_product_id' and product_HSN='$product_HSN' and customer_id='$customer_id'";
    $query = mysqli_query($con, $sql);
    $count = mysqli_num_rows($query);
    if ($count != 0) {
      header("location: $cr_url?id=$user_product_id&err=Item Already In Cart");
    } else {
      $sql = "INSERT INTO customer_cart (
        customer_id, ip_address, device_info, user_product_id, product_tags, product_price, product_mrp, product_quantity, product_total_amount,
        mrp_total, cart_add_date, product_img, hindi_name, product_HSN, product_taxes, product_net_prices, product_title
      ) VALUES (
        '$customer_id', '$ip_address', '$device_info', '$user_product_id', '$product_tags', '$product_price', '$product_mrp', '$product_quantity', '$product_total_amount',
        '$mrp_total', '$cart_add_date', '$product_img', '$hindi_name', '$product_HSN', '$product_taxes', '$product_net_prices', '$product_title'
      )";
      //die($sql);
      $query = mysqli_query($con, $sql);
      if ($query == true) {
        header("location: $cr_url?id=$user_product_id&data=Product Save Into Cart Successfully!");
      } else {
        header("location: $cr_url?id=$user_product_id&data=Unable to Save Products into Cart!");
      }
    }
  } else {
    if (isset($_SESSION['ADD_TO_CART_SESSION'])) {
      $ip_address = $_SESSION['ADD_TO_CART_SESSION'];
    } else {
      $_SESSION['ADD_TO_CART_SESSION'] = rand(00000, 99999);
      $ip_address = $_SESSION['ADD_TO_CART_SESSION'];
    }
    $sql = "SELECT * from customer_cart where ip_address='$ip_address' and device_info='$user_product_id'";
    $query = mysqli_query($con, $sql);
    $count = mysqli_num_rows($query);
    if ($count != 0) {
      header("location: $cr_url?id=$user_product_id&err=Item Already In Cart");
    } else {
      $customer_id = 0;
      $sql = "INSERT INTO customer_cart (
        customer_id, ip_address, device_info, user_product_id, product_tags, product_price, product_mrp, product_quantity, product_total_amount,
        mrp_total, cart_add_date, product_img, hindi_name, product_HSN, product_taxes, product_net_prices, product_title
      ) VALUES (
        '$customer_id', '$ip_address', '$device_info', '$user_product_id', '$product_tags', '$product_price', '$product_mrp', '$product_quantity', '$product_total_amount',
        '$mrp_total', '$cart_add_date', '$product_img', '$hindi_name', '$product_HSN', '$product_taxes', '$product_net_prices', '$product_title'
      )";
      $query = mysqli_query($con, $sql);

      if ($query == true) {
        header("location: $cr_url?id=$user_product_id&data=Product Save Into Cart Successfully!");
      } else {
        header("location: $cr_url?id=$user_product_id&data=Unable to Save Products into Cart!");
      }
    }
  }
} elseif (isset($_POST['upload_customer_dp'])) {
  $customer_id = $_POST['customer_id'];
  $cust_dp = $_FILES['customer_image_uplaod']['name'];
  $temp_name = $_FILES['customer_image_uplaod']['tmp_name'];
  $path = "img/user_img/";

  move_uploaded_file($_FILES['customer_image_uplaod']['tmp_name'], $path . $cust_dp);

  $sql = "UPDATE customers SET customer_image='$cust_dp' where customer_id='$customer_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: account.php?msg=updated");
  } else {
    header("location: account.php?msg=update_failed");
  }
} elseif (isset($_POST['update_customer_password'])) {
  $customer_password_old = $_POST['customer_password_old'];
  if ($customer_password_old == $customer_password) {
    $customer_password_new = $_POST['customer_password_new'];
    $customer_password_new_2 = $_POST['customer_password_new_2'];
    if ($customer_password_new == $customer_password_new_2) {
      $sql = "UPDATE customers SET customer_password='$customer_password_new' where customer_id='$customer_id'";
      $query = mysqli_query($con, $sql);
      if ($query == true) {
        header("location: account.php?pass_update=true");
      } else {
        header("location: account.php?pass_update=false");
      }
    } else {
      header("location: account.php?err=new_pass_unmatched");
    }
  } else {
    header("location: account.php?msg=unmatched");
  }
} elseif (isset($_POST['update_customer_data'])) {
  $customer_id = $_POST['customer_id'];
  $customer_name_new = $_POST['customer_name'];
  $customer_phone_number_new = $_POST['customer_phone_number'];
  $customer_mail_id_new = $_POST['customer_mail_id'];
  $sql = "UPDATE customers SET customer_name='$customer_name_new', customer_mail_id='$customer_mail_id_new', customer_phone_number='$customer_phone_number_new' where customer_id='$customer_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: account.php?details_update=true");
  } else {
    header("location: account.php?details_update=false");
  }
} elseif (isset($_POST['add_customer_address'])) {
  $customer_id = $_POST['customer_id'];
  $street_address = $_POST['street_address'];
  $area_locality = $_POST['area_locality'];
  $customer_city = $_POST['customer_city'];
  $customer_state = $_POST['customer_state'];
  $address_pincode = $_POST['address_pincode'];
  $contact_person = $_POST['contact_person'];
  $alternate_phone = $_POST['alternate_phone'];
  $status = "inactive";

  $sql = "INSERT INTO customer_address (customer_id, street_address, area_locality, customer_city, customer_state, address_pincode, contact_person, alternate_phone, status) VALUES
   ('$customer_id', '$street_address', '$area_locality', '$customer_city', '$customer_state', '$address_pincode', '$contact_person', '$alternate_phone', '$status')";
  $query = mysqli_query($con, $sql);

  if ($query == true) {
    header("location: address.php?data=Address Saved Successfully!");
  } else {
    header("location: address.php?err=Unable to Save Address");
  }
} elseif (isset($_POST['save_products_into_session'])) {
  $date_time = date("dmy");
  $_SESSION['order_id'] = "INV" . $date_time . rand(111111, 999999);
  $_SESSION['product_total_amount_entry'] = $_POST['product_total_amount'];
  $_SESSION['coupon_code'] = $_POST['coupon_code'];
  $_SESSION['total_amount_after_discount'] = $_POST['total_amount_after_discount'];
  $_SESSION['delivery_charge'] = $_POST['delivery_charge'];
  $_SESSION['net_payable_amount'] = $_POST['net_payable_amount'];
  $_SESSION['store_id'] = $_POST['store_id'];
  $_SESSION['DELIVERY_TYPE'] = $_POST['DELIVERY_TYPE'];
  $_SESSION['PICK_SCHEDULE_TIME'] = $_POST['PICK_SCHEDULE_TIME'];

  setcookie("product_total_amount_entry", $_SESSION['product_total_amount_entry'], time() + 60 * 60 * 365);
  setcookie("coupon_code", $_SESSION['coupon_code'], time() + 60 * 60 * 365);
  setcookie("total_amount_after_discount", $_SESSION['total_amount_after_discount'], time() + 60 * 60 * 365);
  setcookie("delivery_charge", $_SESSION['delivery_charge'], time() + 60 * 60 * 365);
  setcookie("net_payable_amount", $_SESSION['net_payable_amount'], time() + 60 * 60 * 365);
  setcookie("store_id", $_SESSION['store_id'], time() + 60 * 60 * 365);
  setcookie("DELIVERY_TYPE", $_SESSION['DELIVERY_TYPE'], time() + 60 * 60 * 365);
  setcookie("PICK_SCHEDULE_TIME", $_SESSION['PICK_SCHEDULE_TIME'], time() + 60 * 60 * 365);
  setcookie("order_id", $_SESSION['order_id'], time() + 60 * 60 * 365);

  header("location: checkout.php");
} elseif (isset($_POST['save_order_delivery_information'])) {
  $cr_url = $_POST['cr_url'];
  $customer_id = $_SESSION['customer_id'];

  $date_time = date("dmy");
  $store_id = $store_id;
  $_SESSION['delivery_address'] = $_SESSION['delivery_address'];
  $_SESSION['billing_address'] = $_SESSION['billing_address'];
  $_SESSION['payment_mode'] = $_POST['payment_mode'];

  setcookie("delivery_address", $_SESSION['delivery_address'], time() + 60 * 60 * 365);
  setcookie("billing_address", $_SESSION['billing_address'], time() + 60 * 60 * 365);
  setcookie("payment_mode", $_SESSION['payment_mode'], time() + 60 * 60 * 365);

  header("location: payment.php?payment=true");

  //DEVICE_ID, ORDER_ID, CUSTOMER_ID, STORE_ID, DELIVERY_ADDRESS, BILLING_ADDRESS, PAYMENT_MODE, DELIVERY_STATUS, DELIVERY_DATE, DELIVERY_TIME, DELIVERY_TYPE, DELIVERY_CHARGE, DELIVERY_PICK_SCHEDULE_TIME, DELIVERY_PICK_SCHEDULE_DATE, DELIVERY_PICK_SCHEDULE_TIME_B, DELIVERY_PICK_SCHEDULE_DATE_B, DELIVERY_PICK_SCHEDULE_TIME_C, DELIVERY_PICK_SCHEDULE_DATE_C, DELIVERY_PICK_SCHEDULE_TIME_D, DELIVERY_PICK_SCHEDULE_DATE_D, DELIVERY_PICK_SCHEDULE_TIME_E, DELIVERY_PICK_SCHEDULE_DATE_E, DELIVERY_PICK_SCHEDULE_TIME_F, DELIVERY_PICK_SCHEDULE_DATE_F, DELIVERY_PICK_SCHEDULE_TIME_G, DELIVERY_PICK_SCHEDULE_DATE_G, DELIVERY_PICK_SCHEDULE_TIME_H, DELIVERY_PICK_SCHEDULE_DATE_H, DELIVERY_PICK_SCHEDULE_TIME_I, DELIVERY_PICK_SCHEDULE_DATE_I, DELIVERY_PICK_SCHEDULE_TIME_J, DELIVERY_PICK_SCHEDULE_DATE_J, DELIVERY_PICK_SCHEDULE_TIME_K, DELIVERY_PICK_SCHEDULE_DATE_K, DELIVERY_PICK_SCHEDULE_TIME_L, DELIVERY_PICK_SCHEDULE_DATE_L, DELIVERY_PICK_SCHEDULE_TIME_M, DELIVERY_PICK_SCHEDULE_DATE_M, DELIV
} elseif (isset($_GET['accept_id'])) {
  $order_id = $_GET['accept_id'];
  $store_id = $_GET['store_id'];

  $sql = "UPDATE customer_orders SET order_status='Accepted' where order_id='$order_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: order.php?msg= $order_id Accepted Successfully!");
  } else {
    header("location: order.php?warning= $order_id  Unable to Accept!");
  }
} elseif (isset($_POST['SAVE_QUERY'])) {
  $device_type = detectDevice();
  $ip_address = get_ip();
  date_default_timezone_set("Asia/Calcutta");
  $date_time_c = date("D d M, Y h:m:s A");
  $ipv6_n = php_uname('n');
  $ipv6_p = php_uname('p');
  $os = php_uname('s');
  $OS_release = php_uname('r');
  $OS_Version = php_uname('v');
  $System_Info = php_uname('m');
  $System_more_Info = $_SERVER['HTTP_USER_AGENT'];
  $device_info = "$ip_address";
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $query_subject = $_POST['query_subject'];
  $query_details = $_POST['query_details'];
  $QUERY_SOURCE = $_POST['QUERY_SOURCE'];
  $device_details = "$device_type<br>$ip_address<br>$date_time_c<br>$ipv6_p<br>$ipv6_n<br>$os<br>$OS_release<br>$OS_Version<br>$System_Info<br>$System_more_Info";

  $SaveQuery = "INSERT INTO queryies (full_name, email, phone_number, query_subject, query_details, QUERY_SOURCE, device_details, date_time) VALUES ('$full_name', '$email', '$phone_number', '$query_subject', '$query_details', '$QUERY_SOURCE', '$device_details', '$date_time_c')";
  $query = mysqli_query($con, $SaveQuery);
  if ($query == true) {
    header("location: query.php?msg=Query Send Successfully!");
  } else {
    header("location: query.php?msg=Unable to Send Query.");
  }
} elseif (isset($_POST['SaveNewReview'])) {
  Save_DATA(
    $tablename = "product_reviews",
    $checkrows = "0",
    $tablerows = array("ProReviewTitle", "ProductId", "ProReviewUserType", "ProReviewCreatedOn", "ProReviewStatus", "ProReviewStarCount", "ProReviewName", "ProReviewEmail", "ProReviewDesc", "ProReviewDeviceDetails"),
    $auth = "0"
  );
} elseif (isset($_POST['ReviewsType'])) {
  Save_DATA(
    $tablename = "product_reviews_counts",
    $checkrows = "0",
    $tablerows = array("ProReviewId", "ReviewsType", "ReviewsSubmittedBy", "ReviewSubmittedOn"),
    $auth = "0"
  );
} elseif (isset($_POST['save_address'])) {
  $customer_id = $_SESSION['customer_id'];
  $contact_person = $_POST['contact_person'];
  $alternate_phone = $_POST['alt_phone'];
  $street_address = $_POST['custaddress'];
  $customer_addressblock = $_POST['customer_addressblock'];
  $area_locality = $_POST['arealocality'];
  $customer_city = $_POST['custcity'];
  $customer_state = $_POST['custstate'];
  $address_pincode = $_POST['custpincode'];
  $address_type = $_POST['address_type'];
  $url = $_POST['url'];
  $gst_no = $_POST['gst_no'];

  $Save = SAVE("customer_address", [
    "customer_id",
    "contact_person",
    "alternate_phone",
    "street_address",
    "area_locality",
    "customer_city",
    "customer_state",
    "address_pincode",
    "customer_addressblock",
    "address_type",
    "gst_no"
  ]);

  if ($Save == true) {
    header("location: $url?data=New Address Saved!");
  } else {
    header("location: $url?err=Unable to Save Address");
  }
}
