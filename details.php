<?php include 'files.php';
if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $_SESSION['view_id'] = $_GET['id'];
} else {
  $product_id = $_SESSION['view_id'];
}

$sql = "SELECT * from user_products, product_categories,  pro_brands, product_sub_categories where user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id and user_products.user_product_id='$product_id' and product_categories.product_cat_id=product_sub_categories.product_cat_id and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$user_product_id_value = $fetch['user_product_id'];
$user_product_id_value_view = $fetch['user_product_id'];
$product_cat_id_view = $fetch['product_cat_id'];
$product_sub_cat_id_view = $fetch['product_sub_cat_id'];
$product_brand_id_view = $fetch['product_brand_id'];
$product_title_view = $fetch['product_title'];
$Product_title_value_view  = $fetch['product_title'];
$ProductModalNo_view = $fetch['ProductModalNo'];
$product_modal_for_seo_view = $fetch['product_modal_for_seo'];
$ProductSizeCapacity_view = $fetch['ProductSizeCapacity'];
$product_size_capacity_status_view = $fetch['product_size_capacity_status'];
$unique_feature_view = $fetch['unique_feature'];
$ProductEdition_view = $fetch['ProductEdition'];
$product_edition_status_view = $fetch['product_edition_status'];
$product_warranty_in_diff_time_view = $fetch['product_warranty_in_diff_time'];
$product_warranty_in_break_view = $fetch['product_warranty_in_break'];
$product_top_list_status_view = $fetch['product_top_list_status'];
$product_measure_unit_view = $fetch['product_measure_unit'];
$unit_type_view = $fetch['unit_type'];
$product_offer_status_view = $fetch['product_offer_status'];
$product_stock_in_view = $fetch['product_stock_in'];
$product_stock_alert_on_view = $fetch['product_stock_alert_on'];
$product_type_view = $fetch['product_type'];
$product_offer_price_view = $fetch['product_offer_price'];
$product_mrp_price_view = $fetch['product_mrp_price'];
$product_save_amount_view = $fetch['product_save_amount'];
$product_HSN_view = $fetch['product_HSN'];
$products_taxes_view = $fetch['products_taxes'];
$product_net_price_view = $fetch['product_net_price'];
$product_return_policy_status_view = $fetch['product_return_policy_status'];
$product_return_policy_charge_amount_view = $fetch['product_return_policy_charge_amount'];
$product_return_time_in_days_view = $fetch['product_return_time_in_days'];
$product_installation_charge_status_view = $fetch['product_installation_charge_status'];
$product_installation_charge_view = $fetch['product_installation_charge'];
$product_installation_charge_pincode_wise_view = $fetch['product_installation_charge_pincode_wise'];
$product_delivery_charge_status_view = $fetch['product_delivery_charge_status'];
$product_delivery_charge_view = $fetch['product_delivery_charge'];
$product_delivery_charge_pincode_wise_view = $fetch['product_delivery_charge_pincode_wise'];
$product_description_view = $fetch['product_description'];
$product_created_at_view = $fetch['product_created_at'];
$product_updated_at_view = $fetch['product_updated_at'];
$product_status_view = $fetch['product_status'];
$product_sort_by_order_view = $fetch['product_sort_by_order'];
$product_status_view = $fetch['product_status'];
$stockcount_view = $product_stock_in_view;
$alertcount_view = $product_stock_alert_on_view;
$hindi_name_view = $unique_feature_view;
$product_tags_view = $product_measure_unit_view; //$fetch['product_tags'];
$brand_title_view = $fetch['brand_title'];
$product_image_view = $fetch['product_image'];
$product_sub_cat_title_view = $fetch['sub_cat_title'];
$product_created_at_view = $fetch['product_created_at'];
$product_updated_at_view = $fetch['product_updated_at'];
$brand_title_view = $fetch['brand_title'];
$sub_cat_title_view = $fetch['sub_cat_title'];
$product_cat_title_view = $fetch['product_cat_title'];
$stockcount = $fetch['product_stock_in'];
$alertcount = $fetch['product_stock_alert_on'];
$hindi_name = $fetch['unique_feature'];
$product_img = $fetch['product_image'];
$product_type_view = $fetch['product_type'];

if ($product_status_view == "active") {
  $status = "<i class='text-success fa fa-check-circle float-right'> Active</i>";
} elseif ($product_status_views == "inactive") {
  $status = "<i class='text-warning fa fa-warning float-right'> Inactive</i>";
}

$saveamount = $product_save_amount_view;

