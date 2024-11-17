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
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Subscription Items : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click"
 data-menu="vertical-menu-modern" data-col="2-columns">

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
    <!-- users list start -->
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action">Subscription Items <i class="fa fa-angle-right"></i>
         <span class="text-right">
          <a href='export.php?subscription_list_today=true' target='_blank' class='btn btn-info btn-sm'><i
            class='fa fa-file-pdf-o'></i>
           Export Items
          </a>
         </span>
        </h4>
        <form action="" method="GET">
         <div class="row">
          <div class="col-lg-12">
           <p>
            <?php if (isset($_GET['day'])) {
                                                    $f_day = $_GET['day'];
                                                    $f_month = $_GET['month'];
                                                    $f_year = $_GET['year'];

                                                    if ($f_day == null) {
                                                        $f_day = 0;
                                                    } else {
                                                        $f_day = $f_day;
                                                    }
                                                    echo "Filtered View : <i class='fa fa-angle-right'></i>
                                                Date :  $f_day -
                                                Month : $f_month -
                                                Year : $f_year -
                                                 <a href='delivered.php'>Clear Filter</a>";
                                                } else {
                                                    echo "No Filter Applied!";
                                                } ?></p>
          </div>
          <div class="col-lg-3 col-md-12 col-3">
           <select class="form-control" name='day'>
            <option value="">Select View Date</option>
            <?php
                                                $count = 1;
                                                while ($count <= 31) {
                                                    echo "<option value='$count'>$count</option>";
                                                    $count++;
                                                }
                                                ?>
           </select>
          </div>

          <div class="col-lg-3 col-md-12 col-3">
           <select class="form-control" name='month'>
            <option value="">Select View Month</option>
            <?php
                                                $count = 1;
                                                while ($count <= 12) {
                                                    echo "<option value='$count'>$count</option>";
                                                    $count++;
                                                }
                                                ?>
           </select>
          </div>

          <div class="col-lg-3 col-md-12 col-3">
           <select class="form-control" name='year'>
            <option value="">Select View Year</option>
            <?php
                                                $count = 2020;
                                                while ($count <= 2025) {
                                                    echo "<option value='$count'>$count</option>";
                                                    $count++;
                                                }
                                                ?>
           </select>
          </div>

          <div class="col-lg-3 col-md-12 col-3">
           <button class="btn btn-md btn-primary" type="Submit">Apply Filter</button>
          </div>
         </div>

        </form>
        <div class="row">
         <div class='col-lg-12 col-12 col-md-6'>
          <hr>
          <p>
           <span><b>Subscription Items for Date :</b>
            <?php

                                                if (isset($_GET['day'])) {
                                                    echo $_GET['day'];
                                                    echo date(" M, Y ");
                                                    $month = date("M");
                                                    $year = date("Y");
                                                } else {
                                                    echo date("d M, Y");
                                                }
                                                ?>
           </span><br>
           <a href='view_items.php' class='btn btn-success btn-sm'><i class='fa fa-calendar'></i>
            Today
           </a>
           <a
            href='?day=<?php echo date("d", strtotime("+1 Days")); ?>&month=<?php echo date("m"); ?>&year=<?php echo date("Y"); ?>'
            class='btn btn-primary btn-sm'><i class='fa fa-calendar'></i>
            Tommorrow
           </a>
          </p>
         </div>


        </div>
       </div>

       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table">
           <thead>
            <tr>
             <th style="padding: 1%; font-size: 12px;">IMG</th>
             <th style="padding: 1%; font-size: 12px;">Item Name</th>
             <th style="padding: 1%; font-size: 12px;">Item Price</th>
             <th class="text-center" style="padding: 1%; font-size: 12px;">
              Quantity
             </th>
             <th style="padding: 1%; font-size: 12px;">Total Price</th>
            </tr>
           </thead>

           <tbody>
            <?php
                                                $user_role = $_SESSION['user_role'];
                                                if ($user_role == "SUPER_ADMIN") {
                                                } elseif ($user_role == "STORE_USER") {

                                                    if (isset($_GET['day'])) {

                                                        $v_day = $_GET['day'];
                                                        $v_month = $_GET['month'];
                                                        $v_year = $_GET['year'];
                                                        $filter_view = "$v_day $v_month $v_year";
                                                        $daily_plan = "DAILY_PLAN";
                                                        $current_dates = date("Y-m-d", strtotime($filter_view));
                                                        $view_day = strtoupper(date("D", strtotime($filter_view)));
                                                    } else {

                                                        $v_day = date("d");
                                                        $v_month = date("m");
                                                        $v_year = date("Y");
                                                        $filter_view = "$v_day $v_month $v_year";
                                                        $daily_plan = "DAILY_PLAN";
                                                        $current_dates = date("Y-m-d", strtotime($filter_view));
                                                        $view_day = strtoupper(date("D", strtotime($filter_view)));
                                                    }

                                                    $user_id = $_SESSION['user_id'];
                                                    $sql = "SELECT * FROM stores where user_id='$user_id'";
                                                    $query =  mysqli_query($con, $sql);
                                                    $fetch = mysqli_fetch_assoc($query);
                                                    $store_id = $fetch['store_id'];

                                                    $sql = "SELECT * FROM customer_subscriptions_days where store_id='$store_id' and SUBSCRIPTION_DAYS='$view_day' and SUBS_START_DATE<>'$current_dates' or SUBSCRIPTION_DAYS='DAILY_PLAN' ";
                                                }
                                                $query = mysqli_query($con, $sql);
                                                $count_subs = mysqli_num_rows($query);
                                                if ($count_subs == 0) {
                                                    echo "<tr align='center'>
           <td colspan='3'><h5>No Subscription Found!</h5></td>
        </tr>";
                                                } else {
                                                    while ($fetch = mysqli_fetch_assoc($query)) {

                                                        $sql = "SELECT * from customer_subscriptions where store_id='$store_id' and SUBSCRIPTION_STATUS='ACTIVE'";
                                                        $query = mysqli_query($con, $sql);
                                                        while ($fetch = mysqli_fetch_assoc($query)) {
                                                            $SUBS_ID[] = $fetch['customer_subscription_id'];
                                                        }
                                                    }

                                                    foreach ($SUBS_ID as $SUB_ID) {



                                                        $sql = "SELECT * FROM subscription_products where customer_subscription_id='$SUB_ID' and store_id='$store_id'";
                                                        $query = mysqli_query($con, $sql);
                                                        while ($fetch = mysqli_fetch_assoc($query)) {
                                                            $product_name = $fetch['product_name'];
                                                            $brand_title = $fetch['brand_title'];
                                                            $product_img = $fetch['product_img'];
                                                            $product_quantity = $fetch['product_quantity'];
                                                            $product_offer_price = $fetch['product_offer_price'];
                                                            $product_total_price = $fetch['product_total_price'];

                                                            echo "<tr>
                <td><img src='$Domain/img/store_img/$product_img' style='width:30px;'></td>
                <td>$product_name</td>
                <td>Rs.$product_offer_price</td>
                <td> x $product_quantity</td>
                <td>Rs.$product_total_price</td>
           </tr>";
                                                        }
                                                    }
                                                }


                                                ?>
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