<?php require 'files.php'; require 'session.php';?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php';?>

  <!-- header part end -->
  <br>
  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 bg-success p-1">
     <h5 class="font-7 text-white"><i class="fa fa-bell text-warning"></i> ALL Notification <i class="fa fa-angle-right"></i></h5>
    </div>
    <div class="col-sm-12">
     <p class="mt-1 mb-1"><code>*</code> Click on Notification to know details...</p>
    </div>
   </div>
  </section>
  <section class="container-fluid">
   <div class="row">
    <div class="col-12 col-xs-12 col-sm-12" style='padding-left:1%; padding-right:1%;'>
     <?php 
$customer_id = $_SESSION['customer_id'];
$READNOTIFICATION = "UPDATE notifications SET notification_status='READ', read_time=CURRENT_TIMESTAMP where customer_id='$customer_id' and notification_status='NEW'";
$Query = mysqli_query($con, $READNOTIFICATION);
if($Query == true){

     $sql = "SELECT * FROM notifications where customer_id='$customer_id' ORDER BY notification_id DESC";
     $query = mysqli_query($con, $sql);
     while($fetch = mysqli_fetch_assoc($query)){
       $notification_id = $fetch['notification_id'];
       $notification_title = $fetch['notification_title'];
       $notification_date = $fetch['notification_date'];
       $notification_desc = $fetch['notification_desc'];
       $notification_status = $fetch['notification_status'];
       $read_time = $fetch['read_time'];
       $NotificationReadTime = date("D d M, Y h:m A", strtotime($read_time));
       $NotificationSendTime = date("D d M, Y h:m A", strtotime($notification_date)); ?>

     <p style="font-size: 12px;
    background-color: #f7f7f7;
    padding: 2%;
    margin-bottom: 1.5vw;
    box-shadow: 0px 0px 0.5px grey;
    border-radius: 9px;" onclick="ShowMsg<?php echo $notification_id;?>()" class="table-striped">
      <i class="fa fa-bell text-success"></i> <b><?php echo $notification_title;?></b><br>
      <span style="float: right;margin-top: -4vw;
    margin-bottom: -5px;
    font-size: 10px;"><i class="fa fa-clock-o"></i> <?php echo $NotificationSendTime;?></span>
      <span style="margin-top: 2.7vw;"><?php echo $notification_desc;?></span>
     </p>
     <script type="text/javascript">
     function ShowMsg<?php echo $notification_id;?>() {
      var NOTDETAILS<?php echo $notification_id;?> = document.getElementById("NOTDETAILS<?php echo $notification_id;?>");
      if (NOTDETAILS<?php echo $notification_id;?>.style.display == "none") {
       NOTDETAILS<?php echo $notification_id;?>.style.display = "block";
      } else {
       NOTDETAILS<?php echo $notification_id;?>.style.display = "none";
      }
     }
     </script>
     <div style="padding: 5%;
    border-radius: 25px;
    box-shadow: grey 0px 0px 15px;
    position: fixed;
    bottom: 0vw;
    right: 0;
    left: 0;
    z-index: 12;
    font-size: 14px;
    width: 100% !important;
    background-color: white;
    display: none;" id="NOTDETAILS<?PHP ECHO $notification_id;?>" class="pl-3 pr-3 pt-5 pb-3">
      <h6><i class="fa fa-bell"></i>
       <spna class="text-primary"> Notification </spna>
       <span style="clear: right;float: right;"><i class="fa fa-send"></i> <?php echo $NotificationSendTime;?> </span>
      </h6>
      <p>
       <span style="float: right"><i class="fa fa-info-circle"></i> ID<?php echo $notification_id;?></span>
       <b>Notification Title <i class="fa fa-angle-right"></i></b> <?php echo $notification_title;?><br>
       <b>Sent at:</b> <?php echo $NotificationSendTime;?><br>
       <b>Read at:</b> <?php echo $NotificationReadTime;?><br><br>
       <b><i class="fa fa-envelope"></i></b> <?php echo $notification_desc;?>
       <hr>
       <span class="btn btn-lg btn-block btn-danger float-right" onclick="ShowMsg<?php echo $notification_id;?>()"><i class="fa fa-times"></i> Close</span>
      </p>
     </div>

     <?php } } ?>

    </div>
   </div>
  </section>
  <hr>
  <center>
   <spna>That's All for Now</spna>
  </center>
  <br><br><br><br><br>

  <?php GSI_footer_files();?>
 </body>

</html>
