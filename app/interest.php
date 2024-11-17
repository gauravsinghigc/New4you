<?php require 'files.php'; ?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="bigboost">
		<meta name="keywords" content="bigboost">
		<meta name="author" content="bigboost">
		<link rel="icon" href="<?php echo $app_logo_sq;?>" type="image/x-icon" />
		<link rel="shortcut icon" href="<?php echo $app_logo_sq;?>" type="image/x-icon" />
		<title><?php echo $app_name;?> : Home Page</title>

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display:300,400,700" rel="stylesheet">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="libs/font-material/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="libs/nivo-slider/css/nivo-slider.css">
		<link rel="stylesheet" href="libs/nivo-slider/css/animate.css">
		<link rel="stylesheet" href="libs/nivo-slider/css/style.css">
		<link rel="stylesheet" href="libs/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="libs/slider-range/css/jslider.css">

		<!-- Template CSS -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/reponsive.css">

	</head>

	<body class="home home-2">
		<div id="all">
			<?php include 'header.php';?>

			<section class="container-fluid pb-2">
				<div class="row">
					<div class="col-md-12 col-12 col-sm-12">
						<?php if(isset($_GET['type'])){
							$type = $_GET['type'];
							if($type == "MILK"){ ?>

						<img src="img/buffalo.png" style="width:100%">
						<h4>Pure Buffalo Milk @ Rs.60/1Kg</h4>
						<hr>
						<p><?php echo $APP_NAME;?> is going Launch Pure Buffalo Milk with interesting price range. Show
							your interest and avail benefits of early access. We will inform you when we start the
							process...</p>

						<h4>Why from <?php echo $APP_NAME;?></h4>

						<ul style="list-style-type: circle !important;">
							<li><i class="fa fa-check-circle text-success"></i> Daily Milk Quality Checking. </li>
							<li><i class="fa fa-check-circle text-success"></i> Daily Test Reports are Uploading on the
								App.</li>
							<li><i class="fa fa-check-circle text-success"></i> Safe and Clean Milk Distribution
								Process.</li>
							<li><i class="fa fa-check-circle text-success"></i> Easy to maintain your Milk subscription
								with <?php echo $APP_NAME;?> APP.</li>
							<li><i class="fa fa-check-circle text-success"></i> Free Test Samples for Qaulity and Purity
								Check.</li>
							<li><i class="fa fa-check-circle text-success"></i> Interesting Price.</li>
							<li><i class="fa fa-check-circle text-success"></i> On Call/Whatsapp Subscription active and
								cancellation.</li>
							<li><i class="fa fa-check-circle text-success"></i> Contact less Delivery.</li>
						</ul>

						<p>We will inform you as we start the process...</p>
						<center>
							<form action="" method="POST">
								<input type="text" name="customer_id" value="<?php echo $customer_id;?>" hidden="">
								<input type="text" name="interest_type" value="<?php echo $type;?>" hidden="">
								<?php
if(!isset($_SESSION['customer_id'])){ ?>
								<a href="login.php" class="btn btn-success btn-sm"
									style='background-color: cornflowerblue;'>
									<i class="fa fa-check-circle text-white"></i> Login To Show Interest
								</a>
								<?php	} else { ?>
								<button type="submit" name="SUBMIT_INTEREST" class="btn btn-success btn-sm"
									style='background-color: cornflowerblue;'><i
										class="fa fa-check-circle text-white"></i> Show
									Interest</button>
							</form>
						</center>
						<?php } ?>



						<?php } elseif($type == ""){

						}

						} else {
						header("location: index.php?note=No Any Near By Launches are Available");
						} ?>
					</div>
				</div>
			</section>

			<br><br><br><br>

			<?php
if(isset($_POST['SUBMIT_INTEREST'])){
	$customer_id = $_POST['customer_id'];
	$interest_type = $_POST['interest_type'];
	$date_time = date("D d M, Y");

	$sql = "INSERT INTO interest (customer_id, interest_type, submitdate) VALUES ('$customer_id', '$interest_type', '$date_time')";
	$query = mysqli_query($con, $sql);
	if($query == true){ ?>
			<meta http-equiv="refresh" content="1, message.php?note=true">
			<?php	}
			}

			?>
			<!-- Vendor JS -->
			<script src="libs/jquery/jquery.js">
			</script>
			<script src="libs/bootstrap/js/bootstrap.js">
			</script>
			<script src="libs/jquery.countdown/jquery.countdown.js">
			</script>
			<script src="libs/nivo-slider/js/jquery.nivo.slider.js">
			</script>
			<script src="libs/owl.carousel/owl.carousel.min.js">
			</script>
			<script src="libs/slider-range/js/tmpl.js">
			</script>
			<script src="libs/slider-range/js/jquery.dependClass-0.1.js">
			</script>
			<script src="libs/slider-range/js/draggable-0.1.js">
			</script>
			<script src="libs/slider-range/js/jquery.slider.js">
			</script>
			<script src="libs/elevatezoom/jquery.elevatezoom.js">
			</script>

			<!-- Template CSS -->
			<script src="js/main.js">
			< script >
				$(window).on('load', function() {
					$('#exampleModal').modal('show');
				});

			function openSearch() {
				document.getElementById("search-overlay").style.display = "block";
			}

			function closeSearch() {
				document.getElementById("search-overlay").style.display = "none";
			}
			</script>
			<script type="text/javascript">
			function incrementValue() {
				var value = parseInt(document.getElementById('number').value, 10);
				value = isNaN(value) ? 0 : value;
				if (value < 10) {
					value++;
					document.getElementById('number').value = value;
				}
			}

			function decrementValue() {
				var value = parseInt(document.getElementById('number').value, 10);
				value = isNaN(value) ? 0 : value;
				if (value > 1) {
					value--;
					document.getElementById('number').value = value;
				}

			}
			</script>
	</body>

</html>
