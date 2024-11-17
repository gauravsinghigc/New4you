<?php require 'files.php'; ?>
<!DOCTYPE html>
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

        <!-- header part end -->
        <section class="container-fluid pb-2">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left: 1%; padding-right: 1%;">
                    <h6>
                        <?php

     if (isset($_GET['id'])) {
      $id = $_GET['id'];
      echo "<span style='font-size: 4.5vw;
    font-weight: 600;'><i class='fa fa-calendar text-success'></i> SUBSID : $id</span>";
     } else {
      header("location: home.php?note=Invalid Subscription!");
     }
     $sql = "SELECT * FROM customer_subscriptions where customer_subscription_id='$id'";
     $query = mysqli_query($con, $sql);
     $fetch = mysqli_fetch_assoc($query);
     $SUBS_APPLY_DATE = $fetch['SUBS_APPLY_DATE'];
     $customer_id = $fetch['customer_id'];
     $store_id = $fetch['store_id'];
     $status = $fetch['SUBSCRIPTION_STATUS'];
     $delivery_address = $fetch['delivery_address'];
     $customer_subscription_id = $fetch['customer_subscription_id'];

     $start_date = $fetch['SUBS_START_DATE'];
                $SUBS_START_DATE = $start_date;

     if ($store_id == null) { ?>
                        <meta http-equiv="refresh" content="1, home.php?note=No Subscription Found!" />
                        <?php }
     ?><br>
                        Req Date : <?php echo $SUBS_APPLY_DATE; ?><br>
                        Start Date : <?php echo $SUBS_START_DATE;?><br>
                        <?php

      if ($status == "ACTIVE") { ?>
                        <span class="text-success">Status : <?php echo $status; ?> <small style="    font-size: 10px;
">(Delivery Active)</small></span>
      <?php } else { ?>
<span style="color: red;">Status : <?php echo $status; ?> <small style="    font-size: 10px;
">(Delivery Pause)</small></span>
       <?php } ?>
                    </h6>
                    <?php

      if ($status == "ACTIVE") { ?>
                    <a href="update.php?subs_deactivate=<?php echo $customer_subscription_id; ?>&cr_url=<?php echo get_url(); ?>&action=PAUSE"
                        class='btn btn-sm btn-warning float-right mb-2' style='float:right;margin-bottom: 2%;
        margin-top: -12vw;background-color: #008000a6;font-family: none;'><i class="fa fa-pause"></i></a>
                    <?php } elseif ($status == "CANCEL") { ?>
                    <a href="" class='btn btn-sm text-danger float-right' style='float:right;'>Cancelled</a>
                    <?php } else { ?>
                        <span>
                    <a href="update.php?subs_deactivate=<?php echo $customer_subscription_id; ?>&cr_url=<?php echo get_url(); ?>&action=ACTIVE"
                        class='btn btn-sm btn-info' style='margin:1%;background: red;float:right;margin-bottom: 2%;
        margin-top: -12vw;'><i class="fa fa-play"></i></a>
</span>
                    <?php } ?>

                </div>
            </div>
        </section>

        <section class="container-fluid pb-2">

            <?php
 $subscribe_id = $_GET['id'];
 $sql = "SELECT * FROM subscription_products  where customer_subscription_id='$customer_subscription_id'";
 $query =  mysqli_query($con, $sql);
 while($fetch = mysqli_fetch_assoc($query)){
   $product_type = $fetch['product_type'];
   $subs_refrenece_id = $fetch['subs_refrenece_id'];
   $product_name = $fetch['product_name'];
   $product_tags = $fetch['product_tags'];
   $product_qty = $fetch['product_quantity'];
   $product_img= $fetch['product_img'];
   $product_units = "$product_tags";
    $letters = preg_replace('/[0-9\.]/','', "$product_tags");
    $numbers = preg_replace("/[^0-9\.]/", '', "$product_tags");
    $Quantity = $product_qty;
    $qty = $Quantity/$numbers;
    if($Quantity >= 1000 and $letters = "GM"){
      $Quantity = $Quantity/1000;
      $letters = "KG";
    }  else {
      $Quantity = $Quantity;
      $letters = $letters;
    }

 ?>
            <div class="col-12 col-md-12" style="padding-right:1%; padding-left:1%;">
                <div class="row" style="padding:2%;box-shadow:0px 0px 1px grey; border-radius:5px;">
                    <div class="col-sm-4 col-xs-4" style='padding:2%; box-shadow:0px 0px 1px grey;'>
                        <img src="<?php echo $admin_url;?>/img/store_img/<?php echo $product_img;?>" class=' img-fluid text-center'
                            style='width: 100%;'>
                    </div>
                    <div class="col-sm-8 col-xs-8">
                        <p style="color: black; font-size: 12px;margin-top:-8px;"><br>
                            <span style='font-size:14px !important;'><?php echo $product_name; ?></span>
                            <?php 
                             if($product_type == "ADD_ON"){ ?>
                            <span>
                                <a href="delete.php?subs_items_delete=<?php echo $subs_refrenece_id;?>&id=<?php echo $subscribe_id;?>"
                                    class="btn btn-outline-danger btn-sm float-right"> <i class='fa fa-trash'></i> </a>
                            </span>
                            <?php }
                            ?><br>
                            <b style="font-size: 14px; color: green;"><i class="fa fa-inr"></i>
                                <?php echo $fetch['product_offer_price']; ?> /
                                <?php echo $fetch['product_tags']; ?></b><br>
                            <b>Quantity: <?php echo $Quantity;?> <?php echo $letters;?> </b><br>
                            Total Price : <i class="fa fa-inr"></i><?php echo $fetch['product_offer_price']; ?> x
                            <?php echo $fetch['product_quantity'];?> = <i class="fa fa-inr"></i>
                            <?php echo $fetch['product_offer_price']*$fetch['product_quantity'];?>
                        </p>


                        <table style="width: 133px;">
          <tr>
            <td>
              <form action='update.php' method='POST' class="float-right">
        <input type="text" name="subs_refrenece_id" value="<?php echo $id; ?>" hidden="">
        <input type="text" name="quantity" value="<?php echo $fetch['product_quantity']; ?>" hidden="">
        <input type="text" name="product_offer_price" value="<?php echo $fetch['product_offer_price']; ?>" hidden="">
        <input type="text" name="product_mrp_price" value="<?php echo $fetch['product_mrp_price'];?>" hidden="">
        <input type="submit" name="DECREASE_SUBS_ITEMS" class="btn btn-info btn-sm float-right text-white" value="-"
         style="padding: 0px 8px 0px 7px !important;font-size: 14px;" />
       </form>
            </td>
            <td>
              <input type='text' min='1' max='10' value='<?php echo $fetch['product_quantity']; ?>' style='width: 30px !important;
    padding: 0px 0px 3px 8px !important;
    box-shadow: 0px 0px 1px grey;
    height: 23px;' id="number">
            </td>
            <td>
               <form action='update.php' method='POST'>
        <input type="text" name="subs_refrenece_id" value="<?php echo $id; ?>" hidden="">
        <input type="text" name="quantity" value="<?php echo $fetch['product_quantity']; ?>" hidden="">
        <input type="text" name="product_offer_price" value="<?php echo $fetch['product_offer_price']; ?>" hidden="">
        <input type="text" name="product_mrp_price" value="<?php echo $fetch['product_mrp_price'];?>" hidden="">
        <input type="submit" name="INCREASE_SUBS_ITEMS" class="btn btn-info btn-sm float-left text-white" value="+"
         style="padding: 0px 8px 0px 7px !important;font-size: 14px;" />
       </form>

            </td>
          </tr>
        </table>
                    </div>
                    <div class="col-xs-12 col-sm-12" style="padding: initial;
    margin-top: 5vw;">
                  <small>(You can change Item Quantity in This Subscription as per your requirements.)</small>
                </div>
                </div>
                
            </div>

            <?php } ?>


            <div class="row">
                <div class="col-12 col-lg-12" style="padding-right:1%; padding-left:1%;">
                    <br>
                    <h5 style="font-size: 4vw"><b><i class="fa fa-calendar"></i> Subscription Plan</b></h5>
                    <p>Item will be Delivered Daily.</p>
                    <hr style='margin-top:0px; margin-bottom:0px;'>
                </div>
            </div>

            <div class="row mt-0">
                <div class="col-12 col-lg-12" style="padding-right:1%; padding-left:1%;">
                    <h5>
                        <a href='subs_billings.php?id=<?php echo $id; ?>' class='btn btn-info btn-sm float-right' style='padding: 1.3%;float: right; background: green;padding-left: 4%;
    background: green;
    padding-right: 4%;'> <i class="fa fa-inr"></i> View Payments</a>
                        <b><i class="fa fa-inr"></i> Payments</b>
                    </h5>

                        <?php
     $select = "SELECT sum(product_total_price) FROM subscription_products where customer_subscription_id='$subscribe_id'";
     $action = mysqli_query($con, $select);
     while ($record = mysqli_fetch_assoc($action)) {
       $total_amount = $record['sum(product_total_price)'];
     }

     $sql = "SELECT * FROM customer_subscription_payments where customer_subscription_id='$id'";
     $query =  mysqli_query($con, $sql);
     $fetch = mysqli_fetch_assoc($query); ?>
                        <?php
     $payment_cycle = $fetch['payment_cycle'];
     $payment_mode = $fetch['payment_mode'];
     ?>

                   <table style="width: 100%;font-size: 14px;margin-top: 10%;">
                     <tr>
                       <th>Net Payable Amount</th>
                       <td><span class='text-success' style='font-size:20px;float: right'><i
                                class='fa fa-inr'></i>
                            <?php echo $total_amount;?><small> (<?php echo $Quantity;?> <?php echo $letters;?>) </small></span></td>
                     </tr>
                     <tr>
                       <th>Payment Cycle</th>
                       <td><span style="float: right;"> <?php echo $payment_cycle; ?></span></td>
                     </tr>
                     <tr>
                       <th>Payment Mode</th>
                       <td><span style="float: right;"><?php echo $payment_mode; ?></span></td>
                     </tr>
                   </table>
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-12" style="padding-right:1%; padding-left:1%;">
                    <h5><b><i class="fa fa-map-marker"></i> Delivery Address</b></h5>
                    <p><?php echo $delivery_address;?></p>
                    <hr>

                    <p><b class="text-danger">Note <i class="fa fa-angle-right"></i></b> For Cancellation or Have any query feel free to contact us. 
                      <span style="float: right;
    padding: 2%;
    background-color: #0076bf;
    border-radius: 24px;
    color: white !important;"><a href="tel:<?php echo $store_phone;?>" style="color: white;"><i class="fa fa-phone-square-alt"></i> <?php echo $store_phone;?></a></span></p>
                </div>
            </div>



            <?php
  $sql = "SELECT * from subscription_deliveries where customer_subscription_id='$id'";
  $query = mysqli_query($con, $sql);
  $count_del = mysqli_num_rows($query);
  if ($count_del == 0) { ?>
            <div class="row">
                <div class="col-lg-12 col-12" style="padding-right:1%; padding-left:1%;">
                    <h5>Delivered Items</h5>
                </div>
            </div>
            <div class="col-lg-12 col-12" style="padding-right:1%; padding-left:1%;">
                <div class="row" style='box-shadow:0px 0px 1px grey; border-radius:10px;'>
                    <div class="col-sm-2 col-xs-2" style='padding-top:5%;box-shadow:0px 0px 1px grey;border-radius:10px;'>
                        <i class='fa fa-truck text-center text-succcess' style='width: 100%;font-size:40px;'></i>
                    </div>
                    <div class="col-xs-10 col-sm-10">
                        <p style="color: black; font-size: 12px;">
                            <h3>No Item Delivered!</h3>
                        </p>
                    </div>
                </div>
            </div>

            <?php } else { ?>
            <div class="row">
                <div class="col-lg-12 col-12" style="padding-right:1%; padding-left:1%;">
                    <h5>Delivered Items
                        <span class='float-right'>Total Delivery : <?php echo $count_del;?></span></h5>
                </div>
            </div>
            <?php
   while ($fetch = mysqli_fetch_assoc($query)) { ?>
            <div class="col-lg-12 col-12" style="padding-right:1%; padding-left:1%;">
                <div class="row" style='box-shadow:0px 0px 1px grey; border-radius:10px;'>
                    <div class="col-2" style='padding-top:4.5%;box-shadow:0px 0px 1px grey;border-radius:10px;'>
                        <i class='fa fa-truck text-center text-succcess' style='width: 100%;font-size:25px;'></i>
                    </div>
                    <div class="col-10" style='padding:2%;'>
                        <p style="color: black; font-size: 12px;">
                            <span>Delivered On: <?php echo $fetch['delivery_date']; ?></span><br>
                            <span style='font-size:14px !important;'><?php echo $product_name; ?></span> <br>
                            Quantity : <?php echo $fetch['delivered_quantity']; ?><br>
                            Payment : <i class='fa fa-inr'></i> <?php echo $fetch['payment_amount']; ?>
                            <span class="float-right">Status: <?php echo $fetch['delivery_status']; ?></span><br>
                            <span>Pay Mode : <?php echo $fetch['payment_mode'];?></span><br>
                            <span>Payment Status : <?php echo $fetch['payment_status'];?></span>

                        </p>
                    </div>
                </div>
            </div>

            <?php }
  } ?>
            <br>
            <hr>
            <br><br>


            </div>
        </section>


        <?php if (isset($_GET['note'])) {
    $msg = $_GET['note'];
 ?>

        <div class="modal fade bd-example-modal-lg theme-modal newsletter-popup" id="exampleModal" tabindex="-1"
            role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content" style='border-radius: 20px;'>
                    <div class="modal-body" style='background-image:none;border-radius:20px;'>
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="modal-bg">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <div class="offer-content text-center">
                                            <img src='img/full-width-white.png' style='width:100px;'>
                                            <h4 style='text-transform:none;'><?php echo $msg;?>
                                            </h4>

                                            <a class='text-center' data-dismiss="modal">
                                                <button type="submit" class="btn btn-solid text-center"
                                                    id="mc-submit">Close</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
<br><br><br>
</div>

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