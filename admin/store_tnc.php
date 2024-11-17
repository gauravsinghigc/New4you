<?php
require 'config.php';
require 'tools.php';
require 'alert.php';

if (isset($_GET['id'])) {
  $access_id = $_GET['id'];
  $access_id_2 = $_GET['id_2'];

  $sql = "SELECT * FROM users where phone_number='$access_id_2' OR email_id='$access_id'";
  $query = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($query);
  if ($fetch == true) {
    $tnc = $fetch['tnc'];
    $full_name = $fetch['full_name'];
    $username = $fetch['username'];
    $password = $fetch['password'];
    $email_id = $fetch['email_id'];
    $phone_number = $fetch['phone_number'];
    $user_address = $fetch['user_address'];
    $user_arealocality = $fetch['user_arealocality'];
    $user_city = $fetch['user_city'];
    $user_state = $fetch['user_state'];
    $user_pincode = $fetch['user_pincode'];
    $date_time = $fetch['date_time'];
    $user_id = $fetch['user_id'];

    //store information
    $sql = "SELECT * FROM stores where user_id='$user_id'";
    $query =  mysqli_query($con, $sql);
    $fetchstore = mysqli_fetch_assoc($query);
    $store_name = $fetchstore['store_name'];
    $store_phone = $fetchstore['store_phone'];
    $store_mail_id = $fetchstore['store_mail_id'];
    $store_description = $fetchstore['store_description'];
    $store_address = $fetchstore['store_address'];
    $store_arealocality = $fetchstore['store_arealocality'];
    $store_city = $fetchstore['store_city'];
    $store_state = $fetchstore['store_state'];
    $store_pincode = $fetchstore['store_pincode'];
    $activation_fee_status = $fetchstore['activation_fee_status'];
    $store_add_date = $fetchstore['store_add_date'];
    $store_activation_fee = $fetchstore['store_activation_fee'];
    $activation_fee_status = $fetchstore['activation_fee_status'];
    $store_type = $fetchstore['store_type'];
  } else {
  }
} else {
  header("location: error.php?err=Please visit valid link. You are trying to open a Broken Link.");
}

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Store Activation : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns" data-open="click" data-menu="vertical-menu-modern"
 data-col="2-columns">

 <!-- BEGIN: Content-->
 <div class="app-content content" style='margin-left:0px;'>
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
       <div class="card-header" style='padding-left: 2%;
    padding-right: 2%;
    padding-bottom: 1%;
    padding-top: 5%;'>
        <h4 class="users-action mobile-font-size">Account Details <i class="fa fa-angle-right"></i>
         <small class='float-right'><b>REG. On:</b> <?php echo $date_time; ?></small>
         <hr>
        </h4>
       </div>
       <div class="card-content">
        <div class="card-body" style='padding-left: 2%;
    padding-right: 2%;
    padding-top: 1%;
    padding-bottom: 1%;'>

         <?php if ($tnc == "true") {
                  } else {
                  } ?>
         <div class='row'>
          <div class='col-lg-6 col-md-6 col-12' style='padding-bottom:5%;'>
           <h4>Store Owner Information:</h4>
           <table style='widht:100%;font-size:13px;'>
            <tr>
             <th>Full Name </th>
             <td>:</td>
             <td><?php echo $full_name; ?></td>
            </tr>
            <tr>
             <th>Email Id</th>
             <td>:</td>
             <td><?php echo $email_id; ?></td>
            </tr>
            <tr>
             <th>Phone Number</th>
             <td>:</td>
             <td><?php echo $phone_number; ?></td>
            </tr>
           </table>
          </div>

          <div class='col-lg-6 col-md-6 col-12' style='padding-bottom:5%;'>
           <h4>Store Information:</h4>
           <table style='width:100%;font-size:13px;'>
            <tr>
             <th>Store Name </th>
             <td>:</td>
             <td><?php echo $store_name; ?></td>
            </tr>
            <tr>
             <th>Store Type </th>
             <td>:</td>
             <td><?php echo $store_type; ?></td>
            </tr>
            <tr>
             <th>Store Email ID</th>
             <td>:</td>
             <td><?php echo $store_mail_id; ?></td>
            </tr>
            <tr>
             <th>Store Phone Number</th>
             <td>:</td>
             <td><?php echo $store_phone; ?></td>
            </tr>
            <tr>
             <th>Store Address</th>
             <td>:</td>
             <td><?php echo $store_address; ?>, <?php echo $store_arealocality; ?>, <?php echo $store_city; ?>,
              <?php echo $store_state; ?>, <?php echo $store_pincode; ?></td>
            </tr>
            <tr>
             <th>Store Activation Status:</th>
             <td>:</td>
             <td><?php echo $activation_fee_status; ?></td>
            </tr>
            <tr>
             <th>Store Activation Fee:</th>
             <td>:</td>
             <td><?php echo $store_activation_fee; ?></td>
            </tr>
           </table>
          </div>

          <div class='col-lg-6 col-md-6 col-12' style='padding-bottom:5%;'>
           <h4>Login Information:</h4>
           <table style='width:100%;font-size:13px;'>
            <tr>
             <th>Login Url </th>
             <td>:</td>
             <td>Please active your account first, by accepting T&C below...</td>
            </tr>
            <tr>
             <th>Username</th>
             <td>:</td>
             <td><?php echo $username; ?></td>
            </tr>
            <tr>
             <th>Password</th>
             <td>:</td>
             <td><?php echo $password; ?></td>
            </tr>

           </table>
          </div>

          <div class='col-lg-12 col-md-12 col-12' style='padding-bottom:5%;'>
           <h4>Terms of Services :</h4>
           <p>
            <b>1.</b> Subscription will start only after complete registration;<br>
            <b>2.</b> activation period is not part of subscription time.<br>
            <b>3.</b> Activation charges includes verification of details , PayTM integration and MobiPOS
            integration.<br>
            <b>4.</b> All payments are transferred on company name only (Allbiz Global INC) , No Personal PayTM
            transfers are allowed.<br>
            <b>5.</b> Store owner self Subscription registration is necessary to activate the shop under mobistore and
            mobipos<br>
            <b>6.</b> Store owner can anytime Unsubscribe the given subscription , before the subscription date.<br>
            <b>7.</b> Store owner should pay the subscription fee automatically from the account , a grace period of 10
            days will be given before deactivation of services.<br>
            <b>8.</b> Store owner is liable to post only legal products to sell on mobistore.<br>
            <b>9.</b> Store owner is self responsible to maintain the timely delivery of products.<br>
            <b>10.</b> Store owner is self responsible to supply the quality products, if some faulty/damaged or expired
            product is delivered by store owner, store owner will replace the product by its own.<br>
            <b>12.</b> Store owner can include Vegetables, Dairy products or Unique products of own brand to sell.<br>
            <b>11.</b> Store owner can upload any number of products under inventory , condition applied is , such
            products must be available physically in shop.<br>
            <b>13.</b> Store owner cannot raise objection on any brand store.<br>
            <b>14.</b> Store owner must provide details for mobile wallet/ UPI payments , as needed by the mob store
            team for store direct payment integration.<br>
           </p>

           </table>
          </div>

         </div>


         <form action="insert.php" method="POST">

          <input type="text" name="username" value="<?php echo $username; ?>" hidden=''>
          <input type="text" name="password" value="<?php echo $password; ?>" hidden=''>
          <div class='row'>
           <div class='col-lg-12 col-12'>
            <?php
                        if ($tnc == "true") {
                          echo "<h4 class='text-success'>You Already Accepted Terms of Services.</h4>
                     <p>Click to Continue and Access your account.</p>";
                        } else { ?>
            <div class='form-group'>
             <input type="checkbox" name="tnc" value="true" required='' data-error='Please Accept Terms of Services'>
             <label>Accept Terms of Services.</label>

            </div>
            <?php } ?>
           </div>
          </div>
          <div class="modal-footer">
           <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
           <button type="Submit" name="Accept_TNC" class="btn btn-outline-primary">Continue</button>
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

 <?php include 'footer.php'; ?>
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