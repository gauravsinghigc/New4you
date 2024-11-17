<?php include 'files.php';
require 'session.php';
if (isset($_COOKIE['customer_id']) and isset($_COOKIE['store_id'])) {
  $customer_id = $_COOKIE['customer_id'];
  $store_id = $_COOKIE['store_id'];
  $introduction = $_COOKIE['introduction'];

  $_SESSION['introduction'] = $introduction;
  $_SESSION['customer_id'] = $customer_id;
  $_SESSION['store_id'] = $store_id;
}

if (isset($_SESSION['customer_id'])) {
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
  $device_info = "$ip_address$device_type";

  $sql = "UPDATE customer_cart SET customer_id='$customer_id' where ip_address='$device_info' and store_id='$store_id'";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
  } else {
  }
}
$IpAddress = get_ip();
$DeviceType = strtoupper(detectDevice());
$VisitingUrl = basename($_SERVER['PHP_SELF']);

if (isset($_SESSION['customer_id'])) {
  $customer_id = $_SESSION['customer_id'];
  $sql = "SELECT * FROM customers where customer_id='$customer_id'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  $customer_name = $fetch['customer_name'];
  $customer_mail_id = $fetch['customer_mail_id'];
  $customer_phone_number = $fetch['customer_phone_number'];
  $UserStatus = "Login";
  $CustomerId = $customer_id;
} else {
  $customer_id = "Unknown";
  $customer_name = "Unknown";
  $customer_mail_id = "Unknown";
  $customer_phone_number = "Unknown";
  $UserStatus = "Unknown";
  $CustomerId = "Unknown";
}

$UserDetails = "<br><b>UserStatus :</b> $UserStatus
<br><b>CustomerId :</b> $customer_id
<br><b>CustomerName :</b> $customer_name
<br><b>CustomerMailId :</b> $customer_mail_id
<br><b>CustomerPhoneNumber :</b> $customer_phone_number";

$ipv6_n = php_uname('n');
$ipv6_p = php_uname('p');
$os = php_uname('s');
$OS_release = php_uname('r');
$OS_Version = php_uname('v');
$System_Info = php_uname('m');
$DeviceInformations = $_SERVER['HTTP_USER_AGENT'] . "<br><b>IpV6N :</b> $ipv6_n
<br><b>IpV6P :</b> $ipv6_p
<br><b>OS :</b> $os
<br><b>OsRelease :</b> $OS_release
<br><b>OsVersion :</b> $OS_Version
<br><b>SystemType :</b> $System_Info
$UserDetails";
$VistingDOT = date("d M Y h:m:s a");
$VisitingSource = "APP";

$CheckVisitors = "SELECT * FROM visitors where IpAddress='$IpAddress' and DeviceType='$DeviceType' and VisitingSource='$VisitingSource';";
$VisitorsQuery = mysqli_query($con, $CheckVisitors);
$CountVisitors = mysqli_num_rows($VisitorsQuery);
if ($CountVisitors == 0) {
  $InsertVisitors = "INSERT INTO visitors (IpAddress, DeviceType, VisitorType, VistingDOT, VisitingUrl, DeviceInformations, VisitingCounts, VisitingSource, UserStatus, CustomerId) VALUES ('$IpAddress', '$DeviceType', 'NEW', '$VistingDOT', '$VisitingUrl', '$DeviceInformations', '1', '$VisitingSource', '$UserStatus', '$CustomerId')";
  $InsertQuery = mysqli_query($con, $InsertVisitors);
} else {
  $FetchVisitors = mysqli_fetch_assoc($VisitorsQuery);
  $VisitorId = $FetchVisitors['VisitorId'];
  $VisitingCounts = $FetchVisitors['VisitingCounts'];
  $VisitingCounts++;
  $InsertVisitors = "INSERT INTO visitors (IpAddress, DeviceType, VisitorType, VistingDOT, VisitingUrl, DeviceInformations, VisitingCounts, VisitingSource, UserStatus, CustomerId) VALUES ('$IpAddress', '$DeviceType', 'RE-VISIT', '$VistingDOT', '$VisitingUrl', '$DeviceInformations', '1', '$VisitingSource', '$UserStatus', '$CustomerId')";
  $InsertQuery = mysqli_query($con, $InsertVisitors);
}

