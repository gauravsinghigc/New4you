<?php require 'files.php'; require 'session.php'; ?>
<html style="<?php echo $ThemeColor;?>">

 <head>
  <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title>
  <?php GSI_header_files();?>
 </head>

 <body>
  <?php include 'header.php'; GetMsg();?>
  <?php CreateSlider("CUSTOM");?><br>
  <section class="container-fluid pb-2">
   <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-12 d-block mx-auto bg-success p-1">
     <h4 class="font-7 text-white"><i class="fa fa-shopping-cart"></i> Create Custom Order</h4>
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12 col-12 d-block mx-auto">
     <br>
     <img src="img/SP0y.txt" class="img-fluid">
     <h4 class="text-center">Custom Ordering Process is Coming Soon...</h4>
     <p class="text-center font-2">You can show your interest and get extra benefits or Reward Point at Custom Order Creating.</p>
     <h5 class="font-3">Benefits of Custom Order Interest Submit.</h5>
     <ul>
      <li>3 Hr Delivery in Active Service Area. </li>
      <li>On Starting Process Get Rs.100 Free Reward Points Free.</li>
      <li>You can create custom order for anything as you want, we deliver it for you within 3hr in active service area....<small class="text-danger">T&C Apply.</small></li>
      <li>Earn 10% Upto Rs.150 Reward Points after successful Delivery of Custom Order.</li>
      <li>30% OFF upto Rs.100 on Delivery Charges for First 10 Deliveries.</li>
     </ul>
     <form action="" method="POST">
      <input type="text" name="customer_id" value="<?php echo $customer_id;?>" hidden="">
      <input type="text" name="interest_type" value="CUSTOM ORDERS" hidden="">
      <?php
               if(!isset($_SESSION['customer_id'])){ ?>
      <a href="login.php" class="btn btn-success btn-md font-3 bottom-p d-block mx-auto text-white" style='background-color: cornflowerblue;'>
       <i class="fa fa-check-circle text-white"></i> Login To Show Interest
      </a>
      <?php } else { 
                  $sql = "SELECT * from interest where customer_id='$customer_id' and interest_type='CUSTOM ORDERS'";
                  $query = mysqli_query($con, $sql);
                  $CountInterest = mysqli_fetch_assoc($query);
                  if($CountInterest == 0){?>
      <button type="submit" name="SUBMIT_INTEREST" class="btn btn-success btn-md font-3 d-block mx-auto" style='background-color: cornflowerblue;'><i class="fa fa-check-circle text-white"></i> Show
       Interest</button>
     </form>
     <?php } else { ?>
     <br>
     <button class="btn btn-outline-success btn-md font-3 d-block mx-auto disabled bottom-text bottom-p"><i class="fa fa-check-circle text-success"></i> Interest Submited</button>
     <?php } } ?>
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12 col-12 p-2">
     <hr>
     <h3 class="text-success text-center">You can also Show Interest for Custom Order via Call or whatsapp @ <a href="whatsapp://" class="text-info"><?php echo $store_phone;?></a></h3>
     <h4 class="text-success text-center">
      <a href="tel:<?php echo $store_phone;?>" class="text-white btn btn-md bottom-text fixed-bottom btn-info bottom-p"><i class="fa fa-phone"></i> Call @ <?php echo $store_phone;?></a><br>
     </h4>
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
  <meta http-equiv="refresh" content="1, create_order.php?msg=Thanks for Showing Your Interest in Custom Orders.">
  <?php }
      }

      ?>

  <?php GSI_footer_files();?>
 </body>

</html>
