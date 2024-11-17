<ul class="nav navbar-nav flex-row">
 <li class="nav-item mobile-menu d-lg-none mr-auto">
  <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="fa fa-bars font-large-1"></i></a>
 </li>
 <li class="nav-item mr-auto">
  <a class="navbar-brand pt-0 d-block mx-auto" href="index.php">
   <?php
      $sql = "SELECT * FROM stores where store_id='1'";
      $query = mysqli_query($con, $sql);
      $fetch = mysqli_fetch_assoc($query);
      $StoreLogo = $fetch['store_profile_img']; ?>
   <img class="brand-logo d-block mx-auto img-fluid" alt="<?php echo $PosName; ?>" src="<?php echo $StoreLogo; ?>"
    title='<?php echo $PosName; ?>' style="width:85%;padding: 3%;">
  </a>
 </li>
 <li class="nav-item d-none d-lg-block nav-toggle">
  <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
   <i class="fa fa-bars font-medium-5 black" data-ticon="feather.icon-toggle-right"></i>
  </a>
 </li>
 <li class="nav-item d-lg-none">
  <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
   <i class="fa fa-ellipsis-v"></i>
  </a>
 </li>

</ul>