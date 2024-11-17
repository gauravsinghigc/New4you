<?php
session_start();
require 'files.php';
require 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Products : <?php echo $name;?></title>
        <link rel="shortcut icon" href="img/favicon.ico">
        <!--STYLESHEET-->
        <!--=================================================-->
        <!--Roboto Slab Font [ OPTIONAL ] -->
<link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,700" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Roboto:500,400italic,100,700italic,300,700,500italic,400" rel="stylesheet">
<!--Bootstrap Stylesheet [ REQUIRED ]-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!--Jasmine Stylesheet [ REQUIRED ]-->
<link href="css/style.css" rel="stylesheet">
<!--Font Awesome [ OPTIONAL ]-->
<link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!--Switchery [ OPTIONAL ]-->
<link href="plugins/switchery/switchery.min.css" rel="stylesheet">
<!--Bootstrap Select [ OPTIONAL ]-->
<link href="plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
<!--Bootstrap Table [ OPTIONAL ]-->
<link href="plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<!--Demo [ DEMONSTRATION ]-->
<link href="css/demo/jasmine.css" rel="stylesheet">
<!--SCRIPT-->
<!--=================================================-->
<!--Page Load Progress Bar [ OPTIONAL ]-->
<link href="plugins/pace/pace.min.css" rel="stylesheet">
<script src="plugins/pace/pace.min.js"></script>

    </head>
    <!--TIPS-->
    <!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
    <body>
        <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
            <!--NAVBAR-->
            <?php require 'header.php'; ?>
            <!--===================================================-->
            <!--END NAVBAR-->
            <div class="boxed">
                <!--CONTENT CONTAINER-->
                <!--===================================================-->
                <div id="content-container">
                    <?php require 'user_tools.php'; ?>
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div class="pageheader">
                        <h3><i class="fa fa-home"></i>Featured Product</h3>
                        <div class="breadcrumb-wrapper">
                            <span class="label">Page Location:</span>
                            <ol class="breadcrumb">
                                <li><a href="admin.php"> Home </a> </li>
                                <li><a href="products.php">Products</a></li>
                            </ol>
                        </div>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->
                    <!--Page content-->
                    <!--===================================================-->
                    <div id="page-content">

                       <div class="row">
                        <div class="col-lg-12 col-md-12">
                         <div class="panel">
                          <?php msg();?>
                         </div>
                        </div>
                       </div>

                       <div class="row">
                           <div class="col-lg-12">
                               <div class="panel">
                                   <div class="panel-heading">
                                    <a href="add_sub_category.php" class="text-white">
                                     <button class="btn btn-sm btn-info text-white btn_mr"><i class="fa fa-plus"></i> Sub Category</buttton>
                                    </a>
                                    <a href="add_brand.php" class="text-white">
                                     <button class="btn btn-sm btn-info text-white btn_mr"><i class="fa fa-plus"></i> Brand</buttton>
                                    </a>
                                    <a href="add_product.php" class="text-white">
                                     <button class="btn btn-sm btn-info text-white btn_mr"><i class="fa fa-plus"></i> Products</buttton>
                                    </a>
                                    <a href="store_products.php" class="text-white pull-right">
                                     <button class="btn btn-sm btn-info text-white btn_mr pull-right"><i class="fa fa-refresh"></i> Add Products From Store</buttton>
                                    </a>
                                   </h3>
                                   </div>
                                   <div class="panel-body">
                                       <!--Hover Rows-->
                                       <!--===================================================-->
                                       <table  id="demo-dt-basic" class="table table-striped table-bordered">
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>Action</th>
                                                   <th>Image</th>
                                                   <th>Product Title</th>
                                                   <th>Category</th>
                                                   <th>Sub Cat</th>
                                                   <th>Brand</th>
                                                   <th>Price(MRP/OFFER)</th>
                                                   <th>UNIT</th>
                                                   <th>Status</th>
                                                   <th>Added By</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <?php fetch_products_for_store_user_feature();?>

                                           </tbody>
                                       </table>
                                       <!--===================================================-->
                                       <!--End Hover Rows-->
                                   </div>
                               </div>
                           </div>
                       </div>

                    <!--===================================================-->
                    <!--End page content-->
                    </div>
                <!--===================================================-->
                <!--END CONTENT CONTAINER-->
                <!--MAIN NAVIGATION-->
                <!--===================================================-->
               <?php require 'sidebar.php'; ?>
                <!--===================================================-->
                <!--END MAIN NAVIGATION-->
                <!--ASIDE-->
                <!--===================================================-->
                <?php require 'right_side_status.php'; ?>
            </div>
            <!-- FOOTER -->
           <?php require 'footer.php'; ?>
            <!-- END FOOTER -->
            <!-- SCROLL TOP BUTTON -->
            <!--===================================================-->
            <button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
            <!--===================================================-->
        </div>
        <!--===================================================-->
        <!-- END OF CONTAINER -->
        <!--JAVASCRIPT-->
        <!--jQuery [ REQUIRED ]-->
        <script src="js/jquery-2.1.1.min.js"></script>
        <!--BootstrapJS [ RECOMMENDED ]-->
        <script src="js/bootstrap.min.js"></script>
        <!--Fast Click [ OPTIONAL ]-->
        <script src="plugins/fast-click/fastclick.min.js"></script>
        <!--Jasmine Admin [ RECOMMENDED ]-->
        <script src="js/scripts.js"></script>
        <!--Switchery [ OPTIONAL ]-->
        <script src="plugins/switchery/switchery.min.js"></script>
        <!--Bootstrap Select [ OPTIONAL ]-->
        <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <!--DataTables [ OPTIONAL ]-->
        <script src="plugins/datatables/media/js/jquery.dataTables.js"></script>
        <script src="plugins/datatables/media/js/dataTables.bootstrap.js"></script>
        <script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
        <!--Fullscreen jQuery [ OPTIONAL ]-->
        <script src="plugins/screenfull/screenfull.js"></script>
        <!--Demo script [ DEMONSTRATION ]-->
        <script src="js/demo/jasmine.js"></script>
        <!--DataTables Sample [ SAMPLE ]-->
        <script src="js/demo/tables-datatables.js"></script>

    </body>
</html>
