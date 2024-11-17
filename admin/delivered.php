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
 <title>Orders : <?php echo $PosName; ?></title>
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
        <h4 class="users-action">Delivered Orders <i class="fa fa-angle-right"></i>
        </h4>

        <form action="" method="GET">
         <div class="row">
          <div class="col-lg-12">
           <p><?php if (isset($_GET['f_day'])) {
                                                    $f_day = $_GET['f_day'];
                                                    $f_month = $_GET['f_month'];
                                                    $f_year = $_GET['f_year'];

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
           <select class="form-control" name='f_day'>
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
           <select class="form-control" name='f_month'>
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
           <select class="form-control" name='f_year'>
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
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
         <ul class="list-inline mb-0">
          <li><a href='export.php?subscription_list_today=true' target='_blank' class='btn btn-info btn-sm'><i
             class='fa fa-file-pdf-o'></i>
            Export</a> </li>
          <li></li>
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
             <th style="padding: 1%; font-size: 12px;">ID</th>
             <th style="padding: 1%; font-size: 12px;">Customer Name</th>
             <th class="text-center" style="padding: 1%; font-size: 12px;">
              Items/Amount</th>
             <th class="hidden-xs text-center" style="padding: 1%; font-size: 12px;">Payment Type</th>
             <th style="padding: 1%; font-size: 12px;">Action</th>
            </tr>
           </thead>

           <tbody>
            <?php
                                                $user_role = $_SESSION['user_role'];

                                                if ($user_role == "SUPER_ADMIN") {
                                                    $sql = "SELECT * FROM customer_subscriptions";
                                                    $query = mysqli_query($con, $sql);
                                                } elseif ($user_role == "STORE_USER") {
                                                    $user_id = $_SESSION['user_id'];
                                                    $sql = "SELECT * from stores where user_id='$user_id'";
                                                    $query = mysqli_query($con, $sql);
                                                    $fetch = mysqli_fetch_assoc($query);
                                                    $store_id = $fetch['store_id'];
                                                    $store_phone = $fetch['store_phone'];
                                                    $store_mail_id = $fetch['store_mail_id'];
                                                    $store_name = $fetch['store_name'];

                                                    if (isset($_GET['day'])) {
                                                        $view_day = $_GET['day'];
                                                        if ($view_day <= 9) {
                                                            $view_days = "0$view_day";
                                                        } else {
                                                            $view_days = $view_day;
                                                        }
                                                        $view_day = $_GET['day'];
                                                        $view_month = $_GET['month'];
                                                        $view_year = $_GET['year'];
                                                        $monthName = strtoupper(date('M', mkttime(0, 0, 0, $view_month, 10)));
                                                        $filter_view = "$view_days-$monthName-$view_year";
                                                        $daily_plan = "DAILY_PLAN";
                                                    } else {
                                                        $view_day = date("d");
                                                        $view_month = strtoupper(date("M"));
                                                        $view_year = date("Y");
                                                        $filter_view = "$view_day-$view_month-$view_year";
                                                        $daily_plan = "DAILY_PLAN";
                                                    }
                                                    $count_day = strtoupper(date("D", strtotime($filter_view)));
                                                    $sql = "SELECT * from customer_subscriptions where store_id='$store_id'";
                                                    $query = mysqli_query($con, $sql);
                                                }
                                                $count = mysqli_num_rows($query);
                                                if ($count == 0) {
                                                    echo "<tr align='center'>
              <td colspan='8'><h3><i class='fa fa-warning'></i><br></h3><h3>No Subscriptions!</h3>
             </tr>";
                                                } else {
                                                    while ($fetch = mysqli_fetch_assoc($query)) {

                                                        $subsid = $fetch['customer_subscription_id'];

                                                        $sql = "SELECT * FROM customer_subscriptions_days where SUBSCRIPTION_DAYS='$count_day' and customer_subscription_id='$subsid'";
                                                        $query = mysqli_query($con, $sql);
                                                        $count_subs = mysqli_num_rows($query);
                                                        if ($count == 0) {
                                                        } else {
                                                            while ($fetch = mysqli_fetch_assoc($query)) {


                                                                $sql = "SELECT * from customer_subscriptions where customer_subscription_id='$subsid' and SUBSCRIPTION_STATUS='ACTIVE'";
                                                                $query = mysqli_query($con, $sql);
                                                                $fetch = mysqli_fetch_assoc($query);
                                                                $customer_id = $fetch['customer_id'];
                                                                $SUBSCRIBE_PLAN_TYPE = $fetch['SUBSCRIBE_PLAN_TYPE'];
                                                                $sql = "SELECT * FROM customers where customer_id='$customer_id'";
                                                                $query = mysqli_query($con, $sql);
                                                                $fetch = mysqli_fetch_assoc($query);
                                                                $customer_name = $fetch['customer_name'];

                                                ?>
            <tr>
             <td style="padding: 1%; font-size: 12px;">
              <h4><a href="subscription_orders.php?id=<?php echo $subsid; ?>" class='text-info'
                style="padding: 1%; font-size: 12px;"><?php echo $subsid; ?></a>
              </h4>
             </td>
             <td style="padding: 1%; font-size: 12px;">
              <?php echo $customer_name; ?></td>
             <td style="padding: 1%; font-size: 12px;" class='text-center'>
              <?php
                                                                        $sql = "SELECT * FROM subscription_products where customer_subscription_id='$subsid'";
                                                                        $query = mysqli_query($con, $sql);
                                                                        $count_items = mysqli_num_rows($query);
                                                                        echo $count_items . " Items / Rs.";
                                                                        $select = "SELECT sum(product_total_price) FROM subscription_products where customer_subscription_id='$subsid'";
                                                                        $action = mysqli_query($con, $select);
                                                                        while ($record = mysqli_fetch_assoc($action)) {
                                                                            echo $total_amount = $record['sum(product_total_price)'];
                                                                        }


                                                                        ?>
             </td>
             <td style="padding: 1%; font-size: 12px;" class="text-center">
              <?php
                                                                        $sql = "SELECT * FROM customer_subscription_payments  WHERE customer_subscription_id='$subsid'";
                                                                        $query = mysqli_query($con, $sql);
                                                                        $fetch = mysqli_fetch_assoc($query);
                                                                        $payment_cycle = $fetch['payment_cycle'];
                                                                        $payment_mode = $fetch['payment_mode'];
                                                                        echo "$payment_cycle / $payment_mode";
                                                                        ?>
             </td>
             <td style="padding: 1%; font-size: 12px;">
              Not Applicable
             </td>
            </tr>
            <?php }
                                                        }
                                                    }
                                                } ?>
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