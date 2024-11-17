<?php
require 'files.php';
if (!isset($_SESSION['customer_id'])) {
   header("location: index.php?msg=logout");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $store_name;?> :  Address</title>
     <?php require 'header_files.php';?>
   </head>
   <body>
      <?php require 'header.php';?>
      <section class="account-page section-padding">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-11 mx-auto">
                  <div class="row no-gutters">
                     <div class="col-md-4">
                        <div class="card account-left">
                           <?php include 'account_section.php';?>
                           <div class="list-group" style="font-size: 14px;">
                              <a href="account.php" class="list-group-item list-group-item-action">
                                 <i aria-hidden="true" class="fa fa-user"></i>  My Account</a>
                              <a href="address.php" class="list-group-item list-group-item-action active">
                                 <i aria-hidden="true" class="fa fa-map-marker"></i>  My Address</a>
                              <a href="order_list.php" class="list-group-item list-group-item-action">
                                 <i aria-hidden="true" class="fa fa-shopping-cart"></i> My Orders</a>
                              <a href="rewards.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-star"></i> Reward Points</a>
                              <a href="wallet.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-square"></i> 24kharido Funds</a>
                              <a href="refer.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-share"></i> Refer & Earns</a>
                              <a href="notification.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-bell"></i> Notification</a>

                              <a href="logout.php" class="list-group-item list-group-item-action">
                                 <i aria-hidden="true" class="fa fa-sign-out"></i>  Logout</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="card card-body account-right">
                           <div class="widget">
                              <div class="section-header">
                                 <h5 class="heading-design-h5">
                                   <i class="fa fa-map-marker text-success"></i> My Address
                                    <hr>
                                 </h5>
                              </div>
                                  <?php
$sql = "SELECT * from customers where customers.customer_id='$customer_id' ";
$query = mysqli_query($con, $sql);
$count_address = mysqli_num_rows($query);
$fetch = mysqli_fetch_assoc($query);
 $customer_name = $fetch['customer_name'];
 $customer_mail_id = $fetch['customer_mail_id'];
 $customer_phone_number = $fetch['customer_phone_number'];
 $customer_password= $fetch['customer_password'];
 $cust_dp = $fetch['customer_image'];
 $arealocality = $fetch['arealocality'];
 $custaddress = $fetch['custaddress'];
 $custcity = $fetch['custcity'];
 $custstate = $fetch['custstate'];
 $custpincode = $fetch['custpincode'];
 $contactperson = $fetch['contactperson'];
 $alternatenumber = $fetch['alternatenumber'];
?>
<form action='update.php' method="POST">
     <input type="text" name="customer_id" value="<?php echo $customer_id;?>" hidden>
     <input type='text' name='cr_url' value='<?php echo get_url();?>' hidden="">
     <div class="row">
      <div class="col-sm-12">
       <div class="form-group">
        <label class="control-label">Street Address<span class="required">*</span></label>
        <textarea class="form-control border-form-control" name="street_address" value="<?php echo $custaddress;?>"
         placeholder="" type="text"><?php echo $custaddress;?></textarea>
       </div>
      </div>
     </div>
     <div class="row">
      <div class="col-sm-6">
       <div class="form-group">
        <label class="control-label">Area/Locality/NearBy<span class="required">*</span></label>
        <select class="form-control" name="area_locality">
          <option value="<?php echo $arealocality;?>"><?php echo $arealocality;?></option>
          <?php 
           $sql = "SELECT * FROM services_area where area_locality!='$arealocality' and area_status='active'";
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
         <select class="form-control" name="customer_city">
          <option value="<?php echo $custcity;?>"><?php echo $custcity;?></option>
          <?php 
           $sql = "SELECT * FROM city where city_status='active' and city_name!='$custcity'";
           $query = mysqli_query($con, $sql);
           while ($fetch = mysqli_fetch_assoc($query)){
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
        <input class="form-control border-form-control" name="address_pincode" value="<?php echo $custpincode;?>"
         placeholder="" type="text">
       </div>
      </div>
     </div>
     <div class="row">
      <div class="col-sm-6">
       <div class="form-group">
        <label class="control-label">Contact Person<span class="required">*</span></label>
        <input class="form-control border-form-control" name="contact_person" value="<?php echo $contactperson;?>"
         placeholder="" type="text">
       </div>
      </div>
      <div class="col-sm-6">
       <div class="form-group">
        <label class="control-label">Alternate Number<span class="required">*</span></label>
        <input class="form-control border-form-control" name="alternate_phone" value="<?php echo $alternatenumber;?>"
         placeholder="" type="text">
       </div>
      </div>
     </div>
     <div class="row">
      <div class="col-sm-12 text-right">
        <br>
       <button type="submit" name="update_customer_address" class="btn btn-success btn-md p-3 btn-block" style="font-size: 15px;" onclick="SavingData()"><span id="SavingData"><?php 
      if(isset($_GET['address_update'])){
        $address_update_value = $_GET['address_update'];
      if($_GET['address_update'] == "true") { 
        echo "<i class='fa fa-check-circle mt-0'></i> Address Updated!"; 
      } elseif ($_GET['address_update'] == "false") {
        echo "<i class='fa fa-warning mt-0'></i> Failed!"; 
       } else { echo "Update Address"; } 
      } else {
        echo "Update Address";
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
         </div>
      </section>
      <?php
      require 'footer.php';?>

      <!-- Bootstrap core JavaScript -->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <!-- select2 Js -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel -->
      <script src="js/owl.carousel.js"></script>
      <!-- Custom -->
      <script src="js/custom.js"></script>



</body></html>

<div class="modal fade login-modal-main" id="upload-profile-image">
         <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-body">
                  <div class="login-modal">
                     <div class="row">
                        <div class="col-lg-12 pad-left-0">
                           <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true"><i class="fa fa-times"></i></span>
                           <span class="sr-only">Close</span>
                           </button>
                              <div class="login-modal-right">
                                    <div class="tab-pane" role="tabpanel">
                                       <h5 class="heading-design-h5"> <i class="fa fa-user text-info"></i> Upload Profile Image</h5>
                                     <form action="insert.php" method="POST" enctype="multipart/form-data">
                                     <input type="text" name="customer_id" value="<?php echo $customer_id;?>" hidden>
                                      <fieldset class="form-group">
                                         <input type="FILE" class="form-control" name="customer_image_uplaod" placeholder="Full Name" required="" accept="image/*" style="padding: 1% !important;">
                                         <span><code>*</code> Image Ratio 1x1 (SQAURE Image)</span><br>
                                         <span><code>*</code> Only Image formate are accepted like png, jpg, jpeg, gif.</span>
                                       </fieldset>
                                       <fieldset class="form-group">
                                          <button type="submit" name="upload_customer_dp" class="btn btn-lg btn-secondary btn-block"><i class='fa fa-upload'></i>Upload</button>
                                       </fieldset>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
