<?php
require 'files.php';
if (isset($_GET['product_id'])) {
  $product_id = $_GET['product_id'];
  mysqli_set_charset($con, 'utf8');
  $sql = "SELECT * from user_products, product_categories,  pro_brands, product_sub_categories where user_id='$user_id' and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id and user_products.user_product_id='$product_id'and product_categories.product_cat_id=product_sub_categories.product_cat_id and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  $user_product_id_value = $fetch['user_product_id'];
  $product_title = $fetch['product_title'];
  $product_title_value = $fetch['product_title'];
  $product_img = $fetch['product_img'];
  $product_offer_price = $fetch['product_offer_price'];
  $product_mrp_price = $fetch['product_mrp_price'];
  $product_tags = $fetch['product_tags'];
  $product_cat_id_value = $fetch['product_cat_id'];
  $brand_title = $fetch['brand_title'];
  $product_cat_title_value = $fetch['product_cat_title'];
  $product_sub_cat_id = $fetch['product_sub_cat_id'];
  $product_desc = $fetch['product_desc'];
  $hindi_name = $fetch['hindi_name'];
  $offer_percentage = $product_offer_price / $product_mrp_price * 100;
  $off = round($offer_percentage);
  if ($offer_percentage == 100) {
    $off_per = 0;
  } else {
    $off_per = 100 - $off;
  }

  $sql = "SELECT * FROM product_sub_categories where sub_cat_id='$product_sub_cat_id'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  $sub_cat_id = $fetch['sub_cat_id'];
  $sub_cat_title_value = $fetch['sub_cat_title'];
} else {
  header("location: products.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $store_name; ?> : <?php echo $product_title; ?></title>
  <?php require 'header_files.php'; ?>
  <script type="text/javascript">
    function incrementValue() {
      var value = parseInt(document.getElementById('number').value, 10);
      value = isNaN(value) ? 0 : value;
      if (value < 10) {
        value++;
        document.getElementById('number').value = value;
      }
    }

    function decrementValue() {
      var value = parseInt(document.getElementById('number').value, 10);
      value = isNaN(value) ? 0 : value;
      if (value > 1) {
        value--;
        document.getElementById('number').value = value;
      }

    }
  </script>
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
  <?php require 'header.php'; ?>
  <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <a href="index.php"><strong><span class="fa fa-home"></span> Home</strong></a> <span class="fa fa-angle-right"></span>
          <a href="products.php">All Products</a> <span class="fa fa-angle-right"></span>
          <a href="products.php?cat_id=<?php echo $product_cat_id_value; ?>"><?php echo $product_cat_title_value; ?></a>
          <span class="fa fa-angle-right"></span>
          <a href="products.php?sub_cat_id=<?php echo $sub_cat_id; ?>"><?php echo $sub_cat_title_value; ?></a> <span class="fa fa-angle-right"></span>
          <a href="products.php?product_id=<?php echo $product_id; ?>"><?php echo $product_title_value; ?></a>
        </div>
      </div>
    </div>
  </section>
  <section class="shop-single section-padding pt-3" style="background-color: white;margin-top: 0.5%;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="shop-detail-left">
            <div class="shop-detail-slider">
              <img src='<?php echo $url; ?>/img/store_img/pro_img/<?php echo $product_img; ?>'>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="shop-detail-right">
            <span class="badge badge-success"><?php echo $off_per; ?>% OFF</span>
            <h2><?php echo $product_title_value; ?> - <?php echo $hindi_name; ?></h2>
            <hr>
            <h6 class="mb-0"><strong><span class="fa fa-check-circle text-success"></span>
              </strong><?php echo $brand_title; ?>
            </h6>
            <p class="regular-price"> MRP : <i class="fa fa-inr"></i> <?php echo $product_mrp_price; ?></p>
            <p class="offer-price mb-2">Offer Price : <span class="text-success"><i class="fa fa-inr"></i><?php echo $product_offer_price; ?></span></p>
            <p class="offer-price mb-0"><span class="text-danger fa fa-square-outline"><?php echo $product_tags; ?></span></p>
            <br>

            <form action="insert.php" method="POST" class="pt-0 float-left width-auto">
              <span class="mobilabs-qty-text">Quantity:</span><input type="button" onclick="decrementValue()" class="btn btn-info btn-sm mb-0 mt-0" value="-" />
              <input type="number" name="quantity" min="1" max="10" value="1" id="number">
              <input type="button" onclick="incrementValue()" class="btn btn-info btn-sm mb-0 mt-0" value="+" /><br><br>
              <input type="text" name="store_id" value="<?php echo $store_id; ?>" hidden>
              <input type="text" name="ip_address" value="<?php echo get_ip(); ?>" hidden>
              <input type="text" name="cr_url" value="<?php get_url(); ?>" hidden>
              <input type="text" name="user_product_id_value" value="<?php echo $user_product_id_value; ?>" hidden>
              <button type="submit" name="save_to_cart" class="btn btn-success btn-lg mt-1 cart-btn-new-mobilabs"><i class="fa fa-shopping-cart"></i> Add To Cart</button>
            </form>
            <div class="clearfix"></div>
            <div class="short-description">
              <h5>
                Description
              </h5>
              <p>
                <?php echo $product_desc; ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="product-items-slider section-padding bg-white">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-md-12">
          <h3><b>Review & FAQ's </b>
            <hr>
          </h3>
        </div>
      </div>

      <div class="row">

        <div class="col-lg-4 col-md-4 col-12 col-sm-12">
          <h4 class="p-3 bg-info text-white"><b>Submit New Review</b></h4>
          <form action="insert.php" method="POST">
            <input type="text" name="ProductId" class="form-control" value="<?php echo $user_product_id_value; ?>" hidden="">
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

        <div class="col-lg-8 col-md-8 col-12 col-sm-12">
          <h4 class="p-3 bg-success text-white"><b>Top Reviews</b>
            <span class="float-right">
              <?php
              $SQL_product_reviews = "SELECT * FROM product_reviews where ProductId='$user_product_id_value' and ProReviewStatus='NEW'";
              $QUERY_product_reviews = mysqli_query($con, $SQL_product_reviews);
              $COUNT_product_reviews_all = mysqli_num_rows($QUERY_product_reviews);
              if ($COUNT_product_reviews_all == 0) {
                echo "No Review Found!";
              } else {
                echo "Total " . $COUNT_product_reviews_all . " Reviews";
              }
              ?>
            </span>
          </h4>
          <ul>
            <?php
            $SQL_product_reviews = "SELECT * FROM product_reviews where ProductId='$user_product_id_value' ORDER BY ProReviewStarCount  DESC LIMIT 0, 5";
            $QUERY_product_reviews = mysqli_query($con, $SQL_product_reviews);
            $COUNT_product_reviews = mysqli_num_rows($QUERY_product_reviews);
            if ($COUNT_product_reviews == 0 or $COUNT_product_reviews == null) { ?>
              <li>
                <div class="row">
                  <div class="col-lg-1 col-md-2 col-sm-2 col-3 pr-1"><img src="img/user.png" class="img-fluid"></div>
                  <div class="col-lg-11 col-md-10 col-sm-10 col-9 pl-1">
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
                <li class="mt-2">
                  <div class="row">
                    <div class="col-lg-1 col-md-2 col-sm-2 col-1 pr-1 text-center"><img src="img/user.png" class="img-fluid d-block mx-auto" style="width: 80%;"></div>
                    <div class="col-lg-11 col-md-10 col-sm-10 col-11 pl-1">
                      <h6 class="mb-1 mt-1"><b><?php echo $FETCH_product_reviews['ProReviewTitle']; ?></b><br>
                        <?php echo $FETCH_product_reviews['ProReviewName']; ?>
                        <span class="float-right"><i><?php echo $FETCH_product_reviews['ProReviewCreatedOn']; ?></i></span>
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
                      <p class="mb-0"><?php echo $FETCH_product_reviews['ProReviewDesc']; ?></p>
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

      <div class="section-header">
        <h3>More Products in
          <b>
            <?php
            $sql = "SELECT * FROM product_categories where product_cat_id='$product_cat_id_value'";
            $query = mysqli_query($con, $sql);
            $fetch = mysqli_fetch_assoc($query);
            $product_cat_title = $fetch['product_cat_title'];
            echo $product_cat_title;
            ?>

          </b>
          <hr>
        </h3>
        </h5>
      </div>
      <div class="owl-carousel owl-carousel-featured">
        <?php $sql = "SELECT * from user_products, pro_brands where user_id='$user_id' and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and product_sub_cat_id='$product_sub_cat_id'";
        $query = mysqli_query($con, $sql);
        while ($fetch = mysqli_fetch_assoc($query)) {
          $user_product_id_value = $fetch['user_product_id'];
          $product_title = $fetch['product_title'];
          $product_img = $fetch['product_img'];
          $product_offer_price = $fetch['product_offer_price'];
          $product_mrp_price = $fetch['product_mrp_price'];
          $product_tags = $fetch['product_tags'];
          $brand_title = $fetch['brand_title'];
          $offer_percentage = $product_offer_price / $product_mrp_price * 100;
          $off = round($offer_percentage);
          if ($offer_percentage == 100) {
            $off_per = 0;
          } else {
            $off_per = 100 - $off;
          }

        ?>
          <div class="item">
            <div class="product">
              <a href="details.php?product_id=<?php echo $user_product_id_value; ?>">
                <div class="product-header">

                  <img class="img-fluid" src="<?php echo $img_url; ?>/img/store_img/pro_img/<?php echo $product_img; ?>" alt="<?php echo $product_title; ?>" title="<?php echo $product_title; ?>">
                </div>
                <div class="product-body">
                  <h5><?php echo $product_title; ?> <br><?php echo $hindi_name; ?></h5>
                  <h6><strong><span class="fa fa-check-circle text-success"></span> <?php echo $product_tags; ?></strong></h6>
                </div>
                <div class="product-footer">

                  <p class="offer-price">
                    <b class="price">Rs.<?php echo $product_offer_price; ?></b>
                    <span class="regular-price">Rs.<?php echo $product_mrp_price; ?></span>
                  </p>
                  <form action="insert.php" method="POST" class="mb-2 text-center">
                    <input type="text" name="quantity" value="1" hidden="">
                    <input type="text" name="store_id" value="<?php echo $store_id; ?>" hidden>
                    <input type="text" name="ip_address" value="<?php echo get_ip(); ?>" hidden>
                    <input type="text" name="cr_url" value="<?php get_url(); ?>" hidden>
                    <input type="text" name="user_product_id_value" value="<?php echo $user_product_id_value; ?>" hidden>
                    <?php
                    $CheckItemInCart = "SELECT * FROM customer_cart where device_info='$user_product_id_value' and ip_address='$ip_address'";
                    $CartQuery = mysqli_query($con, $CheckItemInCart);
                    $CountItemInCart = mysqli_num_rows($CartQuery);
                    if ($CountItemInCart == 0) {
                      $ButtonClass = "btn-outline-success";
                      $ButtonText = "<i class='fa fa-shopping-cart'></i> Add to Cart";
                    } else {
                      $ButtonText = "<i class='fa fa-check-circle'></i> Saved";
                      $ButtonClass = "btn-danger";
                    } ?>
                    <button type="submit" name="save_to_cart" class="btn btn-secondary text-white btn-sm <?php echo $ButtonClass; ?>"><?php echo $ButtonText; ?></button>
                  </form>
                </div>
              </a>
            </div>
          </div>

        <?php } ?>

      </div>
    </div>
  </section>

  <?php require 'why_section.php'; ?>
  <?php require 'footer.php';
  require 'login_section.php'; ?>

  <!-- Bootstrap core JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <!-- select2 Js -->
  <script src="js/select2.min.js"></script>
  <!-- Owl Carousel -->
  <script src="js/owl.carousel.js"></script>
  <!-- Custom -->
  <script src="js/custom.js"></script>



</body>

</html>
<style type="text/css">
  .value-button {
    display: inline-block;
    border: 1px solid #ddd;
    margin: 0px;
    width: 40px;
    height: 20px;
    text-align: center;
    vertical-align: middle;
    padding: 11px 0;
    background: #eee;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .value-button:hover {
    cursor: pointer;
  }

  .form-data #decrease {
    margin-right: -4px;
    border-radius: 8px 0 0 8px;
  }

  .form-data #increase {
    margin-left: -4px;
    border-radius: 0 8px 8px 0;
  }

  .form-data #input-wrap {
    margin: 0px;
    padding: 0px;
  }

  input#number {
    text-align: center;
    border: none;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    margin: 0px;
    width: 40px;
    height: 40px;
  }

  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
</style>

<script type="text/javascript">
  function increaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
  }

  function decreaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value < 1 ? value = 1 : '';
    value--;
    document.getElementById('number').value = value;
  }
</script>