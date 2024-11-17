<?php require 'files.php';
$date_time = date("dmy");
$_SESSION['order_id'] = $_COOKIE['order_id']; ?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $store_name; ?> Payment</title>
  <?php include 'header_files.php'; ?>

</head>

<body öncontextmenu="return false">
  <!-- breadcrumb start -->
  <div class="breadcrumb-main">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="breadcrumb-contain">
            <div>
              <h1>Please do not refresh the page...</h1>
              <h2 class="text-lowercase">We are executing payment for order ID : <?php echo $_SESSION['order_id']; ?></h2>
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
        <div>
          <div class="card-body">
            <div class="text-left">

              <?php
              $payment_mode = $_SESSION['payment_mode'];
              $order_id = $_SESSION['order_id'];
              $customer_id = $_SESSION['customer_id'];
              $net_payable_amount = $_SESSION['net_payable_amount'];
              $customer_mail_id = $customer_mail_id;
              $store_id;
              $customer_phone_number;

              if ($payment_mode == "online_payment") { ?>
                <h3 class="text-center">Online Payment</h3>
                <br>
                <p class="text-center">You choose Online Payment as a Payment Option, so click on Place Order button than your are redirect to our Payment Gateway. complete the Payment and then after Payment Success your order is Placed Successfully!</p>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <form method="post" action="pgRedirect.php" id="cartCheckout" name="payment_req">
                      <input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo $order_id; ?>" hidden="">
                      <input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $customer_id; ?>" hidden="">
                      <input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" hidden="">
                      <input id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB" hidden="">
                      <input title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo $net_payable_amount; ?>" hidden="">
                      <input title="PHONE_NUMBER" tabindex="10" type="text" name="PHONE_NUMBER" value="<?php echo $customer_phone_number; ?>" hidden="">
                      <input title="EMAIL" tabindex="10" type="text" name="EMAIL" value="<?php echo $customer_mail_id; ?>" hidden="">
                      <button type="submit" onload="form.submit()" value="Checkout" class="btn btn-success btn-md">Click to Retry <i class="fa fa-refresh"></i></button>
                    </form>
                    <a href="checkout.php" class="btn btn-link text-primary text-decoration-none"><i class="fa fa-angle-left"></i> Back to Checkout</a>
                  </div>
                </div>
                <br><br>
                <p class="text-center"><code>*</code> Your payment is safe and secure with us. Please feel free to make this transaction with us.</p>
              <?php

              } else { ?>
                <center>
                  <img src="img/7VozH.gif" style="width: 25%;">
                  <meta http-equiv="refresh" content="1, order_mail.php">
                  <h3><i class="fa fa-refresh fa-spin text-success"></i> Creating Order, Please wait...</h3>
                </center>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    document.write(payment_response_code);
  </script>
  <!-- section end -->
  <SCRIPT TYPE="text/javascript">
    function disableselect(e) {
      return false
    }

    function reEnable() {
      return true
    }
    //if IE4+
    document.onselectstart = new Function("return false")
    //if NS6
    if (window.sidebar) {
      document.onmousedown = disableselect
      document.onclick = reEnable
    }
  </SCRIPT>

  <script>
    window.onload = function() {
      $("#rzp-button1").click();
    }
  </script>
  <script>
    window.onload = function() {
      document.forms['payment_req'].submit();
    }
  </script>

  <script>
    $('#modal-close').click(function() {
      location.replace('<?php echo $DOMAIN; ?>/checkout.php');
    });
  </script>
</body>

</html>