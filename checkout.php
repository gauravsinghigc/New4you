<?php require 'files.php'; ?>
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
      <div class="col-lg-7 col-md-7 col-12">
       <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <div class="flex-s-b">
         <h3>Most Recently Used Addresses</h3>
        </div>
       </div>
       <div class="col-md-12">
        <h2 class="mt-3">Select Delivery Address</h2>
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

                      $CombineAdddress1 = "<p><b>$contact_person</b><br>$customer_phone_number, $alternate_phone<br> $street_address 
                      $customer_addressblock <br> $area_locality <br> $customer_city $customer_state - $address_pincode <br> $gst_no</p>";

                      $CombineAdddress2 = "<p><b style='font-size:1rem !important;'>$contact_person</b><br>$alternate_phone<br> $street_address 
                      $customer_addressblock <br> $area_locality <br> $customer_city $customer_state - $address_pincode <br> $gst_no</p>";

                    ?>
        <div class="col-md-6 col-lg-6 col-12 col-sm-6 p-1 bg-white">
         <div class="rounded-1 p-2 bg-light shadow-sm" style="height:100% !important;">
          <form action="billing.php" method="POST">
           <div class="form-group">
            <label>
             <span style="float: right;color:grey;"><i><?php echo $address_type; ?></i></span>
             <?php echo $CombineAdddress2; ?>
            </label><br>
            <button class="btn btn-primary btn-sm mt-2" type="submit" name="delivery_address"
             value="<?php echo $CombineAdddress1; ?>">Delivery to This Address</button>
            <a href="delete.php?address_remove=<?php echo $customer_address_id ?>&cid=<?php echo $customer_id; ?>"
             class="btn btn-sm btn-danger mt-2">Delete</a>
            <a href="checkouteditaddress.php?address_id=<?php echo $customer_address_id ?>"
             class="btn btn-sm btn-warning mt-2">Edit</a>
           </div>
          </form>
         </div>
         <div class="clearfix"></div>
        </div>
        <?php } ?>
       </div>
      </div>
      <div class="col-lg-5 col-md-5 col-12">
       <form action="insert.php" method="POST">
        <input type="text" name="url" value="checkout.php" hidden="">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
         <br>
         <h3 class="mb-2">Add New Address</h3>
        </div>
        <div class="row">
         <div class="form-group col-md-6 col-sm-6 col-xs-12">
          <label class="control-label">Contact Person</label>
          <input class="form-control border-form-control" name="contact_person" value="" placeholder="" type="text"
           required>
         </div>
         <div class="form-group col-md-6 col-sm-6 col-xs-12">
          <label class="control-label">Alternate Phone</label>
          <input class="form-control border-form-control" name="alt_phone" value="" placeholder="" type="text">
         </div>
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
         <label class="control-label">House/Flat/Street no,</label>
         <textarea class="form-control border-form-control" name="custaddress" value="" rows="3" type="text"
          required=''></textarea>
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
         <label class="control-label">Sector/Area/Block/RoadNo</label>
         <input class="form-control border-form-control" name="customer_addressblock" required="">
        </div>
        <div class="form-group col-md-12 col-sm-6 col-xs-12">
         <label class="control-label">Nearby </label>
         <input class="form-control border-form-control" name="arealocality" value="" type="text" required>
        </div>
        <div class="form-group col-md-12 col-sm-6 col-xs-12">
         <label class="control-label">City</label>
         <input class="form-control border-form-control" name="custcity" value="" type="text" required>
        </div>
        <div class="form-group col-md-12 col-sm-6 col-xs-12">
         <label class="control-label">State</label>
         <input class="form-control border-form-control" name="custstate" value="" type="text" required>
        </div>
        <div class="form-group col-md-12 col-sm-6 col-xs-12">
         <label class="control-label">Select Pincode</label>
         <select name="custpincode" class="form-control" required="">
          <option value="null">Select Pincode</option>
          <?php
                        foreach ($pincodearray as $pins) { ?>
          <option value="<?php echo $pins; ?>"><?php echo $pins; ?></option>
          <?php } ?>
         </select>
        </div>
        <div class="form-group col-md-12 col-sm-6 col-xs-12">
         <label class="control-label">Address Type</label>
         <select class="form-control" name="address_type" required="">
          <option value="Address">Select Address Type</option>
          <option value="Home Address">Home Address</option>
          <option value="Office Address">Office Address</option>
         </select>
        </div>
        <div class="form-group col-md-12 col-sm-6 col-xs-12">
         <label class="control-label">GST No (Optional)</label>
         <input class="form-control border-form-control" name="gst_no" value="" placeholder="" type="text">
        </div>
        <div class="form-group col-md-12 col-sm-6 col-xs-12 pt-2">
         <button class="btn btn-primary btn-sm mt-3" name="save_address" type="submit">Save Address</button>
        </div>
       </form>
      </div>
      <?php }
          } else {  ?>
      <div class="row">
       <div class="col-md-12 text-center p-5">
        <div class="p-2">
         <?php $_SESSION['redirect_url'] = "checkout.php"; ?>
         <h3 class="p-2">Login into Your Account!</h3>
         <a href="login.php" class="btn btn-primary">Login</a>
         <a href="register.php" class="btn btn-default">Register</a>
        </div>
       </div>
      </div>
      <?php } ?>
     </div>
    </div>
   </div>
 </section>
 <!-- section end -->


 <?php include 'footer.php'; ?>
</body>

</html>
