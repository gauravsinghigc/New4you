<?php
require 'files.php';
require 'session.php';

if (isset($_GET['store_id'])) {
  $_SESSION['store_id'] = $_GET['store_id'];
  $store_id = $_SESSION['store_id'];
} else {
  $user_role = $_SESSION['user_role'];
  if ($user_role == "STORE_USER") {
    $store_user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM stores where user_id='$store_user_id'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    $store_id = $fetch['store_id'];
    $_SESSION['store_id'] = $store_id;
  } else {
    $store_id = $_SESSION['store_id'];
  }
}
$sql = "SELECT * from stores where store_id='$store_id'";
$query =  mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$store_name = $fetch['store_name'];
$store_phone = $fetch['store_phone'];
$store_mail_id = $fetch['store_mail_id'];
$store_description = $fetch['store_description'];
$store_address = $fetch['store_address'];
$store_arealocality = $fetch['store_arealocality'];
$store_city = $fetch['store_city'];
$store_state = $fetch['store_state'];
$store_pincode = $fetch['store_pincode'];
$activation_fee_status = $fetch['activation_fee_status'];
$store_user_id = $fetch['user_id'];
$user_view_id = $store_user_id;
$store_gst = $fetch['GST'];
$store_pan = $fetch['PAN'];
$store_profile_img = $fetch['store_profile_img'];



$sql = "SELECT * FROM users, user_types where user_id='$user_view_id' and users.user_role=user_types.user_type_id";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$user_role_cr = $fetch['user_type_title'];
$user_type_id = $fetch['user_type_id'];
$full_name_user = $fetch['full_name'];
$username = $fetch['username'];
$password = $fetch['password'];
$email_id = $fetch['email_id'];
$phone_number = $fetch['phone_number'];
$user_address = $fetch['user_address'];
$user_arealocality = $fetch['user_arealocality'];
$user_city = $fetch['user_city'];
$user_state = $fetch['user_state'];
$user_pincode = $fetch['user_pincode'];
$DateTime = $fetch['date_time'];
$user_status_check = $fetch['user_status'];
$user_verification_check = $fetch['user_verification'];
if ($user_status_check == "Inactive" or $user_status_check == "BLOCK" or $user_status_check == "LEAVED") {
  $user_status_show = "<i class='text-warning fa fa-warning'> Inactive</i>";
} else {
  $user_status_show = "<i class='text-success fa fa-check-circle'> Active</i>";
}

if ($user_verification_check == "Unverified") {
  $user_verification = "<i class='text-warning fa fa-warning'> Unverified</i>";
} else {
  $user_verification = "<i class='text-success fa fa-check-circle'> Verified</i>";
}
$tnc = $fetch['tnc'];
$ref = $fetch['ref'];
$user_img = $fetch['user_img'];
if ($user_img == null) {
  $store_img = "app-assets/images/portrait/small/avatar-s-26.png";
} else {
  $store_img = $fetch['user_img'];
}