if (!isset($_SESSION['introduction'])) {
  header("location: intro.php");
}
?>

<html>

 <head>
  <title><?php echo $AppNameWithExt; ?> ! <?php echo $AppTag; ?></title>
  <?php GSI_header_files(); ?>
 </head>

 <body>
  <?php include 'header.php';
  GetMsg(); ?><br>
  <?php CreateSlider("MAIN"); ?>
  <div class="container-fluid">
   <div class="row">
    <?php
      $sql = "SELECT * from product_categories where product_categories.product_cat_status='active' ORDER BY sortby ASC";
      $query = mysqli_query($con, $sql);
      while ($fetch = mysqli_fetch_assoc($query)) {
        $product_cat_id = $fetch['product_cat_id'];
        $category_img = $fetch['category_img'];
        $product_cat_title = $fetch['product_cat_title'];
      ?>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6" style="margin-top: 3%;">
     <a href="products.php?cat_id=<?php echo $product_cat_id; ?>&sub_cat_id=">
      <img src="<?php echo $MUrl; ?>/admin/img/store_img/cat_img/<?php echo $category_img; ?>" style="width: 100%;box-shadow: 0px 0px 2px grey;margin-bottom: 2.5%;border-radius: 8px; padding: 1%;">
      <h6 style="margin-top: 0px;" class="font-5"><?php echo $product_cat_title; ?></h6>
     </a>
    </div>

    <?php } ?>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6" style="margin-top: 3%;">
     <a href="create_order.php">
      <img src="img/CustomOrder.png" style="width: 100%;box-shadow: 0px 0px 2px grey;margin-bottom: 2.5%;border-radius: 8px; padding: 1%;">
      <h6 style="margin-top: 0px;" class="font-5">Create Custom Order</h6>
     </a>
    </div>
   </div>
  </div>

  <div class="container-fluid mt-5 mb-2">
   <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-12 col-xs-12 bg-success">
     <h5 class="text-center text-white font-7">Deal Of the Day</h5>
    </div>
   </div>
  </div>

  <?php
  mysqli_set_charset($con, 'utf8');
  $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='1' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_type='TODAY_DEALS' ORDER BY sortby ASC limit 0, 7";
  $query = mysqli_query($con, $sql);
  $count_products = mysqli_num_rows($query);
  if ($count_products == 0) { ?>
  <section class="container-fluid">
   <div class="row" style="padding:2%;">
    <div class="col-sm-12 col-xs-12">
     <div class="row" style='box-shadow:0px 0px 1px grey;padding-left:2%; padding-right:2%;border-radius:10px;'>
      <div class='col-sm-4 col-xs-4 col-4'
       style='padding-left:1%; padding-right:1%;padding:1%;border-right-style: groove !important; border-width: 1px !important; border-color: #8080801f !important;padding:5%;'>
       <img src="img/blank.png" style='width:100%;'>
      </div>
      <div class='col-sm-8 col-xs-8 col-8' style='padding-left:1%; padding-right:1%;padding:1%;'>
       <h5>Coming Soon...</h5>
       <p>Items are Coming soon.We will inform as soon as we start the process...</p>
      </div>
     </div>
    </div>
   </div>
  </section>
  <?php } else {
    while ($fetch = mysqli_fetch_assoc($query)) {
      $user_product_id = $fetch['user_product_id'];
      $product_tags = $fetch['product_tags'];
      $product_units = "$product_tags";
      $letters = preg_replace('/[0-9]/', '', "$product_tags");
      $numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
      $product_type = $fetch['product_type'];
      $sortby = $fetch['sortby'];
      $ApproxWeight = $fetch['approx_weight'];
      $product_title = $fetch['product_title'];
      $product_img = $fetch['product_img'];
      $product_offer_price = $fetch['product_offer_price'];
      $product_mrp_price = $fetch['product_mrp_price'];
      $product_tags = $fetch['product_tags'];
      $sub_cat_id = $fetch['product_sub_cat_id'];
      $brand_title = $fetch['brand_title'];
      $OfferAmount = $product_offer_price / $product_mrp_price * 100;
      $OfferAmount = round(100 - $OfferAmount);
      $SaveAmount = $product_mrp_price - $product_offer_price;
      $HindiName = $fetch['hindi_name'];
      $OfferAmount = $product_offer_price / $product_mrp_price * 100;
      $OfferAmount = round(100 - $OfferAmount);
      $SaveAmount = $product_mrp_price - $product_offer_price;

      if ($OfferAmount == 0) {
        $OfferAmount = "";
      } else {
        $OfferAmount = "<span class='offer-tag mt-2 ml-1'>$OfferAmount% OFF</span>";
      }

      if ($SaveAmount == 0) {
        $SaveAmount = "";
      } else {
        $SaveAmount = "<span class='st-price font-2'>Save <i class='fa fa-inr'></i>$SaveAmount</span>";
      }

      $sql = "SELECT * FROM product_sub_categories where sub_cat_id='$sub_cat_id'";
      $Query = mysqli_query($con, $sql);
      $fetch = mysqli_fetch_assoc($Query);
      $sub_cat_title = $fetch['sub_cat_title'];
    ?>
  <?php include 'product_section.php'; ?>
  <?php } ?>
  <a href="today_deals.php" class="btn btn-md font-5 btn-info bottom-p text-white d-block mx-auto">View All</a>
  <?php } ?>
  <br>
  <?php CreateSlider("MIDDLE"); ?>
  <div class="container-fluid mt-5 mb-2">
   <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-12 col-xs-12 bg-success">
     <h5 class="text-center text-white font-7">Monthly Ration Offers</h5>
    </div>
   </div>
  </div>

  <?php
  mysqli_set_charset($con, 'utf8');
  $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='1' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_type='RATIONS' ORDER BY sortby ASC limit 0, 7";
  $query = mysqli_query($con, $sql);
  $count_products = mysqli_num_rows($query);
  if ($count_products == 0) { ?>
  <section class="container-fluid">
   <div class="row" style="padding:2%;">
    <div class="col-sm-12 col-xs-12">
     <div class="row" style='box-shadow:0px 0px 1px grey;padding-left:2%; padding-right:2%;border-radius:10px;'>
      <div class='col-sm-4 col-xs-4 col-4'
       style='padding-left:1%; padding-right:1%;padding:1%;border-right-style: groove !important; border-width: 1px !important; border-color: #8080801f !important;padding:5%;'>
       <img src="img/blank.png" style='width:100%;'>
      </div>
      <div class='col-sm-8 col-xs-8 col-8' style='padding-left:1%; padding-right:1%;padding:1%;'>
       <h5>Coming Soon...</h5>
       <p>Items are Coming soon.We will inform as soon as we start the process...</p>
      </div>
     </div>
    </div>
   </div>
  </section>
  <?php } else {
    while ($fetch = mysqli_fetch_assoc($query)) {
      $user_product_id = $fetch['user_product_id'];
      $product_tags = $fetch['product_tags'];
      $product_units = "$product_tags";
      $letters = preg_replace('/[0-9]/', '', "$product_tags");
      $numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
      $product_type = $fetch['product_type'];
      $sortby = $fetch['sortby'];
      $ApproxWeight = $fetch['approx_weight'];
      $product_title = $fetch['product_title'];
      $product_img = $fetch['product_img'];
      $product_offer_price = $fetch['product_offer_price'];
      $product_mrp_price = $fetch['product_mrp_price'];
      $product_tags = $fetch['product_tags'];
      $sub_cat_id = $fetch['product_sub_cat_id'];
      $brand_title = $fetch['brand_title'];
      $HindiName = $fetch['hindi_name'];
      $OfferAmount = $product_offer_price / $product_mrp_price * 100;
      $OfferAmount = round(100 - $OfferAmount);
      $SaveAmount = $product_mrp_price - $product_offer_price;

      if ($OfferAmount == 0) {
        $OfferAmount = "";
      } else {
        $OfferAmount = "<span class='offer-tag mt-2 ml-1'>$OfferAmount% OFF</span>";
      }

      if ($SaveAmount == 0) {
        $SaveAmount = "";
      } else {
        $SaveAmount = "<span class='st-price font-2'>Save <i class='fa fa-inr'></i>$SaveAmount</span>";
      }

      $sql = "SELECT * FROM product_sub_categories where sub_cat_id='$sub_cat_id'";
      $Query = mysqli_query($con, $sql);
      $fetch = mysqli_fetch_assoc($Query);
      $sub_cat_title = $fetch['sub_cat_title'];
    ?>
  <?php include 'product_section.php'; ?>
  <?php } ?>
  <a href="rations.php" class="btn btn-md font-5 bottom-p btn-info text-white d-block mx-auto">View All</a>
  <?php } ?>

  <div class="container-fluid mt-5 mb-2">
   <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-12 col-xs-12 bg-success">
     <h5 class="text-center text-white font-7">Recommended Products</h5>
    </div>
   </div>
  </div>

  <?php
  mysqli_set_charset($con, 'utf8');
  $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='1' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_type='RECOMMENDED' ORDER BY sortby ASC limit 0, 7";
  $query = mysqli_query($con, $sql);
  $count_products = mysqli_num_rows($query);
  if ($count_products == 0) { ?>
  <section class="container-fluid">
   <div class="row" style="padding:2%;">
    <div class="col-sm-12 col-xs-12">
     <div class="row" style='box-shadow:0px 0px 1px grey;padding-left:2%; padding-right:2%;border-radius:10px;'>
      <div class='col-sm-4 col-xs-4 col-4'
       style='padding-left:1%; padding-right:1%;padding:1%;border-right-style: groove !important; border-width: 1px !important; border-color: #8080801f !important;padding:5%;'>
       <img src="img/blank.png" style='width:100%;'>
      </div>
      <div class='col-sm-8 col-xs-8 col-8' style='padding-left:1%; padding-right:1%;padding:1%;'>
       <h5>Coming Soon...</h5>
       <p>Items are Coming soon.We will inform as soon as we start the process...</p>
      </div>
     </div>
    </div>
   </div>
  </section>
  <?php } else {
    while ($fetch = mysqli_fetch_assoc($query)) {
      $user_product_id = $fetch['user_product_id'];
      $product_tags = $fetch['product_tags'];
      $product_units = "$product_tags";
      $letters = preg_replace('/[0-9]/', '', "$product_tags");
      $numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
      $product_type = $fetch['product_type'];
      $sortby = $fetch['sortby'];
      $ApproxWeight = $fetch['approx_weight'];
      $product_title = $fetch['product_title'];
      $product_img = $fetch['product_img'];
      $product_offer_price = $fetch['product_offer_price'];
      $product_mrp_price = $fetch['product_mrp_price'];
      $product_tags = $fetch['product_tags'];
      $sub_cat_id = $fetch['product_sub_cat_id'];
      $brand_title = $fetch['brand_title'];
      $HindiName = $fetch['hindi_name'];
      $OfferAmount = $product_offer_price / $product_mrp_price * 100;
      $OfferAmount = round(100 - $OfferAmount);
      $SaveAmount = $product_mrp_price - $product_offer_price;

      if ($OfferAmount == 0) {
        $OfferAmount = "";
      } else {
        $OfferAmount = "<span class='offer-tag mt-2 ml-1'>$OfferAmount% OFF</span>";
      }

      if ($SaveAmount == 0) {
        $SaveAmount = "";
      } else {
        $SaveAmount = "<span class='st-price font-2'>Save <i class='fa fa-inr'></i>$SaveAmount</span>";
      }

      $sql = "SELECT * FROM product_sub_categories where sub_cat_id='$sub_cat_id'";
      $Query = mysqli_query($con, $sql);
      $fetch = mysqli_fetch_assoc($Query);
      $sub_cat_title = $fetch['sub_cat_title'];
    ?>
  <?php include 'product_section.php'; ?>
  <?php } ?>
  <a href="recommended.php" class="btn btn-md font-5 bottom-p btn-info text-white d-block mx-auto">View All</a>
  <?php } ?>
  <br>
  <?php CreateSlider("BOTTOM"); ?>
  <br><br><br><br><br>
  <?php GSI_footer_files(); ?>
  <script type="text/javascript">
  $('#carouselExampleIndicators').carousel({
   interval: 2300
  })
  </script>
 </body>

</html>
