<?php
require 'files.php';
require 'session.php';
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Edit Slider : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
 <?php require 'header.php'; ?>
 <?php require 'sidebar.php'; ?>
 <!-- BEGIN: Content-->
 <div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
   <div class="content-header row">
    <div class="col-lg-12 card-content">
     <?php notification(); ?>
    </div>
   </div>

   <div class="content-body">
    <!-- users list start -->
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action">ADD Slide <i class="fa fa-angle-right"></i></h4>
        <hr>
        <div class="row">
         <div class="col-lg-6 col-sm-6 col-md-6 c0l-xs-12">
          <p><b>Slider Sizes</b></p>
          <ul>
           <li>MAIN Slider : 1024 x 450</li>
           <li>APP WELCOME PAGE Slider : 1024 x 500</li>
           <li>MIDDLE or BOTTOM Slider : 1024 x 350</li>
           <li>CART or ORDERS or RATIONS or RECOMMONDED or TODAY_DEALS Slider <br>: 1024 x 250</li>
           <li>PRODUCT Slider : 1024 x 300</li>
           <li>WALLET Slider : 1024 x 250</li>
           <li>NOTIFICATION Slider : 1024 x 250</li>
           <li>WEBSITE Slider : 1200 x 390</li>
           <li>TODAY_DEALS Slide : 1024 x 300</li>
           <li>CUSTOM ORDER Slider : 1160 x 300</li>
           <li>PROMOTION Slide : 1024 x 230</li>
          </ul>
         </div>
         <div class="col-lg-6 col-sm-6 col-md-6 c0l-xs-12">
          <p><b>Common Dimension for All Sliders</b></p>
          <ul>
           <li>Image Size should be lower than 200 KB.</li>
           <li>Open Url is Optional. if not required then leave empty</li>
           <li>For Clear view Image should be clean, clear and have easy text reading fonts style & color combinations.
           </li>
          </ul>
         </div>

        </div>
       </div>

       <div class="card-content">
        <div class="card-body">
         <form action="insert.php" method="POST" enctype="Multipart/form-data">
          <div class="row">
           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <div class="form-group">
             <label>Enter Slide Title</label>
             <input type="text" name="slider_title" value="" class="form-control" required="">
            </div>
           </div>
           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <div class="form-group">
             <label>Slide Type</label>
             <select name="slider_type" class="form-control" required="">
              <option value="WELCOME">APP WELCOME PAGE</option>
              <option value="MAIN">MAIN Slider</option>
              <option value="MIDDLE">MIDDLE Slider</option>
              <option value="BOTTOM">BOTTOM Slider</option>
              <option value="CART">CART PAGE</option>
              <option value="PRODUCTS">PRODUCTS PAGE</option>
              <option value="WALLET">WALLET PAGE</option>
              <option value="NOTIFICATION">NOTIFICATION PAGE</option>
              <option value="WEBSITE">WEBSITE SLIDER HOME</option>
              <option value="ORDERS">ORDERS PAGE</option>
              <option value="TODAY_DEALS">TODAY DEALS</option>
              <option value="PROMOTION">PROMOTION</option>
              <option value="RATIONS">RATION OFFERS</option>
              <option value="RECOMMONDED">RECOMMONDED ITEM</option>
              <option value="CUSTOM">CUSTOM ORDER PAGE</option>
             </select>
            </div>
           </div>
           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <div class="form-group">
             <label>Slide Image</label>
             <input type="FILE" name="slider_img" value="" class="form-control" required="">
            </div>
           </div>
           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <div class="form-group">
             <label>Sort Order</label>
             <?php SortBy(); ?>
            </div>
           </div>
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
             <label>Open Url
              <small><i class="fa fa-angle-right"></i> View Sample Urls or predefined Url</small>
             </label>
             <a href="urls.php" class="btn btn-sm btn-primary float-right" target="blank"><i class="fa fa-link"></i>
              View Urls</a>
             <input type="text" name="target_url" value="" class="form-control">
            </div>
           </div>

           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <button class="btn btn-md btn-success" type="submit" name="CREATE_SLIDER"> Create Slide</button>
           </div>
          </div>
         </form>

        </div>
       </div>
      </div>
     </div>
    </section>
    <!-- users list ends -->
   </div>
  </div>
 </div>
 <!-- END: Content-->

 <?php require 'footer.php'; ?>

</body>
<!-- END: Body-->

</html>