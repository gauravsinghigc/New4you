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

                <h3 class="mb-3 spc-responsive">Notification</h3>
                <section class="container-fluid">
                  <div class="row">

                    <div class="col-12 col-xs-12 col-sm-12" style='padding-left:1%; padding-right:1%;'>
                      <?php
                      $customer_id = $_SESSION['customer_id'];
                      $READNOTIFICATION = "UPDATE notifications SET notification_status='READ', read_time=CURRENT_TIMESTAMP where customer_id='$customer_id' and notification_status='NEW'";
                      $Query = mysqli_query($con, $READNOTIFICATION);
                      if ($Query == true) {

                        $sql = "SELECT * FROM notifications where customer_id='$customer_id' ORDER BY notification_id DESC LIMIT 0, 16";
                        $query = mysqli_query($con, $sql);
                        while ($fetch = mysqli_fetch_assoc($query)) {
                          $notification_id = $fetch['notification_id'];
                          $notification_title = $fetch['notification_title'];
                          $notification_date = $fetch['notification_date'];
                          $notification_desc = $fetch['notification_desc'];
                          $notification_status = $fetch['notification_status'];
                          $read_time = $fetch['read_time'];
                          $NotificationReadTime = date("D d M, Y h:m A", strtotime($read_time));
                          $NotificationSendTime = date("D d M, Y h:m A", strtotime($notification_date)); ?>

                          <p style="font-size: 12.5px;
    background-color: #f7f7f7;
    padding: 1%;
    color: black;
    margin-bottom: 1%;
    text-align: justify;
    cursor: pointer;
    box-shadow: 0px 0px 1px grey;" onclick="ShowMsg<?php echo $notification_id; ?>()">
                            <i class="fa fa-bell text-success"></i> <b><?php echo $notification_title; ?></b><br>
                            <span style="float: right;
          margin-top: -4%;
    margin-bottom: -5px;
    font-size: 11px;"><i class="fa fa-clock-o"></i> <?php echo $NotificationSendTime; ?></span>
                            <span style="margin-top: 2.7vw;"><?php echo $notification_desc; ?></span>
                          </p>
                          <script type="text/javascript">
                            function ShowMsg<?php echo $notification_id; ?>() {
                              var NOTDETAILS<?php echo $notification_id; ?> = document.getElementById("NOTDETAILS<?php echo $notification_id; ?>");
                              if (NOTDETAILS<?php echo $notification_id; ?>.style.display == "none") {
                                NOTDETAILS<?php echo $notification_id; ?>.style.display = "block";
                              } else {
                                NOTDETAILS<?php echo $notification_id; ?>.style.display = "none";
                              }
                            }
                          </script>
                          <div style="padding: 2%;
    border-radius: 25px;
    box-shadow: grey 0px 0px 50px;
    position: fixed;
    bottom: 1%;
    right: 1%;
    z-index: 12;
    font-size: 11px;
    color: black !important;
    width: 45% !important;
    min-width: 200px;
    max-width:350px;
    background-color: white;
    text-align:justify;
    display: none;" id="NOTDETAILS<?PHP echo $notification_id; ?>">
                            <h5><i class="fa fa-bell"></i>
                              <spna class="text-primary"> Notification </spna>
                              <span style="clear: right;float: right;"><i class="fa fa-send"></i> <?php echo $NotificationSendTime; ?> </span>
                            </h5>
                            <p style="color: black;font-size: 13px;">
                              <span style="float: right"><i class="fa fa-info-circle"></i> ID<?php echo $notification_id; ?></span>
                              <b>Notification Title <i class="fa fa-angle-right"></i></b> <?php echo $notification_title; ?><br>
                              <b>Sent at:</b> <?php echo $NotificationSendTime; ?><br>
                              <b>Read at:</b> <?php echo $NotificationReadTime; ?><br><br>
                              <b><i class="fa fa-envelope"></i></b> <?php echo $notification_desc; ?>

                              <hr>
                              <span class="btn btn-lg btn-danger float-right" onclick="ShowMsg<?php echo $notification_id; ?>()" style="cursor: pointer;"><i class="fa fa-times"></i> Close</span>
                            </p>
                          </div>

                      <?php }
                      } ?>




                    </div>
                  </div>
                </section>
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