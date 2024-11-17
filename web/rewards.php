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
      <title><?php echo $store_name;?> :  Reward Points</title>
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
                              <a href="rewards.php" class="list-group-item list-group-item-action active"><i aria-hidden="true"
                                    class="fa fa-star"></i> Reward Points</a>
                              <a href="wallet.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-square"></i> 24kharido Funds</a>
                              <a href="refer.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-share"></i> Refer & Earns</a>
                              <a href="notification.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
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
                                    <i class="fa fa-star text-warning mt-0"></i> Reward Points
                                    <span class='text-success float-right'><?php if(isset($_GET['msg'])){ echo  $_GET['msg']; }?></span>
                                    <hr>
                                 </h5>
                              </div>
                                 <section class="container-fluid pb-2">
  <div class="row p-1">
   <div class="col-lg-12 pt-2" style='box-shadow:0px 0px 1px grey;background-color: #1a5cae0d;' >
      <h3 class="mt-4 font-4"><i class="fa fa-star text-success"></i> 
      <?php 
$select = "SELECT sum(rewards_point) FROM customer_rewards where customer_id='$customer_id' and reward_status='active'";
        $action = mysqli_query($con, $select);
        while ($record = mysqli_fetch_array($action)) {
          $TotalActiveRewards = $record['sum(rewards_point)'];
        }
         if($TotalActiveRewards == 0){
           echo "0";
         } else {
           echo $TotalActiveRewards;
         }
         
      ?>
      <small> Points</small>
      </h3>
      <p class="font-2">
       <span class="float-right font-3" style='color:black;float: right;'><b>1 Points = <i class="fa fa-inr"></i> 1</b></span>
      <b>My Rewards :</b><br> <?php 
$select = "SELECT sum(rewards_point) FROM customer_rewards where customer_id='$customer_id' and reward_status='active'";
        $action = mysqli_query($con, $select);
        while ($record = mysqli_fetch_array($action)) {
          $TotalActiveRewards = $record['sum(rewards_point)'];
        }
         if($TotalActiveRewards == 0){
           echo "0";
         } else {
           echo $TotalActiveRewards;
         }
      ?> Points = <i class="fa fa-inr"></i> 
      
      <?php 
$select = "SELECT sum(rewards_point) FROM customer_rewards where customer_id='$customer_id' and reward_status='active'";
        $action = mysqli_query($con, $select);
        while ($record = mysqli_fetch_array($action)) {
          $TotalActiveRewards = $record['sum(rewards_point)'];
        }
         if($TotalActiveRewards == 0){
           echo "0";
         } else {
           echo $TotalActiveRewards;
         }
      ?><br>
      <a href="redeem.php" class="text-black" style="color: black;">How to Redeem?</a>
      
     
     <?php
     if($TotalActiveRewards >= 1){ ?> 
       <a href="index.php?msg=Reward Points are Redeemed at Checkout." class="btn btn-md text-white bottom-text p-3 btn-success float-right"> 
      Redeem
      </a><br>
     <?php } else { ?>
     <span class="float-right" style="float: right">Minimum Point : 1 Points</span>
     <a href="" class="btn btn-md text-white btn-danger float-right"> Redeem Not Applicable </a>
     <br>
     <?php } ?>
      <br>
      </p>
    </div>
  </div>
 </section>

 <section class="container-fluid">
   <div class="row">
     <div class="col-12" style="padding-right: 0%; padding-left: 0%;">
       <h4><i class="fa fa-exchange"></i> Reward History!</h4>
     </div>

     <div class="col-12" >
<?php 
     $sql = "SELECT * FROM customer_rewards where customer_id='$customer_id' and reward_status='active' ORDER BY rewards_id DESC";
     $query = mysqli_query($con, $sql);
     while($fetch = mysqli_fetch_assoc($query)){
       $order_id = $fetch['order_id'];
       $rewards_point = $fetch['rewards_point'];
       $reward_date = $fetch['reward_date'];
       $order_id = $fetch['order_id']; ?>
<table style="width: 100%; font-size: 12px;">
  <tr>
    <td align="left">#<?php echo $order_id;?><br>
     <i class="fa fa-star text-success"></i> <?php echo $rewards_point;?> Points</td>
    <td align="right"><i class="fa fa-calendar"></i> <?php echo $reward_date;?><br><span class='text-success' style="float: right;">Earned</span></td>
  </tr>
</table>
<hr class="mt-1 mb-2">

     <?php } ?>
      <?php 
       $sql = "SELECT * FROM customer_orders where customer_id='$customer_id' and coupon_code='REWARD_POINTS'";
       $query = mysqli_query($con, $sql);
       while ($fetch = mysqli_fetch_assoc($query)){
        $rewardspoints = $fetch['rewardspoints'];
        $rewardsamount = $fetch['rewardsamount'];
        $order_date = $fetch['order_date'];
        $order_id = $fetch['order_id']; ?>
        <table style="width: 100%; font-size: 12px;">
  <tr>
    <td align="left">#<?php echo $order_id;?><br>
     <i class="fa fa-star text-success"></i> <?php echo $rewardspoints;?> Points</td>
    <td align="right"><i class="fa fa-calendar"></i> <?php echo $order_date;?><br><span class='text-info' style="float: right;">REEDEMED</span></td>
  </tr>
</table>
<hr class="mt-1 mb-2">
       <?php }
      ?>
     
     

     <?php 
     $sql = "SELECT * FROM customer_rewards where customer_id='$customer_id' and reward_status='Redeemed' ORDER BY rewards_id DESC";
     $query = mysqli_query($con, $sql);
     while($fetch = mysqli_fetch_assoc($query)){
       $order_id = $fetch['order_id'];
       $rewards_point = $fetch['rewards_point'];
       $reward_date = $fetch['reward_date']; ?>

       <table style="width: 100%; font-size: 12px;">
  <tr>
    <td align="left">#<?php echo $order_id;?><br>
     <i class="fa fa-star text-success"></i> <?php echo $rewards_point;?> Points</td>
    <td align="right"><i class="fa fa-calendar"></i> <?php echo $reward_date;?><br><span class='text-success' style="float: right;">REDEEMED</span></td>
  </tr>
</table>
<hr class="mt-1 mb-2">
     <?php } ?>



       
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
