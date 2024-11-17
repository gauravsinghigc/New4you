<?php
require 'files.php';
?>
<!DOCTYPE html>
<html lang="en" data-lt-installed="true"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <?php require 'header_files.php';?>
      <title>
      <?php
            if(isset($_GET['cat_id'])){
               $cat_id = $_GET['cat_id'];
            $sql = "SELECT * FROM product_categories where product_cat_id='$cat_id' and product_cat_id!='12'";
            $query = mysqli_query($con, $sql);
            $fetch = mysqli_fetch_assoc($query);
            $product_cat_title = $fetch['product_cat_title'];
            echo $product_cat_title;
         } else {
            echo "All Products";
         }
            ?> : <?php echo $store_name;?>

      </title>
   </head>
   <body>

      <?php require 'header.php'; ?>


	  <section class="pt-1 pb-1 page-info section-padding border-bottom bg-white">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                   <a href="index.php"><strong><span class="fa fa-home"></span> Home</strong></a> <span class="fa fa-angle-right"></span>
                  <?php
            if(isset($_GET['cat_id'])){
               $cat_id = $_GET['cat_id'];
            $sql = "SELECT * FROM product_categories where product_cat_id='$cat_id'";
            $query = mysqli_query($con, $sql);
            $fetch = mysqli_fetch_assoc($query);
            $product_cat_title = $fetch['product_cat_title'];
            echo "<a href='products.php'> All Products</a></li>"." <i class='fa fa-angle-right'></i> <a href='products.php?cat_id=$cat_id'>$product_cat_title</a>";
         } elseif(isset($_GET['search'])) {
            $search = $_GET['search'];
            echo "<a href='products.php'>All Products</a></li> <i class='fa fa-angle-right'></i> <a href=''>Search Items: </a>"."<i class='fa fa-angle-right'></i> $search";
         } else {
            echo "<a href='products.php'>All Products</a></li>";
         }
            ?>
            <?php
            if (isset($_GET['sub_cat_id'])) {
               $sub_cat_id = $_GET['sub_cat_id'];
                $sub_cat_id = $_GET['sub_cat_id'];
               $sql = "SELECT * FROM product_sub_categories, product_categories where product_sub_categories.sub_cat_id='$sub_cat_id' and product_sub_categories.product_cat_id=product_categories.product_cat_id";
               $query = mysqli_query($con, $sql);
               $fetch = mysqli_fetch_assoc($query);
               $cat_id = $fetch['product_cat_id'];
               $product_cat_title = $fetch['product_cat_title'];
               $sql = "SELECT * FROM product_sub_categories, product_categories where product_categories.product_cat_id=product_sub_categories.product_cat_id and product_sub_categories.sub_cat_id='$sub_cat_id'";
               $query = mysqli_query($con, $sql);
               $fetch =  mysqli_fetch_assoc($query);
                  $sub_cat_title = $fetch['sub_cat_title'];
                  echo "
                 <i class='fa fa-angle-right'></i> <a href='products.php?cat_id=$cat_id'>$product_cat_title</a>
                  <i class='fa fa-angle-right'></i> <a href='products.php?sub_cat_id=$sub_cat_id'>$sub_cat_title</a>";
            }
            ?>
               </div>
            </div>
         </div>
      </section>

      <section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                   <ul class="inline-list">
                     <?php
                     if(isset($_GET['cat_id'])){
            $cat_id = $_GET['cat_id'];
            $sql = "SELECT * FROM product_sub_categories where product_cat_id='$cat_id'";
            $query = mysqli_query($con, $sql);
            while ($fetch = mysqli_fetch_assoc($query)){
              $sub_cat_id = $fetch['sub_cat_id'];
              $sub_cat_title = $fetch['sub_cat_title'];
              echo "<li class='m-1'><a href='products.php?sub_cat_id=$sub_cat_id'>$sub_cat_title</a></li>";
            }
                     } elseif(isset($_GET['sub_cat_id'])){
               $sub_cat_id = $_GET['sub_cat_id'];
               $sql = "SELECT * FROM product_sub_categories where sub_cat_id='$sub_cat_id'";
               $query = mysqli_query($con, $sql);
               $fetch = mysqli_fetch_assoc($query);
               $cat_id = $fetch['product_cat_id'];
               $sql = "SELECT * FROM product_sub_categories where product_cat_id='$cat_id'";
            $query = mysqli_query($con, $sql);
            while ($fetch = mysqli_fetch_assoc($query)){
              $sub_cat_id = $fetch['sub_cat_id'];
              $sub_cat_title = $fetch['sub_cat_title'];
              echo "<li class='m-1'><a href='products.php?sub_cat_id=$sub_cat_id'>$sub_cat_title</a></li>";
            }

              } ?>
                   </ul>
               </div>
            </div>
         </div>
      </section>

      <section class="shop-list section-padding">
         <div class="container-fluid ">
            <div class="row">
               <div class="col-md-12">
                  <div class="shop-head" style="background-color: #ffffffd6;
    padding: 0.5%;">
                     <h5 class="mb-3">
                     <?php
            if(isset($_GET['cat_id'])){
               $cat_id = $_GET['cat_id'];
            $sql = "SELECT * FROM product_categories where product_cat_id='$cat_id'";
            $query = mysqli_query($con, $sql);
            $fetch = mysqli_fetch_assoc($query);
            $product_cat_title = $fetch['product_cat_title'];
            echo $product_cat_title;
         } elseif(isset($_GET['search'])) {
            $search = $_GET['search'];
            echo "Search Results : $search    <a href='products.php' class='text-danger'><i class='fa fa-times'></i> Clear Search</a>";
         } else {
            echo "All Products";
         }
            ?>
                  </h5>
                  </div><br>
                  <div class="row no-gutters">

