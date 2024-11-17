<?php require 'files.php';
if (isset($_SESSION['customer_id'])) {
  $customer_id = $_SESSION['customer_id'];
  $sql = "SELECT * FROM customers where customer_id='$customer_id'";
  $query =  mysqli_query($con, $sql);
  $fetch =  mysqli_fetch_assoc($query);
  $arealocality = $fetch['arealocality'];
  $custaddress = $fetch['custaddress'];
  $custcity = $fetch['custcity'];
  $custstate = $fetch['custstate'];
  $custpincode = $fetch['custpincode'];
  $contactperson = $fetch['contactperson'];
  $alternatenumber = $fetch['alternatenumber'];
  $delivery_address = "$custaddress $arealocality $custcity $custstate $custpincode";
  $contactinfo = "$contactperson $alternatenumber";
  $store_id = $fetch['store_id'];
} else {
  $store_id = "1";

}

ini_set("display_errors", 1);
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

<body class="home home-2">
 <div id="all">
   <?php include 'header.php';?>

 <section class="container-fluid pb-2">
  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left: 1%; padding-right: 1%;">
    <h6 style="font-size: 4vw;margin-top: 4vw;
    padding-bottom: 2%;">Subscriptions <i class="fa fa-angle-right"></i></h6>
   </div>
  </div>
 </section>
 <?php
  $sql = "SELECT * from subscription_cart where store_id='$store_id' and customer_id='$customer_id'";
  $query =  mysqli_query($con, $sql);
  $count_items = mysqli_num_rows($query);
  if($count_items == 0){ ?>
 <section class="container-fluid pb-1 pt-0">
  <div class="row" style="padding:2%;">
   <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row" style='box-shadow:0px 0px 1px grey;padding-left:2%; padding-right:2%;border-radius:10px;'>
     <div class='col-sm-4 col-xs-4'
      style='padding-left:1%; padding-right:1%;padding:1%;border-right-style: groove !important; border-width: 1px !important; border-color: #8080801f !important;padding:5%;'>
      <img src="img/blank.png" style='width:100%;'>
     </div>
     <div class='col-sm-8 col-xs-8' style='padding-left:1%; padding-right:1%;padding:1%;'>
      <h6>No Item Found!</h6>
      <p>It seems, there is no Items in Subscribing List!</p>
      <a href='home.php' class='btn btn-sm btn-info'><i class='fa fa-angle-left'></i> Go to Home</a>
     </div>
    </div>
   </div>
  </div>
  </div>
 </section>
 <?php } else {
 while ($fetch = mysqli_fetch_assoc($query)) {
 $product_name = $fetch['product_name'];
 $product_img = $fetch['product_img'];
 $subs_refrenece_id = $fetch['subs_refrenece_id'];
 $brand_title = $fetch['brand_title'];
 $product_offer_price = $fetch['product_offer_price'];
 $product_mrp_price = $fetch['product_mrp_price'];
 $product_total_price = $fetch['product_total_price'];
 $product_tags = $fetch['product_tags'];
 $product_quantity = $fetch['product_quantity']; ?>
 <section class="container-fluid pb-1 pt-0">
  <div class="row" style="padding:2%;">
   <div class="col-md-12">
    <div class="row" style='box-shadow:0px 0px 1px grey;padding-left:2%; padding-right:2%;border-radius:10px;'>
     <div class='col-sm-4 col-xs-4' style='padding-left:1%; padding-right:1%;padding:1%;'>
       <img
        src="<?php echo $admin_url; ?>/img/store_img/<?php echo $product_img; ?>" style='width:100%;'>
     </div>
     <div class='col-sm-8 col-xs-8' style='padding-left:1%; padding-right:1%;padding:1%;'>
      <h6 style="font-size: 5vw;"><?php echo $product_name;?></h6>
      <a href="delete.php?delete_subs_items=<?php echo $subs_refrenece_id;?>"
       class='btn btn-danger btn-sm float-right mt-2' style="float: right;position: absolute;
    right: 0;
    top: 1vw;
    padding: 2vw;
    padding-left: 3vw;
    padding-right: 3vw;
        background-color: red;"><i class='fa fa-times'></i></a>
      <hr class='pb-0 pt-0' style='margin-top:1px; margin-bottom: 1px;'>
      <p style='font-size:14px;line-height: initial;'><b><?php echo $brand_title; ?></b><br>
       <b class='text-success' style='font-size:20px;'><i class='fa fa-inr'></i>
        <?php echo $product_offer_price; ?> / </b> <b style='font-size:13px;'
        class='text-black'><?php echo $product_tags; ?>
       </b>
      </p>
      <div class="input-group">
        <table style="width: 133px;">
          <tr>
            <td>
              <form action='update.php' method='POST' class="float-right">
        <input type="text" name="subs_refrenece_id" value="<?php echo $subs_refrenece_id; ?>" hidden="">
        <input type="text" name="quantity" value="<?php echo $product_quantity; ?>" hidden="">
        <input type="text" name="product_offer_price" value="<?php echo $product_offer_price; ?>" hidden="">
        <input type="text" name="product_mrp_price" value="<?php echo $product_mrp_price;?>" hidden="">
        <input type="submit" name="DECREASE_SUBS" class="btn btn-info btn-sm float-right text-white" value="-"
         style="padding: 0px 8px 0px 7px !important;font-size: 14px;" />
       </form>
            </td>
            <td>
              <input type='text' min='1' max='10' value='<?php echo $product_quantity; ?>' style='width: 30px !important;
    padding: 0px 0px 3px 8px !important;
    box-shadow: 0px 0px 1px grey;
    height: 23px;' id="number">
            </td>
            <td>
               <form action='update.php' method='POST'>
        <input type="text" name="subs_refrenece_id" value="<?php echo $subs_refrenece_id; ?>" hidden="">
        <input type="text" name="quantity" value="<?php echo $product_quantity; ?>" hidden="">
        <input type="text" name="product_offer_price" value="<?php echo $product_offer_price; ?>" hidden="">
        <input type="text" name="product_mrp_price" value="<?php echo $product_mrp_price;?>" hidden="">
        <input type="submit" name="INCREASE_SUBS" class="btn btn-info btn-sm float-left text-white" value="+"
         style="padding: 0px 8px 0px 7px !important;font-size: 14px;" />
       </form>

            </td>
          </tr>
        </table>
       
       
      
      </div>
      <br>
      <span class="float-right" style='font-size:17px;float: right;'><i class="fa fa-inr"></i>
       <?php echo $product_offer_price;?> x
       <?php echo $product_quantity;?> = <i class=''></i> <i class="fa fa-inr"></i>
       <?php echo $product_total_price; ?></span>

     </div>
    </div>
   </div>
  </div>
  </div>
 </section>
 <?php } ?>

 <section class="container-fluid">
  <div class="row">
   <div class="col-lg-12 col-12">
    <form action="insert.php" method="POST">
     <input type='text' name="product_name" value="<?php echo $product_name;?>" hidden>
     <input type='text' name="product_tags" value="<?php echo $product_tags;?>" hidden>
     <input type='text' name="product_offer_price" value="<?php echo $product_offer_price;?>" hidden>
     <input type='text' name="product_mrp_price" value="<?php echo $product_mrp_price;?>" hidden>
     <input type='text' name="store_id" value="<?php echo $store_id; ?>" hidden>
     <table style="width:100%;">

      <tr>
       <td colspan="2">
        <div class="form-group">
         <label class="container">
          <input type="text" name="SUBSCRIBE_PLAN_TYPE" Value="DAILY_PLAN" hidden="" />
          <span class="checkmark"></span>
         </label>
        </div>
        <div>
         <hr>
         <p>Select Subscription Start Date <i class="fa fa-angle-right"></i></p>
         <p id='TimeNotSelected' style="font-size: 14px;
    color: red;
    font-weight: 600;"></p>
        </div>
        <style type="text/css">
             /* HIDE RADIO */
             [type=radio] {
              position: absolute;
              opacity: 0;
              width: 0;
              height: 0;
             }

             /* IMAGE STYLES */
             [type=radio]+span.date {
              cursor: pointer;
             }
            .date {
              padding: 6%;
    background-color: #f8fbf8;
    color: #0e0101;
    border-radius: 5px;
    box-shadow: 0px 0px 1px grey;
        padding-left: 10%;
    padding-right: 10%;

            }

            .date:hover {
              padding: 6%;
    background-color: #f8fbf8;
    color: #0e0101;
    border-radius: 5px;
    box-shadow: 0px 0px 1px grey;
        padding-left: 10%;
    padding-right: 10%;

            }
             /* CHECKED STYLES */
             [type=radio]:checked+span.date {
    border-radius: 10px !important;
    background-color: red;
    color: white;
             }

             </style>
             <div class="row">
              <br>
                <div class="col-xs-6 col-sm-6" style="padding-right: 1%;">
                <label style="width: 100%;text-align: center;">
                <input type="radio" name="START_DATE" id="SUBSCRIDATE" value="<?php 
                $current_date = date("d");
                $nextdate = 1;
                if($current_date > 15) {
                  $nextmonth = date("M", strtotime("+1 month"));
                  $month = date("m");
                  if($month == 12){
                    $nextyear = date("Y", strtotime("+1 year"));
                  } else {
                    $nextyear = date("Y");
                  }
                } else {
                  $nextmonth = date("M");
                  $month = date("m");
                  if($month = 12){
                    $nextyear = date("Y", strtotime("+1 year"));
                  } else {
                    $nextyear = date("Y");
                  }
                }

                echo "$nextdate $nextmonth, $nextyear";
                ?>">
                <span class="date"><?php 
                $current_date = date("d");
                $nextdate = 1;
                if($current_date > 15) {
                  $nextmonth = strtoupper(date("M", strtotime("+1 month")));
                  $month = date("m");
                  if($month == 12){
                    $nextyear = date("Y", strtotime("+1 year"));
                  } else {
                    $nextyear = date("Y");
                  }
                } else {
                  $nextmonth = strtoupper(date("M"));
                  $month = date("m");
                  if($month == 12){
                    $nextyear = date("Y", strtotime("+1 year"));
                  } else {
                    $nextyear = date("Y");
                  }
                }
                echo "$nextdate $nextmonth, $nextyear";
                ?></span>
               </label>
             </div>
             <div class="col-xs-6 col-sm-6" style="padding-left: 1%;">
               <label style="width: 100%;text-align: center;">
                <input type="radio" name="START_DATE" value="<?php 
                $current_date = date("d");
                $nextdatef = 15;
                if($current_date < 15) {
                  $nextmonthf = date("M");
                  $month = date("m");
                  if($month == 12){
                    $nextyearf = date("Y", strtotime("+1 year"));
                  } else {
                    $nextyearf = date("Y");
                  }
                } else {
                  $nextmonthf = date("M", strtotime("+1 month"));
                  $month = date("m");
                  if($month == 12){
                    $nextyearf = date("Y", strtotime("+1 year"));
                  } else {
                    $nextyearf = date("Y");
                  }
                }

                echo "$nextdatef $nextmonthf $nextyearf";
                ?>" required="">
                <span class="date"><?php 
                $current_date = date("d");
                $nextdatef = 15;
                if($current_date < 15) {
                  $nextmonthf = strtoupper(date("M"));
                  $month = date("m");
                  if($month == 12){
                    $nextyearf = date("Y", strtotime("+1 year"));
                  } else {
                    $nextyearf = date("Y");
                  }
                } else {
                  $nextmonthf = strtoupper(date("M", strtotime("+1 month")));
                  $month = date("m");
                  if($month == 12){
                    $nextyearf = date("Y", strtotime("+1 year"));
                  } else {
                    $nextyearf = date("Y");
                  }
                }

                echo "$nextdatef $nextmonthf $nextyearf";
                ?></span>
               </label>
             </div>
             <div class="col-xs-12 col-sm-12">
              <br>
             <p><small>New Subscription will Starts Only from 1st and 15th Day of the Month.</small></p>
           </div>
           </div>
        <hr>
       </td>
      </tr>

      <tr>
       <td colspan="2">
        <h5>Payment Plan</h5>
        <label><input type='text' name='payment_cycle' VALUE="Monthly Billings" hidden=""> Monthly Bills (25 Days)</label><br>
        <p>Your Subscription Bill is auto generated on Monthly Bases. You can check your Monthly Bills at Billing & Payments Section.</p>
       </td>
      </tr>
        <input type='text' name='payment_mode' VALUE="Cash or Online" hidden=""> 
      <?php if(isset($_SESSION['customer_id'])){ ?>
      <tr>
       <td colspan="2">
        <hr>
        <h5>Delivery Address
         <a href='address.php' class='btn-link float-right'>Edit Address<br></a><br>
        </h5>
        <textarea rows="4" name='delivery_address' class='form-control'><?php echo $delivery_address;?></textarea>
       </td>
      </tr>
      <?php } else { } ?>
      <tr>
       <td colspan="2">
        <div class="form-group float-right">
         <br>
         <?php
                  if (isset($_SESSION['customer_id'])) { ?>
        <p id='TimeNotSELE' style="font-size: 14px;
    color: red;
    font-weight: 600;"></p>
         <button class="btn btn-success btn-md" type="Submit" onclick="validateform()" name="SUBSCRIBE" value="SUBSCRIBE">Subscribe Now</button>
         <?php } else { ?>
         <a href="login.php?go_url=<?php echo get_url();?>" class="btn btn-info btn-sm text-right"> <i
           class="fa fa-arrow-left"></i> Login &
          Subscribe </a>
         <?php }
                  ?>


        </div>
       </td>
      </tr>
      <tr>
       <td colspan="2">
        <p><code>*</code> Feel free to Subscribe with us. You can pause or continue it as per your need.</p>
       </td>
      </tr>
     </table>

    </form>
   </div>
  </div>
 </section>

<?php } ?>
 <hr style='width:50%;'><br><br><br>

<script type="text/javascript">
 function validateform() {
   var x = document.getElementById("SUBSCRIDATE").checked;
   if(x == false){
    var msg = "<i class='fa fa-warning'></i> Please Select Subscription Start Date...";
    document.getElementById("TimeNotSelected").innerHTML = msg;
    document.getElementById("TimeNotSELE").innerHTML = "Start Date Not Selected";
   }
}

</script>

 <script type="text/javascript">
 function show1() {
  document.getElementById('div1').style.display = 'none';
 }

 function show2() {
  document.getElementById('div1').style.display = 'block';
 }
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

</html>
