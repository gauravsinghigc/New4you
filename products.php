<?php require 'files.php'; ?>
<!DOCTYPE html>
<html>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <title>Products : <?php echo $APP_NAME; ?></title>
 <?php include 'header_files.php'; ?>
 <style>
 .price .price {
  margin-left: -47px !important;
  margin-top: 0.7rem !important;
 }

 .text-grey {
  color: grey !important;
  font-size: 0.9rem !important;
 }

 .product .product-box .product-imgbox {
  background-color: white !important;
 }

 </style>
</head>

<body>
 <?php include "header.php"; ?>

 <!-- section start -->
 <section class="ratio_asos b-g-light">
  <div class="collection-wrapper">
   <div class="custom-container">
    <div class="row">
     <div class="collection-content col">
      <div class="page-main-content">
       <div class="top-banner-wrapper">
        <?php
                $sql = "SELECT * FROM slider where slider_type='PRODUCTS' ORDER BY sortby ASC limit 0, 1";
                $query = mysqli_query($con, $sql);
                $CountSlides = 0;
                while ($fetch = mysqli_fetch_assoc($query)) {
                  $CountSlides++;
                  $slider_img = $fetch["slider_img"];
                  $target_url = $fetch["target_url"];
                  $slider_title = $fetch["slider_title"];
                  if ($target_url == "No Url Required") {
                    $target_url = "#";
                  } else {
                    $target_url = "href='$target_url'";
                  }
                  if ($CountSlides == 1) {
                    $showing = "showing";
                  } else {
                    $showing = "";
                  } ?>
        <a href="<?php echo $target_url; ?>"><img
          src="<?php echo $img_url; ?>/img/store_img/slider/<?php echo $slider_img; ?>"
          class="img-fluid blur-up w-100 lazyload" alt="<?php echo $slider_title; ?>"
          title="<?php echo $slider_title; ?>"></a>
        <?php } ?>
        <div class="top-banner-content small-section pb-0">
         <h3><?php
                      if (isset($_GET['cat_id'])) {
                        $cat_id = $_GET['cat_id'];
                        $sql = "SELECT * FROM product_categories where product_cat_id='$cat_id'";
                        $query = mysqli_query($con, $sql);
                        $fetch = mysqli_fetch_assoc($query);
                        $product_cat_title = $fetch['product_cat_title'];
                        echo $product_cat_title;
                      } elseif (isset($_GET['view'])) {
                        echo "All Products in " . $_GET['view'];
                      } else {
                        echo "All Products";
                      }
                      ?></h3>
         <h4 class="mt-2">
          <?php
                    if (isset($_GET['cat_id'])) {
                      $cat_id = $_GET['cat_id'];
                      $sql = "SELECT * FROM product_sub_categories where product_cat_id='$cat_id'";
                      $query = mysqli_query($con, $sql);
                      while ($fetch = mysqli_fetch_assoc($query)) {
                        $sub_cat_id = $fetch['sub_cat_id'];
                        $sub_cat_title = $fetch['sub_cat_title'];
                        echo "<a href='?sub_cat_id=$sub_cat_id' class='btn btn-sm btn-primary m-1 text-white'>$sub_cat_title</a>";
                      }
                    } elseif (isset($_GET['sub_cat_id'])) {
                      $sub_cat_id = $_GET['sub_cat_id'];
                      $sql = "SELECT * FROM product_sub_categories where sub_cat_id='$sub_cat_id'";
                      $query = mysqli_query($con, $sql);
                      $fetch = mysqli_fetch_assoc($query);
                      $cat_id = $fetch['product_cat_id'];
                      $sql = "SELECT * FROM product_sub_categories where product_cat_id='$cat_id'";
                      $query = mysqli_query($con, $sql);
                      while ($fetch = mysqli_fetch_assoc($query)) {
                        $sub_cat_id = $fetch['sub_cat_id'];
                        $sub_cat_title = $fetch['sub_cat_title'];
                        echo "<a href='?sub_cat_id=$sub_cat_id' class='btn btn-sm btn-primary m-1 text-white'>$sub_cat_title</a>";
                      }
                    } ?>
         </h4>
        </div>
       </div>
       <div class="collection-product-wrapper">
        <div class="product-wrapper-grid product">
         <div class="row">
          <?php
                    if (isset($_GET['cat_id'])) {
                      $cat_id = $_GET['cat_id'];
                      mysqli_set_charset($con, 'utf8');
                      $sql = "SELECT * from user_products, product_categories, pro_brands where user_products.product_cat_id=product_categories.product_cat_id and product_categories.product_cat_id='$cat_id' and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' ORDER BY user_products.user_product_id DESC";
                      $query = mysqli_query($con, $sql);
                    } elseif (isset($_GET['sub_cat_id'])) {
                      $sub_cat_id = $_GET['sub_cat_id'];
                      mysqli_set_charset($con, 'utf8');
                      $sql = "SELECT * from user_products, product_sub_categories, pro_brands, product_categories where user_products.product_cat_id=product_categories.product_cat_id and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and product_sub_categories.sub_cat_id='$sub_cat_id' and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' ORDER BY user_products.user_product_id DESC";
                      $query = mysqli_query($con, $sql);
                    } elseif (isset($_GET['search'])) {
                      $search = $_GET['search'];
                      mysqli_set_charset($con, 'utf8');
                      $sql = "SELECT * from user_products, product_sub_categories, pro_brands, product_categories where user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_cat_id=product_categories.product_cat_id and user_products.product_title like '%$search%' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' ORDER BY user_products.user_product_id DESC";
                      $query = mysqli_query($con, $sql);
                    } elseif (isset($_GET['view'])) {
                      mysqli_set_charset($con, 'utf8');
                      $item_view = $_GET['view'];
                      $sql = "SELECT * from user_products, product_sub_categories, pro_brands, product_categories where user_products.product_cat_id=product_categories.product_cat_id and user_products.product_status='active' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' and user_products.product_type like '%$item_view%' ORDER BY user_products.user_product_id DESC";
                      $query = mysqli_query($con, $sql);
                    } elseif (isset($_GET['brand_id'])) {
                      mysqli_set_charset($con, 'utf8');
                      $brand_view = $_GET['brand_id'];
                      $sql = "SELECT * from user_products, product_sub_categories, pro_brands, product_categories where user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_cat_id=product_categories.product_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' and pro_brands.brand_id='$brand_view' ORDER BY user_products.user_product_id DESC";
                      $query = mysqli_query($con, $sql);
                    } else {
                      $sql = "SELECT * from user_products, product_sub_categories, pro_brands, product_categories where user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_cat_id=product_categories.product_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' ORDER BY user_products.user_product_id DESC";
                      $query = mysqli_query($con, $sql);
                    }
                    $TotalItems = mysqli_num_rows($query);
                    $NetPages = round((int)$TotalItems / 20);
                    if (isset($_GET['start_page'])) {
                      $start_page = $_GET['start_page'];
                      $end_page = $_GET['end_page'];
                      $start_pagep = 0;
                      $end_pagep = 20;
                      $start_pagel = 20 + $_GET['start_page'];
                      $end_pagel = 40 + $_GET['start_page'];
                    } else {
                      $start_pagep = 0;
                      $end_pagep = 20;
                      $start_page = 0;
                      $end_page = 20;
                      $start_pagel = 20;
                      $end_pagel = 40;
                    }

                    if ($end_page >= $TotalItems) {
                      $disabledbtn = "style='display:none;'";
                      $disabledbtn2 = "";
                    } else {
                      $disabledbtn = "";
                      $disabledbtn2 = "style='display:none;'";
                    }
                    ?>
          <?php if (isset($_GET['start_page'])) { ?>
          <div class="col-md-12">
           <h5><b>Showing Products</b> <?php echo $start_page; ?> to <?php echo $end_page; ?> from
            <b><?php echo $TotalItems; ?> Items</b>
           </h5>
          </div>
          <?php  } ?>
          <?php
                    if (isset($_GET['cat_id'])) {
                      $cat_id = $_GET['cat_id'];
                      mysqli_set_charset($con, 'utf8');
                      $sql = "SELECT * from user_products, product_categories, pro_brands where user_products.product_cat_id=product_categories.product_cat_id and product_categories.product_cat_id='$cat_id' and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' ORDER BY user_products.user_product_id DESC limit $start_page, $end_page";
                      $query = mysqli_query($con, $sql);
                    } elseif (isset($_GET['sub_cat_id'])) {
                      $sub_cat_id = $_GET['sub_cat_id'];
                      mysqli_set_charset($con, 'utf8');
                      $sql = "SELECT * from user_products, product_sub_categories, pro_brands, product_categories where user_products.product_cat_id=product_categories.product_cat_id and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and product_sub_categories.sub_cat_id='$sub_cat_id' and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' ORDER BY user_products.user_product_id DESC limit $start_page, $end_page";
                      $query = mysqli_query($con, $sql);
                    } elseif (isset($_GET['search'])) {
                      $search = $_GET['search'];
                      mysqli_set_charset($con, 'utf8');
                      $sql = "SELECT * from user_products, product_sub_categories, pro_brands, product_categories where user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_cat_id=product_categories.product_cat_id and user_products.product_title like '%$search%' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' ORDER BY user_products.user_product_id DESC limit $start_page, $end_page";
                      $query = mysqli_query($con, $sql);
                    } elseif (isset($_GET['view'])) {
                      mysqli_set_charset($con, 'utf8');
                      $item_view = $_GET['view'];
                      $sql = "SELECT * from user_products, product_sub_categories, pro_brands, product_categories where user_products.product_cat_id=product_categories.product_cat_id and user_products.product_status='active' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' and user_products.product_type like '%$item_view%' ORDER BY user_products.user_product_id DESC limit $start_page, $end_page";
                      $query = mysqli_query($con, $sql);
                    } elseif (isset($_GET['brand_id'])) {
                      mysqli_set_charset($con, 'utf8');
                      $brand_view = $_GET['brand_id'];
                      $sql = "SELECT * from user_products, product_sub_categories, pro_brands, product_categories where user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_cat_id=product_categories.product_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' and pro_brands.brand_id='$brand_view' ORDER BY user_products.user_product_id DESC limit $start_page, $end_page";
                      $query = mysqli_query($con, $sql);
                    } else {
                      $sql = "SELECT * from user_products, product_sub_categories, pro_brands, product_categories where user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_cat_id=product_categories.product_cat_id and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' ORDER BY user_products.user_product_id DESC limit $start_page, $end_page";
                      $query = mysqli_query($con, $sql);
                    }
                    $count = mysqli_num_rows($query);
                    if ($count == 0) { ?>
          <div class="col-md-3 col-6 col-grid-box">
           <div class="product-box">
            <div class="product-imgbox">
             <div class="product-front">
              <a href="#"> <img src="img/no_products_found.png" class="img-fluid" alt="product"> </a>
             </div>
            </div>
            <div class="product-detail detail-center detail-inverse">
             <div class="detail-title">
              <div class="detail-left">
               <p>No Products are available in selected category!</p>
               <a href="#">
                <h6 class="price-title">
                 No Item Found!
                </h6>
               </a>
              </div>

             </div>

            </div>
           </div>
          </div>

          <?php }
                    while ($fetch = mysqli_fetch_assoc($query)) {
                      require "fields.php";
                    ?>
          <div class="col-md-3 col-6 col-grid-box">
           <div class="product-box" style="height:auto !important;">
            <div class="product-imgbox">
             <a href="details.php?id=<?php echo $user_product_id_value; ?>">
              <img loading="lazy" src="<?php echo $img_url; ?>/img/store_img/pro_img/<?php echo $product_img; ?>"
               alt="<?php echo $product_title; ?>" title="<?php echo $product_title; ?>" class="img-fluid">
             </a>
             <div class="new-label1" <?php echo $hidden; ?>>
              <div>Save Rs.<?php echo number_format($saveamount); ?> </div>
             </div>
             <div class="detail-title">
              <div class="detail-left p-1">
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

        <div class="row">
         <div class="col-md-12">
          <hr>
         </div>
         <div class="col-md-12 flex-space-evenly">

          <?php
                    $StartFirstPage = 0;
                    if ($start_page >= 0) {
                      $previous_disbaled = "disabled";
                      $next_disabled = "";
                    } elseif ($end_page >= $TotalItems) {
                      $previous_disbaled = "";
                      $next_disabled = "disabled";
                    } ?>
          <a <?php echo $previous_disbaled; ?>
           href="?start_page=<?php echo $start_pagep; ?>&end_page=<?php echo $end_pagep; ?>" class="m-t-13" disabled="">
           <h4 class="text-center text-color"><i class="fa fa-angle-double-left"></i> Previous Page</h4>
          </a>
          <div class="text-center">
           <?php
                      $pagingold = 0;
                      $pagingnew = 20;
                      while ($StartFirstPage <= $NetPages) {
                        $StartFirstPage++;
                        if ($StartFirstPage == 1) {
                          $pagingoldn = $pagingold;
                          $pagingnewn = $pagingnew;
                        } else {
                          $pagingnewn = $pagingnew * $StartFirstPage;
                          $pagingoldn = $pagingnewn - 20;
                        }

                        if ($end_page == $pagingnewn) {
                          $active = "btn-primary";
                        } else {
                          $active = "btn-success";
                        }
                      ?>
           <a href="?start_page=<?php echo $pagingoldn; ?>&end_page=<?php echo $pagingnewn; ?>">
            <h3 class="btn btn-sm <?php echo $active; ?> fs-16"><?php echo $StartFirstPage; ?></h3>
           </a>
           <?php }
                      ?>
           <br><br>
           <center class="mt-3">
            Viewing <b><?php echo $end_page / 20; ?></b> Page out of <b><?php if ($NetPages == 0) {
                                                                                      echo "1";
                                                                                    } else {
                                                                                      echo $NetPages;
                                                                                    } ?> pages</b>
           </center>
          </div>
          <a href="#" class="text-center text-color text-grey" <?php echo $disabledbtn2; ?>>
           <h4 class="text-center text-grey p-2">Last Page <i class="fa fa-angle-double-right"></i></h4>
          </a>
          <a <?php echo $next_disabled; ?> <?php echo $disabledbtn; ?>
           href="?start_page=<?php echo $start_pagel; ?>&end_page=<?php echo $end_pagel; ?>" class="m-t-13">
           <h4 class="text-center text-color">Next Page <i class="fa fa-angle-double-right"></i></h4>
          </a>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </section>
 <!-- section End -->

 <?php include 'footer.php'; ?>
</body>

</html>
