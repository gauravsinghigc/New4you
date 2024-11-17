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
        <style>
        div.scrollmenu {
            background-color: white;
            overflow: auto;
            color: black;
            white-space: nowrap;
        }

        div.scrollmenu a {
            display: inline-block;
            color: black;
            text-align: center;
            padding: 2%;
            font-size: 13px;
            text-decoration: none;
            box-shadow: 0px 0px 1px grey;
            margin-top: 1%;
            margin-bottom: 1%;
            border-radius: 10px;
            margin: 1%;
        }

        div.scrollmenu a:hover {
            background-color: white;
            color: red !important;
            box-shadow: 0px 0px 1px red !important;
        }

        </style>
        <!-- header part end -->
        <section class="container-fluid pb-2">
            <div class="row">
                <div class="col-md-12">
                    <h5>Payments <i class="fa fa-angle-right"></i></h5>
                </div>
            </div>
        </section>

        <section class="container-fluid pb-0 pt-0">
            <div class="row">
                <div class="col-lg-12 col-12 col-md-12" style='padding-left:0px; padding-right:0px;'>
                    <div class="scrollmenu">
                        <a href="subs_billings.php" <?php
                                 if (isset($_GET['type'])) {
                                  echo $shadow = "";
                                 } else {
                                  echo $shadow = "style='box-shadow:0px 0px 2px red;font-weight: 600;'";
                                 }
                                 ?>> ALL Payments</a>
                        <a href="?type=Paid" <?php
                                if (isset($_GET['type'])) {
                                 $day = $_GET['type'];
                                 if ($day == "Paid") {
                                  echo $shadow = "style='box-shadow:0px 0px 2px red;font-weight: 600;'";
                                 } else {
                                  $shadow = "";
                                 }
                                }
                                ?>> Paid</a>
                        <a href="?type=unpaid" <?php
                              if (isset($_GET['type'])) {
                               $day = $_GET['type'];
                               if ($day == "unpaid") {
                                echo $shadow = "style='box-shadow:0px 0px 2px red;font-weight: 600;'";
                               } else {
                                $shadow = "";
                               }
                              }
                              ?>>Unpaid</a>

                    </div>
                </div>
            </div>
        </section>
        <section class="container-fluid pb-2">
            <div class="row">
                <?php
   if (!isset($_SESSION['customer_id'])) { ?>
                <div class="col-md-12 col-12">
                    <center>
                        <img src="img/blank.png" style="width: 100%;">
                        <h4>No Payments</h4>
                        <a href="login.php" class="btn btn-info btn-sm"><i class="fa fa-angle-left"></i> Login to View
                            Payments</a>
                    </center>
                </div>
                <?php } else {
    $customer_id = $_SESSION['customer_id'];
    if (isset($_GET['type'])) {
     $type = $_GET['type'];
     $sql = "SELECT * FROM customer_subscription_billings where customer_id='$customer_id' and payment_status='$type' ORDER BY billing_ref_id DESC";
    } elseif(isset($_GET['id'])){
      $id = $_GET['id'];
      $sql = "SELECT * FROM customer_subscription_billings where customer_id='$customer_id' and customer_subscription_id='$id' ORDER BY billing_ref_id DESC";
    } else {
     $sql = "SELECT * FROM customer_subscription_billings where customer_id='$customer_id' ORDER BY billing_ref_id DESC";
    }
    $query = mysqli_query($con, $sql);
    $count = mysqli_num_rows($query);
    if ($count == 0) { ?>
                <div class="col-md-12 col-12">
                    <center>
                        <img src="img/blank.png" style="width: 100%;">
                        <h4>No Transactions Found</h4>
                        <a href="subs_orders.php" class="btn btn-info btn-sm"><i class="fa fa-angle-left"></i> View
                            Subscriptions</a>
                    </center>
                </div>
                <?php } else { ?>
                <table style='width:100%; padding:1%;'>
                    <?php
                while ($fetch = mysqli_fetch_assoc($query)) {
                  $billing_ref_id = $fetch['billing_ref_id']; 
                  $billing_date = $fetch['billing_date'];
                  $payment_status = $fetch['payment_status'];
                  $payment_note = $fetch['payment_note'];
                  $payment_mode = $fetch['payment_mode'];
                  $payment_amount = $fetch['payment_amount'];
                  $SUBS_id = $fetch['customer_subscription_id'];?>
                    <tr style='padding:2%;'>
                        <td style='width:10%;'><img src='img/paid.png' style='width:100%;margin-top:-15px;'></td>
                        <td>
                            <p style='font-size:14px;padding:2%;margin-bottom:2%;'>
                                SUBS ID: <?php echo $SUBS_id;?><br>
                                <span class='float-right'>REF ID: <?php echo $billing_ref_id;?></span>
                                Paid On:<?php echo $billing_date;?><br>
                                Payment Mode: <?php echo $payment_mode;?><br>
                                Payment Status: <?php echo $payment_status;?><br>
                                Payment Note: <?php echo $payment_note;?>
                                <span class='float-right' style='font-size:20px;margin-top:-25px;color:green;'><i
                                        class='fa fa-inr'></i>
                                    <?php echo $payment_amount;?></span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=3>
                            <hr style='margin-bottom: 1%;
    margin-top: 1%;width:97%;'>
                        </td>
                    </tr>


                    <?php }
    } ?>
                </table>
                <?php } ?>
            </div><br><br><br>
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