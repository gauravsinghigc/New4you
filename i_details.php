<p class="text-black" style="letter-spacing:0px !important;display:block;visibility:visible;">
 <span class="text-uppercase text-black h6"><?php echo $brand_title; ?> &nbsp; <?php echo $product_title; ?></span><br>
 <span class="bold h6"><b><?php echo $unique_feature; ?> &nbsp; <?php echo $ProductSizeCapacity; ?></b></span><br>
 <span class="h6"><?php echo $ProductModalNo; ?> &nbsp; <?php echo $ProductEdition; ?><br> </span>
 <span class="h6"><?php echo $product_warranty_in_diff_time; ?> &nbsp; <?php echo $product_warranty_in_break; ?></span><br>
 <?php
 $SavingPercentage = round($product_offer_price / $product_mrp_price * 100);
 $SavingPercentage = 100 - $SavingPercentage;
 if ($SavingPercentage == 0 or $SavingPercentage <= 0) {
  $SavingPercentage = "";
 } else {
  $SavingPercentage = $SavingPercentage . "% Off";
 }
 ?>
 <span class="h5 text-primary"><i class="fa fa-inr"></i> <span class="price_view"><?php echo number_format($product_offer_price); ?></span> &nbsp;
  <strike class='text-black h6'><i class="fa fa-inr"></i> <span class="price_view"><?php echo number_format($product_mrp_price); ?></span></strike> &nbsp;
  <span class="text-dark h6"><?php echo $SavingPercentage; ?></span></span>
 <?php if ($stockcount == 0 or $stockcount == "0") { ?>
  <br><span class="text-danger">Currently Not Available</span><br>
 <?php } else { ?>
  <br><span class="text-success"> In Stock</span><br>
 <?php } ?>
 <span class="text-center text-uppercase"><?php echo $product_offer_status; ?></span>
</p>