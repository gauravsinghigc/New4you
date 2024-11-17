<?php
$user_product_id_value = $fetch['user_product_id'];
$user_product_id_value_view = $fetch['user_product_id'];
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
$product_net_price = $fetch['product_net_price'];
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
$product_sub_cat_title = "";
$product_created_at = $fetch['product_created_at'];
$product_updated_at = $fetch['product_updated_at'];
$brand_title = $fetch['brand_title'];
$sub_cat_title = "";
$product_cat_title = $fetch['product_cat_title'];
$stockcount = $fetch['product_stock_in'];
$alertcount = $fetch['product_stock_alert_on'];
$hindi_name = $fetch['unique_feature'];
$product_img = $fetch['product_image'];
$products_taxes = $fetch['products_taxes'];

$sub_cat_title = "";
if ($product_status == "active") {
 $status = "<i class='text-success fa fa-check-circle float-right'> Active</i>";
} elseif ($product_status == "inactive") {
 $status = "<i class='text-warning fa fa-warning float-right'> Inactive</i>";
}

$saveamount = $product_save_amount;

if ($product_installation_charge_status === "YES") {
 $installation_charge = "<br>Installation <i class='fa fa-inr'></i> " . $product_installation_charge;
} else {
 $installation_charge = "";
}


if ($product_delivery_charge_status === "YES") {
 $delivery_charge = "<br> Delivery <i class='fa fa-inr'></i> " . $product_delivery_charge;
} else {
 $delivery_charge = "";
}

if ($saveamount == 0 || $saveamount < 0) {
 $hidden = "style='display:none;'";
} else {
 $hidden = "";
}


if ($product_offer_status === "YES") {
 $product_type = str_replace("_", " ", $product_type);
 $product_offer_status = "<br><span class='text-danger'>Offer Available</span> | <span class='text-success'>$product_type</span>";
} else {
 $product_offer_status = "";
}
