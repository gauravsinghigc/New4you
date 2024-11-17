<?php
$product_offer_price = preg_replace("/[^0-9\.]/", '', "$product_offer_price"); 
if($ITEM_VIEW_TYPE == "GRID") { ?>
<div class="col-4 pl-1 pr-1 p-2">
 <div class="bg-white p-1 border" style="border-radius:15px !important;box-shadow:0px 0px 1px lightgrey !important;">
  <?php if($SaveAmount != null) { ?> <span class="save-tag"><?php echo $SaveAmount; ?></span> <?php } ?>
  <a href="details.php?id=<?php echo $user_product_id; ?>">
   <img src="<?php echo $MUrl; ?>admin/img/store_img/pro_img/<?php echo $product_img; ?>" class='img-fluid bg-white d-block mx-auto'
    style="box-shadow: 0px 0px 1.5px grey;border-radius: 12px;padding: 1%;width:100% !important;">
   <p class="mt-1 ml-1" style="line-height: 13.5px !important;">
    <span><i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i
      class="fa fa-star-half text-warning"></i> (<?php
              $RatingCount = $product_offer_price * 0.5 + 7;
              echo $RatingCount;
              ?>)
    </span><br>
    <span class="font-3"><b><?php echo $product_title;?></b></span><br>
    <span class="font-3"><i class="fa fa-language text-success"></i> <?php echo $HindiName; ?></span><br>
    <span><i class="fa fa-check-circle text-success"></i> <?php echo $brand_title; ?></span><br>
    <span><?php echo $product_tags; ?></span>
    <span class="st-price font-4 float-right" style="clear:both;margin-top:-10% !important;"><strike>Rs.<?php echo $product_mrp_price; ?></strike></span><br>
    <span class="font-6 float-right"
     style="border-style: groove;border-width: thin; border-color: green;padding-left: 7px !important; padding-right: 7px !important;border-radius: 15px;background-color:green; color:white; padding:2.5%;margin-top:-9% !important;">
     Rs.<?php echo $product_offer_price; ?></span>

    </span>
   </p>
  </a>
 </div>
</div>

<?php }  else { ?>
<div class="container-fluid product-on-click">
 <div class="row mb-2">
  <div class="col-3 col-sm-3 col-xs-3 col-md-3 col-lg-3 p-2 pro-text-bg pl-3" style="border-top-left-radius:5px !important;border-bottom-left-radius:5px !important;">
   <a href="details.php?id=<?php echo $user_product_id; ?>">
    <?php if($SaveAmount != null) { ?> <span class="save-tag w-60 ml-1 font-1"><?php echo $SaveAmount; ?></span> <?php } ?>
    <img src="<?php echo $MUrl; ?>admin/img/store_img/pro_img/<?php echo $product_img; ?>" class='img-fluid bg-white pro-img' style="box-shadow: 0px 0px 1.5px grey;border-radius: 12px;padding: 1%;">
   </a>
  </div>
  <div class="col-9 col-sm-9 col-xs-9 col-md-9 col-lg-9 p-1 pr-3 pro-text-bg" style="border-top-right-radius:5px !important;border-bottom-right-radius:5px !important;">
   <a href="details.php?id=<?php echo $user_product_id; ?>">
    <div>
     <h5 class="mb-0 font-6" style="margin-top: 1.5% !important;"><?php echo $product_title; ?></h5>
     <p class="text-grey font-4 mr-1 mb-1" style="line-height: 13.5px !important;margin-top:1.5% !important; ">
      <span class="pro-price float-right mr-2" style="margin-right: 0px !important;margin-top: -12px;"><br>
      </span>
      <span><i class="fa fa-language text-success"></i> <?php echo $HindiName; ?></span><br>
      <span><i class="fa fa-check-circle text-success"></i> <?php echo $brand_title; ?></span><br>
      <span><?php echo $product_tags; ?></span>
      <?php if($ApproxWeight == null) { echo "";} else { echo "<i class='fa fa-angle-right'></i> $ApproxWeight"; } ?><br>
      <span><i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i
        class="fa fa-star-half text-warning"></i> (<?php
              $RatingCount = $product_offer_price * 0.5 + 7;
              echo $RatingCount;
              ?>)
      </span>
      <span><?php echo $OfferAmount; ?></span>
      <span class="float-right" style="margin-top: 0px !important;">
       <span class="st-price font-4"><strike>Rs.<?php echo $product_mrp_price; ?></strike></span>
       <span class="font-7"
        style="border-style: groove;border-width: thin; border-color: green;padding-left: 7px !important; padding-right: 7px !important;border-radius: 15px;background-color:green; color:white; padding:2.5%;">Rs.<?php echo $product_offer_price; ?></span>
      </span>
     </p>
    </div>
   </a>
  </div>
 </div>
 <script type="text/javascript">
 function SavedItem<?php echo $user_product_id; ?>() {
  document.getElementById("UserProduct<?php echo $user_product_id; ?>").innerHTML =
   "<i class='fa fa-refresh fa-spin'></i> Saving...";
 }
 </script>
</div>

<?php } ?>
