<?php
require "files.php";
require 'include.php';
ini_set("display_errors", 1);

$sql = "SELECT * FROM web_tools where NAME='POINT_EARN'";
$Query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($Query);
$PointsEranings = $fetch['VALUE'];

if (isset($_COOKIE['customer_id']) and isset($_COOKIE['store_id'])) {
    $customer_id = $_COOKIE['customer_id'];
    $_SESSION['customer_id'] = $customer_id;
}

$customer_id = $_SESSION['customer_id'];
$sql = "SELECT * from customers where customer_id='$customer_id'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$store_id = $fetch['store_id'];

$customer_name = $fetch['customer_name'];
$customer_mail_id = $fetch['customer_mail_id'];
$customer_phone_number = $fetch['customer_phone_number'];
$delivery_address = $_COOKIE['delivery_address'];
$billing_address = $_COOKIE['billing_address'];
$payment_mode = $_COOKIE['payment_mode'];
$payment_amount = $_COOKIE['net_payable_amount'];
$net_payable_amount = $_COOKIE['net_payable_amount'];
$total_amount = $_COOKIE['product_total_amount_entry'];
$coupon_code = $_COOKIE['coupon_code'];
$total_amount_after_discount =  $_COOKIE['total_amount_after_discount'];
$delivery_charge = $_COOKIE['delivery_charge'];
$date_time = date("d M Y h:m A");
$order_id = $_COOKIE['order_id'];
$store_id = $_COOKIE['store_id'];
$DELIVERY_TYPE = $_COOKIE['DELIVERY_TYPE'];
$order_month = date("m");
$order_year = date("Y");
$order_day = date("d");
$order_date = date("d M Y");
$payment_note = "";
$delivery_status = "NOT_PICK_UP";
$delivery_date = "NA";
$order_status = "NEW_ORDER";
$PICK_SCHEDULE_TIME = "Not Available";
$payment_status = "";
$PICKUP_TIME = "";
$PICKUP_STATUS = "NOT_PICK_UP";
$rewardspoints = "";
$rewardsamount = "";
$order_type = "ONLINE";
$delivered_by = "";
$GSTTaxamount = "";

$sql = "SELECT * FROM stores where store_id='$store_id'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$store_user_id = $fetch['user_id'];

if ($payment_mode == "online_payment") {
    $PaymentStatus = $_COOKIE['PAYMENT_STATUS'];
    $PaymentDetails = $_COOKIE['TXNID'];
    $PaymentMode = $_COOKIE['PAYMENT_MODE'];
    $PaymentSource = $_COOKIE['PAYMENT_SOURCE'];
    $completeonlinepaydetails = $_COOKIE['COMPLETE_DETAILS'];
    $payment_status = "Success - TXN ID: $order_id";
    $payment_note = $PaymentDetails . " MODE: $PaymentMode" . " Source: $PaymentSource";

    //send order details on sms
    SEND_SMS(
        "38314e455734594f553234351658469066",
        "NEWFRU",
        "1",
        "$customer_phone_number",
        "You paid $net_payable_amount to new4you.in. Txn ID: $PaymentDetails for Order Id: $order_id. If you have issue then contact us at 9212684272. NEW4YOU",
        "1507165580660156487",
        "POST",
    );

    //cash paymnts
} elseif ($payment_mode == "cash_on_delivery") {
    $PaymentStatus = "TXN_SUCCESS";
    $PaymentDetails = "Cash";
    $PaymentMode = "CASH";
    $PaymentSource = "OFFLINE_CASH";
    $completeonlinepaydetails = "OFFLINE_CASH";
    $payment_status = "Not Paid";
    $payment_note = "";
}

