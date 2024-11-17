<?php
require 'files.php';
require 'session.php';
$title_name = "Customers";
if (isset($_GET['customer_id'])) {
  $_SESSION['CUST_VIEW_ID'] = $_GET['customer_id'];
  $customer_id = $_SESSION['CUST_VIEW_ID'];
} elseif (isset($_GET['search'])) {
  $SearchCustomers = $_GET['search'];
  $SelectCustomers = "SELECT * FROM customers";
  $CustomerQuery = mysqli_query($con, $SelectCustomers);
  while ($fetchCustomer = mysqli_fetch_assoc($CustomerQuery)) {
    $CustomerIDS = $fetchCustomer['customer_id'];
    $CustomerPhone = $fetchCustomer['customer_phone_number'];
    $CustomerName = $fetchCustomer['customer_name'];
    $CustomerArea = $fetchCustomer['arealocality'];

    $SearchFormat = "$CustomerPhone - $CustomerName - $CustomerArea";

    if ($SearchFormat == $SearchCustomers) {
      $customer_id = $CustomerIDS;
      $_SESSION['CUST_VIEW_ID'] = $customer_id;
    } else {
      $customer_id = $_SESSION['CUST_VIEW_ID'];
    }
  }
} else {
  $customer_id = $_SESSION['CUST_VIEW_ID'];
}
$sql = "SELECT * FROM customers where customer_id='$customer_id'";
$query =  mysqli_query($con, $sql);
$fetch =  mysqli_fetch_assoc($query);

$customer_id = $fetch['customer_id'];
$customer_name = $fetch['customer_name'];
$customer_mail_id = $fetch['customer_mail_id'];
$customer_phone_number = $fetch['customer_phone_number'];
$custaddress = $fetch['custaddress'];
$custcity = $fetch['custcity'];
$custstate = $fetch['custstate'];
$custpincode = $fetch['custpincode'];
$arealocality = $fetch['arealocality'];
$contactperson = $fetch['contactperson'];
$alternatenumber = $fetch['alternatenumber'];
$customer_middlename = $fetch['customer_middlename'];
$customer_lastname = $fetch['customer_lastname'];
$customer_street_no = $fetch['customer_street_no'];
$customer_addressblock = $fetch['customer_addressblock'];
$customer_road = $fetch['customer_road'];
$customer_other  = $fetch['customer_other'];
$customer_sub_area = $fetch['customer_sub_area'];
$customer_floor = $fetch['customer_floor'];

if ($alternatenumber == null) {
  $alternatenumber = "Not Available";
} else {
  $alternatenumber = "+91-" . $alternatenumber;
}
$customer_reg_date = $fetch['customer_reg_date'];
$customer_password = $fetch['customer_password'];
$customer_image = $fetch['customer_image'];
if ($customer_image == null) {
  $customer_image = "user.jpg";
} else {
  $customer_image = $customer_image;
}
$CustomerStatus = $fetch['customer_status'];
if ($CustomerStatus == "verified") {
  $CustomerStatus = "<i class='fa fa-check-circle text-success'></i>";
} else {
  $CustomerStatus = "<i class='fa fa-warning text-danger'></i>";
}

$customer_completeaddress = "$custaddress  $customer_floor $customer_street_no $customer_addressblock $customer_road  $customer_other $customer_sub_area $arealocality $custcity $custstate $custpincode";


