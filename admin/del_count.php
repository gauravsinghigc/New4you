<!-- Grouped multiple cards for statistics starts here -->
<div class="row grouped-multiple-statistics-card">
 <div class="col-12">
  <div class="card">
   <div class="card-body">
    <div class="row">
     <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
      <a href='deliveries.php' class="text-black">
       <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
        <span class="card-icon success d-flex justify-content-center mr-3">
         <i class="icon p-1 fa fa-truck customize-icon font-large-2 p-1"></i>
        </span>
        <div class="stats-amount mr-3">
         <h3 class="heading-text text-bold-600">
          <?php
                                        $user_id = $_SESSION['user_id'];
                                        $sql = "SELECT * FROM users where user_id='$user_id'";
                                        $query = mysqli_query($con, $sql);
                                        $fetch = mysqli_fetch_assoc($query);
                                        $ref_id = $fetch['ref'];

                                        $sql = "SELECT * FROM stores where user_id ='$ref_id'";
                                        $query = mysqli_query($con, $sql);
                                        $fetch = mysqli_fetch_assoc($query);
                                        $store_id = $fetch['store_id'];
                                        $v_day = date("d");
                                        $v_month = date("m");
                                        $v_year = date("Y");
                                        $filter_view = "$v_day $v_month $v_year";
                                        $daily_plan = "DAILY_PLAN";
                                        $current_dates = date("Y-m-d", strtotime($filter_view));
                                        $view_day = strtoupper(date("D", strtotime($filter_view)));


                                        $sql = "SELECT * FROM customer_subscriptions_days where store_id='$store_id' and SUBSCRIPTION_DAYS='$view_day' and SUBS_START_DATE<>'$current_dates' or SUBSCRIPTION_DAYS='DAILY_PLAN' ";

                                        $query = mysqli_query($con, $sql);
                                        $count = mysqli_num_rows($query);
                                        if ($count == 0) {
                                            echo "0";
                                        } else {
                                            echo "$count";
                                        }
                                        ?>
         </h3>
         <p class="font-small-3">Today Delivery</p>
        </div>
       </div>
      </a>
      <hr>
     </div>

     <div class="col-lg-6 col-xl-3 col-sm-6 col-12">

      <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
       <span class="card-icon success d-flex justify-content-center mr-3">
        <i class="icon p-1 fa fa-inr customize-icon font-large-2 p-1"></i>
       </span>
       <div class="stats-amount mr-3">
        <h3 class="heading-text text-bold-600">
         <?php
                                    $select = "SELECT sum(payment_amount) FROM customer_subscription_billings where store_id='$store_id' and payment_mode='CASH_PAYMENT'";
                                    $action = mysqli_query($con, $select);
                                    while ($record = mysqli_fetch_array($action)) {
                                        $total_amount = $record['sum(payment_amount)'];
                                    }
                                    echo "Rs.$total_amount"; ?>
        </h3>
        <p class="font-small-3">Cash Payments</p>
       </div>
      </div>

      <hr>
     </div>

     <div class="col-lg-6 col-xl-3 col-sm-6 col-12">

      <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
       <span class="card-icon success d-flex justify-content-center mr-3">
        <i class="icon p-1 fa fa-inr customize-icon font-large-2 p-1"></i>
       </span>
       <div class="stats-amount mr-3">
        <h3 class="heading-text text-bold-600">
         <?php
                                    $select = "SELECT sum(payment_amount) FROM customer_subscription_billings where store_id='$store_id' and payment_mode='WALLET'";
                                    $action = mysqli_query($con, $select);
                                    while ($record = mysqli_fetch_array($action)) {
                                        $total_amount = $record['sum(payment_amount)'];
                                    }
                                    echo "Rs.$total_amount"; ?>
        </h3>
        <p class="font-small-3">Wallet Payments</p>
       </div>
      </div>

      <hr>
     </div>

     <div class="col-lg-6 col-xl-3 col-sm-6 col-12">

      <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
       <span class="card-icon success d-flex justify-content-center mr-3">
        <i class="icon p-1 fa fa-truck customize-icon font-large-2 p-1"></i>
       </span>
       <div class="stats-amount mr-3">
        <h3 class="heading-text text-bold-600">
         <?php
                                    $sql = "SELECT * FROM subscription_deliveries where store_id='$store_id'";
                                    $query = mysqli_query($con, $sql);
                                    $count_1 = mysqli_num_rows($query);
                                    if ($count_1 == 0) {
                                        echo "$count_1";
                                    } else {
                                        echo "$count_1";
                                    } ?>
        </h3>
        <p class="font-small-3">Subscription Orders!</p>
       </div>
      </div>

      <hr>
     </div>

     <div class="col-lg-6 col-xl-3 col-sm-6 col-12">

      <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
       <span class="card-icon success d-flex justify-content-center mr-3">
        <i class="icon p-1 fa fa-truck customize-icon font-large-2 p-1"></i>
       </span>
       <div class="stats-amount mr-3">
        <h3 class="heading-text text-bold-600">
         0
        </h3>
        <p class="font-small-3">Normal Orders!</p>
       </div>
      </div>

      <hr>
     </div>



     <div class="col-lg-6 col-xl-3 col-sm-6 col-12">

      <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
       <span class="card-icon success d-flex justify-content-center mr-3">
        <i class="icon p-1 fa fa-truck customize-icon font-large-2 p-1"></i>
       </span>
       <div class="stats-amount mr-3">
        <h3 class="heading-text text-bold-600">
         0
        </h3>
        <p class="font-small-3">Un Delivered!</p>
       </div>
      </div>

      <hr>
     </div>

    </div>
   </div>
  </div>
 </div>
</div>
<!-- Grouped multiple cards for statistics ends here -->