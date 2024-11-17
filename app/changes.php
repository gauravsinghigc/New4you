<?php 
session_start();
require 'files.php';
if(isset($_GET['msg'])){
echo "<meta http-equiv='refresh' content='2, changes.php'>";
}
?>
<html style="<?php echo $ThemeColor;?>">
    <head>
       <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title> 
       <?php GSI_header_files();?>   
    </head>
    <body>

   <!-- Main Content -->

        <!--section start-->
        <section class="login-page section-b-space">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mt-3">
                       <img src="<?php echo $LogoRec;?>" style="width: 60%;" class='d-block mx-auto'>
                       <p class="text-center kharido-TagLine-all font-3 mt-0"><?php echo $AppTag;?></p>
                       <?php 
      if(isset($_GET['pass_update']) == "true"){ ?>
        <br>
       <h4 class="text-center font-8"><i class="fa fa-edit text-info"></i> Password Reset</h4>
       <br><br><br>
       <img src="../img/7VozH.gif" style="width: 30%;border-radius: 100px;" class="img-fluid d-block mx-auto">
       <h5 class="text-center font-6"><i class="fa fa-check-circle text-success"></i> Password Updated Successfully!</h5>
       <br><br><br><br>
       <a href="login.php" class="btn btn-block bottom-text btn-success fixed-bottom bottom-p text-white"><i class="fa fa-sign-in mt-0"></i> Login</a>
       <a href="index.php" class="btn btn-block bottom-text text-link fixed-bottom mb-5 text-info bottom-p" style="margin-bottom: 14% !important;"><i class="fa fa-angle-left mt-0"></i> Back to Home</a><br>
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
                                <button name="Update_Password" type="submit" class="btn btn-success btn-block btn-lg bottom-text">Update</button>
                              </div>
                            </form>
                        </div>
     <?php } ?>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-2 pr-0 pl-0">
                </div>
                    
                </div>
            </div>
        </section>
        <!--Section ends-->





<?php GSI_footer_files();?>
    </body>
</html>
