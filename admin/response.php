<?php
require 'files.php';
require 'session.php';
$start_time = $_SESSION['feedback_start_date_time'];
$end_time = $_SESSION['feedback_end_date_time'];

$diff = strtotime($end_time) - strtotime($start_time);
$fullHours   = floor($diff / (60 * 60));
$fullMinutes = floor(($diff - $fullHours * 60 * 60) / 60);
$fullsec = floor(($diff - $fullHours * 60 * 60) - $fullMinutes * 60 / 60);

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Users : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar pt-0" data-open="click"
 data-menu="vertical-menu-modern" data-col="2-columns">


 <!-- BEGIN: Content-->
 <div class="content-overlay"></div>
 <div class="content-wrapper">
  <div class="content-header row">
   <div class="col-lg-12 card-content">
    <?php notification(); ?>
   </div>
  </div>

  <div class="content-body">
   <!-- users list start -->

   <?php

      $action_id = $_SESSION['action_id'];
      $sql = "SELECT * FROM tasks_action where tasks_action_id='$action_id'";
      $query =  mysqli_query($con, $sql);
      $fetch = mysqli_fetch_assoc($query);
      $task_id = $fetch['task_id'];

      $sql = "SELECT * from taska where tasks_id='$task_id'";
      $query = mysqli_query($con, $sql);
      $fetch =  mysqli_fetch_assoc($query);
      $tasks_id = $fetch['tasks_id'];
      $tasks_title = $fetch['tasks_title'];
      $tasks_desc = $fetch['tasks_desc'];
      $full_name_t = $fetch['full_name'];
      $email_id_t = $fetch['email_id'];
      $phone_number_t = $fetch['phone_number'];
      $address_t = $fetch['address'];
      $city_t = $fetch['city'];
      $state_t = $fetch['state'];
      $tasks_status = $fetch['tasks_status'];
      $tasks_count = $fetch['tasks_count'];
      $taska_datetime = $fetch['taska_datetime'];
      $tasks_end_date = $fetch['tasks_end_date'];
      $tasks_assign_id = $fetch['tasks_assign_id'];
      $tasks_executer_id = $fetch['tasks_executer_id'];
      ?>
   <section class="users-list-wrapper">
    <div class="users-list-table">
     <div class="card">
      <div class="card-header">
       <h4 class="users-action">Feedback for Call @ <?php echo $phone_number_t; ?> : TSK
        <?PHP echo $task_id; ?>
       </h4>
       <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
      </div>
      <div class="card-content">
       <div class="card-body">
        <!-- datatable start -->

        <div class="row">
         <div class="col-lg-6 col-6">
          <h4><b>Person Information:</b>
           <hr>
          </h4>
          <p><?php echo $full_name_t; ?><br>
           <?php echo $email_id_t; ?><br>
           <?php echo $phone_number_t; ?><br>
           <?php echo $address_t; ?> <br><?php echo $city_t; ?> <?php echo $state_t; ?></p>
         </div>
         <div class="col-lg-6 col-6">
          <h4><b>Calling Details:</b>
           <hr>
          </h4>
          <p><b>Starting Time :</b> <?php echo $start_time; ?><br>
           <b>End Time :</b> <?php echo $end_time; ?><br>
           <b>Duration:</b> <?php echo $fullMinutes; ?> Minutes, <?php echo $fullsec; ?> Seconds
          </p>
         </div>
         <div class="col-lg-6">
          <?php
                    if ($fullsec <= 30) {
                      echo "<hr>
                        <H3><B>FEEDBACK</B></H3><br><br>
                     	<h4><b><i class='fa fa-warning text-danger'></i> Your Call is Below 30 Seconds</b></h4>
                     	<p>If Call is below 30 Second than it is not verified for Feedback response, so please try again. <br>You can also provide Feedback for Below 30 Seconds Call as a CALL TYPE for wrong numbers, not receiving, missbehave, TRY SOME TIME or Others. </p>"; ?>
          <form action="insert.php" method="POSt" class="float-left">
           <input type="text" name="task_id" value="<?php echo $task_id; ?>" hidden>
           <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
           <input type="text" name="tasks_count" value="<?php echo $tasks_count; ?>" hidden>
           <input type="text" name="task_action_description" value="Call Again" hidden>

           <button type="submit" name="callon_data" class="btn btn-success btn-md">
            <i class="fa fa-phone"></i> Call Again
           </button>
          </form>&nbsp;
         </div>
         <div class="col-lg-6">

          <?php
                      $sql = "SELECT * FROM taska where tasks_id='$tasks_id'";
                      $query =  mysqli_query($con, $sql);
                      $fetch =  mysqli_fetch_assoc($query);
                      $Rejected = $fetch['tasks_status'];

                      if ($Rejected == "Rejected") { ?>
          <h2 class="text-danger float-right"> Rejected</h2>
          <?php } else { ?>

          <form action="insert.php" method="POSt">
           <input type="text" name="task_id" value="<?php echo $task_id; ?>" hidden>
           <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
           <input type="text" name="tasks_count" value="<?php echo $tasks_count; ?>" hidden>
           <input type="text" name="action_id" value="<?php echo $action_id; ?>" hidden>
           <input type="text" name="feedback_start_date_time" value="<?php echo $start_time; ?>" hidden>
           <input type="text" name="feedback_end_date_time" value="<?php echo $end_time; ?>" hidden>
           <input type="text" name="task_action_description" value="Rejected" class="form-control" hidden>
           <div class="form-group">
            <hr>
            <label>
             <h4><b>CALL TYPE</b></h4>
            </label><br>
            <label>Call Type title:</label>
            <select class="form-control" name="tasks_status" required="">
             <option value="CLOSED_WRONG_NUMBER">WRONG NUMBER</option>
             <option value="NOT_RECEIVED">NOT_RECEIVED</option>
             <option value="NEGATIVE_BEHAVE">NEGATIVE BEHAVE</option>
             <option value="AFTER_SOME_TIMES">TRY AFTER SOMETIME</option>
             <option value="OTHERS">OTHERS</option>
            </select>
           </div>
           <div class="form-group">
            <label>Reason for CALL Type Enterance:</label>
            <textarea type="text" name="feedback_desc" class="form-control" placeholder="Enter feedback"
             required=""></textarea>
           </div>

           <button type="submit" name="TASKS_FEEDBACK" class="btn btn-danger btn-md">
            Submit
           </button>
          </form>
          <?php }
                    } else { ?>

          <form action="insert.php" method="POST">
           <input type="text" name="task_id" value="<?php echo $task_id; ?>" hidden>
           <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
           <input type="text" name="tasks_count" value="<?php echo $tasks_count; ?>" hidden>
           <input type="text" name="action_id" value="<?php echo $action_id; ?>" hidden>
           <input type="text" name="feedback_start_date_time" value="<?php echo $start_time; ?>" hidden>
           <input type="text" name="feedback_end_date_time" value="<?php echo $end_time; ?>" hidden>
           <input type="text" name="task_action_description" value="FEEDBACK" class="form-control" hidden>
           <div class="form-group">
            <label>Call Status:</label>
            <select class="form-control" name="tasks_status" required="">
             <option value="FOR_NEXT_DAY">NEXT DAY Transfer</option>
             <option value="NOT_INTERESTED">NOT INTERESTED</option>
             <option value="INTERESTED">INTERESTED</option>
             <option value="INTERESTED_BUT_MORE_DATA">Need More Details</option>
             <option value="MEETING">WANT F2F MEETING</option>
             <option value="NOT_RECEIVED">NOT Received</option>
             <option value="NEGATIVE_BEHAVE">NEGATIVE BEHAVE</option>
             <option value="CLOSED">CLOSED THIS</option>
             <option value="OTHERS">OTHERS</option>
            </select>
           </div>
           <div class="form-group">
            <label>If you want to Reject than enter Reason:</label>
            <textarea type="text" name="feedback_desc" rows='5' class="form-control" placeholder="Enter feedback"
             required=""></textarea>
           </div>
           <button type="submit" name="TASKS_FEEDBACK" class="btn btn-success btn-md">
            Submit Feedback
           </button>
          </form>
          <?php } ?>
         </div>

        </div>
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