<?php
require 'files.php';
require 'session.php';
$title_name = "Customer Reviews";

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title><?php echo $title_name; ?> : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>
<style type="text/css">
  b {
    font-weight: 600 !important;
  }
</style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click"
 data-menu="vertical-menu-modern" data-col="2-columns">

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
        <h4 class="users-action"><i class="fa fa-table text-primary"></i> <?php echo $title_name; ?> <i
          class="fa fa-angle-right"></i>
        </h4>
       </div><br>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <style>
         table tr th,
         td {
          font-size: 12.5px !important;
         }
         </style>
         <div class="table-responsive">
          <table class="table table-striped zero-configuration" style="font-size: 12px !important;">
           <thead>
            <tr>
             <th>#</th>
             <th>ReviewId</th>
             <th>StarCounts</th>
             <th>ReviewTitle</th>
             <th>UserType</th>
             <th>ReviewerName</th>
             <th>ReviewerEmailId</th>
             <th>ProReviewCreatedOn</th>
             <th>Responses</th>
             <th>Status</th>
             <th>Action</th>
            </tr>
           </thead>
           <tbody>
            <?php
            $product_reviews = "SELECT * FROM product_reviews ORDER BY ProReviewId DESC";
            $product_reviews_query = mysqli_query($con, $product_reviews);
            $count = 0;
              while ($fetchreviws = mysqli_fetch_assoc($product_reviews_query)) {
            $count++; ?>
            <tr>
              <td><?php echo $count;?></td>
              <td>#REW<?php echo $fetchreviws['ProReviewId'];?></td>
              <td>
                <?php 
           $CountStar = $fetchreviws['ProReviewStarCount'];
           $RatingCounts = 0;
           while($RatingCounts < $CountStar){
            echo "<i class='fa fa-star text-warning mt-0'></i>";
            $RatingCounts++;
           } ?>
              </td>
              <td><a href="#" data-toggle="modal"
               data-target="#ViewModal<?php echo $fetchreviws['ProReviewId']; ?>"><?php echo $fetchreviws['ProReviewTitle'];?></a></td>
              <td>
                <?php if($fetchreviws['ProReviewUserType'] == "Unknown"){
                  echo "Unknown";
                } else {?>
                Registered
              <?php } ?>
              </td>
              <td>
                 <?php if($fetchreviws['ProReviewUserType'] == "Unknown"){
                  echo $fetchreviws['ProReviewName'];
                } else { ?>
                <a href="cust_details.php?customer_id=<?php echo $fetchreviws['ProReviewUserType'];?>">
                  <i class="fa fa-user"></i>
                  <?php $SQL_customers = "SELECT * FROM customers where customer_id='".$fetchreviws['ProReviewUserType']."'";
                  $QUERY_customers = mysqli_query($con, $SQL_customers);
                  $FETCH_customers = mysqli_fetch_assoc($QUERY_customers);
                  $CustomerName = $FETCH_customers['customer_name'];
                  echo $CustomerName;
                  ?>                
                  </a>
                <?php } ?>
              </td>
              <td><?php echo $fetchreviws['ProReviewEmail']; ?></td>
              <td><?php echo $fetchreviws['ProReviewCreatedOn']; ?></td>
              <td>
                <span><i class="fa fa-thumbs-up text-success"></i><?php 
              $SQL_product_reviews_count = "SELECT * FROM product_reviews_counts where ReviewsType='HELPFULL' and ProReviewId='".$fetchreviws['ProReviewId']."'";
              $QUERY_product_reviews_counts = mysqli_query($con, $SQL_product_reviews_count);
              $COUNT_product_reviews_counts_true = mysqli_num_rows($QUERY_product_reviews_counts);
              if($COUNT_product_reviews_counts_true == 0){
                echo "0";
              } else {
                echo $COUNT_product_reviews_counts_true;
              } ?></span> /
                <span><i class="fa fa-thumbs-down text-danger"></i><?php 
              $SQL_product_reviews_count = "SELECT * FROM product_reviews_counts where ReviewsType='REPORTED' and ProReviewId='".$fetchreviws['ProReviewId']."'";
              $QUERY_product_reviews_counts = mysqli_query($con, $SQL_product_reviews_count);
              $COUNT_product_reviews_counts_false = mysqli_num_rows($QUERY_product_reviews_counts);
              if($COUNT_product_reviews_counts_false == 0){
                echo "0";
              } else {
                echo $COUNT_product_reviews_counts_false;
              } ?></span>
              </td>
              <td><?php 
              $status = $fetchreviws['ProReviewStatus'];
              $ProReviewId = $fetchreviws['ProReviewId'];
              $ProReviewTitle = $fetchreviws['ProReviewTitle'];
              if($status == "NEW") {
                echo "<a href='update.php?update_reviews=$ProReviewId&status=HIDE&name=$ProReviewTitle'><i class='fa fa-eye btn btn-sm btn-black'></i></a>";
              } else {
                echo "<a href='update.php?update_reviews=$ProReviewId&status=NEW&name=$ProReviewTitle'><i class='fa fa-eye-slash btn btn-sm btn-danger'></i></a>";
              } ?></td>
             <td><a href="#" class="btn btn-sm btn-info" data-toggle="modal"
               data-target="#ViewModal<?php echo $fetchreviws['ProReviewId']; ?>"><i class="fa fa-list"></i></a>
             </td>
            </tr>
            <!-- Modal -->

            <div class="modal fade text-left" id="ViewModal<?php echo $fetchreviws['ProReviewId']; ?>" tabindex="-1"
             role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
             <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
               <div class="modal-header">
                <h4 class="modal-title font-medium-4" id="myModalLabel1"><i class="fa fa-history text-success"></i> <?php echo $title_name;?> <i class="fa fa-angle-right"></i> <?php echo $fetchreviws['ProReviewTitle']; ?> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
               </div>
               <div class="modal-body">
                <div class="row">
                  <?php
                  $SQL_user_products = "SELECT * FROM user_products where user_product_id='".$fetchreviws['ProductId']."'";
                  $QUERY_user_products = mysqli_query($con, $SQL_user_products);
                  $FETCH_user_products = mysqli_fetch_assoc($QUERY_user_products); ?>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12 p-1 pr-1">
                    <img src="<?php echo $img_url;?>/store_img/pro_img/<?php echo $FETCH_user_products['product_img'];?>" class="img-fluid" style="border-radius: 15px;">
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12 pl-1">
                    <h5 class="mb-0 font-medium-4 pl-0 ml-0">Product Details :</h5>
                    <hr class="mb-1 mt-0">
                    <p>
                      <b>Product Title :</b> <?php echo $FETCH_user_products['product_title'];?><br>
                      <b>Alternate Name :</b> <?php echo $FETCH_user_products['hindi_name'];?><br>
                      <b>Product Price:</b> <b>OFFER PRICE <i class="fa fa-angle-right"></i></b> Rs.<?php echo $FETCH_user_products['product_offer_price'];?>
                      | <b>MRP PRICE :</b> <?php echo $FETCH_user_products['product_mrp_price'];?><br>
                      <b>Item Measuring Unit :</b> <?php echo $FETCH_user_products['product_tags'];?><br>
                      <b>Item Referance :</b> <?php echo $FETCH_user_products['product_type'];?><br>
                      <b>In Stock :</b> <?php echo $FETCH_user_products['stockcount'];?><br>
                      <b>Status :</b> <?php echo $FETCH_user_products['product_status'];?>
                    </p>
                    <a href="edit_product.php?product_id=<?php echo $FETCH_user_products['user_product_id'];?>" class="btn btn-md btn-black">View Product Details <i class="fa fa-angle-right"></i></a>
                  </div>
                </div>
                <p class="mt-1">
                  <h4 class="font-medium-4">Review Details :<hr></h4>
                  <b>ProReviewCreatedOn :</b> <?php echo $fetchreviws['ProReviewCreatedOn'];?><br>
                  <b>ProReviewId :</b> #REW<?php echo $fetchreviws['ProReviewId'];?><br>
                  <b>ProductId :</b> <?php echo $fetchreviws['ProductId'];?><br>
                  <b>ProReviewStarCount :</b> <?php 
           $CountStar = $fetchreviws['ProReviewStarCount'];
           $RatingCounts = 0;
           while($RatingCounts < $CountStar){
            echo "<i class='fa fa-star text-warning mt-0'></i>";
            $RatingCounts++;
           } ?><br>
                <b>ProReviewTitle :</b> <?php echo $fetchreviws['ProReviewTitle'];?><br>
                <b>ProReviewName :</b> <?php echo $fetchreviws['ProReviewName'];?><br>
                <b>ProReviewEmail :</b> <?php echo $fetchreviws['ProReviewEmail'];?><br>
                <b>ProReviewDesc :</b> <?php echo $fetchreviws['ProReviewDesc'];?><br>
                <b>ProReviewUserType :</b> <?php echo $fetchreviws['ProReviewUserType'];?> 
                <?php 
                if($fetchreviws['ProReviewStatus'] == "Unknown"){
                  echo "(user is not registered!)";
                } else { ?>
                 <B>(Registered User)</B> <a href="cust_details.php?customer_id=<?php echo $fetchreviws['ProReviewUserType'];?>" class="btn btn-primary btn-sm">View Profile <i class="fa fa-angle-right"></i></a>
                <?php } ?><br>
                <b>ProReviewStatus :</b> <?php echo $fetchreviws['ProReviewStatus'];?>
                </p>
                <h5 class="font-medium-4">ProReviewDeviceDetails :<hr></h5><p><?php echo $fetchreviws['ProReviewDeviceDetails'];?></p>
                 <h5 class="font-medium-4">Responses On Reviews :<hr></h5>
                 <p>
                <b>Helpfull/Usefull/Like :</b> <span><i class="fa fa-thumbs-up text-success"></i><?php echo $COUNT_product_reviews_counts_true;?></span> Received<br>
                <b>Reported/Unusefull/Dislike :</b> <span class=""><i class="fa fa-thumbs-down text-danger"></i><?php echo $COUNT_product_reviews_counts_false;?></span> Received<br></p>
                  <h4 class="pl-0 pr-1 mb-0">
                    <a href="reviews_submitted.php" class="btn btn-primary btn-md w-50 d-block mx-auto">
                    <b>View All Like or Dislike submitted devices/customers 
                      <i class="fa fa-angle-right"></i>
                    </b>
                  </a>
                  </h4>
               </div>
               <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
               </div>
              </div>
             </div>
            </div>

            <?php } ?>
           </tbody>
          </table>
         </div>
         <!-- datatable ends -->
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