?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="<?php echo $PosName; ?>">
  <title><?php echo $full_name_user; ?> : <?php echo $PosName; ?></title>
  <?php include 'header_files.php'; ?>

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
          <?php notification(); ?>
        </div>
      </div>
      <div class="content-body">
        <!-- users edit start -->
        <section class="users-edit">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <h4><?php echo $store_name; ?> <i class='fa fa-angle-right'></i> Store Settings <i class='fa fa-angle-right'></i>
                </h4>
                <p><small>If you are not aware about the changes, or updates, please leave it and Do
                    not try to make any changes, it will affect your store visibility.</small>
                </p>
                <a href='areas.php' class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> Service Areas</a>
                <a href='charges.php' class="btn btn-primary btn-sm"> <i class="fa fa-inr"></i> Store Charges</a>
                <hr>
                <!-- users edit media object start -->
                <div class="media mb-2">
                  <a class="mr-2" href="#">
                    <img src="<?php echo $store_profile_img; ?>" alt="<?php echo $full_name; ?>" title="<?php echo $full_name; ?>" class="users-avatar" height="64" width="64">
                  </a>
                  <div class="media-body">
                    <h4 class="media-heading"><i class="fa fa-user"></i>
                      <?php echo $store_name; ?><br>
                      <small class="font-small-3"><i class="fa fa-briefcase"></i>
                        <?php echo $user_role_cr; ?> <i class="fa fa-angle-right"></i>
                        <?php echo $user_status_show; ?> <i class="fa fa-angle-right"></i>
                        <?php echo $user_verification; ?> </small>
                    </h4>
                    <div class="col-12 px-0 d-flex">
                      <a href="#" data-toggle="modal" data-target="#upload_profile" class="btn btn-sm btn-primary mr-25">Upload
                        Profile</a>
                    </div>
                  </div>
                  <div class="modal fade text-left" id="upload_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel17">
                            <?php echo $store_name; ?> <i class="fa fa-angle-right"></i>
                            Upload Profile</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form class="form" action="update.php" method="POST" enctype="multipart/form-data">
                            <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
                            <input type="text" name="user_id" value="<?php echo $user_id; ?>" hidden>
                            <div class="row">
                              <div class="col-md-12">
                                <label>Upload Profile<small class="text-muted"><i class="fa fa-angle-right"></i> square
                                    image are best fit like 100x100.
                                  </small></label>
                                <input type="FILE" name="STORE_IMG" value="" class="form-control" required="">
                              </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                          <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
                          <button type="submit" class="btn btn-outline-primary" name="UPDATE_STORE_IMG">Save Profile</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>





                <!-- users edit Info form start -->
                <form action="update.php" method="POST">
                  <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
                  <input type="text" name="user_owner_id" value="<?php echo $store_user_id; ?>" hidden>
                  <input type="text" name="store_id" value="<?php echo $store_id; ?>" hidden>
                  <div class="row">
                    <div class="col-lg-12">
                      <h4>
                        <b>Store Status :
                          <?php
                          if ($activation_fee_status == "Activated") {
                            echo "<h2 class='text-success fa fa-check-circle'> Activated</h2>";
                          } else {
                            echo "<h2 class='text-danger fa fa-warning'> NOT Activated</h2>";
                          }
                          ?>
                        </b>
                      </h4>
                      <hr>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Store Name</label>
                        <input type="text" class="form-control" name="store_name" value="<?php echo $store_name; ?>" placeholder="STORE Name">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Store Phone</label>
                        <input type="text" class="form-control" name="store_phone" value="<?php echo $store_phone; ?>" placeholder="Store Phone">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Store Small Description</label>
                        <input type="text" class="form-control" name="store_description" value="<?php echo $store_description; ?>" placeholder="Store Intro">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Store Mail-ID</label>
                        <input type="email" class="form-control" name="store_mail_id" value="<?php echo $store_mail_id; ?>" placeholder="Store Email">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Store Address</label>
                        <input type="text" class="form-control" name="store_address" value="<?php echo $store_address; ?>" placeholder="SHop no/building/number">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Store AreaLocality</label>
                        <input type="text" class="form-control" name="store_arealocality" value="<?php echo $store_arealocality; ?>" placeholder="AREA/SECTOR/BLOCK">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Store city</label>
                        <input type="text" class="form-control" name="store_city" value="<?php echo $store_city; ?>" placeholder="City">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Store State</label>
                        <input type="text" class="form-control" name="store_state" value="<?php echo $store_state; ?>" placeholder="State">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Pincode </label>
                        <input type="text" class="form-control" minlength="6" maxlength="6" name="store_pincode" value="<?php echo $store_pincode; ?>" placeholder="000000">
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <br><br>
                      <h4><b>Store GST & PAN NO:</b></h4>
                      <hr>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>GST NO </label>
                        <input type="text" class="form-control" minlength="15" maxlength="15" name="GST" value="<?php echo $store_gst; ?>" placeholder="BACDEG1525SGHVGH">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>PANCARD </label>
                        <input type="text" class="form-control" minlength="6" name="PAN" value="<?php echo $store_pan; ?>" placeholder="ABCD1234">
                      </div>
                    </div>

                    <div class="col-lg-12" style="display: none;">
                      <h4><b>Store Domain:</b></h4>
                      <hr>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <select class="form-control" name="domain_avaibility" hidden="">
                          <option value="<?php echo $domain_avaibility; ?>">
                            <?php echo $domain_avaibility; ?></option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <select class="form-control" name="domain_type" hidden="">
                          <option value="<?php echo $domain_type; ?>">
                            <?php echo $domain_type; ?></option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" class="form-control" name="domain" value="<?php echo $domain; ?>" placeholder="example.com" hidden="">
                        <a href="https://<?php echo $domain; ?>" target='_blank' hidden="">
                          <i class="fa fa-eye"></i> <?php echo $domain; ?></a>
                      </div>
                    </div>

                    <div class="col-lg-12" hidden="">
                      <hr>
                      <h4><b>Payment Gateway:</b></h4>
                      <hr>
                    </div>

                    <div class="col-md-4" hidden="">
                      <div class="form-group">
                        <label>PAYMENT GATEWAY (PG)</label>
                        <select class="form-control" name="payment_use">
                          <option value="<?php echo $store_name; ?>">
                            <?php echo $payment_use; ?></option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4" hidden="">
                      <div class="form-group">
                        <label>PROD_MODE</label>
                        <input type="text" class="form-control" value="<?php echo $pg_mode; ?>" name="pg_mode" placeholder="PROD OR TEST">
                      </div>
                    </div>

                    <div class="col-md-4" hidden="">
                      <div class="form-group">
                        <label>PROD_MID</label>
                        <input type="text" class="form-control" value="<?php echo $pg_mid; ?>" name="pg_mid" placeholder="xGhbgFfgHH1H146765">
                      </div>
                    </div>

                    <div class="col-md-4" hidden="">
                      <div class="form-group">
                        <label>PROD_KEY</label>
                        <input type="text" class="form-control" value="<?php echo $pg_key; ?>" name="pg_key" placeholder="HbGVGSG125BVvg">
                      </div>
                    </div>

                    <div class="col-md-4" hidden="">
                      <div class="form-group">
                        <label>WEBSITE TYPE </label>
                        <input type="text" class="form-control" value="<?php echo $pg_web; ?>" name="pg_web" placeholder="HbGVGSG125BVvg">
                      </div>
                    </div>

                    <div class="col-md-4" hidden="">
                      <div class="form-group">
                        <label>ACTIVATION Status : </label>
                        <input type="text" class="form-control" name="store_activation_fee" placeholder="Rs." hidden>
                        <?php
                        if ($activation_fee_status == "Activated") {
                          echo "<h2 class='text-success fa fa-check-circle'> Activated</h2>";
                        } else {
                          echo "<h2 class='text-danger fa fa-warning'> NOT Activated</h2>";
                        }
                        ?>
                      </div>
                    </div>

                  </div>
              </div>
              <div class="modal-footer">
                <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
                <button type="Submit" name="UPDATE_STORE" class="btn btn-outline-primary">UPDATE</button>
                </form>
              </div>
            </div>
          </div>
      </div>
      <!-- users edit Info form ends -->
    </div>
  </div>
  </div>
  </div>
  </section>
  <!-- users edit ends -->
  </div>
  </div>
  </div>
  <!-- END: Content-->

  <?php require 'footer.php'; ?>

</body>
<!-- END: Body-->

</html>