<?php require 'files.php';
unset($_SESSION['PAYMENT_STATUS']);
unset($_SESSION['TXNID']);
unset($_SESSION['PAYMENT_MODE']);
unset($_SESSION['PAYMENT_SOURCE']);
unset($_SESSION['COMPLETE_DETAILS']);
unset($_SESSION['PICK_SCHEDULE_TIME']);
unset($_SESSION['delivery_address']);
unset($_SESSION['billing_address']);
unset($_SESSION['payment_mode']);
unset($_SESSION['net_payable_amount']);
unset($_SESSION['net_payable_amount']);
unset($_SESSION['product_total_amount_entry']);
unset($_SESSION['coupon_code']);
unset($_SESSION['total_amount_after_discount']);
unset($_SESSION['delivery_charge']);
unset($_SESSION['order_id']);
unset($_SESSION['store_id']);
unset($_SESSION['DELIVERY_TYPE']);
?>
<!DOCTYPE html>
<html>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <title><?php echo $store_name; ?> : Cart</title>
 <?php include 'header_files.php'; ?>
</head>

<body>
 <?php
 include "header.php"; ?>
 <!-- breadcrumb start -->
 <div class="breadcrumb-main ">
  <div class="container">
   <div class="row">
    <div class="col">
     <div class="breadcrumb-contain">
      <div>
       <h2>Order Status</h2>
       <ul>
        <li><a href="index.php">home</a></li>
        <li><i class="fa fa-angle-double-right"></i></li>
        <li><a href="javascript:void(0)">Order Status</a></li>
       </ul>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
 <!-- breadcrumb End -->

 <!-- section start -->
 <section class="section-big-py-space b-g-light">
  <div class="custom-container">
   <div class="card">
    <div class="card-header" id="headingThree">
     <h5 class="mb-0">Order Complete</h5>
    </div>
    <div id="collapsefour" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
     <div class="card-body">
      <div class="text-center">
       <div class="col-lg-10 col-md-10 mx-auto order-done">
        <i class="fa fa-check-circle text-success font-large-1" style="font-size: 12rem;"></i>
        <h4 class="text-success">Congrats! Your Order has been Placed..</h4>
        <p>
         Your Order Is placed Successfully. Please Check your registered mail id to know more about order details, order status.<br>You can also check in your Store Account about this.
        </p>
       </div>

       <div class="text-center">
        <br><br>
        <a href="index.php"><button type='button' class="btn btn-success mb-1 btn-sm"><i class="fa fa-angle-left"></i> Return to Store</button></a>
        <a href="orders.php"><button type="button" class="btn btn-info mb-2 btn-sm text-white mt-1">View Orders <i class="fa fa-angle-right"></i></button></a>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </section>
 <!-- section end -->


 <?php include 'footer.php'; ?>
</body>

</html>