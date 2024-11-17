<?php
require 'files.php';
if (isset($_GET['id'])) {
    $ORDERID = $_GET['id'];
} else {
    header("location: orders.php");
}

$SelectUserDetails = "SELECT * from customer_orders where order_id='$ORDERID'";
$QueryUserDetails = mysqli_query($con, $SelectUserDetails);
$FetchUserDetails = mysqli_fetch_assoc($QueryUserDetails);
$store_id = $FetchUserDetails['store_id'];
$customer_id = $FetchUserDetails['customer_id'];

//order details
$delivery_address = $FetchUserDetails['delivery_address'];
$payment_mode = $FetchUserDetails['payment_mode'];
$payment_note = $FetchUserDetails['payment_note'];
$coupon_code = $FetchUserDetails['coupon_code'];
$net_payable_amount = $FetchUserDetails['net_payable_amount'];
$payment_status = $FetchUserDetails['payment_status'];
$delivery_status = $FetchUserDetails['delivery_status'];
$delivery_date = $FetchUserDetails['delivery_date'];
$order_status = $FetchUserDetails['order_status'];
$order_date = $FetchUserDetails['order_date'];
$total_amount = $FetchUserDetails['total_amount'];
$total_amount_after_discount = $FetchUserDetails['total_amount_after_discount'];
$delivery_charge = $FetchUserDetails['delivery_charge'];

//customer_details
$sql = "SELECT * FROM customers where customer_id='$customer_id'";
$query =  mysqli_query($con, $sql);
$fetch =  mysqli_fetch_assoc($query);
$customer_name = $fetch['customer_name'];
$customer_mail_id = $fetch['customer_mail_id'];
$customer_phone_number = $fetch['customer_phone_number'];

