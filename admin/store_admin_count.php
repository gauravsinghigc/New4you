<div class="row">
	<div class="col-xl-12 col-md-12 col-sm-12 mb-1 pl-0 pr-0">
		<div class="card">
			<div class="card-content">
				<div class="card-body">
					<h4 class="card-title"><i class="fa fa-users text-info"></i> <b>Website & App Visitors</b>
						<a href="visitors.php" class="btn btn-sm btn-info float-right">View All</a>
					</h4>
				</div>
				<div class="row">
					<div class="col-lg-6 col-xl-3 col-sm-12 col-12 pl-1 pr-1">
						<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
							<span class="card-icon primary d-flex justify-content-center mr-0" style="margin-right: 0px !important;">
								<i class="icon p-1 icon-screen-tablet customize-icon font-large-2 p-1"></i>
							</span>
							<div class="stats-amount mr-3">
								<h3 class="heading-text text-bold-600 numbers">
									<?php
                  $SelectVisitors = "SELECT sum(VisitingCounts) FROM visitors where VisitingSource='APP'";
                  $VisitorsQuery = mysqli_query($con, $SelectVisitors);
                  while ($CountAppVisitors = mysqli_fetch_array($VisitorsQuery)) {
                    $TotalAppVisitors = $CountAppVisitors['sum(VisitingCounts)'];
                  }
                  if ($TotalAppVisitors == 0 or $TotalAppVisitors == null) {
                    $TotalAppVisitors = 0;
                  } else {
                    $TotalAppVisitors = $TotalAppVisitors;
                  }
                  echo "$TotalAppVisitors";
                  ?>
								</h3>
								<p class="sub-heading">
									<b>New :</b> <span class="numbers">
										<?php
                    $SelectVisitors = "SELECT sum(VisitingCounts) FROM visitors where VisitingSource='APP' and VisitorType='NEW'";
                    $VisitorsQuery = mysqli_query($con, $SelectVisitors);
                    while ($CountAppVisitors = mysqli_fetch_array($VisitorsQuery)) {
                      $TotalAppVisitors = $CountAppVisitors['sum(VisitingCounts)'];
                    }
                    if ($TotalAppVisitors == 0 or $TotalAppVisitors == null) {
                      $TotalAppVisitorsNew = 0;
                    } else {
                      $TotalAppVisitorsNew = $TotalAppVisitors;
                    }
                    echo "$TotalAppVisitorsNew";
                    ?></span> <br> <b>Returning : </b> <span class="numbers">
										<?php
                    $SelectVisitors = "SELECT sum(VisitingCounts) FROM visitors where VisitingSource='APP' and VisitorType='RE-VISIT'";
                    $VisitorsQuery = mysqli_query($con, $SelectVisitors);
                    while ($CountAppVisitors = mysqli_fetch_array($VisitorsQuery)) {
                      $TotalAppVisitors = $CountAppVisitors['sum(VisitingCounts)'];
                    }
                    if ($TotalAppVisitors == 0 or $TotalAppVisitors == null) {
                      $TotalAppVisitorsOld = 0;
                    } else {
                      $TotalAppVisitorsOld = $TotalAppVisitors;
                    }
                    echo "$TotalAppVisitorsOld";
                    ?></span>
									<br>APP Visitors
								</p>
							</div>
							<span class="inc-dec-percentage">
								<?php
                $TotalAppVisits = $TotalAppVisitorsOld + $TotalAppVisitorsNew;
                if ($TotalAppVisits == 0 or $TotalAppVisitorsOld == 0) {
                  $TotalAppVisits = 1;
                }
                if ($TotalAppVisitorsNew > $TotalAppVisitorsOld) {
                  if ($TotalAppVisitorsNew == 0) {
                    $TotalAppVisitorsNew = 1;
                  }
                  $NewVisitsRations = $TotalAppVisitorsNew / $TotalAppVisits * 100; ?>
								<small class="success mr-1"><i class="fa fa-long-arrow-up"></i> <span class="numbers"><?php echo $NewVisitsRations; ?></span> %</small>
								<?php } else {
                  if ($TotalAppVisitorsOld == 0) {
                    $TotalAppVisitorsOld = 1;
                  }
                  $OldVisitsRations = $TotalAppVisitorsOld / $TotalAppVisits * 100; ?>
								<small class="danger mr-1"><i class="fa fa-long-arrow-down"></i> <span class="numbers"><?php echo $OldVisitsRations; ?></span> %</small>
								<?php } ?>
							</span>
						</div>
					</div>
					<div class="col-lg-6 col-xl-3 col-sm-12 col-12 pr-1 pl-1">
						<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
							<span class="card-icon primary d-flex justify-content-center mr-0" style="margin-right: 0px !important;">
								<i class="icon p-1 icon-globe customize-icon font-large-2 p-1"></i>
							</span>
							<div class="stats-amount mr-3">
								<h3 class="heading-text text-bold-600 numbers">
									<?php
                  $SelectVisitors = "SELECT sum(VisitingCounts) FROM visitors where VisitingSource='WEBSITE'";
                  $VisitorsQuery = mysqli_query($con, $SelectVisitors);
                  while ($CountWebsiteVisitors = mysqli_fetch_array($VisitorsQuery)) {
                    $TotalWebsiteVisitors = $CountWebsiteVisitors['sum(VisitingCounts)'];
                  }
                  if ($TotalWebsiteVisitors == 0 or $TotalWebsiteVisitors == null) {
                    $TotalWebsiteVisitorsNew = 0;
                  } else {
                    $TotalWebsiteVisitorsNew = $TotalWebsiteVisitors;
                  }
                  echo "$TotalWebsiteVisitors";
                  ?>
								</h3>
								<p class="sub-heading"><b>New :</b> <span class="numbers">
										<?php
                    $SelectVisitors = "SELECT sum(VisitingCounts) FROM visitors where VisitingSource='WEBSITE' and VisitorType='NEW'";
                    $VisitorsQuery = mysqli_query($con, $SelectVisitors);
                    while ($CountWebsiteVisitors = mysqli_fetch_array($VisitorsQuery)) {
                      $TotalWebsiteVisitors = $CountWebsiteVisitors['sum(VisitingCounts)'];
                    }
                    if ($TotalWebsiteVisitors == 0 or $TotalWebsiteVisitors == null) {
                      $TotalWebsiteVisitorsNew = 0;
                    } else {
                      $TotalWebsiteVisitorsNew = $TotalWebsiteVisitors;
                    }
                    echo "$TotalWebsiteVisitorsNew";
                    ?></span> <br> <b>Returning : </b> <span class="numbers">
										<?php
                    $SelectVisitors = "SELECT sum(VisitingCounts) FROM visitors where VisitingSource='WEBSITE' and VisitorType='RE-VISIT'";
                    $VisitorsQuery = mysqli_query($con, $SelectVisitors);
                    while ($CountWebsiteVisitors = mysqli_fetch_array($VisitorsQuery)) {
                      $TotalWebsiteVisitors = $CountWebsiteVisitors['sum(VisitingCounts)'];
                    }
                    if ($TotalWebsiteVisitors == 0 or $TotalWebsiteVisitors == null) {
                      $TotalWebsiteVisitorsOld = 0;
                    } else {
                      $TotalWebsiteVisitorsOld = $TotalWebsiteVisitors;
                    }
                    echo "$TotalWebsiteVisitorsOld";
                    ?></span>
									<br>Website Visitors
								</p>
							</div>
							<span class="inc-dec-percentage">
								<?php
                $TotalWebsiteVisits = $TotalWebsiteVisitorsNew + $TotalWebsiteVisitorsOld;
                if ($TotalWebsiteVisits == 0 or $TotalWebsiteVisitorsOld == 0) {
                  $TotalWebsiteVisits = 1;
                }
                if ($TotalWebsiteVisitorsNew > $TotalWebsiteVisitorsOld) {
                  if ($TotalWebsiteVisitorsNew == 0) {
                    $TotalWebsiteVisitorsNew = 1;
                  }
                  $NewWebsiteVisitsRations = $TotalWebsiteVisitorsNew / $TotalWebsiteVisits * 100; ?>
								<small class="success mr-1"><i class="fa fa-long-arrow-up"></i> <span class="numbers"><?php echo $NewWebsiteVisitsRations; ?></span> %</small>
								<?php } else {
                  if ($TotalWebsiteVisitorsOld == 0) {
                    $TotalWebsiteVisitorsOld = 1;
                  }
                  $OldWebsiteVisitsRations = $TotalWebsiteVisitorsOld / $TotalWebsiteVisits * 100; ?>
								<small class="danger mr-1"><i class="fa fa-long-arrow-down"></i> <span class="numbers"><?php echo $OldWebsiteVisitsRations; ?></span> %</small>
								<?php } ?>
							</span>
						</div>
					</div>
					<div class="col-lg-6 col-xl-3 col-sm-12 col-12">
						<div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
							<span class="card-icon success d-flex justify-content-center mr-0" style="margin-right: 0px !important;">
								<i class="icon p-1 icon-disc customize-icon font-large-2 p-1"></i>
							</span>
							<div class="stats-amount mr-3">
								<h3 class="heading-text text-bold-600 numbers">
									<?php
                  $SelectVisitors = "SELECT sum(VisitingCounts) FROM visitors";
                  $VisitorsQuery = mysqli_query($con, $SelectVisitors);
                  while ($CountAllVisitors = mysqli_fetch_array($VisitorsQuery)) {
                    $TotalAllVisitors = $CountAllVisitors['sum(VisitingCounts)'];
                  }
                  if ($TotalAllVisitors == 0 or $TotalAllVisitors == null) {
                    $TotalAllVisitors = 0;
                  } else {
                    $TotalAllVisitors = $TotalAllVisitors;
                  }
                  echo "$TotalAllVisitors";
                  ?></h3>
								<p class="sub-heading"><b>New :</b> <span class="numbers">
										<?php
                    $SelectVisitors = "SELECT sum(VisitingCounts) FROM visitors where VisitorType='NEW'";
                    $VisitorsQuery = mysqli_query($con, $SelectVisitors);
                    while ($CountNewVisitors = mysqli_fetch_array($VisitorsQuery)) {
                      $TotalNewVisitors = $CountNewVisitors['sum(VisitingCounts)'];
                    }
                    if ($TotalNewVisitors == 0 or $TotalNewVisitors == null) {
                      $TotalNewVisitors = 0;
                    } else {
                      $TotalNewVisitors = $TotalNewVisitors;
                    }
                    echo "$TotalNewVisitors";
                    ?></span> <br> <b>Returning : </b> <span class="numbers">
										<?php
                    $SelectVisitors = "SELECT sum(VisitingCounts) FROM visitors where VisitorType='RE-VISIT'";
                    $VisitorsQuery = mysqli_query($con, $SelectVisitors);
                    while ($CountOldVisitors = mysqli_fetch_array($VisitorsQuery)) {
                      $TotalOldVisitors = $CountOldVisitors['sum(VisitingCounts)'];
                    }
                    if ($TotalOldVisitors == 0 or $TotalOldVisitors == null) {
                      $TotalOldVisitors = 0;
                    } else {
                      $TotalOldVisitors = $TotalOldVisitors;
                    }
                    echo "$TotalOldVisitors";
                    ?></span>
									<br>Total Visitors
								</p>
							</div>
							<span class="inc-dec-percentage">
								<small class="success mr-1">
									<?php
                  $TotalALLVisits = $TotalNewVisitors + $TotalOldVisitors;
                  if ($TotalALLVisits == 0 or $TotalOldVisitors == 0) {
                    $TotalALLVisits = 1;
                  }
                  if ($TotalNewVisitors > $TotalOldVisitors) {
                    if ($TotalNewVisitors == 0) {
                      $TotalNewVisitors = 1;
                    }
                    $TotalNewVisitorsPer = $TotalNewVisitors / $TotalALLVisits * 100; ?>
									<small class="success mr-1"><i class="fa fa-long-arrow-up"></i> <span class="numbers"><?php echo $TotalNewVisitorsPer; ?></span> %</small>
									<?php } else {
                    if ($TotalOldVisitors == 0) {
                      $TotalOldVisitors = 1;
                    }
                    $TotalOldVisitorspER = $TotalOldVisitors / $TotalALLVisits * 100; ?>
									<small class="danger mr-1"><i class="fa fa-long-arrow-down"></i> <span class="numbers"><?php echo $TotalOldVisitorspER; ?></span> %</small>
									<?php } ?></small>
							</span>
						</div>
					</div>
					<div class="col-lg-6 col-xl-3 col-sm-12 col-12">
						<div class="d-flex align-items-start">
							<span class="card-icon warning d-flex justify-content-center mr-0" style="margin-right: 0px !important;">
								<i class="icon p-1 icon-directions customize-icon font-large-2 p-1"></i>
							</span>
							<div class="stats-amount mr-3">
								<h3 class="heading-text text-bold-600 numbers">
									<?php
                  $SelectVisitors = "SELECT sum(VisitingCounts) FROM visitors where DeviceType='COMPUTER' and VisitingSource='APP'";
                  $VisitorsQuery = mysqli_query($con, $SelectVisitors);
                  while ($CountWebAppVisitors = mysqli_fetch_array($VisitorsQuery)) {
                    $TotalWetoAppVisitors = $CountWebAppVisitors['sum(VisitingCounts)'];
                  }
                  if ($TotalWetoAppVisitors == 0 or $TotalWetoAppVisitors == null) {
                    $TotalWetoAppVisitors = 0;
                  } else {
                    $TotalWetoAppVisitors = $TotalWetoAppVisitors;
                  }

                  $SelectVisitors = "SELECT sum(VisitingCounts) FROM visitors where DeviceType='MOBILE' and VisitingSource='WEBSITE'";
                  $VisitorsQuery = mysqli_query($con, $SelectVisitors);
                  while ($CountWebAppVisitors = mysqli_fetch_array($VisitorsQuery)) {
                    $TotalApptoWebVisitors = $CountWebAppVisitors['sum(VisitingCounts)'];
                  }
                  if ($TotalApptoWebVisitors == 0 or $TotalApptoWebVisitors == null) {
                    $TotalApptoWebVisitors = 0;
                  } else {
                    $TotalApptoWebVisitors = $TotalApptoWebVisitors;
                  }
                  echo $TotalApptoWebVisitors + $TotalWetoAppVisitors;
                  ?></h3>
								<p class="sub-heading"><b>APP <i class="fa fa-angle-right"></i></b> <span class="numbers">
										<?php
                    $SelectVisitors = "SELECT sum(VisitingCounts) FROM visitors where DeviceType='COMPUTER' and VisitingSource='APP'";
                    $VisitorsQuery = mysqli_query($con, $SelectVisitors);
                    while ($CountWebAppVisitors = mysqli_fetch_array($VisitorsQuery)) {
                      $TotalWeAppVisitors = $CountWebAppVisitors['sum(VisitingCounts)'];
                    }
                    if ($TotalWeAppVisitors == 0 or $TotalWeAppVisitors == null) {
                      $TotalWeAppVisitors = 0;
                    } else {
                      $TotalWeAppVisitors = $TotalWeAppVisitors;
                    }
                    echo "$TotalWeAppVisitors";
                    ?></span>
									Website <br> <b>Website <i class="fa fa-angle-right"></i></b> <span class="numbers">
										<?php
                    $SelectVisitors = "SELECT sum(VisitingCounts) FROM visitors where DeviceType='MOBILE' and VisitingSource='WEBSITE'";
                    $VisitorsQuery = mysqli_query($con, $SelectVisitors);
                    while ($CountWebAppVisitors = mysqli_fetch_array($VisitorsQuery)) {
                      $TotalWeAppVisitors = $CountWebAppVisitors['sum(VisitingCounts)'];
                    }
                    if ($TotalWeAppVisitors == 0 or $TotalWeAppVisitors == null) {
                      $TotalWeAppVisitors = 0;
                    } else {
                      $TotalWeAppVisitors = $TotalWeAppVisitors;
                    }
                    echo "$TotalWeAppVisitors";
                    ?></span> App<br>
									WEB-APP Redirected Visitors</p>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-6 col-md-6 col-sm-12 mb-1 pl-0 pr-0">
		<div class="card p-1">
			<div class="card-content">
				<div class="card-body">
					<h4 class="card-title"><i class="fa fa-refresh fa-spin text-danger"></i> <b>Running Orders...</b></h4>
					<p class="card-text">Latest running Orders that not delivered or not reached to their final destination.</p>
				</div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>OrderId</th>
							<th>Order Amount</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
            $CheckOrder = "SELECT * FROM customer_orders where order_status!='DELIVERED' and order_status!='CANCELLED' and order_status!='REJECTED' order by customer_order_id DESC  limit 0, 10";
            $OrderQuery = mysqli_query($con, $CheckOrder);
            while ($FetchOrders = mysqli_fetch_assoc($OrderQuery)) {
              $customerID = $FetchOrders['customer_id'];
              $CheckCustomer = "SELECT * FROM customers where customer_id='$customerID'";
              $CustomerQuery = mysqli_query($con, $CheckCustomer);
              $FetchCustomer = mysqli_fetch_assoc($CustomerQuery); ?>
						<tr>
							<td><a href='pickup_deliver.php?id=<?php echo $FetchOrders['order_id']; ?>'><?php echo $FetchOrders['order_id']; ?></a>
							</td>
							<td>Rs.<?php echo $FetchOrders['net_payable_amount']; ?></td>
							<td>
								<?php if ($FetchOrders['order_status'] == "NEW_ORDER") { ?>
								<a href="update.php?accept_id=<?php echo $FetchOrders['order_id']; ?>&store_id=<?php echo $store_id; ?>&cr_url=<?php echo get_url(); ?>"
									class='btn btn-info btn-sm float-left'>
									Accept
								</a>
								<a href="update.php?reject_id=<?php echo $FetchOrders['order_id']; ?>&store_id=<?php echo $store_id; ?>&sms=&s_p=&s_m=&cr_url=<?php echo get_url(); ?>"
									class='btn btn-warning btn-sm float-right'>
									Reject
								</a>
								<?php } elseif ($FetchOrders['order_status'] == "ACCEPTED") { ?>
								<a href="update.php?delivery_out=<?php echo $FetchOrders['order_id']; ?>&store_id=<?php echo $store_id; ?>&sms=" class='btn btn-primary btn-sm'>
									Out For Delivery
								</a>
								<?php } elseif ($FetchOrders['order_status'] == "OUT_FOR_DELIVERY") { ?>
								<a href="pickup_deliver.php?id=<?php echo $FetchOrders['order_id']; ?>" class='btn btn-warning btn-sm'>
									Delivered?
								</a>
								<?php } elseif ($FetchOrders['order_status'] == "REJECTED") { ?>
								<span class="text-danger">Rejected</span>
								<a href="update.php?accept_id=<?php echo $FetchOrders['order_id']; ?>&store_id=<?php echo $store_id; ?>" class='btn btn-info btn-sm float-right'>
									Re-Accept
								</a>
								<?php } ?>
							</td>
							<td><a href='pickup_deliver.php?id=<?php echo $FetchOrders['order_id']; ?>' class='btn btn-sm btn-info'>View
									Details</a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col-xl-6 col-md-6 col-sm-12 mb-1">
		<div class="card p-1">
			<div class="card-content">
				<div class="card-body">
					<h4 class="card-title"><i class="fa fa-truck text-success"></i> <b>Latest Delivered Orders</b></h4>
					<p class="card-text">Latest deliverd orders sort by ordered amount in desc order.</p>
				</div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>OrderId</th>
							<th>Customer Name</th>
							<th>Order Amount</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
            $CheckOrder = "SELECT * FROM customer_orders where order_status='DELIVERED'";
            $OrderQuery = mysqli_query($con, $CheckOrder);
            while ($FetchOrders = mysqli_fetch_assoc($OrderQuery)) {
              $customerID = $FetchOrders['customer_id'];
              $CheckCustomer = "SELECT * FROM customers where customer_id='$customerID'";
              $CustomerQuery = mysqli_query($con, $CheckCustomer);
              $FetchCustomer = mysqli_fetch_assoc($CustomerQuery); ?>
						<tr>
							<td><a href='<?php echo $MDomain; ?>/invoice.php?id=<?php echo $FetchOrders['order_id']; ?>' target="blank"><?php echo $FetchOrders['order_id']; ?></a></td>
							<td><a href="cust_details.php?customer_id=<?php echo $FetchCustomer['customer_id']; ?>"><?php echo $FetchCustomer['customer_name']; ?></a>
							</td>
							<td>Rs.<?php echo $FetchOrders['net_payable_amount']; ?></td>
							<td><?php echo $FetchOrders['order_status']; ?></td>
							<td><a href='<?php echo $MDomain; ?>/invoice.php?id=<?php echo $FetchOrders['order_id']; ?>' target="blank" class='btn btn-sm btn-info'>View Invoice</a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>

<style type="text/css">
.autocomplete-items {
	position: absolute;
	border-bottom: none;
	border-top: 1px solid #d4d4d4;
	z-index: 99;
	/*position the autocomplete items to be the same width as the container:*/
	top: 100%;
	left: 0;
	right: 0;
	background-color: white !important;
	margin-left: 1.5%;
	border-radius: 25px;
	margin-right: 1% !important;
}

</style>
<!-- Grouped multiple cards for statistics starts here -->
<div class="row grouped-multiple-statistics-card">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row mt-0">

					<div class="col-lg-6 col-xl-3 col-sm-6 col-6 mt-1 mb-1">
						<a href="customers.php">
							<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
								<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
									<img src="img/teamwork-icon-200x200.gif" style="width: 50px;">
								</span>
								<div class="stats-amount mr-0 ml-1">
									<h3 class="heading-text text-bold-600 numbers">
										<?php
                    $sql = "SELECT * FROM customers";
                    $query = mysqli_query($con, $sql);
                    $count_customers = mysqli_num_rows($query);
                    if ($count_customers == 0 or $count_customers==null) {
                      echo "0";
                    } else {
                      echo $count_customers;
                    }
                    ?>
									</h3>
									<p class="font-small-3">All Customers</p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-6 col-xl-3 col-sm-6 col-6 mt-1 mb-1">
						<a href="interest.php">
							<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
								<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
									<img src="img/customer-icon.png" style="width: 50px;">
								</span>
								<div class="stats-amount mr-0 ml-1">
									<h3 class="heading-text text-bold-600 numbers">
										<?php

                    $sql = "SELECT * FROM interest";
                    $query = mysqli_query($con, $sql);
                    $count_customers = mysqli_num_rows($query);
                    if ($count_customers == 0) {
                      echo "0";
                    } else {
                      echo $count_customers;
                    } ?>
									</h3>
									<p class="font-small-3">Interest Submited</p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-6 col-xl-3 col-sm-6 col-6 mt-1 mb-1">
						<a href="orders.php">
							<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
								<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
									<img src="img/SlushyObedientGrackle-max-1mb.gif" style="width: 50px;">
								</span>
								<div class="stats-amount mr-0 ml-1">
									<h3 class="heading-text text-bold-600 numbers">
										<?php
                    $sql = "SELECT * FROM customer_orders where store_id='$store_id' and order_status='DELIVERED'";
                    $query = mysqli_query($con, $sql);
                    $count_orders = mysqli_num_rows($query);
                    if ($count_orders == 0) {
                      echo "0";
                    } else {
                      echo $count_orders;
                    } ?>
									</h3>
									<p class="font-small-3">Total Delivered Orders</p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-6 col-xl-3 col-sm-6 col-6 mt-1 mb-1">
						<a href="orders.php?type=CANCELLED">
							<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
								<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
									<img src="img/source.gif" style="width: 50px;">
								</span>
								<div class="stats-amount mr-0 ml-1">
									<h3 class="heading-text text-bold-600 numbers">
										<?php
                    $sql = "SELECT * FROM customer_orders where store_id='$store_id' and order_status='CANCELLED'";
                    $query = mysqli_query($con, $sql);
                    $count_orders = mysqli_num_rows($query);
                    if ($count_orders == 0) {
                      echo "0";
                    } else {
                      echo $count_orders;
                    } ?>
									</h3>
									<p class="font-small-3">Total Cancelled Orders</p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-6 col-xl-3 col-sm-6 col-6 mt-1 mb-1">
						<a href="orders.php?type=UNDELIVERED">
							<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
								<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
									<img src="img/Cancel-Order.png" style="width: 50px;">
								</span>
								<div class="stats-amount mr-0 ml-1">
									<h3 class="heading-text text-bold-600 numbers">
										<?php
                    $sql = "SELECT * FROM customer_orders where store_id='$store_id' and order_status='UNDELIVERED'";
                    $query = mysqli_query($con, $sql);
                    $count_orders = mysqli_num_rows($query);
                    if ($count_orders == 0) {
                      echo "0";
                    } else {
                      echo $count_orders;
                    } ?>
									</h3>
									<p class="font-small-3">Total UnDelivered Orders</p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-6 col-xl-3 col-sm-6 col-6 mt-1 mb-1">
						<a href="pickup_orders.php?type=NEW_ORDER">
							<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
								<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
									<img src="img/new-order-icon-9.jpg" style="width: 50px;">
								</span>
								<div class="stats-amount mr-0 ml-1">
									<h3 class="heading-text text-bold-600 numbers">
										<?php
                    $sql = "SELECT * FROM customer_orders where store_id='$store_id' and order_status='NEW_ORDER' or order_status='ACCEPTED' or order_status='OUT_FOR_DELIVERY'";
                    $query = mysqli_query($con, $sql);
                    $count_orders = mysqli_num_rows($query);
                    if ($count_orders == 0) {
                      echo "0";
                    } else {
                      echo $count_orders;
                    } ?>
									</h3>
									<p class="font-small-3">Total Pending Orders</p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-6 col-xl-3 col-sm-6 col-6 mt-1 mb-1">
						<a href="rejected_orders.php">
							<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
								<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
									<img src="img/office-letterpad-writingpad-resume-candidate-cancel-reject-1-12349.webp" style="width: 50px;">
								</span>
								<div class="stats-amount mr-0 ml-1">
									<h3 class="heading-text text-bold-600 numbers">
										<?php
                    $sql = "SELECT * FROM customer_orders where store_id='$store_id' and order_status='REJECTED'";
                    $query = mysqli_query($con, $sql);
                    $count_orders = mysqli_num_rows($query);
                    if ($count_orders == 0) {
                      echo "0";
                    } else {
                      echo $count_orders;
                    } ?>
									</h3>
									<p class="font-small-3">Total Rejected Orders</p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-6 col-xl-3 col-sm-6 col-6 mt-1 mb-1">
						<a href="payments.php">
							<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
								<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
									<img src="img/644cf027a761da47-cash-find-make-share-gfycat-gifs.gif" style="width: 50px;">
								</span>
								<div class="stats-amount mr-0 ml-1">
									<h3 class="heading-text text-bold-600 numbers">
										<?php
                    $select = "SELECT sum(net_payable_amount) FROM customer_orders where payment_status='PAID' and order_status='DELIVERED' and payment_mode='CASH_PAYMENT'";
                    $action = mysqli_query($con, $select);
                    while ($record = mysqli_fetch_array($action)) {
                      $total_amount = $record['sum(net_payable_amount)'];

                      if ($total_amount == 0) {
                        echo "0";
                      } else {
                        echo $total_amount;
                      }
                    }
                    ?>
									</h3>
									<p class="font-small-3">Total Cash Payments</p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-6 col-xl-3 col-sm-6 col-6 mt-1 mb-1">
						<a href="payments.php">
							<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
								<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
									<img src="img/92ae661537ab0633b9f586b462d600a9.gif" style="width: 50px;">
								</span>
								<div class="stats-amount mr-0 ml-1">
									<h3 class="heading-text text-bold-600 numbers">
										<?php
                    $select = "SELECT sum(net_payable_amount) FROM customer_orders where payment_status='PAID' and order_status='DELIVERED' and payment_mode='WALLET'";
                    $action = mysqli_query($con, $select);
                    while ($record = mysqli_fetch_array($action)) {
                      $total_amount = $record['sum(net_payable_amount)'];

                      if ($total_amount == 0) {
                        echo "0";
                      } else {
                        echo $total_amount;
                      }
                    }
                    ?>
									</h3>
									<p class="font-small-3">Total Wallet/UPI Payments</p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-6 col-xl-3 col-sm-6 col-6 mt-1 mb-1">
						<a href="payments.php?type=Not Paid">
							<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
								<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
									<img src="img/303-3038420_no-down-payment-icontim-no-down-payment-icon.png" style="width: 50px;">
								</span>
								<div class="stats-amount mr-0 ml-1">
									<h3 class="heading-text text-bold-600 numbers">
										<?php
                    $select = "SELECT sum(net_payable_amount) FROM customer_orders where payment_status='Not Paid' and order_status!='REJECTED'";
                    $action = mysqli_query($con, $select);
                    while ($record = mysqli_fetch_array($action)) {
                      $total_amount = $record['sum(net_payable_amount)'];

                      if ($total_amount == 0) {
                        echo "0";
                      } else {
                        echo $total_amount;
                      }
                    }
                    ?>
									</h3>
									<p class="font-small-3">Total Pending Payments</p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-6 col-xl-3 col-sm-6 col-6 mt-1 mb-1">
						<a href="stock.php">
							<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
								<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
									<img src="img/1_D-ZiKd0B00tdifaB2X3tKQ.gif" style="width: 50px;">
								</span>
								<div class="stats-amount mr-0 ml-1">
									<h3 class="heading-text text-bold-600 numbers">
										<?php
                    $select = "SELECT * FROM user_products";
                    $action = mysqli_query($con, $select);
                    $StockCount = mysqli_num_rows($action);
                    if ($StockCount == 0) {
                      echo "0";
                    } else {
                      echo $StockCount;
                    }
                    ?>
									</h3>
									<p class="font-small-3">Available Stock</p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-6 col-xl-3 col-sm-6 col-6 mt-1 mb-1">
						<a href="stock.php">
							<div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
								<span class="card-icon success d-flex justify-content-center" style="margin-right: 0px !important;">
									<img src="img/shopping-cart.gif" style="width: 50px;">
								</span>
								<div class="stats-amount mr-0 ml-1">
									<h3 class="heading-text text-bold-600 numbers">
										<?php
                    $select = "SELECT * FROM customer_cart";
                    $action = mysqli_query($con, $select);
                    $StockCount = mysqli_num_rows($action);
                    if ($StockCount == 0) {
                      echo "0";
                    } else {
                      echo $StockCount;
                    }
                    ?>
									</h3>
									<p class="font-small-3">Stock in Shopping Cart</p>
								</div>
							</div>
						</a>
					</div>

				</div>

			</div>
		</div>
	</div>
</div>

<!-- Grouped multiple cards for statistics ends here -->
<script type="text/javascript">
function autocomplete(inp, arr) {
	/*the autocomplete function takes two arguments,
	the text field element and an array of possible autocompleted values:*/
	var currentFocus;
	/*execute a function when someone writes in the text field:*/
	inp.addEventListener("input", function(e) {
		var a, b, i, val = this.value;
		/*close any already open lists of autocompleted values*/
		closeAllLists();
		if (!val) {
			return false;
		}
		currentFocus = -1;
		/*create a DIV element that will contain the items (values):*/
		a = document.createElement("DIV");
		a.setAttribute("id", this.id + "autocomplete-list");
		a.setAttribute("class", "autocomplete-items");
		/*append the DIV element as a child of the autocomplete container:*/
		this.parentNode.appendChild(a);
		/*for each item in the array...*/
		for (i = 0; i < arr.length; i++) {
			/*check if the item starts with the same letters as the text field value:*/
			if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
				/*create a DIV element for each matching element:*/
				b = document.createElement("DIV");
				/*make the matching letters bold:*/
				b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
				b.innerHTML += arr[i].substr(val.length);
				/*insert a input field that will hold the current array item's value:*/
				b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
				/*execute a function when someone clicks on the item value (DIV element):*/
				b.addEventListener("click", function(e) {
					/*insert the value for the autocomplete text field:*/
					inp.value = this.getElementsByTagName("input")[0].value;
					/*close the list of autocompleted values,
					(or any other open lists of autocompleted values:*/
					closeAllLists();
				});
				a.appendChild(b);
			}
		}
	});
	/*execute a function presses a key on the keyboard:*/
	inp.addEventListener("keydown", function(e) {
		var x = document.getElementById(this.id + "autocomplete-list");
		if (x) x = x.getElementsByTagName("div");
		if (e.keyCode == 40) {
			/*If the arrow DOWN key is pressed,
			increase the currentFocus variable:*/
			currentFocus++;
			/*and and make the current item more visible:*/
			addActive(x);
		} else if (e.keyCode == 38) { //up
			/*If the arrow UP key is pressed,
			decrease the currentFocus variable:*/
			currentFocus--;
			/*and and make the current item more visible:*/
			addActive(x);
		} else if (e.keyCode == 13) {
			if (currentFocus > -1) {
				/*and simulate a click on the "active" item:*/
				if (x) x[currentFocus].click();
			}
		}
	});

	function addActive(x) {
		/*a function to classify an item as "active":*/
		if (!x) return false;
		/*start by removing the "active" class on all items:*/
		removeActive(x);
		if (currentFocus >= x.length) currentFocus = 0;
		if (currentFocus < 0) currentFocus = (x.length - 1);
		/*add class "autocomplete-active":*/
		x[currentFocus].classList.add("autocomplete-active");
	}

	function removeActive(x) {
		/*a function to remove the "active" class from all autocomplete items:*/
		for (var i = 0; i < x.length; i++) {
			x[i].classList.remove("autocomplete-active");
		}
	}

	function closeAllLists(elmnt) {
		/*close all autocomplete lists in the document,
		except the one passed as an argument:*/
		var x = document.getElementsByClassName("autocomplete-items");
		for (var i = 0; i < x.length; i++) {
			if (elmnt != x[i] && elmnt != inp) {
				x[i].parentNode.removeChild(x[i]);
			}
		}
	}
	/*execute a function when someone clicks in the document:*/
	document.addEventListener("click", function(e) {
		closeAllLists(e.target);
	});
}
autocomplete(document.getElementById("CustomerPhones"), countries);
</script>
