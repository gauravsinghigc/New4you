<?php
if (isset($_GET['ref'])) {
  $RefrenceId = $_GET['ref'];
  $MainReferebPersonId = preg_replace("/[^0-9\.]/", '', "$RefrenceId");
  $_SESSION['REFER_PERSON_ID'] = $MainReferebPersonId;
} ?>
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
 padding: 0.6rem !important;
 margin-bottom: 0.3rem !important;
}

.header-nav ul li {
 padding: 0.1rem;
 margin-right: 0.8rem;
}

.header-nav ul li a {
 color: white !important;
 font-size: 0.77rem !important;
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
}

.text-black {
 color: black !important;
}

.new-label1 {
 text-transform: capitalize !important;
}

.product .product-box .product-imgbox img {
 height: auto !important;
}

.detail-title h2 {
 font-size: 1rem !important;
}

.detail-left p {
 font-size: 0.8rem !important;
}

.h6 {
 font-size: 0.85rem !important;
}

</style>

<div class="container-fluid app-bg">
 <div class="row">
  <div class="col-md-12 p-1 text-center">
   <ul class="top-links top-links2">
    <li>
     <a href="index.php"><i class="fa fa-mobile"></i> Service</a>
    </li>
    <li>
     <a href="contact-us.php"><i class="fa fa-home"></i> Store</a>
    </li>
    <li>
     <a href=""><i class="fa fa-mobile"></i> Download App</a>
    </li>
    <li>
     <a href="track-order.php"><i class="fa fa-map-marker"></i> Track</a>
    </li>
   </ul>
  </div>
 </div>
</div>
<style>
.mobile-menu-header ul {
 display: flex;
 justify-content: space-between;
}

.mobile-menu-header .logo {
 width: 40%;
}

a {
 color: black !important;
}

.mobile-menu-header ul li i.fa {
 font-size: 1.7rem;
 margin-left: 0.3rem !important;
 padding: 0.7rem 0.9rem !important;
}

.mobile-menu-header ul li.fa-search {
 margin-right: 2rem !important;
}

.cart-block {
 position: fixed;
 z-index: 9999;
 bottom: 2rem;
 right: 2rem;
 background-color: red;
 color: white !important;
 padding: 0.3rem 1.2rem;
 border-radius: 2rem !important;
 box-shadow: 0px 0px 10px black !important;
}

.cart-block a {
 color: white !important;
 font-size: 1.7rem;
}

.hidden {
 display: none;
}

