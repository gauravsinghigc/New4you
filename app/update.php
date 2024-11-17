<?php
ini_set("display_errors",1);
require 'files.php';
require 'session.php';
require 'text.php';
if (isset($_POST['update_cart'])) {
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
    header("location: cart.php?msg=Cart Quantity updated");
  } else {
    header("location: cart.php?msg=failed to Update Qty");
  }
} elseif (isset($_GET['active_address'])) {
  $address_id = $_GET['active_address'];
  $customer_id = $_SESSION['customer_id'];
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
    $cart_msg = "Quantity Can't be Zero!";
  } else {
    $newqty = $newqty;
    $cart_msg = "Quantity Decreased!";
  }

  $new_price = $newqty * $product_price;
  $new_mrp = $newqty * $product_mrp;
  $sql = "UPDATE customer_cart SET product_quantity='$newqty', product_total_amount='$new_price', mrp_total='$new_mrp' where cart_id='$cart_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: cart.php?msg=$cart_msg");
  } else {
    header("location: cart.php?msg=Unable to Decrease Quantity!");
  }
} elseif (isset($_POST['INCREASE'])) {
  $cart_id = $_POST['cart_id'];
  $product_price = $_POST['product_price'];
  $quantity = $_POST['quantity'];
  $product_mrp = $_POST['product_mrp'];
  $cr_url = $_POST['cr_url'];

  $newqty = $quantity;
  $newqty++;

  if($newqty > 10){
    $newqty = 10;
    $cart_msg = "Quantity can't be Greater than 10";
  } else {
    $newqty = $newqty;
    $cart_msg = "Quantity Increased";
  }

  $new_price = $newqty * $product_price;
  $new_mrp = $newqty * $product_mrp;
  $sql = "UPDATE customer_cart SET product_quantity='$newqty', product_total_amount='$new_price', mrp_total='$new_mrp' where cart_id='$cart_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: cart.php?msg=$cart_msg");
  } else {
    header("location: cart.php?msg=Unable to Increse Quantity!");
  }
} elseif (isset($_POST['update_customer_address'])) {
  $customer_id = $_SESSION['customer_id'];
  $sql = "SELECT * from customers where customer_id='$customer_id'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  $customer_mail_id = $fetch['customer_mail_id'];
  $customer_name = $fetch['customer_name'];
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
    NOTIFICATION_ALERT(
      $TITLE = "Address Updated Successfully!", 
      $DESC = "Dear $customer_name, Your Delivery Address is updated Recently. Your New address is <br> $street_address, $area_locality, $customer_city, $customer_state, $address_pincode, <br><b>Contact Person :</b> $contact_person, <br><b>Alternate Phone :</b> $alternate_phone", 
      $STATUS = "NEW"
     );
     SendMail(
             $Valid = "true",
             $Subject = "Address Updated",
             $Title = "Dear <b>$customer_name</b>",
             $CustomerMailId = "$customer_mail_id",
             $MAIL_MSG = "<p>Your Delivery Address is Successfully. Your New address is <br>$street_address, $area_locality, $customer_city, $customer_state, $address_pincode, <br><b>Contact Person :</b> $contact_person, <br><b>Alternate Phone :</b> $alternate_phone.</p>"
    );
    header("location: account.php?msg=Address Updated Successfully!");
  } else {
    header("location: account.php?msg=Unable to Update Address!");
  }
} elseif (isset($_GET['subs_deactivate'])) {
  $subs_deactivate = $_GET['subs_deactivate'];
  $cr_url = $_GET['cr_url'];
  $action = $_GET['action'];
  $sql = "UPDATE customer_subscriptions SET SUBSCRIPTION_STATUS='$action' where customer_subscription_id='$subs_deactivate'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
    header("location: subs_details.php?id=$subs_deactivate&msg=Subscription will be Paused!");
  } else {
    header("location: subs_details.php?id=$subs_deactivate");
  }
}elseif(isset($_POST['DECREASE_SUBS'])){
 $subs_refrenece_id = $_POST['subs_refrenece_id'];
 $product_offer_price = $_POST['product_offer_price'];
 $quantity = $_POST['quantity'];
 $product_mrp_price = $_POST['product_mrp_price'];
 $newqty = $quantity;
 $newqty--;
 if ($newqty == 0) {
   $newqty = 1;
 } else {
   $newqty = $newqty;
 }
 $new_price = $newqty * $product_offer_price;
 $new_mrp = $newqty * $product_mrp_price;
 $sql = "UPDATE subscription_cart SET product_quantity='$newqty', product_total_price='$new_price', product_mrp_total='$new_mrp' where subs_refrenece_id='$subs_refrenece_id'";
 $query = mysqli_query($con, $sql);
 if($query ==  true){
header("location: subscribe.php?msg=Quantity Decreased!");
} else {
  header("location: subscribe.php?msg=Unable to Decrease Quantity!");
}
} elseif(isset($_POST['INCREASE_SUBS'])){
 $subs_refrenece_id = $_POST['subs_refrenece_id'];
 $product_offer_price = $_POST['product_offer_price'];
 $quantity = $_POST['quantity'];
 $product_mrp_price = $_POST['product_mrp_price'];
 $newqty = $quantity;
 $newqty++;
 $new_price = $newqty * $product_offer_price;
 $new_mrp = $newqty * $product_mrp_price;
 $sql = "UPDATE subscription_cart SET product_quantity='$newqty', product_total_price='$new_price', product_mrp_total='$new_mrp' where subs_refrenece_id='$subs_refrenece_id'";
 $query = mysqli_query($con, $sql);
 if($query ==  true){
  header("location: subscribe.php?msg=Quantity Increased!");
 } else {
  header("location: subscribe.php?msg=Unable to Increase Quantity!");
 }
}elseif(isset($_POST['DECREASE_COMBO'])){
 $combo_items_id = $_POST['combo_items_id'];
 $product_mrp_price = $_POST['product_mrp_price'];
 $quantity = $_POST['quantity'];
 $product_mrp_price = $_POST['product_mrp_price'];
 $newqty = $quantity;
 $newqty--;
 if ($newqty == 0) {
   $newqty = 1;
 } else {
   $newqty = $newqty;
 }
 $new_price = $newqty * $product_offer_price;
 $new_mrp = $newqty * $product_mrp_price;
 $sql = "UPDATE customer_cart SET product_quantity='$newqty', product_total_amount='$new_price', product_mrp_total='$new_mrp' where combo_id='$combo_items_id'";
 $query = mysqli_query($con, $sql);
 if($query ==  true){
  header("location: cart.php?note=Quantity Increased!");
 } else {
  header("location: cart.php?note=Unable to Increase Quantity!");
 }
} elseif(isset($_POST['INCREASE_COMBO'])){
 $combo_items_id = $_POST['combo_items_id'];
 $product_mrp_price = $_POST['product_mrp_price'];
 $quantity = $_POST['quantity'];
 $product_mrp_price = $_POST['product_mrp_price'];
 $newqty = $quantity;
 $newqty++;
 $new_price = $newqty * $product_mrp_price;
 $new_mrp = $newqty * $product_mrp_price;
 $sql = "UPDATE customer_cart SET product_quantity='$newqty', product_total_amount='$new_price', product_mrp_total='$new_mrp' where combo_id='$combo_items_id'";
 $query = mysqli_query($con, $sql);
 if($query ==  true){
  header("location: cart.php?note=Quantity Increased!");
 } else {
  header("location: cart.php?note=Unable to Increase Quantity!");
 }
} elseif(isset($_POST['DECREASE_SUBS_ITEMS'])){
 $subs_refrenece_id = $_POST['subs_refrenece_id'];
 $product_offer_price = $_POST['product_offer_price'];
 $quantity = $_POST['quantity'];
 $product_mrp_price = $_POST['product_mrp_price'];
 $newqty = $quantity;
 $newqty--;
 if ($newqty == 0) {
   $newqty = 1;
 } else {
   $newqty = $newqty;
 }
 $new_price = $newqty * $product_offer_price;
 $new_mrp = $newqty * $product_mrp_price;
 $sql = "UPDATE subscription_products SET product_quantity='$newqty', product_total_price='$new_price', product_mrp_total='$new_mrp' where customer_subscription_id='$subs_refrenece_id'";
 $query = mysqli_query($con, $sql);
 if($query ==  true){
header("location: subs_details.php?id=$subs_refrenece_id");
} else {
  header("location: subs_details.php?id=$subs_refrenece_id");
}
} elseif(isset($_POST['INCREASE_SUBS_ITEMS'])){
 $subs_refrenece_id = $_POST['subs_refrenece_id'];
 $product_offer_price = $_POST['product_offer_price'];
 $quantity = $_POST['quantity'];
 $product_mrp_price = $_POST['product_mrp_price'];
 $newqty = $quantity;
 $newqty++;
 $new_price = $newqty * $product_offer_price;
 $new_mrp = $newqty * $product_mrp_price;
 $sql = "UPDATE subscription_products SET product_quantity='$newqty', product_total_price='$new_price', product_mrp_total='$new_mrp' where customer_subscription_id='$subs_refrenece_id'";
 $query = mysqli_query($con, $sql);
 if($query ==  true){
  header("location: subs_details.php?id=$subs_refrenece_id");
 } else {
  header("location: subs_details.php?id=$subs_refrenece_id");
 }
} elseif(isset($_POST['Update_Password'])){
  $customer_id = $_SESSION['C_PHONE_NUMBER'];
  $pass_1 = $_POST['pass_1'];
  $pass_2 = $_POST['pass_2'];

  if($pass_1 == $pass_2){
    $sql = "UPDATE customers SET customer_password='$pass_1' where customer_phone_number='$customer_id'";
    $query = mysqli_query($con, $sql);
    if($query == true){
      header("location: changes.php?pass_update=true");
    }
  } else {
    header("location: changes.php?msg=Password Do Not Match!");
  }
}
    ?>
