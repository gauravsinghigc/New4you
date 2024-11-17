<div class="product-box">
 <div class="product-imgbox">
  <div class="product-front">
   <a href="details.php?id=<?php echo $user_product_id_value; ?>">
    <img src="<?php echo $img_url; ?>/img/store_img/pro_img/<?php echo $product_img; ?>" alt="<?php echo $product_title; ?>" title="<?php echo $product_title; ?>" class="img-fluid">
   </a>
  </div>

  <div class="product-icon icon-inline">
   <?php if ($fetch['stockcount'] == 0 or $fetch['stockcount'] == "0") { ?>

   <?php } else { ?>
    <form action="insert.php" method="POST" class="pt-0 float-left width-auto">
     <input type="text" name="store_id" value="<?php echo $store_id; ?>" hidden>
     <input type="text" name="ip_address" value="<?php echo get_ip(); ?>" hidden>
     <input type="text" name="cr_url" value="<?php get_url(); ?>" hidden>
     <input type="text" name="product_HSN" value="<?php echo $product_HSN; ?>" hidden="">
     <input type="text" name="product_taxes" value="<?php echo $product_taxes; ?>" hidden="">
     <input type="text" name="product_net_price" value="<?php echo $product_net_price; ?>" hidden="">
     <input type="text" name="user_product_id_value" value="<?php echo $user_product_id_value_view; ?>" hidden>
     <input class="qty-adj form-control" name="quantity" type="number" value="1" hidden="" />
     <div class=" product-buttons">
      <button id="cartEffect" data-tippy-content="Add to cart" class="tooltip-top" type="submit" value="details.php" name="save_to_cart" class="btn btn-lg btn-info text-white" style="border-radius: 0px;
    padding: 0.6rem 1rem;margin-bottom: -0.9rem !important;">
       <i data-feather="shopping-cart" class="fa fa-shopping-cart"></i>
      </button>
     </div>
    </form>
   <?php } ?>
   <a href="details.php?id=<?php echo $user_product_id_value; ?>" class="tooltip-top" data-tippy-content="Quick View">
    <i data-feather="eye"></i>
   </a>
  </div>
  <div class="new-label1" <?php echo $hidden; ?>>
   <div><?php echo $off_actual; ?> % &nbsp;&nbsp; Discount</div>
  </div>
 </div>
 <div class="product-detail detail-inline">
  <div class="detail-title">
   <div class="detail-left">
    <div class="rating-star">
     <i class="fa fa-star"></i>
     <i class="fa fa-star"></i>
     <i class="fa fa-star"></i>
     <i class="fa fa-star"></i>
     <i class="fa fa-star"></i>
    </div>
    <a href="details.php?id=<?php echo $user_product_id_value; ?>">
     <p>
      <span class="text-uppercase text-black"><?php echo $brand_title; ?> &nbsp; <?php echo $sub_cat_title; ?></span><br>
      <span><?php echo $ProductModalNo; ?> &nbsp; <?php echo $ProductSizeCapacity; ?></span><br>
      <span><?php echo $ProductEdition; ?></span><br>
      <span>Warranty <?php echo $ProductWarrantyInYear; ?> &nbsp; <?php echo $ProductWarrantyInBreak; ?></span><br>
     </p>
    </a>
   </div>
   <style>
    .price .h4 {
     display: flex;
     margin-bottom: 0px;
    }

    .check-price {
     padding-top: 3%;
     margin-left: 6px;
    }
   </style>
   <div class="detail-right">
    <div class="price">
     <div class="price">
      Rs.<?php echo $product_offer_price; ?>
      <div class="check-price h3 text-black text-dark text-grey">
       Rs.<?php echo $product_mrp_price; ?>
      </div>
     </div>
     <span class="h6 float-right text-success">Save Rs.<?php echo $saveamount; ?> &nbsp; <span class="text-black"> Installtion <?php echo $ProductInstallation; ?></span></span>

    </div>
   </div>
   <?php if ($fetch['stockcount'] == 0 or $fetch['stockcount'] == "0") { ?>
    <span class="text-danger">Currently Not Available</span>
   <?php } else { ?>
    <span class="text-success"> In Stock</span>
   <?php } ?>
  </div>
 </div>
</div>