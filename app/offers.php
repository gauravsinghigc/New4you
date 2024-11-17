<?php require 'files.php'; require 'session.php'; ?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php'; GetMsg();?>
  <?php CreateSlider("RATIONS");?><br>
  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-sm-12 col-12 bg-success p-1">
     <h4 class="font-7 text-white"><i class="fa fa-star fa-spin text-warning"></i> Running Offers<i class="fa fa-star fa-spin text-warning"></i></h4>
    </div>
   </div>
  </section>

  <div class="container-fluid mt-1">
   <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-12 col-xs-12 bg-info">
     <h4 class="text-center text-white font-6">Deal Of the Day</h4>
    </div>
   </div>
  </div>

  <?php
mysqli_set_charset($con, 'utf8');
      $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='1' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_type='TODAY_DEALS' ORDER BY sortby ASC limit 0, 10";
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
    $letters = preg_replace('/[0-9]/','',"$product_tags");
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
    $OfferAmount = $product_offer_price/$product_mrp_price*100;
    $OfferAmount = round(100-$OfferAmount);
    $SaveAmount = $product_mrp_price - $product_offer_price;
    $HindiName = $fetch['hindi_name'];
    $OfferAmount = $product_offer_price/$product_mrp_price*100;
    $OfferAmount = round(100-$OfferAmount);
    $SaveAmount = $product_mrp_price - $product_offer_price;

    if($OfferAmount == 0){
      $OfferAmount = "";
    } else {
      $OfferAmount = "<span class='offer-tag mt-2 ml-1'>$OfferAmount% OFF</span>";
    }

    if($SaveAmount == 0){
      $SaveAmount = "";
    } else {
      $SaveAmount = "<span class='st-price font-2'>Save <i class='fa fa-inr'></i>$SaveAmount</span>";
    }

    $sql = "SELECT * FROM product_sub_categories where sub_cat_id='$sub_cat_id'";
    $Query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($Query);
    $sub_cat_title = $fetch['sub_cat_title'];
   ?>
  <?php include 'product_section.php';?>
  <?php } ?>
  <a href="today_deals.php" class="btn btn-md font-5 bottom-p btn-info text-white d-block mx-auto">View All</a>
  <?php } ?>
  <br>
  <?php CreateSlider("MIDDLE");?>
  <div class="container-fluid mt-5">
   <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-12 col-xs-12 bg-info">
     <h4 class="text-center text-white font-6">Monthly Ration Offers</h4>
    </div>
   </div>
  </div>

  <?php
mysqli_set_charset($con, 'utf8');
      $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='1' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_type='RATIONS' ORDER BY sortby ASC limit 0, 10";
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
    $letters = preg_replace('/[0-9]/','',"$product_tags");
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
    $OfferAmount = $product_offer_price/$product_mrp_price*100;
    $OfferAmount = round(100-$OfferAmount);
    $SaveAmount = $product_mrp_price - $product_offer_price;

    if($OfferAmount == 0){
      $OfferAmount = "";
    } else {
      $OfferAmount = "<span class='offer-tag mt-2 ml-1'>$OfferAmount % OFF</span>";
    }

    if($SaveAmount == 0){
      $SaveAmount = "";
    } else {
      $SaveAmount = "<span class='st-price font-2'>Save <i class='fa fa-inr'></i>$SaveAmount</span>";
    }

    $sql = "SELECT * FROM product_sub_categories where sub_cat_id='$sub_cat_id'";
    $Query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($Query);
    $sub_cat_title = $fetch['sub_cat_title'];
   ?>
  <?php include 'product_section.php';?>
  <?php } ?>
  <a href="rations.php" class="btn btn-md font-5 bottom-p btn-info text-white d-block mx-auto">View All</a>
  <?php } ?>

  <div class="container-fluid mt-5">
   <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-12 col-xs-12 bg-info">
     <h4 class="text-center text-white font-6">Recommended Products</h4>
    </div>
   </div>
  </div>

  <?php
mysqli_set_charset($con, 'utf8');
      $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='1' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_type='RECOMMENDED' ORDER BY sortby ASC limit 0, 10";
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
    $letters = preg_replace('/[0-9]/','',"$product_tags");
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
    $OfferAmount = $product_offer_price/$product_mrp_price*100;
    $OfferAmount = round(100-$OfferAmount);
    $SaveAmount = $product_mrp_price - $product_offer_price;

    if($OfferAmount == 0){
      $OfferAmount = "";
    } else {
      $OfferAmount = "<span class='offer-tag mt-2 ml-1'>$OfferAmount % OFF</span>";
    }

    if($SaveAmount == 0){
      $SaveAmount = "";
    } else {
      $SaveAmount = "<span class='st-price font-2'>Save <i class='fa fa-inr'></i>$SaveAmount</span>";
    }

    $sql = "SELECT * FROM product_sub_categories where sub_cat_id='$sub_cat_id'";
    $Query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($Query);
    $sub_cat_title = $fetch['sub_cat_title'];
   ?>
  <?php include 'product_section.php';?>
  <?php } ?>
  <a href="recommended.php" class="btn btn-md font-5 bottom-p btn-info text-white d-block mx-auto">View All</a>
  <?php } ?>

  <br><br><br><br>
  <?php GSI_footer_files();?>
 </body>

</html>
