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
      <title><?php echo $store_name;?> :  Refer & Earn</title>
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
                              <a href="refer.php" class="list-group-item list-group-item-action active"><i aria-hidden="true"
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
                                    <i class="fa fa-users text-info mt-0"></i> Refer & Earn
                                    <span class='text-success float-right'><?php if(isset($_GET['msg'])){ echo  $_GET['msg']; }?></span>
                                    <span style="float: right;"><i class="fa fa-star text-success"></i> <?php 
              $select = "SELECT sum(rewards_point) FROM customer_rewards where customer_id='$customer_id' and order_id='REFERRED POINTS'";
                                  $action = mysqli_query($con, $select);
                                   while ($record = mysqli_fetch_array($action)) {
                                    $paid_amount= $record['sum(rewards_point)'];
                                    if($paid_amount == 0){
                                      echo $paid_amount = 0;
                                    } else {
                                    echo  $paid_amount = $paid_amount;
                                    }
                             } ?> Points</span>
                                    <hr>
                                 </h5>
                              </div>
                                 <section class="container-fluid pb-2">
        <div class="row">
          <div class="col-lg-12 col-sm-12 col-md-12 text-center">
            <input type="text" value="https://24kharido.in/?ref=KH<?php echo $customer_id;?>RIDO" class="form-control text-center" id="myInput<?php echo $customer_id;?>" readonly="">
            <br>
            <button onclick="urlcopy<?php echo $customer_id;?>()" id='button<?php echo $customer_id;?>' class='btn btn-sm btn-primary'><span id="Text<?php echo $customer_id;?>">Copy Link</span></button>
            <br>
            <br>
          </div>
          <div class="col-md-12 col-xs-12 col-sm-12 rewwarsds">  
    <hr style="margin-top: 0.5%;margin-bottom: 0.5%;">
            <table style="width: 100%;">
              <?php 
                             $sql = "SELECT * from referred_person where customer_id='$customer_id'";
                             $query = mysqli_query($con, $sql);
                             $count = mysqli_num_rows($query);
                             if($count == 0){
                              echo "<tr><td align='center'><h4><br><br>No Any Refered Person!</h4></td></tr>";
                             } else {
                             while ($fetch = mysqli_fetch_assoc($query)){
                             $referred_phone[] = $fetch['referred_phone'];
                             } 
                             foreach($referred_phone as $PERSON_PHONE){
                             $sql = "SELECT * FROM customers where customer_phone_number='$PERSON_PHONE'";
                             $query = mysqli_query($con, $sql);
                             $fetch = mysqli_fetch_assoc($query);
                             $customer_id_new = $fetch['customer_id'];
                             $customer_name_new = $fetch['customer_name'];

                             $select = "SELECT sum(net_payable_amount) FROM customer_orders where customer_id='$customer_id_new' and payment_status='PAID'";
                                  $action = mysqli_query($con, $select);
                                   while ($record = mysqli_fetch_array($action)) {
                                    $paid_amount= $record['sum(net_payable_amount)'];
                                    if($paid_amount == 0){
                                      $paid_amount = 0;
                                    } else {
                                      $paid_amount = $paid_amount;
                                    }
                             } 
                             


                             if($paid_amount < 1000){
                               $percentage = $paid_amount/1000*100;
                               $percentage = $percentage."%";
                             } elseif($paid_amount > 1000) {
                                $percentage = "100%";
                             } else {
                              $percentage = "none";
                             } 
                           
                              if($paid_amount > 1000){
                                $reward_date = date("D d M, Y");
                                $sql = "SELECT * from customer_rewards where customer_id='$customer_id' and order_id='REFERRED POINTS' and reward_by='$customer_id_new'";
                                $query = mysqli_query($con, $sql);
                                $fetch = mysqli_fetch_assoc($query);
                                if($fetch == true){

                                } else {
                                $sql = "INSERT INTO customer_rewards (customer_id, order_id, store_id, rewards_point, reward_date, reward_status, reward_by) VALUES ('$customer_id', 'REFERRED POINTS', '1', '100', '$reward_date', 'active', '$customer_id_new')";
                              
                                $query = mysqli_query($con, $sql);
                                if($query == true){
                                   $paid_amount_t = 1000;
                                } else {
                                   $paid_amount_t = $paid_amount;
                                }
                              }
                              } else {
                                
                              }

                             ?>
                              <tr style="border-bottom-style: groove;
    border-color: #eaeaea82;
    border-width: thin;
    height: 60px;">
                                 <td style="width: 10%;" align="left">
                                  <img src="img/user.png" style="width: 60%; border-radius: 50%;">
                                 </td>
                                 <td style="font-size: 14px;width: 70%;position: absolute;" align="left">
                                  <?php if($customer_name_new == null){ echo "$PERSON_PHONE";} else { echo "<b>$customer_name_new</b> <i class='fa fa-angle-right'></i> $PERSON_PHONE";} ?>
                                  <div class="w3-light-grey" style="height: 12px;border-radius: 10px;">
                                       <div class="w3-container w3-blue" style="width:<?php echo $percentage;?>; height: 12px;font-size: 10px;border-radius: 10px;">
                                      </div>
                                       <i class="fa fa-inr" style="position: absolute;
    margin-top: 0.4%;color: grey;"> <?php if($paid_amount <= 1000 or $paid_amount == 0){
                             echo   $paid_amount = $paid_amount;
                             } else {
                              echo $paid_amount = 1000;
                             } ?></i>
                             <span style="float: right;color: grey;"><i class="fa fa-inr"></i> 1000 </span>
                                    </div> 
                                    <span style="float: left;"></span>

                                 </td>
                                 <td style="width: 20%; font-size: 14px;" align="right">
                                  <i class="fa fa-star text-success" style="font-size: 10px;"></i>100 Points<br>
                                  <?php if ($percentage == 100) { echo "<span class='text-success'> Earned</span>"; } else { echo "<span class='text-danger'>Not Earned</span>"; } ?>
                                 </td>
                              </tr>
                             <?php } }
              ?>
            </table>
          </div>
        </div>
      </section>
      <script>
function urlcopy<?php echo $customer_id;?>() {
  var copyText = document.getElementById("myInput<?php echo $customer_id;?>");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
 document.getElementById("Text<?php echo $customer_id;?>").innerHTML = "Link Copied";
  document.getElementById("button<?php echo $customer_id;?>").className = "btn-danger btn btn-sm btn";
}
</script>

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