</style>
<div class="container-fluid bg-white" id="app-top-headers">
 <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pl-0 pr-0 col-12 p-2 text-center">

   <div class="mobile-menu-header" style="padding: 0.5rem !important;">
    <ul>
     <li class="logo">
      <div class="logo-area p-2">
       <a href="index.php">
        <img src="<?php echo $logo; ?>" class="img-fluid" alt="<?php echo $APP_NAME; ?>"
         title="<?php echo $APP_NAME; ?>">
       </a>
      </div>
     </li>
     <li>
      <a href="#" onclick="ShowSearchBar()">
       <span id="s_text"><i class="fa fa-search"></i></span>
      </a>
      <a href="#" onclick="ShowSidebar()">
       <i class="fa fa-bars"></i>
      </a>
     </li>

    </ul>
   </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-12 col-xs-12 text-center p-2 hidden" id="searchbar">
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
 </div>
 <script>
 function ShowSearchBar() {
  var searchbar = document.getElementById("searchbar");

  if (searchbar.style.display === "block") {
   searchbar.style.display = "none";
   document.getElementById("s_text").innerHTML = "<i class='fa fa-search'></i>";
  } else {
   searchbar.style.display = "block";
   document.getElementById("s_text").innerHTML = "<i class='fa fa-times'></i>";
  }
 }
 </script>
 <style>
 .mobile-bars {
  position: fixed;
  background-color: white;
  width: 80%;
  top: 0px;
  left: 0px;
  padding: 0.7rem;
  z-index: 99999999;
  box-shadow: 0px 0px 100px black;
  height: 100%;
  overflow: scroll;
  display: none;
 }

 .mobile-bars ul {
  padding-left: 1rem;
  list-style-type: none;
 }

 .mobile-bars ul li {
  display: list-item;
  text-align: left;
 }

 .mobile-bars ul li a {
  font-size: 1.3rem;
  padding: 0.5rem;
  line-height: 2.2rem !important;
  text-transform: capitalize !important;
 }

 </style>
 <div class="row">
  <div class="col-md-12 pl-0 pr-0" style="padding-left: 0px !important;padding-right: 0px !important;">
   <div class="mobile-bars" id="sidebar">
    <ul>
     <li class="text-right">

     </li>
     <?php if (isset($_SESSION['customer_id'])) {
            $sql = "SELECT * from customers where customer_id ='$customer_id'";
            $query = mysqli_query($con, $sql);
            $count_address = mysqli_num_rows($query);
            $fetch = mysqli_fetch_assoc($query);
            $customer_name = $fetch['customer_name'];
            $customer_mail_id = $fetch['customer_mail_id'];
            $customer_phone_number = $fetch['customer_phone_number'];
            $street_address = $fetch['custaddress'];
            $area_locality = $fetch['arealocality'];
            $customer_city = $fetch['custcity'];
            $customer_state = $fetch['custstate'];
            $address_pincode = $fetch['custpincode'];
            $contact_person = $fetch['contactperson'];
            $alternate_phone = $fetch['alternatenumber'];
            $customer_status = $fetch['customer_status'];
            $customer_status_check = $fetch['customer_status'];
            if ($customer_status == "verified") {
              $customer_status = "<i class='fa fa-check-circle text-success'></i> Verified";
            } else {
              $customer_status = "<a href='verify.php' class='btn btn-danger btn-sm'><i class='fa fa-warning mt-0'></i> Verify Account</a>";
            }
          ?>
     <li>
      <a href="#" onclick="ShowSidebar()" class="btn btn-md btn-danger text-white pull-right"><i
        class="fa fa-times"></i></a>
      <a href="account.php">
       <h2>
        <i class="fa fa-user display-5  btn btn-md btn-primary"></i> <?php echo $customer_name; ?><br>
        <?php echo $customer_mail_id; ?><br>
        <?php echo $customer_phone_number; ?>
       </h2>
      </a>
     </li>
     <li class="text-right">
      <a href="logout.php">Logout <i class="fa fa-sign-out"></i></a>
     </li>
     <?php } else { ?>
     <li>
      <a href="#" onclick="ShowSidebar()" class="btn btn-md btn-danger text-white pull-right"><i
        class="fa fa-times"></i></a>

      <a href="login.php">
       <h2><i class="fa fa-user display-5  btn btn-md btn-primary"></i> Login / Register</h2>
      </a>
     </li>
     <?php } ?>
     <hr>
     <li>
      <h2 class="text-black"><b>Browse Products</b></h2>
     </li>
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
<script>
function ShowSidebar() {
 var sidebar = document.getElementById("sidebar");

 if (sidebar.style.display == "block") {
  sidebar.style.display = "none";
 } else {
  sidebar.style.display = "block";
 }
}
</script>
<script>
//scroll acitivity
window.onscroll = function() {
 myFunction2();
};
var header2s = document.getElementById("app-top-headers");
var sticky = header2s.offsetTop;

function myFunction2() {
 if (window.pageYOffset > sticky) {
  header2s.classList.add("fixed-top");
 } else {
  header2s.classList.remove("fixed-top");
 }
}
</script>
<?php if (cart_count() != 0) { ?>
<div class="cart-block">
 <a href="cart.php">
  <span><i class="fa fa-shopping-cart"></i></span>
  <span>
   <span><?php echo cart_count(); ?></span>
  </span></a>
</div>
<?php } ?>
