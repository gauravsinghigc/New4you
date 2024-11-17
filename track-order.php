<?php require 'files.php'; ?>
<!DOCTYPE html>
<html>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <title><?php echo $store_name; ?> : Track Order</title>
 <?php include 'header_files.php'; ?>
 <style>
  fieldset {
   border: none !important;
  }

  ol.progtrckr {
   margin: 0;
   padding: 0;
   list-style-type none;
  }

  ol.progtrckr li {
   display: inline-block;
   text-align: center;
   line-height: 3.5em;
  }

  ol.progtrckr[data-progtrckr-steps="2"] li {
   width: 49%;
  }

  ol.progtrckr[data-progtrckr-steps="3"] li {
   width: 33%;
  }

  ol.progtrckr[data-progtrckr-steps="4"] li {
   width: 24%;
  }

  ol.progtrckr[data-progtrckr-steps="5"] li {
   width: 19%;
  }

  ol.progtrckr[data-progtrckr-steps="6"] li {
   width: 16%;
  }

  ol.progtrckr[data-progtrckr-steps="7"] li {
   width: 14%;
  }

  ol.progtrckr[data-progtrckr-steps="8"] li {
   width: 12%;
  }

  ol.progtrckr[data-progtrckr-steps="9"] li {
   width: 11%;
  }

  ol.progtrckr li.progtrckr-done {
   color: black;
   border-bottom: 4px solid yellowgreen;
  }

  ol.progtrckr li.progtrckr-failed {
   color: black;
   border-bottom: 4px solid #e20606;
  }

  ol.progtrckr li.progtrckr-todo {
   color: silver;
   border-bottom: 4px solid silver;
  }

  ol.progtrckr li:after {
   content: "\00a0\00a0";
  }

  ol.progtrckr li:before {
   position: relative;
   bottom: -2.5em;
   float: left;
   left: 50%;
   line-height: 1em;
  }

  ol.progtrckr li.progtrckr-done:before {
   content: "\2713";
   color: white;
   background-color: yellowgreen;
   height: 2.2em;
   width: 2.2em;
   line-height: 2.2em;
   border: none;
   border-radius: 2.2em;
  }

  ol.progtrckr li.progtrckr-failed:before {
   content: "X" !important;
   color: white;
   background-color: #e20606;
   height: 2.2em;
   width: 2.2em;
   line-height: 2.2em;
   border: none;
   border-radius: 2.2em;
  }

  ol.progtrckr li.progtrckr-todo:before {
   content: "\039F";
   color: silver;
   background-color: white;
   font-size: 2.2em;
   bottom: -1.2em;
  }
 </style>
</head>