if ($product_installation_charge_status_view === "YES") {
  $installation_charge = "Installation <i class='fa fa-inr'></i> " . $product_installation_charge_view . "<br>";
} else {
  $installation_charge = "";
}


if ($product_delivery_charge_status_view === "YES") {
  $delivery_charge = "Delivery <i class='fa fa-inr'></i> " . $product_delivery_charge_view . "<br>";
} else {
  $delivery_charge = "";
}

if ($saveamount == 0 || $saveamount < 0) {
  $hidden = "style='display:none;'";
} else {
  $hidden = "";
}

if ($product_offer_status_view === "Yes") {
  $product_type = str_replace("_", " ", $product_type_view);
  $product_offer_status = "<span class='text-danger'>Offer Available</span> | <span class='text-success'>$product_type_view</span>";
} else {
  $product_offer_status = "";
}


?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $product_title_view; ?> : Home</title>
  <?php include 'header_files.php'; ?>
  <style>
    .price .price {
      margin-left: -47px !important;
      margin-top: 0.7rem !important;
    }
  </style>
  <style type="text/css">
    .rating {
      display: inline-block;
      position: relative;
      height: 50px;
      line-height: 50px;
      font-size: 50px;
    }

    .rating label {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      cursor: pointer;
    }

    .rating label:last-child {
      position: static;
    }

    .rating label:nth-child(1) {
      z-index: 5;
    }

    .rating label:nth-child(2) {
      z-index: 4;
    }

    .rating label:nth-child(3) {
      z-index: 3;
    }

    .rating label:nth-child(4) {
      z-index: 2;
    }

    .rating label:nth-child(5) {
      z-index: 1;
    }

    .rating label input {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
    }

    .rating label .icon {
      float: left;
      color: transparent;
    }

    .rating label:last-child .icon {
      color: #000;
    }

    .rating:not(:hover) label input:checked~.icon,
    .rating:hover label:hover input~.icon {
      color: #09f;
    }

    .rating label input:focus:not(:checked)~.icon:last-child {
      color: #000;
      text-shadow: 0 0 5px #09f;
    }
  </style>
</head>

