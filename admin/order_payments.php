<?php
require 'files.php';
require 'session.php';



//store information
$store_user_id = $_SESSION['user_id'];
$select_store = "SELECT * FROM stores where user_id='$store_user_id'";
$store_query = mysqli_query($con, $select_store);
$fetch_store = mysqli_fetch_assoc($store_query);
$store_id = $fetch_store['store_id'];
$store_name = $fetch_store['store_name'];
$store_phone = $fetch_store['store_phone'];
$store_mail_id = $fetch_store['store_mail_id'];
$store_address = $fetch_store['store_address'];
$store_arealocality = $fetch_store['store_arealocality'];
$store_city = $fetch_store['store_city'];
$store_state = $fetch_store['store_state'];
$store_pincode = $fetch_store['store_pincode'];

//customer information
if (isset($_GET['customer_phone_number'])) {

  $_SESSION['customer_id'] = $_GET['customer_id'];
  $_SESSION['customer_name'] = $_GET['customer_name'];
  $_SESSION['customer_mail_id'] = $_GET['customer_mail_id'];
  $_SESSION['customer_phone_number'] = $_GET['customer_phone_number'];
  $_SESSION['custaddress'] = $_GET['custaddress'];
  $_SESSION['custcity'] = $_GET['custcity'];
  $_SESSION['custstate'] = $_GET['custstate'];
  $_SESSION['custpincode'] = $_GET['custpincode'];
  $_SESSION['arealocality'] = $_GET['arealocality'];
  $_SESSION['cr_url'] = $_GET['cr_url'];

  $customer_id = $_SESSION['customer_id'];
  $customer_name = $_SESSION['customer_name'];
  $customer_mail_id = $_SESSION['customer_mail_id'];
  $customer_phone_number = $_SESSION['customer_phone_number'];
  $custaddress = $_SESSION['custaddress'];
  $custcity = $_SESSION['custcity'];
  $custstate = $_SESSION['custstate'];
  $custpincode = $_SESSION['custpincode'];
  $arealocality = $_SESSION['arealocality'];
  $cr_url = $_SESSION['cr_url'];
} else {

  $customer_id = $_SESSION['customer_id'];
  $customer_name = $_SESSION['customer_name'];
  $customer_mail_id = $_SESSION['customer_mail_id'];
  $customer_phone_number = $_SESSION['customer_phone_number'];
  $custaddress = $_SESSION['custaddress'];
  $custcity = $_SESSION['custcity'];
  $custstate = $_SESSION['custstate'];
  $custpincode = $_SESSION['custpincode'];
  $arealocality = $_SESSION['arealocality'];
  $cr_url = $_SESSION['cr_url'];
}




//search customer exist or not///
$sql = "SELECT * from customers where customer_mail_id='$customer_mail_id' and customer_phone_number='$customer_phone_number'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);

if ($fetch == true) {
  //if customer exists
  $customer_id = $_SESSION['customer_id'];
  $customer_name = $_SESSION['customer_name'];
  $customer_mail_id = $_SESSION['customer_mail_id'];
  $customer_phone_number = $_SESSION['customer_phone_number'];
  $custaddress = $_SESSION['custaddress'];
  $custcity = $_SESSION['custcity'];
  $custstate = $_SESSION['custstate'];
  $custpincode = $_SESSION['custpincode'];
  $arealocality = $_SESSION['arealocality'];
  $cr_url = $_SESSION['cr_url'];
} else {
  //if customer is not exists

  $customer_reg_date = date("d M Y h:m A");
  $customer_add_month = date("M");
  $customer_add_date = date("d");
  $customer_add_year = date("Y");

  $sql = "INSERT INTO customers
           (customer_name, customer_phone_number, customer_mail_id, customer_password, customer_reg_date, customer_add_month, customer_add_year, customer_image, store_id, arealocality, custaddress, custcity, custstate, custpincode, customer_add_date)
    VALUES ('$customer_name', '$customer_phone_number', '$customer_mail_id', '$customer_phone_number', '$customer_reg_date', '$customer_add_month', '$customer_add_year', 'user.jpg', '$store_id', '$arealocality', '$custaddress', '$custcity', '$custstate', '$custpincode', '$customer_add_date')";
  $query = mysqli_query($con, $sql);
  if ($query == true) {
  }
}

