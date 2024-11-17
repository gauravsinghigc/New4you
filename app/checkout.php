<?php require 'files.php'; require 'session.php';
$customer_id = $_SESSION['customer_id'];
$sql = "SELECT * from customers where customers.customer_id='$customer_id' ";
$query = mysqli_query($con, $sql);
$count_address = mysqli_num_rows($query);
$fetch = mysqli_fetch_assoc($query);
 $customer_name = $fetch['customer_name'];
 $customer_mail_id = $fetch['customer_mail_id'];
 $customer_phone_number = $fetch['customer_phone_number'];
 $customer_password= $fetch['customer_password'];
 $cust_dp = $fetch['customer_image'];
 $store_id = $fetch['store_id'];
$street_address = $fetch['custaddress'];
$area_locality_s = $fetch['arealocality'];
$area_locality_c = $fetch['arealocality'];
$customer_city = $fetch['custcity'];
$customer_state = $fetch['custstate'];
$address_pincode = $fetch['custpincode'];
$contact_person = $fetch['contactperson'];
$alternate_phone = $fetch['alternatenumber'];
if(isset($_SESSION['area'])){
$area_view = $_SESSION['area'];
if($area_view == $area_locality_s){
  $area_locality_s = $area_locality_s;
} else {
  $area_locality_s = $area_view;
} 
} else {
   $area_locality_s = $area_locality_s;
}?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php';?>

  <!-- header part end --><br>
  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-sm-12 col-xs-12 bg-success p-1">
     <h5 class="font-7 text-white"><i class="fa fa-truck text-warning"></i> Delivery & Billing Address <i class="fa fa-angle-right"></i></h5>
    </div>
    <div class="col-sm-12 col-xs-12">
     <p class="font-6 mt-2">
      <i class="fa fa-map-marker text-success"></i> <?php echo $street_address;?>, <?php echo $area_locality_c;?>, <?php echo $customer_city;?>, <?php echo $customer_state;?> -
      <?php echo $address_pincode;?><br>
      <i class="fa fa-user text-info"></i> <b>Contact Person </b> <?php echo $contact_person;?><br>
      <i class="fa fa-phone text-info"></i> <b>Person Phone </b> <?php echo $alternate_phone;?>
     </p>
     <?php
         if (isset($_GET['msg'])) {
                $msg = $_GET['msg'];
                 echo "<p class='text-success'>$msg";
                 echo '<button onclick="remove_msg()" href="#" class="btn btn-link float-right close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-times" style="margin-top: -10px;color:red; "></i></button></p>';
                }  elseif (isset($_GET['err'])) {
                    $err= $_GET['err'];
                 echo "<p class='text-danger'>$err";
                 echo '<button onclick="remove_msg()" href="#" class="btn btn-link float-right close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-times" style="margin-top: -10px;color:red; "></i></button></p>';
                }
        ?>
    </div>
   </div>
  </section>
  <style type="text/css">
  .control-label {
   font-size: 15px !important;
  }

  </style>

  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-sm-12 col-xs-12 bg-info p-1">
     <h4 class="font-7 text-white"><i class="fa fa-edit text-warning"></i> Edit Delivery Address </h4>
    </div>
    <div class="col-sm-12 col-xs-12 pt-2">
     <form action='insert.php' method="POST" class="font-3">
      <input type="text" name="customer_id" value="<?php echo $customer_id;?>" hidden>
      <input type='text' name='store_id' value='<?php echo $store_id;?>' hidden="">
      <div class="row">
       <div class="col-sm-6">
        <div class="form-group">
         <label class="control-label">House No <span class="required">*</span></label>
         <input class="form-control border-form-control tr-input bg-white" name="street_address" value="<?php echo $street_address;?>" placeholder="<?php echo $street_address;?>" type="text"
          required="">
        </div>
       </div>
       <div class="col-sm-6">
        <div class="form-group">
         <label class="control-label">Area/Locality/NearBy<span class="required">*</span></label>
         <select class="form-control tr-input bg-white" name="area_locality">
          <option value="<?php echo $area_locality_s;?>"><?php echo $area_locality_s;?></option>
          <?php 
           $sql = "SELECT * FROM services_area where area_status='active' and area_locality!='$area_locality_s'";
           $query = mysqli_query($con, $sql);
           while ($fetch = mysqli_fetch_assoc($query)){
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
         <select class="form-control tr-input bg-white" name="customer_city">
          <option value="<?php echo $store_city_cr;?>"><?php echo $store_city_cr;?></option>
          <?php 
           $sql = "SELECT * FROM city where city_status='active' and city_name!='$store_city_cr'";
           $query = mysqli_query($con, $sql);
           while ($fetch = mysqli_fetch_assoc($query)){
              $city_nameall = $fetch['city_name'];
              echo "<option value='$city_nameall'>$city_nameall</option>";
           }
          ?>
         </select>
        </div>
       </div>

       <div class="col-sm-6">
        <div class="form-group">
         <label class="control-label">State<span class="required">*</span></label>
         <select class="form-control tr-input bg-white" name="customer_city">
          <option value="<?php echo $custstate;?>"><?php echo $custstate;?></option>
          <?php 
           $sql = "SELECT * FROM state where state_status='active' and state_name!='$custstate'";
           $query = mysqli_query($con, $sql);
           while ($fetch = mysqli_fetch_assoc($query)){
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
         <input class="form-control border-form-control tr-input bg-white" name="address_pincode" value="<?php echo $address_pincode;?>" placeholder="<?php echo $address_pincode;?>" type="text">
        </div>
       </div>

       <div class="col-sm-6">
        <div class="form-group">
         <label class="control-label">Contact Person<span class="required">*</span></label>
         <input class="form-control border-form-control tr-input bg-white" name="contact_person" value="<?php echo $contact_person;?>" placeholder="<?php echo $contact_person;?>" type="text">
        </div>
       </div>
       <div class="col-sm-6">
        <div class="form-group">
         <label class="control-label">Alternate Number<span class="required">*</span></label>
         <input class="form-control border-form-control tr-input bg-white" name="alternate_phone" value="<?php echo $alternate_phone;?>" placeholder="<?php echo $alternate_phone;?>" type="text">
        </div>
       </div>
      </div>
      <div class="row">
       <div class="col-sm-12 col-xs-12">
        <hr>
        <h5 class="font-7">Payment Method</h5>
       </div>
       <div class="col-sm-12 col-xs-12">
        <div class="form-group font-6">
         <input type="radio" name="payment_mode" value="cash_on_delivery" required="" checked=""> Pay
         <?php $delivery_type = $_SESSION['DELIVERY_TYPE'];
        if($delivery_type == "HOME_DELIVERY") {
          echo "Cash/Wallet/UPI On Delivery";
        } elseif($delivery_type == "STORE_PICKUP") {
          echo "at Store Pickup";

        }?>
         <p class="font-5">You can pay from various payment method like CASH, Wallet (Paytm), UPI APP (Paytm/Google Pay/Phone Pay/ ALL UPI APPs) at delivery time.</p>
         <img src="img/PaymentBanner.png" style="width: 100%;">
        </div>
        <!--<div class="form-group font-3">
        <input type="radio" name="payment_mode" value="online_payment"> Pay Online Now
       </div>-->
       </div>
      </div>

      <div class="row">
       <div class="col-sm-12 col-xs-12 text-right">
        <button type="submit" name="save_order_delivery_information" class="btn btn-success fixed-bottom bottom-text btn-block btn-lg bottom-p"><i class="fa fa-map-marker"></i> Confirm Address &
         Checkout </button>
       </div>
      </div>

     </form><br><br><br><br>
    </div>
   </div>
  </section>

  <?php GSI_footer_files();?>
 </body>

</html>
