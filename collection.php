<!--title start-->
<div class="title1 section-my-space" style="display: flex;
    justify-content: space-evenly;">
 <h4 class="p-1">Shop By Categories</h4>
</div>
<!-- title end -->

<!-- product start -->
<section class="product section-pb-space mb--5">
 <div class="custom-container">
  <div class="row">
   <div class="col pr-0">
    <div class="product-slide-6 no-arrow">
     <?php
          $sqlMOB = "SELECT * FROM product_categories where product_cat_status='active' ORDER BY sortby ASC";
          $query = mysqli_query($con, $sqlMOB);
          $countcat = mysqli_num_rows($query);
          while ($fetch =  mysqli_fetch_assoc($query)) {
            $product_cat_id = $fetch['product_cat_id'];
            $category_img = $fetch['category_img'];
            $product_cat_title = $fetch['product_cat_title'];
            $product_cat_add_date = $fetch['product_cat_add_date'];
            $product_cat_status = $fetch['product_cat_status'];
            $sql_products = "SELECT * from user_products where product_cat_id='$product_cat_id' and user_products.product_status='active'";
            $query_products = mysqli_query($con, $sql_products);
            $count = mysqli_num_rows($query_products); ?>

     <div>
      <div class="product-box"
       style="box-shadow: 0px 0px 2px #1c3481;border-bottom-style: groove;border-color: aliceblue;border-width: 8px;border-color: #b1c0f3;">
       <a href="products.php?cat_id=<?php echo $product_cat_id; ?>">
        <img loading="lazy" src="<?php echo $img_url; ?>/img/store_img/cat_img/<?php echo $category_img; ?>"
         alt="<?php echo $product_cat_title; ?>" title="<?php echo $product_cat_title; ?>" class="img-fluid p-4">
       </a>

       <div class="detail-title">
        <div class="detail-center" style="text-align:center;">
         <a href="products.php?cat_id=<?php echo $product_cat_id; ?>">
          <h2 class="text-uppercase text-grey" style="font-size: 1.2rem;color: #1c3481;">
           <?php echo $product_cat_title; ?></h2>
         </a>
        </div>
       </div>
      </div>
     </div>

     <?php } ?>
    </div>
   </div>
  </div>
 </div>
</section>
<!--product end-->

<!--collection banner end-->
<script>
var owl = $('.owl-carousel');
owl.owlCarousel({
 loop: true,
 margin: 10,
 autoplay: true,
 autoplayTimeout: 1000,
 autoplayHoverPause: true,
 responsive: {
  0: {
   items: 1
  },
  600: {
   items: 2
  },
  1000: {
   items: 4
  }
 }
});
$('.play').on('click', function() {
 owl.trigger('play.owl.autoplay', [1000])
})
$('.stop').on('click', function() {
 owl.trigger('stop.owl.autoplay')
})
</script>
