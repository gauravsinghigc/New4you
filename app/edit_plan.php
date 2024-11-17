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
                <div class="col-md-12">
                    <h6>Change Subscription Plan <i class="fa fa-angle-right"></i><br>
                        SUBS ID : <?php echo $_GET['id'];?> <br>
                        <?php if(isset($_GET['msg'])){
       $msg = $_GET['msg'];
       echo "<br><br><b class='text-success'>$msg</b>";
      } ?></h6>
                    <?php 
        $subscription_id = $_GET['id'];
        $sql = "SELECT * FROM "
     ?>
                    <p></p>
                </div>
            </div>
        </section>

        <section class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <form style='width:100%;' action="insert.php" method="POST" enctype="multipart/form-data">
                        <input type='text' name="product_title" value="<?php echo $fetch['product_title']; ?>" hidden>
                        <input type='text' name="product_tags" value="<?php echo $fetch['product_tags']; ?>" hidden>
                        <input type='text' name="product_offer_price"
                            value="<?php echo $fetch['product_offer_price']; ?>" hidden>
                        <input type='text' name="product_mrp_price" value="<?php echo $fetch['product_mrp_price']; ?>"
                            hidden>
                        <input type='text' name="store_id" value="<?php echo $store_id; ?>" hidden>
                        <table style="width:100%;">

                            <tr>
                                <td colspan="2">
                                    <hr>
                                    <h6>Subscribe for </h6>

                                    <div class="form-group">
                                        <label class="container">
                                            <input type="radio" name="SUBSCRIBE_PLAN_TYPE" Value="CUSTOMDAYS"
                                                required="" onclick="show1();" />
                                            <span class="checkmark"></span>Custom Days</label>
                                        <style>
                                        .date_time_week li {
                                            font-size: 12px !important;
                                            border-radius: 5px;
                                            padding: 1%;
                                            box-shadow: 0px 0px 1px grey;
                                            border-radius: 5px;
                                            margin: 1%;
                                        }

                                        .inout_date {
                                            padding: 1%;
                                            box-shadow: 0px 0px 1px grey;
                                            border-radius: 5px;
                                            font-size: 12px;
                                        }

                                        .inout_date:visited {
                                            padding: 1%;
                                            box-shadow: 0px 0px 1px red !important;
                                            border-radius: 5px;
                                            font-size: 12px;
                                        }

                                        .container {
                                            display: block;
                                            position: relative;
                                            padding-left: 35px;
                                            margin-bottom: 12px;
                                            cursor: pointer;
                                            font-size: 22px;
                                            -webkit-user-select: none;
                                            -moz-user-select: none;
                                            -ms-user-select: none;
                                            user-select: none;
                                        }

                                        /* Hide the browser's default radio button */
                                        .container input {
                                            position: absolute;
                                            opacity: 0;
                                            cursor: pointer;
                                        }

                                        /* Create a custom radio button */
                                        .checkmark {
                                            position: absolute;
                                            top: 0;
                                            left: 0;
                                            height: 25px;
                                            width: 25px;
                                            background-color: #eee;
                                            border-radius: 50%;
                                        }

                                        /* On mouse-over, add a grey background color */
                                        .container:hover input~.checkmark {
                                            background-color: #ccc;
                                        }

                                        /* When the radio button is checked, add a blue background */
                                        .container input:checked~.checkmark {
                                            background-color: #2196F3;
                                        }

                                        /* Create the indicator (the dot/circle - hidden when not checked) */
                                        .checkmark:after {
                                            content: "";
                                            position: absolute;
                                            display: none;
                                        }

                                        /* Show the indicator (dot/circle) when checked */
                                        .container input:checked~.checkmark:after {
                                            display: block;
                                        }

                                        /* Style the indicator (dot/circle) */
                                        .container .checkmark:after {
                                            top: 5px;
                                            left: 5px;
                                            width: 15px;
                                            height: 15px;
                                            border-radius: 50%;
                                            background: white;
                                        }

                                        .hide {
                                            display: none;
                                        }

                                        </style>
                                        <?php
                  $count_1 = 1;
                  while ($count_1 < 8) { ?>
                                        <label class="inout_date">
                                            <input type='checkbox' name="CUSTOMDAYS[]" value="<?php $day = date("d-M-Y", strtotime("+$count_1 days"));
                                                                      echo strtoupper($day); ?>" checked>
                                            <span style='font-size: 12px;'>
                                                <?php
                        $day = date("D", strtotime("+$count_1 days"));
                        echo strtoupper($day);
                        ?>
                                            </span>
                                        </label>
                                        <?php $count_1++;
                  } ?>
                                    </div>


                                    <hr>
                                    <div class="form-group date_time_week">
                                        <label class="container">
                                            <input type="radio" name="SUBSCRIBE_PLAN_TYPE" Value="WEEKENDS_PLAN"
                                                onclick="show1();" />
                                            <span class="checkmark"></span>Only for Weekends (Sat & Sun)</label>
                                        <label class="inout_date">
                                            <input type='checkbox' name="WEEKENDS_PLAN_DAYS[]" value="<?php
                                                                              $search_days = 1;
                                                                              while ($search_days < 8) {
                                                                                $running_dates = date("d-M-Y", strtotime("+$search_days days"));
                                                                                $running_days = date("D", strtotime("+$search_days days"));
                                                                                if ($running_days == "Sat") {
                                                                                  echo strtoupper($running_dates);
                                                                                }
                                                                                $search_days++;
                                                                              }
                                                                              ?>
          " checked>
                                            <span style='font-size: 12px;'>SAT</span>
                                        </label>

                                        <label class="inout_date">
                                            <input type='checkbox' name="WEEKENDS_PLAN_DAYS[]" value="<?php
                                                                              $search_days = 1;
                                                                              while ($search_days < 8) {
                                                                                $running_dates = date("d-M-Y", strtotime("+$search_days days"));
                                                                                $running_days = date("D", strtotime("+$search_days days"));
                                                                                if ($running_days == "Sun") {
                                                                                  echo strtoupper($running_dates);
                                                                                }
                                                                                $search_days++;
                                                                              }

                                                                              ?>" checked>
                                            <span style='font-size: 12px;'>
                                                SUN</span>
                                        </label>
                                    </div>

                                    <hr>
                                    <div class="form-group">
                                        <label class="container">
                                            <input type="radio" name="SUBSCRIBE_PLAN_TYPE" Value="DAILY_PLAN"
                                                onclick="show2();" />
                                            <span class="checkmark"></span>Daily
                                        </label>
                                        <p>Item will be delivered on Daily Bases. You can cancel anytime complete plan
                                            or skip some days when ever you
                                            want till one day before delivery.</p>
                                    </div>
                                    <hr>
                                </td>
                            </tr>

                           
                            <tr>
                                <td colspan="2">
                                    <div class="form-group float-right">
                                        <br>
                                        
                                        <button class="btn btn-success btn-md" type="Submit" name=""
                                            value="">Change Plan</button>
                                        
                                        

                                    </div>
                                </td>
                            </tr>
                            
                        </table>

                    </form>
                </div>
            </div>
        </section>
    </div>
        <hr style='width:50%;'><br><br><br>



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