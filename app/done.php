<?php require 'files.php';
session_start();
if(isset($_GET['id'])){
   $id = $_GET['id'];
   $sql = "SELECT * FROM customers where customer_mail_id='$id'";
   $query = mysqli_query($con, $sql);
   $fetch = mysqli_fetch_assoc($query);  
   $_SESSION['customer_id'] = $fetch['customer_id'];
   $customer_id = $_SESSION['customer_id'];
} else {
   $customer_phone = $_SESSION['C_PHONE_NUMBER'];
   $sql = "SELECT * FROM customers where customer_phone_number='$customer_phone'";
   $query = mysqli_query($con, $sql);
   $fetch = mysqli_fetch_assoc($query);
   $customer_id = $fetch['customer_id'];
   $_SESSION['customer_id'] = $customer_id;  
   unset($_SESSION['C_PHONE_NUMBER']); 
} ?>
<html style="<?php echo $ThemeColor;?>">
    <head>
       <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title> 
       <?php GSI_header_files();?>   
    </head>
    <body>

   <!-- Main Content -->

        <!--section start-->
        <section class="login-page section-b-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mt-3">
                       <img src="<?php echo $LogoRec;?>" style="width: 60%;" class='d-block mx-auto'>
                       <hr>
                        <h3 class="title">Password Reset</h3>

                        <div class="theme-card">
                            <?php
                        if(isset($_GET['msg'])){
                            $msg = $_GET['msg'];
                            echo "<span class='text-black text-center mt-3'>$msg</span><br><br>
                            
                            <a href='login.php' class='btn btn-sm btn-success btn-block bottom-text text-white'><i class='fa fa-angle-left'></i> Login</a>";
                        } else { } ?>

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!--Section ends-->







<?php GSI_footer_files();?>
    </body>
</html>