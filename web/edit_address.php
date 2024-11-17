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
       <title><?php echo $store_name;?> :  Edit Address</title>
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
                           <div class="user-profile-header">
                              <img alt="logo" src="img/user_img/<?php echo $customer_image;?>"><br>
                              <a data-target="#upload-profile-image" data-toggle="modal" class="btn btn-link text-secondary" href=""><i class="fa fa-upload"></i> Update Image</a>
                              <h4 class="mb-0 text-success"><?php echo $customer_name;?></h4>
                              <p class="mb-0"> +91 <?php echo $customer_phone_number;?></p>
                              <p class="mb-0"> <?php echo $customer_mail_id;?></p>
                           </div>
                           <div class="list-group">
                              <a href="account.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="fa fa-user"></i>  My Account</a>
                              <a href="address.php" class="list-group-item list-group-item-action active"><i aria-hidden="true" class="fa fa-map-marker"></i>  My Address</a>
                              <a href="order_list.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="fa fa-shopping-cart"></i>  Order List</a> 
                              <a href="logout.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="fa fa-sign-out"></i>  Logout</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="card card-body account-right">
                           <div class="widget">
                              <div class="section-header">
                                 <h5 class="heading-design-h5">
                                    <i class='fa fa-edit'></i> Edit Address
                                    <a href="address.php" class="float-right"><i class="fa fa-angle-left"></i> Back to All Address</a>
                                 </h5>
                              </div>
                              <form action='insert.php' method="POST">
                                 <input type="text" name="customer_address_id" value="<?php echo $customer_address_id;?>" hidden>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                          <label class="control-label">Street Address<span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="street_address" value="<?php echo $street_address;?>" placeholder="<?php echo $area_locality;?>" type="text">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Area/Locality/NearBy<span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="area_locality" value="<?php echo $area_locality;?>" placeholder="<?php echo $area_locality;?>" type="text">
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">City<span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="customer_city" value="<?php echo $customer_city;?>" placeholder="<?php echo $customer_city;?>" type="text">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">State<span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="customer_state" value="<?php echo $customer_state;?>" placeholder="<?php echo $customer_state;?>" type="text">
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Pincode<span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="address_pincode" value="<?php echo $address_pincode;?>" placeholder="<?php echo $address_pincode;?>" type="text">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Contact Person<span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="contact_person" value="<?php echo $contact_person;?>" placeholder="<?php echo $contact_person;?>" type="text">
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Alternate Number<span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="alternate_phone" value="<?php echo $alternate_phone;?>" placeholder="<?php echo $alternate_phone;?>" type="text" >
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12 text-right">
                                       <button type="submit" name="update_customer_address" class="btn btn-success btn-lg"> Save Address </button>
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
      require 'login_section.php';
      require 'footer.php';
      require 'cart_section.php'; ?>

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
                                       <h5 class="heading-design-h5">Upload Profile Image</h5>
                                     <form action="insert.php" method="POST" enctype="multipart/form-data">
                                     <input type="text" name="customer_id" value="<?php echo $customer_id;?>" hidden>
                                      <fieldset class="form-group">
                                         <input type="FILE" class="form-control" name="customer_image_uplaod" placeholder="Full Name" required="">
                                         <span><code>*</code> for better view please upload square images</span>
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