//store information
$sql = "SELECT * FROM stores where store_id='$store_id'";
$query = mysqli_query($con, $sql);
$fetch_store = mysqli_fetch_assoc($query);
$store_name = $fetch_store['store_name'];
$store_phone = $fetch_store['store_phone'];
$store_mail_id = $fetch_store['store_mail_id'];
$store_address = $fetch_store['store_address'];
$store_arealocality = $fetch_store['store_arealocality'];
$store_city = $fetch_store['store_city'];
$store_state = $fetch_store['store_state'];
$store_pincode = $fetch_store['store_pincode'];
$store_gst = $fetch_store['GST'];
$store_pan = $fetch_store['PAN'];
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title><?php echo $ORDERID; ?> : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click"
 data-menu="vertical-menu-modern" data-col="2-columns">
 <!-- BEGIN: Content-->
 <div class="app-content content" style="margin-left: 0px !important;">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
   <div class="content-header row">
    <div class="col-lg-12 card-content">
     <?php notification(); ?>
    </div>
   </div>

   <div class="content-body">
    <!-- users list start -->
    <section class="app-invoice-wrapper">
     <div class="row">

      <div class="col-xl-12 col-md-12 col-12 printable-content" id="printableArea">
       <!-- using a bootstrap card -->
       <div class="card">
        <!-- card body -->
        <div class="card-body p-2">
         <!-- card-header -->
         <div class="card-header px-0">
          <div class="row">
           <div class="col-md-12 col-lg-6 col-xl-6 mb-50">
            <span class="invoice-id font-weight-bold">INVOICE NO: </span>
            <span> #<?php echo $ORDERID; ?></span>
           </div>
           <div class="col-md-12 col-lg-6 col-xl-6">
            <div class="d-flex align-items-center justify-content-end justify-content-xs-start">
             <div class="issue-date pr-2">
              <span class="font-weight-bold no-wrap">Billing Date: </span>
              <span><?php echo $order_date; ?></span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <!-- invoice logo and title -->
         <div class="invoice-logo-title row py-2">
          <div class="col-6 d-flex flex-column justify-content-center align-items-start">
           <h2 class="text-primary">Invoice</h2>
          </div>
         </div>
         <hr>
         <!-- invoice address and contacts -->
         <div class="row invoice-adress-info py-2">
          <div class="col-6 mt-1 from-info" style="float: left;">
           <div class="info-title mb-1">
            <span><b>Customer Details</b></span>
           </div>
           <div class="company-name mb-1">
            <p>
             <?php echo $customer_name; ?><br>
             <?php echo $customer_phone_number; ?><br>
             <?php echo $customer_mail_id; ?><br>
             <?php echo $delivery_address; ?>
            </p>
           </div>
          </div>
          <div class="col-6 mt-1 to-info" style="float: right;">
           <div class="info-title mb-1">
            <span><b>Store Information</b></span>
           </div>
           <div class="company-name mb-1">
            <p><?php echo $store_name; ?><br>
             <?php echo $store_phone; ?><br>
             <?php echo $store_mail_id; ?><br>
             <?php echo $store_address; ?> <?php echo $store_arealocality; ?> <?php echo $store_city; ?><br>
             <?php echo $store_state; ?> - <?php echo $store_pincode; ?><br>
             <b>GST:</b> <?php echo $store_gst; ?>
             <br><b>PAN:</b> <?php echo $store_pan; ?>
            </p>

           </div>
          </div>
         </div>

         <!--product details table -->
         <div class="product-details-table py-2 table-responsive">
          <table class="table table-borderless" style="width: 100%;font-size: 13px;">
           <thead>
            <tr>
             <th scope="col" align="left">ITEM Name</th>
             <th scope="col" align="left">Price</th>
             <th scope="col" align="left">QTY</th>
             <th scope="col" align="left">PRICE</th>
            </tr>
           </thead>
           <tbody>
            <?php
                                                $sql = "SELECT * FROM ordered_products where order_id='$ORDERID' and customer_id='$customer_id' and store_id='$store_id'";
                                                $query = mysqli_query($con, $sql);
                                                while ($fetch = mysqli_fetch_assoc($query)) {
                                                ?>
            <tr>
             <td><?php echo $fetch['product_names']; ?></td>
             <td>Rs.<?php echo $fetch['product_price']; ?> </td>
             <td>x <?php echo $fetch['product_qty']; ?></td>
             <td class="font-weight-bold">Rs.<?php echo $fetch['product_total_price']; ?></td>
            </tr>
            <?php } ?>
           </tbody>
          </table>
         </div>
         <hr>

         <!-- invoice total -->
         <div class="invoice-total py-2">
          <div class="row">
           <div class="col-6 col-md-6 col-lg-6 mt-75" style="float: left;">
            <p>
             <b>Payment Mode:</b> <?php echo $payment_mode; ?><br>
             <b>Payment Details:</b> <?php echo $payment_note; ?><br>
             <b>Status:</b> <?php echo $payment_status; ?>
            </p>
           </div>
           <div class="col-6 col-lg-6 col-md-6 d-flex justify-content-end mt-75" style="float: right;">
            <ul class="list-group cost-list" style="list-style-type: none;">
             <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
              <span class="cost-title mr-2">SubTotal</span>
              <span class="cost-value">Rs.<?php
                                                                                    $select = "SELECT sum(product_total_price) FROM ordered_products where store_id='$store_id' and customer_id='$customer_id' and order_id='$ORDERID'";
                                                                                    $action = mysqli_query($con, $select);
                                                                                    while ($record = mysqli_fetch_array($action)) {
                                                                                        echo $total_amount = $record['sum(product_total_price)'];
                                                                                    }
                                                                                    ?></span>
             </li>
             <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
              <span class="cost-title mr-2">Net Payable Amount</span>
              <span class="cost-value">
               <h2><span id="number">Rs.<?php
                                                                                        $select = "SELECT sum(product_total_price) FROM ordered_products where store_id='$store_id' and customer_id='$customer_id' and order_id='$ORDERID'";
                                                                                        $action = mysqli_query($con, $select);
                                                                                        while ($record = mysqli_fetch_array($action)) {
                                                                                            echo $total_amount = $record['sum(product_total_price)'];
                                                                                        }
                                                                                        ?></span></h2>
              </span>
              <p id="words"></p>
             </li>
            </ul>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>

      <!-- buttons section -->
      <div class="col-xl-12 col-md-12 col-12">
       <div class="card">
        <div class="card-body p-2 text-center">
         <a onclick="printPageArea('printableArea')" class="btn btn-info btn-md mb-1 text-white"> <i
           class="fa fa-print"></i> Print</a>
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

 <script type="text/javascript">
 function printPageArea(areaid) {
  var printContent = document.getElementById(areaid);
  var WinPrint = window.open('', '', 'width=1200,height=650');
  WinPrint.document.write(printContent.innerHTML);
  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();
  WinPrint.close();
 }
 </script>
 <script type="text/javascript">
 var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ',
  'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '
 ];
 var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

 function inWords(num) {
  if ((num = num.toString()).length > 9) return 'overflow';
  n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
  if (!n) return;
  var str = '';
  str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
  str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
  str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
  str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
  str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
  return str;
 }

 document.getElementById('number').onkeyup = function() {
  document.getElementById('words').innerHTML = inWords(document.getElementById('number').value);
 };
 </script>

</body>
<!-- END: Body-->

</html>