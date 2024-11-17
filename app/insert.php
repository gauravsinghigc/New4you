<?php
session_start();
require 'config.php';
require 'text.php';
include 'include.php';
include 'tools.php';

if (isset($_POST['register_customer'])) {
 $customer_name = $_POST['CustomerName'];
 $customer_phone_number = $_POST['CustomerPhone'];
 $customer_mail_id = $_POST['CustomerEmail'];
 $customer_password = $_POST['CustomerPassword'];
 $customer_password_2 = $_POST['CustomerPassword'];
 $street_address = "";
 $area_locality = "";
 $customer_city = "";
 $customer_state = "";
 $address_pincode = "";
 $customer_add_month = date("M");
 $customer_add_year = date("Y");
 $status = "active";
 $store_id = "1";
 $go_url = $_POST['go_url'];

 $sql = "SELECT * from customers where customer_mail_id='$customer_mail_id' OR customer_phone_number='$customer_phone_number'";
 $query = mysqli_query($con, $sql);
 $fetch = mysqli_fetch_assoc($query);

 if ($fetch == true) {
  header("location: index.php?err=User Already Registered!");
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

   $sql = "INSERT INTO customers (customer_name, customer_phone_number, customer_mail_id, customer_password, customer_reg_date, customer_add_month, customer_add_year, customer_image, store_id, arealocality, custaddress, custcity, custstate, custpincode, contactperson, alternatenumber, customer_status) VALUES ('$customer_name', '$customer_phone_number', '$customer_mail_id', '$customer_password', CURRENT_TIMESTAMP, '$customer_add_month', '$customer_add_year', 'user.jpg', '$store_id', '$area_locality', '$street_address', '$customer_city', '$customer_state', '$address_pincode', '$customer_name', '$customer_phone_number', 'unverified')";

   $query = mysqli_query($con, $sql);

   if ($query == true) {
    $sql = "SELECT * from customers where customer_password='$customer_password' and customer_phone_number='$customer_phone_number'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    if ($fetch == true) {
     $_SESSION['customer_id'] = $fetch['customer_id'];
     $customer_id = $fetch['customer_id'];
     $_SESSION['STORE_ID'] = $fetch['store_id'];
     $store_id = $fetch['store_id'];
     $RANDOM_OTP = rand(000000, 999999);
     $_SESSION['OTP_SESSION'] = $RANDOM_OTP;
     SMS(
      $MSG = "
Dear $customer_name, Your Account is created with $APP_NAME Successfully. $APP_NAME Deliver your product at your door with in 24hr.",
      $PHONE = "$customer_phone_number"
     );

     SendMail(
      $Valid = "true",
      $Subject = "Account Created Successfully!",
      $Title = "Dear <b>$customer_name</b>",
      $CustomerMailId = "$customer_mail_id",
      $MAIL_MSG = "<p>Your account is created successfully on 24kharido.in. 24kharido provide all type daily needs items and delivery it at your door step.</p>
             <h4>Please Update your latest address, email-id for receiving regular updates and offers details.</h4>
             <br>
             ----
             <h5>What 24Kharido.in Does :</h5>
<p>             
<b>○</b> At 24kharido.in, customers buy/sell everything of their choice and requirements. They don’t need to leave their homes, comfort and safety. 24kharido.in delivering your order to its destination locally within 24 hours.<br><br>

<b>○</b> At 24kharido.in, Customers create their own orders too, named as Custom Orders. For Custom Orders, customers have to fill in product details, store information (Optional), Approx price of that item (Optional). When Custom Orders are placed, they get a call from 24Kharido.in for your order and price confirmation. After confirmation we will deliver it within 24 Hours.<br><br>

<b>○</b> At 24kharido.in, customers sell their old and used items, products, electronics, and many more items. They don’t need to contact the customer (Buyer of used time) we make deals for you and pick posted item from your home and deliver it to buyer within 24hrs. Amounts will be transferred via Paytm, Google Pay, Phonepay, Amazon Pay, UPI and Direct Bank Transfer to customer accounts after delivery means within in 24hours.<br><br>

<b>○</b> At 24kharido.in, customers pay their bills, recharge, buy life/automobile insurances, and do many more exciting things.</p>

<h5>Why Shop at 24kharido.in:</h5><p>
<b>○</b> At 24Kharido.in, Customer earns 24kharido Funds every time on every purchase, 24kharido Funds are used for Bill/Recharge Payments and Shopping at 24kharido.in, and they also transfer that into their wallets (Paytm) and Bank Accounts as preferred by customers.<br><br>

<b>○</b> 24Kharido Funds are for direct use. It does not contain points into the amount ration, Like if you Purchase a product then you earn 10% (upto Rs.300) of the purchased amount as 24kharido funds. For example, if a customer purchased a Earphone of Rs.299 then it earn Rs.20 as 24kharido Funds. Customers can use whole funds for next purchased or doing bill payments/recharges.</p>

<h5>24Kharido Refer & Earn</h5>
<p>
24kharido.in have a Referred Program where you can earn upto Rs.500 per refer as 24kharido Funds, which is used for shopping at 24kharido, recharge, and many more things.</p>
             "
     );

     NOTIFICATION_ALERT(
      $TITLE = "Registered Successfully!",
      $DESC = "Dear $customer_name, your account is created with $APP_NAME Successfully!. Please update your address and other contact details as soon as possible to avail latest offers and benefits.",
      $STATUS = "NEW"
     );
     header("location: index.php?msg=Welcome $customer_name, Your account is Created Successfully!");
    }
   } else {
    header("location: login.php?msg=Registration Failed!");
   }
  } else {
   header("location: login.php?msg=Password Do Not Match!");
  }
 }
} elseif (isset($_POST['login_request'])) {
 $CustomerPhone = $_POST['CustomerPhone'];
 $customer_password = $_POST['CustomerPassword'];
 $go_url = $_POST['go_url'];

 $sql = "SELECT * from customers where customer_password='$customer_password' and customer_phone_number='$CustomerPhone'";
 $query = mysqli_query($con, $sql);
 $count_users = mysqli_num_rows($query);
 if ($count_users != 0) {
  $fetch = mysqli_fetch_assoc($query);
  $UserStatus = $fetch['customer_status'];
  $customer_name = $fetch['customer_name'];
  $customer_phone_number = $fetch['customer_phone_number'];
  $customer_mail_id_for_mail = $fetch['customer_mail_id'];
  $customer_id = $fetch['customer_id'];
  $customer_name = $fetch['customer_name'];
  $_SESSION['customer_id'] = $fetch['customer_id'];
  $_SESSION['STORE_ID'] = $fetch['store_id'];
  $store_id = $fetch['store_id'];
  setcookie("customer_id", $customer_id, time() + 60 * 60 * 365);
  setcookie("store_id", $store_id, time() + 60 * 60 * 365);
  SendMail(
   $Valid = "true",
   $Subject = "New Login Received",
   $Title = "Dear <b>$customer_name</b>",
   $CustomerMailId = "$customer_mail_id_for_mail",
   $MAIL_MSG = "<p>We Received a fresh new login. Please check if this is by your then ignore this. If this is not you then please check device details or change password of your account.</p>"
  );
  header("location: $go_url?&msg=Welcome, $customer_name in 24kharido");
 } else {
  SendMail(
   $Valid = "true",
   $Subject = "Miscellaneous Login Detected!",
   $Title = "Dear <b>$customer_name</b>",
   $CustomerMailId = "$customer_mail_id_for_mail",
   $MAIL_MSG = "<p>24kharido Detects unusual Login with your account. If this was you then ignore this, if this was not you please change your password. Device details are mention below please check...</p>"
  );
  header("location: login.php?err=Invalid Username/Password!");
 }
} elseif (isset($_POST['save_to_cart']) or isset($_POST['save_to_cart_attr'])) {
 $user_product_id = $_POST['user_product_id_value'];
 $quantity = $_POST['quantity'];
 if (isset($_POST['Attoptions'])) {
  $options = $_POST['Attoptions'];
 } else {
  $options = " ";
 }


 if (!isset($_SESSION['customer_id'])) {
  $store_id = "1";
 } else {
  $store_id = $_POST['store_id'];
 }

 $ip_address = $_POST['ip_address'];
 mysqli_set_charset($con, 'utf8');
 $sql = "SELECT * from user_products, pro_brands where user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.user_product_id='$user_product_id'";
 $query = mysqli_query($con, $sql);
 $fetch = mysqli_fetch_assoc($query);
 $product_title = $fetch['product_title'];
 $hindi_name = $fetch['hindi_name'];
 $product_img = $fetch['product_img'];
 $product_offer_price = $fetch['product_offer_price'];
 $product_mrp_price = $fetch['product_mrp_price'];
 $product_tags = $fetch['product_tags'];
 $product_img = $fetch['product_img'];

 if ($_POST['home_url'] == "true") {
  $cr_url = $_POST['cr_url'] . "?&";
 } else {
  $cr_url = $_POST['cr_url'] . "?&";
 }


 $cart_add_date = date("d M Y h:m a");
 $amount = $quantity * $product_offer_price;
 $mrp_total = $quantity * $product_mrp_price;

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
 $device_info = "$ip_address$device_type";

 if (isset($_SESSION['customer_id'])) {
  $customer_id = $_SESSION['customer_id'];
  $sql = "SELECT * from customer_cart where device_info='$user_product_id' and customer_id='$customer_id'";
 } else {
  $sql = "SELECT * from customer_cart where device_info='$user_product_id' and ip_address='$device_info'";
 }
 $query = mysqli_query($con, $sql);
 $fetch = mysqli_fetch_assoc($query);
 if ($fetch == true) {
  header("location: $cr_url&msg=$product_title is Already in Cart");
 } else {

  if (isset($_SESSION['customer_id'])) {
   mysqli_set_charset($con, 'utf8');
   $sql = "INSERT into customer_cart (customer_id, ip_address, device_info, user_product_id, product_tags, product_price, product_mrp, product_quantity, product_total_amount, cart_add_date, store_id, mrp_total, product_img, hindi_name, options) VALUES ('$customer_id', '$ip_address', '$user_product_id', '$product_title', '$product_tags', '$product_offer_price', '$product_mrp_price', '$quantity', '$amount', '$cart_add_date', '$store_id', '$mrp_total', 'pro_img/$product_img', '$hindi_name', '$options')";
   $query = mysqli_query($con, $sql);
   if ($query == true) {
    header("location: $cr_url&msg=$product_title ($product_tags) Saved into Cart");
   } else {
    header("location: $cr_url&msg=Unable to Save $product_title");
   }
  } else {
   mysqli_set_charset($con, 'utf8');
   $sql = "INSERT into customer_cart (customer_id, ip_address, device_info, user_product_id, product_tags, product_price, product_mrp, product_quantity, product_total_amount, cart_add_date, store_id, mrp_total, product_img, hindi_name, options) VALUES ('', '$device_info', '$user_product_id', '$product_title', '$product_tags', '$product_offer_price', '$product_mrp_price', '$quantity', '$amount', '$cart_add_date', '$store_id', '$mrp_total', 'pro_img/$product_img', '$hindi_name', '$options')";
   $query = mysqli_query($con, $sql);
   if ($query == true) {
    header("location: $cr_url&msg=$product_title ($product_tags) Saved into Cart");
   } else {
    header("location: $cr_url&msg=Unable to Save $product_title");
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
 $customer_id = $_SESSION['customer_id'];
 $sql = "SELECT * FROM customers where customer_id='$customer_id'";
 $query = mysqli_query($con, $sql);
 $fetch = mysqli_fetch_assoc($query);
 $customer_name = $fetch['customer_name'];
 $customer_password = $_POST['cr_pass'];
 $customer_password_old = $_POST['customer_password_old'];
 $customer_mail_id = $_POST['customer_mail_id'];
 if ($customer_password_old == $customer_password) {
  $customer_password_new = $_POST['customer_password_new'];
  $customer_password_new_2 = $_POST['customer_password_new_2'];
  if ($customer_password_new == $customer_password_new_2) {
   $sql = "UPDATE customers SET customer_password='$customer_password_new' where customer_id='$customer_id'";
   $query = mysqli_query($con, $sql);
   if ($query == true) {
    NOTIFICATION_ALERT(
     $TITLE = "Password Updated Successfully!",
     $DESC = "Dear $customer_name, Your $APP_NAME account password is changed recenlty. Please use your Latest Password for future Logins, NEW PASSWORD IS : $customer_password_new",
     $STATUS = "NEW"
    );
    SendMail(
     $Valid = "true",
     $Subject = "Password Changed",
     $Title = "Dear <b>$customer_name</b>",
     $CustomerMailId = "$customer_mail_id",
     $MAIL_MSG = "<p>Your 24kharido.in password is changed recently. Your new Password is $customer_password_new. Please don't share this with anyone. 24kkharido do not call/email/sms for sharing this in any way like verify account, order cancelletion, or in any manner. Please keep it confidential, private and safe.</p>
             <p>If this password update is not done by you please update your password as soon as possible. password changing steps are mentions below;<br>
             -> Go to http://24kharido.in<br>
             -> Go to Login/Signup Page.<br>
             -> Click on Forget Password.<br>
             -> Enter Your Registered Phone number.<br>
             -> You will receive OTP or one time password on your registed phone or registered mail id. enter otp from their.<br><br>
             -> <b>(Change Step)</b> If OTP verified :-<br>
               ---> Enter New Password.<br>
               ---> Re-Enter New password.<br>
               ---> Click on Update Button.<br>
               ---> Your password is updated now. you can you lastes password for future logins.<br>
             ->If OTP not verified :- <br>
               ---> Try again.<br>
               ---> Please check you number twice.<br>
               ---> Follow <b>(Change Step)</b>.</p>

            <p>If your still facing issue then please contact us via help & support section.</p>"
    );
    header("location: account.php?msg=Password Updated Successfully!");
   } else {
    SendMail(
     $Valid = "true",
     $Subject = "Password Change Request",
     $Title = "Dear <b>$customer_name</b>",
     $CustomerMailId = "$customer_mail_id",
     $MAIL_MSG = "<p>Someone trying to change your password. 24kharido recommended to change your password as soon as possible or immediately.</p>"
    );
    header("location: security.php?msg=Unable to Update Password");
   }
  } else {
   SendMail(
    $Valid = "true",
    $Subject = "Password Change Request",
    $Title = "Dear <b>$customer_name</b>",
    $CustomerMailId = "$customer_mail_id",
    $MAIL_MSG = "<p>Someone trying to change your password. 24kharido recommended to change your password as soon as possible or immediately.</p>"
   );
   header("location: security.php?msg=New Password Do Not Matched");
  }
 } else {
  SendMail(
   $Valid = "true",
   $Subject = "Password Change Request",
   $Title = "Dear <b>$customer_name</b>",
   $CustomerMailId = "$customer_mail_id",
   $MAIL_MSG = "<p>Someone trying to change your password. 24kharido recommended to change your password as soon as possible or immediately.</p>"
  );
  header("location: security.php?msg=incorrect Current Password");
 }
} elseif (isset($_POST['update_customer_data'])) {
 $customer_id = $_POST['customer_id'];
 $customer_name_new = $_POST['customer_name'];
 $customer_phone_number_new = $_POST['customer_phone_number'];
 $customer_mail_id_new = $_POST['customer_mail_id'];
 $sql = "UPDATE customers SET customer_name='$customer_name_new', customer_mail_id='$customer_mail_id_new', customer_phone_number='$customer_phone_number_new' where customer_id='$customer_id'";
 $query = mysqli_query($con, $sql);
 if ($query == true) {
  NOTIFICATION_ALERT(
   $TITLE = "Account Details Updated!",
   $DESC = "Dear $customer_name_new, You account details are updated recenlty. Updates are Name : $customer_name_new, Phone : $customer_phone_number_new, Mail ID : $customer_mail_id_new. Thanks for updating your latest contact details with $APP_NAME",
   $STATUS = "NEW"
  );
  header("location: account.php?msg=Changes Saved Successfully!");
 } else {
  header("location: account.php?err=Unable to Update Data");
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
  header("location: address.php?msg=Address Saved Successfully!");
 } else {
  header("location: address.php?err=Unable to Save Address");
 }
} elseif (isset($_POST['save_products_into_session'])) {

 $_SESSION['product_total_amount_entry'] = $_POST['product_total_amount'];
 $_SESSION['coupon_code'] = $_POST['coupon_code'];
 $_SESSION['total_amount_after_discount'] = $_POST['total_amount_after_discount'];
 $_SESSION['delivery_charge'] = $_POST['delivery_charge'];
 $_SESSION['net_payable_amount'] = $_POST['net_payable_amount'];
 $_SESSION['store_id'] = $_POST['store_id'];
 $_SESSION['DELIVERY_TYPE'] = $_POST['DELIVERY_TYPE'];
 $_SESSION['PICK_SCHEDULE_TIME'] = $_POST['PICK_SCHEDULE_TIME'];

 if (isset($_SESSION['customer_id'])) {
  $_SESSION['customer_id'] = $_SESSION['customer_id'];
 } else {
 }
 header("location: checkout.php");
} elseif (isset($_POST['save_order_delivery_information'])) {

 $cr_url = $_POST['cr_url'];
 $customer_id = $_SESSION['customer_id'];
 $street_address = $_POST['street_address'];
 $area_locality = $_POST['area_locality'];
 $customer_city = $_POST['customer_city'];
 $customer_state = $_POST['customer_state'];
 $address_pincode = $_POST['address_pincode'];
 $contact_person = $_POST['contact_person'];
 $alternate_phone = $_POST['alternate_phone'];
 $date_time = date("dmy");
 $store_id = $_POST['store_id'];
 $_SESSION['order_id'] = "INV$date_time" . rand(100, 99999999);
 $_SESSION['delivery_address'] = "$street_address, $area_locality, $customer_city, $customer_state, $address_pincode,<br> $contact_person $alternate_phone";
 $_SESSION['payment_mode'] = $_POST['payment_mode'];
 header("location: payment.php?payment=true");
} elseif (isset($_GET['accept_id'])) {
 $order_id = $_GET['accept_id'];
 $store_id = $_GET['store_id'];

 $sql = "UPDATE customer_orders SET order_status='Accepted' where store_id='$store_id' and order_id='$order_id'";
 $query = mysqli_query($con, $sql);
 if ($query == true) {
  header("location: order.php?msg= $order_id Accepted Successfully!");
 } else {
  header("location: order.php?warning= $order_id  Unable to Accept!");
 }
} elseif (isset($_POST['update_customer_data'])) {
 $cr_url  = $_POST['cr_url'];
 $customer_id = $_POST['customer_id'];
 $customer_name_new = $_POST['customer_name'];
 $customer_phone_number_new = $_POST['customer_phone_number'];
 $customer_mail_id_new = $_POST['customer_mail_id'];
 $sql = "UPDATE customers SET customer_name='$customer_name_new', customer_mail_id='$customer_mail_id_new', customer_phone_number='$customer_phone_number_new' where customer_id='$customer_id'";
 $query = mysqli_query($con, $sql);
 if ($query == true) {
  header("location: $cr_url?msg=updated");
 } else {
  header("location: $cr_url?err=Unable to Update Data");
 }
} elseif (isset($_POST['update_customer_password'])) {
 $cr_url  = $_POST['cr_url'];
 $customer_password_old = $_POST['customer_password_old'];
 if ($customer_password_old == $customer_password) {
  $customer_password_new = $_POST['customer_password_new'];
  $customer_password_new_2 = $_POST['customer_password_new_2'];
  if ($customer_password_new == $customer_password_new_2) {
   $sql = "UPDATE customers SET customer_password='$customer_password_new' where customer_id='$customer_id'";
   $query = mysqli_query($con, $sql);
   if ($query == true) {
    header("location: $cr_url?msg=updated");
   } else {
    header("location: $cr_url?err=Unable to Update Data");
   }
  } else {
   header("location: $cr_url?err=new_pass_unmatched");
  }
 } else {
  header("location: $cr_url?msg=unmatched");
 }
} elseif (isset($_POST['add_customer_address'])) {
 $cr_url = $_POST['cr_url'];
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
  header("location: $cr_url?msg=Address Saved Successfully!");
 } else {
  header("location: $cr_url?err=Unable to Save Address");
 }
} elseif (isset($_POST['save_products_into_session'])) {

 $_SESSION['product_total_amount_entry'] = $_POST['product_total_amount'];
 $_SESSION['coupon_code'] = $_POST['coupon_code'];
 $_SESSION['total_amount_after_discount'] = $_POST['total_amount_after_discount'];
 $_SESSION['delivery_charge'] = $_POST['delivery_charge'];
 $_SESSION['net_payable_amount'] = $_POST['net_payable_amount'];
 $_SESSION['store_id'] = $store_id;

 if (isset($_SESSION['customer_id'])) {
  $_SESSION['customer_id'] = $_SESSION['customer_id'];
 } else {
  header("location: checkout.php");
 }
} elseif (isset($_POST['SUBSCRIBE'])) {

 $store_id = $_POST['store_id'];
 $customer_id = $_SESSION['customer_id'];
 $SUBSCRIBE_PLAN_TYPE = $_POST['SUBSCRIBE_PLAN_TYPE'];

 $date_time = date("dmy");

 $SUBSCRIPTION_ID = $_SESSION['SUBSCRIPTION_ID'];
 $subscribe_day = date("D");
 $subscribe_date = date("d");
 $susbcribe_month = date("m");
 $subscribe_year = date("Y");
 $SUBSCRIPTION_STATUS = "ACTIVE";
 date_default_timezone_set("Asia/Calcutta");
 $APPLY_DATE = date("d M, Y");
 $payment_cycle = $_POST['payment_cycle'];
 $payment_mode = $_POST['payment_mode'];
 $delivery_address = $_POST['delivery_address'];
 $START_DATE = $_POST['START_DATE'];

 $sql = "SELECT * FROM subscription_cart where customer_id='$customer_id' and store_id='$store_id'";
 $query = mysqli_query($con, $sql);
 while ($fetch = mysqli_fetch_assoc($query)) {
  $SUB_REFENCE_ID[] = $fetch['subs_refrenece_id'];
 }

 foreach ($SUB_REFENCE_ID as $ref_id) {
  $sql = "SELECT * from subscription_cart where subs_refrenece_id='$ref_id'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  $customer_subscription_id = $fetch['customer_subscription_id'];
  $product_title = $fetch['product_name'];
  $product_tags = $fetch['product_tags'];
  $product_offer_price = $fetch['product_offer_price'];
  $product_mrp_price = $fetch['product_mrp_price'];
  $product_quantity = $fetch['product_quantity'];
  $product_img = $fetch['product_img'];
  $brand_title = $fetch['brand_title'];
  $product_mrp_total = $product_mrp_price * $product_quantity;
  $product_total_price = $product_offer_price * $product_quantity;
  $sql = "INSERT INTO subscription_products (customer_subscription_id, product_name, product_tags, product_offer_price, product_mrp_price, product_quantity, product_img, customer_id, store_id, brand_title, product_total_price, product_mrp_total) VALUES ('$customer_subscription_id', '$product_title', '$product_tags', '$product_offer_price', '$product_mrp_price', '$product_quantity', '$product_img', '$customer_id', '$store_id', '$brand_title', '$product_total_price', '$product_mrp_total')";

  mysqli_query($con, $sql);
 }
 $sql = "DELETE from subscription_cart where customer_subscription_id='$SUBSCRIPTION_ID'";
 $query = mysqli_query($con, $sql);
 if ($query == true) {

  $sql = "INSERT INTO customer_subscriptions (customer_subscription_id, customer_id, store_id, SUBSCRIBE_PLAN_TYPE, subscribe_day, subscribe_date, subscribe_month, subscribe_year, SUBSCRIPTION_STATUS, SUBS_APPLY_DATE, delivery_address, SUBS_START_DATE) VALUES ('$SUBSCRIPTION_ID', '$customer_id', '$store_id', '$SUBSCRIBE_PLAN_TYPE', '$subscribe_day', '$subscribe_date', '$susbcribe_month', '$subscribe_year', '$SUBSCRIPTION_STATUS', '$APPLY_DATE', '$delivery_address', '$START_DATE')";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
   $sql = "INSERT INTO customer_subscription_payments (customer_subscription_id, customer_id, store_id, payment_cycle, payment_mode) VALUE ('$SUBSCRIPTION_ID', '$customer_id', '$store_id', '$payment_cycle', '$payment_mode')";
   $query =  mysqli_query($con, $sql);
   if ($query == true) {
    if ($SUBSCRIBE_PLAN_TYPE == "CUSTOMDAYS") {
     foreach ($_POST['CUSTOMDAYS'] as $WEEKDAYS) {
      $DAYS_CONVERT = strtoupper(date("D", strtotime($WEEKDAYS)));
      $sql = "INSERT into customer_subscriptions_days (customer_subscription_id, customer_id, store_id, SUBSCRIBE_PLAN_TYPE, SUBSCRIPTION_DATES, SUBSCRIPTION_DAYS, SUBS_START_DATE) VALUES ('$SUBSCRIPTION_ID', '$customer_id', '$store_id', '$SUBSCRIBE_PLAN_TYPE', '$WEEKDAYS', '$DAYS_CONVERT', '$START_DATE')";
      $query = mysqli_query($con, $sql);
     }
     if ($query == true) {
      header("location: subs_details.php?id=$SUBSCRIPTION_ID");
     } else {
      header("location: error.php?err=Unable to Subscribe!");
     }
    } elseif ($SUBSCRIBE_PLAN_TYPE == "WEEKENDS_PLAN") {
     foreach ($_POST['WEEKENDS_PLAN_DAYS'] as $DAYS) {
      $DAYS_CONVERT = strtoupper(date("D", strtotime($DAYS)));
      $sql = "INSERT into customer_subscriptions_days (customer_subscription_id, customer_id, store_id, SUBSCRIBE_PLAN_TYPE, SUBSCRIPTION_DATES, SUBSCRIPTION_DAYS, SUBS_START_DATE) VALUES ('$SUBSCRIPTION_ID', '$customer_id', '$store_id', '$SUBSCRIBE_PLAN_TYPE', '$DAYS', '$DAYS_CONVERT', '$START_DATE')";
      $query = mysqli_query($con, $sql);
     }
     if ($query == true) {
      header("location: subs_details.php?id=$SUBSCRIPTION_ID");
     } else {
      header("location: error.php?err=Unable to Subscribe!");
     }
    } elseif ($SUBSCRIBE_PLAN_TYPE == "DAILY_PLAN") {
     $DELIVERY_DAYS = "DAILY_PLAN";
     $sql = "INSERT into customer_subscriptions_days (customer_subscription_id, customer_id, store_id, SUBSCRIBE_PLAN_TYPE, SUBSCRIPTION_DATES, SUBSCRIPTION_DAYS, SUBS_START_DATE) VALUES ('$SUBSCRIPTION_ID', '$customer_id', '$store_id', '$SUBSCRIBE_PLAN_TYPE', '$DELIVERY_DAYS', 'DAILY_PLAN', '$START_DATE')";
     $query = mysqli_query($con, $sql);
     if ($query == true) {
      header("location: subs_details.php?id=$SUBSCRIPTION_ID");
     } else {
      header("location: error.php?err=Unable to Subscribe!");
     }
    }
   }
  }
 }
} elseif (isset($_POST['ADD_ITEM_SUBSCRIBER_LIST'])) {
 $cr_url = $_POST['cr_url'];
 $store_id = $_POST['store_id'];
 $customer_id = $_SESSION['customer_id'];
 $product_title = $_POST['product_title'];
 $product_tags = $_POST['product_tags'];
 $product_offer_price = $_POST['product_offer_price'];
 $product_mrp_price = $_POST['product_mrp_price'];
 $product_quantity = 1;
 $product_img = $_POST['product_img'];
 $brand_title = $_POST['brand_title'];
 $product_mrp_total = $product_mrp_price * $product_quantity;
 $product_total_price = $product_offer_price * $product_quantity;
 if (isset($_SESSION['SUBSCRIPTION_ID'])) {
  $SUBSCRIPTION_ID = $_SESSION['SUBSCRIPTION_ID'];
 } else {
  $_SESSION['SUBSCRIPTION_ID'] = "C$customer_id" . "D$date_time" . "I" . rand(100, 99999999);
  $SUBSCRIPTION_ID = $_SESSION['SUBSCRIPTION_ID'];
 }

 $ip_address = get_ip();
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
 $device_info = "$ip_address$device_type$date_time_c$ipv6_n$ipv6_p$os$OS_release$OS_Version$System_Info$System_more_Info";

 $sql = "SELECT * from subscription_products where product_name='$product_title' and customer_id='$customer_id'";
 $query = mysqli_query($con, $sql);
 $fetch = mysqli_fetch_assoc($query);
 if ($fetch == true) {
  header("location:  $cr_url?&note=Item Already Subscribed!");
 } else {
  $sql = "INSERT INTO subscription_cart (customer_subscription_id, product_name, product_tags, product_offer_price, product_mrp_price, product_quantity, product_img, customer_id, store_id, brand_title, product_total_price, product_mrp_total, device_info) VALUES ('$SUBSCRIPTION_ID', '$product_title', '$product_tags', '$product_offer_price', '$product_mrp_price', '$product_quantity', 'pro_img/$product_img', '$customer_id', '$store_id', '$brand_title', '$product_total_price', '$product_mrp_total', '$device_info')";
  $query =  mysqli_query($con, $sql);

  if ($query == true) {
   header("location: subscribe.php");
  } else {
   header("location: subscribe.php");
  }
 }
} elseif (isset($_POST['save_combo_to_cart'])) {
 $combo_product_id = "";
 $quantity = $_POST['quantity'];
 $store_id = $_POST['store_id'];
 $ip_address = $_POST['ip_address'];
 $cr_url = $_POST['cr_url'];
 $combo_id = $_POST['combo_id'];
 $offer_price_total = $_POST['offer_price_total'];
 $customer_id = $_SESSION['customer_id'];
 $cart_add_date = date("d M Y h:m A");

 $sql = "SELECT * FROM combos_products where combo_id='$combo_id'";
 $query = mysqli_query($con, $sql);
 $fetch = mysqli_fetch_assoc($query);
 $Combo_title = $fetch['Combo_title'];
 $mrp_total = $fetch['mrp_total'];
 $combo_type = $fetch['combo_type'];
 $combo_img = $fetch['combo_img'];

 $sql = "SELECT * FROM combo_products_list where combo_id='$combo_id'";
 $query =  mysqli_query($con, $sql);
 while ($fetch = mysqli_fetch_assoc($query)) {
  $combo_product_id .= "-" . $fetch['combo_product_id'] . "- Rs." . $fetch['product_mrp_price'] . "<br>";
 }

 $sql = "SELECT * from customer_cart where customer_id='$customer_id' and combo_id='$combo_id'";
 $query = mysqli_query($con, $sql);
 $count_it = mysqli_num_rows($query);
 if ($count_it != 0) {
  header("location: $cr_url?&note=Combo Already In Cart!");
 } else {
  $sql = "INSERT INTO customer_cart (customer_id, user_product_id, product_mrp, product_price, product_total_amount, mrp_total, combo_id, combo_price, cart_add_date, store_id, product_quantity, product_img) VALUES ('$customer_id', '$Combo_title<br> $combo_product_id', '$mrp_total', '$offer_price_total', '$offer_price_total', '$mrp_total', '$combo_id', '$offer_price_total', '$cart_add_date', '$store_id', '1', 'combo_img/$combo_img')";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
   header("location: $cr_url?&note=Combo Save in Cart!");
  } else {
   header("location: $cr_url?&note=Unbale to Save Combo!");
  }
 }
} elseif (isset($_POST['ADD_ITEM_SUBSCRIPTION_LIST'])) {
 $SUBSCRIPTION_ID = $_POST['SUBSCRIPTION_ID'];
 $customer_id = $_SESSION['customer_id'];
 $product_title = $_POST['product_title'];
 $product_tags = $_POST['product_tags'];
 $product_offer_price = $_POST['product_offer_price'];
 $product_mrp_price = $_POST['product_mrp_price'];
 $product_quantity = $_POST['product_quantity'];
 $product_img = $_POST['product_img'];
 $brand_title = $_POST['brand_title'];
 $store_id = $_POST['store_id'];
 $product_mrp_total = $product_mrp_price * $product_quantity;
 $product_total_price = $product_offer_price * $product_quantity;
 $product_type = "ADD_ON";
 $cr_url = $_POST['cr_url'];

 $sql = "INSERT INTO subscription_products(customer_subscription_id, store_id, customer_id, product_name, brand_title, product_img, product_tags, product_offer_price, product_mrp_price, product_quantity, product_total_price, product_mrp_total, product_type) VALUES ('$SUBSCRIPTION_ID', '$store_id', '$customer_id', '$product_title', '$brand_title', 'pro_img/$product_img', '$product_tags', '$product_offer_price', '$product_mrp_price', '$product_quantity', '$product_total_price', '$product_mrp_price', '$product_type')";
 $query = mysqli_query($con, $sql);
 if ($query == true) {
  header("location: subs_details.php?id=$SUBSCRIPTION_ID&note=$product_title is Add into Subscription ID:$SUBSCRIPTION_ID!");
 } else {
  header("location: subs_details.php?id=$SUBSCRIPTION_ID&note=Sorry, $product_title is not Saved into Subscription!");
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
  header("location: support.php?msg=Query Send Successfully!");
 } else {
  header("location: support.php?msg=Unable to Send Query.");
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
} else {
 header("location: error.php?err=InValidInsertRequest!");
}
