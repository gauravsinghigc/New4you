<section class="top-category section-padding">
    <div class="container-fluid">
      <div class="row">
                <?php
                        $sql = "SELECT * FROM product_categories where product_cat_status='active' and store_id='$store_id' ORDER BY sortby ASC";
                        
                        $query = mysqli_query($con, $sql);
                        while ($fetch =  mysqli_fetch_assoc($query)) {

                       $product_cat_id = $fetch['product_cat_id'];
                       $category_img = $fetch['category_img'];
                       $product_cat_title = $fetch['product_cat_title'];
                       $product_cat_add_date = $fetch['product_cat_add_date'];
                       $product_cat_status = $fetch['product_cat_status'];

                       $sql_products = "SELECT * from user_products where product_cat_id='$product_cat_id' and user_id='$user_id' and user_products.product_status='active'";
                       $query_products = mysqli_query($con, $sql_products);
                       $count = mysqli_num_rows($query_products); ?>
              <div class="col-lg-2 col-md-3 col-sm-4 col-6 col-xs-4 mb-2 p-3 cate-hover">
                        <a href="products.php?cat_id=<?php echo $product_cat_id;?>">
                            <img class="img-fluid"
                                src="<?php echo $img_url;?>/img/store_img/cat_img/<?php echo $category_img;?>"
                                alt="<?php echo $product_cat_title;?>" title="<?php echo $product_cat_title;?>">
                            <h6><?php echo $product_cat_title;?></h6>
                        </a>
              </div>
                <?php } ?>
        </div>
    </div>
</section>