<body>
  <?php include "header.php";  ?>
  <!-- breadcrumb start -->
  <div class="breadcrumb-main ">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="breadcrumb-contain">
            <div>
              <h2><?php echo $product_title_view; ?></h2>
              <ul>
                <li><a href="index.php">home</a></li>
                <li><i class="fa fa-angle-double-right"></i></li>
                <li><a href="javascript:void(0)"><?php echo $product_title_view; ?></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- breadcrumb End -->

  <!-- section start -->
  <section class="section-big-pt-space b-g-light">
    <div class="collection-wrapper">
      <div class="custom-container">
        <div class="row">

          <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="container-fluid">
              <div class="row ">
                <div class="col-lg-5 bg-white" style="margin-bottom:1rem !important;">
                  <div class="product-slick bg-white">
                    <div><img loading="lazy" src="<?php echo $img_url; ?>/img/store_img/pro_img/<?php echo $product_img; ?>" alt="" class="img-fluid p-2 image_zoom_cls-0" style="border-radius:10px !important;"></div>
                  </div>
                </div>
                <div class="col-lg-7 rtl-text text-left">
                  <div class="product-right">
                    <div class="pro-group">
                      <div class="new-label1" style="background-color: #008000c4;
    color: white !important;
    padding: 0.4rem;
    font-weight: 600;
    font-size: 1.2rem;
    border-radius: 5px;
    border-top-right-radius: 50px;
    margin-bottom: 0.4rem !important;">
                        <div>Save Rs.<?php echo number_format($saveamount); ?></div>
                      </div>
                      <p class="text-black text-left" style="letter-spacing:0px !important;display:block;visibility:visible;font-size:1.2rem !important;">
                        <span class="text-uppercase text-black"><?php echo $brand_title_view; ?> &nbsp; <?php echo $product_title_view; ?></span><br>
                        <span class="bold"><b><?php echo $unique_feature_view; ?> &nbsp; <?php echo $ProductSizeCapacity_view; ?></b></span><br>
                        <span class=""><?php echo $ProductModalNo_view; ?> &nbsp; <?php echo $ProductEdition_view; ?><br> </span>
                        <span class=""><?php echo $product_warranty_in_diff_time_view; ?> &nbsp; <?php echo $product_warranty_in_break_view; ?></span><br>
                        <?php
                        $SavingPercentage = round($product_offer_price_view / $product_mrp_price_view * 100);
                        $SavingPercentage = 100 - $SavingPercentage;
                        if ($SavingPercentage == 0 or $SavingPercentage <= 0) {
                          $SavingPercentage = "";
                        } else {
                          $SavingPercentage = $SavingPercentage . "% Off";
                        }
                        ?>
                        <span class="h4 text-primary"><i class="fa fa-inr"></i> <?php echo number_format($product_offer_price_view); ?> &nbsp; <strike class='text-black h6'><i class="fa fa-inr"></i> <?php echo number_format($product_mrp_price_view); ?></strike> <span class="h6 text-black"><?php echo $SavingPercentage; ?></span></span><br>
                        <span>
                          <?php if ($saveamount != 0 || $saveamount != "0") { ?>
                            Save <i class="fa fa-inr"></i> <?php echo number_format($saveamount); ?><br>
                          <?php } ?>
                          <?php echo $installation_charge; ?>
                        </span>
                        <span>
                          <?php echo $delivery_charge; ?>
                        </span>
                        <?php if ($stockcount == 0 or $stockcount == "0") { ?>
                          <span class="text-danger">Currently Not Available</span><br>
                        <?php } else { ?>
                          <span class="text-success"> In Stock</span><br>
                        <?php } ?>
                        <span class="text-center text-uppercase"><span class="text-center text-uppercase"><?php echo $product_offer_status; ?></span></span>
                      </p>
                    </div>
                    <div id="selectSize" class="pro-group addeffect-section product-description" style="display: flex;
    justify-content: flex-start;">
                      <?php if ($stockcount == 0 or $stockcount == "0") { ?>
                        <button class="btn btn-warning btn-md">Out Of Stock</button>
                      <?php } else { ?>
                        <form action="insert.php" method="POST" class="pt-0 float-left width-auto">
                          <input type="text" name="store_id" value="<?php echo $store_id; ?>" hidden>
                          <input type="text" name="ip_address" value="<?php echo get_ip(); ?>" hidden>
                          <input type="text" name="cr_url" value="<?php get_url(); ?>" hidden>
                          <input type="text" name="product_HSN" value="<?php echo $product_HSN_view; ?>" hidden="">
                          <input type="text" name="product_taxes" value="<?php echo $products_taxes_view; ?>" hidden="">
                          <input type="text" name="product_net_price" value="<?php echo $product_net_price_view; ?>" hidden="">
                          <input type="text" name="user_product_id_value" value="<?php echo $user_product_id_value_view; ?>" hidden>
                          <input class="qty-adj form-control" name="quantity" type="number" value="1" hidden="" />
                          <div class=" product-buttons">
                            <button id="cartEffect" type="submit" value="details.php" name="save_to_cart" class="btn btn-lg btn-info text-white" style="border-radius: 0px;
    padding: 0.6rem 1rem;">
                              <I class="fa fa-shopping-basket"></I> add to cart
                            </button>
                          </div>
                        </form>
                        <form action="insert.php" method="POST" class="pt-0 ml-5 float-left width-auto">
                          <input type="text" name="store_id" value="<?php echo $store_id; ?>" hidden>
                          <input type="text" name="ip_address" value="<?php echo get_ip(); ?>" hidden>
                          <input type="text" name="cr_url" value="<?php get_url(); ?>" hidden>
                          <input type="text" name="product_HSN" value="<?php echo $product_HSN_view; ?>" hidden="">
                          <input type="text" name="product_taxes" value="<?php echo $products_taxes_view; ?>" hidden="">
                          <input type="text" name="product_net_price" value="<?php echo $product_net_price_view; ?>" hidden="">
                          <input type="text" name="user_product_id_value" value="<?php echo $user_product_id_value_view; ?>" hidden>
                          <input class="qty-adj form-control" name="quantity" type="number" value="1" hidden="" />
                          <div class=" product-buttons">
                            <button id="cartEffect" type="submit" value="cart.php" name="save_to_cart" class="btn cart-btn btn-lg btn-danger" style="border-radius: 0px;
    padding: 0.6rem 1rem;
    margin-left: 1rem !important;">
                              <I class="fa fa-tag"></I> Buy Now
                            </button>
                          <?php } ?>
                          </div>
                        </form>
                    </div>
                    <div class="pro-group pb-0 text-left">
                      <h6 class="product-title">share</h6>
                      <ul class="product-social">
                        <li><button onclick="ShareView()" id="Sharebtn" class="btn btn-light btn-primary text-white"><i class="fa fa-share text-white"></i></button></li>
                        <li id="share" style="display:none;"><button class="btn btn-dark" id="copybutton" onclick="myFunction()"><span id="CCText">Click to Copy</span><input type="text" id="myInput" value="<?php echo get_url(); ?>" class="form-control"></button></li>
                      </ul>
                      <script>
                        function myFunction() {
                          var copyText = document.getElementById("myInput");
                          copyText.select();
                          copyText.setSelectionRange(0, 99999)
                          document.execCommand("copy");
                          document.getElementById("CCText").innerHTML = "Sharing Link Copied!";
                          document.getElementById("copybutton").classList.add("btn-danger");
                        }

                        function ShareView() {
                          var sharebtnstatus = document.getElementById("share");
                          if (sharebtnstatus.style.display === "none") {
                            document.getElementById("share").style.display = "block";
                          } else {
                            document.getElementById("share").style.display = "none";
                          }
                        }
                      </script>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <section class="tab-product tab-exes creative-card creative-inner">
              <div class="row">
                <div class="col-sm-12 col-lg-12">
                  <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-selected="true"><i class="icofont icofont-ui-home"></i>Description</a>
                      <div class="material-border"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="review-top-tab" data-bs-toggle="tab" href="#top-review" role="tab" aria-selected="false"><i class="icofont icofont-contacts"></i>Write Review</a>
                      <div class="material-border"></div>
                    </li>
                  </ul>
                  <div class="tab-content nav-material" id="top-tabContent">
                    <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                      <div class="row">
                        <div class="col-md-6">
                          <table class="table table-striped w-30">
                            <?php
                            $SQL_options = "SELECT * FROM product_specifications where product_id='$user_product_id_value_view'";
                            $optionsquery = mysqli_query($con, $SQL_options);
                            $counto = 0;
                            while ($F_options = mysqli_fetch_assoc($optionsquery)) {
                              $counto++; ?>
                              <tr>
                                <th><?php echo $F_options['specification_name']; ?></th>
                                <td><?php echo $F_options['specification_value']; ?></td>
                              </tr>
                            <?php } ?>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="top-review" role="tabpanel" aria-labelledby="review-top-tab">
                      <div class="row">
                        <div class="col-md-6 col-lg-6 col-12 p-1">
                          <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <span class="float-right">
                              <?php
                              $user_product_id_value = $user_product_id_value_view;
                              $SQL_product_reviews = "SELECT * FROM product_reviews where ProductId='$user_product_id_value' and ProReviewStatus='NEW'";
                              $QUERY_product_reviews = mysqli_query($con, $SQL_product_reviews);
                              $COUNT_product_reviews_all = mysqli_num_rows($QUERY_product_reviews);
                              ?>
                            </span>
                            <ul>
                              <?php
                              $user_product_id_value = $user_product_id_value_view;
                              $SQL_product_reviews = "SELECT * FROM product_reviews where ProductId='$user_product_id_value' ORDER BY ProReviewStarCount  DESC LIMIT 0, 5";
                              $QUERY_product_reviews = mysqli_query($con, $SQL_product_reviews);
                              $COUNT_product_reviews = mysqli_num_rows($QUERY_product_reviews);
                              if ($COUNT_product_reviews == 0 or $COUNT_product_reviews == null) { ?>
                                <li style="width:100%;">
                                  <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-3 pr-1"><img src="img/user.png" class="img-fluid"></div>
                                    <div class="col-lg-10 col-md-9 col-sm-8 col-9 pl-1">
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
                                  <li class="mt-2" style="width:100%;">
                                    <div class="row">
                                      <div class="col-lg-2 col-md-3 col-sm-2 col-3 pr-1 text-center pt-3">
                                        <img src="img/user.png" class="img-fluid d-block mx-auto" style="width: 80%;">
                                      </div>
                                      <div class="col-lg-10 col-md-9 col-sm-10 col-9 pl-1">
                                        <h6 class="mb-1 mt-1"><b><?php echo $FETCH_product_reviews['ProReviewTitle']; ?></b><br>
                                          <?php echo $FETCH_product_reviews['ProReviewName']; ?>
                                          <span class="float-right" style="float:right !important;"><i><?php echo $FETCH_product_reviews['ProReviewCreatedOn']; ?></i></span>
                                        </h6>
                                        <h5 class="mb-0 mt-0">
                                          <?php
                                          $CountStar = $FETCH_product_reviews['ProReviewStarCount'];
                                          $RatingCounts = 0;
                                          while ($RatingCounts < $CountStar) {
                                            echo "<i class='fa fa-star text-warning mt-0'></i>";
                                            $RatingCounts++;
                                          } ?>

                                        </h5>
                                        <p class="mb-0 ml-0 pl-0"><?php echo $FETCH_product_reviews['ProReviewDesc']; ?></p>
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
                                      </div>
                                    </div>
                                  </li>
                                <?php }
                              }
                              if ($COUNT_product_reviews_all > 5) { ?>
                                <a href="reviews.php?pro_id=<?php echo $user_product_id_value; ?>" class="float-right p-2 btn-success btn">View All (<?php echo $COUNT_product_reviews_all; ?> Reviews)</a>
                              <?php } ?>

                            </ul>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-12">
                          <div class="bg-success p-3">
                            <h5 class="text-white">Submit New Review</h5>
                          </div>
                          <form action="insert.php" method="POST">
                            <input type="text" name="ProductId" class="form-control" value="<?php echo $user_product_id_value; ?>" hidden="">
                            <input type="text" name="ProReviewUserType" class="form-control" value="<?php if (isset($_SESSION['customer_id'])) {
                                                                                                      echo $_SESSION['customer_id'];
                                                                                                    } else {
                                                                                                      echo "Unknown";
                                                                                                    } ?>" hidden="">
                            <input type="text" name="ProReviewCreatedOn" class="form-control" value="<?php echo date("d M Y, h:m A"); ?>" hidden="">
                            <input type="text" name="ProReviewStatus" class="form-control" value="NEW" hidden="">
                            <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
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
                              <input type="text" name="ProReviewName" class="form-control" required="" placeholder="Full Name" value="<?php if (isset($_SESSION['customer_id'])) {
                                                                                                                                        echo $customer_name;
                                                                                                                                      } else {
                                                                                                                                      }; ?>">
                            </div>
                            <div class="form-group">
                              <input type="email" name="ProReviewEmail" class="form-control" required="" placeholder="Email Id" value="<?php if (isset($_SESSION['customer_id'])) {
                                                                                                                                          echo $customer_mail_id;
                                                                                                                                        } else {
                                                                                                                                        }; ?>">
                            </div>
                            <div class="form-group">
                              <input type="text" name="ProReviewTitle" class="form-control" required="" placeholder="Review Title">
                            </div>
                            <div class="form-group">
                              <textarea class="form-control" name="ProReviewDesc" required="" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                              <button class="btn btn-success btn-block p-3" name="SaveNewReview" type="Submit">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section ends -->

  <!-- related products -->
  <section class="section-big-py-space  ratio_asos b-g-light">
    <div class="custom-container">
      <div class="row">
        <div class="col-12 product-related">
          <h2>related products</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12 product">
          <div class="product-slide-6 product-m no-arrow">
            <?php
            $sql = "SELECT * from user_products, pro_brands, product_categories where user_products.product_cat_id=product_categories.product_cat_id and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' and user_products.product_sub_cat_id='$product_sub_cat_id_view' ORDER BY user_product_id DESC limit 0, 4";
            $query = mysqli_query($con, $sql);
            while ($fetch = mysqli_fetch_assoc($query)) {
              include 'fields.php';
            ?>
              <?php
              $SQL_product_reviews = "SELECT * FROM product_reviews where ProductId='$user_product_id_value' and ProReviewStatus='NEW'";
              $QUERY_product_reviews = mysqli_query($con, $SQL_product_reviews);
              $COUNT_product_reviews_all = mysqli_num_rows($QUERY_product_reviews);
              if ($COUNT_product_reviews_all == 0) {
                $review =  "(0) <i class='fa fa-user text-info'></i>";
              } else {
                $review = "(" . $COUNT_product_reviews_all . ")  <i class='fa fa-user text-info'></i>";
              }
              ?>
              <div>
                <div class="product-box" style="height:auto !important;">
                  <div class="product-imgbox">
                    <a href="details.php?id=<?php echo $user_product_id_value; ?>">
                      <img loading="lazy" src="<?php echo $img_url; ?>/img/store_img/pro_img/<?php echo $product_img; ?>" alt="<?php echo $product_title; ?>" title="<?php echo $product_title; ?>" class="img-fluid">
                    </a>
                    <div class="new-label1" <?php echo $hidden; ?>>
                      <div>Save Rs.<?php echo number_format($saveamount); ?> </div>
                    </div>
                    <div class="detail-title">
                      <div class="detail-left">
                        <a href="details.php?id=<?php echo $user_product_id_value; ?>">
                          <?php require 'i_details.php'; ?>
                        </a>
                      </div>
                    </div>
                    <br>
                    <?php include "add-btn.php"; ?>
                  </div>
                </div>
              </div>
            <?php } ?>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- related products -->

  <?php include 'footer.php'; ?>

</body>

</html>