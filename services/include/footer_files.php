<script src="<?php echo $DOMAIN; ?>/assets/js/bootstrap.bundle.js"></script>
<script src="<?php echo $DOMAIN; ?>/assets/js/bootstrap.bundle.js.map"></script>
<script src="<?php echo $DOMAIN; ?>/assets/js/custom.js"></script>
<script src="<?php echo $DOMAIN; ?>/assets/js/owl.carousel.js"></script>
<script src="<?php echo $DOMAIN; ?>/assets/js/owl.carousel.min.js"></script>
<script>
 function actionBtn(type, text) {
  document.getElementById("" + type + "").innerHTML = "<i class='fa fa-spinner fa-spin'></i> " + text;
  document.getElementById("" + type + "").classList.remove("btn-primary");
  document.getElementById("" + type + "").classList.remove("btn-success");
  document.getElementById("" + type + "").classList.remove("btn-danger");
  document.getElementById("" + type + "").classList.remove("btn-warning");
  document.getElementById("" + type + "").classList.remove("btn-dark");
  document.getElementById("" + type + "").classList.remove("square");
  document.getElementById("" + type + "").classList.add("app-bg");
  document.getElementById("" + type + "").classList.add("text-black");
 }
</script>

<script>
 function Databar(data) {
  databar = document.getElementById("" + data + "");
  if (databar.style.display === "block") {
   databar.style.display = "none";
  } else {
   databar.style.display = "block";
  }
 }
</script>

<script>
 $('.count').each(function() {
  $(this).prop('Counter', 0).animate({
   Counter: $(this).text()
  }, {
   duration: 4000,
   easing: 'swing',
   step: function(now) {
    $(this).text(Math.ceil(now));
   }
  });
 });
</script>

<script>
 window.onscroll = function() {
  myFunction();
 };
 var header = document.getElementById("NavbarControl");
 var sticky = header.offsetTop;

 function myFunction() {
  if (window.pageYOffset > sticky) {
   header.classList.add("fixed-top");
   header.classList.add("bg-warning");
  } else {
   header.classList.remove("fixed-top");
   header.classList.remove("bg-warning");
  }
 }
</script>

<script>
 window.onscroll = function() {
  myFunction();
 };
 var header2 = document.getElementById("header");
 var sticky = header2.offsetTop;

 function myFunction() {
  if (window.pageYOffset > sticky) {
   header2.classList.add("fixed-top");
  } else {
   header2.classList.remove("fixed-top");
  }
 }
</script>