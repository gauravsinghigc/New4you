<?php
require 'files.php';
require 'session.php';
$title_name = "Reward Points";

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
    <section class="users-listwrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action"><i class="fa fa-table text-primary"></i> <?php echo $title_name; ?> <i
          class="fa fa-angle-right"></i>
         <!--<a href="notifications_logs.php"><i class="fa fa-eye"></i> View Notifications</a>-->
        </h4>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table table-striped zero-configuration" style="font-size: 12px !important;">
           <thead>
            <tr>
             <th style="width: 5% !important;">#</th>
             <th style="width: 13% !important;">Customer Name</th>
             <th style="width: 14% !important;">OrderId</th>
             <th style="width: 5% !important;">Points</th>
             <th style="width: 15% !important;">DateTime</th>
             <th style="width: 7% !important;">Status</th>
             <th style="width: 19% !important;">Is Reffered?</th>
             <th style="width: 10% !important">Action</th>
            </tr>
           </thead>
           <tbody>
            <?php
                                                $customer_rewards = "SELECT * FROM customer_rewards";
                                                $customer_rewards_query = mysqli_query($con, $customer_rewards);
                                                $count = 0;
                                                while ($Fetch_customer_rewards = mysqli_fetch_assoc($customer_rewards_query)) {
                                                    $count++; ?>
            <tr>
             <td><?php echo $count; ?></td>
             <td>
              <a href="cust_details.php?customer_id=<?php echo $Fetch_customer_rewards['customer_id']; ?>"><i
                class='fa fa-user'></i>
               <?php $customer_id = $Fetch_customer_rewards['customer_id'];
                                                                $sql = "SELECT * from customers where customer_id='$customer_id'";
                                                                $query = mysqli_query($con, $sql);
                                                                $fetchcustomer = mysqli_fetch_assoc($query);
                                                                echo $fetchcustomer['customer_name']; ?>
              </a>
             </td>
             <td><a href="<?php echo $MDomain; ?>/invoice.php?id=<?php echo $Fetch_customer_rewards['order_id']; ?>"
               class='text-info' style="padding: 1%; font-size: 12px;"
               target="blank">#<?php echo $Fetch_customer_rewards['order_id']; ?></a></td>
             <td><?php echo $Fetch_customer_rewards['rewards_point']; ?></td>
             <td><?php echo $Fetch_customer_rewards['reward_date']; ?></td>
             <td><?php echo $Fetch_customer_rewards['reward_status']; ?></td>
             <td><?php if ($Fetch_customer_rewards['reward_by'] == null) {
                                                                echo "<span class='text-danger'>No, </span> Direct Credit on Order.";
                                                            } else {
                                                                $RefferedId = $Fetch_customer_rewards['reward_by'];
                                                                $select = "SELECT * FROM customers where customer_id='$RefferedId'";
                                                                $selectquery = mysqli_query($con, $select);
                                                                $fetchref = mysqli_fetch_assoc($selectquery);
                                                                $refcustomername = $fetchref['customer_name'];
                                                                echo "<span class='text-success'>Yes,</span> By <a href='cust_details.php?customer_id=$RefferedId'>$refcustomername</a>";
                                                            } ?></td>
             <td align="center"><a href="#" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Details</a></td>
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