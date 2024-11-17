<?php require 'files.php';
require 'session.php';

if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $_SESSION['product_id'] = $_GET['product_id'];
} else {
  $product_id = $_SESSION['product_id'];
}
mysqli_set_charset($con, 'utf8');
$sql = "SELECT * from user_products, product_categories,  pro_brands, product_sub_categories where user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id and  product_sub_categories.sub_cat_id=user_products.product_sub_cat_id and user_products.user_product_id='$product_id'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$user_product_id = $fetch['user_product_id'];
$product_tags = $fetch['product_tags'];
$product_cat_id = $fetch['product_cat_id'];
$product_cat_title = $fetch['product_cat_title'];
$product_sub_cat_title = $fetch['sub_cat_title'];
$product_sub_cat_id = $fetch['product_sub_cat_id'];
$product_units = "$product_tags";
$letters = preg_replace('/[0-9]/', '', "$product_tags");
$numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
$product_type = $fetch['product_type'];
$sortby = $fetch['sortby'];
$ApproxWeight = $fetch['approx_weight'];
$product_title_value = $fetch['product_title'];
$product_img = $fetch['product_img'];
$product_offer_price = $fetch['product_offer_price'];
$product_mrp_price = $fetch['product_mrp_price'];
$product_tags_value = $fetch['product_tags'];
$sub_cat_id_value = $fetch['product_sub_cat_id'];
$brand_title = $fetch['brand_title'];
$product_desc = $fetch['product_desc'];
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
  $OfferAmount = "<span class='offer-tag mt-1 pt-3 ml-0 pl-0 w-100 d-block mx-auto pb-3 bg-success text-white font-9' style='border-radius:35px;box-shadow:0px 0px 1px green;left:0px;'><i class='fa fa-star fa-spin'></i> $OfferAmount % OFF <i class='fa fa-star fa-spin'></i><br></span>";
}

if ($SaveAmount == 0) {
  $SaveAmount = "";
} else {
  $SaveAmount = "<span class='st-price'>Save <i class='fa fa-inr'></i>$SaveAmount</span>";
}

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
$ip_address = get_ip();
$IP_ADDRESS = $ip_address;
$DEVICE_TYPE = detectDevice();
$SYSTEM_INFO = $_SERVER['HTTP_USER_AGENT'];
date_default_timezone_set("Asia/Calcutta");
$CURRENT_DATE_TIME = date("d D M Y, h:m a");
$HOST_NAME = php_uname('n');
$GSI_GET_SYSTEM_DATA = "
 <b>Date_TIME:</b> $CURRENT_DATE_TIME<br>
 <b>IP_ADDRESS:</b> $IP_ADDRESS<br>
 <b>DEVICE_TYPE:</b> $DEVICE_TYPE<br>
 <b>HOST_NAME:</b> $HOST_NAME<br>
 <b>ipv6_n:</b> $ipv6_n<br>
 <b>ipv6_p:</b> $ipv6_p<br>
 <b>OS:</b> $os<br>
 <b>OS_RELESE:</b> $OS_release<BR>
 <b>OS_VERSION:</b> $OS_Version<br>
 <b>SYSTEM_INFO:</b> $System_Info<br>
 <b>SYSTEM_DETAIL:</b> $System_more_Info";
