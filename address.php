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
                                <div class="flex-s-b pb-3" style="display: flex;
    justify-content: space-between;">
                                    <h3 class="spc-responsive">My Addresses</h3>
                                    <a href="add_address.php" class="btn btn-sm btn-primary">Add New Address</a>
                                </div>
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
                                        $customer_addressblock = $fetchAddresses['customer_addressblock'];
                                        $area_locality = $fetchAddresses['area_locality'];
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

                                        $CombineAdddress1 = "<p><b>$contact_person</b><br>$alternate_phone<br> $street_address 
                      $customer_addressblock <br> $area_locality <br> $customer_city $customer_state - $address_pincode <br> $gst_no</p>";

                                        $CombineAdddress2 = "<p><b style='font-size:1rem !important;'>$contact_person</b><br>$alternate_phone<br> $street_address 
                      $customer_addressblock <br> $area_locality <br> $customer_city $customer_state - $address_pincode <br> $gst_no</p>";

                                    ?>
                                        <div class="col-md-6 col-lg-6 col-12 col-sm-6 p-1 bg-white">
                                            <div class="rounded-1 p-2 bg-light shadow-sm" style="height:100% !important;">
                                                <div class="form-group">
                                                    <label>
                                                        <span style="float: right;color:grey;"><i><?php echo $address_type; ?></i></span>
                                                        <?php echo $CombineAdddress2; ?>
                                                    </label><br>
                                                    <a href="delete.php?address_remove=<?php echo $customer_address_id ?>&cid=<?php echo $customer_id; ?>" class="btn btn-sm btn-danger mt-2">Delete</a>
                                                    <a href="edit_address.php?address_id=<?php echo $customer_address_id ?>" class="btn btn-sm btn-warning mt-2">Edit</a>
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
    </section>
    <!-- section end -->


    <?php include 'footer.php'; ?>
</body>

</html>