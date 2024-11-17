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

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>New Store : <?php echo $PosName; ?></title>
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
        <h4 class="users-action mobile-font-size">Store Owner <i class="fa fa-angle-right"></i> <small>Enter Owner
          Information</small></h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
         <ul class="list-inline mb-0">
          <li><a data-action="expand"><i class="fa fa-expand"></i></a></li>
         </ul>
        </div>
       </div>
       <div class="card-content">
        <div class="card-body">
         <form action="insert.php" method="POST">
          <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden>
          <input type="text" name="user_type" value="STORE_USER" hidden>
          <input type='text' name='password' value='12345' hidden>
          <input type="text" name="password_2" value='12345' hidden>

          <div class="row">
           <div class="col-md-4">
            <div class="form-group">
             <label>USER TYPE</label>
             <select class="form-control" name="user_role" readonly=''>
              <?php
                                                        $user_id = $_SESSION['user_id'];
                                                        $SelectUserTypes = "SELECT * FROM user_types WHERE user_type_title='STORE_USER'";
                                                        $SelectUserTypesQuery = mysqli_query($con, $SelectUserTypes);
                                                        while ($SelectUserTypesFetch = mysqli_fetch_assoc($SelectUserTypesQuery)) {
                                                            $UserTypeid = $SelectUserTypesFetch['user_type_id'];
                                                            $UserTypeTitle = $SelectUserTypesFetch['user_type_title'];
                                                            $UserTypeDate = $SelectUserTypesFetch['user_type_date']; ?>
              <option value="<?php echo $UserTypeid; ?>">
               <?php echo $UserTypeTitle; ?></option>
              <?php } ?>
             </select>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label>STORE TYPE</label>
             <select class="form-control" name="store_type" required=''>
              <option>Select Store Type</option>
              <option value="GROCERY_STORE">GROCERY STORE</option>
              <option value="MEDICAL_STORE">MEDICAL STORE</option>
              <option value="BRAND_STORE">BRAND STORE</option>
              <option value="FRUITS_AND_VEGETABLES">FRUITS AND VEGETABLES</option>
             </select>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label>Store Name</label>
             <input type="text" class="form-control" name="Store_name" placeholder="Enter Store Name" required="">
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label>Owner Full name</label>
             <input type="text" class="form-control" name="full_name" placeholder="Full Name" required="">
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label>Username</label>
             <input type="text" class="form-control" name="username"
              value='<?php $sql = "SELECT * FROM stores ORDER BY store_id DESC";
                                                                                                                    $query = mysqli_query($con, $sql);
                                                                                                                    $fetch = mysqli_fetch_assoc($query);
                                                                                                                    $store_id = $fetch['store_id'];
                                                                                                                    $store_id++;
                                                                                                                    echo "STR$store_id"; ?>' placeholder="Email Id"
              readonly=''>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label>Enter Email-id</label>
             <input type="email" class="form-control" name="email_id" placeholder="Email Id" required="">
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label>Phone Number (without +91)</label>
             <input type="text" class="form-control" name="phone_number" placeholder="+91" required="">
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label>Password</label>
             <input type="text" class="form-control" name="password" placeholder="********" readonly='' disabled=''
              value='12345'>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label>Store Address</label>
             <input type="text" class="form-control" name="user_address" placeholder="H no/Flat no/Street Address"
              required="">
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label>Area Locality</label>
             <input type="text" class="form-control" name="user_arealocality" placeholder="Area/ Sector/ Locality/"
              required="">
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label>Select State</label>
             <input type="hidden" name="country" id="countryId" value="IN" />
             <select name="user_state" class="states order-alpha form-control" id="stateId">
              <option value="">Select Store State</option>
             </select>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label>Select City</label>
             <select name="user_city" class="cities order-alpha form-control" id="cityId">
              <option value="" style='text-transform:uppercase;'>Select
               Store City</option>
             </select>
            </div>
           </div>

           <div class="col-md-4">
            <div class="form-group">
             <label>Area Pincode</label>
             <input type="text" class="form-control" name="user_pincode" placeholder="Pincode" required="">
             <a href='https://www.indiapost.gov.in/VAS/Pages/findpincode.aspx' target="blank">Don't Know Pincode</a>
            </div>
           </div>

          </div>
        </div>
        <div class="modal-footer">
         <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
         <button type="Submit" name="REGISTER_NEW_USER" class="btn btn-outline-primary">Continue</button>
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

 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="//geodata.solutions/includes/statecity.js"></script>

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