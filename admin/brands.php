<?php
require 'files.php';
require 'session.php';
$title_name = "ALL Brands";

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
									<h4 class="users-action"><i class="fa fa-certificate text-warning"></i> <?php echo $title_name; ?> <i class="fa fa-angle-right"></i>
										<a href="add_brands.php"><i class="fa fa-plus"></i> Add Brands</a>
										<a href="sub_categories.php"><i class="fa fa-eye"></i> View Sub Categories</a>
										<a href="categories.php"><i class="fa fa-eye"></i> View Categories</a>
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
														<th style="width:5%;">#</th>
														<th style="width:3%;">Img</th>
														<th style="width:15%;">Update Img</th>
														<th style="width:37%;">Brand Title</th>
														<th style="width:5%">Stock</th>
														<th style="width:20%;">ADD Date</th>
														<th style="width:5%;">Status</th>
														<th style="width:10%;">Action</th>
													</tr>
												</thead>
												<tbody align="center">
													<?php
                                                $user_role = $_SESSION['user_role'];
                                                if ($user_role == "SUPER_ADMIN") {
                                                    $sql = "SELECT * from pro_brands ORDER BY brand_title ASC";
                                                } else {
                                                    $store_user_id = $_SESSION['user_id'];
                                                    $select_store = "SELECT * FROM stores where user_id='$store_user_id'";
                                                    $store_query = mysqli_query($con, $select_store);
                                                    $fetch_store = mysqli_fetch_assoc($store_query);
                                                    $store_id = $fetch_store['store_id'];
                                                    $sql = "SELECT * from pro_brands where store_id='$store_id' ORDER BY brand_title ASC";
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
                                                    $brand_id = $fetch['brand_id'];
                                                    $brand_title = $fetch['brand_title'];
                                                    $brand_add_date = $fetch['brand_add_date'];
                                                    $brand_status = $fetch['brand_status'];
                                                    $brand_img= $fetch['brand_img'];
                                                    
                                                    if($brand_img == null){
                                                        $brand_img = "img/placeholder.png";
                                                    } else {
                                                        $brand_img = $brand_img;
                                                    }
                                                    $num++;

                                                    if ($brand_status == "active") {
                                                        $status = '<input type="checkbox" id="switcherySize3" class="switchery" data-size="xs" checked/>';
                                                    } elseif ($brand_status == "inactive") {
                                                        $status = '<input type="checkbox" id="switcherySize3" class="switchery" data-size="xs"/>';
                                                    }

                                                    $Productsql = "SELECT * FROM user_products where product_brand_id='$brand_id'";
                                                    $Productquery = mysqli_query($con, $Productsql);
                                                    $CountProducts = mysqli_num_rows($Productquery);
                                                    if ($CountProducts == 0) {
                                                        $CountProducts = 0;
                                                        $btnsts = "";
                                                    } else {
                                                        $CountProducts = $CountProducts;
                                                        $btnsts = "disabled";
                                                    }

                                                    echo "
   <tr>
   <form action='update.php' method='POST' enctype='multipart/form-data'>
      <td>$num</td>
      <td><img src='$brand_img' class='w-20 img-fluid round border'></td>
      <td><input type='FILE' class='d-input font-small-1' name='brand_img_file' value=''></td>
      <td><input type='text' name='brand_title' value='$brand_title' required='' placeholder='Enter Brand Name' class='form-control d-input'></td>
      <td>$CountProducts</td>
      <td>$brand_add_date</td>
      <td><a href='update.php?brand_status_update=$brand_id&value=$brand_status&brand_title=$brand_title' class='text-info'>$status</a></td>
      <td><button type='submit' name='UpdateBrand' value='$brand_id' class='btn btn-sm btn-primary'><i class='fa fa-edit'></i></button>
      <a href='delete.php?delete_brand=$brand_id' class='btn btn-sm btn-danger $btnsts'><i class='fa fa-trash'></i></td>
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
