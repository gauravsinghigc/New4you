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
 <title>Tasks Details : <?php echo $PosName; ?></title>
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

    <?php
        if (isset($_POST['task_id'])) {
          $_SESSION['task_id'] = $_POST['task_id'];
          $task_id = $_SESSION['task_id'];
        } elseif (!isset($_POST['task_id '])) {
          $task_id = $_SESSION['task_id'];

          if ($task_id == null) {
            header("location: tasks.php");
          }
        }

        $sql = "SELECT * from taska where tasks_id='$task_id'";
        $query = mysqli_query($con, $sql);
        $fetch =  mysqli_fetch_assoc($query);

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
        $tasks_month = $fetch['tasks_month'];
        $tasks_year = $fetch['tasks_year'];
        $taska_datetime_t = $fetch['taska_datetime'];
        $tasks_assign_id = $fetch['tasks_assign_id'];
        $tasks_executer_id = $fetch['tasks_executer_id'];
        $tasks_feedback = $fetch['tasks_feedback'];
        $tasks_followupdate = $fetch['tasks_followupdate'];
        $feedbackdatetime_t = $fetch['feedbackdatetime'];
        if ($tasks_status == "HOT") {
          $tasks_status_view = "<i class='badge badge-md badge-danger'>HOT</i>";
        } elseif ($tasks_status == "COLD") {
          $tasks_status_view = "<i class='badge badge-md badge-info'>COLD</i>";
        } elseif ($tasks_status == "WARM") {
          $tasks_status_view = "<i class='badge badge-md badge-warning'>WARM</i>";
        } elseif ($tasks_status == "SALE") {
          $tasks_status_view = "<i class='badge badge-md badge-success'>SALE</i>";
        } else {
          $tasks_status_view = "<i class='badge badge-md badge-black'>OTHERS</i>";
        }
        ?>
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action mobile-font-size">TSK
         <?PHP echo $task_id; ?> <i class='fa fa-angle-right'></i> <?php echo $full_name_t; ?> <i
          class='fa fa-angle-right'></i>
         <?php if ($tasks_status != null and $tasks_feedback != null and $tasks_followupdate != null) {
                    echo "<i class='fa fa-check text-success'> Completed!</i>";
                  } else {
                    echo "<i class='fa fa-warning text-danger'> Not Completed!</i>";
                  } ?>
        </h4>
        <h6>
         <?php echo "<small><b>Assign Date:</b> " . $taska_datetime_t . "-" . $tasks_month . "-" . $tasks_year . "</small><br>"; ?>
        </h6>
        <h6><?php
                    if ($feedbackdatetime_t == null) {
                      echo "<small><b>Complete On:</b> Not Completed! </small><br>";
                    } else {
                      echo "<small><b>Completed On:</b> $feedbackdatetime_t </small><br>";
                    } ?></h6>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->

         <div class="row mobile-font-size">
          <div class="col-lg-6 col-6">
           <h5>Task Assign By:</h5>
           <hr>
           <?php
                      $sql = "SELECT * FROM users where user_id='$tasks_assign_id'";
                      $query =  mysqli_query($con, $sql);
                      $fetch = mysqli_fetch_assoc($query);

                      echo "<i class='fa fa-user'></i> " . $full_name_a = $fetch['full_name'] . "<br>";
                      echo "<i class='fa fa-envelope'></i> " . $email_id = $fetch['email_id'] . "<br>";
                      echo "<i class='fa fa-phone'></i> " . $phone_number_a = $fetch['phone_number'] . "<br>";

                      ?>
          </div>
          <div class="col-lg-6 col-6">
           <h5>Task Assign to:</h5>
           <hr>
           <?php
                      $sql = "SELECT * FROM users where user_id='$tasks_executer_id'";
                      $query =  mysqli_query($con, $sql);
                      $fetch = mysqli_fetch_assoc($query);

                      echo "<i class='fa fa-user'></i> " . $full_name_b = $fetch['full_name'] . "<br>";
                      echo "<i class='fa fa-envelope'></i> " . $email_id_b = $fetch['email_id'] . "<br>";
                      echo "<i class='fa fa-phone'></i> " . $phone_number_b = $fetch['phone_number'] . "<br>";

                      ?>
          </div>
         </div>
         <div class="row">
          <div class="col-lg-6 p-2">
           <h5>Tasks Details:</h5>
           <p><b>Title :</b> <?php echo $tasks_title; ?><br>
            <b>Desc :</b> <?php echo $tasks_desc; ?>
           </p>
          </div>
          <div class="col-lg-6 p-2">
           <h5><b>Calling On:</b></h5>
           <p><?php echo $full_name_t; ?> <br><?php echo $email_id_t; ?><br><?php echo $phone_number_t; ?><br>
            <b>Address:</b> <?php echo $address_t; ?> <br><?php echo $city_t; ?> <?php echo $state_t; ?>
           </p>
          </div>
         </div>

         <div class="row">
          <div class="col-lg-6">
           <a href='tel:<?php echo $phone_number_t; ?>' target="_blank">
            <button type="submit" name="callon_data" class="btn btn-success btn-md">
             <i class="fa fa-phone"></i> Make a Call
            </button>
           </a>
          </div>
         </div>
         <div class="row">
          <div class="col-lg-12">
           <hr>

           <div class="modal fade text-left" id="submit_new_feedback" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel17" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
              <div class="modal-header">
               <h4 class="modal-title mobile-font-size" id="myModalLabel17">FEEDBACKs <i class="fa fa-angle-right"></i>
                Submit New Feedback</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
               </button>
              </div>
              <div class="modal-body">
               <p>TSKID: <?php echo $task_id; ?> <i class="fa fa-angle-right"></i> <?php echo $tasks_title; ?> <i
                 class="fa fa-angle-right"></i> <?php echo $full_name_t; ?> </p>
               <form action="insert.php" method="POST" enctype="multipart/form-data">
                <input type='text' name='task_id' value='<?php echo $task_id; ?>' hidden>
                <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
                <div class="row">
                 <div class="col-md-4">
                  <div class="form-group">
                   <label>Tasks Status</label>
                   <select class="form-control" name="tasks_status">
                    <option value=''>Select Status</option>
                    <option value='HOT'>HOT</option>
                    <option value='WARM'>WARM</option>
                    <option value='COLD'>COLD</option>
                    <option value='SALE'>SALE</option>
                   </select>
                  </div>
                 </div>

                 <div class="col-md-4">
                  <div class="form-group">
                   <label>FOLLOW UPDATE</label>
                   <input type="text" class="form-control" name="tasks_followupdate" placeholder="DD/MM/YYYY">
                  </div>
                 </div>

                 <div class="col-md-12">
                  <div class="form-group">
                   <label>Enter FEEDBACK</label>
                   <textarea class="form-control" name='tasks_feedback' placeholder="Enter Feedback"
                    rows="5"></textarea>
                  </div>
                 </div>
                </div>
              </div>
              <div class="modal-footer mobile-font-size">
               <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
               <button type="Submit" name="SAVE_NEW_FEEDBACK" class="btn btn-outline-primary">Save</button>
               </form>
              </div>
             </div>
            </div>
           </div>
           <div class="row">
            <div class="col-lg-12">
             <h4 class='mobile-font-size'>Feedbacks
              <i class='fa fa-angle-right'></i>
              <a data-toggle='modal' data-target='#submit_new_feedback' class='btn text-white btn-sm btn-info'><i
                class="fa fa-plus"></i> NEW FEEDBACK</a>
             </h4>
            </div>
            <?php if ($tasks_status != null and $tasks_feedback != null and $tasks_followupdate != null) { ?>
            <?php
                          if (isset($_POST['TASKS_FEEDBACK'])) {
                            message("success", "Saved", "Feedback is Saved");
                            echo "<h4 class='mobile-font-size'>Task is Completed!</h4><br>
                              <a href='tasks.php' class='btn btn-md btn-info'><i class='fa fa-angle-left'></i> Back to All</a>";
                          } else {
                            $sql = "SELECT * from taska where tasks_id='$task_id'";
                            $query  = mysqli_query($con, $sql);
                            $fetch =  mysqli_fetch_assoc($query);
                            $latest_status = $fetch['tasks_status'];
                            $latest_followupdate = $fetch['tasks_followupdate'];
                            $latest_feedback = $fetch['tasks_feedback'];
                            echo "
                            <div class='col-md-3 col-sm-6 col-6'>
                            <p class='mobile-font-size'>
                            <b><i class='fa fa-calendar'></i> :</b> $feedbackdatetime_t<br>
                            <b>Status : </b> $tasks_status_view<br>
                            <b>Followup date:</b> $latest_followupdate<br>
                            <b>Feedback:</b> $latest_feedback</p>
                            </div>
                            ";

                            $sql = "SELECT * from tasks_feedbacks where task_id='$task_id'";
                            $query =  mysqli_query($con, $sql);
                            while ($fetch = mysqli_fetch_assoc($query)) {
                              $tasks_feedback_id = $fetch['tasks_feedback_id'];
                              $tasks_status_plus = $fetch['tasks_status'];
                              $tasks_feedback_plus = $fetch['tasks_feedback'];
                              $tasks_followupdate_plus = $fetch['tasks_followupdate'];
                              $feedback_datetime_plus = $fetch['feedback_datetime'];
                              if ($tasks_status_plus == "HOT") {
                                $tasks_status_view_plus = "<i class='badge badge-md badge-danger'>HOT</i>";
                              } elseif ($tasks_status_plus == "COLD") {
                                $tasks_status_view_plus = "<i class='badge badge-md badge-info'>COLD</i>";
                              } elseif ($tasks_status_plus == "WARM") {
                                $tasks_status_view_plus = "<i class='badge badge-md badge-warning'>WARM</i>";
                              } elseif ($tasks_status_plus == "SALE") {
                                $tasks_status_view_plus = "<i class='badge badge-md badge-success'>SALE</i>";
                              } else {
                                $tasks_status_view_plus = "<i class='badge badge-md badge-black'>OTHERS</i>";
                              }
                              echo "
                             <div class='col-md-3 col-sm-6 col-6'>
                             <b><i class='fa fa-calendar'></i> :</b> $feedback_datetime_plus<br>
                             <p class='mobile-font-size'><b>Status : </b> $tasks_status_view_plus<br>
                             <b>Followup date:</b> $tasks_followupdate_plus<br>
                             <b>Feedback:</b> $tasks_feedback_plus</p>
                             </div>";
                            }
                            echo "<br> ";
                          } ?>
            <div class="col-lg-12">
             <a href='tasks.php' class='btn btn-md btn-info'><i class='fa fa-angle-left'></i> Back to All</a>
            </div>
           </div>



           <?php  } else { ?>
           <h4><b>Feedback</b></h4>
           <?php if (!isset($_POST['TASKS_FEEDBACK'])) { ?>
           <form action="" method="POST"><br>
            <div class="form-group">
             <label>Select Call Status:</label>
             <select class="form-control" name="tasks_status" required=''>
              <option value=''>Select Status</option>
              <option value='HOT'>HOT</option>
              <option value='WARM'>WARM</option>
              <option value='COLD'>COLD</option>
              <option value='SALE'>SALE</option>
             </select>
            </div>
            <div class="form-group">
             <label>Follow Up Date: <small> <i class="fa fa-angle-right"></i> if no followup than enter NA</small>
             </label>
             <input type="text" name='tasks_followupdate' placeholder="DD / MM / 2020" required='' class="form-control">
            </div>
            <div class="form-group">
             <label>Enter Feedback:</label>
             <textarea type="text" name="feedback_desc" rows='5' class="form-control" placeholder="Enter feedback"
              required=""></textarea>
            </div>
            <button type="submit" name="TASKS_FEEDBACK" class="btn btn-success btn-md">
             Submit Feedback
            </button>
           </form>
           <?php } ?>
           <?php
                          if (isset($_POST['TASKS_FEEDBACK'])) {
                            $new_tasks_status = $_POST['tasks_status'];
                            $tasks_followupdate_new = $_POST['tasks_followupdate'];
                            $feedback_desc_new = $_POST['feedback_desc'];
                            $feedbackdatetime = date("d M Y h:m a");

                            $sql = "UPDATE taska SET tasks_status='$new_tasks_status', tasks_followupdate='$tasks_followupdate_new', tasks_feedback='$feedback_desc_new', feedbackdatetime='$feedbackdatetime' where tasks_id='$task_id'";

                            $query = mysqli_query($con, $sql);
                      ?>
           <?php }
                        } ?>

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