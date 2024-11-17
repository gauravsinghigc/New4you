<?php require 'files.php';
if(isset($_SESSION['customer_id'])){
header("location: account.php");
}
if(isset($_GET['msg'])){
echo "<meta http-equiv='refresh' content='2, changes.php'>";
}?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $store_name;?> : Login</title>
      <?php include 'header_files.php';?>
<style type="text/css">
   input {
      padding: 3% !important;
   }
</style>
   </head>
   <body style="font-size: 15px !important;">
      <?php require 'header.php'; ?>

<section class="container-fluid mb-4 mt-4" style="background-image: url('img/lucrezia-carnelos-wQ9VuP_Njr4-unsplash.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center; padding: 6%;">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-12 col-xs-12 mx-auto bg-white pt-5 pb-4 pl-3 pr-3">
      <img src="<?php echo $logo;?>" class="img-fluid d-block mx-auto mt-4" style="width: 50%;">
      <?php 
      if(isset($_GET['pass_update']) == "true"){ ?>
       <h4 class="text-center"><i class="fa fa-edit text-info"></i> Password Reset</h4> <hr>
       <img src="img/7VozH.gif" style="width: 30%;" class="img-fluid d-block mx-auto">
       <h5 class="text-center"><i class="fa fa-check-circle text-success"></i> Password Updated Successfully!</h5>
       <br>
       <a href="login.php" class="btn btn-block font-15 btn-success p-3"><i class="fa fa-sign-in mt-0"></i> Login</a>
       <a href="login.php" class="btn btn-block font-15 text-link text-info p-3"><i class="fa fa-angle-left mt-0"></i> Back to Home</a>
      <?php } else {
      ?>
      <h4 class="title text-center"><i class="fa fa-edit text-info"></i> Change Password</h4><hr>
      <p>Please enter your new password...</p>
                      
                        <div class="theme-card">
                            <span><?php
                        if(isset($_GET['msg'])){
                            $msg = $_GET['msg'];
                            $type = "border border-danger";
                            echo "<span class='text-danger text-center'>$msg</span><br>";
                        } else { $type = ""; } ?></span>
                            <form class="theme-form" action="update.php" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control <?php echo $type;?>" name="pass_1" placeholder="Enter New Password"
                                        required="">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control <?php echo $type;?>" name="pass_2" placeholder="Confirm New Password"
                                        required="">
                                </div>
                                <div class="form-group">
                                  <br>
                                <button name="Update_Password" type="submit" class="btn btn-success btn-block btn-lg font-15 p-3">Update</button>
                              </div>
                            </form>
                        </div>
     <?php } ?>
    </div>
  </div>
</section>

 <?php require 'footer.php'; ?>
 
<!-- Bootstrap core JavaScript -->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <!-- select2 Js -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel -->
      <script src="js/owl.carousel.js"></script>
      <!-- Custom -->
      <script src="js/custom.js"></script>


</body></html>
