<?php
require 'files.php';
require 'session.php';
$DownloadLink = "https://bit.ly/2N1QTOi";

//store information
$store_user_id = $_SESSION['user_id'];
$select_store = "SELECT * FROM stores where user_id='$store_user_id'";
$store_query = mysqli_query($con, $select_store);
$fetch_store = mysqli_fetch_assoc($store_query);
$store_id = $fetch_store['store_id'];
$store_name = $fetch_store['store_name'];
$store_phone = $fetch_store['store_phone'];
$store_mail_id = $fetch_store['store_mail_id'];
$store_address = $fetch_store['store_address'];
$store_arealocality = $fetch_store['store_arealocality'];
$store_city = $fetch_store['store_city'];
$store_state = $fetch_store['store_state'];
$store_pincode = $fetch_store['store_pincode'];

if (isset($_GET['CUSTOMER_ORDERING'])) {

  $getcustid = $_GET['customer_id'];

  if ($getcustid == "null" or $getcustid == 0) {
    ///////////////////////
    $customer_name = $_GET['customer_name'];
    $customer_mail_id = $_GET['customer_mail_id'];
    $customer_phone_number = $_GET['customer_phone_number'];
    $custaddress = $_GET['custaddress'];
    $custcity = $_GET['custcity'];
    $custstate = $_GET['custstate'];
    $custpincode = $_GET['custpincode'];
    $arealocality = $_GET['arealocality'];
    $cr_url = $_GET['cr_url'];
    $customer_middlename = $_GET['customer_middlename'];
    $customer_lastname = $_GET['customer_lastname'];
    $customer_street_no = $_GET['customer_street_no'];
    $customer_addressblock = $_GET['customer_addressblock'];
    $customer_road = $_GET['customer_road'];
    $customer_other  = $_GET['customer_other'];
    $customer_sub_area = $_GET['customer_sub_area'];
    $customer_floor = $_GET['customer_floor'];
    $contact_person = $_SESSION['contact_person'];
    $alternate_phone = $_SESSION['alternate_phone'];

    //billing address 
    $custaddress_b = $_GET['custaddress_b'];
    $custcity_b = $_GET['custcity_b'];
    $custstate_b = $_GET['custstate_b'];
    $custpincode_b = $_GET['custpincode_b'];
    $arealocality_b = $_GET['arealocality_b'];
    $customer_street_no_b = $_GET['customer_street_no_b'];
    $customer_addressblock_b = $_GET['customer_addressblock_b'];
    $customer_road_b = $_GET['customer_road_b'];
    $customer_other_b  = $_GET['customer_other_b'];
    $customer_sub_area_b = $_GET['customer_sub_area_b'];
    $customer_floor_b = $_GET['customer_floor_b'];
    $contact_person_b = $_GET['contact_person_b'];
    $alternate_phone_b = $_GET['alternate_phone_b'];


    $customer_reg_date = date("d M Y h:m A");
    $customer_add_month = date("M");
    $customer_add_date = date("d");
    $customer_add_year = date("Y");

    $sql = "INSERT INTO customers
           (customer_name, customer_phone_number, customer_mail_id, customer_password, customer_reg_date, customer_add_month, customer_add_year, customer_image, store_id, arealocality, custaddress, custcity, custstate, custpincode, customer_add_date, customer_status, customer_middlename, customer_lastname, customer_street_no, customer_addressblock, customer_road, customer_other, customer_sub_area, customer_floor)
    VALUES ('$customer_name', '$customer_phone_number', '$customer_mail_id', '$customer_phone_number', '$customer_reg_date', '$customer_add_month', '$customer_add_year', 'user.jpg', '$store_id', '$arealocality', '$custaddress', '$custcity', '$custstate', '$custpincode', '$customer_add_date', 'verified', '$customer_middlename', '$customer_lastname', '$customer_street_no', '$customer_addressblock', '$customer_road', '$customer_other', '$customer_sub_area', '$customer_floor')";
    $query = mysqli_query($con, $sql);
    if ($query == true) {

      $sql = "SELECT * FROM customers where customer_phone_number='$customer_phone_number'";
      $query =  mysqli_query($con, $sql);
      $fetch =  mysqli_fetch_assoc($query);

      $_SESSION['customer_id'] = $fetch['customer_id'];
      $_SESSION['customer_name'] = $_GET['customer_name'];
      $_SESSION['customer_mail_id'] = $_GET['customer_mail_id'];
      $_SESSION['customer_phone_number'] = $_GET['customer_phone_number'];
      $_SESSION['custaddress'] = $_GET['custaddress'];
      $_SESSION['custcity'] = $_GET['custcity'];
      $_SESSION['custstate'] = $_GET['custstate'];
      $_SESSION['custpincode'] = $_GET['custpincode'];
      $_SESSION['arealocality'] = $_GET['arealocality'];
      $_SESSION['cr_url'] = $_GET['cr_url'];
      $_SESSION['customer_middlename'] = $_GET['customer_middlename'];
      $_SESSION['customer_lastname'] = $_GET['customer_lastname'];
      $_SESSION['customer_street_no'] = $_GET['customer_street_no'];
      $_SESSION['customer_addressblock'] = $_GET['customer_addressblock'];
      $_SESSION['customer_road'] = $_GET['customer_road'];
      $_SESSION['customer_other']  = $_GET['customer_other'];
      $_SESSION['customer_sub_area'] = $_GET['customer_sub_area'];
      $_SESSION['customer_floor'] = $_GET['customer_floor'];
      $_SESSION['contact_person'] = $_GET['contact_person'];
      $_SESSION['alternate_phone'] = $_GET['alternate_phone'];
      $_SESSION['user_img'] = "$Domain/img/user_img/user.jpg";

      //billing address
      $_SESSION['custaddress_b'] = $_GET['custaddress_b'];
      $_SESSION['custcity_b'] = $_GET['custcity_b'];
      $_SESSION['custstate_b'] = $_GET['custstate_b'];
      $_SESSION['custpincode_b'] = $_GET['custpincode_b'];
      $_SESSION['arealocality_b'] = $_GET['arealocality_b'];
      $_SESSION['customer_street_no_b'] = $_GET['customer_street_no_b'];
      $_SESSION['customer_addressblock_b'] = $_GET['customer_addressblock_b'];
      $_SESSION['customer_road_b'] = $_GET['customer_road_b'];
      $_SESSION['customer_other_b']  = $_GET['customer_other_b'];
      $_SESSION['customer_sub_area_b'] = $_GET['customer_sub_area_b'];
      $_SESSION['customer_floor_b'] = $_GET['customer_floor_b'];

      $customer_id = $_SESSION['customer_id'];
      $customer_name = $_SESSION['customer_name'];
      $customer_mail_id = $_SESSION['customer_mail_id'];
      $customer_phone_number = $_SESSION['customer_phone_number'];
      $custaddress = $_SESSION['custaddress'];
      $custcity = $_SESSION['custcity'];
      $custstate = $_SESSION['custstate'];
      $custpincode = $_SESSION['custpincode'];
      $arealocality = $_SESSION['arealocality'];
      $cr_url = $_SESSION['cr_url'];
      $customer_image = $_SESSION['user_img'];
      $customer_middlename = $_SESSION['customer_middlename'];
      $customer_lastname = $_SESSION['customer_lastname'];
      $customer_street_no = $_SESSION['customer_street_no'];
      $customer_addressblock = $_SESSION['customer_addressblock'];
      $customer_road = $_SESSION['customer_road'];
      $customer_other  = $_SESSION['customer_other'];
      $customer_sub_area = $_SESSION['customer_sub_area'];
      $customer_floor = $_SESSION['customer_floor'];
      $contact_person = $_SESSION['contact_person'];
      $alternate_phone = $_SESSION['alternate_phone'];

      //billing address 
      $custaddress_b = $_SESSION['custaddress_b'];
      $custcity_b = $_SESSION['custcity_b'];
      $custstate_b = $_SESSION['custstate_b'];
      $custpincode_b = $_SESSION['custpincode_b'];
      $arealocality_b = $_SESSION['arealocality_b'];
      $customer_street_no_b = $_SESSION['customer_street_no_b'];
      $customer_addressblock_b = $_SESSION['customer_addressblock_b'];
      $customer_road_b = $_SESSION['customer_road_b'];
      $customer_other_b  = $_SESSION['customer_other_b'];
      $customer_sub_area_b = $_SESSION['customer_sub_area_b'];
      $customer_floor_b = $_SESSION['customer_floor_b'];
      $contact_person_b = $_SESSION['contact_person_b'];
      $alternate_phone_b = $_SESSION['alternate_phone_b'];

      header("location: order_products.php"); ?>

<?php }

    //////////////////////
  } else {
    ///////////////////////////
    $customer_phone_number = $_GET['customer_phone_number'];
    $customer_mail_id = $_GET['customer_mail_id'];
    $customer_id = $_GET['customer_id'];

    $sql = "SELECT * from customers where customer_id='$customer_id' and customer_phone_number='$customer_phone_number'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);

    if ($fetch == true) {
      //if customer exists
      $customer_name = $_GET['customer_name'];
      $customer_mail_id = $_GET['customer_mail_id'];
      $customer_phone_number = $_GET['customer_phone_number'];
      $custaddress = $_GET['custaddress'];
      $custcity = $_GET['custcity'];
      $custstate = $_GET['custstate'];
      $custpincode = $_GET['custpincode'];
      $arealocality = $_GET['arealocality'];
      $customer_middlename = $_GET['customer_middlename'];
      $customer_lastname = $_GET['customer_lastname'];
      $customer_street_no = $_GET['customer_street_no'];
      $customer_addressblock = $_GET['customer_addressblock'];
      $customer_road = $_GET['customer_road'];
      $customer_other  = $_GET['customer_other'];
      $customer_sub_area = $_GET['customer_sub_area'];
      $customer_floor = $_GET['customer_floor'];
      $contact_person = $_GET['contact_person'];
      $alternate_phone = $_GET['alternate_phone'];
      $cr_url = $_GET['cr_url'];

      //billing address
      $custaddress_b = $_GET['custaddress_b'];
      $custcity_b = $_GET['custcity_b'];
      $custstate_b = $_GET['custstate_b'];
      $custpincode_b = $_GET['custpincode_b'];
      $arealocality_b = $_GET['arealocality_b'];
      $customer_street_no_b = $_GET['customer_street_no_b'];
      $customer_addressblock_b = $_GET['customer_addressblock_b'];
      $customer_road_b = $_GET['customer_road_b'];
      $customer_other_b  = $_GET['customer_other_b'];
      $customer_sub_area_b = $_GET['customer_sub_area_b'];
      $customer_floor_b = $_GET['customer_floor_b'];
      $contact_person_b = $_GET['contact_person_b'];
      $alternate_phone_b = $_GET['alternate_phone_b'];

      $Update = "UPDATE customers SET customer_floor='$customer_floor', customer_middlename='$customer_middlename', customer_lastname='$customer_lastname', customer_street_no='$customer_street_no', customer_addressblock='$customer_addressblock', customer_road='$customer_road', customer_other='$customer_other', customer_sub_area='$customer_sub_area', custaddress='$custaddress', custcity='$custcity', custstate='$custstate', custpincode='$custpincode', arealocality='$arealocality' where customer_id='$customer_id'";
      $query = mysqli_query($con, $Update);
      if ($query == true) {
        $_SESSION['customer_id'] = $fetch['customer_id'];
        $_SESSION['customer_name'] = $_GET['customer_name'];
        $_SESSION['customer_mail_id'] = $_GET['customer_mail_id'];
        $_SESSION['customer_phone_number'] = $_GET['customer_phone_number'];
        $_SESSION['custaddress'] = $_GET['custaddress'];
        $_SESSION['custcity'] = $_GET['custcity'];
        $_SESSION['custstate'] = $_GET['custstate'];
        $_SESSION['custpincode'] = $_GET['custpincode'];
        $_SESSION['arealocality'] = $_GET['arealocality'];
        $_SESSION['cr_url'] = $_GET['cr_url'];
        $_SESSION['customer_middlename'] = $_GET['customer_middlename'];
        $_SESSION['customer_lastname'] = $_GET['customer_lastname'];
        $_SESSION['customer_street_no'] = $_GET['customer_street_no'];
        $_SESSION['customer_addressblock'] = $_GET['customer_addressblock'];
        $_SESSION['customer_road'] = $_GET['customer_road'];
        $_SESSION['customer_other']  = $_GET['customer_other'];
        $_SESSION['customer_sub_area'] = $_GET['customer_sub_area'];
        $_SESSION['customer_floor'] = $_GET['customer_floor'];
        $_SESSION['contact_person'] = $_GET['contact_person'];
        $_SESSION['alternate_phone'] = $_GET['alternate_phone'];

        $customer_image = $fetch['customer_image'];
        if ($customer_image == null) {
          $customer_image = "$Domain/img/user_img/user.jpg";
          $_SESSION['user_img'] = "$Domain/img/user_img/user.jpg";
        } else {
          $customer_image = "$Domain/img/user_img/$customer_image";
          $_SESSION['user_img'] = $customer_image;
        }

        $customer_id = $_SESSION['customer_id'];
        $customer_name = $_SESSION['customer_name'];
        $customer_mail_id = $_SESSION['customer_mail_id'];
        $customer_phone_number = $_SESSION['customer_phone_number'];
        $custaddress = $_SESSION['custaddress'];
        $custcity = $_SESSION['custcity'];
        $custstate = $_SESSION['custstate'];
        $custpincode = $_SESSION['custpincode'];
        $arealocality = $_SESSION['arealocality'];
        $cr_url = $_SESSION['cr_url'];
        $customer_middlename = $_SESSION['customer_middlename'];
        $customer_lastname = $_SESSION['customer_lastname'];
        $customer_street_no = $_SESSION['customer_street_no'];
        $customer_addressblock = $_SESSION['customer_addressblock'];
        $customer_road = $_SESSION['customer_road'];
        $customer_other  = $_SESSION['customer_other'];
        $customer_sub_area = $_SESSION['customer_sub_area'];
        $customer_floor = $_SESSION['customer_floor'];
        $contact_person = $_SESSION['contact_person'];
        $alternate_phone = $_SESSION['alternate_phone'];

        //billing address

        $custaddress_b = $_GET['custaddress_b'];
        $custcity_b = $_GET['custcity_b'];
        $custstate_b = $_GET['custstate_b'];
        $custpincode_b = $_GET['custpincode_b'];
        $arealocality_b = $_GET['arealocality_b'];
        $customer_street_no_b = $_GET['customer_street_no_b'];
        $customer_addressblock_b = $_GET['customer_addressblock_b'];
        $customer_road_b = $_GET['customer_road_b'];
        $customer_other_b  = $_GET['customer_other_b'];
        $customer_sub_area_b = $_GET['customer_sub_area_b'];
        $customer_floor_b = $_GET['customer_floor_b'];
        $contact_person_b = $_GET['contact_person_b'];
        $alternate_phone_b = $_GET['alternate_phone_b'];

        $_SESSION['custaddress_b'] = $_GET['custaddress_b'];
        $_SESSION['custcity_b'] = $_GET['custcity_b'];
        $_SESSION['custstate_b'] = $_GET['custstate_b'];
        $_SESSION['custpincode_b'] = $_GET['custpincode_b'];
        $_SESSION['arealocality_b'] = $_GET['arealocality_b'];
        $_SESSION['customer_street_no_b'] = $_GET['customer_street_no_b'];
        $_SESSION['customer_addressblock_b'] = $_GET['customer_addressblock_b'];
        $_SESSION['customer_road_b'] = $_GET['customer_road_b'];
        $_SESSION['customer_other_b']  = $_GET['customer_other_b'];
        $_SESSION['customer_sub_area_b'] = $_GET['customer_sub_area_b'];
        $_SESSION['customer_floor_b'] = $_GET['customer_floor_b'];
        $_SESSION['contact_person_b'] = $_GET['contact_person_b'];
        $_SESSION['alternate_phone_b'] = $_GET['alternate_phone_b'];
      }
    }
    //////////////////////////
  }
} else {
  $customer_id = $_SESSION['customer_id'];
  $customer_name = $_SESSION['customer_name'];
  $customer_mail_id = $_SESSION['customer_mail_id'];
  $customer_phone_number = $_SESSION['customer_phone_number'];
  $custaddress = $_SESSION['custaddress'];
  $custcity = $_SESSION['custcity'];
  $custstate = $_SESSION['custstate'];
  $custpincode = $_SESSION['custpincode'];
  $arealocality = $_SESSION['arealocality'];
  $cr_url = $_SESSION['cr_url'];
  $customer_image = $_SESSION['user_img'];
  $customer_middlename = $_SESSION['customer_middlename'];
  $customer_lastname = $_SESSION['customer_lastname'];
  $customer_street_no = $_SESSION['customer_street_no'];
  $customer_addressblock = $_SESSION['customer_addressblock'];
  $customer_road = $_SESSION['customer_road'];
  $customer_other  = $_SESSION['customer_other'];
  $customer_sub_area = $_SESSION['customer_sub_area'];
  $customer_floor = $_SESSION['customer_floor'];
  $contact_person = $_SESSION['contact_person'];
  $alternate_phone = $_SESSION['alternate_phone'];

  //billing address
  $custaddress_b = $_SESSION['custaddress_b'];
  $custcity_b = $_SESSION['custcity_b'];
  $custstate_b = $_SESSION['custstate_b'];
  $custpincode_b = $_SESSION['custpincode_b'];
  $arealocality_b = $_SESSION['arealocality_b'];
  $customer_street_no_b = $_SESSION['customer_street_no_b'];
  $customer_addressblock_b = $_SESSION['customer_addressblock_b'];
  $customer_road_b = $_SESSION['customer_road_b'];
  $customer_other_b  = $_SESSION['customer_other_b'];
  $customer_sub_area_b = $_SESSION['customer_sub_area_b'];
  $customer_floor_b = $_SESSION['customer_floor_b'];
  $contact_person_b = $_SESSION['contact_person_b'];
  $alternate_phone_b = $_SESSION['alternate_phone_b'];
}

