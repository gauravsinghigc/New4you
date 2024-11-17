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
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Combo Products : <?php echo $PosName; ?></title>
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
        <h4 class="users-action mobile-font-size">Combo Products <i class="fa fa-angle-right"></i> <small>Combo Price
          Details</small></h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
         <ul class="list-inline mb-0">
          <li><a data-action="expand"><i class="fa fa-expand"></i></a></li>
         </ul>
        </div>
       </div>
       <div class="card-content">
        <div class="card-body">
         <form action="insert.php" method="POST" enctype="multipart/form-data">
          <input type='text' name='store_id' value='<?php echo $store_id; ?>' hidden>
          <input tyep='text' name='COMBO_TYPE' value='<?php echo $_POST['COMBO_TYPE']; ?>' hidden="">
          <input type="text" name="Combo_title" value='<?php echo $_POST['Combo_title']; ?>' class="form-control"
           required="" hidden="">
          <div class="panel-body">
           <div class="row">
            <div class="col-sm-6">
             <div class="form-group">
              <label class="control-label"><b>Combo Type</b> :
               <?php echo $_POST['COMBO_TYPE']; ?></label>
             </div>
            </div>
            <div class="col-sm-6">
             <div class="form-group">
              <label class="control-label"><b>Combo Title</b> :
               <?php echo $_POST['Combo_title']; ?></label>
             </div>
            </div>
           </div>
           <div class="row">
            <div class="col-sm-12">
             <table style='width:100%;'>
              <thead>
               <tr>
                <th>Product Name</th>
                <th>Product Mrp</th>
                <th>Product Offer Price</th>
               </tr>
              </thead>
              <tbody>
               <?php
                                                            $COMBO_TYPE = $_POST['COMBO_TYPE'];
                                                            if ($COMBO_TYPE == "SINGLE") { ?>
               <tr>
                <td>
                 <?php
                                                                        $item_1 = $_POST['item_1'];
                                                                        $sql = "SELECT * FROM user_products where product_title='$item_1' and user_id='$store_user_id'";
                                                                        $query = mysqli_query($con, $sql);
                                                                        $fetch = mysqli_fetch_assoc($query);
                                                                        $product_title = $fetch['product_title'];
                                                                        $product_tags = $fetch['product_tags'];
                                                                        $product_mrp_price = $fetch['product_mrp_price'];
                                                                        $product_offer_price = $fetch['product_offer_price'];
                                                                        $count_1 = mysqli_num_rows($query);
                                                                        if ($count_1 == 0) {
                                                                            echo "Please Select Valid Product.";
                                                                        } else {
                                                                            echo "1. " . $product_title . " - " . $product_tags;
                                                                        }  ?>
                </td>
                <td>
                 Rs.<?php echo $product_mrp_price; ?>
                </td>
                <td>
                 Rs.<?php echo $product_offer_price; ?>
                 <input tyep='text' name='item_1' value='<?php echo $product_title . " - " . $product_tags; ?>'
                  hidden="">
                 <input tyep='text' name='product_mrp_price_1' value='<?php echo $product_mrp_price; ?>' hidden="">
                 <input tyep='text' name='product_offer_price_1' value='<?php echo $product_offer_price; ?>' hidden="">
                </td>
               </tr>
               <tr>
                <td colspan="3">
                 <hr>
                </td>
               </tr>
               <tr style='font-size:20px;'>
                <td style='text-align:right;'>
                 <?php echo "Total Price:"; ?> &nbsp;</td>
                <td><?php echo  "Rs." . $product_mrp_price; ?></td>
                <td><b><?php echo "Rs." . $product_offer_price; ?></b>
                </td>
                <input tyep='text' name='mrp_total' value='<?php echo $product_mrp_price; ?>' hidden="">
               </tr>

               <?php  } elseif ($COMBO_TYPE == "DOUBLE") { ?>
               <tr>
                <td>
                 <?php $item_1 = $_POST['item_1'];
                                                                        $sql_1 = "SELECT * FROM user_products where product_title='$item_1' and user_id='$store_user_id'";
                                                                        $query_1 = mysqli_query($con, $sql_1);
                                                                        $fetch_1 = mysqli_fetch_assoc($query_1);
                                                                        $product_title_1 = $fetch_1['product_title'];
                                                                        $product_tags_1 = $fetch_1['product_tags'];
                                                                        $product_mrp_price_1 = $fetch_1['product_mrp_price'];
                                                                        $product_offer_price_1 = $fetch_1['product_offer_price'];
                                                                        $count_1 = mysqli_num_rows($query_1);
                                                                        if ($count_1 == 0) {
                                                                            echo "1.Please select valid product!";
                                                                        } else {
                                                                            echo "1. " . $product_title_1 . " - " . $product_tags_1;
                                                                        } ?>
                </td>
                <td>
                 Rs.<?php echo $product_mrp_price_1; ?>
                </td>
                <td>
                 Rs.<?php echo $product_offer_price_1; ?>
                 <input tyep='text' name='item_1' value='<?php echo $product_title_1 . " - " . $product_tags_1; ?>'
                  hidden="">
                 <input tyep='text' name='product_mrp_price_1' value='<?php echo $product_mrp_price_1; ?>' hidden="">
                 <input tyep='text' name='product_offer_price_1' value='<?php echo $product_offer_price_1; ?>'
                  hidden="">
                </td>
               </tr>

               <tr>
                <td>
                 <?php
                                                                        $item_2 = $_POST['item_2'];
                                                                        $sql_2 = "SELECT * FROM user_products where product_title='$item_2' and user_id='$store_user_id'";
                                                                        $query_2 = mysqli_query($con, $sql_2);
                                                                        $fetch_2 = mysqli_fetch_assoc($query_2);
                                                                        $product_title_2 = $fetch_2['product_title'];
                                                                        $product_tags_2 = $fetch_2['product_tags'];
                                                                        $product_mrp_price_2 = $fetch_2['product_mrp_price'];
                                                                        $product_offer_price_2 = $fetch_2['product_offer_price'];
                                                                        $count_2 = mysqli_num_rows($query_2);
                                                                        if ($count_2 == 0) {
                                                                            echo "2.Please select valid product!";
                                                                        } else {
                                                                            echo "2. " . $product_title_2 . " - " . $product_tags_2;
                                                                        } ?>
                </td>
                <td>
                 Rs.<?php echo $product_mrp_price_2; ?>
                </td>
                <td>
                 Rs.<?php echo $product_offer_price_2; ?>
                 <input tyep='text' name='item_2' value='<?php echo $product_title_2 . " - " . $product_tags_2; ?>'
                  hidden="">
                 <input tyep='text' name='product_mrp_price_2' value='<?php echo $product_mrp_price_2; ?>' hidden="">
                 <input tyep='text' name='product_offer_price_2' value='<?php echo $product_offer_price_2; ?>'
                  hidden="">
                </td>
               </tr>

               <tr>
                <td colspan="3">
                 <hr>
                </td>
               </tr>
               <tr>
                <td style='text-align:right;'>
                 <?php echo "Total Price:"; ?></td>
                <td><?php $total_2 = $product_mrp_price_1 + $product_mrp_price_2;
                                                                        echo  "Rs." . $total_2; ?>
                </td>
                <td><?php $total_off_2 = $product_offer_price_1 + $product_offer_price_2;
                                                                        echo "Rs." . $total_off_2; ?>
                </td>
                <input tyep='text' name='mrp_total' value='<?php echo $total_2; ?>' hidden="">
               </tr>

               <?php } elseif ($COMBO_TYPE == "TRIPPLE") { ?>
               <tr>
                <td>
                 <?php $item_1 = $_POST['item_1'];
                                                                        $sql_1 = "SELECT * FROM user_products where product_title='$item_1' and user_id='$store_user_id'";
                                                                        $query_1 = mysqli_query($con, $sql_1);
                                                                        $fetch_1 = mysqli_fetch_assoc($query_1);
                                                                        $product_title_1 = $fetch_1['product_title'];
                                                                        $product_tags_1 = $fetch_1['product_tags'];
                                                                        $product_img_1 = $fetch_1['product_img'];
                                                                        $product_mrp_price_1 = $fetch_1['product_mrp_price'];
                                                                        $product_offer_price_1 = $fetch_1['product_offer_price'];
                                                                        $count_1 = mysqli_num_rows($query_1);
                                                                        if ($count_1 == 0) {
                                                                            echo "1.Please select valid product!";
                                                                        } else {
                                                                            echo "1. " . $product_title_1 . " - " . $product_tags_1;
                                                                        } ?>
                </td>
                <td>
                 Rs.<?php echo $product_mrp_price_1; ?>
                </td>
                <td>
                 Rs.<?php echo $product_offer_price_1; ?>
                 <input tyep='text' name='item_1' value='<?php echo $product_title_1 . " - " . $product_tags_1; ?>'
                  hidden="">
                 <input tyep='text' name='product_mrp_price_1' value='<?php echo $product_mrp_price_1; ?>' hidden="">
                 <input tyep='text' name='product_offer_price_1' value='<?php echo $product_offer_price_1; ?>'
                  hidden="">
                </td>
               </tr>

               <tr>
                <td>
                 <?php
                                                                        $item_2 = $_POST['item_2'];
                                                                        $sql_2 = "SELECT * FROM user_products where product_title='$item_2' and user_id='$store_user_id'";
                                                                        $query_2 = mysqli_query($con, $sql_2);
                                                                        $fetch_2 = mysqli_fetch_assoc($query_2);
                                                                        $product_title_2 = $fetch_2['product_title'];
                                                                        $product_tags_2 = $fetch_2['product_tags'];
                                                                        $product_img_2 = $fetch_2['product_img'];
                                                                        $product_mrp_price_2 = $fetch_2['product_mrp_price'];
                                                                        $product_offer_price_2 = $fetch_2['product_offer_price'];
                                                                        $count_2 = mysqli_num_rows($query_2);
                                                                        if ($count_2 == 0) {
                                                                            echo "2.Please select valid product!";
                                                                        } else {
                                                                            echo "2. " . $product_title_2 . " - " . $product_tags_2;
                                                                        } ?>
                </td>
                <td>
                 Rs.<?php echo $product_mrp_price_2; ?>
                </td>
                <td>
                 Rs.<?php echo $product_offer_price_2; ?>
                 <input type='text' name='item_2' value='<?php echo $product_title_2 . " - " . $product_tags_2; ?>'
                  hidden="">
                 <input type='text' name='product_mrp_price_2' value='<?php echo $product_mrp_price_2; ?>' hidden="">
                 <input type='text' name='product_offer_price_2' value='<?php echo $product_offer_price_2; ?>'
                  hidden="">
                </td>
               </tr>

               <tr>
                <td>
                 <?php
                                                                        $item_3 = $_POST['item_3'];
                                                                        $sql_3 = "SELECT * FROM user_products where product_title='$item_3' and user_id='$store_user_id'";
                                                                        $query_3 = mysqli_query($con, $sql_3);
                                                                        $fetch_3 = mysqli_fetch_assoc($query_3);
                                                                        $product_title_3 = $fetch_3['product_title'];
                                                                        $product_tags_3 = $fetch_3['product_tags'];
                                                                        $product_img_3 = $fetch_3['product_img'];
                                                                        $product_mrp_price_3 = $fetch_3['product_mrp_price'];
                                                                        $product_offer_price_3 = $fetch_3['product_offer_price'];
                                                                        $count_3 = mysqli_num_rows($query_3);
                                                                        if ($count_3 == 0) {
                                                                            echo "3.Please select valid product!";
                                                                        } else {
                                                                            echo "3. " . $product_title_3 . " - " . $product_tags_3;
                                                                        } ?>
                </td>
                <td>
                 Rs.<?php echo $product_mrp_price_3; ?>
                </td>
                <td>
                 Rs.<?php echo $product_offer_price_3; ?>
                 <input tyep='text' name='item_3' value='<?php echo $product_title_3 . " - " . $product_tags_3; ?>'
                  hidden="">
                 <input tyep='text' name='product_mrp_price_3' value='<?php echo $product_mrp_price_3; ?>' hidden="">
                 <input tyep='text' name='product_offer_price_3' value='<?php echo $product_offer_price_3; ?>'
                  hidden="">
                </td>
               </tr>

               <tr>
                <td colspan="3">
                 <hr>
                </td>
               </tr>
               <tr>
                <td style='text-align:right;'>
                 <?php echo "Total Price:"; ?></td>
                <td><?php $total_3 = $product_mrp_price_1 + $product_mrp_price_2 + $product_mrp_price_3;
                                                                        echo  "Rs." . $total_3; ?>
                </td>
                <td><?php $total_off_3 = $product_offer_price_1 + $product_offer_price_2 + $product_offer_price_3;
                                                                        echo "Rs." . $total_off_3; ?>
                </td>
                <input tyep='text' name='mrp_total' value='<?php echo $total_3; ?>' hidden="">
               </tr>

               <?php } ?>
              </tbody>
             </table>
            </div>

           </div>
           <div class='row'>
            <div class='col-lg-12'>
             <hr>
            </div>
           </div>

           <div class="row">
            <div class="col-sm-6">
             <div class="form-group">
              <label class="control-label">Combo Image</label>
              <input type="FILE" name="combo_img" value='' class="form-control" required="">
             </div>
             <h6>Auto Generated Combo Image : </h6>
             <?php

                                                    if (!isset($_POST['item_1']) and !isset($_POST['item_2']) and !isset($_POST['item_3'])) {
                                                        echo "No Image Found!";
                                                    } elseif (isset($_POST['item_1']) and !isset($_POST['item_2']) and !isset($_POST['item_3'])) {
                                                        echo "<div style='padding:1%;box-shadow:0px 0px 2px grey;width:320px;text-align:center;'>
     <img src='$Domain/img/store_img/pro_img/$product_img_1' style='width:100px;margin-top: 50px;'>";
                                                        echo "<img src='$Domain/img/combo_icon.png' style='width:300px;margin-top:-56px;'>";
                                                        echo "<img src='$Domain/img/combo.png' style='width:90px;position:absolute; left:10px; top:93px;'>
     </div>";
                                                    } elseif (isset($_POST['item_2']) and isset($_POST['item_2']) and !isset($_POST['item_3'])) {
                                                        echo "<div style='padding:1%;box-shadow:0px 0px 2px grey;width:320px;text-align:center;'>
     <img src='$Domain/img/store_img/pro_img/$product_img_1' style='width:100px;margin-top: 50px;'>";
                                                        echo "<img src='$Domain/img/store_img/pro_img/$product_img_2' style='width:100px;margin-top: 50px;'>";
                                                        echo "<img src='$Domain/img/combo_icon.png' style='width:300px;margin-top:-56px;'>";
                                                        echo "<img src='$Domain/img/combo.png' style='width:90px;position:absolute; left:10px; top:93px;'>
     </div>";
                                                    } elseif (isset($_POST['item_3']) and isset($_POST['item_2']) and isset($_POST['item_3'])) {
                                                        echo "
     <div style='padding:1%;box-shadow:0px 0px 2px grey;width:320px;text-align:center;'>
     <img src='$Domain/img/store_img/pro_img/$product_img_1' style='width:100px;margin-top: 50px;'>";
                                                        echo "<img src='$Domain/img/store_img/pro_img/$product_img_2' style='width:100px;margin-top: 50px;'>";
                                                        echo "<img src='$Domain/img/store_img/pro_img/$product_img_3' style='width:100px;margin-top: 50px;'>";
                                                        echo "<img src='$Domain/img/combo_icon.png' style='width:300px;margin-top:-56px;'>";
                                                        echo "<img src='$Domain/img/combo.png' style='width:90px;position:absolute; left:10px; top:93px;'>
     </div>";

                                                        function createimageinstantly()
                                                        {
                                                            global $Domain;
                                                            global $product_img_1;
                                                            global $product_img_2;
                                                            global $product_img_3;
                                                            $x = $y = 600;
                                                            header('Content-Type: image/png');
                                                            $targetFolder = "$Domain/img/store_img/pro_img/";
                                                            $ComboFolder = "$Domain/img/store_img/combo_img/";
                                                            $img_folder = "$Domain/img/";
                                                            $targetPath = $ComboFolder;

                                                            $img1 = $targetFolder . $product_img_1;
                                                            $img2 = $targetFolder . $product_img_1;
                                                            $img3 = $targetFolder . $product_img_1;
                                                            $img4 = $img_folder . "combo_icon.png";
                                                            $img5 = $img_folder . "combo.png";

                                                            $outputImage = imagecreatetruecolor(600, 600);

                                                            // set background to white
                                                            $white = imagecolorallocate($outputImage, 255, 255, 255);
                                                            imagefill($outputImage, 0, 0, $white);

                                                            $first = imagecreatefrompng($img1);
                                                            $second = imagecreatefrompng($img2);
                                                            $third = imagecreatefrompng($img3);
                                                            $fourth = imagecreatefrompng($img4);
                                                            $fifth = imagecreatefrompng($img5);

                                                            //imagecopyresized ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h )
                                                            imagecopyresized($outputImage, $first, 0, 0, 0, 0, $x, $y, $x, $y);
                                                            imagecopyresized($outputImage, $second, 0, 0, 0, 0, $x, $y, $x, $y);
                                                            imagecopyresized($outputImage, $third, 200, 200, 0, 0, 100, 100, 204, 148);
                                                            imagecopyresized($outputImage, $fourth, 200, 200, 0, 0, 100, 100, 5, 0);
                                                            imagecopyresized($outputImage, $fifth, 200, 200, 0, 0, 100, 100, 95, 0);

                                                            // Add the text
                                                            //imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )
                                                            //$white = imagecolorallocate($im, 255, 255, 255);
                                                            imagettftext($outputImage, 32, 0, 150, 150);

                                                            $filename = $targetPath . round(microtime(true)) . '.png';
                                                            imagepng($outputImage, $filename);

                                                            imagedestroy($outputImage);
                                                        }
                                                    }
                                                    ?>
            </div>

            <div class="col-sm-6">
             <div class="form-group">
              <label class="control-label">Combo Price (Selling
               Price)</label>
              <input type="text" name="offer_price_total" value='' class="form-control" required="">
             </div>
            </div>
           </div>


           <div class="panel-footer text-right">
            <?php $user_role = $_SESSION['user_role'];
                                                if ($user_role == "SUPER_ADMIN") { ?>
            <a href="products.php" class="btn btn-default">Back to Products</a>
            <?php } elseif ($user_role == "STORE_USER") { ?>
            <a href="combo_products.php" class="btn btn-default">Back to Combo
             Products</a>
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

 <?php require 'footer.php'; ?>


 <!-- BEGIN: Vendor JS-->
 <script src="app-assets/vendors/js/vendors.min.js"></script>
 <!-- BEGIN Vendor JS-->

 <!-- BEGIN: Page Vendor JS-->
 <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
 <!-- END: Page Vendor JS-->

 <!-- BEGIN: Theme JS-->
 <script src="app-assets/js/core/app-menu.min.js"></script>
 <script src="app-assets/js/core/app.min.js"></script>
 <script src="app-assets/js/scripts/customizer.min.js"></script>
 <!-- END: Theme JS-->

 <!-- BEGIN: Page JS-->
 <script src="app-assets/js/scripts/pages/page-users.min.js"></script>

</body>
<!-- END: Body-->

</html>