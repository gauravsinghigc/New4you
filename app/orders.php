<?php require 'files.php'; require 'session.php'; ?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php';?>

  <!-- header part end -->
  <br>
  <section class="container-fluid pb-1">
   <div class="row">
    <div class="col-sm-12 col-xs-12 bg-success p-1">
     <h4 class="font-7 text-white"><i class="fa fa-shopping-cart"></i> My Orders <i class="fa fa-angle-right"></i>
      <?php if(isset($_GET['type'])){ $type = $_GET['type'];
							$typeview = str_replace('_', ' ', $type);
							echo $typeview; } else { } ?></h4>
    </div>
   </div>
  </section>

  <?php CreateSlider("ORDERS");?><br>

  <section class="container-fluid pb-2 pt-0" style="margin-top: -3%;">
   <div class="row">
    <div class="col-sm-12 col-xs-12" style='padding-left:0px; padding-right:0px;'>
     <div class="scrollmenu">
      <a href="orders.php" class="font-6 rouded circle" <?php
                                          if (isset($_GET['type'])) {
                                             echo $shadow = "";
                                          } else {
                                             echo $shadow = "style='box-shadow:0px 0px 2px red;font-weight: 600;'";
                                          }
                                          ?>> ALL Orders</a>
      <a href="?type=NEW_ORDER" class="font-6 rouded circle" <?php
                                          if (isset($_GET['type'])) {
                                             $day = $_GET['type'];
                                             if ($day == "NEW_ORDER") {
                                                echo $shadow = "style='box-shadow:0px 0px 2px red;font-weight: 600;'";
                                             } else {
                                                $shadow = "";
                                             }
                                          }
                                          ?>> New Order</a>
      <a href="?type=ACCEPTED" class="font-6 rouded circle" <?php
                                          if (isset($_GET['type'])) {
                                             $day = $_GET['type'];
                                             if ($day == "ACCEPTED") {
                                                echo $shadow = "style='box-shadow:0px 0px 2px red;font-weight: 600;'";
                                             } else {
                                                $shadow = "";
                                             }
                                          }
                                          ?>> Accepted</a>
      <a href="?type=OUT_FOR_DELIVERY" class="font-6 rouded circle" <?php
                                          if (isset($_GET['type'])) {
                                             $day = $_GET['type'];
                                             if ($day == "OUT_FOR_DELIVERY") {
                                                echo $shadow = "style='box-shadow:0px 0px 2px red;font-weight: 600;'";
                                             } else {
                                                $shadow = "";
                                             }
                                          }
                                          ?>> OUT FOR DELIVERY</a>
      <a href="?type=DELIVERED" class="font-6 rouded circle" <?php
                                             if (isset($_GET['type'])) {
                                                $day = $_GET['type'];
                                                if ($day == "DELIVERED") {
                                                   echo $shadow = "style='box-shadow:0px 0px 2px red;font-weight: 600;'";
                                                } else {
                                                   $shadow = "";
                                                }
                                             }
                                             ?>>DELIVERED</a>
      <a href="?type=Rejected" class="font-6 rouded circle" <?php
                                             if (isset($_GET['type'])) {
                                                $day = $_GET['type'];
                                                if ($day == "Rejected") {
                                                   echo $shadow = "style='box-shadow:0px 0px 2px red;font-weight: 600;'";
                                                } else {
                                                   $shadow = "";
                                                }
                                             }
                                             ?>>Rejected</a>
     </div>
    </div>
   </div>
  </section>

  <section class="container-fluid pb-2">
   <div class="row">
    <?php
         if (!isset($_SESSION['customer_id'])) { ?>
    <meta http-equiv="refresh" content="0, index.php" />
    <?php }
         $customer_id = $_SESSION['customer_id'];
         if(isset($_GET['type'])){
               $type= $_GET['type'];
            $sql = "SELECT * FROM customer_orders where customer_id='$customer_id' and order_status='$type' ORDER BY customer_order_id DESC ";
         } else {
            $sql = "SELECT * FROM customer_orders where customer_id='$customer_id' ORDER BY customer_order_id DESC ";
         }

         $query = mysqli_query($con, $sql);
         $count = mysqli_num_rows($query);
         if ($count == 0) { ?>
    <div class="col-sm-12 col-xs-12 mt-4">

     <center>
      <img src="img/noresult.gif" style='width:45%;border-radius: 500px;box-shadow: 0px 0px 0.5px grey;' class="d-block mx-auto">

      <h4>No Orders</h4>
      <a href="index.php" class="btn btn-info btn-block fixed-bottom bottom-text bottom-p text-white"><i class="fa fa-angle-left"></i> Buy
       Products</a>
     </center>
    </div>
    <?php } else {
            while ($fetch = mysqli_fetch_assoc($query)) {
                  $del_charge = $fetch['delivery_charge'];
                  $order_price = $fetch['total_amount_after_discount'];

            ?>

    <div class="col-xs-12 col-sm-12 mb-2 bg-white">
     <div class="row" style="padding:2%; border-radius:5px;">
      <div class="col-sm-2 col-xs-2 col-2 bg-grey" style='padding:1%;border-radius: 10px'>
       <img src='img/referral-icon2.png' class='img-fluid text-center' style='margin-top: 7%;'>
      </div>
      <div class="col-sm-10 col-xs-10 col-10 bg-white pr-0">
       <a href="order_details.php?id=<?php echo $fetch['order_id']; ?>">
        <h6 class="text-left font-3" style="margin-bottom: 3%;margin-top: 1%;">ID# <?php echo $fetch['order_id']; ?> </h6>
        <p style="color: black; font-size: 2.5vw;margin-bottom: 0px;margin-top: -3px;">Date : <?php echo $fetch['order_date']; ?><br>
         <div style="width: 30%;
    height: 0px;
    margin-top: 9px;
    margin-bottom: -12px;"><b style="font-size: 3.5vw;
    color: green;
    background-color: #ece9e978;
    padding: 5%;
    border-radius: 20px;
    padding-left: 13%;
    padding-right: 13%;
    box-shadow: 0px 0px 1px grey;"><i class="fa fa-inr mt-0"></i>
           <?php echo $fetch['net_payable_amount']; ?></b></div>
         <span class="float-right font-2 mb-1" style="margin-top: -9%;
    color: #020000;
    background-color: #ffffff;
    padding: 0.5%;
    padding-left: 2%;
    border-radius: 20px;
    padding-right: 2%;
    font-size: 10px !important;
    box-shadow: 0px 0px 1px grey;">
          <?php $order_status = $fetch['order_status']; $order_status = str_replace('_', ' ', $order_status); 
                    if($order_status == "NEW ORDER"){
                      echo "<i class='fa fa-star text-warning'></i> $order_status";
                    } elseif($order_status == "ACCEPTED") {
                      echo "<i class='fa fa-check-circle text-success'></i> $order_status";
                    } elseif($order_status == "OUT FOR DELIVERY"){
                      echo "<i class='fa fa-truck text-info'></i> $order_status";
                    } elseif($order_status == "REJECTED") {
                      echo "<i class='fa fa-times text-danger'></i> $order_status";
                    } elseif($order_status == "UNDELIVERED") {
                      echo "<i class='fa fa-times text-danger'></i> <i class='fa fa-truck text-info'></i> $order_status";
                    } elseif($order_status == "DELIVERED"){
                      echo "<i class='fa fa-check-circle text-success'></i> <i class='fa fa-truck text-info'></i> $order_status";
                    } else {
                      echo "<i class='fa fa-info text-danger'></i> $order_status";
                    }?></span>

         <a href="order_details.php?id=<?php echo $fetch['order_id']; ?>" class='btn btn-sm btn-success text-white float-right' style="margin-top: -5%; margin: 0.5%;"><i class="fa fa-list mt-0"></i>
          Details</a>
         <a href="track-order.php?order_id=<?php echo $fetch['order_id']; ?>" class='btn btn-sm btn-success text-white float-right' style="margin-top: -5%;margin: 0.5%;"><i
           class="fa fa-map-marker mt-0"></i> Track</a>
        </p>
       </a>
      </div>
     </div>
    </div>
    <?php }
         } ?>
   </div><br><br><br>
  </section>

  <?php GSI_footer_files();?>
 </body>

</html>
