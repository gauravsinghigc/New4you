<?php
if (isset($_GET['ref'])) {
  $RefrenceId = $_GET['ref'];
  $MainReferebPersonId = preg_replace("/[^0-9\.]/", '', "$RefrenceId");
  $_SESSION['REFER_PERSON_ID'] = $MainReferebPersonId;
}

if (DeviceType() == "Computer") { ?>
<style>
.autocomplete {
 /*the container must be positioned relative:*/
 position: relative;
 display: inline-block;
}

input {
 border: 1px solid transparent;
 padding: 10px;
 font-size: 13px;
}

input[type=text] {
 width: 100%;
}

input[type=submit] {
 color: black;
}

.autocomplete-items {
 position: absolute;
 border: 1px solid #d4d4d4;
 border-bottom: none;
 border-top: none;
 z-index: 99;
 /*position the autocomplete items to be the same width as the container:*/
 top: 90%;
 left: 0;
 right: 0;
 background-color: transparent;
}

.autocomplete-items div {
 padding: 10px;
 cursor: pointer;
 border-bottom: 1px solid #d4d4d4;
 background-color: white !important;
 color: black !important;
}

.autocomplete-items div:hover {
 /*when hovering an item:*/
 background-color: #caeff7;
 color: black;
}

.autocomplete-active {
 /*when navigating through the items using the arrow keys:*/
 color: black;
}

.notification-box {
 position: fixed;
 right: 0.5%;
 bottom: -1%;
 width: 70%;
 min-width: 250px;
 max-width: 350px;
 z-index: 1 !important;
 padding: 1% !important;
 padding-left: 1% !important;
 padding-right: 1% !important;
 box-shadow: 0px 0px 10px grey;
 border-radius: 10px !important;
 background-color: white !important;
 -webkit-border-radius: 10px !important;
 -moz-border-radius: 10px !important;
 -ms-border-radius: 10px !important;
 -o-border-radius: 10px !important;
}

.notification-box h4 {
 cursor: pointer;
 padding: 0.7rem !important;
 border-radius: 4px;
 font-weight: 200 !important;
 font-size: 1rem !important;
}

.notification-box p {
 padding: 2% !important;
 padding-left: 3% !important;
}

.notification-box h4 i.fa-times {
 float: right !important;
 margin-right: 2% !important;
}

@media (max-width: 720px) {
 .notification-box {
  width: 100% !important;
  min-width: 100% !important;
  max-width: 100%;
  bottom: 0px;
  z-index: 1111111111111 !important;
  position: fixed;
  border-top-right-radius: 20px !important;
  border-top-left-radius: 20px !important;
  box-shadow: 0px 0px 1px lightgrey !important;
  padding-top: 2% !important;
 }
}

.text-right {
 text-align: right !important;
}

.user-account-section .fa {
 font-size: 2rem !important;
 color: #1c3481 !important;
}

.user-account-section ul li {
 padding: 0.5rem 1rem !important;
 margin-right: 1rem !important;
}

.user-account-section ul li a {
 display: flex;
 justify-content: start;
}

.user-account-section ul li a span span {
 font-size: 1.3rem;
 margin-left: 0.3rem !important;
}

.header-nav {
 width: 100%;
 background-color: #1c3481;
 padding: 0.5rem !important;
 margin-bottom: 0.3rem !important;
}

.header-nav ul li {
 padding: 0.05rem;
 margin-right: 0.8rem;
}

.header-nav ul {
 display: -webkit-inline-box;
}

.header-nav ul li a {
 color: white !important;
 font-size: 0.7rem !important;
}

.header-nav ul li a:hover {
 color: white !important;
 font-weight: 600 !important;
}

.text-left {
 text-align: left !important;
}

.app-bg {
 background-color: #1c3481;
}

.top-links li {
 margin-left: 0.5rem !important;
 padding: 0.2rem !important;
}

.top-links li a {
 color: white !important;
 text-transform: uppercase;
 font-size: 0.75rem !important;
}

.btn-primary {
 background-color: #1c3481 !important;
 color: white !important;
}

.text-black {
 color: black !important;
}

.new-label1 {
 text-transform: capitalize !important;
}

.detail-left {
 word-break: break-all;
 overflow: hidden;
 text-overflow: ellipsis;
 display: -webkit-box;
 -webkit-line-clamp: 6;
 line-clamp: 6;
 -webkit-box-orient: vertical;
}

.flex-space-evenly {
 display: flex;
 justify-content: space-evenly;
}

</style>

<div class="container-fluid app-bg">
 <div class="row">
  <div class="col-md-4 text-left p-1">
   <h4 class="text-white p-1" style="margin-left: 4.5rem !important;">DEAL OF THE DAY</h4>
  </div>
  <div class="col-md-8 text-right p-1">
   <ul class="top-links">
    <li>
     <a href="index.php"><i class="fa fa-mobile"></i> Service App</a>
    </li>
    <li>
     <a href="contact-us.php"><i class="fa fa-home"></i> Store Locator</a>
    </li>
    <li>
     <a href=""><i class="fa fa-mobile"></i> Download Mobile App</a>
    </li>
    <li>
     <a href="track-order.php"><i class="fa fa-map-marker"></i> Track Order</a>
    </li>
    <li>
     <a href="tel:<?php echo $store_phone; ?>"><i class="fa fa-phone-square"></i> Order Online :
      <?php echo $store_phone ?></a>
    </li>
   </ul>
  </div>
 </div>
</div>
<div class="container-fluid bg-white" id="app-top-header">
 <div class="row">
  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 col-12 p-2 text-center">
   <div class="logo-area">
    <a href="index.php">
     <img src="<?php echo $logo; ?>" class="img-fluid" alt="<?php echo $APP_NAME; ?>" title="<?php echo $APP_NAME; ?>">
    </a>
   </div>
  </div>
  <div class="col-lg-7 col-md-7 col-sm-12 col-12 p-2 col-xs-12 text-center">
   <div class="search-bar" style="padding: 0.5rem;">
    <form class="big-deal-form" action="products.php" method="GET" style="margin-bottom:0px !important;">
     <div class="input-group ">
      <input type="search" onchange="form.submit()" class="form-control" name="search" id='bavbaritems'
       placeholder="Search a Product">
      <div class="input-group-text">
       <button type="submit" class="btn btn-theme">Search</button>
      </div>
     </div>
    </form>
   </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-12 col-12 col-xs-12 text-center p-2">
   <div class="user-account-section" style="padding: 0.5rem !important;">
    <ul>
     <?php if (isset($_SESSION['customer_id'])) { ?>
     <li>
      <a href="account.php">
       <span>
        <i class="fa fa-user"></i>
       </span>
       <span>
        <span><?php echo $customer_name; ?></span>
       </span>
      </a>
     </li>
     <?php } else { ?>
     <li>
      <a href="login.php">
       <span>
        <i class="fa fa-user"></i>
       </span>
       <span>
        <span>Login/Register</span>
       </span>
      </a>
     </li>
     <?php  } ?>
     <li>
      <a href="cart.php">
       <span><i class="fa fa-shopping-cart"></i></span>
       <span>
        <span><?php echo cart_count(); ?></span>
       </span></a>
     </li>
    </ul>
   </div>
  </div>
 </div>

 <div class="row">
  <div class="col-md-12 pl-0 pr-0 text-center" style="padding-left: 0px !important;padding-right: 0px !important;">
   <div class="header-nav">
    <ul>
     <li><a href="products.php" class="text-uppercase">View All Products</a></li>
     <?php
            $sqlMOB = "SELECT * FROM product_categories where product_cat_status='active' and store_id='$store_id' ORDER BY sortby ASC";
            $query = mysqli_query($con, $sqlMOB);
            $countcat = mysqli_num_rows($query);
            while ($fetch =  mysqli_fetch_assoc($query)) {
              $product_cat_idMOB[] = $fetch['product_cat_id'];
            }

            foreach ($product_cat_idMOB as $product_cat_id) {
              $sql = "SELECT * FROM product_categories where product_cat_status='active' and product_cat_id='$product_cat_id' and store_id='$store_id' ORDER BY sortby ASC";
              $query = mysqli_query($con, $sql);
              $fetch =  mysqli_fetch_assoc($query);
              $product_cat_id = $fetch['product_cat_id'];
              $category_img = $fetch['category_img'];
              $product_cat_title = $fetch['product_cat_title'];
              $product_cat_add_date = $fetch['product_cat_add_date'];
              $product_cat_status = $fetch['product_cat_status'];
              $sql_products = "SELECT * from user_products where product_cat_id='$product_cat_id' and user_products.product_status='active'";
              $query_products = mysqli_query($con, $sql_products);
              $count = mysqli_num_rows($query_products); ?>
     <li><a href="products.php?cat_id=<?php echo $product_cat_id; ?>"><?php echo $product_cat_title; ?></a></li>
     <?php } ?>

    </ul>
   </div>
  </div>
 </div>
</div>
<?php } else {
  include "mobi-header.php";
} ?>
