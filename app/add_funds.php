<?php require 'files.php';
require 'session.php';
  $customer_id = $_SESSION['customer_id'];
$sql = "SELECT * from customers where customers.customer_id='$customer_id' ";
$query = mysqli_query($con, $sql);
$count_address = mysqli_num_rows($query);
$fetch = mysqli_fetch_assoc($query);
 $customer_name = $fetch['customer_name'];
 $customer_mail_id = $fetch['customer_mail_id'];
 $customer_phone_number = $fetch['customer_phone_number'];
 $customer_password= $fetch['customer_password'];
 $cust_dp = $fetch['customer_image'];
 $arealocality = $fetch['arealocality'];
 $custaddress = $fetch['custaddress'];
 $custcity = $fetch['custcity'];
 $custstate = $fetch['custstate'];
 $custpincode = $fetch['custpincode'];
 $contactperson = $fetch['contactperson'];
 $alternatenumber = $fetch['alternatenumber']; 

?>
<?php
  header("Pragma: no-cache");
  header("Cache-Control: no-cache");
  header("Expires: 0");

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
 <title><?php echo $app_name;?> : Rewards Points</title>

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
<script>
function currentTime() {
  var date = new Date(); /* creating object of Date class */
  var hour = date.getHours();
  var min = date.getMinutes();
  var sec = date.getSeconds();
  var midday = "AM";
  midday = (hour >= 12) ? "PM" : "AM"; /* assigning AM/PM */
  hour = (hour == 0) ? 12 : ((hour > 12) ? (hour - 12): hour); /* assigning hour in 12-hour format */
  hour = updateTime(hour);
  min = updateTime(min);
  sec = updateTime(sec);
  document.getElementById("TXNTIME").value = hour + " : " + min + " : " + sec + " " + midday; /* adding time to the div */
    var t = setTimeout(currentTime, 1000); /* setting timer */
}

function updateTime(k) { /* appending 0 before time elements if less than 10 */
  if (k < 10) {
    return "0" + k;
  }
  else {
    return k;
  }
}


</script>
<body class="home home-2">
 <div id="all">
   <?php include 'header.php';?>

</head>

<!-- header part end -->
 <section class="container-fluid pb-2">
  <div class="row">
   <div class="col-md-12 col-xs-12 col-sm-12" style="padding-right: 1%; padding-left: 1%;padding-bottom: 2%;">
   <img src="img/funds.png" style="width: 100%;">
   </div>
  </div>
 </section>

 <!-- header part end -->
 <section class="container-fluid pb-2">
  <div class="row">
   <div class="col-md-12 col-xs-12 col-sm-12" style="padding-right: 1%; padding-left: 1%;padding-bottom: 2%;">
    <h5 style="font-size: 4vw;"><i class="fas fa-wallet" style="color: #af6565;"></i> Add Funds <i class="fa fa-angle-right"></i></h5>
   </div>
  </div>
 </section>
<style type="text/css">
  .btndec {
    border-radius: 15px;
  }
  .btndec:hover {
    background-color: black;
    color: white;
    border-radius: 15px;
  }
  .btninc {
    border-radius: 15px;
  }
  .btninc:hover {
    background-color: green;
    color: white;
    border-radius: 15px;
  }
</style>

<?php $currentTime = '<span id="TXNTIME"><script type="text/javascript">currentTime()</script></span>';?>
 <section class="container-fluid pb-2">
  <div class="row">
   <div class="col-lg-12 col-xs-12 col-sm-12">
    <form method="POST" action="pgRedirect.php">
      <input id="ORDER_ID" tabindex="1" maxlength="20" size="20"name="ORDER_ID" autocomplete="off" value="<?php echo  "SHKW".date("dmy"). rand(10000,99999999)?>" hidden="">
      <input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $customer_id;?>"  hidden="">
      <input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail"  hidden="">
      <input id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB"  hidden="">
      <input type="text" name="MSISDN" value="<?php echo $customer_phone_number;?>" hidden="">
      <input type="text" name="EMAIL" value="<?php echo $customer_mail_id;?>" hidden="">
      <div class="row">

        <div class="col-sm-12 col-xs-12">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-4 col-sm-4">
                <input type="button" class="btndec" onclick="decrementValue()" value="-" style="padding: 11% 40%;float: left;" />
              </div>

               <div class="col-xs-4 col-sm-4" style="padding-right: 1%;padding-left: 1%;">
               <center>
                <input type="text" name="TXN_AMOUNT" value="500" id="number" style="font-size: 8vw;
    font-weight: 600;
    color: black;
    font-family: cursive;
    padding-top: 0px;
    padding-bottom: 0px;
    padding-left: 0px;
    padding-right: 0px;
        text-align: center;" />
              </center>
              </div>

               <div class="col-xs-4 col-sm-4">
                 <input type="button" class="btninc" onclick="incrementValue()" value="+" style="padding: 11% 40%;float: right;" />
              </div>
            </div>  
          </div>
        </div>

        <div class="col-sm-12 col-xs-12">
          <div class="form-group">
           <input value="ADD Funds" type="submit" onclick="" class="form-control" style="background-color: #82d8b5;">
          </div>
        </div>

      </div>
    </form>
      
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
      <script src="js/main.js"></script>

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
  if (value < 5000) {
   values = value+500;
   document.getElementById('number').value = values;
  }
 }

 function decrementValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  if (value > 500) {
   values = value-500;
   document.getElementById('number').value = values;
  }

 }
 </script>
</body>

</html>
