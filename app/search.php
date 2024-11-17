<?php require 'files.php'; require 'session.php';?>
<html style="<?php echo $ThemeColor;?>">

	<head>
		<title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
		<?php GSI_header_files();?>
	</head>

	<body>
		<?php include 'header.php'; GetMsg();?>
		<br>
		<section class="container-fluid pb-2">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 bg-success p-1">
					<h2 class="font-6 text-white ml-2"><i class="fa fa-search"></i> Search Results <i class="fa fa-angle-right"></i>
						<?php echo $_GET['search'];?>
					</h2>
				</div>
			</div>
		</section>
		<?php 
 if (isset($_GET['search'])) {
$productname = $_GET['search'];
$searchproductid = "SELECT * FROM user_products where product_title like '%$productname%'";

mysqli_set_charset($con, 'utf8');
      $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='1' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_title LIKE '%$productname%' ORDER BY sortby ASC limit 0, 20";
  $query = mysqli_query($con, $sql);
  $count_products = mysqli_num_rows($query);
  if ($count_products == 0) { ?>
		<section class="container-fluid">
			<div class="row" style="padding:2%;">
				<div class="col-sm-12 col-xs-12">
					<div class="row" style='padding-left:2%;border-radius:10px;'>
						<div class='col-sm-12 col-xs-12 col-12 text-center'
							style='padding-left:1%; padding-right:1%;padding:1%;border-right-style: groove !important; border-width: 1px !important; border-color: #8080801f !important;padding:5%;'>
							<img src="img/blank.png" style='width:40%;'>
							<h5>Item Not Found!</h5>
							<h6 class="text-danger">Search : <?php echo $_GET['search'];?></h6>
							<p>Search item could not found.</p>
							<a href="index.php" class="bg-info bottom-p bottom-text circle text-white fixed-bottom"><i class="fa fa-angle-left"></i> Back to Home</a>
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

		<?php } } ?>
		<br>
		<?php CreateSlider("BOTTOM");?>
		<br><br><br><br><br>
		<?php GSI_footer_files();?>
		<script type="text/javascript">
		$('#carouselExampleIndicators').carousel({
			interval: 2300
		})
		</script>
	</body>

</html>
