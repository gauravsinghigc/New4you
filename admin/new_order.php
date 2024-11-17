<?php
require 'files.php';
require 'session.php';
if (isset($_GET['q'])) {
  $q = $_GET['q'];
  if ($_GET['q'] == null) {
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
    $customer_middlename = "";
    $customer_lastname = "";
    $customer_street_no = "";
    $customer_addressblock = "";
    $customer_road = "";
    $customer_other  = "";
    $customer_sub_area = "";
    $customer_floor = "";
    $contactperson = "";
    $alternatenumber = "";
  } else {
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
    $customer_middlename = $fetch['customer_middlename'];
    $customer_lastname = $fetch['customer_lastname'];
    $customer_street_no = $fetch['customer_street_no'];
    $customer_addressblock = $fetch['customer_addressblock'];
    $customer_road = $fetch['customer_road'];
    $customer_other  = $fetch['customer_other'];
    $customer_sub_area = $fetch['customer_sub_area'];
    $customer_floor = $fetch['customer_floor'];
    $contactperson = $fetch['contactperson'];
    $alternatenumber = $fetch['alternatenumber'];
  }
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
  $customer_middlename = "";
  $customer_lastname = "";
  $customer_street_no = "";
  $customer_addressblock = "";
  $customer_road = "";
  $customer_other  = "";
  $customer_sub_area = "";
  $customer_floor = "";
  $contactperson = "";
  $alternatenumber = "";
}

?>
<audio id="audiotag1" src="audio/example.wav" preload="auto"></audio>
<script type="text/javascript">
  function play() {
    document.getElementById('audiotag1').play();
  }
