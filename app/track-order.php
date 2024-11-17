<?php require 'files.php'; require 'session.php';?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php';?>

  <!-- header part end -->
  <br>
  <section class="container-fluid">
   <div class="row">
    <div class="col-md-12 bg-success p-1">
     <h5 class="font-7 text-white"><i class="fa fa-truck"></i> Track Orders <i class="fa fa-angle-right"></i></h5>
    </div>
   </div>
  </section>

  <section class="container-fluid">
   <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-12 d-block mx-auto mt-4">
     <form action="" method="POST" class="form">
      <div class="form-group">
       <label class="font-5">Enter Order Id</label>
       <input type="text" name="order_id" class="form-control tr-input font-9" placeholder="#INV"
        value="<?php if(isset($_GET['order_id'])) { echo $_GET['order_id']; } elseif(isset($_POST['order_id'])) { echo $_POST['order_id']; } else { }?>">
      </div>

      <?php if(isset($_GET['order_id']) or isset($_POST['order_id'])){?>

      <?php } else {
                    if(isset($_SESSION['customer_id'])){ ?>
      <div class="form-group">
       <label>Active Orders <i class="fa fa-angle-right"></i></label><br>
       <?php 
                     $SearchORDER = "SELECT * FROM customer_orders where customer_id='$customer_id' and order_status!='DELIVERED' and order_status!='REJECTED' and order_status!='CANCELLED' and order_status!='UNDELIVERED'";
                     $Query = mysqli_query($con, $SearchORDER);
                     $countORDER = mysqli_fetch_assoc($Query);
                     if($countORDER ==0){
                      echo "<h4 class='text-info'>No Active Order Found!</h4>";
                     } else {
                      while ($fetch = mysqli_fetch_assoc($Query)){
                        $order_id = $fetch['order_id'];
                        $order_status = $fetch['order_status'];
                        $order_status = str_replace('_', ' ', $order_status);
                        echo "<a href='track-order.php?order_id=$order_id' class='btn btn-md btn-outline-success btn-block font-3 text-black'>#$order_id - $order_status</a><br>";
                      }
                     } 
                     ?>
      </div>
      <?php } else { } ?>
      <?php } ?>
      <div class="form-group">
       <button type="submit" onclick="SearchOrderId()" name="TRACK_ORDER" value="" class="btn btn-success btn-md d-block mx-auto bottom-p bottom-text fixed-bottom btn-block"><span
         id="SearchOrderId">GET Order Status</span></button>
      </div>
     </form>
     <script type="text/javascript">
     function SearchOrderId() {
      document.getElementById("SearchOrderId").innerHTML = "<i class='fa fa-refresh fa-spin'></i> Searching...";
     }
     </script>
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12 p-1 pb-5 text-black" style="text-align: justify; padding-left: 1% !important;color:black !important;">
     <?php 
