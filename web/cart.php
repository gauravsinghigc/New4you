<?php
require 'files.php';
if (isset($_GET['data'])) { ?>
   <meta http-equiv="refresh" content="3; cart.php">
<?php } elseif (isset($_GET['msg'])) { ?>
   <meta http-equiv="refresh" content="3; cart.php">
<?php } elseif (isset($_GET['err'])) { ?>
   <meta http-equiv="refresh" content="3; cart.php">
<?php } else {
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title><?php echo $store_name; ?> : Cart</title>
   <?php require 'header_files.php'; ?>
   <script type="text/javascript">
      function incrementValue() {
         var value = parseInt(document.getElementById('number').value, 10);
         value = isNaN(value) ? 0 : value;
         if (value < 10) {
            value++;
            document.getElementById('number').value = value;
         }
      }

      function decrementValue() {
         var value = parseInt(document.getElementById('number').value, 10);
         value = isNaN(value) ? 0 : value;
         if (value > 1) {
            value--;
            document.getElementById('number').value = value;
         }

      }
   </script>
</head>

<body>
   <?php require 'header.php'; ?>
   <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <a href="index.php"><strong><span class="fa fa-home"></span> Home</strong></a> <span class="fa fa-angle-right"></span> <a href="cart.php">My Cart</a>
            </div>
         </div>
      </div>
   </section>
   <section class="cart-page section-padding">
      <div class="container">
         <div class="row">

            <?php
            $ip_address = get_ip();
            $device_type = detectDevice();
            date_default_timezone_set("Asia/Calcutta");
            $date_time_c = date("dMY");
            $ipv6_n = php_uname('n');
            $ipv6_p = php_uname('p');
            $os = php_uname('s');
            $OS_release = php_uname('r');
            $OS_Version = php_uname('v');
            $System_Info = php_uname('m');
            $System_more_Info = $_SERVER['HTTP_USER_AGENT'];
            $device_info = "$ip_address";
            if (isset($_SESSION['customer_id'])) {
               $customer_id = $_SESSION['customer_id'];
               $sql = "SELECT * from customer_cart where store_id='$store_id' and customer_id='$customer_id'";
               $query = mysqli_query($con, $sql);
               $count = mysqli_num_rows($query);

               $select = "SELECT sum(product_total_amount) FROM customer_cart where store_id='$store_id' and customer_id='$customer_id'";
               $action = mysqli_query($con, $select);
               while ($record = mysqli_fetch_array($action)) {
                  $total_amount = $record['sum(product_total_amount)'];
               }
            } else {
               $sql = "SELECT * from customer_cart where device_info='$device_info' and ip_address='$ip_address' and store_id='$store_id'";
               $query = mysqli_query($con, $sql);
               $count = mysqli_num_rows($query);

               $select = "SELECT sum(product_total_amount) FROM customer_cart where ip_address='$ip_address' and store_id='$store_id' and device_info='$device_info'";
               $action = mysqli_query($con, $select);
               while ($record = mysqli_fetch_array($action)) {
                  $total_amount = $record['sum(product_total_amount)'];
               }
            }

            $sql = "SELECT * FROM delivery_charges where store_id='$store_id' and delivery_charge_status='active'";
            $query = mysqli_query($con, $sql);
            $fetch = mysqli_fetch_assoc($query);
            $concharge = $fetch['concharge'];
            $delivery_charge = $fetch['delivery_charge'];
            $est_delivery_amount = $fetch['est_delivery_amount'];

            $delivery_charges = $delivery_charge + $concharge;

            if ($count == 0) { ?>
               <div class="col-md-12 top_brand_left">
                  <center>
                     <img src="img/blank.png" style="width:30%; margin-top:5%;">
                     <h1>Shopping Cart in Empty</h1>
                     <p>Please add some products in Shopping cart.</p>
                     <a href="products.php" class="btn btn-info btn-lg">View Products</a><br><br><br>
                  </center>
               </div>

            <?php } else { ?>
               <div class="col-md-12">
                  <div class="card card-body cart-table">
                     <div class="table-responsive">
                        <table class="table cart_summary">
                           <thead>
                              <tr>
                                 <th class="cart_product" style="width:9%;">Product</th>
                                 <th style="width: 33%;">Description</th>
                                 <th style="width: 25%;">price</th>
                                 <th style="width: 10%;">Qty</th>
                                 <th style="width: 15%;">Total</th>
                                 <th class="action" style="width: 9%;"><i class="fa fa-trash mt-0"></i></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $fetch = mysqli_fetch_assoc($query);
                              $user_product_id = $fetch['user_product_id'];
                              if (isset($_SESSION['customer_id'])) {
                                 mysqli_set_charset($con, 'utf8');
                                 $sql = "SELECT * FROM customer_cart, user_products, pro_brands, product_categories where customer_id='$customer_id' and customer_cart.user_product_id=user_products.product_title and user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id";
                              } else {
                                 mysqli_set_charset($con, 'utf8');
                                 $sql = "SELECT * FROM customer_cart, user_products, pro_brands, product_categories where device_info='$device_info' and ip_address='$ip_address' and customer_cart.user_product_id=user_products.product_title and user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id";
                              }
                              $query = mysqli_query($con, $sql);
                              while ($fetch = mysqli_fetch_assoc($query)) {
                                 $cart_id = $fetch['cart_id'];
                                 $user_product_id_value = $fetch['user_product_id'];
                                 $product_title = $fetch['product_title'];
                                 $product_img = $fetch['product_img'];
                                 $product_cat_title = $fetch['product_cat_title'];
                                 $product_price = $fetch['product_price'];
                                 $product_tags = $fetch['product_tags'];
                                 $brand_title = $fetch['brand_title'];
                                 $product_quantity = $fetch['product_quantity'];
                                 $product_total_amount = $fetch['product_total_amount'];
                                 $product_mrp = $fetch['product_mrp'];
                                 $hindi_name = $fetch['hindi_name'];
                              ?>
                                 <tr>
                                    <td class="cart_product"><a href="details.php?product_id=<?php echo $user_product_id_value; ?>">
                                          <img class="img-fluid" src="<?php echo $img_url; ?>/img/store_img/pro_img/<?php echo $product_img; ?>" alt="<?php echo $product_title; ?>" title='<?php echo $product_title; ?>'></a></td>
                                    <td class="cart_description">
                                       <h5><b><a href="details.php?product_id=<?php echo $user_product_id_value; ?>"><?php echo $product_title; ?> <br><?php echo $hindi_name; ?> </a></b></h5>
                                       <h6><strong><span class="fa fa-balance-scale text-success"></span></strong> <?php echo $product_tags; ?></h6>
                                       <div class="input-group" style="width:100%;">
                                          <form action='update.php' method='POST'>
                                             <input type="text" name="product_price" value="<?php echo $product_price; ?>" hidden="">
                                             <input type="text" name="cart_id" value="<?php echo $cart_id; ?>" hidden="">
                                             <input type="text" name="quantity" value="<?php echo $product_quantity; ?>" hidden="">
                                             <input type="text" name="product_mrp" value="<?php echo $product_mrp; ?>" hidden="">
                                             <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
                                             <input type="submit" name="DECREASE" class="btn btn-info btn-md float-right text-white" value="-" style="padding: 7px !important;
    padding-left: 10px !important;
    padding-right: 10px !important;" />
                                          </form>
                                          <input type='text' min='1' max='10' value='<?php echo $product_quantity; ?>' style='width:10% !important;
    padding: 0px 0px 3px 8px !important;
    box-shadow: 0px 0px 1px grey;
    height: 33px;' id="qty<?php echo $user_product_id_value; ?>">
                                          <form action='update.php' method='POST'>
                                             <input type="text" name="product_price" value="<?php echo $product_price; ?>" hidden="">
                                             <input type="text" name="cart_id" value="<?php echo $cart_id; ?>" hidden="">
                                             <input type="text" name="quantity" value="<?php echo $product_quantity; ?>" hidden="">
                                             <input type="text" name="product_mrp" value="<?php echo $product_mrp; ?>" hidden="">
                                             <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
                                             <input type="submit" name="INCREASE" class="btn btn-info btn-md float-left text-white" value="+" style="padding: 7px !important;
    padding-left: 10px !important;
    padding-right: 10px !important;" />
                                          </form>
                                       </div>
                                    </td>

                                    <td class="price"><span><i class="fa fa-inr"></i> <?php echo $product_price; ?> / <?php echo $product_tags; ?></span></td>
                                    <td class="qty">
                                       x <?php echo $product_quantity; ?>
                                    </td>
                                    <td class="price"><span><i class="fa fa-inr"></i> <?php echo $product_total_amount; ?></span></td>
                                    <td class="action">
                                       <a class="btn btn-sm btn-danger" data-original-title="Remove Item" href="delete.php?delete_cart=<?php echo $cart_id; ?>" title="" data-placement="top" data-toggle="tooltip"><i class="fa fa-trash mt-0"></i></a>
                                    </td>
                                 </tr>
                              <?php } ?>

                           </tbody>
                           <tfoot>
                              <tr>

                                 <td colspan="5">
                                    <?php
                                    if (isset($_POST['OC'])) {
                                       $OC = $_POST['OC'];
                                       $sql = "SELECT * from store_coupons where store_id='$store_id' and coupon_status='active'";
                                       $query = mysqli_query($con, $sql);
                                       $fetch = mysqli_fetch_assoc($query);
                                       $percentage = $fetch['percentage'];
                                       $coupon_code = $fetch['coupon_code'];
                                       $coupon_status = $fetch['coupon_status'];

                                       if ($OC == $coupon_code) {
                                          $discount_price = round($total_amount / 100 * $percentage);
                                          echo "<h6 class='text-success float-right'>Coupon <code>$OC</code> Applied Successfully!, You Save <i class='fa fa-inr'></i>$discount_price in this Purchase  <a href='cart.php' data-placement='top' data-toggle='tooltip' data-original-title='Remove Coupon' class='text-danger'><i class='fa fa-trash'></i> Remove</h6>
                                       ";
                                       } elseif ($OC != $coupon_code) { ?>
                                          <h6 class='text-danger float-right'>INVALID Coupon Code <a href='cart.php' data-placement='top' data-toggle='tooltip' data-original-title='Remove Coupon' class='text-danger'><i class='fa fa-trash'></i> Remove</h6>
                                       <?php } ?>
                                    <?php } else { ?>
                                       <form class="form-inline float-right" action="" method="POST">
                                          <div class="form-group">
                                             <label class="text-left">Have you any GIFT Code or OFFER code? &nbsp;</label>
                                             &nbsp;<input type="text" placeholder="Enter code" name='OC' class="form-control border-form-control form-control-sm">
                                          </div>
                                          &nbsp;<br><br>
                                          <button class="btn btn-success btn-md" type="submit">Apply</button>
                                       </form>
                                    <?php } ?>
                                    <!--Discount : <i class="fa fa-inr"></i>237.88-->
                                 </td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td class="text-right" colspan="4">Total Products Price :</td>
                                 <td colspan="2"> <i class="fa fa-inr"></i> <?php echo $total_amount; ?> </td>
                              </tr>
                              <?php if (isset($_POST['OC'])) { ?>
                                 <tr>
                                    <td class="text-right" colspan="4">Discount Amount:</td>
                                    <td colspan="2">
                                       <?php
                                       if ($OC == $coupon_code) {
                                          $discount_price = round($total_amount / 100 * $percentage);
                                          $new_total_amount = $total_amount - $discount_price;
                                          echo "<i class='fa fa-inr'></i>" . $discount_price;
                                       } elseif ($OC != $coupon_code) {
                                          echo "<i class='fa fa-inr'></i> 0 ";
                                       }
                                       ?>
                                    </td>
                                 </tr>
                              <?php  } ?>
                              <?php if (isset($_POST['OC'])) { ?>
                                 <tr>
                                    <td class="text-right" colspan="4">After Discount Total Product Price:</td>
                                    <td colspan="2">
                                       <?php if (isset($_POST['OC'])) {
                                          if ($OC == $coupon_code) {
                                             $discount_price = round($total_amount / 100 * $percentage);
                                             $new_total_amount = $total_amount - $discount_price;
                                             echo "<h4 class='text-success'><i class='fa fa-inr'></i> $new_total_amount</h4>";
                                          } elseif ($OC != $coupon_code) {
                                             echo "<i class='fa fa-inr'></i>" . $total_amount;
                                          }
                                       } ?>
                                    </td>
                                 </tr>
                              <?php } ?>
                              <tr>
                                 <td class="text-right" colspan="4">Delivery & Conveniance Charges :
                                    <?php if (isset($_POST['OC'])) {
                                       if ($OC == $coupon_code) {
                                          $discount_price = round($total_amount / 100 * $percentage);
                                          $new_total_amount = $total_amount - $discount_price;

                                          if ($total_amount < $est_delivery_amount) {
                                          } elseif ($est_delivery_amount <= $total_amount) {
                                          } ?></td>
                                 <td colspan="2">
                                    <?php if ($total_amount < $est_delivery_amount) {
                                             echo '<i class="fa fa-inr"></i> ' . $delivery_charges;
                                          } elseif ($est_delivery_amount <= $total_amount) {
                                             echo "Free";
                                          }
                                       } elseif ($OC != $coupon_code) {

                                          if ($total_amount < $est_delivery_amount) {
                                          } elseif ($est_delivery_amount <= $total_amount) {
                                          } ?></td>
                                 <td colspan="2"> <?php if ($total_amount < $est_delivery_amount) {
                                                      echo '<i class="fa fa-inr"></i> ' . $delivery_charges;
                                                   } elseif ($est_delivery_amount <= $total_amount) {
                                                      echo "Free";
                                                   }
                                                }
                                             } else {
                                                if ($total_amount < $est_delivery_amount) {
                                                } elseif ($est_delivery_amount <= $total_amount) {
                                                } ?></td>
                                 <td colspan="2"> <?php if ($total_amount < $est_delivery_amount) {
                                                      echo '<i class="fa fa-inr"></i> ' . $delivery_charges;
                                                   } elseif ($est_delivery_amount <= $total_amount) {
                                                      echo "Free";
                                                   }
                                                } ?>

                                 </td>
                              </tr>
                              <tr>
                                 <td class="text-right" colspan="4"><strong>Net Payable Amount:</strong></td>
                                 <td class="text-danger" colspan="2"><strong>
                                       <h3><i class="fa fa-inr"></i>
                                          <?php if (isset($_POST['OC'])) {
                                             if ($OC == $coupon_code) {
                                                $discount_price = round($total_amount / 100 * $percentage);
                                                $new_total_amount = $total_amount - $discount_price;
                                                if ($total_amount < $est_delivery_amount) {
                                                   echo $delivery_charge + $new_total_amount + $concharge;
                                                } elseif ($est_delivery_amount <= $total_amount) {
                                                   echo $new_total_amount + $concharge;
                                                }
                                             } else {
                                                if ($total_amount < $est_delivery_amount) {
                                                   echo $delivery_charge + $total_amount + $concharge;
                                                } elseif ($est_delivery_amount <= $total_amount) {
                                                   echo $total_amount + $concharge;
                                                }
                                             }
                                          } else {
                                             if ($total_amount < $est_delivery_amount) {
                                                echo $delivery_charge + $total_amount + $concharge;
                                             } elseif ($est_delivery_amount <= $total_amount) {
                                                echo $total_amount + $concharge;
                                             }
                                          } ?></h3>
                                    </strong></td>
                              </tr>
                              <form action="insert.php" method="POST">
                                 <style type="text/css">
                                    /* HIDE RADIO */
                                    [type=radio] {
                                       position: absolute;
                                       opacity: 0;
                                       width: 0;
                                       height: 0;
                                    }

                                    /* IMAGE STYLES */
                                    [type=radio]+img {
                                       cursor: pointer;
                                    }

                                    /* CHECKED STYLES */
                                    [type=radio]:checked+img {
                                       border-style: groove !important;
                                       box-shadow: 0px 0px 5px green !important;
                                       border-radius: 10px !important;
                                       border-width: thin;
                                       border-color: green;
                                    }
                                 </style>
                                 <input type='text' name='store_id' value='<?php echo $store_id; ?>' hidden=''>
                                 <tr>
                                    <td colspan="3" align="right">
                                       <h5><i class="fa fa-truck text-success"></i> Choose Delivery Slot</h5>
                                       <p><b>Morning</b> <i class="fa fa-angle-right"></i> 6:00 AM to 11:00 AM<br>
                                          <b>Evening </b><i class="fa fa-angle-right"></i> 2:00 PM to 6:00 PM
                                       </p>
                                    </td>
                                    <td colspan="3" align="right">
                                       <div class="row" style="padding-right: 0px !important;
    margin-right: 0px !important;">
                                          <div class="col-6">
                                             <label>
                                                <input type="radio" name="PICK_SCHEDULE_TIME" id="PICKSCHEDULETIME" value="MORNING" required="">
                                                <img src="img/Morning.png" style="width: 90%; box-shadow: 0px 0px 4px grey;
    border-radius: 5px;
    padding: 3%;">
                                             </label>
                                          </div>
                                          <div class="col-6">
                                             <label>
                                                <input type="radio" name="PICK_SCHEDULE_TIME" id="PICKSCHEDULETIME2" value="EVENING" required="">
                                                <img src="img/evening.png" style="width: 90%; box-shadow: 0px 0px 4px grey;
    border-radius: 5px;
    padding: 3%;">
                                             </label>
                                          </div>
                                       </div>
                                    </td>

                                 </tr>
                           </tfoot>
                        </table>
                     </div>



                     <?php
                     if (isset($_GET['del'])) {
                        $del = $_GET['del'];
                        if ($del == "STORE_PICKUP") { ?>
                           <input type="text" name="DELIVERY_TYPE" value="STORE_PICKUP" hidden="">
                        <?php } elseif ($del == "DELIVERY") { ?>
                           <input type="text" name="DELIVERY_TYPE" value="HOME_DELIVERY" hidden="">
                        <?php  } else { ?>
                           <input type="text" name="DELIVERY_TYPE" value="HOME_DELIVERY" hidden="">
                        <?php }
                     } else { ?>
                        <input type="text" name="DELIVERY_TYPE" value="HOME_DELIVERY" hidden="">
                     <?php }
                     ?>

                     <input type="text" name="product_total_amount" value="<?php echo $total_amount; ?>" hidden>
                     <?php
                     if (isset($_POST['OC'])) {
                        if ($OC == $coupon_code) { ?>
                           <input type="text" name="coupon_code" value="<?php echo $coupon_code;
                                                                        echo ' (' . $percentage . '%)'; ?>" hidden>
                        <?php } else { ?>
                           <input type="text" name="coupon_code" value="Invalid Coupon" hidden>
                        <?php }
                     } else { ?>
                        <input type="text" name="coupon_code" value="NO Coupon Applied" hidden>
                     <?php } ?>

                     <input type="text" name="total_amount_after_discount" value="<?php
                                                                                    if (isset($_POST['OC'])) {
                                                                                       if ($OC == $coupon_code) {
                                                                                          echo $new_total_amount;
                                                                                       } else {
                                                                                          echo $total_amount;
                                                                                       }
                                                                                    } else {
                                                                                       echo $total_amount;
                                                                                    } ?>" hidden>
                     <input type="text" name="delivery_charge" value="
                        <?php if ($total_amount < $est_delivery_amount) {
                           echo $delivery_charges;
                        } elseif ($total_amount >= $est_delivery_amount) {
                           echo $concharge;
                        } ?>" hidden>
                     <input type="text" name="net_payable_amount" value="<?php if (isset($_POST['OC'])) {
                                                                              if ($OC == $coupon_code) {
                                                                                 $discount_price = round($total_amount / 100 * $percentage);
                                                                                 $new_total_amount = $total_amount - $discount_price;
                                                                                 if ($total_amount < $est_delivery_amount) {
                                                                                    echo $delivery_charge + $new_total_amount + $concharge;
                                                                                 } elseif ($est_delivery_amount <= $total_amount) {
                                                                                    echo $new_total_amount + $concharge;
                                                                                 }
                                                                              } else {
                                                                                 if ($total_amount < $est_delivery_amount) {
                                                                                    echo $delivery_charge + $total_amount + $concharge;
                                                                                 } elseif ($est_delivery_amount <= $total_amount) {
                                                                                    echo $total_amount + $concharge;
                                                                                 }
                                                                              }
                                                                           } else {
                                                                              if ($total_amount < $est_delivery_amount) {
                                                                                 echo $delivery_charge + $total_amount + $concharge;
                                                                              } elseif ($est_delivery_amount <= $total_amount) {
                                                                                 echo $total_amount + $concharge;
                                                                              }
                                                                           } ?>" hidden>


                     <button class="btn btn-secondary float-right" type="submit" name='save_products_into_session'>
                        <span class="float-right"><i class="fa fa-arrow-right"></i> Proceed to Checkout </span>
                     </button>
                     </form>
                  </div>
               </div>
            <?php } ?>
         </div>
      </div>
   </section>

   <?php require 'why_section.php'; ?>
   <?php require 'footer.php';
   require 'login_section.php'; ?>

</body>

</html>