<?php
session_start();
require 'files.php';
ini_set("display_errors", 1);
date_default_timezone_set("Asia/Calcutta");
$CURRENT_DATE_TIME = date("Y-m-d h:m:s A");

if (isset($_POST['SAVE_USER_TYPES'])) {
  $USER_TYPE_TITLE = $_POST['USER_TYPE_TITLE'];
  $USER_TYPE_DATE_TIME = $CURRENT_DATE_TIME;
  $CR_URL = $_POST['CR_URL'];

  $CheckExistingData = "SELECT * FROM user_types where user_type_title='$USER_TYPE_TITLE'";
  $CheckExistingDataQuery = mysqli_query($con, $CheckExistingData);
  $CountExistingData = mysqli_num_rows($CheckExistingDataQuery);
  if ($CountExistingData == 0) {
    $SaveUserType = "INSERT INTO user_types (user_type_title, user_type_date) VALUES ('$USER_TYPE_TITLE', '$USER_TYPE_DATE_TIME')";
    $SaveUserTypeQuery = mysqli_query($con, $SaveUserType);
    if ($SaveUserTypeQuery == true) {
      header("location: $CR_URL?t=success&m=Registered&a=USER type $USER_TYPE_TITLE is Saved Successfully!");
    } else {
      header("location: $CR_URL?t=danger&m=Failed&a=Unable to Save $USER_TYPE_TITLE");
    }
  } else {
    header("location: $CR_URL?t=warning&m=Failed&a=$USER_TYPE_TITLE is Already Exits in User Types");
  }
} elseif (isset($_POST['REGISTER_NEW_USER'])) {

  //reg user start
  $cr_url = $_POST['cr_url'];
  $USER_ROLE = $_POST['user_role'];
  $full_name = $_POST['full_name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password_2 = $_POST['password_2'];
  $email_id = $_POST['email_id'];
  $phone_number = $_POST['phone_number'];
  $user_address = $_POST['user_address'];
  $user_arealocality = $_POST['user_arealocality'];
  $user_city = $_POST['user_city'];
  $user_state = $_POST['user_state'];
  $user_pincode = $_POST['user_pincode'];
  $DateTime = $CURRENT_DATE_TIME;
  $user_status = "Inactive";
  $user_verification = "Unverified";
  $tnc = "FALSE";
  $ref = $_SESSION['user_id'];
  $user_type = $_POST['user_type'];
  $user_add_day = date("d");
  $user_add_month = date("m");
  $user_add_year = date("Y");

  $CheckExistingUserData = "SELECT * FROM users where email_id='$email_id' and phone_number='$phone_number'";
  $CheckExistingUserDataQuery = mysqli_query($con, $CheckExistingUserData);
  $CountExistingUserData = mysqli_num_rows($CheckExistingUserDataQuery);

  if ($CheckExistingUserData == 0) {
    //check data duplicate or not

    if ($password == $password_2) {
      //password match

      $SaveNewUserData = "INSERT INTO users (full_name, username, password, email_id, phone_number, user_address, user_arealocality, user_city, user_state, user_pincode, date_time, user_role, user_status, user_type, user_verification, tnc, ref, user_add_day, user_add_month, user_add_year) VALUES
          ('$full_name', '$username', '$password', '$email_id', '$phone_number', '$user_address', '$user_arealocality', '$user_city', '$user_state', '$user_pincode', '$DateTime', '$USER_ROLE', '$user_status', '$user_type', '$user_verification', '$tnc', '$ref', '$user_add_day', '$user_add_month', '$user_add_year')";

      $SaveNewUserDataQuery = mysqli_query($con, $SaveNewUserData);

      if ($SaveNewUserDataQuery == true) {
        SendMail(
          $Valid = "true",
          $Subject = "Account Created",
          $Title = "Registration Completed",
          $CustomerMailId = "$customer_mail_id",
          $MAIL_MSG = "<p>Dear <b>$customer_name</b>,<br>Your account is created Successfully on $StoreName.</p>
             <p><b>User Details</b><br>
             $customer_name<br>$customer_mail_id<br>$customer_phone_number<br>$user_address, $user_arealocality, $user_city, $user_state - $user_pincode</p>
             <p><b>Login Details</b><br>
             Login Url : $StoreName<br>
             Username : $customer_phone_number<br>
             Password : $customer_phone_number</p>
             <p>For Stay Connected with us Download $StoreName App from Play Store Now.</p>",
          $ResponseUrl = "$cr_url?t=success&m=Registered&a=$full_name is Registered Successfully and Registration Details are sent to Your mail id."
        );
      } else {
        header("location: $cr_url?t=warning&m=warning&a=Unable to Save $full_name");
      }

      //password do not match
    } else {
      header("location: $cr_url?t=warning&m=ERROR&a=Password Do Not Match");
    }

    //check data duplicate or not with else
  } else {
    header("location: $cr_url?t=warning&m=ERROR&a=$full_name is Already Exists. Please Try with another USERNAME and Email Id");
  }

  //reg user end with else add
} elseif (isset($_POST['SAVE_DOCUMENTS'])) {
  $user_id = $_POST['user_id'];
  $cr_url = $_POST['cr_url'];
  $document_id = $_POST['document_id'];
  $document_file = $_FILES['document_file']['name'];
  $tmp_name = $_FILES['document_file']['tmp_name'];
  $dir      = "USER_DATA/userdoc/";
  move_uploaded_file($_FILES['document_file']['tmp_name'], $dir . $document_file);

  $sql = "INSERT into user_documents (user_id, document_id, document_file, document_add_date) VALUES ('$user_id', '$document_id', '$document_file', '$CURRENT_DATE_TIME')";
  $query =  mysqli_query($con, $sql);
  if ($query == true) {
    header("location: $cr_url?t=success&m=Saved&a=Document Uploaded Successfully!");
  } else {
    header("location: $cr_url?t=danger&m=Failed&a=Unable to Upload Documents");
  }
} elseif (isset($_POST['REGISTER_NEW_STORE'])) {
  $cr_url = $_POST['cr_url'];
  $store_ref_id = $_SESSION['user_id'];
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
  $store_activation_fee = $_POST['store_activation_fee'];
  $store_add_date = $CURRENT_DATE_TIME;
  $store_add_day = date("d");
  $store_add_month = date("M");
  $store_add_year = date("Y");
  $upper_id = $_POST['upper_id'];

  $store_status = "Inactive";
  $store_visibility = "hide";
  $activation_fee_status = "NOT_ACTIVATED";

  $domain_type = $_POST['domain_type'];
  $domain_avaibility = $_POST['domain_avaibility'];
  $domain = $_POST['domain'];
  $add_date = $CURRENT_DATE_TIME;
  $domain_status = "Inactive";

  $pg_mode = "PROD";
  $pg_mid = $_POST['pg_mid'];
  $pg_key = $_POST['pg_key'];
  $pg_web = $_POST['pg_web'];
  $pay_gate_status = "Inactive";
  $payment_use = $_POST['payment_use'];
  $pay_gate_status = "Inactive";

  $sql = "INSERT into stores
  (user_id, store_name, store_phone, store_mail_id, store_description, store_address, store_arealocality, store_city, store_state, store_pincode, store_activation_fee, activation_fee_status, store_add_day, store_add_date, store_add_month, store_add_year, store_status, store_visibility, store_ref_id, upper_id)
  VALUES
  ('$user_owner_id', '$store_name', '$store_phone', '$store_mail_id', '$store_description', '$store_address', '$store_arealocality', '$store_city', '$store_state', '$store_pincode', '$store_activation_fee', '$activation_fee_status', '$store_add_day', '$store_add_date', '$store_add_month', '$store_add_year', '$store_status', '$store_visibility', '$store_ref_id', '$upper_id')";
  $query = mysqli_query($con, $sql);

  if ($query == true) {
    $selectlaststore = "SELECT * from stores ORDER BY store_id DESC";
    $query = mysqli_query($con, $selectlaststore);
    $fetch = mysqli_fetch_assoc($query);
    $store_id = $fetch['store_id'];

    $save_domain = "INSERT into store_domains
    (domain_type, domain_avaibility, domain, store_id, add_date, domain_status)
    VALUES
    ('$domain_type', '$domain_avaibility', '$domain', '$store_id', '$add_date', '$domain_status')";
    $domain_query =  mysqli_query($con, $save_domain);
    if ($domain_query == true) {
      $pg_sql = "INSERT INTO payment_gateway (store_id, payment_use, pg_mode, pg_mid, pg_key, pg_web, pay_gate_status) VALUES
      ('$store_id', '$payment_use', '$pg_mode', '$pg_mid', '$pg_key', '$pg_web', '$pay_gate_status')";
      $pg_query =  mysqli_query($con, $pg_sql);
      if ($pg_query == true) {
        // Subject
        $message = "";
        $subject = "$store_name is Created Successfuly at Mobilabs.in";
        $sms_mail = "notification@mobilabs.in";
        $reply_mail = "support@mobilabs.in";
        $sendto = $email_id;
        $IpAddress = ip_address();


        // Set Message
        $message = "<body style='text-shadow: 0px 0px 0.5px grey;font-weight: 400;'>

<h2>$store_name is Created Successfuly at Mobilabs.in</h2>  <hr>

<p><B>Dear $store_name, you store is created on Mobilabs.in at $store_add_date with Subscription Status = $activation_fee_status. Please pay Store Activation Fee of Rs.$store_activation_fee and start selling Your products Online. Share with your customers, suggestion them to order items via Mobi Store App and Item are delievered at their door step while sitting at home in this Situation where outside shopping and buying daily essential goods is not easy Now days.</p>

<p>Please Check one view on your Store Details:</p>

<table style='width:100%;text-align:left;font-size:12px;'>
<tr><td colspan=2>$store_add_date</td></tr>

<tr><td colspan=2>Store Information</td></tr>
<tr><td>Store Name : </td><td> $store_name</td></tr>
<tr><td>Store MailID:  </td><td> $email_id </td></tr>
<tr><td>Phone </td><td> $store_phone</td></tr>
<tr><td>ADDRESS </td><td> $store_address, $store_arealocality, $store_city, $store_state - $store_pincode</td></tr>
<tr<td>USER ROLE</TD><td> $fetch_user_role_title</td></tr>

<tr><td colspan=2>Domain Details</td></tr>
<tr><td>Domain type </td><td> $domain_type </td></tr>
<tr><td>Domain Avaibility </td><td> $domain_avaibility </td></tr>
<tr><td>Domain </td><td> $domain</td></tr>
<tr><td>Domain Status </td><td> $domain_status</td></tr>

<tr><td colspan='2'>Payment Gateway</td></tr>
<tr><td>PG_USE </td><td> $payment_use</td></tr>
<tr><td>PG MODE </td><td> $pg_mode</td></tr>
<tr><td>PG MID </td><td> $pg_mid</td></tr>
<tr><td>PG KEY </td><td> $pg_key</td></tr>
<tr><td>PG WEB </td><td> $pg_web</td></tr>
<tr><td>PG Status </td><td> $pay_gate_status</td></tr>
</table>
<hr>
<p style='font-size: 12px;'><b>* Note:</b> This is a auto generated mail, send from Mobilabs.in. If you find something incorrect in this mail, than mail us at $reply_mail.</p>
</body>";

        // Set From: header
        $from =  "<" . $sms_mail . ">";

        // Email Headers
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply_mail . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        ini_set("sendmail_from", $store_mail_id); // for windows server
        $mail = mail($sendto, $subject, $message, $headers);

        if ($mail == true) {
          //mail delivered
          header("location: $cr_url?t=success&m=Saved&a=$store_name is Saved Successfully and ALL Details is Send on Registered Mail ID");
        } else {
          //mail not delivered
          header("location: $cr_url?t=success&m=Saved&a=$store_name is Saved Successfully!");
        }
      }
    }
  }
} elseif (isset($_POST['SAVE_NEW_TASKS'])) {
  $cr_url = $_POST['cr_url'];
  $tasks_executer_id = $_POST['tasks_executer_id'];
  $tasks_assign_id = $_SESSION['user_id'];
  $tasks_title = $_POST['tasks_title'];
  $tasks_desc = $_POST['tasks_desc'];
  $full_name = $_POST['full_name'];
  $email_id = $_POST['email_id'];
  $phone_number = $_POST['phone_number'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $tasks_status = $_POST['tasks_status'];
  $tasks_feedback = $_POST['tasks_feedback'];
  $tasks_followupdate = $_POST['tasks_followupdate'];
  $taska_datetime = date("d");
  $tasks_day = $_POST['tasks_day'];
  $tasks_month = $_POST['tasks_month'];
  $tasks_year = $_POST['tasks_year'];


  $sql = "INSERT into taska (tasks_assign_id, tasks_executer_id, tasks_title, tasks_desc, full_name, email_id, phone_number, address, city, state, tasks_status, taska_datetime, tasks_day, tasks_month, tasks_year, tasks_feedback, tasks_followupdate, 'feedbackdatetime')
   VALUES ('$tasks_assign_id', '$tasks_executer_id', '$tasks_title', '$tasks_desc', '$full_name', '$email_id', '$phone_number', '$address', '$city', '$state', '$tasks_status', '$taska_datetime', '$tasks_day', '$tasks_month', '$tasks_year', '$tasks_feedback', '$tasks_followupdate', '$CURRENT_DATE_TIME')";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: $cr_url?t=success&m=Assigned&a=$tasks_title Assigned!");
  } else {
    header("location: $cr_url?t=danger&m=Failed&a=Unable to Assign tasks!");
  }
} elseif (isset($_POST['DATA_TYPE'])) {
  $cr_url = $_POST['cr_url'];
  $tasks_executer_id = $_POST['tasks_executer_id'];
  $tasks_assign_id = $_SESSION['user_id'];
  $tasks_title = $_POST['tasks_title'];
  $tasks_desc = $_POST['tasks_desc'];
  $taska_datetime = date("d");
  $tasks_day = $_POST['tasks_day'];
  $tasks_month = $_POST['tasks_month'];
  $tasks_year = $_POST['tasks_year'];

  if ($_FILES['CALLING_DATA']['name']) {
    $FileName = explode(".", $_FILES['CALLING_DATA']['name']);
    if ($FileName[1] == "csv") {
      $handle = fopen($_FILES['CALLING_DATA']['tmp_name'], "r");
      $flag = true;
      while ($data = fgetcsv($handle)) {
        if ($flag) {
          $flag = false;
          continue;
        }
        if (array(null) !== $data) {
          $fullname = mysqli_real_escape_string($con, $data[0]);
          $email_id = mysqli_real_escape_string($con, $data[1]);
          $phonenumber = mysqli_real_escape_string($con, $data[2]);
          $address = mysqli_real_escape_string($con, $data[3]);
          $city = mysqli_real_escape_string($con, $data[4]);
          $state = mysqli_real_escape_string($con, $data[5]);
          $tasks_status = mysqli_real_escape_string($con, $data[6]);
          $tasks_followupdate = mysqli_real_escape_string($con, $data[7]);
          $tasks_feedback = mysqli_real_escape_string($con, $data[8]);

          $sql = "INSERT INTO taska (tasks_title, tasks_desc, full_name, phone_number, email_id, address, city, state, taska_datetime, tasks_day, tasks_month, tasks_year, tasks_status, tasks_executer_id, tasks_assign_id, tasks_feedback, tasks_followupdate, feedbackdatetime) VALUES ('$tasks_title', '$tasks_desc', '$fullname', '$phonenumber', '$email_id', '$address', '$city', '$state', '$taska_datetime', '$tasks_day', '$tasks_month', '$tasks_year', '$tasks_status', '$tasks_executer_id', '$tasks_assign_id', '$tasks_feedback', '$tasks_followupdate', '$CURRENT_DATE_TIME')";
          mysqli_query($con, $sql);
        }
      }
      fclose($handle);
      header("location: $cr_url?t=success&m=Uploaded&a=Data Uploaded Successfully!");
    }
  }
} elseif (isset($_POST['callon_data'])) {
  $cr_url = $_POST['cr_url'];
  $task_id = $_POST['task_id'];
  $tasks_count = $_POST['tasks_count'];
  $next_count = $tasks_count;
  $next_count++;
  $tasks_status = "Not Completed";
  $task_action_description = $_POST['task_action_description'];

  $sql = "UPDATE taska SET tasks_status='$tasks_status', tasks_count='$next_count' where tasks_id='$task_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    $sql = "INSERT into tasks_action (task_id, task_action_description, tasks_action_date) VALUES ('$task_id', '$task_action_description', '$CURRENT_DATE_TIME')";
    $query = mysqli_query($con, $sql);
    if ($query == true) {
      $sql = "SELECT * from tasks_action ORDER BY tasks_action_id DESC";
      $query =  mysqli_query($con, $sql);
      $fetch_action = mysqli_fetch_assoc($query);
      $action_id = $fetch_action['tasks_action_id'];
      $_SESSION['action_id'] = $action_id;
      header("location: calling.php");
    } else {
      echo "error: unable to start calling";
    }
  } else {
    echo "error: unable to start action";
  }
} elseif (isset($_POST['TASKS_FEEDBACK'])) {
  $cr_url = $_POST['cr_url'];
  $task_id = $_POST['task_id'];
  $tasks_count = $_POST['tasks_count'];
  $next_count = $tasks_count;
  $tasks_status = $_POST['tasks_status'];
  $task_action_description = $_POST['task_action_description'];
  $action_id = $_POST['action_id'];
  $feedback_start_date_time = $_POST['feedback_start_date_time'];
  $feedback_end_date_time = $_POST['feedback_end_date_time'];
  $feedback_desc = $_POST['feedback_desc'];

  $sql = "UPDATE taska SET tasks_status='$tasks_status', tasks_count='$next_count' where tasks_id='$task_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    $sql = "INSERT into tasks_feedback (action_id, feedback_title, feedback_desc, feedback_start_date_time, feedback_end_date_time) VALUES ('$action_id', '$tasks_status', '$feedback_desc', '$feedback_start_date_time', '$feedback_end_date_time')";
    $query =  mysqli_query($con, $sql);
    if ($query == true) {
      header("location: tasks_details.php?t=success&m=Rejected&a=Tasks Response is $tasks_status");
    } else {
      header("location: tasks_details.php?t=danger&m=Failed&a=Failed to Reject Tasks!");
    }
  } else {
    header("location: $cr_url?t=warning&m=Failed&a=Unable to Close!");
  }
} elseif (isset($_POST['insert_products'])) {

  $cr_url = "add_stock.php";
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

  $product_image = $_FILES['product_image']['name'];
  $product_image_tmp = $_FILES['product_image']['tmp_name'];
  $product_image_size = $_FILES['product_image']['size'];
  $product_image_ext = pathinfo($product_image, PATHINFO_EXTENSION);
  $product_image_path = "img/store_img/pro_img/";

  $allowed_file_types = array("jpg", "jpeg", "png", "gif");

  if (in_array($product_image_ext, $allowed_file_types)) {
    if ($product_image_size < 5000000) {
      $product_image_new_name = "product_" . time() . "." . $product_image_ext;
      $product_image_final_path = $product_image_path . $product_image_new_name;
      $product_image_db_path = $product_image_new_name;
      move_uploaded_file($product_image_tmp, $product_image_final_path);
    } else {
      $product_image_db_path = null;
    }
  } else {
    $product_image_db_path = null;
  }

  $Save = "INSERT INTO user_products (product_cat_id, product_sub_cat_id, product_brand_id, product_title, ProductModalNo, product_modal_for_seo, ProductSizeCapacity, product_size_capacity_status, unique_feature, ProductEdition, product_edition_status, product_warranty_in_diff_time, product_warranty_in_break, product_top_list_status, product_measure_unit, unit_type, product_offer_status, product_stock_in, product_stock_alert_on, product_type, product_offer_price, product_mrp_price, product_save_amount, product_HSN, products_taxes, product_net_price, product_return_policy_status, product_return_policy_charge_amount, product_return_time_in_days, product_installation_charge_status, product_installation_charge, product_installation_charge_pincode_wise, product_delivery_charge_status, product_delivery_charge, product_delivery_charge_pincode_wise, product_description, product_created_at, product_status, product_sort_by_order, product_image) VALUES (
    '$product_cat_id', '$product_sub_cat_id', '$product_brand_id', '$product_title', '$ProductModalNo', '$product_modal_for_seo', '$ProductSizeCapacity', '$product_size_capacity_status', '$unique_feature', '$ProductEdition', '$product_edition_status', '$product_warranty_in_diff_time', '$product_warranty_in_break', '$product_top_list_status', '$product_measure_unit', '$unit_type', '$product_offer_status', '$product_stock_in', '$product_stock_alert_on', '$product_type', '$product_offer_price', '$product_mrp_price', '$product_save_amount', '$product_HSN', '$products_taxes', '$product_net_price', '$product_return_policy_status', '$product_return_policy_charge_amount', '$product_return_time_in_days', '$product_installation_charge_status', '$product_installation_charge', '$product_installation_charge_pincode_wise', '$product_delivery_charge_status', '$product_delivery_charge', '$product_delivery_charge_pincode_wise', '$product_description', '$product_created_at', '$product_status', '$product_sort_by_order', '$product_image_db_path')";

  $query = mysqli_query($con, $Save);
  if ($query) {
    header("location: $cr_url?t=success&m=Success&a=Successfully Added!");
  } else {
    header("location: $cr_url?t=danger&m=Failed&a=Failed to Add!");
  }

  //save feedbacks
} elseif (isset($_POST['SAVE_NEW_FEEDBACK'])) {
  $cr_url = $_POST['cr_url'];
  $task_id = $_POST['task_id'];
  $tasks_status = $_POST['tasks_status'];
  $tasks_followupdate = $_POST['tasks_followupdate'];
  $tasks_feedback = $_POST['tasks_feedback'];
  $datetime = $CURRENT_DATE_TIME;

  $sql = "INSERT into tasks_feedbacks (task_id, tasks_status, tasks_feedback, tasks_followupdate, feedback_datetime) VALUES ('$task_id', '$tasks_status', '$tasks_feedback', '$tasks_followupdate', '$datetime')";
  $query  =  mysqli_query($con, $sql);
  $_SESSION["MSG_TIME"] = time();
  if ($query == true) {
    $_SESSION['MSG_SUCCESS'] = "<b>Saved:</b> New Feedback is Saved!";
    header("location: $cr_url");
  } else {
    $_SESSION['MSG_FAILED'] = "<b>Failed:</b> Unable to Saved Feedback!";
    header("location: $cr_url");
  }
} elseif (isset($_GET['SAVE_NEW_CUSTOMER'])) {

  $customer_name = $_GET['customer_name'];
  $customer_mail_id = $_GET['customer_mail_id'];
  $customer_phone_number = $_GET['customer_phone_number'];
  $custaddress = $_GET['custaddress'];
  $custcity = $_GET['custcity'];
  $custstate = $_GET['custstate'];
  $custpincode = $_GET['custpincode'];
  $arealocality = $_GET['arealocality'];
  $cr_url = $_GET['cr_url'];
  $store_id = $_GET['store_id'];
  $customer_reg_date = date("d M Y h:m A");
  $customer_add_month = date("M");
  $customer_add_date = date("d");
  $customer_add_year = date("Y");
  $customer_middlename = $_GET['customer_middlename'];
  $customer_lastname = $_GET['customer_lastname'];
  $customer_street_no = $_GET['customer_street_no'];
  $customer_addressblock = $_GET['customer_addressblock'];
  $customer_road = $_GET['customer_road'];
  $customer_other  = $_GET['customer_other'];
  $customer_sub_area = $_GET['customer_sub_area'];
  $customer_floor = $_GET['customer_floor'];

  //search customer exist or not///
  $sql = "SELECT * from customers where customer_mail_id='$customer_mail_id' and customer_phone_number='$customer_phone_number'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);

  if ($fetch == false) {
    //if customer exists
    $sql = "INSERT INTO customers
           (customer_name, customer_phone_number, customer_mail_id, customer_password, customer_reg_date, customer_add_month, customer_add_year, customer_image, store_id, arealocality, custaddress, custcity, custstate, custpincode, customer_add_date, customer_status, customer_middlename, customer_lastname, customer_street_no, customer_addressblock, customer_road, customer_other, customer_sub_area, customer_floor)
    VALUES ('$customer_name', '$customer_phone_number', '$customer_mail_id', '$customer_phone_number', '$customer_reg_date', '$customer_add_month', '$customer_add_year', 'user.jpg', '$store_id', '$arealocality', '$custaddress', '$custcity', '$custstate', '$custpincode', '$customer_add_date', 'verified', '$customer_middlename', '$customer_lastname', '$customer_street_no', '$customer_addressblock', '$customer_road', '$customer_other', '$customer_sub_area', '$customer_floor')";
    $query = mysqli_query($con, $sql);
    if ($query == true) {
      NOTIFICATION_ALERT(
        $TITLE = "Account Created",
        $DESC = "Dear $customer_name, Your account is created Successfully. Please update your account details for stay connected with us.",
        $STATUS = "NEW"
      );
      sms_data(
        $MSG = "Dear $customer_name, Your Account is Created Successfully with 24kharido App. To know more http://24kharido.in/",
        $PHONE = "$customer_phone_number"
      );

      SendMail(
        $Valid = "true",
        $Subject = "Account Created",
        $Title = "Registration Completed",
        $CustomerMailId = "$customer_mail_id",
        $MAIL_MSG = "<p>Dear <b>$customer_name</b>, You account is created Successfully on $StoreName.</p><p>Your username and password is $customer_phone_number, for login please check $StoreName.</p><p>For Stay Connected with us Download $StoreName App from Play Store Now.</p>",
        $ResponseUrl = "$cr_url?msg=$customer_name is Registered Successfully and Registration Details are sent to Your mail id."
      );
    } else {
      header("location: $cr_url?&t=warning&m=failed&a=Something Went Wrong");
    }
  } else {
    header("location: $cr_url?&t=warning&m=failed&a=Customer Already Registered!");
  }
} elseif (isset($_POST['UPLOAD_PRODUCTS'])) {
  $user_id = $_POST['user_id'];
  $product_cat_id = $_POST['product_cat_id'];
  $product_sub_cat_id = $_POST['product_sub_cat_id'];
  $product_brand_id = $_POST['product_brand_id'];
  $product_add_date = date("d M Y h:m A");
  $product_status = "Inactive";
  $product_added_by = $_SESSION['user_role'];
  $cr_url = $_POST['cr_url'];

  if ($_FILES['PRODUCT_DATA']['name']) {
    $FileName = explode(".", $_FILES['PRODUCT_DATA']['name']);
    if ($FileName[1] == "csv") {
      $handle = fopen($_FILES['PRODUCT_DATA']['tmp_name'], "r");
      $flag = true;
      while ($data = fgetcsv($handle)) {
        if ($flag) {
          $flag = false;
          continue;
        }
        if (array(null) !== $data) {
          $product_title = mysqli_real_escape_string($con, $data[0]);
          $product_img = mysqli_real_escape_string($con, $data[1]);
          $product_mrp_price = mysqli_real_escape_string($con, $data[2]);
          $product_offer_price = mysqli_real_escape_string($con, $data[3]);
          $product_tags = mysqli_real_escape_string($con, $data[4]);
          $product_desc = mysqli_real_escape_string($con, $data[5]);
          $stockcount = mysqli_real_escape_string($con, $data[6]);
          $alertcount = mysqli_real_escape_string($con, $data[7]);

          $sql = "INSERT INTO user_products (product_cat_id, user_id, product_sub_cat_id, product_brand_id, product_title, product_img, product_offer_price, product_mrp_price, product_status, product_add_date, product_desc, product_tags, product_added_by, stockcount, alertcount) VALUES ('$product_cat_id', '$user_id', '$product_sub_cat_id', '$product_brand_id', '$product_title', '$product_img', '$product_offer_price', '$product_mrp_price', '$product_status', '$product_add_date', '$product_desc', '$product_tags', '$product_added_by', '$stockcount', '$alertcount')";
          mysqli_query($con, $sql);
        }
      }
      fclose($handle);
      header("location: $cr_url?t=success&m=Uploaded&a=Data Uploaded Successfully!");
    }
  }
} elseif (isset($_POST['create_pro_cat'])) {
  $cr_url = $_POST['cr_url'];
  $store_id = $_POST['store_id'];
  $product_cat_title = $_POST['product_cat_title'];
  $product_cat_add_date = date("d M Y h:m a");
  $product_cat_status = "active";

  $user_role = $_SESSION['user_role'];

  $category_img = $_FILES['category_img']['name'];

  $category_img = $_FILES['category_img']['name'];
  $temp_name = $_FILES['category_img']['tmp_name'];
  $path = "img/store_img/cat_img/";
  move_uploaded_file($_FILES['category_img']['tmp_name'], $path . $category_img);


  $check = "SELECT * FROM product_categories where product_cat_title='$product_cat_title' and store_id='$store_id'";
  $query = mysqli_query($con, $check);
  $fetchcheck = mysqli_fetch_assoc($query);

  if ($fetchcheck == true) {
    header("location: $cr_url?t=info&m=Exists&a=$product_cat_title is Already Exists!");
  } else {

    $sql = "INSERT into product_categories (category_img, product_cat_title, product_cat_add_date, product_cat_status, store_id) VALUES ('$category_img', '$product_cat_title', '$product_cat_add_date', '$product_cat_status', '$store_id')";
    $query = mysqli_query($con, $sql);
    if ($query == true) {
      header("location: $cr_url?t=success&m=Saved&a=$product_cat_title is Saved Successfully!");
    } else {
      header("location: $cr_url?t=danger&m=Failed&a=Unable to save $product_cat_title!");
    }
  }
} elseif (isset($_POST['create_pro_sub_cat'])) {
  $product_cat_id = $_POST['product_cat_id'];
  $sub_cat_title = $_POST['sub_cat_title'];
  $sub_cat_add_date = date("d M Y h:m A");
  $sub_cat_status = "active";
  $store_id = $_POST['store_id'];
  $cr_url = $_POST['cr_url'];

  if ($product_cat_id == "null") {
    header("location: $cr_url?t=warning&m=Warning&a=Please Select Category First.");
  } else {

    $sub_cat_img = $_FILES['sub_cat_img']['name'];
    $temp_name = $_FILES['sub_cat_img']['tmp_name'];
    $path = "img/store_img/sub_cat_img/";
    move_uploaded_file($_FILES['sub_cat_img']['tmp_name'], $path . $sub_cat_img);

    $sql = "INSERT into product_sub_categories (product_cat_id, sub_cat_title, sub_cat_add_date, sub_cat_status, store_id, sub_cat_img) VALUES ('$product_cat_id', '$sub_cat_title', '$sub_cat_add_date', '$sub_cat_status', '$store_id', '$path/$sub_cat_img')";
    $query = mysqli_query($con, $sql);
    if ($query == true) {
      header("location: $cr_url?t=success&m=Saved&a=$sub_cat_title saved Successfully!");
    } else {
      header("location: $cr_url?t=danger&m=Failed&a=Unable to Save $sub_cat_title!");
    }
  }
} elseif (isset($_POST['insert_products_combo_products'])) {
  $store_id = $_POST['store_id'];
  $COMBO_TYPE = $_POST['COMBO_TYPE'];
  $Combo_title = $_POST['Combo_title'];
  $mrp_total = $_POST['mrp_total'];
  $offer_price_total = $_POST['offer_price_total'];
  $added_date = date("d M Y h:m a");

  $combo_img = $_FILES['combo_img']['name'];
  $tmp_name = $_FILES['combo_img']['tmp_name'];
  $dir = "img/store_img/combo_img/";
  move_uploaded_file($_FILES['combo_img']['tmp_name'], $dir . $combo_img);

  $sql = "INSERT INTO combos_products (store_id, Combo_title, combo_type, offer_price_total, mrp_total, added_date, combo_img, combo_status) VALUES ('$store_id', '$Combo_title', '$COMBO_TYPE', '$offer_price_total', '$mrp_total', '$added_date', '$combo_img', 'active')";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    if ($COMBO_TYPE == "SINGLE") {
      $item_1 = $_POST['item_1'];
      $product_mrp_price_1 = $_POST['product_mrp_price_1'];
      $product_offer_price_1 = $_POST['product_offer_price_1'];
      $sql = "SELECT * FROM combos_products where store_id='$store_id' ORDER BY combo_id DESC";
      $query = mysqli_query($con, $sql);
      $fetch = mysqli_fetch_assoc($query);
      $combo_id = $fetch['combo_id'];
      $sql = "INSERT INTO combo_products_list (combo_product_id, store_id, combo_id, product_mrp_price, product_offer_price) VALUES ('$item_1', '$store_id', '$combo_id', '$product_mrp_price_1', '$product_offer_price_1')";
      $query = mysqli_query($con, $sql);
      if ($query == true) {
        header("location: combo_products.php?t=success&m=Created&a=Combo Slider Created!");
      } else {
        header("location: combo_products.php?t=danger&m=Failed&a=Unable to Create Combo Data!");
      }
    } elseif ($COMBO_TYPE == "DOUBLE") {
      $item_1 = $_POST['item_1'];
      $item_2 = $_POST['item_2'];
      $product_mrp_price_1 = $_POST['product_mrp_price_1'];
      $product_offer_price_1 = $_POST['product_offer_price_1'];
      $product_mrp_price_2 = $_POST['product_mrp_price_2'];
      $product_offer_price_2 = $_POST['product_offer_price_2'];
      $sql = "SELECT * FROM combos_products where store_id='$store_id' ORDER BY combo_id DESC";
      $query = mysqli_query($con, $sql);
      $fetch = mysqli_fetch_assoc($query);
      $combo_id = $fetch['combo_id'];
      $sql = "INSERT INTO combo_products_list (combo_product_id, store_id, combo_id, product_mrp_price, product_offer_price) VALUES ('$item_1', '$store_id', '$combo_id', '$product_mrp_price_1', '$product_offer_price_1'), ('$item_2', '$store_id', '$combo_id', '$product_mrp_price_2', '$product_offer_price_2')";
      $query = mysqli_query($con, $sql);
      if ($query == true) {
        header("location: combo_products.php?t=success&m=Created&a=Combo Slider Created!");
      } else {
        header("location: combo_products.php?t=danger&m=Failed&a=Unable to Create Combo Data!");
      }
    } elseif ($COMBO_TYPE == "TRIPPLE") {
      $item_1 = $_POST['item_1'];
      $item_2 = $_POST['item_2'];
      $item_3 = $_POST['item_3'];
      $product_mrp_price_1 = $_POST['product_mrp_price_1'];
      $product_offer_price_1 = $_POST['product_offer_price_1'];
      $product_mrp_price_2 = $_POST['product_mrp_price_2'];
      $product_offer_price_2 = $_POST['product_offer_price_2'];
      $product_mrp_price_3 = $_POST['product_mrp_price_3'];
      $product_offer_price_3 = $_POST['product_offer_price_3'];
      $sql = "SELECT * FROM combos_products where store_id='$store_id' ORDER BY combo_id DESC";
      $query = mysqli_query($con, $sql);
      $fetch = mysqli_fetch_assoc($query);
      $combo_id = $fetch['combo_id'];
      $sql = "INSERT INTO combo_products_list (combo_product_id, store_id, combo_id, product_mrp_price, product_offer_price) VALUES ('$item_1', '$store_id', '$combo_id', '$product_mrp_price_1', '$product_offer_price_1'), ('$item_2', '$store_id', '$combo_id', '$product_mrp_price_2', '$product_offer_price_2'), ('$item_3', '$store_id', '$combo_id', '$product_mrp_price_3', '$product_offer_price_3')";
      $query = mysqli_query($con, $sql);
      if ($query == true) {
        header("location: combo_products.php?t=success&m=Created&a=Combo Slider Created!");
      } else {
        header("location: combo_products.php?t=danger&m=Failed&a=Unable to Create Combo Data!");
      }
    }
  }
} elseif (isset($_POST['Accept_TNC'])) {

  $tnc = $_POST['tnc'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "UPDATE users SET tnc='$tnc', user_status='active' where username='$username' and password='$password'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    $sql = "SELECT * from users where users.username='$username' and users.password='$password'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    if ($fetch == true) {

      $user_status = $fetch['user_status'];
      if ($user_status == "BLOCK" or $user_status == "Inactive" or $user_status == "LEAVED") {
        header("location: login.php?t=warning&m=Failed&a=Your Account is Deactivated! Please contact to Admin.");
      } else {
        $user_id = $fetch['user_id'];
        $user_role_id = $fetch['user_role'];
        $user_type = $fetch['user_type'];

        $sql = "SELECT * FROM user_types where user_type_id='$user_role_id'";
        $query =  mysqli_query($con, $sql);

        if ($query == true) {
          $fetch = mysqli_fetch_assoc($query);
          $user_type_title = $fetch['user_type_title'];

          $_SESSION['user_id'] = $user_id;
          $_SESSION['user_role'] = $user_type_title;
          $_SESSION['user_type'] = $user_type;

          header("location: profile.php?t=success&m=Success&a=Account is Activated, Please Upload Required Documents First.");
        } else {
          header("location: login.php?t=warning&m=failed&m=Something Went Wrong!");
        }
      }
    } else {
      header("location: login.php?t=danger&m=Invalid&a=Invalid Username and Password!");
    }
  }
} elseif (isset($_POST['create_brand'])) {
  $cr_url = $_POST['cr_url'];
  $store_id = $_POST['store_id'];
  $brand_title = $_POST['brand_title'];
  $add_date = $CURRENT_DATE_TIME;

  $brand_img = $_FILES['brand_img']['name'];
  $tmp_name = $_FILES['brand_img']['tmp_name'];
  $dir = "img/store_img/brand_img";
  move_uploaded_file($_FILES['brand_img']['tmp_name'], $dir . "/" . $brand_img);


  $sql = "SELECT * from pro_brands where brand_title='$brand_title' and store_id='$store_id'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  if ($fetch == true) {
    header("location: $cr_url?t=warning&m=Warning&a=$brand_title Brand Already Exits in Your Store!");
  } else {
    $sql = "INSERT INTO pro_brands (brand_title, brand_add_date, brand_status, store_id, brand_img) VALUES ('$brand_title', '$add_date', 'active', '$store_id', '$dir/$brand_img')";
    $query = mysqli_query($con, $sql);
    if ($query == true) {
      header("location: $cr_url?t=success&m=Saved&a=$brand_title is Saved!");
    } else {
      header("location: $cr_url?t=danger&m=Failed&a=Unable to Save $brand_title!");
    }
  }
} elseif (isset($_POST['create_store_city'])) {
  $Storeid = $_POST['store_id'];
  $Curl = $_POST['cr_url'];
  $StateName = $_POST['state_name'];
  $CityName = $_POST['city_name'];
  $AddDate = $CURRENT_DATE_TIME;

  $sql = "SELECT * from city where city_name='$CityName' and state_name='$StateName' and store_id='$Storeid'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  if ($fetch == true) {
    header("location: $Curl?t=warning&a=Warning&a=$CityName is Already Exits");
  } else {
    $sql = "INSERT INTO city (store_id, state_name, city_name, city_status, add_date) VALUES ('$Storeid', '$StateName', '$CityName', 'active', '$AddDate')";
    $query = mysqli_query($con, $sql);
    if ($query == true) {
      $CheckState = "SELECT * FROM state where state_name='$StateName'";
      $Checkquery = mysqli_query($con, $CheckState);
      $CountState = mysqli_num_rows($Checkquery);
      if ($CountState == 0) {
        $SaveStates = "INSERT INTO state (state_name, state_status, add_date) VALUES ('$StateName', 'active', '$AddDate')";
        $statequery = mysqli_query($con, $SaveStates);
        if ($statequery == true) {
          header("location: $Curl?t=success&m=Activated&a=$CityName is Activated! Please Create Services Areas in $CityName!");
        } else {
          header("location: $Curl?t=danger&m=failed&a=Unable to save $StateName");
        }
      } else {
        header("location: $Curl?t=success&m=Activated&a=$CityName is Activated! Please Create Services Areas in $CityName!");
      }
    } else {
      header("location: $Curl?t=warning&m=Failed&a=$CityName is Not Activated! ");
    }
  }
} elseif (isset($_POST["ADD_STOCK_PURCHASE"])) {
  /* This loop will iterate through all days.  */
  foreach ($_POST["PRODUCT_TITLE"] as $key => $PRODUCT_TITLE) {
    /* This loop will give start & end times for a particular day, i.e. $day */

    foreach ($PRODUCT_TITLE as $timeIndex => $startTime) {
      $PRODUCT_TITLE = $_POST["PRODUCT_TITLE"][$key][$timeIndex];
      $hindi_name = $_POST['hindi_name'][$key][$timeIndex];
      $market_price = $_POST['market_price'][$key][$timeIndex];
      $purchase_qty = $_POST['purchase_qty'][$key][$timeIndex];
      $total_price = $_POST['total_price'][$key][$timeIndex];
      $PRODUCT_TAGS = $_POST['PRODUCT_TAGS'][$key][$timeIndex];
      $purchase_day = date("D d M, Y");
      $PurchaseStock = "INSERT INTO stock_purchase (product_name, hindi_name, quantiy_purchased, market_price_per_unit, total_price, purchase_date, purchase_day) VALUES ('$PRODUCT_TITLE', '$hindi_name', '$purchase_qty $PRODUCT_TAGS', '$market_price', '$total_price', CURRENT_TIMESTAMP, '$purchase_day')";
      $PurchaseQuery = mysqli_query($con, $PurchaseStock);
      if ($PurchaseQuery == true) {
        $sql = "UPDATE ordered_products SET item_status='true' where product_names LIKE '%$PRODUCT_TITLE%'";
        $RemovePurchaseStockFromOrderedProducts = mysqli_query($con, $sql);
      }
    }
  }
  if ($RemovePurchaseStockFromOrderedProducts == true) {
    header_remove();
    header("location: purchased.php?t=success&m=Updated&a=Today Stock Purchased!");
  } else {
    header_remove();
    header("location: purchased.php?t=danger&m=Failed&a=Unable to Purchase Stock!");
  }
} elseif (isset($_POST['CREATE_SLIDER'])) {
  $slider_title = $_POST['slider_title'];
  $slider_type = $_POST['slider_type'];
  $target_url = $_POST['target_url'];
  $sortby = $_POST['sortby'];

  if ($target_url == null) {
    $target_url = "No Url Required";
  } else {
    $target_url = $target_url;
  }

  $slider_img = $_FILES['slider_img']['name'];
  $temp_name = $_FILES['slider_img']['tmp_name'];

  $dir = "img/store_img/slider/";

  move_uploaded_file($_FILES['slider_img']['tmp_name'], $dir . $slider_img);

  $sql = "INSERT INTO slider (slider_title, slider_img, target_url, slider_type, slider_status, add_time, sortby) VALUES ('$slider_title', '$slider_img', '$target_url', '$slider_type', 'active', CURRENT_TIMESTAMP, '$sortby')";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: slider.php?t=success&m=Saved&a=$slider_title is created Successfully!");
  } else {
    header("location: slider.php?t=danger&m=failed&a=$slider_title is not created!");
  }
} elseif (isset($_POST['CREATE_DELIVERY'])) {
  $customer_subscription_id = $_POST['customer_subscription_id'];
  $customer_id = $_POST['customer_id'];
  $store_id = $_POST['store_id'];
  $payment_cycle = $_POST['payment_cycle'];
  $payment_mode = $_POST['payment_mode'];
  $payment_status = $_POST['payment_status'];
  $delivery_date = $_POST['delivery_date'];
  $delivered_quantity = $_POST['delivered_quantity'];
  $payment_amount = $_POST['payment_amount'];
  $delivery_status = $_POST['delivery_status'];
  $delivery_note = $_POST['delivery_note'];
  if ($delivery_status != "DELIVERED") {
    $payment_status = "Not Available";
  } else {
    $payment_status = $payment_status;
  }
  echo "$customer_subscription_id<br>$customer_id<br>$store_id<br>$payment_cycle<br>$payment_mode<br>$payment_status<br>$delivery_date<br>$delivered_quantity<br>$payment_amount<br>$delivery_status<br>$delivery_note";
  $InsertDelivery = "INSERT into subscription_deliveries (customer_subscription_id, customer_id, store_id, delivery_date, delivery_status, delivered_quantity, payment_cycle, payment_mode, payment_status, payment_amount, delivery_note) VALUES ('$customer_subscription_id', '$customer_id', '$store_id', '$delivery_date', '$delivery_status', '$delivered_quantity', '$payment_cycle', '$payment_mode', '$payment_status', '$payment_amount', '$delivery_note')";
  $DeliveryQuery = mysqli_query($con, $InsertDelivery);
  if ($DeliveryQuery == true) {
    header_remove();
    header("location: subscription.php?t=success&m=Delivered&a=SUBSCRIPTION ID $customer_subscription_id is Delivered Successfully!");
  } else {
    header_remove();
    header("location: subscription.php?t=danger&m=Failed&a=SUBSCRIPTION ID $customer_subscription_id is not Delivered!");
  }
} elseif (isset($_POST['create_services_area'])) {
  $city_id = $_POST['city_id'];
  $area_locality = $_POST['area_locality'];
  $store_id = $_POST['store_id'];
  $area_status = "active";

  $sql = "SELECT * from services_area where area_locality='$area_locality'";
  $query = mysqli_query($con, $sql);
  $countArea = mysqli_num_rows($query);
  if ($countArea == 0) {
    $SaveServiceArea = "INSERT INTO services_area (store_id, city_id, area_locality, area_status, area_add_date) VALUES ('$store_id', '$city_id', '$area_locality', '$area_status', CURRENT_TIMESTAMP)";
    $ServiceAreaQuery = mysqli_query($con, $SaveServiceArea);
    if ($ServiceAreaQuery == true) {
      header("location: add_area.php?t=success&m=Saved&a=$area_locality is Created Successfully");
    } else {
      header("location: add_area.php?t=danger&m=Failed&a=Unable to create $area_locality");
    }
  } else {
    header("location: add_area.php?t=danger&m=Already Exits&a=$area_locality is Already Exits");
  }
} elseif (isset($_POST['WEB_TOOL_INSERT'])) {
  $NAME = $_POST['NAME'];
  $VALUE = $_POST['VALUE'];
  $sql = "INSERT into web_tools (NAME, VALUE, add_date) VALUES ('$NAME', '$VALUE', CURRENT_TIMESTAMP)";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: web_tools.php?t=success&m=Saved&a=$NAME is Saved Successfully!");
  } else {
    header("location: web_tools.php?t=danger&m=FAILED&a=Unable to Create $Name with VALUE $VALUE");
  }
} elseif (isset($_POST['SaveNewState'])) {
  $state_name = $_POST['state_name'];
  $state_status = "active";
  $add_date = date("D d M, Y");
  $CheckState = "SELECT * FROM state where state_name='$state_name'";
  $Checkquery = mysqli_query($con, $CheckState);
  $CountState = mysqli_num_rows($Checkquery);
  if ($CountState == 0) {
    $SaveStates = "INSERT INTO state (state_name, state_status, add_date) VALUES ('$state_name', '$state_status', '$add_date')";
    $statequery = mysqli_query($con, $SaveStates);
    if ($statequery == true) {
      header("location: states.php?t=success&m=Saved&a=$state_name is Saved Successfully!");
    } else {
      header("location: states.php?t=danger&m=failed&a=Unable to save $state_name");
    }
  } else {
    header("location: states.php?t=warning&m=Failed&a=$state_name is Already Exits!");
  }
} elseif (isset($_POST['SAVE_NEW_DOCUMENT_TYPE'])) {
  $CR_URL = $_POST['CR_URL'];
  $document_name = $_POST['document_name'];
  $doc_type_add_date = date("d M Y h:m A");
  $doc_type_status = "active";
  $CheckData = "SELECT * FROM user_documents_types where document_name like '%$document_name%'";
  $CheckDataQuery = mysqli_query($con, $CheckData);
  $CountData = mysqli_num_rows($CheckDataQuery);
  if ($CountData == null) {
    $InsertNewDocumentType = "INSERT INTO user_documents_types (document_name, doc_type_add_date, doc_type_status) VALUES ('$document_name', '$doc_type_add_date', '$doc_type_status')";
    $InsertQuery = mysqli_query($con, $InsertNewDocumentType);
    if ($InsertQuery == true) {
      header("location: document_types.php?t=success&m=Saved&a=$document_name is Saved Successfully!");
    } else {
      header("location: document_types.php?t=danger&m=Failed&a=Unable to Save $document_name!");
    }
  } else {
    header("location: document_types.php?t=warning&m=Exits&a=$document_name is already Exits!");
  }
} elseif (isset($_POST['SaveNewUrl'])) {

  Save_DATA(
    $tablename = "sharelinks",
    $checkrows = "linktitle='" . $_POST['linktitle'] . "'",
    $tablerows = array("linktitle", "fafacode", "linkurl", "linkaltname", "linkstatus", "linkcreatedon"),
    $auth = "0"
  );
} elseif (isset($_POST['create_product_options'])) {
  $product_id = $_POST['create_product_options'];
  $option_icon = $_POST['option_icon'];
  $option_name = $_POST['option_name'];
  $option_value = $_POST['option_value'];
  $status = $_POST['status'];
  $save = SAVE("products_options", ["product_id", "option_icon", "option_name", "option_value", "status"]);
  if ($save == true) {
    header("location: edit_product.php?t=success&m=Saved&a=$option_name is created!!");
  } else {
    header("location: edit_product.php?t=danger&m=failed&a=Unable to create $option_name");
  }
} elseif (isset($_POST['create_product_specification'])) {
  $product_id = $_POST['create_product_specification'];
  $specification_name = $_POST['specification_name'];
  $specification_value = $_POST['specification_value'];
  $status = $_POST['status'];
  $save = SAVE("product_specifications", ["product_id", "specification_name", "specification_value", "status"]);
  if ($save == true) {
    header("location: edit_product.php?t=success&m=Saved&a=$specification_name is created!!");
  } else {
    header("location: edit_product.php?t=danger&m=failed&a=Unable to create $specification_name");
  }
} else {
  header("location: error.php?err=INVALID_INSERT_ACTION_OBSERVED : invalid data insertion is blocked by system.");
}
