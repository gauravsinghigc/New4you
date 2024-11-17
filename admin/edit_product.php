<?php
require 'files.php';
require 'session.php';
$title_name = "Edit Product";
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="<?php echo $PosName; ?>">
  <meta charset="utf-8">
  <title>Edit Product : <?php echo $PosName; ?></title>
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
        <?php
        if (isset($_GET['product_id'])) {
          $user_product_id = $_GET['product_id'];
          $_SESSION['user_product_id'] = $_GET['product_id'];
        } else {
          $user_product_id = $_SESSION['user_product_id'];
        }
        $product_id = $user_product_id;
        $sql = "SELECT * FROM user_products, product_categories, product_sub_categories, pro_brands where user_products.user_product_id='$user_product_id' and user_products.product_cat_id=product_categories.product_cat_id and user_products.product_sub_cat_id=product_sub_categories.sub_cat_id and user_products.product_brand_id=pro_brands.brand_id";
        $query = mysqli_query($con, $sql);
        $fetch = mysqli_fetch_assoc($query);
        $product_cat_id = $fetch['product_cat_id'];
        $product_sub_cat_id = $fetch['product_sub_cat_id'];
        $product_brand_id = $fetch['product_brand_id'];
        $product_title = $fetch['product_title'];
        $ProductModalNo = $fetch['ProductModalNo'];
        $product_modal_for_seo = $fetch['product_modal_for_seo'];
        $ProductSizeCapacity = $fetch['ProductSizeCapacity'];
        $product_size_capacity_status = $fetch['product_size_capacity_status'];
        $unique_feature = $fetch['unique_feature'];
        $ProductEdition = $fetch['ProductEdition'];
        $product_edition_status = $fetch['product_edition_status'];
        $product_warranty_in_diff_time = $fetch['product_warranty_in_diff_time'];
        $product_warranty_in_break = $fetch['product_warranty_in_break'];
        $product_top_list_status = $fetch['product_top_list_status'];
        $product_measure_unit = $fetch['product_measure_unit'];
        $unit_type = $fetch['unit_type'];
        $product_offer_status = $fetch['product_offer_status'];
        $product_stock_in = $fetch['product_stock_in'];
        $product_stock_alert_on = $fetch['product_stock_alert_on'];
        $product_type = $fetch['product_type'];
        $product_offer_price = $fetch['product_offer_price'];
        $product_mrp_price = $fetch['product_mrp_price'];
        $product_save_amount = $fetch['product_save_amount'];
        $product_HSN = $fetch['product_HSN'];
        $products_taxes = $fetch['products_taxes'];
        $product_net_price = $fetch['product_net_price'];
        $product_tax_price = round($product_offer_price / 100 * $products_taxes, 2);
        $product_return_policy_status = $fetch['product_return_policy_status'];
        $product_return_policy_charge_amount = $fetch['product_return_policy_charge_amount'];
        $product_return_time_in_days = $fetch['product_return_time_in_days'];
        $product_installation_charge_status = $fetch['product_installation_charge_status'];
        $product_installation_charge = $fetch['product_installation_charge'];
        $product_installation_charge_pincode_wise = $fetch['product_installation_charge_pincode_wise'];
        $product_delivery_charge_status = $fetch['product_delivery_charge_status'];
        $product_delivery_charge = $fetch['product_delivery_charge'];
        $product_delivery_charge_pincode_wise = $fetch['product_delivery_charge_pincode_wise'];
        $product_description = $fetch['product_description'];
        $product_created_at = $fetch['product_created_at'];
        $product_updated_at = $fetch['product_updated_at'];
        $product_status = $fetch['product_status'];
        $product_sort_by_order = $fetch['product_sort_by_order'];
        $product_status = $fetch['product_status'];
        $stockcount = $product_stock_in;
        $alertcount = $product_stock_alert_on;
        $hindi_name = $unique_feature;
        $product_tags = $product_measure_unit; //$fetch['product_tags'];
        $brand_title = $fetch['brand_title'];
        $product_image = $fetch['product_image'];
        $product_sub_cat_title = $fetch['sub_cat_title'];
        $product_created_at = $fetch['product_created_at'];
        $product_updated_at = $fetch['product_updated_at'];
        if ($product_status == "active") {
          $status = "<i class='text-success fa fa-check-circle float-right'> Active</i>";
        } elseif ($product_status == "inactive") {
          $status = "<i class='text-warning fa fa-warning float-right'> Inactive</i>";
        }
        ?>
        <section class="users-list-wrapper">
          <div class="users-list-table">
            <div class="card">
              <div class="card-header">
                <h4 class="users-action"><b><i class="fa fa-edit text-primary"></i> Edit Product</b> <i class="fa fa-angle-right"></i>
                  <?php echo $fetch['product_title']; ?> - <?php echo $unique_feature; ?> <?php echo $status; ?>

                </h4>
                <p> <b>Add Date :</b> <?php echo $product_created_at; ?><br>
                  <b>Last Update On :</b> <?php echo $product_updated_at; ?><br>
                  <b>Product Type :</b>
                  <?php if ($fetch['product_type'] === " ") {
                    echo "Regular Item";
                  } else {
                    echo $fetch['product_type'];
                  } ?>
                </p>
                <p><code>Note <i class="fa fa-angle-right"></i> </code> &nbsp; Item type is option sensitive selected option
                  will affect the display of particular item. so if you not aware this, please leave it as it as.
              </div>
              <div class="card-content">
                <div class="card-body">



                  <div class="panel-body">
                    <div class="row">
                      <div class="col-sm-3" style="max-height: 300px !important;">
                        <div class="form-group">
                          <label class="control-label"><b>Product Image</b></label>
                          <img src='img/store_img/pro_img/<?php echo $product_image; ?>' style='width:100%;box-shadow:0px 0px 1px grey;'>
                        </div>
                        <form action="update.php" method="POST" enctype="multipart/form-data">
                          <div class="form-group">
                            <input type="text" name="user_product_id" value="<?php echo $user_product_id; ?>" hidden="">
                            <input type="FILE" name="product_image" value="" class="form-control" required="">
                          </div>
                          <div class="form-group">
                            <button type="SUBMIT" name="UPDATE_ITEM_IMAGE" class="form-control btn btn-md btn-primary text-white">Upload</button>
                          </div>
                        </form>
                      </div>
                      <div class="col-sm-9">

                        <div class="row">

                          <div class="col-lg-4 col-md-4 col-sm-12 col-12 col-xs-12">
                            <div class="form-group">
                              <form action="" method="GET">
                                <label class="control-label">Product Category</label>
                                <select class="form-control" name="product_cat_id" onchange="form.submit()">
                                  <?php
                                  $product_cat_id = $fetch['product_cat_id'];
                                  $sql = "SELECT * FROM product_categories where product_cat_status='active' ORDER BY product_cat_title ASC";
                                  $Action = mysqli_query($con, $sql);
                                  while ($RowData = mysqli_fetch_assoc($Action)) {
                                    $product_cat_id2 = $RowData['product_cat_id'];
                                    $product_cat_title2 = $RowData['product_cat_title'];
                                    if (isset($_GET['product_cat_id'])) {
                                      if ($_GET['product_cat_id'] == $product_cat_id2) {
                                        echo "<option value='$product_cat_id2' selected>$product_cat_title2</option>";
                                      } else {
                                        echo "<option value='$product_cat_id2'>$product_cat_title2</option>";
                                      }
                                    } else {
                                      if ($product_cat_id == $product_cat_id2) {
                                        echo "<option value='$product_cat_id2' selected>$product_cat_title2</option>";
                                      } else {
                                        echo "<option value='$product_cat_id2'>$product_cat_title2</option>";
                                      }
                                    }
                                  }
                                  ?>
                                </select>
                              </form>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-12 col-xs-12">
                            <form action="update.php" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="user_product_id" value="<?php echo $user_product_id; ?>">
                              <?php if (isset($_GET['product_cat_id'])) {
                                $product_cat_id = $_GET['product_cat_id'];
                              } else {
                                $product_cat_id = $product_cat_id;
                              } ?>
                              <input type="hidden" name="product_cat_id" value="<?php echo $product_cat_id; ?>">
                              <div class="form-group">
                                <label class="control-label">Sub Category</label>
                                <select class="form-control" name="product_sub_cat_id">
                                  <?php
                                  $sub_cat_id = $fetch['product_sub_cat_id'];
                                  if (isset($_GET['product_cat_id'])) {
                                    $product_cat_idss = $_GET['product_cat_id'];
                                    $sql = "SELECT * FROM product_sub_categories where sub_cat_status='active' and product_cat_id='$product_cat_idss' ORDER BY sub_cat_title ASC";
                                  } else {
                                    $sql = "SELECT * FROM product_sub_categories where sub_cat_status='active' and sub_cat_id='$product_sub_cat_id' ORDER BY sub_cat_title ASC";
                                  }

                                  $Action = mysqli_query($con, $sql);
                                  while ($RowData = mysqli_fetch_assoc($Action)) {
                                    $sub_cat_id = $RowData['sub_cat_id'];
                                    $sub_cat_title = $RowData['sub_cat_title'];
                                    $product_cat_id2 = $RowData['product_cat_id'];
                                    if (isset($_GET['product_cat_id'])) {
                                      if ($_GET['product_cat_id'] == $product_cat_id2) {
                                        echo "<option value='$sub_cat_id' selected>$sub_cat_title</option>";
                                      } else {
                                        echo "<option value='$sub_cat_id'>$sub_cat_title</option>";
                                      }
                                    } else {
                                      if ($sub_cat_id == $product_sub_cat_id) {
                                        echo "<option value='$sub_cat_id' selected>$sub_cat_title</option>";
                                      } else {
                                        echo "<option value='$sub_cat_id'>$sub_cat_title</option>";
                                      }
                                    }
                                  }
                                  ?>
                                </select>
                              </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Company/Brand Name</label>
                              <select class="form-control" required="" name="product_brand_id">
                                <option value='null'>Select Brand
                                </option>
                                <?php
                                $sql = "SELECT * FROM pro_brands ORDER BY brand_title ASC";
                                $query = mysqli_query($con, $sql);
                                while ($fetch = mysqli_fetch_assoc($query)) {
                                  $brand_id  = $fetch['brand_id'];
                                  $brand_title = $fetch['brand_title'];
                                  if ($brand_id == $product_brand_id) {
                                    echo "<option value='$brand_id' selected>$brand_title</option>";
                                  } else {
                                    echo "<option value='$brand_id'>$brand_title</option>";
                                  }
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Product Name </label>
                              <input type="text" name="product_title" value='<?php echo $product_title; ?>' class="form-control" required="">
                            </div>
                          </div>

                          <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                              <label>Product Modal Number</label>
                              <input type="text" name="ProductModalNo" value="<?php echo $ProductModalNo; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                              <label>Modal No By Company For SEO</label>
                              <input type="text" name="product_modal_for_seo" value="<?php echo $product_modal_for_seo; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                              <label>Product Size Capacity</label>
                              <input type="text" name="ProductSizeCapacity" value="<?php echo $ProductSizeCapacity; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                              <label>Product Size Capacity (Show/Hide)</label>
                              <select class="form-control" name="product_size_capacity_status">
                                <?php if ($product_size_capacity_status == "Show") { ?>
                                  <option value="Show" selected>Show</option>
                                  <option value="hide">Hide</option>
                                <?php } else { ?>
                                  <option value="Show">Show</option>
                                  <option value="hide" selected>Hide</option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Unique Feature</label>
                              <input type="text" name="unique_feature" value="<?php echo $unique_feature; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                              <label>Year of MFG / Edition</label>
                              <input type="text" name="ProductEdition" value="<?php echo $ProductEdition; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                              <label>Year of MFG / Edition</label>
                              <select class="form-control" name="product_edition_status">
                                <?php if ($product_edition_status == "Show") { ?>
                                  <option value="Show" selected>Show</option>
                                  <option value="hide">Hide</option>
                                <?php } else { ?>
                                  <option value="Show">Show</option>
                                  <option value="hide" selected>Hide</option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                              <label>Warranty in Year/Months/days</label>
                              <input type="text" name="product_warranty_in_diff_time" value="<?php echo $product_warranty_in_diff_time; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                              <label>Warranty in Break</label>
                              <input type="text" name="product_warranty_in_break" value="<?php echo $product_warranty_in_break; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                              <label>Top List product (Yes/No)</label>
                              <select class="form-control" name="product_top_list_status">
                                <?php if ($product_top_list_status == "Show") { ?>
                                  <option value="Show" selected>Show</option>
                                  <option value="hide">Hide</option>
                                <?php } else { ?>
                                  <option value="Show">Show</option>
                                  <option value="hide" selected>Hide</option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label class="control-label">Measurement/Units</label>
                              <input type="text" name="product_measure_unit" value="<?php echo $product_measure_unit; ?>" class="form-control" placeholder="example: 1 or 500">
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label class="control-label">Select Unit</label>
                              <select class="form-control" name="unit_type">
                                <?php if ($unit_type == "PCs") { ?>
                                  <option value='PCs' selected>PCS</option>
                                  <option value='Kg'>KG</option>
                                  <option value='Tons'>Tons</option>
                                  <option value='Litre'>Litre</option>
                                  <option value='Meter'>Meter</option>
                                  <option value='WATT'>Watt</option>
                                <?php } elseif ($unit_type == "Kg") { ?>
                                  <option value='PCs'>PCS</option>
                                  <option value='Kg' selected>KG</option>
                                  <option value='Tons'>Tons</option>
                                  <option value='Litre'>Litre</option>
                                  <option value='Meter'>Meter</option>
                                  <option value='WATT'>Watt</option>
                                <?php } elseif ($unit_type == "Tons") { ?>
                                  <option value='PCs'>PCS</option>
                                  <option value='Kg'>KG</option>
                                  <option value='Tons' selected>Tons</option>
                                  <option value='Litre'>Litre</option>
                                  <option value='Meter'>Meter</option>
                                  <option value='WATT'>Watt</option>
                                <?php } elseif ($unit_type == "Litre") { ?>
                                  <option value='PCs'>PCS</option>
                                  <option value='Kg'>KG</option>
                                  <option value='Tons'>Tons</option>
                                  <option value='Litre' selected>Litre</option>
                                  <option value='Meter'>Meter</option>
                                  <option value='WATT'>Watt</option>
                                <?php } elseif ($unit_type == "Meter") { ?>
                                  <option value='PCs'>PCS</option>
                                  <option value='Kg'>KG</option>
                                  <option value='Tons'>Tons</option>
                                  <option value='Litre'>Litre</option>
                                  <option value='Meter' selected>Meter</option>
                                  <option value='WATT'>Watt</option>
                                <?php } elseif ($unit_type == "WATT") { ?>
                                  <option value='PCs'>PCS</option>
                                  <option value='Kg'>KG</option>
                                  <option value='Tons'>Tons</option>
                                  <option value='Litre'>Litre</option>
                                  <option value='Meter'>Meter</option>
                                  <option value='WATT' selected>Watt</option>
                                <?php } else { ?>
                                  <option value='PCs' selected>PCS</option>
                                  <option value='Kg'>KG</option>
                                  <option value='Tons'>Tons</option>
                                  <option value='Litre'>Litre</option>
                                  <option value='Meter'>Meter</option>
                                  <option value='WATT'>Watt</option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                              <label>Offer Applicable (Yes/No)</label>
                              <select class="form-control" name="product_offer_status">
                                <?php if ($product_offer_status == "YES") { ?>
                                  <option value="YES" selected>Yes</option>
                                  <option value="No">No</option>
                                <?php } else { ?>
                                  <option value="Yes">Yes</option>
                                  <option value="No" selected>No</option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Stock In</label>
                              <input type="text" name="product_stock_in" value="<?php echo $product_stock_in; ?>" class="form-control" placeholder="example: 1 or 500">
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Stock Alert On</label>
                              <input type="text" name="product_stock_alert_on" value="<?php echo $product_stock_alert_on; ?>" class="form-control" placeholder="example: 1 or 500">
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Item Type</label>
                              <select class="form-control" name='product_type'>
                                <?php if ($product_type == "null") { ?>
                                  <option value='null' selected="">NONE</option>
                                  <option value='RECOMMENDED'>RECOMMENDED</option>
                                  <option value='BEST'>BEST SELLING</option>
                                  <option value="TODAY_DEALS"> DEAL OF THE DAY</option>
                                <?php } elseif ($product_type == "RECOMMENDED") { ?>
                                  <option value='null'>NONE</option>
                                  <option value='RECOMMENDED' selected>RECOMMENDED</option>
                                  <option value='BEST'>BEST SELLING</option>
                                  <option value="TODAY_DEALS"> DEAL OF THE DAY</option>
                                <?php } elseif ($product_type == "BEST") { ?>
                                  <option value='null'>NONE</option>
                                  <option value='RECOMMENDED'>RECOMMENDED</option>
                                  <option value='BEST' selected="">BEST SELLING</option>
                                  <option value="TODAY_DEALS"> DEAL OF THE DAY</option>
                                <?php } elseif ($product_type == "TODAY_DEALS") { ?>
                                  <option value='null'>NONE</option>
                                  <option value='RECOMMENDED'>RECOMMENDED</option>
                                  <option value='BEST'>BEST SELLING</option>
                                  <option value="TODAY_DEALS" selected=""> DEAL OF THE DAY</option>
                                <?php } else { ?>
                                  <option value='null' selected="">NONE</option>
                                  <option value='RECOMMENDED'>RECOMMENDED</option>
                                  <option value='BEST'>BEST SELLING</option>
                                  <option value="TODAY_DEALS"> DEAL OF THE DAY</option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Offer Price/Selling Price (Rs.)</label>
                              <input type="text" name="product_offer_price" id="productPrice" onmouseover="CalculateSaveAmount()" oninput="NetProductPrice()" value="<?php echo $product_offer_price; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">MRP Price (Rs.)</label>
                              <input type="text" name="product_mrp_price" id="mrp_amount" oninput="CalculateSaveAmount()" value="<?php echo $product_mrp_price; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Save Amount in Rs.</label>
                              <input type="text" name="product_save_amount" id="save_amount" value="<?php echo $product_save_amount; ?>" class="form-control">
                            </div>
                          </div>
                          <script>
                            function CalculateSaveAmount() {
                              var mrp_amount = document.getElementById("mrp_amount").value;
                              var productPrice = document.getElementById("productPrice").value;
                              var save_amount = mrp_amount - productPrice;
                              document.getElementById("save_amount").value = save_amount;
                            }
                          </script>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">PRODUCT HSN</label>
                              <input type="text" name="product_HSN" value="<?php echo $product_HSN; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Applicable GST</label>
                              <select type="text" name="products_taxes" id="gsttaxes" onchange="NetProductPrice()" class="form-control">
                                <?php if ($products_taxes == "0") { ?>
                                  <option value="0" selected>0%</option>
                                  <option value="5">5%</option>
                                  <option value="12">12%</option>
                                  <option value="18">18%</option>
                                  <option value="28">28%</option>
                                <?php } elseif ($products_taxes == "5") { ?>
                                  <option value="0">0%</option>
                                  <option value="5" selected>5%</option>
                                  <option value="12">12%</option>
                                  <option value="18">18%</option>
                                  <option value="28">28%</option>
                                <?php } elseif ($products_taxes == "12") { ?>
                                  <option value="0">0%</option>
                                  <option value="5">5%</option>
                                  <option value="12" selected>12%</option>
                                  <option value="18">18%</option>
                                  <option value="28">28%</option>
                                <?php } elseif ($products_taxes == "18") { ?>
                                  <option value="0">0%</option>
                                  <option value="5">5%</option>
                                  <option value="12">12%</option>
                                  <option value="18" selected>18%</option>
                                  <option value="28">28%</option>
                                <?php } elseif ($products_taxes == "28") { ?>
                                  <option value="0">0%</option>
                                  <option value="5">5%</option>
                                  <option value="12">12%</option>
                                  <option value="18">18%</option>
                                  <option value="28" selected>28%</option>
                                <?php } else { ?>
                                  <option value="0" selected>0%</option>
                                  <option value="5">5%</option>
                                  <option value="12">12%</option>
                                  <option value="18">18%</option>
                                  <option value="28">28%</option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Product TAX Amount</label>
                              <input type="text" oninput="CalculatePrice()" name="product_net_price" id="net_price" value="<?php echo $product_tax_price; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                              <label>Return Policy Applicable (Yes/No)</label>
                              <select class="form-control" name="product_return_policy_status">
                                <?php if ($product_return_policy_status == "YES") { ?>
                                  <option value="YES" selected>YES</option>
                                  <option value="NO">NO</option>
                                <?php } elseif ($product_return_policy_status == "NO") { ?>
                                  <option value="YES">YES</option>
                                  <option value="NO" selected>NO</option>
                                <?php } else { ?>
                                  <option value="YES">YES</option>
                                  <option value="NO">NO</option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Return Policy Charge Amount</label>
                              <input type="text" name="product_return_policy_charge_amount" value="<?php echo $product_return_policy_charge_amount; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Return Policy Time in Days</label>
                              <input type="text" name="product_return_time_in_days" value="<?php echo $product_return_time_in_days; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                              <label>Installation Charge (Show/Hide)</label>
                              <select class="form-control" name="product_installation_charge_status">
                                <?php if ($product_installation_charge_status == "YES") { ?>
                                  <option value="YES" selected>YES</option>
                                  <option value="NO">NO</option>
                                <?php } elseif ($product_installation_charge_status == "NO") { ?>
                                  <option value="YES">YES</option>
                                  <option value="NO" selected>NO</option>
                                <?php } else { ?>
                                  <option value="YES">YES</option>
                                  <option value="NO">NO</option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Installation Charge </label>
                              <input type="text" name="product_installation_charge" value="<?php echo $product_installation_charge; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Installation Charge Pincode Wise </label>
                              <input type="text" name="product_installation_charge_pincode_wise" value="<?php echo $product_installation_charge_pincode_wise; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                              <label>Delivery Charge (Show/Hide)</label>
                              <select class="form-control" name="product_delivery_charge_status">
                                <?php if ($product_delivery_charge_status == "YES") { ?>
                                  <option value="YES" selected>YES</option>
                                  <option value="NO">NO</option>
                                <?php } elseif ($product_delivery_charge_status == "NO") { ?>
                                  <option value="YES">YES</option>
                                  <option value="NO" selected>NO</option>
                                <?php } else { ?>
                                  <option value="YES">YES</option>
                                  <option value="NO">NO</option>
                                <?php  } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Delivery Charge </label>
                              <input type="text" name="product_delivery_charge" value="<?php echo $product_delivery_charge; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Delivery Charge Pincode Wise </label>
                              <input type="text" name="product_delivery_charge_pincode_wise" value="<?php echo $product_delivery_charge_pincode_wise; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Product Status</label>
                              <select class="form-control" name="product_status">
                                <?php if ($product_status == "active") { ?>
                                  <option value="active" selected>ACTIVE</option>
                                  <option value="inactive">INACTIVE</option>
                                <?php } elseif ($product_status == "inactive") { ?>
                                  <option value="active">ACTIVE</option>
                                  <option value="inactive" selected>INACTIVE</option>
                                <?php } else { ?>
                                  <option value="active">ACTIVE</option>
                                  <option value="inactive">INACTIVE</option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Product Sort By Order </label>
                              <input type="number" name="product_sort_by_order" value="<?php echo $product_sort_by_order; ?>" class="form-control">
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Product Description</label>
                              <textarea name="product_description" class="form-control" rows="5"><?php echo SECURE($product_description, "d"); ?></textarea>
                            </div>
                            <hr>
                          </div>
                        </div>
                        <div class="row">
                          <div class="panel-footer text-right">
                            <?php $user_role = $_SESSION['user_role'];
                            if ($user_role == "admin") { ?>
                              <a href="products.php" class="btn btn-default">Back to Products</a>
                            <?php } elseif ($user_role == "store_user") { ?>
                              <a href="product.php" class="btn btn-default">Back to Products</a>
                            <?php } ?>
                            <button class="btn btn-success" type="submit" name="update_products">Update Product</button>
                          </div>
                          </form>
                        </div>
                      </div>

                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-1 flex-s">
                            <button onclick="OptionAdd()" id="optionbtn" class="btn btn-md float-right btn-primary mt-2">Add Options</button>
                            <h3 class="font-medium-3 mb-2 mt-2 bold"><b>Order Options <i class="fa fa-angle-right"></i></b></h3>
                          </div>
                          <div class="col-md-12" id="option_Add" style="display:none;">
                            <form action="insert.php" class="form row" method="POST" enctype="multipart/form-data">
                              <p class="col-md-12">To search icon please visit icon library at <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2" target="_blank">Icons</a></p>
                              <div class="col-md-4 col-lg-4 col-sm-6 col-12 form-group">
                                <label>Option Icon <i class="fa fa-angle-right"></i> <small>Insert fa fa-icon example fa-user </small></label>
                                <input type="text" name="option_icon" class="form-control" required="">
                              </div>
                              <div class="col-md-4 col-lg-4 col-sm-6 col-12 form-group">
                                <label>Option Name</label>
                                <input type="text" name="option_name" class="form-control" required="">
                              </div>
                              <div class="col-md-4 col-lg-4 col-sm-6 col-12 form-group">
                                <label>Option Value</label>
                                <input type="text" name="option_value" class="form-control" required="">
                              </div>
                              <div class="col-md-4 col-lg-4 col-sm-6 col-12 form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" required="">
                                  <option value="active">Active</option>
                                  <option value="inactive">Inactive</option>
                                </select>
                              </div>
                              <div class="col-md-4 col-lg-4 col-sm-6 col-12 form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-success form-control" name="create_product_options" value="<?php echo $user_product_id; ?>">Save</button>
                              </div>
                            </form>
                          </div>
                          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                              <table class="table table-striped zero-configuration" style="font-size: 12px !important;">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>OptioName</th>
                                    <th>OptionValue</th>
                                    <th>Icon</th>
                                    <th>status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  <?php
                                  $SQL_options = "SELECT * FROM products_options where product_id='$user_product_id'";
                                  $optionsquery = mysqli_query($con, $SQL_options);
                                  $counto = 0;
                                  while ($F_options = mysqli_fetch_assoc($optionsquery)) {
                                    $counto++; ?>
                                    <tr>
                                      <td><?php echo $counto; ?></td>
                                      <td><?php echo $F_options['option_name']; ?></td>
                                      <td><?php echo $F_options['option_value']; ?></td>
                                      <td><i class="fa <?php echo $F_options['option_icon']; ?>"></i></td>
                                      <td><?php echo $F_options['status']; ?></td>
                                      <td>None</td>

                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-1 flex-s">
                            <button onclick="SpecificationAdd()" id="specifybtn" class="btn btn-md float-right btn-primary mt-2">Add</button>
                            <h3 class="font-medium-3 mb-2 mt-2 bold"><b>Production Specifications <i class="fa fa-angle-right"></i></b></h3>
                          </div>
                          <div class="col-md-12" id="specifi_Add" style="display:none;">
                            <form action="insert.php" class="form row" method="POST" enctype="multipart/form-data">
                              <div class="col-md-4 col-lg-4 col-sm-6 col-12 form-group">
                                <label>Title</label>
                                <input type="text" name="specification_name" class="form-control" required="">
                              </div>
                              <div class="col-md-4 col-lg-4 col-sm-6 col-12 form-group">
                                <label>Specification</label>
                                <input type="text" name="specification_value" class="form-control" required="">
                              </div>
                              <div class="col-md-4 col-lg-4 col-sm-6 col-12 form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" required="">
                                  <option value="active">Active</option>
                                  <option value="inactive">Inactive</option>
                                </select>
                              </div>
                              <div class="col-md-4 col-lg-4 col-sm-6 col-12 form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-success form-control" name="create_product_specification" value="<?php echo $user_product_id; ?>">Save</button>
                              </div>
                            </form>
                          </div>
                          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                              <table class="table table-striped zero-configuration" style="font-size: 12px !important;">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Value</th>
                                    <th>status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  <?php
                                  $SQL_options = "SELECT * FROM product_specifications where product_id='$user_product_id'";
                                  $optionsquery = mysqli_query($con, $SQL_options);
                                  $counto = 0;
                                  while ($F_options = mysqli_fetch_assoc($optionsquery)) {
                                    $counto++; ?>
                                    <tr>
                                      <td><?php echo $counto; ?></td>
                                      <td><?php echo $F_options['specification_name']; ?></td>
                                      <td><?php echo $F_options['specification_value']; ?></td>
                                      <td><?php echo $F_options['status']; ?></td>
                                      <td>None</td>

                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>



                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-1">
                            <h3 class="font-medium-3 mb-2 mt-2"><b>Product Reviews <i class="fa fa-angle-right"></i></b></h3>
                          </div>
                          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                              <table class="table table-striped zero-configuration" style="font-size: 12px !important;">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>ReviewId</th>
                                    <th>StarCounts</th>
                                    <th>ReviewTitle</th>
                                    <th>UserType</th>
                                    <th>ReviewerName</th>
                                    <th>ReviewerEmailId</th>
                                    <th>ProReviewCreatedOn</th>
                                    <th>Responses</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $product_reviews = "SELECT * FROM product_reviews where ProductId='$user_product_id' ORDER BY ProReviewId DESC";
                                  $product_reviews_query = mysqli_query($con, $product_reviews);
                                  $count = 0;
                                  while ($fetchreviws = mysqli_fetch_assoc($product_reviews_query)) {
                                    $count++; ?>
                                    <tr>
                                      <td><?php echo $count; ?></td>
                                      <td>#REW<?php echo $fetchreviws['ProReviewId']; ?></td>
                                      <td>
                                        <?php
                                        $CountStar = $fetchreviws['ProReviewStarCount'];
                                        $RatingCounts = 0;
                                        while ($RatingCounts < $CountStar) {
                                          echo "<i class='fa fa-star text-warning mt-0'></i>";
                                          $RatingCounts++;
                                        } ?>
                                      </td>
                                      <td><a href="#" data-toggle="modal" data-target="#ViewModal<?php echo $fetchreviws['ProReviewId']; ?>"><?php echo $fetchreviws['ProReviewTitle']; ?></a>
                                      </td>
                                      <td>
                                        <?php if ($fetchreviws['ProReviewUserType'] == "Unknown") {
                                          echo "Unknown";
                                        } else { ?>
                                          Registered
                                        <?php } ?>
                                      </td>
                                      <td>
                                        <?php if ($fetchreviws['ProReviewUserType'] == "Unknown") {
                                          echo $fetchreviws['ProReviewName'];
                                        } else { ?>
                                          <a href="cust_details.php?customer_id=<?php echo $fetchreviws['ProReviewUserType']; ?>">
                                            <i class="fa fa-user"></i>
                                            <?php $SQL_customers = "SELECT * FROM customers where customer_id='" . $fetchreviws['ProReviewUserType'] . "'";
                                            $QUERY_customers = mysqli_query($con, $SQL_customers);
                                            $FETCH_customers = mysqli_fetch_assoc($QUERY_customers);
                                            $CustomerName = $FETCH_customers['customer_name'];
                                            echo $CustomerName;
                                            ?>
                                          </a>
                                        <?php } ?>
                                      </td>
                                      <td><?php echo $fetchreviws['ProReviewEmail']; ?></td>
                                      <td><?php echo $fetchreviws['ProReviewCreatedOn']; ?></td>
                                      <td>
                                        <span><i class="fa fa-thumbs-up text-success"></i>
                                          <?php
                                          $SQL_product_reviews_count = "SELECT * FROM product_reviews_counts where ReviewsType='HELPFULL' and ProReviewId='" . $fetchreviws['ProReviewId'] . "'";
                                          $QUERY_product_reviews_counts = mysqli_query($con, $SQL_product_reviews_count);
                                          $COUNT_product_reviews_counts_true = mysqli_num_rows($QUERY_product_reviews_counts);
                                          if ($COUNT_product_reviews_counts_true == 0) {
                                            echo "0";
                                          } else {
                                            echo $COUNT_product_reviews_counts_true;
                                          } ?></span> /
                                        <span><i class="fa fa-thumbs-down text-danger"></i>
                                          <?php
                                          $SQL_product_reviews_count = "SELECT * FROM product_reviews_counts where ReviewsType='REPORTED' and ProReviewId='" . $fetchreviws['ProReviewId'] . "'";
                                          $QUERY_product_reviews_counts = mysqli_query($con, $SQL_product_reviews_count);
                                          $COUNT_product_reviews_counts_false = mysqli_num_rows($QUERY_product_reviews_counts);
                                          if ($COUNT_product_reviews_counts_false == 0) {
                                            echo "0";
                                          } else {
                                            echo $COUNT_product_reviews_counts_false;
                                          } ?></span>
                                      </td>
                                      <td><?php
                                          $status = $fetchreviws['ProReviewStatus'];
                                          $ProReviewId = $fetchreviws['ProReviewId'];
                                          $ProReviewTitle = $fetchreviws['ProReviewTitle'];
                                          if ($status == "NEW") {
                                            echo "<a href='update.php?update_reviews=$ProReviewId&status=HIDE&name=$ProReviewTitle'><i class='fa fa-eye btn btn-sm btn-black'></i></a>";
                                          } else {
                                            echo "<a href='update.php?update_reviews=$ProReviewId&status=NEW&name=$ProReviewTitle'><i class='fa fa-eye-slash btn btn-sm btn-danger'></i></a>";
                                          } ?></td>
                                      <td><a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ViewModal<?php echo $fetchreviws['ProReviewId']; ?>"><i class="fa fa-list"></i></a>
                                      </td>
                                    </tr>
                                    <!-- Modal -->

                                    <div class="modal fade text-left" id="ViewModal<?php echo $fetchreviws['ProReviewId']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                      <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title font-medium-4" id="myModalLabel1"><i class="fa fa-history text-success"></i>
                                              <?php echo $title_name; ?> <i class="fa fa-angle-right"></i>
                                              <?php echo $fetchreviws['ProReviewTitle']; ?> </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="row">
                                              <?php
                                              $SQL_user_products = "SELECT * FROM user_products where user_product_id='" . $fetchreviws['ProductId'] . "'";
                                              $QUERY_user_products = mysqli_query($con, $SQL_user_products);
                                              $FETCH_user_products = mysqli_fetch_assoc($QUERY_user_products); ?>
                                              <div class="col-lg-4 col-md-4 col-sm-12 col-12 p-1 pr-1">
                                                <img src="<?php echo $img_url; ?>/store_img/pro_img/<?php echo $FETCH_user_products['product_img']; ?>" class="img-fluid" style="border-radius: 15px;">
                                              </div>
                                              <div class="col-lg-8 col-md-8 col-sm-12 col-12 pl-1">
                                                <h5 class="mb-0 font-medium-4 pl-0 ml-0">Product Details :</h5>
                                                <hr class="mb-1 mt-0">
                                                <p>
                                                  <b>Product Title :</b> <?php echo $FETCH_user_products['product_title']; ?><br>
                                                  <b>Alternate Name :</b> <?php echo $FETCH_user_products['hindi_name']; ?><br>
                                                  <b>Product Price:</b> <b>OFFER PRICE <i class="fa fa-angle-right"></i></b>
                                                  Rs.<?php echo $FETCH_user_products['product_offer_price']; ?>
                                                  | <b>MRP PRICE :</b> <?php echo $FETCH_user_products['product_mrp_price']; ?><br>
                                                  <b>Item Measuring Unit :</b> <?php echo $FETCH_user_products['product_tags']; ?><br>
                                                  <b>Item Referance :</b> <?php echo $FETCH_user_products['product_type']; ?><br>
                                                  <b>In Stock :</b> <?php echo $FETCH_user_products['stockcount']; ?><br>
                                                  <b>Status :</b> <?php echo $FETCH_user_products['product_status']; ?>
                                                </p>
                                                <a href="edit_product.php?product_id=<?php echo $FETCH_user_products['user_product_id']; ?>" class="btn btn-md btn-black">View Product Details <i class="fa fa-angle-right"></i></a>
                                              </div>
                                            </div>
                                            <p class="mt-1">
                                            <h4 class="font-medium-4">Review Details :
                                              <hr>
                                            </h4>
                                            <b>ProReviewCreatedOn :</b> <?php echo $fetchreviws['ProReviewCreatedOn']; ?><br>
                                            <b>ProReviewId :</b> #REW<?php echo $fetchreviws['ProReviewId']; ?><br>
                                            <b>ProductId :</b> <?php echo $fetchreviws['ProductId']; ?><br>
                                            <b>ProReviewStarCount :</b> <?php
                                                                        $CountStar = $fetchreviws['ProReviewStarCount'];
                                                                        $RatingCounts = 0;
                                                                        while ($RatingCounts < $CountStar) {
                                                                          echo "<i class='fa fa-star text-warning mt-0'></i>";
                                                                          $RatingCounts++;
                                                                        } ?><br>
                                            <b>ProReviewTitle :</b> <?php echo $fetchreviws['ProReviewTitle']; ?><br>
                                            <b>ProReviewName :</b> <?php echo $fetchreviws['ProReviewName']; ?><br>
                                            <b>ProReviewEmail :</b> <?php echo $fetchreviws['ProReviewEmail']; ?><br>
                                            <b>ProReviewDesc :</b> <?php echo $fetchreviws['ProReviewDesc']; ?><br>
                                            <b>ProReviewUserType :</b> <?php echo $fetchreviws['ProReviewUserType']; ?>
                                            <?php
                                            if ($fetchreviws['ProReviewStatus'] == "Unknown") {
                                              echo "(user is not registered!)";
                                            } else { ?>
                                              <B>(Registered User)</B> <a href="cust_details.php?customer_id=<?php echo $fetchreviws['ProReviewUserType']; ?>" class="btn btn-primary btn-sm">View Profile <i class="fa fa-angle-right"></i></a>
                                            <?php } ?><br>
                                            <b>ProReviewStatus :</b> <?php echo $fetchreviws['ProReviewStatus']; ?>
                                            </p>
                                            <h5 class="font-medium-4">ProReviewDeviceDetails :
                                              <hr>
                                            </h5>
                                            <p><?php echo $fetchreviws['ProReviewDeviceDetails']; ?></p>
                                            <h5 class="font-medium-4">Responses On Reviews :
                                              <hr>
                                            </h5>
                                            <p>
                                              <b>Helpfull/Usefull/Like :</b> <span><i class="fa fa-thumbs-up text-success"></i><?php echo $COUNT_product_reviews_counts_true; ?></span>
                                              Received<br>
                                              <b>Reported/Unusefull/Dislike :</b> <span class=""><i class="fa fa-thumbs-down text-danger"></i><?php echo $COUNT_product_reviews_counts_false; ?></span>
                                              Received<br>
                                            </p>
                                            <h4 class="pl-0 pr-1 mb-0">
                                              <a href="reviews_submitted.php" class="btn btn-primary btn-md w-50 d-block mx-auto">
                                                <b>View All Like or Dislike submitted devices/customers
                                                  <i class="fa fa-angle-right"></i>
                                                </b>
                                              </a>
                                            </h4>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                  <?php } ?>
                                </tbody>
                              </table>
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
  <script>
    function NetProductPrice() {
      var selectedValue = document.getElementById("gsttaxes").value;
      var productPrice = document.getElementById("productPrice").value;
      var netPrice = document.getElementById("net_price");

      priceDifference = +productPrice / 100 * +selectedValue;
      newPrice = priceDifference;

      netPrice.value = Math.round(newPrice * 100) / 100;
    }
  </script>
  <?php
  if (isset($_POST['SAVE_ATTRIBUTE'])) {
    $product_id = $_POST['product_id'];
    $ATTRIBUTE_TYPE = $_POST['ATTRIBUTE_TYPE'];
    $ATTRIBUTE_TITLE = $_POST['ATTRIBUTE_TITLE'];
    $ATTRIBUTE_VALUE = $_POST['ATTRIBUTE_VALUE'];

    $Sql = "INSERT into product_attributes (product_id, attribute_type, attribute_title, attribute_value) VALUES ('$product_id', '$ATTRIBUTE_TYPE', '$ATTRIBUTE_TITLE', '$ATTRIBUTE_VALUE')";
    $query = mysqli_query($con, $Sql);
    if ($query == true) { ?>
      <meta http-equiv="refresh" content="1, edit_product.php?product_id=<?php echo $product_id; ?>" />
  <?php }
  }

  ?>

  <script type="text/javascript">
    function CheckAlertQTY() {
      var StockInNumber = document.getElementById("StockInNumber").value;
      var StockAlertNumber = document.getElementById("StockAlertNumber").value;
      if (StockAlertNumber === StockInNumber) {
        document.getElementById("AlertMsg").style.display = "block";
      } else {
        document.getElementById("AlertMsg").style.display = "none";
      }
    }
  </script>

  <script>
    function OptionAdd() {
      if (document.getElementById("option_Add").style.display === "none") {
        document.getElementById("option_Add").style.display = "block";
        document.getElementById("optionbtn").innerHTML = "Hide";
        document.getElementById("optionbtn").classList.remove("btn-primary");
        document.getElementById("optionbtn").classList.add("btn-danger");
      } else {
        document.getElementById("option_Add").style.display = "none";
        document.getElementById("optionbtn").innerHTML = "Add Options";
        document.getElementById("optionbtn").classList.remove("btn-danger");
        document.getElementById("optionbtn").classList.add("btn-primary");
      }
    }
  </script>
  <script>
    function SpecificationAdd() {
      if (document.getElementById("specifi_Add").style.display === "none") {
        document.getElementById("specifi_Add").style.display = "block";
        document.getElementById("specifybtn").innerHTML = "Hide";
        document.getElementById("specifybtn").classList.remove("btn-primary");
        document.getElementById("specifybtn").classList.add("btn-danger");
      } else {
        document.getElementById("specifi_Add").style.display = "none";
        document.getElementById("specifi_Add").innerHTML = "Add Options";
        document.getElementById("specifybtn").classList.remove("btn-danger");
        document.getElementById("specifybtn").classList.add("btn-primary");
      }
    }
  </script>
  <?php require 'footer.php'; ?>

</body>
<!-- END: Body-->

</html>