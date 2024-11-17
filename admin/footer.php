<!-- Buynow Button -->
<!--
 BEGIN: Footer-->

<script type="text/javascript">
$('.numbers').each(function() {
 $(this).prop('Counter', 0).animate({
  Counter: $(this).text()
 }, {
  duration: 3000,
  easing: 'linear',
  step: function(now) {
   $(this).text(Math.ceil(now));
  }
 });
});
</script>
<script type="text/javascript">
//loader script
document.onreadystatechange = function() {
 if (document.readyState !== "complete") {
  document.querySelector("body").style.visibility = "hidden";
  document.querySelector("#loader").style.visibility = "visible";
 } else {
  document.querySelector("#loader").style.display = "none";
  document.querySelector("body").style.visibility = "visible";
 }
};
</script>
<script>
var options = {
 debug: 'info',
 modules: {
  toolbar: '#toolbar'
 },
 placeholder: 'Compose an epic...',
 readOnly: true,
 theme: 'snow'
};
var editor = new Quill('#editor', options);
</script>
<!-- BEGIN: Vendor JS-->
<script src="app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
<script src="app-assets/vendors/js/tables/buttons.flash.min.js"></script>
<script src="app-assets/vendors/js/tables/jszip.min.js"></script>
<script src="app-assets/vendors/js/tables/pdfmake.min.js"></script>
<script src="app-assets/vendors/js/tables/vfs_fonts.js"></script>
<script src="app-assets/vendors/js/tables/buttons.html5.min.js"></script>
<script src="app-assets/vendors/js/tables/buttons.print.min.js"></script>
<script src="app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js"></script>
<script src="app-assets/vendors/js/forms/toggle/switchery.min.js"></script>
<!-- END: Page Vendor JS-->

<script src="app-assets/vendors/js/extensions/jquery.knob.min.js"></script>
<script src="app-assets/vendors/js/charts/raphael-min.js"></script>
<script src="app-assets/vendors/js/charts/morris.min.js"></script>
<script src="app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
<script src="app-assets/vendors/js/charts/apexcharts/apexcharts.min.js"></script>

<!-- BEGIN: Theme JS-->
<script src="app-assets/js/core/app-menu.min.js"></script>
<script src="app-assets/js/core/app.min.js"></script>
<script src="app-assets/js/scripts/customizer.min.js"></script>
<script src="app-assets/js/scripts/cards/card-statistics.min.js"></script>
<script src="app-assets/js/scripts/forms/switch.min.js"></script>
<script src="app-assets/js/scripts/forms/tags/tagging.min.js"></script>
<script src="app-assets/vendors/js/ui/prism.min.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="app-assets/js/scripts/tables/datatables/datatable-advanced.min.js"></script>
<script src="app-assets/js/scripts/tables/datatables/datatable-basic.min.js"></script>
<script src="app-assets/js/scripts/popover/popover.min.js"></script>
<script src="app-assets/vendors/js/forms/quill/highlight.min.js"></script>
<script src="app-assets/vendors/js/forms/quill/quill.js"></script>
<script src="app-assets/vendors/js/forms/quill/katex.min.js"></script>
<script src="app-assets/js/scripts/forms/quill/form-text-editor.min.js"></script>