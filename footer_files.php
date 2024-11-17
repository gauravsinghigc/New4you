<script>
//scroll acitivity
window.onscroll = function() {
 myFunction();
};
var header2 = document.getElementById("app-top-header");
var headermob = document.getElementById("app-top-header2");
var sticky = header2.offsetTop;
var stickymob = headermob.offsetTop;

function myFunction() {
 if (window.pageYOffset > sticky) {
  header2.classList.add("fixed-top");
  headermob.classList.add("fixed-top");
 } else {
  header2.classList.remove("fixed-top");
  headermob.classList.remove("fixed-top");
 }
}
</script>
<script>
function PriceView(int) {
 var value = int;
 document.body.innerHTML = value.toLocaleString();
}
</script>
<script type="text/javascript">
var products = [<?php
                    $sql = "SELECT * FROM user_products where product_status='active' GROUP BY product_title ORDER BY product_title ASC";
                    $query = mysqli_query($con, $sql);
                    while ($fetch = mysqli_fetch_assoc($query)) {
                        $product_title = $fetch['product_title'];
                        echo '"' . $product_title . '",';
                    } ?>]

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
    b.innerHTML += "<a href='products.php'><input type='hidden' value='" + arr[i] + "'><a>";
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
autocomplete(document.getElementById("bavbaritems"), products);
</script>

<!-- latest jquery-->
<script src="assets/js/jquery-3.3.1.min.js"></script>

<!-- slick js-->
<script src="assets/js/slick.js"></script>

<!-- popper js-->
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap-notify.min.js"></script>

<!-- menu js-->
<script src="assets/js/menu.js"></script>

<!-- timer js -->
<!-- Bootstrap js-->
<script src="assets/js/bootstrap.js"></script>

<!-- tool tip js -->
<script src="assets/js/tippy-popper.min.js"></script>
<script src="assets/js/tippy-bundle.iife.min.js"></script>

<!-- father icon -->
<script src="assets/js/feather.min.js"></script>
<script src="assets/js/feather-icon.js"></script>

<!-- Theme js-->
<script src="assets/js/modal.js"></script>
<script src="assets/js/script.js"></script>
