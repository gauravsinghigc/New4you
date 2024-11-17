<?php
require 'files.php';
require 'session.php';
$user_view_id = $_GET['user_view'];
$sql = "SELECT * FROM users where user_id='$user_view_id'";
$query  = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$user_full_name = $fetch['full_name'];
$user_phone = $fetch['phone_number'];
$user_email_id = $fetch['email_id'];
$user_Role_id = $fetch['user_role'];
$user_type = $fetch['user_type'];

$sql = "SELECT * FROM user_types where user_type_id='$user_Role_id'";
$query  = mysqli_query($con, $sql);
$fetch =  mysqli_fetch_assoc($query);
$user_type_title = $fetch['user_type_title'];
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="<?php echo $PosName; ?>">
  <title><?php echo $user_full_name; ?> : <?php echo $PosName; ?></title>
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
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12 card-content px-1 mobile-font-size">
                  <h3 class="mobile-font-size">Dashboard of</h3>
                  <h4 class="mobile-font-size"><b>UID:</b> <?php echo $user_view_id; ?> : <?php echo $user_full_name; ?></h4>
                  <p class="mobile-font-size">
                    <i class="fa fa-briefcase"></i> <?php echo $user_type_title; ?> | <?php echo $user_type; ?><br>
                    <i class="fa fa-envelope"></i> <?php echo $user_email_id; ?><br>
                    <i class="fa fa-phone"></i> <?php echo $user_phone; ?>
                  <form action='team_edit.php' method="POST" class="float-right">
                    <button type="submit" value="<?php echo $user_id; ?>" name='id' class="btn btn-link btn-outline-primary btn-md">
                      <i class="fa fa-edit"></i> Edit Profile</button>
                  </form>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="content-body">
            <?php $user_role = $_SESSION['user_role'];

            if ($user_role == "SUPER_ADMIN") {
              require 'super_admin_count.php';
            } elseif ($user_role == "TEAM_LEADER") {
              require 'team_admin_count.php';
            } elseif ($user_role == "INFLUENCER") {
              require 'inf_admin_count.php';
            } elseif ($user_role == "STORE_USER") {
              require 'store_admin_count.php';
            } elseif ($user_role == "VENDORS") {
              require 'vendor_admin_count.php';
            } elseif ($user_role == "EMPLOYEE") {
              require 'emp_admin_count.php';
            } ?>

            <!-- Minimal modern charts for power consumption, region statistics and sales etc. starts here -->
            <div class="row minimal-modern-charts">
              <!-- power consumption chart -->
              <div class="col-xxl-5 col-xl-7 col-lg-7 col-md-12 col-12 power-consumption-stats-chart">
                <div class="card">
                  <div class="card-content pt-2 px-1">
                    <div class="row">
                      <div class="col-8 d-flex">
                        <div>
                          <h4 class="power-consumption-stats-title text-bold-350 mobile-font-size"><b>Calling Statistics</b></h4>
                          <?php
                          if (isset($_GET['cy'])) {
                            $cyf = $_GET['cy'];
                            $cmf = $_GET['cm']; ?>
                            <div class="row">
                              <div class="col-lg-12 col-xl-12 col-12">
                                <div class="alert alert-success-outline alert-dismissible" role="alert">
                                  <button type="button" class="close" onclick="remove_msg()" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" class="float-right mt-0">&times;</span>
                                  </button>
                                  <h6 class="p-0 ml-0 mobile-font-size"><b>Filter By:</b> <span class="text-danger"><?php echo $cyf; ?> <i class="fa fa-angle-right"></i> <?php echo $cmf; ?></span> </h6>
                                </div>
                              </div>
                            </div>

                          <?php } else {
                            echo "";
                          } ?>
                        </div>
                      </div>
                      <div class="col-4 d-flex justify-content-end pr-1">
                        <div class="dark-text">
                          <a onclick="remove_msg()">
                            <h6 class="power-consumption-active-tab text-bold-500 mobile-font-size">Week</h6>
                          </a>
                        </div>
                        <div class="dropdown update-year-menu pb-1 ml-1">
                          <h6 id="dropdownMenuLink" class="dropdown-toggle mobile-font-size" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><a class="bg-transparent light-text black" href="#" role="button"><?php echo date("M"); ?></a></h6>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <?php
                            if (isset($_GET['cy'])) {
                              $cy = $_GET['cy'];
                              $CFY = "&cy=$cy";
                            } else {
                              $CFY = "&cy=";
                            }
                            ?>
                            <a class="dropdown-item" href="?cm=<?php echo date("M", strtotime("-1 Month")); ?><?php echo $CFY; ?>"><?php echo date("M", strtotime("-1 Month")); ?></a>
                            <a class="dropdown-item" href="?cm=<?php echo date("M", strtotime("-2 Month")); ?><?php echo $CFY; ?>"><?php echo date("M", strtotime("-2 Month")); ?></a>
                            <a class="dropdown-item" href="?cm=<?php echo date("M", strtotime("-3 Month")); ?><?php echo $CFY; ?>"><?php echo date("M", strtotime("-3 Month")); ?></a>
                            <a class="dropdown-item" href="?cm=<?php echo date("M", strtotime("-4 Month")); ?><?php echo $CFY; ?>"><?php echo date("M", strtotime("-4 Month")); ?></a>
                            <a class="dropdown-item" href="?cm=<?php echo date("M", strtotime("-5 Month")); ?><?php echo $CFY; ?>"><?php echo date("M", strtotime("-5 Month")); ?></a>
                          </div>
                        </div>
                        <div class="dropdown update-year-menu pb-1 ml-0">
                          <h6 id="dropdownMenuLink" class="dropdown-toggle mobile-font-size" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><a class="bg-transparent light-text black" href="#" role="button"><?php echo date("Y"); ?></a></h6>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <?php
                            if (isset($_GET['cm'])) {
                              $cm = $_GET['cm'];
                              $CFM = "&cm=$cm";
                            } else {
                              $CFM = "&cm=";
                            }
                            ?>
                            <a class="dropdown-item" href="?cy=<?php echo date("Y", strtotime("-1 Year")); ?><?php echo $CFM; ?>"><?php echo date("Y", strtotime("-1 Year")); ?></a>
                            <a class="dropdown-item" href="?cy=<?php echo date("Y", strtotime("-2 Year")); ?><?php echo $CFM; ?>"><?php echo date("Y", strtotime("-2 Year")); ?></a>
                            <a class="dropdown-item" href="?cy=<?php echo date("Y", strtotime("-3 Year")); ?><?php echo $CFM; ?>"><?php echo date("Y", strtotime("-3 Year")); ?></a>
                            <a class="dropdown-item" href="?cy=<?php echo date("Y", strtotime("-2 Year")); ?><?php echo $CFM; ?>"><?php echo date("Y", strtotime("-4 Year")); ?></a>
                            <a class="dropdown-item" href="?cy=<?php echo date("Y", strtotime("-3 Year")); ?><?php echo $CFM; ?>"><?php echo date("Y", strtotime("-5 Year")); ?></a>

                          </div>
                        </div>
                      </div>

                    </div>
                    <div id="spline-chart"></div>
                  </div>
                </div>
              </div>

              <!-- tracking stats chart -->
              <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-12 tracking-stats-chart">
                <div class="card chart-with-tabs">
                  <div class="card-content">
                    <ul class="nav nav-pills card-tabs mb-2 pl-2 border-bottom-blue-grey border-bottom-lighten-5" id="pills-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link text-primary bg-transparent active px-0 mr-1 py-1" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">New Activation</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-primary bg-transparent px-0 py-1" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Subscription Fees</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="body-header pl-2">
                          <div class="float-right p-t p-1">
                            <h5 class="text-info mt-0"><i class="fa fa-circle"></i> <?php echo date("M, Y"); ?></h5>
                          </div>
                          <div class="d-flex">
                            <h3 class="mr-2 body-header-title text-bold-600 mb-0"><i class="fa fa-inr"></i>
                              <?php
                              $user_id = $_SESSION['user_id'];
                              $user_role = $_SESSION['user_role'];
                              $this_month_s = date("M");
                              $this_year_s = date("Y");
                              if ($user_role == "SUPER_ADMIN") {
                                $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$this_month_s' and store_add_year='$this_year_s'";
                                $query = mysqli_query($con, $sql);
                                while ($record = mysqli_fetch_array($query)) {
                                  $total_amount_a = $record['sum(store_activation_fee)'];
                                  if ($total_amount_a == 0) {
                                    echo "0";
                                  } else {
                                    echo $total_amount_a;
                                  }
                                }
                              } else {
                                $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$this_month_s' and store_add_year='$this_year_s' and store_ref_id='$user_id'";
                                $query = mysqli_query($con, $sql);
                                while ($record = mysqli_fetch_array($query)) {
                                  $total_amount_a = $record['sum(store_activation_fee)'];
                                  if ($total_amount_a == 0) {
                                    echo "0";
                                  } else {
                                    echo $total_amount_a;
                                  }
                                }
                              }
                              ?>
                            </h3>
                            <small class="success"> <?php
                                                    $user_id = $_SESSION['user_id'];
                                                    $user_role = $_SESSION['user_role'];
                                                    $this_month_s = date("M");
                                                    $this_year_s = date("Y");
                                                    if ($user_role == "SUPER_ADMIN") {
                                                      $sql = "SELECT * FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$this_month_s' and store_add_year='$this_year_s'";
                                                      $query = mysqli_query($con, $sql);
                                                      $total_store_count = mysqli_num_rows($query);
                                                      if ($total_store_count == 0) {
                                                        echo "0";
                                                      } else {
                                                        echo $total_store_count;
                                                      }
                                                    } else {
                                                      $sql = "SELECT * FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$this_month_s' and store_add_year='$this_year_s' and store_ref_id='$user_id'";
                                                      $query = mysqli_query($con, $sql);
                                                      $total_store_count = mysqli_num_rows($query);
                                                      if ($total_store_count == 0) {
                                                        echo "0";
                                                      } else {
                                                        echo $total_store_count;
                                                      }
                                                    }
                                                    ?> Stores</small>
                          </div>
                          <div class="body-header-subtitle">
                            <span class="text-muted">Activation Fee Received</span>
                          </div>

                        </div>
                        <div id="product_sales_column_basic_chart"></div>
                      </div>
                      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="tracking-tab-container px-2">
                          <div class="tracking-tab-content">
                            <div class="top-content d-flex flex-wrap justify-content-start mt-2 pb-1 mb-2">
                              <div class="tracking-heading-icon mr-2">
                                <i class="icon icon-pie-chart"></i>
                              </div>
                              <div class="pb-30">
                                <h5 class="tracking-tab-title mb-0 text-bold-600">Total Stores</h5>

                                <small class="text-muted">
                                  <?php
                                  $user_id = $_SESSION['user_id'];
                                  $user_role = $_SESSION['user_role'];
                                  $this_month_s = date("M");
                                  $this_year_s = date("Y");
                                  if ($user_role == "SUPER_ADMIN") {
                                    $sql = "SELECT * FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$this_month_s' and store_add_year='$this_year_s'";
                                    $query = mysqli_query($con, $sql);
                                    $total_store_count = mysqli_num_rows($query);
                                    if ($total_store_count == 0) {
                                      echo "0";
                                    } else {
                                      echo $total_store_count;
                                    }
                                  } else {
                                    $sql = "SELECT * FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$this_month_s' and store_add_year='$this_year_s' and store_ref_id='$user_id'";
                                    $query = mysqli_query($con, $sql);
                                    $total_store_count = mysqli_num_rows($query);
                                    if ($total_store_count == 0) {
                                      echo "0";
                                    } else {
                                      echo $total_store_count;
                                    }
                                  }
                                  ?> Stores
                                </small>
                              </div>
                            </div>

                            <div class="bottom-content">
                              <ul class="tracking-list list-group">
                                <li class="list-group-item border py-1 px-0 d-flex justify-content-between align-items-center">
                                  <span class="tracking-task text-bold-600 text-left">Active Stores</span>
                                  <span class="badge badge-pill badge-success px-1 py-50">
                                    <?php
                                    $user_id = $_SESSION['user_id'];
                                    $user_role = $_SESSION['user_role'];
                                    $this_month_s = date("M");
                                    $this_year_s = date("Y");
                                    if ($user_role == "SUPER_ADMIN") {
                                      $sql = "SELECT * FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$this_month_s' and store_add_year='$this_year_s'";
                                      $query = mysqli_query($con, $sql);
                                      $total_store_count = mysqli_num_rows($query);
                                      if ($total_store_count == 0) {
                                        echo "0";
                                      } else {
                                        echo $total_store_count;
                                      }
                                    } else {
                                      $sql = "SELECT * FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$this_month_s' and store_add_year='$this_year_s' and store_ref_id='$user_id'";
                                      $query = mysqli_query($con, $sql);
                                      $total_store_count = mysqli_num_rows($query);
                                      if ($total_store_count == 0) {
                                        echo "0";
                                      } else {
                                        echo $total_store_count;
                                      }
                                    }
                                    ?></span>
                                </li>
                                <li class="list-group-item border py-1 px-0 d-flex justify-content-between align-items-center">
                                  <span class="tracking-task text-bold-600 text-left">Recurring Fee Received</span>
                                  <span class="badge badge-pill badge-success px-1 py-50"><i class="fa fa-inr"></i>
                                    <?php
                                    $user_id = $_SESSION['user_id'];
                                    $user_role = $_SESSION['user_role'];
                                    $this_month_s = date("M");
                                    $this_year_s = date("Y");
                                    if ($user_role == "SUPER_ADMIN") {
                                      $sql = "SELECT sum(subsamount) FROM stores, store_subscriptions where activation_fee_status='ACTIVATED' and subspaymentmonth='$this_month_s' and subpaymentyear='$this_year_s' and stores.store_id=store_subscriptions.store_id";
                                      $query = mysqli_query($con, $sql);
                                      while ($record = mysqli_fetch_array($query)) {
                                        $total_amount_a = $record['sum(subsamount)'];
                                        if ($total_amount_a == 0) {
                                          echo "0";
                                        } else {
                                          echo $total_amount_a;
                                        }
                                      }
                                    } else {
                                      $sql = "SELECT sum(subsamount) FROM stores, store_subscriptions where activation_fee_status='ACTIVATED' and subspaymentmonth='$this_month_s' and subpaymentyear='$this_year_s' and store_ref_id='$user_id' and stores.store_id=store_subscriptions.store_id";
                                      $query = mysqli_query($con, $sql);
                                      while ($record = mysqli_fetch_array($query)) {
                                        $total_amount_a = $record['sum(subsamount)'];
                                        if ($total_amount_a == 0) {
                                          echo "0";
                                        } else {
                                          echo $total_amount_a;
                                        }
                                      }
                                    }
                                    ?>
                                  </span>
                                </li>
                                <li class="list-group-item border py-1 px-0 d-flex justify-content-between align-items-center">
                                  <span class="tracking-task text-bold-600 text-left">FEE Paid Stores</span>
                                  <span class="badge badge-pill badge-success px-1 py-50">
                                    <?php
                                    $user_id = $_SESSION['user_id'];
                                    $user_role = $_SESSION['user_role'];
                                    $this_month_s = date("M");
                                    $this_year_s = date("Y");
                                    if ($user_role == "SUPER_ADMIN") {
                                      $sql = "SELECT * FROM store_subscriptions, stores where store_subscriptions.store_id=stores.store_id and subspaymentmonth='$this_month_s' and subpaymentyear='$this_year_s' and subspaystatus='PAID'";
                                      $query = mysqli_query($con, $sql);
                                      $total_store_count = mysqli_num_rows($query);
                                      if ($total_store_count == 0) {
                                        echo "0";
                                      } else {
                                        echo $total_store_count;
                                      }
                                    } else {
                                      $sql = "SELECT * FROM store_subscriptions, stores where store_subscriptions.store_id=stores.store_id and subspaymentmonth='$this_month_s' and subpaymentyear='$this_year_s' and subspaystatus='PAID' and store_ref_id='$user_id'";
                                      $query = mysqli_query($con, $sql);
                                      $total_store_count = mysqli_num_rows($query);
                                      if ($total_store_count == 0) {
                                        echo "0";
                                      } else {
                                        echo $total_store_count;
                                      }
                                    }
                                    ?> Stores </span>
                                </li>
                                <li class="list-group-item border py-1 px-0 d-flex justify-content-between align-items-center">
                                  <span class="tracking-task text-bold-600 text-left">Pending Stores</span>
                                  <span class="badge badge-pill badge-danger px-1 py-50">
                                    <?php
                                    $user_id = $_SESSION['user_id'];
                                    $user_role = $_SESSION['user_role'];
                                    $this_month_s = date("M");
                                    $this_year_s = date("Y");
                                    if ($user_role == "SUPER_ADMIN") {
                                      $sql = "SELECT * FROM store_subscriptions, stores where store_subscriptions.store_id=stores.store_id and subspaymentmonth='$this_month_s' and subpaymentyear='$this_year_s' and subspaystatus='UNPAID'";
                                      $query = mysqli_query($con, $sql);
                                      $total_store_count = mysqli_num_rows($query);
                                      if ($total_store_count == 0) {
                                        echo "0";
                                      } else {
                                        echo $total_store_count;
                                      }
                                    } else {
                                      $sql = "SELECT * FROM store_subscriptions, stores where store_subscriptions.store_id=stores.store_id and subspaymentmonth='$this_month_s' and subpaymentyear='$this_year_s' and subspaystatus='UNPAID' and store_ref_id='$user_id'";
                                      $query = mysqli_query($con, $sql);
                                      $total_store_count = mysqli_num_rows($query);
                                      if ($total_store_count == 0) {
                                        echo "0";
                                      } else {
                                        echo $total_store_count;
                                      }
                                    }
                                    ?> Stores</span>
                                </li>
                                <li class="list-group-item border py-1 px-0 d-flex justify-content-between align-items-center">
                                  <span class="tracking-task text-bold-600 text-left">Inactive Stores</span>
                                  <span class="badge badge-pill badge-warning px-1 py-50">
                                    <?php
                                    $user_id = $_SESSION['user_id'];
                                    $user_role = $_SESSION['user_role'];
                                    $this_month_s = date("M");
                                    $this_year_s = date("Y");
                                    if ($user_role == "SUPER_ADMIN") {
                                      $sql = "SELECT * FROM stores where activation_fee_status='NOT_ACTIVATED' and store_add_month='$this_month_s' and store_add_year='$this_year_s'";
                                      $query = mysqli_query($con, $sql);
                                      $total_store_count = mysqli_num_rows($query);
                                      if ($total_store_count == 0) {
                                        echo "0";
                                      } else {
                                        echo $total_store_count;
                                      }
                                    } else {
                                      $sql = "SELECT * FROM stores where activation_fee_status='NOT_ACTIVATED' and store_add_month='$this_month_s' and store_add_year='$this_year_s' and store_ref_id='$user_id'";
                                      $query = mysqli_query($con, $sql);
                                      $total_store_count = mysqli_num_rows($query);
                                      if ($total_store_count == 0) {
                                        echo "0";
                                      } else {
                                        echo $total_store_count;
                                      }
                                    }
                                    ?> Stores</span>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- region stats chart -->
              <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-12 region-stats-chart">
                <div class="card statistic-card">
                  <div class="card-content">
                    <div class="top-row statistics-card-title border-bottom-blue-grey border-bottom-lighten-5">
                      <div class="py-1 pl-2 primary">
                        <span class="mb-1">
                          <?php
                          $user_role = $_SESSION['user_role'];
                          if ($user_role == "SUPER_ADMIN") {
                            echo "Revenue Statistics";
                          } else {
                            echo "My Performance";
                          } ?>
                        </span>
                      </div>
                    </div>
                    <div class="statistics-chart d-flex justify-content-center align-self-center">
                      <div id="sales_in_region_pie_donut"></div>
                    </div>
                    <div class="statistics-chart-data d-flex justify-content-center ml-auto mr-auto pb-50 mb-0">
                      <div class="collection mr-1">
                        <span class="bullet bullet-xs bullet-warning"></span>
                        <span class="font-weight-bold">Subscriptions Fee</span>
                      </div>
                      <div class="collection mr-1">
                        <span class="bullet bullet-xs bullet-primary"></span>
                        <span class="font-weight-bold">Activation Fee</span>
                      </div>
                    </div>
                    <h5 class="text-center">
                      Month : <?php echo date("M, Y"); ?>
                    </h5>
                    <div class="statistic-card-footer d-flex">
                      <div class="column-data py-1 text-center border-top-blue-grey border-top-lighten-5 flex-grow-1 text-center border-right-blue-grey border-right-lighten-5">
                        <p class="font-medium-3 mb-0"><i class="fa fa-inr"></i>
                          <?php
                          $user_role = $_SESSION['user_role'];
                          if ($user_role == "SUPER_ADMIN") {
                            $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED'";
                          } else {
                            $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_ref_id='$user_id'";
                          }
                          $query = mysqli_query($con, $sql);
                          while ($record = mysqli_fetch_array($query)) {
                            $total_amount_a = $record['sum(store_activation_fee)'];
                            if ($total_amount_a == 0) {
                              echo "0";
                            } else {
                              echo $total_amount_a;
                            }
                          }
                          ?></p>
                        <span>Activation Fee</span>
                      </div>
                      <div class="column-data py-1 flex-grow-1 text-center border-top-blue-grey border-top-lighten-5">
                        <p class="font-medium-3 mb-0"><?php
                                                      $user_role = $_SESSION['user_role'];
                                                      if ($user_role == "SUPER_ADMIN") {
                                                        $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED'";
                                                      } else {
                                                        $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_ref_id='$user_id'";
                                                      }
                                                      $sql = "SELECT * FROM stores where activation_fee_status='ACTIVATED'";
                                                      $query  = mysqli_query($con, $sql);
                                                      $count =  mysqli_num_rows($query);
                                                      if ($count == 0) {
                                                        echo "0";
                                                      } else {
                                                        echo $count;
                                                      } ?></p>
                        <span>New Stores</span>
                      </div>
                      <div class="column-data py-1 flex-grow-1 text-center border-top-blue-grey border-top-lighten-5 border-left-blue-grey border-left-lighten-5">
                        <p class="font-medium-3 mb-0"><i class="fa fa-inr"></i>0</p>
                        <span>Subscription Paid</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <!-- latest update tracking chart-->
              <div class="col-xxl-4 col-xl-8 col-lg-8 col-md-12 col-12 latest-update-tracking">
                <div class="card">
                  <div class="card-header latest-update-heading d-flex justify-content-between">
                    <h4 class="latest-update-heading-title text-bold-500">System Performance</h4>
                    <h5 id="dropdownMenuLink" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><a class="bg-transparent light-text text-info" href="#" role="button"><?php echo date("Y"); ?></a></h5>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="?y=<?php echo date("Y", strtotime("-1 Year")); ?>"><?php echo date("Y", strtotime("-1 Year")); ?></a>
                      <a class="dropdown-item" href="?y=<?php echo date("Y", strtotime("-2 Year")); ?>"><?php echo date("Y", strtotime("-2 Year")); ?></a>
                      <a class="dropdown-item" href="?y=<?php echo date("Y", strtotime("-3 Year")); ?>"><?php echo date("Y", strtotime("-3 Year")); ?></a>
                    </div>

                  </div>
                  <div class="card-content latest-update-tracking-list pt-0 pb-1 px-2 position-relative">
                    <ul class="list-group">
                      <li class="list-group-item pt-0 px-0 latest-updated-item border-0 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                          <span class="list-group-item-icon d-inline mr-1">
                            <i class="icon text-primary bg-light-primary icon-bag total-products-icon rounded-circle p-50"></i>
                          </span>
                          <div>
                            <p class="mb-25 latest-update-item-name text-bold-600">Total Stores</p>
                          </div>
                        </div>
                        <span class="update-profit text-bold-600">
                          <?php
                          $sql = "SELECT * FROM stores where activation_fee_status='ACTIVATED'";
                          $query  = mysqli_query($con, $sql);
                          $count =  mysqli_num_rows($query);
                          if ($count == 0) {
                            echo "0";
                          } else {
                            echo $count;
                          } ?>
                          Stores</span>
                      </li>
                      <li class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                          <span class="list-group-item-icon d-inline mr-1">
                            <i class="icon icon-graph bg-light-info text-info total-sales-icon rounded-circle p-50"></i>
                          </span>
                          <div>
                            <p class="mb-25 latest-update-item-name text-bold-600">Total Sales</p>
                          </div>
                        </div>
                        <span class="update-profit text-bold-600"><i class="fa fa-inr"></i>
                          <?php
                          $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED'";
                          $query = mysqli_query($con, $sql);
                          while ($record = mysqli_fetch_array($query)) {
                            $total_amount_a = $record['sum(store_activation_fee)'];
                            if ($total_amount_a == 0) {
                              echo "0";
                            } else {
                              echo $total_amount_a;
                            }
                          }
                          ?></span>
                      </li>
                      <li class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                          <span class="list-group-item-icon d-inline mr-1">
                            <i class="icon icon-bag bg-light-danger text-danger total-products-icon rounded-circle p-50"></i>
                          </span>
                          <div>
                            <p class="mb-25 latest-update-item-name text-bold-600">Total Products</p>
                          </div>
                        </div>
                        <span class="update-profit text-bold-600">
                          1<?php
                            $sql = "SELECT * FROM store_products";
                            $query  = mysqli_query($con, $sql);
                            $count =  mysqli_num_rows($query);
                            if ($count == 0) {
                              echo "0";
                            } else {
                              echo $count;
                            } ?> Products</span>
                      </li>
                      <li class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                          <div class="list-group-item-icon d-inline mr-1">
                            <i class="icon icon-credit-card bg-light-primary text-primary total-revenue-icon rounded-circle p-50"></i>
                          </div>
                          <div>
                            <p class="mb-25 latest-update-item-name text-bold-600">Total Visitors</p>
                          </div>
                        </div>
                        <span class="update-profit text-bold-600">
                          <?php
                          $sql = "SELECT sum(visitors_view) FROM visitors";
                          $query = mysqli_query($con, $sql);
                          while ($record = mysqli_fetch_array($query)) {
                            $total_amount_a = $record['sum(visitors_view)'];
                            if ($total_amount_a == 0) {
                              echo "0";
                            } else {
                              echo $total_amount_a;
                            }
                          }
                          ?> visits</span>
                      </li>
                      <li class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                          <span class="list-group-item-icon d-inline mr-1">
                            <i class="icon icon-graph bg-light-info text-info total-sales-icon rounded-circle p-50"></i>
                          </span>
                          <div>
                            <p class="mb-25 latest-update-item-name text-bold-600">Total Orders</p>
                          </div>
                        </div>
                        <span class="update-profit text-bold-600"><?php
                                                                  $sql = "SELECT * FROM customer_orders";
                                                                  $query  = mysqli_query($con, $sql);
                                                                  $count =  mysqli_num_rows($query);
                                                                  if ($count == 0) {
                                                                    echo "0";
                                                                  } else {
                                                                    echo $count;
                                                                  } ?> Orders</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- info and time tracking chart -->
              <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 col-12">
                <div class="card info-time-tracking">
                  <div class="card-content">
                    <div class="row">
                      <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                        <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
                          <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Call Performance</h4>
                          <span class="pr-2">
                            <i class="icon icon-settings"></i>
                          </span>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="info-time-tracking-content">
                          <div class="row">
                            <div class="col-md-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                              <div class="general-task-loading pr-2 pl-4 px-sm-4 px-md-2 py-md-2 d-flex justify-content-start">
                                <div id="general_task_radial_bar_chart"></div>
                                <div class="task-content d-flex flex-column align-items-start justify-content-center">
                                  <h5 class="font-weight-bold mt-2 mt-sm-0">Daily Tasks Completion</h5>
                                  <p class="leading-para">
                                    To reach 100% call performance you should archive 50 new stores with feedback.
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <div class="pr-2 total-stats pl-4 px-sm-4 px-md-2 py-md-2 d-flex justify-content-start">
                                <div id="info_tracking_total_stats"></div>
                                <div class="pl-2 ml-50 stats-content d-flex flex-column align-items-start justify-content-center pr-2">
                                  <h5 class="font-weight-bold">Week Performance</h5>
                                  <p class="leading-para">YOUR daily calling performance is trackable for your own analysis.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- active users and my task timeline cards starts here -->
            <div class="row match-height">
              <!-- active users card -->
              <div class="col-xl-12 col-lg-12">
                <div class="card active-users">
                  <div class="card-header border-0">
                    <h4 class="card-title">TOTAL STORES</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                      <ul class="list-inline mb-0">
                        <li><a href="">ALL Store</a></li>
                        <li><a href="?str=active">Active :
                            <?php
                            $user_id_s = $_SESSION['user_id'];
                            $user_role = $_SESSION['user_role'];
                            $selectusers = "SELECT * from users where ref='$user_id_s'";
                            $userquery = mysqli_query($con, $selectusers);
                            $fetchusers = mysqli_fetch_assoc($userquery);
                            $ref_id = $fetchusers['user_id'];
                            $selectstore = "SELECT * from stores, users where stores.user_id=users.user_id and stores.store_ref_id='$ref_id' and store_status='active'";
                            $selectquery = mysqli_query($con, $selectstore);
                            $countactivestore = mysqli_num_rows($selectquery);
                            echo $countactivestore; ?>
                          </a></li>

                        <li><a href="?str=inactive">InActive : <?php
                                                                $user_id_s = $_SESSION['user_id'];
                                                                $user_role = $_SESSION['user_role'];
                                                                $selectusers = "SELECT * from users where ref='$user_id_s'";
                                                                $userquery = mysqli_query($con, $selectusers);
                                                                $fetchusers = mysqli_fetch_assoc($userquery);
                                                                $ref_id = $fetchusers['user_id'];
                                                                $selectstore = "SELECT * from stores, users where stores.user_id=users.user_id and stores.store_ref_id='$ref_id' and store_status='inactive'";
                                                                $selectquery = mysqli_query($con, $selectstore);
                                                                $countactivestore = mysqli_num_rows($selectquery);
                                                                echo $countactivestore; ?></a></li>

                        <li><a href="?str=unlisted">UnListed : <?php
                                                                $user_id_s = $_SESSION['user_id'];
                                                                $user_role = $_SESSION['user_role'];
                                                                $selectusers = "SELECT * from users where ref='$user_id_s'";
                                                                $userquery = mysqli_query($con, $selectusers);
                                                                $fetchusers = mysqli_fetch_assoc($userquery);
                                                                $ref_id = $fetchusers['user_id'];
                                                                $selectstore = "SELECT * from stores, users where stores.user_id=users.user_id and stores.store_ref_id='$ref_id' and store_status='unlisted'";
                                                                $selectquery = mysqli_query($con, $selectstore);
                                                                $countactivestore = mysqli_num_rows($selectquery);
                                                                echo $countactivestore; ?></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table" id="users-list-datatable">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Owner Name</th>
                              <th>Store name</th>
                              <th>Phone Number</th>
                              <th>Email ID</th>
                              <th>Orders</th>
                              <th>REG DATE</th>
                              <th>Status</th>
                              <th>Details</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $user_id_s = $_SESSION['user_id'];
                            $user_role = $_SESSION['user_role'];
                            $selectusers = "SELECT * from users where ref='$user_id_s'";
                            $userquery = mysqli_query($con, $selectusers);
                            while ($fetchusers = mysqli_fetch_assoc($userquery)) {
                              $ref_id = $fetchusers['user_id'];
                              if (isset($_GET['str'])) {
                                $str = $_GET['str'];
                                $selectstore = "SELECT * from stores, users where stores.user_id=users.user_id and stores.store_ref_id='$ref_id' and store_status='$str'";
                              } else {
                                $selectstore = "SELECT * from stores, users where stores.user_id=users.user_id and stores.store_ref_id='$ref_id'";
                              }
                              $selectquery = mysqli_query($con, $selectstore);

                              $countstore = mysqli_num_rows($selectquery);



                              while ($storefetch = mysqli_fetch_assoc($selectquery)) {
                                $StoreUserId = $storefetch['user_id'];
                                $StoreId = $storefetch['store_id'];
                                $Storename = $storefetch['store_name'];
                                $StoreOwner = $storefetch['full_name'];
                                $StorePhone = $storefetch['store_phone'];
                                $StoreStatus = $storefetch['store_status'];
                                $StoreVisibility = $storefetch['store_visibility'];
                                $StoreActivation = $storefetch['activation_fee_status'];
                                $StoreUserId = $storefetch['user_id'];
                                $Storemailid = $storefetch['store_mail_id'];
                                $StoreAddDate = $storefetch['store_add_date'];
                                $user_imgs = $fetch['user_img'];
                                if ($user_imgs == null) {
                                  $userimgs = "app-assets/images/portrait/small/avatar-s-26.png";
                                } else {
                                  $userimgs = $fetch['user_img'];
                                }
                                if ($StoreStatus == "active") {
                                  $storestatusview = '<span class="badge badge-md badge-success">Active</span>';
                                } elseif ($StoreStatus == "Inactive") {
                                  $storestatusview = '<span class="badge badge-md badge-warning">Inactive</span>';
                                } elseif ($StoreStatus == "unlisted") {
                                  $storestatusview = '<span class="badge badge-md badge-danger">Un Listed</span>';
                                } else {
                                  $storestatusview = '<span class="badge">NA</span>';
                                }
                                $sql = "SELECT * FROM customer_orders where store_id='$StoreId'";
                                $query = mysqli_query($con, $sql);
                                $countorders = mysqli_num_rows($query);
                                if ($countorders == 0) {
                                  $countorderss = "0 Orders";
                                } else {
                                  $countorderss = $countorders;
                                } ?>
                                <tr>
                                  <td>
                                    STR<?php echo $StoreId; ?>
                                  </td>
                                  <td>
                                    <?php echo $StoreOwner; ?>
                                  </td>
                                  <td>
                                    <?php echo $Storename; ?>
                                  </td>
                                  <td>
                                    <?php echo $StorePhone; ?>
                                  </td>
                                  <td>
                                    <?php echo $Storemailid; ?>
                                  </td>
                                  <td>
                                    <?php echo $countorderss; ?>
                                  </td>
                                  <td>
                                    <?php echo $StoreAddDate; ?>
                                  </td>
                                  <td>
                                    <span class="badge badge-success"><?php echo $storestatusview; ?></span>
                                  </td>
                                  <td>
                                    <form action='team_edit.php' method="POST">
                                      <button type="submit" value="<?php echo $StoreUserId; ?>" name='id' class='btn btn-outline-info btn-md font-small-3'>More</button>
                                    </form>
                                  </td>
                                </tr>

                            <?php }
                            } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- my task Timeline -->
              <div class="col-xl-12 col-lg-12">
                <div class="card">
                  <div class="card-header border-0">
                    <h4 class="card-title">My Tasks : <a href="tasks.php">View ALL Tasks</a></h4>
                    <div class="heading-elements">
                      <ul class="list-inline">
                        <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      <div class="widget-timeline">
                        <ul>
                          <li class="timeline-items timeline-icon-success">
                            <div class="timeline-title">Store Activation </div>
                            <?php
                            $user_id = $_SESSION['user_id'];
                            $select = "SELECT * FROM stores where store_ref_id='$user_id' and activation_fee_status!='ACTIVATED'";
                            $query =  mysqli_query($con, $select);
                            $counttask = mysqli_num_rows($query);
                            if ($counttask == 0) {
                              echo '<div class="timeline-subtitle">No tasks</div>';
                            }
                            while ($fetch = mysqli_fetch_assoc($query)) {
                              $store_add_date = $fetch['store_add_date']; ?>
                              <p class="timeline-time"><?php echo $store_add_date; ?></p>
                              <div class="timeline-title">New Store Activation : <a href='team_stores.php'>STRID<?php echo $fetch['store_id']; ?> : <?php echo $fetch['store_name']; ?></a>
                              </div>
                              <div class="timeline-subtitle">Store Activation : <?php echo $fetch['store_activation_date']; ?><br>
                                Subscription FEE: Rs.<?php echo $fetch['store_activation_fee']; ?><br>
                                Payment Status : <?php echo $fetch['activation_fee_status']; ?></div>
                            <?php } ?>
                          </li>
                          <li class="timeline-items timeline-icon-danger">
                            <div class="timeline-title">Calling Tasks</div>
                            <?php
                            $sql = "SELECT * FROM taska where tasks_executer_id='$user_id'";
                            $SelectUsersQuery = mysqli_query($con, $sql);
                            $count_tasks = mysqli_num_rows($SelectUsersQuery);
                            $fetch_tasks = mysqli_fetch_assoc($SelectUsersQuery);
                            $task_date = $fetch_tasks['taska_datetime'];
                            if ($count_tasks == 0) {
                              echo "<div class='timeline-subtitle'>No Calling Tasks</div>";
                            } else { ?>
                              <p class="timeline-time"><?php echo date("d M, Y"); ?></p>
                              <div class="timeline-title"><a href='tasks.php'>New Calling Tasks (Tasks Count :
                                  <?php echo $count_tasks; ?>)</a></div>
                              <div class="timeline-subtitle"><a href='tasks.php'>View tasks</a></div>
                            <?php } ?>
                          </li>
                          <li class="timeline-items timeline-icon-warning">
                            <div class="timeline-title">Product Approval</div>
                            <?php
                            $sql = "SELECT * FROM taska where tasks_executer_id='$user_id' and tasks_status=null and tasks_feedback=null and tasks_followupdate=null";
                            $SelectUsersQuery = mysqli_query($con, $sql);
                            $count_tasks = mysqli_num_rows($SelectUsersQuery);
                            $fetch_tasks = mysqli_fetch_assoc($SelectUsersQuery);
                            $task_date = $fetch_tasks['taska_datetime'];
                            if ($count_tasks == 0) {
                              echo "<div class='timeline-subtitle'>No New Product saved by any of your Stores.</div>";
                            } else { ?>
                              <p class="timeline-time"><?php echo date("d M, Y"); ?></p>
                              <div class="timeline-title"><a href='tasks.php'>New Tasks Received (Tasks Count :
                                  <?php echo $count_tasks; ?>)</a></div>
                              <div class="timeline-subtitle"><a href='tasks.php'>View tasks</a></div>
                            <?php } ?>
                          </li>
                          <li class="timeline-items timeline-icon-warning">
                            <div class="timeline-title">Upcoming Subscriptions</div>
                            <?php
                            $sql = "SELECT * FROM taska where tasks_executer_id='$user_id' and tasks_status=null and tasks_feedback=null and tasks_followupdate=null";
                            $SelectUsersQuery = mysqli_query($con, $sql);
                            $count_tasks = mysqli_num_rows($SelectUsersQuery);
                            $fetch_tasks = mysqli_fetch_assoc($SelectUsersQuery);
                            $task_date = $fetch_tasks['taska_datetime'];
                            if ($count_tasks == 0) {
                              echo "<div class='timeline-subtitle'>No Upcoming Subscription</div>";
                            } else { ?>
                              <p class="timeline-time"><?php echo date("d M, Y"); ?></p>
                              <div class="timeline-title"><a href='tasks.php'>New Tasks Received (Tasks Count :
                                  <?php echo $count_tasks; ?>)</a></div>
                              <div class="timeline-subtitle"><a href='tasks.php'>View tasks</a></div>
                            <?php } ?>
                          </li>
                          <li class="timeline-items timeline-icon-info">
                            <div class="timeline-title">FollowUp Dates</div>
                            <?php
                            $sql = "SELECT * FROM taska where tasks_executer_id='$user_id' and tasks_status=null and tasks_feedback=null and tasks_followupdate=null";
                            $SelectUsersQuery = mysqli_query($con, $sql);
                            $count_tasks = mysqli_num_rows($SelectUsersQuery);
                            $fetch_tasks = mysqli_fetch_assoc($SelectUsersQuery);
                            $task_date = $fetch_tasks['taska_datetime'];
                            if ($count_tasks == 0) {
                              echo "<div class='timeline-subtitle'>No Today Follow Ups</div>";
                            } else { ?>
                              <p class="timeline-time"><?php echo date("d M, Y"); ?></p>
                              <div class="timeline-title"><a href='tasks.php'>New Tasks Received (Tasks Count :
                                  <?php echo $count_tasks; ?>)</a></div>
                              <div class="timeline-subtitle"><a href='tasks.php'>View tasks</a></div>
                            <?php } ?>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- active users and my task timeline cards ends here -->



            <!-- END: Content-->

            <?php require 'footer.php'; ?>

            <!-- BEGIN: Vendor JS-->
            <script src="app-assets/vendors/js/vendors.min.js"></script>
            <!-- BEGIN Vendor JS-->

            <!-- BEGIN: Page Vendor JS-->
            <script src="app-assets/vendors/js/charts/apexcharts/apexcharts.min.js"></script>
            <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
            <!-- END: Page Vendor JS-->

            <!-- BEGIN: Theme JS-->
            <script src="app-assets/js/core/app-menu.min.js"></script>
            <script src="app-assets/js/core/app.min.js"></script>
            <script src="app-assets/js/scripts/customizer.min.js"></script>
            <script src="test.php"></script>

            <!-- END: Theme JS-->

            <!-- BEGIN: Page JS-->
            <script src="app-assets/js/scripts/cards/card-statistics.min.js"></script>
            <script src="app-assets/js/scripts/charts/apexcharts/charts-apexcharts.min.js"></script>
            <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
