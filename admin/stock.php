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
								<h4 class="users-action"><i class="fa fa-table text-primary"></i> <?php echo $fetchstore['store_name']; ?> <i class="fa fa-angle-right"></i>
									ALL Products <i class="fa fa-angle-right"></i>
									<a href="add_stock.php"><i class="fa fa-plus"></i> ADD Products</a>
									<a href="categories.php"><i class="fa fa-eye"></i> View Categories</a>
									<a href="sub_categories.php"><i class="fa fa-eye"></i> View Sub Categories</a>
									<a href="brands.php"><i class="fa fa-eye"></i> View Brands</a>
									<a href="stock_price.php"><i class="fa fa-edit"></i> Update Stock Price</a>
								</h4>
							</div>
							<div class="card-content">
								<div class="card-body">
									<!-- datatable start -->
									<style>
										table tr th,
										td,
										a {
											font-size: 12px !important;
										}

										.text-grey {
											color: grey !important;
										}
									</style>
									<div class="table-responsive">
										<table class="table table-striped zero-configuration">
											<thead>
												<tr>
													<th style="width: 3%;">#</th>
													<th style="width: 3%;">Img</th>
													<th style="width: 54%;">Product Title</th>
													<th style="width: 9%">Type</th>
													<th style=" width: 10%;">Price (Inc. GST)</th>
													<th style="width: 6%;">UNIT</th>
													<th style="width: 4%;">Stock</th>
													<th style="width: 6%;">Status</th>
													<th style="width: 5%;">Action</th>
												</tr>
											</thead>
											<tbody>

												<?php
												if (isset($_GET['user_id'])) {
													$user_id = $_GET['user_id'];
												} else {
													$user_id = $_SESSION['user_id'];
												}
												mysqli_set_charset($con, 'utf8');
												$sql = "SELECT * from user_products, product_categories, product_sub_categories, pro_brands where user_products.product_cat_id=product_categories.product_cat_id and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_brand_id=pro_brands.brand_id ORDER by user_products.user_product_id DESC";

												$query = mysqli_query($con, $sql);
												$count = mysqli_num_rows($query);
												if ($count == 0) {
													echo "
   										<tr>
      								<td colspan='10' align='center'><h2>No Data Avaialable</h2></td>
   										</tr>
  											";
												}
												$num = 0;
												while ($fetch = mysqli_fetch_assoc($query)) {
													$user_product_id =	$fetch['user_product_id'];
													$product_cat_id = $fetch['product_cat_id'];
													$product_sub_cat_id = $fetch['product_sub_cat_id'];
													$product_brand_id = $fetch['product_brand_id'];
													$product_title = $fetch['product_title'];
													$ProductModalNo = $fetch['ProductModalNo'];
													$product_modal_for_seo = $fetch['product_modal_for_seo'];
													$ProductSizeCapacity = $fetch['ProductSizeCapacity'];
													$product_size_capacity_status = $fetch['product_size_capacity_status'];
													$unique_feature = $fetch['unique_feature'];
													$ProductEdition = $fetch['ProductEdition'];
													$product_edition_status = $fetch['product_edition_status'];
													$product_warranty_in_diff_time = $fetch['product_warranty_in_diff_time'];
													$product_warranty_in_break = $fetch['product_warranty_in_break'];
													$product_top_list_status = $fetch['product_top_list_status'];
													$product_measure_unit = $fetch['product_measure_unit'];
													$unit_type = $fetch['unit_type'];
													$product_offer_status = $fetch['product_offer_status'];
													$product_stock_in = $fetch['product_stock_in'];
													$product_stock_alert_on = $fetch['product_stock_alert_on'];
													$product_type = $fetch['product_type'];
													$product_offer_price = $fetch['product_offer_price'];
													$product_mrp_price = $fetch['product_mrp_price'];
													$product_save_amount = $fetch['product_save_amount'];
													$product_HSN = $fetch['product_HSN'];
													$products_taxes = $fetch['products_taxes'];
													$product_net_price = $fetch['product_net_price'];
													$product_return_policy_status = $fetch['product_return_policy_status'];
													$product_return_policy_charge_amount = $fetch['product_return_policy_charge_amount'];
													$product_return_time_in_days = $fetch['product_return_time_in_days'];
													$product_installation_charge_status = $fetch['product_installation_charge_status'];
													$product_installation_charge = $fetch['product_installation_charge'];
													$product_installation_charge_pincode_wise = $fetch['product_installation_charge_pincode_wise'];
													$product_delivery_charge_status = $fetch['product_delivery_charge_status'];
													$product_delivery_charge = $fetch['product_delivery_charge'];
													$product_delivery_charge_pincode_wise = $fetch['product_delivery_charge_pincode_wise'];
													$product_description = SECURE($fetch['product_description'], "e");
													$product_created_at = $fetch['product_created_at'];
													$product_updated_at = $fetch['product_updated_at'];
													$product_status = $fetch['product_status'];
													$product_sort_by_order = $fetch['product_sort_by_order'];
													$product_status = $fetch['product_status'];
													$product_image = $fetch['product_image'];
													$product_img = $product_image;
													$stockcount = $product_stock_in;
													$alertcount = $product_stock_alert_on;
													$hindi_name = $unique_feature;
													$product_tags = $product_measure_unit;
													$brand_title = $fetch['brand_title'];
													$product_sub_cat_title = $fetch['sub_cat_title'];

													if ($product_status == "active") {
														$status = "<i class='text-success fa fa-check-circle float-right'> Active</i>";
													} elseif ($product_status == "inactive") {
														$status = "<i class='text-warning fa fa-warning float-right'> Inactive</i>";
													}

													if ($product_net_price == null or $product_net_price == "") {
														$product_net_price = $product_offer_price;
													}

													if ($product_type == null) {
														$product_type = "NONE";
													} else {
														$product_type = $product_type;
													}

													if ($stockcount <= $alertcount) {
														$stock_data = "<span class='text-danger'>$stockcount</span>";
														$alert_stck = "bg-danger text-white";
													} else {
														$stock_data = "<span class='text-success'>$stockcount</span>";
														$alert_stck = "";
													}
													$num++;

													if ($product_status == "active") {
														$status = '<input type="checkbox" id="switcherySize3" class="switchery" data-size="xs" checked/>';
														$back = "";
														$btnst = "btn-info";
													} elseif ($product_status == "inactive") {
														$status = '<input type="checkbox" id="switcherySize3" class="switchery" data-size="xs"/>';
														$back = "background-color: #fbcfcf33 !important;";
														$btnst = "btn-danger";
													}

													echo "
   <tr style='$back'>
     <td class='$alert_stck'>$num</td>
     <td align='center'><center><a href='img/store_img/pro_img/$product_img' target='blank'><img src='img/store_img/pro_img/$product_img' class='w-30 img-fluid round border'></a></center></td>
     <td style='overflow:hidden !important;'><a href='edit_product.php?product_id=$user_product_id' class='text-primary'>$product_title </a><br><span class='text-grey'>
			<b>HSN :</b> $product_HSN |		<b>Info:</b> $hindi_name | <b>Brand :</b> $brand_title | <b>Listing :</b> $product_sub_cat_title</span></td>
     <td>$product_type</td>
     <td><b class='text-success'>Rs.$product_offer_price</br></td>
     <td>$product_tags</td>
     <td>$stock_data</td>
     <td><a href='update.php?product_status_update=$user_product_id&value=$product_status&product_title=$product_title'>$status</a></td>
     <td>
     <a href='edit_product.php?product_id=$user_product_id' class='btn btn-sm btn-info'><i class='fa fa-edit'></i></a>
     <a href='delete.php?delete_product=$user_product_id&file=$product_img' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></a>
     </td>
</tr>

  ";
												}
												?>
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