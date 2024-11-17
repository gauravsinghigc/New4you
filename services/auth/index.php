<?php
require '../require/config.php';
require '../data/tags.php';
require '../data/pagevariables.php';
require '../require/modules.php';

//session controller for user 
if (isset($_SESSION['LOGIN_USER'])) {
 header("location: ../admin/");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Login | <?php echo $APP_NAME; ?></title>
 <?php
 //header files
 include '../include/header_files.php';
 ?>
</head>

<body style="background-image:url('<?php echo $DOMAIN; ?>/storage/default/login-bg.jpg');background-size:cover;">
 <section class="container-fluid">
  <div class="row">
   <div class="col-md-12 pt-5 flex-c">
    <div class="p-4 app-bg login-bg br10 mt-5">
     <h1 class="border-left p-2 mt-3"><?php echo $APP_NAME; ?></h1>
     <h4 class="mt-5 pt-2 pb-2">Login</h4>
     <form class="form" action="../controller/authcontroller.php" method="POST">
      <input type="text" name="access_url" value="../auth/" hidden="">
      <div class="form-group mb-2">
       <label>Username</label>
       <input type="text" name="username" value="" class="form-control p-1" required="" min="5">
      </div>
      <div class="form-group mb-2">
       <label>Password</label>
       <input type="password" name="password" value="" class="form-control p-1" required="" min="5">
      </div>
      <div class="form-group mb-2">
       <a href="forget.php" class="text-grey">Forget Password?</a>
      </div>
      <div class="form-group mb-2">
       <button type="submit" name="LoginRequest" class="btn btn-primary btn-block">Secured Login</button>
      </div>
      <div class="form-group">
       <hr>
       <p class="text-center fs-13 text-grey">Developed & Design by <?php echo $CREATED_BY; ?></p>
       <p class="text-center text-grey fs-12">Copyrighted @ <?php echo DATE("Y"); ?> | All Right are Reserved by <?php echo $CREATED_BY; ?></p>
      </div>
     </form>
    </div>
   </div>
  </div>
 </section>

 <?php

 //message
 include '../include/message.php';

 //footer
 include '../include/footer.php';

 //footer files
 include '../include/footer_files.php';
 ?>
</body>

</html>