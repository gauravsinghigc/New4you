<?php
require 'files.php';
require 'session.php';
$title_name = "ALL Categories";

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
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action"><i class="fa fa-table text-primary"></i> <?php echo $title_name; ?> <i
          class="fa fa-angle-right"></i>
         <a href="add_categories.php"><i class="fa fa-plus"></i> Add Categories</a>
         <a href="sub_categories.php"><i class="fa fa-eye"></i> View Sub Categories</a>
         <a href="brands.php"><i class="fa fa-eye"></i> View Brands</a>
         <a href="stock.php"><i class="fa fa-eye"></i> View Stock</a>
        </h4>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table table-striped zero-configuration" style="font-size: 12px !important;">
           <thead>
            <tr>
             <th style="width: 2% !important;">#</th>
             <th style="width: 3% !important;">Image</th>
             <th style="width: 10% !important;">Change Image</th>
             <th style="width: 29% !important;">Title</th>
             <th style="width: 3% !important;">Sub Cats</th>
             <th style="width: 3% !important;">Stock</th>
             <th style="width: 13% !important;">ADD Date</th>
             <th style="width: 7% !important;">Status</th>
             <th style="width: 5% !important;">SortBy</th>
             <th style="width: 15% !important;">Action</th>
            </tr>
           </thead>
           <tbody align="center">
            <?php
                                                $user_role = $_SESSION['user_role'];
                                                if ($user_role == "SUPER_ADMIN") {
                                                    $sql = "SELECT * FROM product_categories";
                                                } else {
                                                    $store_user_id = $_SESSION['user_id'];
                                                    $select_store = "SELECT * FROM stores where user_id='$store_user_id'";
                                                    $store_query = mysqli_query($con, $select_store);
                                                    $fetch_store = mysqli_fetch_assoc($store_query);
                                                    $store_id = $fetch_store['store_id'];
                                                    $sql = "SELECT * FROM product_categories where store_id='$store_id' ORDER BY product_cat_title ASC";
                                                }

                                                $query = mysqli_query($con, $sql);
                                                $count = mysqli_num_rows($query);
                                                if ($count == 0) {
                                                    echo "
   <tr>
      <td colspan='7' align='center'><h2>No Data Avaialable</h2></td>
   </tr>
  ";
                                                }
                                                $num = 0;
                                                while ($fetch =  mysqli_fetch_assoc($query)) {

                                                    $product_cat_id = $fetch['product_cat_id'];
                                                    $category_img = $fetch['category_img'];
                                                    $product_cat_title = $fetch['product_cat_title'];
                                                    $product_cat_add_date = date("D d M, Y", strtotime($fetch['product_cat_add_date']));
                                                    $product_cat_status = $fetch['product_cat_status'];
                                                    $sortby = $fetch['sortby'];
                                                    $num++;

                                                    if ($product_cat_status == "active") {
                                                        $status = '<input type="checkbox" id="switcherySize3" class="switchery" data-size="xs" checked/>';
                                                        $StatusC = "Inactive";
                                                    } elseif ($product_cat_status == "inactive") {
                                                        $status = '<input type="checkbox" id="switcherySize3" class="switchery" data-size="xs"/>';
                                                        $StatusC = "Active";
                                                    }

                                                    $sql = "SELECT * FROM product_sub_categories where product_cat_id='$product_cat_id'";
                                                    $subquery = mysqli_query($con, $sql);
                                                    $CountSubCategories = mysqli_num_rows($subquery);
                                                    if ($CountSubCategories == 0) {
                                                        $CountSubCategories = 0;
                                                    } else {
                                                        $CountSubCategories = $CountSubCategories;
                                                    }

                                                    $Productsql = "SELECT * FROM user_products where product_cat_id='$product_cat_id'";
                                                    $Productquery = mysqli_query($con, $Productsql);
                                                    $CountProducts = mysqli_num_rows($Productquery);
                                                    if ($CountProducts == 0) {
                                                        $CountProducts = 0;
                                                    } else {
                                                        $CountProducts = $CountProducts;
                                                    }

                                                    if ($CountSubCategories == 0) {
                                                        $btnst = "";
                                                        $msgpop = "";
                                                    } else {
                                                        $btnst = "disabled";
                                                        $msgpop = "Please Delete First all Sub Categories of $product_cat_title";
                                                    }

                                                    echo "
   <tr>
   <form action='update.php' method='POST' enctype='multipart/form-data'>
      <td>$num</td>
      <td align='center'>
      <img src='img/store_img/cat_img/$category_img' style='width:33px;'>
      </td>
      <td>
      <input type='FILE' name='category_img' value='' class='d-input' style='font-size:8px !important;'>
      </td>
      <td style='color:black !important;'>
      <input type='text' name='product_cat_title' value='$product_cat_title' class='form-control d-input'>
      </td>
      <td>$CountSubCategories</td>
      <td>$CountProducts</td>
      <td>$product_cat_add_date</td>
      <td align='center'>
      <center><a href='update.php?cat_id=$product_cat_id&value=$product_cat_status&cat_title=$product_cat_title' alt='click to change status' title='click to change status'>$status</a></center></td>
      <td><input type='number' class='form-control d-input' name='sortby' value='$sortby' min='1' max='$count' required=''></td>
      <td>
      <button type='submit' name='UpdateCategories' class='btn btn-primary btn-sm' value='$product_cat_id'>Update</button>
      <a href='delete.php?delete_cat=$product_cat_id' class='btn btn-danger btn-sm $btnst' alt='$msgpop'><i class='fa fa-trash'></i></a>
      </td>
    </form>
   </tr>
  ";
                                                }
                                                ?>

           </tbody>
          </table>
         </div>
         <!-- datatable ends -->
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