<script type="text/javascript">
  ! function(t, e, a) {
    "use strict";
    var r = ["#179bad", "#0f8e67", "#ffb997", "#00b5b8", "#ff8f9e", "#2c3648"],
      o = !1;
    "rtl" == a("html").data("textdirection") && (o = !0), a(".knob").length && a(".knob").knob({
      rtl: o,
      draw: function() {
        var t = this.$,
          e = t.attr("style");
        e = e.replace("bold", "normal");
        var r = parseInt(t.css("font-size"), 10),
          o = Math.ceil(1.65 * r);
        e = (e = e.replace("bold", "normal")) + "font-size: " + o + "px;";
        var i = t.attr("data-knob-icon");
        if (t.hide(), a('<i class="knob-center-icon ' + i + '"></i>').insertAfter(t).attr("style", e), "tron" == this.$
          .data("skin")) {
          this.cursorExt = .3;
          var s, l = this.arc(this.cv);
          return this.g.lineWidth = this.lineWidth, this.o.displayPrevious && (s = this.arc(this.v), this.g.beginPath(),
              this.g.strokeStyle = this.pColor, this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, s.s, s.e, s.d),
              this.g.stroke()), this.g.beginPath(), this.g.strokeStyle = this.o.fgColor, this.g.arc(this.xy, this.xy, this
              .radius - this.lineWidth, l.s, l.e, l.d), this.g.stroke(), this.g.lineWidth = 2, this.g.beginPath(), this.g
            .strokeStyle = this.o.fgColor, this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + 2 * this
              .lineWidth / 3, 0, 2 * Math.PI, !1), this.g.stroke(), !1
        }
      }
    }), a("#morris-likes").length && Morris.Area({
      element: "morris-likes",
      data: [{
        y: "1",
        a: 14
      }, {
        y: "2",
        a: 12
      }, {
        y: "3",
        a: 4
      }, {
        y: "4",
        a: 9
      }, {
        y: "5",
        a: 3
      }, {
        y: "6",
        a: 6
      }, {
        y: "7",
        a: 11
      }, {
        y: "8",
        a: 10
      }, {
        y: "9",
        a: 13
      }, {
        y: "10",
        a: 9
      }, {
        y: "11",
        a: 14
      }, {
        y: "12",
        a: 11
      }, {
        y: "13",
        a: 16
      }, {
        y: "14",
        a: 20
      }, {
        y: "15",
        a: 15
      }],
      xkey: "y",
      ykeys: ["a"],
      labels: ["Likes"],
      axes: !1,
      grid: !1,
      behaveLikeLine: !0,
      ymax: 20,
      resize: !0,
      pointSize: 0,
      smooth: !0,
      numLines: 6,
      lineWidth: 2,
      fillOpacity: .1,
      lineColors: ["#16D39A"],
      hideHover: !0,
      hoverCallback: function(t, e, a, r) {
        return ""
      }
    }), a("#morris-comments").length && Morris.Area({
      element: "morris-comments",
      data: [{
        y: "1",
        a: 15
      }, {
        y: "2",
        a: 20
      }, {
        y: "3",
        a: 16
      }, {
        y: "4",
        a: 11
      }, {
        y: "5",
        a: 14
      }, {
        y: "6",
        a: 9
      }, {
        y: "7",
        a: 13
      }, {
        y: "8",
        a: 10
      }, {
        y: "9",
        a: 11
      }, {
        y: "10",
        a: 6
      }, {
        y: "11",
        a: 3
      }, {
        y: "12",
        a: 9
      }, {
        y: "13",
        a: 4
      }, {
        y: "14",
        a: 12
      }, {
        y: "15",
        a: 14
      }],
      xkey: "y",
      ykeys: ["a"],
      labels: ["Comments"],
      axes: !1,
      grid: !1,
      behaveLikeLine: !0,
      ymax: 20,
      resize: !0,
      pointSize: 0,
      smooth: !0,
      numLines: 6,
      lineWidth: 2,
      fillOpacity: .1,
      lineColors: ["#FF7D4D"],
      hideHover: !0,
      hoverCallback: function(t, e, a, r) {
        return ""
      }
    }), a("#morris-views").length && Morris.Area({
      element: "morris-views",
      data: [{
        y: "1",
        a: 14
      }, {
        y: "2",
        a: 12
      }, {
        y: "3",
        a: 4
      }, {
        y: "4",
        a: 9
      }, {
        y: "5",
        a: 3
      }, {
        y: "6",
        a: 6
      }, {
        y: "7",
        a: 11
      }, {
        y: "8",
        a: 10
      }, {
        y: "9",
        a: 13
      }, {
        y: "10",
        a: 9
      }, {
        y: "11",
        a: 14
      }, {
        y: "12",
        a: 11
      }, {
        y: "13",
        a: 16
      }, {
        y: "14",
        a: 20
      }, {
        y: "15",
        a: 15
      }],
      xkey: "y",
      ykeys: ["a"],
      labels: ["Views"],
      axes: !1,
      grid: !1,
      behaveLikeLine: !0,
      ymax: 20,
      resize: !0,
      pointSize: 0,
      smooth: !0,
      numLines: 6,
      lineWidth: 2,
      fillOpacity: .1,
      lineColors: ["#FF4558"],
      hideHover: !0,
      hoverCallback: function(t, e, a, r) {
        return ""
      }
    });
    var i, s = function() {
      a("#sp-line-total-cost").length && a("#sp-line-total-cost").sparkline([14, 12, 4, 9, 3, 6, 11, 10, 13, 9, 14, 11, 16,
        20, 15
      ], {
        type: "line",
        width: "100%",
        height: "100px",
        lineColor: "#FFA87D",
        fillColor: "#FFA87D",
        spotColor: "",
        minSpotColor: "",
        maxSpotColor: "",
        highlightSpotColor: "",
        highlightLineColor: "",
        chartRangeMin: 0,
        chartRangeMax: 20
      }), a("#sp-line-total-sales").length && a("#sp-line-total-sales").sparkline([14, 12, 4, 9, 3, 6, 11, 10, 13, 9, 14,
        11, 16, 20, 15
      ], {
        type: "line",
        width: "100%",
        height: "100px",
        lineColor: "#16D39A",
        fillColor: "#16D39A",
        spotColor: "",
        minSpotColor: "",
        maxSpotColor: "",
        highlightSpotColor: "",
        highlightLineColor: "",
        chartRangeMin: 0,
        chartRangeMax: 20
      }), a("#sp-line-total-revenue").length && a("#sp-line-total-revenue").sparkline([14, 12, 4, 9, 3, 6, 11, 10, 13, 9,
        14, 11, 16, 20, 15
      ], {
        type: "line",
        width: "100%",
        height: "100px",
        lineColor: "#FF7588",
        fillColor: "#FF7588",
        spotColor: "",
        minSpotColor: "",
        maxSpotColor: "",
        highlightSpotColor: "",
        highlightLineColor: "",
        chartRangeMin: 0,
        chartRangeMax: 20
      }), a("#sp-bar-total-cost").length && a("#sp-bar-total-cost").sparkline([5, 6, 7, 8, 9, 10, 12, 13, 15, 14, 13, 12,
        10, 9, 8, 10, 12, 14, 15, 16, 17, 14, 12, 11, 10, 8
      ], {
        type: "bar",
        width: "100%",
        height: "30px",
        barWidth: 2,
        barSpacing: 4,
        barColor: "#FFA87D"
      }), a("#sp-bar-total-sales").length && a("#sp-bar-total-sales").sparkline([5, 6, 7, 8, 9, 10, 12, 13, 15, 14, 13,
        12, 10, 9, 8, 10, 12, 14, 15, 16, 17, 14, 12, 11, 10, 8
      ], {
        type: "bar",
        width: "100%",
        height: "30px",
        barWidth: 2,
        barSpacing: 4,
        barColor: "#16D39A"
      }), a("#sp-bar-total-revenue").length && a("#sp-bar-total-revenue").sparkline([5, 6, 7, 8, 9, 10, 12, 13, 15, 14,
        13, 12, 10, 9, 8, 10, 12, 14, 15, 16, 17, 14, 12, 11, 10, 8
      ], {
        type: "bar",
        width: "100%",
        height: "30px",
        barWidth: 2,
        barSpacing: 4,
        barColor: "#FF7588"
      }), a("#sp-stacked-bar-total-cost").length && a("#sp-stacked-bar-total-cost").sparkline([
        [8, 10],
        [12, 8],
        [9, 14],
        [8, 11],
        [10, 13],
        [7, 11],
        [8, 14],
        [9, 12],
        [10, 11],
        [12, 14],
        [8, 12],
        [9, 12],
        [9, 14]
      ], {
        type: "bar",
        width: "100%",
        height: "30px",
        barWidth: 4,
        barSpacing: 6,
        stackedBarColor: ["#4CAF50", "#FFEB3B"]
      }), a("#sp-stacked-bar-total-cost").length && a("#sp-stacked-bar-total-sales").sparkline([
        [8, 10],
        [12, 8],
        [9, 14],
        [8, 11],
        [10, 13],
        [7, 11],
        [8, 14],
        [9, 12],
        [10, 11],
        [12, 14],
        [8, 12],
        [9, 12],
        [9, 14]
      ], {
        type: "bar",
        width: "100%",
        height: "30px",
        barWidth: 4,
        barSpacing: 6,
        stackedBarColor: ["#FF5722", "#009688"]
      }), a("#sp-stacked-bar-total-revenue").length && a("#sp-stacked-bar-total-revenue").sparkline([
        [8, 10],
        [12, 8],
        [9, 14],
        [8, 11],
        [10, 13],
        [7, 11],
        [8, 14],
        [9, 12],
        [10, 11],
        [12, 14],
        [8, 12],
        [9, 12],
        [9, 14]
      ], {
        type: "bar",
        width: "100%",
        height: "30px",
        barWidth: 4,
        barSpacing: 6,
        stackedBarColor: ["#E91E63", "#00BCD4"]
      }), a("#sp-tristate-bar-total-cost").length && a("#sp-tristate-bar-total-cost").sparkline([1, 1, 0, 1, -1, -1, 1, -
        1, 0, 0, 1, 1, 0, -1, 1, -1
      ], {
        type: "tristate",
        height: "30",
        posBarColor: "#ffeb3b",
        negBarColor: "#4caf50",
        barWidth: 4,
        barSpacing: 5,
        zeroAxis: !1
      }), a("#sp-tristate-bar-total-sales").length && a("#sp-tristate-bar-total-sales").sparkline([1, 1, 0, 1, -1, -1, 1,
        -1, 0, 0, 1, 1, 0, -1, 1, -1
      ], {
        type: "tristate",
        height: "30",
        posBarColor: "#009688",
        negBarColor: "#FF5722",
        barWidth: 4,
        barSpacing: 5,
        zeroAxis: !1
      }), a("#sp-tristate-bar-total-revenue").length && a("#sp-tristate-bar-total-revenue").sparkline([1, 1, 0, 1, -1, -1,
        1, -1, 0, 0, 1, 1, 0, -1, 1, -1
      ], {
        type: "tristate",
        height: "30",
        posBarColor: "#00BCD4",
        negBarColor: "#E91E63",
        barWidth: 4,
        barSpacing: 5,
        zeroAxis: !1
      }), a("#sp-line-total-profit").length && a("#sp-line-total-profit").sparkline([14, 12, 4, 9, 3, 6, 11, 10, 13, 9,
        14, 11, 16, 20, 15
      ], {
        type: "line",
        width: "100%",
        height: "50px",
        lineColor: "#E91E63",
        fillColor: "",
        spotColor: "",
        minSpotColor: "",
        maxSpotColor: "",
        highlightSpotColor: "",
        highlightLineColor: "",
        chartRangeMin: 0,
        chartRangeMax: 20
      })
    };
    a(t).resize((function(t) {
      clearTimeout(i), i = setTimeout(s, 500)
    })), s();
    var l = {
      chart: {
        height: 370,
        type: "area",
        toolbar: {
          show: !1
        },
        dropShadow: {
          enabled: !0,
          top: 18,
          left: 0,
          blur: 2,
          color: "#00b5b8",
          opacity: .1
        }
      },
      fill: {
        colors: "#00b5b8",
        type: "gradient",
        gradient: {
          shadeIntensity: 1,
          opacityFrom: .2,
          opacityTo: .6,
          stops: [0, 90, 100]
        }
      },
      legend: {
        show: !1
      },
      dataLabels: {
        enabled: !1
      },
      stroke: {
        curve: "smooth",
        colors: r
      },
      series: [{
        name: "",
        data: [5, 10, 15, 5, 30, 3]
      }],
      xaxis: {
        type: "category",
        categories: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed"],
        axisBorder: {
          show: !1
        },
        axisTicks: {
          show: !1
        },
        labels: {
          show: !0,
          style: {
            fontSize: "14",
            fontFamily: "Helvetica, Arial, sans-serif",
            cssClass: "apexcharts-xaxis-title",
          }
        }
      },
      yaxis: {
        tickAmount: 10,
        min: 0,
        max: 100
      },
      tooltip: {
        x: {
          show: !1
        },
        y: {
          formatter: function(t) {
            return t + " Calls"
          }
        },
        marker: {
          show: !1
        }
      },
      theme: {
        mode: "light"
      },
      markers: {
        colors: "#00b5b8"
      }
    };

    new ApexCharts(e.querySelector("#spline-chart"), l).render();
    var n = {
      chart: {
        height: 310,
        type: "bar",
        toolbar: {
          show: !1
        }
      },
      legend: {
        show: !1
      },
      grid: {
        show: !1
      },
      colors: ["#00b5b8", "#00b5b8", "#ff8f9e", "#00b5b8", "#ffb997"],
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "22%",
          endingShape: "flat",
          colors: {
            backgroundBarColors: "#444",
            backgroundBarOpacity: .1
          },
          distributed: !0
        }
      },
      dataLabels: {
        enabled: !1
      },
      series: [{
        name: "Rs",
        data: [5000, 7500, 12500, 7500, 5000, 0]
      }],
      xaxis: {
        type: "category",
        categories: ["Jan", "Feb", "March", "Apr", "May", "Jun"],
        axisBorder: {
          show: !1
        },
        axisTicks: {
          show: !1
        },
        labels: {
          style: {
            cssClass: "apexcharts-xaxis-title"
          }
        },
      },
      yaxis: {
        show: !1,
        labels: {
          show: !0,
          style: {
            fontSize: "10",
            cssClass: "apexcharts-xaxis-title"
          },
          offsetY: 10
        }
      },
      fill: {
        opacity: 1
      },
      tooltip: {
        marker: {
          show: !1
        },
        x: {
          show: !1
        },
        y: {
          formatter: function(t) {
            return t + " Sales"
          }
        }
      }
    };


    new ApexCharts(e.querySelector(".tab-content #product_sales_column_basic_chart"), n).render();
    var h = {
      chart: {
        width: 240,
        height: 258,
        type: "donut"
      },
      plotOptions: {
        pie: {
          size: "92",
          offsetY: 30,
          donut: {
            size: "93%",
            labels: {
              show: !0,
              name: {
                offsetY: 23,
                color: "#98a4b8",
                fontSize: "20px"
              },
              value: {
                fontSize: "35px",
                offsetY: -22,
                color: "#404e67",
                formatter: function(t) {
                  return t + "%"
                }
              },
              total: {
                show: !0,
                label: "Total",
                color: "#98a4b8",
                formatter: function(t) {
                  return "Rs."
                }
              }
            }
          }
        }
      },
      dataLabels: {
        enabled: !1
      },
      series: [90, 10],
      labels: ["Activation Fee", "Subscription Paid"],
      responsive: [{
        breakpoint: 480,
        options: {
          chart: {
            width: 200
          },
          legend: {
            show: !1
          }
        }
      }, {
        breakpoint: 1425,
        options: {
          chart: {
            width: 250
          },
          legend: {
            show: !1
          }
        }
      }],
      legend: {
        show: !1
      },
      colors: ["#00b5b8", "#ff8f9e", "#ffb997"]
    };

    new ApexCharts(e.querySelector("#sales_in_region_pie_donut"), h).render();
    var p = {
      chart: {
        height: 145,
        width: 170,
        type: "radialBar",
        offsetY: 30,
        toolbar: {
          show: !1
        }
      },
      plotOptions: {
        radialBar: {
          hollow: {
            margin: 0,
            size: "80%"
          },
          track: {
            background: "#eee",
            strokeWidth: "80%",
            margin: 0
          },
          dataLabels: {
            showOn: "always",
            name: {
              show: !1
            },
            value: {
              formatter: function(t) {
                return parseInt(t) + "%"
              },
              offsetY: 8,
              color: "#179bad",
              fontSize: "20px",
              show: !0
            }
          }
        }
      },
      responsive: [{
        breakpoint: 768,
        options: {
          chart: {
            width: 170,
            offsetX: -15
          },
          legend: {
            show: !1
          }
        }
      }],
      fill: {
        colors: ["#00b5b8"]
      },
      series: [25],
      stroke: {
        lineCap: "flat"
      },
      labels: ["Calls"]
    };
    new ApexCharts(e.querySelector("#general_task_radial_bar_chart"), p).render();
    var c = {
      chart: {
        height: 120,
        width: 180,
        type: "bar",
        toolbar: {
          show: !1
        }
      },
      states: {
        hover: {
          filter: {
            type: "darken",
            value: .9
          }
        }
      },
      legend: {
        show: !1
      },
      grid: {
        show: !1
      },
      colors: ["#eee", "#eee", "#eee", "#eee", "#eee", "#00b5b8"],
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "50%",
          endingShape: "rounded",
          distributed: !0
        }
      },
      dataLabels: {
        enabled: !1
      },
      series: [{
        name: "",
        data: [67, 19, 45, 23, 56, 32]
      }],
      xaxis: {
        type: "category",
        categories: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed"],
        axisBorder: {
          show: !1
        },
        axisTicks: {
          show: !1
        },
        labels: {
          show: !0,
          style: {
            fontSize: "9",
            fontFamily: "Helvetica, Arial, sans-serif",
            cssClass: "apexcharts-xaxis-title"
          }
        }
      },
      yaxis: {
        show: !1,
        labels: {
          show: !0,
          style: {
            fontSize: "10",
            fontFamily: "Helvetica, Arial, sans-serif",
            cssClass: "apexcharts-xaxis-title"
          },
          offsetY: 10
        }
      },
      fill: {
        opacity: 1
      },
      tooltip: {
        marker: {
          show: !1
        },
        x: {
          show: !1
        },
        y: {
          formatter: function(t) {
            return t + " Calls"
          }
        }
      }
    };
    new ApexCharts(e.querySelector("#info_tracking_total_stats"), c).render(), a(".latest-update-tracking").length > 0 &&
      new PerfectScrollbar(".latest-update-tracking-list", {
        wheelPropagation: !1
      })
  }(window, document, jQuery);
</script>