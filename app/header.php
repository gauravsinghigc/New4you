<?php
if (isset($_SESSION['customer_id'])) {
  $ip_address = "$ip_address$device_type";
  $customer_id = $_SESSION['customer_id'];
  $UpdateCart = "UPDATE customer_cart SET customer_id='$customer_id' where ip_address='$ip_address'";
  $Query = mysqli_query($con, $UpdateCart);
} ?>

<nav class="navbar navbar-expand-lg navbar-light w-100 pl0 pr0 theme-24" id="BeforeScroll">
	<a class="navbar-brand">
		<button class="btn btn-white font-12" type="button" onclick="ShowSideBar()">
			<i class="fa fa-bars font-12 mt-2" style="font-size: 25px !important;"></i>
		</button>
	</a>
	<?php if (isset($_SESSION['customer_id'])) { ?>
	<a href='index.php'>
		<img src="<?php echo $LogoRec; ?>" class="d-inline-block align-top Kharido-Height mb-0 mt-0" alt="" loading="lazy">
		<p style="font-size: 8px !important;text-align: center;margin-bottom: 0px !important; margin-top: -5px !important;" class="kharido-TagLine">You Need, We Have, We Deliver.</p>
	</a>
	<a href="notification.php" class="mr-2">
		<button class="btn btn-lg border border-success font-5" style="border-radius: 50px !important;"><i class="fa fa-bell"></i>
			<?php
        $CheckNotification = "SELECT * FROM notifications where customer_id='$customer_id' and notification_status='NEW'";
        $NotificaitonQuery = mysqli_query($con, $CheckNotification);
        $CountNotificaiton = mysqli_num_rows($NotificaitonQuery);
        if ($CountNotificaiton == 0) {
        } else {
          echo "<span class='badge bg-danger'>" . $CountNotificaiton . "</span>";
        }
        ?>
		</button>
	</a>
	<?php } else { ?>
	<a href='index.php'>
		<img src="<?php echo $LogoRec; ?>" class="d-inline-block align-top Kharido-Height mb-0 mt-0 ml-4" alt="" loading="lazy">
		<p style="font-size: 8px !important;text-align: center;margin-bottom: 0px !important; margin-top: -6px !important;margin-left: 18% !important;" class="kharido-TagLine">You Need, We Have, We
			Deliver.
		</p>
	</a>
	<a href="login.php" class="font-4 mr-2 border border-info" style="border-radius: 50px !important;padding: 1.9%;"><i class="fa fa-user-circle font-6"></i> Login <i class="fa fa-sign-in"></i></a>
	<?php } ?>
