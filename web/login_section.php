<div class="modal fade login-modal-main" id="bd-example-modal">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
                                 <!-- Tab panes -->
                              <form action="insert.php" method="POST">
                                 <input type="text" name="cr_url" value="<?php get_url();?>" hidden>
                                 <div class="tab-content">

                                    <div class="tab-pane active" id="login" role="tabpanel">
                                     <div class="row">
                                        <div class="col-lg-6">
                                          <img src="img/blog-post.png" class="img-fluid" style="margin-top: 16%;">
                                        </div>
                                        <div class="col-lg-6">
                                          <br>
                                          <h5 class="heading-design-h5">Login to your account</h5>
                                       <fieldset class="form-group">
                                         <label class="text-left text-black" style="color: black;">Email-Id/Phone</label>
                                           <input type="text" class="form-control" name="customer_mail_id" placeholder="Email-id/Phone Number" required="">
                                       </fieldset>
                                       <fieldset class="form-group">
                                         <label style="color: black;">Enter Password</label>
                                            <input type="password" class="form-control" name="customer_password" placeholder="********" required="">
                                       </fieldset>
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                          <label class="custom-control-label" for="customCheck1" style="color: black;">Remember me</label>
                                       </div>
                                       <fieldset class="form-group">
                                          <button type="submit" name="login_request" class="btn btn-lg btn-secondary btn-block">Enter to your account</button>
                                       </fieldset>
                                    </form>
                                        </div>
                                     </div>

                                 </div>

                                 <div class="tab-pane" id="register" role="tabpanel">
                                    <h5 class="heading-design-h5">Register Now!</h5>
                                     <form action="insert.php" method="POST">
                                      <input type="text" name="cr_url" value="<?php get_url();?>" hidden>
                                     <div class="row">
                                       <div class="col-lg-6">
                                          <fieldset class="form-group">
                                          <label>Full name</label>
                                             <input type="text" class="form-control" name="customer_name" placeholder="Full Name" required="">
                                       </fieldset>
                                       <fieldset class="form-group">
                                          <label>Enter Email-id</label>
                                              <input type="text" class="form-control" name="customer_mail_id"  placeholder="Email Id" required="">
                                       </fieldset>
                                       <fieldset class="form-group">
                                           <label>Phone Number (excluding +91)</label>
                                              <input type="text" class="form-control" name="customer_phone_number" placeholder="+91" required="">
                                       </fieldset>
                                       <fieldset class="form-group">
                                            <label>Enter Password</label>
                                             <input type="password" class="form-control" name="customer_password" placeholder="********" required="">
                                       </fieldset>
                                       <fieldset class="form-group">
                                             <label>Enter Confirm Password </label>
                                               <input type="password" class="form-control" name="customer_password_2" placeholder="********" required="">
                                       </fieldset>

                                       </div>
                                       <div class="col-lg-6">
                                          <fieldset class="form-group">
                                             <label>Street Address</label>
                                                <input type="text" class="form-control" name="street_address" placeholder="H no/Flat no/Street Address" required="">
                                       </fieldset>
                                       <fieldset class="form-group">
                                             <label>Area Locality</label>
                                             <br>
                                             <select class="form-control" name="area_locality" required="">
                                             <?php 
                              $sql = "SELECT * FROM services_area where area_status='active'";
                              $query = mysqli_query($con, $sql);
                              while ($fetch = mysqli_fetch_assoc($query)){
                                $area_localityn = $fetch['area_locality'];
                                echo "<option value='$area_localityn'>$area_localityn</option>";
                              }?>
                                               </select>
                                       </fieldset>
                                       <fieldset class="form-group">
                                             <label>City</label>
                                             <select name="customer_city" class="form-control">
                              <?php
                              $sql = "SELECT * FROM city where city_status='active'";
                              $query = mysqli_query($con, $sql);
                              while ($fetch = mysqli_fetch_assoc($query)){
                                $city_name = $fetch['city_name'];
                                echo "<option value='$city_name'>$city_name</option>";
                              } ?>
                            </select>
                                       </fieldset>
                                       <fieldset class="form-group">
                                             <label>State</label>
                                                <input type="text" class="form-control" value="Haryana" readonly="" name="customer_state" placeholder="State" required="">
                                       </fieldset>
                                       <fieldset class="form-group">
                                             <label>Area Pincode</label>
                                                <input type="text" class="form-control" name="address_pincode" placeholder="Pincode" required="">
                                                <a href='https://www.indiapost.gov.in/VAS/Pages/findpincode.aspx' target="blank">Don't Know Pincode</a>
                                       </fieldset>
                                      </div>
                                   </div>
                                   <div class="row">
                                    <div class="col-lg-6 mx-auto">
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="customCheck2" required="">
                                          <label class="custom-control-label" for="customCheck2">I Agree with <a href="terms-and-conditions.php" class="text-danger">Term and Conditions</a></label>
                                       </div>
                                       <fieldset class="form-group">
                                          <button type="submit" name="register_customer" class="btn btn-lg btn-secondary btn-block">Create Your Account</button>
                                       </fieldset>
                                    </div>


                                       </div>
                                     </div>


                                    </div>
                                 </div>

                                 <div class="clearfix"></div>
                                 <div class="text-center login-footer-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                       <li class="nav-item">
                                          <a class="nav-link active" data-toggle="tab" href="#login" role="tab" style="box-shadow: 0px 0px 1px #130101;
    background-color: green !important;
    color: white;"><i class="fa fa-sign-in"></i> LOGIN</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#register" role="tab" style="box-shadow: 0px 0px 1px #130101;
    background-color: #007a80 !important;
    color: white;"><i class="fa fa-pencil"></i> REGISTER</a>
                                       </li>
                                    </ul>
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
