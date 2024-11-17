        <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
        <link
         href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
         rel="stylesheet">

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="https://fonts.googleapis.com/css2?family=Commissioner&display=swap" rel="stylesheet">
        <script type="text/javascript" src="test.php"></script>
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/colors.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/components.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
        <!-- END: Theme CSS-->

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/pages/card-statistics.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/pages/vertical-timeline.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/ui/prism.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/tags/tagging.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/quill/katex.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/quill/monokai-sublime.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/quill/quill.snow.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/quill/quill.bubble.css">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="app-assets/fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/toggle/switchery.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/switch.min.css">
        <!-- END: Custom CSS-->

        <link rel="stylesheet" href="app-assets/charts/dist/bar.chart.min.css" />
        <script src="app-assets/charts/dist/jquery.bar.chart.min.js"></script>
        <link href="css-circular-prog-bar.css" media="all" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-tooltip.min.css">
        <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

        <script type="text/javascript">
var uri = window.location.toString();
if (uri.indexOf("?") > 0) {
 var clean_uri = uri.substring(0, uri.indexOf("?"));
 window.history.replaceState({}, document.title, clean_uri);
}
        </script>

        <script type="text/javascript">
$(document).ready(function() {
 $('.zero-configuration').DataTable({
  "lengthMenu": [
   [<?php echo SYS_CONFIG("DATA_VIEW"); ?>],
   [<?php echo SYS_CONFIG("DATA_VIEW"); ?>]
  ]
 });
});
        </script>