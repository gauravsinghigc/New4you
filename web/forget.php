<?php require 'files.php';
if(isset($_SESSION['customer_id'])){
header("location: account.php");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $store_name;?> : Forget Password</title>
      <?php include 'header_files.php';?>
<style type="text/css">
   input {
      padding: 3% !important;
   }
</style>
   </head>
   <body style="font-size: 15px !important;">
      <?php require 'header.php'; ?>
<section class="container-fluid" style="background-image: url('img/lucrezia-carnelos-wQ9VuP_Njr4-unsplash.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center; padding: 6%;">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-12 col-xs-12 bg-white mx-auto p-4">
      <img src="<?php echo $logo;?>" class="img-fluid d-block mx-auto mt-0" style="width: 50%;">
      <h4 class="title text-center"><i class="fa fa-edit text-info"></i> Password Reset</h4>
      <p class="text-center">Forget Password? Don't worry let's Reset it.</p>
      <hr>
                        <div class="theme-card">
                            <form class="theme-form" action="reset.php" method="POST">
                                
                                <div class="form-group">
                                <div class="col-auto">
                                    <label>Please Enter Your Registered Phone Number <br><small class="text-danger">Don't Include +91.</small></label>
                                             <div class="input-group mb-2">
                                                 <div class="input-group-prepend">
                                                    <div class="input-group-text">+91</div>
                                                 </div>
                                                 <input type="text" class="form-control tr-input font-15" value="" id="LoginPhoneNumber" name="check_data" placeholder="XXXXXXXXXX" required="">
                                             </div>
                                       </div>
                                </div>
                                <button name="check_user" type="submit" class="btn btn-success btn-block bottom-text p-3 btn-block mb-2" style="font-size: 15px;" onclick="ResetClick()">
                                  <span id="ResetClick"><i class="fa fa-refresh mt-0"></i> Reset</span>
                                </button>

                                <a href="login.php" class="btn text-link text-info btn-block bottom-text p-3 text-white mt-5" style="font-size: 15px;"><i class="fa fa-angle-left"></i> Back to Login</a>
                            </form>
                        </div>
    </div>
  </div>
</section>
<script type="text/javascript">
  function ResetClick(){
    var DataInput = document.getElementById("DataInput").value;
    document.getElementById("ResetClick").innerHTML = "<i class='fa fa-refresh fa-spin mt-0'></i> Searching Account for " + DataInput + " ...";
  }
</script>    
 <?php require 'footer.php'; ?>
</body></html>
