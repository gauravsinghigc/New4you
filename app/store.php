<?php require 'files.php';
if(isset($_GET['CITY'])){
 $CITY = $_GET['CITY'];
 if($CITY == null OR $CITY == ""){
  header("location: signup.php?note=Please Choose your City First!");
 }
}

?>
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
		<title><?php echo $APP_NAME;?> : Home Page</title>

		<!--Google font-->
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

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
<style type="text/css">
	.areaClick:hover {
		box-shadow: 0px 1px 12px #1d0303;
    border-radius: 10px;
    padding-top: 3%;
    background-color: #ffffff;
    margin-top: 1%;
    color: white !important;
	}
</style>
	</head>

	<body
		style="background-image: url('img/bg/nica-cn-1zOtkv3hJ9s-unsplash.jpg');background-size: cover; background-repeat: no-repeat;background-position: center center;background-attachment: fixed;color:black !important;">
		<!-- header part start -->
		<header class="header-2">
			<div class="container-fluid">
				<div class="row header-content">
					<div class="col-lg-12 col-sm-12" style="padding: 1%;">
						<div class="content-header">
							<div class="left-section">
								<div class="header-top"
									style="padding-top: 2%; padding-bottom: 2%;border-bottom: none;">
									<div class="navbar" style="margin-bottom: 1%;">
										<a href="signup.php">
											<div class="bar-style">
												<img src="img/white.png"
													style="width: 10%; position: fixed;border-radius: 25px;">
											</div>
										</a>
										<center>
											<a href="">
												<img src="<?php echo $Logo;?>"
													style="width:25%;border-radius: 3px;margin-top:0%;background-color: white;
    box-shadow: 0px 0px 3px grey;
    padding: 3%;
    border-radius: 4vw;">
											</a>
										</center>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</header>

		<!-- header part end -->
		<section class="container-fluid" style='padding-top:0px;'>
			<div class="row">
				<div class="col-md-12" style="padding-left:1%; padding-right:1%;">
					
					<?php
  $sql = "SELECT * FROM city where city_id='$CITY'";
  $query = mysqli_query($con, $sql);
  $fetch =  mysqli_fetch_assoc($query);
  $CityName = $fetch['city_name'];

    $sql = "SELECT * FROM services_area where city_id='$CITY'";
  $query = mysqli_query($con, $sql);
  $count_stores = mysqli_num_rows($query);
  ?>
				</div>
			</div>
		</section>

		<!-- header part end -->
		<section class="container-fluid" style='padding-top:1%;'>
			<div class="row">
				<div class="col-md-12">
					<form action='' METHOD='GET'>
						<div class='row'>
							<div class='col-sm-12' style="padding-left: 1%; padding-right: 1%;">
								<input type='text' name='CITY' value="<?php echo $_GET['CITY'];?>" hidden="">
								<input type='text' name='AREA' id="area" value=''
									placeholder='Search By Area/Locality...' class='form-control' style="padding: 5.5%;">
							</div>
							<div class='col-sm-12'>
								<center>
									<br>
									<button type='SUBMIT' class='btn btn-md btn-success'> <i class='fa fa-search'></i>
									</button>
								</center>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
		<script type="text/javascript">
		var countries = [<?php
			$sql = "SELECT * FROM services_area where city_id='$CITY'";
			$query = mysqli_query($con, $sql);
			while ($fetch = mysqli_fetch_assoc($query)) {
				$product_title = $fetch['area_locality'];
				echo'"'.$product_title.'",';
			} ?>];
		</script>
		<section class="container-fluid">
			<div class="row" style='padding:1%;'>
            <?php 
              if(isset($_GET['AREA'])){ ?>
              	<br>
              <p> Search Area : <?php echo $_GET['AREA']; ?>
<a href="store.php?CITY=<?php echo $_GET['CITY'];?>" style='color:black;float: right;'><i class="fa fa-times"></i> Clear Search</a>
</p>
              <?php } else {

              }
            ?>
				

				<?php
  if(isset($_GET['AREA'])){
    $area = $_GET['AREA'];
     $sql = "SELECT * FROM services_area where city_id='$CITY' and area_locality='$area'";
  } else {
  $sql = "SELECT * FROM services_area where city_id='$CITY'";
  }
  $query = mysqli_query($con, $sql);
  $count_stores = mysqli_num_rows($query);
  if($count_stores == 0){ ?>

				<div class="col-12 mt-2">

					<center>
						
						<i class="fa fa-map-marker" style="font-size: 150px;"></i><i class="fa fa-times" style="font-size: 49px;
    margin-left: -42px;
    top: 1px !important;
    margin-top: 4px !important;
    color: red;"></i><br><br>
						<p style="background-color: #f4f5f7;
    padding: 6%;
    border-radius: 50%;">Sorry, Currenlty We are not active in <br> 
							 <i class="fa fa-map-marker"></i> <?php echo $CityName;?> <i class="fa fa-angle-right"></i> <?php echo $_GET['AREA'];?></p>
					    <a href="signup.php" class="text-black btn" style="color:black;font-family: auto;">Change City</a>
					</center>
				</div>
				<?php } else {

  while ($fetch = mysqli_fetch_assoc($query)){
  $area_locality = $fetch['area_locality'];
  $Storeid = $fetch['store_id']; ?>

				<a href="register.php?store_id=<?php echo $Storeid;?>&area=<?php echo $area_locality;?>">
					<div class="col-sm-12" style='box-shadow: 0px 1px 2px grey;
    border-radius: 10px;
    padding-top: 3%;
    background-color: #f4f5f7;
    margin-top: 1%;'>
						<div class="row areaClick">
							<div class='col-sm-12' style="padding-left:1%; padding-right:1%;">
								<p style='margin-top:5px;color: black !important;'>
									<i class="fa fa-map-marker" style="font-size: 16px;"></i> <?php echo $CityName;?> <i class="fa fa-angle-right"></i>
									<?php echo $area_locality;?>
								</p>
							</div>
						</div>
					</div>
				</a>

				<?php }  }?>
			</div>
			</div>
		</section>

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
					/*If the ENTER key is pressed, prevent the form from being submitted,*/
					e.preventDefault();
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

		autocomplete(document.getElementById("area"), countries);
		</script>
		<!-- latest jquery-->
		<script src="assets/js/jquery-3.3.1.min.js"></script>

		<!-- menu js-->
		<script src="assets/js/menu.js"></script>

		<!-- timer js-->
		<script src="assets/js/flipclock.js"></script>

		<!-- popper js-->
		<script src="assets/js/popper.min.js"></script>

		<!-- slick js-->
		<script src="assets/js/slick.js"></script>

		<!-- Bootstrap js-->
		<script src="assets/js/bootstrap.js"></script>


		<!-- Bootstrap Notification js-->
		<script src="assets/js/bootstrap-notify.min.js"></script>

		<!-- Theme js-->
		<script src="assets/js/script.js"></script>

		<script>
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
