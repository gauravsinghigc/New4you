<?php require 'files.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8" />
 <title>Admin Page | <?php echo $name; ?></title>

 <?php require 'meta.php';
    require 'stylesheet.php'; ?>

</head>

<body>
 <!-- begin #page-loader -->
 <!-- end #page-loader -->

 <!-- begin #page-container -->
 <div id="page-container"
  class="fade page-container page-header-fixed page-sidebar-fixed page-with-two-sidebar page-with-footer">

  <?php require 'header.php';
        require 'sidebar.php'; ?>



  <!-- begin #content -->
  <div id="content" class="content">
   <!-- begin page-header -->
   <h1 class="page-header">Dashboard <small><i class="fa fa-angle-right"></i> Main Dashboard</small></h1>
   <hr class="hr-mr">
   <!-- end page-header -->

   <!-- begin row -->
   <div class="row">
    <!-- begin col-3 -->

    <div class="col-lg-3 col-sm-6 col-6">
     <!-- begin widget -->
     <div class="widget widget-stat bg-primary text-white">
      <div class="widget-stat-btn"><a href="admin.php" data-click="widget-reload"><i
         class="icon-refresh text-white"></i></a></div>
      <div class="widget-stat-icon"><i class="icon-users"></i></div>
      <div class="widget-stat-info">
       <div class="widget-stat-title">
        <a href='contacts_list.php' class="text-white">ALL Customers</a>
       </div>
       <div class="widget-stat-number">
        <?php
                                $contact_view = modify("customer", "e");
                                $sql = "SELECT * FROM contacts_list where contact_type='$contact_view'";
                                $query = mysqli_query($con, $sql);
                                $count = mysqli_num_rows($query);
                                echo $count; ?>
       </div>
       <div class="widget-stat-text">
        <i class="fa fa-check-circle"></i>
        <?php
                                $contact_view = modify("customer", "e");
                                $active = modify("active", "e");
                                $sql = "SELECT * FROM contacts_list where contact_type='$contact_view' and contact_status='$active'";
                                $query = mysqli_query($con, $sql);
                                $count = mysqli_num_rows($query);
                                echo $count; ?> Active |

        <i class="fa fa-warning"></i>
        <?php
                                $contact_view = modify("customer", "e");
                                $inactive = modify("inactive", "e");
                                $sql = "SELECT * FROM contacts_list where contact_type='$contact_view' and contact_status='$inactive'";
                                $query = mysqli_query($con, $sql);
                                $count = mysqli_num_rows($query);
                                echo $count; ?> Inactive

       </div>
      </div>
     </div>
     <!-- end widget -->
    </div>

    <!-- end col-3 -->


    <div class="col-lg-3 col-sm-6 col-6">
     <!-- begin widget -->
     <div class="widget widget-stat bg-info text-white">
      <div class="widget-stat-btn"><a href="admin.php" data-click="widget-reload"><i
         class="icon-refresh text-white"></i></a></div>
      <div class="widget-stat-icon"><i class="icon-users"></i></div>
      <div class="widget-stat-info">
       <div class="widget-stat-title">
        <a href='team_list.php' class="text-white">ALL Teammates</a>
       </div>
       <div class="widget-stat-number">
        <?php
                                $team_view = modify("team", "e");
                                $sql = "SELECT * FROM contacts_list where contact_type='$team_view'";
                                $query = mysqli_query($con, $sql);
                                $count = mysqli_num_rows($query);
                                echo $count; ?>
       </div>
       <div class="widget-stat-text">
        <i class="fa fa-check-circle"></i>
        <?php
                                $team_view = modify("team", "e");
                                $active = modify("active", "e");
                                $sql = "SELECT * FROM contacts_list where contact_type='$team_view' and contact_status='$active'";
                                $query = mysqli_query($con, $sql);
                                $count = mysqli_num_rows($query);
                                echo $count; ?> Active |

        <i class="fa fa-warning"></i>
        <?php
                                $team_view = modify("team_view", "e");
                                $inactive = modify("inactive", "e");
                                $sql = "SELECT * FROM contacts_list where contact_type='$team_view' and contact_status='$inactive'";
                                $query = mysqli_query($con, $sql);
                                $count = mysqli_num_rows($query);
                                echo $count; ?> Inactive

       </div>
      </div>
     </div>
     <!-- end widget -->
    </div>
    <!-- end col-3 -->



   </div>
   <!-- end row -->

   <!-- begin row -->
   <div class="row">
    <!-- begin col-6 -->
    <div class="col-lg-6">
     <!-- begin widget -->
     <div class="widget widget-chart">
      <!-- begin widget-header -->
      <div class="widget-header bg-inverse-dark">
       <ul class="widget-header-btn">
        <li><a href="" data-click="widget-reload"><i class="fa fa-refresh text-white f-s-13"></i></a></li>
        <li class="text-white">
         <?php $sql = "SELECT * from user_login_logs";
                                    $query =  mysqli_query($con, $sql);
                                    $count =  mysqli_num_rows($query);
                                    echo $count; ?> <i class="fa fa-sign-in"></i>
        </li>
       </ul>
       <h4 class="text-white">Latest Login Logs</h4>
      </div>
      <!-- end widget-header -->
      <!-- begin widget-body -->
      <div class="widget-body">
       <table class="table table-bordered table-hover table-last-row-no-border-bottom m-b-0 f-s-13">
        <tbody>
         <?php
                                    $sql = "SELECT * from user_login_logs, contacts_list where user_login_logs.contact_id=contacts_list.contact_id ORDER BY logs_id DESC limit 0, 10";
                                    $query =  mysqli_query($con, $sql);
                                    $count  =  mysqli_num_rows($query);
                                    if ($count != true) {
                                        echo "<tr>
                                                         <td class='text-center'><h4>No Logs Available</h4><p>Please refresh the login Logs or Try Re-Login.</td>
                                                       </tr>";
                                    } else {
                                        while ($fetch =  mysqli_fetch_assoc($query)) {
                                            $contact_id = $fetch['contact_id'];
                                    ?>

         <tr>
          <td class='text-center'>LOGID<?php echo $fetch['logs_id']; ?></td>
          <td class='text-center'>
           <form action='contacts_list_view.php' method='POST' class="margin-bottom-0">
            <input type='text' name='id' value="<?php echo $contact_id; ?>" hidden=''>
            <button type='submit' name='view' class='btn btn-sm btn-link text-primary font-size-13'>
             <i class="fa fa-user"></i> <?php echo modify($fetch['contact_fullname'], "d"); ?>
            </button>
           </form>
          </td>
          <td class='text-center'><?php echo modify($fetch['logs_user_username'], "d"); ?></td>
          <td class='text-center'><?php echo modify($fetch['logs_entry_date'], "d"); ?></td>
         </tr>
         <?php }
                                    } ?>
        </tbody>
       </table>

      </div>
      <!-- end widget-body -->
     </div>
     <!-- end widget -->
    </div>
    <!-- end col-6 -->

    <!-- begin col-6 -->
    <div class="col-lg-6">
     <!-- begin widget -->
     <div class="widget widget-chart">
      <!-- begin widget-header -->
      <div class="widget-header bg-inverse-dark">
       <ul class="widget-header-btn">
        <li><a href="#" class="btn btn-white"><i class="fa fa-cog"></i></a></li>
       </ul>
       <h4 class="text-white">Visitor Analytics</h4>
      </div>
      <!-- end widget-header -->
      <!-- begin widget-body -->
      <div class="widget-body">

       <!-- begin visitor-chart -->

       <!-- end visitor-chart -->
       <!-- begin row -->
       <div class="row col-lg-with-border">
        <div class="col-lg-4 text-center">
         <div class="m-b-2"><span class="fa fa-circle-o br-c text-primary"></span> Total Visitors</div>
         <h4 class="m-0">3,192,489</h4>
        </div>
        <div class="col-lg-4 text-center">
         <div class="m-b-2"><span class="fa fa-circle-o text-danger"></span> Bounce Rate</div>
         <h4 class="m-0">30.25%</h4>
        </div>
        <div class="col-lg-4 text-center">
         <div class="m-b-2"><span class="fa fa-circle-o text-grey"></span> Avg Time on Site</div>
         <h4 class="m-0">00:03:42</h4>
        </div>
       </div>
       <!-- end row -->
      </div>
      <!-- end widget-body -->
     </div>
     <!-- end widget -->
    </div>
    <!-- end col-6 -->


    <!-- begin col-6 -->
    <div class="col-lg-6">
     <!-- begin widget -->
     <div class="widget widget-chart">
      <!-- begin widget-header -->
      <div class="widget-header bg-inverse-dark">
       <ul class="widget-header-btn">
        <li><a href="#" class="btn btn-white">1 Nov 2017 - 31 Nov 2017 <i class="fa fa-cog"></i></a></li>
       </ul>
       <h4 class="text-white">Server Load</h4>
      </div>
      <!-- end widget-header -->
      <!-- begin widget-body -->
      <div class="widget-body">
       <!-- begin chart-placeholder -->
       <ul class="widget-chart-placeholder text-center inline">
        <li><span class="legend-circle bg-danger"></span> Overload > 75%</li>
        <li><span class="legend-circle bg-warning"></span> Heavy Load > 50%</li>
        <li><span class="legend-circle bg-lime"></span> Normal < 50%</li>
       </ul>
       <!-- end chart-placeholder -->
       <!-- begin server-chart -->
       <div id="flot-server-chart" class="m-b-15" data-height="230px"></div>
       <!-- end server-chart -->
       <!-- begin row -->
       <div class="row col-lg-with-border">
        <div class="col-lg-4 text-center">
         <div class="m-b-2">Bandwidth Usage</div>
         <h4 class="m-0">30.56Tb</h4>
        </div>
        <div class="col-lg-4 text-center">
         <div class="m-b-2">Server Usage</div>
         <h4 class="m-0" data-id="server-load-number">0.00%</h4>
        </div>
        <div class="col-lg-4 text-center">
         <div class="m-b-2">Disk Storage</div>
         <h4 class="m-0">3.02Gb</h4>
        </div>
       </div>
       <!-- end row -->
      </div>
      <!-- end widget-body -->
     </div>
     <!-- end widget -->
    </div>
    <!-- end col-6 -->
   </div>
   <!-- end row -->

   <!-- begin row -->
   <div class="row">
    <!-- begin col-4 -->
    <div class="col-lg-4">
     <!-- begin widget -->
     <div class="widget widget-chat">
      <div class="widget-header bg-inverse-dark">
       <h4 class="text-white">Chat History</h4>
      </div>
      <div class="widget-body">
       <ul class="widget-chat-list">
        <li>
         <a href="#" data-toggle="chat-detail">
          <div class="chat-image">
           <img src="assets/img/user_1.jpg" alt="" />
          </div>
          <div class="chat-info has-new">
           <h4>Jengo Chima (1)</h4>
           <p>
            Aliquam erat volutpat. Etiam vulputate arcu feugiat ante imperdiet, ut bibendum ipsum rhoncus.
           </p>
           <span class="chat-time">08:41</span>
          </div>
         </a>
        </li>
        <li>
         <a href="#" data-toggle="chat-detail">
          <div class="chat-image">
           <img src="assets/img/user_2.jpg" alt="" />
          </div>
          <div class="chat-info">
           <h4>Pontus Dragomir</h4>
           <p>
            <i class="fa fa-check send-icon text-success-light"></i> Sed quis ante rutrum, cursus enim sit amet,
            placerat turpis.
           </p>
           <span class="chat-time">YESTERDAY</span>
          </div>
         </a>
        </li>
        <li>
         <a href="#" data-toggle="chat-detail">
          <div class="chat-image">
           <img src="assets/img/user_3.jpg" alt="" />
          </div>
          <div class="chat-info">
           <h4>Lovro Étienne</h4>
           <p>
            <i class="fa fa-check send-icon text-success-light"></i> Morbi ultrices diam vitae placerat suscipit. Morbi
            consectetur ante et ex mollis eleifend.
           </p>
           <span class="chat-time">YESTERDAY</span>
          </div>
         </a>
        </li>
        <li>
         <a href="#" data-toggle="chat-detail">
          <div class="chat-image">
           <img src="assets/img/user_4.jpg" alt="" />
          </div>
          <div class="chat-info">
           <h4>Kendal Matheus</h4>
           <p>
            <i class="fa fa-check send-icon text-success-light"></i> Aenean consectetur in velit vitae faucibus. Fusce
            libero est, euismod eu erat eu, luctus rutrum nunc.
           </p>
           <span class="chat-time">YESTERDAY</span>
          </div>
         </a>
        </li>
        <li>
         <a href="#" data-toggle="chat-detail">
          <div class="chat-image">
           <img src="assets/img/user_5.jpg" alt="" />
          </div>
          <div class="chat-info">
           <h4>Eivind Andrew</h4>
           <p>
            <i class="fa fa-check send-icon text-success-light"></i> Cum sociis natoque penatibus et magnis dis
            parturient montes, nascetur ridiculus mus.
           </p>
           <span class="chat-time">YESTERDAY</span>
          </div>
         </a>
        </li>
       </ul>
       <div class="widget-chat-detail">
        <div class="widget-header bg-inverse">
         <h4 class="text-white"><a href="#" data-dismiss="chat-detail" class="m-r-5 text-white"><i
            class="fa fa-arrow-left"></i> Group Chat</a></h4>
        </div>
        <div class="widget-chat-detail-container">
         <div data-scrollbar="true" data-height="100%">
          <ul class="widget-chat-detail-list">
           <li>
            <a href="javascript:;" class="image"><img src="assets/img/user_7.jpg" alt="" /></a>
            <div class="chat-info">
             <span class="time">04:15 am</span>
             <a href="#" class="name">Neck Jolly</a>
             <div class="message">
              Euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
             </div>
            </div>
           </li>
           <li class="right highlight">
            <a href="javascript:;" class="image"><img src="assets/img/user_6.jpg" alt="" /></a>
            <div class="chat-info">
             <span class="time">05:21 am</span>
             <a href="#" class="name">Sean Ngu</a>
             <div class="message">
              Nullam posuere, nisl a varius rhoncus, risus tellus hendrerit neque.
             </div>
            </div>
           </li>
           <li>
            <a href="javascript:;" class="image"><img src="assets/img/user_1.jpg" alt="" /></a>
            <div class="chat-info">
             <span class="time">12:20pm</span>
             <a href="#" class="name">Shag Strap</a>
             <div class="message">
              Nullam iaculis pharetra pharetra. Proin sodales tristique sapien mattis placerat.
             </div>
            </div>
           </li>
           <li>
            <a href="javascript:;" class="image"><img src="assets/img/user_5.jpg" alt="" /></a>
            <div class="chat-info">
             <span class="time">Just Now</span>
             <a href="javascript:;" class="name">Sowse Bawdy</a>
             <div class="message">
              Lorem ipsum dolor sit amet, consectetuer adipiscing elit volutpat. Praesent mattis interdum arcu eu
              feugiat.
             </div>
            </div>
           </li>
          </ul>
         </div>
        </div>
        <div class="widget-chat-input">
         <form method="POST" name="widget_chat_form" class="form-input-flat">
          <div class="input-group">
           <input type="text" class="form-control" placeholder="Type a message" />
           <div class="input-group-btn">
            <button type="button" class="btn btn-inverse">Send</button>
           </div>
          </div>
         </form>
        </div>
       </div>
      </div>
     </div>
     <!-- end widget -->
    </div>
    <!-- end col-4 -->
    <!-- begin col-8 -->
    <div class="col-lg-8">
     <!-- begin widget -->
     <div class="widget">
      <div class="widget-header bg-inverse-dark">
       <h4 class="text-white">World Population</h4>
      </div>
      <div class="widget-body p-0">
       <div class="row row-space-0">
        <div class="col-lg-7">
         <div id="vector-map" data-height="350px" class="widget-map-left"></div>
        </div>
        <div class="col-lg-5 bg-white">
         <div class="table-responsive m-b-0">
          <table class="table table-bordered table-hover table-last-row-no-border-bottom m-b-0 f-s-13">
           <thead>
            <tr>
             <th>#</th>
             <th>Country</th>
             <th class="text-nowrap" width="1%">Total (millions)</th>
            </tr>
           </thead>
           <tbody>
            <tr>
             <td>1</td>
             <td>China</td>
             <td class="text-center">1,458</td>
            </tr>
            <tr>
             <td>2</td>
             <td>India</td>
             <td class="text-center">1,398</td>
            </tr>
            <tr>
             <td>3</td>
             <td nowrap>United States</td>
             <td class="text-center">352</td>
            </tr>
            <tr>
             <td>4</td>
             <td>Indonesia</td>
             <td class="text-center">273</td>
            </tr>
            <tr>
             <td>5</td>
             <td>Brazil</td>
             <td class="text-center">223</td>
            </tr>
            <tr>
             <td>6</td>
             <td>Pakistan</td>
             <td class="text-center">226</td>
            </tr>
            <tr>
             <td>7</td>
             <td>Bangladesh</td>
             <td class="text-center">198</td>
            </tr>
            <tr>
             <td>8</td>
             <td>Nigeria</td>
             <td class="text-center">151</td>
            </tr>
           </tbody>
          </table>
         </div>
        </div>
       </div>
      </div>
     </div>
     <!-- end widget -->
    </div>
    <!-- end col-8 -->
   </div>
   <!-- end row -->

   <!-- begin row -->
   <div class="row">
    <!-- begin col-4 -->
    <div class="col-lg-4">
     <!-- begin widget -->
     <div class="widget">
      <div class="widget-header bg-inverse-dark">
       <ul class="widget-header-btn">
        <li><a href="javascript:;" class="btn btn-white"><i class="fa fa-plus"></i></a></li>
       </ul>
       <h4 class="text-white">Todo List</h4>
      </div>
      <ul class="widget-todolist">
       <li class="widget-todolist-title">Today</li>
       <li class="completed">
        <div class="checkbox">
         <label>
          <i class="far fa-square" data-click="todolist-checkbox"></i>
          <input type="checkbox" name="todolist_checkbox" checked />
         </label>
        </div>
        <div class="info">
         <h4>Mobile Apps Development Discussion</h4>
         <p>Today 11:15pm</p>
        </div>
        <div class="action">
         <a href="#" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
         <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="#">Edit</a></li>
          <li><a href="#">Archive</a></li>
          <li><a href="#">Delete</a></li>
         </ul>
        </div>
       </li>
       <li>
        <div class="checkbox">
         <label>
          <i class="far fa-square" data-click="todolist-checkbox"></i>
          <input type="checkbox" name="todolist_checkbox" />
         </label>
        </div>
        <div class="info">
         <h4>Meet with Client <span class="label label-danger">URGENT</span></h4>
         <p>Today 3:15pm</p>
        </div>
        <div class="action">
         <a href="#" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
         <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="#">Edit</a></li>
          <li><a href="#">Archive</a></li>
          <li><a href="#">Delete</a></li>
         </ul>
        </div>
       </li>
       <li class="widget-todolist-title">Tomorrow</li>
       <li>
        <div class="checkbox">
         <label>
          <i class="far fa-square" data-click="todolist-checkbox"></i>
          <input type="checkbox" name="todolist_checkbox" />
         </label>
        </div>
        <div class="info">
         <h4>Business Proposal Presentation</h4>
         <p>Tomorrow 12:45pm</p>
        </div>
        <div class="action">
         <a href="#" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
         <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="#">Edit</a></li>
          <li><a href="#">Archive</a></li>
          <li><a href="#">Delete</a></li>
         </ul>
        </div>
       </li>
       <li>
        <div class="checkbox">
         <label>
          <i class="far fa-square" data-click="todolist-checkbox"></i>
          <input type="checkbox" name="todolist_checkbox" />
         </label>
        </div>
        <div class="info">
         <h4>New Idea Brainstorming</h4>
         <p>Tomorrow 5:30pm</p>
        </div>
        <div class="action">
         <a href="#" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
         <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="#">Edit</a></li>
          <li><a href="#">Archive</a></li>
          <li><a href="#">Delete</a></li>
         </ul>
        </div>
       </li>
       <li>
        <div class="checkbox">
         <label>
          <i class="far fa-square" data-click="todolist-checkbox"></i>
          <input type="checkbox" name="todolist_checkbox" />
         </label>
        </div>
        <div class="info">
         <h4>Annual Dinner Preparation</h4>
         <p>Tomorrow 6:30pm</p>
        </div>
        <div class="action">
         <a href="#" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
         <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="#">Edit</a></li>
          <li><a href="#">Archive</a></li>
          <li><a href="#">Delete</a></li>
         </ul>
        </div>
       </li>
      </ul>
     </div>
     <!-- end widget -->
    </div>
    <!-- end col-4 -->
    <!-- begin col-4 -->
    <div class="col-lg-4">
     <!-- begin widget -->
     <div class="widget widget-form">
      <div class="widget-header bg-inverse-dark">
       <h4 class="text-white">Widget Simple Form</h4>
      </div>
      <div class="widget-body p-b-15">
       <form class="form-input-flat" method="POST" name="sample_form">
        <div class="form-group">
         <label class="col-form-label">Title</label>
         <input type="text" class="form-control" />
        </div>
        <div class="form-group">
         <label class="col-form-label">Content</label>
         <textarea class="form-control" rows="5"></textarea>
        </div>
        <div class="m-b-10 p-b-2">
         <button type="submit" class="btn btn-lime btn-block btn-lg">Quick Post</button>
        </div>
        <p class="help-block text-muted f-s-11 m-b-0">
         <span class="text-danger">*</span> Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
         ridiculus mus.
        </p>
       </form>
      </div>
     </div>
     <!-- end widget -->
    </div>
    <!-- end col-4 -->
    <!-- begin col-4 -->
    <div class="col-lg-4">
     <!-- begin widget -->
     <div class="widget">
      <div class="widget-header bg-inverse-dark">
       <h4 class="text-white">Task Lists</h4>
      </div>
      <div class="widget-body p-0">
       <div data-scrollbar="true" data-height="347px">
        <ul class="widget-task-list">
         <li>
          <h4>Mobile App Development</h4>
          <p>Due: 12 November 2015</p>
          <div class="progress progress-sm">
           <div class="progress-bar progress-bar-success" style="width: 80%">80%</div>
          </div>
         </li>
         <li>
          <h4>UI Element Improvement</h4>
          <p>Due: 06 December 2015</p>
          <div class="progress progress-sm">
           <div class="progress-bar progress-bar-warning" style="width: 50%">50%</div>
          </div>
         </li>
         <li>
          <h4>New Server Installation</h4>
          <p>Due: 10 December 2015</p>
          <div class="progress progress-sm">
           <div class="progress-bar progress-bar-danger" style="width: 20%">20%</div>
          </div>
         </li>
         <li>
          <h4>Windows 10 Installation</h4>
          <p>Due: 12 December 2015</p>
          <div class="progress progress-sm">
           <div class="progress-bar progress-bar-grey" style="width: 10%">10%</div>
          </div>
         </li>
         <li>
          <h4>Business Proposal Preparation</h4>
          <p>Due: 15 December 2015</p>
          <div class="progress progress-sm">
           <div class="progress-bar progress-bar-primary" style="width: 90%">90%</div>
          </div>
         </li>
        </ul>
       </div>
      </div>
     </div>
     <!-- end widget -->
    </div>
    <!-- end col-4 -->
   </div>
   <!-- end row -->

   <?php require 'footer.php'; ?>
  </div>
  <!-- end #content -->
  <?php require 'sidebar-right.php'; ?>

 </div>
 <div class="sidebar-bg sidebar-right"></div>
 <!-- end #sidebar-right -->
 </div>
 <!-- end page container -->



 <?php require 'script.php'; ?>
</body>

</html>