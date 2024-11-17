<?php
require 'files.php';
require 'session.php';
$store_user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM stores where user_id = '$store_user_id'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$store_id = $fetch['store_id'];

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName;?>">
 <title>Combo Products : <?php echo $PosName;?></title>
 <?php include 'header_files.php';?>

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
     <?php notification();?>
    </div>
   </div>



   <div class="content-body">
    <!-- users list start -->
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action mobile-font-size">Combo Products <i class="fa fa-angle-right"></i> <small>Enter Combo
          Information</small>
         <a href='combos.php' class='btn btn-link text-primary'><i class="fa fa-eye"></i> All Combos</a>
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
         <form action="combo_entry.php" method="POST" enctype="multipart/form-data">
          <input type='text' name='store_id' value='<?php echo $store_id;?>' hidden>
          <div class="panel-body">
           <div class="row">
            <div class="col-sm-6">
             <div class="form-group">
              <label class="control-label">Combo Type</label>
              <select name="COMBO_TYPE" class="form-control" required="">
               <option value='SINGLE'>Single (Multipack)</option>
               <option value='DOUBLE'>Double (2 Items)</option>
               <option value='TRIPPLE'>Tripple (3 Items)</option>
              </select>
             </div>
            </div>
            <div class="col-sm-6">
             <div class="form-group">
              <label class="control-label">Combo Title</label>
              <input type="text" name="Combo_title" value='' class="form-control" required="">
             </div>
            </div>
           </div>
           <div class="row">
            <div class="col-sm-12">
             <div class="form-group">
              <label class="control-label">Choose Items <small> <i class="fa fa-angle-right"></i> if Combo type is
                Single than select only this and left rest items blanks.</small></label>
              <input type='text' id="item_1" name='item_1' value='' class="form-control">
             </div>
            </div>
            <div class="col-sm-12">
             <div class="form-group">
              <label class="control-label">Choose Items <small><i class="fa fa-angle-right"></i> if combo type double
                than select this too else left this blank.</small></label>
              <input type='text' id="item_2" name='item_2' value='' class="form-control">
             </div>
            </div>
            <div class="col-sm-12">
             <div class="form-group">
              <label class="control-label">Choose Items <small><i class="fa fa-angle-right"></i> if combo type is
                tripple than select this too. or left blank.</small></label>
              <input type='text' id="item_3" name='item_3' value='' class="form-control">
             </div>
            </div>
           </div>



           <div class="panel-footer text-right">
            <?php $user_role = $_SESSION['user_role'];
                                          if($user_role == "SUPER_ADMIN") {?>
            <a href="products.php" class="btn btn-default">Back to Products</a>
            <?php } elseif($user_role == "STORE_USER") {?>
            <a href="product.php" class="btn btn-default">Back to Products</a>
            <?php } ?>
            <button class="btn btn-success" type="submit" name="insert_products_combo_products">Continue</button>
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
 <script type="text/javascript">
 var items_1 = [<?php
  $sql_sr = "SELECT * FROM user_products where user_id='$store_user_id'";
  $query_src = mysqli_query($con, $sql_sr);
  while ($search = mysqli_fetch_assoc($query_src)) {
   $product_title = $search['product_title'];
   $product_tags = $search['product_tags'];
   $product_offer_price = $search['product_offer_price'];
   echo '"'.$product_title.'",';
  } ?>];
 </script>

 <script type="text/javascript">
 var items_2 = [<?php
  $sql_sr = "SELECT * FROM user_products where user_id='$store_user_id'";
  $query_src = mysqli_query($con, $sql_sr);
  while ($search = mysqli_fetch_assoc($query_src)) {
   $product_title = $search['product_title'];
   $product_tags = $search['product_tags'];
   $product_offer_price = $search['product_offer_price'];
   echo '"'.$product_title.'",';
  } ?>];
 </script>

 <script type="text/javascript">
 var items_3 = [<?php
  $sql_sr = "SELECT * FROM user_products where user_id='$store_user_id'";
  $query_src = mysqli_query($con, $sql_sr);
  while ($search = mysqli_fetch_assoc($query_src)) {
   $product_title = $search['product_title'];
   $product_tags = $search['product_tags'];
   $product_offer_price = $search['product_offer_price'];
   echo '"'.$product_title.'",';
  } ?>];
 </script>
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

autocomplete(document.getElementById("item_1"), items_1);
autocomplete(document.getElementById("item_2"), items_2);
autocomplete(document.getElementById("item_3"), items_3);
</script>