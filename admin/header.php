<div id="loader" class="center"></div>
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-light">
  <div class="navbar-wrapper">
    <div class="navbar-header">
      <?php require 'navbar-nav.php'; ?>
    </div>
    <div class="navbar-container content">
      <div class="collapse navbar-collapse" id="navbar-mobile" style="height: 50px;">
        <ul class="nav navbar-nav mr-auto float-left">
        </ul>
        <ul class="nav navbar-nav float-right">

          <li class="dropdown dropdown-notification nav-item">
            <a class="nav-link nav-link-label pl-1" href="support.php">
              <img src="img/STSchat.gif" style="width:30px;">
              <?php
              $Select = "SELECT * FROM queryies where query_status=null order by query_id DESC";
              $query = mysqli_query($con, $Select);
              $CountQuery = mysqli_num_rows($query);
              if ($CountQuery == 0) {
              } else { ?>
                <span class="badge badge-pill badge-warning badge-up"><?php echo $CountQuery; ?></span>
              <?php } ?>
            </a>
          </li>

          <li class="dropdown dropdown-notification nav-item">
            <a class="nav-link nav-link-label pl-1" href="pickup_orders.php">
              <?php
              $user_role = $_SESSION['user_role'];
              if ($user_role == "STORE_USER") {
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * from stores where user_id='$user_id'";
                $query = mysqli_query($con, $sql);
                $fetch = mysqli_fetch_assoc($query);
                $store_id = $fetch['store_id'];
                $sql = "SELECT * FROM customer_orders, customers where customer_orders.store_id='$store_id' and customers.customer_id=customer_orders.customer_id and customer_orders.order_status='NEW_ORDER'";
                $query = mysqli_query($con, $sql);
                $count_orders = mysqli_num_rows($query);
                if ($count_orders == 0) { ?>
                  <img src='img/7df31e490de5c1773242a0303f8e29b5.gif' style="width: 30px;">
                <?php } else { ?>
                  <img src='img/7df31e490de5c1773242a0303f8e29b5.gif' style="width: 30px;">
                  <span class="badge badge-pill badge-warning badge-up"><?php echo $count_orders; ?></span>
              <?php }
              } else {
              }
              ?>

            </a>
            <?php require 'navbar-msg.php';
            $login_user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM users where user_id='$login_user_id'";
            $query =  mysqli_query($con, $sql);
            $fetch = mysqli_fetch_assoc($query);
            $user_img = $fetch['user_img'];
            $user_status = $fetch['user_status']; ?>
          </li>
          <li class="dropdown dropdown-user nav-item">
            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown" style="padding-top: 10%;">
              <div class="avatar avatar-online">
                <?php
                if ($user_img == null) {
                  $userimg = "app-assets/images/portrait/small/avatar-s-26.png";
                } else {
                  $userimg = $fetch['user_img'];
                }
                ?>
                <img src="<?php echo $userimg; ?>" alt="<?php echo $fetch['full_name']; ?>" title='<?php echo $fetch['full_name']; ?>'>
              </div>
              <span class="user-name">
                <?php
                $login_user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM users where user_id='$login_user_id'";
                $query =  mysqli_query($con, $sql);
                $fetch = mysqli_fetch_assoc($query);
                echo $full_name = $fetch['full_name']; ?>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="profile.php"><i class="fa fa-edit"></i> Edit Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<!-- END: Header-->