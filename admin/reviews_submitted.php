<?php
require 'files.php';
require 'session.php';
$title_name = "Responses on Reviews";

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
        <h4 class="users-action"><i class="fa fa-thumbs-up text-primary"></i> <i
          class="fa fa-thumbs-down text-danger"></i> <?php echo $title_name; ?> <i class="fa fa-angle-right"></i>
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
             <th>Reviewid</th>
             <th>ResponseId</th>
             <th>StartCount</th>
             <th>ReviewTitle</th>
             <th>Response</th>
             <th>ReviewSubmittedOn</th>
             <th>Action</th>
            </tr>
           </thead>
           <tbody>
            <?php
                        $SQL_product_reviews_counts = "SELECT * FROM product_reviews_counts ORDER by ProReviewId DESC";
                        $QUERY_product_reviews_counts = mysqli_query($con, $SQL_product_reviews_counts);
                        $Count = 0;
                        while ($FETCH_product_reviews_counts = mysqli_fetch_assoc($QUERY_product_reviews_counts)) {
                          $Count++;
                          $ProReviewId = $FETCH_product_reviews_counts['ProReviewId'];
                          $SQL_product_reviews = "SELECT * FROM product_reviews where ProReviewId='$ProReviewId'";
                          $QUERY_product_reviews = mysqli_query($con, $SQL_product_reviews);
                          $FETCH_product_reviews = mysqli_fetch_assoc($QUERY_product_reviews); ?>
            <tr>
             <td><?php echo $Count; ?></td>
             <td>#REW<?php echo $ProReviewId; ?></td>
             <td>#RERE<?php echo $FETCH_product_reviews_counts['ReviewsCountsId']; ?></td>
             <td><?php
                                $CountStar = $FETCH_product_reviews['ProReviewStarCount'];
                                $RatingCounts = 0;
                                while ($RatingCounts < $CountStar) {
                                  echo "<i class='fa fa-star text-warning mt-0'></i>";
                                  $RatingCounts++;
                                } ?>
             </td>
             <td><?php echo $FETCH_product_reviews['ProReviewTitle']; ?></td>
             <td><?php echo $FETCH_product_reviews_counts['ReviewsType']; ?></td>
             <td><?php echo $FETCH_product_reviews_counts['ReviewSubmittedOn']; ?></td>
             <td>
              <a href="#" data-toggle="modal"
               data-target="#ViewModal<?php echo $FETCH_product_reviews_counts['ReviewsCountsId']; ?>"
               class="btn btn-sm btn-primary"><i class="fa fa-list"></i></a>
             </td>
            </tr>
            <!-- Modal -->



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