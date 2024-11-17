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
                              <a href="rewards.php" class="list-group-item list-group-item-action"><i aria-hidden="true"
                                    class="fa fa-star"></i> Reward Points</a>
                              <a href="wallet.php" class="list-group-item list-group-item-action active"><i aria-hidden="true"
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
                        <div class="card card-body account-right disabled" style="opacity: 0.6;">
                           <div class="widget">
                              <div class="section-header">
                                 <h5 class="heading-design-h5">
                                    <i class="fa fa-inr text-success mt-0"></i> 24kharido Funds
                                    <span class='text-success float-right'><?php if(isset($_GET['msg'])){ echo  $_GET['msg']; }?></span>
                                    <a href="add_funds.php" class="btn btn-success btn-md float-right text-white disabled" style="float: right;background-color: #69b769;
    position: absolute;
    right: 2%;
    top: 1.5%;
    color: white;" disabled="" readonly=""><i class="fa fa-inr"></i> Add Funds</a>
                                    <hr>
                                 </h5>
                              </div>
                                 <section class="container-fluid pb-2">
  <div class="row">
   <div class="col-lg-12" style='background-image: url("img/wallet.png");background-size: cover;padding-bottom: 10vw;
    background-repeat: no-repeat;' >
      <h1><i class="fa fa-inr text-success"></i> 000</h1>
    </div>
  </div>
 </section>

 <section class="container-fluid">
   <div class="row">
     <div class="col-12" style="padding-right: 0%; padding-left: 0%;">
       <h4><i class="fa fa-exchange"></i> Wallet History!</h4>
       <img src="img/SP0y.txt" style="width: 100%; opacity: 1 !important;">
     </div>

     <div class="col-12" style='padding-left:2%; padding-right:2%;'>
<!--<?php 
     $sql = "SELECT * FROM customer_rewards where customer_id='$customer_id' and reward_status='active' ORDER BY rewards_id DESC";
     $query = mysqli_query($con, $sql);
     while($fetch = mysqli_fetch_assoc($query)){
       $order_id = $fetch['order_id'];
       $rewards_point = $fetch['rewards_point'];
       $reward_date = $fetch['reward_date'];
       $order_id = $fetch['order_id']; ?>

       <p style="padding:2%;font-size:12px;">
        <span class="float-left" style="float: left;"><?php echo $order_id;?><br>
        <i class="fa fa-star text-success"></i> <?php echo $rewards_point;?> Points</span><br>
       <span class="float-right" style="float: right;margin-top: -17px;"><i class="fa fa-calendar"></i> <?php echo $reward_date;?><br><span class='text-success' style="float: right;">Earned</span></span>
       <hr></p>

     <?php } ?>
      <?php 
       $sql = "SELECT * FROM customer_orders where customer_id='$customer_id' and coupon_code='REWARD_POINTS'";
       $query = mysqli_query($con, $sql);
       while ($fetch = mysqli_fetch_assoc($query)){
        $rewardspoints = $fetch['rewardspoints'];
        $rewardsamount = $fetch['rewardsamount'];
        $order_date = $fetch['order_date'];
        $order_id = $fetch['rewardsamount']; ?>
        <p style="padding:2%;font-size:12px;">
       <span><i class="fa fa-star text-success"></i> <?php echo $rewardspoints;?> Points</span>
       <span class="float-right" style="float: right"><i class="fa fa-calendar"></i> <?php echo $order_date;?> </span>
       <span class="float-right text-info" style='clear:both;float: right'>Redeemed</span>
       <hr></p>
       <?php }
      ?>
     
     

     <?php 
     $sql = "SELECT * FROM customer_rewards where customer_id='$customer_id' and reward_status='Redeemed' ORDER BY rewards_id DESC";
     $query = mysqli_query($con, $sql);
     while($fetch = mysqli_fetch_assoc($query)){
       $order_id = $fetch['order_id'];
       $rewards_point = $fetch['rewards_point'];
       $reward_date = $fetch['reward_date']; ?>

       <p style="padding:2%;font-size:12px;">
       <span><i class="fa fa-star text-success"></i> <?php echo $rewards_point;?> Points</span>
       <span class="float-right" style="float: right;"><i class="fa fa-calendar"></i> <?php echo $reward_date;?> </span>
       <span class="float-right text-success" style='clear:both; float: right;'>Earned</span>
       <hr></p>

     <?php } ?> -->



       
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
