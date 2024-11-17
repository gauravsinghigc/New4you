<?php
session_start();
require 'config.php';
require 'text.php';
require 'include.php';

if (isset($_POST['register_customer'])) {
 $customer_name = $_POST['customer_name'];
 $customer_phone_number = $_POST['customer_phone_number'];
 $customer_mail_id = $_POST['customer_mail_id'];
 $customer_password = $_POST['customer_password'];
 $customer_password_2 = $_POST['customer_password_2'];
 $customer_reg_date = date("d M Y h:m A");
 $street_address = $_POST['street_address'];
 $area_locality = $_POST['area_locality'];
 $customer_city = $_POST['customer_city'];
 $customer_state = $_POST['customer_state'];
 $address_pincode = $_POST['address_pincode'];
 $status = "active";
 $cr_url = $_POST['cr_url'];

 $sql = "SELECT * from customers where customer_mail_id='$customer_mail_id' and customer_phone_number='$customer_phone_number'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);

  if ($fetch == true) {
    header("location: register.php?err=User Already Registered!");
  } else {
    if ($customer_password == $customer_password_2) {
    
  if(isset($_SESSION['REFER_PERSON_ID'])){
    $ReferedPersonId = $_SESSION['REFER_PERSON_ID'];
    $refer_date = date("d D M, Y");
    $sql = "SELECT * FROM referred_person where referred_phone='$customer_phone_number'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    if($fetch != true){
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
    $_SESSION['customer_id'] = $fetch['customer_id'];
    $customer_id = $fetch['customer_id'];
    $_SESSION['STORE_ID'] = $fetch['store_id'];
    $store_id = $fetch['store_id'];
    $RANDOM_OTP = rand(000000, 999999);
    $_SESSION['OTP_SESSION'] = $RANDOM_OTP;

    SMS(
$MSG="
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

        header("location: index.php?msg=Account Created Successfully!");
    }
      } else {
        header("location: $cr_url?err=Registration Failed!");
      }
    } else {
      header("location: $cr_url?err=Password Do Not Match!");
    }
  }
} elseif (isset($_POST['login_request'])) {
  $customer_mail_id = $_POST['customer_mail_id'];
  $customer_password = $_POST['customer_password'];
  $go_url = $_POST['cr_url'];

  $sql = "SELECT * from customers where customer_password='$customer_password' and customer_phone_number='$customer_mail_id'";
  $query = mysqli_query($con, $sql);
  $count_users = mysqli_num_rows($query);
  if ($count_users != 0) {
    $fetch = mysqli_fetch_assoc($query);
    $UserStatus = $fetch['customer_status'];
    $customer_phone_number = $fetch['customer_phone_number'];
    $customer_mail_id = $fetch['customer_mail_id'];
     $_SESSION['customer_id'] = $fetch['customer_id'];
    $customer_id = $fetch['customer_id'];
    $customer_name = $fetch['customer_name'];
    $_SESSION['STORE_ID'] = $fetch['store_id'];
    $store_id = $fetch['store_id'];
    setcookie("customer_id", $customer_id, time()+60*60*365);
    setcookie("store_id", $store_id, time()+60*60*365);

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

    header("location: $go_url?&msg=Welcome, $customer_name in 24kharido");
  } else {
      header("location: login.php?err=Invalid Username/Password!");
  }
} elseif (isset($_POST['save_to_cart'])) {
  $user_product_id = $_POST['user_product_id_value'];
  $quantity = $_POST['quantity'];
  $store_id = $_POST['store_id'];
  $ip_address = $_POST['ip_address'];
  mysqli_set_charset($con, 'utf8');
  $sql = "SELECT * from user_products, pro_brands where user_id='$user_id' and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.user_product_id='$user_product_id'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);

  $product_title = $fetch['product_title'];
  $hindi_name = $fetch['hindi_name'];
  $product_img = $fetch['product_img'];
  $product_offer_price = $fetch['product_offer_price'];
  $product_mrp_price = $fetch['product_mrp_price'];
  $product_tags = $fetch['product_tags'];
  $product_img = $fetch['product_img'];
  $cr_url = $_POST['cr_url'];
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
  $device_info = "$ip_address";
  if (isset($_SESSION['customer_id'])) {

    $customer_id = $_SESSION['customer_id'];
    $sql = "SELECT * from customer_cart where user_product_id='$product_title' and store_id='$store_id' and ip_address='$ip_address' and device_info='$device_info' and customer_id";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    if ($fetch == true) {
      header("location: $cr_url&err=Item Already In Cart");
    } else {
      mysqli_set_charset($con, 'utf8');
      $sql = "INSERT into customer_cart (customer_id, ip_address, device_info, user_product_id, product_tags, product_price, product_mrp, product_quantity, product_total_amount, cart_add_date, store_id, mrp_total, product_img, hindi_name, options) VALUES ('$customer_id', '$ip_address', '$user_product_id', '$product_title', '$product_tags', '$product_offer_price', '$product_mrp_price', '$quantity', '$amount', '$cart_add_date', '$store_id', '$mrp_total', 'pro_img/$product_img', '$hindi_name', '$options')";
      $query = mysqli_query($con, $sql);
    if ($query == true) {
     header("location: $cr_url?data=Product Save Into Cart Successfully!");
    }else {
      header("location: $cr_url?=Unable to Save Products into Cart!");
    }
   }

  } else {

  $sql = "SELECT * from customer_cart where user_product_id='$user_product_id' and store_id='$store_id' and ip_address='$ip_address' and device_info='$device_info'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    if ($fetch == true) {
      header("location: $cr_url?err=Item Already In Cart");
    } else {
      $sql = "INSERT into customer_cart (ip_address, device_info, user_product_id, product_tags, product_price, product_quantity, product_total_amount, cart_add_date, store_id, mrp_total) VALUES ('$ip_address', '$device_info', '$product_title', '$product_tags', '$product_offer_price', '$quantity', '$amount', '$cart_add_date', '$store_id', '$mrp_total')";
      $query = mysqli_query($con, $sql);

    if ($query == true) {
     header("location: $cr_url?data=Product Save Into Cart Successfully!");
    }else {
      header("location: $cr_url?=Unable to Save Products into Cart!");
    }
   }

 }
} elseif (isset($_POST['upload_customer_dp'])) {
  $customer_id = $_POST['customer_id'];
 $cust_dp = $_FILES['customer_image_uplaod']['name'];
 $temp_name = $_FILES['customer_image_uplaod']['tmp_name'];
 $path = "img/user_img/";

 move_uploaded_file($_FILES['customer_image_uplaod']['tmp_name'], $path.$cust_dp);

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
    }else {
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
 $store_id = $store_id;
 $_SESSION['order_id'] = "INV"."$date_time".rand(100,99999999);
 $_SESSION['delivery_address'] = "$street_address, $area_locality, $customer_city, $customer_state, $address_pincode, <br><b>Contact Person</b> $contact_person $alternate_phone";
 $_SESSION['payment_mode'] = $_POST['payment_mode'];
 header("location: payment.php?payment=true");

} elseif (isset($_GET['accept_id'])){
 $order_id = $_GET['accept_id'];
 $store_id = $_GET['store_id'];

 $sql = "UPDATE customer_orders SET order_status='Accepted' where store_id='$store_id' and order_id='$order_id'";
 $query = mysqli_query($con, $sql);
 if ($query == true) {
  header("location: order.php?msg= $order_id Accepted Successfully!");
 } else {
  header("location: order.php?warning= $order_id  Unable to Accept!");
 }
} elseif(isset($_POST['SAVE_QUERY'])){
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
  if($query == true){
    header("location: query.php?msg=Query Send Successfully!");
  } else {
    header("location: query.php?msg=Unable to Send Query.");
  }
} elseif(isset($_POST['SaveNewReview'])){
  Save_DATA(
    $tablename = "product_reviews", 
    $checkrows = "0",
    $tablerows = array("ProReviewTitle", "ProductId", "ProReviewUserType", "ProReviewCreatedOn", "ProReviewStatus", "ProReviewStarCount", "ProReviewName", "ProReviewEmail", "ProReviewDesc", "ProReviewDeviceDetails"),
    $auth = "0" );
} elseif (isset($_POST['ReviewsType'])) {
  Save_DATA(
    $tablename = "product_reviews_counts", 
    $checkrows = "0",
    $tablerows = array("ProReviewId", "ReviewsType", "ReviewsSubmittedBy", "ReviewSubmittedOn"),
    $auth = "0");
}
