<?php
require 'files.php';
require 'session.php';

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="Mobilabs.in">
    <title>STORES : <?php echo $PosName;?></title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/card-statistics.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/vertical-timeline.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <!-- END: Custom CSS-->

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

   <?php require 'header.php'; ?>


    <?php require 'sidebar.php'; ?>

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="col-lg-12 card-content">
            <?php notification();?>
          </div>
        </div>

                  <div class="modal fade text-left" id="add_users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel17">All STORES <i class="fa fa-angle-right"></i> ADD STORE</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      <div class="modal-body">
                      <form action="insert.php" method="POST">
                        <input type="text" name="cr_url" value="<?php echo get_url();?>" hidden>
                        <div class="row">
                          <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-group">
                           <label>SELECT STORE OWNER</label>
                           <select class="form-control" name="user_owner_id">
                            <?php
                                $user_id = $_SESSION['user_id'];
                                $SelectUserTypes = "SELECT * FROM users, user_types where users.user_role=user_types.user_type_id and user_type_title='STORE_USER' and ref='$user_id'";
                                $SelectUserTypesQuery = mysqli_query($con, $SelectUserTypes);
                                $countstoreusers = mysqli_num_rows($selectstorequery);
                                if ($countstoreusers == 0) {
                                  echo "<option value='null'> No Store Owner Found Regitser By you</option>";
                                }
                                while ($SelectUserTypesFetch = mysqli_fetch_assoc($SelectUserTypesQuery)) {
                                    $store_user_id = $SelectUserTypesFetch['user_id'];
                                    $store_owner_full_name = $SelectUserTypesFetch['full_name'];
                                    $store_owner_email_id = $SelectUserTypesFetch['email_id'];
                                    $store_owner_phone_number = $SelectUserTypesFetch['phone_number']; ?>
                                <option value="<?php echo $store_user_id;?>">UID<?php echo $store_user_id;?> : <?php echo $store_owner_full_name;?> : <?php echo $store_owner_email_id;?> : <?php echo $store_owner_phone_number;?></option>
                                <?php }?>
                           </select>
                            </div>
                          </div>

                          <div class="col-lg-12">
                            <hr>
                            <h4><b>Store Information:</b></h4>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                           <label>Store Name</label>
                           <input type="text" class="form-control" name="store_name" placeholder="STORE Name" required="">
                            </div>
                          </div>

                          <div class="col-md-4">
                             <div class="form-group">
                            <label>Store Phone</label>
                            <input type="text" class="form-control" name="store_phone" placeholder="Store Phone" required="">
                          </div>
                          </div>

                          <div class="col-md-4">
                             <div class="form-group">
                           <label>Store Small Description</label>
                           <input type="text" class="form-control" name="store_description"  placeholder="Store Intro" required="">
                          </div>
                          </div>

                          <div class="col-md-4">
                             <div class="form-group">
                           <label>Store Mail-ID</label>
                            <input type="email" class="form-control" name="store_mail_id"  placeholder="Store Email" required="">
                          </div>
                          </div>

                         <div class="col-md-4">
                             <div class="form-group">
                           <label>Store Address</label>
                            <input type="text" class="form-control" name="store_address"  placeholder="SHop no/building/number" required="">
                          </div>
                          </div>

                          <div class="col-md-4">
                             <div class="form-group">
                           <label>Store AreaLocality</label>
                            <input type="text" class="form-control" name="store_arealocality"  placeholder="AREA/SECTOR/BLOCK" required="">
                          </div>
                          </div>

                          <div class="col-md-4">
                             <div class="form-group">
                           <label>Store city</label>
                          <input type="text" class="form-control" name="store_city" placeholder="City" required="">
                          </div>
                          </div>

                          <div class="col-md-4">
                             <div class="form-group">
                             <label>Store State</label>
                              <select name="store_state" class="form-control" required="">
