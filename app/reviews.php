<?php require 'files.php';
require 'session.php';

if (isset($_GET['pro_id'])) {
  $product_id = $_GET['pro_id'];
  $_SESSION['product_id'] = $_GET['pro_id'];
} else {
  $product_id = $_SESSION['product_id'];
}
mysqli_set_charset($con, 'utf8');
$sql = "SELECT * from user_products, product_categories,  pro_brands where user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id and user_products.user_product_id='$product_id'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$user_product_id = $fetch['user_product_id'];
$product_tags = $fetch['product_tags'];
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
  $OfferAmount = "<span class='offer-tag mt-1 pt-3 ml-0 pl-0 w-100 pb-3 bg-success text-white font-9' style='left:0px !important;border-radius:35px;box-shadow:0px 0px 1px green;'><i class='fa fa-star fa-spin'></i> $OfferAmount % OFF <i class='fa fa-star fa-spin'></i><br></span>";
}

if ($SaveAmount == 0) {
  $SaveAmount = "";
} else {
  $SaveAmount = "<span class='st-price'>Save <i class='fa fa-inr'></i> $SaveAmount</span>";
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
     <input type="text" name="ProReviewCreatedOn" class="form-control" value="<?php echo date("d M Y, h:m A"); ?>"
      hidden="">
     <input type="text" name="ProReviewStatus" class="form-control" value="NEW" hidden="">
     <input type="text" name="cr_url" value="<?php get_url(); ?>" hidden="">
     <textarea class="form-control" rows="5" value="" name="ProReviewDeviceDetails"
      hidden=""><?php echo $GSI_GET_SYSTEM_DATA; ?></textarea>
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
      <input type="text" name="ProReviewName" class="form-control font-5" required="" placeholder="Full Name"
       value="<?php if (isset($_SESSION['customer_id'])) {
                                                                                                                              echo $customer_name;
                                                                                                                            } else {
                                                                                                                            }; ?>">
     </div>
     <div class="form-group">
      <input type="email" name="ProReviewEmail" class="form-control font-5" required="" placeholder="Email Id"
       value="<?php if (isset($_SESSION['customer_id'])) {
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

 <div class="container-fluid mt-3">
  <div class="row">
   <div class="col-md-12 col-sm-12 col-lg-12 col-12 col-xs-12 bg-success mb-3">
    <h5 class="text-white font-7">All Reviews
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
      $SQL_product_reviews = "SELECT * FROM product_reviews where ProductId='$product_id' ORDER BY ProReviewId DESC";
      $QUERY_product_reviews = mysqli_query($con, $SQL_product_reviews);
      $COUNT_product_reviews = mysqli_num_rows($QUERY_product_reviews);
      if ($COUNT_product_reviews == 0 or $COUNT_product_reviews == null) { ?>
   <li>
    <div class="row">
     <div class="col-lg-1 col-md-1 col-sm-1 col-1 pr-1"><img src="img/user.png" class="img-fluid"
       style="border-radius: 100px;"></div>
     <div class="col-lg-11 col-md-11 col-sm-11 col-11 pl-1">
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
   <li class="mt-2 bg-white border p-1 pl-1 pr-1 mt-2" style="border-radius:15px !important;">
    <div class="row p-3">
     <div class="col-lg-1 col-md-2 col-sm-2 col-1 pr-1 text-center pl-1"><img src="img/user.png"
       class="img-fluid d-block mx-auto" style="width: 100%;border-radius: 100px;"></div>
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
       <button type="Submit" name="ReviewsType" value="HELPFULL" class="btn btn-sm btn-success pl-3 pr-3"><i
         class="fa fa-thumbs-up mt-0"></i>
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
       <button type="submit" name="ReviewsType" value="REPORTED" class="btn-danger btn btn-sm pr-3 pr-3"><i
         class="fa fa-thumbs-down mt-0"></i>
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
      } ?>
   <a href="details.php?id=<?php echo $product_id; ?>"
    class="text-white btn btn-info bottom-p bottom-text fixed-bottom">
    <i class="fa fa-angle-left mr-2"></i> Back to Details
   </a>
  </ul>
 </div>



 <?php CreateSlider("BOTTOM"); ?><br><br><br><br>

 <?php GSI_footer_files(); ?>
</body>

</html>