//billing address 
$custaddress_b = $_SESSION['custaddress_b'];
$custcity_b = $_SESSION['custcity_b'];
$custstate_b = $_SESSION['custstate_b'];
$custpincode_b = $_SESSION['custpincode_b'];
$arealocality_b = $_SESSION['arealocality_b'];
$customer_street_no_b = $_SESSION['customer_street_no_b'];
$customer_addressblock_b = $_SESSION['customer_addressblock_b'];
$customer_road_b = $_SESSION['customer_road_b'];
$customer_other_b  = $_SESSION['customer_other_b'];
$customer_sub_area_b = $_SESSION['customer_sub_area_b'];
$customer_floor_b = $_SESSION['customer_floor_b'];
$contact_person_b = $_SESSION['contact_person_b'];
$alternate_phone_b = $_SESSION['alternate_phone_b'];

$customer_completeaddress = "$custaddress  $customer_floor $customer_street_no $customer_addressblock $customer_road  $customer_other $customer_sub_area $arealocality $custcity $custstate $custpincode, <br> $contact_person : $alternate_phone";
$complete_billingaddress = "$custaddress_b $customer_floor_b $customer_street_no_b $customer_addressblock_b $customer_road_b $customer_other_b $customer_sub_area_b $arealocality_b $custcity_b $custstate_b $custpincode_b, <br>$contact_person_b : $alternate_phone_b";
$date_time = date("dmy");
$_SESSION['order_id'] = "INV$date_time" . rand(0, 99999);
$ORDERID = $_SESSION['order_id'];

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">


