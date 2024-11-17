<?php require 'files.php'; require 'session.php'; ?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php'; GetMsg();?>
  <?php CreateSlider("PROMOTION");?><br>
  <section class="container-fluid">
   <div class="row">
    <div class="col-sm-12 col-12 bg-success p-1">
     <h4 class="font-7 text-white"><i class="fa fa-shopping-cart"></i> Shop By Categories</h4>
    </div>
   </div>
  </section>

  <div class="container-fluid">
   <div class="row">
    <?php 
$sql = "SELECT * from product_categories where product_categories.product_cat_status='active' ORDER BY sortby ASC";
          $query = mysqli_query($con, $sql);
          while ($fetch = mysqli_fetch_assoc($query)){
          $product_cat_id = $fetch['product_cat_id'];
          $category_img = $fetch['category_img'];
          $product_cat_title = $fetch['product_cat_title'];
      ?>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6" style="margin-top: 3%;">
     <a href="products.php?cat_id=<?php echo $product_cat_id;?>&sub_cat_id=">
      <img src="<?php echo $MUrl;?>/admin/img/store_img/cat_img/<?php echo $category_img;?>"
       style="width: 100%;box-shadow: 0px 0px 2px grey;margin-bottom: 2.5%; border-radius: 8px !important;padding: 1%;">
      <h6 style="font-size: 14px;margin-top: 0px"><?php echo $product_cat_title;?></h6>
     </a>
    </div>

    <?php } ?>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6" style="margin-top: 3%;">
     <a href="create_order.php">
      <img src="img/CustomOrder.png" style="width: 100%;box-shadow: 0px 0px 2px grey;margin-bottom: 2.5%;border-radius: 8px !important;padding: 1%;">
      <h6 style="font-size: 14px;margin-top: 0px">Create Custom Order</h6>
     </a>
    </div>
   </div>
  </div>
  <br>
  <?php CreateSlider("PROMOTION");?><br>
  <br><br><br><br>
  <?php GSI_footer_files();?>
 </body>

</html>
