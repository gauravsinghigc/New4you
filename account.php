<?php require 'files.php';
if (!isset($_SESSION['customer_id'])) {
    header("location: login.php");
}
?>
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
                            <div class="page-title">
                                <h2>My Account</h2>
                            </div>
                            <div class="welcome-msg">
                                <p>Hello, <?php echo $customer_name; ?></p>
                                <p>From your My Account you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
                            </div>
                            <div class="box-account box-info">

                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="box">
                                            <div class="box-title">
                                                <h3>Contact Information</h3><a href="edit_account.php">Edit</a>
                                            </div>
                                            <div class="box-content">
                                                <h6><?php echo $customer_name; ?></h6>
                                                <h6><?php echo $customer_mail_id; ?></h6>
                                                <h6><?php echo $customer_phone_number; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="box">
                                            <div class="box-title">
                                                <h3>Notifications</h3><a href="notifications.php">View</a>
                                            </div>
                                            <div class="box-content">
                                                <div class="row">
                                                    <div class="col-12 col-xs-12 col-sm-12" style='padding-left:1%; padding-right:1%;'>
                                                        <?php
                                                        $customer_id = $_SESSION['customer_id'];
                                                        $READNOTIFICATION = "UPDATE notifications SET notification_status='READ', read_time=CURRENT_TIMESTAMP where customer_id='$customer_id' and notification_status='NEW'";
                                                        $Query = mysqli_query($con, $READNOTIFICATION);
                                                        if ($Query == true) {

                                                            $sql = "SELECT * FROM notifications where customer_id='$customer_id' ORDER BY notification_id DESC LIMIT 0, 3";
                                                            $query = mysqli_query($con, $sql);
                                                            while ($fetch = mysqli_fetch_assoc($query)) {
                                                                $notification_id = $fetch['notification_id'];
                                                                $notification_title = $fetch['notification_title'];
                                                                $notification_date = $fetch['notification_date'];
                                                                $notification_desc = $fetch['notification_desc'];
                                                                $notification_status = $fetch['notification_status'];
                                                                $read_time = $fetch['read_time'];
                                                                $NotificationReadTime = date("d M, Y", strtotime($read_time));
                                                                $NotificationSendTime = date("d M, Y", strtotime($notification_date)); ?>

                                                                <p style="font-size: 10.5px;
    background-color: #f7f7f7;
    padding: 1%;
    color: black;
    margin-bottom: 1%;
    text-align: justify;
    cursor: pointer;
    box-shadow: 0px 0px 1px grey;" onclick="ShowMsg<?php echo $notification_id; ?>()">
                                                                    <i class="fa fa-bell text-success"></i> <b><?php echo $notification_title; ?></b><br>
                                                                    <span style="float: right;
          margin-top: -6%;
    margin-bottom: -5px;
    font-size: 11px;"><i class="fa fa-clock-o"></i> <?php echo $NotificationSendTime; ?></span>
                                                                </p>
                                                                <script type="text/javascript">
                                                                    function ShowMsg<?php echo $notification_id; ?>() {
                                                                        var NOTDETAILS<?php echo $notification_id; ?> = document.getElementById("NOTDETAILS<?php echo $notification_id; ?>");
                                                                        if (NOTDETAILS<?php echo $notification_id; ?>.style.display == "none") {
                                                                            NOTDETAILS<?php echo $notification_id; ?>.style.display = "block";
                                                                        } else {
                                                                            NOTDETAILS<?php echo $notification_id; ?>.style.display = "none";
                                                                        }
                                                                    }
                                                                </script>
                                                                <div style="padding: 2%;
    border-radius: 25px;
    box-shadow: grey 0px 0px 50px;
    position: fixed;
    bottom: 1%;
    right: 1%;
    z-index: 12;
    font-size: 11px;
    color: black !important;
    width: 45% !important;
    min-width: 200px;
    max-width:350px;
    background-color: white;
    text-align:justify;
    display: none;" id="NOTDETAILS<?PHP echo $notification_id; ?>">
                                                                    <h5><i class="fa fa-bell"></i>
                                                                        <spna class="text-primary"> Notification </spna>
                                                                        <span style="clear: right;float: right;"><i class="fa fa-send"></i> <?php echo $NotificationSendTime; ?> </span>
                                                                    </h5>
                                                                    <p style="color: black;font-size: 13px;">
                                                                        <span style="float: right"><i class="fa fa-info-circle"></i> ID<?php echo $notification_id; ?></span>
                                                                        <b>Notification Title <i class="fa fa-angle-right"></i></b> <?php echo $notification_title; ?><br>
                                                                        <b>Sent at:</b> <?php echo $NotificationSendTime; ?><br>
                                                                        <b>Read at:</b> <?php echo $NotificationReadTime; ?><br><br>
                                                                        <b><i class="fa fa-envelope"></i></b> <?php echo $notification_desc; ?>

                                                                        <hr>
                                                                        <span class="btn btn-lg btn-danger float-right" onclick="ShowMsg<?php echo $notification_id; ?>()" style="cursor: pointer;"><i class="fa fa-times"></i> Close</span>
                                                                    </p>
                                                                </div>

                                                        <?php }
                                                        } ?>




                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="box">
                                        <div class="box-title">
                                            <h3>Address Book</h3>
                                            <a href="address.php">Edit Address</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div style="display: flex;justify-content: flex-start;" class="bg-white row">
                                                    <?php
                                                    $FetchAddress = "SELECT * FROM customer_address where customer_id='$customer_id'";
                                                    $QueryAddress = mysqli_query($con, $FetchAddress);
                                                    while ($fetchAddresses = mysqli_fetch_assoc($QueryAddress)) {
                                                        $customer_address_id = $fetchAddresses['customer_address_id'];
                                                        $customer_id = $fetchAddresses['customer_id'];
                                                        $contact_person = $fetchAddresses['contact_person'];
                                                        $alternate_phone = $fetchAddresses['alternate_phone'];
                                                        $street_address = $fetchAddresses['street_address'];
                                                        $customer_floor = $fetchAddresses['customer_floor'];
                                                        $customer_street_no = $fetchAddresses['customer_street_no'];
                                                        $customer_addressblock = $fetchAddresses['customer_addressblock'];
                                                        $customer_road = $fetchAddresses['customer_road'];
                                                        $customer_other = $fetchAddresses['customer_other'];
                                                        $area_locality = $fetchAddresses['area_locality'];
                                                        $customer_sub_area = $fetchAddresses['customer_sub_area'];
                                                        $customer_city = $fetchAddresses['customer_city'];
                                                        $customer_state = $fetchAddresses['customer_state'];
                                                        $address_pincode = $fetchAddresses['address_pincode'];
                                                        $address_type = $fetchAddresses['address_type'];
                                                        $gst_no = $fetchAddresses['gst_no'];
                                                        if ($gst_no == null or $gst_no == "") {
                                                            $gst_no = "";
                                                        } else {
                                                            $gst_no = "<br><b>GST No:</b> " . $gst_no;
                                                        }

                                                        $CombineAdddress = "<p><b>$contact_person</b><br>$address_type<br> $street_address $customer_floor $customer_street_no<br>
                      $customer_addressblock $customer_road $customer_other $customer_sub_area <br> $area_locality $customer_sub_area<br> $customer_city $customer_state - $address_pincode";

                                                        $CombineAdddress2 = "<p><b style='font-size:1rem !important;'>$contact_person</b><br>Phone no. : $alternate_phone<br> $street_address $customer_floor $customer_street_no<br>
                      $customer_addressblock $customer_road $customer_other $customer_sub_area <br> $area_locality $customer_sub_area<br> $customer_city $customer_state - $address_pincode $gst_no";

                                                    ?>
                                                        <div class="col-md-6 col-lg-6 col-12 col-sm-6 p-1 bg-white">
                                                            <div class="rounded-1 p-2 bg-light shadow-sm" style="height:100% !important;">
                                                                <div class="form-group">
                                                                    <label>
                                                                        <span style="float: right;color:grey;"><i><?php echo $address_type; ?></i></span>
                                                                        <?php echo $CombineAdddress2; ?>
                                                                    </label><br>
                                                                    <a href="delete.php?address_remove=<?php echo $customer_address_id ?>&cid=<?php echo $customer_id; ?>" class="btn btn-sm btn-danger mt-2 text-white">Delete</a>
                                                                    <a href="edit_address.php?address_id=<?php echo $customer_address_id ?>" class="btn btn-sm btn-warning mt-2 text-black">Edit</a>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
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
    <!-- section end -->


    <?php include 'footer.php'; ?>
</body>

</html>