if(isset($_POST['TRACK_ORDER']) OR isset($_GET['order_id'])){
   echo '<img src="img/source.gif" style="width: 35%;z-index: 2;
    position: relative;border-radius:500px;" class="d-block mx-auto">
    <br>
    <img src="img/road.jpg" style="width:100%;margin-top: -8%;
    z-index: -2 !important;">';
   if(isset($_POST['TRACK_ORDER'])){
      $OrderId = $_POST['order_id'];
         $SearchCustomer = "SELECT * FROM customer_orders where order_id='$OrderId' ORDER BY customer_order_id DESC";
         $CustomerQuery = mysqli_query($con, $SearchCustomer);
         $CountCustomer = mysqli_num_rows($CustomerQuery);
         if($CountCustomer == 0){
            $NoCustomerFound = "<div class='form-group'><label class='d-block mx-auto'><span class='text-danger'><h3 class='text-center text-danger'>No Data Found!</h3><span></label></div>";
            $CustomerId = "";
            echo "$NoCustomerFound";
            echo "<h4 class='text-center text-info mt-3'><i class='fa fa-truck'></i> Status For : $OrderId <a href='track-order.php' class='btn btn-danger btn-md text-white'><i class='fa fa-times'></i> Clear</a></h4>";
         } else {
            echo "<h4 class='text-center text-info mt-3'><i class='fa fa-truck'></i> Status for : $OrderId <a href='track-order.php' class='btn btn-danger btn-md text-white'><i class='fa fa-times'></i> Clear</a></h4>";
            $NoCustomerFound = "";
            $FetchCustomer = mysqli_fetch_assoc($CustomerQuery);
            $CustomerId = $FetchCustomer['customer_id'];

$SearchOrders = "SELECT * FROM customer_orders where order_id='$OrderId' ORDER BY customer_order_id DESC";
$OrderQuery = mysqli_query($con, $SearchOrders);
$CountOrders = mysqli_num_rows($OrderQuery);
if($CountOrders == 0){
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
      <?php if($OrderStatus == "NEW ORDER"){ ?>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Ordered</span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <?php } elseif ($OrderStatus == "ACCEPTED") { ?>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Ordered</span></li>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Accepted</span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <?php } elseif ($OrderStatus == "REJECTED") { ?>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Ordered</span></li>
      <li class="progtrckr-failed"><span style="font-size: 11px;color: black;">Rejected</span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <?php } elseif ($OrderStatus == "OUT FOR DELIVERY") { ?>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Ordered</span></li>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Accepted</span></li>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">On Delivery</span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <?php } elseif ($OrderStatus == "DELIVERED") { ?>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Ordered</span></li>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Accepted</span></li>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">On Delivery</span></li>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Delivered</span></li>
      <?php } ?>
     </ol>
     <h4 class="mt-4">Order Id : <?php echo $OrderID;?></h4>
     <p class="text-black" style="color: black !important;">
      <b><i class="fa fa-calendar"></i> Order Date</b> : <?php echo $OrderDate;?><br>
      <b><i class="fa fa-inr"></i> Order Amount :</b> Rs.<?php echo $NetPayableAmount;?><br>
      <b>Delivery Slot: </b> <?php echo $DeliverySlot;?><br>
      <b>Order Status : </b> <?php echo $OrderStatus;?><br>
      <b>Delivery Status : </b> <?php echo $delivery_status;?><br>
      <b>Delivery date:</b> <?php echo $DeliveryDate;?><br>
      <b>Payment Status:</b> <?php echo $PaymentStatus;?>
      <b></b>
     </p>
     <br>
     <hr>

     <?php } 
         }
      }
   } else {
$OrderId = $_GET['order_id'];
$SearchOrders = "SELECT * FROM customer_orders where order_id='$OrderId' ORDER BY customer_order_id DESC";
$OrderQuery = mysqli_query($con, $SearchOrders);
$CountOrders = mysqli_num_rows($OrderQuery);
if($CountOrders == 0){
   $NoCustomerFound = "<div class='form-group'><label class='d-block mx-auto'><span class='text-danger'><h3 class='text-center text-danger'>No Order Found!</h3><span></label></div>";
            echo "$NoCustomerFound";
} else {
   echo "<h4 class='text-center text-info mt-3'><i class='fa fa-truck'></i> Status for : $OrderId <a href='track-order.php' class='btn btn-danger btn-md text-white'><i class='fa fa-times'></i> Clear</a></h4>";
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
      <?php if($OrderStatus == "NEW ORDER"){ ?>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Ordered</span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <?php } elseif ($OrderStatus == "ACCEPTED") { ?>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Ordered</span></li>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Accepted</span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <?php } elseif ($OrderStatus == "REJECTED") { ?>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Ordered</span></li>
      <li class="progtrckr-failed"><span style="font-size: 11px;color: black;">Rejected</span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <?php } elseif ($OrderStatus == "OUT FOR DELIVERY") { ?>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Ordered</span></li>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Accepted</span></li>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">On Delivery</span></li>
      <li class="progtrckr-todo"><span style="font-size: 11px;color: black;"></span></li>
      <?php } elseif ($OrderStatus == "DELIVERED") { ?>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Ordered</span></li>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Accepted</span></li>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">On Delivery</span></li>
      <li class="progtrckr-done"><span style="font-size: 11px;color: black;">Delivered</span></li>
      <?php } ?>
     </ol>
     <h4 class="mt-4">Order Id : <?php echo $OrderID;?></h4>
     <p class="text-black" style="color: black !important;">
      <b><i class="fa fa-calendar"></i> Order Date</b> : <?php echo $OrderDate;?><br>
      <b><i class="fa fa-inr"></i> Order Amount :</b> Rs.<?php echo $NetPayableAmount;?><br>
      <b>Delivery Slot: </b> <?php echo $DeliverySlot;?><br>
      <b>Order Status : </b> <?php echo $OrderStatus;?><br>
      <b>Delivery Status : </b> <?php echo $delivery_status;?><br>
      <b>Delivery date:</b> <?php echo $DeliveryDate;?><br>
      <b>Payment Status:</b> <?php echo $PaymentStatus;?>
      <b></b>
     </p>
     <br>
     <hr>

     <?php }
}

}


?>
     <hr>
     <h3 class="text-success text-center">If You Have any Query for Your Order</h3>
     <h4 class="text-success text-center">
      Please feel free to contact us via Call on
      <br><br><a href="tel:<?php echo $store_phone;?>" class="text-white btn btn-info btn-md bottom-text bottom-p" style="display: inline-block;"><i class="fa fa-phone"></i>
       <?php echo $store_phone;?></a>
      <br><br> or Mail at<br><br>
      <a href="mailto:<?php echo $store_mail_id;?>" class="text-white btn btn-info btn-md bottom-text bottom-p" style="display: inline-block;"><i class="fa fa-envelope"></i>
       <?php echo $store_mail_id;?></a>
     </h4>
     <?php } else {
   $NoCustomerFound = "";
}
?>

    </div>
   </div>
  </section>
  <br><br><br>

  <?php GSI_footer_files();?>
 </body>

</html>