</script>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="<?php echo $PosName; ?>">
  <title>New Orders : <?php echo $PosName; ?></title>
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
                <h4 class="users-action mobile-font-size">Create Order <i class="fa fa-angle-right"></i> <small>Enter Customer
                    Information</small>
                </h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="expand"><i class="fa fa-expand"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <form action="" method="GET" autocomplete="off" onchange="form.submit()" name=searchbox>
                    <div class="row">
                      <div class="col-md-12 col-12 autocomplete">
                        <input list="myInput" class="form-control" type="text" placeholder="Search customer from phone number..." value="" name="q">
                        <datalist id="myInput">
                          <?php
                          $sql_sr = "SELECT * FROM customers";
                          $query_src = mysqli_query($con, $sql_sr);
                          while ($search = mysqli_fetch_assoc($query_src)) {
                            $phone_number = $search['customer_phone_number'];
                            $customer_name_view = $search['customer_name']; ?>
                            <option value="<?php echo $phone_number; ?>"></option>
                          <?php  } ?>
                        </datalist>
                      </div>
                    </div>
                  </form>
                  <form action="order_products.php" method="GET">
                    <input type="text" name="customer_id" value="<?php echo $customer_id; ?>" hidden="">
                    <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
                    <div class="row">
                      <div class="col-lg-12">
                        <h3 class="pl-0 ml-0"><small><i class="fa fa-user text-success"></i> Customer Information <i class="fa fa-angle-right"></i>
                            <?php if ($customer_id == "null" or $customer_id == "") {
                              echo "";
                            } else { ?>
                              <?php echo $customer_name; ?> <i class="fa fa-angle-right"></i> <a href="cust_details.php?customer_id=<?php echo $customer_id; ?>" class="btn btn-success btn-sm">View
                                Profile</a>
                            <?php } ?>
                          </small>
                        </h3>
                      </div>
                      <div class="col-lg-12">
                        <?php
                        if ($customer_id == null) {
                          echo "<h3 class='text-center text-danger'><i class='fa fa-warning'></i> No Customer Found!</h3>";
                        }
                        if (isset($_GET['q'])) {
                          if ($_GET['q'] == null) {
                            echo "<h3 class='text-left text-danger'><i class='fa fa-warning'></i> Please Search with Valid Phone Number!</h3>";
                          }
                        }
                        ?>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_name" value="<?php echo $customer_name; ?>" placeholder="First name" required=''>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_middlename" value="<?php echo $customer_middlename; ?>" placeholder="Middle name" required=''>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_lastname" value="<?php echo $customer_lastname; ?>" placeholder="Last name" required=''>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_phone_number" value="<?php if (isset($_GET['q'])) {
                                                                                                        echo $_GET['q'];
                                                                                                      } else {
                                                                                                        echo "";
                                                                                                      } ?>" placeholder="+91" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="customer_mail_id" class="form-control" placeholder="Enter Mail Id" value="<?php echo $customer_mail_id; ?>">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <h4 class="ml-0 pl-0"><b>Shipping Address</b></h4>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="custaddress" value="<?php echo $custaddress; ?>" placeholder="House no" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_floor" value="<?php echo $customer_floor; ?>" placeholder="Floor No" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_street_no" value="<?php echo $customer_street_no; ?>" placeholder="Street Number" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_addressblock" value="<?php echo $customer_addressblock; ?>" placeholder="Block Number" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_road" value="<?php echo $customer_road; ?>" placeholder="Road Number/Name" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_other" value="<?php echo $customer_other; ?>" placeholder="Location Other Name" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input name="arealocality" value="<?php echo $arealocality; ?>" class="form-control" required="" placeholder="Area Locality">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input name="customer_sub_area" value="<?php echo $customer_sub_area; ?>" placeholder="Sub Area" class="form-control" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input class="form-control" name="custcity" required="" value="<?php echo $custcity; ?>" placeholder="City">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input class="form-control" name="custstate" required="" value="<?php echo $custstate; ?>" placeholder="State">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="custpincode" class="form-control" required="" placeholder="Enter Pincode" value="<?php echo $custpincode; ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="contact_person" class="form-control" required="" placeholder="Contact Person Name" value="<?php echo $contactperson; ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="alternate_phone" class="form-control" required="" placeholder="Person Phone" value="<?php echo $alternatenumber; ?>">
                        </div>
                      </div>

                      <div class="col-md-12">
                        <h4 class="ml-0 pl-0"><b>Billing Address</b></h4>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="custaddress_b" value="<?php echo $custaddress; ?>" placeholder="House no" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_floor_b" value="<?php echo $customer_floor; ?>" placeholder="Floor No" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_street_no_b" value="<?php echo $customer_street_no; ?>" placeholder="Street Number" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_addressblock_b" value="<?php echo $customer_addressblock; ?>" placeholder="Block Number" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_road_b" value="<?php echo $customer_road; ?>" placeholder="Road Number/Name" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_other_b" value="<?php echo $customer_other; ?>" placeholder="Location Other Name" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input name="arealocality_b" value="<?php echo $arealocality; ?>" class="form-control" required="" placeholder="Area Locality">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input name="customer_sub_area_b" value="<?php echo $customer_sub_area; ?>" placeholder="Sub Area" class="form-control" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input class="form-control" name="custcity_b" required="" value="<?php echo $custcity; ?>" placeholder="City">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input class="form-control" name="custstate_b" required="" value="<?php echo $custstate; ?>" placeholder="State">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="custpincode_b" class="form-control" required="" placeholder="Enter Pincode" value="<?php echo $custpincode; ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="contact_person_b" class="form-control" required="" placeholder="Contact Person Name" value="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="alternate_phone_b" class="form-control" required="" placeholder="Person Phone" value="">
                        </div>
                      </div>


                      <div class="col-lg-12">
                        <button type="Submit" name="CUSTOMER_ORDERING" value="ture" class="btn btn-primary text-white">NEXT</button>
                  </form><a href="new_order.php" class="btn btn-danger btn-md">Reset</a>
                  <p><i class="fa fa-angle-right"></i> Proceed to add Products</p>


                </div>

              </div>



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