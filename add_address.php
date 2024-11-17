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
                <div class="flex-s-b pb-3" style="display: flex;
    justify-content: space-between;">
                  <h3 class="spc-responsive">Add New Address</h3>
                  <a href="address.php" class="btn btn-sm btn-primary">Back to All</a>
                </div>
                <form action="insert.php" method="POST">
                  <input type="text" name="url" value="address.php" hidden="">
                  <div class="row">
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                      <label class="control-label">Contact Person</label>
                      <input class="form-control border-form-control" name="contact_person" value="" placeholder="" type="text" required>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                      <label class="control-label">Alternate Phone</label>
                      <input class="form-control border-form-control" name="alt_phone" value="" placeholder="" type="text" required>
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label">House/Flat/Street no,</label>
                    <textarea class="form-control border-form-control" name="custaddress" value="" rows="3" type="text" required=''></textarea>
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
                    <label class="control-label">Select Area Pincode</label>
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
                      <option class="Home Address">Home Address</option>
                      <option class="Office Address">Office Address</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12 col-sm-6 col-xs-12">
                    <label class="control-label">GST No (Optional)</label>
                    <input class="form-control border-form-control" name="gst_no" value="" placeholder="" type="text">
                  </div>
                  <div class="form-group col-md-12 col-sm-6 col-xs-12 pt-2">
                    <button class="btn btn-success btn-md mt-3" name="save_address" type="submit">Save Address</button>
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