<?php require 'files.php';
if (isset($_SESSION['ADD_TO_CART_SESSION'])) {
   $ip_address = $_SESSION['ADD_TO_CART_SESSION'];
} else {
   $ip_address = "";
}
$device_info = "$ip_address";
if (isset($_SESSION['customer_id'])) {
   $customer_id = $_SESSION['customer_id'];
   $sql = "SELECT * from customer_cart where customer_id='$customer_id'";
   $query = mysqli_query($con, $sql);
   $count = mysqli_num_rows($query);

   $select = "SELECT sum(product_total_amount) FROM customer_cart where customer_id='$customer_id'";
   $action = mysqli_query($con, $select);
   while ($record = mysqli_fetch_array($action)) {
      $total_amount = $record['sum(product_total_amount)'];
   }
} else {
   $sql = "SELECT * from customer_cart where ip_address='$ip_address'";
   $query = mysqli_query($con, $sql);
   $count = mysqli_num_rows($query);

   $select = "SELECT sum(product_total_amount) FROM customer_cart where ip_address='$ip_address'";
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
$delivery_charges = $delivery_charge + $concharge; ?>
<!DOCTYPE html>
<html>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <title><?php echo $store_name; ?> : Cart</title>
 <?php include 'header_files.php'; ?>
</head>

<body>
 <?php
   include "header.php"; ?>
 <!-- breadcrumb start -->
 <div class="breadcrumb-main ">
  <div class="container">
   <div class="row">
    <div class="col">
     <div class="breadcrumb-contain">
      <div>
       <h2>Shopping Cart</h2>
       <ul>
        <li><a href="index.php">home</a></li>
        <li><i class="fa fa-angle-double-right"></i></li>
        <li><a href="javascript:void(0)">Shopping Cart</a></li>
       </ul>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>


 <section class="cart-section section-big-py-space b-g-light">
  <div class="custom-container">
   <?php
         if (isset($_SESSION['customer_id'])) {
            $customer_id = $_SESSION['customer_id'];
            $sql = "SELECT * FROM customer_cart, user_products, pro_brands, product_categories where customer_cart.customer_id='$customer_id' and customer_cart.user_product_id=user_products.user_product_id and user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id";
         } else {
            $sql = "SELECT * FROM customer_cart, user_products, pro_brands, product_categories where customer_cart.ip_address='$ip_address' and customer_cart.user_product_id=user_products.user_product_id and user_products.product_brand_id=pro_brands.brand_id and user_products.product_cat_id=product_categories.product_cat_id";
         }
         $query = mysqli_query($con, $sql);
         $count = mysqli_num_rows($query);
         if ($count == 0 || $count == null) { ?>
   <div class="row">
    <div class="col-md-12 top_brand_left">
     <center>
      <img src="img/blank.png" style="width:30%; margin-top:5%;">
      <h1>Shopping Cart in Empty</h1>
      <p>Please add some products in Shopping cart.</p>
      <br>
      <a href="products.php" class="btn btn-info btn-sm text-white">View Products</a><br><br><br>
     </center>
    </div>
   </div>
   <?php } else { ?>
   <div class="row">
    <div class="col-sm-12">
     <?php if ($DEVICE_TYPE == "Mobile") { ?>
     <?php
                     $product_delivery_charge = 0;
                     $product_return_policy_charge_amount = 0;
                     $product_installation_charge = 0;
                     $totalcharges = 0;
                     $producttaxablecharges = 0;
                     while ($fetch = mysqli_fetch_assoc($query)) {
                        $cart_id = $fetch['cart_id'];
                        $user_product_id_value = $fetch['user_product_id'];
                        $product_title = $fetch['product_title'];
                        $product_img = $fetch['product_img'];
                        $product_cat_title = $fetch['product_cat_title'];
                        $product_price = $fetch['product_price'];
                        $product_title = $fetch['product_title'];
                        $product_tags = $fetch['product_tags'];
                        $brand_title = $fetch['brand_title'];
                        $product_quantity = $fetch['product_quantity'];
                        $product_total_amount = $fetch['product_total_amount'];
                        $product_mrp = $fetch['product_mrp'];
                        $hindi_name = $fetch['hindi_name'];
                        $product_taxes = $fetch['product_taxes'];
                        $product_net_price = $fetch['product_net_prices'];
                        $product_delivery_charge += (int)$fetch['product_delivery_charge'];
                        $product_return_policy_charge_amount += (int)$fetch['product_return_policy_charge_amount'];
                        $product_installation_charge += (int)$fetch['product_installation_charge'];
                        $producttaxablecharges += $product_total_amount / 100 * $product_taxes;

                        if ($product_delivery_charge == 0 || $product_delivery_charge == null) {
                           $product_delivery_charge = 0;
                        } else {
                           $product_delivery_charge = $product_delivery_charge;
                        }

                        if ($product_return_policy_charge_amount == 0 || $product_return_policy_charge_amount == null) {
                           $product_return_policy_charge_amount = 0;
                        } else {
                           $product_return_policy_charge_amount = $product_return_policy_charge_amount;
                        }

                        if ($product_installation_charge == 0 || $product_installation_charge == null) {
                           $product_installation_charge = 0;
                        } else {
                           $product_installation_charge = $product_installation_charge;
                        }

                        $totalcharges += $product_delivery_charge + $product_installation_charge;
                        $product_title = $fetch['product_title'] . "-" . $brand_title . "-" . $fetch['ProductModalNo'] . "-" . $fetch['product_modal_for_seo'] . "-" . $fetch['ProductSizeCapacity'] . "-" . $fetch['unique_feature'] . "-" . $fetch['ProductEdition'] . "-" . $fetch['product_warranty_in_diff_time'] . "-" . $fetch['product_warranty_in_break'] . "-" . $fetch['product_HSN'] . "-" . $product_tags . "<br>
  $product_installation_charge
  $product_delivery_charge
  $product_return_policy_charge_amount";
                     ?>

     <div class="row shadow-sm p-1">
      <div class="col-md-3 col-sm-3 col-3 col-xs-3 col">
       <div class="shadow-sm rounded-3">
        <a href="details.php?id=<?php echo $user_product_id_value; ?>"><img
          src="<?php echo $img_url; ?>/img/store_img/pro_img/<?php echo $product_img; ?>" alt="cart"
          class="img-fluid rounded-3">
        </a>
       </div>
      </div>
      <div class="col-md-9 col-sm-9 col-9 col-xs-9 col">
       <div class="p-1">
        <a href="delete.php?delete_cart=<?php echo $cart_id; ?>"
         class="btn btn-danger btn-sm text-white pull-right w-25">
         <i class="fa fa-trash"></i>
        </a>
        <h6><?php echo $product_title; ?></h6>
        <div class="qty-box pt-2">
         <div class="input-group" style="width:100%;border:none !important;">
          <form action='update.php' method='POST'>
           <input type="text" name="product_price" value="<?php echo $product_price; ?>" hidden="">
           <input type="text" name="cart_id" value="<?php echo $cart_id; ?>" hidden="">
           <input type="text" name="quantity" value="<?php echo $product_quantity; ?>" hidden="">
           <input type="text" name="product_mrp" value="<?php echo $product_mrp; ?>" hidden="">
           <input type="text" name="product_taxes" value="<?php echo $product_taxes; ?>" hidden="">
           <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
           <input type="submit" name="DECREASE" class="btn btn-info btn-md float-right text-white" value="-"
            style="padding: 7px !important;padding-left: 10px !important;padding-right: 10px !important;margin-right:2px !important;" />
          </form>
          <input type='text' min='1' max='10' value='<?php echo $product_quantity; ?>'
           style='width:25px !important;padding: 0px 0px 3px 8px !important;height: 38px;'
           id="qty<?php echo $user_product_id_value; ?>">
          <form action='update.php' method='POST'>
           <input type="text" name="product_price" value="<?php echo $product_price; ?>" hidden="">
           <input type="text" name="cart_id" value="<?php echo $cart_id; ?>" hidden="">
           <input type="text" name="quantity" value="<?php echo $product_quantity; ?>" hidden="">
           <input type="text" name="product_mrp" value="<?php echo $product_mrp; ?>" hidden="">
           <input type="text" name="product_taxes" value="<?php echo $product_taxes; ?>" hidden="">
           <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
           <input type="submit" name="INCREASE" class="btn btn-info btn-md float-left text-white" value="+"
            style="padding: 7px !important;padding-left: 10px !important;padding-right: 10px !important;margin-left:2px !important;" />
          </form>
         </div>
         <h5 class="text-black img-fluid mt-0 text-right pull-right p-1" style="width:250px !important;">
          <span class="text-grey">Rs. <?php echo $product_price; ?> x <?php echo $product_quantity; ?></span><br>
          <span>= Rs.<?php echo $product_price * $product_quantity; ?></span>
         </h5>
        </div>


       </div>
      </div>
     </div>

     <?php } ?>
     <?php } else { ?>
     <table class="table cart-table table-responsive-xs">
      <thead>
       <tr class="table-head">
        <th scope="col">action</th>
        <th scope="col">image</th>
        <th scope="col">product name</th>
        <th scope="col">price</th>
        <th scope="col">quantity</th>
        <th scope="col">total</th>
       </tr>
      </thead>
      <?php
                        $product_delivery_charge = 0;
                        $product_return_policy_charge_amount = 0;
                        $product_installation_charge = 0;
                        $totalcharges = 0;
                        $producttaxablecharges = 0;
                        while ($fetch = mysqli_fetch_assoc($query)) {
                           $cart_id = $fetch['cart_id'];
                           $user_product_id_value = $fetch['user_product_id'];
                           $product_title = $fetch['product_title'];
                           $product_img = $fetch['product_img'];
                           $product_cat_title = $fetch['product_cat_title'];
                           $product_price = $fetch['product_price'];
                           $product_title = $fetch['product_title'];
                           $product_tags = $fetch['product_tags'];
                           $brand_title = $fetch['brand_title'];
                           $product_quantity = $fetch['product_quantity'];
                           $product_total_amount = $fetch['product_total_amount'];
                           $product_mrp = $fetch['product_mrp'];
                           $hindi_name = $fetch['hindi_name'];
                           $product_taxes = $fetch['product_taxes'];
                           $product_net_price = $fetch['product_net_prices'];
                           $product_delivery_charge += (int)$fetch['product_delivery_charge'];
                           $product_return_policy_charge_amount += (int)$fetch['product_return_policy_charge_amount'];
                           $product_installation_charge += (int)$fetch['product_installation_charge'];
                           $producttaxablecharges += $product_total_amount / 100 * $product_taxes;

                           if ($product_delivery_charge == 0 || $product_delivery_charge == null) {
                              $product_delivery_charge = 0;
                           } else {
                              $product_delivery_charge = $product_delivery_charge;
                           }

                           if ($product_return_policy_charge_amount == 0 || $product_return_policy_charge_amount == null) {
                              $product_return_policy_charge_amount = 0;
                           } else {
                              $product_return_policy_charge_amount = $product_return_policy_charge_amount;
                           }

                           if ($product_installation_charge == 0 || $product_installation_charge == null) {
                              $product_installation_charge = 0;
                           } else {
                              $product_installation_charge = $product_installation_charge;
                           }

                           $totalcharges += $product_delivery_charge + $product_installation_charge;
                           $product_title = $fetch['product_title'] . "-" . $brand_title . "-" . $fetch['ProductModalNo'] . "-" . $fetch['product_modal_for_seo'] . "-" . $fetch['ProductSizeCapacity'] . "-" . $fetch['unique_feature'] . "-" . $fetch['ProductEdition'] . "-" . $fetch['product_warranty_in_diff_time'] . "-" . $fetch['product_warranty_in_break'] . "-" . $fetch['product_HSN'] . "-" . $product_tags . "<br>
  $product_installation_charge
  $product_delivery_charge
  $product_return_policy_charge_amount";
                        ?>
      <tbody>
       <tr>
        <td><a href="delete.php?delete_cart=<?php echo $cart_id; ?>" class="icon text-danger"><i
           class="fa fa-times"></i></a></td>
        <td>
         <a href="details.php?id=<?php echo $user_product_id_value; ?>"><img
           src="<?php echo $img_url; ?>/img/store_img/pro_img/<?php echo $product_img; ?>" alt="cart" class=" "></a>
        </td>
        <td><a href="details.php?id=<?php echo $user_product_id_value; ?>"><?php echo $product_title; ?><br>
          <small><i><?php echo $brand_title; ?></i></small></a>
        </td>
        <td>
         <h2><i class="fa fa-inr"></i><?php echo $product_price; ?></h2>
        </td>
        <td align="center">
         <div class="qty-box">
          <div class="input-group" style="width:100%;border:none !important;">
           <form action='update.php' method='POST'>
            <input type="text" name="product_price" value="<?php echo $product_price; ?>" hidden="">
            <input type="text" name="cart_id" value="<?php echo $cart_id; ?>" hidden="">
            <input type="text" name="quantity" value="<?php echo $product_quantity; ?>" hidden="">
            <input type="text" name="product_mrp" value="<?php echo $product_mrp; ?>" hidden="">
            <input type="text" name="product_taxes" value="<?php echo $product_taxes; ?>" hidden="">
            <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
            <input type="submit" name="DECREASE" class="btn btn-info btn-md float-right text-white" value="-"
             style="padding: 7px !important;padding-left: 10px !important;padding-right: 10px !important;margin-right:2px !important;" />
           </form>
           <input type='text' min='1' max='10' value='<?php echo $product_quantity; ?>'
            style='width:15% !important;padding: 0px 0px 3px 8px !important;height: 38px;'
            id="qty<?php echo $user_product_id_value; ?>">
           <form action='update.php' method='POST'>
            <input type="text" name="product_price" value="<?php echo $product_price; ?>" hidden="">
            <input type="text" name="cart_id" value="<?php echo $cart_id; ?>" hidden="">
            <input type="text" name="quantity" value="<?php echo $product_quantity; ?>" hidden="">
            <input type="text" name="product_mrp" value="<?php echo $product_mrp; ?>" hidden="">
            <input type="text" name="product_taxes" value="<?php echo $product_taxes; ?>" hidden="">
            <input type="text" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
            <input type="submit" name="INCREASE" class="btn btn-info btn-md float-left text-white" value="+"
             style="padding: 7px !important;padding-left: 10px !important;padding-right: 10px !important;margin-left:2px !important;" />
           </form>
          </div>
         </div>
        </td>
        <td>
         <h2 class="td-color"><i class="fa fa-inr"></i> <?php echo $product_total_amount; ?>
         </h2>
        </td>
       </tr>
      </tbody>

      <?php }

                        if ($totalcharges == 0 || $totalcharges == null) {
                           $totalcharges = 0;
                        } else {
                           $totalcharges = $totalcharges;
                        }  ?>
     </table>
     <?php } ?>
    </div>
    <hr>
    <div class="col-md-12 text-right">
     <h3 class="p-2 shadow-sm"><b class="text-grey">Total Amount : </b><span class="text-black"
       style="width:200px !important;"><i class="fa fa-inr"></i>
       <?php echo $total_amount; ?></span>
     </h3>


     <h3 class="p-2 shadow-sm"><b class="text-grey">Delivery & Conveniance Charges :</b> <span class="text-black"
       style="width:200px !important;"><i class="fa fa-inr"></i>
       <?php echo $totalcharges; ?></span></h3>

     <h3 class="p-2 shadow-sm text-success"><b class="text-success">Net Payable Amount :</b> <span class="text-success"
       style="width:200px !important;"><i class="fa fa-inr"></i>
       <?php $net_payable_amount = $total_amount + $totalcharges;
                        echo $net_payable_amount; ?></span>
     </h3>
     <br>
     <p colspan="2" class="text-grey" style="Color:grey !important; font-weight:300 !important;">All prices are GST
      Inclusive.</p>
    </div>
    <div class="row cart-buttons">
     <div class="col-12">
      <form action="insert.php" method="POST">
       <input type='text' name='store_id' value='<?php echo $store_id; ?>' hidden=''>
       <input type="text" name="product_total_amount" value="<?php echo $total_amount; ?>" hidden="">
       <input type="text" name="DELIVERY_TYPE" value="Home Delivery" hidden="">
       <input type="text" name="coupon_code" value="NO Coupon Applied" hidden="">
       <input type="text" name="total_amount_after_discount" value="<?php echo $net_payable_amount; ?>" hidden="">
       <input type="text" name="net_payable_amount" value="<?php echo $net_payable_amount; ?>" hidden="">
       <input type="text" name="delivery_charge" value="<?php echo $totalcharges; ?>" hidden="">
       <button type="submit" name='save_products_into_session' class="btn btn-normal ms-3">check out</button>
      </form>
     </div>
    </div>
    <?php } ?>
   </div>
 </section>
 <!--section end-->


 <?php include 'footer.php'; ?>
</body>

</html>
