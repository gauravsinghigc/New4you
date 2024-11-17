<?php

require 'files.php';
$Checking = rand(11111111, 99999999999999) * 367;
$checking2 = random_bytes(1000);
$final = $checking2 . $Checking . $checking2;
$FinalSecure = SECURE($final, "e");
$_SESSION['FINAL_CHECKING'] = $final;
$OnlinePaymentStatus = "<script>document.write(window.atob(sessionStorage.getItem('response')));</script>";
$TxnIdOnlinePayment = "<script>document.write(window.atob(sessionStorage.getItem('txnid')));</script>";
$_SESSION['RESPONSER_ONLINE'] = $OnlinePaymentStatus;
$_SESSION['TXNID_ONLINE'] = $TxnIdOnlinePayment; ?>

<!DOCTYPE html>
<html>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <title><?php echo $store_name; ?> Payment Status</title>
 <?php include 'header_files.php'; ?>
</head>

<body öncontextmenu="return false">
 <!-- breadcrumb start -->
 <div class="breadcrumb-main ">
  <div class="container">
   <div class="row">
    <div class="col">
     <div class="breadcrumb-contain">
      <div>
       <h1>Please do not refresh the page...</h1><br>
       <h2 id="spinner"><i class="fa fa-spinner fa-spin"></i></h2>
       <h6 style="text-transform:none;" id="alarmmsg">We are checking payment status for your order <b>#<?php echo $_SESSION['order_id']; ?></b></h6>

       <p id="payment_detials" style="display:none;">
        <script>
         var session_data = sessionStorage.getItem("txnid");
         var response_code = window.atob(sessionStorage.getItem("response"));
         document.getElementById("payment_detials").innerHTML = "<br> <b>Payment Status : </b> <span class='text-uppercase'>" + response_code + " </span><br> <b>TXNID:</b> " + session_data;
        </script>
       </p>
       <form action="order.php" method="POST" name="processPayment">
        <input text="text" name="token" value="<?php echo $FinalSecure; ?>" hidden="">
        <input text="text" name="r_code" id="r_codes" value="" hidden="">
        <input text="text" name="txnid" id="txnids" value="" hidden="">
       </form>
       <br>
       <p id="actionbtn" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Redirecting to checkout...</p>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
 <script>
  document.getElementById("r_codes").value = response_code;
  document.getElementById("txnids").value = session_data;
 </script>
 <script>
  msg = "We are checking payment status for your order <b>#<?php echo $_SESSION['order_id']; ?></b>";
  document.getElementById("alarmmsg").innerHTML = msg;

  setTimeout(function() {
   document.getElementById("spinner").innerHTML = "<i class='fa fa-check-circle-o'></i>";
   document.getElementById("alarmmsg").innerHTML = 'Response Received from the Payment Gateway.';
   document.getElementById("payment_detials").style.display = "block";
  }, 1200);
 </script>

 <script>
  setTimeout(function() {
   document.getElementById("actionbtn").style.display = "block";
   window.setTimeout(document.processPayment.submit(), 4000);
  }, 2500);
 </script>
 <!-- breadcrumb End -->

 <!-- section end -->

 <?php include 'footer_files.php'; ?>

</body>

</html>