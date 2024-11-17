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
 <title>TASKS : <?php echo $PosName; ?></title>
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

   <div class="modal fade text-left" id="add_users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title" id="myModalLabel17">All TASKs<i class="fa fa-angle-right"></i> ADD Tasks</h4>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
       </button>
      </div>
      <div class="modal-body">
       <form action="insert.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
        <div class="row">
         <div class="col-lg-12">
          <div class="row">
           <div class="col-lg-12">
            <h5 class="mobile-font-size">Select Date and Month.</h5>
           </div>
           <div class="col-lg-4 col-4">
            <div class="form-group">
             <select class="form-control" name="tasks_day">
              <option value="<?php echo date('d'); ?>">Today</option>
              <?php
                            $number_1 = 1;
                            while ($number_1 <= 31) { ?>
              <option value="<?php echo $number_1; ?>"><?php echo $number_1; ?></option>
              <?php $number_1++;
                            } ?>
             </select>
            </div>
           </div>
           <div class="col-lg-4 col-4">
            <div class="form-group">
             <select class="form-control" name="tasks_month">
              <option value="<?php echo date('m'); ?>">Current Month</option>
              <?php
                            $number_1 = 1;
                            while ($number_1 <= 12) { ?>
              <option value="<?php echo $number_1; ?>"><?php echo date("M", mktime(0, 0, 0, $number_1, 10)); ?></option>
              <?php $number_1++;
                            } ?>
             </select>
            </div>
           </div>
           <div class="col-lg-4 col-4">
            <div class="form-group">
             <select class="form-control" name="tasks_year">
              <option value="<?php echo date('Y'); ?>">Current Year</option>
              <?php
                            $number_1 = 2020;
                            while ($number_1 <= 2022) { ?>
              <option value="<?php echo $number_1; ?>"><?php echo $number_1; ?></option>
              <?php $number_1++;
                            } ?>
             </select>
            </div>
           </div>
          </div>
         </div>

         <div class="col-md-12">
          <div class="form-group">
           <label>ASSIGN Tasks to</label>
           <select class="form-control" name="tasks_executer_id">
            <?php $user_id = $_SESSION['user_id']; ?>
            <option value="<?php echo $user_id; ?>">UID:<?php echo $user_id; ?> : ASSIGN TO SELF</option>
            <?php
                        $user_id = $_SESSION['user_id'];
                        $sql = "SELECT * FROM users where ref='$user_id'";
                        $query = mysqli_query($con, $sql);
                        while ($fetch =  mysqli_fetch_assoc($query)) {
                          $user_id = $fetch['user_id'];
                          $full_name = $fetch['full_name'];
                          $phone_number = $fetch['phone_number'];
                          $email_id = $fetch['email_id']; ?>
            <option value="<?php echo $user_id; ?>">UID:<?php echo $user_id; ?> : <?php echo $full_name; ?> :
             <?php echo $phone_number; ?> : <?php echo $email_id; ?></option>
            <?php } ?>
           </select>
          </div>
         </div>


         <div class="col-md-4">
          <div class="form-group">
           <label>Select Tasks Title<code>*</code> </label>
           <select name="tasks_title" class="form-control" required="">
            <option value="NEW_STORE_ACTIVATION">NEW_STORE_ACTIVATION</option>
            <option value="NEW_PRODUCT_APPROVAL">NEW PRODUCT APPROVAL</option>
            <option value="CALLING">CALLING</option>
            <option value="NEW_STORE_RESEARCH">NEW_STORE_RESEARCH</option>
            <option value="OTHERS">OTHERS</option>

           </select>
          </div>
         </div>

         <div class="col-md-8">
          <div class="form-group">
           <label>Tasks desciption <code>*</code> </label>
           <input type="text" class="form-control" name="tasks_desc" placeholder="desc" required="">
          </div>
         </div>
        </div>
        <div class="row">
         <div class="col-lg-12">
          <p>Optional Field in case of not uploading DATA list.
           <hr>
          </p>
         </div>
         <div class="col-md-4">
          <div class="form-group">
           <label>Person Name (optional)</label>
           <input type="text" class="form-control" name="full_name" placeholder="full name">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Email Id (optional)</label>
           <input type="text" class="form-control" name="email_id" placeholder="abc@gmail.com">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Phone Number (optional)</label>
           <input type="text" class="form-control" name="phone_number" placeholder="+91">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>Address</label>
           <input type="text" class="form-control" name="address" placeholder="+91">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>City (optional)</label>
           <input type="text" class="form-control" name="city" placeholder="city">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
           <label>State (optional)</label>
           <input type="text" class="form-control" name="state" placeholder="">
          </div>
         </div>
        </div>

        <div class="row">
         <div class="col-lg-12">
          <hr>
          <h6>If your assigning task for someone else than you sould blank below inputs.</h6>
         </div>

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
           <textarea class="form-control" name='tasks_feedback' placeholder="Enter Feedback" rows="5"></textarea>
          </div>
         </div>

        </div>
      </div>
      <div class="modal-footer">
       <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
       <button type="Submit" name="SAVE_NEW_TASKS" class="btn btn-outline-primary">Save Tasks</button>
       </form>
      </div>
     </div>
    </div>
   </div>


   <div class="modal fade text-left" id="upload_tasks_sheet" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title mobile-font-size" id="myModalLabel17">All TASKS <i class="fa fa-angle-right"></i> UPLOAD
        Data </h4>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
       </button>
      </div>
      <div class="modal-body">
       <form action="insert.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
        <div class="row">

         <div class="col-lg-12">
          <h6 class="mobile-font-size">Data Format</h6>
          <p>Please enter Data in having column name mention as below or you may <a href="data/calling_list.csv"
            download="calling_list.csv">Download Format</a> too.</p>
          <ul>
           <li class="mobile-font-size"><b>FULL_NAME</b> </li>
           <li class="mobile-font-size"><b>EMAIL_ID</b> </li>
           <li class="mobile-font-size"><b>PHONE_NUMBER</b></li>
           <li class="mobile-font-size"><b>ADDRESS</b></li>
           <li class="mobile-font-size"><b>CITY</b></li>
           <li class="mobile-font-size"><b>STATE</b></li>
           <li class="mobile-font-size"><b>TASKS_STATUS</b> &nbsp; &nbsp; (Accepted Value : HOT, WARM, COLD, SALE)</li>
           <li class="mobile-font-size"><b>TASKS_FOLLOWDATE</b></li>
           <li class="mobile-font-size"><b>TASKS_FEEDBACK</b></li>
          </ul>
         </div>
         <div class="col-lg-12">
          <div class="row">
           <div class="col-lg-12">
            <h5 class="mobile-font-size">Select Date and Month.</h5>
           </div>
           <div class="col-lg-4 col-4">
            <div class="form-group">
             <select class="form-control" name="tasks_day">
              <option value="<?php echo date('d'); ?>">Today</option>
              <?php
                            $number_1 = 1;
                            while ($number_1 <= 31) { ?>
              <option value="<?php echo $number_1; ?>"><?php echo $number_1; ?></option>
              <?php $number_1++;
                            } ?>
             </select>
            </div>
           </div>
           <div class="col-lg-4 col-4">
            <div class="form-group">
             <select class="form-control" name="tasks_month">
              <option value="<?php echo date('m'); ?>">Current Month</option>
              <?php
                            $number_1 = 1;
                            while ($number_1 <= 12) { ?>
              <option value="<?php echo $number_1; ?>"><?php echo date("M", mktime(0, 0, 0, $number_1, 10)); ?></option>
              <?php $number_1++;
                            } ?>
             </select>
            </div>
           </div>
           <div class="col-lg-4 col-4">
            <div class="form-group">
             <select class="form-control" name="tasks_year">
              <option value="<?php echo date('Y'); ?>">Current Year</option>
              <?php
                            $number_1 = 2020;
                            while ($number_1 <= 2022) { ?>
              <option value="<?php echo $number_1; ?>"><?php echo $number_1; ?></option>
              <?php $number_1++;
                            } ?>
             </select>
            </div>
           </div>
          </div>
         </div>
         <div class="col-md-12">
          <div class="form-group">
           <label>ASSIGN Tasks to</label>
           <select class="form-control" name="tasks_executer_id">
            <?php $user_id = $_SESSION['user_id']; ?>
            <option value="<?php echo $user_id; ?>">UID:<?php echo $user_id; ?> : ASSIGN TO SELF</option>
            <?php
                        $user_id = $_SESSION['user_id'];
                        $sql = "SELECT * FROM users where ref='$user_id'";
                        $query = mysqli_query($con, $sql);
                        while ($fetch =  mysqli_fetch_assoc($query)) {
                          $user_id = $fetch['user_id'];
                          $full_name = $fetch['full_name'];
                          $phone_number = $fetch['phone_number'];
                          $email_id = $fetch['email_id']; ?>
            <option value="<?php echo $user_id; ?>">UID:<?php echo $user_id; ?> : <?php echo $full_name; ?> :
             <?php echo $phone_number; ?> : <?php echo $email_id; ?></option>
            <?php } ?>
           </select>
          </div>
         </div>
         <div class="col-md-4">
          <div class="form-group">
           <label>Select Tasks Title<code>*</code> </label>
           <select name="tasks_title" class="form-control" required="">
            <option value="NEW_STORE_ACTIVATION">NEW_STORE_ACTIVATION</option>
            <option value="NEW_PRODUCT_APPROVAL">NEW PRODUCT APPROVAL</option>
            <option value="CALLING">CALLING</option>
            <option value="NEW_STORE_RESEARCH">NEW_STORE_RESEARCH</option>
            <option value="OTHERS">OTHERS</option>

           </select>
          </div>
         </div>

         <div class="col-md-8">
          <div class="form-group">
           <label>Tasks desciption <code>*</code> </label>
           <input type="text" class="form-control" name="tasks_desc" placeholder="desc" required="">
          </div>
         </div>
         <div class="col-md-12">
          <div class="form-group mobile-font-size">
           Upload Calling Data</label>
           <input type="FILE" class="form-control" name="CALLING_DATA" placeholder="">
          </div>
         </div>

         <div class="col-md-4">
          <div class="form-group mobile-font-size">
           <label>Download Format</label>
           <br>
           <a href="data/calling_list.csv" class="btn btn-info" download="calling_list.csv"><i
             class="fa fa-download"></i> Calling_list.csv</a>
           <p><code>*</code> Only .csv format accepted</p>
          </div>
         </div>

        </div>
      </div>
      <div class="modal-footer mobile-font-size">
       <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
       <button type="Submit" name="DATA_TYPE" class="btn btn-outline-primary">Upload</button>
       </form>
      </div>
     </div>
    </div>
   </div>

   <div class="content-body">
    <!-- users list start -->
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action">All Tasks <i class="fa fa-angle-right"></i>
         <a href="" data-toggle="modal" data-target="#add_users"><i class="fa fa-plus"></i> Create Tasks</a>
         <a href="" data-toggle="modal" data-target="#upload_tasks_sheet"><i class="fa fa-plus"></i> Upload Data</a>
        </h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
         <ul class="list-inline mb-0">
          <li><a data-action="reload"><i class="fa fa-refresh"></i></a></li>
          <li><a data-action="expand"><i class="fa fa-expand"></i></a></li>
         </ul>
        </div>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12">
           <h4 class="mobile-font-size"><b><i class="fa fa-calendar"></i> : </b>
            <?php if (isset($_GET['month'])) {
                          $month_cr = $_GET['month'];
                          $month_cr_n = date("M", mktime(0, 0, 0, $month_cr, 10));
                          $year_cr = $_GET['year'];
                          $date_cr = date("d");
                          echo "$date_cr $month_cr_n, $year_cr";
                        } elseif (isset($_GET['view_month'])) {
                          $month_cr_view = $_GET['view_month'];
                          $year_cr_view = $_GET['view_year'];
                          $year_cr_view_n = date("M", mktime(0, 0, 0, $month_cr_view, 10));
                          $date_cr_view = $_GET['day'];
                          echo "$date_cr_view $year_cr_view_n, $year_cr_view";
                        } else {
                          echo date("d M, Y");
                        } ?></h4>
           <?php
                      /* draws a calendar */
                      function draw_calendar($month, $year)
                      {

                        /* draw table */
                        $calendar = '<table cellpadding="0" cellspacing="0" class="calendar" style="width:100%;">';

                        /* table headings */
                        $headings = array('SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT');
                        $calendar .= '<thead><tr class="calendar-row"><td class="calendar-day-head" style="padding: 2%;
    box-shadow: 0px 0px 1px grey;
    padding-right: 1px !important;
    text-align: center;">' . implode('</td><td class="calendar-day-head" style="padding: 2%;
    box-shadow: 0px 0px 1px grey;
    padding-right: 1px !important;
    text-align: center;">', $headings) . '</td></tr></thead>';

                        /* days and weeks vars now ... */
                        $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
                        $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
                        $days_in_this_week = 1;
                        $day_counter = 0;
                        $dates_array = array();

                        /* row for week one */
                        $calendar .= '<tr class="calendar-row">';

                        /* print "blank" days until the first of the current week */
                        for ($x = 0; $x < $running_day; $x++) :
                          $calendar .= '<td class="calendar-day-np" style="padding: 2%;
    box-shadow: 0px 0px 1px grey;
    padding-right: 1px !important;
    text-align: center;"></td>';
                          $days_in_this_week++;
                        endfor;

                        /* keep going with days.... */
                        for ($list_day = 1; $list_day <= $days_in_month; $list_day++) :
                          $current_date = date("d");
                          if (isset($_GET['month'])) {
                            $view_month = $_GET['month'];
                          } else {
                            $view_month = date("m");
                          }

                          if (isset($_GET['year'])) {
                            $view_year = $_GET['year'];
                          } else {
                            $view_year = date("Y");
                          }
                          $calendar .= '<td class="calendar-day" style="padding: 1%;
    width: 14.28571428571429% !important;
    box-shadow: 0px 0px 1px grey;
    padding-right: 1px !important;
    text-align: center;">';
                          /* add in the day number */
                          $calendar .= '<a href="?day=' . $list_day . '&view_month=' . $view_month . '&view_year=' . $view_year . '"><div class="day-number" >' . $list_day . '</div></a>';
                          $user_id = $_SESSION['user_id'];
                          global $con;
                          $SelectUserstasks = "SELECT * FROM taska where tasks_executer_id='$user_id' and tasks_day='$list_day' and tasks_month='$view_month' and tasks_year='$view_year'";
                          $query_tasks = mysqli_query($con, $SelectUserstasks);
                          $count_tasks = mysqli_num_rows($query_tasks);
                          if ($count_tasks == 0) {
                            $view_counts = " ";
                          } else {
                            $view_counts = $count_tasks . " Tasks";
                          }

                          /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
                          $calendar .= str_repeat("<p style='font-size:12px;margin-bottom:0px;height:20px;'>$view_counts</p>", 1);

                          $calendar .= '</td>';
                          if ($running_day == 6) :
                            $calendar .= '</tr>';
                            if (($day_counter + 1) != $days_in_month) :
                              $calendar .= '<tr class="calendar-row">';
                            endif;
                            $running_day = -1;
                            $days_in_this_week = 0;
                          endif;
                          $days_in_this_week++;
                          $running_day++;
                          $day_counter++;
                        endfor;

                        /* finish the rest of the days in the week */
                        if ($days_in_this_week < 8) :
                          for ($x = 1; $x <= (8 - $days_in_this_week); $x++) :
                            $calendar .= '<td class="calendar-day-np"> </td>';
                          endfor;
                        endif;

                        /* final row */
                        $calendar .= '</tr>';

                        /* end the table */
                        $calendar .= '</table>';

                        /* all done, return result */
                        return $calendar;
                      }



                      /* date settings */
                      $month = (int) (isset($_GET['month']) ? $_GET['month'] : date('m'));
                      $year = (int)  (isset($_GET['year']) ? $_GET['year'] : date('Y'));

                      /* select month control */
                      $select_month_control = '<center><select name="month" id="month" style="padding:2%;">';
                      for ($x = 1; $x <= 12; $x++) {
                        $select_month_control .= '<option value="' . $x . '"' . ($x != $month ? '' : ' selected="selected"') . '>' . date('F', mktime(0, 0, 0, $x, 1, $year)) . '</option>';
                      }
                      $select_month_control .= '</select>';

                      /* select year control */
                      $year_range = 3;
                      $select_year_control = '<select name="year" id="year" style="padding:2%;">';
                      for ($x = ($year - floor($year_range / 2)); $x <= ($year + floor($year_range / 2)); $x++) {
                        $select_year_control .= '<option value="' . $x . '"' . ($x != $year ? '' : ' selected="selected"') . '>' . $x . '</option>';
                      }
                      $select_year_control .= '</select>';

                      /* "next month" control */
                      $next_month_link = '<a href="?month=0' . ($month != 12 ? $month + 1 : 1) . '&year=' . ($month != 12 ? $year : $year + 1) . '" class="control float-right btn btn-sm btn-primary" >Next <i class="fa fa-angle-right"></i></a>';

                      /* "previous month" control */
                      $previous_month_link = '<a href="?month=0' . ($month != 1 ? $month - 1 : 12) . '&year=' .    ($month != 1 ? $year : $year - 1) . '" class="control btn float-left btn-sm btn-primary"><i class="fa fa-angle-left"></i>   Previous</a>';
                      echo $next_month_link;
                      echo $previous_month_link;
                      echo "<br><hr>";
                      echo draw_calendar($month, $year);
                      ?>
          </div>
         </div>
         <div class="table-responsive">
          <table id="users-list-datatable" class="table">
           <thead>
            <tr>
             <th>ID</th>
             <th>STORE_NAME</th>
             <th>PHONE_NUMBER</th>
             <th>STATUS</th>
             <th>FOLLOW DATE</th>
            </tr>
           </thead>
           <tbody>
            <?php
                        if (isset($_GET['view_month'])) {
                          $month = $_GET['view_month'];
                          $year = $_GET['view_year'];
                          if (isset($_GET['day'])) {
                            $view_day = $_GET['day'];
                          }
                          $user_id = $_SESSION['user_id'];
                          $SelectUsers = "SELECT * FROM taska where tasks_executer_id='$user_id' and tasks_day='$view_day' and tasks_month='$month' and tasks_year='$year'";
                        } elseif (isset($_GET['month'])) {
                          $month = $_GET['month'];
                          $year = $_GET['year'];
                          if (isset($_GET['day'])) {
                            $view_day = $_GET['day'];
                          } else {
                            $view_day = date("d");
                          }
                          $user_id = $_SESSION['user_id'];
                          $SelectUsers = "SELECT * FROM taska where tasks_executer_id='$user_id' and tasks_day='$view_day' and tasks_month='$month' and tasks_year='$year'";
                        } else {
                          $user_role = $_SESSION['user_role'];
                          if ($user_role == "SUPER_ADMIN") {
                            $view_day = date("d");
                            $view_m = date("m");
                            $view_y = date("Y");
                            $SelectUsers = "SELECT * FROM taska where tasks_day='$view_day' and tasks_month='$view_m' and tasks_year='$view_y'";
                          } elseif ($user_role != "SUPER_ADMIN") {
                            $user_id = $_SESSION['user_id'];
                            $view_day = date("d");
                            $view_m = date("m");
                            $view_y = date("Y");
                            $SelectUsers = "SELECT * FROM taska where tasks_executer_id='$user_id' or tasks_assign_id='$user_id' and tasks_day='$view_day' and tasks_month='$view_m' and tasks_year='$view_y'";
                          }
                        }

                        $SelectUsersQuery = mysqli_query($con, $SelectUsers);
                        $count_tasks = mysqli_num_rows($SelectUsersQuery);
                        if ($count_tasks == 0) {
                          echo "<tr><td colspan='5' align='center'><h3>No Tasks Found</h3></td></tr>";
                        } else {
                          while ($SelectUsersFetch =  mysqli_fetch_assoc($SelectUsersQuery)) {
                            $tasks_id = $SelectUsersFetch['tasks_id'];
                            $tasks_title = $SelectUsersFetch['tasks_title'];
                            $full_name_tsk = $SelectUsersFetch['full_name'];
                            $phone_number = $SelectUsersFetch['phone_number'];
                            $email_id = $SelectUsersFetch['email_id'];
                            $city = $SelectUsersFetch['city'];
                            $tasks_status = $SelectUsersFetch['tasks_status'];
                            $tasks_followupdate = $SelectUsersFetch['tasks_followupdate'];

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

                            if ($tasks_followupdate == null) {
                              $tasks_followupdate_view = "NA";
                            } else {
                              $tasks_followupdate_view = $tasks_followupdate;
                            } ?>
            <tr>
             <td>TSK<?php echo $tasks_id; ?></td>
             <td>
              <form action='tasks_details.php' method="POST" class="mb-0">
               <button type="submit" value="<?php echo $tasks_id; ?>" name='task_id'
                class='btn btn-link text-info btn-sm font-small-3'>
                <a href=''>
                 <h6><?php echo $full_name_tsk; ?></h6>
                </a>
               </button>
              </form>
             </td>
             <td><a href='tel:<?php echo $phone_number; ?>'><i class="fa fa-phone"></i> <?php echo $phone_number; ?></a>
             </td>
             <td><?php echo $tasks_status_view; ?></td>
             <td><?php echo $tasks_followupdate_view; ?></td>

            </tr>
            <?php }
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