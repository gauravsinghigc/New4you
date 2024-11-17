<?php require 'files.php'; require 'session.php';
if(!isset($_SESSION['customer_id'])){
 header("location: index.php?msg=You are Logout, Please Login First!"); 
}
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
 $arealocality = $fetch['arealocality'];
 $custaddress = $fetch['custaddress'];
 $custcity = $fetch['custcity'];
 $custstate = $fetch['custstate'];
 $custpincode = $fetch['custpincode'];
 $contactperson = $fetch['contactperson'];
 $alternatenumber = $fetch['alternatenumber']; 

?>
<html style="<?php echo $ThemeColor;?>">
    <head>
       <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title> 
       <?php GSI_header_files();?>   
    </head>
    <body>
        <?php include 'header.php';?>

 <!-- header part end -->
 <section class="container-fluid pb-2">
  <div class="row">
  <div class="col-md-12 col-lg-12 col-12 pl-2 pr-2 account-page">
    <h4 class="font-5"><i class="fa fa-edit text-success"></i> Edit Profile <i class="fa fa-angle-right"></i> My Address</h4>
  </div>
   <div class="col-md-12">
    <?php if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
 }?>
 <?php GetMsg();?>
   </div>
  </div>
 </section>

 <section class="container-fluid pb-2">
  <div class="row">
   <div class="col-md-12 col-lg-12 col-12">
    <form action='update.php' method="POST">
     <input type='text' name='cr_url' value='<?php echo get_url();?>' hidden="">
     <div class="row">
      <div class="col-sm-12">
        <br>
       <div class="form-group">
        <label class="control-label">House No <span class="required text-danger">*</span></label>
        <input class="form-control border-form-control tr-input font-6" name="street_address" value="<?php echo $custaddress;?>"
         placeholder="" type="text">
       </div>
      </div>
     </div>
     <div class="row">
      <div class="col-sm-12">
        <br>
       <div class="form-group">
        <label class="control-label">Area/Locality <span class="required text-danger">*</span></label>
        <select class="form-control tr-input font-6" name="area_locality">
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
      <div class="col-sm-12">
        <br>
       <div class="form-group">
        <label class="control-label">City <span class="required text-danger">*</span></label>
        <select class="form-control tr-input font-6" name="customer_city">
          <option value="<?php echo $custcity;?>"><?php echo $custcity;?></option>
          <?php 
           $sql = "SELECT * FROM city where city_name!='$custcity' and city_status='active'";
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
      <div class="col-sm-12">
        <br>
       <div class="form-group">
        <label class="control-label">State <span class="required text-danger">*</span></label>
        <select class="form-control tr-input font-6" name="customer_state">
          <option value="<?php echo $custstate;?>"><?php echo $custstate;?></option>
          <?php 
           $sql = "SELECT * FROM state where state_name!='$custstate' and state_status='active'";
           $query = mysqli_query($con, $sql);
           while ($fetch = mysqli_fetch_assoc($query)){
              $state_name = $fetch['state_name'];
              echo "<option value='$state_name'>$state_name</option>";
           }
          ?>
        </select>
       </div>
      </div>
      <div class="col-sm-12">
        <br>
       <div class="form-group">
        <label class="control-label">Pincode <span class="required text-danger">*</span></label>
        <input class="form-control border-form-control tr-input font-6" name="address_pincode" value="<?php echo $custpincode;?>"
         placeholder="" type="text">
       </div>
      </div>
     </div>
     <div class="row">
      <div class="col-sm-12">
        <br>
       <div class="form-group">
        <label class="control-label">Contact Person <span class="required text-danger">*</span></label>
        <input class="form-control border-form-control tr-input font-6" name="contact_person" value="<?php echo $contactperson;?>"
         placeholder="" type="text">
       </div>
      </div>
      <div class="col-sm-12">
       <div class="form-group">
        <br>
        <label class="control-label">Alternate Number <span class="required text-danger">*</span></label>
        <input class="form-control border-form-control tr-input font-6" name="alternate_phone" value="<?php echo $alternatenumber;?>"
         placeholder="" type="text">
       </div>
      </div>
     </div>
     <div class="row">
      <div class="col-sm-12 text-right">
       <button type="submit" name="update_customer_address" class="btn btn-success btn-sm btn-block rounded-0 bottom-p fixed-bottom bottom-text" onclick="SavingData()"> <span id="SavingData">Update Address</span></button>
      </div>
     </div>

    </form><br><br>
   </div>
  </div>
 </section>






<?php GSI_footer_files();?>
    </body>
</html>