<?php
         if (isset($_GET['cat_id'])) {
            $cat_id = $_GET['cat_id'];
            mysqli_set_charset($con, 'utf8');
            $sql = "SELECT * from user_products, product_categories, pro_brands where user_id='$user_id' and user_products.product_cat_id=product_categories.product_cat_id and product_categories.product_cat_id='$cat_id' and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active'";
            $query = mysqli_query($con, $sql);
         } elseif(isset($_GET['sub_cat_id'])){ $sub_cat_id = $_GET['sub_cat_id'];
         mysqli_set_charset($con, 'utf8');
            $sql = "SELECT * from user_products, product_sub_categories, pro_brands where user_id='$user_id' and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and product_sub_categories.sub_cat_id='$sub_cat_id' and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active'";
            $query = mysqli_query($con, $sql);
         } elseif(isset($_GET['search'])) {  $search = $_GET['search']; 
         mysqli_set_charset($con, 'utf8');
         $sql = "SELECT * from user_products, pro_brands where user_products.product_title like '%$search%' and user_products.user_id='$user_id' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active'";
            $query = mysqli_query($con, $sql);
         } else {
         mysqli_set_charset($con, 'utf8');
          $sql = "SELECT * from user_products, pro_brands where user_id='$user_id' and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' and product_cat_id!='12'";
            $query = mysqli_query($con, $sql);
         }
         $count = mysqli_num_rows($query);
  if ($count == 0) {
  echo '
   <div class="col-md-12 top_brand_left">
      <center>
       <img src="img/blank.png" style="width:30%; margin-top:5%;">
         <h1>No Products</h1>
         <p>Current Category is empty no Products Found in it.</p>
      </center>
   </div>
  ';
 }
            while ($fetch = mysqli_fetch_assoc($query)) {
               $user_product_id_value = $fetch['user_product_id'];
               $product_title = $fetch['product_title'];
               $product_img= $fetch['product_img'];
               $product_offer_price = $fetch['product_offer_price'];
               $product_mrp_price = $fetch['product_mrp_price'];
               $product_tags = $fetch['product_tags'];
               $brand_title = $fetch['brand_title'];
               $hindi_name = $fetch['hindi_name'];
               ?>

                    <div class="col-lg-2 col-4">
                  <div class="product">
                     <a href="details.php?product_id=<?php echo $user_product_id_value;?>">
                        <div class="product-header">

                           <img class="img-fluid" src="<?php echo $img_url;?>/img/store_img/pro_img/<?php echo $product_img;?>" alt="<?php echo $product_title;?>" title="<?php echo $product_title;?>">
                        </div>
                        <div class="product-body">
                           <h5><?php echo $product_title;?> <?php echo $hindi_name;?></h5>
                           <h6><strong><span class="fa fa-check-circle text-success"></span> <?php echo $brand_title;?> </strong>
                            <span class="float-right"><?php echo $product_tags;?></span></h6>
                        </div>
                        <div class="product-footer">

                     <p class="offer-price">
                        <b class="price">Rs.<?php echo $product_offer_price;?></b>
                        <span class="regular-price">Rs.<?php echo $product_mrp_price;?></span></p>
                     <form action="insert.php" method="POST" class="mb-2 text-center">
                     <input type="text" name="quantity" value="1" hidden="">
                           <input type="text" name="store_id" value="<?php echo $store_id;?>" hidden>
                           <input type="text" name="ip_address" value="<?php echo get_ip();?>" hidden>
                           <input type="text" name="cr_url" value="<?php get_url();?>" hidden>
                           <input type="text" name="user_product_id_value" value="<?php echo $user_product_id_value;?>" hidden>
                           <?php 
              $CheckItemInCart = "SELECT * FROM customer_cart where device_info='$user_product_id_value' and ip_address='$ip_address'";
              $CartQuery = mysqli_query($con, $CheckItemInCart);
              $CountItemInCart = mysqli_num_rows($CartQuery);
              if($CountItemInCart == 0){
                $ButtonClass = "btn-outline-success";
                $ButtonText = "<i class='fa fa-shopping-cart'></i> Add to Cart";
              } else {
                $ButtonText = "<i class='fa fa-check-circle'></i> Saved";
                $ButtonClass = "btn-danger";
              } ?>
                          <button type="submit" name="save_to_cart"  class="btn btn-secondary text-white btn-sm <?php echo $ButtonClass;?>"><?php echo $ButtonText;?></button>
                         </form>
                        </div>
                     </a>
                  </div>
               </div>


  <?php }?>




               </div>
            </div>
         </div>
      </section>
      <section class="product-items-slider section-padding bg-white border-top">
         <div class="container-fluid">
            <div class="section-header">
             <?php if (isset($_GET['cat_id']) or isset($_GET['sub_cat_id'])) {
                if(isset($_GET['cat_id'])){
                  $cat_id = $_GET['cat_id'];
                } elseif(isset($_GET['sub_cat_id'])) {
                  $sub_cat_id = $_GET['sub_cat_id'];
                } ?>
                <h5 class="heading-design-h5">Best Selling Products in
                  <b><?php
                      if(isset($_GET['cat_id'])){
                       $cat_id = $_GET['cat_id'];
                       $sql = "SELECT * FROM product_categories where product_cat_id='$cat_id'";
                       $query = mysqli_query($con, $sql);
                       $fetch = mysqli_fetch_assoc($query);
                       $product_cat_title = $fetch['product_cat_title'];
                       echo $product_cat_title;
                     } elseif(isset($_GET['sub_cat_id'])){
                       $sub_cat_id = $_GET['sub_cat_id'];
                       $sql = "SELECT * FROM product_sub_categories where sub_cat_id='$sub_cat_id'";
                       $query = mysqli_query($con, $sql);
                       $fetch = mysqli_fetch_assoc($query);
                       $sub_cat_title = $fetch['sub_cat_title'];
                       echo $sub_cat_title;
                     } } else {

                     }
            ?></b>
               </h5>

            </div>
            <div class="owl-carousel owl-carousel-featured">
               <?php
               if (isset($_GET['cat_id'])) {
            $cat_id = $_GET['cat_id'];
            $sql = "SELECT * from user_products, product_categories, pro_brands where user_id='$user_id' and user_products.product_cat_id=product_categories.product_cat_id and product_categories.product_cat_id='$cat_id' and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active'";
           } elseif (isset($_GET['sub_cat_id'])) {
            $sub_cat_id = $_GET['sub_cat_id'];
            $sql = "SELECT * from user_products, product_categories, pro_brands, product_sub_categories where user_id='$user_id' and user_products.product_cat_id=product_categories.product_cat_id and product_sub_categories.sub_cat_id=user_products.product_sub_cat_id and user_products.product_sub_cat_id='$sub_cat_id' and user_products.product_status='active' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active'";
           } elseif (isset($_GET['search'])) {  $search = $_GET['search']; 
         mysqli_set_charset($con, 'utf8');
         $sql = "SELECT * from user_products, pro_brands where user_products.product_title like '%$search%' and user_products.user_id='$user_id' and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active'";
            $query = mysqli_query($con, $sql);
         }
             $query = mysqli_query($con, $sql);
             while ($fetch = mysqli_fetch_assoc($query)) {
               $user_product_id_value = $fetch['user_product_id'];
               $product_title = $fetch['product_title'];
               $product_img= $fetch['product_img'];
               $product_offer_price = $fetch['product_offer_price'];
               $product_mrp_price = $fetch['product_mrp_price'];
               $product_tags = $fetch['product_tags'];
               $brand_title = $fetch['brand_title'];
                ?>
               <div class="item">
                  <div class="product">
                     <a href="details.php?product_id=<?php echo $user_product_id_value;?>">
                        <div class="product-header">
                           <img class="img-fluid" src="<?php echo $img_url;?>/img/store_img/pro_img/<?php echo $product_img;?>" alt="<?php echo $product_title;?>" title="<?php echo $product_title;?>">
                        </div>
                        <div class="product-body">
                           <h5><?php echo $product_title;?></h5>
                           <h6><strong><span class="fa fa-check-circle text-success"></span> <?php echo $product_tags;?></strong></h6>
                        </div>
                        <div class="product-footer">

                     <p class="offer-price">
                        <b class="price">Rs.<?php echo $product_offer_price;?></b>
                        <span class="regular-price">Rs.<?php echo $product_mrp_price;?></span></p>
                     <form action="insert.php" method="POST" class="mb-2 text-center">
                     <input type="text" name="quantity" value="1" hidden="">
                           <input type="text" name="store_id" value="<?php echo $store_id;?>" hidden>
                           <input type="text" name="ip_address" value="<?php echo get_ip();?>" hidden>
                           <input type="text" name="cr_url" value="<?php get_url();?>" hidden>
                           <input type="text" name="user_product_id_value" value="<?php echo $user_product_id_value;?>" hidden>
                           <?php 
              $CheckItemInCart = "SELECT * FROM customer_cart where device_info='$user_product_id_value' and ip_address='$ip_address'";
              $CartQuery = mysqli_query($con, $CheckItemInCart);
              $CountItemInCart = mysqli_num_rows($CartQuery);
              if($CountItemInCart == 0){
                $ButtonClass = "btn-outline-success";
                $ButtonText = "<i class='fa fa-shopping-cart'></i> Add to Cart";
              } else {
                $ButtonText = "<i class='fa fa-check-circle'></i> Saved";
                $ButtonClass = "btn-danger";
              } ?>
                          <button type="submit" name="save_to_cart"  class="btn btn-secondary text-white btn-sm <?php echo $ButtonClass;?>">
                         <?php echo $ButtonText;?>
                         </button>
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
      <!-- Footer -->
      <?php require 'footer.php'; require 'login_section.php'; ?>
      <!-- End Footer -->


</body></html>
