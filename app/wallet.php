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
  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12 bg-success p-1">
     <h5 class="font-7 text-white"><i class="fa fa-inr"></i> My Wallet <i class="fa fa-angle-right"></i>
      <a href="add_funds.php" class="btn btn-success float-right text-white disabled bottom-text bottom-p btn-block fixed-bottom"><i class="fa fa-inr"></i> Add Funds</a>
     </h5>
    </div>
   </div>
  </section>

  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-lg-12" style='background-image: url("img/wallet.png");background-size: cover;padding-bottom: 10vw;
    background-repeat: no-repeat;padding: 5%;'>
     <h1><i class="fa fa-inr text-success"></i> 000</h1>
    </div>
   </div>
  </section>

  <section class="container-fluid">
   <div class="row">
    <div class="col-12">
     <h6><i class="fa fa-exchange"></i> Wallet History!</h6>
     <img src="img/SP0y.txt" style="width: 100%; opacity: 1 !important;">
    </div>
    <div class="col-12">
     <h6>24kharido Funds</h6>
     <p>Advance Funds or Cashback funds which you use on order purchase, bill & Recharges and All types Payment Solutions.</p>
     <h6><b>What you do with 24kharido Funds</b></h6>
     <ul>
      <li>Purchase anything at 24kharido App or Website.</li>
      <li>Recharge, DTH, or other Bill Payments.</li>
      <li>Transfer into your account/wallet/UPI.</li>
     </ul>
     <form action="" method="POST">
      <input type="text" name="customer_id" value="<?php echo $customer_id;?>" hidden="">
      <input type="text" name="interest_type" value="24kharido Funds" hidden="">
      <?php
               if(!isset($_SESSION['customer_id'])){ ?>
      <a href="login.php" class="btn btn-success btn-sm" style='background-color: cornflowerblue;'>
       <i class="fa fa-check-circle text-white"></i> Login To Show Interest
      </a>
      <?php } else { 
                  $sql = "SELECT * from interest where customer_id='$customer_id' and interest_type='24kharido Funds'";
                  $query = mysqli_query($con, $sql);
                  $CountInterest = mysqli_fetch_assoc($query);
                  if($CountInterest == 0){?>
      <button type="submit" name="SUBMIT_INTEREST" class="btn btn-success btn-md bottom-text bottom-p d-block mx-auto" style='background-color: cornflowerblue;'><i
        class="fa fa-check-circle text-white"></i> Show
       Interest</button>
     </form>
     <?php } else { ?>
     <br>
     <button class="btn btn-outline-success btn-md font-3 d-block mx-auto disabled bottom-text bottom-p"><i class="fa fa-check-circle text-success"></i> Interest Submited</button>
     <?php } } ?>
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

  <?php
if(isset($_POST['SUBMIT_INTEREST'])){
  $customer_id = $_POST['customer_id'];
  $interest_type = $_POST['interest_type'];
  $date_time = date("D d M, Y");

  $sql = "INSERT INTO interest (customer_id, interest_type, submitdate) VALUES ('$customer_id', '$interest_type', '$date_time')";
  $query = mysqli_query($con, $sql);
  if($query == true){ ?>
  <meta http-equiv="refresh" content="1, wallet.php?msg=Thanks for Showing Your Interest in 24kharido Funds.">
  <?php }
      }

      ?>

  <?php GSI_footer_files();?>
 </body>

</html>
