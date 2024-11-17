<?php
require 'files.php';
$IpAddress = get_ip();
$DeviceType = strtoupper(detectDevice());
$VisitingUrl = basename($_SERVER['PHP_SELF']);

if (isset($_SESSION['customer_id'])) {
$customer_id = $_SESSION['customer_id'];
 $sql = "SELECT * FROM customers where customer_id='$customer_id'";
 $query = mysqli_query($con, $sql);
 $fetch = mysqli_fetch_assoc($query);
 $customer_name = $fetch['customer_name'];
 $customer_mail_id = $fetch['customer_mail_id'];
 $customer_phone_number = $fetch['customer_phone_number'];
 $UserStatus = "Login";
 $CustomerId = $customer_id;
} else {
 $customer_id = "Unknown";
 $customer_name = "Unknown";
 $customer_mail_id = "Unknown";
 $customer_phone_number = "Unknown";
 $UserStatus = "Unknown";
 $CustomerId = "Unknown";
}

$UserDetails = "<br><b>UserStatus :</b> $UserStatus
<br><b>CustomerId :</b> $customer_id
<br><b>CustomerName :</b> $customer_name
<br><b>CustomerMailId :</b> $customer_mail_id
<br><b>CustomerPhoneNumber :</b> $customer_phone_number";

$ipv6_n = php_uname('n');
$ipv6_p = php_uname('p');
$os = php_uname('s');
$OS_release = php_uname('r');
$OS_Version = php_uname('v');
$System_Info = php_uname('m');
$DeviceInformations = $_SERVER['HTTP_USER_AGENT']."<br><b>IpV6N :</b> $ipv6_n
<br><b>IpV6P :</b> $ipv6_p
<br><b>OS :</b> $os
<br><b>OsRelease :</b> $OS_release
<br><b>OsVersion :</b> $OS_Version
<br><b>SystemType :</b> $System_Info
$UserDetails";
$VistingDOT = date("d M Y h:m:s a");
$VisitingSource = "WEBSITE";

