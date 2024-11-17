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
		<meta name="author" content="24kharido.in">
		<title>Dashboard : <?php echo $PosName;?></title>
		<?php include 'header_files.php';?>

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
						<?php notification();?>
					</div>

					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-lg-12 card-content px-1">
										<h4 id="textdg"><img src="img/wave_emoji.gif" style="width: 27px;margin-top: -5px !important;"> Hey, <b><?php echo $full_name;?></b>, <a href="checking.php"
												class="float-right"><span class="font-medium-2"><img src="img/hand.gif" style="width: 30px;margin-top: -17px !important;    margin-right: -9px;"> Check
													Orders</span></a></h4>
									</div>
								</div>
								<form action="cust_details.php" method="GET">
									<div class="row ml-0">
										<div class="col-md-10 col-lg-10">
											<div class="form-group mb-0">
												<label><i class="fa fa-search"></i> Search Customers </label>
												<input type="text" name="search" id="CustomerPhones" value="" placeholder="Enter Customer Phone number..." class="form-control">
											</div>
										</div>
										<div class="col-md-2 col-lg-2">
											<div class="form-group mb-0">
												<label>&nbsp;</label>
												<button type="submit" class="btn btn-md btn-success form-control text-white">Search</button>
											</div>
										</div>
									</div>
								</form>
								<script type="text/javascript">
								var countries = [<?php
                      $sql_sr = "SELECT * FROM customers";
                      $query_src = mysqli_query($con, $sql_sr);
                      while ($search = mysqli_fetch_assoc($query_src)) {
                        $phone_number = $search['customer_phone_number'];
                        $customer_name_view = $search['customer_name'];
                        $customer_Area = $search['arealocality'];
                        echo '"'.$phone_number.' - '.$customer_name_view.' - '.$customer_Area.'",';
                      }?>];
								</script>
								<div class="row mt-1 mb-2">
									<div class="col-lg-3 col-md-3 col-sm-3 col-6">
										<a href="new_order.php">
											<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
												<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
													<img src="img/create-order.gif" style="width: 50px;">
												</span>
												<div class="stats-amount mr-0">
													<h4 class="heading-text text-bold-600 ml-0 pl-0">
														Create Order
													</h4>
													<p class="font-small-2 text-success mb-0" style="text-decoration: underline lightgrey;">Create new Orders, Customers</p>
													<p class="mb-1">
														<span style="font-size: 9px !important;">Yesterday :
															<?php
                                                    $TodayDate = date("d M Y");
                                                    $YesterDay = date("d M Y", strtotime("-1 day"));

                                                    $SelectOrders = "SELECT * FROM customer_orders where order_date like '%$YesterDay%'";
                                                    $OrdersQuery = mysqli_query($con, $SelectOrders);
                                                    $CountYesterdayOrders = mysqli_num_rows($OrdersQuery);
                                                    if($CountYesterdayOrders == 0){
                                                        echo "<span class='text-danger' style='font-size: 10px !important;'><i class='fa fa-arrow-down text-danger'></i> $CountYesterdayOrders</span>";
                                                    } else {
                                                        echo "<span class='text-info' style='font-size: 10px !important;'><i class='fa fa-arrow-up text-primary'></i> $CountYesterdayOrders</span>";
                                                    }
                                                    ?>
														</span><br>
														<span style="font-size: 9px !important;">Today : <?php
                                                    $SelectOrders = "SELECT * FROM customer_orders where order_date like '%$TodayDate%'";
                                                    $OrdersQuery = mysqli_query($con, $SelectOrders);
                                                    $CountTodayOrders = mysqli_num_rows($OrdersQuery);
                                                    if($CountTodayOrders == 0){
                                                        echo "<span class='text-danger' style='font-size: 10px !important;'><i class='fa fa-arrow-down text-danger'></i> $CountTodayOrders</span>";
                                                    } else {
                                                        if($CountYesterdayOrders > $CountTodayOrders){
                                                          echo "<span class='text-info' style='font-size: 10px !important;'><i class='fa fa-arrow-down text-warning'></i> $CountTodayOrders</span>";
                                                        } else {
                                                          echo "<span class='text-info' style='font-size: 10px !important;'><i class='fa fa-arrow-up text-success'></i> $CountTodayOrders</span>";
                                                        }
                                                    }
                                                    ?></span>
													</p>
												</div>
											</div>
										</a>
									</div>

									<div class="col-lg-6 col-xl-3 col-sm-6 col-6">
										<a href="pickup_orders.php">
											<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
												<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
													<img src="img/running_orders.webp" style="width: 50px;">
												</span>
												<div class="stats-amount mr-0">
													<h4 class="heading-text text-bold-600">
														Running Orders
													</h4>
													<p class="font-small-2 text-success mb-0" style="text-decoration: underline lightgrey;">New, On delivery & running orders.</p>
													<p class="mb-1">
														<span style="font-size: 9px !important;">Yesterday :
															<?php
                                                    $TodayDate = date("d M Y");
                                                    $YesterDay = date("d M Y", strtotime("-1 day"));

                                                    $SelectOrders = "SELECT * FROM customer_orders where order_date like '%$YesterDay%' and order_status='DELIVERED'";
                                                    $OrdersQuery = mysqli_query($con, $SelectOrders);
                                                    $CountYesterdayOrders = mysqli_num_rows($OrdersQuery);
                                                    if($CountYesterdayOrders == 0){
                                                        echo "<span class='text-danger' style='font-size: 10px !important;'><i class='fa fa-arrow-down text-danger'></i> $CountYesterdayOrders</span>";
                                                    } else {
                                                        echo "<span class='text-info' style='font-size: 10px !important;'><i class='fa fa-arrow-up text-primary'></i> $CountYesterdayOrders</span>";
                                                    }
                                                    ?>
														</span><br>
														<span style="font-size: 9px !important;">Today : <?php
                                                    $SelectOrders = "SELECT * FROM customer_orders where order_date like '%$TodayDate%' and order_status='DELIVERED'";
                                                    $OrdersQuery = mysqli_query($con, $SelectOrders);
                                                    $CountTodayOrders = mysqli_num_rows($OrdersQuery);
                                                    if($CountTodayOrders == 0){
                                                        echo "<span class='text-danger' style='font-size: 10px !important;'><i class='fa fa-arrow-down text-danger'></i> $CountTodayOrders</span>";
                                                    } else {
                                                        if($CountYesterdayOrders > $CountTodayOrders){
                                                          echo "<span class='text-info' style='font-size: 10px !important;'><i class='fa fa-arrow-down text-warning'></i> $CountTodayOrders</span>";
                                                        } else {
                                                          echo "<span class='text-info' style='font-size: 10px !important;'><i class='fa fa-arrow-up text-success'></i> $CountTodayOrders</span>";
                                                        }
                                                    }
                                                    ?></span>
													</p>
												</div>
											</div>
										</a>
									</div>

									<div class="col-lg-6 col-xl-3 col-sm-6 col-6">
										<a href="stock.php">
											<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
												<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
													<img src="img/stock.gif" style="width: 50px;">
												</span>
												<div class="stats-amount mr-0">
													<h4 class="heading-text text-bold-600">
														All Stocks
													</h4>
													<p class="font-small-2 text-success mb-0" style="text-decoration: underline lightgrey;">Create, Update & Delete Stock</p>
													<p class="mb-1">
														<span style="font-size: 9px !important;">Active Stock :
															<?php
                                                    $TodayDate = date("d M Y");
                                                    $YesterDay = date("d M Y", strtotime("-1 day"));

                                                    $SelectStock = "SELECT * FROM user_products where product_status='active'";
                                                    $StockQuery = mysqli_query($con, $SelectStock);
                                                    $CountActiveStock = mysqli_num_rows($StockQuery);
                                                    if($CountActiveStock == 0){
                                                        echo "<span class='text-danger numbers' style='font-size: 10px !important;'> $CountActiveStock</span>";
                                                    } else {
                                                        echo "<span class='text-info numbers' style='font-size: 10px !important;'> $CountActiveStock</span>";
                                                    }
                                                    ?>
														</span><br>
														<span style="font-size: 9px !important;">Inactive Stock : <?php
                                                    $SelectStock = "SELECT * FROM user_products where product_status='inactive'";
                                                    $StockQuery = mysqli_query($con, $SelectStock);
                                                    $CountInactiveStock = mysqli_num_rows($StockQuery);
                                                    if($CountInactiveStock == 0){
                                                        echo "<span class='text-danger numbers' style='font-size: 10px !important;'> $CountInactiveStock</span>";
                                                    } else {
                                                          echo "<span class='text-info numbers' style='font-size: 10px !important;'> $CountInactiveStock</span>";
                                                    }
                                                    ?></span>
													</p>
												</div>
											</div>
										</a>
									</div>

									<div class="col-lg-6 col-xl-3 col-sm-6 col-6">
										<a href="reports.php">
											<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
												<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
													<img src="img/reports.gif" style="width: 50px;">
												</span>
												<div class="stats-amount mr-0">
													<h4 class="heading-text text-bold-600">
														All Reports
													</h4>
													<p class="font-small-2 text-success" style="text-decoration: underline lightgrey;">View & Export All Reports</p>
												</div>
											</div>
										</a>
									</div>

								</div>
							</div>
							<div class="col-12">
								<div class="content-body">
									<?php require 'store_admin_count.php';?>
									<!-- END: Content-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php require 'footer.php'; ?>

	</body>
	<!-- END: Body-->

</html>
