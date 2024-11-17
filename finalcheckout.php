<?php require 'files.php';

if (isset($_POST['billing_address'])) {
  $_SESSION['billing_address'] = $_POST['billing_address'];
} else {
  if (isset($_SESSION['billing_address'])) {
    $_SESSION['billing_address'] = $_SESSION['billing_address'];
  } else {
    $_SESSION['billing_address'] = "Please select billing address...";
  }
}  ?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $store_name; ?> : Cart</title>
  <?php include 'header_files.php'; ?>
  <style>
    input,
    select {
      line-height: 30px !important;
      padding: 0 10px !important;
      height: 30px !important;
    }

    label {
      margin-bottom: 0px !important;
    }

    .checkout-page .checkout-form .form-group {
      margin-bottom: 9px !important;
    }
  </style>
</head>

<body>
  <?php
  include "header.php"; ?>
  <!-- breadcrumb start -->
  <div class="breadcrumb-main " hidden="">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="breadcrumb-contain">
            <div>
              <h2>Checkout</h2>
              <ul>
                <li><a href="index.php">home</a></li>
                <li><i class="fa fa-angle-double-right"></i></li>
                <li><a href="javascript:void(0)">Checkout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- breadcrumb End -->

  <!-- section start -->
  <section class="b-g-light">
    <div class="custom-container">
      <div class="checkout-page contact-page">
        <div class="checkout-form">
          <?php if (isset($_SESSION['customer_id'])) {
            $ip_address = get_ip();
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
            $device_info = "$ip_address$device_type$date_time_c$ipv6_n$ipv6_p$os$OS_release$OS_Version$System_Info$System_more_Info";

            $sql = "UPDATE customer_cart SET customer_id='$customer_id' where device_info='$device_info' and ip_address='$ip_address' and store_id='$store_id'";
            $query = mysqli_query($con, $sql);
            if ($query == true) { ?>
              <div class="row">
                <div class="col-lg-5 col-md-5 col-12 pt-5">
                  <h2>Billing & Shipping Address</h2>
                  <hr>
                  <div class="p-2 mb-4">
                    <h4 class="text-dark text-black-50 mb-1 bg-white p-2 shadow-sm"><i class="fa fa-truck text-success"></i>
                      Delivery Address</h4>
                    <p><?php echo $_SESSION['delivery_address']; ?></p>
                    <a href="checkout.php" class="btn btn-sm btn-info text-white fs-13" style="float: right;">Change Address</a>
                    <br>
                  </div>
                  <div class="p-2 mb-4">
                    <h4 class="text-dark text-black-50 mb-1 bg-white p-2 shadow-sm"><i class="fa fa-inr text-success"></i> Billing
                      Address</h4>
                    <p><?php echo $_SESSION['billing_address']; ?></p>
                    <a href="billing.php" class="btn btn-sm btn-info text-white float-right fs-13" style="float: right;">Change
                      Address</a>
                  </div>
                </div>

                <div class="col-lg-7 col-md-7 col-12">
                  <div class="form-group col-md-12 col-sm-12 col-xs-12 pt-5">
                    <h2>Payment Details</h3>
                      <hr>
                  </div>
                  <form action='insert.php' method="POST">
                    <input typex="text" name="billing_address" value="<?php echo $_SESSION['billing_address']; ?>" hidden="">
                    <input typex="text" name="delivery_address" value="<?php echo $_SESSION['delivery_address']; ?>" hidden="">
                    <div class="checkout-details theme-form">
                      <div class="order-box">
                        <ul class="sub-total">
                          <li>Subtotal <span class="count"><i class="fa fa-inr"></i>
                              <?php echo $_SESSION['product_total_amount_entry']; ?></span></li>
                          <li>Applicable Taxes :
                            <div class="shipping">
                              <div class="shopping-option">
                                <i class="fa fa-inr"></i> <?php echo $_SESSION['delivery_charge']; ?>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <ul class="total">
                          <li>Total <span class="count"><i class="fa fa-inr"></i> <?php echo $_SESSION['net_payable_amount']; ?></span>
                          </li>
                        </ul>
                      </div>
                      <div class="payment-box">
                        <div class="upper-box">
                          <div class="payment-options">
                            <ul>
                              <li>
                                <div class="radio-option">
                                  <input type="radio" name="payment_mode" id="payment-1" value="online_payment">
                                  <label for="payment-1">Online Payment <span class="small-text">Please send a check to Store Name, Store
                                      Street, Store Town, Store State / County, Store Postcode.</span></label>
                                </div>
                              </li>
                              <li>
                                <div class="radio-option">
                                  <input type="radio" name="payment_mode" id="payment-2" value="cash_on_delivery" checked="checked">
                                  <label for="payment-2">Cash On Delivery <span class="small-text"> Please send a check to Store Name,
                                      Store Street, Store Town, Store State / County, Store Postcode.</span></label>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="text-right">
                          <button type="submit" name="save_order_delivery_information" class="btn-normal btn">Place Order</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

              </div>
        </div>
      <?php }
          } else {  ?>
      <div class="row">
        <div class="col-md-12 text-center p-5">
          <div class="p-2">
            <h3 class="p-2">Login into Your Account!</h3>
            <a href="login.php" class="btn btn-primary">Login</a>
            <a href="register.php" class="btn btn-default">Register</a>
          </div>
        </div>
      </div>
    <?php } ?>
      </div>
    </div>
  </section>
  <!-- section end -->


  <?php include 'footer.php'; ?>
</body>

</html>