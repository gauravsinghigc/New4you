<?php
require 'files.php';
require 'session.php';
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="<?php echo $PosName; ?>">
  <title>Slider : <?php echo $PosName; ?></title>
  <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

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
                <h4 class="users-action">Predefined Urls <i class="fa fa-angle-right"></i></h4>
                <br>
              </div>
              <br>
              <div class="card-content">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped zero-configuration">
                      <thead>
                        <tr>
                          <td style="width: 25%;">URL Title</td>
                          <td>URL</td>
                          <td style="width: 15%;">Action</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        mysqli_set_charset($con, 'utf8');
                        $sql = "SELECT * from user_products, product_categories, product_sub_categories, pro_brands where user_products.product_cat_id=product_categories.product_cat_id and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_brand_id=pro_brands.brand_id and user_products.user_id='$user_id' ORDER BY user_product_id  ASC";

                        $query = mysqli_query($con, $sql);
                        while ($fetch = mysqli_fetch_assoc($query)) {
                          $user_product_id = $fetch['user_product_id'];
                          $product_title = $fetch['product_title'];
                          $product_cat_id = $fetch['product_cat_id'];
                          $product_sub_cat_id = $fetch['product_cat_id'];
                          $hindi_name = $fetch['hindi_name']; ?>
                          <tr style="font-size: 11px;">
                            <td style="padding: 0.3vw;">Open <?php echo $product_title; ?> - <?php echo $hindi_name; ?></td>
                            <td style="font-size: 11px;padding: 0.3vw;">
                              <input type="text" value="https://24kharido.in/app/details.php?id=<?php echo $user_product_id; ?>" id="myInput<?php echo $user_product_id; ?>" class='form-control' readonly='' style='padding: 1% 1% 1.5% 1%;
    height: 20px;
    font-size: 11px;'>
                            </td>
                            <td style="padding: 0.3vw;">
                              <input type="text" value="https://24kharido.in/app/details.php?id=<?php echo $user_product_id; ?>" id="myInput<?php echo $user_product_id; ?>" hidden>
                              <button onclick="urlcopy<?php echo $user_product_id; ?>()" id='button<?php echo $user_product_id; ?>' class='btn btn-sm btn-primary'><span id="Text<?php echo $user_product_id; ?>">Copy text</span></button>
                            </td>
                          </tr>
                          <script>
                            function urlcopy<?php echo $user_product_id; ?>() {
                              var copyText = document.getElementById("myInput<?php echo $user_product_id; ?>");
                              copyText.select();
                              copyText.setSelectionRange(0, 99999)
                              document.execCommand("copy");
                              document.getElementById("Text<?php echo $user_product_id; ?>").innerHTML = "Text Copied";
                              document.getElementById("button<?php echo $user_product_id; ?>").className = "btn-danger btn btn-sm btn";
                            }
                          </script>

                        <?php }
                        $sql = "SELECT * from product_categories, product_sub_categories where product_categories.product_cat_id=product_sub_categories.product_cat_id ORDER BY product_cat_title ASC";

                        $query = mysqli_query($con, $sql);
                        while ($fetch = mysqli_fetch_assoc($query)) {
                          $product_cat_id = $fetch['product_cat_id'];
                          $product_sub_cat_id = $fetch['product_cat_id'];
                          $product_cat_title = $fetch['product_cat_title']; ?>
                          <tr style="font-size: 11px;">
                            <td style="padding: 0.3vw;">Open <?php echo $product_cat_title; ?> Category</td>
                            <td style="font-size: 11px;padding: 0.3vw;">
                              <input type="text" value="https://24kharido.in/app/products.php?cat_id=<?php echo $product_cat_id; ?>&sub_cat_id=<?php echo $product_sub_cat_id; ?>" id="CCmyInput<?php echo $product_cat_id; ?><?php echo $product_sub_cat_id; ?>" class='form-control' readonly='' style='padding: 1% 1% 1.5% 1%;
    height: 20px;
    font-size: 11px;'>
                            </td>
                            <td style="padding: 0.3vw;">
                              <input type="text" value="https://24kharido.in/app/products.php?cat_id=<?php echo $product_cat_id; ?>&sub_cat_id=<?php echo $product_sub_cat_id; ?>" id="CCmyInput<?php echo $product_cat_id; ?><?php echo $product_sub_cat_id; ?>" hidden>
                              <button onclick="CCurlcopy<?php echo $product_cat_id; ?><?php echo $product_sub_cat_id; ?>()" id='CCbutton<?php echo $product_cat_id; ?><?php echo $product_sub_cat_id; ?>' class='btn btn-sm btn-primary'><span id="CCText<?php echo $product_cat_id; ?><?php echo $product_sub_cat_id; ?>">Copy text</span></button>
                            </td>
                          </tr>
                          <script>
                            function CCurlcopy<?php echo $product_cat_id; ?><?php echo $product_sub_cat_id; ?>() {
                              var copyText = document.getElementById(
                                "CCmyInput<?php echo $product_cat_id; ?><?php echo $product_sub_cat_id; ?>");
                              copyText.select();
                              copyText.setSelectionRange(0, 99999)
                              document.execCommand("copy");
                              document.getElementById("CCText<?php echo $product_cat_id; ?><?php echo $product_sub_cat_id; ?>")
                                .innerHTML = "Text Copied";
                              document.getElementById("CCbutton<?php echo $product_cat_id; ?><?php echo $product_sub_cat_id; ?>")
                                .className = "btn-danger btn btn-sm btn";
                            }
                          </script>

                        <?php } ?>
                      </tbody>
                    </table>
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

</body>
<!-- END: Body-->

</html>