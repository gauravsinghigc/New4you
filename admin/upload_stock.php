<?php
require 'files.php';
require 'session.php';
if (isset($_GET['q'])) {
  $q = $_GET['q'];
  $sql = "SELECT * FROM customers where customer_phone_number='$q' OR customer_mail_id='$q'";
  $query  = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  $customer_id = $fetch['customer_id'];
  $customer_name = $fetch['customer_name'];
  $customer_mail_id = $fetch['customer_mail_id'];
  $customer_phone_number = $fetch['customer_phone_number'];
  $custaddress = $fetch['custaddress'];
  $custcity = $fetch['custcity'];
  $custstate = $fetch['custstate'];
  $custpincode = $fetch['custpincode'];
  $arealocality = $fetch['arealocality'];
  $custpincode = $fetch['custpincode'];
} else {
  $customer_id = "null";
  $customer_name = "";
  $customer_mail_id = "";
  $customer_phone_number = "";
  $custaddress = "";
  $custcity = "";
  $custstate = "";
  $custpincode = "";
  $arealocality = "";
  $custpincode = "";
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM stores where user_id='$user_id'";
$query =  mysqli_query($con, $sql);
$fetchstore = mysqli_fetch_assoc($query);


?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Upload Stocks : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click"
 data-menu="vertical-menu-modern" data-col="2-columns">

 <?php require 'header.php'; ?>


 <?php require 'sidebar.php'; ?>

 <!-- BEGIN: Content-->
 <div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
   <div class="content-header row">
    <div class="col-lg-12 card-content">
     <?php notification(); ?>
    </div>
   </div>



   <div class="content-body">
    <!-- users list start -->
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action mobile-font-size">Upload Stock <i class="fa fa-angle-right"></i></h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
         <ul class="list-inline mb-0">
          <li><a data-action="expand"><i class="fa fa-expand"></i></a></li>
         </ul>
        </div>
       </div>
       <div class="card-content">
        <div class="card-body">
         <form action="insert.php" method="POST" enctype="multipart/form-data">
          <?php $StoreID = $fetchstore['store_id']; ?>
          <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
          <input type="FILE" name="product_img" value='product-image-placeholder.png' class="form-control" hidden="">
          <input type="text" name="user_id" value="<?php echo $StoreID; ?>" hidden="">
          <div class="row">
           <div class="col-md-4">
            <div class="form-group">
             <label class="control-label">Choose Category</label>
             <select class="form-control" name="product_cat_id" <?php if (isset($_GET['warning'])) {
                                                                                echo "has-error";
                                                                              } else {
                                                                              }; ?>>
              <option value='null' name="product_cat_id">Select Category </option>
              <?php
                            $sql = "SELECT * FROM product_categories where store_id='$store_id' ORDER BY product_cat_title ASC";
                            $query = mysqli_query($con, $sql);
                            while ($fetch = mysqli_fetch_assoc($query)) {
                              $product_cat_id  = $fetch['product_cat_id'];
                              $product_cat_title = $fetch['product_cat_title'];

                              echo "<option value='$product_cat_id' name='product_cat_id'>$product_cat_title - $product_cat_id</option>";
                            }
                            ?>
             </select>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label class="control-label">Choose Sub Category</label>
             <select class="form-control" name="product_sub_cat_id" <?php if (isset($_GET['warning'])) {
                                                                                    echo "has-error";
                                                                                  } else {
                                                                                  }; ?>>
              <option value='null' name="product_sub_cat_id">Select Sub Category </option>
              <?php
                            $sql = "SELECT * FROM product_sub_categories where store_id='$store_id' ORDER BY sub_cat_title ASC";
                            $query = mysqli_query($con, $sql);
                            while ($fetch = mysqli_fetch_assoc($query)) {
                              $sub_cat_id  = $fetch['sub_cat_id'];
                              $sub_cat_title = $fetch['sub_cat_title'];

                              echo "<option value='$sub_cat_id' name='sub_cat_id'>$sub_cat_title - $sub_cat_id</option>";
                            }
                            ?>
             </select>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label class="control-label">Choose Brand</label>
             <select class="form-control" name="product_brand_id" <?php if (isset($_GET['warning'])) {
                                                                                  echo "has-error";
                                                                                } else {
                                                                                }; ?>>
              <option value='null' name="product_brand_id">Select Brand </option>
              <?php
                            $sql = "SELECT * FROM pro_brands where store_id='$store_id' ORDER BY brand_title ASC";
                            $query = mysqli_query($con, $sql);
                            while ($fetch = mysqli_fetch_assoc($query)) {
                              $brand_id  = $fetch['brand_id'];
                              $brand_title = $fetch['brand_title'];
                              echo "<option value='$brand_id' name='product_brand_id'>$brand_title - $brand_id</option>";
                            } ?>
             </select>
            </div>
           </div>

           <div class="col-md-12">
            <div class="form-group">
             <label class="control-label">Choose Product Data</label>
             <input type="FILE" name="PRODUCT_DATA" value="" class="form-control" required="">
            </div>
           </div>

           <div class="col-md-12">
            <div class="form-group">
             <label>Download PRODUCT FORMAT.</label><br>
             <a href="data/PRODUCT_LIST_FORMAT.csv" download="PRODUCT_LIST_FORMAT.csv"
              class="btn btn-primary btn-md">PRODUCT_LIST_FORMAT.csv</a>
            </div>
           </div>


          </div>
        </div>
        <div class="modal-footer">
         <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
         <button type="submit" class="btn btn-outline-primary" name="UPLOAD_PRODUCTS" value="UPLOAD_PRODUCTS">UPLOAD
          PRODUCTS</button>
         </form>
        </div>
       </div>
      </div>
     </div>
   </div>
  </div>
 </div>
 </section>
 <!-- users list ends -->
 </div>
 </div>
 </div>
 <!-- END: Content-->

 <?php require 'footer.php'; ?>

</body>
<!-- END: Body-->

</html>
<script type="text/javascript">
function autocomplete(inp, arr) {
 /*the autocomplete function takes two arguments,
 the text field element and an array of possible autocompleted values:*/
 var currentFocus;
 /*execute a function when someone writes in the text field:*/
 inp.addEventListener("input", function(e) {
  var a, b, i, val = this.value;
  /*close any already open lists of autocompleted values*/
  closeAllLists();
  if (!val) {
   return false;
  }
  currentFocus = -1;
  /*create a DIV element that will contain the items (values):*/
  a = document.createElement("DIV");
  a.setAttribute("id", this.id + "autocomplete-list");
  a.setAttribute("class", "autocomplete-items");
  /*append the DIV element as a child of the autocomplete container:*/
  this.parentNode.appendChild(a);
  /*for each item in the array...*/
  for (i = 0; i < arr.length; i++) {
   /*check if the item starts with the same letters as the text field value:*/
   if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
    /*create a DIV element for each matching element:*/
    b = document.createElement("DIV");
    /*make the matching letters bold:*/
    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
    b.innerHTML += arr[i].substr(val.length);
    /*insert a input field that will hold the current array item's value:*/
    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
    /*execute a function when someone clicks on the item value (DIV element):*/
    b.addEventListener("click", function(e) {
     /*insert the value for the autocomplete text field:*/
     inp.value = this.getElementsByTagName("input")[0].value;
     /*close the list of autocompleted values,
     (or any other open lists of autocompleted values:*/
     closeAllLists();
    });
    a.appendChild(b);
   }
  }
 });
 /*execute a function presses a key on the keyboard:*/
 inp.addEventListener("keydown", function(e) {
  var x = document.getElementById(this.id + "autocomplete-list");
  if (x) x = x.getElementsByTagName("div");
  if (e.keyCode == 40) {
   /*If the arrow DOWN key is pressed,
   increase the currentFocus variable:*/
   currentFocus++;
   /*and and make the current item more visible:*/
   addActive(x);
  } else if (e.keyCode == 38) { //up
   /*If the arrow UP key is pressed,
   decrease the currentFocus variable:*/
   currentFocus--;
   /*and and make the current item more visible:*/
   addActive(x);
  } else if (e.keyCode == 13) {
   if (currentFocus > -1) {
    /*and simulate a click on the "active" item:*/
    if (x) x[currentFocus].click();
   }
  }
 });

 function addActive(x) {
  /*a function to classify an item as "active":*/
  if (!x) return false;
  /*start by removing the "active" class on all items:*/
  removeActive(x);
  if (currentFocus >= x.length) currentFocus = 0;
  if (currentFocus < 0) currentFocus = (x.length - 1);
  /*add class "autocomplete-active":*/
  x[currentFocus].classList.add("autocomplete-active");
 }

 function removeActive(x) {
  /*a function to remove the "active" class from all autocomplete items:*/
  for (var i = 0; i < x.length; i++) {
   x[i].classList.remove("autocomplete-active");
  }
 }

 function closeAllLists(elmnt) {
  /*close all autocomplete lists in the document,
  except the one passed as an argument:*/
  var x = document.getElementsByClassName("autocomplete-items");
  for (var i = 0; i < x.length; i++) {
   if (elmnt != x[i] && elmnt != inp) {
    x[i].parentNode.removeChild(x[i]);
   }
  }
 }
 /*execute a function when someone clicks in the document:*/
 document.addEventListener("click", function(e) {
  closeAllLists(e.target);
 });
}

autocomplete(document.getElementById("myInput"), countries);
autocomplete(document.getElementById("search_products"), products);
</script>