</nav>
<div class="backgroundarea" id="bakcbf" onclick="ShowSideBar()">
	<div class="navback" id="sidebar">
		<div class="kharido-sidenave" id="sidebar2">
			<ul class="list-group list-group-flush">
				<?php if (isset($_SESSION['customer_id'])) { ?>
				<a href="account.php" style="font-size: 14px !important;">
					<li class="list-group-item user-list fixed-top" style="font-size: 14px !important;width:70%;">
						<i class="fa fa-user bg-secondary"></i><span style="font-size: 15px !important;">
							<?php
                $customer_id = $_SESSION['customer_id'];
                $sql = "SELECT * from customers where customers.customer_id='$customer_id' ";
                $query = mysqli_query($con, $sql);
                $fetch = mysqli_fetch_assoc($query);
                $customer_status = $fetch['customer_status'];
                ?><?php CDATA("customer_name"); ?> </span>
					</li>
				</a>
				<?php } else { ?>

				<a href="login.php">
					<li class="list-group-item user-list fixed-top " style="width:70%;">
						<i class="fa fa-user bg-secondary"></i><span> Login & Signup </span>
					</li>
				</a>
				<?php } ?>
				<li class="list-group-item font-6" style="margin-top:21% !important; padding:3% !important;background-image: linear-gradient(to right bottom, #caeff7, #1bff0029) !important;"><b>Offers
						&
						Deals</b>
				</li>
				<a href="index.php">
					<li class="list-group-item">Home</li>
				</a>
				<a href="today_deals.php">
					<li class="list-group-item">Today Deal's</li>
				</a>
				<a href="categories.php">
					<li class="list-group-item">Shop By Categories</li>
				</a>
				<a href="sell.php">
					<li class="list-group-item">Sell on 24kharido.in</li>
				</a>
				<a href="offers.php">
					<li class="list-group-item">Running Offers</li>
				</a>
				<a href="rations.php">
					<li class="list-group-item">Monthly Ration Offers</li>
				</a>
				<a href="create_order.php">
					<li class="list-group-item">Create Custom Orders</li>
				</a>
				<li class="list-group-item" style="padding:3% !important;background-image: linear-gradient(to right bottom, #caeff7, #1bff0029) !important;"><b>Account & Settings</b>
				</li>
				<?php if (isset($_SESSION['customer_id'])) { ?>
				<a href="account.php">
					<li class="list-group-item">My Account</li>
				</a>
				<a href="orders.php">
					<li class="list-group-item">My Orders</li>
				</a>
				<a href="cart.php">
					<li class="list-group-item">My Cart</li>
				</a>
				<a href="wallet.php">
					<li class="list-group-item">24Kharido Funds</li>
				</a>
				<a href="rewards.php">
					<li class="list-group-item">Reward Points</li>
				</a>
				<a href="refers.php">
					<li class="list-group-item">Refers & Earn</li>
				</a>
				<a href="track-order.php">
					<li class="list-group-item">Track Orders</li>
				</a>
				<a href="notification.php">
					<li class="list-group-item">Notifications</li>
				</a>
				<a href="logout.php?n=<?php CDATA("customer_name"); ?>">
					<li class="list-group-item">Logout</li>
				</a>
				<?php } else { ?>
				<a href="track-order.php">
					<li class="list-group-item">Track Orders</li>
				</a>
				<a href="login.php">
					<li class="list-group-item">Login & Signup</li>
				</a>
				<?php } ?>
				<li class="list-group-item font-6" style="padding:3% !important;background-image: linear-gradient(to right bottom, #caeff7, #1bff0029) !important;"><b>About
						<?php echo $store_name; ?></b>
				</li>
				<a href="about-us.php">
					<li class="list-group-item">About Us</li>
				</a>
				<a href="privacy-policy.php">
					<li class="list-group-item">Privacy Policy</li>
				</a>
				<a href="terms-and-conditions.php">
					<li class="list-group-item">Terms & Conditions</li>
				</a>
				<a href="refund-and-cancellation.php">
					<li class="list-group-item">Refunds & Cancellations</li>
				</a>
				<a href="support.php">
					<li class="list-group-item">Help & Support</li>
				</a>
				<a href="../blogs/">
					<li class="list-group-item">F&Q's</li>
				</a>
				<a href="career.php">
					<li class="list-group-item">Career</li>
				</a>
				<a href="support.php">
					<li class="list-group-item">Contact Us</li>
				</a>
				<a href="share://">
					<li class="list-group-item">Share App</li>
				</a>
				<li class="list-group-item font-6" style="padding:3% !important;background-image: linear-gradient(to right bottom, #caeff7, #1bff0029) !important;"><b>Like, Share & Follow On</b>
				</li>
				<li class="list-group-item font-4">
					<?php
          $FETCH_sharelinks = "SELECT * FROM sharelinks where linkstatus='active'";
          $QUERY_sharelinks = mysqli_query($con, $FETCH_sharelinks);
          while ($ROWS = mysqli_fetch_assoc($QUERY_sharelinks)) { ?>
					<a href="<?php echo $ROWS['linkurl']; ?>" class="btn btn-lg m-1 btn-info text-white p-2 pl-3 pr-3"><i class="fa <?php echo $ROWS['fafacode']; ?> text-white font-11"></i></a>
					<?php } ?>
				</li>
				<a href="#">
					<li class="list-group-item">&nbsp;</li>
				</a>
			</ul>
		</div>
	</div>
</div>
<?php
      $PageCheck = basename($_SERVER['PHP_SELF']);
      if ($PageCheck == "index.php") {
        $Hide = "";
      } else {
        $Hide = "hide";
      } ?>