if ($customer_name == null) {
  header("location: customers.php");
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="<?php echo $PosName; ?>">
  <title><?php echo $title_name; ?> : <?php echo $PosName; ?></title>
  <?php include 'header_files.php'; ?>
  <style type="text/css">
    .col-md-6,
    .col-sm-12 {
      padding-left: 1px !important;
      padding-right: 1px !important;
    }
  </style>

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
        </div>
      </div>

      <div class="content-body">
        <!-- users list start -->
        <section class="users-list-wrapper">
          <div class="users-list-table">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-lg-2 col-md-2 col-sm-2 col-12 col-xs-12 mb-2" style="background-color: aliceblue;margin-top: 1%;">
                        <img src="<?php echo $UserImg; ?>/<?php echo $customer_image; ?>" class="d-block mx-auto img-fluid" style="padding: 2%;box-shadow: 0px 0px 2px grey;
    border-radius: 49%;margin-top: 30%;">
                      </div>

                      <div class="col-lg-10 col-md-10 col-sm-10 col-12 col-xs-12" style="font-size:12px !important;">
                        <h4 class="mb-0 pb-0 pl-0" style="font-size:15px !important;"><i class="fa fa-user text-primary"></i>
                          <?php echo $customer_name; ?> <small><?php echo $CustomerStatus; ?></small>
                        </h4>

                        <div class="btn-group float-md-right float-right" role="group" aria-label="Button group with nested dropdown" style="margin-top: -13px;">
                          <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary dropdown-toggle dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-gears"></i> Action</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                              <a href="edit_customer.php?id=<?php echo $customer_id; ?>" class="dropdown-item pl-0 pr-0" style="margin-top: 0px !important;"><i class="fa fa-edit"></i> Edit Profile</a>
                              <a href="<?php echo $MDomain; ?>" target="blank" class="dropdown-item pl-0 pr-0" style="margin-top: 0px !important;"><i class="fa fa-eye"></i> View Profile</a>
                            </div>
                          </div>
                        </div>

                        <p><i class="fa fa-calendar text-danger"></i> &nbsp;Reg Date : <?php echo $customer_reg_date; ?><br>
                          <i class="fa fa-share text-success"></i>
                          <?php $SQL_referred_person = "SELECT * from referred_person where referred_phone='$customer_phone_number'";
                          $QUERY_referred_person = mysqli_query($con, $SQL_referred_person);
                          $FETCH_referred_person = mysqli_fetch_array($QUERY_referred_person);
                          $CounRefers = mysqli_num_rows($QUERY_referred_person);
                          if ($CounRefers == 0) {
                            echo "Self Registration";
                          } else {
                            $referred_customer_id = $FETCH_referred_person['customer_id'];
                            $SQL_customers = "SELECT * FROM customers where customer_id='$referred_customer_id'";
                            $QUERY_customers = mysqli_query($con, $SQL_customers);
                            $FETCH_REF_customers = mysqli_fetch_assoc($QUERY_customers);
                            $ReferredCustomername = $FETCH_REF_customers['customer_name'];
                            $ReferredCustomerId = $FETCH_REF_customers['customer_id'];
                            echo "Referred By <i class='fa fa-angle-double-right'></i> <a href='cust_details.php?customer_id=$ReferredCustomerId'><i class='fa fa-user text-primary'> $ReferredCustomername</i></a>";
                          }
                          ?>
                        </p>
                        <hr class="mt-1 mb-0">
                        <style type="text/css">
                          table tr th,
                          td {
                            padding: 0.4% !important;
                            text-align: left !important;
                          }
                        </style>
                        <table class="table table-striped" style="font-size:12px !important;">
                          <tbody>
                            <tr>
                              <th style="width:15%;"><i class="fa fa-user text-primary"></i> Full Name</th>
                              <td><?php echo $customer_name; ?></td>
                            </tr>
                            <tr>
                              <th><i class="fa fa-phone text-primary"></i> Phone Number</th>
                              <td><a href='tel:<?php echo $customer_phone_number; ?>'>+91-<?php echo $customer_phone_number; ?></a>
                              </td>
                            </tr>
                            <tr>
                              <th><i class="fa fa-envelope text-primary"></i> Email ID</th>
                              <td><a href='mailto:<?php echo $customer_mail_id; ?>'><?php echo $customer_mail_id; ?></a></td>
                            </tr>
                            <tr>
                              <th><i class="fa fa-map-marker text-primary"></i> Address</th>
                              <td><?php echo $customer_completeaddress; ?></td>
                            </tr>
                            <tr>
                              <th><i class="fa fa-address-book-o text-primary"></i> Contact Person</th>
                              <td><?php echo "$contactperson"; ?></td>
                            </tr>
                            <tr>
                              <th><i class="fa fa-address-book-o text-primary"></i> Alt Phone</th>
                              <td><a href='tel:<?php echo $alternatenumber; ?>'><?php echo $alternatenumber; ?></a></td>
                            </tr>
                            <tr>
                              <th><i class="fa fa-key text-primary"></i> Password</th>
                              <td><span id="Password">************</span>
                                <button class="btn btn-sm btn-primary float-right" onclick="ShowPass()" id="ButtonColor"><span id="ButtonName"><i class="fa fa-eye"></i></span></button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 pl-0 pr-0">
                        <ul class="nav nav-tabs nav-top-border" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" role="tab" aria-selected="true"><i class="fa fa-shopping-cart text-success"></i> Orders</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" role="tab" aria-selected="false"><i class="fa fa-inr text-success"></i> Payments</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#tab3" role="tab" aria-selected="false"><i class="fa fa-star text-danger"></i> Reward Points</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#tab4" role="tab" aria-selected="false"><i class="fa fa-star text-warning"></i> Interests</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="base-tab5" data-toggle="tab" aria-controls="tab5" href="#tab5" role="tab" aria-selected="false"><i class="fa fa-shopping-cart text-danger"></i> Cart Items</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="base-tab6" data-toggle="tab" aria-controls="tab6" href="#tab6" role="tab" aria-selected="false"><i class="fa fa-bell text-success"></i> Notifications</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="base-tab7" data-toggle="tab" aria-controls="tab7" href="#tab7" role="tab" aria-selected="false"><i class="fa fa-share text-danger"></i> Referrences</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="base-tab8" data-toggle="tab" aria-controls="tab8" href="#tab8" role="tab" aria-selected="false"><i class="fa fa-info-circle text-primary"></i> Help & Queries</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="base-tab10" data-toggle="tab" aria-controls="tab10" href="#tab10" role="tab" aria-selected="false"><i class="fa fa-heart text-success"></i> Reviews</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="base-tab9" data-toggle="tab" aria-controls="tab9" href="#tab9" role="tab" aria-selected="false"><i class="fa fa-sign-in text-primary"></i> LoginLogs</a>
                          </li>
                        </ul>
                        <!-- ALL orders Tabs -->
                        <div class="tab-content pt-1">
                          <div class="tab-pane active mt-3" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                            <div class="table-responsive customers-orders">
                              <table class="table table-striped zero-configuration">
                                <thead>
                                  <tr>
                                    <th>ORDER ID</th>
                                    <th>Payment Mode</th>
                                    <th>Rewards Points</th>
                                    <th class="text-center">
                                      Order Amount</th>
                                    <th class="hidden-xs">
                                      Payment</th>
                                    <th>ORDER Date</th>
                                    <th>Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $sql = "SELECT * FROM customer_orders, customers where customers.customer_id=customer_orders.customer_id and customers.customer_id='$customer_id' ORDER BY customer_orders.customer_order_id DESC";
                                  $query = mysqli_query($con, $sql);
                                  $count = mysqli_num_rows($query);
                                  if ($count == 0) {
                                    echo "<tr align='center'>
                                  <td colspan='8'><h3><i class='fa fa-warning'></i><br></h3><h3>No Orders are Available!</h3>
                                </tr>";
                                  } else {
                                    while ($fetch = mysqli_fetch_assoc($query)) {
                                      $payment_mode = $fetch['payment_mode'];
                                      if ($payment_mode == "Online Payment") {
                                        $p_s = "";
                                      } elseif ($payment_mode == "Cash On Delivery") {
                                        $p_s = "p_s=Paid";
                                      } ?>
                                      <tr>
                                        <td>
                                          <a href="<?php echo $MDomain; ?>/invoice.php?id=<?php echo $fetch['order_id']; ?>" class='text-info' style="padding: 1%; font-size: 12px;" target="blank">#<?php echo $fetch['order_id']; ?></a>
                                        </td>
                                        <td>
                                          <?php echo $fetch['payment_mode']; ?></td>
                                        <td>
                                          <?php echo $fetch['coupon_code']; ?></td>
                                        <td class="text-center">
                                          Rs.<?php echo $fetch['net_payable_amount']; ?></td>
                                        <td class="text-success">
                                          <?php echo $fetch['payment_status']; ?>
                                        <td class="hidden-xs">
                                          <?php echo $fetch['order_date']; ?></td>
                                        <td>
                                          <?php echo $fetch['order_status']; ?>
                                        </td>
                                      </tr>
                                  <?php }
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <!-- ALL PAYMENTS Tabs -->
                          <div class="tab-pane mt-3" id="tab2" role="tabpanel" aria-labelledby="base-tab2">
                            <div class="table-responsive customers-orders">
                              <table class="table table-striped zero-configuration">
                                <thead>
                                  <tr>
                                    <th>ORDER ID</th>
                                    <th>Payment Mode</th>
                                    <th>Coupon Code</th>
                                    <th class="text-center">Order Amount</th>
                                    <th class="hidden-xs">Order Date</th>
                                    <th>Payment</th>
                                  </tr>
                                </thead>

                                <tbody>
                                  <?php
                                  $sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id and customer_orders.customer_id='$customer_id'";
                                  $query = mysqli_query($con, $sql);
                                  $count = mysqli_num_rows($query);
                                  if ($count == 0) {
                                    echo "<tr align='center'>
                                                        <td colspan='8'><h3><i class='fa fa-warning'></i><br></h3><h3>No Orders are Available!</h3>
                                                    </tr>";
                                  } else {
                                    while ($fetch = mysqli_fetch_assoc($query)) {
                                      $payment_mode = $fetch['payment_mode'];

                                      if ($payment_mode == "online_payment") {
                                        $p_s = "";
                                      } elseif ($payment_mode == "Cash On Delivery") {
                                        $p_s = "p_s=Paid";
                                      } ?>
                                      <tr>
                                        <td style="padding: 1%; font-size: 12px;">
                                          <h4><a href="invoice.php?id=<?php echo $fetch['order_id']; ?>" class='text-info' style="padding: 1%; font-size: 12px;"><?php echo $fetch['order_id']; ?></a></h4>
                                        </td>
                                        <td><?php echo $fetch['payment_mode']; ?></td>
                                        <td><?php echo $fetch['coupon_code']; ?></td>
                                        <td class="text-center"><B>Rs.<?php echo $fetch['net_payable_amount']; ?></B></td>
                                        <td class="hidden-xs"><?php echo $fetch['order_date']; ?></td>
                                        <td><?php echo $fetch['payment_status']; ?>
                                      </tr>
                                  <?php }
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <!-- All reward Points -->
                          <div class="tab-pane mt-3" id="tab3" role="tabpanel" aria-labelledby="base-tab3">
                            <div class="table-responsive customers-orders">
                              <table class="table table-striped zero-configuration">
                                <thead>
                                  <tr>
                                    <th style="width: 5% !important;">#</th>
                                    <th style="width: 19% !important;">OrderId</th>
                                    <th style="width: 5% !important;">Points</th>
                                    <th style="width: 10% !important;">DateTime</th>
                                    <th style="width: 9% !important;">Status</th>
                                    <th style="width: 20% !important;">Is Reffered?</th>
                                    <th style="width: 10% !important">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $customer_rewards = "SELECT * FROM customer_rewards where customer_id='$customer_id'";
                                  $customer_rewards_query = mysqli_query($con, $customer_rewards);
                                  $count = 0;
                                  while ($Fetch_customer_rewards = mysqli_fetch_assoc($customer_rewards_query)) {
                                    $count++; ?>
                                    <tr>
                                      <td><?php echo $count; ?></td>
                                      <td><a href="<?php echo $MDomain; ?>/invoice.php?id=<?php echo $Fetch_customer_rewards['order_id']; ?>" class='text-info' style="padding: 1%; font-size: 12px;" target="blank">#<?php echo $Fetch_customer_rewards['order_id']; ?></a></td>
                                      <td><?php echo $Fetch_customer_rewards['rewards_point']; ?></td>
                                      <td><?php echo $Fetch_customer_rewards['reward_date']; ?></td>
                                      <td><?php echo $Fetch_customer_rewards['reward_status']; ?></td>
                                      <td><?php if ($Fetch_customer_rewards['reward_by'] == null) {
                                            echo "<span class='text-danger'>No, </span> Direct Credit on Order.";
                                          } else {
                                            $RefferedId = $Fetch_customer_rewards['reward_by'];
                                            $select = "SELECT * FROM customers where customer_id='$RefferedId'";
                                            $selectquery = mysqli_query($con, $select);
                                            $fetchref = mysqli_fetch_assoc($selectquery);
                                            $refcustomername = $fetchref['customer_name'];
                                            echo "<span class='text-success'>Yes,</span> By <a href='cust_details.php?customer_id=$RefferedId'>$refcustomername</a>";
                                          } ?></td>
                                      <td align="center"><a href="#" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Details</a>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <!-- All Intrest submitted -->
                          <div class="tab-pane mt-3" id="tab4" role="tabpanel" aria-labelledby="base-tab4">
                            <div class="table-responsive customers-orders">
                              <table class="table table-striped zero-configuration">
                                <thead>
                                  <tr>
                                    <th>INTEREST TYPE</th>
                                    <th>Date</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $SelectUsers = "SELECT * FROM interest, customers where interest.customer_id=customers.customer_id";
                                  $count = 0;
                                  $SelectUsersQuery = mysqli_query($con, $SelectUsers);
                                  while ($SelectUsersFetch =  mysqli_fetch_assoc($SelectUsersQuery)) {
                                    $customer_name = $SelectUsersFetch['customer_name'];
                                    $phone_number = $SelectUsersFetch['customer_phone_number'];
                                    $interest_type = $SelectUsersFetch['interest_type'];
                                    $date_time = $SelectUsersFetch['submitdate'];
                                    $count++;
                                  ?>
                                    <tr>
                                      <td>
                                        <?php echo $interest_type; ?>
                                      </td>
                                      <td><?php echo $date_time; ?></td>

                                    </tr>
                                  <?php } ?>

                                </tbody>
                              </table>
                            </div>
                          </div>

                          <!-- All Cart Items -->
                          <div class="tab-pane mt-3" id="tab5" role="tabpanel" aria-labelledby="base-tab5">
                            <div class="table-responsive customers-orders">
                              <table class="table table-striped zero-configuration">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Img</th>
                                    <th>ProductName</th>
                                    <th>ProductTags</th>
                                    <th>Product Price</th>
                                    <th>Product MRP</th>
                                    <th>Qty</th>
                                    <th>Total Price</th>
                                    <th>MRP Total</th>
                                    <th>Add Date</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $SQL_CustomerCartItems = "SELECT * FROM customer_cart where customer_id='$customer_id'";
                                  $QUERY_CustomerCart = mysqli_query($con, $SQL_CustomerCartItems);
                                  $CountSNo = 0;
                                  while ($FETCH_CustomerCart = mysqli_fetch_assoc($QUERY_CustomerCart)) {
                                    $CountSNo++;
                                    $ProductId = $FETCH_CustomerCart['device_info'];
                                    $SQL_Products = "SELECT * from user_products where user_product_id='$ProductId'";
                                    $QUERY_Products = mysqli_query($con, $SQL_Products);
                                    $FETCH_Products = mysqli_fetch_array($QUERY_Products);
                                    $BrandId = $FETCH_Products['product_brand_id'];

                                    $SQL_Brands = "SELECT * FROM pro_brands where brand_id='$BrandId'";
                                    $QUERY_Brands = mysqli_query($con, $SQL_Brands);
                                    $FETCH_Brands = mysqli_fetch_array($QUERY_Brands);
                                    $BrandTitle = $FETCH_Brands['brand_title']; ?>
                                    <tr>
                                      <td style="width:2% !important;"><?php echo $CountSNo; ?></td>
                                      <td style="width:3% !important;padding:0px !important;" align="center">
                                        <a href="img/store_img/<?php echo $FETCH_CustomerCart['product_img']; ?>" target="blank">
                                          <center><img src="img/store_img/<?php echo $FETCH_CustomerCart['product_img']; ?>" class="img-fluid" style="box-shadow: 0px 0px 2px grey;border-radius: 3px; width:49%;"></center>
                                        </a>
                                      </td>
                                      <td style="width:20% !important;"><a href="edit_product.php?product_id=<?php echo $ProductId; ?>"><?php echo $FETCH_CustomerCart['user_product_id']; ?>
                                          - <i><small><?php echo $FETCH_CustomerCart['hindi_name']; ?> -
                                              <?php echo $BrandTitle; ?></small></i></a></td>
                                      <td style="width:5% !important;"><?php echo $FETCH_CustomerCart['product_tags']; ?></td>
                                      <td style="width:5% !important;"><i class="fa fa-inr mt-0"></i>
                                        <?php echo $FETCH_CustomerCart['product_price']; ?></td>
                                      <td style="width:5% !important;"><i class="fa fa-inr mt-0"></i>
                                        <?php echo $FETCH_CustomerCart['product_mrp']; ?></td>
                                      <td style="width:5% !important;">x<?php echo $FETCH_CustomerCart['product_quantity']; ?></td>
                                      <td style="width:5% !important;"><i class="fa fa-inr mt-0"></i>
                                        <?php echo $FETCH_CustomerCart['product_total_amount']; ?></td>
                                      <td style="width:5% !important;"><i class="fa fa-inr mt-0"></i>
                                        <?php echo $FETCH_CustomerCart['mrp_total']; ?></td>
                                      <td style="width:15% !important;"><?php echo $FETCH_CustomerCart['cart_add_date']; ?></td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <!----- Tab5 End -->

                          <!-- All Notifications -->
                          <div class="tab-pane mt-3" id="tab6" role="tabpanel" aria-labelledby="base-tab6">
                            <div class="table-responsive customers-orders">
                              <table class="table table-striped zero-configuration table-hover" style="font-size: 12px !important;">
                                <thead>
                                  <tr>
                                    <th style="width: 5% !important;">#</th>
                                    <th style="width: 32% !important;">Notification Title</th>
                                    <th style="width: 17% !important;">Sent DateTime</th>
                                    <th style="width: 8% !important;">Status</th>
                                    <th style="width: 15% !important;">Read Time</th>
                                    <th style="width: 13% !important;">Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $SelectNotifications = "SELECT * FROM notifications where customer_id='$customer_id' ORDER BY notification_id DESC";
                                  $NotificationQuery = mysqli_query($con, $SelectNotifications);
                                  $CountNotifications = mysqli_num_rows($NotificationQuery);
                                  $CountSno = 0;
                                  if ($CountNotifications == 0) {
                                    echo "<tr><td colspan='7'><h2>No Notifications Found!</h2></td></tr>";
                                  } else {
                                    while ($FetchNotifications = mysqli_fetch_assoc($NotificationQuery)) {
                                      $CountSno++;
                                      $NotificationId = $FetchNotifications['notification_id'];
                                      $CustomerId = $FetchNotifications['customer_id'];
                                      $NotificationsTitle = $FetchNotifications['notification_title'];
                                      $NotificationDatetime = date("d M Y h:m A", strtotime($FetchNotifications['notification_date']));
                                      $NotificationStatus = $FetchNotifications['notification_status'];
                                      $ReadTime = date("d M Y h:m A", strtotime($FetchNotifications['read_time']));
                                      $NotficationDesc = $FetchNotifications['notification_desc'];

                                      $SelectCustome = "SELECT * FROM customers where customer_id='$CustomerId'";
                                      $CustomerQuery = mysqli_query($con, $SelectCustome);
                                      $FetchCustomer = mysqli_fetch_assoc($CustomerQuery);
                                      $CustomerName = $FetchCustomer['customer_name'];

                                      echo "<tr>
                                                        <td>$CountSno</td>
                                                        <td><a href='#' data-toggle='modal' data-target='#ViewModal$NotificationId'>$NotificationsTitle</a></td>
                                                        <td>$NotificationDatetime</td>
                                                        <td>$NotificationStatus</td>
                                                        <td>$ReadTime</td>
                                                        <td><a href='#' class='btn btn-info btn-sm' data-toggle='modal' data-target='#ViewModal$NotificationId'>View Details</a></td>
                                                      </tr>"; ?>
                                      <!-- Modal -->

                                      <div class="modal fade text-left" id="ViewModal<?php echo $NotificationId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h4 class="modal-title font-medium-2" id="myModalLabel1"><i class="fa fa-bell text-success"></i>
                                                Notifications <i class="fa fa-angle-right"></i> <?php echo $NotificationsTitle; ?> </h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <p>
                                                <b>NotificationId :</b> <?php echo $NotificationId; ?><br>
                                                <b>SentDateTime :</b> <?php echo $NotificationDatetime; ?><br>
                                                <b>CustomerName :</b> <?php echo $CustomerName; ?><br>
                                                <b>NotificationsTitle :</b> <?php echo $NotificationsTitle; ?><br>
                                                <b>NotficationDesc :</b> <?php echo $NotficationDesc; ?><br>
                                                <b>NotificationStatus :</b> <?php echo $NotificationStatus; ?><br>
                                                <b>ReadTime :</b> <?php echo $ReadTime; ?><br>

                                              </p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  <?php }
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <!----- Tab6 End -->

                          <!-- All References -->
                          <div class="tab-pane mt-3" id="tab7" role="tabpanel" aria-labelledby="base-tab7">
                            <div class="table-responsive customers-orders">
                              <table class="table table-striped zero-configuration table-hover" style="font-size: 12px !important;">
                                <thead>
                                  <tr>
                                    <th style="width: 5% !important;">#</th>
                                    <th style="width: 32% !important;">CustomerName</th>
                                    <th style="width: 17% !important;">PhoneNumber</th>
                                    <th style="width: 8% !important;">EmailId</th>
                                    <th style="width: 15% !important;">RefferedDate</th>
                                    <th style="width: 13% !important;">Orders</th>
                                    <th>Cart Items</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $SQL_referred_person = "SELECT * from referred_person where customer_id='$customer_id'";
                                  $QUERY_referred_person = mysqli_query($con, $SQL_referred_person);
                                  $CountSNo = 0;
                                  while ($FETCH_referred_person = mysqli_fetch_array($QUERY_referred_person)) {
                                    $CountSNo++;
                                    $referred_phone = $FETCH_referred_person['referred_phone'];
                                    $SQL_customers = "SELECT * FROM customers where customer_phone_number='$referred_phone'";
                                    $QUERY_customers = mysqli_query($con, $SQL_customers);
                                    $FETCH_REF_customers = mysqli_fetch_assoc($QUERY_customers);
                                    $RefferPersionCustomerId = $FETCH_REF_customers['customer_id']; ?>
                                    <tr>
                                      <td><?php echo $CountSNo; ?></td>
                                      <td><a href="cust_details.php?customer_id=<?php echo $FETCH_REF_customers['customer_id']; ?>"><i class='fa fa-user'></i> <?php echo $FETCH_REF_customers['customer_name']; ?></a></td>
                                      <td><a href="tel:<?php echo $FETCH_REF_customers['customer_phone_number']; ?>"><i class='fa fa-phone'></i> <?php echo $FETCH_REF_customers['customer_phone_number']; ?></a></td>
                                      <td><a href="mailto:<?php echo $FETCH_REF_customers['customer_mail_id']; ?>"><i class='fa fa-envelope'></i> <?php echo $FETCH_REF_customers['customer_mail_id']; ?></a></td>
                                      <td><?php echo $FETCH_referred_person['refer_date']; ?></td>
                                      <td><?php
                                          $SQL_REF_Orders = "SELECT * from customer_orders where customer_id='$RefferPersionCustomerId'";
                                          $QUERY_REF_Orders = mysqli_query($con, $SQL_REF_Orders);
                                          $CountRefOrders = mysqli_num_rows($QUERY_REF_Orders);
                                          if ($CountRefOrders == 0) {
                                            echo "0 Orders";
                                          } else {
                                            echo $CountRefOrders . " Orders";
                                          } ?></td>
                                      <td>
                                        <?php
                                        $SQL_REF_customer_cart = "SELECT * FROM customer_cart where customer_id='$RefferPersionCustomerId'";
                                        $QUERY_REF_customer_cart = mysqli_query($con, $SQL_REF_customer_cart);
                                        $CountRefCartItems = mysqli_num_rows($QUERY_REF_customer_cart);
                                        if ($CountRefCartItems == 0) {
                                          echo "0 Items";
                                        } else {
                                          echo "$CountRefCartItems Items";
                                        } ?>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <!----- Tab7 End -->

                          <!-- All References -->
                          <div class="tab-pane mt-3" id="tab8" role="tabpanel" aria-labelledby="base-tab8">
                            <div class="table-responsive customers-orders">
                              <table class="table table-striped zero-configuration">
                                <thead>
                                  <tr>
                                    <th>S.NO</th>
                                    <th>Subject</th>
                                    <th>FULL NAME</th>
                                    <th>Phone Number</th>
                                    <th>Email ID</th>
                                    <th>QUERY SOURCE</th>
                                    <th>Date</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $Select = "SELECT * FROM queryies where phone_number='$customer_phone_number' order by query_id DESC";
                                  $query = mysqli_query($con, $Select);
                                  $CountQuery = mysqli_num_rows($query);
                                  if ($CountQuery == 0) {
                                    echo "<tr><td colspan='7' align='center'><h4><b>No Query Found!</b></h4></td></tr>";
                                  } else {
                                    while ($fetch = mysqli_fetch_assoc($query)) {
                                      $query_id = $fetch['query_id'];
                                      $full_name = $fetch['full_name'];
                                      $email = $fetch['email'];
                                      $phone_number = $fetch['phone_number'];
                                      $query_subject = $fetch['query_subject'];
                                      $query_details = $fetch['query_details'];
                                      $QUERY_SOURCE = $fetch['QUERY_SOURCE'];
                                      $device_details = $fetch['device_details'];
                                      $date_time = $fetch['date_time'];

                                      echo "<tr>
                                                                <td><a href='query.php?id=$query_id'>#QUERYID$query_id</a></td>
                                                                <td>$query_subject</td>
                                                                <td>$full_name</td>
                                                                <td>$phone_number</td>
                                                                <td>$email</td>
                                                                <td>$QUERY_SOURCE</td>
                                                                <td>$date_time</td>
															</tr>";
                                    }
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <!----- Tab8 End -->

                          <!-- All References -->
                          <div class="tab-pane mt-3" id="tab9" role="tabpanel" aria-labelledby="base-tab9">
                            <div class="table-responsive customers-orders">
                              <table class="table table-striped zero-configuration" style="font-size: 12px !important;">
                                <thead>
                                  <tr>
                                    <th style="width: 5% !important;">#</th>
                                    <th style="width: 18% !important;">Ip Address</th>
                                    <th style="width: 8% !important;">DeviceType</th>
                                    <th style="width: 7% !important;">VisitorType</th>
                                    <th style="width: 13% !important;">VisitingDOT</th>
                                    <th style="width: 7% !important;">Page</th>
                                    <th style="width: 7% !important;">UserStatus</th>
                                    <th style="width: 8% !important">Source</th>
                                    <th style="width: 12%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $visitors = "SELECT * FROM visitors where CustomerId='$customer_id'";
                                  $visitorsquery = mysqli_query($con, $visitors);
                                  $count = 0;
                                  while ($fetchvisitors = mysqli_fetch_assoc($visitorsquery)) {
                                    $count++; ?>
                                    <tr>
                                      <td><?php echo $count; ?></td>
                                      <td><?php echo $fetchvisitors['IpAddress']; ?></td>
                                      <td><?php echo $fetchvisitors['DeviceType']; ?></td>
                                      <td><?php echo $fetchvisitors['VisitorType']; ?></td>
                                      <td><?php echo $fetchvisitors['VistingDOT']; ?></td>
                                      <td><?php echo $fetchvisitors['VisitingUrl']; ?></td>
                                      <td><?php echo $fetchvisitors['UserStatus']; ?></td>
                                      <td><?php echo $fetchvisitors['VisitingSource']; ?></td>
                                      <td><a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ViewModal<?php echo $fetchvisitors['VisitorId']; ?>"><i class="fa fa-list"></i>
                                          Details</a></td>
                                    </tr>
                                    <!-- Modal -->

                                    <div class="modal fade text-left" id="ViewModal<?php echo $fetchvisitors['VisitorId']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title font-medium-2" id="myModalLabel1"><i class="fa fa-history text-success"></i>
                                              Visitor Logs <i class="fa fa-angle-right"></i> <?php echo $fetchvisitors['VisitorId']; ?> <i class="fa fa-sign-out"></i> <?php echo $fetchvisitors['IpAddress']; ?> </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <p>
                                              <b>VisitorId :</b> <?php echo $fetchvisitors['VisitorId']; ?><br>
                                              <b>VistingDOT :</b> <?php echo $fetchvisitors['VistingDOT']; ?><br>
                                              <b>DeviceType :</b> <?php echo $fetchvisitors['DeviceType']; ?><br>
                                              <b>VisitorType :</b> <?php echo $fetchvisitors['VisitorType']; ?><br>
                                              <b>VisitingUrl :</b> <?php echo $fetchvisitors['VisitingUrl']; ?><br>
                                              <b>VisitingCounts :</b> <?php echo $fetchvisitors['VisitingCounts']; ?><br>
                                              <b>VisitingSource :</b> <?php echo $fetchvisitors['VisitingSource']; ?><br>
                                              <b>DeviceInformations :</b> <?php echo $fetchvisitors['DeviceInformations']; ?><br>
                                            </p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                            <?php if ($fetchvisitors['UserStatus'] == "Login") { ?>
                                              <a href="cust_details.php?customer_id=<?php echo $fetchvisitors['CustomerId']; ?>" class="btn btn-outline-primary">View Profile</a>
                                            <?php } ?>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                  <?php } ?>
                                </tbody>

                              </table>
                            </div>
                          </div>
                          <!----- Tab9 End -->

                          <!-- All References -->
                          <div class="tab-pane mt-3" id="tab10" role="tabpanel" aria-labelledby="base-tab10">
                            <div class="table-responsive customers-orders">
                              <table class="table table-striped zero-configuration" style="font-size: 12px !important;">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>StarCounts</th>
                                    <th>ReviewTitle</th>
                                    <th>ProReviewCreatedOn</th>
                                    <th>Responses</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $product_reviews = "SELECT * FROM product_reviews where ProReviewUserType='$customer_id' ORDER BY ProReviewId DESC";
                                  $product_reviews_query = mysqli_query($con, $product_reviews);
                                  $count = 0;
                                  while ($fetchreviws = mysqli_fetch_assoc($product_reviews_query)) {
                                    $count++; ?>
                                    <tr>
                                      <td><?php echo $count; ?></td>
                                      <td>#REW<?php echo $fetchreviws['ProReviewId']; ?></td>
                                      <td>
                                        <?php
                                        $CountStar = $fetchreviws['ProReviewStarCount'];
                                        $RatingCounts = 0;
                                        while ($RatingCounts < $CountStar) {
                                          echo "<i class='fa fa-star text-warning mt-0'></i>";
                                          $RatingCounts++;
                                        } ?>
                                      </td>
                                      <td><a href="#" data-toggle="modal" data-target="#ViewModal<?php echo $fetchreviws['ProReviewId']; ?>"><?php echo $fetchreviws['ProReviewTitle']; ?></a></td>
                                      <td><?php echo $fetchreviws['ProReviewCreatedOn']; ?></td>
                                      <td>
                                        <span><i class="fa fa-thumbs-up text-success"></i><?php
                                                                                          $SQL_product_reviews_count = "SELECT * FROM product_reviews_counts where ReviewsType='HELPFULL' and ProReviewId='" . $fetchreviws['ProReviewId'] . "'";
                                                                                          $QUERY_product_reviews_counts = mysqli_query($con, $SQL_product_reviews_count);
                                                                                          $COUNT_product_reviews_counts_true = mysqli_num_rows($QUERY_product_reviews_counts);
                                                                                          if ($COUNT_product_reviews_counts_true == 0) {
                                                                                            echo "0";
                                                                                          } else {
                                                                                            echo $COUNT_product_reviews_counts_true;
                                                                                          } ?></span> /
                                        <span><i class="fa fa-thumbs-down text-danger"></i><?php
                                                                                            $SQL_product_reviews_count = "SELECT * FROM product_reviews_counts where ReviewsType='REPORTED' and ProReviewId='" . $fetchreviws['ProReviewId'] . "'";
                                                                                            $QUERY_product_reviews_counts = mysqli_query($con, $SQL_product_reviews_count);
                                                                                            $COUNT_product_reviews_counts_false = mysqli_num_rows($QUERY_product_reviews_counts);
                                                                                            if ($COUNT_product_reviews_counts_false == 0) {
                                                                                              echo "0";
                                                                                            } else {
                                                                                              echo $COUNT_product_reviews_counts_false;
                                                                                            } ?></span>
                                      </td>
                                      <td><?php
                                          $status = $fetchreviws['ProReviewStatus'];
                                          $ProReviewId = $fetchreviws['ProReviewId'];
                                          $ProReviewTitle = $fetchreviws['ProReviewTitle'];
                                          if ($status == "NEW") {
                                            echo "<a href='update.php?update_reviews=$ProReviewId&status=HIDE&name=$ProReviewTitle'><i class='fa fa-eye btn btn-sm btn-black'></i></a>";
                                          } else {
                                            echo "<a href='update.php?update_reviews=$ProReviewId&status=NEW&name=$ProReviewTitle'><i class='fa fa-eye-slash btn btn-sm btn-danger'></i></a>";
                                          } ?></td>
                                      <td><a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ViewModal<?php echo $fetchreviws['ProReviewId']; ?>"><i class="fa fa-list"></i></a>
                                      </td>
                                    </tr>
                                    <!-- Modal -->

                                    <div class="modal fade text-left" id="ViewModal<?php echo $fetchreviws['ProReviewId']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                      <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title font-medium-4" id="myModalLabel1"><i class="fa fa-history text-success"></i> <?php echo $title_name; ?> <i class="fa fa-angle-right"></i> <?php echo $fetchreviws['ProReviewTitle']; ?> </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="row">
                                              <?php
                                              $SQL_user_products = "SELECT * FROM user_products where user_product_id='" . $fetchreviws['ProductId'] . "'";
                                              $QUERY_user_products = mysqli_query($con, $SQL_user_products);
                                              $FETCH_user_products = mysqli_fetch_assoc($QUERY_user_products); ?>
                                              <div class="col-lg-4 col-md-4 col-sm-12 col-12 p-1 pr-1">
                                                <img src="<?php echo $img_url; ?>/store_img/pro_img/<?php echo $FETCH_user_products['product_img']; ?>" class="img-fluid" style="border-radius: 15px;">
                                              </div>
                                              <div class="col-lg-8 col-md-8 col-sm-12 col-12 pl-1">
                                                <h5 class="mb-0 font-medium-4 pl-0 ml-0">Product Details :</h5>
                                                <hr class="mb-1 mt-0">
                                                <p>
                                                  <b>Product Title :</b> <?php echo $FETCH_user_products['product_title']; ?><br>
                                                  <b>Alternate Name :</b> <?php echo $FETCH_user_products['hindi_name']; ?><br>
                                                  <b>Product Price:</b> <b>OFFER PRICE <i class="fa fa-angle-right"></i></b> Rs.<?php echo $FETCH_user_products['product_offer_price']; ?>
                                                  | <b>MRP PRICE :</b> <?php echo $FETCH_user_products['product_mrp_price']; ?><br>
                                                  <b>Item Measuring Unit :</b> <?php echo $FETCH_user_products['product_tags']; ?><br>
                                                  <b>Item Referance :</b> <?php echo $FETCH_user_products['product_type']; ?><br>
                                                  <b>In Stock :</b> <?php echo $FETCH_user_products['stockcount']; ?><br>
                                                  <b>Status :</b> <?php echo $FETCH_user_products['product_status']; ?>
                                                </p>
                                                <a href="edit_product.php?product_id=<?php echo $FETCH_user_products['user_product_id']; ?>" class="btn btn-md btn-black">View Product Details <i class="fa fa-angle-right"></i></a>
                                              </div>
                                            </div>
                                            <p class="mt-1">
                                            <h4 class="font-medium-4">Review Details :
                                              <hr>
                                            </h4>
                                            <b>ProReviewCreatedOn :</b> <?php echo $fetchreviws['ProReviewCreatedOn']; ?><br>
                                            <b>ProReviewId :</b> #REW<?php echo $fetchreviws['ProReviewId']; ?><br>
                                            <b>ProductId :</b> <?php echo $fetchreviws['ProductId']; ?><br>
                                            <b>ProReviewStarCount :</b> <?php
                                                                        $CountStar = $fetchreviws['ProReviewStarCount'];
                                                                        $RatingCounts = 0;
                                                                        while ($RatingCounts < $CountStar) {
                                                                          echo "<i class='fa fa-star text-warning mt-0'></i>";
                                                                          $RatingCounts++;
                                                                        } ?><br>
                                            <b>ProReviewTitle :</b> <?php echo $fetchreviws['ProReviewTitle']; ?><br>
                                            <b>ProReviewName :</b> <?php echo $fetchreviws['ProReviewName']; ?><br>
                                            <b>ProReviewEmail :</b> <?php echo $fetchreviws['ProReviewEmail']; ?><br>
                                            <b>ProReviewDesc :</b> <?php echo $fetchreviws['ProReviewDesc']; ?><br>
                                            <b>ProReviewUserType :</b> <?php echo $fetchreviws['ProReviewUserType']; ?>
                                            <?php
                                            if ($fetchreviws['ProReviewStatus'] == "Unknown") {
                                              echo "(user is not registered!)";
                                            } else { ?>
                                              <B>(Registered User)</B> <a href="cust_details.php?customer_id=<?php echo $fetchreviws['ProReviewUserType']; ?>" class="btn btn-primary btn-sm">View Profile <i class="fa fa-angle-right"></i></a>
                                            <?php } ?><br>
                                            <b>ProReviewStatus :</b> <?php echo $fetchreviws['ProReviewStatus']; ?>
                                            </p>
                                            <h5 class="font-medium-4">ProReviewDeviceDetails :
                                              <hr>
                                            </h5>
                                            <p><?php echo $fetchreviws['ProReviewDeviceDetails']; ?></p>
                                            <h5 class="font-medium-4">Responses On Reviews :
                                              <hr>
                                            </h5>
                                            <p>
                                              <b>Helpfull/Usefull/Like :</b> <span><i class="fa fa-thumbs-up text-success"></i><?php echo $COUNT_product_reviews_counts_true; ?></span> Received<br>
                                              <b>Reported/Unusefull/Dislike :</b> <span class=""><i class="fa fa-thumbs-down text-danger"></i><?php echo $COUNT_product_reviews_counts_false; ?></span> Received<br>
                                            </p>
                                            <h4 class="pl-0 pr-1 mb-0">
                                              <a href="reviews_submitted.php" class="btn btn-primary btn-md w-50 d-block mx-auto">
                                                <b>View All Like or Dislike submitted devices/customers
                                                  <i class="fa fa-angle-right"></i>
                                                </b>
                                              </a>
                                            </h4>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <!----- Tab10 End -->



                        </div>
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
  <script type="text/javascript">
    $(document).ready(function() {
      $('#table_id').DataTable();
    });

    function ShowPass() {
      var Password = document.getElementById('Password').innerHTML;
      var ButtonName = document.getElementById('ButtonName').innerHTML;

      if (Password === "************") {
        document.getElementById("Password").innerHTML = "<?php echo $customer_password; ?>";
        document.getElementById("ButtonName").innerHTML = "<i class='fa fa-eye-slash'></i>";
        document.getElementById("ButtonName").classList.add("btn btn-sm btn-danger float-right");
      } else {
        document.getElementById("Password").innerHTML = "************";
        document.getElementById("ButtonName").innerHTML = "<i class='fa fa-eye'></i>";
        document.getElementById("ButtonName").classList.add("btn btn-sm btn-primary float-right");
      }
    }
  </script>

</body>
<!-- END: Body-->

</html>