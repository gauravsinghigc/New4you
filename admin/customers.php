<?php
require 'files.php';
require 'session.php';
$title_name = "Customers";
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="<?php echo $PosName; ?>">
  <title><?php echo $title_name; ?> : <?php echo $PosName; ?></title>
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
        <section class="users-list-wrapper">
          <div class="users-list-table">
            <div class="card">
              <div class="card-header">
                <h4 class="users-action"><i class="fa fa-users text-info"></i> <?php echo $title_name; ?> <i class="fa fa-angle-right"></i>
                  <?php
                  if (isset($_GET['type'])) {
                    echo $_GET['type'] . " Customers";
                  } else {
                    echo "All Customers";
                  } ?>
                  <a href="add_customer.php"><i class="fa fa-plus"></i> ADD Customers</a>
                  <a href="export_customers.php"><i class="fa fa-file-pdf-o"></i> Export Customers</a>
                </h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <!-- datatable start -->
                  <div class="table-responsive">
                    <table class="table table-striped table-hover zero-configuration">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Full Name</th>
                          <th>Email id</th>
                          <th>Phone Number</th>
                          <th>Area Locality</th>
                          <th>Reg. Type</th>
                          <th>Orders</th>
                          <th>Cart Items</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (isset($_GET['type'])) {
                          $CStatus = $_GET['type'];
                          $SelectUsers = "SELECT * FROM customers where customer_status='$CStatus'";
                        } else {
                          $SelectUsers = "SELECT * FROM customers";
                        }
                        $SelectUsersQuery = mysqli_query($con, $SelectUsers);
                        $num = 0;
                        while ($SelectUsersFetch =  mysqli_fetch_assoc($SelectUsersQuery)) {
                          $customer_id = $SelectUsersFetch['customer_id'];
                          $customer_name = $SelectUsersFetch['customer_name'];
                          $customer_mail_id = $SelectUsersFetch['customer_mail_id'];
                          $arealocality = $SelectUsersFetch['arealocality'];
                          if ($customer_mail_id == null) {
                            $customer_mail_id = "Not Available";
                          } else {
                            $customer_mail_id = "<a href='mailto:$customer_mail_id'><i class='fa fa-envelope'></i> $customer_mail_id</a>";
                          }
                          $customer_phone_number = $SelectUsersFetch['customer_phone_number'];
                          $CustomerStatus = $SelectUsersFetch['customer_status'];
                          if ($CustomerStatus == "verified") {
                            $CustomerStatus = "<i class='fa fa-check-circle text-success'></i> Verified";
                            $custview = "<i class='fa fa-check-circle text-success'></i>";
                          } else {
                            $CustomerStatus = "<i class='fa fa-warning text-danger'></i> Unverified";
                            $custview = "<i class='fa fa-warning text-danger'></i>";
                          }
                          $num++; ?>
                          <tr>
                            <td><?php echo $num; ?></td>
                            <td><a href='cust_details.php?customer_id=<?php echo $customer_id; ?>'><?php echo $custview; ?>
                                <?php echo $customer_name; ?></a></td>
                            <td><?php echo $customer_mail_id; ?></td>
                            <td><a href="tel:<?php echo $customer_phone_number; ?>"><i class="fa fa-phone"></i>
                                <?php echo $customer_phone_number; ?></a></td>
                            <td><?php echo $arealocality; ?></td>
                            <td>
                              <i class="fa fa-share text-success"></i> <?php $SQL_referred_person = "SELECT * from referred_person where referred_phone='$customer_phone_number'";
                                                                        $QUERY_referred_person = mysqli_query($con, $SQL_referred_person);
                                                                        $FETCH_referred_person = mysqli_fetch_array($QUERY_referred_person);
                                                                        $CounRefers = mysqli_num_rows($QUERY_referred_person);
                                                                        if ($CounRefers == 0) {
                                                                          echo "Self Registration";
                                                                        } else {
                                                                          $referred_customer_id = $FETCH_referred_person['customer_id'];
                                                                          $SQL_customers = "SELECT * FROM customers where customer_id='$referred_customer_id'";
                                                                          $QUERY_customers = mysqli_query($con, $SQL_customers);
                                                                          $FETCH_REF_customers = mysqli_fetch_assoc($QUERY_customers);
                                                                          $ReferredCustomername = $FETCH_REF_customers['customer_name'];
                                                                          $ReferredCustomerId = $FETCH_REF_customers['customer_id'];
                                                                          echo "Referred By <i class='fa fa-angle-double-right'></i> <a href='cust_details.php?customer_id=$ReferredCustomerId'><i class='fa fa-user text-primary'> $ReferredCustomername</i></a>";
                                                                        }
                                                                        ?>
                            </td>
                            <td><?php
                                $SQL_REF_Orders = "SELECT * from customer_orders where customer_id='$customer_id'";
                                $QUERY_REF_Orders = mysqli_query($con, $SQL_REF_Orders);
                                $CountRefOrders = mysqli_num_rows($QUERY_REF_Orders);
                                if ($CountRefOrders == 0) {
                                  echo "0 Orders";
                                } else {
                                  echo $CountRefOrders . " Orders";
                                } ?>
                            </td>
                            <td><?php
                                $SQL_REF_customer_cart = "SELECT * FROM customer_cart where customer_id='$customer_id'";
                                $QUERY_REF_customer_cart = mysqli_query($con, $SQL_REF_customer_cart);
                                $CountRefCartItems = mysqli_num_rows($QUERY_REF_customer_cart);
                                if ($CountRefCartItems == 0) {
                                  echo "0 Items";
                                } else {
                                  echo "$CountRefCartItems Items";
                                } ?></td>
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

</body>
<!-- END: Body-->

</html>