?>
<html style="<?php echo $ThemeColor; ?>">

 <head>
  <title><?php echo $AppNameWithExt; ?> ! <?php echo $AppTag; ?></title>
  <?php GSI_header_files(); ?>
 </head>

 <body>
  <?php include 'header.php';
  GetMsg(); ?>

  <section class="container-fluid">
   <div class="row mb-2 p-2">
    <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 p-2 pt-5 pl-0 pr-0">
     <a href="details.php?id=<?php echo $user_product_id; ?>">
      <?php echo $OfferAmount; ?>
      <img src="img/566-5664335_offer-ribbon-png-clipart.png" class="img-fluid" style="width:30%;position:absolute;top:50px;">
      <img src="<?php echo $MUrl; ?>/admin/img/store_img/pro_img/<?php echo $product_img; ?>" class='img-fluid mt-0 bg-white d-block border mx-auto mt-5'
       style="box-shadow: 0px 0px 0px grey;border-radius: 15px !important;padding: 10%;width: 100%;">
     </a>
    </div>
    <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 pro-text-bg p-3 mb-0 border" style="border-radius:15px !important;">
     <a href="details.php?id=<?php echo $user_product_id; ?>">
      <h3 class="mb-0 font-10 mb-2"><?php echo $product_title_value; ?></h3>
      <p class="text-grey font-6">
       <span class="pro-price float-right mr-2 mt-3" style="margin-right: 0px !important;margin-top: -8px !important;">
        <span class="font-8"><i class="fa fa-check text-success font-6 mr-0"></i> <?php echo $SaveAmount; ?></span><br>
        <span><i class='fa fa-star text-success font-8'></i>
         <?php echo round($product_offer_price / 100 * $PointsEranings); ?> Points</span>
       </span>
       <span><i class="fa fa-language text-success"></i> <?php echo $HindiName; ?></span><br>
       <span><i class="fa fa-check-circle text-success"></i> <?php echo $brand_title; ?></span><br>
       <span><?php echo $product_tags_value; ?></span> <?php if($ApproxWeight == null) { echo "";} else { echo "<i class='fa fa-angle-right'></i> $ApproxWeight"; } ?><br>
       <span><i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i
         class="fa fa-star-half text-warning"></i> <br> <i class="fa fa-user text-info"></i>
        <?php
              $RatingCount = $product_offer_price * 0.5 + 7;
              echo $RatingCount;
              ?></span>
       <span class="float-right" style="margin-top: -10px !important;">
        <span class="st-price font-5"><strike>Rs.<?php echo $product_mrp_price; ?></strike></span>
        <span class="font-10"
         style="border-style: groove;border-width: thin; border-color: green;padding-left: 15px !important; padding-right: 15px !important;border-radius: 30px;box-shadow: 0px 0px 2px white;background-color:green !important;color:white !important;padding:4%;"><i
          class="font-9 text-success"></i>Rs.<?php echo $product_offer_price; ?></span>
       </span>
      </p>
      <h5 class="font-5"><i class="fa fa-list"></i> Description</h5>
      <p class="font-4"><?php echo $product_desc; ?></p>
     </a>
    </div>
    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 col-12 pl-1 pr-1">
     <form action="insert.php" method="POST" class="mt-4">
      <input type="text" name="home_url" value="" hidden="">
      <input type="text" name="quantity" value="1" hidden="">
      <input type="text" name="Attoptions" value="" hidden="">
      <input type="text" name="store_id" value="<?php echo $store_id; ?>" hidden="">
      <input type="text" name="ip_address" value="<?php echo get_ip(); ?>" hidden="">
      <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
      <input type="text" name="user_product_id_value" value="<?php echo $user_product_id; ?>" hidden="">
      <?php
          if (isset($_SESSION['customer_id'])) {
            $CheckItemInCart = "SELECT * FROM customer_cart where customer_id='$customer_id' and device_info='$user_product_id'";
            $CartQuery = mysqli_query($con, $CheckItemInCart);
            $CountItemInCart = mysqli_num_rows($CartQuery);
            if ($CountItemInCart == 0) {
              $ButtonClass = "btn-info";
              $ButtonText = "<i class='fa fa-shopping-cart'></i> Add to Cart";
            } else {
              $ButtonText = "<i class='fa fa-check-circle'></i> Saved in Cart";
              $ButtonClass = "btn-warning";
            }
          } else {

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

            $CheckItemInCart = "SELECT * FROM customer_cart where ip_address='$device_info' and device_info='$user_product_id'";
            $CartQuery = mysqli_query($con, $CheckItemInCart);
            $CountItemInCart = mysqli_num_rows($CartQuery);
            if ($CountItemInCart == 0) {
              $ButtonClass = "btn-info";
              $ButtonText = "<i class='fa fa-shopping-cart mt-2'></i> Add to Cart";
            } else {
              $ButtonText = "<i class='fa fa-check-circle mt-1'></i> Saved in Cart";
              $ButtonClass = "btn-danger";
            }
          } ?>
      <button type="submit" name="save_to_cart" id="UserProduct<?php echo $user_product_id; ?>" onclick="SavedItem<?php echo $user_product_id; ?>()"
       class="btn btn-sm <?php echo $ButtonClass; ?> btn-block fixed-bottom bottom-text bottom-p mb-1 w-60 d-block mx-auto"><?php echo $ButtonText; ?></button>
     </form>
    </div>
   </div>
   <script type="text/javascript">
   function SavedItem<?php echo $user_product_id; ?>() {
    document.getElementById("UserProduct<?php echo $user_product_id; ?>").innerHTML =
     "<i class='fa fa-refresh fa-spin'></i> Saving...";
   }
   </script>
  </section>

  <div class="container-fluid mt-2">
   <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-12 col-xs-12 bg-success mb-2">
     <h5 class="text-white font-7">Recommended Items</h5>
    </div>
   </div>
  </div>

  <?php
  mysqli_set_charset($con, 'utf8');
  $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='1' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_sub_cat_id='$sub_cat_id_value' ORDER BY sortby ASC limit 0, 10";
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
        $SaveAmount = "<span class='st-price font-4'>Save <i class='fa fa-inr'></i>$SaveAmount</span>";
      }

      $sql = "SELECT * FROM product_sub_categories where sub_cat_id='$sub_cat_id'";
      $Query = mysqli_query($con, $sql);
      $fetch = mysqli_fetch_assoc($Query);
      $sub_cat_title = $fetch['sub_cat_title'];
    ?>
  <div class="container-fluid">
   <?php include 'product_section.php'; ?>
  </div>
  <?php } ?>
  <?php } ?>
  <div class="container-fluid">
   <div class="row">
    <div class="account-page mt-2 pl-1 pr-1">
     <a href="products.php?cat_id=<?php echo $product_cat_id; ?>&sub_cat_id=<?php echo $product_sub_cat_id;?>">
      <h4 class="font-5">View all <?php echo $product_sub_cat_title;?><i class="fa fa-angle-right float-right mr-2 font-11"></i></h4>
     </a>
    </div>
   </div>
  </div>

  <div class="container-fluid mt-3">
   <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-12 col-xs-12 bg-success mb-3">
     <h5 class="text-white font-7">Top Reviews
      <span class="float-right">
       <?php
            $SQL_product_reviews = "SELECT * FROM product_reviews where ProductId='$product_id' and ProReviewStatus='NEW'";
            $QUERY_product_reviews = mysqli_query($con, $SQL_product_reviews);
            $COUNT_product_reviews_all = mysqli_num_rows($QUERY_product_reviews);
            if ($COUNT_product_reviews_all == 0) {
              echo "No Review Found!";
            } else {
              echo "Total " . $COUNT_product_reviews_all . " Reviews";
            }
            ?>
      </span>
     </h5>
    </div>
   </div>
   <ul class="UserReviewsList">
    <?php
      $SQL_product_reviews = "SELECT * FROM product_reviews where ProductId='$product_id' ORDER BY ProReviewId  DESC LIMIT 0, 7";
      $QUERY_product_reviews = mysqli_query($con, $SQL_product_reviews);
      $COUNT_product_reviews = mysqli_num_rows($QUERY_product_reviews);
      if ($COUNT_product_reviews == 0 or $COUNT_product_reviews == null) { ?>
    <li>
     <div class="row p-3 bg-white border" tyle="border-radius:15px !important;">
      <div class="col-lg-1 col-md-2 col-sm-2 col-1 pr-1"><img src="img/user.png" class="img-fluid" style="border-radius: 100px;"></div>
      <div class="col-lg-11 col-md-10 col-sm-10 col-11 pl-1">
       <h6 class="mb-1 mt-1"><b>No Review Submitted!</b></h6>
       <h5 class="mb-0 mt-0">
        <i class="fa fa-star text-warning mt-0"></i>
        (0)
       </h5>
       <p>No Review Submitted</p>
      </div>
     </div>
    </li>
    <?php } else {
        while ($FETCH_product_reviews = mysqli_fetch_assoc($QUERY_product_reviews)) { ?>
    <li class="mt-2 bg-white p-1 border" style="border-radius:15px !important;">
     <div class="row p-3">
      <div class="col-lg-1 col-md-2 col-sm-2 col-1 text-center pr-1 pl-1"><img src="img/user.png" class="img-fluid d-block mx-auto" style="width: 100%;border-radius: 100px;"></div>
      <div class="col-lg-11 col-md-10 col-sm-10 col-11 pl-1">
       <h6 class="mb-1 mt-1 font-6"><b><?php echo $FETCH_product_reviews['ProReviewName']; ?></b>
        <span class="float-right font-3"><i><?php echo $FETCH_product_reviews['ProReviewCreatedOn']; ?></i></span><br>
        <span class="font-9"><?php
                                        $CountStar = $FETCH_product_reviews['ProReviewStarCount'];
                                        $RatingCounts = 0;
                                        while ($RatingCounts < $CountStar) {
                                          echo "<i class='fa fa-star text-warning mt-0'></i>";
                                          $RatingCounts++;
                                        } ?></span><br>
        <span class="font-5 text-info"><?php echo $FETCH_product_reviews['ProReviewTitle']; ?></span>
       </h6>
       <p class="mb-0" style="text-align: justify;"><?php echo $FETCH_product_reviews['ProReviewDesc']; ?>.<br>
       <form action="insert.php" method="POST" class="float-right" style="clear: both;">
        <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
        <input type="text" name="ProReviewId" value="<?php echo $FETCH_product_reviews['ProReviewId']; ?>" hidden="">
        <input type="text" name="ReviewsSubmittedBy" value="<?php echo $GSI_GET_SYSTEM_DATA; ?>" hidden="">
        <input type="text" name="ReviewSubmittedOn" value="<?php echo date("d M Y h:m A"); ?>" hidden="">
        <button type="Submit" name="ReviewsType" value="HELPFULL" class="btn btn-sm btn-success pl-3 pr-3"><i class="fa fa-thumbs-up mt-0"></i>
         <span><?php
                          $SQL_product_reviews_count = "SELECT * FROM product_reviews_counts where ReviewsType='HELPFULL' and ProReviewId='" . $FETCH_product_reviews['ProReviewId'] . "'";
                          $QUERY_product_reviews_counts = mysqli_query($con, $SQL_product_reviews_count);
                          $COUNT_product_reviews_counts = mysqli_num_rows($QUERY_product_reviews_counts);
                          if ($COUNT_product_reviews_counts == 0) {
                            echo "0";
                          } else {
                            echo $COUNT_product_reviews_counts;
                          } ?></span>
        </button>
        <button type="submit" name="ReviewsType" value="REPORTED" class="btn-danger btn btn-sm pr-3 pr-3"><i class="fa fa-thumbs-down mt-0"></i>
         <span><?php
                          $SQL_product_reviews_count = "SELECT * FROM product_reviews_counts where ReviewsType='REPORTED' and ProReviewId='" . $FETCH_product_reviews['ProReviewId'] . "'";
                          $QUERY_product_reviews_counts = mysqli_query($con, $SQL_product_reviews_count);
                          $COUNT_product_reviews_counts = mysqli_num_rows($QUERY_product_reviews_counts);
                          if ($COUNT_product_reviews_counts == 0) {
                            echo "0";
                          } else {
                            echo $COUNT_product_reviews_counts;
                          } ?></span>
        </button>
       </form>
       </p>
      </div>
     </div>
    </li>
    <?php }
      }
      if ($COUNT_product_reviews_all > 5) { ?>
    <div class="account-page mt-3 pl-1 pr-1">
     <a href="reviews.php?pro_id=<?php echo $product_id; ?>">
      <h4 class="font-5">View All (<?php echo $COUNT_product_reviews_all; ?> Reviews) <i class="fa fa-angle-right float-right mr-2 font-11"></i></h4>
     </a>
    </div>
    <?php } ?>
   </ul>
  </div>

  <div class="container-fluid mt-5">
   <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-12 col-xs-12 bg-success mb-3">
     <h5 class="text-white font-7">Submit New Review</h5>
    </div>
    <div class="col-md-12 col-sm-12 col-lg-12 col-12 col-xs-12 mb-3">
     <form action="insert.php" method="POST">
      <input type="text" name="ProductId" class="form-control" value="<?php echo $product_id; ?>" hidden="">
      <input type="text" name="ProReviewUserType" class="form-control" value="<?php if (isset($_SESSION['customer_id'])) {
                                                                                    echo $_SESSION['customer_id'];
                                                                                  } else {
                                                                                    echo "Unknown";
                                                                                  } ?>" hidden="">
      <input type="text" name="ProReviewCreatedOn" class="form-control" value="<?php echo date("d M Y, h:m A"); ?>" hidden="">
      <input type="text" name="ProReviewStatus" class="form-control" value="NEW" hidden="">
      <input type="text" name="cr_url" value="<?php get_url(); ?>" hidden="">
      <textarea class="form-control" rows="5" value="" name="ProReviewDeviceDetails" hidden=""><?php echo $GSI_GET_SYSTEM_DATA; ?></textarea>
      <div class="form-group">
       <label>
        <input type="radio" name="ProReviewStarCount" value="1" required="" />
        <span class="icon" style="font-size: 18px;">★</span>
       </label><br>
       <label>
        <input type="radio" name="ProReviewStarCount" value="2" />
        <span class="icon" style="font-size: 18px;">★</span>
        <span class="icon" style="font-size: 18px;">★</span>
       </label><br>
       <label>
        <input type="radio" name="ProReviewStarCount" value="3" />
        <span class="icon" style="font-size: 18px;">★</span>
        <span class="icon" style="font-size: 18px;">★</span>
        <span class="icon" style="font-size: 18px;">★</span>
       </label><br>
       <label>
        <input type="radio" name="ProReviewStarCount" value="4" />
        <span class="icon" style="font-size: 18px;">★</span>
        <span class="icon" style="font-size: 18px;">★</span>
        <span class="icon" style="font-size: 18px;">★</span>
        <span class="icon" style="font-size: 18px;">★</span>
       </label><br>
       <label>
        <input type="radio" name="ProReviewStarCount" value="5" />
        <span class="icon" style="font-size: 18px;">★</span>
        <span class="icon" style="font-size: 18px;">★</span>
        <span class="icon" style="font-size: 18px;">★</span>
        <span class="icon" style="font-size: 18px;">★</span>
        <span class="icon" style="font-size: 18px;">★</span>
       </label>
      </div>
      <div class="form-group">
       <input type="text" name="ProReviewName" class="form-control font-5" required="" placeholder="Full Name" value="<?php if (isset($_SESSION['customer_id'])) {
                                                                                                                              echo $customer_name;
                                                                                                                            } else {
                                                                                                                            }; ?>">
      </div>
      <div class="form-group">
       <input type="email" name="ProReviewEmail" class="form-control font-5" required="" placeholder="Email Id" value="<?php if (isset($_SESSION['customer_id'])) {
                                                                                                                              echo $customer_mail_id;
                                                                                                                            } else {
                                                                                                                            }; ?>">
      </div>
      <div class="form-group">
       <input type="text" name="ProReviewTitle" class="form-control font-5" required="" placeholder="Review Title">
      </div>
      <div class="form-group">
       <textarea class="form-control font-5" name="ProReviewDesc" required="" rows="4"></textarea>
      </div>
      <div class="form-group">
       <button class="btn btn-success btn-block p-3 bottom-text" name="SaveNewReview" type="Submit">Submit</button>
      </div>
     </form>
    </div>
   </div>
  </div>

  <?php CreateSlider("BOTTOM"); ?><br><br><br><br>

  <?php GSI_footer_files(); ?>
 </body>

</html>
