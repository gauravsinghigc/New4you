<?php require 'files.php'; require 'session.php';
if(!isset($_SESSION['customer_id'])){
header("location: index.php?msg=You are Logout, Please login first!");
}
  $customer_id = $_SESSION['customer_id'];
$sql = "SELECT * from customers where customers.customer_id='$customer_id' ";
$query = mysqli_query($con, $sql);
$count_address = mysqli_num_rows($query);
$fetch = mysqli_fetch_assoc($query);
 $customer_name = $fetch['customer_name'];
 $customer_mail_id = $fetch['customer_mail_id'];
 $customer_phone_number = $fetch['customer_phone_number'];
 $customer_password= $fetch['customer_password'];
 $cust_dp = $fetch['customer_image'];
 $arealocality = $fetch['arealocality'];
 $custaddress = $fetch['custaddress'];
 $custcity = $fetch['custcity'];
 $custstate = $fetch['custstate'];
 $custpincode = $fetch['custpincode'];
 $contactperson = $fetch['contactperson'];
 $alternatenumber = $fetch['alternatenumber']; 

?>
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
    <div class="col-md-12 col-12 bg-success p-1">
     <h4 class="font-7 text-white"><i class="fa fa-star fa-spin text-warning"></i> My Rewards <i class="fa fa-angle-right"></i></h4>
     <?php 
         if (isset($_GET['msg'])) {
                $msg = $_GET['msg'];
                 echo "<p class='text-success'>$msg";
                 echo '<button onclick="remove_msg()" href="#" class="btn btn-link float-right close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-times" style="margin-top: -10px;color:red; "></i></button></p>';   
                }  elseif (isset($_GET['err'])) {
                    $err= $_GET['err'];
                 echo "<p class='text-danger'>$err";
                 echo '<button onclick="remove_msg()" href="#" class="btn btn-link float-right close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-times" style="margin-top: -10px;color:red; "></i></button></p>';
                }      
        ?>
    </div>
   </div>
  </section>

  <section class="container-fluid pb-2 mt-0">
   <div class="row p-1">
    <div class="col-lg-12 pt-2" style='box-shadow:0px 0px 1px grey;background-color: #1a5cae0d;'>
     <h2><i class="fa fa-star text-success"></i>
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
     </h2>
     <p class="font-5">
      <span class="float-right font-5" style='color:black;float: right;'><b>1 Points = <i class="fa fa-inr"></i> 1</b></span>
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
      <a href="redeem.php" class="text-info mt-3">How to Redeem?</a>

      <?php
     if($TotalActiveRewards >= 1){ ?>
      <a href="index.php?msg=Reward Points are Redeemed at Checkout." class="btn btn-md fixed-bottom bottom-text text-white btn-success bottom-p">
       Redeem
      </a><br>
      <?php } else { ?>
      <span class="float-right" style="float: right">Minimum Point : 1 Points</span>
      <a href="" class="btn btn-md fixed-bottom bottom-text bottom-p text-white btn-danger"> Redeem Not Applicable </a>
      <br>
      <?php } ?>
      <br>
     </p>
    </div>
   </div>
  </section>

  <section class="container-fluid">
   <div class="row">
    <div class="col-12">
     <br>
     <p>Reward History!</p>
    </div>

    <div class="col-12">
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
        <i class="fa fa-star text-success"></i> <?php echo $rewards_point;?> Points
       </td>
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
        <i class="fa fa-star text-success"></i> <?php echo $rewardspoints;?> Points
       </td>
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
       $reward_date = $fetch['reward_date'];?>

     <table style="width: 100%; font-size: 12px;">
      <tr>
       <td align="left">#<?php echo $order_id;?><br>
        <i class="fa fa-star text-success"></i> <?php echo $rewards_point;?> Points
       </td>
       <td align="right"><i class="fa fa-calendar"></i> <?php echo $reward_date;?><br><span class='text-success' style="float: right;">REEDEMED</span></td>
      </tr>
     </table>
     <hr class="mt-1 mb-2">
     <?php } ?>

    </div>
   </div>
  </section>

  <br><br><br><br>

  <?php GSI_footer_files();?>
 </body>

</html>
