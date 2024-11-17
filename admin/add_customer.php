<?php
require 'files.php';
require 'session.php';
$store_user_id = $_SESSION['user_id'];
$select_store = "SELECT * FROM stores where user_id='$store_user_id'";
$store_query = mysqli_query($con, $select_store);
$fetch_store = mysqli_fetch_assoc($store_query);
$store_id = $fetch_store['store_id'];
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
  <title>New Customer : <?php echo $PosName; ?></title>
  <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

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
                <h4 class="users-action mobile-font-size"><i class="fa fa-user text-info"></i> New Customer <i class="fa fa-angle-right"></i> <small>Enter Customer Information</small></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="expand"><i class="fa fa-expand"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <form action="insert.php" method="GET">
                    <input type="text" name="customer_id" value="<?php echo $customer_id; ?>" hidden="">
                    <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
                    <input type="text" name="store_id" value="<?php echo $store_id; ?>" hidden="">
                    <div class="row">
                      <div class="col-lg-12">
                        <p><small>Enter New Customer Details</small></p>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_name" value="" placeholder="First name" required=''>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_middlename" value="" placeholder="Middle name" required=''>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_lastname" value="" placeholder="Last name" required=''>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_phone_number" value="" placeholder="+91" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="customer_mail_id" class="form-control" placeholder="Enter Mail Id" value="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="custaddress" value="" placeholder="House no" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_floor" value="" placeholder="Floor No" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_street_no" value="" placeholder="Street Number" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_addressblock" value="" placeholder="Block Number" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_road" value="" placeholder="Road Number/Name" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_other" value="" placeholder="Location Other Name" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input name="arealocality" value="" class="form-control" required="" placeholder="Area Locality">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input name="customer_sub_area" value="" placeholder="Sub Area" class="form-control" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input class="form-control" name="custcity" required="" value="" placeholder="City">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input class="form-control" name="custstate" required="" value="" placeholder="State">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="custpincode" class="form-control" required="" placeholder="Enter Pincode" value="">
                        </div>
                      </div>

                    </div>

                    <div class="col-lg-12 pl-0">
                      <button type="Submit" name="SAVE_NEW_CUSTOMER" value="ture" class="btn btn-primary text-white">Save</button>
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