$CheckVisitors = "SELECT * FROM visitors where IpAddress='$IpAddress' and DeviceType='$DeviceType' and VisitingSource='$VisitingSource';";
$VisitorsQuery = mysqli_query($con, $CheckVisitors);
$CountVisitors = mysqli_num_rows($VisitorsQuery);
if($CountVisitors == 0){
  $InsertVisitors = "INSERT INTO visitors (IpAddress, DeviceType, VisitorType, VistingDOT, VisitingUrl, DeviceInformations, VisitingCounts, VisitingSource, UserStatus, CustomerId) VALUES ('$IpAddress', '$DeviceType', 'NEW', '$VistingDOT', '$VisitingUrl', '$DeviceInformations', '1', '$VisitingSource', '$UserStatus', '$CustomerId')";
  $InsertQuery = mysqli_query($con, $InsertVisitors);
} else {
  $FetchVisitors = mysqli_fetch_assoc($VisitorsQuery);
  $VisitorId = $FetchVisitors['VisitorId'];
  $VisitingCounts = $FetchVisitors['VisitingCounts'];
  $VisitingCounts++;
  $InsertVisitors = "INSERT INTO visitors (IpAddress, DeviceType, VisitorType, VistingDOT, VisitingUrl, DeviceInformations, VisitingCounts, VisitingSource, UserStatus, CustomerId) VALUES ('$IpAddress', '$DeviceType', 'RE-VISIT', '$VistingDOT', '$VisitingUrl', '$DeviceInformations', '1', '$VisitingSource', '$UserStatus', '$CustomerId')";
  $InsertQuery = mysqli_query($con, $InsertVisitors);
} ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $store_name;?> : Home</title>
       <?php include 'header_files.php';?>
    </head>

    <body>

        <?php require 'header.php'; require 'slider.php'; ?>

        <?php require 'cat_bar.php'; ?>
 <section class="product-items-slider section-padding">
            <div class="container-fluid container-fluid-mobile-view">
                <div class="section-header" style="background-color: #ffffffbf;
    padding: 1%;
    margin-bottom: 1%;">
                    <h5 class="heading-design-h5 mb-0">LATEST OFFERS & RECOMMENDED<span class="badge badge-primary"></span>
                        <a class="float-right text-secondary" href="products.php">View All</a>
                    </h5>
                </div>
                <div class="row no-gutters">
                    <?php
            $sql = "SELECT * from user_products, pro_brands where user_id='$user_id' and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' and user_products.product_type='RECOMMENDED' and product_cat_id!='12'";
            $query = mysqli_query($con, $sql);
            while ($fetch = mysqli_fetch_assoc($query)) {
               $user_product_id_value = $fetch['user_product_id'];
               $product_title = $fetch['product_title'];
               $product_img= $fetch['product_img'];
               $product_offer_price = $fetch['product_offer_price'];
               $product_mrp_price = $fetch['product_mrp_price'];
               $product_tags = $fetch['product_tags'];
               $brand_title = $fetch['brand_title'];
               $offer_percentage = $product_offer_price/$product_mrp_price*100;
               $off = round($offer_percentage);
               if($offer_percentage == 100){
                   $off_per = 0;
               } else {
                   $off_per = 100 - $off;
               }

               ?>
                   <div class="col-lg-2 col-4">
                  <div class="product">
                     <a href="details.php?product_id=<?php echo $user_product_id_value;?>">
                        <div class="product-header">

                           <img class="img-fluid" src="<?php echo $img_url;?>/img/store_img/pro_img/<?php echo $product_img;?>" alt="<?php echo $product_title;?>" title="<?php echo $product_title;?>">
                        </div>
                        <div class="product-body">
                           <h5><?php echo $product_title;?> <br><?php echo $hindi_name;?></h5>
                           <h6><strong><span class="fa fa-check-circle text-success"></span> <?php echo $product_tags;?></strong></h6>
                        </div>
                        <div class="product-footer">

                     <p class="offer-price">
                        <b class="price">Rs.<?php echo $product_offer_price;?></b>
                        <span class="regular-price">Rs.<?php echo $product_mrp_price;?></span></p>
                     <form action="insert.php" method="POST" class="mb-2 text-center">
                     <input type="text" name="quantity" value="1" hidden="">
                           <input type="text" name="store_id" value="<?php echo $store_id;?>" hidden>
                           <input type="text" name="ip_address" value="<?php echo get_ip();?>" hidden>
                           <input type="text" name="cr_url" value="<?php get_url();?>" hidden>
                           <input type="text" name="user_product_id_value" value="<?php echo $user_product_id_value;?>" hidden>
                           <?php 
              $CheckItemInCart = "SELECT * FROM customer_cart where device_info='$user_product_id_value' and ip_address='$ip_address'";
              $CartQuery = mysqli_query($con, $CheckItemInCart);
              $CountItemInCart = mysqli_num_rows($CartQuery);
              if($CountItemInCart == 0){
                $ButtonClass = "btn-outline-success";
                $ButtonText = "<i class='fa fa-shopping-cart'></i> Add to Cart";
              } else {
                $ButtonText = "<i class='fa fa-check-circle'></i> Saved";
                $ButtonClass = "btn-danger";
              } ?>
                          <button type="submit" name="save_to_cart"  class="btn btn-secondary text-white btn-sm <?php echo $ButtonClass;?>"><?php echo $ButtonText;?></button>
                         </form>
                        </div>
                     </a>
                  </div>
               </div>
                    <?php } ?>

                </div>
            </div>
        </section>

        <section class="product-items-slider section-padding">
            <div class="container-fluid container-fluid-mobile-view">
                <div class="section-header" style="background-color: #ffffffbf;
    padding: 1%;
    margin-bottom: 1%;">
                    <h5 class="heading-design-h5 mb-0">Best Selling Products <span class="badge badge-primary"></span>
                        <a class="float-right text-secondary" href="products.php">View All</a>
                    </h5>
                </div>
                <div class="row no-gutters">
                    <?php
            $sql = "SELECT * from user_products, pro_brands where user_id='$user_id' and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_status='active' and user_products.product_type='BEST' and product_cat_id!='12'";
            $query = mysqli_query($con, $sql);
            while ($fetch = mysqli_fetch_assoc($query)) {
               $user_product_id_value = $fetch['user_product_id'];
               $product_title = $fetch['product_title'];
               $product_img= $fetch['product_img'];
               $product_offer_price = $fetch['product_offer_price'];
               $product_mrp_price = $fetch['product_mrp_price'];
               $product_tags = $fetch['product_tags'];
               $brand_title = $fetch['brand_title'];
               $offer_percentage = $product_offer_price/$product_mrp_price*100;
               $off = round($offer_percentage);
               if($offer_percentage == 100){
                   $off_per = 0;
               } else {
                   $off_per = 100 - $off;
               }

               ?>
                   <div class="col-lg-2 col-4">
                  <div class="product">
                     <a href="details.php?product_id=<?php echo $user_product_id_value;?>">
                        <div class="product-header">

                           <img class="img-fluid" src="<?php echo $img_url;?>/img/store_img/pro_img/<?php echo $product_img;?>" alt="<?php echo $product_title;?>" title="<?php echo $product_title;?>">
                        </div>
                        <div class="product-body">
                           <h5><?php echo $product_title;?> <br><?php echo $hindi_name;?></h5>
                           <h6><strong><span class="fa fa-check-circle text-success"></span> <?php echo $product_tags;?></strong></h6>
                        </div>
                        <div class="product-footer">

                     <p class="offer-price">
                        <b class="price">Rs.<?php echo $product_offer_price;?></b>
                        <span class="regular-price">Rs.<?php echo $product_mrp_price;?></span></p>
                     <form action="insert.php" method="POST" class="mb-2 text-center">
                     <input type="text" name="quantity" value="1" hidden="">
                           <input type="text" name="store_id" value="<?php echo $store_id;?>" hidden>
                           <input type="text" name="ip_address" value="<?php echo get_ip();?>" hidden>
                           <input type="text" name="cr_url" value="<?php get_url();?>" hidden>
                           <input type="text" name="user_product_id_value" value="<?php echo $user_product_id_value;?>" hidden>
                           <?php 
              $CheckItemInCart = "SELECT * FROM customer_cart where device_info='$user_product_id_value' and ip_address='$ip_address'";
              $CartQuery = mysqli_query($con, $CheckItemInCart);
              $CountItemInCart = mysqli_num_rows($CartQuery);
              if($CountItemInCart == 0){
                $ButtonClass = "btn-outline-success";
                $ButtonText = "<i class='fa fa-shopping-cart'></i> Add to Cart";
              } else {
                $ButtonText = "<i class='fa fa-check-circle'></i> Saved";
                $ButtonClass = "btn-danger";
              } ?>
                          <button type="submit" name="save_to_cart"  class="btn btn-secondary text-white btn-sm <?php echo $ButtonClass;?>"><?php echo $ButtonText;?></button>
                         </form>
                        </div>
                     </a>
                  </div>
               </div>
                    <?php } ?>

                </div>
            </div>
        </section>
        <section class="product-items-slider section-padding">
            <div class="container-fluid container-fluid-mobile-view">
                <div class="section-header" style="background-color: #ffffffbf;
    padding: 1%;
    margin-bottom: 1%;">
                    <h5 class="heading-design-h5 mb-0">Feature Products <span class="badge badge-info"></span>
                        <a class="float-right text-secondary" href="products.php">View All</a>
                    </h5>
                </div>
                <div class="owl-carousel owl-carousel-featured">
                    <?php  $sql = "SELECT * from user_products, pro_brands where user_id='$user_id' and user_products.product_status='active'  and user_products.product_brand_id=pro_brands.brand_id and user_products.product_type='FEATURED' and user_products.product_status='active'";
            $query = mysqli_query($con, $sql);
            while ($fetch = mysqli_fetch_assoc($query)) {
               $user_product_id_value = $fetch['user_product_id'];
               $product_title = $fetch['product_title'];
               $product_img= $fetch['product_img'];
               $product_offer_price = $fetch['product_offer_price'];
               $product_mrp_price = $fetch['product_mrp_price'];
               $product_tags = $fetch['product_tags'];
               $brand_title = $fetch['brand_title'];
               $offer_percentage = $product_offer_price/$product_mrp_price*100;
               $off = round($offer_percentage);
               if($offer_percentage == 100){
                   $off_per = 0;
               } else {
                   $off_per = 100 - $off;
               }

               ?>
                    <div class="item">
                        <div class="product">
                     <a href="details.php?product_id=<?php echo $user_product_id_value;?>">
                        <div class="product-header">

                           <img class="img-fluid" src="<?php echo $img_url;?>/img/store_img/pro_img/<?php echo $product_img;?>" alt="<?php echo $product_title;?>" title="<?php echo $product_title;?>">
                        </div>
                        <div class="product-body">
                           <h5><?php echo $product_title;?> <br><?php echo $hindi_name;?></h5>
                           <h6><strong><span class="fa fa-check-circle text-success"></span> <?php echo $product_tags;?></strong></h6>
                        </div>
                        <div class="product-footer">

                     <p class="offer-price">
                        <b class="price">Rs.<?php echo $product_offer_price;?></b>
                        <span class="regular-price">Rs.<?php echo $product_mrp_price;?></span></p>
                     <form action="insert.php" method="POST" class="mb-2 text-center">
                     <input type="text" name="quantity" value="1" hidden="">
                           <input type="text" name="store_id" value="<?php echo $store_id;?>" hidden>
                           <input type="text" name="ip_address" value="<?php echo get_ip();?>" hidden>
                           <input type="text" name="cr_url" value="<?php get_url();?>" hidden>
                           <input type="text" name="user_product_id_value" value="<?php echo $user_product_id_value;?>" hidden>
                           <?php 
              $CheckItemInCart = "SELECT * FROM customer_cart where device_info='$user_product_id_value' and ip_address='$ip_address'";
              $CartQuery = mysqli_query($con, $CheckItemInCart);
              $CountItemInCart = mysqli_num_rows($CartQuery);
              if($CountItemInCart == 0){
                $ButtonClass = "btn-outline-success";
                $ButtonText = "<i class='fa fa-shopping-cart'></i> Add to Cart";
              } else {
                $ButtonText = "<i class='fa fa-check-circle'></i> Saved";
                $ButtonClass = "btn-danger";
              } ?>
                          <button type="submit" name="save_to_cart"  class="btn btn-secondary text-white btn-sm <?php echo $ButtonClass;?>"><?php echo $ButtonText;?></button>
                         </form>
                        </div>
                     </a>
                  </div>
                    </div>
                    <?php } ?>


                </div>
            </div>
        </section>
        <?php require 'why_section.php'; ?>
        <?php require 'footer.php'; require 'login_section.php'; ?>
    </body>

</html>
