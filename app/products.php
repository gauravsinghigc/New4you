<?php require 'files.php';
require 'session.php';

$SQL_web_tools = "SELECT * FROM web_tools where NAME='ITEM_VIEW_LIST'";
$QUERY_web_tools = mysqli_query($con, $SQL_web_tools);
$FETCH_web_tools = mysqli_fetch_assoc($QUERY_web_tools);
$DEFAULT_LIST_VIEW = $FETCH_web_tools['VALUE'];

//Change list view count
if (isset($_GET['LIST_VIEW'])) {
  $_SESSION['LIST_VIEW'] = $_GET['LIST_VIEW'];
  $ITEM_VIEW_LIST = $_GET['LIST_VIEW'];
} elseif (isset($_SESSION['LIST_VIEW'])) {
  $ITEM_VIEW_LIST = $_SESSION['LIST_VIEW'];
} else {
  $ITEM_VIEW_LIST = $DEFAULT_LIST_VIEW;
}

//Apply new list view count at product view system
if (isset($_GET['start'])) {
  $start = $_GET['start'];
  $end = $_GET['end'];
} else {
  $start = 0;
  $end = $ITEM_VIEW_LIST;
}

//Sortby methods default and user listed
if (isset($_GET['SORT_BY_METHOD'])) {
  $_SESSION['SORT_BY_METHOD'] = $_GET['SORT_BY_METHOD'];
  $SORT_BY_METHOD = $_GET['SORT_BY_METHOD'];
  $ORDER_METHOD  = $_GET['order'];
  $_SESSION['ORDER_METHOD'] = $_GET['order'];
} elseif (isset($_SESSION['SORT_BY_METHOD'])) {
  $SORT_BY_METHOD = $_SESSION['SORT_BY_METHOD'];
  $ORDER_METHOD  = $_SESSION['ORDER_METHOD'];
} else {
  $SORT_BY_METHOD = "sortby";
  $ORDER_METHOD  = "ASC";
}


//ITEM View type LIST OR GRID Adjustment
if (isset($_GET['ITEM_VIEW_TYPE'])) {
  $_SESSION['ITEM_VIEW_TYPE'] = $_GET['ITEM_VIEW_TYPE'];
  $ITEM_VIEW_TYPE = $_GET['ITEM_VIEW_TYPE'];
} elseif (isset($_SESSION['ITEM_VIEW_TYPE'])) {
  $ITEM_VIEW_TYPE = $_SESSION['ITEM_VIEW_TYPE'];
} else {
  $ITEM_VIEW_TYPE = "LIST";
}
?>
<html>

<head>
  <title><?php echo $AppNameWithExt; ?> ! <?php echo $AppTag; ?></title>
  <?php GSI_header_files(); ?>
  <style>
    .circle {
      border-radius: 500px !important;
    }
  </style>
</head>