<div class="container-fluid" id="BeforeScroll">
	<form class="form <?php echo $Hide; ?>" action="search.php" method="GET">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mb-n4">
				<div class="form-group">
					<input type="text" name="search" id="24kharidoitems" class="form-control pl-3" placeholder="Search..." style="border-radius: 50px !important;">
					<button class="btn btn-white bg-white search-btn" name="query" value="true"><i class="fa fa-search"></i></button>
				</div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mb-n4 text-left <?php echo $Hide; ?> pl-2 pr-2">

				<a href="calling_order.php" class="font-4 float-right mt-4 mr-3 mb-0 bg-white circle" style="padding:5px;margin-top:11px !important;">
					Order On <img src="img/order_on_call.gif" style="width: 27px;margin-top:-3px !important; margin-bottom: 0px;"> OR
					<img src="img/order_on_whatsapp.gif" style="width: 33px;margin-top: -2px; margin-bottom: 0px;"><i class="fa fa-angle-right"></i>
				</a>

				<div class="dropdown dropbtn pointer-cr" onclick="HideLocation()" style="position:absolute;">
					<h6 class="mt-4 mb-4 text-black font-4 ml-1 bg-white p-3 circle mr-3" style="margin-top: 10px !important;">
						<a href="#" class="font-5 mt-2"><i class="fa fa-map-marker font-6 text-danger"></i>
							<?php
              if (isset($_GET['city'])) {
                $_SESSION['city_name'] = $_GET['city'];
                $store_city_cr = $_SESSION['city_name'];
              } else {
                if (isset($_SESSION['city_name'])) {
                  $store_city_cr = $_SESSION['city_name'];
                } else {
                  if (isset($_SESSION['customer_id'])) {
                    $store_city_cr = $custcity;
                  } else {
                    $store_city_cr = $store_city;
                  }
                }
              }
              echo "$store_city_cr"; ?> <i class="fa fa-angle-right"></i>
							<?php
              if (isset($_GET['area'])) {
                $_SESSION['area'] = $_GET['area'];
                $store_arealocality_cr = $_SESSION['area'];
              } else {
                if (isset($_SESSION['area'])) {
                  $store_arealocality_cr = $_SESSION['area'];
                } else {
                  $store_arealocality_cr = $store_arealocality;
                }
              }

              $sql = "SELECT * FROM city where city_name='$store_city_cr'";
              $query = mysqli_query($con, $sql);
              $fetch = mysqli_fetch_assoc($query);
              $city_id_cr = $fetch['city_id'];
              $sql = "SELECT * FROM services_area where city_id='$city_id_cr' and area_status='active'";
              $query = mysqli_query($con, $sql);
              $checkarea = mysqli_num_rows($query);
              if ($checkarea == 0) {
                $store_arealocality_cr = "Inactive Area";
              } else {
                $store_arealocality_cr = $store_arealocality_cr;
              }
              echo $store_arealocality_cr;
              ?>
							<i class="fa fa-angle-down"></i>
						</a>
					</h6>
					<div class="dropdown-content" style="width:100% !important;left:0px !important;z-index: 50;position:relative;top:13.1%;margin-top: -4px;" id="LocationArea">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-12">
									<br>
									<span class="btn btn-danger float-right mr-2"><i class="fa fa-times"></i></span>
									<script type="text/javascript">
									function HideLocation() {
										if (document.getElementById("LocationArea").style.display === "block") {
											document.getElementById("LocationArea").style.display = "none";
										} else {
											document.getElementById("LocationArea").style.display = "block";
										}
									}
									</script>
								</div>
								<?php
                $sql = "SELECT * FROM city where city_status='active'";
                $query = mysqli_query($con, $sql);
                while ($fetch = mysqli_fetch_assoc($query)) {
                  $city_id[] = $fetch['city_id'];
                }
                foreach ($city_id as $city_id) {
                  $cr_url = $_SERVER['PHP_SELF'];
                  $sql = "SELECT * FROM city where city_status='active' and city_id='$city_id'";
                  $query = mysqli_query($con, $sql);
                  while ($fetch = mysqli_fetch_assoc($query)) {
                    $city_name = $fetch['city_name'];
                    echo "<div class='col-lg-12 col-md-12 col-sm-12 col-12 col-xs-12' style='text-align: justify;'>";
                    echo "<span class='list-inline-2'><a href='$cr_url?city=$city_name' class='area-locality text-white font-6' style='border-radius:25px;background-color:#3dc33d; color:white !important;padding-left:2%; padding-right:2%;'><i class='fa fa-map-marker mt-0'></i> $city_name</a> <i class='fa fa-angle-right text-black font-6'></i></span><br>";
                    $sql = "SELECT * FROM services_area where city_id='$city_id' and area_status='active'";
                    $query = mysqli_query($con, $sql);
                    while ($fetch = mysqli_fetch_assoc($query)) {
                      $area_locality = $fetch['area_locality'];
                      echo "<span class='list-inline-2'><a href='$cr_url?area=$area_locality' class='area-locality font-5 m-1 pl-3 pr-3'> $area_locality</a></span>";
                    }
                    echo "<br><br></div>";
                  }
                }
                ?>
								<div class='col-lg-12 col-md-12 col-sm-12 col-12 col-xs-12 text-center'>
									<hr>
									<small class="text-danger font-4"><b>"</b> Click on city Name to change city <b>"</b></small>
									<h4 class="text-black font-5"><i class='fa fa-info-circle text-info'></i>
										We are currently working on activating other cities and area too, As activated we will inform you.
									</h4>
									<br>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
	</form>