$date_time = date("dmy");
$_SESSION['order_id'] = "STR$store_id" . "C$customer_id" . "D$date_time" . "I" . rand(100, 99999999);
$ORDERID  = $_SESSION['order_id'];

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

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

  <?php require 'header.php'; ?>


  <?php require 'sidebar.php'; ?>

  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="col-lg-12 card-content">
          <?php notification(); ?>
          <?php

          $device_type = detectDevice();
          date_default_timezone_set("Asia/Calcutta");
          $date_time_c = date("dMY");
          $ipv6_n = php_uname('n');
          $ipv6_p = php_uname('p');
          $os = php_uname('s');
          $OS_release = php_uname('r');
          $OS_Version = php_uname('v');
          $System_Info = php_uname('m');
          $System_more_Info = $_SERVER['HTTP_USER_AGENT'];
          $ip_address = "localbilling";
          $device_info = "$device_type$date_time_c$ipv6_n$ipv6_p$os$OS_release$OS_Version$System_Info$System_more_Info";

          if (isset($_POST['ORDERED_PRODUCTS'])) {

            $productname = $_POST['products_name'];
            $searchproductid = "SELECT * FROM user_products where user_id='$store_user_id' and product_title='$productname'";
            $query =  mysqli_query($con, $searchproductid);
            $fetchproid = mysqli_fetch_assoc($query);
            $user_product_id = $fetchproid['user_product_id'];
            $product_tags = $fetchproid['product_tags'];
            $product_offer_price = $fetchproid['product_offer_price'];
            $quantity            = "1";
            $amount              = $fetchproid['product_offer_price'];
            $cart_add_date       = date("d M Y h:m A");

            $sql = "SELECT * from customer_cart where store_id='$store_id' and customer_id='$customer_id'";
            $query = mysqli_query($con, $sql);
            $fetch = mysqli_fetch_assoc($query);
            if ($fetch == true) { ?>
              <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                <button type="button" class="close" onclick="remove_msg()" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <strong>Failed : </strong> Item Already in Cart
              </div>

          <?php } else {

              $sql = "INSERT into customer_cart (customer_id, ip_address, device_info, user_product_id, product_tags, product_price, product_quantity, product_total_amount, cart_add_date, store_id) VALUES ('$customer_id', '$ip_address', '$device_info', '$user_product_id', '$product_tags', '$product_offer_price', '$quantity', '$amount', '$cart_add_date', '$store_id')";
              $query = mysqli_query($con, $sql);
            }
          }


          ?>

        </div>
      </div>



      <div class="content-body">
        <!-- users list start -->
        <section class="users-list-wrapper">
          <div class="users-list-table">
            <div class="card">
              <div class="card-header">
                <h5 class="users-action mobile-font-size">ORDERID : <?php echo $ORDERID; ?> <i class="fa fa-angle-right"></i>
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
                        <b><i class="fa fa-map-marker"></i></b> <?php echo $custaddress; ?> <?php echo $arealocality; ?>
                        <?php echo $custcity; ?> <?php echo $custstate; ?> <?php echo $custpincode; ?>
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
                            $sql = "SELECT * FROM customer_cart, user_products, pro_brands, product_categories where device_info='$device_info' and ip_address='$ip_address' and store_id='$store_id' and customer_id='$customer_id' and customer_cart.user_product_id=user_products.product_title and user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id";
                            $query = mysqli_query($con, $sql);
                            while ($fetch = mysqli_fetch_assoc($query)) {
                              $cart_id = $fetch['cart_id'];
                              $user_product_id_value = $fetch['user_product_id'];
                              $product_title = $fetch['product_title'];
                              $product_img = $fetch['product_img'];
                              $product_cat_title = $fetch['product_cat_title'];
                              $product_price = $fetch['product_price'];
                              $product_tags = $fetch['product_tags'];
                              $brand_title = $fetch['brand_title'];
                              $product_quantity = $fetch['product_quantity'];
                              $product_total_amount = $fetch['product_total_amount'];
                              $product_mrp = $fetch['product_mrp'];


                            ?>
                              <tr>
                                <td class="cart_description" style="padding: 1%; font-size: 12px;">
                                  <h6><b><?php echo $product_title; ?></b> - <?php echo $product_tags; ?></h6>
                                </td>
                                <td class="cart_description text-right" style="padding: 1%; font-size: 12px;">
                                  <h6><i class="fa fa-inr"></i> <?php echo $product_mrp; ?></h6>
                                </td>
                                <td class="price text-right" style="padding: 1%; font-size: 12px;">
                                  <span><i class="fa fa-inr"></i> <?php echo $product_price; ?></span>
                                </td>
                                <td class="qty text-right" style="padding: 1%; font-size: 12px;">x <?php echo $product_quantity; ?></td>
                                <td class="price text-right" style="padding: 1%; font-size: 12px;">
                                  <span><i class="fa fa-inr"></i> <?php echo $product_total_amount; ?></span>
                                </td>
                              </tr>

                            <?php } ?>
                            <tr>
                              <td colspan="4" class="text-right">MRP Total:</td>
                              <td class="text-right">
                                <h4>Rs.<?php
                                        $select = "SELECT sum(mrp_total) FROM customer_cart where store_id='$store_id' and customer_id='$customer_id'";
                                        $action = mysqli_query($con, $select);
                                        while ($record = mysqli_fetch_array($action)) {
                                          echo $total_amount = $record['sum(mrp_total)'];
                                        }
                                        ?></h4>
                              </td>
                            </tr>

                            <tr>
                              <td colspan="4" class="text-right">Total After OFF :</td>
                              <td class="text-right">
                                <h4>Rs.<?php
                                        $select = "SELECT sum(product_total_amount) FROM customer_cart where store_id='$store_id' and customer_id='$customer_id'";
                                        $action = mysqli_query($con, $select);
                                        while ($record = mysqli_fetch_array($action)) {
                                          echo $total_amount = $record['sum(product_total_amount)'];
                                        }
                                        if ($total_amount == 0) { ?>
                                  <meta http-equiv="refresh" content="1; new_order.php" />
                                <?php }
                                ?>
                                </h4>
                              </td>
                            </tr>

                            <tr>
                              <td colspan="4" class="text-right">You Save:</td>
                              <td class="text-right">
                                <h3 class="text-success"><b>Rs.<?php
                                                                $select = "SELECT sum(mrp_total) FROM customer_cart where store_id='$store_id' and customer_id='$customer_id'";
                                                                $action = mysqli_query($con, $select);
                                                                while ($record = mysqli_fetch_array($action)) {
                                                                  $total_amount_mrp = $record['sum(mrp_total)'];
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
                                                                $select = "SELECT sum(product_total_amount) FROM customer_cart where store_id='$store_id' and customer_id='$customer_id'";
                                                                $action = mysqli_query($con, $select);
                                                                while ($record = mysqli_fetch_array($action)) {
                                                                  echo $total_amount = $record['sum(product_total_amount)'];
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
                            <div class="col-lg-12">
                              <h6><b>SELECT Payment Mode</b></h6>
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
                            <div class="col-lg-2 col-md-4 col-12">
                              <label>
                                <input type="radio" name="payment_mode" value="CARD_PAYMENT" required="">
                                <img src="img/Credit-Cards-1.png" style="width: 100%;box-shadow: 0px 0px 1px grey;">
                              </label>
                            </div>
                            <div class="col-lg-6 col-md-4 col-12">
                              <div class="form-group">
                                <label>Payment Note</label>
                                <textarea class="form-control" rows='4' name="payment_note" required=""></textarea>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <a href='order_products.php' class="btn btn-primary text-white"><i class="fa fa-angle-left"></i>
                                Previuos</a>
                              <button type="Submit" name="GENERATE_ORDER" class="btn btn-primary btn-md float-right">GENERATE
                                ORDER</button>
                            </div>
                          </div>
                          <?php
                          if (isset($_POST['GENERATE_ORDER'])) {
                            $ORDERID = $_POST['order_id'];
                            $payment_mode = $_POST['payment_mode'];
                            $payment_note = $_POST['payment_note'];
                            $delivery_address = "$custaddress, $arealocality, $custcity, $custstate - $custpincode";
                            $net_payable_amount = $total_amount;
                            $payment_status = "PAID";
                            $delivery_status = "DELIVERED";
                            $delivery_date = date("d M Y, h:m a");
                            $order_status = "LOCALBILLING";
                            $order_date = date("d M Y, h:m a");
                            $total_amount = $total_amount_mrp;
                            $total_amount_after_discount = $net_payable_amount;
                            $delivery_charge = "NOT_APPLICABLE";
                            $order_month = date("m");
                            $order_year = date("Y");
                            $order_day = date("d");
                            $coupon_code = "NORMAL_BILLING";

                            $saveorder = "INSERT INTO customer_orders (order_id, customer_id, store_id, delivery_address, payment_mode, payment_note, coupon_code, net_payable_amount, payment_status, delivery_status, delivery_date, order_status, order_date, total_amount, total_amount_after_discount, delivery_charge, order_month, order_year, order_day) VALUES ('$ORDERID', '$customer_id', '$store_id', '$delivery_address', '$payment_mode', '$payment_note', '$coupon_code', '$net_payable_amount', '$payment_status', '$delivery_status', '$delivery_date', '$order_status', '$order_date', '$total_amount', '$total_amount_after_discount', '$delivery_charge', '$order_month', '$order_year', '$order_day')";
                            $query =  mysqli_query($con, $saveorder);

                            if ($query == true) {
                              $savepro = "SELECT * from customer_cart where customer_id='$customer_id' and store_id='$store_id'";
                              $query = mysqli_query($con, $savepro);
                              $insert = "";
                              while ($fetch =  mysqli_fetch_assoc($query)) {

                                $product_names = $fetch['user_product_id'];
                                $product_mrp = $fetch['product_mrp'];
                                $product_price = $fetch['product_price'];
                                $product_qty = $fetch['product_quantity'];
                                $product_total_price = $fetch['product_total_amount'];
                                $product_mrp_total = $fetch['mrp_total'];
                                $producttags = $fetch['product_tags'];
                                $product_full_name = "$product_names - $producttags";

                                $insert .= "('$ORDERID', '$store_id', '$customer_id', '$product_full_name', '$product_mrp', '$product_price', '$product_qty', '$product_total_price', '$product_mrp_total'),";
                              }
                              $insert = substr_replace($insert, '', -1, 1);
                              $insert = "INSERT into ordered_products (order_id, store_id, customer_id, product_names, product_mrp, product_price, product_qty, product_total_price, product_mrp_total) VALUES " . $insert;

                              $query =  mysqli_query($con, $insert);
                            }
                            $sql = "DELETE from customer_cart where store_id='$store_id' and customer_id='$customer_id'";
                            $query = mysqli_query($con, $sql);

                            if ($query == true) { ?>
                              <meta http-equiv="refresh" content="1; new_order.php?t=success&m=Created&a=ORDERID : <b><?php echo $ORDERID; ?></b> is Created Successfully! to view Go to Orders." />
                          <?php }
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


  <!-- BEGIN: Vendor JS-->
  <script src="app-assets/vendors/js/vendors.min.js"></script>
  <!-- BEGIN Vendor JS-->

  <!-- BEGIN: Page Vendor JS-->
  <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
  <!-- END: Page Vendor JS-->

  <!-- BEGIN: Theme JS-->
  <script src="app-assets/js/core/app-menu.min.js"></script>
  <script src="app-assets/js/core/app.min.js"></script>
  <script src="app-assets/js/scripts/customizer.min.js"></script>
  <!-- END: Theme JS-->

  <!-- BEGIN: Page JS-->
  <script src="app-assets/js/scripts/pages/page-users.min.js"></script>

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