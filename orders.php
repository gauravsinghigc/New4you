<?php require 'files.php';
if (!isset($_SESSION['customer_id'])) {
    header("location: login.php");
} ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $store_name; ?> : My Account</title>
    <?php include 'header_files.php'; ?>
</head>

<body>
    <?php
    include "header.php"; ?>
    <!-- section start -->
    <section class="section-big-py-space b-g-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="account-sidebar"><a class="popup-btn">More Details</a></div>
                    <div class="dashboard-left">
                        <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span></div>
                        <div class="block-content ">
                            <ul>
                                <li><a href="account.php">My Account</a></li>
                                <li><a href="orders.php">My Orders</a></li>
                                <li><a href="address.php">My Addresses</a></li>
                                <li><a href="notifications.php">Notification</a></li>
                                <li><a href="account_settings.php">Acccount Settings</a></li>
                                <li><a href="logout.php">Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="dashboard-right">
                        <div class="dashboard">
                            <div class="box-account box-info">

                                <h3 class="mb-3 spc-responsive">My Orders</h3>
                                <section class="container-fluid pb-2" style="padding-left: 1%;
    padding-right: 1%;">
                                    <div class="row">
                                        <?php
                                        if (!isset($_SESSION['customer_id'])) { ?>
                                            <meta http-equiv="refresh" content="0, home.php" />
                                        <?php }
                                        $customer_id = $_SESSION['customer_id'];
                                        if (isset($_GET['type'])) {
                                            $type = $_GET['type'];
                                            $sql = "SELECT * FROM customer_orders where customer_id='$customer_id' and order_status='$type' ORDER BY customer_order_id DESC ";
                                        } else {
                                            $sql = "SELECT * FROM customer_orders where customer_id='$customer_id' ORDER BY customer_order_id DESC ";
                                        }

                                        $query = mysqli_query($con, $sql);
                                        $count = mysqli_num_rows($query);
                                        if ($count == 0) { ?>
                                            <div class="col-sm-12 col-xs-12 mt-4">

                                                <center>
                                                    <img src="app/img/noresult.gif" style='width:45%;border-radius: 50%;box-shadow: 0px 0px 0.5px grey;' class="d-block mx-auto">
                                                    <hr class="w-50">
                                                    <h3>Ooops...</h3>
                                                    <h4>No Orders Found in your account.</h4>
                                                    <a href="home.php" class="btn btn-info btn-sm font-5 p-3 text-white"><i class="fa fa-angle-left mt-0"></i> Buy
                                                        Products</a>
                                                </center>
                                            </div>
                                            <?php } else {
                                            while ($fetch = mysqli_fetch_assoc($query)) {
                                                $del_charge = $fetch['delivery_charge'];
                                                $order_price = $fetch['total_amount_after_discount'];

                                            ?>

                                                <div class="col-xs-12 col-sm-12 mb-2 bg-white">
                                                    <div class="row" style="padding:1%; border-radius:5px;background-color: #f3f1f1;">
                                                        <div class="col-sm-1 col-xs-2 col-2" style='padding:0%;'>
                                                            <img src='app/img/referral-icon2.png' class='img-fluid text-center' style='background-color: #80808040;
    border-radius: 50%;
    padding: 10%;
    margin-top: 17%;'>
                                                        </div>
                                                        <div class="col-sm-11 col-xs-10 col-10 bg-grey">
                                                            <a href="order_details.php?id=<?php echo $fetch['order_id']; ?>">
                                                                <h5 class="text-left font-3 mb-0">ID# <?php echo $fetch['order_id']; ?> </h5>
                                                                <p style="color: black; font-size: 13px;margin-bottom: 0px;">Date : <?php echo $fetch['order_date']; ?><br>
                                                                    <div style="width: 30%;
    height: 0px;
    margin-top: 9px;
    margin-bottom: -12px;"><b style="font-size: 17px;
    color: green;
    background-color: #ece9e9;
    padding: 3%;
    border-radius: 20px;
    padding-left: 6%;
    padding-right: 6%;
    box-shadow: 0px 0px 1px grey;"><i class="fa fa-inr"></i>
                                                                            <?php echo $fetch['net_payable_amount'] ?></b></div>
                                                                    <span class="float-right" style="margin-top: -4.5%;
    color: #020000;
    background-color: #ffffff;
    padding: 0.5%;
    padding-left: 2%;
    border-radius: 20px;
    padding-right: 2%;
    font-size: 12px;
    box-shadow: 0px 0px 1px grey;
    float:right !important;">
                                                                        <?php $order_status = $fetch['order_status'];
                                                                        $order_status = str_replace('_', ' ', $order_status);
                                                                        if ($order_status == "NEW ORDER") {
                                                                            echo "<i class='fa fa-star text-warning'></i> $order_status";
                                                                        } elseif ($order_status == "ACCEPTED") {
                                                                            echo "<i class='fa fa-check-circle text-success'></i> $order_status";
                                                                        } elseif ($order_status == "OUT FOR DELIVERY") {
                                                                            echo "<i class='fa fa-truck text-info'></i> $order_status";
                                                                        } elseif ($order_status == "REJECTED") {
                                                                            echo "<i class='fa fa-times text-danger'></i> $order_status";
                                                                        } elseif ($order_status == "UNDELIVERED") {
                                                                            echo "<i class='fa fa-times text-danger'></i> <i class='fa fa-truck text-info'></i> $order_status";
                                                                        } elseif ($order_status == "DELIVERED") {
                                                                            echo "<i class='fa fa-check-circle text-success'></i> <i class='fa fa-truck text-info'></i> $order_status";
                                                                        } else {
                                                                            echo "<i class='fa fa-info text-danger'></i> $order_status";
                                                                        } ?></span><br>
                                                                    <div style="float:right !important;display: flex;
    justify-content: center;">
                                                                        <a href="order_details.php?id=<?php echo $fetch['order_id']; ?>" class='btn btn-sm btn-success text-white float-right' style="margin-top: -7%; margin: 0.5%;"><i class="fa fa-list mt-0"></i> Details</a>
                                                                        <a href="invoice.php?order_id=<?php echo $fetch['order_id']; ?>" class='btn btn-sm btn-success text-white float-right' target="blank" style="margin-top: -7%;margin: 0.5%;"><i class="fa fa-file mt-0"></i> Invoice</a>
                                                                        <a href="track-order.php?order_id=<?php echo $fetch['order_id']; ?>" class='btn btn-sm btn-success text-white float-right' style="margin-top: -7%;margin: 0.5%;"><i class="fa fa-map-marker mt-0"></i> Track</a>
                                                                    </div>
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php }
                                        } ?>
                                    </div><br><br><br>
                                </section>
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