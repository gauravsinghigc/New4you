<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
	<div class="main-menu-content">
		<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" style="font-weight:450;">
			<li>
				<a href="index.php">
					<span class="menu-title">Dashboard</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
			</li>

			<style type="text/css">
			body.vertical-layout.vertical-menu-modern.menu-expanded .main-menu .navigation li.has-sub>a:not(.mm-next):after {
				content: "\f105";
				font-family: 'FontAwesome';
				font-size: 1rem !important;
				display: inline-block;
				position: absolute;
				right: 20px;
				top: 4px;
				transform: rotate(0deg) !important;
				transition: -webkit-transform 0.2s ease-in-out !important;
			}

			.navigation .navigation-main ul li i.fa {
				width: 10px !important;
				text-align: center !important;
				margin-top: 1px !important;
			}

			</style>
			<li class="nav-item">
				<a href="#users.php">

					<span class="menu-title">Users</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="users.php">All Users</a></li>
					<li><a class="menu-item" href="user_types.php">User Types</a></li>
					<li><a class="menu-item" href="user_documents.php">User Documents</a></li>
					<li><a class="menu-item" href="document_types.php">Documents Types</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="#stores.php">

					<span class="menu-title">Stores</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="stores.php">All Stores</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="#stock.php">

					<span class="menu-title">Stock</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="stock.php">ALL Products</a></li>
					<li><a class="menu-item" href="categories.php">ALL Categories</a></li>
					<li><a class="menu-item" href="sub_categories.php">ALL Sub Categories</a></li>
					<li><a class="menu-item" href="brands.php">ALL Brands</a></li>
					<li><a class="menu-item" href="stock_price.php">Update Stock Price</a></li>
				</ul>
			</li>

			<li>
				<a href="#orders.php">

					<span class="menu-title">Orders </span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="orders.php">All Orders</a></li>
					<li><a class="menu-item" href="pickup_orders.php">Fresh Orders</a></li>
					<li><a class="menu-item" href="pickup_orders.php">Accepted Orders</a></li>
					<li><a class="menu-item" href="pickup_orders.php">Out for Delivery</a></li>
					<li><a class="menu-item" href="orders.php?type=UNDELIVERED">Undelivered Orders</a></li>
					<li><a class="menu-item" href="orders.php">Delivered Orders</a></li>
					<li><a class="menu-item" href="rejected_orders.php">Rejected Orders</a></li>
					<li><a class="menu-item" href="rejected_orders.php">Cancelled Orders</a></li>
				</ul>
			</li>

			<li>
				<a href="#purchased.php">

					<span class="menu-title">Stock Purchase</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="purchased.php">Purchased Stock</a></li>
					<li><a class="menu-item" href="items.php">Unpurchased Stocks</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="#payments.php">

					<span class="menu-title">Payments</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="payments.php?type=PAID">Paid Payments</a></li>
					<li><a class="menu-item" href="payments.php?type=Not Paid">Pending Payment</a></li>
					<li><a class="menu-item" href="payments.php">All Payments</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="#customers.php">

					<span class="menu-title">Customers</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="customers.php">ALL Customers</a></li>
					<li><a class="menu-item" href="customers.php?type=verified">Verified Customers</a></li>
					<li><a class="menu-item" href="customers.php?type=unverified">UnVerified Customers</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="#customers.php">

					<span class="menu-title">Customers Reviews</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="reviews.php">ALL Reviews</a></li>
					<li><a class="menu-item" href="reviews.php?type=verified">Helpful Reviews</a></li>
					<li><a class="menu-item" href="reviews.php?type=unverified">Reported Reviews</a></li>
					<li><a class="menu-item" href="reviews_submitted.php">Responses On Reviews</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="#customers.php">

					<span class="menu-title">Interested Customers</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="interest.php">ALL Interested Customers</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="#customers.php">

					<span class="menu-title">Reward Points</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="rewards.php">All Points</a></li>
					<li><a class="menu-item" href="rewards.php?type=active">Active Points</a></li>
					<li><a class="menu-item" href="rewards.php?type=Redeemed">Redeemed Points</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="#expenses.php">

					<span class="menu-title">Expanses & Purchases</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="purchases.php">All Type Purchases</a></li>
					<li><a class="menu-item" href="bills.php">All Types Bills</a></li>
					<li><a class="menu-item" href="expanses.php">All Types Expanses</a></li>
					<li><a class="menu-item" href="maintainances.php">Maintainances Expanses</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="#expenses.php">

					<span class="menu-title">Employees Records</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="purchases.php">All Employees</a></li>
					<li><a class="menu-item" href="bills.php">Employee Attandances</a></li>
					<li><a class="menu-item" href="maintainances.php">Salaries Records</a></li>
				</ul>
			</li>

			<li>
				<a href="#support.php">

					<span class="menu-title">Help, Support & Queries</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="support.php">Contact Queries</a></li>
					<li><a class="menu-item" href="support.php">Order Queries</a></li>
					<li><a class="menu-item" href="support.php">Support Queries</a></li>
				</ul>
			</li>

			<li>
				<a href="#support.php">

					<span class="menu-title">Notifications & Alerts</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="support.php">Notify Customers</a></li>
					<li><a class="menu-item" href="support.php">Notify Users</a></li>
					<li><a class="menu-item" href="support.php">Notify Stores</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="#loginlogs.php">

					<span class="menu-title">Activity & Login Logs</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>

				<ul class="menu-content">
					<li><a class="menu-item" href="notifications_logs.php">Customer Notifications</a></li>
					<li><a class="menu-item" href="loginlogs.php">User Login Logs</a></li>
					<li><a class="menu-item" href="loginlogs.php">Customer Login Logs</a></li>
					<li><a class="menu-item" href="visitors.php">Web & App Visitors</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="#expenses.php">

					<span class="menu-title">Exports All Reports</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="maintainances.php">ALL Reports</a></li>
					<li><a class="menu-item" href="purchases.php">User Reports</a></li>
					<li><a class="menu-item" href="bills.php">Order Reports</a></li>
					<li><a class="menu-item" href="maintainances.php">Payment Reports</a></li>
					<li><a class="menu-item" href="maintainances.php">Customer Reports</a></li>
					<li><a class="menu-item" href="maintainances.php">Stock Reports</a></li>
					<li><a class="menu-item" href="maintainances.php">Stock Price Charts</a></li>
					<li><a class="menu-item" href="maintainances.php">Expanse Reports</a></li>
					<li><a class="menu-item" href="maintainances.php">Customer Notification Reports</a></li>
					<li><a class="menu-item" href="maintainances.php">User Notification Reports</a></li>
					<li><a class="menu-item" href="maintainances.php">User LoginLogs Reports</a></li>
					<li><a class="menu-item" href="maintainances.php">Customer Loginlogs Reports</a></li>
					<li><a class="menu-item" href="maintainances.php">State, City & Service Area Reports</a></li>
					<li><a class="menu-item" href="maintainances.php">Contacts, Queries Reports</a></li>
					<li><a class="menu-item" href="maintainances.php">Store Reports</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="#customers.php">

					<span class="menu-title">Export Fresh Orders</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>

				<ul class="menu-content">
					<li><a class="menu-item" href="export_orders.php">Fresh Delivery Sheet</a></li>
					<li><a class="menu-item" href="items.php">Unpurchased Stock Sheet</a></li>
					<li><a class="menu-item" href="print_bills.php">Fresh Order Bills</a></li>
				</ul>
			</li>

			<li>
				<hr>
			</li>

			<li>
				<a href="profile.php">

					<span class="menu-title">Profile</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
			</li>

			<li class="nav-item">
				<a href="#store_edit.php">

					<span class="menu-title">Store Settings</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
				<ul class="menu-content">
					<li><a class="menu-item" href="store_edit.php">Store Profile</a></li>
					<li><a class="menu-item" href="areas.php">Service Areas</a></li>
					<li><a class="menu-item" href="cities.php">Service Cities</a></li>
					<li><a class="menu-item" href="states.php">Service States</a></li>
					<li><a class="menu-item" href="charges.php">Store Charges</a></li>
					<li><a class="menu-item" href="slider.php">Slider Settings</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="#store_edit.php">

					<span class="menu-title">Configurations</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>

				<ul class="menu-content">
					<li><a class="menu-item" href="web_tools.php">System Settings</a></li>
					<li><a class="menu-item" href="static_pages.php">Static Pages</a></li>
					<li><a class="menu-item" href="sharelinks.php">Sharing Links</a></li>
				</ul>
			</li>

			<li>
				<a href="logout.php">

					<span class="menu-title">Logout</span>
					<!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
				</a>
			</li>

			<?php
			$user_role = $_SESSION['user_role'];
			if ($user_role == "STORE_USER") { ?>
			<li>
				<?php
					$user_id = $_SESSION['user_id'];
					$sql = "SELECT * from stores where user_id='$user_id'";
					$query = mysqli_query($con, $sql);
					$fetch = mysqli_fetch_assoc($query);
					$alert_status = $fetch['alert_status'];
					if ($alert_status == "ON") {
						$sql = "SELECT * from stores where user_id='$user_id'";
						$query = mysqli_query($con, $sql);
						$fetch = mysqli_fetch_assoc($query);
						$store_id = $fetch['store_id'];
						$sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id and customer_orders.order_status='NEW_ORDER'";
						$query = mysqli_query($con, $sql);
						$count_orders = mysqli_num_rows($query);
						if ($count_orders == 0) { ?>

				<?php } else { ?>
				<audio controls autoplay hidden="">
					<source src="img/loud_alarm.mp3" type="audio/ogg">
					<source src="img/loud_alarm.ogg" type="audio/ogg">
				</audio>
				<?php } ?>
				<a href="update.php?alert_action=OFF&cr_url=<?php echo get_url(); ?>">

					<span class="menu-title"> Notification Alerts</span>
					<span class="badge badge badge-success badge-pill float-right text-white font-small-1">ON</span>
				</a>
				<?php } elseif ($alert_status == "OFF") { ?>
				<a href="update.php?alert_action=ON&cr_url=<?php echo get_url(); ?>">

					<span class="menu-title"> Notification Alerts</span>
					<span class="badge badge badge-danger badge-pill float-right text-white font-small-1">OFF</span>
				</a>
				<?php }
					?>

			</li>
			<?php } else {
			} ?>
			<br><br><br>

		</ul>
	</div>
</div>
<!-- END: Main Menu-->
