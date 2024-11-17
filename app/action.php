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

			<section class="container-fluid pb-2" style="position: absolute;
    bottom: 10%;">
				<div class="row">
					<div class="col-md-12 col-sm-6 col-xs-6" style="text-align:center;">
						<a href="tel:<?php echo $store_phone;?>">
							<img src="img/80-802686_phone-call-icon-blue-call-icon-png-transparent.png" style="width: 40%;
    border-radius: 50%;
    box-shadow: 0px 0px 3px grey;
    padding: 3%;">

						</a>
						<p style="font-size: 14px;
    margin-top: 5%;
    font-weight: 600;"> Order On Call</p>
					</div>
					<div class="col-md-12 col-sm-6 col-xs-6" style="text-align:center;">
						<a
							href="whatsapp:https://wa.me/918447572565?text=<?php echo "$customer_name, $customer_address, $CMT_arealocality, $CMT_city, $CMT_state, $CMT_pincode. Contact Number $customer_phone.";?>">
							<img src="img/whatsapp-logo-computer-icons-whatsapp.jpg" style="width: 40%;
    border-radius: 50%;
    box-shadow: 0px 0px 3px grey;
    padding: 3%;">

						</a>
						<p style="font-size: 14px;
    margin-top: 5%;
    font-weight: 600;"> Order On Whatsapp</p>
					</div>
				</div>
			</section>






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