<option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam">Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
<option value="Daman and Diu">Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Puducherry">Puducherry</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Odisha">Odisha</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Telangana">Telangana</option>
<option value="Tripura">Tripura</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="Uttarakhand">Uttarakhand</option>
<option value="West Bengal">West Bengal</option>
</select>
                          </div>
                          </div>

                          <div class="col-md-4">
                             <div class="form-group">
                             <label>Pincode </label>
                              <input type="text" class="form-control" minlength="6" maxlength="6" name="store_pincode" placeholder="000000" required="">
                          </div>
                          </div>

                           <div class="col-lg-12">
                            <h4><b>Store Domain:</b></h4>
                          </div>

                           <div class="col-md-4">
                             <div class="form-group">
                             <label>Store Already Have Domain?</label>
                              <select class="form-control" name="domain_avaibility" required="">
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                              </select>
                          </div>
                          </div>

                           <div class="col-md-4">
                             <div class="form-group">
                             <label>Domain Type <small><i class="fa fa-angle-right"></i> (Domain Price ADD in Activation if it is Direct Domain)</small> </label>
                              <select class="form-control" name="domain_type" required="">
                                <option value="MAIN_DOMAIN">DIRECT DOMAIN (eg: storename.extn)</option>
                                <option value="SUB_DOMAIN">SUB DOMAIN (eg: storename.mobilabs.in)</option>
                                <option value="DIR_DOMAIN">DIRECTORY DOMAIN (eg: mobilabs.in/storename) </option>
                              </select>
                          </div>
                          </div>

                          <div class="col-md-4">
                             <div class="form-group">
                             <label>Enter Domain Name <small><i class="fa fa-angle-right"></i> like storename.com, storename.in </small> </label>
                              <input type="text" class="form-control" name="domain" placeholder="example.com" required="">
                          </div>
                          </div>

                           <div class="col-lg-12">
                            <hr>
                            <h4><b>Payment Gateway: <small><i class="fa fa-angle-right"></i> Default Payment Gateway is PAYTM for all Customer for Direct Payment Receiving.</small></b></h4>
                          </div>

                          <div class="col-md-4">
                             <div class="form-group">
                             <label>PAYMENT GATEWAY (PG)</label>
                              <select class="form-control" name="payment_use" required="">
                                <option value="MOBILABS">MOBILABS PAYTM (3rd Day Transfer)</option>
                                <option value="STORE_OWNER">STORE OWNER (Direct Receiving)</option>
                              </select>
                          </div>
                          </div>

                          <div class="col-md-4">
                             <div class="form-group">
                             <label>PROD_MID <small><i class="fa fa-angle-right"></i> (if PAYMENT GATEWAY is STORE OWNER else fill NA)</small> </label>
                              <input type="text" class="form-control" name="pg_mid" placeholder="xGhbgFfgHH1H146765">
                          </div>
                          </div>

                          <div class="col-md-4">
                             <div class="form-group">
                             <label>PROD_KEY <small><i class="fa fa-angle-right"></i> (if PAYMENT GATEWAY is STORE OWNER else fill NA)</small> </label>
                              <input type="text" class="form-control" name="pg_key" placeholder="HbGVGSG125BVvg">
                          </div>
                          </div>

                           <div class="col-md-4">
                             <div class="form-group">
                             <label>WEBSITE TYPE <small><i class="fa fa-angle-right"></i> (if PAYMENT GATEWAY is STORE OWNER else fill NA)</small> </label>
                              <input type="text" class="form-control" name="pg_web" placeholder="HbGVGSG125BVvg">
                          </div>
                          </div>

                          <div class="col-lg-12">
                            <hr>
                            <h4><b>Activation By: <small><i class="fa fa-angle-right"></i> UID<?php echo $user_id;?> : <?php echo $full_name;?> </small></b></h4>
                          </div>

                          <div class="col-md-4">
                             <div class="form-group">
                             <label>ACTIVATION FEE <small><i class="fa fa-angle-right"></i> Inclusive of ALL Tax.</small> </label>
                              <input type="text" class="form-control" name="store_activation_fee" placeholder="Rs.">
                          </div>
                          </div>

                        </div>
                      </div>
                      <div class="modal-footer">
                      <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
                      <button type="Submit" name="REGISTER_NEW_STORE" class="btn btn-outline-primary">CREATE Data</button>
                      </form>
                      </div>
                    </div>
                    </div>
                  </div>

        <div class="content-body"><!-- users list start -->
   <section class="users-list-wrapper">
    <div class="users-list-table">
        <div class="card">
          <div class="card-header">
                     <h4 class="users-action">All Stores <i class="fa fa-angle-right"></i>
                      <a href="" data-toggle="modal" data-target="#add_users"><i class="fa fa-plus"></i> ADD Stores</a>
                    </h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="reload"><i class="fa fa-refresh"></i></a></li>
                            <li><a data-action="expand"><i class="fa fa-expand"></i></a></li>
                        </ul>
                    </div>
                </div>
            <div class="card-content">
                <div class="card-body">
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">STRID</th>
                                    <th style="width: 20%;">STORE Name</th>
                                    <th style="width: 25%;">Owner Name</th>
                                    <th style="width: 10%;">StorePhone</th>
                                    <th style="width: 10%;">STATUS</th>
                                    <th style="widows:10%">VISIBILITY</th>
                                    <th style="width: 10%;">ACTIVATION</th>
                                    <th style="width: 10%;">REG_DATETIME</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              $selectusers = "SELECT * from users where ref='$user_id'";
                              $userquery = mysqli_query($con ,$selectusers);
                              while ($fetchusers = mysqli_fetch_assoc($userquery)) {
                                $ref_id = $fetchusers['user_id'];
                               $selectstore = "SELECT * from stores, users where stores.user_id=users.user_id and stores.store_ref_id='$ref_id'";
                               $selectquery = mysqli_query($con, $selectstore);

                               while ($storefetch = mysqli_fetch_assoc($selectquery)) {
                                $StoreId = $storefetch['store_id'];
                                $Storename = $storefetch['store_name'];
                                $StoreOwner = $storefetch['full_name'];
                                $StorePhone = $storefetch['store_phone'];
                                $StoreStatus = $storefetch['store_status'];
                                $StoreVisibility = $storefetch['store_visibility'];
                                $StoreActivation = $storefetch['activation_fee_status'];
                                $StoreUserId = $storefetch['user_id'];
                                $StoreAddDate = $storefetch['store_add_date']; ?>
                               <tr>
                                <td>STR<?php echo $StoreId;?></td>
                                <td>
                                  <form action='team_edit.php' method="POST">
                                  <button type="submit" value="<?php echo $StoreId;?>" name='id' class='btn btn-link text-info btn-sm font-small-3'><?php echo $Storename;?></button>
                                   </form>
                                 </td>
                                <td><?php echo $StoreOwner;?></td>
                                <td><?php echo $StorePhone;?></td>
                                <td><?php echo $StoreStatus;?></td>
                                <td><?php echo $StoreVisibility;?></td>
                                <td><?php echo $StoreActivation;?></td>
                                <td><?php echo $StoreAddDate;?></td>
                              </tr>
                               <?php }
                              }

                                   $selectstore = "SELECT * FROM stores, users where stores.user_id=users.user_id and stores.store_ref_id='$user_id'";
                                    $selectstorequery = mysqli_query($con, $selectstore);
                              while ($FetchStores =  mysqli_fetch_assoc($selectstorequery)) {
                                $StoreId = $FetchStores['store_id'];
                                $Storename = $FetchStores['store_name'];
                                $StoreOwner = $FetchStores['full_name'];
                                $StorePhone = $FetchStores['store_phone'];
                                $StoreStatus = $FetchStores['store_status'];
                                $StoreVisibility = $FetchStores['store_visibility'];
                                $StoreActivation = $FetchStores['activation_fee_status'];
                                $StoreUserId = $FetchStores['user_id'];
                                $StoreAddDate = $FetchStores['store_add_date']; ?>
                                <tr>
                                <td>STR<?php echo $StoreId;?></td>
                                <td>
                                  <form action='team_edit.php' method="POST">
                                  <button type="submit" value="<?php echo $StoreId;?>" name='id' class='btn btn-link text-info btn-sm font-small-3'><?php echo $Storename;?></button>
                                   </form>
                                 </td>
                                <td><?php echo $StoreOwner;?></td>
                                <td><?php echo $StorePhone;?></td>
                                <td><?php echo $StoreStatus;?></td>
                                <td><?php echo $StoreVisibility;?></td>
                                <td><?php echo $StoreActivation;?></td>
                                <td><?php echo $StoreAddDate;?></td>
                              </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- datatable ends -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- users list ends -->
        </div>
      </div>
    </div>
    <!-- END: Content-->

    <?php require 'footer.php'; ?>


   <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.min.js"></script>
    <script src="app-assets/js/core/app.min.js"></script>
    <script src="app-assets/js/scripts/customizer.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/page-users.min.js"></script>

  </body>
  <!-- END: Body-->
</html>