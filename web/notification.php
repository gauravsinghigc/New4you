<?php
require 'files.php';
if (!isset($_SESSION['customer_id'])) {
   header("location: index.php?msg=logout");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $store_name;?> :  Notification</title>
     <?php require 'header_files.php';?>
   </head>
   <body>
      <?php require 'header.php';?>
      <section class="account-page section-padding">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-11 mx-auto">
                  <div class="row no-gutters">
                     <div class="col-md-4">
                        <div class="card account-left">
                            <?php include 'account_section.php';?>
                           <div class="list-group" style="font-size: 14px;">
                              <a href="account.php" class="list-group-item list-group-item-action">
                                 <i aria-hidden="true" class="fa fa-user"></i>  My Account</a>
                              <a href="address.php" class="list-group-item list-group-item-action">
                                 <i aria-hidden="true" class="fa fa-map-marker"></i>  My Address</a>
                              <a href="order_list.php" class="list-group-item list-group-item-action">
                                 <i aria-hidden="true" class="fa fa-shopping-cart"></i> My Orders</a>
                              <a href="rewards.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-star"></i> Reward Points</a>
                              <a href="wallet.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-square"></i> 24kharido Funds</a>
                              <a href="refer.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-share"></i> Refer & Earns</a>
                              <a href="notification.php" class="list-group-item list-group-item-action active"><i aria-hidden="true"
                                    class="fa fa-bell"></i> Notification</a>

                              <a href="logout.php" class="list-group-item list-group-item-action">
                                 <i aria-hidden="true" class="fa fa-sign-out"></i>  Logout</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="card card-body account-right">
                           <div class="widget">
                              <div class="section-header">
                                 <h5 class="heading-design-h5">
                                    <i class="fa fa-bell text-info mt-0"></i> Notification
                                    <span class='text-success float-right'><?php if(isset($_GET['msg'])){ echo  $_GET['msg']; }?></span>
                                    <hr>
                                 </h5>
                              </div>
                                <section class="container-fluid">
   <div class="row">

     <div class="col-12 col-xs-12 col-sm-12" style='padding-left:1%; padding-right:1%;'>
<?php 
$customer_id = $_SESSION['customer_id'];
$READNOTIFICATION = "UPDATE notifications SET notification_status='READ', read_time=CURRENT_TIMESTAMP where customer_id='$customer_id' and notification_status='NEW'";
$Query = mysqli_query($con, $READNOTIFICATION);
if($Query == true){

     $sql = "SELECT * FROM notifications where customer_id='$customer_id' ORDER BY notification_id DESC LIMIT 0, 16";
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

       <p style="font-size: 12.5px;
    background-color: #f7f7f7;
    padding: 1%;
    color: black;
    margin-bottom: 1%;
    text-align: justify;
    cursor: pointer;
    box-shadow: 0px 0px 1px grey;" onclick="ShowMsg<?php echo $notification_id;?>()">
        <i class="fa fa-bell text-success"></i> <b><?php echo $notification_title;?></b><br>
          <span style="float: right;
          margin-top: -4%;
    margin-bottom: -5px;
    font-size: 11px;"><i class="fa fa-clock-o"></i> <?php echo $NotificationSendTime;?></span>
       <span style="margin-top: 2.7vw;"><?php echo $notification_desc;?></span>
       </p>
<script type="text/javascript">
  function ShowMsg<?php echo $notification_id;?>(){
    var NOTDETAILS<?php echo $notification_id;?> = document.getElementById("NOTDETAILS<?php echo $notification_id;?>");
    if(NOTDETAILS<?php echo $notification_id;?>.style.display == "none"){
      NOTDETAILS<?php echo $notification_id;?>.style.display = "block";
    } else {
      NOTDETAILS<?php echo $notification_id;?>.style.display = "none";
    }
  }
</script>
<div style="padding: 2%;
    border-radius: 25px;
    box-shadow: grey 0px 0px 50px;
    position: fixed;
    top: 1%;
    right: 0;
    left: 5%;
    z-index: 12;
    font-size: 11px;
    color: black !important;
    width: 70% !important;
    min-width: 200px;
    background-color: white;
    text-align:justify;
    display: none;" id="NOTDETAILS<?PHP ECHO $notification_id;?>">
    <h5><i class="fa fa-bell"></i><spna class="text-primary"> Notification </spna>
      <span style="clear: right;float: right;"><i class="fa fa-send"></i> <?php echo $NotificationSendTime;?> </span></h5>
      <p style="color: black;font-size: 13px;">
        <span style="float: right"><i class="fa fa-info-circle"></i> ID<?php echo $notification_id;?></span>
        <b>Notification Title <i class="fa fa-angle-right"></i></b> <?php echo $notification_title;?><br>
        <b>Sent at:</b> <?php echo $NotificationSendTime;?><br>
        <b>Read at:</b> <?php echo $NotificationReadTime;?><br><br>
        <b><i class="fa fa-envelope"></i></b> <?php echo $notification_desc;?>   

        <hr>
       <span class="btn btn-lg btn-danger float-right" onclick="ShowMsg<?php echo $notification_id;?>()" style="cursor: pointer;"><i class="fa fa-times"></i> Close</span>   
      </p>
  </div>

     <?php } } ?>



       
     </div>
   </div>
 </section>

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php
      require 'footer.php';?>


</body></html>

<div class="modal fade login-modal-main" id="upload-profile-image">
         <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-body">
                  <div class="login-modal">
                     <div class="row">
                        <div class="col-lg-12 pad-left-0">
                           <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true"><i class="fa fa-times"></i></span>
                           <span class="sr-only">Close</span>
                           </button>
                              <div class="login-modal-right">
                                    <div class="tab-pane" role="tabpanel">
                                       <h5 class="heading-design-h5"> <i class="fa fa-user text-info"></i> Upload Profile Image</h5>
                                     <form action="insert.php" method="POST" enctype="multipart/form-data">
                                     <input type="text" name="customer_id" value="<?php echo $customer_id;?>" hidden>
                                      <fieldset class="form-group">
                                         <input type="FILE" class="form-control" name="customer_image_uplaod" placeholder="Full Name" required="" accept="image/*" style="padding: 1% !important;">
                                         <span><code>*</code> Image Ratio 1x1 (SQAURE Image)</span><br>
                                         <span><code>*</code> Only Image formate are accepted like png, jpg, jpeg, gif.</span>
                                       </fieldset>
                                       <fieldset class="form-group">
                                          <button type="submit" name="upload_customer_dp" class="btn btn-lg btn-secondary btn-block"><i class='fa fa-upload'></i>Upload</button>
                                       </fieldset>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
