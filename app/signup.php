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
                        /* HIDE RADIO */
[type=radio] {
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

/* IMAGE STYLES */
[type=radio] + img {
  cursor: pointer;
}

/* CHECKED STYLES */
[type=radio]:checked + img {
  outline: 2px solid red;
  border-radius: 0px !important;
}
                      </style>
</head>

<body style="background-image: url('img/clement-m-igX2deuD9lc-unsplash.jpg'); background-size: cover; background-repeat: no-repeat;background-position: center center;background-attachment: fixed;color:black;">
<!-- header part start -->
<header class="header-2">
 <div class="container-fluid">
  <div class="row header-content">
   <div class="col-lg-12 col-sm-12" style="padding: 1%;">
    <div class="content-header">
    <div class="left-section">
 <div class="header-top" style="padding-top: 2%; padding-bottom: 2%;">
  <div class="navbar" style="margin-bottom: 1%;">
   <a href="intro.php">
    <div class="bar-style">
      <img src="img/white.png" style="width: 10%; position: fixed;border-radius: 25px;">
    </div>
   </a>
   <center>
                                            <a href="">
                                                <img src="<?php echo $Logo;?>" style="width:25%;border-radius: 4vw;margin-top:0%;background-color: white;
    padding: 3%;box-shadow: 0px 0px 3px grey;">
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
 <section class="container-fluid">
  <div class="row">
   <div class="col-md-12" style="padding-left:2%; padding-right:2%;">
    <h4>Choose Your City</h4>
    <p>Currently we are active in <i class="fa fa-angle-right"></i></p>
   </div>
  </div>
 </section>

 <section class="container-fluid">

  <form action='store.php' method='GET'>
  <div class="row">
  <?php 
  $sql = "SELECT * FROM city where store_id='$store_id' and city_status='active'";
  $query = mysqli_query($con, $sql);

  while ($fetch = mysqli_fetch_assoc($query)){
    $CityName = $fetch['city_name'];
    $CityImage = $fetch['city_image'];
    $CityId = $fetch['city_id'];

  ?>
     <div class="col-sm-4 col-xs-4">
     <label>
      <input type="radio" name="CITY" value="<?php echo $CityId;?>" required="">
      <img src="<?php echo $admin_url;?>/img/city/<?php echo $CityImage;?>" style="width: 100%;border-radius: 50%;">
     </label>
     </div>
   <?php } ?>

     <div class="col-sm-12 col-xs-12" style="position: absolute;
    bottom: 4%;">
      <center>
       <button type="submit" class="btn btn-sm btn-success" style="background-color: #4CAF50;
    color: white;
    font-family: auto;
    text-transform: none;
    font-size: 12px;">Continue <i class="fa fa-angle-right"></i></button>
     </center>
     </div>
   </div>
    </form>
  </div>
 </section>


<?php if (isset($_GET['note'])) {
    $msg = $_GET['note'];
 ?>

 <div class="modal fade bd-example-modal-lg theme-modal newsletter-popup" id="exampleModal" tabindex="-1" role="dialog"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
   <div class="modal-content">
    <div class="modal-body" style='background-image:none;'>
     <div class="container-fluid p-0">
      <div class="row">
       <div class="col-12">
        <div class="modal-bg">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
           aria-hidden="true">&times;</span></button>
         <div class="offer-content text-center">
          <img src='img/full-width-white.png' style='width:100px;'>
          <h4 style='text-transform:none;'>
          <?php echo $msg;?>
          </h4>
           <button type="submit" class="btn btn-solid text-center close" data-dismiss="modal" aria-label="Close">Close</button>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
    <?php }?>



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
