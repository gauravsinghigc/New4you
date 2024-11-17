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
          <div class="account-sidebar"><a class="popup-btn">More Details</a></div>
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
                <h3 class="mb-3 spc-responsive">Account Settings</h3>
                <form action='insert.php' method="POST">
                  <input type="text" name="customer_id" value="<?php echo $customer_id; ?>" hidden>
                  <div class="section-header">
                    <h5 class="heading-design-h5">
                      <i class="fa fa-lock text-success"></i> Change Password
                    </h5>
                    <hr>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label class="control-label">Current Password</label>
                        <input type="password" class="form-control border-form-control " name="customer_password_old" value='' placeholder='Enter Current Password'>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label">New Password</label>
                        <input type="password" class="form-control border-form-control " name="customer_password_new" value='' placeholder='Enter New Password'>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <div class="form-group">
                          <label class="control-label">RE-Enter New Password</label>
                          <input type="password" class="form-control border-form-control " name="customer_password_new_2" value='' placeholder='Re Enter New Password'>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 text-right">

                      <a href='index.php' class="btn btn-info btn-lg"> Go to Home </a>
                      <button type="submit" name="update_customer_password" class="btn btn-success btn-lg"><?php
                                                                                                            if (isset($_GET['pass_update'])) {
                                                                                                              $address_update_value = $_GET['pass_update'];
                                                                                                              if ($_GET['pass_update'] == "true") {
                                                                                                                echo "<i class='fa fa-check-circle mt-0'></i> Password Updated!";
                                                                                                              } elseif ($_GET['pass_update'] == "false") {
                                                                                                                echo "<i class='fa fa-warning mt-0'></i> Failed!";
                                                                                                              } else {
                                                                                                                echo "Update Password";
                                                                                                              }
                                                                                                            } else {
                                                                                                              echo "Update Password";
                                                                                                            }
                                                                                                            ?></button>
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