<?php require 'files.php'; require 'session.php';?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php';?>
  <br>
  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12 bg-success p-1">
     <h4 class="font-7 text-white"><i class="fa fa-share"></i> My Referances <i class="fa fa-angle-right"></i>
     </h4>
    </div>
   </div>
  </section>

  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 text-center">
     <input type="text" value="<?php echo $MUrl;?>?ref=KH<?php echo $customer_id;?>RIDO" class="form-control text-center tr-input bg-white" id="myInput<?php echo $customer_id;?>" readonly="">
     <br>
     <button onclick="urlcopy<?php echo $customer_id;?>()" id='button<?php echo $customer_id;?>' class='btn btn-sm btn-primary p-2 pl-3 pr-3'><span id="Text<?php echo $customer_id;?>">Copy
       Link</span></button>
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
    border-width: thick;
    background-color:white;">
       <td style="width: 10%;" align="left">
        <img src="img/user.png" style="width: 80%;border-radius: 50%;">
       </td>
       <td style="font-size: 13px;width: 70%;position: absolute;" align="left">
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
       <td style="width: 20%; font-size: 12px;" align="right">
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
   document.getElementById("button<?php echo $customer_id;?>").className = "btn-danger btn btn-sm btn p-2 pr-3 pl-3";
  }
  </script>

  <br><br><br><br>

  <?php GSI_footer_files();?>
 </body>

</html>
