<?php
require 'files.php';
require 'session.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM stores where user_id='$user_id'";
$query =  mysqli_query($con, $sql);
$fetchstore = mysqli_fetch_assoc($query);
$store_id = $fetchstore['store_id'];

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title><?php echo $fetchstore['store_name']; ?> : <?php echo $PosName; ?></title>
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
        <h4 class="users-action"><?php echo $fetchstore['store_name']; ?> <i class="fa fa-angle-right"></i>
         Combo Products <i class="fa fa-angle-right"></i>
         <a href="combo_products.php"><i class="fa fa-plus"></i> ADD Combos</a>
        </h4>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table table-striped dom-jQuery-events">
           <thead>
            <tr>
             <th style="padding: 1%; font-size: 12px;">#</th>
             <th style="padding: 1%; font-size: 12px;">Action</th>
             <th style="padding: 1%; font-size: 12px;">Image</th>
             <th style="padding: 1%; font-size: 12px;">Combo Title</th>
             <th style="padding: 1%; font-size: 12px;">Combo Type</th>
             <th style="padding: 1%; font-size: 12px;">Combo Price (MRP/SELL)</th>
             <th style="padding: 1%; font-size: 12px;">Created On</th>
             <th style="padding: 1%; font-size: 12px;">Status</th>
            </tr>
           </thead>
           <tbody>
            <?php
                        if (isset($_GET['user_id'])) {
                          $user_id = $_GET['user_id'];
                        } else {
                          $user_id = $_SESSION['user_id'];
                        }
                        $sql = "SELECT * from combos_products where store_id='$store_id'";

                        $query = mysqli_query($con, $sql);
                        $count = mysqli_num_rows($query);
                        if ($count == 0) {
                          echo "
   <tr>
      <td colspan='11' align='center'><h2>No Data Avaialable</h2></td>
   </tr>
  ";
                        }
                        $num = 0;
                        while ($fetch = mysqli_fetch_assoc($query)) {
                          $combo_id = $fetch['combo_id'];
                          $store_id = $fetch['store_id'];
                          $Combo_title = $fetch['Combo_title'];
                          $offer_price_total = $fetch['offer_price_total'];
                          $mrp_total = $fetch['mrp_total'];
                          $combo_img = $fetch['combo_img'];
                          $combo_type = $fetch['combo_type'];
                          $combo_status = $fetch['combo_status'];
                          $added_date = $fetch['added_date'];

                          $num++;

                          if ($combo_status == "active") {
                            $status = "<i class='text-success fa fa-check-circle'> Active</i>";
                          } elseif ($combo_status == "inactive") {
                            $status = "<i class='text-warning fa fa-warning'> Inactive</i>";
                          }

                          echo "
   <tr>
     <td style='padding: 1%; font-size: 12px;'>$num</td>
     <td style='padding: 1%; font-size: 12px;'>
     <a href='combo_edit.php?combo_id=$combo_id' class='text-success btn-link'><i class='fa fa-edit'></i></a> &nbsp;&nbsp;
     <a href='delete.php?delete_combo=$combo_id' class='text-danger'><i class='fa fa-trash'></i></a>
     </td>
     <td style='padding: 1%; font-size: 12px;'><img src='img/store_img/combo_img/$combo_img' style='width:40px;'></td>
     <td style='padding: 1%; font-size: 12px;'><a href='combo_edit.php?combo_id=$combo_id' class='text-info'>$Combo_title</a></td>
     <td style='padding: 1%; font-size: 12px;'>$combo_type</td>
     <td style='padding: 1%; font-size: 12px;'>Rs.$mrp_total / Rs.$offer_price_total</td>
     <td style='padding: 1%; font-size: 12px;'>$added_date</td>
     <td style='padding: 1%; font-size: 12px;'>$status</td>

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