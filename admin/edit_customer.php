<?php
require 'files.php';
require 'session.php';
$store_user_id = $_SESSION['user_id'];
$select_store = "SELECT * FROM stores where user_id='$store_user_id'";
$store_query = mysqli_query($con, $select_store);
$fetch_store = mysqli_fetch_assoc($store_query);
$store_id = $fetch_store['store_id'];
if (isset($_GET['id'])) {
  $_SESSION['cedit_id'] = $_GET['id'];
  $q = $_GET['id'];
} else {
  $q = $_SESSION['cedit_id'];
}
$sql = "SELECT * FROM customers where customer_id='$q'";
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
$contactperson = $fetch['contactperson'];
$alternatenumber = $fetch['alternatenumber'];
$customer_password = $fetch['customer_password'];
$customer_status = $fetch['customer_status'];
$CustomerStatus = $fetch['customer_status'];
if ($CustomerStatus == "verified") {
  $CustomerStatus = "<span class='btn-success p-1 rounded'><i class='fa fa-check-circle'></i> Verified</span>";
} else {
  $CustomerStatus = "<span class='btn-danger p-1 rounded'><i class='fa fa-warning'></i> Unverified</span>";
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Edit Customer : <?php echo $customer_name; ?> : <?php echo $PosName; ?></title>
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
        <h4 class="users-action mobile-font-size"><i class="fa fa-edit text-success"></i> <?php echo $customer_name; ?>
         <i class="fa fa-angle-right"></i> <small>Update Customer Information</small></h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
         <ul class="list-inline mb-0">
          <li><a data-action="expand"><i class="fa fa-expand"></i></a></li>
         </ul>
        </div>
       </div>
       <div class="card-content">
        <div class="card-body">
         <form action="update.php" method="POST">
          <input type="text" name="customer_id" value="<?php echo $customer_id; ?>" hidden="">
          <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
          <input type="text" name="store_id" value="<?php echo $store_id; ?>" hidden="">
          <div class="row">
           <div class="col-lg-12">
            <p><b>Edit Customer Details <i class="fa fa-angle-right"></i></b></p>
           </div>
           <div class="col-md-4">
            <div class="form-group">
             <input type="text" class="form-control" name="customer_name" value="<?php echo $customer_name; ?>"
              placeholder="full name" required=''>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <input type="text" class="form-control" value="<?php echo $customer_mail_id; ?>" name="customer_mail_id"
              placeholder="abc@gmail.com" required=''>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <input type="text" class="form-control" name="customer_phone_number"
              value="<?php echo $customer_phone_number; ?>" placeholder="+91" required=''>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <input type="text" class="form-control" value="<?php echo $custaddress; ?>" name="custaddress"
              placeholder="address" required="">
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <select name="arealocality" class="form-control" required="">
              <?php
                            if ($arealocality == null) {
                            } else {
                              echo "<option value='$arealocality'>$arealocality</option>";
                            }
                            $sql = "SELECT * FROM services_area where area_status='active' and area_locality!='$arealocality'";
                            $query = mysqli_query($con, $sql);
                            while ($fetch = mysqli_fetch_assoc($query)) {
                              $area_localityn = $fetch['area_locality'];
                              echo "<option value='$area_localityn'>$area_localityn</option>";
                            } ?>
             </select>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <select name="custcity" class="form-control" required="">
              <?php
                            if ($custcity == null) {
                            } else {
                              echo "<option value='$custcity'>$custcity</option>";
                            }
                            $sql = "SELECT * FROM city where city_status='active' and city_name!='$custcity'";
                            $query = mysqli_query($con, $sql);
                            while ($fetch = mysqli_fetch_assoc($query)) {
                              $city_name = $fetch['city_name'];
                              echo "<option value='$city_name'>$city_name</option>";
                            } ?>
             </select>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <select class="form-control" name="custstate" required="">
              <option value="<?php echo $custstate; ?>"><?php echo $custstate; ?></option>
              <?php
                            $sql = "SELECT * FROM state where state_status='active' and state_name!='$custstate'";
                            $query = mysqli_query($con, $sql);
                            while ($fetch = mysqli_fetch_assoc($query)) {
                              $state_name = $fetch['state_name'];
                              echo "<option value='$state_name'>$state_name</option>";
                            } ?>
             </select>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <input type="text" value="<?php echo $custpincode; ?>" class="form-control" name="custpincode" required=""
              placeholder="Pincode">
            </div>
           </div>
          </div>

          <div class="row">
           <div class="col-lg-12">
            <p><b>Alternate Contact Details <i class="fa fa-angle-right"></i></b></p>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <input type="text" class="form-control" value="<?php echo $contactperson; ?>" name="contactperson"
              placeholder="Contact Person">
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <input type="text" class="form-control" value="<?php echo $alternatenumber; ?>" name="alternatenumber"
              placeholder="Alternate Phone">
            </div>
           </div>
          </div>

          <div class="row">
           <div class="col-lg-12">
            <p><b>Update Password <i class="fa fa-angle-right"></i></b></p>
           </div>
           <div class="col-md-4">
            <div class="form-group">
             <input type="text" class="form-control" value="<?php echo $customer_password; ?>" name="customer_password"
              placeholder="Enter New Password" required="">
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <input type="text" class="form-control" value="<?php echo $customer_password; ?>"
              name="customer_password_re" placeholder="Re - Enter New Password" required="">
            </div>
           </div>
          </div>

          <div class="row">
           <div class="col-lg-12">
            <p><b>Verification Status <i class="fa fa-angle-right"></i></b> <?php echo $CustomerStatus; ?></p>
           </div>
           <div class="col-md-4">
            <div class="form-group">
             <select class="form-control" name="customer_status" required="">
              <option value="<?php echo $customer_status; ?>"><?php echo $customer_status; ?></option>
              <?php if ($customer_status == "verified") {
                              echo "<option value='unverified'>unverified</option>";
                            } else {
                              echo "<option value='verified'>verified</option>";
                            } ?>
             </select>
            </div>
           </div>
          </div>

          <div class="col-lg-12 pl-0">
           <button type="Submit" name="UPDATE_CUSTOMER" value="ture" class="btn btn-primary text-white">Update
            Profile</button>
           <a href="customers.php" class="btn btn-info">Back to All Customers</a>
          </div>

        </div>

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