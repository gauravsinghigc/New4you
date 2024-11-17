<?php require 'files.php';?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $store_name;?> : Login</title>
       <?php include 'header_files.php';?>
</head>
<body>
<?php 
include "header.php"; ?>
<!--section start-->
<section class="login-page section-big-py-space b-g-light">
    <div class="custom-container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="theme-card">
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
        </div>
    </div>
</section>
<!--Section ends-->


<?php include 'footer.php'; ?>
</body>
</html>