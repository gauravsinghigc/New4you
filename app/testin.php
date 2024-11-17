<?php include 'files.php';
if (isset($_COOKIE['customer_id']) and isset($_COOKIE['store_id'])) {
  $customer_id = $_COOKIE['customer_id'];
  $store_id = $_COOKIE['store_id'];

  $_SESSION['customer_id'] = $customer_id;
  $_SESSION['store_id'] = $store_id;
}
if (isset($_SESSION['customer_id'])) {
    header("location: home.php");
}

?>
<html style="<?php echo $ThemeColor;?>">
    <head>
       <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title> 
       <?php GSI_header_files();?>   
    </head>
    <body>

        <div class="container-fluid k-align" style="width:100% !important;">
        	<div class="row">
        		<div class="col-sm-12 col-xs-12 col-12">
        			<img src="<?php echo $LogoRec;?>" class="img-fluid Kharido-logo mx-auto d-block" id='box'>
        			<p class="text-center kharido-TagLine mt-0" id='KharidoTagLine'><?php echo $AppTag;?></p>
        		</div>
        	</div>
        </div>

        <div class="container-fluid fixed-bottom mb-0" id="LoginArea">
            <div class="row">
                <?php if(isset($_GET['err'])) { ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group" id='MSG'>
                    <span class="text-danger text-center" ><i class="fa fa-warning"></i> <?php echo $_GET['err'];?></span>
                    <button onclick="Hide()" class="btn btn-sm btn-danger float-right"><i class="fa fa-times"></i></button>
                </div>
                </div>
            <?php } else { } ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form action="insert.php" method="POST" id="LoginForm">
                        <div class="form-group">
                            <input type="text" name="CustomerPhone" class="form-control tr-input" placeholder="+91" required="">
                        </div>
                         <div class="form-group">
                            <input type="password" name="CustomerPassword" class="form-control tr-input" placeholder="********" required="">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-md KLoginButton btn-block" name="login_request"> Login <i class="fa fa-sign-in"></i></button>
                        </div>
                    </form>

                    <form action="insert.php" method="POST" id="SignupForm" class="k-Hide">
                        <div class="form-group">
                            <input type="text" name="CustomerName" class="form-control tr-input" placeholder="Full Name" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" name="CustomerPhone" class="form-control tr-input" placeholder="Phone without +91" required="">
                        </div>
                        <div class="form-group">
                            <input type="email" name="CustomerEmail" class="form-control tr-input" placeholder="Email ID" required="">
                        </div>
                         <div class="form-group">
                            <input type="password" name="CustomerPassword" class="form-control tr-input" placeholder="********" required="">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-md KLoginButton btn-block" name="register_customer"> Signup <i class="fa fa-sign-in"></i></button>
                        </div>
                    </form>
                    <hr>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-outline-info KLoginButton btn-block" onclick="CustomerAction()"><i class="fa fa-sign-in"></i><span id='ActionName'> Create an Account</span></button>
                </div>

                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-4">
                    <p class="text-center copyrighted">CopyRighted &copy; <?php echo date("Y");?> All Right are Reserved By <a href="https://<?php echo $AppNameWithExt;?>"><?php echo $AppNameWithExt;?></a></p>
                </div>
            </div>
        </div>

        <?php GSI_footer_files();?>

        <script type="text/javascript">
            //login page animation
$(document).ready(function(){
    $("#box").animate({marginTop: "110vw", width:"100%"}, 1000);
    $("#KharidoTagLine").animate({fontSize: "6vw"}, 1000);
});

$(document).ready(function(){
    setTimeout(function(){ 
    document.getElementById("box").style.width = "20%";
    document.getElementById("box").style.marginBottom = "0px";
    document.getElementById('box').style.paddingBottom = "0px;";
    document.getElementById("KharidoTagLine").style.fontSize = "1vw";
    $("#KharidoTagLine").animate({fontSize: "3vw"}, 1000);
    $("#box").animate({marginTop: "1vw", width:"60%"}, 1000);
  }, 2000);
});

$(document).ready(function(){
    setTimeout(function(){ 
    document.getElementById("LoginArea").style.display = "block";
    $("#LoginArea").animate({opacity: "1.0"}, 700);
  }, 3500);
});

        </script>
    </body>
</html>