<?php
require 'files.php';
require 'session.php';
$title_name = "ALL Sub Categories";
$store_user_id = $_SESSION['user_id'];
$select_store = "SELECT * FROM stores where user_id='$store_user_id'";
$store_query = mysqli_query($con, $select_store);
$fetch_store = mysqli_fetch_assoc($store_query);
$store_id = $fetch_store['store_id'];
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
									<h4 class="users-action"><i class="fa fa-list text-primary"></i> <?php echo $title_name; ?> <i class="fa fa-angle-right"></i>
										<a href="add_sub_categories.php"><i class="fa fa-plus"></i> Add Sub
											Categories</a>
										<a href="categories.php"><i class="fa fa-eye"></i> View Categories</a>
										<a href="brands.php"><i class="fa fa-eye"></i> View Brands</a>
										<a href="stock.php"><i class="fa fa-eye"></i> View Stock</a>
									</h4>

								</div>
								<div class="card-content">
									<div class="card-body">
										<!-- datatable start -->
										<div class="table-responsive">
											<table class="table table-striped zero-configuration" style="font-size: 12px;">
												<thead>
													<tr>
														<th style="width: 2% !important;">#</th>
														<th style="width: 3% !important;">IMG</th>
														<th style="width: 3% !important;">Update Img</th>
														<th style="width: 22% !important;">Sub Category Title</th>
														<th style="width: 25% !important;">Categories</th>
														<th style="width: 5% !important;">Stock</th>
														<th style="width: 15% !important;">ADD Date</th>
														<th style="width: 10% !important;">Status</th>
														<th style="width: 5% !important;">SortBy</th>
														<th style="width: 10% !important;">Action</th>
													</tr>
												</thead>
												<tbody align="center">
													<?php if (isset($_GET['cat_id'])) {
                                                    $cat_id = $_GET['cat_id'];
                                                    $sql = "SELECT * from product_sub_categories, product_categories where product_sub_categories.product_cat_id=product_categories.product_cat_id and product_sub_categories.store_id='$store_id' and product_sub_categories.product_cat_id='$cat_id' ORDER BY sub_cat_title ASC";
                                                } else {
                                                    $sql = "SELECT * from product_sub_categories, product_categories where product_sub_categories.product_cat_id=product_categories.product_cat_id and product_sub_categories.store_id='$store_id' ORDER BY sub_cat_title ASC";
                                                }

                                                $query = mysqli_query($con, $sql);
                                                $count = mysqli_num_rows($query);
                                                if ($count == 0) {
                                                    echo "
   <tr>
      <td colspan='6' align='center'><h2>No Data Avaialable</h2></td>
   </tr>
  ";
                                                }
                                                $num = 0;
                                                while ($fetch = mysqli_fetch_assoc($query)) {
                                                    $sub_cat_id = $fetch['sub_cat_id'];
                                                    $sub_cat_title = $fetch['sub_cat_title'];
                                                    $product_cat_title = $fetch['product_cat_title'];
                                                    $sub_cat_add_date = $fetch['sub_cat_add_date'];
                                                    $sub_cat_status = $fetch['sub_cat_status'];
                                                    $product_cat_id = $fetch['product_cat_id'];
                                                    $sortby = $fetch['subcatsortby'];
																																																				$sub_cat_img = $fetch['sub_cat_img'];
																																																				$sub_cat_img_file = $fetch['sub_cat_img'];
																																																				if($sub_cat_img == null){
																																																					$sub_cat_img = "img/placeholder.png";
																																																				} else {
																																																					$sub_cat_img = $sub_cat_img;
																																																				}

                                                    $num++;

                                                    $Productsql = "SELECT * FROM user_products where product_sub_cat_id='$sub_cat_id'";
                                                    $Productquery = mysqli_query($con, $Productsql);
                                                    $CountProducts = mysqli_num_rows($Productquery);
                                                    if ($CountProducts == 0) {
                                                        $CountProducts = 0;
                                                        $btnsts = "";
                                                    } else {
                                                        $CountProducts = $CountProducts;
                                                        $btnsts = "disabled";
                                                    }

                                                    if ($sub_cat_status == "active") {
                                                        $status = '<input type="checkbox" id="switcherySize3" class="switchery" data-size="xs" checked/>';
                                                    } elseif ($sub_cat_status == "inactive") {
                                                        $status = '<input type="checkbox" id="switcherySize3" class="switchery" data-size="xs"/>';
                                                    }
                                                    echo "
 <tr>
    <form action='update.php' method='POST' enctype='multipart/form-data'>
				<input type='text' name='sub_cat_img' value='$sub_cat_img_file' hidden=''>
    <td>$num</td>
				<td><img src='$sub_cat_img' class='w-20 img-fluid round border'></td>
				<td><input type='FILE' name='sub_cat_img_file' value='' class='d-input font-small-1'></td>
    <td><input type='text' name='sub_cat_title' value='$sub_cat_title' class='form-control d-input'></td>
    <td>
    <select name='product_cat_id' class='form-control d-input'>
    <option value='$product_cat_id'>$product_cat_title</option>";
                                                    $FetchCategories = "SELECT * FROM product_categories where product_cat_id!='$product_cat_id' and product_cat_status='active' ORDER BY product_cat_title ASC";
                                                    $CategoriesQuery = mysqli_query($con, $FetchCategories);
                                                    while ($FetchCategories = mysqli_fetch_assoc($CategoriesQuery)) {
                                                        echo "<option value='" . $FetchCategories['product_cat_id'] . "'>" . $FetchCategories['product_cat_title'] . "</option>";
                                                    }
                                                    echo "
    </select></td>
    <td>$CountProducts</td>
    <td>$sub_cat_add_date</td>
    <td><a href='update.php?sub_cat_id=$sub_cat_id&value=$sub_cat_status&sub_cat_title=$sub_cat_title' alt='Click to Change Status'>$status</a></td>
    <td><input type='number' min='0' max='$count' class='form-control d-input' name='subcatsortby' value='$sortby'></input></td>
    <td><button type='submit' name='UpdateSubCategories' class='btn btn-sm btn-primary' value='$sub_cat_id'><i class='fa fa-edit'></i></button>
    <a href='delete.php?delete_sub_cat=$sub_cat_id' class='btn btn-sm btn-danger $btnsts'><i class='fa fa-trash'></i></a></td>
    </form>
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
