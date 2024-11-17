<?php require 'files.php'; require 'session.php'; ?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php'; GetMsg();?>
  <?php CreateSlider("TODAY_DEALS");?><br>
  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-sm-12 col-12 bg-success p-1">
     <h4 class="text-white font-7"><i class="fa fa-star fa-spin"></i> Today Deals <i class="fa fa-star fa-spin"></i></h4>
    </div>
   </div>
  </section>

  <?php
mysqli_set_charset($con, 'utf8');
$sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='1' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_type='TODAY_DEALS' ORDER BY sortby ASC limit $start, $end";
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
  
  require 'product_section.php'; 
  
   } ?>
  <?php } ?>
  <section class="container-fluid">
   <div class="row mt-3">
    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xs-4 p-3 pl-1 pr-1">
     <a href="today_deals.php?" class="btn btn-lg btn-info font-5 text-white">First Page</a>
    </div>
    <div class="col-8 col-xs-8 col-md-8 col-sm-8 col-lg-8 pl-1 pr-1">
     <?php 
                              if(isset($_GET['start'])){
                                $start = $_GET['start'];
                                $end = $_GET['end'];
                                if($start == 0 or $end == 0){
                                  $start = 0;
                                  $end = 10;
                                } else {
                                  $start = $_GET['start'];
                                    $end = $_GET['end'];
                                }
                              } elseif ($start == 0 and $end == 10) {
                                $start = 0;
                                $end = 0;
                              } else { 
                                if($start == 0 or $end == 0){
                                  $start = 0;
                                  $end = 10;
                                } else {
                                  $start = 0;
                                $end = 10;
                                }
                                                                
                              }?>
     <?php 
                             $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='1' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_type='TODAY_DEALS' ORDER BY sortby ASC";
    $query = mysqli_query($con, $sql);
  $count_products = mysqli_num_rows($query);
?>

     <br> <a href="today_deals.php?start=<?php echo $start+10;?>&end=<?php 
if($end > $count_products) { echo "$count_products";
$disabled = "disabled";
$LastPageMsg = "<span class='text-danger'>You are at Last Page</span>"; } else { echo $end+10; $disabled = ""; $LastPageMsg = "";}?>"
      class="btn btn-lg btn-info text-white float-right m-1 mt-0 font-5 <?php echo $disabled;?>">Next <i class="fa fa-angle-right"></i> </a>

     <a href="today_deals.php?start=<?php if($start == 0){ echo "0";
                              $disabled = "disabled"; } else { echo $start-10;
                                $disabled = "";};?>&end=<?php if($end == 10){ echo "10"; } else { echo $end-10;};?>"
      class="btn btn-lg btn-info text-white float-right m-2 mt-0 font-5 <?php echo $disabled;?>"><i class="fa fa-angle-left"></i> Previous</a>

     <br>

    </div>
    <div class="col-lg-12 col-12 col-sm-12 col-mn-12 pl-1 pr-1">
     <p class="font-5">
      <span>
       Page No: <?php if(isset($_GET['start']) and isset($_GET['end'])){
                          $start = $_GET['start'];
                          $end = $_GET['end'];
                          $devide = $end/10;
                        } else {
                          $start = 0;
                          $end = 10;
                          $devide = 1;
                        } 
                        echo $devide; ?></span>
      <span class="float-right">
       Total Enteries : <?php 
                             $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='1' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_type='TODAY_DEALS' ORDER BY sortby ASC";
    $query = mysqli_query($con, $sql);
  $count_products = mysqli_num_rows($query);
  echo $count_products; ?><br>
       <?php echo $LastPageMsg;?>
      </span>
     </p>
    </div>
   </div>
  </section>
  <br><br><br><br>
  <?php GSI_footer_files();?>
 </body>

</html>
