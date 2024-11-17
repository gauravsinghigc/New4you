<?php if ($stockcount == 0 or $stockcount == "0") { ?>
 <center class="p-2">
  <a href="details.php?id=<?php echo $user_product_id_value; ?>" class="btn btn-sm btn-primary text-white">View Details</a>
 </center>
<?php } else { ?>
 <form action="insert.php" method="POST" class="pt-0 float-left width-auto">
  <input type="text" name="store_id" value="<?php echo $store_id; ?>" hidden>
  <input type="text" name="ip_address" value="<?php echo get_ip(); ?>" hidden>
  <input type="text" name="cr_url" value="<?php get_url(); ?>" hidden>
  <input type="text" name="product_HSN" value="<?php echo $product_HSN; ?>" hidden="">
  <input type="text" name="product_taxes" value="<?php echo $products_taxes; ?>" hidden="">
  <input type="text" name="product_net_price" value="<?php echo $product_net_price; ?>" hidden="">
  <input type="text" name="user_product_id_value" value="<?php echo $user_product_id_value_view; ?>" hidden>
  <input class="qty-adj form-control" name="quantity" type="number" value="1" hidden="" />
  <center>
   <button type="submit" value="details.php" name="save_to_cart" class="btn btn-sm btn-info text-white">
    <i class="fa fa-shopping-cart"></i> Add
   </button>
   <a href="details.php?id=<?php echo $user_product_id_value; ?>" class="btn btn-sm btn-primary text-white">View</a>
  </center>
 </form>
<?php } ?>