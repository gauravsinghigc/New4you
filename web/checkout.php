<?php
require 'files.php';
if (isset($_GET['data'])) { ?>
   <meta http-equiv="refresh" content="3; checkout.php">
<?php } elseif (isset($_GET['msg'])) { ?>
   <meta http-equiv="refresh" content="3; checkout.php">
<?php } elseif (isset($_GET['err'])) { ?>
   <meta http-equiv="refresh" content="3; checkout.php">
<?php } else {
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title><?php echo $store_name; ?> : Checkout</title>
   <?php require 'header_files.php'; ?>
</head>

<body>
   <?php require 'header.php'; ?>

   <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <a href="index.php"><strong><span class="fa fa-home"></span> Home</strong></a> <span class="fa fa-angle-right"></span> <a href="">Checkout</a>
            </div>
         </div>
      </div>
   </section>

   <section class="checkout-page section-padding">
      <div class="container">
         <div class="row">
            <div class="col-md-8 mx-auto">
               <form action='insert.php' method="POST">
                  <div class="checkout-step">
                     <div class="accordion" id="accordionExample">
                        <div class="card checkout-step-one">
                           <div class="card-header" id="headingOne">
                              <h5 class="mb-0">
                                 <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="number">1</span>
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
                                       if ($query == true) {
                                          echo "Account Details";
                                       }
                                    } else {
                                       echo  "Login into Your Account";
                                    } ?>
                                 </button>
                              </h5>
                           </div>
                           <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">
                                 <?php
                                 if (isset($_SESSION['customer_id'])) { ?>
                                    <p><b>Name:</b> <?php echo $customer_name; ?><br>
                                       <b>Phone number:</b> <?php echo $customer_phone_number; ?><br>
                                       <b>Email-id:</b> <?php echo $customer_mail_id; ?>
                                    </p>
                                    <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn btn-secondary mb-2 btn-lg">Next</button>
                                 <?php } else { ?>
                                    <a href="login.php" class="btn btn-link btn-secondary text-white"><i class="fa fa-sign-in"></i> Login/Sign Up</a>
                                 <?php } ?>
                              </div>
                           </div>
                        </div>
                        <div class="card checkout-step-two">
                           <div class="card-header" id="headingTwo">
                              <h5 class="mb-0">
                                 <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="number">2</span> Delivery Address
                                 </button>
                              </h5>
                           </div>
                           <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body">
                                 <input type="text" name="cr_url" value="<?php get_url(); ?>" hidden>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                          <label class="control-label">Street Address<span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="street_address" value="<?php echo $street_address; ?>" placeholder="<?php echo $area_locality; ?>" type="text" required=''>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Area/Locality/NearBy<span class="required">*</span></label>
                                          <select class="form-control" name="area_locality" required=''>
                                             <option value="<?php echo $store_arealocality_cr; ?>"><?php echo $store_arealocality_cr; ?></option>
                                             <?php
                                             $sql = "SELECT * FROM services_area where area_locality!='$store_arealocality_cr' and area_status='active'";
                                             $query = mysqli_query($con, $sql);
                                             while ($fetch = mysqli_fetch_assoc($query)) {
                                                $area_localityall = $fetch['area_locality'];
                                                echo "<option value='$area_localityall'>$area_localityall</option>";
                                             }
                                             ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">City<span class="required">*</span></label>
                                          <select class="form-control" name="customer_city">
                                             <option value="<?php echo $store_city_cr; ?>"><?php echo $store_city_cr; ?></option>
                                             <?php
                                             $sql = "SELECT * FROM city where city_name!='$store_city_cr' and city_state='active'";
                                             $query = mysqli_query($con, $sql);
                                             while ($fetch = mysqli_fetch_assoc($query)) {
                                                $city_nameall = $fetch['city_name'];
                                                echo "<option value='$city_nameall'>$city_nameall</option>";
                                             }
                                             ?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">State<span class="required">*</span></label>
                                          <select class="form-control" name="customer_state">
                                             <option value="<?php echo $customer_state; ?>"><?php echo $customer_state; ?></option>
                                             <?php
                                             $sql = "SELECT * FROM state where state_status='active' and state_name!='$customer_state'";
                                             $query = mysqli_query($con, $sql);
                                             while ($fetch = mysqli_fetch_assoc($query)) {
                                                $state_name = $fetch['state_name'];
                                                echo "<option value='$state_name'>$state_name</option>";
                                             }
                                             ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Pincode<span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="address_pincode" value="<?php echo $address_pincode; ?>" placeholder="<?php echo $address_pincode; ?>" type="text" required=''>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Contact Person<span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="contact_person" value="<?php echo $contact_person; ?>" placeholder="<?php echo $contact_person; ?>" type="text">
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Alternate Number<span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="alternate_phone" value="<?php echo $alternate_phone; ?>" placeholder="<?php echo $alternate_phone; ?>" type="text">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12 text-right">
                                       <button type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="btn btn-success btn-lg"> Confirm Address</button>
                                    </div>
                                 </div>

                              </div>
                           </div>
                        </div>
                        <div class="card">
                           <div class="card-header" id="headingThree">
                              <h5 class="mb-0">
                                 <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span class="number">3</span> Payment
                                 </button>
                              </h5>
                           </div>
                           <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                              <div class="card-body">
                                 <div class="form-group">
                                    <input type="radio" name="payment_mode" value="cash_on_delivery" required="" checked="" hidden="">
                                 </div>
                                 <div class="form-group" hidden="">
                                    <input type="radio" name="payment_mode" value="online_payment"> Online Payment
                                 </div>
                                 <div class="form-group">
                                    <h3 class="text-center">Pay at Delivery</h3>
                                    <p class="text-center">You can pay from various payment method like CASH, Wallet (Paytm), UPI APP (Paytm/Google Pay/Phone Pay/ ALL UPI APPs) at delivery time. </p>
                                    <img src="img/PaymentBanner.png" style="width: 100%;">
                                 </div>
                                 <hr>
                                 <button type="submit" name="save_order_delivery_information" class="btn btn-lg btn-success btn-block font-15 p-3">Place Order</button>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
            </div>
            </form>
         </div>
      </div>
   </section>
   <?php require 'why_section.php';
   require 'login_section.php';
   require 'footer.php'; ?>

</body>

</html>