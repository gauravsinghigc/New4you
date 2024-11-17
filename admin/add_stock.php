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
  <title>Add Stocks : <?php echo $PosName; ?></title>
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
                <h4 class="users-action mobile-font-size"><i class="fa fa-plus text-info"></i> ADD Stocks <i class="fa fa-angle-right"></i> <small>Enter Product Information</small></h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <form action="" method="GET" class="mb-0">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Choose Category</label>
                          <select class="form-control" required="" onchange="form.submit()" name="product_cat_id" <?php if (isset($_GET['warning'])) {
                                                                                                                    echo "has-error";
                                                                                                                  } else {
                                                                                                                  }; ?>>
                            <?php if (isset($_GET['product_cat_id'])) {
                              $product_cat_id = $_GET['product_cat_id']; ?>
                              <?php
                              $sql = "SELECT * FROM product_categories where product_cat_id='$product_cat_id' ORDER BY product_cat_title ASC";
                              $query = mysqli_query($con, $sql);
                              while ($fetch = mysqli_fetch_assoc($query)) {
                                $product_cat_id  = $fetch['product_cat_id'];
                                $product_cat_title = $fetch['product_cat_title'];

                                echo "<option value='$product_cat_id' name='product_cat_id' selected=''>$product_cat_title</option>";
                              }
                              ?>
                              <?php
                              $sql = "SELECT * FROM product_categories where product_cat_id!='$product_cat_id' ORDER BY product_cat_title ASC";
                              $query = mysqli_query($con, $sql);
                              while ($fetch = mysqli_fetch_assoc($query)) {
                                $product_cat_id  = $fetch['product_cat_id'];
                                $product_cat_title = $fetch['product_cat_title'];

                                echo "<option value='$product_cat_id' name='product_cat_id'>$product_cat_title</option>";
                              }
                              ?>
                            <?php  } else { ?>
                              <option value='null' name="product_cat_id">Select
                                Category </option>
                              <?php
                              $sql = "SELECT * FROM product_categories ORDER BY product_cat_title ASC";
                              $query = mysqli_query($con, $sql);
                              while ($fetch = mysqli_fetch_assoc($query)) {
                                $product_cat_id  = $fetch['product_cat_id'];
                                $product_cat_title = $fetch['product_cat_title'];

                                echo "<option value='$product_cat_id' name='product_cat_id'>$product_cat_title</option>";
                              }
                              ?>
                            <?php  } ?>
                          </select>
                        </div>
                      </div>
                  </form>

                  <div class="col-sm-4">
                    <form action="insert.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label class="control-label">Choose Sub Category</label>
                        <select class="form-control" required="" name="product_sub_cat_id" <?php if (isset($_GET['warning'])) {
                                                                                              echo "has-error";
                                                                                            } else {
                                                                                            }; ?>>
                          <?php if (isset($_GET['product_cat_id'])) {
                            $product_cat_id = $_GET['product_cat_id']; ?>
                            <option value='null' name="product_sub_cat_id">Please Select Category First</option>
                            <?php
                            $sql = "SELECT * FROM product_sub_categories where product_cat_id='$product_cat_id' ORDER BY sub_cat_title ASC";
                            $query = mysqli_query($con, $sql);
                            while ($fetch = mysqli_fetch_assoc($query)) {
                              $sub_cat_id  = $fetch['sub_cat_id'];
                              $sub_cat_title = $fetch['sub_cat_title'];
                              echo "<option value='$sub_cat_id' name='sub_cat_id'>$sub_cat_title</option>";
                            }
                            ?>
                          <?php } else {
                            $product_cat_id = "";
                          } ?>
                        </select>
                      </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Company/Brand Name</label>
                      <select class="form-control" required="" name="product_brand_id">
                        <option value='null' name="product_brand_id">Select Brand
                        </option>
                        <?php
                        $sql = "SELECT * FROM pro_brands ORDER BY brand_title ASC";
                        $query = mysqli_query($con, $sql);
                        while ($fetch = mysqli_fetch_assoc($query)) {
                          $brand_id  = $fetch['brand_id'];
                          $brand_title = $fetch['brand_title'];

                          echo "<option value='$brand_id' name='product_brand_id'>$brand_title</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                </div>
                <input type="text" name="product_cat_id" value="<?php echo $product_cat_id; ?>" hidden="">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Product Name </label>
                        <input type="text" name="product_title" value='' class="form-control" required="">
                      </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Product Modal Number</label>
                        <input type="text" name="ProductModalNo" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Product Modal Number By Company For SEO</label>
                        <input type="text" name="product_modal_for_seo" class="form-control">
                      </div>
                    </div>


                    <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Product Size Capacity</label>
                        <input type="text" name="ProductSizeCapacity" class="form-control">
                      </div>
                    </div>


                    <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Product Size Capacity (Show/Hide)</label>
                        <select class="form-control" name="product_size_capacity_status">
                          <option value="Show" selected>Show</option>
                          <option value="hide">Hide</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Unique Feature</label>
                        <input type="text" name="unique_feature" value='' class="form-control">
                      </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Year of MFG / Edition</label>
                        <input type="text" name="ProductEdition" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Year of MFG / Edition Status</label>
                        <select class="form-control" name="product_edition_status">
                          <option value="Show" selected>Show</option>
                          <option value="hide">Hide</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Warranty in Year/Months/days</label>
                        <input type="text" name="product_warranty_in_diff_time" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Warranty in Break</label>
                        <input type="text" name="product_warranty_in_break" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Top List product (Yes/No)</label>
                        <select class="form-control" name="product_top_list_status">
                          <option value="Show" selected>Show</option>
                          <option value="hide">Hide</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label class="control-label">Measurement/Units</label>
                        <input type="text" name="product_measure_unit" value='' class="form-control" placeholder="example: 1 or 500">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label class="control-label">Select Unit</label>
                        <select class="form-control" name="unit_type">
                          <option value='PCs' selected>PCS</option>
                          <option value='Kg'>KG</option>
                          <option value='Tons'>Tons</option>
                          <option value='Litre'>Litre</option>
                          <option value='Meter'>Meter</option>
                          <option value='WATT'>Watt</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Offer Applicable (Yes/No)</label>
                        <select class="form-control" name="product_offer_status">
                          <option value="YES" selected>Yes</option>
                          <option value="NO">No</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Stock In</label>
                        <input type="text" name="product_stock_in" value='' class="form-control" placeholder="example: 1 or 500">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Stock Alert On</label>
                        <input type="text" name="product_stock_alert_on" value='' class="form-control" placeholder="example: 1 or 500">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Item Type</label>
                        <select class="form-control" name='product_type'>
                          <option value='null' selected="">NONE</option>
                          <option value='RECOMMENDED'>RECOMMENDED</option>
                          <option value='BEST'>BEST SELLING</option>
                          <option value="TODAY_DEALS"> DEAL OF THE DAY</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Offer Price/Selling Price (Rs.)</label>
                        <input type="text" name="product_offer_price" id="productPrice" oninput="NetProductPrice()" value='' class="form-control">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">MRP Price (Rs.)</label>
                        <input type="text" id="mrp_amount" name="product_mrp_price" oninput="CalculateSaveAmount()" value='' class="form-control">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Save Amount in Rs.</label>
                        <input type="text" name="product_save_amount" id="save_amount" value='' class="form-control">
                      </div>
                    </div>
                    <script>
                      function CalculateSaveAmount() {
                        var mrp_amount = document.getElementById("mrp_amount").value;
                        var productPrice = document.getElementById("productPrice").value;
                        var save_amount = mrp_amount - productPrice;
                        document.getElementById("save_amount").value = save_amount;
                      }
                    </script>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">PRODUCT HSN</label>
                        <input type="text" name="product_HSN" value='' class="form-control">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Applicable GST</label>
                        <select type="text" name="products_taxes" id="gsttaxes" onchange="NetProductPrice()" class="form-control">
                          <option value="0" selected>No GST Applicable</option>
                          <option value='3'>3 %</option>
                          <option value='5'>5 %</option>
                          <option value='12'>12 %</option>
                          <option value='15'>15 %</option>
                          <option value='18'>18 %</option>
                          <option value='28'>28 %</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Product TAX Amount</label>
                        <input type="text" oninput="CalculatePrice()" name="product_net_price" id="net_price" value='' class="form-control">
                      </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Return Policy Applicable (Yes/No)</label>
                        <select class="form-control" name="product_return_policy_status">
                          <option value="YES" selected>Yes</option>
                          <option value="NO">No</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Return Policy Charge Amount</label>
                        <input type="text" name="product_return_policy_charge_amount" value='' class="form-control">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Return Policy Time in Days</label>
                        <input type="text" name="product_return_time_in_days" value='' class="form-control">
                      </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Installation Charge (Show/Hide)</label>
                        <select class="form-control" name="product_installation_charge_status">
                          <option value="YES" selected>Show</option>
                          <option value="NO">Hide</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Installation Charge </label>
                        <input type="text" name="product_installation_charge" value='' class="form-control">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Installation Charge Pincode Wise </label>
                        <input type="text" name="product_installation_charge_pincode_wise" value='' class="form-control">
                      </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Delivery Charge (Show/Hide)</label>
                        <select class="form-control" name="product_delivery_charge_status">
                          <option value="YES" selected="">Show</option>
                          <option value="NO">Hide</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Delivery Charge </label>
                        <input type="text" name="product_delivery_charge" value='' class="form-control">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Delivery Charge Pincode Wise </label>
                        <input type="text" name="product_delivery_charge_pincode_wise" value='' class="form-control">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Product Status</label>
                        <select class="form-control" name="product_status">
                          <option value="active" selected="">Active</option>
                          <option value="inactive">Inactive</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Product Sort By Order </label>
                        <input type="number" name="product_sort_by_order" value='1' class="form-control">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Product Images </label>
                        <input type="file" accept="image/*" name="product_image" value='' class="form-control">
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Product Description</label>
                        <textarea name="product_description" class="form-control" rows="5"></textarea>
                      </div>
                      <hr>
                    </div>

                  </div>

                  <div class="panel-footer text-right">
                    <?php $user_role = $_SESSION['user_role'];
                    if ($user_role == "admin") { ?>
                      <a href="products.php" class="btn btn-default">Back to Products</a>
                    <?php } elseif ($user_role == "store_user") { ?>
                      <a href="product.php" class="btn btn-default">Back to Products</a>
                    <?php } ?>
                    <button class="btn btn-success" type="submit" name="insert_products">Save Products</button>
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

  <script>
    function NetProductPrice() {
      var selectedValue = document.getElementById("gsttaxes").value;
      var productPrice = document.getElementById("productPrice").value;
      var netPrice = document.getElementById("net_price");
      var save_amount = document.getElementById("save_amount");
      var mrp_amount = document.getElementById("mrp_amount");

      priceDifference = +productPrice / 100 * +selectedValue;
      newPrice = priceDifference;

      netPrice.value = Math.round(newPrice * 100) / 100;
    }
  </script>

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