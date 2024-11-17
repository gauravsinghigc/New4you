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
               <div class="account-sidebar"><a class="popup-btn">my account</a></div>
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

                        <h3 class="mb-3 spc-responsive">Edit Address</h3>
                        <form action="update.php" method="POST">
                           <input type="text" name="url" value="address.php" hidden="">
                           <?php
                           if (isset($_GET['address_id'])) {
                              $address_id = $_GET['address_id'];
                              $_SESSION['address_id'] = $_GET['address_id'];
                           } else {
                              $address_id = $_SESSION['address_id'];
                           }
                           $FetchAddress = "SELECT * FROM customer_address where customer_id='$customer_id' and customer_address_id='$address_id'";
                           $QueryAddress = mysqli_query($con, $FetchAddress);
                           $fetchAddresses = mysqli_fetch_assoc($QueryAddress);
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

                           $CombineAdddress = "<p><b>$contact_person</b><br>$address_type<br> $street_address $customer_floor $customer_street_no<br>
                      $customer_addressblock $customer_road $customer_other $customer_sub_area <br> $area_locality $customer_sub_area<br> $customer_city $customer_state - $address_pincode";
                           ?>
                           <div class="row">
                              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                 <label class="control-label">Contact Person</label>
                                 <input class="form-control border-form-control" name="contact_person" value="<?php echo $contact_person; ?>" placeholder="" type="text" required>
                              </div>
                              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                 <label class="control-label">Alternate Phone</label>
                                 <input class="form-control border-form-control" name="alt_phone" value="<?php echo $alternate_phone; ?>" placeholder="" type="text" required>
                              </div>
                           </div>
                           <div class="form-group col-md-12 col-sm-12 col-xs-12">
                              <label class="control-label">House/Flat/Street no,</label>
                              <textarea class="form-control border-form-control" name="custaddress" value="<?php echo $street_address; ?>" rows="3" type="text" required=''><?php echo $street_address; ?></textarea>
                           </div>
                           <div class="form-group col-md-12 col-sm-12 col-xs-12">
                              <label class="control-label">Sector/Area/Block/RoadNo</label>
                              <input class="form-control border-form-control" value="<?php echo $customer_addressblock; ?>" name="customer_addressblock" required="">
                           </div>
                           <div class="form-group col-md-12 col-sm-6 col-xs-12">
                              <label class="control-label">Nearby </label>
                              <input class="form-control border-form-control" name="arealocality" value="<?php echo $area_locality; ?>" type="text" required>
                           </div>
                           <div class="form-group col-md-12 col-sm-6 col-xs-12">
                              <label class="control-label">City</label>
                              <input class="form-control border-form-control" name="custcity" value="<?php echo $customer_city; ?>" type="text" required>
                           </div>
                           <div class="form-group col-md-12 col-sm-6 col-xs-12">
                              <label class="control-label">State</label>
                              <input class="form-control border-form-control" name="custstate" value="<?php echo $customer_state; ?>" type="text" required>
                           </div>
                           <div class="form-group col-md-12 col-sm-6 col-xs-12">
                              <label class="control-label">Select Pincode</label>
                              <select name="custpincode" class="form-control" required="">
                                 <option value="<?php echo $address_pincode; ?>" selected><?php echo $address_pincode; ?></option>
                                 <?php
                                 foreach ($pincodearray as $pins) { ?>
                                    <option value="<?php echo $pins; ?>"><?php echo $pins; ?></option>
                                 <?php } ?>
                              </select>
                           </div>

                           <div class="form-group col-md-12 col-sm-6 col-xs-12">
                              <label class="control-label">Address Type</label>
                              <select class="form-control" name="address_type" required="">
                                 <option class="Home Address">Home Address</option>
                                 <option class="Office Address">Office Address</option>
                              </select>
                           </div>
                           <div class="form-group col-md-12 col-sm-6 col-xs-12">
                              <label class="control-label">GST No (Optional)</label>
                              <input class="form-control border-form-control" name="gst_no" value="<?php echo $gst_no; ?>" placeholder="" type="text">
                           </div>
                           <div class="form-group col-md-12 col-sm-6 col-xs-12 pt-2">
                              <button class="btn btn-primary btn-sm mt-3" name="update_address" type="submit">Update Address</button>
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