</div>
<script type="text/javascript">
var items = [<?php
                mysqli_set_charset($con, 'utf8');
                $sql = "SELECT * FROM user_products where product_status='active' ORDER BY product_title ASC";
                $query = mysqli_query($con, $sql);
                while ($fetch = mysqli_fetch_assoc($query)) {
                  $product_title = $fetch['product_title'];
                  $hindi_name = $fetch['hindi_name'];
                  $product_tags = $fetch['product_tags'];
                  echo '"' . $product_title . '",';
                } ?>];

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
				b.innerHTML +=
					"<i class='fa fa-search' style='float:left;font-size:12px;margin-top: 3px;padding-right: 2%;'></i><input type='hidden' value='" +
					arr[i] + "'>";
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
autocomplete(document.getElementById("24kharidoitems"), items);
autocomplete(document.getElementById("kharidoitemsss"), items);
</script>
<?php
if (isset($_SESSION['customer_id'])) {
  $customer_id = $_SESSION['customer_id'];
  $device_info = "$ip_address$device_type";
  $Sql = "SELECT * from customer_cart where customer_id='$customer_id'";
  $Query = mysqli_query($con, $Sql);
  $CounCartItems = mysqli_num_rows($Query);
  if ($CounCartItems == 0 or $CounCartItems == null) {
    $CounCartItems = "";
    $Hide = "hide";
    $total_amount = "";
    $HideCart = "";
  } else {
    $CounCartItems = "<span class='badge bg-danger'>$CounCartItems</span>";
    $Hide = "";
    $select = "SELECT sum(product_total_amount) FROM customer_cart where customer_id='$customer_id'";
    $action = mysqli_query($con, $select);
    while ($record = mysqli_fetch_array($action)) {
      $total_amount = $record['sum(product_total_amount)'];
    }
    $sql = "SELECT * FROM delivery_charges where delivery_charge_status='active'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    $delivery_charge = $fetch['delivery_charge'];
    $est_delivery_amount = $fetch['est_delivery_amount'];
    $concharge = $fetch['concharge'];
    if ($total_amount <= $est_delivery_amount) {
      $total_amounts = $total_amount + $delivery_charge + $concharge;
    } else {
      $total_amounts = $total_amount + $concharge;
    }

    if ($total_amount <= $est_delivery_amount) {
      $delmsg = "<i class='fa fa-inr'></i> $delivery_charge ( <i class='fa fa-truck'></i> )";
    } else {
      $delmsg = "<i class='fa fa-truck'></i> Free";
    }
    $PageCheck = basename($_SERVER['PHP_SELF']);
    if ($PageCheck == "cart.php" or $PageCheck == "checkout.php" or $PageCheck == "payment.php" or $PageCheck == "support.php" or $PageCheck == "orders.php" or $PageCheck == "create_order.php") {
      $HideCart = "hide";
    } else {
      $HideCart = "";
    }
  }
?>
<a href="cart.php" class="fixed-bottom mb-2 cart-button-24kharido-short d-block mx-auto <?php echo $Hide; ?> <?php echo $HideCart; ?>">
	<button class="btn btn-md btn-success font-6 d-block mx-auto">
		<i class="fa fa-shopping-cart font-6"></i> <?php echo $CounCartItems; ?>
	</button>
</a>

<!--<a href="cart.php" class="fixed-bottom cart-button-24kharido mb-2 <?php echo $Hide; ?> <?php echo $HideCart; ?>">
    <span class="float-left mt-1 font-5">
      <span>
        Cart Amount
        <small class="font-5"><i class="fa fa-angle-right"></i> &nbsp;
          <span><i class="fa fa-inr"></i> <?php echo $total_amount; ?></span>
          <b>+</b> <?php echo $delmsg; ?> =
        </small>
        <span class="font-5">
          <i class="fa fa-inr"></i> <?php echo $total_amounts; ?>
        </span>
      </span>
    </span>
    <button class="btn btn-md btn-success font-6 float-right">
      <i class="fa fa-shopping-cart font-6"></i> <?php echo $CounCartItems; ?>
    </button>
  </a>-->

<?php } else {
  $ip_address = get_ip();
  $device_type = detectDevice();
  date_default_timezone_set("Asia/Calcutta");
  $date_time_c = date("dMY");
  $ipv6_n = php_uname('n');
  $ipv6_p = php_uname('p');
  $os = php_uname('s');
  $OS_release = php_uname('r');
  $OS_Version = php_uname('v');
  $System_Info = php_uname('m');
  $System_more_Info = $_SERVER['HTTP_USER_AGENT'];
  $device_info = "$ip_address$device_type";

  $Sql = "SELECT * from customer_cart where ip_address='$device_info'";
  $Query = mysqli_query($con, $Sql);
  $CounCartItems = mysqli_num_rows($Query);
  if ($CounCartItems == 0 or $CounCartItems == null) {
    $CounCartItems = "";
    $Hide = "hide";
    $total_amount = "";
  } else {
    $CounCartItems = "<span class='badge bg-danger'>$CounCartItems</span>";
    $Hide = "";
    $select = "SELECT sum(product_total_amount) FROM customer_cart where ip_address='$device_info'";
    $action = mysqli_query($con, $select);
    while ($record = mysqli_fetch_array($action)) {
      $total_amount = $record['sum(product_total_amount)'];
    }
    $sql = "SELECT * FROM delivery_charges where delivery_charge_status='active'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    $delivery_charge = $fetch['delivery_charge'];
    $est_delivery_amount = $fetch['est_delivery_amount'];
    $concharge = $fetch['concharge'];
    if ($total_amount <= $est_delivery_amount) {
      $total_amounts = $total_amount + $delivery_charge + $concharge;
    } else {
      $total_amounts = $total_amount + $concharge;
    }

    if ($total_amount <= $est_delivery_amount) {
      $delmsg = "<i class='fa fa-inr'></i> $delivery_charge ( <i class='fa fa-truck'></i> )";
    } else {
      $delmsg = "<i class='fa fa-truck'></i> Free";
    }
    $PageCheck = basename($_SERVER['PHP_SELF']);
    if ($PageCheck == "cart.php" or $PageCheck == "checkout.php" or $PageCheck == "payment.php" or $PageCheck == "support.php" or $PageCheck == "orders.php" or $PageCheck == "create_order.php") {
      $HideCart = "hide";
    } else {
      $HideCart = "";
    }
  }
?>
<a href="cart.php" class="fixed-bottom mb-2 cart-button-24kharido-short d-block mx-auto <?php echo $Hide; ?> <?php echo $HideCart; ?>">
	<button class="btn btn-md btn-success font-6 d-block mx-auto">
		<i class="fa fa-shopping-cart font-6"></i> <?php echo $CounCartItems; ?>
	</button>
</a>
<?php } ?>