<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="<?php echo $PosName; ?>">
  <title>New Orders : <?php echo $ORDERID; ?></title>
  <?php include 'header_files.php'; ?>
  <!-- END: Custom CSS-->
  <style type="text/css">
    .autocomplete-items {
      position: absolute;
      border: 1px solid #d4d4d4;
      border-bottom: none;
      border-top: 1px solid #d4d4d4;
      z-index: 99;
      top: 100%;
      left: -1px;
      right: 0;
      background-color: white !important;
      margin-top: -247px;
      width: 97.5%;
    }
  </style>
</head>
<!-- END: Head -->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

  <?php require 'header.php'; ?>


  <?php require 'sidebar.php'; ?>

  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="col-lg-12 card-content">
          <?php notification(); ?>
          <?php
          mysqli_set_charset($con, 'utf8');
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
          $ip_address = "localbilling";
          $device_info = "$device_type$date_time_c$ipv6_n$ipv6_p$os$OS_release$OS_Version$System_Info$System_more_Info";

          if (isset($_POST['ORDERED_PRODUCTS'])) {
            $productname = $_POST['products_name'];
            $GetTargetedProductName = "SELECT * FROM user_products where product_HSN='$productname'";
            $QueryForTargetedProductName = mysqli_query($con, $GetTargetedProductName);
            $fetchTagrgetedProductName = mysqli_fetch_assoc($QueryForTargetedProductName);
            $TargetProductName = $fetchTagrgetedProductName['product_title'];
            $TargetProductTags = $fetchTagrgetedProductName['product_tags'];
            $TargetedProductHindiName = $fetchTagrgetedProductName['hindi_name'];
            $TargetProductNameId = $fetchTagrgetedProductName['user_product_id'];
            $TargetProductOfferPrice = $fetchTagrgetedProductName['product_offer_price'];
            $TargetedProductHSN = $fetchTagrgetedProductName['product_HSN'];
            $TragetedProductTaxes = $fetchTagrgetedProductName['products_taxes'];
            $product_net_price = $fetchTagrgetedProductName['product_net_price'];

            $user_product_id = $fetchTagrgetedProductName['user_product_id'];
            $product_tags = $fetchTagrgetedProductName['product_tags'];
            $product_offer_price = $fetchTagrgetedProductName['product_offer_price'];
            $amount              = $fetchTagrgetedProductName['product_offer_price'];
            $cart_add_date       = date("d M Y h:m A");
            $product_mrp_price   = $fetchTagrgetedProductName['product_mrp_price'];
            $product_title = $fetchTagrgetedProductName['product_title'];
            $product_img = $fetchTagrgetedProductName['product_img'];

            $product_units = "$product_tags";
            $letters = preg_replace('/[0-9\.]/', '', "$product_tags");
            $numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
            $quantity = $numbers;

            $sql = "SELECT * from customer_cart where customer_id='$customer_id' and product_HSN='$TargetedProductHSN'";
            $query = mysqli_query($con, $sql);
            $CountCartItems = mysqli_num_rows($query);

            if ($CountCartItems != 0) { ?>
              <div class="alert alert-danger alert-dismissible mb-2" role="alert" id="MsgArea">
                <button type="button" class="close" onclick="remove_msg()" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <strong>Failed : </strong> Item Already in Cart
              </div>

              <?php } else {
              $sql = "INSERT into customer_cart (customer_id, ip_address, device_info, user_product_id, product_tags, product_price, product_mrp, product_quantity, product_total_amount, mrp_total, cart_add_date, store_id, product_img, hindi_name, product_HSN, product_taxes, product_net_prices) VALUES ('$customer_id', '$ip_address', '$TargetProductNameId', '$TargetProductName', '$product_tags', '$product_offer_price', '$product_mrp_price', '$quantity', '$amount', '$product_mrp_price', '$cart_add_date', '$store_id', 'pro_img/$product_img', '$TargetedProductHindiName', '$TargetedProductHSN', '$TragetedProductTaxes', '$product_net_price')";
              $query = mysqli_query($con, $sql);
              if ($query == true) { ?>

              <?php } else { ?>
                <div class="alert alert-danger alert-dismissible mb-2" role="alert" id="MsgArea">
                  <button type="button" class="close" onclick="remove_msg()" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Invalid Item : </strong> Please Select Correct Item Name
                </div>

          <?php }
            }
          } ?>



        </div>
      </div>



      <div class="content-body">
        <!-- users list start -->
        <section class="users-list-wrapper">
          <div class="users-list-table">
            <div class="card">
              <div class="card-header">
                <h5 class="users-action mobile-font-size"><i class="fa fa-star text-primary fa-spin"></i> New Order <i class="fa fa-angle-right"></i> <?php echo $ORDERID; ?></h5>
                <hr class="mb-0 mt-0">
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="expand"><i class="fa fa-expand"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="card-content">
                <div class="card-body pt-0">
                  <div class="row pt-0">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-3 pr-0">
                      <center>
                        <img src="<?php echo $customer_image; ?>" class="img-fluid bg-primary rounded" style="border-radius: 80% !important;width: 50%;padding: 2% !important;">
                      </center>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-9 pl-0">
                      <h6 class="mobile-font-size pl-0 pt-0 mb-0"><b>Customer Information:</b></h6>
                      <p class="mobile-font-size"><b>
                          <a href="cust_details.php?customer_id=<?php echo $customer_id; ?>"><i class="fa fa-user"></i></b>
                        <?php echo $customer_name; ?> <?php echo $customer_middlename; ?> <?php echo $customer_lastname; ?></a><br>
                        <a href="mailto:<?php echo $customer_mail_id; ?>"><b><i class="fa fa-envelope"></i></b>
                          <?php echo $customer_mail_id; ?></a><br>
                        <a href="tel:<?php echo $customer_phone_number; ?>"><b><i class="fa fa-phone"></i></b>
                          <?php echo $customer_phone_number; ?></a><br>
                      </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-12">
                      <p><b>Shipping Address:</b> <?php echo $customer_completeaddress; ?></p>
                    </div>
                    <div class="col-md-6 col-12">
                      <p><b>Billing Address:</b> <?php echo $complete_billingaddress; ?></p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <div class="">
                        <table class="table cart_summary table-striped">
                          <thead align="center">
                            <tr>
                              <th class="cart_product" style="width:5%;padding: 1%; font-size: 12px;">
                                Image</th>
                              <th style="padding: 1%; font-size: 12px;text-align: left !important;">
                                Product Name</th>
                              <th style="width: 17%;padding: 1%; font-size: 12px;">
                                Product Price</th>
                              <th style="width: 10%;padding: 1%; font-size: 12px;">Qty
                              </th>
                              <th style="width: 12%;padding: 1%; font-size: 12px;" align="center" style="text-align: center !important;">
                                Total Price</th>
                              <th style="width: 12%;padding: 1%; font-size: 12px;" align="center" style="text-align: center !important;">
                                Taxes</th>
                              <th style="width: 12%;padding: 1%; font-size: 12px;" align="center" style="text-align: center !important;">
                                Net Price</th>
                              <th class="action" style="width: 8%;padding: 1%; font-size: 12px;" align="center">Remove</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            mysqli_set_charset($con, 'utf8');
                            $sql = "SELECT * FROM customer_cart, user_products, pro_brands, product_categories where customer_id='$customer_id' and customer_cart.device_info=user_products.user_product_id and user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id";
                            $query = mysqli_query($con, $sql);
                            while ($fetch = mysqli_fetch_assoc($query)) {
                              $cart_id = $fetch['cart_id'];
                              $user_product_id_value = $fetch['user_product_id'];
                              $product_title = $fetch['product_title'];
                              $product_img = $fetch['product_img'];
                              $product_cat_title = $fetch['product_cat_title'];
                              $product_price = $fetch['product_price'];
                              $product_tags = $fetch['product_tags'];
                              $brand_title = $fetch['brand_title'];
                              $product_quantity = $fetch['product_quantity'];
                              $product_total_amount = $fetch['product_total_amount'];
                              $product_mrp = $fetch['product_mrp'];
                              $hindi_name = $fetch['hindi_name'];
                              $product_units = "$product_tags";
                              $letters = preg_replace('/[0-9.]/', '', "$product_tags");
                              $numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
                              $Quantity = $product_quantity / $numbers;
                              $product_taxes = $fetch['product_taxes'];
                              $product_net_price = $fetch['product_net_prices'];
                            ?>
                              <tr>
                                <td class="cart_product" style="padding:0.2%; font-size: 12px;" align="center">
                                  <img class="img-fluid" src="img/store_img/pro_img/<?php echo $product_img; ?>" alt="<?php echo $product_title; ?>" title='<?php echo $product_title; ?>' style="box-shadow: 0px 0px 2px grey; width: 74%; padding: 2% !important;border-radius: 8px;">
                                </td>
                                <td class="cart_description" style="padding: 0.2%; font-size: 12px !important;">
                                  <h5 style="font-size: 13px !important;"><b><a href="edit_product.php?product_id=<?php echo $user_product_id_value; ?>"><?php echo $product_title; ?>
                                        - <?php echo $hindi_name; ?>
                                      </a></b><br>
                                    <small><i class="fa fa-check-circle text-success"></i> <?php echo $brand_title; ?></small>
                                  </h5>
                                </td>
                                <td class="price" style="padding: 0.5%; font-size: 13.5px;" align="center">
                                  <span><i class="fa fa-inr"></i>
                                    <?php echo $product_price; ?>/<?php echo $product_tags; ?></span>
                                </td>

                                <td class="qty" style="padding: 0.5%; font-size: 12px;">
                                  <div class="input-group">
                                    <form action='update.php' method='POST'>
                                      <input type="text" name="product_price" value="<?php echo $product_price; ?>" hidden="">
                                      <input type="text" name="numbers" value="<?php echo $numbers; ?>" hidden="">
                                      <input type="text" name="cart_id" value="<?php echo $cart_id; ?>" hidden="">
                                      <input type="text" name="quantity" value="<?php echo $product_quantity + $numbers; ?>" hidden="">
                                      <input type="text" name="product_mrp" value="<?php echo $product_mrp; ?>" hidden="">
                                      <input type="text" name="product_taxes" value="<?php echo $product_taxes; ?>" hidden="">
                                      <input type="submit" name="INCREASE" class="btn btn-info btn-sm mb-0 mt-0 float-left text-white" value="+" />
                                    </form>
                                    <input type='number' min='1' max='10' value='<?php echo $Quantity; ?>' class='form-control' style='width: 20px !important; padding: 1%; height: 5%;' id="qty<?php echo $user_product_id_value; ?>">
                                    <form action='update.php' method='POST' class="float-right">
                                      <input type="text" name="product_price" value="<?php echo $product_price; ?>" hidden="">
                                      <input type="text" name="numbers" value="<?php echo $numbers; ?>" hidden="">
                                      <input type="text" name="cart_id" value="<?php echo $cart_id; ?>" hidden="">
                                      <input type="text" name="quantity" value="<?php echo $product_quantity - $numbers; ?>" hidden="">
                                      <input type="text" name="product_mrp" value="<?php echo $product_mrp; ?>" hidden="">
                                      <input type="text" name="product_taxes" value="<?php echo $product_taxes; ?>" hidden="">
                                      <input type="submit" name="DECREASE" class="btn btn-info btn-sm mb-0 mt-0 float-right text-white" value="-" />
                                    </form>
                                  </div>
                                </td>
                                <td class="price" style="padding: 0.5%; font-size: 13.5px;" align="center">
                                  <span><i class="fa fa-inr"></i>
                                    <?php echo $product_total_amount; ?></span><br>

                                </td>
                                <td style="padding: 0.5%; font-size: 13.5px;" align="center">
                                  <span class="text-grey" style="color:grey; font-weight:300 !important;">+ Rs.<?php echo $Taxeamount = round($product_total_amount / 100 * $product_taxes); ?> <br> GST <?php echo $product_taxes; ?>%</span>
                                </td>
                                <td style="padding: 0.5%; font-size: 14px;" align="center">
                                  <b><i class="fa fa-inr"></i> <?php echo $product_net_price; ?></b>
                                </td>
                                <td class="action" style="padding: 0.5%; font-size: 12px;" align="center">
                                  <a class="btn btn-sm btn-danger" data-original-title="Remove Item" href="delete.php?delete_cart=<?php echo $cart_id; ?>" title="" data-placement="top" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                </td>
                              </tr>
                              <script type="text/javascript">
                                function i <?php echo $user_product_id_value; ?>() {
                                  var value = parseInt(document.getElementById('qty<?php echo $user_product_id_value; ?>').value, 10);
                                  value = isNaN(value) ? 0 : value;
                                  if (value < 10) {
                                    value++;
                                    document.getElementById('qty<?php echo $user_product_id_value; ?>').value = value;
                                  }
                                }

                                function d <?php echo $user_product_id_value; ?>() {
                                  var value = parseInt(document.getElementById('qty<?php echo $user_product_id_value; ?>').value, 10);
                                  value = isNaN(value) ? 0 : value;
                                  if (value > 1) {
                                    value--;
                                    document.getElementById('qty<?php echo $user_product_id_value; ?>').value = value;
                                  }

                                }
                              </script>
                            <?php } ?>
                            <form action="" method="POST">
                              <tr>
                                <td colspan="5" class="pl-0 pr-0">
                                  <input type="text" class="form-control" list="product_names" value="" name="products_name" placeholder="Type Product Name...">
                                  <datalist id="product_names">
                                    <?php
                                    $sql_sr = "SELECT * FROM user_products";
                                    $query_src = mysqli_query($con, $sql_sr);
                                    while ($search = mysqli_fetch_assoc($query_src)) {
                                      $user_product_id = $search['user_product_id'];
                                      $hindi_name = $search['hindi_name'];
                                      $product_title = $search['product_title'];
                                      $product_tags = $search['product_tags'];
                                      $product_offer_price = $search['product_offer_price'];
                                      $product_HSN = $search['product_HSN']; ?>
                                      <option value="<?php echo $product_HSN; ?>"><?php echo $product_title; ?>, <?php echo $product_tags; ?>, Rs.<?php echo $product_offer_price; ?>, HSN : <?php echo $product_HSN; ?></option>
                                    <?php } ?>
                                  </datalist>
                                </td>
                                <td class="pl-1 pr-0">
                                  <input type="Submit" class="btn btn-primary text-white form-control" name="ORDERED_PRODUCTS" placeholder="Enter Product Name" value="ADD">
                                </td>
                              </tr>
                            </form>
                          </tbody>
                        </table>

                        <style type="text/css">
                          table tr th,
                          td {
                            padding: 0.5% !important;
                            padding-left: 0.1% !important;
                          }
                        </style>
                        <table class="table table-striped" style="font-size: 13.5px !important;">
                          <tr>
                            <td colspan="2" align="right" style="width: 85%;">Total Product Price :</td>
                            <td><b>Rs.<?php
                                      $select = "SELECT sum(product_net_prices) FROM customer_cart where store_id='$store_id' and customer_id='$customer_id'";
                                      $action = mysqli_query($con, $select);
                                      while ($record = mysqli_fetch_array($action)) {
                                        echo $total_amount = $record['sum(product_net_prices)'];
                                      }
                                      ?></b></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="right">MRP Total :</td>
                            <td>
                              Rs.<?php
                                  $select = "SELECT sum(mrp_total) FROM customer_cart where store_id='$store_id' and customer_id='$customer_id'";
                                  $action = mysqli_query($con, $select);
                                  while ($record = mysqli_fetch_array($action)) {
                                    $total_amount_mrp = $record['sum(mrp_total)'];
                                  }
                                  $save = $total_amount_mrp - $total_amount;
                                  echo $total_amount_mrp;
                                  ?></td>
                          </tr>

                          <tr>
                            <td colspan="2" align="right">Discount & Coupons :</td>
                            <td>
                              Rs.<?php
                                  $select = "SELECT sum(mrp_total) FROM customer_cart where store_id='$store_id' and customer_id='$customer_id'";
                                  $action = mysqli_query($con, $select);
                                  while ($record = mysqli_fetch_array($action)) {
                                    $total_amount_mrp = $record['sum(mrp_total)'];
                                  }
                                  $save = $total_amount_mrp - $total_amount;
                                  echo $save;
                                  ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="right">Conveniance & Delivery Charges :</td>
                            <td>
                              <?php
                              $Sql = "SELECT * FROM delivery_charges";
                              $Query = mysqli_query($con, $Sql);
                              $Fetch = mysqli_fetch_assoc($Query);
                              $delivery_charge = $Fetch['delivery_charge'];
                              $est_delivery_amount = $Fetch['est_delivery_amount'];
                              $concharge = $Fetch['concharge'];
                              $select = "SELECT sum(product_net_prices) FROM customer_cart where store_id='$store_id' and customer_id='$customer_id'";
                              $action = mysqli_query($con, $select);
                              while ($record = mysqli_fetch_array($action)) {
                                $total_product_amount = $record['sum(product_net_prices)'];
                              }
                              if ($total_product_amount <= $est_delivery_amount) {
                                $DeliveryCharges = $delivery_charge + $concharge;
                                echo "Rs." . $DeliveryCharges;
                              } else {
                                $DeliveryCharges = 0;
                                echo "Free Delivery";
                              }
                              ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="right">GST Tax Amount :</td>
                            <td>
                              <?php
                              mysqli_set_charset($con, 'utf8');
                              $sql = "SELECT * FROM customer_cart, user_products, pro_brands, product_categories where customer_id='$customer_id' and customer_cart.device_info=user_products.user_product_id and user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id";
                              $query = mysqli_query($con, $sql);
                              (int)$GSTTaxAmount = 0;
                              while ($fetch = mysqli_fetch_assoc($query)) {
                                $cart_id = $fetch['cart_id'];
                                $user_product_id_value = $fetch['user_product_id'];
                                $product_title = $fetch['product_title'];
                                $product_img = $fetch['product_img'];
                                $product_cat_title = $fetch['product_cat_title'];
                                $product_price = $fetch['product_price'];
                                $product_tags = $fetch['product_tags'];
                                $brand_title = $fetch['brand_title'];
                                $product_quantity = $fetch['product_quantity'];
                                $product_total_amount = $fetch['product_total_amount'];
                                $product_mrp = $fetch['product_mrp'];
                                $hindi_name = $fetch['hindi_name'];
                                $product_units = "$product_tags";
                                $letters = preg_replace('/[0-9.]/', '', "$product_tags");
                                $numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
                                $Quantity = $product_quantity / $numbers;
                                $product_taxes = $fetch['product_taxes'];
                                $product_net_price = $fetch['product_net_prices'];

                                $Taxamounts = round($product_total_amount / 100 * $product_taxes);
                                $GSTTaxAmount = $Taxamounts + $GSTTaxAmount;
                              }
                              ?>
                              <?php echo $GSTTaxAmount; ?>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" align="right">Total Order Amount :</td>
                            <td>Rs.<?php echo $total_amount + $DeliveryCharges; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="right"><b>Net Payable Amount :</b></td>
                            <td class="text-black">
                              <h4><b>
                                  Rs.<?php
                                      $select = "SELECT sum(product_net_prices) FROM customer_cart where store_id='$store_id' and customer_id='$customer_id'";
                                      $action = mysqli_query($con, $select);
                                      while ($record = mysqli_fetch_array($action)) {
                                        $total_product_price = $record['sum(product_net_prices)'];
                                        echo $total_amount = $record['sum(product_net_prices)'] + $DeliveryCharges;
                                      }
                                      if ($total_amount == 0) { ?>

                                <?php }
                                ?></h4></b>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <form action="" method="POST">
                        <input type="text" name="order_id" value="<?php echo $ORDERID; ?>" hidden=''>
                        <div class="row">
                          <hr>
                          <div class="col-sm-6 col-xs-6 col-lg-6 col-md-6">
                            <h5 class="ml-0 pl-0">Delivery Time</h5>
                            <p class="font-4"><b>Morning</b> <i class="fa fa-angle-right"></i> 6:00 AM to 11:00 AM<br>
                              <b>Evening </b><i class="fa fa-angle-right"></i> 2:00 PM to 6:00 PM
                            </p>
                            <p id='TimeNotSelected' style="font-size: 14px;
    color: red;
    font-weight: 600;"></p>
                          </div>
                          <style type="text/css">
                            /* HIDE RADIO */
                            [type=radio] {
                              position: absolute;
                              opacity: 0;
                              width: 0;
                              height: 0;
                            }

                            /* IMAGE STYLES */
                            [type=radio]+img {
                              cursor: pointer;
                            }

                            /* CHECKED STYLES */
                            [type=radio]:checked+img {
                              border-style: groove !important;
                              box-shadow: 0px 0px 5px green !important;
                              border-radius: 10px !important;
                              border-width: thin;
                              border-color: green;
                            }
                          </style>
                          <div class="col-lg-6 col-md-6">
                            <div class="row">
                              <div class="col-xs-6 col-sm-6 col-6">
                                <label>
                                  <input type="radio" name="PICK_SCHEDULE_TIME" id="PICKSCHEDULETIME" value="MORNING" required="">
                                  <img src="img/morning.png" style="width: 100%; box-shadow: 0px 0px 4px grey;
    border-radius: 5px;
    padding: 3%;">
                                </label>
                              </div>
                              <div class="col-xs-6 col-sm-6 col-6">
                                <label>
                                  <input type="radio" name="PICK_SCHEDULE_TIME" id="PICKSCHEDULETIME2" value="EVENING" required="">
                                  <img src="img/evening.png" style="width: 100%; box-shadow: 0px 0px 4px grey;
    border-radius: 5px;
    padding: 3%;">
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                      <a href='new_order.php' class="btn btn-primary text-white"><i class="fa fa-angle-left"></i> Previuos</a>
                      <button type="Submit" name="GENERATE_ORDER" class="btn btn-primary btn-md float-right" onclick="return validateform()">CREATE
                        ORDER</button>
                    </div>
                  </div>
                  <?php
                  $select = "SELECT sum(mrp_total) FROM customer_cart where store_id='$store_id' and customer_id='$customer_id'";
                  $action = mysqli_query($con, $select);
                  while ($record = mysqli_fetch_array($action)) {
                    $total_amount_mrp = $record['sum(mrp_total)'];
                  }
                  $save = $total_amount_mrp - $total_amount;
                  ?>
                  <?php
                  if (isset($_POST['GENERATE_ORDER'])) {
                    $ORDERID = $_POST['order_id'];
                    $payment_mode = "cash_on_delivery";
                    $payment_note = "";
                    $delivery_address = "$custaddress, $arealocality, $custcity, $custstate - $custpincode";
                    $net_payable_amount = $total_amount;
                    $payment_status = "NOT PAID";
                    $delivery_status = "ACCEPTED";
                    $delivery_date = "";
                    $order_status = "ACCEPTED";
                    date_default_timezone_set('Asia/Kolkata');
                    $order_date = date("d M Y, h:m a");
                    $total_amount = $total_amount_mrp;
                    $total_amount_after_discount = $total_product_price;
                    $delivery_charge = $DeliveryCharges;
                    $order_month = date("m");
                    $order_year = date("Y");
                    $order_day = date("d");
                    $coupon_code = "Not Available";
                    $order_type = "OFFLINE";
                    $PICK_SCHEDULE_TIME = $_POST['PICK_SCHEDULE_TIME'];

                    $sql = "SELECT * FROM customer_orders where order_id='$ORDERID'";
                    $query = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($query);
                    if ($count == 0) {

                      $saveorder = "INSERT INTO customer_orders (order_id, customer_id, store_id, delivery_address, payment_mode, payment_note, coupon_code, net_payable_amount, payment_status, delivery_status, delivery_date, order_status, order_date, total_amount, total_amount_after_discount, delivery_charge, order_month, order_year, order_day, order_type, PICK_SCHEDULE_TIME, billing_address, GSTTaxamount) VALUES ('$ORDERID', '$customer_id', '$store_id', '$customer_completeaddress', '$payment_mode', '$payment_note', '$coupon_code', '$net_payable_amount', '$payment_status', '$delivery_status', '$delivery_date', '$order_status', '$order_date', '$total_amount', '$total_amount_after_discount', '$delivery_charge', '$order_month', '$order_year', '$order_day', '$order_type', '$PICK_SCHEDULE_TIME', '$complete_billingaddress', '$GSTTaxAmount')";
                      $query =  mysqli_query($con, $saveorder);

                      if ($query == true) {
                        $savepro = "SELECT * from customer_cart where customer_id='$customer_id'";
                        $query = mysqli_query($con, $savepro);
                        $insert = "";
                        while ($fetch =  mysqli_fetch_assoc($query)) {

                          $product_names = $fetch['user_product_id'];
                          $product_mrp = $fetch['product_mrp'];
                          $product_price = $fetch['product_price'];
                          $product_qty = $fetch['product_quantity'];
                          $product_total_price = $fetch['product_total_amount'];
                          $product_mrp_total = $fetch['mrp_total'];
                          $producttags = $fetch['product_tags'];
                          $product_full_name = "$product_names";
                          $hindi_name = $fetch['hindi_name'];
                          $product_img = $fetch['product_img'];
                          $product_taxes = $fetch['product_taxes'];
                          $product_net_prices = $fetch['product_net_prices'];
                          $product_HSN = $fetch['product_HSN'];

                          $insert .= "('$ORDERID', '$store_id', '$customer_id', '$product_full_name', '$product_mrp', '$product_price', '$product_qty', '$product_total_price', '$product_mrp_total', '$producttags', 'false', '$hindi_name', '$product_img', '$product_HSN', '$product_taxes', '$product_net_prices'),";
                        }
                        $insert = substr_replace($insert, '', -1, 1);
                        $insert = "INSERT into ordered_products (order_id, store_id, customer_id, product_names, product_mrp, product_price, product_qty, product_total_price, product_mrp_total, product_tags, item_status, hindi_name, product_img, product_HSN, product_taxes, product_net_prices) VALUES " . $insert;
                        $query =  mysqli_query($con, $insert);
                      }
                      $sql = "DELETE from customer_cart where store_id='$store_id' and customer_id='$customer_id'";
                      $query = mysqli_query($con, $sql);

                      if ($query == true) {
                        sms_data(
                          $MSG = "$ORDERID>" . "
Your Order Placed Successfully!
Amount : Rs.$net_payable_amount
Mode : $payment_mode
Status : $payment_status
Delivery Slot : $PICK_SCHEDULE_TIME
-
Track Order
https://24kharido.in/track-order.php",
                          $PHONE = "$customer_phone_number"
                        );

                        NOTIFICATION_ALERT(
                          $TITLE = "Order Placed Successfully!",
                          $DESC = "Your Order having #$ORDERID is placed Successfully and will be delivered coming $PICK_SCHEDULE_TIME at $delivery_address. Your Paymend mode is $payment_mode. Total Order Amount is Rs.$net_payable_amount. To know about your order details check My Orders.",
                          $STATUS = "NEW"
                        ); ?>
                        <meta http-equiv="refresh" content="1; new_order.php?t=success&m=Created&a=ORDERID : <b><?php echo $ORDERID; ?></b> is Created Successfully! to view Go to Orders." />
                  <?php }
                    }
                  }
                  ?>
                  </form>
                </div>



              </div>

            </div>
          </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </section>
  <!-- users list ends -->
  </div>
  </div>
  </div>
  <!-- END: Content-->

  <?php require 'footer.php'; ?>

</body>
<!-- END: Body-->

</html>
<script type="text/javascript">
  function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) {
        return false;
      }
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
            /*insert the value for the autocomplete text field:*/
            inp.value = this.getElementsByTagName("input")[0].value;
            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
            closeAllLists();
          });
          a.appendChild(b);
        }
      }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
    });

    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }

    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function(e) {
      closeAllLists(e.target);
    });
  }
  autocomplete(document.getElementById("product_names"), products);
  autocomplete(document.getElementById("product_tags"), products_tags);
</script>