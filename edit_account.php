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

                                <h3 class="mb-3 spc-responsive">Edit Profile</h3>
                                <form action='insert.php' method="POST">
                                    <input type="text" name="customer_id" value="<?php echo $customer_id; ?>" hidden>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">Full name <span class="required text-danger">*</span></label>
                                                <input class="form-control border-form-control" name="customer_name" value="<?php echo $customer_name; ?>" placeholder="<?php echo $customer_name; ?>" type="text" style="padding: 1.5% !important;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone <span class="required text-danger">*</span></label>
                                                <input class="form-control border-form-control" name="customer_phone_number" value="<?php echo $customer_phone_number; ?>" placeholder="<?php echo $customer_phone_number; ?>" type="text" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Email-ID/Username <span class="required text-danger">*</span></label>
                                                <input class="form-control border-form-control" name="customer_mail_id" value="<?php echo $customer_mail_id; ?>" placeholder="<?php echo $customer_mail_id; ?>" type="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            <button type="submit" name="update_customer_data" class="btn btn-success btn-lg" onclick="SavingData()"><span id="SavingData"><?php
                                                                                                                                                                            if (isset($_GET['details_update'])) {
                                                                                                                                                                                $address_update_value = $_GET['details_update'];
                                                                                                                                                                                if ($_GET['details_update'] == "true") {
                                                                                                                                                                                    echo "<i class='fa fa-check-circle mt-0'></i> Changes Saved!";
                                                                                                                                                                                } elseif ($_GET['details_update'] == "false") {
                                                                                                                                                                                    echo "<i class='fa fa-warning mt-0'></i> Failed!";
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "Save Changes";
                                                                                                                                                                                }
                                                                                                                                                                            } else {
                                                                                                                                                                                echo "Save Changes";
                                                                                                                                                                            }
                                                                                                                                                                            ?></span></button>
                                        </div>
                                    </div>

                                </form>
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