<?php
require 'files.php';
require 'session.php';

//store information
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users where user_id='$user_id'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$store_user_id_1 = $fetch['ref'];

$select_store = "SELECT * FROM stores where user_id='$store_user_id_1'";
$store_query = mysqli_query($con, $select_store);
$fetch_store = mysqli_fetch_assoc($store_query);
$store_user_id = $fetch_store['store_id'];
$store_id = $fetch_store['store_id'];
$store_name = $fetch_store['store_name'];
$store_phone = $fetch_store['store_phone'];
$store_mail_id = $fetch_store['store_mail_id'];
$store_address = $fetch_store['store_address'];
$store_arealocality = $fetch_store['store_arealocality'];
$store_city = $fetch_store['store_city'];
$store_state = $fetch_store['store_state'];
$store_pincode = $fetch_store['store_pincode'];

if (isset($_GET['id'])) {
  $subscribe_id = $_GET['id'];

  $sql = "SELECT * from customer_subscriptions where customer_subscription_id='$subscribe_id'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  $customer_id = $fetch['customer_id'];
  $delivery_address = $fetch['delivery_address'];
  $sql = "SELECT * FROM customers where customer_id='$customer_id'";
  $query =  mysqli_query($con, $sql);
  $fetchcustomer = mysqli_fetch_assoc($query);
  $customer_name = $fetchcustomer['customer_name'];
  $customer_mail_id = $fetchcustomer['customer_mail_id'];
  $customer_phone_number = $fetchcustomer['customer_phone_number'];
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Orders Payments : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click"
 data-menu="vertical-menu-modern" data-col="2-columns">

 <?php require 'header.php'; ?>


 <?php require 'sidebar.php'; ?>

 <!-- BEGIN: Content-->
 <div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
   <div class="content-header row">
    <div class="col-lg-12 card-content">
     <?php notification(); ?>
    </div>
   </div>



   <div class="content-body">
    <!-- users list start -->
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h5 class="users-action mobile-font-size">SUBSCIPTION_ID : <?php echo $subscribe_id; ?> <i
          class="fa fa-angle-right"></i>
         Payments Option</h5>
        <hr>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
         <ul class="list-inline mb-0">
          <li><a data-action="expand"><i class="fa fa-expand"></i></a></li>
         </ul>
        </div>
       </div>
       <div class="card-content">
        <div class="card-body" style="margin-top: -46px;">
         <div class="row">
          <div class="col-lg-6 col-6">
           <h6 class="mobile-font-size"><b>Customer Information:</b></h6>
           <p class="mobile-font-size font-small-2"><b><i class="fa fa-user"></i></b> <?php echo $customer_name; ?><br>
            <b><i class="fa fa-envelope"></i></b> <?php echo $customer_mail_id; ?><br>
            <b><i class="fa fa-phone"></i></b> <?php echo $customer_phone_number; ?><br>
            <b><i class="fa fa-map-marker"></i></b> <?php echo $delivery_address; ?>
           </p>
          </div>
          <div class="col-lg-6 col-6 text-right">
           <h6 class="mobile-font-size"><b>Store Information:</b></h6>
           <p class="mobile-font-size font-small-2"><?php echo $store_name; ?><br>
            <?php echo $store_phone; ?><br>
            <?php echo $store_mail_id; ?><br>
            <?php echo $store_address; ?> <?php echo $store_arealocality; ?> <?php echo $store_city; ?>
            <?php echo $store_state; ?> <?php echo $store_pincode; ?>
           </p>
          </div>
         </div>

         <div class="row">
          <div class="col-lg-12 col-md-12">
           <div class="">
            <table class="table cart_summary">
             <thead>
              <tr>
               <th style="width:40%;padding: 1%; font-size: 12px;">Item Name</th>
               <th style="width:13%;padding: 1%; font-size: 12px;" class="text-right">MRP Price</th>
               <th style="width: 10%;padding: 1%; font-size: 12px;" class="text-right">Offer price</th>
               <th style="width: 7%;padding: 1%; font-size: 12px;" class="text-right">Qty</th>
               <th style="width: 10%;padding: 1%; font-size: 12px;" class="text-right">Total</th>
              </tr>
             </thead>
             <tbody>
              <?php

                            $sql = "SELECT * FROM subscription_products where customer_subscription_id='$subscribe_id'";
                            $query = mysqli_query($con, $sql);
                            while ($fetch = mysqli_fetch_assoc($query)) {

                            ?>
              <tr>
               <td class="cart_description" style="padding: 1%; font-size: 12px;">
                <h6><b><?php echo $fetch['product_name']; ?></b> - <?php echo $fetch['product_tags']; ?></h6>
               </td>
               <td class="cart_description text-right" style="padding: 1%; font-size: 12px;">
                <h6><i class="fa fa-inr"></i> <?php echo $fetch['product_mrp_price']; ?></h6>
               </td>
               <td class="price text-right" style="padding: 1%; font-size: 12px;">
                <span><i class="fa fa-inr"></i> <?php echo $fetch['product_offer_price']; ?></span>
               </td>
               <td class="qty text-right" style="padding: 1%; font-size: 12px;">x
                <?php echo $fetch['product_quantity']; ?></td>
               <td class="price text-right" style="padding: 1%; font-size: 12px;">
                <span><i class="fa fa-inr"></i> <?php echo $fetch['product_total_price']; ?></span>
               </td>
              </tr>

              <?php } ?>
              <tr>
               <td colspan="4" class="text-right">MRP Total:</td>
               <td class="text-right">
                <h4>Rs.<?php
                                        $select = "SELECT sum(product_mrp_total) FROM subscription_products where customer_subscription_id='$subscribe_id'";
                                        $action = mysqli_query($con, $select);
                                        while ($record = mysqli_fetch_array($action)) {
                                          echo $total_amount_mrp = $record['sum(product_mrp_total)'];
                                        }
                                        ?></h4>
               </td>
              </tr>

              <tr>
               <td colspan="4" class="text-right">Total After OFF :</td>
               <td class="text-right">
                <h4>Rs.<?php
                                        $select = "SELECT sum(product_total_price) FROM subscription_products where customer_subscription_id='$subscribe_id'";
                                        $action = mysqli_query($con, $select);
                                        while ($record = mysqli_fetch_array($action)) {
                                          echo $total_amount = $record['sum(product_total_price)'];
                                        }
                                        if ($total_amount == 0) { ?>

                 <?php }
                                ?></h4>
               </td>
              </tr>

              <tr>
               <td colspan="4" class="text-right">You Save:</td>
               <td class="text-right">
                <h3 class="text-success"><b>Rs.<?php
                                                                $select = "SELECT sum(product_mrp_total) FROM subscription_products where customer_subscription_id='$subscribe_id'";
                                                                $action = mysqli_query($con, $select);
                                                                while ($record = mysqli_fetch_array($action)) {
                                                                  $total_amount_mrp = $record['sum(product_mrp_total)'];
                                                                }
                                                                $save = $total_amount_mrp - $total_amount;
                                                                echo $save;
                                                                ?></b></h3>
               </td>
              </tr>

              <tr>
               <td colspan="4" class="text-right">Net Payable Amount :</td>
               <td class="text-right">
                <h3 class="text-primary"><b>Rs.<?php
                                                                $select = "SELECT sum(product_total_price) FROM subscription_products where customer_subscription_id='$subscribe_id'";
                                                                $action = mysqli_query($con, $select);
                                                                while ($record = mysqli_fetch_array($action)) {
                                                                  echo $total_amount = $record['sum(product_total_price)'];
                                                                }
                                                                ?></b></h3>
               </td>
              </tr>



             </tbody>
            </table>
            <div class="row">
             <style type="text/css">
             /* HIDE RADIO */
             [type=radio] {
              position: absolute;
              opacity: 0;
              width: 0;
              height: 0;
             }

             /* IMAGE STYLES */
             [type=radio]+img {
              cursor: pointer;
             }

             /* CHECKED STYLES */
             [type=radio]:checked+img {
              outline: 2px solid #f00;
             }
             </style>
            </div>
            <form action="" method="POST">
             <input type="text" name="order_id" value="<?php echo $ORDERID; ?>" hidden=''>
             <div class="row">
              <div class="col-lg-6">
               <h6><b>Payment Method :</b></h6>
               <?php
                              $sql = "SELECT * FROM customer_subscription_payments where customer_subscription_id='$subscribe_id'";
                              $query =  mysqli_query($con, $sql);
                              $fetch = mysqli_fetch_assoc($query);
                              $payment_cycle = $fetch['payment_cycle'];
                              $payment_mode = $fetch['payment_mode'];
                              ?>
               <p>
                Payment Plan : <?php echo $payment_cycle; ?><br>
                Payment Mode : <?php echo $payment_mode; ?></p>
              </div>

              <div class="col-lg-6">
               <h6><b>Subscription Details:</b></h6>
               <?php
                              $sql = "SELECT * FROM customer_subscriptions where customer_subscription_id='$subscribe_id'";
                              $query =  mysqli_query($con, $sql);
                              $fetch = mysqli_fetch_assoc($query);
                              $SUBSCRIBE_PLAN_TYPE = $fetch['SUBSCRIBE_PLAN_TYPE'];
                              $SUBS_APPLY_DATE = $fetch['SUBS_APPLY_DATE'];

                              ?>
               <p>
                Apply Date : <?php echo $SUBS_APPLY_DATE; ?><br>
                Plan Type : <?php echo $SUBSCRIBE_PLAN_TYPE; ?><br>
                Delivery Days: <?php $sql = "SELECT * FROM customer_subscriptions_days where customer_subscription_id='$subscribe_id' ORDER BY SUBSCRIPTION_DAYS ASC";
                                                $query =  mysqli_query($con, $sql);
                                                while ($fetch = mysqli_fetch_assoc($query)) {
                                                  echo "-" . $fetch['SUBSCRIPTION_DAYS'];
                                                  $SUBS_START_DATE = $fetch['SUBS_START_DATE'];
                                                }
                                                $fetch = mysqli_fetch_assoc($query);

                                                ?><br>
                Start Date : <?php echo $SUBS_START_DATE; ?></p>
              </div>

              <div class="col-lg-12 col-12">
               <hr>
              </div>

              <div class="col-lg-2 col-md-4 col-12">
               <label>
                <input type="radio" name="payment_mode" value="CASH_PAYMENT" required="">
                <img src="img/cash-payment.png" style="width: 100%; box-shadow: 0px 0px 1px grey;">
               </label>
              </div>
              <div class="col-lg-2 col-md-4 col-12">
               <label>
                <input type="radio" name="payment_mode" value="WALLET" required="">
                <img src="img/wallet.png" style="width: 100%;box-shadow: 0px 0px 1px grey;">
               </label>
              </div>
              <div class="col-lg-8 col-md-4 col-12">
               <div class="form-group">
                <label>Payment Note</label>
                <textarea class="form-control" rows='4' name="payment_note" required=""></textarea>
               </div>
              </div>
              <div class="col-lg-12">
               <a href='order_products.php' class="btn btn-primary text-white"><i class="fa fa-angle-left"></i>
                Previuos</a>
               <button type="Submit" name="GENERATE_ORDER"
                class="btn btn-primary btn-md float-right">Delivered?</button>
              </div>
             </div>
             <?php
                          if (isset($_POST['GENERATE_ORDER'])) {
                            ////Deliver itmes informations

                            $sql = "SELECT * FROM subscription_products where customer_subscription_id='$subscribe_id'";
                            $query = mysqli_query($con, $sql);
                            $count_items = mysqli_num_rows($query);

                            $sql = "SELECT * FROM customer_subscriptions where customer_subscription_id='$subscribe_id'";
                            $query = mysqli_query($con, $sql);
                            $fetch = mysqli_fetch_assoc($query);
                            $SUBS_APPLY_DATE = $fetch['SUBS_APPLY_DATE'];

                            $customer_subscription_id = $subscribe_id;
                            $customer_id = $customer_id;
                            $store_id = $store_id;
                            date_default_timezone_set("Asia/Calcutta");
                            $delivery_date = date("d M Y h:m A");
                            $delivery_status = "DELIVERED";
                            $delivered_quantity = $count_items;
                            $delivery_day = date("d");
                            $delivery_month = date("m");
                            $delivery_year = date("Y");
                            $payment_cycle = $payment_cycle;
                            $payment_mode = $payment_mode;
                            $payment_status = "PAID";
                            $payment_amount = $total_amount;

                            ////billing informations
                            $payment_from_date = $SUBS_APPLY_DATE;
                            date_default_timezone_set("Asia/Calcutta");
                            $payment_to_date = date("d M Y h:m A");
                            $payment_amount = $payment_amount;
                            $payment_status = "PAID";
                            $payment_note = $_POST['payment_note'];
                            $billing_date = $delivery_date;
                            $payment_mode = $_POST['payment_mode'];

                            $sql = "INSERT INTO subscription_deliveries (customer_subscription_id, customer_id, store_id, delivery_date, delivery_status, delivered_quantity, delivery_day, delivery_month, delivery_year, payment_cycle, payment_mode, payment_status, payment_amount) VALUES ('$customer_subscription_id', '$customer_id', '$store_id', '$delivery_date', '$delivery_status', '$delivered_quantity', '$delivery_day', '$delivery_month', '$delivery_year', '$payment_cycle', '$payment_mode', '$payment_status', '$payment_amount')";
                            $query =  mysqli_query($con, $sql);
                            if ($query == true) {
                              $sql = "INSERT INTO customer_subscription_billings (customer_subscription_id, customer_id, store_id, payment_cycle, payment_mode, payment_from_date, payment_to_date, payment_amount, payment_status, payment_note, billing_date) VALUES ('$subscribe_id', '$customer_id', '$store_id', '$payment_cycle', '$payment_mode', '$payment_from_date', '$payment_to_date', '$payment_amount', '$payment_status', '$payment_note', '$billing_date')";
                              $query = mysqli_query($con, $sql);
                              if ($query == true) { ?>
             <meta http-equiv="refresh"
              content="1; deliveries.php?t=success&m=Delivered&a=ORDERID : <b><?php echo $subscribe_id; ?></b> is Delivered Successfully!" />
             <?php } else { ?>
             <meta http-equiv="refresh"
              content="1; deliveries.php?t=success&m=Delivered&a=ORDERID : <b><?php echo $subscribe_id; ?></b> is not Delivered!." />
             <?php }
                            }
                          }
                          ?>
            </form>
           </div>

          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
   </div>
   </section>
   <!-- users list ends -->
  </div>
 </div>
 </div>
 <!-- END: Content-->


 <?php require 'footer.php'; ?>

</body>
<!-- END: Body-->

</html>
<script type="text/javascript">
function autocomplete(inp, arr) {
 /*the autocomplete function takes two arguments,
 the text field element and an array of possible autocompleted values:*/
 var currentFocus;
 /*execute a function when someone writes in the text field:*/
 inp.addEventListener("input", function(e) {
  var a, b, i, val = this.value;
  /*close any already open lists of autocompleted values*/
  closeAllLists();
  if (!val) {
   return false;
  }
  currentFocus = -1;
  /*create a DIV element that will contain the items (values):*/
  a = document.createElement("DIV");
  a.setAttribute("id", this.id + "autocomplete-list");
  a.setAttribute("class", "autocomplete-items");
  /*append the DIV element as a child of the autocomplete container:*/
  this.parentNode.appendChild(a);
  /*for each item in the array...*/
  for (i = 0; i < arr.length; i++) {
   /*check if the item starts with the same letters as the text field value:*/
   if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
    /*create a DIV element for each matching element:*/
    b = document.createElement("DIV");
    /*make the matching letters bold:*/
    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
    b.innerHTML += arr[i].substr(val.length);
    /*insert a input field that will hold the current array item's value:*/
    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
    /*execute a function when someone clicks on the item value (DIV element):*/
    b.addEventListener("click", function(e) {
     /*insert the value for the autocomplete text field:*/
     inp.value = this.getElementsByTagName("input")[0].value;
     /*close the list of autocompleted values,
     (or any other open lists of autocompleted values:*/
     closeAllLists();
    });
    a.appendChild(b);
   }
  }
 });
 /*execute a function presses a key on the keyboard:*/
 inp.addEventListener("keydown", function(e) {
  var x = document.getElementById(this.id + "autocomplete-list");
  if (x) x = x.getElementsByTagName("div");
  if (e.keyCode == 40) {
   /*If the arrow DOWN key is pressed,
   increase the currentFocus variable:*/
   currentFocus++;
   /*and and make the current item more visible:*/
   addActive(x);
  } else if (e.keyCode == 38) { //up
   /*If the arrow UP key is pressed,
   decrease the currentFocus variable:*/
   currentFocus--;
   /*and and make the current item more visible:*/
   addActive(x);
  } else if (e.keyCode == 13) {
   if (currentFocus > -1) {
    /*and simulate a click on the "active" item:*/
    if (x) x[currentFocus].click();
   }
  }
 });

 function addActive(x) {
  /*a function to classify an item as "active":*/
  if (!x) return false;
  /*start by removing the "active" class on all items:*/
  removeActive(x);
  if (currentFocus >= x.length) currentFocus = 0;
  if (currentFocus < 0) currentFocus = (x.length - 1);
  /*add class "autocomplete-active":*/
  x[currentFocus].classList.add("autocomplete-active");
 }

 function removeActive(x) {
  /*a function to remove the "active" class from all autocomplete items:*/
  for (var i = 0; i < x.length; i++) {
   x[i].classList.remove("autocomplete-active");
  }
 }

 function closeAllLists(elmnt) {
  /*close all autocomplete lists in the document,
  except the one passed as an argument:*/
  var x = document.getElementsByClassName("autocomplete-items");
  for (var i = 0; i < x.length; i++) {
   if (elmnt != x[i] && elmnt != inp) {
    x[i].parentNode.removeChild(x[i]);
   }
  }
 }
 /*execute a function when someone clicks in the document:*/
 document.addEventListener("click", function(e) {
  closeAllLists(e.target);
 });
}
autocomplete(document.getElementById("product_names"), products);
autocomplete(document.getElementById("product_tags"), products_tags);
</script>