if ($PaymentStatus == "TXN_SUCCESS") {

    $Sql = "SELECT * FROM customer_orders where order_id='$order_id' and customer_id='$customer_id'";
    $Query = mysqli_query($con, $Sql);
    $CountOrders = mysqli_num_rows($Query);

    if ($CountOrders == 0) {

        $SaveOrders = SAVE("customer_orders", [
            "order_id",
            "customer_id",
            "store_id",
            "delivery_address",
            "billing_address",
            "payment_mode",
            "payment_note",
            "coupon_code",
            "net_payable_amount",
            "payment_status",
            "delivery_status",
            "delivery_date",
            "order_status",
            "order_date",
            "total_amount",
            "total_amount_after_discount",
            "delivery_charge",
            "order_month",
            "order_year",
            "order_day",
            "DELIVERY_TYPE",
            "PICKUP_TIME",
            "PICK_SCHEDULE_TIME",
            "PICKUP_STATUS",
            "rewardspoints",
            "rewardsamount",
            "order_type",
            "delivered_by",
            "GSTTaxamount",
            "completeonlinepaydetails"
        ]);
        if ($SaveOrders == true) {
            $SQLItems = "SELECT * FROM customer_cart where customer_id='$customer_id'";
            $QueryItems = mysqli_query($con, $SQLItems);
            while ($FetchItems = mysqli_fetch_assoc($QueryItems)) {
                $CartId[] = $FetchItems['cart_id'];
            }

            foreach ($CartId as $cart_id) {
                $SQLItems = "SELECT * FROM customer_cart where customer_id='$customer_id' and cart_id='$cart_id'";
                $QueryItems = mysqli_query($con, $SQLItems);
                $FetchItem = mysqli_fetch_assoc($QueryItems);
                $product_id = $FetchItem['user_product_id'];
                $product_tags = $FetchItem['product_tags'];
                $product_price = $FetchItem['product_price'];
                $product_mrp = $FetchItem['product_mrp'];
                $product_quantity = $FetchItem['product_quantity'];
                $product_total_amount = $FetchItem['product_total_amount'];
                $mrp_total = $FetchItem['mrp_total'];
                $product_img = $FetchItem['product_img'];
                $hindi_name = $FetchItem['hindi_name'];
                $product_HSN = $FetchItem['product_HSN'];
                $product_taxes = $FetchItem['product_taxes'];
                $product_net_prices = $FetchItem['product_net_prices'];
                $product_names = $FetchItem['product_title'];
                $product_mrp_total = (int)$FetchItem['mrp_total'] * (int)$product_quantity;
                $product_total_price = (int)$FetchItem['product_price'] * (int)$product_quantity;
                $product_qty = $product_quantity;

                $SQLItemsDetails = "SELECT * FROM user_products where user_product_id='$product_id'";
                $QueryItemsDetails = mysqli_query($con, $SQLItemsDetails);
                $FetchItemsDetails = mysqli_fetch_assoc($QueryItemsDetails);

                $SaveItemIntoCustomerOrders = SAVE("ordered_products", [
                    "order_id", "store_id",
                    "customer_id", "product_id",
                    "product_names", "product_tags",
                    "product_mrp", "product_price",
                    "product_qty", "product_total_price",
                    "product_mrp_total", "item_status",
                    "product_img", "product_HSN",
                    "product_taxes", "product_net_prices"
                ]);

                $getQtyofStock = "SELECT * FROM user_products where user_product_id='$product_id'";
                $QueryOfStockQty = mysqli_query($con, $getQtyofStock);
                $FetchStockItemQty = mysqli_fetch_assoc($QueryOfStockQty);
                $ItemStockQty = (int)$FetchStockItemQty['product_stock_in'];
                $FinalItemQty = $ItemStockQty - (int)$product_qty;
                $UpdateStockQty = "UPDATE user_products SET product_stock_in='$FinalItemQty' where user_product_id='$product_id'";
                $UpdateQuery = mysqli_query($con, $UpdateStockQty);
            }


            if ($SaveItemIntoCustomerOrders == true) {
                $deletecartitems = "DELETE FROM customer_cart where customer_id='$customer_id'";
                $Deletequery = mysqli_query($con, $deletecartitems);
                if ($Deletequery == true) {

                    //send order details on sms
                    SEND_SMS(
                        "38314e455734594f553234351658469066",
                        "NEWFRU",
                        "1",
                        "$customer_phone_number",
                        "Thank you for shopping at new4you.in. We will deliver your order with id: $order_id in shortest possible time. Next SMS/Email on dispatch. NEW4YOU",
                        "1507165580646330556",
                        "POST",
                    );

                    echo "Items deleted";
                    header("location: done.php?msg=Order Placed!");
                } else {
                    echo "Unable to delete items";
                    header("location: done.php?msg= Order Placed Succesfully!");
                }
            } else {
                echo "Unable to save items into orders";
                header("location: cart.php?err=Unable to save items in orders");
            }
        } else {
            echo "Unable to save order";
            header("location: cart.php?err=Unable to create order");
        }
    } else {
        header("location: order_details.php?id=$order_id");
    }
} else {
    // header("location: cart.php?data=Transation Failed, Please Try Again after Some time.");
}
