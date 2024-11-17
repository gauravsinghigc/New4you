<?php
require 'files.php';
require 'session.php';
$title_name = "Enter New Purchase";

if (isset($_POST['CREATE_NEW_PURCHASE'])) {
 $_SESSION['ExpansesId'] = "EXP" . date("dmy") . rand(0, 100000000000000);
 $_SESSION['CREATE_NEW_PURCHASE'] = $_POST['CREATE_NEW_PURCHASE'];
 $_SESSION['CustomerId'] = $_POST['CustomerId'];
 $_SESSION['ExpansesCategories'] = $_POST['ExpansesCategories'];
 $_SESSION['ExpansesDate'] = date("d M Y", strtotime($_POST['ExpansesDate']));
 $_SESSION['ExpansesDueDate'] = date("d M Y", strtotime($_POST['ExpansesDueDate']));
} else {
 $_SESSION['ExpansesId'] = $_SESSION['ExpansesId'];
 $_SESSION['CREATE_NEW_PURCHASE'] = $_SESSION['CREATE_NEW_PURCHASE'];
 $_SESSION['CustomerId'] = $_SESSION['CustomerId'];
 $_SESSION['ExpansesCategories'] = $_SESSION['ExpansesCategories'];
 $_SESSION['ExpansesDate'] = $_SESSION['ExpansesDate'];
 $_SESSION['ExpansesDueDate'] = $_SESSION['ExpansesDueDate'];
}
if ($_SESSION['CustomerId'] == "null") {
 header("locations: purchases.php?t=danger&a=Error&m=Please Select CustomerId too...");
} else {
 $SQL_customers = "SELECT * from customers where customer_id='" . $_SESSION['CustomerId'] . "'";
 $QUERY_customers = mysqli_query($con, $SQL_customers);
 $FETCH_customer = mysqli_fetch_array($QUERY_customers);
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title><?php echo $title_name; ?> : <?php echo $PosName; ?></title>
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

    <!-- Purchase Block Entry -->

    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action"><i class="fa fa-shopping-cart text-primary"></i> <?php echo $title_name; ?> <i
          class="fa fa-angle-right"></i>
         <a href="#" data-toggle='modal' data-target='#ADD_NEW_PURCHASE'><i class="fa fa-plus"></i> New Purchase</a>
        </h4>
       </div>
       <div class="card-content">
        <div class="card-body">


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