<onscroll="HideSideScroll()">
  <?php include 'header.php'; ?>
  <?php CreateSlider("PRODUCTS"); ?>
  <section class="container-fluid pb-0 pt-0 pr-1 pl-1">
    <div class="row">
      <div class="col-sm-12 col-xs-12 bg-success p-0">
        <h6 class="text-white">
          <?php
          if (isset($_GET['type'])) {
            $type = $_GET['type'];
            if ($type = "BASKET") {
              echo "Create Fruit Basket <i class='fa fa-angle-right'></i>";
            }
          }

          ?>

          <?php
          if (isset($_GET['sub_cat_id'])) {
            $sub_cat_id = $_GET['sub_cat_id'];
            $product_cat_id = $_GET['cat_id'];
            $sql = "SELECT * FROM product_categories where product_cat_id='$product_cat_id'";
            $query = mysqli_query($con, $sql);
            $fetch = mysqli_fetch_assoc($query);
            $product_cat_title = $fetch['product_cat_title'];

            $sql = "SELECT * FROM product_sub_categories where sub_cat_id='$sub_cat_id' and store_id='$store_id' and sub_cat_status='active'";
            $query = mysqli_query($con, $sql);
            $fetch = mysqli_fetch_assoc($query);
            $sub_cat_title = $fetch['sub_cat_title'];

            if ($sub_cat_id == null) {
              echo "<h6 class='font-6 text-white ml-2'>$product_cat_title <i class='fa fa-angle-right'></i></h4>";
            } else {
              echo "<h6 class='font-6 text-white ml-2'> $sub_cat_title <i class='fa fa-angle-right'></i></h4>";
            }
          } else {
          }  ?>
          <?php
          if (isset($_GET['SUBS_ID'])) { ?>
            ADD Items In : <?php echo $_GET['SUBS_ID']; ?>
          <?php } ?>
        </h6>
        <p><?php
            if (isset($_GET['type'])) {
              $type = $_GET['type'];
              if ($type = "BASKET") {
                echo "Basket Weight : 8 Kg and 10 Kg<br>
                          Choose Fruits for your Fruit Basket  ";
              }
            }

            ?></p>
      </div>
    </div>
  </section>

  <!-- header part end -->
  <section class="container-fluid pb-0 pt-0">
    <div class="row">
      <div class="col-sm-12 col-xs-12" style='padding-left:0px; padding-right:0px;'>

        <div class="scrollmenu mt-1">
          <?php
          if (isset($_GET['SEASONAL'])) { ?>
            <a href="?SEASONAL=true">ALL Subscription Products</a>
          <?php } else {
          ?>
            <?php
            if (isset($_GET['cat_id'])) {
              $cat_id = $_GET['cat_id'];
              $sub_cat = $_GET['sub_cat_id'];
              $sql_sub = "SELECT * FROM product_sub_categories where sub_cat_status='active' and product_cat_id='$cat_id'";
              $query_sub = mysqli_query($con, $sql_sub);
              while ($fetch = mysqli_fetch_assoc($query_sub)) {
                $cat_id = $_GET['cat_id'];
                $sub_cat_id = $fetch['sub_cat_id'];
                $sub_cat_title = $fetch['sub_cat_title'];
                $sub_cat_img = $fetch['sub_cat_img'];

                if ($sub_cat_id == $sub_cat) { ?>
                  <a href="?cat_id=<?php echo $cat_id; ?>&sub_cat_id=<?php echo $sub_cat_id; ?>" class="text-white bg-success font-6" style="width:20px !important;">
                    <img src="<?php echo $MUrl; ?>admin/<?php echo $sub_cat_img; ?>" class="img-fluid w-20" style="width:60% !important;border-radius:10px;"><br>
                    <?php echo $sub_cat_title; ?> </a>
                <?php  } else { ?>
                  <a href=" ?cat_id=<?php echo $cat_id; ?>&sub_cat_id=<?php echo $sub_cat_id; ?>" class='font-6' style="width:20px !important;">
                    <img src="<?php echo $MUrl; ?>admin/<?php echo $sub_cat_img; ?>" class="img-fluid w-20" style="width:60% !important;border-radius:10px;"><br>
                    <?php echo $sub_cat_title; ?>
                  </a>
          <?php }
              }
            }
          }
          ?>
        </div>
      </div>
    </div>
  </section>

  <div class=" container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 pl-0 pr-1 mb-2 pt-1">
        <span class="mb-0 ml-1 font-5 mt-1 float-left mr-2 mb-0 ">Sort By <i class="fa fa-angle-right"></i> </span>
        <div class="scrollmenu-filter">
          <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&SORT_BY_METHOD=sortby&order=ASC" class="font-4 <?php if ($SORT_BY_METHOD == "sortby") {
                                                                                                                                                                      echo "bg-info text-white";
                                                                                                                                                                    } else {
                                                                                                                                                                      echo "text-black";
                                                                                                                                                                    } ?>">Relevance
          </a>
          <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&SORT_BY_METHOD=product_title&order=ASC" class="font-4 <?php if ($SORT_BY_METHOD == "product_title" and $ORDER_METHOD == "ASC") {
                                                                                                                                                                            echo "bg-info text-white";
                                                                                                                                                                          } else {
                                                                                                                                                                            echo "text-black";
                                                                                                                                                                          } ?>">A to Z
          </a>
          <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&SORT_BY_METHOD=product_title&order=DESC" class="font-4 <?php if ($SORT_BY_METHOD == "product_title" and $ORDER_METHOD == "DESC") {
                                                                                                                                                                              echo "bg-info text-white";
                                                                                                                                                                            } else {
                                                                                                                                                                              echo "text-black";
                                                                                                                                                                            } ?>">Z to A
          </a>
          <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&SORT_BY_METHOD=product_offer_price&order=ASC" class="font-4 <?php if ($SORT_BY_METHOD == "product_offer_price" and $ORDER_METHOD == "ASC") {
                                                                                                                                                                                  echo "bg-info text-white";
                                                                                                                                                                                } else {
                                                                                                                                                                                  echo "text-black";
                                                                                                                                                                                } ?>">Price
            Low to High
          </a>
          <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&SORT_BY_METHOD=product_offer_price&order=DESC" class="font-4 <?php if ($SORT_BY_METHOD == "product_offer_price" and $ORDER_METHOD == "DESC") {
                                                                                                                                                                                    echo "bg-info text-white";
                                                                                                                                                                                  } else {
                                                                                                                                                                                    echo "text-black";
                                                                                                                                                                                  } ?>">Price
            High to Low
          </a>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 pl-0 pr-1 mb-2 mt-0 pt-0 text-center">
        <span>
          <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&LIST_VIEW=<?php echo $DEFAULT_LIST_VIEW; ?>" class="<?php if ($ITEM_VIEW_LIST == $DEFAULT_LIST_VIEW) {
                                                                                                                                                                          echo "bg-info";
                                                                                                                                                                        } else {
                                                                                                                                                                          echo "bg-secondary";
                                                                                                                                                                        } ?> text-white circle filter-btn"><?php echo $DEFAULT_LIST_VIEW; ?>
          </a>
          <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&LIST_VIEW=<?php echo $DEFAULT_LIST_VIEW * 2; ?>" class="<?php if ($ITEM_VIEW_LIST == $DEFAULT_LIST_VIEW * 2) {
                                                                                                                                                                              echo "bg-info";
                                                                                                                                                                            } else {
                                                                                                                                                                              echo "bg-secondary";
                                                                                                                                                                            } ?> text-white filter-btn circle"><?php echo $DEFAULT_LIST_VIEW * 2; ?>
          </a>
          <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&LIST_VIEW=<?php echo $DEFAULT_LIST_VIEW * 3; ?>" class="<?php if ($ITEM_VIEW_LIST == $DEFAULT_LIST_VIEW * 3) {
                                                                                                                                                                              echo "bg-info";
                                                                                                                                                                            } else {
                                                                                                                                                                              echo "bg-secondary";
                                                                                                                                                                            } ?> text-white filter-btn circle"><?php echo $DEFAULT_LIST_VIEW * 3; ?>
          </a>
          <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&LIST_VIEW=<?php echo $DEFAULT_LIST_VIEW * 4; ?>" class="<?php if ($ITEM_VIEW_LIST == $DEFAULT_LIST_VIEW * 4) {
                                                                                                                                                                              echo "bg-info";
                                                                                                                                                                            } else {
                                                                                                                                                                              echo "bg-secondary";
                                                                                                                                                                            } ?> text-white filter-btn circle"><?php echo $DEFAULT_LIST_VIEW * 4; ?>
          </a>

          <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&ITEM_VIEW_TYPE=LIST" class="<?php if ($ITEM_VIEW_TYPE == "LIST") {
                                                                                                                                                  echo "bg-info";
                                                                                                                                                } else {
                                                                                                                                                  echo "bg-secondary";
                                                                                                                                                } ?> text-white filter-btn circle"><i class="fa fa-list"></i></a>
          <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&ITEM_VIEW_TYPE=GRID" class="<?php if ($ITEM_VIEW_TYPE == "GRID") {
                                                                                                                                                  echo "bg-info";
                                                                                                                                                } else {
                                                                                                                                                  echo "bg-secondary";
                                                                                                                                                } ?> text-white filter-btn circle"><i class="fa fa-th"></i></a>
        </span>
      </div>
    </div>
  </div>

  <div class="container-fluid mt-1">
    <div class="row">
      <?php
      mysqli_set_charset($con, 'utf8');
      if (isset($_GET['cat_id'])) {
        $product_cat_id = $_GET['cat_id'];
        $product_sub_cat_id = $_GET['sub_cat_id'];

        if ($_GET['sub_cat_id'] == "") {
          mysqli_set_charset($con, 'utf8');
          $sql = "SELECT * FROM user_products, product_categories, pro_brands where user_products.product_cat_id=product_categories.product_cat_id and user_products.product_brand_id=pro_brands.brand_id and user_products.user_id='$user_id' and user_products.product_status='active' and user_products.product_cat_id='$product_cat_id' ORDER BY user_products.$SORT_BY_METHOD $ORDER_METHOD limit $start, $end";
        } else {
          mysqli_set_charset($con, 'utf8');
          $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='$user_id' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and product_sub_categories.sub_cat_id='$product_sub_cat_id' and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' ORDER BY user_products.$SORT_BY_METHOD $ORDER_METHOD limit $start, $end";
        }
      } else {
        header("location: index.php");
      }
      $query = mysqli_query($con, $sql);
      $count_products = mysqli_num_rows($query);
      if ($count_products == 0) { ?>

        <div class="col-sm-12 col-xs-12">
          <img src="img/noresult.gif" style='width:45%;border-radius: 50%;box-shadow: 0px 0px 0.5px grey;' class="d-block mx-auto">
          <br>
          <h5 class="text-center font-3">Coming Soon...</h5>
          <p class="text-center font-2">Items are Coming soon.We will inform as soon as we come with items.</p>
        </div>

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
            $SaveAmount = "<span class='st-price font-2'>Save <i class='fa fa-inr font-2'></i>$SaveAmount</span>";
          }

          $sql = "SELECT * FROM product_sub_categories where sub_cat_id='$sub_cat_id'";
          $Query = mysqli_query($con, $sql);
          $fetch = mysqli_fetch_assoc($Query);
          $sub_cat_title = $fetch['sub_cat_title'];
        ?>
          <?php include 'product_section.php'; ?>
      <?php }
      } ?>
    </div>
  </div>

  <?php GetMsg(); ?>
  <section class="container-fluid">
    <div class="row mt-3">
      <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xs-4 p-3 pl-1 pr-1">
        <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>" class="btn btn-lg btn-info font-5 text-white mt-2" style="border-radius: 50px !important;">Main
          Page</a>
      </div>
      <div class="col-8 col-xs-8 col-md-8 col-sm-8 col-lg-8">
        <?php
        if (isset($_GET['start'])) {
          $start = $_GET['start'];
          $end = $_GET['end'];
          if ($start == 0 or $end == 0) {
            $start = 0;
            $end = $ITEM_VIEW_LIST;
          } else {
            $start = $_GET['start'];
            $end = $_GET['end'];
          }
        } elseif ($start == 0 and $end == $ITEM_VIEW_LIST) {
          $start = 0;
          $end = 0;
        } else {
          if ($start == 0 or $end == 0) {
            $start = 0;
            $end = $ITEM_VIEW_LIST;
          } else {
            $start = 0;
            $end = $ITEM_VIEW_LIST;
          }
        } ?>
        <?php
        if ($_GET['sub_cat_id'] == "") {
          mysqli_set_charset($con, 'utf8');
          $sql = "SELECT * FROM user_products, product_categories, pro_brands where user_products.product_cat_id=product_categories.product_cat_id and user_products.product_brand_id=pro_brands.brand_id and user_products.user_id='$user_id' and user_products.product_status='active' and user_products.product_cat_id='$product_cat_id' ORDER BY user_products.$SORT_BY_METHOD $ORDER_METHOD";
        } else {
          mysqli_set_charset($con, 'utf8');
          $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='$user_id' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and product_sub_categories.sub_cat_id='$product_sub_cat_id' and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' ORDER BY user_products.$SORT_BY_METHOD $ORDER_METHOD";
        }
        $query = mysqli_query($con, $sql);
        $count_products = mysqli_num_rows($query);
        ?>

        <br> <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&start=<?php echo $start + $ITEM_VIEW_LIST; ?>&end=<?php
                                                                                                                                                                          if ($end >= $count_products) {
                                                                                                                                                                            echo "$count_products";
                                                                                                                                                                            $disabled = "disabled";
                                                                                                                                                                            $LastPageMsg = "<span class='text-danger'>You are at Last Page</span>";
                                                                                                                                                                          } else {
                                                                                                                                                                            echo $end + $DEFAULT_LIST_VIEW;
                                                                                                                                                                            $disabled = "";
                                                                                                                                                                            $LastPageMsg = "";
                                                                                                                                                                          } ?>" class="btn btn-lg btn-info text-white float-right m-2 mr-0 mt-0 font-5 <?php echo $disabled; ?>" style="border-radius: 50px !important;">Next <i class="fa fa-angle-right"></i>
        </a>

        <a href="products.php?cat_id=<?php echo $_GET['cat_id']; ?>&sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&start=<?php if ($start == 0) {
                                                                                                                          echo "0";
                                                                                                                          $disabled = "disabled";
                                                                                                                        } else {
                                                                                                                          echo $start - $ITEM_VIEW_LIST;
                                                                                                                          $disabled = "";
                                                                                                                        }; ?>&end=<?php if ($end == $ITEM_VIEW_LIST) {
                                                                                                                                    echo "$ITEM_VIEW_LIST";
                                                                                                                                  } else {
                                                                                                                                    echo $end - $ITEM_VIEW_LIST;
                                                                                                                                  }; ?>" class="btn btn-lg btn-info text-white float-right m-2 mt-0 font-5 <?php echo $disabled; ?>" style="border-radius: 50px !important;"><i class="fa fa-angle-left"></i>
          Previous</a>

        <br>

      </div>
      <div class="col-lg-12 col-12 col-sm-12 col-mn-12">
        <p class="font-5">
          <span>
            Page No: <?php if (isset($_GET['start']) and isset($_GET['end'])) {
                        $start = $_GET['start'];
                        $end = $_GET['end'];
                        $divide = round($end / $ITEM_VIEW_LIST);
                        echo $divide;
                      } else {
                        $start = 0;
                        $end = $ITEM_VIEW_LIST;
                        $divide = 1;
                        echo "0";
                      }
                      ?></span>
          <span class="float-right">
            Total Products : <?php
                              if ($_GET['sub_cat_id'] == "") {
                                mysqli_set_charset($con, 'utf8');
                                $sql = "SELECT * FROM user_products, product_categories, pro_brands where user_products.product_cat_id=product_categories.product_cat_id and user_products.product_brand_id=pro_brands.brand_id and user_products.user_id='$user_id' and user_products.product_status='active' and user_products.product_cat_id='$product_cat_id' ORDER BY user_products.sortby ASC";
                              } else {
                                mysqli_set_charset($con, 'utf8');
                                $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='$user_id' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and product_sub_categories.sub_cat_id='$product_sub_cat_id' and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' ORDER BY user_products.sortby ASC";
                              }
                              $query = mysqli_query($con, $sql);
                              $count_products = mysqli_num_rows($query);
                              echo $count_products; ?><br>
            <?php echo $LastPageMsg; ?>
          </span>
        </p>
      </div>
    </div>
  </section>
  <hr class="w-50 d-block mx-auto">
  <h6 class="text-center">That's All for Now</h6><br><br>

  <?php GSI_footer_files(); ?>

  </body>

</html>