<body>
 <?php
 include "header.php"; ?>
 <div class="breadcrumb-main ">
  <div class="container">
   <div class="row">
    <div class="col">
     <div class="breadcrumb-contain">
      <div>
       <h2>Track Orders</h2>
       <ul>
        <li><a href="index.php">Home</a></li>
        <li><i class="fa fa-angle-double-right"></i></li>
        <li><a href="javascript:void(0)">Track Orders</a></li>
       </ul>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
 <!-- breadcrumb End -->
 <section class="container-fluid">
  <div class="row">
   <div class="col-lg-6 col-md-6 col-sm-12 col-12 d-block mx-auto mt-4">
    <form action="" method="POST" class="form">
     <div class="form-group">
      <label>Enter Order Id</label>
      <input type="text" name="order_id" class="form-control" value="<?php if (isset($_GET['order_id'])) {
                                                                      echo $_GET['order_id'];
                                                                     } else {
                                                                     } ?>" placeholder="#INV">
     </div>
     <div class="form-group">
      <label class="text-center d-block mx-auto">OR</label>
     </div>
     <div class="form-group">
      <label>Enter Phone</label>
      <input type="text" name="search_invoice" class="form-control" placeholder="+91xxxxxxxxx">
     </div>
     <div class="form-group">
      <button type="submit" name="TRACK_ORDER" value="" class="btn btn-success btn-md d-block mx-auto">Check Order Status</button>
     </div>
    </form>
   </div>
  </div>
  <div class="row">
   <div class="col-md-6 col-lg-6 col-sm-6 d-block mx-auto p-1 pb-5 text-black" style="text-align: justify; padding-left: 1% !important;color:black !important;">
    <?php
    if (isset($_POST['TRACK_ORDER']) or isset($_GET['order_id'])) {
     echo '<img src="img/source.gif" style="width: 25%;z-index: 2;
    position: relative;" class="d-block mx-auto">
    <img src="img/road.jpg" style="width:100%;margin-top: -5%;
    z-index: -2 !important;">';
     if (isset($_POST['TRACK_ORDER'])) {
      $OrderId = $_POST['order_id'];
      $SearchData = $_POST['search_invoice'];
      if ($SearchData != null) {
       $SearchCustomer = "SELECT * FROM customers where customer_phone_number='$SearchData' OR customer_mail_id='$SearchData'";
       $SearchQuery = mysqli_query($con, $SearchCustomer);
       $CountCustomer = mysqli_num_rows($SearchQuery);
       if ($CountCustomer == 0) {
        $NoCustomerFound = "<div class='form-group'><label class='d-block mx-auto'><span class='text-danger'><h3 class='text-center text-danger'>No Data Found!</h3><span></label></div>";
        echo "$NoCustomerFound";
        $CustomerId = "";
        echo "<h4 class='text-center text-info mt-4'><i class='fa fa-search'></i> Search For : $SearchData <a href='track-order.php' class='btn btn-danger btn-md'><i class='fa fa-times mt-0'></i> Clear</a></h4>";
       } else {
        $NoCustomerFound = "";
        $FetchCustomer = mysqli_fetch_assoc($SearchQuery);
        $CustomerId = $FetchCustomer['customer_id'];
        echo "<h4 class='text-center text-info mt-4'><i class='fa fa-search'></i> Search For : $SearchData <a href='track-order.php' class='btn btn-danger btn-md'><i class='fa fa-times mt-0'></i> Clear</a></h4>";
       }
       $SearchOrders = "SELECT * FROM customer_orders where customer_id='$CustomerId' ORDER BY customer_order_id DESC LIMIT 0, 5";
       $OrderQuery = mysqli_query($con, $SearchOrders);
       $CountOrders = mysqli_num_rows($OrderQuery);
       if ($CountOrders == 0) {
        $NoCustomerFound = "<div class='form-group'><label class='d-block mx-auto'><span class='text-danger'><h3 class='text-center text-danger'>No Order Found!</h3><span></label></div>";
        echo "$NoCustomerFound";
       } else {
        $NoCustomerFound = "";
        while ($FetchOrders = mysqli_fetch_assoc($OrderQuery)) {
         $OrderID = $FetchOrders['order_id'];
         $DeliveryAddress = $FetchOrders['delivery_address'];
         $NetPayableAmount = $FetchOrders['net_payable_amount'];
         $DeliveryDate = $FetchOrders['delivery_date'];
         $OrderStatus = $FetchOrders['order_status'];
         $DeliverySlot = $FetchOrders['PICK_SCHEDULE_TIME'];
         $PaymentStatus = $FetchOrders['payment_status'];
         $OrderDate = $FetchOrders['order_date'];
         $PICKUP_TIME = $FetchOrders['PICKUP_TIME'];
         $delivery_status = $FetchOrders['delivery_status'];
         $OrderStatus = str_replace('_', ' ', $OrderStatus);
         $PaymentStatus = str_replace('_', ' ', $PaymentStatus);
         $delivery_status = str_replace('_', ' ', $delivery_status);

    ?>
         <ol class="progtrckr" data-progtrckr-steps="4">
          <?php if ($OrderStatus == "NEW ORDER") { ?>
           <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
           <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
           <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
           <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
          <?php } elseif ($OrderStatus == "ACCEPTED") { ?>
           <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
           <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Accepted</span></li>
           <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
           <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
          <?php } elseif ($OrderStatus == "REJECTED") { ?>
           <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
           <li class="progtrckr-failed"><span style="font-size: 11px;color: black;">Order Rejected</span></li>
           <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
           <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
          <?php } elseif ($OrderStatus == "OUT FOR DELIVERY") { ?>
           <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
           <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Out Accepted</span></li>
           <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Out for Delivery</span></li>
           <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
          <?php } elseif ($OrderStatus == "DELIVERED") { ?>
           <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
           <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Accepted</span></li>
           <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Out for Delivery</span></li>
           <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Delivered</span></li>
          <?php } ?>
         </ol>
         <h4 class="mt-4">Order Id : <?php echo $OrderID; ?></h4>
         <p class="text-black" style="color: black !important;">
          <b><i class="fa fa-calendar"></i> Order Date</b> : <?php echo $OrderDate; ?><br>
          <b><i class="fa fa-inr"></i> Order Amount :</b> Rs.<?php echo $NetPayableAmount; ?><br>
          <b>Delivery Slot: </b> <?php echo $DeliverySlot; ?><br>
          <b>Order Status : </b> <?php echo $OrderStatus; ?><br>
          <b>Delivery Status : </b> <?php echo $delivery_status; ?><br>
          <b>Delivery date:</b> <?php echo $DeliveryDate; ?><br>
          <b>Payment Status:</b> <?php echo $PaymentStatus; ?>
          <b></b>
         </p>
         <br>
         <hr>

         <?php }
       }
      } else {
       $SearchCustomer = "SELECT * FROM customer_orders where order_id='$OrderId' ORDER BY customer_order_id DESC";
       $CustomerQuery = mysqli_query($con, $SearchCustomer);
       $CountCustomer = mysqli_num_rows($CustomerQuery);
       if ($CountCustomer == 0) {
        $NoCustomerFound = "<div class='form-group'><label class='d-block mx-auto'><span class='text-danger'><h3 class='text-center text-danger'>No Data Found!</h3><span></label></div>";
        $CustomerId = "";
        echo "$NoCustomerFound";
        echo "<h4 class='text-center text-info mt-4'><i class='fa fa-search'></i> Search For : $OrderId <a href='track-order.php' class='btn btn-danger btn-md'><i class='fa fa-times mt-0'></i> Clear</a></h4>";
       } else {
        echo "<h4 class='text-center text-info mt-4'><i class='fa fa-search'></i> Search For : $OrderId <a href='track-order.php' class='btn btn-danger btn-md'><i class='fa fa-times mt-0'></i> Clear</a></h4>";
        $NoCustomerFound = "";
        $FetchCustomer = mysqli_fetch_assoc($CustomerQuery);
        $CustomerId = $FetchCustomer['customer_id'];

        $SearchOrders = "SELECT * FROM customer_orders where order_id='$OrderId' ORDER BY customer_order_id DESC";
        $OrderQuery = mysqli_query($con, $SearchOrders);
        $CountOrders = mysqli_num_rows($OrderQuery);
        if ($CountOrders == 0) {
         $NoCustomerFound = "<div class='form-group'><label class='d-block mx-auto'><span class='text-danger'><h3 class='text-center text-danger'>No Order Found!</h3><span></label></div>";
         echo "$NoCustomerFound";
        } else {
         $NoCustomerFound = "";
         while ($FetchOrders = mysqli_fetch_assoc($OrderQuery)) {
          $OrderID = $FetchOrders['order_id'];
          $DeliveryAddress = $FetchOrders['delivery_address'];
          $NetPayableAmount = $FetchOrders['net_payable_amount'];
          $DeliveryDate = $FetchOrders['delivery_date'];
          $OrderStatus = $FetchOrders['order_status'];
          $DeliverySlot = $FetchOrders['PICK_SCHEDULE_TIME'];
          $PaymentStatus = $FetchOrders['payment_status'];
          $OrderDate = $FetchOrders['order_date'];
          $PICKUP_TIME = $FetchOrders['PICKUP_TIME'];
          $delivery_status = $FetchOrders['delivery_status'];
          $OrderStatus = str_replace('_', ' ', $OrderStatus);
          $PaymentStatus = str_replace('_', ' ', $PaymentStatus);
          $delivery_status = str_replace('_', ' ', $delivery_status); ?>

          <ol class="progtrckr" data-progtrckr-steps="4">
           <?php if ($OrderStatus == "NEW ORDER") { ?>
            <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
            <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
            <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
            <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
           <?php } elseif ($OrderStatus == "ACCEPTED") { ?>
            <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
            <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Accepted</span></li>
            <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
            <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
           <?php } elseif ($OrderStatus == "REJECTED") { ?>
            <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
            <li class="progtrckr-failed"><span style="font-size: 11px;color: black;">Order Rejected</span></li>
            <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
            <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
           <?php } elseif ($OrderStatus == "OUT FOR DELIVERY") { ?>
            <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
            <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Out Accepted</span></li>
            <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Out for Delivery</span></li>
            <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
           <?php } elseif ($OrderStatus == "DELIVERED") { ?>
            <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
            <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Accepted</span></li>
            <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Out for Delivery</span></li>
            <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Delivered</span></li>
           <?php } ?>
          </ol>
          <h4 class="mt-4">Order Id : <?php echo $OrderID; ?></h4>
          <p class="text-black" style="color: black !important;">
           <b><i class="fa fa-calendar"></i> Order Date</b> : <?php echo $OrderDate; ?><br>
           <b><i class="fa fa-inr"></i> Order Amount :</b> Rs.<?php echo $NetPayableAmount; ?><br>
           <b>Delivery Slot: </b> <?php echo $DeliverySlot; ?><br>
           <b>Order Status : </b> <?php echo $OrderStatus; ?><br>
           <b>Delivery Status : </b> <?php echo $delivery_status; ?><br>
           <b>Delivery date:</b> <?php echo $DeliveryDate; ?><br>
           <b>Payment Status:</b> <?php echo $PaymentStatus; ?>
           <b></b>
          </p>
          <br>
          <hr>

        <?php }
        }
       }
      }
     } else {
      $OrderId = $_GET['order_id'];
      $SearchOrders = "SELECT * FROM customer_orders where order_id='$OrderId' ORDER BY customer_order_id DESC";
      $OrderQuery = mysqli_query($con, $SearchOrders);
      $CountOrders = mysqli_num_rows($OrderQuery);
      if ($CountOrders == 0) {
       $NoCustomerFound = "<div class='form-group'><label class='d-block mx-auto'><span class='text-danger'><h3 class='text-center text-danger'>No Order Found!</h3><span></label></div>";
       echo "$NoCustomerFound";
      } else {
       $NoCustomerFound = "";
       while ($FetchOrders = mysqli_fetch_assoc($OrderQuery)) {
        $OrderID = $FetchOrders['order_id'];
        $DeliveryAddress = $FetchOrders['delivery_address'];
        $NetPayableAmount = $FetchOrders['net_payable_amount'];
        $DeliveryDate = $FetchOrders['delivery_date'];
        $OrderStatus = $FetchOrders['order_status'];
        $DeliverySlot = $FetchOrders['PICK_SCHEDULE_TIME'];
        $PaymentStatus = $FetchOrders['payment_status'];
        $OrderDate = $FetchOrders['order_date'];
        $PICKUP_TIME = $FetchOrders['PICKUP_TIME'];
        $delivery_status = $FetchOrders['delivery_status'];
        $OrderStatus = str_replace('_', ' ', $OrderStatus);
        $PaymentStatus = str_replace('_', ' ', $PaymentStatus);
        $delivery_status = str_replace('_', ' ', $delivery_status); ?>

        <ol class="progtrckr" data-progtrckr-steps="4">
         <?php if ($OrderStatus == "NEW ORDER") { ?>
          <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
          <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
          <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
          <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
         <?php } elseif ($OrderStatus == "ACCEPTED") { ?>
          <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
          <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Accepted</span></li>
          <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
          <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
         <?php } elseif ($OrderStatus == "REJECTED") { ?>
          <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
          <li class="progtrckr-failed"><span style="font-size: 11px;color: black;">Order Rejected</span></li>
          <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
          <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
         <?php } elseif ($OrderStatus == "OUT FOR DELIVERY") { ?>
          <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
          <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Out Accepted</span></li>
          <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Out for Delivery</span></li>
          <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
         <?php } elseif ($OrderStatus == "DELIVERED") { ?>
          <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Placed</span></li>
          <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Order Accepted</span></li>
          <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Out for Delivery</span></li>
          <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Delivered</span></li>
         <?php } ?>
        </ol>
        <h4 class="mt-4">Order Id : <?php echo $OrderID; ?></h4>
        <p class="text-black" style="color: black !important;">
         <b><i class="fa fa-calendar"></i> Order Date</b> : <?php echo $OrderDate; ?><br>
         <b><i class="fa fa-inr"></i> Order Amount :</b> Rs.<?php echo $NetPayableAmount; ?><br>
         <b>Delivery Slot: </b> <?php echo $DeliverySlot; ?><br>
         <b>Order Status : </b> <?php echo $OrderStatus; ?><br>
         <b>Delivery Status : </b> <?php echo $delivery_status; ?><br>
         <b>Delivery date:</b> <?php echo $DeliveryDate; ?><br>
         <b>Payment Status:</b> <?php echo $PaymentStatus; ?>
         <b></b>
        </p>
        <br>
        <hr>

     <?php }
      }
     }
     ?>

     <h3 class="text-success text-center">If You Have any Query for Your Order</h3>
     <h4 class="text-success text-center">
      Please feel free to contact us via Call on <a href="tel:<?php echo $store_phone; ?>" class="text-info"><i class="fa fa-phone"></i> <?php echo $store_phone; ?></a> or Mail at <a href="mailto:<?php echo $store_mail_id; ?>" class="text-info"><i class="fa fa-envelope"></i> <?php echo $store_mail_id; ?></a>
     </h4>
    <?php } else {
     $NoCustomerFound = "";
    }
    ?>

   </div>
  </div>
 </section>


 <?php include 'footer.php'; ?>
</body>

</html>