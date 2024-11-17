<?php
require 'files.php';
require 'session.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM stores where user_id='$user_id'";
$query =  mysqli_query($con, $sql);
$fetchstore = mysqli_fetch_assoc($query);

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="<?php echo $PosName; ?>">
  <title><?php echo $fetchstore['store_name']; ?> : <?php echo $PosName; ?></title>
  <?php include 'header_files.php'; ?>

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
                <h4 class="users-action"><?php echo $fetchstore['store_name']; ?> <i class="fa fa-angle-right"></i>
                  Update Stock Price <i class="fa fa-angle-right"></i>
                </h4>
                <p><code>Note:</code> SortBy Rules</p>
                <ul>
                  <li>SortBy No 1, 2, 3, 4 are reserved for Highlighted and special items. These items are always at top
                    in the
                    list view in app.</li>
                  <li>SortBy number maximum limit will be 9.</li>
                  <li>You can choose same number for two item of different category or same. Different Category result
                    in
                    different sorting and same category result in suffle sorting.</li>
                  <li>You cannot sortby below 0 (zero).</li>
                  <li>Items shown in app are sort in Ascending order means items list in app from 1 to 9.</li>
                </ul>
                <hr>
                <form action="export_stock_sheet.php" class="mt-1" method="GET" target="blank">
                  <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <lebal>Export By Category</lebal>
                        <select name="product_cat_id" class="form-control">
                          <option value="ALL">ALL Categories</option>
                          <?php
													$Sql = "SELECT * FROM product_categories";
													$Query = mysqli_query($con, $Sql);
													while ($Fetch = mysqli_fetch_assoc($Query)) {
														$product_cat_id = $Fetch['product_cat_id'];
														$product_cat_title = $Fetch['product_cat_title'];
														echo "<option value='$product_cat_id'>$product_cat_title</option>";
													}
													?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <lebal>Export By Item Status</lebal>
                        <select name="pro_status" class="form-control">
                          <option value="">ALL</option>
                          <option value="active">Available</option>
                          <option value="inactive">Unavailable</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <br>
                        <button class="btn btn-primary btn-md form-control text-white" name="EXPORT_STOCK"><i
                            class="fa fa-file-pdf-o"></i> Export Stock Chart</button>
                      </div>
                    </div>

                  </div>
                </form>

              </div>
              <div class="card-content">
                <div class="card-body">
                  <!-- datatable start -->
                  <div class="table-responsive">
                    <table class="table table-striped dom-jQuery-events">
                      <thead>
                        <tr>
                          <th style="padding: 1%; font-size: 12px;">#</th>
                          <th style="padding: 1%; font-size: 12px;">Image</th>
                          <th style="padding: 1%; font-size: 12px;">Product Title</th>
                          <th style="padding: 1%; font-size: 12px;">Market Price (Rs.)</th>
                          <th style="padding: 1%; font-size: 12px;">Our Price (Rs)</th>
                          <th style="padding: 1%; font-size: 12px;">UNIT</th>
                          <th style="padding: 1%; font-size: 12px;">Approx. Weight</th>
                          <th style="padding: 1%; font-size: 12px;">Sort By</th>
                        </tr>
                      </thead>
                      <form action='update.php' method='POST'>
                        <tbody>
                          <?php
													if (isset($_GET['user_id'])) {
														$user_id = $_GET['user_id'];
													} else {
														$user_id = $_SESSION['user_id'];
													}
													mysqli_set_charset($con, 'utf8');
													$sql = "SELECT * from user_products, product_categories, product_sub_categories, pro_brands where user_products.product_cat_id=product_categories.product_cat_id and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_brand_id=pro_brands.brand_id and user_products.user_id='$user_id' ORDER BY product_status DESC";

													$query = mysqli_query($con, $sql);
													$count = mysqli_num_rows($query);
													if ($count == 0) {
														echo "
   <tr>
      <td colspan='11' align='center'><h2>No Data Avaialable</h2></td>
   </tr>
  ";
													}
													$num = 0;
													while ($fetch = mysqli_fetch_assoc($query)) {
														$user_product_id = $fetch['user_product_id'];
														$product_title = $fetch['product_title'];
														$product_cat_title = $fetch['product_cat_title'];
														$hindi_name = $fetch['hindi_name'];
														$sub_cat_title = $fetch['sub_cat_title'];
														$brand_title = $fetch['brand_title'];
														$product_img = $fetch['product_img'];
														$product_offer_price = $fetch['product_offer_price'];
														$product_mrp_price = $fetch['product_mrp_price'];
														$product_status = $fetch['product_status'];
														$product_tags = $fetch['product_tags'];
														$product_added_by = $fetch['product_added_by'];
														$stockcount = $fetch['stockcount'];
														$alertcount = $fetch['alertcount'];
														$product_type = $fetch['product_type'];
														$sortbyvalues = $fetch['sortby'];
														$approx_weight = $fetch['approx_weight'];

														if ($product_type == null) {
															$product_type = "NONE";
														} else {
															$product_type = $product_type;
														}

														if ($stockcount < $alertcount) {
															$stock_data = "<span class='text-danger'>$stockcount</span>";
															$alert_stck = "bg-danger text-white";
														} else {
															$stock_data = "<span class='text-success'>$stockcount</span>";
															$alert_stck = "";
														}
														$num++;

														if ($product_status == "active") {
															$status = "<i class='text-success fa fa-check-circle'> Active</i>";
															$back = "";
														} elseif ($product_status == "inactive") {
															$status = "<i class='text-warning fa fa-warning'> Inactive</i>";
															$back = "background-color: #fbcfcf70 !important;";
														}

														echo "
  <input type='text' name='USER_PRODUCT_ID[pro$user_product_id][]' value='$user_product_id' hidden=''>
   <tr style='$back'>
     <td style='font-size: 12px;' class='$alert_stck'>$num</td>
     <td style='font-size: 12px;'><img src='img/store_img/pro_img/$product_img' style='width:25px;'></td>
     <td style='font-size: 12px;'><a href='edit_product.php?product_id=$user_product_id'>$product_title - $hindi_name</a></td>
     <td style='font-size: 12px;'><input type='text' name='product_mrp_price[pro$user_product_id][]' value='$product_mrp_price' class='form-control d-input' style='padding: 3% 5%;
   width:100%;
        padding-bottom: 0.3%;
    padding-top: 0.3%;'></td>
     <td style='font-size: 12px;'><input type='text' name='product_offer_price[pro$user_product_id][]' value='$product_offer_price' class='form-control d-input' style='padding: 3% 5%;
         padding-bottom: 0.3%;
    padding-top: 0.3%;
   width:100%;
        padding-bottom: 0.3%;
    padding-top: 0.3%;'></td>
     <td style='font-size: 12px;'><input type='text' name='product_tags[pro$user_product_id][]' value='$product_tags' class='form-control d-input' style='padding: 3% 5%;
   width:100%;
        padding-bottom: 0.3%;
    padding-top: 0.3%;'></td>
     <td style='font-size: 12px;'><input type='text' name='approx_weight[pro$user_product_id][]' value='$approx_weight' class='form-control d-input' style='padding: 3% 5%;
   width:100%;
        padding-bottom: 0.3%;
    padding-top: 0.3%;'></td>
     <td style='font-size: 12px;'><input type='number' min='1' max='9' name='sortby[pro$user_product_id][]' value='$sortbyvalues' class='form-control d-input' style='padding: 5% 15%;
   width:100%;
        padding-bottom: 0.3%;
    padding-top: 0.3%;
'></td>
</tr>

  ";
													}
													?> <tr>
                            <td colspan="8" align="center">
                              <button type="submit" class="btn btn-primary btn-sm p-1" name="UPDATE_STOCK_PRICE">Update
                                Stock
                                Price</button>
                            </td>
                          </tr>
                        </tbody>
                      </form>
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
