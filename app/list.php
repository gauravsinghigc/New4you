<ul class="menu" style="font-size: 16px !important;">
							<li><?php
        if (isset($_SESSION['customer_id'])) {
          $customer_id = $_SESSION['customer_id'];
          $sql = "SELECT * FROM customers where customer_id='$customer_id'";
          $query = mysqli_query($con, $sql);
          $fetch =  mysqli_fetch_assoc($query);
          $customer_name = $fetch['customer_name'];
          $PhoneNumber = $fetch['customer_phone_number'];
          $CustomerMailId = $fetch['customer_mail_id']; ?>

								<div class="container">
									<div class="row" style="padding: 4%;
    padding-right: 0px;
    padding-left: 0px;
    border-top-style: groove;
    border-color: #80808021;
    border-width: thin;">
										<div class="col-sm-3 col-xs-3" style="padding-right: 1%;padding-left: 2%;">
											<img src='img/30-512.png' style="border-radius: 12%;width: 100%;">
										</div>
										<div class="col-sm-9 col-xs-9" style="padding-right: 2%;">
											<p style="font-size: 12px;"><b style="font-size: 14px;"><i class="fa fa-user"></i> <?php echo $customer_name; ?></b> <br>
												<i class="fa fa-phone"></i> <?php echo $PhoneNumber;?><br>
												<i class="fa fa-envelope"></i> <?php echo $CustomerMailId;?>
											</p>
											<a href='logout.php?n=<?php echo $customer_name;?>' style="float: right; font-size: 13px;">
												Logout <i class="fa fa-angle-right text-primary"></i>
											</a>
										</div>
										<!--<div class="col-sm-12 col-xs-12" style="padding-left: 2%;">
											<hr style="margin-top: 1%;margin-bottom: 4%;">
											<p style="text-align: center;margin-bottom: 0;">
											<a href='' style="float: left; font-size: 17px;">
												<i class="fa fa-money text-success"></i> <i class="fa fa-angle-right"></i> <i class="fa fa-inr"></i>1200.
											</a>
											<a href='' style="
    font-size: 9px;
    padding: 2%;
    color: white;
    background-color: green;" class="btn btn-success btn-sm">
												<i class="fa fa-plus"></i> Funds
											</a>


											<a href='logout.php?n=<?php echo $customer_name;?>' style="float: right; font-size: 13px;">
												Logout <i class="fa fa-sign-in text-primary"></i>
											</a>
										</p>
										</div> -->
									</div>
								</div>


								<?php } else { ?>
								<div class="container">
									<div class="row" style="padding: 4%;
    padding-right: 0px;
    padding-left: 0px;
    border-top-style: groove;
    border-color: #80808021;
    border-width: thin;">
										<div class="col-sm-4 col-xs-4">
											<img src='img/avatar.jpg' style="border-radius: 50%;width:100%;">
										</div>
										<div class="col-sm-8 col-xs-8" style="padding-top: 8%;">
											<a href="login.php" style="margin-top: -2vw;font-size: 13px;"><i class="fa fa-angle-left text-primary"></i> Login & Signup</a>
										</div>
									</div>
								</div>

								<?php } ?></li>

							<li>
								<a href="home.php" title="Homepage"><i class="fa fa-home text-primary" style="width: 4vw;text-align: center;"></i> Home</a>
							</li>
							<?php
        if (isset($_SESSION['customer_id'])) { ?>
							<li>
								<a href="account.php" title="Orders"><i class="fa fa-user text-primary" style="width: 4vw;text-align: center;"></i> My Account</a>
							</li>
							<li>
								<a href="address.php" title="Rewards"><i class="fa fa-map-marker text-primary" style="width: 4vw;text-align: center;"></i> My Address</a>
							</li>
							<li>
								<a href="orders.php" title="Orders"><i class="fa fa-shopping-cart text-primary" style="width: 4vw;text-align: center;"></i> My Orders</a>
							</li>
							<li>
								<a href="refers.php" title="Orders"><i class="fa fa-users text-primary" style="width: 4vw;text-align: center;"></i> My Referrers</a>
							</li>

							<li>
								<a href="rewards.php" title="Rewards"><i class="fa fa-star text-success" style="width: 4vw;text-align: center;"></i> Rewards</a>
							</li>


							<?php } else { } ?>
							<?php if (isset($_SESSION['customer_id'])) { ?>
							<?php } else { ?>

							<?php } ?>
							<li>
								<a href="support.php"><i class="fa fa-info-circle text-primary" style="width: 4vw;text-align: center;"></i> Help & Support</a>
							</li>


							<?php if (isset($_SESSION['customer_id'])) { ?>
							<?php } else { ?>
							<li>
								<a href="login.php"> <i class="fa fa-angle-left text-primary" style="width: 4vw;text-align: center;"></i> Login & Signup</a>
							</li>
							<?php } ?>
                           
							<li>
								<a href="share://">
									<i class="fa fa-share text-primary" style="width: 4vw;text-align: center;"></i> Share App
								</a>
							</li>
						</ul>