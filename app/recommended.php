<?php require 'files.php'; require 'session.php'; ?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php'; GetMsg();?>
  <?php CreateSlider("RECOMMONDED");?>
  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-sm-12 col-12">
     <h4 class="font-4 mt-3 text-center"><i class="fa fa-star fa-spin text-warning"></i> RECOMMONDED ITEMS <i class="fa fa-star fa-spin text-warning"></i></h4>
    </div>
   </div>
  </section>

  <?php
mysqli_set_charset($con, 'utf8');
      $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='1' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_type='RATIONS' ORDER BY sortby ASC";
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
  <?php include 'product_section.php'; ?>
  <?php } ?>
  <?php } ?>
  <br><br><br><br>
  <?php GSI_footer_files();?>
 </body>

</html>
