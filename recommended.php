<!--title start-->
<div class="title1 section-my-space" style="display: flex;
    justify-content: space-evenly;">
  <h4 class="p-1">Recommended</h4>
</div>
<!--title end-->

<!--product start-->
<section class="product section-pb-space mb--5">
  <div class="custom-container">
    <div class="row">
      <div class="col pr-0">
        <div class="product-slide-6 no-arrow">
          <?php
          $sql = "SELECT * FROM user_products, product_categories, product_sub_categories, pro_brands where user_products.product_cat_id=product_categories.product_cat_id and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_brand_id=pro_brands.brand_id and user_products.product_type='RECOMMENDED' ORDER BY user_product_id DESC limit 0, 15";
          $query = mysqli_query($con, $sql);

          while ($fetch = mysqli_fetch_assoc($query)) {
            require "fields.php";
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

      <div class="col-md-12 text-center">
        <a href="products.php?view=RECOMMENDED" class="btn btn-md btn-secondary text-white">View All Products <i class="fa fa-angle-right"></i></a>
      </div>
      <br>
    </div>
  </div>
</section>
<!--product end-->