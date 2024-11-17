<?php require 'files.php'; require 'session.php'; ?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php';?>

  <!-- header part end -->
  <br>
  <section class="container-fluid">
   <div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12 p-1 bg-success">
     <h5 class="font-7 text-white"><i class="fa fa-shopping-cart"></i> Sell Items <i class="fa fa-angle-right"></i>
      <a href="add_funds.php" class="btn btn-info btn-block fixed-bottom bottom-p bottom-text text-white disabled"><i class="fa fa-plus mt-0"></i> Sell Item</a>
     </h5>
    </div>
   </div>
  </section>

  <section class="container-fluid">
   <div class="row">
    <div class="col-12 mt-3">
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

  <?php GSI_footer_files();?>
 </body>

</html>
